<?php

namespace App\Helper\Factory;

use App\Helper\Storage\StorageInterface;
use App\Registry\Config;

abstract class BaseFactory
{
    /**
     * @var array
     */
    protected $config;

    public function __construct()
    {
        $this->config = Config::get(Config::DB);
    }

    /**
     * @return StorageInterface
     */
    abstract public function createConnection(): StorageInterface;

}