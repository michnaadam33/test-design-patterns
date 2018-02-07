<?php

namespace App\Helper\Factory;


use App\Helper\Storage\MysqlStorage;
use App\Helper\Storage\StorageInterface;

class MysqlFactory extends BaseFactory
{
    /**
     * @inheritdoc
     */
    public function createConnection(): StorageInterface
    {
        $dsn = "mysql:host={$this->config['host']};dbname={$this->config['database']}";
        $pdo = new \PDO($dsn, $this->config['user'], $this->config['password']);
        return new MysqlStorage($pdo);
    }

}