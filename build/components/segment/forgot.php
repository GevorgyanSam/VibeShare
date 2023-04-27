<?php

    if(isset($_SESSION["Registration_Edit_State"])) {
        unset($_SESSION["Registration_Edit_State"]);
        unset($_SESSION["Name"]);
        unset($_SESSION["LastName"]);
        unset($_SESSION["Email"]);
        unset($_SESSION["Login"]);
        unset($_SESSION["Password"]);
    }

    if(!isset($_SESSION["Forgot_Edit_State"])) {
        $Edit_State = 1;
    } else {
        $Edit_State = $_SESSION["Forgot_Edit_State"];
    }

?>