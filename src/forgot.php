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
                <!-- <div class="firstStep">
                    <h2>find your account</h2>
                    <h3>Please enter your login name or email to search for your account.</h3>
                    <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" autocomplete="off" method="POST">
                        <div class="formParent">
                            <div class="formItem">
                                <div class="dateParent">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input type="text" placeholder="Login Or Email">
                                </div>
                                <div class="errorParent">
                                    <label class="error"></label>
                                </div>
                            </div>
                            <div class="formItem submitParent">
                                <button type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="secondStep">
                    <div class="profileParent">
                        <div class="userBackgroundParent" style="background-image: url(https://imgs.search.brave.com/wv9bhyYa5CjPXwNsGPW3NAGO95tX6iS11Kjb-3sUVk4/rs:fit:1200:1200:1/g:ce/aHR0cHM6Ly93d3cu/Z29vZGZyZWVwaG90/b3MuY29tL2FsYnVt/cy9jcm9hdGlhL3Bs/aXR2aWNlLWxha2Vz/LW5hdGlvbmFsLXBh/cmsvbGFrZS1sYW5k/c2NhcGUtdW5kZXIt/c2tpZXMtcGxpdHZp/Y2UtbGFrZS1uYXRp/b25hbC1wYXJrLWNy/b2F0aWEuanBn);"></div>
                        <div class="userLogoParent">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80">
                        </div>
                        <div class="userInfoParent">
                            <h2>Maria Ashley</h2>
                        </div>
                        <div class="questionParent">
                            <h1>it's you ?</h1>
                        </div>
                        <div class="formParent">
                            <form action="<?php echo(htmlspecialchars($_SERVER["PHP_SELF"])); ?>" method="POST">
                                <button type="submit" id="cancel">cancel</button>
                                <button type="submit" id="continue">continue</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="./lib/jquery-3.6.4.min.js"></script>
    <script src="./js/forgot.js"></script>
</body>
</html>