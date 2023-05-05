<?php

    // ----- ---- ----- --- ---- -- --
    // Check What State The Page Is In
    // ----- ---- ----- --- ---- -- --

    if(!isset($_SESSION["RegistrationData"])) {
        $Edit_State = 1;
    } else {
        $Edit_State = $_SESSION["RegistrationData"]["EditState"];
    }

    class User {

        public $Array, $Name, $LastName, $Email, $Login, $Password, $CPassword, $Code;
        public $NameError, $LastNameError, $EmailError, $LoginError, $PasswordError, $CPasswordError, $CodeError;

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

                    $RegistrationData = [
                        "EditState" => 2,
                        "Name" => $this->Name,
                        "LastName" => $this->LastName,
                        "Email" => $this->Email,
                        "Login" => $this->Login,
                        "Password" => $this->Password
                    ];
                    $_SESSION["RegistrationData"] = $RegistrationData;
                    $CurrentPage = $_SERVER["PHP_SELF"];
                    $this->SendVerificationCode();
                    header("Location: $CurrentPage");

                }

            }

            if(isset($this->Array["verify"])) {

                if(empty(trim($this->Array["code"]))) {
                    $this->CodeError = "Enter The Code We Sent You By Email";
                } else {
                    $this->Code = $this->ValidateData($this->Array["code"]);
                }

                if(!empty($this->Code)) {
                    if($_SESSION["RegistrationData"]["Code"] === $this->Code) {
                        unset($_SESSION["RegistrationData"]);
                        header("Location: ./index.php");
                    } else {
                        $this->CodeError = "Verification Failed. Incorrect Code";
                    }
                }

            }

            if(isset($this->Array["resend"])) {

                $this->SendVerificationCode();

            }

        }

        // ---- -- - -------- ---- ------ --- -------- -- ---- ----
        // This Is A Function That Checks The Security Of User Data
        // ---- -- - -------- ---- ------ --- -------- -- ---- ----

        private function ValidateData($Data) {
            $Data = trim($Data);
            $Data = htmlspecialchars($Data);
            $Data = stripslashes($Data);
            return $Data;
        }

        // ---- -- - -------- ---- ----- --- ------------ ---- -- --- ----
        // This Is A Function That Sends The Verification Code To The User
        // ---- -- - -------- ---- ----- --- ------------ ---- -- --- ----

        private function SendVerificationCode() {

            $Code = "";
            for($i = 1; $i <= 8; $i++) {
                $Code .= rand(1, 9);
            }
            $_SESSION["RegistrationData"]["Code"] = $Code;

            $Email = $_SESSION["RegistrationData"]["Email"];
            $Name = $_SESSION["RegistrationData"]["Name"];
            $Name = ucfirst($Name);
            $LastName = $_SESSION["RegistrationData"]["LastName"];
            $LastName = ucfirst($LastName);
            $Subject = "VibeShare - Email Verification";
            $Headers = [
                "MIME-Version" => "1.0",
                "Content-Type" => "text/html;charset=UTF-8",
                "From" => "VibeShare@gmail.com",
                "Reply-To" => "VibeShare@gmail.com"
            ];
            $Message = "Dear $Name $LastName, \r\n<br><br><br>";
            $Message .= "Your New VibeShare Account Has Been Created. Welcome To The VibeShare. \r\n<br><br>";
            $Message .= "Please Enter The Verification Code To Complete Your Registration. \r\n<br><br>";
            $Message .= "Verification Code: $Code \r\n<br><br>";
            $result = mail($Email, $Subject, $Message, $Headers);

        }

    }

    $User = new User($_POST);
    $User->ValidateUser();

?>