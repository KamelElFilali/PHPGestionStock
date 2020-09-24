<?php

$hostName = 'localhost';
$userNameConnexion = 'root';
$port = '3308';
$password = 'abc123...';
$bdName = 'programmation-web-3';

$pdo = null;

try {
    $dsn = "mysql:host=$hostName;port=$port;dbname=$bdName";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ];

    $pdo = new PDO($dsn, $userNameConnexion, $password, $options);
} catch (\Throwable $th) {
    echo "Error: $th";
}
