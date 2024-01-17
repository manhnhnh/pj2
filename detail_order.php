<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();
if (empty($_SESSION['user_id'])) {
    header('location:login.php');
} else {
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
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="logresbg">
            <div class="padform container">
                <table class="table table-bordered table-hover">
                    <tr>
                        <th style="background-color: #F1F1F1;">Tên món</th>
                        <th style="background-color: #F1F1F1;">Số lượng</th>
                        <th style="background-color: #F1F1F1;">Giá</th>
                    </tr>
                    <?php $o_de = mysqli_query($db, "SELECT * FROM `detail_orders` WHERE o_id=70;");
                    while ($rows_detail = mysqli_fetch_array($o_de)) { ?>
                        <tr>
                            <td> <?php echo $rows_detail['d_id']; ?> </td>
                            <td> <?php echo $rows_detail['quantity']; ?> </td>
                            <td> <?php echo $rows_detail['price']; ?> </td>
                        </tr>
                    <?php } ?>
                    <!-- Add more rows for additional products if needed -->

                    <tr>
                        <th style="background-color: #F1F1F1;" colspan="2">Phương thức thanh toán:</th>
                        <td>COD (Cash on Delivery)</td>
                    </tr>
                    <tr>
                        <th style="background-color: #F1F1F1;" colspan="2">Voucher:</th>
                        <td><?php echo $rows_detail['vou_id']; ?></td>
                    </tr>
                    <tr>
                        <th style="background-color: #F1F1F1;" colspan="2">Phí vận chuyển:</th>
                        <td>50,000</td>
                    </tr>
                    <tr>
                        <th style="background-color: #F1F1F1;" colspan="2">Tổng cộng:</th>
                        <td><strong><?php echo number_format($item_total) . " đ"; ?></strong></td>
                    </tr>

                </table>
            </div>
            <?php include('footer.php') ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
<?php
}
?>