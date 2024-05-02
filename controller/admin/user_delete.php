<?php
session_start();
include '../koneksi.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = $conn->real_escape_string($_GET['id']);

    $sql = "DELETE FROM user WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['sukses'] = 'User Berhasil Dihapus';
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    } else {
        $_SESSION['error'] = 'User Gagal Dihapus';
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    $conn->close();
} else {
    $_SESSION['error'] = 'Gagal';
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
