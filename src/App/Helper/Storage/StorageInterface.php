<?php

namespace App\Helper\Storage;


interface StorageInterface
{
    public function persist(array $params): int;

    public function retrieve(
        string $tableName,
        array $where = null,
        array $order = null,
        int $limit = null
    ): array;

    public function delete(int $id);

}