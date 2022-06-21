<?php

declare(strict_types=1);

namespace employee_assignment\Repository;

use PDO;

abstract class AbstractDbRepository
{
    protected $connection;
    protected $tableName = '';

    public function __construct()
    {
        $config = require './config.php';
        $this->connection = new PDO(
            sprintf('mysql:host=%s:%s;dbname=%s', $config['host'], $config['port'], $config['database']),
            $config['username'],
            $config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
        );
    }

        
    public function getAll(): array
    {
        $statement = $this->connection->prepare('SELECT * FROM ' . $this->tableName . ';');

        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function create(array $record): void
    {

        $columns = array_keys($record);
        $query = 'INSERT INTO ' . $this->tableName . ' (' . implode(', ', $columns) . ') VALUES ';
        
        $params = [];
        foreach ($columns as $param) {
            $params[] = ':' . $param;
        }
        
        $query = $query . '(' . implode(', ', $params) . ');';
        
        $statement = $this->connection->prepare($query);
        $statement->execute($record);
    }

    public function update(array $updatedRecord): void
    {
        $query = 'UPDATE ' . $this->tableName . ' SET ';

        $updates = [];
        foreach (array_keys($updatedRecord) as $columnName) {
            if ($columnName === 'id' || $columnName === 'created_at') {
                continue;
            }
            $columnUpdate = $columnName . ' = :' . $columnName;
            $updates[] = $columnUpdate;
        }

        $query = $query . implode(', ', $updates) . ' WHERE id = :id;';

        unset($updatedRecord['created_at']);

        $statement = $this->connection->prepare($query);
        $statement->execute($updatedRecord);
    }

    public function delete(string $id): void
    {
        $statement = $this->connection->prepare('DELETE FROM ' . $this->tableName . ' WHERE id = :id;');
        $statement->execute(['id' => $id]);
    }
}