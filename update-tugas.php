<?php
    include 'koneksi.php';

    if(isset($_POST['simpan_edit'])) {
        $id_tugas = $_POST['id_tugas'];
        $id_mapel = $_POST['id_mapel'];
        $tanggal_dibuat = $_POST['tanggal_dibuat'];
        $judul_tugas = $_POST['judul_tugas'];
        $tenggat = $_POST['tenggat'];
        $catatan = $_POST['catatan'];
        $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tugas SET tanggal_dibuat = ?, judul_tugas = ?, tenggat_tugas = ?, catatan = ?, status = ? WHERE id_tugas = ?");
    $stmt->execute([$tanggal_dibuat, $judul_tugas, $tenggat, $catatan, $status, $id_tugas]);

    header("Location: index-mapel.php?id=" . $id_mapel);
    exit;
    }

?>