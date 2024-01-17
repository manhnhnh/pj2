<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- NAV 1 -->
    <nav class="navbar n1 navbar-expand-lg bg-body-tertiary position-relative">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../images/logo.png" alt="Logo" style="width:150px;" class="d-inline-block align-top">
            </a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="logout.php" role="button">
                            Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="left-sidebar">
        <a class="nav-link" href="#"><i style="padding-right: 7px;" class="fa fa-tachometer"></i>Số liệu tổng thể</a>
        <a class="nav-link" href="#"><i style="padding-right: 7px;" class="fa fa-users"></i>Thành viên</a>
        <!-- Chỉnh sửa nhà hàng dropdown -->
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-building" style="padding-right: 7px;"></i>
                    Nhà hàng
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">Danh sách nhà hàng</a></li>
                <li><a class="dropdown-item" href="#">Thêm nhà hàng</a></li>
                <li><a class="dropdown-item" href="#">Thêm phân loại nhà hàng</a></li>
            </ul>
        </div>
        <a class="nav-link" href="#"><i style="padding-right: 7px;" class="fa fa-ticket"></i>Voucher</a>
    </div>


</body>

</html>