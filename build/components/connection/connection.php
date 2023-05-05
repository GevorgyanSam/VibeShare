<?php

    session_start();

    $Server_Host = "mysql:host=localhost;dbname=VibeShare;charset=utf8";
    $Server_User = "root";
    $Server_Password = "";
    $Server_Options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
        $db = new PDO($Server_Host, $Server_User, $Server_Password, $Server_Options);
    } catch(PDOException $e) {
        print("Connection Failed: " . $e->getMessage());
        die();
    }

?>