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
//	$array = array('green','blue','yellow','red','purple');
	$array = array('yellow');
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
      <span class="logo-mini"><b>KR</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>KARU</b></span>
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
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="pop1" data-content="Shortcut" rel="popover" data-placement="bottom" >
              <i class="fa fa-list-alt"></i>
			  <?php
				if($notifikasi > 0){
						echo'<span class="label label-success blinking"><i class="fa fa-exclamation"></i></span>';
				}
			  ?>
            </a>
            <ul class="dropdown-menu">
              <li>
                <ul class="menu">
				  <?php
						foreach($link_notification as $rowlink_notification){
						$url_link=base_url().$rowlink_notification['link_notification'];
							echo'
							  <li>
								<a href="'.$url_link.'">
								  <i class="fa fa-list-alt text-green blinking"></i> '.$rowlink_notification['nama_notification'].
								'</a>
							  </li>
							';
						}
				  ?>
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="pop2" data-content="Berkas" rel="popover" data-placement="bottom">
              <i class="fa fa-file-text"></i>
			  <?php
				if($jml_str >= 1){
					echo'<span class="label label-danger blinking"><i class="fa fa-exclamation"></i></span>';
				}elseif($jml_sip >= 1){
					echo'<span class="label label-danger blinking"><i class="fa fa-exclamation"></i></span>';
				}elseif($jml_sik >= 1){
					echo'<span class="label label-danger blinking"><i class="fa fa-exclamation"></i></span>';
				}
			  ?>
            </a>
            <ul class="dropdown-menu">
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
					<?php
						foreach($ambil_berkas_expired as $rowambil_berkas_expired){
						if(empty($rowambil_berkas_expired['foto'])){
							$url_thumbambil_berkas_expired=base_url().'assets/images/noavatar.jpg';
						}else{
							$cek_filesmallambil_berkas_expired=FCPATH.'assets/foto/member/small/'.$rowambil_berkas_expired['foto'];
							if(file_exists($cek_filesmallambil_berkas_expired)){
								$url_thumbambil_berkas_expired=base_url().'assets/foto/member/small/'.$rowambil_berkas_expired['foto'];
							}else{
								$url_thumbambil_berkas_expired=base_url().'assets/images/noavatar.jpg';
							}
						}
					?>
                  <li>
                    <a href="<?php echo base_url('perawat/str');?>">
                      <div class="pull-left">
                        <img src="<?php echo $url_thumbambil_berkas_expired; ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?php echo $rowambil_berkas_expired['nama_kategori_berkas']; ?>
                        <small><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y', strtotime($rowambil_berkas_expired['tgl_b_berkas'])); ?></small>
                      </h4>
                      <p> <?php echo $rowambil_berkas_expired['nama_kategori_berkas']; ?> Anda </p>
                    </a>
                  </li>
					<?php
						}
					?>
                </ul>
              </li>
            </ul>
          </li>
          <li class="dropdown messages-menu">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="pop3" data-content="Birthday" rel="popover" data-placement="bottom">
              <i class="fa fa-birthday-cake"></i>
              <span class="label label-danger"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <ul class="menu">
					<?php
						foreach($ambil_birthday as $rowambil_birthday){
						if(empty($rowambil_birthday['foto'])){
							$url_thumbambil_birthday=base_url().'assets/images/noavatar.jpg';
						}else{
							$cek_filesmallambil_birthday=FCPATH.'assets/foto/member/small/'.$rowambil_birthday['foto'];
							if(file_exists($cek_filesmallambil_birthday)){
								$url_thumbambil_birthday=base_url().'assets/foto/member/small/'.$rowambil_birthday['foto'];
							}else{
								$url_thumbambil_birthday=base_url().'assets/images/noavatar.jpg';
							}
						}
					?>
                  <li>
                    <a>
                      <div class="pull-left">
                        <img src="<?php echo $url_thumbambil_birthday; ?>" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?php echo substr($rowambil_birthday['nama_pegawai'],0,14); ?>..
                        <small><i class="fa fa-clock-o"></i> <?php echo date('d-m-Y', strtotime($rowambil_birthday['tgl_lahir'])); ?></small>
                      </h4>
                      <div class="progress xs">
						<?php
							if(date('m-d') == substr($rowambil_birthday['tgl_lahir'],5,5)) {
								echo '<div class="progress-bar progress-bar-green" style="width: 100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        </div>';
							}else{
								echo '<div class="progress-bar progress-bar-aqua" style="width: 100%" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        </div>'; }
						?>
                      </div>

                    </a>
                  </li>
					<?php
						}
					?>
                </ul>
              </li>
            </ul>
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
                  <a href="<?php  echo base_url('pegawai/profil');?>" class="btn btn-default btn-flat">Profile</a>
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
		<li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard text-<?php echo $v; ?>"></i> <span>Dashboard</span></a></li>
		<li class="<?php cek_aktif($page,array('grafik')); ?>">
			<a href="<?php echo base_url('karu/grafik');?>">
				<i class="fa fa-line-chart text-<?php echo $v; ?>"></i> Grafik Poin
			</a>
		</li>
        <li class="treeview <?php cek_aktif($page,array('user','user_edit','etik','etik_lihat','etik_tambah')); ?>">
          <a href="#">
            <i class="fa fa-cog text-<?php echo $v; ?>"></i>
            <span>Umum</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php cek_aktif($page,array('user','user_edit','user_tambah'));?>">
				<a href="<?php echo base_url('karu/user');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> User</a></li>
             <li class="<?php cek_aktif($page,array('etik','etik_lihat','etik_tambah'));?>">
				<a href="<?php echo base_url('karu/etik');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Etik</a></li>
             <li class="<?php cek_aktif($page,array('jadwal'));?>">
				<a href="<?php echo base_url('jadwal');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Jadwal</a></li>
             <li class="<?php cek_aktif($page,array('berkas'));?>">
				<a href="<?php echo base_url('berkas');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Berkas, Grafik dan OPPE</a></li>
             <li class="<?php cek_aktif($page,array('anjababk'));?>">
				<a href="<?php echo base_url('anjababk');?>"><i class="fa fa-circle-o text-<?php echo $v; ?>"></i>Analisa Beban Kerja</a></li>
				<li class="<?php cek_aktif($page,array('kegiatan'));?>">
					<a href="<?php echo base_url('kegiatan');?>">
					<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kegiatan Pemulihan
					</a>
				</li>
          </ul>
        </li>
       <li class="treeview <?php cek_aktif($page,array('logbook','logbook_tambah')); ?>">
          <a href="#">
            <i class="fa fa-book text-<?php echo $v; ?>"></i>
            <span>Logbook</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php cek_aktif($page,array('logbook','logbook_tambah'));?>">
				<a href="<?php echo base_url('karu/logbook');?>">
					<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Validasi
				</a>
			</li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>
  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>
