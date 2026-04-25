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
 		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
		<style>
.tableFixHead {
  overflow-y: auto;
  height: 200px;
}

.tableFixHead table {
  border-collapse: collapse;
  width: 100%;
}

.tableFixHead th,
.tableFixHead td {
  padding: 8px 16px;
}

.tableFixHead th {
  position: sticky;
  top: 0;
  background: #eee;
}
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
if(empty($this->session->id_level)){
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
}else{
	if(empty($photo)){
		$url_thumb=base_url().'assets/images/noavatar.jpg';
		$url_picbesar=base_url().'assets/images/noavatar.jpg';				
	}else{
		$cek_filesmall=FCPATH.'assets/foto/ol/ol/'.$photo;
		if(file_exists($cek_filesmall)){
			$url_thumb=base_url().'assets/foto/ol/ol/'.$photo;
			$url_picbesar=base_url().'assets/foto/ol/ol/'.$photo;
		}else{
			$url_thumb=base_url().'assets/images/noavatar.jpg';
			$url_picbesar=base_url().'assets/images/noavatar.jpg';
		}				
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
      <span class="logo-lg"><b>WELCOME</b></span>
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
                  <small>KREDENSIAL</small>
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
          <p><small>KREDENSIAL</small></p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">KREDENSIAL</li>		
				<li>
					<a href="<?php echo base_url($this->session->beranda);?>">
						<i class="fa fa-dashboard text-<?php echo $v; ?>"></i> 
							<span>Dashboard</span>
					</a>
				</li>		
	      <li class="treeview">
	         <a href="#">
	           <i class="fa fa-book text-<?php echo $v; ?>"></i>
	           <span>Menu Level</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	         	<?php  
	         		foreach($ambil_data_a_online as $rowambil_data_a_online) {
	         				?>
				          <li>
										<a href="<?php echo base_url($rowambil_data_a_online['kode_online']);?>">
											<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> <?= $rowambil_data_a_online['nama_menu'] ?>
										</a>
									</li>
	         				<?php
	         		}
	         		foreach($ambil_data_a_enabled as $rowambil_data_a_enabled) {
	         	?>
	          <li>
							<a href="<?php echo base_url($rowambil_data_a_enabled['kode_online']);?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> <?= $rowambil_data_a_enabled['nama_menu'] ?>
							</a>
						</li>
	         	<?php
	         		}
	         		?>
	         </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('profil','working','unit','peminatan','signature','pengcab','indikator','mutu','i_mutup','quality','control','q_control','report','sheet','pasien','tes','ps_pakai','ps_reject','clone_i_mutu','clone_i_mutu_copy_user','time_respon','absen','even','acara','pendaftaran')); ?>">
	         <a href="#">
	           <i class="fa fa-user text-<?php echo $v; ?>"></i>
	           <span>User</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('profil'));?>">
							<a href="<?php echo base_url('member/profil');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Biodata
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('peminatan'));?>">
							<a href="<?php echo base_url('member/peminatan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Peminatan
							</a>
						</li>
