<?php

/*
Author  :   Okis
Project :   Simple registration module
Date    :   02.06.2022
*/

declare(strict_types = 1);

//Libraries and other files
require_once "App\Router.php";
require_once "App\App.php";
require_once "App\Controllers\HomeController.php";
require_once "App\Controllers\AccountController.php";
require_once "App\Errors\RouteNotFoundException.php";
require_once "App\Libs\DB.php";
require_once "App\Libs\Model.php";

use App\Router;
use App\App;
use App\Controllers\Home;
use App\Controllers\Account;

session_start();

//Code
try{
    $router = new Router();

    $router ->register('/',             [Home::class, 'index'])
            ->register('/about',        [Home::class, 'about'])
            ->register('/news',         [Home::class, 'news'])
            ->register('/login',        [Account::class, 'login'])
            ->register('/signup',       [Account::class, 'signup'])
            ->register('/info/secret',  [Account::class, 'secret'])
            ->register('/exit',         [Account::class, 'exit']);

    (new App($router))->run();

}catch(Exception $e){
    echo "<br>Error! " . $e->getMessage();
}