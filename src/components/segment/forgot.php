<?php

    if(isset($_SESSION["Registration_Edit_State"])) {
        unset($_SESSION["Registration_Edit_State"]);
        unset($_SESSION["Email_Address"]);
    }

    if(!isset($_SESSION["Forgot_Edit_State"])) {
        $Edit_State = 1;
    } else {
        $Edit_State = $_SESSION["Forgot_Edit_State"];
    }

?>