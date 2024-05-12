<?php
session_start();
include '../controller/koneksi.php';
if (!isset($_SESSION['loggedin'])) {
  $_SESSION['error'] = 'Kamu Tidak Punya Akses';
  header('Location: ../loginform.php');
}
if ($_SESSION['role'] == 'user') {
  header('Location: ../index.php');
}
if (isset($_SESSION['sukses'])) {
  echo "<script>alert('" . $_SESSION['sukses'] . "');</script>";
  unset($_SESSION['sukses']);
}
if (isset($_SESSION['error'])) {
  echo "<script>alert('" . $_SESSION['error'] . "');</script>";
  unset($_SESSION['error']);
}


$query2 = "SELECT COUNT(nama) AS jumlah_wisata FROM wisata  ";
$result2 = mysqli_query($conn, $query2);
$wisata = mysqli_fetch_assoc($result2);


$query = "SELECT COUNT(email) AS jumlah_user FROM user WHERE role = 'user' ";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);


$query3 = "SELECT COUNT(id) AS jumlah_transaksi FROM tiket WHERE status = 2 ";
$result3 = mysqli_query($conn, $query3);
$transaksi = mysqli_fetch_assoc($result3);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tuban Explore | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
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
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="dashboard.php" class="nav-link">Dashboard</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i> Profile
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="profile.php" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="../controller/logout.php" class="dropdown-item">
              <i class="fas fa-arrow-right mr-2"></i> Logout
            </a>
          </div>
        </li>

      </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #5C83E8;">
      <a href="dashboard.php" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Halaman Admin</span>
      </a>
      <div class="sidebar">
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="data-wisata.php" class="nav-link">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                  Data Wisata
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="data-tiket.php" class="nav-link">
                <i class="nav-icon fas fa-cart-plus"></i>
                <p>
                  Data Pembelian Tiket
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="data-user.php" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                 Data User
                </p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4 col-6">
              <div class="small-box" style="background-color: #ffffff;">
                <div class="inner">
                  <h1 style="color: #5C83E8;">Data Wisata</h1>
                  <h3><?php echo $wisata['jumlah_wisata'] ?></h3>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-6">
              <div class="small-box" style="background-color: #ffffff;">
                <div class="inner">
                  <h1 style="color: #5C83E8;">Data User</h1>
                  <h3><?php echo $user['jumlah_user'] ?></h3>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-6">
              <div class="small-box " style="background-color: #ffffff;">
                <div class="inner">
                  <h1 style="color: #5C83E8;">Data Transaksi</h1>
                  <h3><?php echo $transaksi['jumlah_transaksi'] ?></h3>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="row">
            <section class="col-lg-12 ">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    Grafik Penjualan
                  </h3>

                </div>
                <div class="card-body">
                  <div class="tab-content p-0">
                    asdasda
                  </div>
                </div>
              </div>



            </section>
          </div> -->
        </div>
      </section>
    </div>

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
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>