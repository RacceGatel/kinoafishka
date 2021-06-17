<?
include_once _app.'/models/model_film.php';

require_once _app.'/controllers/controller_Auth.php';

class Controller_Main extends Controller {
    function action_index() {
        $data = [];
        $films = (new Model_Film())->get_all();
        $rand = [];

        for($i=0;$i<count($films)-1;$i++) {
            $rand[$i] = $i+1;
        }
        shuffle($rand);

        array_push ($data, $films[$rand[0]]);
        array_push ($data, $films[$rand[1]]);
        array_push ($data, $films[$rand[2]]);
        $this->view->generate('main.php', 'layout.php', $data);
    }
}