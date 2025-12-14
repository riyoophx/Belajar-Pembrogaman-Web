<?php
session_start();
require 'config/koneksi.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = mysqli_prepare($conn, "SELECT id, password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $hash);
    if (mysqli_stmt_fetch($stmt)) {
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            $message = 'Login gagal: password salah.';
        }
    } else {
        $message = 'Login gagal: user tidak ditemukan.';
    }
    mysqli_stmt_close($stmt);
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login - projek_uas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Login</h4>
                    <?php if ($message): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label>Username</label>
                            <input name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" required>
                        </div>
                        <button class="btn btn-primary">Login</button>
                        <a href="register.php" class="btn btn-link">Register</a>
                    </form>
                    <hr>
                    <p class="small text-muted">Default admin: admin / admin123</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
