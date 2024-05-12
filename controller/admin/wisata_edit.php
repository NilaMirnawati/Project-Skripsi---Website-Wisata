<?php
session_start();
include '../koneksi.php';

if (isset($_POST['id_wisata'], $_POST['nama'], $_POST['htm'], $_POST['deskripsi'], $_POST['deskripsi_singkat'], $_POST['fasilitas'], $_POST['alamat'], $_POST['place_id'], $_POST['jam_buka'], $_POST['jam_tutup'], $_POST['hari'])) {

    $id = $_POST['id_wisata'];
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

    $gambar = generateRandomFileName($_FILES['image']['name']);
    $slide1 = generateRandomFileName($_FILES['slide1']['name']);
    $slide2 = generateRandomFileName($_FILES['slide2']['name']);
    $slide3 = generateRandomFileName($_FILES['slide3']['name']);

    if (!empty($gambar)) {
        $sql1 = "UPDATE wisata SET gambar = ? WHERE id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("si", $gambar, $id);
        $imageDir = "../../image/wisata/";
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $imageDir . $gambar)) {
            $stmt1->execute();
        }
    }
    if (!empty($slide1)) {
        $sql2 = "UPDATE wisata SET slide1 = ? WHERE id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("si", $slide1, $id);
        $slideDir = "../../image/detail/";
        if (move_uploaded_file($_FILES["slide1"]["tmp_name"], $slideDir . $slide1)) {
            $stmt2->execute();
        }
    }
    if (!empty($slide2)) {
        $sql3 = "UPDATE wisata SET slide2 = ? WHERE id = ?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("si", $slide2, $id);
        $slideDir = "../../image/detail/";
        if (move_uploaded_file($_FILES["slide2"]["tmp_name"], $slideDir . $slide2)) {
            $stmt3->execute();
        }
    }
    if (!empty($slide3)) {
        $sql4 = "UPDATE wisata SET slide3 = ? WHERE id = ?";
        $stmt4 = $conn->prepare($sql4);
        $stmt4->bind_param("si", $slide3, $id);
        $slideDir = "../../image/detail/";
        if (move_uploaded_file($_FILES["slide3"]["tmp_name"], $slideDir . $slide3)) {
            $stmt4->execute();
        }
    }

    $sql = "UPDATE wisata SET nama=?, deskripsi=?, deskripsi_singkat=?, alamat=?, place_id=?, jam_buka=?, jam_tutup=?, hari=?, fasilitas=?, htm=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die('Error: ' . $conn->error); 
    }

    $stmt->bind_param("sssssssssii", $nama, $deskripsi, $deskripsi_singkat, $alamat, $place_id, $jam_buka, $jam_tutup, $hari_buka, $fasilitas, $htm, $id);


    if ($stmt->execute()) {
        $_SESSION['sukses'] = 'Wisata Berhasil Diperbarui';
        header('Location: ../../admin/data-wisata.php');
    } else {
        $_SESSION['error'] = 'Wisata Gagal Diperbarui';
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
} else {
    $_SESSION['error'] = 'Data tidak lengkap';
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

function generateRandomFileName($originalFileName)
{
    $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    return uniqid() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
}
