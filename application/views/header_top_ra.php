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
  <link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">

  <title><?php echo $header; ?> | <?php echo $instance_name; ?></title>

  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/fontawesome/css/all.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">

  <!-- Data Table css-->
  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/datatable/jquery.dataTables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/datatable/buttons.dataTables.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/datatable/select.dataTables.min.css">
  
  <!-- wheather icon css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/weather/weather-icons.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/weather/weather-icons-wind.css">
  
  <!-- prism css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/prism/prism.min.css">

  <!-- Animation css -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/animation/animate.min.css">

  <!-- tabler icons-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/tabler-icons/tabler-icons.css">

  <!--flag Icon css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/flag-icons-master/flag-icon.css">

  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/bootstrap/bootstrap.min.css">

  <!-- apexcharts css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/apexcharts/apexcharts.css">

  <!-- simplebar css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/simplebar/simplebar.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/datepikar/flatpickr.min.css">

  <!-- Selecrt css -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/select/select2.min.css">

  <!-- Toatify css-->
  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/notifications/toastify.min.css">

  <!-- apexcharts css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/vendor/apexcharts/apexcharts.css">

  <!-- slick css -->
  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/slick/slick.css">
  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/slick/slick-theme.css">
  
  <!-- glight css -->
  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/glightbox/glightbox.min.css">

  <!-- filepond css -->
  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/filepond/filepond.css">
  <link rel="stylesheet" href="<?= base_url() ?>rassets/vendor/filepond/image-preview.min.css">

  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/css/style.css">

  <!-- Responsive css -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>rassets/css/responsive.css">
  <!--<link rel="stylesheet" type="text/css" href="<= base_url() ?>rassets/css/index.global.min.css">
   <link rel="stylesheet" type="text/css" href="<= base_url() ?>rassets/css/toastui-calendar.min.css">-->
  <style>
    .blinking {
      animation: blinkOpacity 2s ease-in-out infinite;
    }

    @keyframes blinkOpacity {
      0%   { opacity:1; }
      50%  { opacity:.5; }
      100% { opacity:0; }
    }
   /* ===== BUTTON LOADING ===== */
 .ra-loading {
   pointer-events: none;
   opacity: .7;
 }
 .ra-spinner {
   display: inline-block;
   margin-right: 6px;
 }
.ra-spinner {
  display:inline-flex;
  align-items:center;
}
 /* ===== SELECT2 FIX ===== */
 .select2-container {
   z-index: 1060;
 }
 .select2-dropdown {
   z-index: 1065;
 }
 .select2-container .select2-selection--single {
    height: 38px !important; /* ukuran md bootstrap */
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 38px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 38px !important;
}
/* ======================================================
   DATATABLE BUTTONS & SELECT – STABLE VERSION
   CI3 + Bootstrap 4/5 SAFE
   ====================================================== */
/* ---------- CHECKBOX SELECT ---------- */
td.select-checkbox::before {
    content:"☐";
    color:#adb5bd;
    font-size:14px;
}
tr.selected td.select-checkbox::before {
    content:"☑";
    color:#556ee6;
    font-weight:bold;
}
.dataTables_wrapper {
    overflow-x: auto;
}
.dataTables_wrapper .dt-buttons {
    justify-content: center;
    display: flex;
    align-items: center;
    gap: 6px;

    margin-left: 16px;   /* ⬅️ INI KUNCINYA */
    margin-bottom: 8px;
}

