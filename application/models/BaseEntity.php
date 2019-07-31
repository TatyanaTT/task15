<?php
namespace Models;
error_reporting(E_ALL);
ini_set('display_errors','On');
abstract class BaseEntity
{
    private $id;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

}