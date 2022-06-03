<?php

declare(strict_types = 1);

namespace App\Libs;

use App\Errors\RegistrationException;
use App\Errors\LoginException;
use Exception;

require_once 'App\\Errors\\RegistreationException.php';
require_once 'App\\Errors\\LoginException.php';
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

    public function check(string $name, string $password)
    {
        $request = 'SELECT COUNT(idUser) AS count FROM users 
                    WHERE login = "' . $name . '" AND password = "' . $password . '"';

        $stmt = $this->db->prepare($request);
        try{
            
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC)[0];

        }catch(Exception){
            throw new LoginException();

        }
        return null;
    }
}