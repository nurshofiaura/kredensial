<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico">
		<title><?php echo $header; ?> | <?php echo $instance_name; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="index, follow">
		<meta name="description" content="<?php echo $idescription; ?>">
		<meta name="keywords" content="<?php echo $ikeywords; ?>">
		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/datatables.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/css/buttons.dataTables.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		   folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/sa.css">
		  <!-- Select2 -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/select2/dist/css/select2.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/iCheck/all.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/lightbox.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.min.css">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>
	<?php
	$array = array('green','blue','yellow','red','purple');
	$k = array_rand($array);
	$v = $array[$k];
	?>
	<body class="hold-transition skin-<?php echo $v; ?> sidebar-mini text-sm">
<?php
if(empty($photo)){
	$url_thumb=base_url().'assets/images/noavatar.jpg';
	$url_picbesar=base_url().'assets/images/noavatar.jpg';
}else{
	$cek_filesmall=FCPATH.'assets/foto/'.$photo;
	if(file_exists($cek_filesmall)){
		$url_thumb=base_url().'assets/foto/'.$photo;
		$url_picbesar=base_url().'assets/foto/'.$photo;
	}else{
		$url_thumb=base_url().'assets/images/noavatar.jpg';
		$url_picbesar=base_url().'assets/images/noavatar.jpg';
	}
}
function cek_aktif($page,$alamat)
{
  $status=FALSE;
  if (is_array($alamat)){
    foreach ($alamat as $d) {
      if($page==$d)
        $status=TRUE;
    }
  }
  else{
    if($page==$alamat)
      $status=TRUE;
  }
  if($status)
    echo "active";
  else
    echo "" ;
}
?>
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo $iheader_mini; ?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $iheader; ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top text-sm">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		<li class="nav-item">
			<a class="nav-link hidden-xs" href="#">
				<div id="timer_waktu"></div>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">
					<SCRIPT language=JavaScript>var d = new Date();
						var h = d.getHours();
						if (h < 11) { document.write('SELAMAT PAGI '); }
						else { if (h < 15) { document.write('SELAMAT SIANG '); }
						else { if (h < 19) { document.write('SELAMAT SORE '); }
						else { if (h <= 23) { document.write('SELAMAT MALAM '); }
						}}}
					</SCRIPT>
			</a>
		</li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $url_thumb; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $member_name; ?></span>
            </a>
            <ul class="dropdown-menu" style="box-shadow:10px 10px 5px grey; margin-right: 5px;">
              <!-- User image -->
              <li class="user-header">
				<img src="<?php echo $url_thumb; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $member_name; ?>
                  <small><?php echo $level_name; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('pegawai/profil');?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('logout');?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $url_thumb; ?>" style="width:32px;height:40px;" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $member_name; ?></p>
          <p><small><?php echo $level_name; ?></small></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><?php echo $level_name; ?></li>
        <li class="treeview <?php cek_aktif($page,array('instansi','pcare','work','komunitas','komunitas_tambah','komunitas_edit','komunitas_stempel','mitra','instansi_logo','program','whatsnew','aplikasi_bayar','pelayanan','ruangan','grade','kompetensi','kewenangan','import_csv_tambah','struktur_jabatan','kategori_absen','seting_absen','mitra','mitra_tambah','mitra_edit')); ?>">
          <a href="#">
            <i class="fa fa-cog text-<?php echo $v; ?>"></i>
            <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php cek_aktif($page,array('instansi','instansi_logo','lakon'));?>">
				<a href="<?php echo base_url('sa/instansi');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Web</a></li>
            <li class="<?php cek_aktif($page,array('work','mitra','mitra_tambah','mitra_edit'));?>">
				<a href="<?php echo base_url('sa/work');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i>Instansi</a></li>
            <li class="<?php cek_aktif($page,array('komunitas','komunitas_tambah','komunitas_edit','komunitas_stempel'));?>">
							<a href="<?php echo base_url('sa/komunitas');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
									Komunitas
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('grade'));?>">
				<a href="<?php echo base_url('sa/grade');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i>Grade</a></li>
            <li class="<?php cek_aktif($page,array('struktur_jabatan'));?>">
				<a href="<?php echo base_url('sa/struktur_jabatan');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i>S Jabatan</a></li>
            <li class="<?php cek_aktif($page,array('ruangan'));?>">
				<a href="<?php echo base_url('sa/ruangan');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i>Ruangan</a></li>
				<li class="<?php cek_aktif($page,array('kompetensi'));?>">
				<a href="<?php echo base_url('sa/kompetensi');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kompetensi</a></li>
				<li class="<?php cek_aktif($page,array('kewenangan'));?>">
				<a href="<?php echo base_url('sa/kewenangan');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kewenangan</a></li>
				<li class="<?php cek_aktif($page,array('import_csv_tambah'));?>">
				<a href="<?php echo base_url('sa/import_csv/tambah');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Import CSV Pasien</a></li>
            <li class="<?php cek_aktif($page,array('kategori_absen'));?>">
				<a href="<?php echo base_url('sa/kategori_absen');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i>Kategori Absen</a></li>
            <li class="<?php cek_aktif($page,array('seting_absen'));?>">
				<a href="<?php echo base_url('sa/seting_absen');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i>Seting Absen</a></li>
				<li class="<?php cek_aktif($page,array('whatsnew'));?>">
				<a href="<?php echo base_url('sa/whatsnew');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Whats New</a></li>
          </ul>
        </li>
        <li class="treeview <?php cek_aktif($page,array('lakon','akses','ol_lakon','ol_akses','a_online','enabled','pengurus_enabled','instansi_enabled','status_bayar','aktifasi','aktifasi_tambah','working','pengajuan','pengajuan_aktifasi','struk','struk_upload','kop','kop_upload')); ?>">
          <a href="#">
            <i class="fa fa-users text-<?php echo $v; ?>"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php cek_aktif($page,array('lakon','akses'));?>">
							<a href="<?php echo base_url('sa/lakon');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
									Whole User
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('ol_lakon','ol_akses'));?>">
							<a href="<?php echo base_url('sa/ol_lakon');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
									Whole User OL
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('a_online'));?>">
							<a href="<?php echo base_url('sa/a_online');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
									Online
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('enabled','pengurus_enabled','instansi_enabled'));?>">
							<a href="<?php echo base_url('sa/enabled');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
									Enabled
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('aktifasi','aktifasi_tambah'));?>">
							<a href="<?php echo base_url('sa/aktifasi');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
									Aktifasi Nakes Lainnya
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('pengajuan','pengajuan_aktifasi'));?>">
							<a href="<?php echo base_url('sa/pengajuan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
									Aktifasi Pengajuan
							</a>
						</li>
      <li class="<?php cek_aktif($page,array('struk','struk_upload'));?>">
							<a href="<?php echo base_url('sa/struk');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
									Upload Struk
							</a>
						</li>
      <li class="<?php cek_aktif($page,array('kop','kop_upload'));?>">
       <a href="<?php echo base_url('sa/kop');?>">
        <i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
         Upload KOP
       </a>
      </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog text-<?php echo $v; ?>"></i>
            <span>Program</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-cog"></i>
				<span>Umum</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="<?php echo base_url('user');?>"><i class="fa fa-dashboard"></i><span>User</span></a></li>
				<li><a href="<?php echo base_url('aktifasi');?>"><i class="fa fa-dashboard"></i><span>Aktifasi</span></a></li>
				<li><a href="<?php echo base_url('unit');?>"><i class="fa fa-dashboard"></i><span>Unit</span></a></li>
				<li><a href="<?php echo base_url('ruangan');?>"><i class="fa fa-dashboard"></i><span>Ruangan</span></a></li>
				<li><a href="<?php echo base_url('jadwal');?>"><i class="fa fa-dashboard"></i><span>Jadwal</span></a></li>
				<li><a href="<?php echo base_url('berkas');?>"><i class="fa fa-dashboard"></i><span>Berkas</span></a></li>
				<li><a href="<?php echo base_url('isi_etik');?>"><i class="fa fa-dashboard"></i><span>Isi Etik</span></a></li>
				<li><a href="<?php echo base_url('upload');?>"><i class="fa fa-dashboard"></i><span>Upload</span></a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-cog"></i>
				<span>Admin</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="<?php echo base_url('admin_pelayanan');?>"><i class="fa fa-dashboard"></i> <span>Pelayanan</span></a></li>
				<li><a href="<?php echo base_url('kepegawaian');?>"><i class="fa fa-dashboard"></i> <span>Kepegawaian</span></a></li>
				<li><a href="<?php echo base_url('admin_perawat');?>"><i class="fa fa-dashboard"></i> <span>Keperawatan</span></a></li>
				<li><a href="<?php echo base_url('admin_apotek');?>"><i class="fa fa-dashboard"></i> <span>Apotek</span></a></li>
				<li><a href="<?php echo base_url('admin_radiologi');?>"><i class="fa fa-dashboard"></i> <span>Radiologi</span></a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-money"></i>
				<span>Keuangan</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="<?php echo base_url('admin_keuangan');?>"><i class="fa fa-dashboard"></i> <span>Admin</span></a></li>
				<li><a href="<?php echo base_url('akunting');?>"><i class="fa fa-dashboard"></i> <span>Keuangan</span></a></li>
				<li><a href="<?php echo base_url('laporan');?>"><i class="fa fa-dashboard"></i> <span>Laporan</span></a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-file-text"></i>
				<span>Pelayanan</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="<?php echo base_url('admin_pelayanan');?>"><i class="fa fa-dashboard"></i> <span>Pelayanan</span></a></li>
				<li><a href="<?php echo base_url('pendaftaran');?>"><i class="fa fa-dashboard"></i> <span>Pendaftaran</span></a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-globe"></i>
				<span>Online</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="<?php echo base_url('ol_daftar');?>"><i class="fa fa-dashboard"></i> <span>Admin OL</span></a></li>
				<li><a href="<?php echo base_url('ol_administrator');?>"><i class="fa fa-dashboard"></i> <span>Admin Pengurus</span></a></li>
				<li><a href="<?php echo base_url('ol_admin_rs');?>"><i class="fa fa-dashboard"></i> <span>Admin Kredensial</span></a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-globe"></i>
				<span>Sanitasi</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="<?php echo base_url('admin_sanitasi');?>"><i class="fa fa-dashboard"></i> <span>Admin Sanitasi</span></a></li>
				<li><a href="<?php echo base_url('sanitasi');?>"><i class="fa fa-dashboard"></i> <span>Sanitasi</span></a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-envelope"></i>
				<span>Surat</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="<?php echo base_url('surat_admin');?>"><i class="fa fa-dashboard"></i> <span>Admin</span></a></li>
			  </ul>
			</li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>
  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>
