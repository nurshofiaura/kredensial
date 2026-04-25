<?php
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
  <!-- ganti customizer
    <nav class="selected vertical-sidebar">
    <nav class="selected horizontal-sidebar">
    <nav class="selected dark-sidebar">
    -->
    <nav class="vertical-sidebar text-secondary small-text">
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
          <li class="no-sub">
            <a class="" href="<?= base_url($this->session->beranda) ?>" aria-expanded="true">
              <i class="ti ti-home"></i> Dashboard
            </a>
          </li>
          <li>
            <a class="" data-bs-toggle="collapse" href="#slider1" aria-expanded="false">
              <i class="ph-duotone  ph-house-line"></i>
              dashboard
              <span class="badge text-bg-success badge-notification ms-2">4</span>
            </a>
            <ul class="collapse" id="slider1">
              <li><a href="index.html">Ecommerce</a></li>
              <li><a href="project_dashboard.html">Project</a></li>
              <li><a href="crypto_dashboard.html">Crypto</a></li>
              <li><a href="education.html">Education</a></li>
            </ul>
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