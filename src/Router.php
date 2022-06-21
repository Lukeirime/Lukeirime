<?php

declare(strict_types=1);

namespace employee_assignment;

use employee_assignment\DTO\Route;
use employee_assignment\Controller\AssignmentController;
use employee_assignment\Controller\HomepageController;

class Router
{
    public function doRouting(): void
    {
        $route = $this->parseRoute();

        if ($route->getResource() === 'assignment') {
            $this->routeAssignments($route);
        }

        if ($route->getResource() === '') {
            $controller = new HomepageController();
            $controller->show();
            die();
        }

        http_response_code(404);
    }

    private function routeAssignments(Route $route): void
    {
        $controller = new AssignmentController();
        switch ($route->getAction()) {
            case 'list': 
                $controller->listAssignments();
                break;
            case 'create':
                if ($route->getMethod() === 'GET') {
                    $controller->showCreateAssignmentForm();
                } elseif ($route->getMethod() === 'POST') {
                    $controller->handleCreateAssignmentSubmission();
                } else {
                    http_response_code(404);
                }
                
                break;
            case 'delete':
                if ($route->getId() === null) {
                    http_response_code(404);
                    break;
                }
                $controller->handleDeleteArchive($route->getId());
                break;
            default:
                http_response_code(404);
                break;
        }
        die();
    }

    private function parseRoute(): Route
    {
        $route = new Route();
        $route->setMethod($_SERVER['REQUEST_METHOD']);

        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri, '/');

        $parts = explode('/', $uri);
        $route->setResource($parts[0]);

        if (!isset($parts[1])) {
            return $route;
        }

        if (is_numeric($parts[1])) {
            $route->setId($parts[1]);
            $route->setAction($parts[2]);
        } else {
            $route->setId(null);
            $route->setAction($parts[1]);
        }

        return $route;
    }
}