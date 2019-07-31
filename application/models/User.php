<?php


namespace Models;


class User extends BaseEntity
{
private $name ;
private $surname;
private $email;
private $token;

    /**
     * User constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $email
     * @param $token
     */
    public function __construct($id,$name, $surname, $email,$token)
    {
        $this->setId($id);
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

}