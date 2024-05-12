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
$sql = "SELECT * FROM user  ";
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
                            <a href="dashboard.php" class="nav-link">
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
                            <a href="data-user.php" class="nav-link active">
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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Data User</h1>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                <i class="fas fa-plus"></i>
                                Tambah User
                            </button>
                            <div class=" modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Form User</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../controller/admin/user_create.php" method="post" enctype="multipart/form-data">
                                                <div class="form-outline mb-1">
                                                    <label class="form-label" for="nama">Username</label>
                                                    <input type="text" id="nama" name="nama" class="form-control form-control-lg" />
                                                </div>

                                                <div class="form-outline mb-1">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input type="text" id="email" name="email" class="form-control form-control-lg" />
                                                </div>
                                                <div class="form-outline mb-1">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input type="text" id="password" name="password" class="form-control form-control-lg" />
                                                </div>
                                                <div class="form-outline mb-1">
                                                    <label class="form-label" for="level">Level</label>
                                                    <select class="form-control form-control-lg" name="level" id="level">
                                                        <option value="user">User</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>

                                                <div class="pt-1 mb-4">
                                                    <button class="btn btn-primary btn-lg btn-block" type="submit" value="submit">
                                                        Tambahkan
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- <div class="card-header">
                                    <h3 class="card-title">DataTable with default features</h3>
                                </div> -->
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Level</th>
                                                <th>Username</th>
                                                <th>Email</th>
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
                                                        <td><?php echo $row['role'] ?></td>
                                                        <td><?php echo $row['username'] ?></td>
                                                        <td><?php echo $row['email'] ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit<?php echo $row['id'] ?>">
                                                                Edit
                                                            </button>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?php echo $row['id'] ?>">
                                                                Hapus
                                                            </button>

                                                            <div class=" modal fade" id="modal-edit<?php echo $row['id'] ?>">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Form Edit User</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="../controller/admin/user_edit.php?id=<?php echo $row['id'] ?>" method="post" enctype="multipart/form-data">
                                                                                <div class="form-outline mb-1">
                                                                                    <label class="form-label" for="nama">Username</label>
                                                                                    <input type="text" id="nama" name="nama" value="<?php echo $row['username'] ?>" class="form-control form-control-lg" />
                                                                                </div>

                                                                                <div class="form-outline mb-1">
                                                                                    <label class="form-label" for="email">Email</label>
                                                                                    <input type="text" id="email" name="email" value="<?php echo $row['email'] ?>" class="form-control form-control-lg" />
                                                                                </div>
                                                                                <div class="form-outline mb-1">
                                                                                    <label class="form-label" for="password">Password</label>
                                                                                    <input type="text" id="password" name="password" class="form-control form-control-lg" placeholder="Kosongkan jika tidak perlu" />
                                                                                </div>
                                                                                <div class="form-outline mb-1">
                                                                                    <label class="form-label" for="level">Level</label>
                                                                                    <select class="form-control form-control-lg" name="level" id="level">
                                                                                        <option value="user" <?php echo $row['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                                                                        <option value="admin" <?php echo $row['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                                                    </select>
                                                                                    <!-- <input type="text" id="level" name="level" class="form-control form-control-lg" /> -->
                                                                                </div>

                                                                                <div class="pt-1 mb-4">
                                                                                    <button class="btn btn-primary btn-lg btn-block" type="submit" value="submit">
                                                                                        Perbarui
                                                                                    </button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='modal fade' id='modal-hapus<?php echo $row['id'] ?>'>
                                                                <div class='modal-dialog'>
                                                                    <div class='modal-content'>
                                                                        <div class='modal-header'>
                                                                            <h4 class='modal-title'>Hapus User</h4>
                                                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                                                <span aria-hidden='true'>&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class='modal-body'>
                                                                            <h5>Apakah anda ingin menghapus <?php echo $row['username'] ?> ?</h5>
                                                                        </div>
                                                                        <div class='modal-footer justify-content-between'>
                                                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Batal</button>
                                                                            <a href='../controller/admin/user_delete.php?id=<?php echo $row['id'] ?>' class='btn btn-primary'>Hapus</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                            <?php
                                                    $no++;
                                                }
                                            } else {
                                                echo "<tr><td colspan='5'>TIDAK ADA MENU</td></tr>";
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