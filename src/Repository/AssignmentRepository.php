<?php

declare(strict_types=1);

namespace AdsWebsite\Repository;

use PDO;

class AssignmentRepository extends AbstractDbRepository
{
    protected $tableName = 'assignment';

    public function findAllByAssignmentId(int $assignmentId): array
    {
        $query = 'SELECT * FROM ' . $this->tableName . ' WHERE assignment_id = :assignment_id;';
        $statement = $this->connection->prepare($query);
        $statement->bindParam('assignment_id', $assignmentId);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}