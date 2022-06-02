<?php

declare(strict_types = 1);

namespace App\Libs;

require_once 'App\\App.php';

use App\App;

abstract class Model
{
    protected \PDO $db;

    public function __construct()
    {
        $this->db = App::getPDO();
    }
}