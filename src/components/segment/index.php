<?php

    if(isset($_SESSION["RegistrationData"])) {
        unset($_SESSION["RegistrationData"]);
    }
    
    if(isset($_SESSION["UserData"])) {
        header("Location: ./home.php");
    }

?>