<?php
require '../vendor/autoload.php';
$config = include '../config.php';

use Aura\SqlQuery\QueryFactory;
use Components\Router;


Router::config($config['router']);
Router::page($_SERVER['REQUEST_URI']);