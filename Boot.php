<?php
require_once __DIR__.'/vendor/autoload.php';

$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory(__DIR__ . '/src');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Load capsule into the application
include __DIR__ . "/src/Config/Connection.php";

//error_reporting(E_ALL & ~E_NOTICE & ~E_USER_NOTICE);


