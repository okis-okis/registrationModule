<?php

declare(strict_types = 1);

namespace App\Errors;

class RegistrationException extends \Exception
{
    protected $message = "Can't create account!";
}