<?php
session_start();
include '../koneksi.php';

// Mengambil data dari POST
$nama = $_POST['nama'];
$htm = $_POST['htm'];
$deskripsi = $_POST['deskripsi'];
$fasilitas = $_POST['fasilitas'];
$alamat = $_POST['alamat'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$jam_buka = $_POST['jam_buka'];
$jam_tutup = $_POST['jam_tutup'];
$hari_buka = $_POST['hari'];
$gambar = $_FILES['image']['name'];
$slide1 = $_FILES['slide1']['name'];
$slide2 = $_FILES['slide2']['name'];
$slide3 = $_FILES['slide3']['name'];

// Menentukan direktori target
$targetDir = "../../image/wisata/";
$targetDirdet = "../../image/detail/";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Persiapkan dan eksekusi statement SQL untuk gambar utama
    if (!empty($gambar)) {
        $sql = "UPDATE wisata SET gambar = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $gambar, $id);
        $targetFile = $targetDir . basename($gambar);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $stmt->execute();
        }
    }

    // Upload dan update slide images
    if (!empty($slide1) && move_uploaded_file($_FILES["slide1"]["tmp_name"], $targetDirdet . basename($slide1)) &&
        !empty($slide2) && move_uploaded_file($_FILES["slide2"]["tmp_name"], $targetDirdet . basename($slide2)) &&
        !empty($slide3) && move_uploaded_file($_FILES["slide3"]["tmp_name"], $targetDirdet . basename($slide3))) {
        $query = "UPDATE wisata SET nama = ?, deskripsi = ?, alamat = ?, latitude = ?, longitude = ?, jam_buka = ?, jam_tutup = ?, hari = ?, fasilitas = ?, htm = ?, slide1 = ?, slide2 = ?, slide3 = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssssssssi", $nama, $deskripsi, $alamat, $latitude, $longitude, $jam_buka, $jam_tutup, $hari_buka, $fasilitas, $htm, $slide1, $slide2, $slide3, $id);
        if ($stmt->execute()) {
            $_SESSION['sukses'] = 'Wisata Berhasil Diubah';
            header('Location: ../../admin/data-wisata.php');
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    } else {
        $_SESSION['error'] = 'Gagal mengunggah gambar';
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    // Tutup koneksi database
    $conn->close();
}
?>
