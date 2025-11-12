<?php
$bulan = date("n");
$tahun = date("Y");
$jumlah_hari = 0;

switch ($bulan) {
    case 1: case 3: case 5: case 7: case 8: case 10: case 12:
        $jumlah_hari = 31;
        break;
    case 4: case 6: case 9: case 11:
        $jumlah_hari = 30;
        break;
    case 2:
        if (($tahun % 4 == 0 && $tahun % 100 != 0) || ($tahun % 400 == 0)) {
            $jumlah_hari = 29;
        } else {
            $jumlah_hari = 28;
        }
        break;
}

$nama_bulan = date("F");
echo "<p>Bulan saat ini: <b>$nama_bulan $tahun</b></p>";
echo "<p>Jumlah hari dalam bulan ini: <b>$jumlah_hari hari</b></p>";
echo '<br><a href="soal4.html">Kembali</a>';
?>
