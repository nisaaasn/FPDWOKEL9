<?php
// mengaktifkan session php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Cek apakah username dan password adalah "admin"
if ($username === "admin" && $password === "admin") {
    $_SESSION['username'] = $username;
    header("location: dashboard.php");
} else {
    header("location: index.php?pesan=gagal");
}
?>
