<?php

$servername = "127.0.0.1";
$username = "tumanggor675";
$password = "roott";
$dbname = "DAFTAR";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    echo "";
}

