<?php
$jam = $_POST['jam'];
$upah_per_jam = 2000;
$upah_lembur = 3000;
$batas_jam = 48;

if ($jam <= $batas_jam) {
    $total_upah = $jam * $upah_per_jam;
} else {
    $lembur = $jam - $batas_jam;
    $total_upah = ($batas_jam * $upah_per_jam) + ($lembur * $upah_lembur);
}

echo "<p>Total upah yang diterima: <b>Rp " . number_format($total_upah, 0, ',', '.') . "</b></p>";
echo '<br><a href="soal2.html">Kembali</a>';
?>
