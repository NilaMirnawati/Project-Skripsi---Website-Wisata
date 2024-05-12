<?php
session_start();
include '../koneksi.php';

echo 'post_max_size: ' . ini_get('post_max_size');


// if (isset($_POST['nama'], $_POST['htm'], $_POST['deskripsi'], $_POST['deskripsi_singkat'], $_POST['fasilitas'], $_POST['alamat'], $_POST['place_id'], $_POST['jam_buka'], $_POST['jam_tutup'], $_POST['hari'], $_FILES['gambar']['name'], $_FILES['slide1']['name'], $_FILES['slide2']['name'], $_FILES['slide3']['name'], $_FILES['video']['name'])) {
$nama = $_POST['nama'];
$htm = $_POST['htm'];
$deskripsi = $_POST['deskripsi'];
$deskripsi_singkat = $_POST['deskripsi_singkat'];
$fasilitas = $_POST['fasilitas'];
$alamat = $_POST['alamat'];
$place_id = $_POST['place_id'];
$jam_buka = $_POST['jam_buka'];
$jam_tutup = $_POST['jam_tutup'];
$hari_buka = $_POST['hari'];

$gambar = generateRandomFileName($_FILES['gambar']['name']);
$slide1 = generateRandomFileName($_FILES['slide1']['name']);
$slide2 = generateRandomFileName($_FILES['slide2']['name']);
$slide3 = generateRandomFileName($_FILES['slide3']['name']);
// $video = generateRandomFileName($_FILES['video']['name']);
// var_dump($nama, $htm, $deskripsi, $deskripsi_singkat, $fasilitas, $alamat, $place_id, $jam_buka, $jam_tutup, $hari_buka,  $gambar,  $slide1,  $slide2,   $slide3, $video);

$sql = "INSERT INTO wisata (nama, deskripsi, deskripsi_singkat, alamat, place_id, jam_buka, jam_tutup, hari, fasilitas, htm, gambar, slide1, slide2, slide3) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssissss", $nama, $deskripsi, $deskripsi_singkat, $alamat, $place_id, $jam_buka, $jam_tutup, $hari_buka, $fasilitas, $htm, $gambar, $slide1, $slide2, $slide3);
if (!$stmt) {
    die('erororrr: ' . $conn->error);
}

$imageDir = "../../image/wisata/";
$slideDir = "../../image/detail/";
$videoDir = "../../video/wisata/";

move_uploaded_file($_FILES["gambar"]["tmp_name"], $imageDir . $gambar);
move_uploaded_file($_FILES["slide1"]["tmp_name"], $slideDir . $slide1);
move_uploaded_file($_FILES["slide2"]["tmp_name"], $slideDir . $slide2);
move_uploaded_file($_FILES["slide3"]["tmp_name"], $slideDir . $slide3);

if ($stmt->execute()) {
    $_SESSION['sukses'] = 'Wisata Berhasil Ditambah';
    header('Location: ../../admin/data-wisata.php');
} else {
    $_SESSION['error'] = 'Wisata Gagal Ditambah';
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
// } else {
// $_SESSION['error'] = 'Data tidak lengkap';
// header("Location: {$_SERVER['HTTP_REFERER']}");
// }

// Fungsi untuk menghasilkan nama file acak
function generateRandomFileName($originalFileName)
{
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    return uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
}
