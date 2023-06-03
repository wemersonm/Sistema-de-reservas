<?php

require "../vendor/autoload.php";
session_start();

use app\Core\Route;
use app\Support\Payment;
use Dotenv\Dotenv;


date_default_timezone_set("America/Sao_Paulo");
redirectBack();

$path = dirname(__FILE__,2);
$dotEnv = Dotenv::createImmutable($path);
$dotEnv->load(); 

// $p = new Payment;
// $payment = $p->findPayment('1315488273');
// // print_r($payment->id);
// die;

Route::run();

