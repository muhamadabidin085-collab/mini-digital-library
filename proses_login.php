<?php
session_start();
include 'config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];
$remember = isset($_POST['remember']);

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$user  = mysqli_fetch_assoc($query);

if ($user && (password_verify($password, $user['password']) || $password === $user['password'])) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $user['username'];

    if ($remember) {
        setcookie('remember_username', $username, time() + (86400 * 7), "/");
    } else {
        setcookie('remember_username', '', time() - 3600, "/");
    }

    header("Location: dashboard.php");
} else {
    header("Location: index.php?pesan=gagal");
}
?>