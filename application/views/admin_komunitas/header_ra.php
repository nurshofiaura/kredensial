<?php date_default_timezone_set('Asia/Makassar'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template">
  <meta name="keywords"
    content="admin template, ra-admin admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="la-themes">
  <link rel="icon" href="<?= base_url() ?>assets/images/logo/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/logo/favicon.png" type="image/x-icon">

  <title><?php echo $header; ?> | <?php echo $instance_name; ?></title>

  <!--font-awesome-css-->
  <link rel="stylesheet" href="rassets/vendor/fontawesome/css/all.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">

  <!-- wheather icon css-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/weather/weather-icons.css">
  <link rel="stylesheet" type="text/css" href="rassets/vendor/weather/weather-icons-wind.css">
  
  <!-- prism css-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/prism/prism.min.css">

  <!-- Animation css -->
  <link rel="stylesheet" href="rassets/vendor/animation/animate.min.css">

  <!-- tabler icons-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/tabler-icons/tabler-icons.css">

  <!--flag Icon css-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/flag-icons-master/flag-icon.css">

  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/bootstrap/bootstrap.min.css">

  <!-- apexcharts css-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/apexcharts/apexcharts.css">

  <!-- simplebar css-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/simplebar/simplebar.css">

  <!-- slick css -->
  <link rel="stylesheet" href="rassets/vendor/slick/slick.css">
  <link rel="stylesheet" href="rassets/vendor/slick/slick-theme.css">
  
  <!-- glight css -->
  <link rel="stylesheet" href="rassets/vendor/glightbox/glightbox.min.css">

  <!-- filepond css -->
  <link rel="stylesheet" href="rassets/vendor/filepond/filepond.css">
  <link rel="stylesheet" href="rassets/vendor/filepond/image-preview.min.css">

  <!-- Data Table css-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/datatable/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="rassets/vendor/datatable/datatable2/buttons.dataTables.min.css">

  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="rassets/css/style.css">

  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="rassets/css/responsive.css">

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

<body text="rtl light small-text">
  <!-- ganti customizer
    <body class="box-layout" text="large-text">
    <body class="rtl light" text="medium-text">
    <body class="ltr dark" text="small-text">
    -->
<?php
	$array = array('hot','gold','happy','warm','default');
	$k = array_rand($array);
	$v = $array[$k];
?>
  <div class="app-wrapper <?= $v ?>" text="small-text">
  <!-- ganti customizer
    <div class="app-wrapper hot" text="large-text">
    <div class="app-wrapper gold" text="medium-text">
    <div class="app-wrapper happy" text="small-text">
    <div class="app-wrapper warm" text="small-text">
    <div class="app-wrapper default" text="small-text">
    -->
    <div class="loader-wrapper">
      <div class="app-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
    <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>