<!--	           <li class=" cek_aktif($page,array('working'));?>">
							<a href=" echo base_url('member/working');?>">
								<i class="fa fa-circle-o text- echo $v; ?>"></i> Tempat Bekerja
							</a>
						</li> 

	           <li class="php cek_aktif($page,array('unit'));?>">
							<a href="php echo base_url('member/unit');?>">
								<i class="fa fa-circle-o text-php echo $v; ?>"></i> Ruangan
							</a>
						</li>
	           <li class="php cek_aktif($page,array('pengcab'));?>">
							<a href="php echo base_url('member/pengcab');?>">
								<i class="fa fa-circle-o text-php echo $v; ?>"></i> Komunitas Profesi
							</a>
						</li>
							<li class="<?php cek_aktif($page,array('signature'));?>">
								<a href="<?php echo base_url('member/signature');?>">
									<i class="fa fa-circle-o text-php echo $v; ?>"></i>
										<span>Upload Signature</span>
								</a>
							</li>-->
						<li class="treeview <?php cek_aktif($page,array('indikator','mutu','i_mutup','mutu_detil','quality','control','q_control','report','sheet','time_respon','absen','even','acara','pendaftaran')); ?>">
						  <a href="#"><i class="fa fa-bar-chart text-<?php echo $v; ?>"></i> Laporan Personal
							<span class="pull-right-container">
							  <i class="fa fa-angle-left pull-right"></i>
							</span>
						  </a>
						  <ul class="treeview-menu">
							<li class="<?php cek_aktif($page,array('ol_logbook','pasien','ps_pakai','ps_reject'));?>">
								<a href="<?php echo base_url('ol_logbook');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Logbook</a>
							</li>
							<li class="<?php cek_aktif($page,array('tes'));?>">
								<a href="<?php echo base_url('member/tes');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Latihan Pengajuan</a>
							</li>
			        <li class="treeview <?php cek_aktif($page,array('indikator','mutu','i_mutup')); ?>">
			          <a href="#"><i class="fa fa-cogs text-<?php echo $v; ?>"></i> Indikator Mutu
			          <span class="pull-right-container">
			            <i class="fa fa-angle-left pull-right"></i>
			          </span>
			          </a>
			          <ul class="treeview-menu">
			            <li class="<?php cek_aktif($page,array('indikator'));?>">
			              <a href="<?php echo base_url('member/indikator');?>">
			                <i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Indikator</a>
			            </li>
			            <li class="<?php cek_aktif($page,array('mutu'));?>">
			              <a href="<?php echo base_url('member/mutu');?>">
			                <i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Mutu</a>
			            </li>
			            <li class="<?php cek_aktif($page,array('i_mutup'));?>">
			              <a href="<?php echo base_url('member/i_mutup');?>">
			                <i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Input I Mutu</a>
			            </li>
			          </ul>
			        </li>
			        <li class="treeview <?php cek_aktif($page,array('quality','control','q_control')); ?>">
			          <a href="#"><i class="fa fa-cogs text-<?php echo $v; ?>"></i> Quality Control
			          <span class="pull-right-container">
			            <i class="fa fa-angle-left pull-right"></i>
			          </span>
			          </a>
			          <ul class="treeview-menu">
			            <li class="<?php cek_aktif($page,array('quality'));?>">
			              <a href="<?php echo base_url('member/quality');?>">
			                <i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori</a>
			            </li>
			            <li class="<?php cek_aktif($page,array('control'));?>">
			              <a href="<?php echo base_url('member/control');?>">
			                <i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Poin QC</a>
			            </li>
			            <li class="<?php cek_aktif($page,array('q_control'));?>">
			              <a href="<?php echo base_url('member/q_control');?>">
			                <i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Input QC</a>
			            </li>
			          </ul>
			        </li>
			        <li class="treeview <?php cek_aktif($page,array('report','sheet')); ?>">
			          <a href="#"><i class="fa fa-file-text-o text-<?php echo $v; ?>"></i> Laporan
			          <span class="pull-right-container">
			            <i class="fa fa-angle-left pull-right"></i>
			          </span>
			          </a>
			          <ul class="treeview-menu">
			            <li class="<?php cek_aktif($page,array('report','sheet'));?>">
			              <a href="<?php echo base_url('member/report');?>">
			                <i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Laporan</a>
			            </li>
			          </ul>
			        </li>
							<li class="<?php cek_aktif($page,array('absen'));?>">
								<a href="<?php echo base_url('member/absen');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Absen</a>
							</li>
							<li class="<?php cek_aktif($page,array('even','acara'));?>">
								<a href="<?php echo base_url('member/even');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Even / Kegiatan</a>
							</li>
						  </ul>
						</li>
							<li class="<?php cek_aktif($page,array('jadwal_all'));?>">
								<a href="<?php echo base_url('jadwal_all');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i>
										<span>Jadwal</span>
								</a>
							</li>
							<li class="<?php cek_aktif($page,array('chat'));?>">
								<a href="<?php echo base_url('jadwal_all/chat');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i>
										<span>Laporan Jaga</span>
								</a>
							</li>
							<li class="<?php cek_aktif($page,array('pendaftaran'));?>">
								<a href="<?php echo base_url('member/pendaftaran');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i>
										<span>Tindakan Pemeriksaan</span>
								</a>
							</li>
							<li class="<?php cek_aktif($page,array('pengambilan'));?>">
								<a href="<?php echo base_url('jadwal_all/pengambilan');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i>
										<span>Pengambilan Hasil</span>
								</a>
							</li>
	          </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('berkas','berkas_tambah','berkas_edit','ijasah','ijasah_tambah','ijasah_edit','pelatihan','pelatihan_tambah','pelatihan_edit','surat_ijin','surat_ijin_tambah','surat_ijin_edit','surat_ijin_perpanjangan','blaporan','blaporan_tambah','blaporan_edit')); ?>">
	         <a href="#">
	           <i class="fa fa-file-o text-<?php echo $v; ?>"></i>
	           <span>Berkas</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('berkas','berkas_tambah','berkas_edit'));?>">
							<a href="<?php echo base_url('member/berkas');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Berkas
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('ijasah','ijasah_tambah','ijasah_edit'));?>">
							<a href="<?php echo base_url('member/ijasah');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Ijasah
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('pelatihan','pelatihan_tambah','pelatihan_edit'));?>">
							<a href="<?php echo base_url('member/pelatihan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Pelatihan
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('surat_ijin','surat_ijin_tambah','surat_ijin_edit','surat_ijin_perpanjangan'));?>">
							<a href="<?php echo base_url('member/surat_ijin');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Surat Ijin
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('blaporan','blaporan_tambah','blaporan_edit'));?>">
							<a href="<?php echo base_url('member/blaporan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Berkas Laporan
							</a>
						</li>
	          </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('lt','lb','lh')); ?>">
	         <a href="#">
	           <i class="fa fa-file text-<?php echo $v; ?>"></i>
	           <span>LogBook</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
						<li class="treeview <?php cek_aktif($page,array('lt','lb','lh')); ?>">
						  <a href="#"><i class="fa fa-line-chart text-<?php echo $v; ?>"></i> Grafik LogBook
							<span class="pull-right-container">
							  <i class="fa fa-angle-left pull-right"></i>
							</span>
						  </a>
						  <ul class="treeview-menu">
							<li class="<?php cek_aktif($page,array('lh'));?>">
								<a href="<?php echo base_url('member/lh');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Harian</a>
							</li>
							<li class="<?php cek_aktif($page,array('lb'));?>">
								<a href="<?php echo base_url('member/lb');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Bulanan</a>
							</li>
							<li class="<?php cek_aktif($page,array('lt'));?>">
								<a href="<?php echo base_url('member/lt');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Tahunan</a>
							</li>
						  </ul>
						</li>
	          </ul>
	        </li>
      </ul>
    </section>
  </aside>
  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>