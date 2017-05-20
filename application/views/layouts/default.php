<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo $template['title']; ?></title>

  <link href="<?php echo base_url('themes/inspinia/') ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url('themes/inspinia/') ?>font-awesome/css/font-awesome.css" rel="stylesheet">

  <link href="<?php echo base_url('themes/inspinia/') ?>css/animate.css" rel="stylesheet">
  <link href="<?php echo base_url('themes/inspinia/') ?>css/style.css" rel="stylesheet">
  <link href="<?php echo base_url('assets/plugins/toastr/') ?>toastr.min.css" rel="stylesheet">



  <!-- Mainly scripts -->
  <script src="<?php echo base_url('themes/inspinia/') ?>js/jquery-3.1.1.min.js"></script>
  <script src="<?php echo base_url('themes/inspinia/') ?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('themes/inspinia/') ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
  <script src="<?php echo base_url('themes/inspinia/') ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url('assets/plugins/toastr/') ?>toastr.min.js"></script>

  <!-- Custom and plugin javascript -->
  <script src="<?php echo base_url('themes/inspinia/') ?>js/inspinia.js"></script>
  <script src="<?php echo base_url('themes/inspinia/') ?>js/plugins/pace/pace.min.js"></script>
  
  <?php echo $template['metadata']; ?>

</head>

<body class="">

  <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">
<div class="dropdown profile-element"><!--  <span>
<img alt="image" class="img-circle" src="<?php echo base_url('themes/inspinia/') ?>img/profile_small.jpg" />
</span> -->
<a data-toggle="dropdown" class="dropdown-toggle" href="#">
  <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->user->fullname; ?></strong>
  </span> <span class="text-muted text-xs block"><?php echo $this->groups[0]->name ?> <!-- <b class="caret"> --></b></span> </span> </a>
 <!--  <ul class="dropdown-menu animated fadeInRight m-t-xs">
    <li class="divider"></li>
    <?php foreach ($this->groups as $key => $group): ?>
      <li><a href="#"><?php echo $group->name ?></a></li>
    <?php endforeach ?>
    <li class="divider"></li>

  </ul> -->
</div>
<div class="logo-element">
  +++
</div>
</li>
<?php echo $this->multi_menu->render(); ?>
<!-- <li>
  <a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-home"></i> <span class="nav-label">Dashboard</span></a>
</li>
<li>
  <a href="index.html"><i class="fa fa-envelope"></i> <span class="nav-label">Surat Masuk</span> <span class="fa arrow"></span></a>
  <ul class="nav nav-second-level collapse">
    <li><a href="<?php echo base_url('surat_masuk/lihat') ?>">Data Surat Masuk</a></li>
    <li><a href="<?php echo base_url('surat_masuk/tambah') ?>">Tambah Surat Masuk</a></li>

  </ul>
</li>
<li>
  <a href="index.html"><i class="fa fa-envelope-o"></i> <span class="nav-label">Surat keluar</span> <span class="fa arrow"></span></a>
  <ul class="nav nav-second-level collapse">
    <li><a href="<?php echo base_url('surat_keluar/lihat') ?>">Data Surat Keluar</a></li>
    <li><a href="<?php echo base_url('surat_keluar/tambah') ?>">Tambah Surat Keluar</a></li>

  </ul>
</li>
<li>
  <a href="index.html"><i class="fa fa-exchange"></i> <span class="nav-label">Disposisi</span> <span class="fa arrow"></span></a>
  <ul class="nav nav-second-level collapse">
    <li><a href="index.html">Data Disposisi</a></li>

  </ul>
</li>
<li>
  <a href="index.html"><i class="fa fa-group"></i> <span class="nav-label">Manage</span> <span class="fa arrow"></span></a>
  <ul class="nav nav-second-level collapse">
    <li><a href="<?php echo base_url('manage/manage_users'); ?>">Users</a></li>
    <li><a href="<?php echo base_url('manage/manage_groups'); ?>">Groups</a></li>

  </ul>
</li>
<li>
  <a href="index.html"><i class="fa fa-book"></i> <span class="nav-label">Arsip</span> <span class="fa arrow"></span></a>
  <ul class="nav nav-second-level collapse">
    <li><a href="<?php echo base_url('arsip/lihat') ?>">Data Arsip</a></li>
    <li><a href="<?php echo base_url('arsip/tambah') ?>">Tambah Data Arsip</a></li>

  </ul>
</li>

<li>
  <a href="<?php echo base_url('manage/manage_profile') ?>"><i class="fa fa-book"></i> <span class="nav-label">Profile</span></a>
</li>

</ul> -->

</div>
</nav>

<div id="page-wrapper" class="gray-bg">
  <div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

      </div>
      <ul class="nav navbar-top-links navbar-right">
        <li>
          <span class="m-r-sm text-muted welcome-message">Sistem Informasi Persuratan Pengadilan Tinggi Pekanbaru</span>
        </li>
        <li class="divider">|</li>
        <li>
          <a href="<?php echo base_url('logout'); ?>">
            <i class="fa fa-sign-out"></i> Log out
          </a>
        </li>
      </ul>

    </nav>
  </div>
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
      <h2><?php echo $template['title']; ?></h2>

    </div>

  </div>
  <div class="wrapper wrapper-content  ">

    <?php echo $template['body'] ?>

  </div>

  <div class="footer">
    <div>
      <strong>Copyright</strong> Project PPL &copy; 2017
    </div>
  </div>

</div>
</div>

<?php echo $this->session->flashdata('message'); ?>

</body>

</html>
