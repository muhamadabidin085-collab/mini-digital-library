<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
include 'config/koneksi.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT sampul FROM buku WHERE id='$id'");
$buku  = mysqli_fetch_assoc($query);

if ($buku['sampul'] && file_exists("uploads/" . $buku['sampul'])) {
    unlink("uploads/" . $buku['sampul']);
}

mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");

header("Location: dashboard.php");
?>