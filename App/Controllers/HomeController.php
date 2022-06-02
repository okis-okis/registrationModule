<?php

declare(strict_types = 1);

namespace App\Controllers;

require_once "App\View.php";

use App\View;

class Home
{
    public function index()
    {
        return View::make('index', 
        [
            'helloMessage' => 'Home page!'
        ])->render();
    }

    public function about()
    {
        return View::make('about')->render();
    }

    public function news()
    {
        return View::make('news')->render();
    }
}