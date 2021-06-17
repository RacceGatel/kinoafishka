<?php
require_once _app.'/controllers/controller_Auth.php';
require_once _app.'models/model_genrefilms.php';
require_once _app.'models/model_genres.php';
require_once _app.'/models/model_film.php';

class controller_Search extends Controller
{
    function __construct() {
        parent::__construct();
        $this->model = new Model_Film();
    }

    function action_index() {
        $data = (new Model_Film())->get_by_name($_GET['name']);
        $this->view->generate('search.php', 'layout.php', $data);
    }

    function action_genre() {
        $id = (new model_genres())->get_by_name($_GET['name'])->id;

        $data = [];

        foreach((new model_genrefilms())->get_film_by_idgenre($id) as $row) {
            array_push($data, (new Model_Film())->get_by_id($row['idfilm']));

        }

        $this->view->generate('search.php', 'layout.php', $data);
    }
}