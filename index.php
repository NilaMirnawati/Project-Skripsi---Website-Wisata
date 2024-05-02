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
  <title>Home | Tuban Explore</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">




</head>

<body>
  <header class="navbar sticky-top navbar-expand-lg navbar-light shadow-sm main-nav">

    <div class="container">
      <a class="navbar-brand" href="index.html"><img src="assetS/img/logo-1.png" class="main-logo" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto py-3">
          <a class="nav-link active px-3" aria-current="page" href="index.php">Home</a>
          <a class="nav-link ps-3" href="wisata.php">Wisata</a>
          <a class="nav-link ps-3" href="checkcuaca.php">Check Cuaca</a>
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
  <div class="container-fluid banner">
    <div class="container banner-content  col-md-6">
      <div class="row justify-content-center fs-5 text-center ">
        <img src="assets/img/logo-1.png" class="col-lg-5 offset-lg-1 mb-3">
        <div class="welcome">
          <h2>Ayo, jelajahi keindahan alam <span> TUBAN</span> , jangan cuma <span>REBAHAN</span></h2>
          <p></p>
        </div>
        <div class="search-box">
          <form action="controller/search.php" method="post">
            <button class="btn-search"><i class="fas fa-search"></i></button>
            <input type="text" class="input-search" name="cari" placeholder="Type to Search...">
          </form>
        </div>


      </div>


    </div>

  </div>


  <section>
    <div class="container-fluid carousel-contain py-5 main-biru ">
      <div class="container " data-aos="fade-up" data-aos-duration="1500">
        <h2 class="text-center mb-5">TOP DESTINATION</h2>
        <div id="carouselExampleCaptions" class="carousel slide col-lg-8 offset-lg-2" data-bs-ride="carousel ">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>

          </div>
          <div class="carousel-inner bordered">
            <div class="carousel-item active">
              <img src="assets/img/silowo-1.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <a class="nav-link wisata" href="silowo.html">EKOWISATA SILOWO</a>

              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/img/nglirip-1.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <a class="nav-link wisata" href="nglirip.html">AIR TERJUN NGLIRIP</a>

              </div>
            </div>
            <div class="carousel-item">
              <img src="assets/img/pantaikelapa-1.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <a class="nav-link wisata" href="pantaikelapa.html">PANTAI KELAPA</a>

              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>

  </section>

  <section id="populer">
    <div class="container-fluid py-5 ">
      <div class="container">
        <h2 tulisan class="text-center main-judul" data-aos="zoom-out">DESTINASI WISATA</h2>
        <div class="row mt-5 justify-content-center " data-aos="flip-right" data-aos-duration="1500">
          <?php

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
          ?>
              <div class="col-md-4 hovered-card">
                <div class="card shadow-sm w-100">
                  <img src="image/wisata/<?php echo $row['gambar'] ?>" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row['nama'] ?></h5>
                    <p class="card-text"><?php echo $row['deskripsi_singkat'] ?></p>
                    <a href="pelang.html" class="next">Detail</a>
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
          <div class="mt-5 d-flex justify-content-center">
            <a href="wisata.php" class="next">NEXT &raquo;</a>
          </div>


          <section class="footer" data-aos="fade-up" data-aos-duration="1000">

            <div class="container">

              <div class="share">


                <div class="foto">
                  <img src="assets/img/logo-1.png">
                </div>

                <P class="text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates natus ipsa recusandae architecto omnis ipsum ad repellendus tenetur excepturi facere accusantium illum deserunt repellat, expedita voluptas! Voluptatum inventore voluptas aspernatur vel mollitia, qui quia commodi cumque maxime? Quam, aspernatur dolores dolorem, laborum voluptatem quisquam explicabo eligendi quaerat magni, possimus laudantium?</P>

                <a href="#" class="ftr"> <i class="fab fa-facebook-f"></i></a>
                <a href="#" class="ftr"> <i class="fab fa-twitter"></i></a>
                <a href="#" class="ftr"><i class="fab fa-instagram"></i></a>

              </div>


            </div>

        </div>
      </div>

      <div class="container-fluid">
        <div class="text-center py-5 text-light">Copyright &copy 2022. All right reserved</div>
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