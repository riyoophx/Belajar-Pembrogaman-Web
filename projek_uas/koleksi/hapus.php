<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
require '../config/koneksi.php';
$id = intval($_GET['id'] ?? 0);
$user_id = $_SESSION['user_id'];

// get foto name to delete
$stmt = mysqli_prepare($conn, "SELECT foto FROM koleksi WHERE id=? AND user_id=?");
mysqli_stmt_bind_param($stmt, 'ii', $id, $user_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $foto);
if (mysqli_stmt_fetch($stmt)) {
    // proceed to delete
}
mysqli_stmt_close($stmt);

$stmt2 = mysqli_prepare($conn, "DELETE FROM koleksi WHERE id=? AND user_id=?");
mysqli_stmt_bind_param($stmt2, 'ii', $id, $user_id);
if (mysqli_stmt_execute($stmt2)) {
    if ($foto && file_exists(__DIR__.'../upload/'.$foto)) {
        @unlink(__DIR__.'../upload/'.$foto);
    }
}
mysqli_stmt_close($stmt2);
header('Location: ../dashboard.php');
exit;
?>
