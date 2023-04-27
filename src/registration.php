<?php require("./components/error/error.php"); ?>
<?php require("./components/connection/connection.php"); ?>
<?php require("./components/encryption/encode.php"); ?>
<?php require("./components/segment/registration.php") ?>

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
    <link rel="stylesheet" href="./css/registration.css">
    <title>VibeShare | Registration</title>
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


                            <!-- ----- ---- ------------ ----- -->
                            <!-- ----- Main Registration ----- -->
                            <!-- ----- ---- ------------ ----- -->


    <main>
        <div class="mainParent">
            <div class="imgParent"></div>
            <div class="contentParent">


                            <!-- ----- ----- ---- ----- -->
                            <!-- ----- First Step ----- -->
                            <!-- ----- ----- ---- ----- -->


                <?php if($Edit_State == 1): ?>
                <div class="firstStep">
                    <h2>Registration</h2>
                    <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" autocomplete="off" method="POST">
                        <div class="formParent">
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" placeholder="Name" name="name" value="<?php echo($User->Name); ?>">
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($User->NameError); ?></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" placeholder="Last Name" name="lastname" value="<?php echo($User->LastName); ?>">
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($User->LastNameError); ?></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="email" placeholder="Email" name="email" value="<?php echo($User->Email); ?>">
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($User->EmailError); ?></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <input type="text" placeholder="Login" name="login" value="<?php echo($User->Login); ?>">
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($User->LoginError); ?></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-lock"></i>
                                    <input type="password" id="password" placeholder="Password" name="password" value="<?php echo($User->Password); ?>">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($User->PasswordError); ?></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" id="cpassword" placeholder="Confirm Password" name="cpassword" value="<?php echo($User->CPassword); ?>">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($User->CPasswordError); ?></label>
                                </div>
                            </div>
                            <div class="formItem submitParent">
                                <button type="submit" name="register">Register</button>
                            </div>
                        </div>
                        <div class="loginParent">
                            <a href="./index.php">already have an account ? <span>login</span></a>
                        </div>
                    </form>
                </div>
                <?php endif; ?>


                            <!-- ----- ------ ---- ----- -->
                            <!-- ----- Second Step ----- -->
                            <!-- ----- ------ ---- ----- -->


                <?php if($Edit_State == 2): ?>
                <div class="secondStep">
                    <h2>Email Verification</h2>
                    <h3>enter the verification code we send to <p><?php echo($_SESSION["Email"]); ?></p></h3>
                    <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" autocomplete="off" method="POST">
                        <div class="formParent">
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="number" placeholder="type code here" name="code" value="<?php echo($User->Code); ?>">
                                </div>
                                <div class="errorParent">
                                    <label class="error"><?php echo($User->CodeError); ?></label>
                                </div>
                            </div>
                            <div class="formItem submitParent">
                                <button type="submit" name="verify">verify</button>
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
            </div>
        </div>
    </main>
    <script src="./lib/jquery-3.6.4.min.js"></script>
    <script src="./js/registration.js"></script>
</body>
</html>