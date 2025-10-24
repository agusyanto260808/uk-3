<?php
include '../../../config/connection.php';

$nama = $_POST['nama'];
$nik = $_POST['nik'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$query = "INSERT INTO jamaah (nama, nik, tanggal_lahir, jenis_kelamin, alamat, email, phone, created_at)
          VALUES ('$nama', '$nik', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$email', '$phone', NOW())";

if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Data berhasil disimpan!');
        window.location.href='../../pages/data jamaah/index.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menyimpan data!');
        window.location.href='../../pages/data jamaah/create.php';
    </script>";
}
