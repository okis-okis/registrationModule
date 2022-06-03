<?php

declare(strict_types = 1);

namespace App\Errors;

class LoginException extends \Exception
{
    protected $message = "Can't enter to account!";
}