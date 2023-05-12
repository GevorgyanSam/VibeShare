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

        public $Array, $SearchUser, $UserImage, $UserBackgroundImage;
        public $SearchUserError;

        public function __construct($Array) {
            
            $this->Array = $Array;

        }

        // ---- -------- -- --- ------- ----
        // This Function Is For Finding User
        // ---- -------- -- --- ------- ----

        public function GetUser($db, $Encode) {

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
                            "Password" => "{$Encode->decrypt($UserInfo["password"])}",
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

            if(isset($this->Array["cancelFoundUser"])) {

                unset($_SESSION["ForgotData"]);
                header("Location: {$_SERVER["PHP_SELF"]}");

            }

            if(isset($this->Array["continueFoundUser"])) {

                $_SESSION["ForgotData"]["EditState"] = 3;
                header("Location: {$_SERVER["PHP_SELF"]}");

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

    }

    $FindUser = new FindUser($_POST);
    $FindUser->GetUser($db, $Encode);

?>