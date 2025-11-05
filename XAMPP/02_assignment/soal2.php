<?php
$jumlahUang = 1575250;

// Pecahan Rp 100.000
$a = intdiv($jumlahUang, 100000);
$jumlahUang = $jumlahUang % 100000;

// Pecahan Rp 50.000
$b = intdiv($jumlahUang, 50000);
$jumlahUang = $jumlahUang % 50000;

// Pecahan Rp 20.000
$c = intdiv($jumlahUang, 20000);
$jumlahUang = $jumlahUang % 20000;

// Pecahan Rp 5.000
$d = intdiv($jumlahUang, 5000);
$jumlahUang = $jumlahUang % 5000;

// Pecahan Rp 100
$e = intdiv($jumlahUang, 100);
$jumlahUang = $jumlahUang % 100;

// Pecahan Rp 50
$f = intdiv($jumlahUang, 50);
$jumlahUang = $jumlahUang % 50;

// Tampilkan hasil
echo "Jumlah Rp. 100.000 : $a<br />";
echo "Jumlah Rp. 50.000 : $b<br />";
echo "Jumlah Rp. 20.000 : $c<br />";
echo "Jumlah Rp. 5.000 : $d<br />";
echo "Jumlah Rp. 100 : $e<br />";
echo "Jumlah Rp. 50 : $f<br />";
?>
