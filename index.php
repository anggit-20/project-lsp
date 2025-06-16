<?php
  include 'koneksi.php';

  //mengambil data dari tabel mapel untuk ditampilkan
  $stmt = $conn->query("SELECT * FROM mapel");
  $daftar_mapel = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Mengecek apakah ada parameter 'id'
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
     // Ambil data mapel berdasarkan id_mapel
    $stmt = $conn->prepare("SELECT * FROM mapel WHERE id_mapel = ?");
    $stmt->execute([$id]);
    $mapel = $stmt->fetch(PDO::FETCH_ASSOC);
  
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ScholarNotes</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="theme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="theme/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="theme/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="theme/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light">ScholarNotes</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <h2>
          Buat catatan tugasmu disini!
        </h2>
        <!-- form input mapel -->
        <div class="card mt-3">
            <div class="card-header">
                Tambah Mata Pelajaran
            </div>
            <div class="card-body">
                <form method="POST" action="tambah-mapel.php">
                    <div class="form-group">
                    <label>Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel" class="form-control" required>
                    </div>
                    <button type="submit" name="simpan_mapel" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
        <!-- end form input mapel -->
        <!-- button tampil mapel -->
        <div class="row">
        <?php foreach($daftar_mapel as $mapel): ?>
        <?php
        // Ambil jumlah tugas untuk mapel ini
        $stmt_jumlah = $conn->prepare("SELECT COUNT(*) FROM tugas WHERE id_mapel = ?");
        $stmt_jumlah->execute([$mapel['id_mapel']]);
        $jumlah = $stmt_jumlah->fetchColumn();
        ?>
        
          <div class="col-lg-3 col-6">
             <!-- Kotak untuk menampilkan jumlah tugas -->
            <div class="small-box bg-info">
              <div class="inner">
                    <h3 class="m-0"><?php echo $jumlah; ?></h3>
                    <p><?php echo $mapel['nama_mapel']; ?></p>
              </div>
              <!-- Tombol menuju detail tugas dari mapel ini -->
              <a href="index-mapel.php?id=<?= $mapel['id_mapel'] ?>" class="small-box-footer">Buka <i class="fas fa-arrow-circle-right"></i></a>
            </div>
            <!-- Tombol hapus mapel -->
            <a href="./hapus-mapel.php?id_mapel=<?php echo $mapel['id_mapel'] ?>" class="btn btn-danger rounded-pill">Hapus</a>
          </div>
        
        <?php endforeach; ?>
        </div>
        <!-- end button mapel -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="theme/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="theme/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="theme/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="theme/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="theme/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="theme/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="theme/plugins/moment/moment.min.js"></script>
<script src="theme/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="theme/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="theme/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="theme/dist/js/pages/dashboard.js"></script>
</body>
</html>
