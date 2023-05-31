<?php

require "../vendor/autoload.php";
session_start();

use app\Core\Route;

date_default_timezone_set("America/Sao_Paulo");

redirectBack();
print_r($_SESSION[REDIRECT_BACK]);
Route::run();

