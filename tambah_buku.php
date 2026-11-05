<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: index.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="mb-4">Tambah Buku Baru</h4>
            <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah Stok</label>
                        <input type="number" name="stok" class="form-control" min="0" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sampul Buku (.jpg / .png, Max 2MB)</label>
                    <input type="file" name="sampul" class="form-control" accept=".jpg,.jpeg,.png" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="dashboard.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>