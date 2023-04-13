<?php require("./components/error/error.php"); ?>
<?php require("./components/connection/connection.php"); ?>
<?php require("./components/encryption/encode.php"); ?>
<?php require("./components/segment/index.php") ?>

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
    <link rel="stylesheet" href="./css/style.css">
    <title>VibeShare | Login</title>
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


                            <!-- ----- ---- ----- ----- -->
                            <!-- ----- Main Login ----- -->
                            <!-- ----- ---- ----- ----- -->


    <main>
        <div class="mainParent">
            <div class="imgParent"></div>
            <div class="formParent">
                <div>
                    <h2>Login</h2>
                    <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" autocomplete="off" method="POST">
                        <div class="loginParent">
                            <i class="fa-solid fa-user inputIcon"></i>
                            <input type="text" id="login" placeholder="Login">
                        </div>
                        <div class="errorParent">
                            <label for="login" class="error"></label>
                        </div>
                        <div class="passwordParent">
                            <i class="fa-solid fa-lock inputIcon"></i>
                            <input type="password" id="password" placeholder="Password">
                            <i class="fa-solid fa-eye-slash passwordView"></i>
                        </div>
                        <div class="errorParent">
                            <label for="password" class="error"></label>
                        </div>
                        <div class="rememberParent">
                            <div class="rememberMe">
                                <input type="checkbox" id="checkbox">
                                <label for="checkbox">Remember Me</label>
                            </div>
                            <div class="forgotParent">
                                <button type="submit">Forgot Your Password ?</button>
                            </div>
                        </div>
                        <div class="submitParent">
                            <button type="submit">Login</button>
                        </div>
                        <div class="registrationParent">
                            <a href="./registration.php">don't have an account ? <span>register</span></a>
                        </div>
                        <div class="mobileForgotParent">
                            <button type="submit">Forgot Your Password ?</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="./lib/jquery-3.6.4.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>