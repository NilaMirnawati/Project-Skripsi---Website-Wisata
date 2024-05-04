<?php
session_start();
include '../koneksi.php';

$id = $_POST['id'];
$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['name'];
// $level = $_POST['level'];

// var_dump($email, $password, $id, $username);
$update = "UPDATE user SET email = ?, password = ?, username = ? WHERE id = ?";
$stmt = $conn->prepare($update);
if ($stmt === false) {
    // Error handling
    die('MySQL prepare error: ' . $conn->error);
}

$password_hashed = password_hash($password, PASSWORD_DEFAULT);
$stmt->bind_param("sssi", $email, $password_hashed, $username, $id);

if ($stmt->execute()) {
    $_SESSION['sukses'] = 'Profil Berhasil Dirubah';
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit; // Don't forget to call exit after headers are sent.
} else {
    $_SESSION['error'] = 'Profil Gagal Dirubah';
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit; // Don't forget to call exit after headers are sent.
}
