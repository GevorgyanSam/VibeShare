<?php

    if(isset($_SESSION["RegistrationData"])) {
        unset($_SESSION["RegistrationData"]);
    }

    if(isset($_SESSION["UserData"])) {
        header("Location: ./home.php");
    }

    if(!isset($_SESSION["ForgotData"])) {
        $Edit_State = 1;
    } else {
        $Edit_State = $_SESSION["ForgotData"]["EditState"];
    }

    class FindUser {

        public $Array, $SearchUser, $UserImage, $UserBackgroundImage, $Code, $NPassword, $CPassword;
        public $SearchUserError, $CodeError, $NPasswordError, $CPasswordError;

        public function __construct($Array) {
            
            $this->Array = $Array;

        }

        // ---- -------- -- --- ------- ----
        // This Function Is For Finding User
        // ---- -------- -- --- ------- ----

        public function GetUser($db, $Encode) {

            // ------ ----- ----- ----- ---- ----- --
            // Forgot Page: First Step. Edit State 1.
            // ------ ----- ----- ----- ---- ----- --

            if(isset($this->Array["submitSearchUser"])) {

                if(empty($this->Array["searchUser"])) {
                    $this->SearchUserError = "Enter Login Or Email";
                } else {
                    $this->SearchUser = strtolower($this->ValidateData($this->Array["searchUser"]));
                    $search = $db->prepare("SELECT * FROM `users` WHERE `login` IN (:login) OR `email` IN (:login) AND `status` IN (:status)");
                    $search->execute([
                        "status" => "{$Encode->encrypt('active')}",
                        "login" => "{$Encode->encrypt($this->SearchUser)}",
                    ]);
                    if($search->rowCount()) {
                        $UserInfo = $search->fetch();
                        $getProfile = $db->query("SELECT `profile_image`, `profile_background_image` FROM `user_info` WHERE `user_id` IN ('{$UserInfo["id"]}')");
                        if($getProfile->rowCount()) {
                            $getProfileData = $getProfile->fetch();
                            $this->UserImage = $Encode->decrypt($getProfileData["profile_image"]);
                            $this->UserBackgroundImage = $Encode->decrypt($getProfileData["profile_background_image"]);
                        } else {
                            $this->UserImage = "default";
                            $this->UserBackgroundImage = "default";
                        }
                        $ForgotData = [
                            "Id" => "{$UserInfo["id"]}",
                            "Name" => "{$Encode->decrypt($UserInfo["name"])}",
                            "LastName" => "{$Encode->decrypt($UserInfo["last_name"])}",
                            "Email" => "{$Encode->decrypt($UserInfo["email"])}",
                            "Login" => "{$Encode->decrypt($UserInfo["login"])}",
                            "UserImage" => "{$this->UserImage}",
                            "UserBackgroundImage" => "{$this->UserBackgroundImage}",
                            "EditState" => 2,
                        ];
                        $_SESSION["ForgotData"] = $ForgotData;
                        header("Location: {$_SERVER["PHP_SELF"]}");
                    } else {
                        $this->SearchUserError = "Undefined Account";
                    }
                }

            }

            // ------ ----- ------ ----- ---- ----- --
            // Forgot Page: Second Step. Edit State 2.
            // ------ ----- ------ ----- ---- ----- --

            if(isset($this->Array["cancelFoundUser"])) {

                unset($_SESSION["ForgotData"]);
                header("Location: {$_SERVER["PHP_SELF"]}");

            }

            if(isset($this->Array["continueFoundUser"])) {

                $_SESSION["ForgotData"]["EditState"] = 3;
                $this->SendVerificationCode();
                header("Location: {$_SERVER["PHP_SELF"]}");

            }

            // ------ ----- ----- ----- ---- ----- --
            // Forgot Page: Third Step. Edit State 3.
            // ------ ----- ----- ----- ---- ----- --

            if(isset($this->Array["submit"])) {

                if(empty(trim($this->Array["code"]))) {
                    $this->CodeError = "Enter The Code We Sent You By Email";
                } else {
                    $this->Code = $this->ValidateData($this->Array["code"]);
                }

                if(!empty($this->Code)) {
                    if($_SESSION["ForgotData"]["Code"] === $this->Code) {
                        unset($_SESSION["ForgotData"]["Code"]);
                        $_SESSION["ForgotData"]["EditState"] = 4;
                        header("Location: {$_SERVER["PHP_SELF"]}");
                    } else {
                        $this->CodeError = "Verification Failed. Incorrect Code";
                    }
                }

            }

            if(isset($this->Array["resend"])) {

                $this->SendVerificationCode();
                header("Location: {$_SERVER["PHP_SELF"]}");

            }

            // ------ ----- ------ ----- ---- ----- --
            // Forgot Page: Fourth Step. Edit State 4.
            // ------ ----- ------ ----- ---- ----- --

            if(isset($this->Array["change"])) {

                if(empty(trim($this->Array["npassword"]))) {
                    $this->NPasswordError = "Please Enter New Password";
                } else {
                    if(strlen($this->Array["npassword"]) < 6) {
                        $this->NPasswordError = "Minimum Number Of Characters 6";
                    } else {
                        $this->NPassword = $this->ValidateData($this->Array["npassword"]);
                    }
                }

                if(empty(trim($this->Array["cpassword"]))) {
                    $this->CPasswordError = "Please Retype The Password";
                } else {
                    if($this->NPassword === $this->Array["cpassword"]) {
                        $this->CPassword = $this->ValidateData($this->Array["cpassword"]);
                    } else {
                        $this->CPasswordError = "Password Not Matched";
                    }
                }

                if(!empty($this->NPassword) && !empty($this->CPassword)) {
                    $update = $db->prepare("UPDATE `users` SET `password` = :password WHERE `id` = :id");
                    $update->execute([
                        "password" => "{$Encode->encrypt(md5($this->NPassword))}",
                        "id" => "{$_SESSION["ForgotData"]["Id"]}",
                    ]);
                    if($update) {
                        $Email = $_SESSION["ForgotData"]["Email"];
                        $Name = $_SESSION["ForgotData"]["Name"];
                        $LastName = $_SESSION["ForgotData"]["LastName"];
                        $Name = ucfirst($Name);
                        $LastName = ucfirst($LastName);
                        $Subject = "VibeShare - Password Confirmation";
                        $Headers = [
                            "MIME-Version" => "1.0",
                            "Content-Type" => "text/html;charset=UTF-8",
                            "From" => "VibeShare@gmail.com",
                            "Reply-To" => "VibeShare@gmail.com"
                        ];
                        $Message = "Dear $Name $LastName, \r\n<br><br><br>";
                        $Message .= "This Email Is To Confirm That The Password For Your Account Has Been Successfully Updated. Your New Password Is Now In Effect And You Can Log In To Your Account Using This New Password. \r\n<br><br>";
                        $Message .= "If You Did Not Make This Change Or Suspect That Someone Else Has Gained Unauthorized Access To Your Account, Please Contact Us Immediately And We Will Assist You In Securing Your Account. \r\n<br><br>";
                        $Message .= "Thank You For Choosing Our Services. \r\n<br><br>";
                        $Message .= "Best regards, \r\n<br><br>";
                        $Message .= "VibeShare \r\n<br><br>";
                        $result = mail($Email, $Subject, $Message, $Headers);
                        unset($_SESSION["ForgotData"]);
                        header("Location: ./index.php");
                    }
                }

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

        // ---- -------- ----- ----- ---- -----
        // This Function Hides Email From Users
        // ---- -------- ----- ----- ---- -----

        public function HideEmail($Email) {
            $EmailName = substr($Email, 0, strpos($Email, "@"));
            $EmailFormat = substr($Email, strpos($Email, "@"));
            $Symbol = "";
            for($i = 0; $i < strlen($EmailName) - 2; $i++) {
                $Symbol .= "*";
            }
            $Email = substr_replace($EmailName, $Symbol, 1, strlen($EmailName) - 2);
            $Email .= $EmailFormat;
            return $Email;
        }

        // ---- -- - -------- ---- ----- --- ------------ ---- -- --- ----
        // This Is A Function That Sends The Verification Code To The User
        // ---- -- - -------- ---- ----- --- ------------ ---- -- --- ----

        private function SendVerificationCode() {

            $Code = "";
            for($i = 1; $i <= 8; $i++) {
                $Code .= rand(1, 9);
            }
            $_SESSION["ForgotData"]["Code"] = $Code;

            $Email = $_SESSION["ForgotData"]["Email"];
            $Name = $_SESSION["ForgotData"]["Name"];
            $Name = ucfirst($Name);
            $LastName = $_SESSION["ForgotData"]["LastName"];
            $LastName = ucfirst($LastName);
            $Subject = "VibeShare - Reset Password";
            $Headers = [
                "MIME-Version" => "1.0",
                "Content-Type" => "text/html;charset=UTF-8",
                "From" => "VibeShare@gmail.com",
                "Reply-To" => "VibeShare@gmail.com"
            ];
            $Message = "Dear $Name $LastName, \r\n<br><br><br>";
            $Message .= "If You've Lost Your Password Or Wish To Reset It, \r\n<br><br>";
            $Message .= "Enter The Code Below To Reset Your Password \r\n<br><br>";
            $Message .= "Verification Code: $Code \r\n<br><br>";
            $Message .= "If You Did Not Request A Password Reset, You Can Safely Ignore This Email. \r\n<br><br>";
            $Message .= "Only A Person With Access To Your Email Can Reset Your Account Password. \r\n<br><br>";
            $Message .= "Thank You For Choosing Our Services. \r\n<br><br>";
            $Message .= "Best regards, \r\n<br><br>";
            $Message .= "VibeShare \r\n<br><br>";
            $result = mail($Email, $Subject, $Message, $Headers);

        }

    }

    $FindUser = new FindUser($_POST);
    $FindUser->GetUser($db, $Encode);

?>