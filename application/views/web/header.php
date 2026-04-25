<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" href="<?php echo base_url();?>assets/images/ppni.ico">
		<title><?php echo $header; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="index, follow">
		<meta name="description" content="<?php echo $header; ?>">
		<meta name="keywords" content="<?php echo $ikeywords; ?>">

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

		<!-- WEB FONTS : use %7C instead of | (pipe) -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="<?php echo base_url();?>assets/webassets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<!-- REVOLUTION SLIDER -->
		<link href="<?php echo base_url();?>assets/webassets/plugins/slider.revolution.v5/css/pack.css" rel="stylesheet" type="text/css" />

		<!-- THEME CSS -->
		<link href="<?php echo base_url();?>assets/webassets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/webassets/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/webassets/css/thematics-restaurant.css" rel="stylesheet" type="text/css" />

		<!-- PAGE LEVEL SCRIPTS -->
		<link href="<?php echo base_url();?>assets/webassets/css/header-1.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/webassets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
	</head>

	<!--
		AVAILABLE BODY CLASSES:
		
		smoothscroll 			= create a browser smooth scroll
		enable-animation		= enable WOW animations

		bg-grey					= grey background
		grain-grey				= grey grain background
		grain-blue				= blue grain background
		grain-green				= green grain background
		grain-blue				= blue grain background
		grain-orange			= orange grain background
		grain-yellow			= yellow grain background
		
		boxed 					= boxed layout
		pattern1 ... patern11	= pattern background
		menu-vertical-hide		= hidden, open on click
		
		BACKGROUND IMAGE [together with .boxed class]
		data-background="assets/images/_smarty/boxed_background/1.jpg"
	-->
	<body class="smoothscroll enable-animation">

		<!-- wrapper -->
		<div id="wrapper">

			<!-- 
				AVAILABLE HEADER CLASSES

				Default nav height: 96px
				.header-md 		= 70px nav height
				.header-sm 		= 60px nav height

				.b-0 		= remove bottom border (only with transparent use)
				.transparent	= transparent header
				.translucent	= translucent header
				.sticky			= sticky header
				.static			= static header
				.dark			= dark header
				.bottom			= header on bottom
				
				shadow-before-1 = shadow 1 header top
				shadow-after-1 	= shadow 1 header bottom
				shadow-before-2 = shadow 2 header top
				shadow-after-2 	= shadow 2 header bottom
				shadow-before-3 = shadow 3 header top
				shadow-after-3 	= shadow 3 header bottom

				.clearfix		= required for mobile menu, do not remove!

				Example Usage:  class="clearfix sticky header-sm transparent b-0"
			-->
			<div id="header" class="navbar-toggleable-md sticky header-md clearfix">

				<!-- TOP NAV -->
				<header id="topNav">
					<div class="container">

						<!-- Mobile Menu Button -->
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>

						<!-- Logo -->
						<a class="logo float-left" href="<?php echo base_url();?>">
							<img src="<?php echo base_url();?>assets/images/ppni_header.png" style="width:100px;height:50px" alt="" />
						</a>

						<!-- 
							Top Nav 
							
							AVAILABLE CLASSES:
							submenu-dark = dark sub menu
						-->
						<div class="navbar-collapse collapse float-right nav-main-collapse">
							<nav class="nav-main">

								<!--
									NOTE
									
									For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
									Direct Link Example: 

									<li>
										<a href="#">HOME</a>
									</li>
								-->
								<ul id="topMain" class="nav nav-pills nav-main">
									<!-- 
										MENU ANIMATIONS
											.nav-animate-fadeIn
											.nav-animate-fadeInUp
											.nav-animate-bounceIn
											.nav-animate-bounceInUp
											.nav-animate-flipInX
											.nav-animate-flipInY
											.nav-animate-zoomIn
											.nav-animate-slideInUp

											.nav-hover-animate 		= animate text on hover

											.hover-animate-bounceIn = bounceIn effect on mouse over of main menu
									-->
									<li class="dropdown mega-menu nav-animate-fadeIn nav-hover-animate hover-animate-bounceIn"><!-- THEMATIC -->										
										<a class="dropdown-toggle noicon" href="#">
											<span class="badge badge-danger float-right fs-11"></span>
											<i class="fa fa-cogs"></i> <b>MENU</b>
										</a>
										<ul class="dropdown-menu dropdown-menu-clean">
											<li>
												<div class="row">

													<div class="col-md-5th">
														<ul class="list-unstyled">
															<li class="divider"></li>
															<li>
																<span class="fs-11 mt-0 pb-15 pt-15 text-info">
																<?= $desc1 ?>
																</span>
															</li>
															<li class="divider"></li>
															<li><a href="<?php echo base_url('');?>">Beranda</a></li>
															<li class="divider"></li>
															<?php  
																if($masuk_menu == 1){
															?>
															<li><a href="<?php echo base_url('masuk');?>">LOGIN USER</a></li>
															<?php  
																}
															?>
															<li class="divider"></li>
															<?php  
																if($ppni_menu == 1){
															?>
															<li><a href="<?php echo base_url('ol_registrasi');?>">REGISTRASI PROFESI</a></li>
															<?php  
																}
															?>
															<li class="divider"></li>
															<li><span class="fs-11 mt-0 pb-15 pt-15 text-success">
																SELAMAT DATANG DI WEB KAMI
																</span>
															</li>
															<li class="divider"></li>
															<?php  
																if($login_menu == 1){
															?>
															<li><a href="<?php echo base_url('login');?>">LOGIN SIKAS</a></li>
															<?php  
																}
															?>
															<li class="divider"></li>
															<?php  
																if($sikas_menu == 1){
															?>
															<li><a href="<?php echo base_url('registrasi');?>">REGISTRASI SIKAS</a></li>
															<?php  
																}
															?>
															<li class="divider"></li>
															<?php  
																if($nakes_menu == 1){
															?>
															<li><a href="<?php echo base_url('data/registrasi');?>">REGISTRASI NAKES LAINNYA</a></li>
															<?php  
																}
															?>
														</ul>
													</div>

													<div class="col-md-5th">
														<ul class="list-unstyled">
															<li><span>ONCARE</span></li>
															<li class="divider"></li>
															<li><a href="<?php echo base_url('#');?>">FORUM</a></li>
															<li class="divider"></li>
															<li><span>LAIN-LAIN</span></li>
															<li class="divider"></li>

															<li><a href="<?php echo base_url('landing');?>">TUTORIAL</a></li>
															<li class="divider"></li>

														</ul>
													</div>

													<div class="col-md-5th">
														<ul class="list-unstyled">
														<li><span>GRAFIK DAN TABEL</span></li>
															<li class="divider"></li>
															<li><a href="<?php echo base_url();?>data/gender">Grafik Gender </a></li>
															<li><a href="<?php echo base_url();?>data/pk">Grafik PK </a></li>
															<li><a href="<?php echo base_url();?>data/jabfung">Grafik Fungsional </a></li>
															<li><a href="<?php echo base_url();?>data/pendidikan">Grafik Pendidikan </a></li>
															<li><a href="<?php echo base_url();?>data/agama">Grafik Agama </a></li>
															<li><a href="<?php echo base_url();?>data/status_perkawinan">Grafik Perkawinan </a></li>
															<li><a href="<?php echo base_url();?>data/status_pegawai">Grafik Kepegawaian </a></li>
															<li><a href="<?php echo base_url();?>data/pelatihan">Grafik Pelatihan </a></li>
															<li><a href="<?php echo base_url();?>data/demografi">Grafik Demografi </a></li>


														</ul>
													</div>

													<div class="col-md-6 hidden-sm text-center">
														<div class="p-15 block">
															<img class="img-fluid" src="<?php echo base_url();?>assets/images/ppni_cover.png" alt="" />
														</div>
														<p class="menu-caption hidden-xs-down text-muted text-center">
															<?php echo $header; ?>
														</p>
													</div>

												</div>
											</li>
										</ul>
									</li>
								</ul>

							</nav>
						</div>

					</div>
				</header>
				<!-- /Top Nav -->
			</div>		
			  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
			  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>			