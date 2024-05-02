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
if (isset($_GET['id_tiket']) && !empty($_GET['id_tiket'])) {
    $id_tiket = $conn->real_escape_string($_GET['id_tiket']);
    $sql2 = "SELECT * FROM tiket where id = $id_tiket";
    $result2 = mysqli_query($conn, $sql2);
    $tiket = mysqli_fetch_assoc($result2);
    // var_dump($tiket);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Air Terjun Nglirip | Tuban Explore</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css">

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
                    <a class="nav-link px-3" aria-current="page" href="index.php    ">Home</a>
                    <a class="nav-link ps-3" href="wisata.html">Wisata</a>
                    <a class="nav-link ps-3" href="Aartikel.html">Article</a>
                    <a class="nav-link ps-3" href="LOKASI.html">Location</a>
                    <a class="nav-link ps-3" href="about us.html">About us</a>
                </div>
            </div>
        </div>
    </header>
    <section id="blog">
        <div class="container-fluid py-5">
            <div class="row">
                <div class="col-lg-9 mb-3 mx-auto">
                    <div class="card border-dark">
                        <div class="card-header text-center"> <h2>Invoice Pembelian Tiket</h2></div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-3">
                                    <p class="m-1">Nama Lengkap</p>
                                    <p class="m-1">No. Telepon</p>
                                    <p class="m-1">Tanggal Kunjungan</p>
                                    <p class="m-1">Nama Wisata</p>
                                    <p class="m-1">Jumlah</p>
                                    <p class="m-1">Harga Tiket</p>
                                    <p class="m-1">Total Harga</p>
                                </div>
                                <div class="col-9">
                                    <p class="m-1">: <?php echo $tiket['nama_user'] ?></p>
                                    <p class="m-1">: <?php echo $tiket['no_telp'] ?></p>
                                    <p class="m-1">: <?php echo $tiket['tanggal'] ?></p>
                                    <p class="m-1">: <?php echo $tiket['nama_wisata'] ?></p>
                                    <p class="m-1">: <?php echo $tiket['jumlah'] ?></p>
                                    <p class="m-1">: <?php echo $tiket['harga'] ?></p>
                                    <p class="m-1">: <?php echo $tiket['total'] ?></p>
                                </div>
                            </div>
                            <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                            <a href="" class="btn btn-primary">Kembali</a>
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
    <script src="assets/js/jquery-3.6.0.min.js"></script>
</body>

</html>