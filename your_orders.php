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
                    <thead style="background: #404040; color:white;">
                        <tr>
                            <th>Ngày đặt</th>
                            <th>Tổng cộng</th>
                            <th>Trạng thái</th>
                            <th>Xem chi tiết</th>
                            <th>Đặt lại</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_sta = mysqli_query($db, "SELECT * FROM `order_status` INNER JOIN `users_orders` ON `order_status`.`sta_id` = `users_orders`.`sta_id` WHERE `users_orders`.`u_id` = '" . $_SESSION['user_id'] . "'");

                        $query_res = mysqli_query($db, "SELECT * FROM `users_orders` WHERE `u_id`='" . $_SESSION['user_id'] . "'");
                        if (!mysqli_num_rows($query_res) > 0) {
                            echo '<tr><td colspan="6"><center>Chưa có đơn hàng nào</center></td></tr>';
                        } else {
                            while ($row = mysqli_fetch_array($query_res)) {
                                $row_sta = mysqli_fetch_array($query_sta);
                        ?>
                                <tr>
                                    <td data-column="date"> <?php echo $row['cre_date']; ?></td>
                                    <td data-column="total"> <?php echo number_format($row['total']); ?> đ</td>
                                    <td data-column="status"> <?php echo $row_sta['sta_name']; ?></td>
                                    <td data-column="Action">
                                        <a href="detail_order.php?o_id=" class="btn btn-primary btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-ellipsis-h" style="font-size:16px"></i></a>
                                    </td>
                                    <td data-column="Action">
                                        <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Are you sure you want to delete your order?');" class="btn btn-secondary btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-repeat" style="font-size:16px"></i></a>
                                    </td>
                                    <td data-column="Action">
                                        <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Are you sure you want to delete your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
            <?php include('footer.php') ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
<?php
}
?>