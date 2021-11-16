<?php
require "../connection.php";
//hien thi danh muc
$sql  = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

//them sp
if (isset($_POST['btnThemSP'])) {
    $pro_name = $_POST['pro_name'];
    $detail = $_POST['detail'];
    $amount = $_POST['amount'];
    $cate_id = $_POST['cate_id'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    if ($_FILES['pro_img']['size'] > 0) {
        $pro_img = time() . $_FILES['pro_img']['name'];
        move_uploaded_file($_FILES['pro_img']['tmp_name'], "../upload/" . $pro_img);
    } else {
        $pro_img = "";
    }
    $sql = "INSERT INTO products set pro_name='$pro_name', detail='$detail', cate_id=$cate_id, amount=$amount, pro_img='$pro_img', price=$price, sale=$sale";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header("location:product.php");
    die;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thêm sản phẩm</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../signOut.php" class="nav-link">Đăng xuất</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="ml-3 form-inline">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="ml-auto navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="pb-3 mt-3 mb-3 user-panel d-flex">
                    <div class="image">
                        <img src="dist/img/tam2.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Tống Thị Thanh Tâm</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="py-2 nav-item border-bottom">
                            <a href="indexQT.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản trị </p>
                            </a>
                        </li>
                        <li class="py-2 nav-item border-bottom">
                            <a href="cate.php" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản trị danh mục </p>
                            </a>
                        </li>
                        <li class="py-2 nav-item border-bottom">
                            <a href="product.php" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản trị sản phẩm </p>
                            </a>
                        </li>
                        <li class="py-2 nav-item border-bottom">
                            <a href="user.php" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản trị tài khoản </p>
                            </a>
                        </li>
                        <li class="py-2 nav-item border-bottom">
                            <a href="slider.php" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản trị slider </p>
                            </a>
                        </li>
                        <li class="py-2 nav-item border-bottom">
                            <a href="comment.php" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản trị comment </p>
                            </a>
                        </li>
                        <li class="py-2 nav-item border-bottom">
                            <a href="info.php" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Quản trị info </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="mb-2 row">
                        <div class="col-sm-6">
                            <h1>Thêm sản phẩm</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Thêm sản phẩm</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
                <form action="" method="POST" id="addProduct" enctype="multipart/form-data">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12" style="float: left;">
                                <div class="col-sm-6" style="float: left;">
                                    <div class="form-group">
                                        <label for="">Tên Sản Phẩm</label>
                                        <input type="text" class="form-control" name="pro_name" id=""
                                            aria-describedby="helpId" placeholder="Tên sản phẩm" required>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="float: left;">
                                    <div class="form-group">
                                        <label for="">Giảm Giá</label>
                                        <input type="text" class="form-control" name="sale" id=""
                                            aria-describedby="helpId" placeholder="Theo %" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row  -->
                        <div class="row">
                            <div class="col-sm-12" style="float: left;">
                                <div class="col-sm-6" style="float: left;">
                                    <div class="form-group">
                                        <label for="">Giá</label>
                                        <input type="text" class="form-control" name="price" id=""
                                            aria-describedby="helpId" placeholder="Giá" required>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="float: left;">
                                    <div class="form-group">
                                        <label for="">Ảnh</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile" name="pro_img"
                                                required>
                                            <label class="custom-file-label" for="customFile">Chọn File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row  -->
                        <div class="row">
                            <div class="col-sm-12" style="float: left;">
                                <div class="col-sm-6" style="float: left;">
                                    <div class="form-group">
                                        <label for="">Chi tiết sản phẩm</label>
                                        <textarea name="detail" id="" cols="100" rows="10"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="float: left;">
                                    <div class="form-group">
                                        <label for="">Số Lượng</label>
                                        <input type="text" class="form-control" name="amount" id=""
                                            aria-describedby="helpId" placeholder="Số lượng" required>
                                    </div>
                                </div>
                                <div class="col-sm-6" style="float: left;">
                                    <div class="form-group">
                                        <label for="">Danh Mục</label>
                                        <select class="form-control" name="cate_id" id="" required>
                                            <?php foreach ($categories as $cate) : ?>
                                            <option value="<?= $cate['cate_id'] ?>"><?= $cate['cate_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Row  -->
                        <div class="row">
                            <div class="col-sm-12" style="float: left;">
                                <div class="col-sm-8" style="float: left;">
                                    <div class="form-group">
                                        <button type="submit" name="btnThemSP" id="" class="btn btn-primary" btn-lg
                                            btn-block>Thêm Mới Sản Phẩm</button>
                                        <a name="" id="" class="btn btn-danger" href="product.php" role="button">Quay
                                            Lại</a>
                                    </div>
                                </div>
                                <div class="col-sm-4" style="float: left;">
                                </div>
                            </div>
                        </div>
                        <!-- End Row  -->
                    </div>
                </form>
        </div>
        </section>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2021 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.0.5
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
</body>

</html>