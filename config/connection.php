<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "travel_haji_umroh";

// membuat koneksi ke database
$conn = new mysqli($hostname, $username, $password, $database);

// memeriksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
