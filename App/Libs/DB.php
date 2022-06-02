<?php

declare(strict_types = 1);

namespace App\Libs;

class DB
{
    private \PDO $db;

    public function __construct(array $param)
    {
        try{
            $this->db = new \PDO('mysql:host='. $param['host'] . 
                                ';dbname='. $param['dbname'] . ';'
                                , $param['user']);
        }catch(\PDOException $e){
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function getPDO(): \PDO
    {
        return $this->db;
    }
}