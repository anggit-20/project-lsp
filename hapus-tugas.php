<?php
include 'koneksi.php';

if (isset($_GET['id_tugas'])) {
    $id_tugas = $_GET['id_tugas'];

    // Ambil id_mapel dari tugas yang akan dihapus
    $stmt = $conn->prepare("SELECT id_mapel FROM tugas WHERE id_tugas = :id_tugas");
    $stmt->bindParam(':id_tugas', $id_tugas);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $id_mapel = $result['id_mapel'];

        // Hapus tugas
        $sql = "DELETE FROM tugas WHERE id_tugas = :id_tugas";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_tugas', $id_tugas);

        if ($stmt->execute()) {
            // Redirect ke halaman daftar mapel dengan id_mapel
            header("Location: index-mapel.php?id=$id_mapel");
            exit();
        } else {
            echo "Gagal menghapus data.";
        }
    } else {
        echo "Data tugas tidak ditemukan.";
    }
} else {
    echo "ID tugas tidak ditemukan.";
}
