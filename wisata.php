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
      <a class="navbar-brand" href="index.html"><img src="assetS/img/logo-1.png" class="main-logo" /></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto py-3">
          <a class="nav-link px-3" aria-current="page" href="index.php">Home</a>
          <a class="nav-link active ps-3" href="wisata.php">Wisata</a>
          <a class="nav-link ps-3" href="checkcuaca.php">Check Cuaca</a>
          <a class="nav-link ps-3" href="aboutus.php">About us</a>
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
        
          <div class="container">
            <div class="row mt-5 justify-content-center" data-aos="flip-left" data-aos-duration="1500">
              <div class="col-sm-6 col-md-3 hovered-card">
                <div class="card shadow-sm w-100">
                  <img src="assets/img/sendangasmoro-1.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">SENDANG ASMORO</h5>
                    <p class="card-text">Sendang Asmoro merupakan sebuah sendang yang hadir dengan air segar yang berwarna kehijauan, Air Sendang berwarna hijau dan tenang, terdapat ikan yang hidup di dalamnya.</p>
                    <a href="sendangasmoro.html" class="next">Detail</a>
                  </div>
                </div>
              </div>

              <div class="col-md-3 hovered-card">
                <div class="card shadow-sm w-100">
                  <img src="assets/img/sunanbonang-1.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">SUNAN BONANG</h5>
                    <p class="card-text">Makam Sunan Bonang, Raden Makdum Ibrahim atau Sunan Bonang merupakan salah satu ulama anggota Wali Songo sebagai penebar syiar Islam di Jawa abad ke-14 Masehi.</p>
                    <a href="sunanbonang.html" class="next">Detail</a>

                  </div>
                </div>
              </div>

              <div class="col-md-3 hovered-card">
                <div class="card shadow-sm w-100">
                  <img src="assets/img/goaputriasih-1.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">GOA PUTRI ASIH</h5>
                    <p class="card-text">Goa Putri Asih merupakan Goa yang sangat indah sekali dan terletak di tengah hutan jati yang masih alami, Di dalam Gua Putri Asih pengunjung bisa meluhat cave pearl (mutiara gua). </p>
                    <a href="goaputriasih.html" class="next">Detail</a>

                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-5 justify-content-center" data-aos="flip-left" data-aos-duration="1500">
              <div class="col-sm-6 col-md-3 hovered-card mb-3">
                <div class="card shadow-sm w-100">
                  <img src="assets/img/pasirputih-1.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">PANTAI PASIR PUTIH</h5>
                    <p class="card-text">Pantai Pasir Putih merupakan salah satu wisata pantai yang berada di kota Tuban. Pada kawasan Pantai Pasir Putih juga ditumbuhi oleh rimbunan pepohonan mangrove yang menambah sejuk iklim pada daerah pantai.</p>
                    <a href="pasirputih.html" class="next">Detail</a>
                  </div>
                </div>
              </div>

              <div class="col-md-3 hovered-card">
                <div class="card shadow-sm w-100">
                  <img src="assets/img/goangerong-1.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">GOA NGERONG</h5>
                    <p class="card-text">Goa Ngerong merupakan Goa yang memiliki keunikan tersendiri yaitu mulut goa yang dipenuhi dengan ribuan kelelawar dan terdapat aliran air yang bersumber dari dalam goa serta terdapat berbagai jenis ikan.</p>
                    <a href="goangerong.html class=" class="next">Detail</a>

                  </div>
                </div>
              </div>

              <div class="col-md-3 hovered-card">
                <div class="card shadow-sm w-100">
                  <img src="assets/img/pantaisemilir-1.png" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">PANTAI SEMILIR</h5>
                    <p class="card-text">Pantai Semilir merupakan salah satu wisata pantai di Tuban yang menyuguhkan pemandangan yang indah ditambah pasir putih yang membuat pantai ini memanjakan mata para pengunjungnya.</p>
                    <a href="pantaisemilir.html" class="next">Detail</a>

                  </div>
                </div>
              </div>
              <div class="container">
                <div class="row mt-5 justify-content-center" data-aos="flip-left" data-aos-duration="1500">
                  <div class="col-sm-6 col-md-3 hovered-card mb-3">
                    <div class="card shadow-sm w-100">
                      <img src="assets/img/tebingpelangi-1.jpeg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">TEBING PELANGI</h5>
                        <p class="card-text">Tebing Pelangi ini adalah salah satu karya yang sangat luar biasa. Memadukan konsep bekas tambang yang terbengkalai bisa disulapnya menjadi tempat wisata yang layak dikunjungi.</p>
                        <a href="tebingpelangi.html" class="next">Detail</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 hovered-card">
                    <div class="card shadow-sm w-100">
                      <img src="assets/img/pantaiboom-1.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">PANTAI BOOM</h5>
                        <p class="card-text">Pantai Boom merupakan pantai yang sedikit berbeda dibandingkan pantai pada umumnya. Pengunjung yang baru memasuki Pantai Boom akan disambut dengan relief-relief yang menceritakan sejarah Tuban.</p>
                        <a href="pantaiboom.html" class="next">Detail</a>

                      </div>
                    </div>
                  </div>

                  <div class="col-md-3 hovered-card">
                    <div class="card shadow-sm w-100">
                      <img src="assets/img/pantaipanduri-1.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">PANTAI PANDURI</h5>
                        <p class="card-text">Pantai Panduri merupakan pantai yang memiliki daya tarik sendiri dengan pemandangan sunset terbaik di Tuban. Kamu bisa menyaksikan panorama matahari tenggelam tanpa terhalang apapun.</p>
                        <a href="pantaipanduri.html" class="next">Detail</a>

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