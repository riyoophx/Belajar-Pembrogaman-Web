<?php
// Ambil input jumlah uang dari form
$jumlahUang = $_POST['jumlahUang'];

// Menghitung jumlah masing-masing pecahan
$sa = floor($jumlahUang / 100000);
$sisa = $jumlahUang % 100000;

$sb = floor($sisa / 50000);
$sisa = $sisa % 50000;

$sc = floor($sisa / 20000);
$sisa = $sisa % 20000;

$sd = floor($sisa / 5000);
$sisa = $sisa % 5000;

$se = floor($sisa / 100);
$sisa = $sisa % 100;

$sf = floor($sisa / 50);
$sisa = $sisa % 50;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pecahan Uang</title>
</head>
<body>
    <h2>Hasil Pecahan Uang</h2>

    <?php echo "Jumlah Uang: Rp " . number_format($jumlahUang, 0, ',', '.') . "<br><br>"; ?>

    <table border="1" cellpadding="5">
        <tr><th>Pecahan Uang</th><th>Jumlah Lembar/Keping</th></tr>
        <tr><td>Rp 100.000</td><td><?= $sa ?></td></tr>
        <tr><td>Rp 50.000</td><td><?= $sb ?></td></tr>
        <tr><td>Rp 20.000</td><td><?= $sc ?></td></tr>
        <tr><td>Rp 5.000</td><td><?= $sd ?></td></tr>
        <tr><td>Rp 100</td><td><?= $se ?></td></tr>
        <tr><td>Rp 50</td><td><?= $sf ?></td></tr>
    </table>

    <br>
    <a href="proses_pecahan.html">Kembali ke Form</a>

</body>
</html>

