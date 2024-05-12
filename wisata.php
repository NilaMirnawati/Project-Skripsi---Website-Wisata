<?php
session_start();
if (isset($_SESSION['sukses'])) {
  echo "<script>alert('" . $_SESSION['sukses'] . "');</script>";
  unset($_SESSION['sukses']);
}
if (isset($_SESSION['error'])) {
  echo "<script>alert('" . $_SESSION['error'] . "');</script>";
  unset($_SESSION['error']);
}

include 'controller/koneksi.php';

$sql = "SELECT * FROM wisata ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wisata | Tuban Explore</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
          <a class="nav-link active ps-3" href="wisata.php">Wisata</a>
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
  <section id="populer">
    <div class="container-fluid py-5 ">
      <div class="container">
        <h2 tulisan class="text-center main-judul" data-aos="zoom-out">DESTINASI WISATA</h2>
        <div class="row mt-5 justify-content-center " data-aos="flip-right" data-aos-duration="1500">
          <?php

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
          ?>
              <div class="col-md-3 hovered-card m-1">
                <div class="card shadow-sm w-100">
                  <img src="image/wisata/<?php echo $row['gambar'] ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nama'] ?></h5>
                    <p class="card-text"><?php echo $row['deskripsi_singkat'] ?></p>
                    <a href="detail.php?id=<?php echo $row['id'] ?>" class="next">Detail</a>
                  </div>
                </div>
              </div>
            <?php
            }
          } else {
            ?>
            <h1>Tidak Ada Hasil</h1>
          <?php
          }
          ?>

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
    </div>

    <div class="container-fluid">
      <div class="text-center py-5 text-light">Created by : Tuban Explore</div>
    </div>
  </section>


  <script src="assets/js/bundle.min.js"></script>
  <scrip src="assets/js/jquery-3.6.0.min.js"></scrip>
  <script src="assets/js/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script src="assets/js/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/TextPlugin.min.js"></script>
  <script>
    gsap.registerPlugin(TextPlugin);
    gsap.to("aing", {
      duration: 1,
      delay: 1.5,
      Text: 'Pilih tempat terbaik versi terbaikmu!!!',
      ease: "none"
    });
    gsap.from('.banner img', {
      duration: 2.5,
      ease: "elastic.out(1, 0.3)",
      y: -500
    });
    gsap.from('.haikal', {
      duration: 1,
      x: -50,
      opacity: 0,
      delay: 0.5,
      ease: 'back'
    });
  </script>



</html>