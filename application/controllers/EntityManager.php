<?php

namespace Controllers;
use Exception;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

abstract class EntityManager
{
    protected $myDB;

    public function checkToken()
    {
        if (!empty($_SERVER['HTTP_TOKEN']) and $this->isTokenValid($_SERVER['HTTP_TOKEN'])) {
            return true;
        } else {
            header("HTTP/1.1 401 Unauthorized");
            throw new Exception("Token isn't written");
            return false;
        }
    }

    public function isTokenValid($token)
    {
        if (!empty($this->findUserIdByToken($token))) {
            header("HTTP/1.1 200 OK");
            return true;
        } else {
            header("HTTP/1.1 401 Unauthorized");
            throw new Exception("Wrong token");
            return false;
        }
    }
    public  function findUserIdByToken($token)
    {
        $query = "SELECT id FROM `users` WHERE token = $token";
        $selectByToken = mysqli_query($this->myDB->connect(), $query);
        $rows = mysqli_fetch_array($selectByToken, MYSQLI_ASSOC);
        return $this->toString($rows);
    }
    public function toString($array) {
        if (!empty($array)){
            return implode($array);
        }
    }

}