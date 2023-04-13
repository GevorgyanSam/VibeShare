<?php

    session_start();

    $Server_Host = "localhost";
    $Server_User = "root";
    $Server_Password = "";
    $Server_DataBase = "VibeShare";

    $conn = mysqli_connect($Server_Host, $Server_User, $Server_Password, $Server_DataBase);

    if(!$conn) {
        echo("Connection Failed To " . mysqli_connect_error());
        die();
    }

?>