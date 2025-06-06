<?php
    include 'koneksi.php';

    if(isset($_POST['simpan_mapel'])) {
        $nama_mapel = $_POST['nama_mapel'];

        $sql = "INSERT INTO mapel (nama_mapel) VALUES (:nama_mapel)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nama_mapel', $nama_mapel);
        $stmt->execute();

        header("Location: index.php");
        exit;
    } 
?>