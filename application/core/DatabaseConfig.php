<?php


namespace Core;
use Exception;

class DatabaseConfig
{
    public $host;
    public $user;
    public $password;
    public $databaseName;


    function connect()
    {
        $link = mysqli_connect($this->host, $this->user, $this->password);
        if (!$link){
            header("HTTP/1.1 404 Not Found");
            throw new Exception("Can\'t connect");
        }
        else
        {
            if (!mysqli_select_db($link, $this->databaseName)){
                header("HTTP/1.1 404 Not Found");
                throw new Exception("Can\'t connect to DBName");
            }
            else
            {
                header("HTTP/1.1 200 OK");
            }
        }
        return $link;

    }

}