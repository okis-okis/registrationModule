<?php

declare(strict_types = 1);

namespace App\Errors;

class ViewNotFoundException extends \Exception
{
    protected $message = "View not found";
}