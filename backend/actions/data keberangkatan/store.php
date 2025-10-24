<?php
include '../../../config/connection.php';

$paket_id = $_POST['paket_id'];
$departure = $_POST['departure_date'];
$return = $_POST['return_date'];
$quota = $_POST['quota'];
$status = $_POST['status'];

$q = mysqli_query($conn, "
  INSERT INTO keberangkatan (paket_id, departure_date, return_date, quota, booked, status, created_at)
  VALUES ('$paket_id', '$departure', '$return', '$quota', 0, '$status', NOW())
");

if ($q) {
    echo "<script>alert('Data berhasil disimpan'); window.location='../../pages/data berangkat/index.php';</script>";
} else {
    echo "<script>alert('Gagal menyimpan data'); window.location='../../pages/data berangkat/create.php';</script>";
}
