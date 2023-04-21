<?php

    // ----- ---- ----- --- ---- -- --
    // Check What State The Page Is In
    // ----- ---- ----- --- ---- -- --

    if(!isset($_SESSION["Registration_Edit_State"])) {
        $Edit_State = 1;
    } else {
        $Edit_State = $_SESSION["Registration_Edit_State"];
    }

    class User {

        public $Array, $Name, $LastName, $Email, $Login, $Password, $CPassword, $Code;
        public $NameError, $LastNameError, $EmailError, $LoginError, $PasswordError, $CPasswordError;

        function __construct($Array) {

            $this->Array = $Array;

        }

        // ---- -- - -------- ---- --------- ---- ----
        // This Is A Function That Validates User Data
        // ---- -- - -------- ---- --------- ---- ----

        public function ValidateUser() {

            if(isset($this->Array["register"])) {

                if(empty(trim($this->Array["name"]))) {
                    $this->NameError = "Please Enter Your Name";
                } else {
                    $this->Name = $this->ValidateData($this->Array["name"]);
                }

                if(empty(trim($this->Array["lastname"]))) {
                    $this->LastNameError = "Please Enter Your Last Name";
                } else {
                    $this->LastName = $this->ValidateData($this->Array["lastname"]);
                }

                if(empty(trim($this->Array["email"]))) {
                    $this->EmailError = "Please Enter Email Address";
                } else {
                    if(!filter_var($this->Array["email"], FILTER_VALIDATE_EMAIL)) {
                        $this->EmailError = "Enter A Valid Email Address";
                    } else {
                        $this->Email = $this->ValidateData($this->Array["email"]);
                    }
                }

                if(empty(trim($this->Array["login"]))) {
                    $this->LoginError = "Please Enter Login";
                } else {
                    if(strlen($this->Array["login"]) < 3) {
                        $this->LoginError = "Minimum Number Of Symbols 2";
                    } else {
                        $this->Login = $this->ValidateData($this->Array["login"]);
                    }
                }

                if(empty(trim($this->Array["password"]))) {
                    $this->PasswordError = "Please Enter Password";
                } else {
                    if(strlen($this->Array["password"]) < 6) {
                        $this->PasswordError = "Minimum Number Of Symbols 6";
                    } else {
                        $this->Password = $this->ValidateData($this->Array["password"]);
                    }
                }

                if(empty(trim($this->Array["cpassword"]))) {
                    $this->CPasswordError = "Confirm The Password";
                } else {
                    if($this->Password !== $this->Array["cpassword"]) {
                        $this->CPasswordError = "Password Not Matched";
                    } else {
                        $this->CPassword = $this->ValidateData($this->Array["cpassword"]);
                    }
                }

                if(!empty($this->Name) && !empty($this->LastName) && !empty($this->Email) && !empty($this->Login) && !empty($this->Password) && !empty($this->CPassword)) {

                    $_SESSION["Registration_Edit_State"] = 2;
                    $_SESSION["Email_Address"] = $this->Email;
                    $CurrentPage = $_SERVER["PHP_SELF"];
                    header("Location: $CurrentPage");

                }

            }

        }

        private function ValidateData($Data) {
            $Data = trim($Data);
            $Data = htmlspecialchars($Data);
            $Data = stripslashes($Data);
            return $Data;
        }

    }

    $User = new User($_POST);
    $User->ValidateUser();

?>