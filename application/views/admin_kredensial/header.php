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
      <span class="logo-lg"><b>MASTER</b></span>
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
		<li><a href="<?php echo base_url($this->session->beranda);?>"><i class="fa fa-cog text-<?php echo $v; ?>"></i> <span>Dashboard</span></a></li>
        <li class="<?php cek_aktif($page,array('form1'));?>">
					<a href="<?php echo base_url('admin_kredensial/form1');?>">
						<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 1
					</a>
				</li>
       <li class="treeview <?php cek_aktif($page,array('elemen','asesmen','qf_2','format_question','format_question_seting')); ?>">
          <a href="#">
            <i class="fa fa-cogs text-<?php echo $v; ?>"></i>
            <span>Form 2</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php cek_aktif($page,array('elemen'));?>">
							<a href="<?php echo base_url('admin_kredensial/elemen');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Elemen Kompetensi
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('asesmen'));?>">
							<a href="<?php echo base_url('admin_kredensial/asesmen');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Komponen Asesmen
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('qf_2'));?>">
							<a href="<?php echo base_url('admin_kredensial/qf_2');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Question Form 2
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('format_question','format_question_seting'));?>">
							<a href="<?php echo base_url('admin_kredensial/format_question');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 2
							</a>
						</li>
          </ul>
        </li>
       <li class="treeview <?php cek_aktif($page,array('indikator','metode','perangkat','alat','alatbahan','metodist','form3','form3_seting')); ?>">
          <a href="#">
            <i class="fa fa-cogs text-<?php echo $v; ?>"></i>
            <span>Form 3</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php cek_aktif($page,array('metode'));?>">
							<a href="<?php echo base_url('admin_kredensial/metode');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Metode Asesmen
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('perangkat'));?>">
							<a href="<?php echo base_url('admin_kredensial/perangkat');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Perangkat Asesmen
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('alat'));?>">
							<a href="<?php echo base_url('admin_kredensial/alat');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Input Alat dan Bahan
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('alatbahan'));?>">
							<a href="<?php echo base_url('admin_kredensial/alatbahan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Seting Alat dan Bahan
							</a>
						</li>			
            <li class="<?php cek_aktif($page,array('indikator'));?>">
							<a href="<?php echo base_url('admin_kredensial/indikator');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Indikator Unjuk Kerja
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('form3','form3_seting'));?>">
							<a href="<?php echo base_url('admin_kredensial/form3');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 3
							</a>
						</li>					
          </ul>
        </li>
       <li class="treeview <?php cek_aktif($page,array('ceklis','form4','form4_seting','form4b','form4b_seting','form4c','form4c_seting','form4d','form4_addition','form4d_seting')); ?>">
          <a href="#">
            <i class="fa fa-cogs text-<?php echo $v; ?>"></i>
            <span>Form 4</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">	
            <li class="<?php cek_aktif($page,array('form4_addition'));?>">
							<a href="<?php echo base_url('admin_kredensial/form4_addition');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Ms Form 4
							</a>
						</li>	
            <li class="<?php cek_aktif($page,array('form4','form4_seting'));?>">
							<a href="<?php echo base_url('admin_kredensial/form4');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 4A
							</a>
						</li>		
            <li class="<?php cek_aktif($page,array('form4b','form4b_seting'));?>">
							<a href="<?php echo base_url('admin_kredensial/form4b');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 4B
							</a>
						</li>		
            <li class="<?php cek_aktif($page,array('form4c','form4c_seting'));?>">
							<a href="<?php echo base_url('admin_kredensial/form4c');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 4C
							</a>
						</li>	
        <li class="<?php cek_aktif($page,array('form4d','form4d_seting'));?>">
					<a href="<?php echo base_url('admin_kredensial/form4d');?>">
						<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 4D
					</a>
				</li>	
          </ul>
        </li>
       <li class="treeview <?php cek_aktif($page,array('langkah','kegiatan','form5','form5_seting','form6','form6_seting')); ?>">
          <a href="#">
            <i class="fa fa-cogs text-<?php echo $v; ?>"></i>
            <span>Form 5 & 6</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php cek_aktif($page,array('langkah'));?>">
							<a href="<?php echo base_url('admin_kredensial/langkah');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Langkah
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('kegiatan'));?>">
							<a href="<?php echo base_url('admin_kredensial/kegiatan');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kegiatan
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('form5','form5_seting'));?>">
							<a href="<?php echo base_url('admin_kredensial/form5');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 5
							</a>
						</li>				
            <li class="<?php cek_aktif($page,array('form6','form6_seting'));?>">
							<a href="<?php echo base_url('admin_kredensial/form6');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 6
							</a>
						</li>	
          </ul>
        </li>
        <li class="<?php cek_aktif($page,array('form7'));?>">
					<a href="<?php echo base_url('admin_kredensial/form7');?>">
						<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 7
					</a>
				</li>
        <li class="<?php cek_aktif($page,array('form8'));?>">
					<a href="<?php echo base_url('admin_kredensial/form8');?>">
						<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Banding Asesmen
					</a>
				</li>
       <li class="treeview <?php cek_aktif($page,array('kat_kaji_ulang','kaji_ulang','form9a','form9a_seting','form9b','form9b_seting')); ?>">
          <a href="#">
            <i class="fa fa-cogs text-<?php echo $v; ?>"></i>
            <span>Form 9</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php cek_aktif($page,array('kat_kaji_ulang'));?>">
							<a href="<?php echo base_url('admin_kredensial/kat_kaji_ulang');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Kategori Kaji Ulang
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('kaji_ulang'));?>">
							<a href="<?php echo base_url('admin_kredensial/kaji_ulang');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Komp & Aspek Kaji Ulang
							</a>
						</li>
            <li class="<?php cek_aktif($page,array('form9a','form9a_seting'));?>">
							<a href="<?php echo base_url('admin_kredensial/form9a');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 9A
							</a>
						</li>				
            <li class="<?php cek_aktif($page,array('form9b','form9b_seting'));?>">
							<a href="<?php echo base_url('admin_kredensial/form9b');?>">
								<i class="fa fa-circle-o text-<?php echo $v; ?>"></i> Form 9B
							</a>
						</li>	
          </ul>
        </li>
      </ul>
    </section>
  </aside>
  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>