/* ---------- BUTTONS CONTAINER ---------- */
.dt-buttons-wrap {
    padding-left: 12px;      /* geser dari kiri */
    padding-top: 4px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.dt-buttons {
    float: none !important;
    position:relative;
    z-index:20;
}

/* ---------- CORE BUTTON ---------- */
.dt-buttons .btn {
    display:inline-flex !important;
    align-items:center;
    gap:6px;

    height:32px;
    padding: 4px 10px !important;
    font-size:11.5px !important;
    font-weight:500;

    border-radius:7px !important;
    border:1px solid transparent !important;

    line-height:1;
    white-space:nowrap;
    cursor:pointer;

    transition:all .15s ease;
    pointer-events:auto !important;
}

/* ---------- ICON BUTTON ---------- */
.dt-buttons .btn-icon {
    width:32px !important;
    height:32px !important;
    padding:0 !important;
    justify-content:center;
    border-radius:50% !important;
}

/* ---------- HOVER ---------- */
.dt-buttons .btn:hover {
    filter:brightness(.95);
}
//==========================================
/* ---------- COLOR THEMES ---------- */
.dt-buttons .btn-primary   {background:#5ccad6!important;color:#fff!important;}
.dt-buttons .btn-secondary {background:#8b8378!important;color:#fff!important;}
.dt-buttons .btn-success   {background:#b6d91d!important;color:#fff!important;}
.dt-buttons .btn-danger    {background:#ff6b45!important;color:#fff!important;}
.dt-buttons .btn-warning   {background:#f3c742!important;color:#212529!important;}
.dt-buttons .btn-info      {background:#5a63f2!important;color:#fff!important;}
.dt-buttons .btn-light     {background:#e6e3df!important;color:#212529!important;}
.dt-buttons .btn-dark      {background:#3f3b36!important;color:#fff!important;}

/* ---------- OUTLINE ---------- */
.dt-buttons .btn-outline-primary   {color:#5ccad6!important;border-color:#5ccad6!important;}
.dt-buttons .btn-outline-secondary {color:#8b8378!important;border-color:#8b8378!important;}
.dt-buttons .btn-outline-success   {color:#b6d91d!important;border-color:#b6d91d!important;}
.dt-buttons .btn-outline-danger    {color:#ff6b45!important;border-color:#ff6b45!important;}
.dt-buttons .btn-outline-warning   {color:#f3c742!important;border-color:#f3c742!important;}
.dt-buttons .btn-outline-info      {color:#5a63f2!important;border-color:#5a63f2!important;}
.dt-buttons .btn-outline-dark      {color:#3f3b36!important;border-color:#3f3b36!important;}

/* ---------- PASTEL ---------- */
.dt-buttons .btn-pastel {border:none!important;}
.dt-buttons .btn-pastel-primary   {background:#e6f8fb!important;color:#2ec7d3!important;}
.dt-buttons .btn-pastel-secondary {background:#f1ede8!important;color:#8c7b6a!important;}
.dt-buttons .btn-pastel-success   {background:#f0f9e6!important;color:#9acd32!important;}
.dt-buttons .btn-pastel-danger    {background:#ffece6!important;color:#ff5733!important;}
.dt-buttons .btn-pastel-warning   {background:#fff6db!important;color:#f2b705!important;}
.dt-buttons .btn-pastel-info      {background:#eef0ff!important;color:#5864ff!important;}
//==========================================

/* ===============================
   BASE BUTTON (AMAN)
   =============================== */
.btn {
  display:inline-flex;
  align-items:center;
  gap:6px;
  cursor:pointer;
  border:1px solid transparent;
  font-weight:500;
  transition:all .15s ease;
}

/* ===============================
   COLORS (BOOTSTRAP STYLE)
   =============================== */
.ra-btn.btn-primary{background:#0d6efd;color:#fff}
.ra-btn.btn-success{background:#198754;color:#fff}
.ra-btn.btn-warning{background:#ffc107;color:#212529}
.ra-btn.btn-danger{background:#dc3545;color:#fff}
.ra-btn.btn-info{background:#0dcaf0;color:#212529}
.ra-btn.btn-secondary{background:#6c757d;color:#fff}
.ra-btn.btn-dark{background:#212529;color:#fff}

.btn-outline-primary{border-color:#0d6efd;color:#0d6efd;background:transparent}
.btn-outline-success{border-color:#198754;color:#198754;background:transparent}
.btn-outline-warning{border-color:#ffc107;color:#ffc107;background:transparent}
.btn-outline-danger{border-color:#dc3545;color:#dc3545;background:transparent}
.btn-outline-info{border-color:#0dcaf0;color:#0dcaf0;background:transparent}
.btn-outline-secondary{border-color:#6c757d;color:#6c757d;background:transparent}
.btn-outline-dark{border-color:#212529;color:#212529;background:transparent}

/* ===============================
   SHAPES
   =============================== */
.btn-pill       { border-radius:999px!important; }
.btn-square     { border-radius:0!important; }
.btn-rounded-sm { border-radius:4px!important; }
.btn-rounded-lg { border-radius:12px!important; }

/* ===============================
   SIZES
   =============================== */
.btn-xs { height:26px;font-size:10px;padding:2px 8px; }
.btn-sm { height:30px;font-size:11px;padding:4px 10px; }
.btn-md { height:36px;font-size:12px;padding:6px 12px; }

/* ===============================
   ICON BUTTON
   =============================== */
.btn-icon {
  width:32px;
  height:32px;
  padding:0;
  justify-content:center;
}

/* ===============================
   EFFECTS
   =============================== */
.btn-soft-shadow { box-shadow:0 4px 10px rgba(0,0,0,.15); }

.btn-glow {
  animation: glowPulse 2s infinite;
}
@keyframes glowPulse {
  0%   { box-shadow:0 0 0 rgba(0,0,0,0); }
  50%  { box-shadow:0 0 12px rgba(90,99,242,.6); }
  100% { box-shadow:0 0 0 rgba(0,0,0,0); }
}

.btn-ghost {
  background:transparent!important;
  border-style:dashed!important;
}

/* ==== FIX WHITE TEXT ==== */
.btn-ghost,
.btn-outline-primary,
.btn-outline-success,
.btn-outline-warning,
.btn-outline-danger,
.btn-outline-info {
  color: currentColor!important;
}

.btn-ghost.btn-loading::after {
  border-top-color: currentColor!important;
}

/* ===== LOADING BUTTON ===== */
.ra-loading {
  opacity:.85;
}

.d-inline-flex-center {
  display:inline-flex;
  align-items:center;
  justify-content:center;
}

.icon-btn {
  width:36px;
  height:36px;
  padding:0!important;
}

/* ---------- DROPDOWN (COLVIS / EXPORT) ---------- */
.dt-button-collection {
    padding:8px !important;
    z-index:9999 !important;
}
.dt-button-collection .dt-button {
    display:block;
    width:100%;
    text-align:left;
    margin-bottom:4px;
    color:#212529!important;
    background:#fff!important;
}
.dt-button-collection .dt-button.active {
    background:#556ee6!important;
    color:#fff!important;
}
/* ===============================
   FIX DATATABLE ROW SELECTED
   =============================== */

table.dataTable tbody tr.selected,
table.dataTable tbody tr.selected > td {
    background-color: #0d6efd !important; /* biru */
    color: #fff !important;
}

/* hover saat selected */
table.dataTable tbody tr.selected:hover,
table.dataTable tbody tr.selected:hover > td {
    background-color: #0b5ed7 !important;
}

/* hilangkan efek striped yang nabrak */
table.dataTable.table-striped tbody tr.selected:nth-of-type(odd),
table.dataTable.table-striped tbody tr.selected:nth-of-type(even) {
    background-color: #0d6efd !important;
}
table.dataTable tbody tr.selected td.dt-control {
    background-color: #0d6efd !important;
}
table.dataTable tbody tr.selected td {
    border-color: rgba(255,255,255,.2);
}

/* ---------- MOBILE ---------- */
@media (max-width:768px){
    .dt-buttons .btn {
        font-size:11px!important;
        padding:4px 8px!important;
    }
}
td.dt-control {
    cursor: pointer;
    text-align: center;
}

td.dt-control:before {
    content: "+";
    background: #0d6efd;
    color: #fff;
    padding: 3px 8px;
    border-radius: 4px;
}

tr.shown td.dt-control:before {
    content: "-";
}
tr.shown + tr td table tbody tr:hover {
    background-color: #f1f5ff !important;
    cursor: pointer;
}
/* ===== DARK MODE AUTO ===== */
@media (prefers-color-scheme: dark) {
    .dt-buttons .btn-pastel {
        filter:brightness(.9);
    }
}
/*.select2-container {
    position: relative !important;
    z-index: 1000 !important;
}*/

/* ===============================
   RA-ADMIN CUSTOM THEMES
   =============================== */
/* 1. BLUE */
.app-wrapper.blue {
  --primary-color: #1677ff;
  --secondary-color: #e6f4ff;
  --text-color: #000;
  --text-stroke-color: #fff;
}

/* 2. PURPLE */
.app-wrapper.purple {
  --primary-color: #722ed1;
  --secondary-color: #f9f0ff;
  --text-color: #000;
  --text-stroke-color: #fff;
}

/* 3. TEAL */
.app-wrapper.teal {
  --primary-color: #13c2c2;
  --secondary-color: #e6fffb;
  --text-color: #000;
  --text-stroke-color: #fff;
}

/* 4. GREEN */
.app-wrapper.green {
  --primary-color: #389e0d;
  --secondary-color: #f6ffed;
  --text-color: #000;
  --text-stroke-color: #fff;
}

/* 5. CYAN */
.app-wrapper.cyan {
  --primary-color: #08979c;
  --secondary-color: #e6fffb;
  --text-color: #000;
  --text-stroke-color: #fff;
}

/* 6. INDIGO */
.app-wrapper.indigo {
  --primary-color: #2f54eb;
  --secondary-color: #f0f5ff;
  --text-color: #000;
  --text-stroke-color: #fff;
}

/* 7. PINK */
.app-wrapper.pink {
  --primary-color: #eb2f96;
  --secondary-color: #fff0f6;
  --text-color: #000;
  --text-stroke-color: #fff;
}

/* 8. ORANGE */
.app-wrapper.orange {
  --primary-color: #fa541c;
  --secondary-color: #fff2e8;
  --text-color: #000;
  --text-stroke-color: #fff;
}

/* 9. BROWN */
.app-wrapper.brown {
  --primary-color: #8b5a2b;
  --secondary-color: #f5eee6;
  --text-color: #fff;
  --text-stroke-color: #000;
}

/* 10. NAVY (DARK) */
.app-wrapper.navy {
  --primary-color: #001529;
  --secondary-color: #f0f2f5;
  --text-color: #fff;
  --text-stroke-color: #000;
}

/* ===============================
   FOOTER TEXT OVERRIDE
   =============================== */
.footer-text {
  color: var(--text-color);

  /* ultra-thin adaptive stroke */
/*  text-shadow:
    -0.2px 0 0 var(--text-stroke-color),
     0.2px 0 0 var(--text-stroke-color),
     0 -0.2px 0 var(--text-stroke-color),
     0  0.2px 0 var(--text-stroke-color);
}*/
.app-wrapper {
  --text-color: #000;
  --text-stroke-color: #fff;
}
/* ===============================
   SIDEBAR
   =============================== */
.vertical-sidebar .main-nav ul {
  padding-left: 0;
  margin-left: 0;
}
.vertical-sidebar .main-nav > li > a {
  padding-left: 9px;
}
.vertical-sidebar .main-nav > li > ul > li > a {
  padding-left: 12px;   /* ⬅️ KIRI BANGET TAPI AMAN */
  font-size: 10px;
  opacity: .95;
}
.vertical-sidebar .main-nav > li > ul > li > ul > li > a {
  padding-left: 14px;
  font-size: 10px;
}
.vertical-sidebar .main-nav > li > ul {
  position: relative;
}

.vertical-sidebar .main-nav > li > ul::before {
  content: "";
  position: absolute;
  left: 18px;
  top: 8px;
  bottom: 8px;
  width: 1px;
  background: rgba(255,255,255,.12);
}
.dark-sidebar .main-nav > li > ul::before {
  background: rgba(255,255,255,.18);
}
.select-example-container {
    width: 100% !important;
    padding: 0;
}

  </style>
</head>

<body text="small-text">
  <!-- ganti customizer
    <body class="box-layout" text="large-text">
    <body class="rtl light" text="medium-text">
    <body class="ltr dark" text="small-text">
    -->
<?php
  $arraywrap = array('hot','gold','happy','warm','default','blue','purple','teal','green','cyan','indigo','pink','orange','brown','navy','navy');
	$kwrap = array_rand($arraywrap);
	$vwrap = $arraywrap[$kwrap];
$array = array('green','blue','yellow','red','purple');
$k = array_rand($array);
$v = $array[$k];    
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
?>
  <div class="app-wrapper <?= $vwrap ?>" text="small-text">
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
  <!-- ganti customizer
    <nav class="selected vertical-sidebar">
    <nav class="selected horizontal-sidebar">
    <nav class="selected dark-sidebar">
    -->
    <nav class="selected horizontal-sidebar">
      <div class="app-logo">
        <a class="logo d-inline-block text-center" style="font-size: 1.5em;font-weight: bold;" href="<?= base_url($this->session->beranda) ?>">
          <i class="ti ti-brand-kickstarter"></i> KREDENSIAL.COM
        </a>
        <span class="bg-light-primary toggle-semi-nav">
          <i class="ti ti-chevrons-right f-s-20"></i>
        </span> 
      </div>
      <div class="app-nav" id="app-simple-bar">
        <ul class="main-nav p-0 mt-2">
          <li class="menu-title">
            <span>Dashboard</span>
          </li>
          <li>
            <a href="<?= base_url($this->session->beranda) ?>">
              <i class="ph-duotone  ph-house-line"></i>
              dashboard
            </a>
          </li>
        </ul>
      </div>

      <div class="menu-navs">
      <!--  <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
        <span class="menu-next"><i class="ti ti-chevron-right"></i></span>-->
      </div>

    </nav>

    <div class="app-content">
      <div class="">

        <header class="header-main">
          <div class="container-fluid">
            <div class="row">
              <div class="col-6 col-sm-4 d-flex align-items-center header-left p-0">
                <span class="header-toggle me-3">
                  <i class="ph ph-circles-four"></i>
                </span>
              </div>
              <div class="col-6 col-sm-8 d-flex align-items-center justify-content-end header-right p-0">
                <ul class="d-flex align-items-center">
                  <li class="header-cloud">
                    <div class="head-icon" id="timer_waktu" style="font-size: 1em;"></div>
                  </li>
                  <li class="header-cloud">
                    <div class="head-icon" style="font-size: 1em;">
                    <SCRIPT language=JavaScript>var d = new Date();
                      var h = d.getHours();
                      if (h < 11) { document.write('SELAMAT PAGI '); }
                      else { if (h < 15) { document.write('SELAMAT SIANG '); }
                      else { if (h < 19) { document.write('SELAMAT SORE '); }
                      else { if (h <= 23) { document.write('SELAMAT MALAM '); }
                      }}}
                    </SCRIPT>
                    </div>
                  </li>
                  <li class="header-profile">
                    <a href="#" class="d-block head-icon" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#profilecanvasRight" aria-controls="profilecanvasRight">
                      <img src="<?= $url_thumb ?>" alt="avtar" class="b-r-10 h-35 w-35">
                    </a>

                   <div class="offcanvas offcanvas-end header-profile-canvas" tabindex="-1" id="profilecanvasRight"
                         aria-labelledby="profilecanvasRight">
                      <div class="offcanvas-body app-scroll">
                        <ul class="">
                          <li>
                            <div class="d-flex-center">
                              <span class="h-45 w-45 d-flex-center b-r-10 position-relative">
                                <img src="<?= $url_thumb ?>" alt="" class="img-fluid b-r-10">
                              </span>
                            </div>
                            <div class="text-center mt-2">
                              <h6 class="mb-0"> <?= $member_name ?></h6>
                              <p class="f-s-12 mb-0 text-secondary">ANGGOTA</p>
                            </div>
                          </li>

                          <li class="app-divider-v dotted py-1"></li>
                          <li>
                            <a class="f-w-500" href="<?= base_url('member/profil') ?>">
                              <i class="ph-duotone  ph-user-circle pe-1 f-s-20"></i> Profile Details
                            </a>
                          </li>
                          <li class="app-divider-v dotted py-1"></li>
                          <li>
                            <a class="mb-0 text-danger" href="<?= base_url('logout') ?>">
                              <i class="ph-duotone  ph-sign-out pe-1 f-s-20"></i> Log Out
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </header>