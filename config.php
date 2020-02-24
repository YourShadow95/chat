<?php
$dsn = "mysql:host=localhost;dbname=chat;charset=utf8";
try {
    $dbConn = new PDO($dsn, 'root', '');
} catch (PDOException $e)
{
    echo $e->getMessage();
}
