<html>
<head>
    <title>Menghitung Komisi Salesman</title>
</head>
<body>
    <h1>Menghitung Komisi Salesman</h1>

    <?php
    $nilaiJual = $_POST['penjualan'];   // membaca nilai penjualan
    $prosenKomisi = $_POST['komisi'];   // membaca nilai prosentase komisi

    $komisi = $nilaiJual * $prosenKomisi / 100;  // hitung komisi berdasarkan persen komisi

    echo "<p>Nilai penjualan salesman : Rp. " . $nilaiJual . "</p>";   // menampilkan nilai penjualan
    echo "<p>Persentase Komisi : " . $prosenKomisi . " %</p>";         // menampilkan prosentase komisi
    echo "<p>Komisi yang didapat salesman adalah Rp. " . $komisi . "</p>"; // menampilkan hasil komisi
    ?>
</body>
</html>
