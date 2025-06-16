<?php
include 'koneksi.php';

// Mengecek apakah parameter 'id_mapel' ada pada URL
if (isset($_GET['id_mapel'])) {
    $id = $_GET['id_mapel'];

    //untuk menghapus data dari tabel 'mapel' berdasarkan id_mapel
    $sql = "DELETE FROM mapel WHERE id_mapel = :id_mapel";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_mapel', $id);

    if ($stmt->execute()) {
         // Jika penghapusan berhasil, redirect ke halaman index.php
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    // Jika parameter id_mapel tidak ditemukan di URL
    echo "ID film tidak ditemukan.";
}
