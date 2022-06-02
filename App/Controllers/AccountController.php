<?php

declare(strict_types = 1);

namespace App\Controllers;

require_once('App\\Libs\\User.php');
require_once "App\View.php";

use App\View;

use App\Libs\User;
use Exception;

class Account
{
    public function login()
    {
        return View::make('account\login')->render();
    }

    public function signup()
    {

        if( isset($_POST['userName'])   && 
            isset($_POST['password'])   && 
            isset($_POST['rPassword'])  && 
            isset($_POST['email']))
        {
            try{
                if(is_null($_POST['userName']) || strlen($_POST['userName']) < 4){
                    $_POST['createProcess'] = 'User name should content minimum 4 chars!';
                    throw new Exception();
                }

                if(is_null($_POST['password']) || strlen($_POST['password']) < 8){
                    $_POST['createProcess'] = 'Password length should be minimum 8 chars!';
                    throw new Exception();
                }

                if(is_null($_POST['email']) || substr($_POST['email'], strlen($_POST['email']) - 4) != '.com'){
                    $_POST['createProcess'] = 'Enter, please, email!';
                    throw new Exception();
                }

                if($_POST['password'] == $_POST['rPassword']){
                    try{
                        (new User())->create($_POST['userName'], $_POST['password'], $_POST['email']);
                        
                        $_POST['createProcess'] = 'Account was created';
                        unset($_POST['userName']);
                        unset($_POST['password']); 
                        unset($_POST['rPassword']);
                        unset($_POST['email']);

                    }catch(Exception $e){
                        $_POST['createProcess'] = $e->getMessage();
                    }
                }
                else{
                    $_POST['createProcess'] = `Password and repeat password don't equal`;
                    throw new Exception(); 
                }
            }catch(Exception){
                $_POST['createProcess'] = 'Error!';
            }
        }
        
        return View::make('account\signup')->render();
    }
}