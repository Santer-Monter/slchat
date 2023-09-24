<?php
$dbConfig = [
    "host" => "localhost",
    'user' => "test",
    "password" => "admin",
    "name" => "slchat"
];

$db = new PDO("mysql:host=" . $dbConfig["host"] . ";dbname=" . $dbConfig['name'], $dbConfig["user"], $dbConfig["password"]);

include_once "helper.php";