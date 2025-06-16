<?php
include 'koneksi.php';

// Cek apakah parameter id_tugas dikirim melalui URL
if (isset($_GET['id_tugas']) && isset($_GET['id_mapel'])) {
    // Ambil nilai id_tugas dari parameter URL
    $id_tugas = $_GET['id_tugas'];
    $id_mapel = $_GET['id_mapel'];

    $stmt = $conn->prepare("DELETE FROM tugas WHERE id_tugas = ?");
    if ($stmt->execute([$id_tugas])) {
        header("Location: index-mapel.php?id=$id_mapel");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
} 