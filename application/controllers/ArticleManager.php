<?php

namespace Controllers;

use Models\BaseEntity;
use Models\User;
use Models\Article;

error_reporting(E_ALL);
ini_set('display_errors', 'On');


/**
 * Class ArticleManager
 * @package Service
 */
class ArticleManager extends EntityManager implements ManagerInterface
{
    /**
     * ArticleManager constructor.
     */
    public function __construct()
    {
        $this->myDB = new MysqlConfig();
    }

    public function actionIndex()
    {
        $rows = array();
        if ($this->checkToken() and $_SERVER['REQUEST_METHOD'] = 'GET') {
            $query = "SELECT blog.title, blog.text FROM `blog` INNER JOIN `users`
                    ON blog.blogger=users.id WHERE users.token =" . $_SERVER['HTTP_TOKEN'];
            $selectByToken = mysqli_query($this->myDB->connect(), $query);
            while ($array = mysqli_fetch_array($selectByToken, MYSQLI_ASSOC)) {
                $rows[] = $array;
            }
        }
        return $rows;
    }

    public function actionCreate()
    {
        if ($this->checkToken() and $_SERVER['REQUEST_METHOD'] = 'POST') {
            $idUser = $this->findUserIdByToken($_SERVER['HTTP_TOKEN']);
            $query = "INSERT INTO `blog` (blog.title, blog.text,blog.blogger) 
                        VALUES ('" . $_POST['title'] . "','" . $_POST['text'] . "','"
                . $idUser . "')";
            mysqli_query($this->myDB->connect(), $query);
        }

    }

    public function actionUpdate()
    {
        if ($this->checkToken() and $_SERVER['REQUEST_METHOD'] = 'PUT') {
            $_PUT = array();
            parse_str(file_get_contents("php://input"), $_PUT);
            if ($this->isIdValidForUpdating($_PUT['id'])) {
                $idUser = $this->findUserIdByToken($_SERVER['HTTP_TOKEN']);
                $query = "UPDATE `blog` SET  
                        title = " . $_PUT['title'] . ",
                        text = " . $_PUT['text'] . ",
                        blogger = $idUser 
                        WHERE blog.id =" . $_PUT['id'];
                mysqli_query($this->myDB->connect(), $query);
            }
        }
    }

    public function actionDelete()
    {
        $_DELETE = array();
        parse_str(file_get_contents("php://input"), $_DELETE);
        if ($this->checkToken() and $_SERVER['REQUEST_METHOD'] = 'DELETE') {
            if ($this->isIdValidForUpdating($_DELETE['id'])) {
                $query = "DELETE FROM blog WHERE id = " . $_DELETE['id'];
                mysqli_query($this->myDB->connect(), $query);
            }
        }
    }


    private function isIdValidForUpdating($id)
    {
        $idUser = $this->findUserIdByToken($_SERVER['HTTP_TOKEN']);
        if ($idUser == ($this->getById($id)->getBlogger())) {
            return true;
        } else {
            return false;
        }

    }


    /**
     * @param int $id
     * @return BaseEntity|null
     * @throws \Exception
     */

    private function getById(int $id): ?BaseEntity
    {
        $query = "SELECT * FROM blog WHERE id = $id";
        $selectById = mysqli_query($this->myDB->connect(), $query);
        $rows = mysqli_fetch_array($selectById, MYSQLI_ASSOC);
        $blogger = new User(null, null, null, null, null);
        if (!empty($rows['blogger'])) {
            $query = "SELECT * FROM users WHERE id =" . $rows['blogger'];
            $selectByIdU = mysqli_query($this->myDB->connect(), $query);
            $rowsUser = mysqli_fetch_array($selectByIdU, MYSQLI_ASSOC);
            $blogger = new User($rows['blogger'], $rowsUser['name'],
                $rowsUser['surname'], $rowsUser['email'], $_SERVER['HTTP_TOKEN']);
        }
        $object = new Article($id, $rows['title'], $rows['text'], $blogger);
        return $object;
    }

}

