<?php

declare(strict_types = 1);

namespace App;

require_once 'App\\Errors\\ViewNotFoundException.php';

use App\Errors\ViewNotFoundException;

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
        $viewPath = 'App\\Views\\' . $this->view . '.php';

        if(!file_exists($viewPath)){
            throw new ViewNotFoundException();
        }

        return include $viewPath;
    }
}