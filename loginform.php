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
  <title>Login | Tuban Explore</title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<body>
  <div class="container-fluid banner">
    <div class="container">
      <input type="checkbox" id="check">
      <div class="login form">
        <header>Login</header>
        <form action="controller/login.php" method="post">
          <input type="text" placeholder="Enter your email" name="email">
          <input type="password" placeholder="Enter your password" name="password">
          <!-- <a href="#">Forgot password?</a> -->
          <input type="submit" class="button" value="submit">
        </form>
        <div class="signup">
          <span class="signup">Don't have an account?
            <label for="check">Signup</label>
          </span>
        </div>
      </div>
      <div class="registration form">
        <header>Signup</header>
        <form action="controller/registrasi.php" method="post">
          <input type="text" placeholder="Enter your email" name="email">
          <input type="password" placeholder="Create a password" name="password">
          <input type="password" placeholder="Confirm your password" name="confpass">
          <input type="submit" class="button" value="submit">
        </form>
        <div class="signup">
          <span class="signup">Already have an account?
            <label for="check">Login</label>
          </span>
        </div>
      </div>
    </div>
</body>

</html>