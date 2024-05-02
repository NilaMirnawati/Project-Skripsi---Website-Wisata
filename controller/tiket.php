<?php
session_start();
include 'koneksi.php';

$id_tiket = $_POST['id_tiket'];

$update = "UPDATE tiket SET status = 2 WHERE id = $id_tiket";
$conn->query($update);
$_SESSION['sukses'] = 'Tiket Berhasil Dibeli';
header("Location: ../invoice.php?id_tiket=$id_tiket");

