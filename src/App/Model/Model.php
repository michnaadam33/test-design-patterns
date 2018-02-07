<?php

namespace App\Model;


/**
 * Class Model
 * Base model class
 * @package App\Model
 */
abstract class Model
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

}