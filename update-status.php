<?php
    include 'koneksi.php';

    $id = $_POST['id_tugas'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tugas SET status = ? WHERE id_tugas = ?");
    $stmt->execute([$status, $id_tugas]);

    header("Location: index-mapel.php?id_mapel=".$_GET['id_mapel']);
?>
