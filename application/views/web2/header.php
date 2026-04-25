<!DOCTYPE html>
<html lang="en">
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
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->

		<!-- WEB FONTS : use %7C instead of | (pipe) -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<!-- SWIPER SLIDER -->
		<link href="<?php echo base_url();?>assets/plugins/slider.swiper/dist/css/swiper.min.css" rel="stylesheet" type="text/css" />

		<!-- THEME CSS -->
		<link href="<?php echo base_url();?>assets/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/layout-datatables.css" rel="stylesheet" type="text/css" />

		<!-- PAGE LEVEL SCRIPTS -->
		<link href="<?php echo base_url();?>assets/css/header-1.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
	</head>

	<?php
	if ($page=="home")
	{
	?>
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
	<body class="smoothscroll enable-animation grain-grey">
	<?php
	}else{
	?>
	<!--
		AVAILABLE BODY CLASSES:

		smoothscroll 			= create a browser smooth scroll
		enable-animation		= enable WOW animations
	-->
	<body class="smoothscroll enable-animation">
	<?php
	}
	?>
		<!-- wrapper -->
		<div id="wrapper">

			<!-- Top Bar -->
			<div id="topBar">

				<div class="container">

					<!-- right -->
					<ul class="top-links list-inline float-right">
						<?php
						if ($opsi_login== 1){
						?>
						<li class="hidden-xs-down"><a href="<?php echo base_url();?>masuk">LOGIN</a></li>
						<li class="hidden-xs-down"><a href="<?php echo base_url();?>ol_registrasi">REGISTER</a></li>
						<?php
						}
						else{
						?>
						<li class="hidden-xs-down"><a href="<?php echo base_url();?>login">LOGIN</a></li>
						<li class="hidden-xs-down"><a href="<?php echo base_url();?>registrasi">REGISTER</a></li>
						<?php
						}
						?>
					</ul>

					<!-- left -->
					<ul class="top-links list-inline">
						<li class="hidden-xs-down"><a href="<?php echo base_url();?>web/faq">TUTORIAL</a></li>
					</ul>
				</div>

				<?php
				if ($page=="home")
				{
				?>
				<div class="border-top block clearfix">
					<div class="container">

						<!-- Logo -->
						<a class="logo has-banner float-left text-center-md" href="<?php echo base_url();?>">
							<img src="<?php echo base_url();?>assets/images/sikas.svg" alt="" style="width:150px"/>
						</a>

			<!--			<a class="banner float-right hidden-sm hidden-xs-down" href="#">
							<img src="assets/images/banner.png" alt="banner" />
						</a> -->

					</div>
				</div>
				<?php
				}
				?>
			</div>
			<!-- /Top Bar -->

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
			<div id="header" class="navbar-toggleable-md sticky header-sm clearfix">

				<!-- TOP NAV -->
				<header id="topNav">
					<div class="container">

						<!-- Mobile Menu Button -->
						<button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
							<i class="fa fa-bars"></i>
						</button>

						<!--
							Top Nav

							AVAILABLE CLASSES:
							submenu-dark = dark sub menu
						-->
						<?php
						if ($page=="home")
						{
						?>
						<div class="navbar-collapse collapse float-left nav-main-collapse pl-0 pr-0">
						<?php
						}else{
						?>
						<a class="logo float-left" href="<?php echo base_url();?>">
							<img src="<?php echo base_url();?>assets/images/sikas.svg" alt="" style="width:150px"/>
						</a>
						<div class="navbar-collapse collapse float-right nav-main-collapse submenu-dark">
						<?php
						}
						 ?>
							<nav class="nav-main">

								<!--


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
									<li><a href="<?php echo base_url();?>"><b>BERANDA</b></a></li>
									<li class="dropdown mega-menu nav-animate-fadeIn nav-hover-animate hover-animate-bounceIn"><!-- THEMATIC -->
										<a class="dropdown-toggle noicon" href="#">
											<span class="badge badge-danger float-right fs-11"><?= $idescription ?></span>
											<b>MENU</b>
										</a>
										<ul class="dropdown-menu dropdown-menu-clean">
											<li>
												<div class="row">

													<div class="col-md-4">
														<ul class="list-unstyled">
															<li><span><?= $idescription ?></span></li>
															<li class="divider"></li>
															<li>
																<span class="fs-11 mt-0 pb-15 pt-15 text-info"><?= $instance_name ?></span>
															</li>
															<li class="divider"></li>
						<?php
						if ($opsi_login== 1){
						?>
						<li class="hidden-xs-down"><a href="<?php echo base_url();?>masuk">LOGIN</a></li>
						<li class="hidden-xs-down"><a href="<?php echo base_url();?>ol_registrasi">REGISTER</a></li>
						<?php
						}
						else{
						?>
						<li class="hidden-xs-down"><a href="<?php echo base_url();?>login">LOGIN</a></li>
						<li class="hidden-xs-down"><a href="<?php echo base_url();?>registrasi">REGISTER</a></li>
						<?php
						}
						?>
															<li class="divider"></li>
															<li><a href="<?php echo base_url();?>web/faq">TUTORIAL</a></li>
														</ul>
															<hr class="half-margins" /><!-- separator -->
														<div class="p-15 block text-right">
															<img class="img-fluid" src="<?php echo base_url();?>assets/images/statistik.png" alt="" style="width:100px"/>
														</div>
													</div>

													<div class="col-md-4">
														<ul class="list-unstyled">
															<li><span>GRAFIK DAN TABEL</span></li>
															<li class="divider"></li>
															<li><a href="<?php echo base_url();?>web/logbook">Tabel LogBook </a></li>
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

													<div class="col-md-4 hidden-sm text-center">
														<div class="p-15 block">
															<img class="img-fluid" src="<?php echo base_url();?>assets/images/nakes.png" alt="" style="width:300px"/>
														</div>
														<p class="menu-caption hidden-xs-down text-muted text-center">
															<?= $header ?>
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
