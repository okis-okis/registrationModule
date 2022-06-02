<?php

/*
Special class for execute pre process do
*/

declare(strict_types = 1);

namespace App;

class App
{
    private static \PDO $db;
    private Router $router;

    public function __construct($router)
    {
        try{
            static::$db = (new Libs\DB([
                'host'      =>  'localhost',
                'dbname'    =>  'test',
                'user'      =>  'root'
            ]))->getPDO();

            $this->router = $router;
        }catch(\PDOException $e)
        {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }
    
    public function run()
    {
        $this->router->resolve($_SERVER['REQUEST_URI']);
    }

    public static function getPDO():\PDO
    {
        return static::$db;
    }
}