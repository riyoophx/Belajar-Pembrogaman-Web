<?php

// Inisialisasi variabel untuk menghindari error jika form belum disubmit
$saldo_awal = 0;
$n_bulan = 0;
$saldo_akhir = 0;
$riwayat = []; // Array untuk menyimpan riwayat saldo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input dari form
    $saldo_awal = (float)$_POST['saldo_awal'];
    $n_bulan = (int)$_POST['n_bulan'];
    $saldo_saat_ini = $saldo_awal;
    
    // Simpan saldo awal di riwayat
    $riwayat[] = [
        'bulan' => 0,
        'saldo' => $saldo_saat_ini,
        'bunga' => 0,
        'admin' => 0
    ];

    // Lakukan perulangan untuk setiap bulan
    for ($bulan = 1; $bulan <= $n_bulan; $bulan++) {
        $biaya_admin = 9000;
        $bunga_tahunan;

        // Tentukan bunga berdasarkan saldo
        if ($saldo_saat_ini < 1100000) { // Saldo kurang dari Rp 1.100.000,- [cite: 174]
            $bunga_tahunan = 0.03; // 3% p.a. [cite: 174]
        } else { // Saldo lebih besar atau sama dengan Rp 1.100.000,- [cite: 175]
            $bunga_tahunan = 0.04; // 4% p.a. [cite: 175]
        }

        // Hitung bunga bulanan
        $bunga_bulanan = ($bunga_tahunan / 12) * $saldo_saat_ini;

        // Hitung saldo setelah ditambah bunga dan dikurangi biaya admin
        $saldo_saat_ini = $saldo_saat_ini + $bunga_bulanan - $biaya_admin;

        // Simpan riwayat bulanan
        $riwayat[] = [
            'bulan' => $bulan,
            'saldo' => $saldo_saat_ini,
            'bunga' => $bunga_bulanan,
            'admin' => $biaya_admin
        ];
        
        $saldo_akhir = $saldo_saat_ini;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simulasi Saldo Bank</title>
</head>
<body>

    <h2>Simulasi Saldo Tabungan Bank X</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="saldo_awal">Saldo Awal (Rp):</label>
        <input type="number" step="any" name="saldo_awal" required value="<?php echo isset($_POST['saldo_awal']) ? $_POST['saldo_awal'] : '1000000'; ?>"><br><br>
        
        <label for="n_bulan">Jangka Waktu (N bulan):</label>
        <input type="number" name="n_bulan" required value="<?php echo isset($_POST['n_bulan']) ? $_POST['n_bulan'] : '12'; ?>"><br><br>
        
        <input type="submit" value="Hitung Saldo Akhir">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <hr>
        <h3>Hasil Perhitungan</h3>
        <p><strong>Saldo Awal:</strong> Rp <?php echo number_format($riwayat[0]['saldo'], 2, ',', '.'); ?></p>
        <p><strong>Jangka Waktu:</strong> <?php echo $n_bulan; ?> bulan</p>
        <p><strong>Saldo Akhir Setelah <?php echo $n_bulan; ?> Bulan:</strong> 
           <span style="color: blue; font-weight: bold;">
               Rp <?php echo number_format($saldo_akhir, 2, ',', '.'); ?>
           </span>
        </p>

        <h4>Detail Perhitungan Bulanan</h4>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Bulan</th>
                <th>Saldo Awal Bulan</th>
                <th>Bunga (Diterima)</th>
                <th>Biaya Admin (Dikenakan)</th>
                <th>Saldo Akhir Bulan</th>
            </tr>
            <?php for ($i = 1; $i <= $n_bulan; $i++): ?>
            <?php 
                $saldo_awal_bulan = $riwayat[$i-1]['saldo'];
                $bunga = $riwayat[$i]['bunga'];
                $admin = $riwayat[$i]['admin'];
                $saldo_akhir_bulan = $riwayat[$i]['saldo'];
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>Rp <?php echo number_format($saldo_awal_bulan, 2, ',', '.'); ?></td>
                <td style="color: green;">+ Rp <?php echo number_format($bunga, 2, ',', '.'); ?></td>
                <td style="color: red;">- Rp <?php echo number_format($admin, 2, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($saldo_akhir_bulan, 2, ',', '.'); ?></td>
            </tr>
            <?php endfor; ?>
        </table>
    <?php endif; ?>

</body>
</html>