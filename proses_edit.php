<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
include 'config/koneksi.php';

$id           = $_POST['id'];
$judul        = $_POST['judul'];
$kategori     = $_POST['kategori'];
$penulis      = $_POST['penulis'];
$tahun_terbit = $_POST['tahun_terbit'];
$stok         = $_POST['stok'];

$filename = $_FILES['sampul']['name'];

if ($filename != "") {
    $filesize = $_FILES['sampul']['size'];
    $filetmp  = $_FILES['sampul']['tmp_name'];

    $ext_izinkan = array('png', 'jpg', 'jpeg');
    $x = explode('.', $filename);
    $ekstensi = strtolower(end($x));

    if (!in_array($ekstensi, $ext_izinkan)) {
        echo "<script>alert('Ekstensi gambar hanya diperbolehkan .jpg dan .png!'); window.location='edit_buku.php?id=$id';</script>";
        exit;
    }

    if ($filesize > 2097152) {
        echo "<script>alert('Ukuran file gambar maksimal 2MB!'); window.location='edit_buku.php?id=$id';</script>";
        exit;
    }

    $data_lama = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT sampul FROM buku WHERE id='$id'"));
    if ($data_lama['sampul'] && file_exists('uploads/' . $data_lama['sampul'])) {
        unlink('uploads/' . $data_lama['sampul']);
    }

    $nama_baru = time() . '_' . $filename;
    move_uploaded_file($filetmp, 'uploads/' . $nama_baru);

    $query = "UPDATE buku SET judul='$judul', kategori='$kategori', penulis='$penulis', 
              tahun_terbit='$tahun_terbit', stok='$stok', sampul='$nama_baru' WHERE id='$id'";
} else {
    $query = "UPDATE buku SET judul='$judul', kategori='$kategori', penulis='$penulis', 
              tahun_terbit='$tahun_terbit', stok='$stok' WHERE id='$id'";
}

mysqli_query($koneksi, $query);
header("Location: dashboard.php");
?>