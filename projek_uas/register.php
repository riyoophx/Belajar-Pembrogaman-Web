<?php
require 'config/koneksi.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === '' || $password === '') {
        $message = 'Isi semua field.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, 'ss', $username, $hash);
        if (mysqli_stmt_execute($stmt)) {
            header('Location: login.php');
            exit;
        } else {
            $message = 'Gagal registrasi: ' . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register - Sistem Koleksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-3">Register</h4>
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
                        <button class="btn btn-success">Daftar</button>
                        <a href="login.php" class="btn btn-link">Login</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
