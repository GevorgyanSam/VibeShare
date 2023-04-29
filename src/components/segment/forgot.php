<?php

    if(isset($_SESSION["RegistrationData"])) {
        unset($_SESSION["RegistrationData"]);
    }

    if(!isset($_SESSION["Forgot_Edit_State"])) {
        $Edit_State = 1;
    } else {
        $Edit_State = $_SESSION["Forgot_Edit_State"];
    }

?>