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
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

</head>
<style>
    #pac-input {
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        width: 300px;
        margin-top: 10px;
    }
</style>

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
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Form Wisata</h1>
                        </div>
                    </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="../controller/admin/wisata_create.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="nama">Nama Wisata</label>
                                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Wisata" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="htm">Harga Tiket Wisata</label>
                                                    <input type="number" class="form-control" name="htm" id="htm" placeholder="Harga Tiket Wisata" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="deskripsi">Deskripsi Lengkap</label>
                                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Deskripsi Wisata"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="deskripsi_singkat">Deskripsi Singkat</label>
                                                    <textarea class="form-control" name="deskripsi_singkat" id="deskripsi_singkat" rows="3" placeholder="Deskripsi Wisata"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="fasilitas">Fasilitas</label>
                                                    <textarea class="form-control" name="fasilitas" id="fasilitas" rows="3" placeholder="Fasilitas Wisata" required></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat Wisata</label>
                                                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Wisata" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    
                                                    <label for="lokasi">Lokasi</label>
                                                    <input type="hidden" id="place_id" name="place_id">
                                                    <label for="place_input">Search Location:</label><br>
                                                    <input class="form-control" id="place_input" type="text" placeholder="Cari Tempat (kosongkan jika tidak perlu)">

                                                    <div id="map" style="height: 400px;">
                                                    </div>   
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="">Waktu Operasional</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="jam_buka">Jam Buka</label>
                                                    <input type="time" class="form-control" name="jam_buka" id="jam_buka" placeholder="Nama Wisata">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="jam_tutup">Jam Tutup</label>
                                                    <input type="time" class="form-control" name="jam_tutup" id="jam_tutup" placeholder="Nama Wisata">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="hari">Hari Buka</label>
                                                    <input type="text" class="form-control" name="hari" id="hari" rows="3" placeholder="Hari Buka">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-sm-12">
                                                <label for="gambar">Gambar</label>
                                                <input type="file" class="form-control-file " id="gambar" name="gambar">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-sm-4">
                                                <label for="slide1">Gambar Detail</label>
                                                <input type="file" class="form-control-file" id="slide1" name="slide1">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="slide2">Gambar Detail</label>
                                                <input type="file" class="form-control-file" id="slide2" name="slide2">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="slide3">Gambar Detail</label>
                                                <input type="file" class="form-control-file" id="slide3" name="slide3">
                                            </div>
                                        </div>
                                        <!-- <div class="row mb-4">
                                            <div class="col-sm-12">
                                                <label for="video">Pilih video (maksimal 100 MB):</label><br>
                                                <input type="file" id="video" name="vi  deo" accept="video/*" size="104857600" required><br>
                                                <small>File video harus berformat MP4, MOV, atau format video lainnya.</small><br>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-12 d-flex">
                                                <button type="submit" class="btn btn-primary w-100"> Simpan Data Wisata</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
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
        var map;
        var placeInput = document.getElementById('place_input');
        var placeIdInput = document.getElementById('place_id');
        var marker;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -6.903477943268576,
                    lng: 112.06260681152345
                },
                zoom: 12 
            });

            var searchBox = new google.maps.places.SearchBox(placeInput);

            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                var place = places[0];
                placeIdInput.value = place.place_id;

                placeMarker(place.geometry.location);
            });

            map.addListener('click', function(event) {
                var geocoder = new google.maps.Geocoder;
                geocoder.geocode({
                    'location': event.latLng
                }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            var placeId = results[0].place_id;
                            console.log("Place ID:", placeId);
                            placeIdInput.value = placeId;
                            placeMarker(event.latLng);
                        } else {
                            console.log('No results found');
                        }
                    } else {
                        console.log('Geocoder failed due to: ' + status);
                    }
                });
            });
        }

        function placeMarker(location) {
            if (marker) {
                marker.setMap(null);
            }

            marker = new google.maps.Marker({
                position: location,
                map: map
            });

            map.panTo(location);
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6nI0wmy4zLxm7OT2U4inrqpQAIDDPAn8&libraries=places&callback=initMap"></script>
</body>

</html>