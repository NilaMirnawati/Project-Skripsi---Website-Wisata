<?php
session_start();
include '../koneksi.php';

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$level = $_POST['level'];

$sql = "INSERT INTO user (email, password, role, username) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$password_hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt->bind_param("ssss", $email, $password_hashed, $level, $nama);

if ($stmt->execute()) {
    $_SESSION['sukses'] = 'User Berhasil Ditambah';
    header("Location: {$_SERVER['HTTP_REFERER']}");
} else {
    $_SESSION['error'] = 'User Gagal Ditambah';
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
// 
