<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
require '../config/koneksi.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $nama = trim($_POST['nama_kategori']);
    if ($nama !== '') {
        $stmt = mysqli_prepare($conn, "INSERT INTO kategori (nama_kategori) VALUES (?)");
        mysqli_stmt_bind_param($stmt, 's', $nama);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: index.php');
        exit;
    } else {
        $message = 'Nama kategori tidak boleh kosong.';
    }
}

$cats = mysqli_query($conn, "SELECT id, nama_kategori FROM kategori ORDER BY id ASC");
$cats = mysqli_fetch_all($cats, MYSQLI_ASSOC);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kelola Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3>Kelola Kategori</h3>
    <?php if ($message): ?><div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
    <form method="post" class="mb-3">
        <div class="input-group">
            <input name="nama_kategori" class="form-control" placeholder="Tambah kategori...">
            <button name="tambah" class="btn btn-primary">Tambah</button>
        </div>
    </form>
    <table class="table">
        <thead><tr><th>#</th><th>Nama</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php foreach ($cats as $c): ?>
            <tr>
                <td><?php echo $c['id']; ?></td>
                <td><?php echo htmlspecialchars($c['nama_kategori']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-secondary">Edit</a>
                    <a href="hapus.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../dashboard.php" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>
