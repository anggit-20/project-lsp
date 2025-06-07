<?php
include 'koneksi.php';

if (isset($_GET['id_tugas'])) {
    $id = $_GET['id_tugas'];

    $sql = "DELETE FROM tugas WHERE id_tugas = :id_tugas";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_tugas', $id);

    if ($stmt->execute()) {
        // Redirect ke halaman daftar film
        header("Location: index-mapel.php?id=$id_mapel");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID film tidak ditemukan.";
}
