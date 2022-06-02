<?php

declare(strict_types = 1);

namespace App\Libs;

use App\Errors\RegistrationException;
use Exception;

require_once 'App\\Errors\\RegistreationException.php';
require_once 'App\\Libs\\Model.php';

class User extends Model
{
    public function create(string $login, string $password, string $email)
    {
        $request = 'INSERT INTO users (login, password, email) 
                    VALUES("'.$login.'", "'.$password.'", "'.$email.'")';

        $stmt = $this->db->prepare($request);
        try{
            
            $stmt->execute();

        }catch(Exception){
            throw new RegistrationException();

        }
        return (int)$this->db->lastInsertId();
    }

    public function getInfo()
    {

    }

    public function delete()
    {

    }

    public function getId()
    {

    }
}