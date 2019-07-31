<?php


namespace Controllers;
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
            throw new Exception("Can\'t connect");
        }
        mysqli_select_db($link, $this->databaseName) or die ('Can\'t find');
        return $link;

    }

}