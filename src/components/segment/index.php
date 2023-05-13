<?php

    if(isset($_SESSION["RegistrationData"])) {
        unset($_SESSION["RegistrationData"]);
    }

    if(isset($_SESSION["ForgotData"])) {
        unset($_SESSION["ForgotData"]);
    }

    if(isset($_SESSION["UserData"])) {
        header("Location: ./home.php");
    }

    class User {

        public $Login, $Password, $Remember, $Array, $UserImage, $UserBackgroundImage;
        public $LoginError, $PasswordError;

        public function __construct($Array) {

            $this->Array = $Array;

        }

        // ---- -- - -------- ---- --------- ---- ----
        // This Is A Function That Validates User Data
        // ---- -- - -------- ---- --------- ---- ----

        public function ValidateUser($db, $Encode) {

            if(isset($this->Array["submit"])) {

                if(empty(trim($this->Array["login"]))) {
                    $this->LoginError = "Please Enter Login";
                } else {
                    if(strlen($this->Array["login"]) < 3) {
                        $this->LoginError = "Minimum Number Of Symbols 3";
                    } else {
                        $check = $db->prepare("SELECT * FROM `users` WHERE `login` IN (:login) OR `email` IN (:login)");
                        $check->execute([
                            "login" => $Encode->encrypt(strtolower($this->ValidateData($this->Array["login"]))),
                        ]);
                        if(!$check->rowCount()) {
                            $this->LoginError = "Undefined Account";
                        } else {
                            $this->Login = $this->ValidateData($this->Array["login"]);
                        }
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

                if(isset($this->Array["remember"])) {
                    $this->Remember = 1;
                } else {
                    $this->Remember = 0;
                }

                if(!empty($this->Login) && !empty($this->Password)) {

                    $check = $db->prepare("SELECT * FROM `users` WHERE `login` IN (:login) OR `email` IN (:login) AND `status` IN (:status)");
                    $check->execute([
                        "login" => $Encode->encrypt(strtolower($this->Login)),
                        "status" => "{$Encode->encrypt("active")}",
                    ]);
                    $read = $check->fetch();
                    $UserId = $read["id"];
                    $UserName = $read["name"];
                    $UserLastName = $read["last_name"];
                    $UserEmail = $read["email"];
                    $UserLogin = $read["login"];
                    if($Encode->decrypt($read["password"]) === md5($this->Password)) {
                        $update_registration_table = $db->prepare("UPDATE `registration_info` SET `status` = :status WHERE `user_id` = :id");
                        $update_registration_table->execute([
                            "status" => "{$Encode->encrypt("inactive")}",
                            "id" => "{$UserId}",
                        ]);
                        $update_login_table = $db->prepare("UPDATE `login_info` SET `status` = :status WHERE `user_id` = :id");
                        $update_login_table->execute([
                            "status" => "{$Encode->encrypt("inactive")}",
                            "id" => "{$UserId}",
                        ]);
                        $insert = $db->prepare("INSERT INTO `login_info` (`id`, `user_id`, `remote_addr`, `user_agent`, `date`, `remember`, `status`) VALUES (NULL, :user_id, :remote_addr, :user_agent, NULL, :remember, :status)");
                        $UserIp = $_SERVER["REMOTE_ADDR"];
                        $UserAgent = $_SERVER["HTTP_USER_AGENT"];
                        if($this->Remember) {
                            $insert->execute([
                                "user_id" => "{$UserId}",
                                "remote_addr" => "{$Encode->encrypt($UserIp)}",
                                "user_agent" => "{$Encode->encrypt($UserAgent)}",
                                "status" => "{$Encode->encrypt("active")}",
                                "remember" => "{$Encode->encrypt("true")}",
                            ]);
                        } else {
                            $insert->execute([
                                "user_id" => "{$UserId}",
                                "remote_addr" => "{$Encode->encrypt($UserIp)}",
                                "user_agent" => "{$Encode->encrypt($UserAgent)}",
                                "status" => "{$Encode->encrypt("active")}",
                                "remember" => "{$Encode->encrypt("false")}",
                            ]);
                        }
                        if($insert) {
                            $UserData = [
                                "Id" => "$UserId",
                                "Name" => $Encode->decrypt($UserName),
                                "LastName" => $Encode->decrypt($UserLastName),
                                "Email" => $Encode->decrypt($UserEmail),
                                "Login" => $Encode->decrypt($UserLogin),
                                "Sourse" => $_SERVER["PHP_SELF"]
                            ];
                            $_SESSION["UserData"] = $UserData;
                            header("Location: ./home.php");
                        }
                    } else {
                        $this->PasswordError = "Wrong Password";
                    }

                }

            }

            if(isset($this->Array["forgot"])) {
                
                if(empty(trim($this->Array["login"]))) {
                    header("Location: ./forgot.php");
                } else {
                    $searchUser = strtolower($this->ValidateData($this->Array["login"]));
                    $search = $db->prepare("SELECT * FROM `users` WHERE `login` IN (:login) OR `email` IN (:login) AND `status` IN (:status)");
                    $search->execute([
                        "status" => "{$Encode->encrypt('active')}",
                        "login" => "{$Encode->encrypt($searchUser)}",
                    ]);
                    if($search->rowCount()) {
                        $row = $search->fetch();
                        $getProfile = $db->query("SELECT `profile_image`, `profile_background_image` FROM `user_info` WHERE `user_id` IN ('{$row["id"]}')");
                        if($getProfile->rowCount()) {
                            $getProfileData = $getProfile->fetch();
                            $this->UserImage = $Encode->decrypt($getProfileData["profile_image"]);
                            $this->UserBackgroundImage = $Encode->decrypt($getProfileData["profile_background_image"]);
                        } else {
                            $this->UserImage = "default";
                            $this->UserBackgroundImage = "default";
                        }
                        $ForgotData = [
                            "Id" => "{$row["id"]}",
                            "Name" => "{$Encode->decrypt($row["name"])}",
                            "LastName" => "{$Encode->decrypt($row["last_name"])}",
                            "Email" => "{$Encode->decrypt($row["email"])}",
                            "Login" => "{$Encode->decrypt($row["login"])}",
                            "UserImage" => "{$this->UserImage}",
                            "UserBackgroundImage" => "{$this->UserBackgroundImage}",
                            "EditState" => 2,
                        ];
                        $_SESSION["ForgotData"] = $ForgotData;
                        header("Location: ./forgot.php");
                    } else {
                        header("Location: ./forgot.php");
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

        // ---- -------- ------ ---- ---- ---- -------- -- ---
        // This Function Checks That User Need Password Or Not
        // ---- -------- ------ ---- ---- ---- -------- -- ---

        public function UserAuth($db, $Encode) {

            $AuthUserIp = $Encode->encrypt($_SERVER["REMOTE_ADDR"]);
            $AuthUserAgent = $Encode->encrypt($_SERVER["HTTP_USER_AGENT"]);
            $AuthRemember = $Encode->encrypt("true");
            $AuthCheck = $db->prepare("SELECT * FROM `login_info` WHERE `remember` IN (:remember) AND `remote_addr` IN (:user_ip) AND `user_agent` IN (:user_agent)");
            $AuthCheck->execute([
                "remember" => "{$AuthRemember}",
                "user_ip" => "{$AuthUserIp}",
                "user_agent" => "{$AuthUserAgent}"
            ]);
            if($AuthCheck->rowCount()) {
                $AuthRead = $AuthCheck->fetch();
                $AuthUserId = $AuthRead["user_id"];
                $AuthReady = $db->prepare("SELECT * FROM `users` WHERE `status` IN (:status) AND `id` IN (:id)");
                $AuthReady->execute([
                    "status" => "{$Encode->encrypt("active")}",
                    "id" => "{$AuthUserId}",
                ]);
                if($AuthReady->rowCount()) {
                    $AuthReadyRead = $AuthReady->fetch();
                    $AuthUserId = $AuthReadyRead["id"];
                    $AuthUserName = $AuthReadyRead["name"];
                    $AuthUserLastName = $AuthReadyRead["last_name"];
                    $AuthUserEmail = $AuthReadyRead["email"];
                    $AuthUserLogin = $AuthReadyRead["login"];
                    $UserData = [
                        "Id" => "$AuthUserId",
                        "Name" => $Encode->decrypt($AuthUserName),
                        "LastName" => $Encode->decrypt($AuthUserLastName),
                        "Email" => $Encode->decrypt($AuthUserEmail),
                        "Login" => $Encode->decrypt($AuthUserLogin),
                        "Sourse" => $_SERVER["PHP_SELF"]
                    ];
                    "UPDATE `login_info` SET `remember` = 'true', `status` = 'inactive' WHERE AND `user_id` = 1";
                    $update_login_table = $db->prepare("UPDATE `login_info` SET `status` = :status, `remember` = :remember WHERE `user_id` = :id");
                    $update_login_table->execute([
                        "status" => "{$Encode->encrypt("inactive")}",
                        "remember" => "{$Encode->encrypt("false")}",
                        "id" => "{$AuthUserId}",
                    ]);
                    $insert_login_table = $db->prepare("INSERT INTO `login_info` (`id`, `user_id`, `remote_addr`, `user_agent`, `date`, `remember`, `status`) VALUES (NULL, :user_id, :remote_addr, :user_agent, NULL, :remember, :status)");
                    $insert_login_table->execute([
                        "user_id" => "{$AuthUserId}",
                        "remote_addr" => "{$AuthUserIp}",
                        "user_agent" => "{$AuthUserAgent}",
                        "status" => "{$Encode->encrypt("active")}",
                        "remember" => "{$Encode->encrypt("true")}",
                    ]);
                    $_SESSION["UserData"] = $UserData;
                    header("Location: ./home.php");
                }
            }

        }

    }

    $User = new User($_POST);
    $User->UserAuth($db, $Encode);
    $User->ValidateUser($db, $Encode);

?>