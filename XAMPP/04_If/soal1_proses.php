<?php
$tahun = $_POST['tahun'];

if (($tahun % 4 == 0 && $tahun % 100 != 0) || ($tahun % 400 == 0)) {
    echo "<p>Tahun $tahun adalah <b>Tahun Kabisat</b>.</p>";
} else {
    echo "<p>Tahun $tahun <b>bukan</b> Tahun Kabisat.</p>";
}
echo '<br><a href="soal1.html">Kembali</a>';
?>
