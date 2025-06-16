<?php
    include 'koneksi.php';

    // Mengecek apakah parameter id_mapel dikirim melalui URL
    if (!isset($_GET['id_mapel'])) {
        // Jika tidak ada id_mapel, redirect kembali ke index-mapel.php atau tampilkan error
        header('Location: index-mapel.php');
        exit;
      }
      
      // Menyimpan nilai id_mapel dari URL ke dalam variabel
      $id_mapel = $_GET['id_mapel'];

    // Mengecek apakah form dengan tombol name="simpan_tugas" dikirim
    if(isset($_POST['simpan_tugas'])) {
    $tanggal_dibuat = $_POST['tanggal_dibuat'];
    $judul_tugas = $_POST['judul_tugas'];
    $tenggat = $_POST['tenggat'];
    $catatan = $_POST['catatan'];

    // Status default tugas adalah 'belum'
    $status = 'belum';

    //menyimpan data tugas ke dalam tabel 'tugas'
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

    // Setelah data berhasil disimpan, redirect ke halaman index-mapel.php dengan menyertakan id_mapel
    header("Location: index-mapel.php?id=$id_mapel");
    exit;
} 

?>