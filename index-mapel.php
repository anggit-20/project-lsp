
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

  //menghitung jumlah tugas
  $stmt_selesai = $conn->prepare("SELECT COUNT(*) FROM tugas WHERE id_mapel = ? AND status = 'sudah' ");
  $stmt_selesai->execute([$id]);
  $jumlah_selesai = $stmt_selesai->fetchColumn();

  $stmt_belum = $conn->prepare("SELECT COUNT(*) FROM tugas WHERE id_mapel = ? AND status = 'belum' ");
  $stmt_belum->execute([$id]);
  $jumlah_belum = $stmt_belum->fetchColumn();

  $stmt_jumlah = $conn->prepare("SELECT COUNT(*) FROM tugas WHERE id_mapel = ? ");
  $stmt_jumlah->execute([$id]);
  $jumlah = $stmt_jumlah->fetchColumn();
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
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

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
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3 class="m-0"><?php echo $jumlah; ?></h3>
                <p><?php echo $mapel['nama_mapel']?></p>
              </div>
            </div>
        </div>
        <!-- end button mapel -->
            <!-- button tambah tugas -->
            <div class="text-right">
            <a href="form-tambah-tugas.php?id=<?php echo $mapel['id_mapel']; ?>" class="btn btn-primary">Tambah Tugas</a>
            </div>
            <!-- end button tambah -->
        <!-- tabel data tugas -->
          <div class="col-12">
            <div class="card mt-4">
              <div class="card-header">
                <h3 class="card-title">Daftar Tugas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelTugas" class="table table-bordered table-hover">
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
                    <td><a href="./hapus-tugas.php?id_tugas=<?php echo $tugas['id_tugas'] ?>" class="btn btn-danger">Hapus</a>
                        <a href="./form-edit-tugas.php?id_tugas=<?php echo $tugas['id_tugas'] ?>" class="btn btn-warning">Edit</a>
                    </td>
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
        <div class="row">
        <div class="box col-2 mr-3 text-center" style="background-color: #99090c; height: 50px; border-radius: 5px;">
              <div class="inner"> 
                  <h5 class="m-0" style="color: white;"><strong><?php echo $jumlah_selesai; ?></strong></h5>
                  <p style="color: white;">Sudah Selesai</p>
              </div>
        </div>
        <div class="box col-2 text-center" style="background-color: #99090c; height: 50px; border-radius: 5px;">
              <div class="inner"> 
                  <h5 class="m-0" style="color: white;"><strong><?php echo $jumlah_belum; ?></strong></h5>
                  <p style="color: white;">Belum Selesai</p>
              </div>
        </div>
        </div>
        <!-- end jumlah tugas -->
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
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
  $(function () {
    $("#tabelTugas").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "searching": true,
      "ordering": true,
      "paging": false,
      "info": true,
      
    }).container().appendTo('#tabelTugas_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
