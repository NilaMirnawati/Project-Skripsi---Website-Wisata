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

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
}

$sql = "SELECT * FROM wisata where id = $id";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6nI0wmy4zLxm7OT2U4inrqpQAIDDPAn8&libraries=places"></script>
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
                                    <form action="../controller/admin/wisata_edit.php?id=<?php echo $data['id'] ?>" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="nama">Nama Wisata</label>
                                                    <input type="hidden" name="id_wisata" id="id_wisata" value="<?php echo $data['id'] ?>">
                                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Wisata" value="<?php echo $data['nama'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="htm">Harga Tiket Wisata</label>
                                                    <input type="number" class="form-control" name="htm" id="htm" placeholder="Harga Tiket Wisata" value="<?php echo $data['htm'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="deskripsi">Deskripsi Lengkap</label>
                                                    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" placeholder="Deskripsi Wisata"> <?php echo $data['deskripsi'] ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="deskripsi_singkat">Deskripsi Singkat</label>
                                                    <textarea class="form-control" name="deskripsi_singkat" id="deskripsi_singkat" rows="5" placeholder="Deskripsi Wisata"><?php echo $data['deskripsi'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="fasilitas">Fasilitas</label>
                                                    <textarea class="form-control" name="fasilitas" id="fasilitas" rows="5" placeholder="Fasilitas Wisata">  <?php echo $data['fasilitas'] ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="alamat">Alamat Wisata</label>
                                                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat Wisata" value="<?php echo $data['alamat'] ?>">
                                                </div>
                                            </div>
                                            <!-- <div class="row"> -->
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="lokasi">Lokasi</label>

                                                    <div class="col-auto" style="position: sticky;">
                                                        <div id="map" style="height: 400px;"></div>
                                                        <input type="hidden" name="place_id" id="place_id" value="<?php echo $data['place_id']; ?>">
                                                        <input type="text" id="place_input" class="form-control mt-2" placeholder="Cari Lokasi (kosongkan jika tidak perlu)" style="width: 80%; box-sizing: border-box;">
                                                        <?php
                                                        $placeId = $data['place_id'];
                                                        $apiKey = "AIzaSyC6nI0wmy4zLxm7OT2U4inrqpQAIDDPAn8";
                                                        $apiUrl = "https://maps.googleapis.com/maps/api/place/details/json?place_id=" . $placeId . "&key=" . $apiKey;
                                                        $response = file_get_contents($apiUrl);
                                                        $data2 = json_decode($response, true);

                                                        if ($data2['status'] == 'OK') {
                                                            $latitude = $data2['result']['geometry']['location']['lat'];
                                                            $longitude = $data2['result']['geometry']['location']['lng'];

                                                            echo "<script src='https://maps.googleapis.com/maps/api/js?key=$apiKey&libraries=places'></script>";
                                                            echo "<script>
                                                            var map, marker, searchBox;

                                                            function initMap() {
                                                                var initialPos = {lat: $latitude, lng: $longitude};
                                                                map = new google.maps.Map(document.getElementById('map'), {
                                                                    center: initialPos,
                                                                    zoom: 15
                                                                });

                                                                marker = new google.maps.Marker({
                                                                    position: initialPos,
                                                                    map: map,
                                                                    draggable: true
                                                                });

                                                                map.addListener('click', function(e) {
                                                                    placeMarkerAndPanTo(e.latLng, map);
                                                                });

                                                                // Setup the search box
                                                                searchBox = new google.maps.places.SearchBox(document.getElementById('place_input'));
                                                                map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('place_input'));

                                                                searchBox.addListener('places_changed', function() {
                                                                    var places = searchBox.getPlaces();

                                                                    if (places.length == 0) {
                                                                        return;
                                                                    }

                                                                    // For each place, get the icon, name and location.
                                                                    places.forEach(function(place) {
                                                                        if (!place.geometry) {
                                                                            console.log('Returned place contains no geometry');
                                                                            return;
                                                                        }

                                                                        // Clear the existing marker
                                                                        if (marker) {
                                                                            marker.setMap(null);
                                                                        }

                                                                        // Create a new marker at the place location
                                                                        marker = new google.maps.Marker({
                                                                            map: map,
                                                                            title: place.name,
                                                                            position: place.geometry.location
                                                                        });

                                                                        // Update the map's viewport
                                                                        if (place.geometry.viewport) {
                                                                            map.fitBounds(place.geometry.viewport);
                                                                        } else {
                                                                            map.setCenter(place.geometry.location);
                                                                            map.setZoom(17);
                                                                        }

                                                                        // Set the place ID to the input field
                                                                        document.getElementById('place_id').value = place.place_id;
                                                                    });
                                                                });
                                                            }

                                                            function placeMarkerAndPanTo(latLng, map) {
                                                                if (marker) {
                                                                    marker.setMap(null);
                                                                }

                                                                marker = new google.maps.Marker({
                                                                    position: latLng,
                                                                    map: map
                                                                });

                                                                map.panTo(latLng);
                                                                getPlaceId(latLng);
                                                            }

                                                            function getPlaceId(latLng) {
                                                                var geocoder = new google.maps.Geocoder;
                                                                geocoder.geocode({'location': latLng}, function(results, status) {
                                                                    if (status === 'OK') {
                                                                        if (results[0]) {
                                                                            var place_id = results[0].place_id;
                                                                            document.getElementById('place_id').value = place_id;
                                                                        }
                                                                    } else {
                                                                        window.alert('Geocoder failed due to: ' + status);
                                                                    }
                                                                });
                                                            }

                                                            initMap();
                                                            </script>";
                                                        } else {
                                                            echo "<p>Error: Unable to fetch location details.</p>";
                                                        }
                                                        ?>
                                                        <a class="btn btn-primary mt-3" href="https://www.google.com/maps/search/?api=1&query=<?php echo $latitude; ?>,<?php echo $longitude; ?>" target="_blank">Open in Google Maps</a>
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
                                                    <input type="time" class="form-control" name="jam_buka" id="jam_buka" placeholder="Nama Wisata" value="<?php echo $data['jam_buka'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="jam_tutup">Jam Tutup</label>
                                                    <input type="time" class="form-control" name="jam_tutup" id="jam_tutup" placeholder="Nama Wisata" value="<?php echo $data['jam_tutup'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="hari">Hari Buka</label>
                                                    <input type="text" class="form-control" name="hari" id="hari" rows="3" placeholder="Hari Buka" value="<?php echo $data['hari'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-sm-12">
                                                <div class="profile-pic-div">
                                                    <img id="photoold" class="m-1 img-fluid" src="../image/wisata/<?php echo $data['gambar']; ?>" alt="profile" style="width: 200px;">
                                                    <input style="display:none" class="form-control" type="file" id="image" name="image">
                                                    <br>
                                                    <label class="btn btn-outline-secondary" for="image">Ganti Gambar</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-sm-4">
                                                <label for="slide1">Gambar Detail</label>
                                                <br>
                                                <img id="photoold1" class="m-1 img-fluid" src="../image/detail/<?php echo $data['slide1']; ?>" alt="profile" style="width: 200px;">
                                                <input style="display:none" type="file" class="form-control" id="slide1" name="slide1">
                                                <br>
                                                <label class="btn btn-outline-secondary" for="slide1">Ganti Gambar</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="slide2">Gambar Detail</label>
                                                <br>
                                                <img id="photoold2" class="m-1 img-fluid" src="../image/detail/<?php echo $data['slide2']; ?>" alt="profile" style="width: 200px;">
                                                <input style="display:none" type="file" class="form-control" id="slide2" name="slide2">
                                                <br>
                                                <label class="btn btn-outline-secondary" for="slide2">Ganti Gambar</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="slide3">Gambar Detail</label>
                                                <br>
                                                <img id="photoold3" class="m-1 img-fluid" src="../image/detail/<?php echo $data['slide3']; ?>" alt="profile" style="width: 200px;">
                                                <input style="display:none" type="file" class="form-control" id="slide3" name="slide3">
                                                <br>
                                                <label class="btn btn-outline-secondary" for="slide3">Ganti Gambar</label>
                                            </div>
                                        </div>
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
 
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script>
        function updateImagePreview(input, imgElementId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(imgElementId).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            updateImagePreview(this, '#photoold');
        });
        $("#slide1").change(function() {
            updateImagePreview(this, '#photoold1');
        });
        $("#slide2").change(function() {
            updateImagePreview(this, '#photoold2');
        });
        $("#slide3").change(function() {
            updateImagePreview(this, '#photoold3');
        });
    </script>
</body>

</html>