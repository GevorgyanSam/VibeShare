<?php require("./components/error/error.php"); ?>
<?php require("./components/connection/connection.php"); ?>
<?php require("./components/encryption/encode.php"); ?>
<?php require("./components/segment/forgot.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Samvel Gevorgyan, gsamvel2005@gmail.com">
    <meta name="description" content="VibeShare - Обмен Впечатлениями">
    <meta name="subject" content="VibeShare">
    <meta name="keywords" content="VibeShare, Blog">
    <link rel="icon" href="">
    <link rel="stylesheet" href="./lib/icons.css">
    <link rel="stylesheet" href="./css/forgot.css">
    <title>VibeShare | Forgot</title>
</head>
<body>


                            <!-- ----- ---------- ----- -->
                            <!-- ----- Navigation ----- -->
                            <!-- ----- ---------- ----- -->


    <header>
        <nav>
            <div class="navParent">
                <div class="logoParent">
                    <div class="logo">
                        <a href="./index.php">VibeShare</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>


                            <!-- ----- ---- ------ ----- -->
                            <!-- ----- Main Forgot ----- -->
                            <!-- ----- ---- ------ ----- -->


    <main>
        <div class="mainParent">
            <div class="imgParent"></div>
            <div class="contentParent">


                            <!-- ----- ----- ---- ----- -->
                            <!-- ----- First Step ----- -->
                            <!-- ----- ----- ---- ----- -->


                <?php if($Edit_State == 1): ?>
                <div class="firstStep">
                    <h2>find your account</h2>
                    <h3>Please enter your login name or email to search for your account.</h3>
                    <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" autocomplete="off" method="POST">
                        <div class="formParent">
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input type="text" placeholder="Login Or Email" name="searchUser" value="<?php echo($FindUser->SearchUser); ?>">
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($FindUser->SearchUserError); ?></label>
                                </div>
                            </div>
                            <div class="formItem submitParent">
                                <button type="submit" name="submitSearchUser">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endif; ?>


                            <!-- ----- ------ ---- ----- -->
                            <!-- ----- Second Step ----- -->
                            <!-- ----- ------ ---- ----- -->


                <?php if($Edit_State == 2): ?>
                <div class="secondStep">
                    <div class="profileParent">
                        <?php
                            if($_SESSION["ForgotData"]["UserBackgroundImage"] == "default") {
                                echo('<div class="userBackgroundParent"></div>');
                            } else {
                                echo('<div class="userBackgroundParent" style="background-image: url(./uploads/' . $_SESSION["ForgotData"]["UserBackgroundImage"] . ');"></div>');
                            }
                        ?>
                        <div class="userLogoParent">
                        <?php
                            if($_SESSION["ForgotData"]["UserImage"] == "default") {
                                echo('<img src="./assets/defaultuser.jpg">');
                            } else {
                                echo('<img src="./uploads/' . $_SESSION["ForgotData"]["UserImage"] . '">');
                            }
                        ?>
                        </div>
                        <div class="userInfoParent">
                            <h2><?php echo($_SESSION["ForgotData"]["Name"] . " " . $_SESSION["ForgotData"]["LastName"]); ?></h2>
                        </div>
                        <div class="questionParent">
                            <h1>it's you ?</h1>
                        </div>
                        <div class="formParent">
                            <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" method="POST">
                                <button type="submit" id="cancel" name="cancelFoundUser">cancel</button>
                                <button type="submit" id="continue" name="continueFoundUser">continue</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>


                            <!-- ----- ----- ---- ----- -->
                            <!-- ----- Third Step ----- -->
                            <!-- ----- ----- ---- ----- -->


                <?php if($Edit_State == 3): ?>
                <div class="thirdStep">
                    <h2>Email Verification</h2>
                    <h3>enter the verification code we send to <br> <span><?php echo($FindUser->HideEmail($_SESSION["ForgotData"]["Email"])); ?></span></h3>
                    <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" autocomplete="off" method="POST">
                        <div class="formParent">
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="number" placeholder="type code here" name="code" value="<?php echo($FindUser->Code); ?>">
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($FindUser->CodeError); ?></label>
                                </div>
                            </div>
                            <div class="formItem submitParent">
                                <button type="submit" name="submit">verify</button>
                                <div class="resendParent">
                                    <div class="await">
                                        Didn't Get The Code ? <span>02:00</span>
                                    </div>
                                    <div class="resend">
                                        <button type="submit" name="resend">
                                            didn't get the code ? <span>resend</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endif; ?>


                            <!-- ----- ----- ---- ----- -->
                            <!-- ----- Fourth Step ----- -->
                            <!-- ----- ----- ---- ----- -->


                <?php if($Edit_State == 4): ?>
                <div class="fourthStep">
                    <h2>Change Password</h2>
                    <h3>set the new password for your account</h3>
                    <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" autocomplete="off" method="POST">
                        <div class="formParent">
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-lock"></i>
                                    <input type="password" id="password" placeholder="New Password" name="npassword" value="<?php echo($FindUser->NPassword); ?>">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($FindUser->NPasswordError); ?></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" id="cpassword" placeholder="Confirm Password" name="cpassword" value="<?php echo($FindUser->CPassword); ?>">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($FindUser->CPasswordError); ?></label>
                                </div>
                            </div>
                            <div class="formItem submitParent">
                                <button type="submit" name="change">change password</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script src="./lib/jquery-3.6.4.min.js"></script>
    <script src="./js/forgot.js"></script>
</body>
</html>