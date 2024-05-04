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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Tuban Explore</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <header class="navbar sticky-top navbar-expand-lg navbar-light shadow-sm main-nav">

        <div class="container">
          <a class="navbar-brand" href="index.html"><img src="assetS/img/logo-1.png" class="main-logo"/></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto py-3">
          <a class="nav-link px-3" aria-current="page" href="index.php">Home</a>
          <a class="nav-link ps-3" href="wisata.php">Wisata</a>
          <a class="nav-link ps-3" href="checkcuaca.php">Check Cuaca</a>
          <a class="nav-link active ps-3" href="aboutus.php">About us</a>
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
      <section class="main-biru">
          <div class="container py-5">
              <div class="text-center"><h1>ABOUT US</h1></div>
          </div>

      </section>
      <section class="container py-5">
          <div class="row">
              <div class="col-lg-8 mx-auto">
                  <p><img src="assets/img/logo-1.png" class="w-50 border px-3 py-3 rounded mx-3 my-3" align="left"> website ini menyediakan tentang berbagai informasi menarik mengenai wisata-wisata yang ada di tuban . untuk memudahkan para wisatawan untuk berwisata dan memilih tempat yang cocok serta menarik </p>
                  
                  
                  <h3>GASKEUNNNN!!!</h3>
              </div>
          </div>
      </section>
      <section class="footer" data-aos="fade-up"data-aos-duration="1000">

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