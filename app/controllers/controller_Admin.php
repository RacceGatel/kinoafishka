<?php
require_once _app.'models/model_film.php';
require_once _app.'models/model_cinemas.php';
require_once _app.'models/model_film_cinemas.php';
require_once _app.'models/model_genrefilms.php';
require_once _app.'models/model_halls.php';
require_once _app.'models/model_cinemas_halls.php';
require_once _app.'models/model_genres.php';
require_once _app.'models/model_place.php';
require_once _app.'models/model_orders.php';
require_once _app.'models/model_seance.php';
require_once _app.'models/model_employed_place.php';
require_once _app.'/controllers/controller_Auth.php';

class controller_Admin extends Controller
{
    public function action_index()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm) {


            $data['cinemas'] = (new model_cinemas)->get_all();
            $data['halls'] = (new model_halls)->get_all();
            $data['films'] = (new Model_Film())->get_all();
            $data['cinemas_halls'] = (new model_cinemas_halls())->get_all();
            $data['seance'] = (new model_seance())->get_all();
            $data['users'] = (new model_users())->get_all();
            $data['orders'] = (new model_orders())->get_all();
            $data['films'] = (new Model_Film())->get_all();

            $this->view->generate('admin.php', 'layout.php', $data);
        }
        else
            Route::ErrorPage404();
    }

    public function action_add_cinema()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm)
        {
            (new model_cinemas())->insert($_GET['name']);
        }
    }

    public function action_create_hall()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm)
        {
            (new model_halls())->insert([$_GET['num'],$_GET['size'],$_GET['rows'],$_GET['spots']]);
            $this->action_add_places();
        }
    }


    public function action_add_hall()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm)
        {
            $idhall = (new model_halls())->get_row_by_id($_GET['idhall'])->id;
            (new model_cinemas_halls())->insert(array($_GET['idcinema'],$idhall));
        }
    }

    public function action_add_seance()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm)
        {
            $idfilm = $_GET['idfilm'];
            $idhall = $_GET['idhall'];
            $idcinema = $_GET['idcinema'];
            $date = $_GET['date'];
            $time = $_GET['time'];

            (new model_seance())->insert(array($idfilm,$idhall,$idcinema,$date,$time));
        }
    }

    public function action_add_places($gets)
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm) {
            $cinema = $_GET['idcinema'];
            $hall = $_GET['idhall'];

            $firstid = ($cinema*pow(10,strlen($hall)) + $hall) *1000;
            $curid = $firstid;
            $count = 0;
            $cur_hall = (new model_halls())->get_row_by_id($hall);
            $maxcount = $cur_hall->size;

            for($i=0; $i<$cur_hall->rows; $i++) {
                for ($j = 0; $j < $cur_hall->spots; $j++) {
                    $curid++;
                    $count++;
                    if ($count > $maxcount)
                        exit;
                    (new model_place)->insert(array($curid, $i + 1, $j + 1));
                    (new model_employed_place())->insert(array($hall, $curid));
                }
            }
        }
    }


    public function action_delete_cinema()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm) {
            if($_SERVER['REQUEST_METHOD']=='DELETE')
            {
                ((new model_cinemas()))->delete_by_id($_GET['id']);
            }
        }
    }

    public function action_delete_hall()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm) {
            if($_SERVER['REQUEST_METHOD']=='DELETE')
            {
                $places = ((new model_employed_place())->get_by_idhall($_GET['id']));
                if(count($places)>0) {
                    (new model_employed_place())->delete_by_idhalls($_GET['id']);
                    foreach ($places as $place) {
                        (new model_place())->delete_by_id($place['idplace']);
                    }
                }
                ((new model_halls()))->delete_by_id($_GET['id']);
            }
        }
    }

    public function action_delete_cinemas_halls()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm) {
            if($_SERVER['REQUEST_METHOD']=='DELETE')
            {
                ((new model_cinemas_halls()))->delete_by_id([$_GET['idcinema'], $_GET['idhall']]);
            }
        }
    }

    public function action_delete_seance()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm) {
            if($_SERVER['REQUEST_METHOD']=='DELETE')
            {
                ((new model_seance()))->delete_by_id($_GET['id']);
            }
        }
    }

    public function action_delete_user()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm) {
            if($_SERVER['REQUEST_METHOD']=='DELETE')
            {
                ((new model_user()))->delete_by_id($_GET['id']);
            }
        }
    }

    public function action_delete_order()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm) {
            if($_SERVER['REQUEST_METHOD']=='DELETE')
            {
                ((new model_orders()))->delete_by_id($_GET['id']);
            }
        }
    }

    public function action_delete_film()
    {
        $auth = Controller_Auth::check_login();
        $perm = Controller_Auth::check_perm();
        if (!$auth && !$perm) {
            if($_SERVER['REQUEST_METHOD']=='DELETE')
            {
                ((new Model_Film()))->delete_by_id($_GET['id']);
            }
        }
    }
}