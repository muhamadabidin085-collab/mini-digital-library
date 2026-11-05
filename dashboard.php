<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
include 'config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Mini Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-header text-white fw-bold text-decoration-none fs-5" href="#">Mini Digital Library</a>
            <div>
                <span class="text-white me-3">Halo, <b><?= htmlspecialchars($_SESSION['username']); ?></b></span>
                <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Daftar Koleksi Buku</h3>
            <a href="tambah_buku.php" class="btn btn-primary">+ Tambah Buku Baru</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-secondary">
                            <tr>
                                <th>No</th>
                                <th>Sampul</th>
                                <th>Judul Buku</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Tahun</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                        $no = 1;
                        while ($buku = mysqli_fetch_assoc($query)): 
                            // Logika Ketersediaan Stok
                            if ($buku['stok'] > 0) {
                                $status = '<span class="badge bg-success">Tersedia</span>';
                            } else {
                                $status = '<span class="badge bg-danger">Dipinjam</span>';
                            }

                            // Logika Penampilan Gambar (Online URL / File Lokal / Default Placeholder)
                            $gambar = $buku['sampul'];
                            if (filter_var($gambar, FILTER_VALIDATE_URL)) {
                                // Jika kolom 'sampul' di database berisi URL Link Gambar Online
                                $src_gambar = $gambar;
                            } elseif (!empty($gambar) && file_exists("uploads/" . $gambar)) {
                                // Jika file ada di folder uploads/
                                $src_gambar = "uploads/" . $gambar;
                            } else {
                                // Jika kosong, pakai gambar placeholder otomatis (via via.placeholder.com)
                                $src_gambar = "https://via.placeholder.com/150x200/1e293b/ffffff?text=" . urlencode($buku['judul']);
                            }
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <img src="<?= $src_gambar; ?>" width="50" height="70"
                                        class="rounded object-fit-cover shadow-sm" alt="Sampul Buku">
                                </td>
                                <td class="fw-bold"><?= htmlspecialchars($buku['judul']); ?></td>
                                <td><?= htmlspecialchars($buku['kategori']); ?></td>
                                <td><?= htmlspecialchars($buku['penulis']); ?></td>
                                <td><?= $buku['tahun_terbit']; ?></td>
                                <td><?= $buku['stok']; ?></td>
                                <td><?= $status; ?></td>
                                <td class="text-center">
                                    <a href="edit_buku.php?id=<?= $buku['id']; ?>"
                                        class="btn btn-warning btn-sm me-1">Edit</a>
                                    <a href="hapus_buku.php?id=<?= $buku['id']; ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if (mysqli_num_rows($query) == 0): ?>
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">Belum ada data buku.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>