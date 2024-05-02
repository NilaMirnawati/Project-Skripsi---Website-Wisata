<?php
session_start(); 
include 'koneksi.php';

if (isset($_POST['cari']) && !empty($_POST['cari'])) {
    $cari = $_POST['cari'];
    $cari = $conn->real_escape_string($cari);
    $searchTerm = "%" . $cari . "%";

    $stmt = $conn->prepare('SELECT * FROM wisata WHERE nama LIKE ?');
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resultsArray = [];
        while ($row = $result->fetch_assoc()) {
            $resultsArray[] = $row;
        }
        
        $_SESSION['search_results'] = $resultsArray; // Store the results in session
        header("Location: ../hasil.php"); // Redirect to results page
        exit(); // Don't forget to call exit after header
    } else {
        $_SESSION['search_results'] = []; // Store an empty array if no results
        header("Location: ../hasil.php");
        exit();
    }
    $stmt->close();
} else {
    echo "Gagal";
}

$conn->close();
?>