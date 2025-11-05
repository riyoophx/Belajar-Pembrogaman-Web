<html>
    <head>
        <title>Menghitung Komisi Salesman</title>
    </head>
    <body>
        <h1>Menghitung Komisi salesman</h1>
        <?php
        /*
        script ini menghitung komisi salesman berdasarkan nilai penjualan
        yang dicapaiya yaitu sebesar Rp. 1.500.000,-
        ketentuan komisinya adalah 5% dari nilai penjualan yang dicapai.
        */
        $nilaiJual = 1500000; // nilai penjualan yang di dapatkan
        $komisi = 0.05 * $nilaiJual; // menghitung komisi yaitu 5% dari nilai penjualan
        echo "<p>Nilai penjualan salesman : Rp. ".$nilaiJual."<p>"; // menampilkan nilai penjualan salesman
        echo "<p>Komisi yang didapat salesman adalah : Rp ".$komisi."<p>";
        // menampilkan hasil perhitungan komisi
        ?>
    </body>
</html>