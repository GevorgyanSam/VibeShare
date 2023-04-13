<?php

    // ---- -------- -- --- ---- ----------
    // This Function Is For Data Encryption
    // ---- -------- -- --- ---- ----------

    $GLOBALS["Key"] = (16 + 14 * 15 / 2) * 10;

    function encrypt($Data) {

        $Encrypted_Data = "";

        for($i = 0; $i < strlen(utf8_decode($Data)); $i++) {

            $Encrypted_Data .= ord($Data[$i]) + $GLOBALS["Key"] . " ";

        }

        return $Encrypted_Data;

    }

    // ---- -------- -- --- ---- ----------
    // This Function Is For Data Decryption
    // ---- -------- -- --- ---- ----------

    function decrypt($Data) {

        $Decrypted_Data = "";

        return $Decrypted_Data;

    }

?>