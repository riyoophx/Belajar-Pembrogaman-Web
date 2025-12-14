<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

require '../config/koneksi.php';
$message = '';

// Ambil kategori
$catRes = mysqli_query($conn, "SELECT id, nama_kategori FROM kategori ORDER BY nama_kategori");
$categories = mysqli_fetch_all($catRes, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_item'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal_masuk'];
    $kategori_id = $_POST['kategori_id'] ? intval($_POST['kategori_id']) : null;
    $user_id = $_SESSION['user_id'];
    $foto_name = null;

    // Upload Foto
    if (!empty($_FILES['foto']['name'])) {
        $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array(strtolower($ext), $allowed)) {
            $message = 'Ekstensi file tidak diperbolehkan.';
        } else {
            $foto_name = time() . '' . preg_replace('/[^A-Za-z0-9.-]/', '_', $_FILES['foto']['name']);
            $target = __DIR__ . '/../upload/' . $foto_name;

            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
                $message = 'Gagal mengunggah foto.';
            }
        }
    }

    if ($message === '') {
        $stmt = mysqli_prepare($conn, "INSERT INTO koleksi (nama_item, deskripsi, tanggal_masuk, foto, kategori_id, user_id) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssssii', $nama, $deskripsi, $tanggal, $foto_name, $kategori_id, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            header('Location: ../dashboard.php');
            exit;
        } else {
            $message = 'Gagal menyimpan: ' . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah Koleksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h3>Tambah Koleksi</h3>

    <?php if ($message): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label>Nama Item</label>
            <input name="nama_item" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Tanggal Masuk</label>
            <input name="tanggal_masuk" type="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nama_kategori']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Foto (jpg/png)</label>
            <input name="foto" type="file" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="../dashboard.php" class="btn btn-secondary">Batal</a>

    </form>
</div>
</body>
</html>