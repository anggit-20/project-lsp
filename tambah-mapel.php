<?php
    include 'koneksi.php';

    // Mengecek apakah form dengan tombol bernama 'simpan_mapel' telah dikirim
    if(isset($_POST['simpan_mapel'])) {
        $nama_mapel = $_POST['nama_mapel'];

        //memasukkan data ke tabel 'mapel'
        $sql = "INSERT INTO mapel (nama_mapel) VALUES (:nama_mapel)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nama_mapel', $nama_mapel);
        $stmt->execute();

        // Setelah data disimpan, arahkan ke halaman index.php
        header("Location: index.php");
        exit;
    } 
?> 