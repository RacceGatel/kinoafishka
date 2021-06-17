<?php
require_once _app.'models/model_film.php';
require_once _app.'models/model_cinemas.php';
require_once _app.'models/model_film_cinemas.php';
require_once _app.'models/model_genrefilms.php';
require_once _app.'models/model_genres.php';
require_once _app.'models/model_place.php';
require_once _app.'models/model_halls.php';
require_once _app.'models/model_seance.php';
require_once _app.'models/model_orders.php';
require_once _app.'/controllers/controller_Auth.php';
require_once _app.'models/model_comments.php';

class Controller_Film extends Controller {
    function __construct() {
        parent::__construct();
        $this->model = new Model_Film();

    }

    function action_index() {
        $model = (new Model_Film());
        $data = $model->get_by_id($_GET['id']);



        $genres = [];
        $comments = (new model_comments())->get_all_by_idfilm($_GET['id']);

        $iduser = (new model_users())->get_id_by_name($_SESSION['user'])->id;
        $exist_comment = (new model_comments())->get_exist_by_iduser_idfilm($iduser,$_GET['id']);


        foreach((new model_genrefilms())->get_genre_by_idfilm($_GET['id']) as $id) {
            array_push($genres, (new model_genres)->get_by_id($id[0]));
        }

        $i=0;
        foreach($comments as $com) {
            $comments[$i]['user'] = (new model_users())->get_row_by_id($com['iduser'])->name;
            $i++;
        }
        $data['genre'] = $genres;
        $data['comments'] = $comments;
        $data['exist_comment'] = $exist_comment;

        if(empty($data['name']))
            Route::ErrorPage404();
        else
            $this->view->generate('film.php', 'layout.php', $data);
    }

    function action_add() {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm)
            $this->view->generate('add_film.php', 'layout.php');
        else
            Route::ErrorPage404();
    }

    function action_add_comment() {
        $auth = Controller_Auth::check_login();
        if (!$auth) {
            $iduser = (new model_users())->get_id_by_name($_SESSION['user'])->id;
            $exist = (new model_comments())->get_exist_by_iduser_idfilm($iduser,$_GET['idfilm']);
            if(!$exist) {
                (new model_comments())->insert(array($_GET['idfilm'], $iduser, date("Y-m-d"), $_GET['comment'], $_GET['rate']));

                $rate = (new Model_Film())->get_by_id($_GET['idfilm'])['rate'];
                (new Model_Film())->update_rate_by_id(array(($_GET['rate']+($rate*49))/50, $_GET['idfilm']));
            }
        }
    }


    public function action_get_film() {
        $data = (new Model_Film())->get_by_id($_GET['id']);
        http_response_code(200);
        echo json_encode($data);
    }

    public function action_get_film_seance_info() {
        $data = (new model_film_cinemas())->get_film_about_seances($_GET['idfilm']);
        http_response_code(200);
        echo json_encode($data);
    }

    public function action_get_cinemas() {
        $data = (new model_cinemas())->get_row_by_id($_GET['idfilm']);
        http_response_code(200);
        echo json_encode($data);
    }

    public function action_get_places() {

        $data = (new model_film_cinemas())->get_seance_places($_GET['idhall'],$_GET['idseance']);

        http_response_code(200);
        echo json_encode($data);
    }

    public function action_reserve_place() {
        $auth = Controller_Auth::check_login();

        if (!$auth)
        {
            $id = $_SESSION['id'];
            foreach($_GET['idplace'] as $idplace) {
                //echo json_encode(array($id,$_GET['idseance'],$_GET['idhall'],$idplace));
                (new model_orders())->insert([$id, $_GET['idseance'], $_GET['idhall'], $idplace]);
                (new model_place())->update_by_id_free([0,$idplace]);
            }
            http_response_code(200);
        } else
            http_response_code(400);

    }
}