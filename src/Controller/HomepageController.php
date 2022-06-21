<?php

declare(strict_types=1);

namespace employee_assignment\Controller;

class HomepageController
{
    public function show(): void
    {
        require './view/page.php';
    }
}