<?php
include '../../../config/connection.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM paket WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../../pages/data paket/index.php");
