<?php

declare(strict_types=1);

$config = require './config.php';


$connection = new PDO(
    sprintf('mysql:host=%s:%s', $config['host'], $config['port']));

$connection->exec('DROP DATABASE IF EXISTS ' . $config['database']);

$connection->exec('CREATE DATABASE ' . $config['database']);
$connection->exec('USE ' . $config['database']);

$connection->exec('
CREATE TABLE employee
(
    id int not null PRIMARY KEY AUTO_INCREMENT,
    first_name varchar(100) not null,
    last_name varchar(100) not null,
    )
');

$connection->exec('
CREATE TABLE assignment
(
    id int PRIMARY KEY AUTO_INCREMENT,
    employee_id int NOT NULL, CONSTRAINT FOREIGN KEY (employee_id) REFERENCES employee (id) ON DELETE CASCADE,
    title varchar(255) not null,
    created_at datetime DEFAULT CURRENT_TIMESTAMP()
)
');

echo 'Database recreated successfully!';