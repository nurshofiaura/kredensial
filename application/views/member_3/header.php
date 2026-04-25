<?php
	if(empty($logonik)){
		$url_logo=base_url().'assets/berkas/logo/ppni.png';			
	}else{
		$cek_filesmall=FCPATH.'assets/berkas/logo/'.$logonik;
		if(file_exists($cek_filesmall)){
			$url_logo=base_url().'assets/berkas/logo/'.$logonik;
		}else{
			$url_logo=base_url().'assets/berkas/logo/ppni.png';	
		}				
	}
	if(empty($iconik)){
		$url_ikon=base_url().'assets/berkas/icon/ppni.ico';			
	}else{
		$cek_filesmall=FCPATH.'assets/berkas/icon/'.$iconik;
		if(file_exists($cek_filesmall)){
			$url_ikon=base_url().'assets/berkas/icon/'.$iconik;
		}else{
			$url_ikon=base_url().'assets/berkas/icon/ppni.ico';	
		}				
	}
	$url_beranda=base_url().$this->session->beranda;	
?>
<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" href="<?php echo $url_ikon; ?>">
		<title><?php echo $header; ?> | <?php echo $instance_name; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="index, follow">
		<meta name="description" content="<?php echo $idescription; ?>">
		<meta name="keywords" content="<?php echo $ikeywords; ?>">
		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
	  <!-- Google Font: Source Sans Pro -->
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/plugins/fontawesome-free/css/all.min.css">
	  <!-- daterange picker -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/plugins/daterangepicker/daterangepicker.css">
	  <!-- iCheck for checkboxes and radio inputs -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	  <!-- Bootstrap Color Picker -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	  <!-- Tempusdominus Bootstrap 4 -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	  <!-- Select2 -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/plugins/select2/css/select2.min.css">
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	  <!-- SweetAlert2 -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	  <!-- Toastr -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/plugins/toastr/toastr.min.css">
  	<!-- DataTables -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/datatables.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/css/buttons.dataTables.min.css">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin3/dist/css/adminlte.min.css">
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
		.select2-container {
		    width: 100% !important;
		    padding: 0;
		}
		</style>
	</head>
  <?php
  $adarkorlight = array('dark','light');
  $kadarkorlight = array_rand($adarkorlight);
  $darkorlight = $adarkorlight[$kadarkorlight];
  if($darkorlight == 'dark'){
    $darkoposite = 'light';
    $text = 'black';
  }elseif($darkorlight == 'light'){
    $darkoposite = 'dark';
    $text = 'white';
  }else{
  	$darkoposite = 'light';
  	$text = 'black';
  	$darkorlight = 'dark';  	
  }
  $array = array('-primary','-secondary','-warning','-info','-danger','-success','-indigo','-lightblue','-navy','-purple','-fuchsia','-pink','-maroon','-orange','-lime','-teal','-olive','-white');
  $k = array_rand($array);
  $v = $array[$k];  
  ?>
<body class="hold-transition sidebar-mini-xs <?php echo $darkorlight; ?>-mode mb-4 sidebar-collapse layout-fixed layout-footer-fixed text-sm">
  <!-- dark-mode mb-4 layout-navbar-fixed sidebar-collapse layout-footer-fixed-->		
<?php
if(empty($this->session->id_level)){
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
}else{
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
  <!-- dropdown-legacy  mb-1 border-bottom-0 -->
  <nav class="main-header navbar navbar-expand navbar<?php echo $v; ?> navbar-<?php echo $darkoposite; ?> text-sm">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php  echo base_url('member/profil');?>" class="nav-link">
        	<i class="fa fa-user"></i> Profil</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('logout');?>" class="nav-link">
        	<i class="fa fa-lock"></i> Sign Out</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-<?php echo $darkoposite; ?><?php echo $v; ?> elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $url_beranda; ?>" class="brand-link">
      <img src="<?php echo $url_logo; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold"><?php echo $iheader; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $url_thumb; ?>" style="width:160;height:160;" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <span style="color: <?php echo $text; ?>;font-weight: bold;"><?php echo $level_name; ?></spa>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="nav-compact mr-1 text-sm">
        <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Multi Akses
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
	         	<?php
	         		foreach($multi_level as $rowmulti_level) {
	         	?>
              <li class="nav-item">
                <a href="<?php echo base_url($rowmulti_level['link_akses']);?>" class="nav-link">
                  <i class="far fa-circle nav-icon text-<?php echo $v; ?>"></i> 
                  <p><?= $rowmulti_level['nama_akses'] ?></p>
                </a>
              </li>
	         	<?php 
	         		}
	         	?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php  echo base_url('member/profil');?>" class="nav-link <?php cek_aktif($page,array('profil')); ?>">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profile
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link <?php cek_aktif($page,array('berkas','berkas_tambah','berkas_edit','ijasah','ijasah_tambah','ijasah_edit','pelatihan','pelatihan_tambah','pelatihan_edit','surat_ijin','surat_ijin_tambah','surat_ijin_edit','surat_ijin_perpanjangan')); ?>">
              <i class="nav-icon fa fa-file"></i>
              <p>
                Berkas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('member/berkas');?>" class="nav-link <?php cek_aktif($page,array('berkas','berkas_tambah','berkas_edit'));?>">
                  <i class="far fa-circle nav-icon text-<?php echo $v; ?>"></i>
                  <p>Berkas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('member/ijasah');?>" class="nav-link <?php cek_aktif($page,array('ijasah','ijasah_tambah','ijasah_edit'));?>">
                  <i class="far fa-circle nav-icon text-<?php echo $v; ?>"></i>
                  <p>Ijasah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('member/pelatihan');?>" class="nav-link <?php cek_aktif($page,array('pelatihan','pelatihan_tambah','pelatihan_edit'));?>">
                  <i class="far fa-circle nav-icon text-<?php echo $v; ?>"></i>
                  <p>Pelatihan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('member/surat_ijin');?>" class="nav-link <?php cek_aktif($page,array('surat_ijin','surat_ijin_tambah','surat_ijin_edit','surat_ijin_perpanjangan'));?>">
                  <i class="far fa-circle nav-icon text-<?php echo $v; ?>"></i>
                  <p>Surat Ijin</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
              	<div id="timer_waktu"></div>
                <SCRIPT language=JavaScript>
									function Timer() {
									   var hr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
									   var bl = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
									   var dt=new Date()
									   document.getElementById('timer_waktu').innerHTML=hr[dt.getDay()]+", "+dt.getDate()+" "+bl[dt.getMonth()]+" "+dt.getFullYear()+" ["+ dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds()+"]";
									   setTimeout("Timer()",1000);
									}
									Timer();
                </SCRIPT>
              </li>
              <li class="breadcrumb-item">
                <SCRIPT language=JavaScript>var d = new Date();
                  var h = d.getHours();
                  if (h < 11) { document.write('SELAMAT PAGI '); }
                  else { if (h < 15) { document.write('SELAMAT SIANG '); }
                  else { if (h < 19) { document.write('SELAMAT SORE '); }
                  else { if (h <= 23) { document.write('SELAMAT MALAM '); }
                  }}}
                </SCRIPT> &nbsp;
                <?php echo $member_name; ?>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>