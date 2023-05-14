<?php require("./components/error/error.php"); ?>
<?php require("./components/connection/connection.php"); ?>
<?php require("./components/encryption/encode.php"); ?>
<?php require("./components/segment/home.php") ?>

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
    <link rel="stylesheet" href="./css/home.css">
    <title>VibeShare | Home</title>
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
                        <a href="./home.php">VibeShare</a>
                    </div>
                </div>
                <div class="userParent">
                    <a href="./home.php">
                        <div>
                            <h3>User</h3>
                        </div>
                        <div>
                            <img src="./assets/defaultuser.jpg">
                        </div>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <script src="./lib/jquery-3.6.4.min.js"></script>
    <script src="./js/home.js"></script>
</body>
</html>