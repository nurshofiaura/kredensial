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
		<style>
		.blinking {
			animation: opacity 2s ease-in-out infinite;
			opacity: 1;
		}
		@keyframes opacity {
		  0% {
			opacity: 1;
		  }

		  50% {
			opacity: 0.5;
		  }

		  100% {
			opacity: 0;
		  }
		}
		</style>
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
	$cek_filesmall=FCPATH.'assets/foto/ol/'.$photo;
	if(file_exists($cek_filesmall)){
		$url_thumb=base_url().'assets/foto/ol/'.$photo;
		$url_picbesar=base_url().'assets/foto/ol/'.$photo;
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
    <a href="<?php echo base_url($this->session->beranda);?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo $iheader_mini; ?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>INSTANSI</b></span>
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
                  <a href="<?php  echo base_url('member/profil');?>" class="btn btn-default btn-flat">Profile</a>
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
				<li>
					<a href="<?php echo base_url($this->session->beranda);?>">
						<i class="fa fa-dashboard text-<?php echo $v; ?>"></i> 
							<span>Dashboard</span>
					</a>
				</li>		
	       <li class="treeview <?php cek_aktif($page,array('data_user')); ?>">
	         <a href="#">
	           <i class="fa fa-file-text text-<?php echo $v; ?>"></i>
	           <span>USER</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('data_user'));?>">
							<a href="<?php echo base_url('instansi_user/data_user');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Data User
							</a>
						</li>
	          </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('pendidikan','berkas_kategori','kategori_pelatihan','unit','bahan','struktur_jabatan','kategori_surat','other','pengirim','tindakan','kategori','equipment')); ?>">
	         <a href="#">
	           <i class="fa fa-file-text text-<?php echo $v; ?>"></i>
	           <span>Master</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('pendidikan'));?>">
							<a href="<?php echo base_url('instansi_user/pendidikan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Pendidikan
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('berkas_kategori'));?>">
							<a href="<?php echo base_url('instansi_user/berkas_kategori');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori Berkas
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('kategori_pelatihan'));?>">
							<a href="<?php echo base_url('instansi_user/kategori_pelatihan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori Pelatihan
							</a>
						</li>
		       <li class="treeview <?php cek_aktif($page,array('struktur_jabatan','kategori_surat','other')); ?>">
		         <a href="#">
		           <i class="fa fa-file-text text-<?php echo $v; ?>"></i>
		           <span>Korespondensi</span>
		           <span class="pull-right-container">
		             <i class="fa fa-angle-left pull-right"></i>
		           </span>
		         </a>
		         <ul class="treeview-menu">
		           <li class="<?php cek_aktif($page,array('struktur_jabatan'));?>">
								<a href="<?php echo base_url('instansi_user/struktur_jabatan');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Struktur Jabatan
								</a>
							</li>
		           <li class="<?php cek_aktif($page,array('kategori_surat'));?>">
								<a href="<?php echo base_url('instansi_user/kategori_surat');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Tipe Surat
								</a>
							</li>
		           <li class="<?php cek_aktif($page,array('other'));?>">
								<a href="<?php echo base_url('instansi_user/other');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Pengirim Luar
								</a>
							</li>
		          </ul>
		        </li>
	           <li class="<?php cek_aktif($page,array('unit'));?>">
							<a href="<?php echo base_url('instansi_user/unit');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Ruangan/Unit
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('equipment'));?>">
							<a href="<?php echo base_url('instansi_user/equipment');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Peralatan
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('bahan'));?>">
							<a href="<?php echo base_url('instansi_user/bahan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Bahan Habis Pakai
							</a>
						</li>
		       <li class="treeview <?php cek_aktif($page,array('pengirim','tindakan','kategori')); ?>">
		         <a href="#">
		           <i class="fa fa-hospital-o text-<?php echo $v; ?>"></i>
		           <span>Pendaftaran Tindakan</span>
		           <span class="pull-right-container">
		             <i class="fa fa-angle-left pull-right"></i>
		           </span>
		         </a>
		         <ul class="treeview-menu">
		           <li class="<?php cek_aktif($page,array('kategori'));?>">
								<a href="<?php echo base_url('instansi_user/kategori');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori Tindakan
								</a>
							</li>
		           <li class="<?php cek_aktif($page,array('tindakan'));?>">
								<a href="<?php echo base_url('instansi_user/tindakan');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Tindakan / Pemeriksaan
								</a>
							</li>
		           <li class="<?php cek_aktif($page,array('pengirim'));?>">
								<a href="<?php echo base_url('instansi_user/pengirim');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Dokter
								</a>
							</li>
		          </ul>
		        </li>
	          </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('pengembangan_profesi','kinerja_klinis_lbulanan','etik','oppe','kinerja_unit')); ?>">
	         <a href="#">
	           <i class="fa fa-file-text text-<?php echo $v; ?>"></i>
	           <span>Penilaian Kinerja</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('kinerja_klinis_lbulanan'));?>">
							<a href="<?php echo base_url('instansi_user/kinerja_klinis');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kinerja Klinis
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('pengembangan_profesi'));?>">
							<a href="<?php echo base_url('instansi_user/pengembangan_profesi');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Pengembangan Profesi
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('etik'));?>">
							<a href="<?php echo base_url('instansi_user/etik');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Etika Profesi
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('oppe'));?>">
							<a href="<?php echo base_url('instansi_user/oppe');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> OPPE
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('kinerja_unit'));?>">
							<a href="<?php echo base_url('instansi_user/kinerja_unit');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kinerja Unit
							</a>
						</li>
	          </ul>
	        </li>
         <li class="<?php cek_aktif($page,array('demografi'));?>">
					<a href="<?php echo base_url('instansi_user/demografi');?>">
						<i class="fa fa-list-alt text-<?php echo $v; ?>"></i> 
							<span>Demografi Instansi</span>
					</a>
				</li>	
         <li class="<?php cek_aktif($page,array('rs'));?>">
					<a href="<?php echo base_url('instansi_user/rs');?>">
						<i class="fa fa-list-alt text-<?php echo $v; ?>"></i> 
							<span>Demografi Ruangan / Unit</span>
					</a>
				</li>
         <li class="<?php cek_aktif($page,array('lihat','lihat_profil','lihat_tabel','lihat_galeri'));?>">
					<a href="<?php echo base_url('instansi_user/lihat');?>">
						<i class="fa fa-list-alt text-<?php echo $v; ?>"></i> 
							<span>Indikator Mutu</span>
					</a>
				</li>
         <li class="<?php cek_aktif($page,array('informasi_jabatan'));?>">
					<a href="<?php echo base_url('instansi_user/informasi_jabatan');?>">
						<i class="fa fa-list-alt text-<?php echo $v; ?>"></i> 
							<span>Anjab ABK</span>
					</a>
				</li>
      </ul>
    </section>
  </aside>
  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>