<?php


namespace Controllers;

require "/var/www/html/sandbox/git/Homework/task17/config/config.php";

class MysqlConfig extends DatabaseConfig
{

    /**
     * MysqlConfig constructor.
     */
    public function __construct()
    {
        $this->host = host;
        $this->databaseName = databaseName;
        $this->password = password;
        $this->user = user;
    }
}