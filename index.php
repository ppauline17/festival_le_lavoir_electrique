<?php

use Dotenv\Dotenv;

session_start();

require_once __DIR__ . '/vendor/autoload.php';

// accéder au fichier .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if(isset($_GET["controller"]) && isset($_GET["action"])){
    $controller=$_GET["controller"];
    $action=$_GET["action"];
}elseif(isset($_POST["controller"]) && isset($_POST["action"])){
    $controller=$_POST["controller"];
    $action=$_POST["action"];
}else{
    $controller="pages";
    $action="index";
}

require_once('routes.php');