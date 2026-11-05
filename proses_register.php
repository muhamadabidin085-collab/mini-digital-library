<?php
include 'config/koneksi.php';

$username         = mysqli_real_escape_string($koneksi, $_POST['username']);
$password         = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// 1. Cek apakah konfirmasi password cocok
if ($password !== $confirm_password) {
    header("Location: register.php?pesan=password_beda");
    exit;
}

// 2. Cek apakah username sudah pernah dipakai
$cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
if (mysqli_num_rows($cek_user) > 0) {
    header("Location: register.php?pesan=username_ada");
    exit;
}

// 3. Enkripsi password menggunakan password_hash (aman)
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// 4. Simpan ke database MySQL
$query = "INSERT INTO users (username, password) VALUES ('$username', '$password_hashed')";
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Gagal mendaftar!'); window.location='register.php';</script>";
}
?>