<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
require '../config/koneksi.php';
$message = '';

$id = intval($_GET['id'] ?? 0);
$user_id = $_SESSION['user_id'];

// fetch item
$stmt = mysqli_prepare($conn, "SELECT id, nama_item, deskripsi, tanggal_masuk, foto, kategori_id FROM koleksi WHERE id = ? AND user_id = ?");
mysqli_stmt_bind_param($stmt, 'ii', $id, $user_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$item = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$item) {
    die('Item tidak ditemukan atau bukan milik Anda.');
}

$catRes = mysqli_query($conn, "SELECT id, nama_kategori FROM kategori ORDER BY nama_kategori");
$categories = mysqli_fetch_all($catRes, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_item'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal_masuk'];
    $kategori_id = $_POST['kategori_id'] ? intval($_POST['kategori_id']) : null;
    $foto_name = $item['foto'];

    // handle upload
    if (!empty($_FILES['foto']['name'])) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','gif'];
        if (!in_array(strtolower($ext), $allowed)) {
            $message = 'Ekstensi file tidak diperbolehkan.';
        } else {
            $foto_name = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '_', $_FILES['foto']['name']);
            $target = __DIR__ . '/../upload/' . $foto_name;
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
                $message = 'Gagal mengunggah foto.';
            } else {
                // remove old file
                if ($item['foto'] && file_exists(__DIR__.'/../upload/'.$item['foto'])) {
                    @unlink(__DIR__.'/../upload/'.$item['foto']);
                }
            }
        }
    }

    if ($message === '') {
        $stmt = mysqli_prepare($conn, "UPDATE koleksi SET nama_item=?, deskripsi=?, tanggal_masuk=?, foto=?, kategori_id=? WHERE id=? AND user_id=?");
        mysqli_stmt_bind_param($stmt, 'ssssiii', $nama, $deskripsi, $tanggal, $foto_name, $kategori_id, $id, $user_id);
        if (mysqli_stmt_execute($stmt)) {
            header('Location: ../dashboard.php');
            exit;
        } else {
            $message = 'Gagal update: ' . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Koleksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3>Edit Koleksi</h3>
    <?php if ($message): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama Item</label>
            <input name="nama_item" class="form-control" value="<?php echo htmlspecialchars($item['nama_item']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?php echo htmlspecialchars($item['deskripsi']); ?></textarea>
        </div>
        <div class="mb-3">
            <label>Tanggal Masuk</label>
            <input name="tanggal_masuk" type="date" class="form-control" value="<?php echo htmlspecialchars($item['tanggal_masuk']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control">
                <option value="">-- Pilih --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php if ($cat['id']==$item['kategori_id']) echo 'selected'; ?>><?php echo htmlspecialchars($cat['nama_kategori']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Foto (kosongkan jika tidak ingin mengganti)</label>
            <input name="foto" type="file" class="form-control">
            <?php if ($item['foto']): ?>
                <div class="mt-2"><img src="../upload/<?php echo htmlspecialchars($item['foto']); ?>" style="height:120px; object-fit:cover;"></div>
            <?php endif; ?>
        </div>
        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="../dashboard.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
