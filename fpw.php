<!DOCTYPE html>
<html lang="en">
<?php
include("./connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginquery = "SELECT * FROM users WHERE username='$username' && password='" . md5($password) . "'"; //selecting matching records
    $result = mysqli_query($db, $loginquery); //executing
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
        $_SESSION["user_id"] = $row['u_id'];
        header("refresh:1;url=index.php");
    } else {
        echo "<script>alert('sai Tên tài khoản hoặc Mật khẩu');</script>";
        $message = "Invalid Username or Password!";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt đồ ăn online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header id="header">
        <nav class="navbar navbar-expand-sm">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="./images/logo.png" alt="" style="width:150px;" class="img-rounded">
                </a>
                <div class="menu float-lg-right">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="restaurants.php">Đặt món</a>
                        </li>
                        <?php
                        if (empty($_SESSION["user_id"])) // if user is not login
                        {
                            echo '<li class="nav-item"><a class="nav-link" href="login.php">Đăng nhập</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="registration.php">Đăng ký</a></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="#">Lịch sử</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="account.php">Tài khoản</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="logresbg">
        <div class="padform">
            <form action="seand-password-reset.php" method="post">
                <div class="container bgform">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="email"><b>Email</b></label>
                            <input type="email" placeholder="" name="emaail" id="email" required>
                        </div>

                        <div class="col-sm-12">
                            <label for="psw"><b>Mật khẩu</b></label>
                            <input type="password" placeholder="" name="password" id="psw" required>
                        </div>



                        <div class="col-sm-12">
                            <button name="submit" type="submit" class="registerbtn"><b>Gửi</b></button>
                        </div>
                    </div>
                    <a class="fop" href="fpw.php">Quên mật khẩu?</a>
                </div>

                <div class="container signin">
                    <p>Chưa có tài khoản? <a class="" href="registration.php">Đăng ký.</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>