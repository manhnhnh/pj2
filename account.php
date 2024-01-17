<!DOCTYPE html>
<html lang="en">
<?php
include("./connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
    $username = ($_POST['username']);
    $fname = ($_POST['firstname']);
    $lname = ($_POST['lastname']);
    $email = ($_POST['email']);
    $phone = ($_POST['phone']);
    $address = ($_POST['address']);

    $mql = "update users set username='$username', f_name='$fname', l_name='$lname',email='$email',phone='$phone',
            address='$address' where u_id='" . $_SESSION['user_id'] . "' ";
    mysqli_query($db, $mql);
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
                            echo '<li class="nav-item"><a class="nav-link" href="your_orders.php">Lịch sử</a></li>';
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
            <?php $ssql = "SELECT * FROM users where u_id='" . $_SESSION['user_id'] . "' ";
            $res = mysqli_query($db, $ssql);
            $newrow = mysqli_fetch_array($res); ?>
            <form action="" method="post">
                <div class="container bgform">
                    <div class="text-center">
                        <label for="">
                            <h5><b>Thông tin cá nhân</b></h5>
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="username"><b>Tên tài khoản</b></label>
                            <input type="text" name="username" id="username" value="<?php echo $newrow['username']; ?>" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="fname"><b>Họ</b></label>
                            <input type="text" name="firstname" id="fname" value="<?php echo $newrow['f_name']; ?>" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="lname"><b>Tên</b></label>
                            <input type="text" name="lastname" id="lname" value="<?php echo $newrow['l_name']; ?>" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="email"><b>Email</b></label>
                            <input type="text" name="email" id="email" value="<?php echo $newrow['email']; ?>" required>
                        </div>

                        <div class="col-sm-6">
                            <label for="phone"><b>Số điện thoại</b></label>
                            <input type="text" name="phone" id="phone" value="<?php echo $newrow['phone']; ?>" required>
                        </div>

                        <div class="col-sm-12">
                            <label for="address"><b>Địa chỉ nhận hàng</b></label>
                            <input type="text" name="address" id="address" value="<?php echo $newrow['address']; ?>" required>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" name="submit" class="registerbtn"><b>Lưu thay đổi</b></button>
                        </div>

                        <div class="col-sm-12">
                            <a href="logout.php" class="logoutbtn">
                                <b>Đăng xuất</b>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="container signin">
                    <p><a href="login.php">Đổi mật khẩu?</a></p>
                </div>
            </form>
        </div>
    </div>

    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>