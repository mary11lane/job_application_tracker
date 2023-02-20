<?php

error_reporting(0);

include_once('config.php');

function connection()
{
    $host = HOST;
    $username = USERNAME;
    $password = PASSWORD;
    $database = DATABASE;

    $dsn = "mysql:host=$host;dbname=$database";

    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
    return $pdo;
}
