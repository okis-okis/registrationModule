<?php

declare(strict_types = 1);

namespace App\Libs;

class Page
{
    public static function redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);

        exit();
    }
}