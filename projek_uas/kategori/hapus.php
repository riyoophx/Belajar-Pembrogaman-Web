<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: ../login.php'); exit; }
require '../config/koneksi.php';
$id = intval($_GET['id'] ?? 0);

// set kategori_id of related koleksi to NULL then delete category
$stmt = mysqli_prepare($conn, "UPDATE koleksi SET kategori_id = NULL WHERE kategori_id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

$stmt2 = mysqli_prepare($conn, "DELETE FROM kategori WHERE id = ?");
mysqli_stmt_bind_param($stmt2, 'i', $id);
mysqli_stmt_execute($stmt2);
mysqli_stmt_close($stmt2);

// 🔥 CEK JIKA TABEL SUDAH KOSONG → RESET AUTO_INCREMENT KE 1
$cek = mysqli_query($conn, "SELECT COUNT(*) AS total FROM kategori");
$row = mysqli_fetch_assoc($cek);

if ($row['total'] == 0) {
    mysqli_query($conn, "ALTER TABLE kategori AUTO_INCREMENT = 1");
}

header('Location: index.php');
exit;
?>