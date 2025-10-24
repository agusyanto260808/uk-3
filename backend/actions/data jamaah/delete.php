<?php
include '../../../config/connection.php';

$id = $_GET['id'];

$query = "DELETE FROM jamaah WHERE id='$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>
        alert('Data jamaah berhasil dihapus!');
        window.location='../../pages/data jamaah/index.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus data!');
       window.location='../../pages/data jamaah/index.php';
    </script>";
}
