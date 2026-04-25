<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico">
		<title><?php echo $header; ?> | <?php echo $instance_name; ?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
.huruf-14 {
  font-family: Times New Roman;
  font-size: 20pt;
  line-height: 2;  
}
.huruf-12 {
  font-family: Times New Roman;
  font-size: 12pt;
  line-height: 2;  
}
#chartdiv {
  width: 100%;
  height: 1000px;
}
@media print {
a {
  color: black;
  word-wrap: break-word;
}
 a[href]:after {
    word-wrap: break-word;
    display: none;
    visibility: hidden;
 }
  .taborder {
     border: 1px solid #000000!important;
  }
}
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}
</style>
	</head>
	<?php
	$array = array('green','blue','yellow','red','purple');
	$k = array_rand($array);
	$v = $array[$k];	
	?>
<body class="hold-transition skin-<?php echo $v; ?> layout-top-nav text-sm">
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
    <nav class="navbar navbar-static-top text-sm">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url();?><?php if ( $this->session->has_userdata('id_pegawai') ) echo $this->session->beranda; ?>" class="navbar-brand"><b><?php echo $header; ?></b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">

        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
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
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo $url_thumb; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $member_name; ?></span>
              </a>
              <ul class="dropdown-menu" style="box-shadow:10px 10px 5px grey; margin-right: 5px;">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo $url_thumb; ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo $member_name; ?>
                  <small><?php echo $level_name; ?></small>
                </p>
                </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url('external');?>" class="btn btn-default btn-flat">Dashboard</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('masuk');?>" class="btn btn-default btn-flat">Login</a>
                </div>
              </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>
  <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>