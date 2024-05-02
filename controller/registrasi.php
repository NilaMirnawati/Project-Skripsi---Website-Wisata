<?php
session_start();
include 'koneksi.php';
$email = $_POST['email'];
$password = $_POST['password'];
$confpass = $_POST['confpass'];
// var_dump($email,$password,$confpass);

if ($stmt = $conn->prepare('SELECT id FROM user WHERE email = ?')) {
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = 'Email Sudah Ada';
        header('Location: ../loginform.php');
    } else {
        if ($confpass === $password) {

            if ($stmt = $conn->prepare('INSERT INTO user (email, password, role) VALUES (?, ?, ?)')) {
                $role = 'user';
                $password_hashed = password_hash($password, PASSWORD_DEFAULT);
                $stmt->bind_param('sss', $email, $password_hashed, $role);
                $stmt->execute();
                $_SESSION['sukses'] = 'Registrasi Berhasil';
                header('Location: ../loginform.php');
            } else {
                $_SESSION['error'] = 'Registrasi Gagal';
                header('Location: ../loginform.php');
            }
        } else {
            $_SESSION['error'] = 'Password Tidak Sama';
            header('Location: ../loginform.php');
        }
    }
    $stmt->close();
} else {
    $_SESSION['error'] = 'Gagal';
    header('Location: ../loginform.php');
}
$conn->close();
