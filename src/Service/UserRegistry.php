<?php

declare(strict_types=1);

namespace employee_assignment\Service;
use employee_assignment\Repository\EmployeeRepository;

class UserRegistry
{
    public function getCurrentlyLoggedInUser()
    {
        if (isset($_SESSION['authenticated_user_id'])) {
            $repository = new EmployeeRepository();
    
            return $repository->getOneById($_SESSION['authenticated_user_id']);
        }

        return null;
    }
}