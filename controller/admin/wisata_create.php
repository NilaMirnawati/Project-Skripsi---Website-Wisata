<?php
session_start();
include '../koneksi.php';

// Periksa apakah semua variabel POST tersedia
if (isset($_POST['nama'], $_POST['htm'], $_POST['deskripsi'], $_POST['deskripsi_singkat'], $_POST['fasilitas'], $_POST['alamat'], $_POST['latitude'], $_POST['longitude'], $_POST['jam_buka'], $_POST['jam_tutup'], $_POST['hari'], $_FILES['gambar']['name'], $_FILES['slide1']['name'], $_FILES['slide2']['name'], $_FILES['slide3']['name'])) {

    // Tangkap data dari form
    $nama = $_POST['nama'];
    $htm = $_POST['htm'];
    $deskripsi = $_POST['deskripsi'];
    $deskripsi_singkat = $_POST['deskripsi_singkat'];
    $fasilitas = $_POST['fasilitas'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $jam_buka = $_POST['jam_buka'];
    $jam_tutup = $_POST['jam_tutup'];
    $hari_buka = $_POST['hari'];
    $gambar = $_FILES['gambar']['name'];
    $slide1 = $_FILES['slide1']['name'];
    $slide2 = $_FILES['slide2']['name'];
    $slide3 = $_FILES['slide3']['name'];

    // Persiapkan statement SQL
    $sql = "INSERT INTO wisata (nama, deskripsi, deskripsi_singkat, alamat, latitude, longitude, jam_buka, jam_tutup, hari, fasilitas, htm, gambar, slide1, slide2, slide3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssissss", $nama, $deskripsi, $deskripsi_singkat, $alamat, $latitude, $longitude, $jam_buka, $jam_tutup, $hari_buka, $fasilitas, $htm, $gambar, $slide1, $slide2, $slide3);

    // Pindahkan file ke folder target
    $targetDir = "../../image/wisata/";
    $targetFile = $targetDir . basename($gambar);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile);

    $targetDirdet = "../../image/detail/";
    $targetFileslide1 = $targetDirdet . basename($slide1);
    $targetFileslide2 = $targetDirdet . basename($slide2);
    $targetFileslide3 = $targetDirdet . basename($slide3);
    move_uploaded_file($_FILES["slide1"]["tmp_name"], $targetFileslide1);
    move_uploaded_file($_FILES["slide2"]["tmp_name"], $targetFileslide2);
    move_uploaded_file($_FILES["slide3"]["tmp_name"], $targetFileslide3);

    // Eksekusi query SQL dan cek keberhasilan
    if ($stmt->execute()) {
        $_SESSION['sukses'] = 'Wisata Berhasil Ditambah';
        header('Location: ../../admin/data-wisata.php');
    } else {
        $_SESSION['error'] = 'Wisata Gagal Ditambah';
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
} else {
    // Jika ada data yang hilang, kembali ke halaman sebelumnya
    $_SESSION['error'] = 'Data tidak lengkap';
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
?>
