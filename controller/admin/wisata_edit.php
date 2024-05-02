<?php
session_start();
include '../koneksi.php';

$nama = $_POST['nama'];
$htm = $_POST['htm'];
$deskripsi = $_POST['deskripsi'];
$fasilitas = $_POST['fasilitas'];
$alamat = $_POST['alamat'];
$lokasi = $_POST['lokasi'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$jam_buka = $_POST['jam_buka'];
$jam_tutup = $_POST['jam_tutup'];
$hari_buka = $_POST['hari'];
$gambar = $_FILES['image']['name'];
$targetDir = "../../image/wisata/";
// var_dump($nama, $htm, $deskripsi, $fasilitas, $alamat, $latitude, $longitude, $jam_buka, $jam_tutup, $hari_buka, $gambar)

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($gambar) && !empty($gambar)) {
        $sql = "UPDATE wisata SET gambar = '$gambar' WHERE id = $id ";
        $targetFile = $targetDir . basename($gambar);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
        $conn->query($sql);
    }

    $query = "UPDATE wisata SET nama = '$nama', deskripsi = '$deskripsi', alamat = '$alamat',
      lokasi = '$lokasi', jam_buka = '$jam_buka', jam_tutup = '$jam_tutup', 
        hari = '$hari_buka', fasilitas = '$fasilitas', htm = '$htm' WHERE id = $id ";

    if ($conn->query($query) === TRUE) {
        $_SESSION['sukses'] = 'Wisata Berhasil Diubah';
        // header("Location: {$_SERVER['HTTP_REFERER']}");
        header('Location: ../../admin/data-wisata.php');
        exit();
    } else {
        // $_SESSION['error'] = 'Wisata Gagal Diubah';
        // header("Location: {$_SERVER['HTTP_REFERER']}");
        echo "Error updating record: " . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
}
