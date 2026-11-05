<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Mini Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h4 class="text-center fw-bold mb-3">Buat Akun Baru</h4>

                        <?php if (isset($_GET['pesan'])): ?>
                        <?php if ($_GET['pesan'] == 'username_ada'): ?>
                        <div class="alert alert-danger py-2 fs-6">Username sudah terdaftar!</div>
                        <?php elseif ($_GET['pesan'] == 'password_beda'): ?>
                        <div class="alert alert-danger py-2 fs-6">Konfirmasi password tidak cocok!</div>
                        <?php endif; ?>
                        <?php endif; ?>

                        <form action="proses_register.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100 rounded-3 mb-3">Daftar Sekarang</button>
                        </form>
                        <div class="text-center">
                            <small>Sudah punya akun? <a href="index.php">Login di sini</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>