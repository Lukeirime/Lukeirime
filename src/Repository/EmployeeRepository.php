<?php

declare(strict_types=1);

namespace employee_assignment\Repository;

class EmployeeRepository extends AbstractDbRepository
{
    protected $tableName = 'employee';
}