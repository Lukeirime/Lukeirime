<?php

declare(strict_types=1);

namespace employee_assignment\Controller;

use employee_assignment\Repository\AssignmentRepository;

class AssignmentController
{
    public function showCreateAssignmentForm(): void
    {
        $pageTitle = 'New Assignment';

        require './view/page.php';
    }

    public function handleCreateAssignmentSubmission(): void
    {
        $repository = new AssignmentRepository();
        $newAssignment = [
            'employee_id' => $_SESSION['authenticated_employee_id'],
            'title' => $_POST['title'],
            'created_at' => $_POST['created_at'],
        ];
        $repository->create($newAssignment);

    }

    public function handleDeleteArchive(string $id): void
    {
        $repository = new AssignmentRepository();
        $repository->delete($id);

    }

}