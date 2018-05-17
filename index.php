<?php
//First, let's load the magic autoloader.
require_once 'app\script\autoloader.php';
//Initialize our application;
app\base\App::initializePath(__DIR__);
$app = new app\base\Application();
//We cant wait to display  your page, let's do it!
$app->start();
