<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
include 'config/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");
$buku = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="mb-4">Edit Data Buku</h4>
            <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $buku['id']; ?>">
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($buku['judul']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($buku['kategori']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" value="<?= htmlspecialchars($buku['penulis']); ?>" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control" value="<?= $buku['tahun_terbit']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah Stok</label>
                        <input type="number" name="stok" class="form-control" value="<?= $buku['stok']; ?>" min="0" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti Sampul Buku (Opsional, Max 2MB)</label>
                    <input type="file" name="sampul" class="form-control" accept=".jpg,.jpeg,.png">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah sampul saat ini.</small>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-warning">Update Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>