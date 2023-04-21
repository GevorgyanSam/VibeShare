<?php

    if(isset($_SESSION["Registration_Edit_State"])) {
        unset($_SESSION["Registration_Edit_State"]);
        unset($_SESSION["Email_Address"]);
    }

?>