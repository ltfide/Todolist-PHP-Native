<?php

require __DIR__ . "/../vendor/autoload.php";

use Todolist\PHP\Native\App\Router;
use Todolist\PHP\Native\Controller\TodolistController;

Router::add("GET", "/", TodolistController::class, "index");
Router::add("POST", "/", TodolistController::class, "postAdd");
Router::add("GET", "/delete/([0-9]*)", TodolistController::class, "destroy");

Router::run();