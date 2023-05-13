<?php

    if(!isset($_SESSION["UserData"])) {
        header("Location: ./index.php");
    }
    echo("<pre>");
    print_r($_SESSION["UserData"]);
    echo("</pre>");

?>