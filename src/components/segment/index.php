<?php

    if(isset($_SESSION["Registration_Edit_State"])) {
        unset($_SESSION["Registration_Edit_State"]);
        unset($_SESSION["Name"]);
        unset($_SESSION["LastName"]);
        unset($_SESSION["Email"]);
        unset($_SESSION["Login"]);
        unset($_SESSION["Password"]);
    }

?>