<?php

require "../vendor/autoload.php";
session_start();

use app\Core\Request;
use app\Core\Route;
use app\Support\DocumentValidator;
use Dotenv\Dotenv;


date_default_timezone_set("America/Sao_Paulo");
redirectBack();

$path = dirname(__FILE__, 2);
$dotEnv = Dotenv::createImmutable($path);
$dotEnv->load();

Route::run();
