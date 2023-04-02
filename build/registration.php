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
                <!-- <div class="firstStep">
                    <h2>Registration</h2>
                    <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" autocomplete="off" method="POST">
                        <div class="formParent">
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="errorParent">
                                    <label class="error"></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" placeholder="Last Name">
                                </div>
                                <div class="errorParent">
                                    <label class="error"></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="email" placeholder="Email">
                                </div>
                                <div class="errorParent">
                                    <label class="error"></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-user-tie"></i>
                                    <input type="text" placeholder="Login">
                                </div>
                                <div class="errorParent">
                                    <label class="error"></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-lock"></i>
                                    <input type="password" id="password" placeholder="Password">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </div>
                                <div class="errorParent">
                                    <label class="error"></label>
                                </div>
                            </div>
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-key"></i>
                                    <input type="password" id="cpassword" placeholder="Confirm Password">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </div>
                                <div class="errorParent">
                                    <label class="error"></label>
                                </div>
                            </div>
                            <div class="formItem submitParent">
                                <button type="submit">Register</button>
                            </div>
                        </div>
                        <div class="loginParent">
                            <a href="./index.php">already have an account ? <span>login</span></a>
                        </div>
                    </form>
                </div> -->
                <div class="secondStep">
                    <h2>Email Verifictaion</h2>
                    <h3>enter the verification code we send to <br> <span>test@gmail.com</span></h3>
                    <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" autocomplete="off" method="POST">
                        <div class="formParent">
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="number" placeholder="type code here">
                                </div>
                                <div class="errorParent">
                                    <label class="error"></label>
                                </div>
                            </div>
                            <div class="formItem submitParent">
                                <button type="submit">verify</button>
                                <p>didn't get the code ? <span>resend</span></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="./lib/jquery-3.6.4.min.js"></script>
    <script src="./js/registration.js"></script>
</body>
</html>