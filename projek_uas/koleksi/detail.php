<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
require '../config/koneksi.php';
$id = intval($_GET['id'] ?? 0);
$user_id = $_SESSION['user_id'];

$stmt = mysqli_prepare($conn, "SELECT k.*, cat.nama_kategori, u.username FROM koleksi k LEFT JOIN kategori cat ON k.kategori_id=cat.id LEFT JOIN users u ON k.user_id=u.id WHERE k.id=? AND k.user_id=?");
mysqli_stmt_bind_param($stmt, 'ii', $id, $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$item = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$item) {
    die('Item tidak ditemukan atau bukan milik Anda.');
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detail Koleksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3><?php echo htmlspecialchars($item['nama_item']); ?></h3>
    <?php if ($item['foto']): ?>
        <img src="../upload/<?php echo htmlspecialchars($item['foto']); ?>" style="max-width:400px; display:block;">
    <?php endif; ?>
    <p><strong>Kategori:</strong> <?php echo htmlspecialchars($item['nama_kategori']); ?></p>
    <p><strong>Tanggal Masuk:</strong> <?php echo htmlspecialchars($item['tanggal_masuk']); ?></p>
    <p><strong>Deskripsi:</strong><br><?php echo nl2br(htmlspecialchars($item['deskripsi'])); ?></p>
    <a href="../dashboard.php" class="btn btn-secondary">Kembali</a>
</div>
</body>
</html>
