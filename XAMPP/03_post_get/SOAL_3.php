<?php
$nama_lengkap = $_POST['nama_lengkap'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal = $_POST['tanggal'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$alamat_rumah = $_POST['alamat_rumah'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$asal_sekolah = $_POST['asal_sekolah'];
$nilai_uan = $_POST['nilai_uan'];

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
    <a href="index.html">Kembali</a>
</body>
</html>