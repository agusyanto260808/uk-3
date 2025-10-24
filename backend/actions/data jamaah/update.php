<?php
include '../../../config/connection.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$query = "UPDATE jamaah SET 
            nama='$nama',
            nik='$nik',
            tanggal_lahir='$tanggal_lahir',
            jenis_kelamin='$jenis_kelamin',
            alamat='$alamat',
            email='$email',
            phone='$phone',
            updated_at=NOW()
          WHERE id='$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Data jamaah berhasil diperbarui!');
        window.location='../../pages/data jamaah/index.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui data!');
       window.location='../../pages/data jamaah/edit.php';
    </script>";
}
