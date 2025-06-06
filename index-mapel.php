<?php
  include 'koneksi.php';

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM mapel WHERE id_mapel = ?");
    $stmt->execute([$id]);
    $mapel = $stmt->fetch(PDO::FETCH_ASSOC);
  
  }

  //ambil data tugas untuk tabel
  $stmt2 = $conn->prepare("SELECT * FROM tugas WHERE id_mapel = ?");
  $stmt2->execute([$id]);
  $data_tugas = $stmt2->fetchAll(PDO::FETCH_ASSOC);  

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ScholarNotes | Dashboard Mapel</title>

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
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="theme/dist/img/apps.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block">Dashboard</a>
        </div>
      </div>
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
        <!-- button tampil mapel -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 class="m-0">150</h3>
                <p><?php echo $mapel['nama_mapel']?></p>
              </div>
            </div>
        </div>
        <!-- end button mapel -->
        <div class="row">
            <!-- search tugas -->

            <!-- end search tugas -->
            <!-- button tambah tugas -->
            <a href="form-tambah-tugas.php?id=<?php echo $mapel['id_mapel']; ?>" class="btn btn-primary">Tambahkan Tugas</a>
            <!-- end button tambah -->
        </div> <!-- /row -->

        <!-- tabel data tugas -->
          <div class="col-12">
            <div class="card mt-4">
              <div class="card-header">
                <h3 class="card-title">Daftar Tugas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Judul Tugas</th>
                    <th>Tenggat Tugas</th>
                    <th>catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($data_tugas as $tugas):?>
                  <tr>
                    <td><?php echo $tugas['tanggal_dibuat']; ?></td>
                    <td><?php echo $tugas['judul_tugas']; ?></td>
                    <td><?php echo $tugas['tenggat_tugas']; ?></td>
                    <td><?php echo $tugas['catatan']; ?></td>
                    <td><?php echo $tugas['status']; ?></td>
                    <td><a href="./hapus-film.php?id_tugas=<?php echo $tugas['id_tugas'] ?>" class="btn btn-danger">Hapus</a></th>
                  </tr>
                  <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Tanggal</th>
                    <th>Judul Tugas</th>
                    <th>Tenggat Tugas</th>
                    <th>catatan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        <!-- end tabel -->
        <!-- jumlah tugas -->
        <div class="small-box col-2" style="background-color: #99090c;">
              <div class="inner">
                  <p style="color: white;"><strong>Jumlah</strong></p>
              </div>
        </div>
        <!-- end jumlah tugas -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

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
