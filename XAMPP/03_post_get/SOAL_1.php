<?php
$saldo_awal = $_POST['saldo_awal'];
$bunga_perbulan = $_POST['bunga_perbulan'];
$lama_tabungan = $_POST['lama_tabungan'];

$total_bunga = $bunga_perbulan * $lama_tabungan;
$saldo_akhir = $saldo_awal + $total_bunga;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Perhitungan Bank</title>
</head>
<body>
    <h2>Hasil Perhitungan</h2>
    <table border="1">
        <tr>
            <td>Saldo Awal</td>
            <td>Rp <?php echo number_format($saldo_awal, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Bunga Perbulan</td>
            <td>Rp <?php echo number_format($bunga_perbulan, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td>Lama Tabungan</td>
            <td><?php echo $lama_tabungan; ?> bulan</td>
        </tr>
        <tr>
            <td>Total Bunga</td>
            <td>Rp <?php echo number_format($total_bunga, 0, ',', '.'); ?></td>
        </tr>
        <tr>
            <td><strong>Saldo Akhir</strong></td>
            <td><strong>Rp <?php echo number_format($saldo_akhir, 0, ',', '.'); ?></strong></td>
        </tr>
    </table>
    <br>
    <a href="proses_saldo.html">Kembali</a>
</body>
</html>