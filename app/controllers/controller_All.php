<?php
require_once _app.'models/model_film.php';
require_once _app.'/controllers/controller_Auth.php';

class Controller_All extends Controller {

    function __construct() {
        parent::__construct();
        $this->model = new Model_Film();
    }

    function action_index() {
        $data = (new Model_Film())->get_all();
        $this->view->generate('allfilms.php', 'layout.php', $data);
    }

    function action_add_film() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $perm = Controller_Auth::check_perm();


            if ($perm) {
                http_response_code(401);
                exit;
            } else {
                $film = (new Model_Film());
                $film->insert(array($_POST['name'], $_POST['describe'], $_POST['lnk_trailer'], $_POST['age']));
            }
        }
    }
}