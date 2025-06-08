<?php
include 'koneksi.php';

if (isset($_GET['id_mapel'])) {
    $id = $_GET['id_mapel'];

    $sql = "DELETE FROM mapel WHERE id_mapel = :id_mapel";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_mapel', $id);

    if ($stmt->execute()) {
        // Redirect ke halaman daftar film
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID film tidak ditemukan.";
}
