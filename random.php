<?php declare(strict_types=1);

try {
    $conn = new PDO("mysql:host=localhost:8000;dbname=open_training;charset=utf8", 'root', 'root');
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo $e;
//    echo "Connection failed: " . $e->getMessage();
}
