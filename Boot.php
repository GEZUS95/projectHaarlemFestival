<?php
require_once __DIR__.'/vendor/autoload.php';

$loader = new Nette\Loaders\RobotLoader;
$loader->addDirectory(__DIR__ . '/src');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Load capsule into the application
include __DIR__ . "/src/Config/Connection.php";

//start the php session
$session = new \Matrix\SessionManager();

