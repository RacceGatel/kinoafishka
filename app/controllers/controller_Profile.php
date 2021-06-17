<?php
require_once _app . '/models/model_film_cinemas.php';
require_once _app . '/models/model_orders.php';
require_once _app . '/models/model_place.php';
require_once _app . '/models/model_users.php';
require_once _app . '/controllers/controller_Auth.php';

class controller_Profile extends Controller
{
    public static function action_orders()
    {
        echo json_encode((new model_film_cinemas())->get_orders_by_id($_GET['idclient']));
        http_response_code(200);
    }

    public static function action_get_user_info()
    {
        if (!Controller_Auth::check_login()) {
            $data = (new model_users())->get_row_by_id($_SESSION['id']);
            $data->perm = Controller_Auth::check_perm() == 1 ? 'Пользователь' : 'Администратор';
            echo json_encode($data);
        }
    }

    public function action_delete_order()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $auth = Controller_Auth::check_login();
            if (!$auth) {
                if (count((new model_orders())->exist_id_by_idclient($_GET['idorder'], $_SESSION['id'])) > 0) {
                    (new model_orders())->delete_by_id($_GET['idorder']);
                    (new model_place())->update_by_id_free([1, $_GET['idplace']]);
                }
            }
        }
    }

    public function action_change_login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = Controller_Auth::check_login();
            if (!$auth) {
                if (isset($_POST['ch_login']) && strlen($_POST['ch_login']) >= 3)
                    if ((new model_users())->get_id_by_name($_POST['ch_login'])) {
                        echo "Такой логин уже существует";
                    } else {
                        (new model_users())->update_name($_SESSION['id'], $_POST['ch_login']);
                        $_SESSION['user'] = $_POST['ch_login'];
                        echo "Успешно";
                    }
            }
        }
    }

    public function action_change_email()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = Controller_Auth::check_login();
            if (!$auth) {
                if (isset($_POST['ch_email']) && strlen($_POST['ch_email']) >= 5)
                    if ((new model_users())->get_id_by_email($_POST['ch_email'])) {
                        echo "Такая почта уже используется";
                    } else {
                        (new model_users())->update_email($_SESSION['id'], $_POST['ch_email']);
                        echo "Успешно";
                    }
            }
        }
    }

    public function action_change_phone()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = Controller_Auth::check_login();
            if (!$auth) {
                if (isset($_POST['ch_phone']) && strlen($_POST['ch_phone']) >= 10)
                    if ((new model_users())->get_id_by_phone($_POST['ch_phone'])) {
                        echo "Такай номер уже используется";
                    } else {
                        (new model_users())->update_phone($_SESSION['id'], $_POST['ch_phone']);
                        echo "Успешно";
                    }
            }
        }
    }

    public function action_change_psw()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $auth = Controller_Auth::check_login();
            if (!$auth) {
                if (isset($_SERVER['PHP_AUTH_PW']) && strlen($_SERVER['PHP_AUTH_PW']) >= 6) {
                    (new model_users())->update_psw($_SESSION['id'], md5($_SERVER['PHP_AUTH_PW']));
                    echo "Успешно";
                } else
                    echo "Неправильный формат";
            }
        }
    }
}