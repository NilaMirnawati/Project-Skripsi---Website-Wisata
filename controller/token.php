<?php

namespace Midtrans;

session_start();
include 'koneksi.php';

$nama = $_POST['t_user'];
$id_user = $_POST['t_id_user'];
$phone = $_POST['t_telp'];
$tanggal = $_POST['t_tanggal'];
$id_wisata = $_POST['t_id_wisata'];
$nama_wisata = $_POST['t_wisata'];
$harga = $_POST['t_harga'];
$jumlah = $_POST['t_jumlah'];
$total = $_POST['t_total'];
// var_dump($total);

require_once dirname(__FILE__) . '/../midtrans/Midtrans.php';

// Set your Merchant Server Key
Config::$serverKey = 'SB-Mid-server-8XRCgp30kZZiZUoa_y2vKROq';
// printExampleWarningMessage();

// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
// \Midtrans\Config::$isProduction = false;
// // Set sanitization on (default)
// \Midtrans\Config::$isSanitized = true;
// // Set 3DS transaction for credit card to true
// \Midtrans\Config::$is3ds = true;

$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => $total,
);


$customer_details = array(
    'first_name'    => $nama,
    'email'         => $_SESSION['email'],

);
$item_details = array();
$item_detail = array(
    'id' => $id_wisata,
    'name' => $nama_wisata,
    'price' => $harga,
    'quantity' => $jumlah,
);
$item_details[] = $item_detail;

$params = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

// var_dump($params);
$snapToken = '';
$snapToken = Snap::getSnapToken($params);

// var_dump($nama);
$sql2 = "UPDATE user SET username = ? WHERE id = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("si", $nama, $id_user);
$stmt2->execute();

$status = 1;
$sql = "INSERT INTO tiket (id_wisata, id_user, nama_user,nama_wisata, no_telp, tanggal, jumlah, harga, total, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisssssssi", $id_wisata, $id_user, $nama, $nama_wisata, $phone, $tanggal, $jumlah, $harga, $total, $status);

if ($stmt->execute()) {
    $last_id = $conn->insert_id;
    header("Location: {$_SERVER['HTTP_REFERER']}&snaptoken=$snapToken&id_tiket=$last_id");
} else {
    $_SESSION['error'] = 'Tiket Gagal Dibeli';
    header("Location: {$_SERVER['HTTP_REFERER']}");
}


