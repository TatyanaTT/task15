<?php


namespace Controllers;
use Core\MysqlConfig;


class UserManager extends EntityManager implements ManagerInterface
{
    /**
     * UserManager constructor.
     */
    public function __construct(){
        $this->myDB = new MysqlConfig();
    }

     public function actionIndex()
     {
         // find information about users
         // TODO: Implement actionIndex() method.
         $rows = array();
         if ($this->checkToken() and $_SERVER['REQUEST_METHOD'] == 'GET') {
             $query = "SELECT * FROM users WHERE users.token =" . $_SERVER['HTTP_TOKEN'];
             $selectByToken = mysqli_query($this->myDB->connect(), $query);
             $rows = mysqli_fetch_array($selectByToken, MYSQLI_ASSOC);
         }
         return $rows;
     }

}