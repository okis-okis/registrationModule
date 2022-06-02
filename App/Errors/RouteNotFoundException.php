<?php

declare(strict_types = 1);

namespace App\Errors;

class RouteNotFoundException extends \Exception
{
    protected $message = "404 Page don't found";
}