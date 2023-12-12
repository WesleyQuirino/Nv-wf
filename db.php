<?php
    $db = "teste";
    $host = "localhost";
    $user = "root";
    $pass = "admin";
    
    try{
        
        $conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //echo "Connected successfully";

    } catch(PDOException $e) {

        $erro = "Connection failed: " . $e->getMessage();
        return $erro;

    }