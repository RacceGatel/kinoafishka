<?php
require_once dirname(__FILE__).'/init.php';
require_once _config.'Env.php';
require_once _app.'core/model.php';
require_once _app.'core/controller.php';
require_once _app.'core/route.php';

(new Env(_root.'/.env'))->Write();

Route::index();