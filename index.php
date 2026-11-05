<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

$remember_user = isset($_COOKIE['remember_username']) ? $_COOKIE['remember_username'] : '';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mini Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h4 class="text-center fw-bold mb-3">Library Login</h4>

                        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
                        <div class="alert alert-danger py-2 fs-6">Username atau Password salah!</div>
                        <?php endif; ?>

                        <form action="proses_login.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control"
                                    value="<?= htmlspecialchars($remember_user); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember"
                                    <?= $remember_user ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-3">Masuk</button>
                            <!-- Tambahkan ini tepat di bawah tombol submit login -->
                            <div class="text-center mt-3">
                                <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>