<?php

declare(strict_types = 1);

namespace App\Controllers;

require_once 'App\\Libs\\User.php';
require_once "App\View.php";
require_once "App\\Errors\\LoginException.php";
require_once 'App\\Libs\\User.php';
require_once 'App\\Libs\\Page.php';

use App\View;
use App\Libs\User;
use Exception;
use App\Errors\LoginException;
use App\Libs\Page;

class Account
{
    public function login()
    {

        if( isset($_SESSION["authorized"]) &&
            $_SESSION["authorized"] == 1){
                Page::redirect('info/secret');
            }

        if( isset($_POST['loginName']) &&
            isset($_POST['loginPassword']))
        {
            try{
                if( is_null($_POST['loginName']) ||
                    is_null($_POST['loginPassword']))
                {
                    $_POST['loginProcess'] = 'Enter, please, paramers';
                    throw new LoginException();
                }

                //Check account
                $result = (new User())->check($_POST['loginName'], $_POST['loginPassword']);
                if($result['count'] == null)
                {
                    $_POST['loginProcess'] = 'Wrong login or password';
                    throw new LoginException();
                }

                if($result['count'] > 0){
                    $_SESSION["authorized"] = 1;
                    unset($_POST['loginName']);
                    unset($_POST['loginPassword']);
                    Page::redirect('info/secret');
                }
                else{
                    $_POST['loginProcess'] = 'Wrong login or password';
                    throw new LoginException();
                }
            }catch(Exception)
            {

            }
        }

        return View::make('account\login')->render();
    }

    public function signup()
    {
        if( isset($_SESSION["authorized"]) &&
            $_SESSION["authorized"] == 1){
                Page::redirect('info/secret');
            }

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
                        unset($_POST['userName']);
                        unset($_POST['password']); 
                        unset($_POST['rPassword']);
                        unset($_POST['email']);

                        $_SESSION["authorized"] = 1;
                        Page::redirect('info/secret');
                    }catch(Exception $e){
                        $_POST['createProcess'] = $e->getMessage();
                    }
                }
                else{
                    $_POST['createProcess'] = `Password and repeat password don't equal`;
                    throw new Exception(); 
                }
            }catch(Exception){
                $_POST['createProcess'] = 'Error! ' . $_POST['createProcess'];
            }
        }
        
        return View::make('account\signup')->render();
    }

    public static function isAuthorized(): bool
    {
        if( isset($_SESSION["authorized"]) &&
                $_SESSION["authorized"] == 1){
                return true;
        }
        return false;
    }

    public function exit()
    {
        unset($_SESSION["authorized"]);
        Page::redirect('/');
    }

    public function secret()
    {
        if( isset($_SESSION["authorized"]) &&
            $_SESSION["authorized"] == 1){
                return View::make('secret')->render();
            }

        Page::redirect('/');
    }
}