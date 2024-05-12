<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wisata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("koneksi gagal. " . $conn->connect_error);
}
// $stmt = $conn->prepare($sql);
// if (!$stmt) {
//     die("Error saat menyiapkan pernyataan SQL: " . $conn->error);
// }
// echo "koneksi berhasil";

