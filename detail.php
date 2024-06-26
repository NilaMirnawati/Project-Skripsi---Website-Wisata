<?php
session_start();
include 'controller/koneksi.php';
if (isset($_SESSION['sukses'])) {
    echo "<script>alert('" . $_SESSION['sukses'] . "');</script>";
    unset($_SESSION['sukses']);
}
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['nama'] ?>| Tuban Explore</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6nI0wmy4zLxm7OT2U4inrqpQAIDDPAn8"></script>
</head>

<body>
    <header class="navbar sticky-top navbar-expand-lg navbar-light shadow-sm main-nav">

        <div class="container">
            <a class="navbar-brand" href="index.php"><img src="assetS/img/logo-1.png" class="main-logo" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto py-3">
                    <a class="nav-link px-3" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link ps-3" href="wisata.php">Wisata</a>
                    <a class="nav-link ps-3" href="checkcuaca.php">Check Cuaca</a>
                    <a class="nav-link ps-3" href="aboutus.php">About us</a>
                    <?php
                    if (isset($_SESSION['loggedin'])) {
                    ?>
                        <a class="nav-link ps-3" href="controller/logout.php">Log Out</a>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link ps-3" href="loginform.php">Login</a>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </header>
    <section id="blog">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-lg-8 mb-3 mx-auto">
                    <div class="rounded shadow-lg w-100">
                        <div class="px-5 py-5">
                            <h2 tulisan class="text-center main-judul mb-2" data-aos="zoom-out"><?php echo $data['nama'] ?></h2>
                        </div>
                    </div>
                    <div class="col-lg-12 mx-auto py-5 px-5 ">
                        <div id="carouselExampleFade" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="3000">
                                    <img src="image/detail/<?php echo $data['slide1'] ?>" class="w-50 border px-3 py-3 rounded mx-3 my-3 w-100" />
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <img src="image/detail/<?php echo $data['slide2'] ?>" class="w-50 border px-3 py-3 rounded mx-3 my-3 w-100" />
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <img src="image/detail/<?php echo $data['slide3'] ?>" class="w-50 border px-3 py-3 rounded mx-3 my-3 w-100" />
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>


                        <p>
                        <H4> <b><?php echo $data['nama'] ?></b></H4>
                        <?php echo $data['deskripsi'] ?></p>
                        <h4>Lokasi</h4>
                        <p><?php echo $data['alamat'] ?></p>
                        <div class="col-auto" style="position: sticky;">

                            <div id="map" style="height: 400px;">
                            </div>
                            <?php echo $data['place_id'] ?>
                            <?php
                            $placeId = $data['place_id'];
                            $apiUrl = "https://maps.googleapis.com/maps/api/place/details/json?place_id=" . $placeId . "&key=AIzaSyC6nI0wmy4zLxm7OT2U4inrqpQAIDDPAn8";
                            $response = file_get_contents($apiUrl);
                            $data2 = json_decode($response, true);

                            if ($data2['status'] == 'OK') {
                                $latitude = $data2['result']['geometry']['location']['lat'];
                                $longitude = $data2['result']['geometry']['location']['lng'];

                                echo "<script>
                                                var map;
                                                function initMap() {
                                                    map = new google.maps.Map(document.getElementById('map'), {
                                                        center: {lat: $latitude, lng: $longitude},
                                                        zoom: 15
                                                    });
                                                    var marker = new google.maps.Marker({
                                                        position: {lat: $latitude, lng: $longitude},
                                                        map: map
                                                    });
                                                }
                                                initMap();
                                            </script>";
                            ?>
                                <button class="btn btn-primary mt-3">
                                    <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $data2['result']['geometry']['location']['lat'] ?>,<?php echo $data2['result']['geometry']['location']['lng'] ?>" target="_blank">Open in Google Maps</a>
                                </button>
                            <?php
                            } else {
                                echo "<p>Error: Unable to fetch location details.</p>";
                            }
                            ?>
                        </div>
                        <h4>Jam Operasional</h4>
                        <p> <?php echo $data['hari'] ?>, pukul <?php echo $data['jam_buka'] ?>-<?php echo $data['jam_tutup'] ?> WIB.</p><br>
                        <h4>Fasilitas</h4>
                        <p><?php echo $data['fasilitas'] ?></p><br>
                        <h3>HTM:</h3>
                        <p>Harga tiket <?php echo $data['nama'] ?> adalah Rp. <?php echo number_format($data['htm'], 0, ',', '.') ?> </p>
                        <button type="submit" class="btn btn-main rounded-full px-4">
                            <a href="formtiket.php?id=<?php echo $data['id'] ?>" class="fa fa-fw fa-clipboard-list">Beli Tiket</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <section class="footer" data-aos="fade-up" data-aos-duration="1000">

        <div class="container">

            <div class="share">
                <div class="foto">
                    <img src="assets/img/logo-1.png">
                </div>
                <P class="text-center">Tuban Explore adalah website yang menyediakan informasi dan panduan mengenai destinasi wisata di Kabupaten Tuban. website ini menyajikan foto-foto, peta, serta tracking cuaca dan untuk membantu pengguna membeli tiket wisata secara online. Dengan menggunakan website Tuban Explore, pengguna dapat menjelajahi berbagai tujuan wisata, merencanakan itinerary perjalanan, dan memperoleh informasi penting lainnya untuk membuat pengalaman liburan mereka menjadi lebih menyenangkan dan berkesan.</P>

                <a href="#" class="ftr"> <i class="fab fa-facebook-f"></i></a>
                <a href="#" class="ftr"> <i class="fab fa-twitter"></i></a>
                <a href="#" class="ftr"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        </div>
        <div class="container-fluid">
            <div class="text-center py-5 text-light">Created by : Tuban Explore</div>
        </div>
    </section>



    <script src="assets/js/bundle.min.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
</body>

</html>