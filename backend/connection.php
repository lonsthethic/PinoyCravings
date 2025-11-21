<?php

$dsn = "mysql:host=localhost;dbname=pinoycravings";
$dbUsername = "root";
$dbPassword = "@admin1230997";

try {
    $pdo = new PDO($dsn, $dbUsername, $dbPassword);
    $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}