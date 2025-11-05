<?php
$nama_lengkap = $_GET['nama_lengkap'];
$tempat_lahir = $_GET['tempat_lahir'];
$tanggal = $_GET['tanggal'];
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
$alamat_rumah = $_GET['alamat_rumah'];
$jenis_kelamin = $_GET['jenis_kelamin'];
$asal_sekolah = $_GET['asal_sekolah'];
$nilai_uan = $_GET['nilai_uan'];

$tanggal_lahir = $tanggal . '-' . $bulan . '-' . $tahun;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pendaftaran</title>
</head>
<body>
    <h2>Data Pendaftaran Mahasiswa</h2>
    <table border="1">
        <tr>
            <td>Nama Lengkap</td>
            <td><?php echo $nama_lengkap; ?></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td><?php echo $tempat_lahir; ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td><?php echo $tanggal_lahir; ?></td>
        </tr>
        <tr>
            <td>Alamat Rumah</td>
            <td><?php echo $alamat_rumah; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td><?php echo $jenis_kelamin; ?></td>
        </tr>
        <tr>
            <td>Asal Sekolah</td>
            <td><?php echo $asal_sekolah; ?></td>
        </tr>
        <tr>
            <td>Nilai UAN</td>
            <td><?php echo $nilai_uan; ?></td>
        </tr>
    </table>
    <br>
    <a href="proses_get.html">Kembali ke Form</a>
</body>
</html>
