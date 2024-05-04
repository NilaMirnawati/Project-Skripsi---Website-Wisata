<?php
session_start();
include '../koneksi.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $slider = 1;
    $sql = "UPDATE wisata SET slider = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $slider, $id);
    // $stmt->execute();

    if ($stmt->execute()) {
        $_SESSION['sukses'] = 'Wisata Ditambahkan ke Halaman Depan';
        header('Location: ../../admin/data-wisata.php');
        exit();
    } else {
        $_SESSION['error'] = 'Wisata Gagal Ditambahkan ke Halaman Depan';
        header('Location: ../../admin/data-wisata.php');
    }


} else {
    $_SESSION['error'] = 'Gagal';
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

// Tutup koneksi database
$conn->close();
