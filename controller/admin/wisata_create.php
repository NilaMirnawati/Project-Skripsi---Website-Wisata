<?php
session_start();
include '../koneksi.php';

$nama = $_POST['nama'];
$htm = $_POST['htm'];
$deskripsi = $_POST['deskripsi'];
$deskripsi_singkat = $_POST['deskripsi_singkat'];
$fasilitas = $_POST['fasilitas'];
$alamat = $_POST['alamat'];
// $latitude = $_POST['latitude'];
// $longitude = $_POST['longitude'];
$lokasi = $_POST['lokasi'];
$jam_buka = $_POST['jam_buka'];
$jam_tutup = $_POST['jam_tutup'];
$hari_buka = $_POST['hari'];
$gambar = $_FILES['gambar']['name'];
$targetDir = "../../image/wisata/";
// var_dump($nama, $htm, $deskripsi, $fasilitas, $alamat, $latitude, $longitude, $jam_buka, $jam_tutup, $hari_buka, $gambar)

$sql = "INSERT INTO wisata (nama, deskripsi, deskripsi_singkat, alamat,lokasi, jam_buka, jam_tutup, hari, fasilitas, htm, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssis", $nama, $deskripsi, $deskripsi_singkat, $alamat, $lokasi ,$jam_buka, $jam_tutup, $hari_buka, $fasilitas, $htm, $gambar);
$targetFile = $targetDir . basename($gambar);
// echo "Error updating record: " . $conn->error;
if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
    // File berhasil diunggah, lanjutkan dengan eksekusi query SQL
    if ($stmt->execute()) {
        $_SESSION['sukses'] = 'Wisata Berhasil Ditambah';
        // header("Location: {$_SERVER['HTTP_REFERER']}");
        header('Location: ../../admin/data-wisata.php');
    } else {
        $_SESSION['error'] = 'Wisata Gagal Ditambah';
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
} else {
    $_SESSION['error'] = 'Gagal mengunggah gambar';
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
