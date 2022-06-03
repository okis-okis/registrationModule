<?php

declare(strict_types = 1);

namespace App;

require_once 'App\\Errors\\ViewNotFoundException.php';
require_once 'App\\Controllers\\AccountController.php';

use App\Errors\ViewNotFoundException;
use App\Controllers\Account;

class View
{
    public function __construct(private string $view, private array $params = [])
    {

    }

    public static function make(string $view, array $params = []): self
    {
        return new static($view, $params);
    }

    public function render()
    {
        $header = 'App\\Views\\elements\\header.php';

        if(!file_exists($header)){
            throw new ViewNotFoundException();
        }

        $_POST['isAuthorized'] = Account::isAuthorized();

        include $header;

        $viewPath = 'App\\Views\\' . $this->view . '.php';

        if(!file_exists($viewPath)){
            throw new ViewNotFoundException();
        }

        return include $viewPath;
    }
}