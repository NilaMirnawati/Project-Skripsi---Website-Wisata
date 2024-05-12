<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    $_SESSION['error'] = 'Gagal';
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
include '../controller/koneksi.php';

$sql = "SELECT * FROM wisata ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tuban Explore | Data Wisata</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
    <!-- JQVMap -->
    <!-- <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->
    <!-- summernote -->
    <!-- <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css"> -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

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
                    <a href="dashboard.php" class="nav-link">Dashboard</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
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

                <!-- Notifications Dropdown Menu -->
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
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #5C83E8;">
            <!-- Brand Logo -->
            <a href="dashboard.php" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Halaman Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="data-wisata.php" class="nav-link active">
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
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data Wisata</h1>
                            <!-- <a href=""></a> -->
                            <a href="../admin/wisata_create.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Tambah Wisata
                            </a>

                        </div>
                    </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Foto</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Deskripsi Singkat</th>
                                                <th>Lokasi</th>
                                                <th>Jam</th>
                                                <th>Fasilitas</th>
                                                <th>HTM</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $no ?></td>
                                                        <td><img src="../image/wisata/<?php echo $row['gambar'] ?>" alt="" width="50%"> </td>
                                                        <td><?php echo $row['nama'] ?></td>
                                                        <td><?php echo $row['deskripsi'] ?></td>
                                                        <td><?php echo $row['deskripsi_singkat'] ?></td>
                                                        <td><?php echo $row['alamat'] ?></td>
                                                        <td><?php echo $row['jam_buka'] ?> - <?php echo $row['jam_tutup'] ?></td>
                                                        <td><?php echo $row['fasilitas'] ?></td>
                                                        <td><?php echo $row['htm'] ?></td>
                                                        <td>
                                                            <a href="wisata_edit.php?id=<?php echo $row['id'] ?>" class="btn btn-primary m-1">
                                                                Edit
                                                            </a>
                                                            <a href='#' data-toggle='modal' data-target='#modalhapus<?php echo $row['id'] ?>' class="btn btn-danger">Hapus</a>
                                                            <div class='modal fade' id='modalhapus<?php echo $row['id'] ?>'>
                                                                <div class='modal-dialog'>
                                                                    <div class='modal-content'>
                                                                        <div class='modal-header'>
                                                                            <h4 class='modal-title'>Hapus Menu</h4>
                                                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                                <span aria-hidden='true'>&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class='modal-body'>
                                                                            <h5>Apakah anda ingin menghapus <?php echo $row['nama'] ?> ?</h5>
                                                                        </div>
                                                                        <div class='modal-footer justify-content-between'>
                                                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Batal</button>
                                                                            <a href='../controller/admin/wisata_delete.php?id=<?php echo $row['id'] ?>' class='btn btn-primary'>Hapus</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- <?php if ($row['slider'] == 1) { ?>
                                                                <a href="../controller/admin/wisata_slider2.php?id=<?php echo $row['id'] ?>" class="btn btn-warning m-1">
                                                                    Hapus Dari Halaman Utama
                                                                </a>
                                                            <?php } else { ?>
                                                                <a href="../controller/admin/wisata_slider.php?id=<?php echo $row['id'] ?>" class="btn btn-success m-1">
                                                                    Tambahkan Ke Halaman Utama
                                                                </a>
                                                            <?php } ?> -->
                                                        </td>
                                                    </tr>

                                                <?php
                                                    $no++;
                                                }
                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="9"> Tidak Ada Hasil</td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
</body>

</html>