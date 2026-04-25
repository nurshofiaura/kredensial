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
      <span class="logo-lg"><b>ADMIN</b></span>
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
					<a href="<?php echo base_url();?>">
						<i class="fa fa-dashboard text-<?php echo $v; ?>"></i> 
							<span>Dashboard</span>
					</a>
				</li>		
	      <li class="treeview <?php cek_aktif($page,array('daftar_registrasi','daftar_registrasi_aktifasi')); ?>">
	         <a href="#">
	           <i class="fa fa-book text-<?php echo $v; ?>"></i>
	           <span>Registrasi</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	          <li class="<?php cek_aktif($page,array('daftar_registrasi','daftar_registrasi_aktifasi'));?>">
							<a href="<?php echo base_url('ol_daftar/daftar_registrasi');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Registrasi
							</a>
						</li>
	         </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('user','user_tambah','user_edit','level','akses','working','unit','ms_peminatan')); ?>">
	         <a href="#">
	           <i class="fa fa-users text-<?php echo $v; ?>"></i>
	           <span>Users</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('user','user_tambah','user_edit','akses'));?>">
							<a href="<?php echo base_url('ol_daftar/user');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> User
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('level'));?>">
							<a href="<?php echo base_url('ol_daftar/level');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Level
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('working'));?>">
							<a href="<?php echo base_url('ol_daftar/working');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Tempat Bekerja
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('unit'));?>">
							<a href="<?php echo base_url('ol_daftar/unit');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Ruangan
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('ms_peminatan'));?>">
							<a href="<?php echo base_url('ol_daftar/ms_peminatan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Peminatan
							</a>
						</li>
	          </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('kat_work','kategori_berkas','kategori_pelatihan','status_pegawai','status_pegawai_tambah','status_pegawai_edit')); ?>">
	         <a href="#">
	           <i class="fa fa-cog text-<?php echo $v; ?>"></i>
	           <span>Master</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('kategori_pelatihan'));?>">
							<a href="<?php echo base_url('ol_daftar/kategori_pelatihan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori Pelatihan
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('kategori_berkas'));?>">
							<a href="<?php echo base_url('ol_daftar/kategori_berkas');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori Berkas
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('kat_work'));?>">
							<a href="<?php echo base_url('ol_daftar/kat_work');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori Tempat Bekerja
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('status_pegawai','status_pegawai_tambah','status_pegawai_edit'));?>">
							<a href="<?php echo base_url('ol_daftar/status_pegawai');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Status Pegawai
							</a>
						</li>
	          </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('cabang','cabang_tambah','cabang_edit','jabatan_pengurus','pengurus','pengurus_tambah','pengurus_edit','pegawai_pengurus','pegawai_pengurus_tambah','pegawai_pengurus_edit','pegawai_pengurus_tambah','pengurus_tambah_pengurus')); ?>">
	         <a href="#">
	           <i class="fa fa-users text-<?php echo $v; ?>"></i>
	           <span>Organisasi</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('jabatan_pengurus'));?>">
							<a href="<?php echo base_url('ol_daftar/jabatan_pengurus');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Jabatan Pengurus
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('cabang','cabang_tambah','cabang_edit'));?>">
							<a href="<?php echo base_url('ol_daftar/cabang');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Wilayah
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('pengurus','pengurus_tambah','pengurus_edit'));?>">
							<a href="<?php echo base_url('ol_daftar/pengurus');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Pengurus
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('pegawai_pengurus','pegawai_pengurus_tambah','pegawai_pengurus_edit','pengurus_tambah_pengurus'));?>">
							<a href="<?php echo base_url('ol_daftar/pegawai_pengurus');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Anggota Pengurus
							</a>
						</li>
	          </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('work','work_tambah','work_edit','struktur','struktur_tambah','jabatan_struktur','pegawai_struktur','pegawai_struktur_tambah','pegawai_struktur_edit')); ?>">
	         <a href="#">
	           <i class="fa fa-hospital-o text-<?php echo $v; ?>"></i>
	           <span>Instansi</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('jabatan_struktur'));?>">
							<a href="<?php echo base_url('ol_daftar/jabatan_struktur');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Jabatan Struktur
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('work','work_tambah','work_edit'));?>">
							<a href="<?php echo base_url('ol_daftar/work');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Instansi
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('struktur','struktur_tambah'));?>">
							<a href="<?php echo base_url('ol_daftar/struktur');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Struktur Instansi
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('pegawai_struktur','pegawai_struktur_tambah','pegawai_struktur_edit'));?>">
							<a href="<?php echo base_url('ol_daftar/pegawai_struktur');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Anggota Struktur
							</a>
						</li>
	          </ul>
	        </li>
	       <li class="treeview <?php cek_aktif($page,array('kategori_surat','kategori_surat_edit','pengajuan_korespodensi','pengajuan_korespodensi_validasi','pengajuan_korespodensi_print')); ?>">
	         <a href="#">
	           <i class="fa fa-envelope text-<?php echo $v; ?>"></i>
	           <span>Korespodensi</span>
	           <span class="pull-right-container">
	             <i class="fa fa-angle-left pull-right"></i>
	           </span>
	         </a>
	         <ul class="treeview-menu">
	           <li class="<?php cek_aktif($page,array('kategori_surat','kategori_surat_edit'));?>">
							<a href="<?php echo base_url('ol_daftar/kategori_surat');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori
							</a>
						</li>
	           <li class="<?php cek_aktif($page,array('pengajuan_korespodensi','pengajuan_korespodensi_validasi','pengajuan_korespodensi_print'));?>">
							<a href="<?php echo base_url('ol_daftar/pengajuan_korespodensi');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Pengajuan
							</a>
						</li>
	          </ul>
	        </li>
					<li class="treeview <?php cek_aktif($page,array('kategori_kompetensi','kategori_kewenangan','kompetensi','kompetensi_tambah',
								'kompetensi_edit','kompetensi_clone','lulus','lulus_tambah','kompetensi_tambah_unit','cat_oppe','format_validator','etik','etik_tambah','etik_edit','relasi','relasi_tambah','butir_kegiatan','ms_etik','ms_etik_edit','ms_etik_tambah','etik_pegawai','etik_pegawai_lihat','etik_pegawai_tambah')); ?>">
					 	 	<a href="#"><i class="fa fa-file-o text-<?php echo $v; ?>"></i> Kredensial
								<span class="pull-right-container">
						  		<i class="fa fa-angle-left pull-right"></i>
								</span>
					  	</a>
					  <ul class="treeview-menu">
							<li class="<?php cek_aktif($page,array('kategori_kompetensi'));?>">
								<a href="<?php echo base_url('ol_daftar/kategori_kompetensi');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori Kompetensi
								</a>
							</li>
							<li class="treeview <?php cek_aktif($page,array('cat_oppe','format_validator')); ?>">
							  <a href="#"><i class="fa fa-cog text-<?php echo $v; ?>"></i> Format
								<span class="pull-right-container">
								  <i class="fa fa-angle-left pull-right"></i>
								</span>
							  </a>
							  <ul class="treeview-menu">
									<li class="<?php cek_aktif($page,array('cat_oppe'));?>">
										<a href="<?php echo base_url('ol_daftar/cat_oppe');?>">
											<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
												Rekom Nilai OPPE
										</a>
									</li>
									<li class="<?php cek_aktif($page,array('format_validator'));?>">
										<a href="<?php echo base_url('ol_daftar/format_validator');?>">
											<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
												Validator PerInstansi
										</a>
									</li>							
							  </ul>
							</li>
							<li class="treeview <?php cek_aktif($page,array('kategori_kewenangan','kompetensi','kompetensi_tambah','kompetensi_edit',
							'kompetensi_clone','kompetensi_tambah_unit','lulus','lulus_tambah','relasi','relasi_tambah','butir_kegiatan')); ?>">
							  <a href="#"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori Kewenangan
								<span class="pull-right-container">
								  <i class="fa fa-angle-left pull-right"></i>
								</span>
							  </a>
							  <ul class="treeview-menu">
									<li class="<?php cek_aktif($page,array('kategori_kewenangan'));?>">
										<a href="<?php echo base_url('ol_daftar/kategori_kewenangan');?>">
											<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
												Buku Putih
										</a>
									</li>
									<li class="<?php cek_aktif($page,array('kompetensi','kompetensi_tambah','kompetensi_edit','kompetensi_copy','kompetensi_clone','kompetensi_tambah_unit'));?>">
										<a href="<?php echo base_url('ol_daftar/kompetensi');?>">
											<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
												Detil
										</a>
									</li>
									<li class="<?php cek_aktif($page,array('lulus','lulus_tambah'));?>">
										<a href="<?php echo base_url('ol_daftar/lulus');?>">
											<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
												Lulus
										</a>
									</li>
									<li class="<?php cek_aktif($page,array('butir_kegiatan'));?>">
										<a href="<?php echo base_url('ol_daftar/butir_kegiatan');?>">
											<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
												Butir Kegiatan
										</a>
									</li>
									<li class="<?php cek_aktif($page,array('relasi','relasi_tambah'));?>">
										<a href="<?php echo base_url('ol_daftar/relasi');?>">
											<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> 
												KW Relasi Ke BK
										</a>
									</li>								
							  </ul>
							</li>
							<li class="treeview <?php cek_aktif($page,array('bcp')); ?>">
							  <a href="#"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Analisa
								<span class="pull-right-container">
								  <i class="fa fa-angle-left pull-right"></i>
								</span>
							  </a>
							  <ul class="treeview-menu">
								<li class="<?php cek_aktif($page,array('bcp'));?>">
									<a href="<?php echo base_url('ol_daftar/bcp');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> BCP / LogBook</a></li>
							  </ul>
							</li>
							<li class="treeview <?php cek_aktif($page,array('etik','etik_tambah','etik_edit','etik_pegawai','etik_pegawai_lihat','etik_pegawai_tambah','ms_etik','ms_etik_edit','ms_etik_tambah')); ?>">
							  <a href="#"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Etik
								<span class="pull-right-container">
								  <i class="fa fa-angle-left pull-right"></i>
								</span>
							  </a>
							  <ul class="treeview-menu">
				           <li class="<?php cek_aktif($page,array('etik','etik_tambah','etik_edit'));?>">
										<a href="<?php echo base_url('ol_daftar/etik');?>">
											<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Master Etik
										</a>
									</li>
					        <li class="<?php cek_aktif($page,array('ms_etik','ms_etik_edit','ms_etik_tambah'));?>">
										<a href="<?php echo base_url('ol_daftar/ms_etik');?>">
										<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Pilih Master Etik
										</a>
									</li>
					        <li class="<?php cek_aktif($page,array('etik_pegawai','etik_pegawai_lihat','etik_pegawai_tambah'));?>">
										<a href="<?php echo base_url('ol_daftar/etik_pegawai');?>">
										<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Etik User
										</a>
									</li>
							  </ul>
							</li>
					  </ul>
					</li>	
		      <li class="treeview <?php cek_aktif($page,array('slide_title')); ?>">
		         <a href="#">
		           <i class="fa fa-globe text-<?php echo $v; ?>"></i>
		           <span>Konten</span>
		           <span class="pull-right-container">
		             <i class="fa fa-angle-left pull-right"></i>
		           </span>
		         </a>
		         <ul class="treeview-menu">
		          <li class="<?php cek_aktif($page,array('slide_title'));?>">
								<a href="<?php echo base_url('ol_daftar/slide_title');?>">
									<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Text Web
								</a>
							</li>
		         </ul>
		        </li>
      </ul>
    </section>
  </aside>
  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>