<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: ../login.php'); exit; }
require '../config/koneksi.php';
$id = intval($_GET['id'] ?? 0);
$message = '';

$stmt = mysqli_prepare($conn, "SELECT id, nama_kategori FROM kategori WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$cat = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);
if (!$cat) die('Kategori tidak ditemukan.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama_kategori']);
    if ($nama !== '') {
        $stmt = mysqli_prepare($conn, "UPDATE kategori SET nama_kategori=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, 'si', $nama, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: index.php');
        exit;
    } else {
        $message = 'Nama kategori tidak boleh kosong.';
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Edit Kategori</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
<div class="container py-4">
    <h3>Edit Kategori</h3>
    <?php if ($message): ?><div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label>Nama Kategori</label>
            <input name="nama_kategori" class="form-control" value="<?php echo htmlspecialchars($cat['nama_kategori']); ?>">
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
