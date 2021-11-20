<?php

namespace App\BlogEngine\Query;

/**
 * Class PostQuery
 *
 * @package App\BlogEngine\Query
 */
class PostQuery
{
    /**
     * @var string
     */
    private $id;


    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}