<?php
session_start();
include '../koneksi.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
}

$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password'];
$level = $_POST['level'];

$sql = "UPDATE user SET email = ?, role = ?, username = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $email, $level, $nama, $id);



if (isset($password)) {
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $update = "UPDATE user SET email = ?, role = ?, username = ?, password = ?  WHERE id = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssssi", $email, $level, $nama,$password_hashed, $id);
    $stmt->execute();
}

if ($stmt->execute()) {
    $_SESSION['sukses'] = 'User Berhasil Dirubah';
    header("Location: {$_SERVER['HTTP_REFERER']}");
} else {
    $_SESSION['error'] = 'User Gagal Dirubah';
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
