<?php


namespace App\Helper\Storage;

use PDO;

class MysqlStorage implements StorageInterface
{
    /**
     * @var PDO
     */
    private $conn;

    /**
     * MysqlStorage constructor.
     * @param PDO $conn
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * Insert method
     * @param array $params
     * @return int
     */
    public function persist(array $params): int
    {
        //todo Implement
    }


    /**
     * Select method
     * TODO Use param validation
     * @param string $tableName
     * @param array|null $where
     * @param array|null $order
     * @param int|null $limit
     * @return array
     */
    public function retrieve(
        string $tableName,
        array $where = null,
        array $order = null,
        int $limit = null
    ): array
    {
        $sql = "SELECT * FROM " . $tableName . " ";
        if(!empty($where)){
            $sql .= ' WHERE ';
            foreach ($where as $column => $value){
                $sql .= ' '.$column . ' = '.$value.' ';
            }
        }
        if(!empty($order)){
            $sql .= ' ORDER BY ';
            foreach ($order as $column => $value){
                $sql .= ' '.$column . ' '.$value.' ';
            }
        }
        if(!empty($limit)){
            $sql .= ' LIMIT '.$limit;
        }
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        //todo Implement
    }
}