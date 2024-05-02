<?php
include 'koneksi.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nama'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                $_SESSION['sukses'] = 'Login Berhasil';
                header("Location: ../admin/dashboard.php");
                // var_dump(true);
            } else {
                $_SESSION['sukses'] = 'Login Berhasil';
                header("Location: ../index.php");
                // var_dump(true);
            }
            // var_dump(true);
            exit();
        } else {
            $_SESSION['error'] = 'Invalid username or password';
            header("Location: ../loginform.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 'Invalid username or password';
        header("Location: ../loginform.php");
        exit();
    }
}

