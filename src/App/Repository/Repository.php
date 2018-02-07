<?php

namespace App\Repository;


use App\Helper\Storage\StorageInterface;

abstract class Repository
{
    /**
     * @var StorageInterface
     */
    protected $persistence;

    /**
     * @var string
     */
    protected $tableName;

    /**
     * Repository constructor.
     * @param StorageInterface $persistence
     */
    public function __construct(StorageInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * @return string
     */
    public function getTableName() : string {
        return $this->tableName;
    }

}