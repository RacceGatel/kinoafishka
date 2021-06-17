<?php
define('_app', dirname(__FILE__,2).'/app/');
define('_views', dirname(__FILE__,2).'/resources/views/');
define('_css', $_SERVER['HTTPS'].'/resources/css/');
define('_images', $_SERVER['HTTPS'].'/resources/images/');
define('_root', dirname(__FILE__,2).'/');
define('_config', dirname(__FILE__,2).'/config/');
define('_js', $_SERVER['HTTPS'].'/resources/js/');

require_once _config.'Env.php';
require_once _app.'core/model.php';
require_once _app.'core/controller.php';
require_once _app.'core/route.php';

(new Env(_root.'/.env'))->Write();