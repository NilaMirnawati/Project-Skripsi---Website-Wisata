<?php
session_start();
include '../koneksi.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = $conn->real_escape_string($_GET['id']);

    $sql = "DELETE FROM wisata WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['sukses'] = 'Wisata Berhasil Dihapus';
        header('Location: ../../admin/data-wisata.php');
        exit();
    } else {
        $_SESSION['error'] = 'Wisata Gagal Dihapus';
        header('Location: ../../admin/data-wisata.php');
    }

    $conn->close();
} else {
    $_SESSION['error'] = 'Gagal';
    header('Location: ../../admin/data-wisata.php');
    exit();
}
