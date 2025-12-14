<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'config/koneksi.php';
$user_id = $_SESSION['user_id'];

// FILTER KATEGORI
$where = "WHERE k.user_id = ?";
$params = [$user_id];
$types = "i";

$filterKategori = "";
if (isset($_GET['kategori_id'])) {
    $kategori_id = intval($_GET['kategori_id']);
    $where .= " AND k.kategori_id = ?";
    $params[] = $kategori_id;
    $types .= "i";

    // untuk tampilan judul saat filter
    $getCat = mysqli_query($conn, "SELECT nama_kategori FROM kategori WHERE id = $kategori_id");
    $rowCat = mysqli_fetch_assoc($getCat);
    $filterKategori = $rowCat['nama_kategori'] ?? "";
}

// Query koleksi + filter
$sql = "SELECT k.id, k.nama_item, k.tanggal_masuk, k.foto, cat.nama_kategori 
        FROM koleksi k 
        LEFT JOIN kategori cat ON k.kategori_id = cat.id
        $where
        ORDER BY k.tanggal_masuk DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$collections = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

// Fetch kategori untuk tombol filter
$catRes = mysqli_query($conn, "SELECT id, nama_kategori FROM kategori ORDER BY nama_kategori");
$categories = mysqli_fetch_all($catRes, MYSQLI_ASSOC);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard - Memory Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php">projek_uas</a>
    <div class="d-flex">
      <a href="kategori/index.php" class="btn btn-outline-secondary me-2">Kelola Kategori</a>
      <a href="dashboard.php" class="btn btn-outline-dark me-2">Semua Koleksi</a>
      <a href="koleksi/tambah.php" class="btn btn-primary me-2">Tambah Koleksi</a>
      <a href="logout.php" class="btn btn-danger">Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
    </div>
  </div>
</nav>

<div class="container py-4">
    <h4 class="mb-3">
        <?php echo $filterKategori ? "Kategori: " . htmlspecialchars($filterKategori) : "Daftar Koleksi Saya"; ?>
    </h4>

    <!-- Tombol Filter Kategori -->
    <div class="mb-4">
        <?php foreach ($categories as $cat): ?>
            <a href="dashboard.php?kategori_id=<?php echo $cat['id']; ?>" 
                class="btn btn-sm <?php echo (isset($_GET['kategori_id']) && $cat['id'] == $kategori_id) ? 'btn-dark' : 'btn-outline-dark'; ?> me-2 mb-2">
                <?php echo htmlspecialchars($cat['nama_kategori']); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if (count($collections) === 0): ?>
        <div class="alert alert-info">Belum ada koleksi untuk kategori ini.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($collections as $c): ?>
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm">
                    <?php if ($c['foto']): ?>
                        <img src="upload/<?php echo htmlspecialchars($c['foto']); ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                    <?php else: ?>
                        <div style="height:200px; background:#f5f5f5;" class="d-flex align-items-center justify-content-center text-muted">
                            No Image
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($c['nama_item']); ?></h5>
                        <p class="card-text">
                            <small class="text-muted">
                                <?php echo htmlspecialchars($c['nama_kategori']); ?> • 
                                <?php echo htmlspecialchars($c['tanggal_masuk']); ?>
                            </small>
                        </p>
                        <a href="koleksi/detail.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                        <a href="koleksi/edit.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="koleksi/hapus.php?id=<?php echo $c['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin akan hapus?')">Hapus</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
