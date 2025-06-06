<?php
$host = "localhost"; //berjalan dilaptop sendiri
$dbname = "db_catatan"; //nama database
$username = "root";
global $conn;

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Koneksi Berhasil";
} catch (PDOException $e) {
    echo "Koneksi Gagal: " . $e->getMessage();
}
?>