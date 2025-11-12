<?php
$jam = $_POST['jam'];
$gol = $_POST['golongan'];
$upah_lembur = 3000;
$batas_jam = 48;

switch ($gol) {
    case "A": $upah = 4000; break;
    case "B": $upah = 5000; break;
    case "C": $upah = 6000; break;
    case "D": $upah = 7500; break;
    default: $upah = 0; break;
}

if ($jam <= $batas_jam) {
    $total = $jam * $upah;
} else {
    $lembur = $jam - $batas_jam;
    $total = ($batas_jam * $upah) + ($lembur * $upah_lembur);
}

echo "<p>Golongan: <b>$gol</b><br>";
echo "Total Upah: <b>Rp " . number_format($total, 0, ',', '.') . "</b></p>";
echo '<br><a href="soal3.html">Kembali</a>';
?>
