<html>
<head>
<title>Menghitung Selisih Dua waktu</title>
</head>
<body>
<?php
// Menghitung Selisih Dua waktu

$jam1 = $_POST['jam1'];    // baca jam dari waktu 1
$menit1 = $_POST['menit1'];  // baca menit dari waktu 1
$detik1 = $_POST['detik1'];  // baca detik dari waktu 1

$jam2 = $_POST['jam2'];    // baca jam dari waktu 2
$menit2 = $_POST['menit2'];  // baca menit dari waktu 2
$detik2 = $_POST['detik2'];  // baca detik dari waktu 2

$totaldetik1 = $jam1*3600 + $menit1*60 + $detik1; // menghitung total detik untuk waktu pertama
$totaldetik2 = $jam2*3600 + $menit2*60 + $detik2; // menghitung total detik untuk waktu kedua

$selisih = abs($totaldetik1 - $totaldetik2); // hitung selisih total detik dari kedua waktu

echo "Selisih dari kedua waktu adalah: $selisih detik";
?>
</body>
</html>