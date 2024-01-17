<!DOCTYPE html>
<html lang="en">
<?php
include("./connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();


function function_alert()
{
    echo "<script>alert('Đặt hàng thành công!');</script>";
    echo "<script>window.location.replace('your_orders.php');</script>";
}

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {

    foreach ($_SESSION["cart_item"] as $item) {

        $item_total += ($item["price"] * $item["quantity"]);
    }
    if ($_POST['submit']) {
        $sql_users_orders = "INSERT INTO users_orders (u_id, total) VALUES ('" . $_SESSION["user_id"] . "', '" . $item_total . "')";

        // Thực hiện truy vấn users_orders
        if (mysqli_query($db, $sql_users_orders)) {
            // Nếu thành công, lấy ID cuối cùng được chèn
            $last_id = mysqli_insert_id($db);
            // Sử dụng ID cuối cùng được chèn cho truy vấn detail_orders
            foreach ($_SESSION["cart_item"] as $item) {
                $sql_detail_orders = "INSERT INTO detail_orders (o_id, d_id, quantity, price,vou_id) VALUES ('" . $last_id . "', '" . $item["d_id"] . "',
                 '" . $item["quantity"] . "', '" . $item["price"] . "','1')";
                mysqli_query($db, $sql_detail_orders);
            }
        }

        unset($_SESSION["cart_item"]);
        unset($item["d_name"]);
        unset($item["quantity"]);
        unset($item["price"]);
        $success = "Thank you. Your order has been placed!";

        function_alert();
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
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <section class="step-links">
            <div class="top-links">
                <div class="container">
                    <ul class="row slink">
                        <li class="col-12 col-sm-4 link-item"><span>1</span><a href="#">Chọn nhà hàng</a></li>
                        <li class="col-12 col-sm-4 link-item"><span>2</span><a href="#">Chọn món ăn</a></li>
                        <li class="col-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Thanh toán</a></li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="check-bill">
            <form action="" method="post">
                <h4>Hóa đơn</h4>
                <table class="table">
                    <?php
                    $item_total = 0;
                    foreach ($_SESSION["cart_item"] as $item) {
                    ?>
                        <tbody>
                            <tr>
                                <td><?php echo $item["d_name"]; ?></td>
                                <td>Số lượng: <?php echo $item["quantity"]; ?></td>
                                <td> <?php echo number_format($item["price"]) . "đ"; ?></td>
                            </tr>
                        <?php
                        $item_total += ($item["price"] * $item["quantity"]);
                    }
                        ?>
                        <tr>
                            <td>Tổng giá món ăn</td>
                            <td></td>
                            <td> <?php echo number_format($item_total) . " đ"; ?></td>
                        </tr>
                        <tr>
                            <td>Phí vận chuyển</td>
                            <td></td>
                            <td>Free</td>
                        </tr>
                        <tr>
                            <td>Voucher</td>
                            <td></td>
                            <td>- 20% đơn </td>
                        </tr>
                        <tr>
                            <td class="text-color"><strong>Tổng cộng đơn hàng</strong></td>
                            <td></td>
                            <td class="text-color"><strong> <?php echo number_format($item_total) . " đ"; ?></strong></td>
                        </tr>

                </table>
                <div class="payment-option">
                    <ul class=" list-unstyled">
                        <li>
                            <label class="custom-control custom-radio  m-b-20">
                                <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Thanh toán khi nhận hàng</span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio  m-b-10">
                                <input name="mod" type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Tài khoản ngân hàng <img src="images/paypal.jpg" alt="" width="90"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-control custom-radio  m-b-10">
                                <input name="mod" type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Momo<img src="images/paypal.jpg" alt="" width="90"></span>
                            </label>
                        </li>
                    </ul>
                    <p class="text-xs-center"> <input type="submit" onclick="return confirm('Xác nhận đặt hàng?');" name="submit" class="btn btn-success btn-block" value="Đặt hàng"> </p>
                </div>
            </form>
        </section>

        <?php include('footer.php') ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
<?php
}
?>