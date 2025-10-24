<?php
include '../../../config/connection.php';

$id = $_POST['id'];
$paket_id = $_POST['paket_id'];
$departure = $_POST['departure_date'];
$return = $_POST['return_date'];
$quota = $_POST['quota'];
$status = $_POST['status'];

$q = mysqli_query($conn, "
  UPDATE keberangkatan 
  SET paket_id='$paket_id',
      departure_date='$departure',
      return_date='$return',
      quota='$quota',
      status='$status',
      updated_at = NOW()
  WHERE id='$id'
");

if ($q) {
    echo "<script>alert('Data berhasil diperbarui'); window.location='../../pages/data berangkat/index.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui data'); window.location='../../pages/data berangkat/edit.php';</script>";
}
