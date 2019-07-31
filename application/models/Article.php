<?php

namespace Models;

class Article extends BaseEntity
{
    private $title;
    private $text;
    private $blogger;


    /**
     * Article constructor.
     * @param $id
     * @param $title
     * @param $text
     * @param $blogger
     *
     */
    public function __construct($id,$title, $text, User $blogger)
    {
        $this->setId($id);
        $this->title = $title;
        $this->text = $text;
        $this->blogger = $blogger;

    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getBlogger()
    {
        return $this->blogger->getId();
    }

}
