<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
include 'config/koneksi.php';

$judul        = $_POST['judul'];
$kategori     = $_POST['kategori'];
$penulis      = $_POST['penulis'];
$tahun_terbit = $_POST['tahun_terbit'];
$stok         = $_POST['stok'];

$filename = $_FILES['sampul']['name'];
$filesize = $_FILES['sampul']['size'];
$filetmp  = $_FILES['sampul']['tmp_name'];

$ext_izinkan = array('png', 'jpg', 'jpeg');
$x = explode('.', $filename);
$ekstensi = strtolower(end($x));

if (!in_array($ekstensi, $ext_izinkan)) {
    echo "<script>alert('Ekstensi gambar hanya diperbolehkan .jpg dan .png!'); window.location='tambah_buku.php';</script>";
    exit;
}

if ($filesize > 2097152) {
    echo "<script>alert('Ukuran file gambar maksimal 2MB!'); window.location='tambah_buku.php';</script>";
    exit;
}

$nama_baru = time() . '_' . $filename;
move_uploaded_file($filetmp, 'uploads/' . $nama_baru);

$query = "INSERT INTO buku (judul, kategori, penulis, tahun_terbit, stok, sampul) 
          VALUES ('$judul', '$kategori', '$penulis', '$tahun_terbit', '$stok', '$nama_baru')";
mysqli_query($koneksi, $query);

header("Location: dashboard.php");
?>