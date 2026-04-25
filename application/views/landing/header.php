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


		<!-- up to 10% speed up for external res -->
		<link rel="dns-prefetch" href="https://fonts.googleapis.com/">
		<link rel="dns-prefetch" href="https://fonts.gstatic.com/">
		<link rel="preconnect" href="https://fonts.googleapis.com/">
		<link rel="preconnect" href="https://fonts.gstatic.com/">
		<!-- preloading icon font is helping to speed up a little bit -->
		<link rel="preload" href="<?php echo base_url();?>assets/fonts/flaticon/Flaticon.woff2" as="font" type="font/woff2" crossorigin>

		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/core.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/vendor_bundle.min.css">
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700&display=swap" rel="stylesheet">
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
	<body class="header-sticky header-over">

		<div id="wrapper">
			<!-- Header -->
			<header id="header" class="shadow-xs">


				<!-- Navbar -->
				<div class="container position-relative">

					<nav class="navbar navbar-expand-lg navbar-light justify-content-lg-between justify-content-md-inherit">

						<div class="align-items-start">

							<!-- mobile menu button : show -->
							<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMainNav" aria-controls="navbarMainNav" aria-expanded="false" aria-label="Toggle navigation">
								<svg width="25" viewBox="0 0 20 20">
									<path d="M 19.9876 1.998 L -0.0108 1.998 L -0.0108 -0.0019 L 19.9876 -0.0019 L 19.9876 1.998 Z"></path>
									<path d="M 19.9876 7.9979 L -0.0108 7.9979 L -0.0108 5.9979 L 19.9876 5.9979 L 19.9876 7.9979 Z"></path>
									<path d="M 19.9876 13.9977 L -0.0108 13.9977 L -0.0108 11.9978 L 19.9876 11.9978 L 19.9876 13.9977 Z"></path>
									<path d="M 19.9876 19.9976 L -0.0108 19.9976 L -0.0108 17.9976 L 19.9876 17.9976 L 19.9876 19.9976 Z"></path>
								</svg>
							</button>

<!-- navbar : brand (logo) 
							<a class="navbar-brand" href="?php echo base_url();?>">
								<img src=" echo base_url();?>assets/images/logo/logo_dark.png" width="110" height="38" alt="...">
								<img src=" echo base_url();?>assets/images/logo/logo_light.png" width="110" height="38" alt="...">
							</a>-->

						</div>




						<!-- Menu -->
						<div class="collapse navbar-collapse navbar-animate-fadein justify-content-end" id="navbarMainNav">


							<!-- navbar : mobile menu -->
							<div class="navbar-xs d-none"><!-- .sticky-top -->

								<!-- mobile menu button : close -->
								<button class="navbar-toggler pt-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMainNav" aria-controls="navbarMainNav" aria-expanded="false" aria-label="Toggle navigation">
									<svg width="20" viewBox="0 0 20 20">
										<path d="M 20.7895 0.977 L 19.3752 -0.4364 L 10.081 8.8522 L 0.7869 -0.4364 L -0.6274 0.977 L 8.6668 10.2656 L -0.6274 19.5542 L 0.7869 20.9676 L 10.081 11.679 L 19.3752 20.9676 L 20.7895 19.5542 L 11.4953 10.2656 L 20.7895 0.977 Z"></path>
									</svg>
								</button>

								<!-- 
									Mobile Menu Logo 
									Logo : height: 70px max
								-->
								<a class="navbar-brand" href="<?php echo base_url();?>">
									<img src="<?php echo base_url();?>assets/images/logo/logo_dark.png" width="110" height="38" alt="...">
								</a>

							</div>
							<!-- /navbar : mobile menu -->



							<!-- navbar : navigation -->
							<ul class="navbar-nav fs-6">

								<!-- about -->
								<li class="nav-item">

									<a class="nav-link scroll-to" href="#logbook">
										LOGBOOK
									</a>

								</li>

								<!-- about -->
								<li class="nav-item">

									<a class="nav-link scroll-to" href="#pengajuan">
										PENGAJUAN KOMPETENSI
									</a>

								</li>


								<!-- about -->
								<li class="nav-item">

									<a class="nav-link scroll-to" href="#validasi">
										VALIDASI
									</a>

								</li>

								<li class="nav-item">

									<a class="nav-link scroll-to" href="#spk">
										SPK
									</a>

								</li>
							</ul>
							<!-- /navbar : navigation -->
						</div>
						<!-- OPTIONS -->
						<ul class="list-inline list-unstyled mb-0 d-flex align-items-end">

						</ul>
						<!-- /OPTIONS -->
					</nav>
				</div>
				<!-- /Navbar -->
			</header>
			<!-- /Header -->