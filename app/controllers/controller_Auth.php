<?php

require_once _app . '/models/model_users.php';

class Controller_Auth extends Controller
{
    private function get_params($gets, $params)
    {
        $keys = [];
        $val = [];
        foreach ($gets as $get) {
            $name = explode('=', $get);
            foreach ($params as $param)
                if ($name[0] == $param) {
                    array_push($keys, $param);
                    array_push($val, $name[1]);
                }
        }

        return array_combine($keys, $val);
    }

    public function valid_params($gets)
    {
        foreach ($gets as $get)
            switch (key($get)) {
                case 'id':
                    if (preg_match('/^[0-9]$/', $get)) {
                        http_response_code(400);
                        exit;
                    }
                    break;
                case 'name':
                    if (preg_match('/^[a-zA-Zа-яёА-ЯЁ\-|0-9]{3,40}$/', $get)) {
                        http_response_code(400);
                        echo "Неправильный формат логина";
                        exit;
                    }
                    break;
            }
    }

    public static function check_login()
    {
        $user = new model_users();

        session_start();

        if(isset($_SESSION['user']) &&  isset($_SESSION['id']) && $_SESSION['id']==($user->get_id_by_name($_SESSION['user']))->id)
        {
            http_response_code(200);
            return false;
        } else {
            http_response_code(200);
            return true;
        }
    }

    public static function check_perm()
    {
        if ((new model_users())->get_perm_by_name($_SESSION['user'])->perm == 1) {
            http_response_code(200);
            return false;
        } else {
            http_response_code(200);
            return true;
        }

    }

    public function action_get_user_id()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!Controller_Auth::check_login()) {
                header('Content-type: application/json');
                echo json_encode($_SESSION['id']);
            }
        }
    }

    public function action_get_user_name()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (!Controller_Auth::check_login()) {
                header('Content-type: application/json');
                echo json_encode($_SESSION['name']);
            }
        }
    }

    public function action_enter()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Authorization");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!($this->check_login())) {
                echo "Вы уже вошли";
                exit;
            }

            //$params = $this->get_params($gets, array('name', 'psw'));

            $user = new model_users();

            $id = ($user->get_id_by_name($_SERVER['PHP_AUTH_USER']))->id;

            if ($id && $user->get_pass_by_id($id)->psw == md5($_SERVER['PHP_AUTH_PW'])) {
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['user'] = $_SERVER['PHP_AUTH_USER'];
                setcookie("USER_ID", $id);
                http_response_code(200);
                echo "Успешно";
            } else {
                http_response_code(401);
                echo "Не удалось авторизоваться";
            }
        }
    }

    public function action_register()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!($this->check_login())) {
                echo "Вы уже вошли";
                exit;
            }

            $user = new model_users();

            $check_user = count($user->get_user_by_params(array($_SERVER['PHP_AUTH_USER'], $_GET['email'], $_GET['phone']))) > 0 ? 1 : 0;

            if (!$check_user) {
                $user->insert(array($_SERVER['PHP_AUTH_USER'], $_GET['email'],
                    !empty($_GET['phone']) ? $_GET['phone'] : null, md5($_SERVER['PHP_AUTH_PW'])));

                $id = ($user->get_id_by_name($_SERVER['PHP_AUTH_USER']))->id;
                if (!$id) {
                    http_response_code(401);
                    echo "Не удалось зарегистрироваться";
                    exit;
                }

                session_start();
                $_SESSION['id'] = $id;

                $_SESSION['user'] = $_SERVER['PHP_AUTH_USER'];

                $_SESSION['perm'] = 0;

                http_response_code(200);
                echo "Успешно";
            } else {
                http_response_code(401);
                echo "Пользователь с такими данными уже существует";
            }
        }
    }

    public function action_logout()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            session_start();
            if (session_destroy())
                http_response_code(200);
            else
                http_response_code(500);
        }
    }
}