<?php
    include 'koneksi.php';

    if (!isset($_GET['id_mapel'])) {
        // Jika tidak ada id_mapel, redirect kembali ke index-mapel.php atau tampilkan error
        header('Location: index-mapel.php');
        exit;
      }
      
      $id_mapel = $_GET['id_mapel'];

if(isset($_POST['simpan_tugas'])) {
    $tanggal_dibuat = $_POST['tanggal_dibuat'];
    $judul_tugas = $_POST['judul_tugas'];
    $tenggat = $_POST['tenggat'];
    $catatan = $_POST['catatan'];

    $status = 'belum';

    $sql = "INSERT INTO tugas (id_mapel, tanggal_dibuat, judul_tugas, tenggat_tugas, catatan, status)
            VALUES (:id_mapel, :tanggal_dibuat, :judul_tugas, :tenggat, :catatan, :status)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_mapel', $id_mapel);
    $stmt->bindParam(':tanggal_dibuat', $tanggal_dibuat);
    $stmt->bindParam(':judul_tugas', $judul_tugas);
    $stmt->bindParam(':tenggat', $tenggat);
    $stmt->bindParam(':catatan', $catatan);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    header("Location: index-mapel.php?id=$id_mapel");
    exit;
} 

?>