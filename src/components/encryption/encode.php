<?php

    class Encode {

        private $Key = (17 + 15 * 14) * 3;

        // ---- -------- -- --- ---- ----------
        // This Function Is For Data Encryption
        // ---- -------- -- --- ---- ----------

        public function encrypt($Data) {

            $Encrypted_Data = "";

            for($i = 0; $i < strlen($Data); $i++) {

                $Encrypted_Data .= ord($Data[$i]) + $this->Key . "03 ";

            }

            return $Encrypted_Data;

        }

        // ---- -------- -- --- ---- ----------
        // This Function Is For Data Decryption
        // ---- -------- -- --- ---- ----------

        public function decrypt($Data) {

            $Decrypted_Data = "";
            $Count = substr_count($Data, " ");

            for($i = 0; $i < $Count; $i++) {

                $Current_Position = strpos($Data, " ");
                $Current_Symbol = substr($Data, 0, $Current_Position + 1);
                $Remove_Symbol = $Current_Symbol;
                $Current_Symbol = substr($Current_Symbol, 0, 3) - $this->Key;
                $Current_Symbol = chr($Current_Symbol);
                $Decrypted_Data .= $Current_Symbol;
                $Data = substr($Data, 6);

            }

            return $Decrypted_Data;

        }

    }

    $Encode = new Encode();

?>