<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
$attr_ra = [
    'class' => 'select-example'
];
if ($page=="homex")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">MENU DATA LEVEL</h3>
                  <div class="box-tools pull-right"></div>
                </div>
                <div class="box-body">
                   <?php 
/*                   echo $isi_whatsnew; 
                   if($this->session->id_level == 99){
                    echo '<pre>'; print_r($this->session->all_userdata());
                   }
                      //    $isi_whatsnew = strip_tags($isi_whatsnew); 
                     //     $isi_whatsnew = html_entity_decode($isi_whatsnew); 
                    //      $isi_whatsnew = substr($isi_whatsnew,0,70); 
                   //     echo $isi_whatsnew;  
                        $es = '3';
                        $session = 'id_pengcab-'.$es;
                        echo $this->session->$session;*/
                //          echo '<pre>'; print_r($this->session->all_userdata());
                          
  //  $_SESSION['matresult'][$i][$j] = $matrixa[$i][$j] + $matrixb[$i][$j]; 
 //   echo $_SESSION['nama_pengcab'][2];
                //          echo ;
                  ?> 
               <button onclick="location.href='<?php  echo base_url('ol_pengajuan');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/kompetensi.png');?>"> <br>Kompetensi
              </button> 
              <?php  
                foreach ($shortcut as $rowshortcut){
              ?>
               <button onclick="location.href='<?= base_url($rowshortcut['link_shortcut']) ?>'" >
                <img style="width:75px;height:75px;" src="<?= base_url($rowshortcut['icon_shortcut']) ?>"> <br><?= $rowshortcut['judul_shortcut'] ?>
              </button>
              <?php  
                }
                if($cek_billing > 0){
              ?>
              <button type="button" class="LihatBilling" data-toggle="tooltip" data-placement="right" 
                title="Lihat Billing" data-toggle="modal" data-target="#modal-default">
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/billing.png');?>"> <br>Billing
              </button>
              <?php  
                }
              ?>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">MENU DATA PERSONAL</h3>
                  <div class="box-tools pull-right"></div>
                </div>
                <div class="box-body">
               <button onclick="location.href='<?php  echo base_url('member/profil');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/profil.png');?>"> <br>Profil
              </button> 
               <button onclick="location.href='<?php  echo base_url('member/berkas');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/berkas.png');?>"> <br>Berkas
              </button> 
               <button onclick="location.href='<?php  echo base_url('member/ijasah');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/ijasah.png');?>"> <br>Ijasah
              </button> 
               <button onclick="location.href='<?php  echo base_url('member/pelatihan');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/sertifikat.png');?>"> <br>Pelatihan
              </button> 
               <button onclick="location.href='<?php  echo base_url('member/surat_ijin');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/str.png');?>"> <br>Surat Ijin
              </button> 

               <button onclick="location.href='<?php  echo base_url('jadwal_all/lihat_jadwal');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/jadwal.png');?>"> <br>Jadwal Jaga
              </button> 
               <button onclick="location.href='<?php  echo base_url('jadwal_all/chat');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/laporan.png');?>"> <br>Laporan Jaga
              </button> 
               <button onclick="location.href='<?php  echo base_url('ol_logbook');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/logbook.png');?>"> <br>Logbook
              </button> 
               <button onclick="location.href='<?php  echo base_url('member/tes');?>'" >
                <img style="width:75px;height:75px;" src="<?php echo base_url('assets/images/tes.png');?>"> <br>Latihan Kompetensi
              </button>               
                </div>
              </div>
            </div>            
<?php 
  $dateb = date("Y-m-d", strtotime("+1 years"));
  $all_surat_ijin=$this->m_ol_rancak->ambil_berkas_surat_ijin_list();
  foreach ($all_surat_ijin as $rowall_surat_ijin){
?>
<div class="col-md-6">
      <h4>
        <i class="fa fa-file-text-o"></i> <?= $rowall_surat_ijin['nama_berkas_kategori'] ?> <small>[ SURAT IJIN ]</small>
      </h4>
            <?php 
        if($rowall_surat_ijin['lifetime_berkas'] == '0'){
              if($rowall_surat_ijin['tgl_b_berkas'] <= date('Y-m-d')){
            ?>
                   <button class="btn btn-danger btn-xs">
                      <?= date('d-m-Y', strtotime($rowall_surat_ijin['tgl_b_berkas'])) ?>
                    </button>    
            <?php 
              }elseif(($rowall_surat_ijin['tgl_b_berkas'] >= date('Y-m-d')) && ($rowall_surat_ijin['tgl_b_berkas'] <= $dateb)){
            ?>
                   <button class="btn btn-warning btn-xs">
                      <?= date('d-m-Y', strtotime($rowall_surat_ijin['tgl_b_berkas'])) ?>
                    </button> 
            <?php 
              }else{
             ?>
                   <button class="btn btn-success btn-xs">
                      <?= date('d-m-Y', strtotime($rowall_surat_ijin['tgl_b_berkas'])) ?>
                    </button>            
            <?php             
              }
        }else{
          echo '<button class="btn btn-success btn-xs">SEUMUR HIDUP</button>';
        }
?>
</div>
<?php
  }
?>
          </div>
        </div>
        <div class="box-footer">
<button class="btn btn-xs btn-success">Pengajuan Aktif : <?= $lunas ?></button>
<button class="btn btn-xs btn-warning">Pengajuan Pending : <?= $blm_lunas ?></button>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="home")
{
?>
<style>
.shortcut-card {
  cursor: pointer;
  transition: all .3s;
}
.shortcut-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0,0,0,.15);
}

.chat-card {
  height: 100%;
}
.chat-body {
  height: 260px;
  overflow-y: auto;
}
.chat-message {
  margin-bottom: 10px;
}
.chat-message.left .bubble {
  background: #f1f1f1;
  padding: 8px 12px;
  border-radius: 10px;
  display: inline-block;
}
.chat-message.right {
  text-align: right;
}
.chat-message.right .bubble {
  background: #0d6efd;
  color: #fff;
  padding: 8px 12px;
  border-radius: 10px;
  display: inline-block;
}

.dashboard-card {
    border-radius: 14px;
    border: 1px solid #eee;
    box-shadow: 0 2px 6px rgba(0,0,0,.08);   /* shadow default */
    transition: all .25s ease;
}
.dashboard-card:hover {
    box-shadow: 0 8px 20px rgba(0,0,0,.15); /* shadow saat hover */
    transform: translateY(-3px);
}
.card {
  height: 100%;
}

/* Paksa legend rata kiri */
.apexcharts-legend {
    display: grid !important;
    grid-template-columns: repeat(2, 1fr);
    justify-content: flex-start !important;
    flex-wrap: wrap !important;
}

.apexcharts-legend-series {
    justify-content: flex-start !important;
    margin: 4px 8px !important; /* margin atas/bawah 4px, kiri/kanan 8px */
   /* margin: 4px 15px 4px 8px;  atas 4px, kanan 15px, bawah 4px, kiri 8px */
    width: 70%; /* 2 kolom */
}

/* legend jadi 2 kolom */
.apexcharts-legend {

}

/* jarak antar item */
.apexcharts-legend-series {
    
}

/* kecilkan teks biar muat */
.apexcharts-legend-text {
    font-size: 11px !important;
}

/* Gradient header & rounded */
/* Gradient header & rounded */
.table-gradient {
    background: linear-gradient(135deg, #7752FE, #33C1FF);
    border-radius: 0.5rem 0.5rem 0 0;
}
.table-hover tbody tr:hover {
    background-color: rgba(119, 82, 254, 0.1);
    transform: scale(1.02);
    transition: all 0.2s ease-in-out;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(119, 82, 254, 0.05);
}
#tbl_berkas th, #tbl_berkas td {
    vertical-align: middle;
}
.kpi { display: inline-block; padding: 10px 20px; background: #f2f2f2; border-radius: 5px; margin-right: 20px; text-align: center; }
table { border-collapse:collapse; width:100%; margin-top:20px;table-layout: auto; }
        table, th, td { border:1px solid #ccc; }
        th, td { padding:8px; text-align:left;font-size:10px;white-space: nowrap; }

/* WRAP TEXT EVENT */
.toastui-calendar-event-title{
  white-space: normal !important;
  word-break: break-word;
  line-height: 1.2;
}

/* BATASI TINGGI EVENT */
.toastui-calendar-month-event{
  max-height: 42px;
  overflow: hidden;
}

/* HINDARI KOLOM MELEBAR */
.toastui-calendar-grid-cell{
  min-width: 0 !important;
}
</style>
<main>

  <div class="container-fluid">

    <!-- ROW 1 : FULL WIDTH -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5>Shortcut</h5>
          </div>
          <div class="card-body">
            <div class="container-fluid">
                <div class="row g-3">
                    <?php foreach ($cards as $c): 
                        $attr = card_attr($c);
                    ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="<?= $attr['href'] ?>" <?= $attr['extra'] ?> class="text-decoration-none">
                            <div class="card h-100 text-center dashboard-card">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center">

                                    <img src="<?= $c['image'] ?>"
                                         style="width:60px;height:60px;"
                                         class="mb-2">

                                    <div class="fw-semibold small">
                                        <?= $c['title'] ?>
                                    </div>

                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php
            /* 060200009482626
            Shortcut Gabungan = <?php foreach ($cards as $c): ?> <?php endforeach ?>
            Shortcut dari DB = <?php foreach ($cards_db_saja as $c): ?> <?php endforeach ?>
            Shortcut dari Array = <?php foreach ($dari_array_saja as $c): ?> <?php endforeach ?>
            */
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- ROW 3 : 2 KOLOM -->
    <div class="row mb-4">
      <div class="col-md-6 mb-3 mb-md-0">
        <div class="card chat-card">
          <div class="card-header">
            <h5>📅 Kalendar Acara</h5>
          </div>
          <div class="card-body">
<div class="d-flex justify-content-between align-items-center mb-2">
  <div>
    <button class="btn btn-sm btn-outline-primary" id="btnPrev">‹</button>
    <button class="btn btn-sm btn-outline-primary" id="btnToday">Today</button>
    <button class="btn btn-sm btn-outline-primary" id="btnNext">›</button>
  </div>

  <strong id="calTitle"></strong>

  <div>
    <button class="btn btn-sm btn-outline-secondary" data-view="month">Month</button>
    <button class="btn btn-sm btn-outline-secondary" data-view="week">Week</button>
    <button class="btn btn-sm btn-outline-secondary" data-view="day">Day</button>
  </div>
</div>
            <div id="calendar" style="height:800px;"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body chat-body" style="height:400px; overflow:auto;">
   <div class="kpi">Total Kredit: <strong><?php echo $total_kredit; ?></strong></div>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama Pelatihan</th>
            <th>Kategori</th>
            <th>Kredit</th>
            <th>Penyelenggara</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pelatihan as $p): ?>
        <tr>
            <td><?php echo date('d-m-Y',strtotime($p['tgl_b_berkas'])); ?></td>
            <td><?php echo $p['nama_berkas']; ?></td>
            <td><?php echo $p['nama_kategori_pelatihan']; ?></td>
            <td><?php echo $p['kredit']; ?></td>
            <td><?php echo $p['penyelenggara']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-6 mb-3 mb-md-0">
        <div class="card h-100">
          <div class="card-header">
            <div class="col-md-6">
            <?php
              input_pdselect2("tahun_pie", $tahun_list, $tahun_pie, $attr_ra);
            ?>
            </div>
          </div>
          <div class="card-body">
            <div id="pie1" class="chart-sm"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card h-100">
          <div class="card-header">
            <h5>Grafik Line dan Pie Logbook</h5>
          </div>
          <div class="card-body">
            <div id="line1" class="chart-lg"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ROW 2 : 2 KOLOM -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h5>Jadwal Dinas</h5>
          </div>

          <div class="card-body">

            <!-- FILTER -->
            <div class="row mb-3">
              <div class="col-md-3">
                <label>Bulan</label>
              <?php
                input_pdselect2("bulan", $cmd_bulan, $bulan, $attr_ra);
              ?>
              </div>
              <div class="col-md-3">
                <label>Tahun</label>
              <?php
                input_pdselect2("tahun", $cmd_tahun, $tahun, $attr_ra);
              ?>
              </div>
              <div class="col-md-3 d-flex align-items-end">
                <button
                  type="button"
                  id="btnFilter"
                  class="btn btn-primary"
                >
                  <i class="fa fa-refresh"></i> Proses
                </button>
              </div>
            </div>
            <div id="jadwal-wrapper"></div>
            <hr>
            <div id="jadwal-wrapper2"></div>
          </div>
        </div>
      </div>
    </div>

  </div>


</main>
<div class="modal fade" id="raModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="raModalTitle"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body" id="raModalBody">
        <div class="text-center p-5">
          <div class="spinner-border"></div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="eventModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Event</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="evtStart">
        <input type="hidden" id="evtEnd">

        <div class="mb-2">
          <label>Title</label>
          <input type="text" id="evtTitle" class="form-control">
        </div>

        <div class="mb-2">
          <label>Description</label>
          <textarea id="evtDesc" class="form-control"></textarea>
        </div>

        <div class="mb-2">
          <label>Color</label>
          <input type="color" id="evtColor" class="form-control form-control-color">
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" id="btnSaveEvent">Save</button>
      </div>
    </div>
  </div>
</div>

<?php
}
elseif ($page=="jadwal_ajax")
{
?>
    <?php
    $awal = $tahun.'-'.$bulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir = $tahun.'-'.$bulan.'-'.$tglakhir;
    ?>
    <table id="example1" width="100%" class="table table-bordered table-striped">
      <thead>
     <tr>
      <th style="background-color:#D3D3D3;color:black;">Nama Pegawai</th>
     <?php
      foreach (range(1, $tglakhir) as $number) {
         if(in_array($number,$tgl_hari_libur)){ ?>
      <th style="background-color:#ff0000;color:white;font-size:12px;vertical-align:middle;text-align:center;width: 3%;"><?php echo $number; ?></th>
       <?php
         }else{ ?>
      <th style="background-color:#D3D3D3;color:black;font-size:12px;vertical-align:middle;text-align:center;width: 3%;"><?php echo $number; ?></th>
       <?php
         }
      }
     ?>
     </tr>
      </thead>
      <tbody>
      <?php
       foreach($ambil_data_pegawai as $rowambil_data_pegawai){
      ?>
     <tr>
      <td style="background-color:#D3D3D3;color:black;vertical-align:middle;text-align:left"><?php echo $rowambil_data_pegawai['nama_pegawai']; ?><br><?php echo $rowambil_data_pegawai['no_hp']; ?></td>
      <?php
      foreach (range(1, $tglakhir) as $numbers) {
       $tglenya = $tahun.'-'.$bulan.'-'.$numbers;
       $id_pegawai = $rowambil_data_pegawai['id_pegawai'];
       $jadwal_at = $this->m_member->print_jadwal($tglenya,$id_pegawai);
       $kondisi_surat=array('id_pegawai'=>$id_pegawai,'tgl_jadwal'=>$tglenya);
       $jml=$this->m_umum->jumlah_record_filter('pegawai_jadwal',$kondisi_surat);
       if($jml == 0){
        if(in_array($numbers,$tgl_hari_libur)){ ?>
         <td style="background-color:#ff0000;color:white;font-size:12px;vertical-align:middle;text-align:center;">-</td>
        <?php
        }else{ ?>
         <td style="vertical-align:middle;text-align:center">-</td>
        <?php
        }
       }else{
        foreach($jadwal_at as $rowjadwal_at){
      ?>
      <td style="background-color:<?php echo $rowjadwal_at['kode_warna']; ?>;vertical-align:middle;text-align:center;color:<?php echo $rowjadwal_at['text_warna']; ?>;">
       <?php echo $rowjadwal_at['nama_dinas_jaga']; ?>
      </td>
      <?php
        }
       }
      }
      ?>
     </tr>
      <?php
       }
      ?>
      </tbody>
    </table>
<script type="text/javascript">
 $(document).ready(function() {
 var example1 = $('#example1').DataTable({
 'paging'       : false,
 'lengthChange' : false,
 'searching'    : false,
 'ordering'     : false,
 'info'         : false,
 'scrollX'   : false,
 'scrollY'   : '500px',
 'scrollCollapse' : true,
 'fixedColumns' : true,
 'responsive' : true,
 'autoWidth' : true
 });new $.fn.dataTable.FixedColumns(example1, { leftColumns: 1 }); 
 });
</script>
<?php
}
elseif ($page=="jadwal_dashboard_ajax")
{
?>
<?php
$dates = [];
for ($i = -1; $i <= 3; $i++) {
    $dates[] = date('Y-m-d', strtotime("$i day", strtotime($baseDate)));
}
?>

<table class="table table-bordered table-sm text-center w-100">
  <thead>
    <tr>
      <?php foreach ($dates as $tgl): ?>
        <th><?= date('d M Y', strtotime($tgl)) ?></th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php foreach ($dates as $tgl): ?>
        <td><?= $jadwal[$tgl] ?? '(-)' ?></td>
      <?php endforeach; ?>
    </tr>
  </tbody>
</table>

<?php
}
elseif ($page=="billing_lihat")
{
  foreach($billing as $rowbilling){
    $dateb = date("Y-m-d", strtotime("+3 month"));
    if($rowbilling['expired_mitra'] > $dateb){
      $bg = 'bg-green';
    }else{
      $bg = 'bg-red';
    }
?>
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <li class="time-label">
                <span class="<?= $bg ?>">
                  Expired : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowbilling['expired_mitra']))) ?>
                </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">File</h3>
                <div class="timeline-body">
                <ul>
                  <li>Data Komite / Bidang : <?= $rowbilling['nama_struktur_jabatan'] ?> <?= $rowbilling['nama_working'] ?></li>
                  <li>Data Kontak : <?= $rowbilling['nama_pegawai'] ?></li>
                  <li>Apabila Data Billing Expired, Hak Akses Admin akan hilang</li>
                </ul>
                </div>
              </div>
              </li>
            <?php  
              if($rowbilling['struk_working_mitra']){
            ?>
              <li>
                <i class="fa fa-money bg-yellow"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">Struk</h3>

                <div class="timeline-body">
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?= base_url();?>assets/berkas/struk/<?= $rowbilling['struk_working_mitra'] ?>" allowfullscreen></iframe>
</div>
                </div>
              </div>
              </li> 

<?php  
    }
?>

              <li>
              <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul> <br><br>
<?php
  }
}
// ============================================== TES
elseif ($page=="tes")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <small>
     <a href="<?php echo base_url($this->session->beranda);?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>         
        </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
                       <button style="font-weight:bold;" class="btn btn-xs btn-warning">
                       Pengajuan Pending : <?= $blm_lunas ?>
                      </button>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;width: 5%;">ID</th>
            <th style="width:15%;">Tanggal</th>
            <th>Nama Asesi</th>
            <th>Kategori</th>
            <th style="width:15%;">Status</th>
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="tes_sukses")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <ul class="timeline timeline-inverse">
              <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">
                    Tanggal Pengajuan : <?= $tgl_pengajuan ?>
                </h3>
                <div class="timeline-body">
                <ul>
                  <li>Jenis Pengajuan Kompetensi : <?= $nama_status_diusulkan ?></li>
                  <li>Nama Pegawai : <?= $nama_pegawai ?></li>
                  <li>Ini adalah tes / latihan melakukan pengajuan kompetensi / kredensial dan tidak dikenakan biaya aopapun</li>
                  <li>Silahkan melanjutkan untuk tes / latihan mengisi kelengkapan berkas, logbook dan lain-lain</li>

                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
          </div>
        </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="tes_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tes/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><?php $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <li class="time-label">
                <span class="bg-red">
                  <?php echo date('d-m-Y'); ?>
                </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">File</h3>
                <div class="timeline-body">
                <ul>
                  <li>Siapkan file surat ijin (STR) yang berlaku</li>
                  <li>Siapkan file ijasah pendidikan terakhir</li>
                  <li>Siapkan file sertifikat pelatihan, workshop, kongres, simposium dll</li>
                  <li>Siapkan file berkas lainnya (opsional)</li>
                  <li>Semua berkas di upload di menu berkas sesuai kategorinya (Surat Ijin, Seminar dll, Ijasah dan berkas lainnya) dalam format PDF</li>
                  <li>Semua berkas yang diupload tidak akan hilang dan dapat di download atau digunakan untuk pengajuan selanjutnya</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-user bg-aqua"></i>
              <div class="timeline-item">
                <h3 class="timeline-header">Logbook</h3>
                <div class="timeline-body">
                <ul>
                  <li>Pengajuan Kredensial / Non Keperawatan hanya akan divalidasi oleh komite / penilai</li>
                  <li>Pengajuan Kredensial setiap profesi berbeda-beda sesuai dengan komite</li>
                  <li>Pengajuan Pemulihan kewenangan diambil dari logbook yang ditolak</li>
                  <li><span style="blinking"></strong>INI HANYA TES DAN SETIAP USER HANYA BISA 2X PENAMBAHAN TES</span></li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">Pengiriman</h3>

                <div class="timeline-body">
                <ul>
                  <li>Lengkapi berkas dan logbook terlebih dahulu baru kemudian pengajuan dapat diajukan</li>
                  <li>Setelah pengajuan terkirim mohon untuk menghubungi tim kompetensi</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
            <br />
              <?php
              echo '<label>Jenis Pengajuan Kompetensi</label>';
              input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
              echo '<label>Tempat Bekerja</label>';
              input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
              ?>           
            <div class="box-body box-profile">
            <button type="submit" class="btn btn-primary btn-block"><b>AJUKAN</b></button>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tes_isi")
{
  $arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
        </div>
        <div class="box-body">
    <?php echo form_open_multipart('member/tes/isi/'.$id,' ');
    input_text("id_pengajuan",$id_pengajuan,"","","hidden");
    ?>
      <div class="row">
      <div class="col-md-4">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">
                KELENGKAPAN
                </h3>
            </div>
            <div class="box-body">
              <div class="box-body box-profile">
      <?php
        if(empty($foto)){
          $url_thumbx=base_url().'assets/images/noavatar.jpg';
          $url_picbesarx=base_url().'assets/images/noavatar.jpg';
        }else{
          $cek_filesmall=FCPATH.'assets/foto/ol/'.$foto;
          if(file_exists($cek_filesmall)){
            $url_thumbx=base_url().'assets/foto/ol/'.$foto;
            $url_picbesarx=base_url().'assets/foto/ol/'.$foto;
          }else{
            $url_thumbx=base_url().'assets/images/noavatar.jpg';
            $url_picbesarx=base_url().'assets/images/noavatar.jpg';
          }
        }
      ?>
                <a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
                  data-lightbox="example-set" data-title="<?php echo $member_name; ?>">
                  <img class="profile-user-img img-responsive img-circle"
                    src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                </a>
                <h3 class="profile-username" style="color:green;text-align:center;"><?php echo $member_name; ?></h3>
                <h4 style="color:green;text-align:center;"><strong><?= strtoupper($nama_status_diusulkan) ?></strong></h4>
                <ul class="list-group list-group-unbordered">
                <?php
                if($status_pengajuan > 0){
                  echo '<h5 style="color:blue;text-align:left;"><strong>NAMA ASESOR</strong></h5>';
                  foreach($list_asesor as $rowlist_asesor){
                    echo '<li class="list-group-item"><font color="red"><b>'.$rowlist_asesor['nama_pegawai'].'</b></font></li>';
                  }
                }
              if($status_pengajuan=="0"){
                    ?>
                    <li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenTambahKat" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Kompetensi" data-toggle="modal" data-target="#exampleModal">
  Pilih Kompetensi
</button>
                    </li>
                    <?php  
              }
                    if($status_pengajuan=="0"){
                  ?><li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenIjasah" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Ijasah" data-toggle="modal" data-target="#exampleModal">
  Pilih Ijasah
</button>
                  </li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                  ?><li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenSurat" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Surat Ijin" data-toggle="modal" data-target="#exampleModal">
  Pilih Surat Ijin
</button>
                    </li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                  ?> <li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenSertifikat" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Sertifikat" data-toggle="modal" data-target="#exampleModal">
  Pilih Sertifikat
</button>
                    </li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                  ?><li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenBerkasOpsi" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Berkas Lain (opsional)" data-toggle="modal" data-target="#exampleModal">
  Pilih Berkas Lain (opsional)
</button>
                      </li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                      ?><li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenEtik" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Etik (opsional)" data-toggle="modal" data-target="#exampleModal">
  Pilih Etik (opsional)
</button>
                    </li>
                  <?php
                    }
                  ?>
                
                </ul>
                <?php  
                  if($status_pengajuan=="0"){
                ?>
                    <button name="action" value="Btnsimpan" class="btn btn-primary btn-block">
                      <i class="fa fa-save"></i> <b>SIMPAN KOMPETENSI</b>
                    </button>
                <?php  
                  }
                ?>
              </div>
            </div>
          </div>
            <?php 
            if($status_pengajuan == 1){
            ?>
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">LINK KOMPETENSI</h3>           
                      <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                      <i class="fa fa-minus"></i></button>
                      </div>
                </div>
                <div class="box-body">
                <?php  
                  foreach($ambil_link as $row_link) {
                ?>
<div class="info-box bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
  <span class="info-box-icon"><i class="fa fa-<?php echo $arrayfa[array_rand($arrayfa)]; ?> fa-lg"></i></span>

  <div class="info-box-content">
    <span class="info-box-text blinking" style="font-size:0.8em;font-weight: bold;"><?= $row_link['nama_pegawai'] ?></span>
    <span class="info-box-number" style="font-size:0.9em;"><?= $row_link['judul_link'] ?></span>

    <div class="progress">
      <div class="progress-bar" style="width: 100%"></div>
    </div>
        <a href="<?php echo base_url('member/tes/'.$row_link['url_link'].'/'.$row_link['barcode_pengajuan_validasi']);?>" class="progress-description" style="color: white;">
          Hasil <i class="fa fa-arrow-circle-right"></i>
        </a>
  </div>
</div>
                <?php
                    }
                ?>

                </div>
              </div>
                <?php
                    }
                ?>
        </div>
        <div class="col-md-8">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
             DATA BERKAS
            </h3>
            </div>
            <div class="box-body">
        <div class="box-body no-padding">
          <div class="mailbox-controls">

          </div>
          <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">IJASAH</td>
            </tr>
              <?php
              if($ijasah!==""){
                foreach($ambil_berkas_data as $row){
                  if (in_array($row['id_berkas'],$id_ijasah)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_ijasah[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox"></td>
                <td class="mailbox-name">
Nama Instansi : <b><?= $row['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row['nama_berkas_kategori'] ?></b><br>Jenjang : <b><?= $row['nama_pendidikan']?></b><br>No Ijasah : <b><?= $row['no_berkas']?></b><br>Tanggal Lulus : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row['tgl_b_berkas']))) ?></b><br><br>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $row['link_berkas'] ?>" allowfullscreen></iframe>
</div><br><br>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">SURAT IJIN</td>
            </tr>
              <?php
              if($str!==""){
                foreach($ambil_berkas_data as $row2){
                  if (in_array($row2['id_berkas'],$id_str)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_str[]" value="<?php echo $row2['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
Nama Berkas : <b><?= $row2['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row2['nama_berkas_kategori'] ?></b><br>No Surat Ijin : <b><?= $row2['no_berkas']?></b><br>Tanggal Berlaku : <b>
<?php if($row2['lifetime_berkas'] == 0){ $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row['tgl_b_berkas']))); }else{ echo 'Seumur Hidup'; }
?></b><br><br>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $row2['link_berkas'] ?>" allowfullscreen></iframe>
</div><br><br>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">SERTIFIKAT</td>
            </tr>
              <?php
              if($sertifikat!==""){
                foreach($ambil_berkas_data as $row3){
                  if (in_array($row3['id_berkas'],$id_sertifikat)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
Nama Pelatihan : <b><?= $row3['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row3['nama_berkas_kategori'] ?></b><br>Penyelenggara : <b><?= $row3['penyelenggara']?></b><br>Kategori Pelatihan : <b><?= $row3['nama_kategori_pelatihan']?></b><br>No Sertifikat : <b><?= $row3['no_sertifikat']?></b><br>Tanggal Mulai : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row3['tgl_a_berkas']))) ?></b><br>Tanggal Berakhir : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row3['tgl_b_berkas']))) ?></b><br><br>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $row3['link_berkas'] ?>" allowfullscreen></iframe>
</div><br><br>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">BERKAS PELENGKAP</td>
            </tr>
              <?php
              if($berkas!==""){
                foreach($ambil_berkas_data as $row4){
                  if (in_array($row4['id_berkas'],$id_berkas)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_berkas[]" value="<?php echo $row4['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
Nama Berkas : <b><?= $row4['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row4['nama_berkas_kategori'] ?></b><br>No Berkas : <b><?= $row4['no_berkas']?></b><br><br>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $row4['link_berkas'] ?>" allowfullscreen></iframe>
</div><br><br>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">ETIK</td>
            </tr>
              <?php
              if($id_etik_pegawai!==""){
                foreach($ambil_data_etik_pegawai_oppe as $row5){
                  if (in_array($row5['id_etik_pegawai'],$etike)) {
              ?>
                <tr>
              <td width="5%"><input name="id_etik_pegawai[]" value="<?php echo $row5['id_etik_pegawai']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
Tanggal Etik : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row5['tgl_etik_pegawai']))) ?></b><br>
Hasil Etik : <b><?= $row5['hasil_etik'] ?></b><br>
Penguji : <b><?= $row5['nama_pegawai']?></b><br><br>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>member/tes/pdf_etika/<?= $row5['id_etik_pegawai'] ?>" allowfullscreen></iframe>
</div><br><br>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            </tbody>
          </table>
          <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
          <!-- Check all button -->
          <div class="pull-right">
           <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT <i class="fa fa-trash-o"></i> UNCHECK KEMUDIAN SIMPAN UNTUK MEMBUANG BERKAS
          </div>
          <!-- /.pull-right -->
          </div>
        </div>
            </div>
          </div>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">
                <small style="color:white;font-weight:bold;">DAFTAR TOTAL PEMERIKSAAN</small>
              </h3>
            </div>
            <div class="box-body">
              <?php 
                if(!empty($kode_unit_pengajuan)){
              ?>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>member/tes/pdf_logbook/<?= $id_pengajuan ?>" allowfullscreen></iframe>
</div>
              <?php
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $header; ?> <small><?php echo $instance_name; ?></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="tes_tambah_kompetensi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tes/simpan_tambah_kompetensi');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="kode_unit_pengajuan" value="<?= $kode_unit_pengajuan; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Struktur Validator</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_kompetensi'],explode(",", $kode_unit_pengajuan))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kompetensi'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_kompetensi']; ?></td>

              </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="tabel_tambah_berkas")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tabel/simpan_tambah_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
      <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <input type="hidden" name="berkase" value="<?= $berkase; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Berkas</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Lihat Berkas</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_berkas'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?= $checked?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_berkas']; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_berkas_kategori']; ?></td>
              <td style="vertical-align:middle;text-align:center;">
                <a href="<?php echo base_url('assets/berkas/ol/'.$row['link_berkas']);?>" class="btn bg-green btn-xs" target="_blank">
                <i class="fa fa-file-pdf-o"></i></a>
              </td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="tes_tambah_logbook")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tes/simpan_tambah_logbook');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan ?>">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Tanggal</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan-[Kompetensi] = Q</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Sifat</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                  if(in_array($row['id_logbook'],explode(",", $logbook))){
                    $cek = "checked";
                  }else{
                    $cek ="";
                  }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_logbook'];?>" <?=$cek ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_logbook']))); ?></td>
                <td style="vertical-align:middle;"><input type="hidden" name="id_kewenangan[]" value="<?= $row['id_kewenangan'] ?>">
                  <?= $row['nama_kewenangan'] ?> - <b>[<?= $row['nama_kompetensi'] ?>]</b> = <?= $row['jml_logbook'] ?>
                </td>
                <td style="vertical-align:middle;"><?= $row['nama_sifat_kewenangan'] ?></td>
              </tr>
                <?php
                //    }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="tes_tambah_ijasah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tes/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="id" value="id_ijasah">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">IJASAH</h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Instansi</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jenjang Pendidikan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal Lulus</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_berkas'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_berkas']; ?> 
                <a href="<?= base_url('assets/berkas/ol/'.$row['link_berkas']) ?>" target="_blank"> &nbsp;&nbsp;<i class="fa fa-search"></i> Lihat</a>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_pendidikan']; ?></td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))); ?></td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="tes_tambah_str")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tes/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="id" value="id_str">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Data Surat Ijin</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal Expired</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_berkas'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;">
                  Berkas : <?= $row['nama_berkas'] ?><br>
                  Kategori : <?= $row['nama_berkas_kategori'] ?><br>
                  No : <?= $row['no_berkas'] ?><br>
                  Tanggal : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_a_berkas']))); ?><br>
              <a href="<?= base_url('assets/berkas/ol/'.$row['link_berkas']) ?>" target="_blank"> &nbsp;&nbsp;<i class="fa fa-search"></i> Lihat</a>
                </td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))); ?></td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="tes_tambah_sertifikat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tes/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="id" value="id_sertifikat">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Data Sertifikat</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal Mulai</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal Selesai</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_berkas'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;">
                  Berkas : <?= $row['nama_berkas'] ?><br>
                  Kategori : <?= $row['nama_berkas_kategori'] ?><br>
                  No : <?= $row['no_sertifikat'] ?><br>
                  SKP : <?= $row['kredit'] ?><br>
                  Penyelenggara : <?= $row['penyelenggara'] ?><br>
              <a href="<?= base_url('assets/berkas/ol/'.$row['link_berkas']) ?>" target="_blank"> &nbsp;&nbsp;<i class="fa fa-search"></i> Lihat</a>
                </td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_a_berkas']))); ?></td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))); ?></td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="tes_tambah_berkaslain")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tes/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="id" value="id_berkas">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Berkas</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">No Berkas</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_berkas'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;">
                  Berkas : <?= $row['nama_berkas'] ?><br>
              <a href="<?= base_url('assets/berkas/ol/'.$row['link_berkas']) ?>" target="_blank"> &nbsp;&nbsp;<i class="fa fa-search"></i> Lihat</a>
                </td>
                <td style="vertical-align:middle;"><?= $row['no_berkas'] ?></td>
                <td style="vertical-align:middle;"><?= $row['nama_berkas_kategori'] ?></td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="tes_tambah_etik")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tes/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="id" value="id_etik_pegawai">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">ETIK PEGAWAI</h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
          <tr>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
              <input name="select_all" class="checkall" type="checkbox" />
            </th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;">Tanggal</th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;">Soal</th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;">Penguji</th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;"><i class="fa fa-print"></i></th>
          </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_etik_pegawai'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_etik_pegawai'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_etik_pegawai']))); ?></td>
                <td style="vertical-align:middle;text-align: center;"><?= $row['jumlah_etik'] ?></td>
                <td style="vertical-align:middle;text-align: center;"><?= $row['hasil_etik'] ?></td>
                <td style="vertical-align:middle;text-align: center;"><?= $row['nama_pegawai'] ?></td>
                <td style="vertical-align:middle;text-align: center;">
  <a href="<?php echo base_url('member/tes/pdf_etika/'.$row['id_etik_pegawai']);?>" class="btn bg-green btn-xs" target="_blank">
                    == <i class="fa fa-file-pdf-o"></i> pdf ==</a>
                </td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
// ============================================== MAHASISWA
elseif ($page=="mhs_logbook")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_kembali;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
       <h3 class="box-title">
      <?php echo $header; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div class="col-md-6">
      <?php echo form_open_multipart('mahasiswa/mhs_logbook/view/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Instansi</label>
                  <?php
  input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_instansi_null,"barcode_working","nama_working",$id_ruangan,"Semua");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kompetensi</label>
                  <?php
  input_pdselect2fleksibel("id_kompetensi","id_kompetensi",$ambil_data_kompetensi_null,"id_kompetensi","nama_kompetensi",$pxe,"Semua");
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
       </div>
      <div class="col-md-6">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">CATATAN</h3>
        </div>
          <div class="box-body">
          <div class="box box-widget">
          <div style="font-weight:bold;color:green;" class="box-body">
            <ul>
            <li>KEWENANGAN KOMPETENSI SESUAI KEMENAKER NO 237 TAHUN 2020</li>
            <li>TENTANG PENETAPAN STANDAR KOMPETENSI KERJA NASIONAL INDONESIA</li>
            <li>GUNAKAN RANGE / PERIODE TANGGAL UNTUK MELIHAT DATA LOGBOOK LAMA</li>
            <li>SIFAT KOMPETENSI : <font color="blue">SUPERVISI (DI AWASI MENTOR / MENTORSHIP)</font></li>
            <li><font color="red">DATA YANG DI NILAI ADALAH KOMPETENSI, CUKUP MEMASUKKAN 1 KEWENANGAN / SUB KOMPETENSI JIKA ADA 2 DALAM 1 KOMPETENSI, MISAL TELAH MELAKUKAN</font> EPIDIDIMIS KIRI / KANAN, <font color="red"> CUKUP SALAH SATUNYA SAJA KARENA KEDUANYA TERMASUK KOMPETENSI</font> PEMERIKSAAN (USG) SKORTUM</li>
          </ul>           
          </div>
          <!-- /.box-body -->
          </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
          DATA LOGBOOK
           </h3>
          <div class="box-tools pull-right">
          <a href="<?php echo base_url('mahasiswa/mhs_logbook/pdf_pasien/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe); ?>" target="_blank" class="btn btn-white btn-md">
            <i class="fa fa-file-pdf-o"></i> KEGIATAN KOMPETENSI
          </a>
          </div>
        </div>
        <div class="box-body">
          <div class="box-tools pull-right">
          <?php
            input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
          ?>
          </div>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="vertical-align:middle;font-weight:bold;width: 5%;"></th>                
                <th style="vertical-align:middle;font-weight:bold;display:none;"></th>
                <th style="vertical-align:middle;font-weight:bold;">Tanggal</th>
                <th style="vertical-align:middle;font-weight:bold;">Kode Unit</th>
                <th style="vertical-align:middle;font-weight:bold;width:40%;">Nama Kompetensi</th>
                <th style="vertical-align:middle;font-weight:bold;text-align: right;width: 7%;">Q</th>
                <th style="vertical-align:middle;font-weight:bold;">Pengawas</th>
                <th style="vertical-align:middle;font-weight:bold;">Instansi</th>
              </tr>
            </thead>
          </table>
        </div>
        </div>
        </div>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
       <?php echo $instance_name; ?>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="mhs_logbook_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
  <?php echo form_open_multipart('mahasiswa/mhs_logbook/tambah' ,' id="signupform" ');
    input_text("id_jabatan",$this->session->id_jabatan,"","","hidden");
  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Kode Unit</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Grade</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $kondisi=array('id_logbooker'=>$this->session->id_pegawai,'tolak >'=> 0);
          $tolake = $this->m_umum->ambil_data_kondisi_result('mhs_logbook',$kondisi);
          $kw_tolak = array();
          foreach($tolake as $valambil_kw_tolak){
              $kw_tolak[] = $valambil_kw_tolak['id_kewenangan'];
          }
          $eimplokw_tolak = implode(",", $kw_tolak);
          foreach($kr_kewenangan_detil as $row){
            if (in_array($row['id_kewenangan'],explode(",", $eimplokw_tolak))){ 
              $tol = ' - <b><font color="red">TOLAK</font></b>'; 
            }else{ 
              $tol = ''; 
            }
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan'];?>" >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['kode_unit']; ?></td>
          <td style="vertical-align:middle;"><span style="font-weight:bold;color:green;"><?php echo $row['nama_kewenangan']; ?></span> [<?php echo $row['nama_kompetensi']; ?>] <?php echo $tol; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_grade']; ?></td>
        </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="mhs_logbook_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('mahasiswa/mhs_logbook/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="barcode_logbook" value="<?= $barcode_logbook; ?>">
    <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
    <input type="hidden" name="id_logbook" value="<?= $id_logbook; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title ?></h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_logbook","tgl_logbook",$tgl_logbook,"Masukkan Tanggal Transaksi"," required");
                  ?>
              </div>  
              <div class="col-md-9">
                  <label>Pencatatan Registrasi Pasien</label>
                  <?php
                     input_text("rm",$rm," ","","text");
               //     input_text("rm",$rm," id='editor1' rows='2' cols='10' class='form-control' ","Keterangan");
                  ?>        
              </div>
              <div class="col-md-2">
                  <label>Jumlah</label>
                  <?php
                    input_textcustom("jml_logbook","$jml_logbook","maxlength='5' required class='form-control' onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan Jumlah","text");
                  ?>  
              </div>    
        <div class="col-md-7">
            <label>Penguji</label>
                  <?php
                    input_pdselect2("id_penguji",$cmd_penguji,$id_penguji);
                  ?>
        </div>
              <div class="col-md-3">
                  <label>Instansi</label>
                        <?php
                          input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
                        ?>
              </div>
             </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_logbook').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_logbook").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="mhs_logbook_isi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
  <?php echo form_open_multipart('mahasiswa/mhs_logbook/isi/'.$first_date,' id="signupform" ');
  input_text("id_pegawai",$this->session->id_pegawai,"","","hidden");
  input_text("counter",$count,"","","hidden");
  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <?= $title ?>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
        <div class="row">
      <div class="col-md-12">
        <div class="col-md-2">
            <label>Tanggal</label>
              <?php
                input_calendar("tgl_logbook","tgl_logbook",$tgl_logbook,"Masukkan Tanggal Transaksi"," required");
              ?>
        </div>
        <div class="col-md-5">
            <label>Instansi</label>
                  <?php
                    input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
                  ?>
        </div>
        <div class="col-md-5">
            <label>Penguji</label>
                  <?php
                    input_pdselect2("id_penguji",$cmd_penguji,$id_penguji);
                  ?>
        </div>
      </div>
        <?php
        $no =0;
        foreach($kr_kewenangan as $row){
          if(in_array($row['id_kewenangan'], $terpilih)){
            input_text("id_kewenangan[]",$row['id_kewenangan'],"","","hidden");
            $jml_log = $this->m_ol_rancak->jumlah_record_logbook($row['id_kewenangan']);
            if($jml_log == 0){
                $no++;  
        ?>
      <div class="col-md-12">
        <div class="col-md-6">
        <label><strong>Kewenangan - Kompetensi</strong></label>
        <?php
        input_textarea("nama_kewenangan[]",$row['nama_kewenangan'].' - Kompetensi : '.$row['nama_kompetensi'],"readonly ","","text");
        ?>
      </div>
      <div class="col-md-5">
        <label><strong>Pencatatan Registrasi Pasien</strong></label>
        <?php
    input_text("rm[]","","","","text");
    //    input_textarea("rm[]","","  ","","text");
        ?>
      </div>      
      <div class="col-md-1">
        <label><strong>Jumlah</strong></label>
        <?php if($count=='0') { $read = 'readonly'; } else { $read = '';}
        input_textcustom("jml_logbook[]","1","maxlength='5' required class='form-control' $read
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan Jumlah","text"); ?>
        </div>
      </div>
        <?php
      }
    }
  }
        ?>
        </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="mhs_pasien")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">SILAHKAN PILIH RM PASIEN JIKA TIDAK ADA PILIH TAMBAH PASIEN</h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
          <tr>
            <th>RM</th>
            <th>Nama Pasien</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
          </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="mhs_pasien_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('mahasiswa/mhs_pasien/simpan_tambah');?>" onClick="return cek();">
          <input type="hidden" name="id_logbook" value="<?= $id_logbook; ?>">
          <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
          <input type="hidden" name="jml_logbook" value="<?= $jml_logbook; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">SILAHKAN CARI DATA DI NAMA PASIEN BERDASARKAN RM / NAMA PASIEN</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text"); 
                  ?>
              </div>
              <div class="col-md-8">
                  <label for="autocomplete">Cari Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' required id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-2">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Alamat</label>
                  <?php
                     input_text("alamat",$alamat," maxlength='255' ","Alamat","text");
               //     input_text("rm",$rm," id='editor1' rows='2' cols='10' class='form-control' ","Keterangan");
                  ?>        
              </div>
              <div class="col-md-3">
                  <label>Pemakaian</label>
                  <?php
                input_textcustom("jml_bahan",$jml_bahan," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah Pemakaian","text"); 
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Bahan</label>
                  <?php
                input_pdselect2("id_bahan",$cmd_bahan,$id_bahan);
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Reject</label>
                  <?php
                input_textcustom("jml_reject",$jml_reject," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah Reject","text");  
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Bahan Reject</label>
                  <?php
                input_pdselect2("id_reject",$cmd_reject,$id_reject);
                  ?>
              </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
    </FORM>
<script type="text/javascript">
var status=0;
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>mahasiswa/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>mahasiswa/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="mhs_pasien_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('mahasiswa/mhs_pasien/simpan_edit');?>" onClick="return cek();">
          <input type="hidden" name="id_logbook_pasien" value="<?= $id_logbook_pasien; ?>">
          <input type="hidden" name="id_logbook" value="<?= $id_logbook; ?>">
          <input type="hidden" name="jml_logbook" value="<?= $jml_logbook; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">SILAHKAN CARI DATA DI NAMA PASIEN BERDASARKAN RM / NAMA PASIEN</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text"); 
                  ?>
              </div>
              <div class="col-md-8">
                  <label for="autocomplete">Cari Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' required id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-2">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Alamat</label>
                  <?php
                     input_text("alamat",$alamat," maxlength='255' ","Alamat","text");
               //     input_text("rm",$rm," id='editor1' rows='2' cols='10' class='form-control' ","Keterangan");
                  ?>        
              </div>
              <div class="col-md-3">
                  <label>Pemakaian</label>
                  <?php
                input_textcustom("jml_bahan",$jml_bahan," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah Pemakaian","text"); 
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Bahan</label>
                  <?php
                input_pdselect2("id_bahan",$cmd_bahan,$id_bahan);
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Reject</label>
                  <?php
                input_textcustom("jml_reject",$jml_reject," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah Reject","text");  
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Bahan Reject</label>
                  <?php
                input_pdselect2("id_reject",$cmd_reject,$id_reject);
                  ?>
              </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
    </FORM>
<script type="text/javascript">
var status=0;
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>mahasiswa/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>mahasiswa/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="mhs_logbook_pasien")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?= $title ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
          <div class="col-md-12">
          <div class="table-responsive" tabindex="-1">
            <table id="item_table" class="table table-hover table-transaksi table-sm">
            <thead class="bg-light">
               <tr style="background-color: #800000;color: white;">
              <th class="text-sm text-label text-center border-0" style="display: none;"></th>
              <th class="text-sm text-label text-center border-0">Nama Pasien</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">RM</th>
              <th class="text-sm text-label text-center border-0" style="width: 7%;text-align:right;">Umur</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">&nbsp;</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">Jenis Kelamin</th>
              <th class="text-sm text-label text-center border-0" style="width: 7%">Film</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">Jenis FIlm</th>
              <th class="text-sm text-label text-center border-0" style="width: 7%">Reject</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">Jenis Reject</th>
              <th class="text-sm text-label text-center border-0" style="width: 5%"></th>
              </tr>
            </thead>
            <tbody>
              <?php  
                foreach($data_pasien as $rowsoal){
              ?>
              <tr>
              <td class="text-sm text-label border-0" style="display: none;">
              <?php
                input_text("id_pasien_edit[]",$rowsoal['id_pasien'],"required ","","hidden");
              ?>               
              </td>
              <td class="text-sm text-label border-0">
              <?php
                input_text("nama_pasien_edit[]",$rowsoal['nama_pasien'],"required maxlength='255' ","","text");
              ?>               
              </td>
              <td class="text-sm text-label border-0">
              <?php
                input_textcustom("rm_edit[]",$rowsoal['rm']," style='text-align:right;' maxlength='20' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text"); 
            //    input_text("rm_edit[]",$rowsoal['rm'],"maxlength='10' ","","text");
              ?>               
              </td>
              <td class="text-sm text-label border-0">
              <?php 
                input_textcustom("umur_pasien_edit[]",$rowsoal['umur_pasien']," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text");          
              ?>              
              </td>     
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("satuan_pasien_edit[]",$cmd_satuan_umur,$rowsoal['satuan_pasien']);
              ?>
              </td>      
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("gender_pasien_edit[]",$cmd_jk,$rowsoal['gender_pasien']);
              ?>
              </td>
              <td class="text-sm text-label border-0">
              <?php 
                input_textcustom("jml_bahan_edit[]",$rowsoal['jml_bahan']," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text");          
              ?>              
              </td>     
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("id_bahan_edit[]",$cmd_bahan,$rowsoal['id_bahan']);
              ?>
              </td> 
              <td class="text-sm text-label border-0">
              <?php 
                input_textcustom("jml_reject_edit[]",$rowsoal['jml_reject']," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text");          
              ?>              
              </td>     
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("id_reject_edit[]",$cmd_reject,$rowsoal['id_reject']);
              ?>
              </td>               
              <td class="text-sm text-label border-0"></td>
              </tr>
            <?php  
              }
            ?>
            </tbody>
            </table>
          </div>
          <div class="col-md-12">
          <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
          </div>
          </div>
             </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
//===================================================================
elseif ($page=="absen")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small><?= $title ?></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('member/'.$page.'/view/'.$id.'/'.$id2,' id="signupform" '); ;
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Awal</label>
              <?php
                input_calendar("id","id",$id,"Masukkan Tanggal Transaksi","required");
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Tanggal Akhir</label>
            <?php
              input_calendar("id2","id2",$id2,"Masukkan Tanggal Transaksi","required");
            ?>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><div id="status">Kadang Untuk Browser Google Chrome Tidak Berfungsi</div></h3>

          <div class="box-tools pull-right">
      <?php
   //     input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;">&nbsp;</th>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Kehadiran</th>
                <th>CLock In</th>
                <th>Clock Out</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="box-footer">
<input type="hidden" name="id_seting" value="<?= $id_seting ?>" class="form-control text-center" readonly>
<input type="hidden" name="nama_seting" value="<?= $nama_seting ?>" class="form-control text-center" readonly>
<input type="hidden" name="location" id="location" class="form-control text-center" readonly>
<input type="hidden" name="base_location" value="<?= $base_location ?>" class="form-control text-center" readonly>
<input type="hidden" name="id_absen" value="<?= $id_absen ?>" class="form-control text-center" readonly>
<input type="hidden" name="include_set_radius" value="<?= $include_set_radius ?>" class="form-control text-center" readonly>
<input type="hidden" name="radius" value="<?= $radius ?>" class="form-control text-center" readonly>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php 
           if($jml == 0){
            echo 'Hubungi Administrator Untuk Dapat Menggunakan Absensi';
           }else{
            echo 'Bisa Juga Untuk Daftar Kehadiran Seminar';
           }
         ?></h3>

          <div class="box-tools pull-right">
      <?php
   //     input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
<div id="map" style="width:100%; height:300px;"></div>
        </div>
        <div class="box-footer text-center"><label>ATTENDANCE</label>
                <?php
                  input_pdselect2("id_kategori_absen",$cmd_abs_kategori_absen,$id_kategori_absen);
                ?><br>
                <?= $tombole ?>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="absen_lihat_in")
{
?>
          <input type="hidden" name="location_in" id="location_in" value="<?= $location_in ?>" class="form-control text-center" readonly>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">DATA ABSEN MASUK</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="map_in" style="width:100%; height:300px;"></div>
            </div>
            <div class="box-footer">

            </div>
          </div>
    </FORM>
<script type="text/javascript">
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPositionin);
  } else {
    alert("Geolocation is not supported by this browser.");
  }

  function showPositionin(position) {
    const map = L.map('map_in').setView([<?= $latitude_user ?>, <?= $longitude_user ?>], <?= $zoom ?>);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: ''
    }).addTo(map);

    var Mylocation = L.icon({
      iconUrl: '<?= base_url('assets/img/icon/mark-office.png'); ?>',

      iconSize:     [38, 38], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([<?= $latitude_user ?>, <?= $longitude_user ?>], {icon: Mylocation}).addTo(map)
      .bindPopup('Location')
      .openPopup();

    var officeIcon = L.icon({
      iconUrl: '<?= base_url('assets/img/icon/office-center.png'); ?>',

      iconSize:     [38, 95], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([<?= $base_location ?>], {icon: officeIcon}).addTo(map)
      .bindPopup('<?= $nama_unit ?>');

    L.circle([<?= $base_location ?>], {
      color: 'blue',
      fillColor: 'blue',
      fillOpacity: 0.5,
      radius: <?= $radius ?>
    }).addTo(map);
  }
</script>
<?php
}
elseif ($page=="absen_lihat_out")
{
?>
          <input type="hidden" name="location_in" id="location_in" value="<?= $location_in ?>" class="form-control text-center" readonly>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">DATA ABSEN MASUK</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="map_in" style="width:100%; height:300px;"></div>
            </div>
            <div class="box-footer">

            </div>
          </div>
    </FORM>
<script type="text/javascript">
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPositionin);
  } else {
    alert("Geolocation is not supported by this browser.");
  }

  function showPositionin(position) {
    const map = L.map('map_in').setView([<?= $latitude_user ?>, <?= $longitude_user ?>], <?= $zoom ?>);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: ''
    }).addTo(map);

    var Mylocation = L.icon({
      iconUrl: '<?= base_url('assets/img/icon/mark-office.png'); ?>',

      iconSize:     [38, 38], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([<?= $latitude_user ?>, <?= $longitude_user ?>], {icon: Mylocation}).addTo(map)
      .bindPopup('Location')
      .openPopup();

    var officeIcon = L.icon({
      iconUrl: '<?= base_url('assets/img/icon/office-center.png'); ?>',

      iconSize:     [38, 95], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([<?= $base_location ?>], {icon: officeIcon}).addTo(map)
      .bindPopup('<?= $nama_unit ?>');

    L.circle([<?= $base_location ?>], {
      color: 'blue',
      fillColor: 'blue',
      fillOpacity: 0.5,
      radius: <?= $radius ?>
    }).addTo(map);
  }
</script>
<?php
}
elseif ($page=="signature")
{
if(empty($ttd_pegawai)){
  $standar_ft=base_url().'assets/images/noavatar.jpg';
}else{
  $cek_filesmall=FCPATH.'assets/berkas/kop/'.$ttd_pegawai;
  if(file_exists($cek_filesmall)){
    $standar_ft=base_url().'assets/berkas/kop/'.$ttd_pegawai;
  }else{
    $standar_ft=base_url().'assets/images/noavatar.jpg';
  }
}
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <?php echo form_open_multipart('member/signature',' id="signupform" ');
        input_text("id_pegawai",$id_pegawai,"","","hidden");
      ?>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?= $title ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                   <div class="form-group">
                      <div class="box-body box-profile">
                        <a class="example-image-link" href="<?php echo $standar_ft; ?>"
                          data-lightbox="example-set" data-title="<?php echo $nama_pegawai; ?>">
                          <img class="profile-user-img img-responsive img-circle" src="<?php echo $standar_ft; ?>" alt="Photo">
                        </a>

                        <p class="text-center">Signature <?php echo $nama_pegawai; ?></p>

                      </div>

                  </div>                 
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                    <label for="exampleInputFile">Ganti Signature</label>
                    <?php
                      input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                    ?>
                    <p class="help-block">png Ukuran 300 Pixel</p>
                  </div>                 
                </div>
              </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="profil")
{
if(empty($foto)){
	$standar_ft=base_url().'assets/images/noavatar.jpg';
}else{
	$cek_filesmall=FCPATH.'assets/foto/ol/'.$foto;
	if(file_exists($cek_filesmall)){
		$standar_ft=base_url().'assets/foto/ol/'.$foto;
	}else{
		$standar_ft=base_url().'assets/images/noavatar.jpg';
	}
}
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
		  <?php echo form_open_multipart('member/profil',' id="signupform" ');
				input_text("id_pegawai",$id_pegawai,"","","hidden");
				input_text("username_lama",$username_lama,"","","hidden");
				input_text("password_lama",$password_lama,"","","hidden");
				input_text("nik_lama",$nik,"","","hidden");
		  ?>
      <div class="row">
        <div class="col-md-3">
		      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		        <div class="box-header with-border">
		           <h3 class="box-title">PROFIL</h3>

		          <div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
		                    title="Collapse">
		              <i class="fa fa-minus"></i></button>
		          </div>
		        </div>
		        <div class="box-body">
	            <div class="box-body box-profile">
                        <a class="example-image-link" href="<?php echo $standar_ft; ?>"
                          data-lightbox="example-set" data-title="<?php echo $nama_pegawai; ?>">
                          <img class="profile-user-img img-responsive img-circle" src="<?php echo $standar_ft; ?>" alt="Photo">
                        </a>

	              <p class="text-center"><?php echo $nama_pegawai; ?></p>

	            </div>
		        </div>
		        <div class="box-footer">
							<div class="form-group">
							  <label for="exampleInputFile">Ganti Foto</label>
								<?php
									input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
								?>
							  <p class="help-block">gif, png, jpg, jpeg</p>
							</div>
		        </div>
		      </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
		      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		        <div class="box-header with-border">
		           <h3 class="box-title">PROFIL</h3>

		          <div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
		                    title="Collapse">
		              <i class="fa fa-minus"></i></button>
		          </div>
		        </div>
		        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Pegawai</label>
                <?php
                  input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Lahir</label>
                <?php
                  input_text("tmp_lahir",$tmp_lahir,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <?php
                  input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir"," required");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?php
                  input_pdselect2("jk",$gender,$jk);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?php
                  input_pdselect2("id_status_kawin",$cmd_status_kawin,$id_status_kawin);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Agama</label>
                <?php
                  input_pdselect2("id_agama",$cmd_agama,$id_agama);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jabatan Pegawai</label>
                <?php
                  input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "No Induk Karyawan","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "No HP format kode negara","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Jabatan Fungsional</label>
                <?php
                  input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>No Profesi (NIRA/PARI DLL)</label>
                <?php
                  input_textcustom("no_profesi",$no_profesi,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "No Profesi (PARI / NIRA DLL)","text");
                ?>
              </div>
            </div>            
            <div class="col-md-6">
              <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <?php
                  input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kecamatan</label>
                <?php
                  input_pdselect2("id_kec",$kec,$id_kec);
                //  echo form_dropdown('id_kec',$kec,'0',array('id'=>'id_kec','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kelurahan</label>
                <?php
                  input_pdselect2("id_kel",$kel,$id_kel);
                //  echo form_dropdown('id_kel',$kel,'0',array('id'=>'id_kel','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
                <?php
                  input_textcustom("username",$username," maxlength='60' class='form-control' required autocomplete='off' id='username' ",
                          "Huruf kecil tanpa spasi dan spesial character kecuali -","text");
                ?>
              </div>
            </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Password (ISI JIKA INGIN DIGANTI)</label>
                  <?php
                    input_textcustom("password",''," maxlength='255' class='form-control' autocomplete='off' id='password' ",
                            "Isi Jika Ingin Di ganti","text");
                  ?>
                </div>
              </div>
          </div>
        </div>
		        </div>
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
		      </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
		<?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="berkas")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				  <thead>
					<tr>
					  <th width="5%" style="display:none;">ID</th>
					  <th>Nama File</th>
					  <th>No File</th>
					  <th>Kategori</th>
					  <th><i class="fa fa-search"></i> </th>
					</tr>
				  </thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="berkas_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('member/berkas/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]","","","","file");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>No Berkas</label>
						<?php
							input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkas_edit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('member/berkas/edit/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("link_berkas_lama",$link_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label>Pilih Berkas Jika ingin di ganti &nbsp;<small">(Format harus PDF)</small></label>
						<?php
							input_text("upload_Files[]","","","","file");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>No Berkas</label>
						<?php
							input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="blaporan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
          <tr>
            <th width="5%" style="display:none;">ID</th>
            <th>Nama File</th>
            <th>No File</th>
            <th>Kategori</th>
            <th><i class="fa fa-search"></i> </th>
          </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="blaporan_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
    <?php echo form_open_multipart('member/blaporan/tambah',' id="signupform" ');
    input_text("id_pegawai",$member_id,"","","hidden");
    ?>
        <div class="box-body">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
            <?php
              input_text("upload_Files[]","","required","","file");
            ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>No Berkas</label>
            <?php
              input_text("no_berkas",$no_berkas,"maxlength='255' ","Masukkan No","text");
            ?>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label>Nama Berkas</label>
            <?php
              input_text("nama_berkas",$nama_berkas,"maxlength='255' autofocus required","Masukkan Nama","text");
            ?>
          </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
        <?php 
          if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
          }
        ?>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="blaporan_edit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
    <?php echo form_open_multipart('member/blaporan/edit/'.$id,' id="signupform" ');
    input_text("id_berkas",$id_berkas,"","","hidden");
    input_text("link_berkas_lama",$link_berkas,"","","hidden");
    ?>
        <div class="box-body">
      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
            <?php
              input_text("upload_Files[]","","","","file");
            ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>No Berkas</label>
            <?php
              input_text("no_berkas",$no_berkas,"maxlength='255' ","Masukkan No","text");
            ?>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <label>Nama Berkas</label>
            <?php
              input_text("nama_berkas",$nama_berkas,"maxlength='255' autofocus required","Masukkan Nama","text");
            ?>
          </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
        <?php 
          if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
          }
        ?>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="ijasah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
						<?php
							input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
						?>
          </div>
        </div>
        <div class="box-body">
					<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
						  <thead>
							<tr>
							  <th width="5%" style="display:none;">ID</th>
							  <th>Nama Instansi</th>
							  <th>Jenjang Pendidikan</th>
							  <th>No Ijasah</th>
							  <th>Lulus Tahun</th>
							  <th><i class="fa fa-search"></i> </th>
							</tr>
						  </thead>
					</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="ijasah_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('member/ijasah/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]","","","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>No Ijasah</label>
						<?php
							input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Instansi Pendidikan</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Jenjang Pendidikan</label>
					<?php
						input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Tanggal Kelulusan</label>
					<?php
						input_calendar("first_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="ijasah_edit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('member/ijasah/edit/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("link_berkas_lama",$link_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]","","","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>No Ijasah</label>
						<?php
							input_text("no_berkas",$no_berkas,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Instansi Pendidikan</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Jenjang Pendidikan</label>
					<?php
						input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
					?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
					<label>Tanggal Kelulusan</label>
					<?php
						input_calendar("first_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pelatihan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				  <thead>
					<tr>
					  <th width="5%"></th>
					  <th width="5%" style="display:none;">ID</th>
					  <th>Nama Pelatihan</th>
					  <th>SKP / SKS</th>
					  <th>Tanggal Mulai</th>
					  <th>Tanggal Selesai</th>
					  <th><i class="fa fa-search"></i> </th>
					</tr>
				  </thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="pelatihan_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('member/pelatihan/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Mulai</label>
					<?php
						input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Akhir</label>
					<?php
						input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>No SK / Sertifikat</label>
						<?php
							input_text("no_sertifikat",$no_sertifikat,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
                  <label>Nilai SKP / SKS (Gunakan titik untuk desimal misal 1.5)</label>
					<?php
						input_textcustom("kredit",$kredit,"maxlength='4' required
						onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'
						","Masukkan Nilai SKP / SKS","text");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Penyelenggara</label>
					<?php
						input_text("penyelenggara",$penyelenggara,"maxlength='255' ","Masukkan penyelenggara","text");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Pelatihan</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori Pelatihan Unit / Jenjang Karir</label>
					<?php
						input_pdselect2fleksibel("id_kategori_pelatihan","id_kategori_pelatihan",$kategori_pelatihan,"id_kategori_pelatihan","nama_kategori_pelatihan",$id_kategori_pelatihan,"Tidak Ada Kategori");
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pelatihan_edit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('member/pelatihan/edit/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("link_berkas_lama",$link_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Mulai</label>
					<?php
						input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Tanggal Akhir</label>
					<?php
						input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>No SK / Sertifikat</label>
						<?php
							input_text("no_sertifikat",$no_sertifikat,"maxlength='255' autofocus","Masukkan No","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
                  <label>Nilai SKP / SKS (Gunakan titik untuk desimal misal 1.5)</label>
					<?php
						input_textcustom("kredit",$kredit,"maxlength='4' required
						onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'
						","Masukkan Nilai SKP / SKS","text");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Penyelenggara</label>
					<?php
						input_text("penyelenggara",$penyelenggara,"maxlength='255' ","Masukkan penyelenggara","text");
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Pelatihan</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$ambil_kategori_berkas,$id_kategori_berkas);
					?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					<label>Kategori Pelatihan Unit / Jenjang Karir</label>
					<?php
						input_pdselect2fleksibel("id_kategori_pelatihan","id_kategori_pelatihan",$kategori_pelatihan,"id_kategori_pelatihan","nama_kategori_pelatihan",$id_kategori_pelatihan,"Tidak Ada Kategori");
					?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="surat_ijin")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				  <thead>
					<tr>
					  <th width="5%" style="display:none;">ID</th>
					  <th>Nama File</th>
					  <th>Nama Berkas</th>
					  <th>No STR/SIK/SIP</th>
					  <th>Berlaku</th>
					  <th>Expired</th>
					  <th>Status</th>
					  <th><i class="fa fa-search"></i> </th>
					</tr>
				  </thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="surat_ijin_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('member/surat_ijin/tambah',' id="signupform" ');
		input_text("id_pegawai",$member_id,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
                  <label>No STR/SIK/SIP</label>
					<?php
						input_text("no_berkas",$no_berkas,"maxlength='255' required","Masukkan No STR / SIK / SIP","text");
						?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Tanggal Berlaku</label>
					<?php
						input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Tanggal Expired</label>
					<?php
						input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
					?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label>Kategori</label>
					<?php
						input_pdselect2("id_kategori_berkas",$kategori_str_all,$id_kategori_berkas);
					?>
					</div>
				</div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Kategori</label>
          <?php
            input_pdselect2("lifetime_berkas",$lifetimekah,$lifetime_berkas);
          ?>
          </div>
        </div>
			</div>
        </div>
        <div class="box-footer">
         <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="surat_ijin_perpanjangan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('member/surat_ijin/perpanjangan/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("id_pegawai",$member_id,"","","hidden");
		input_text("id_kategori_berkas",$id_kategori_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
                  <label>No STR/SIK/SIP</label>
					<?php
						input_text("no_berkas",$no_berkas,"maxlength='255' required","Masukkan No STR / SIK / SIP","text");
						?>
					</div>
				</div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Tanggal Berlaku</label>
          <?php
            input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
          ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Tanggal Expired</label>
          <?php
            input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
          ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Kategori</label>
          <?php
            input_pdselect2("id_kategori_berkas",$kategori_str_all,$id_kategori_berkas);
          ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Kategori</label>
          <?php
            input_pdselect2("lifetime_berkas",$lifetimekah,$lifetime_berkas);
          ?>
          </div>
        </div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="surat_ijin_edit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<?php echo form_open_multipart('member/surat_ijin/edit/'.$id,' id="signupform" ');
		input_text("id_berkas",$id_berkas,"","","hidden");
		input_text("link_berkas_lama",$link_berkas,"","","hidden");
		?>
        <div class="box-body">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
					  <label>Pilih Berkas &nbsp;<small">Format harus PDF</small></label>
						<?php
							input_text("upload_Files[]",""," ","","file");
						?>
					</div>
				</div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Tanggal Berlaku</label>
          <?php
            input_calendar("first_date","tgl_a_berkas",$tgl_a_berkas,"Masukkan Tanggal"," required");
          ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Tanggal Expired</label>
          <?php
            input_calendar("last_date","tgl_b_berkas",$tgl_b_berkas,"Masukkan Tanggal"," required");
          ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Kategori</label>
          <?php
            input_pdselect2("lifetime_berkas",$lifetimekah,$lifetime_berkas);
          ?>
          </div>
        </div>
				<div class="col-md-6">
					<div class="form-group">
					  <label>Nama Berkas</label>
						<?php
							input_text("nama_berkas",$nama_berkas,"maxlength='255' required","Masukkan Nama","text");
						?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
                  <label>No STR/SIK/SIP</label>
					<?php
						input_text("no_berkas",$no_berkas,"maxlength='255' required","Masukkan No STR / SIK / SIP","text");
						?>
					</div>
				</div>
			</div>
        </div>
        <div class="box-footer">
        <?php 
        	if(empty($this->session->id_level)){
        ?>
        <div class="box-footer">
<button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
        <?php 
					}
        ?>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="logbook")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_kembali;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
		   <h3 class="box-title">
			<?php echo $header; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
		   </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
			<div class="col-md-6">
			<?php echo form_open_multipart('ol_logbook/logbook/view/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe,' id="signupform" '); ?>
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
				</div>
				  <div class="box-body">
					<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <label>Tanggal Awal</label>
										<?php
											input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal","");
										?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label>Tanggal Akhir</label>
									<?php
										input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal","");
									?>
								</div>
							</div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Instansi</label>
                  <?php
  input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_instansi_null,"barcode_working","nama_working",$id_ruangan,"Semua");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kompetensi</label>
                  <?php
  input_pdselect2fleksibel("id_kompetensi","id_kompetensi",$ambil_data_kompetensi_null,"id_kompetensi","nama_kompetensi",$pxe,"Semua");
                  ?>
                </div>
              </div>
					</div>
				  </div>
					<div class="box-footer">
					  <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
					</div>
			  </div>
				<?php echo form_close(); ?>
			 </div>
			<div class="col-md-6">
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">CATATAN</h3>
				</div>
				  <div class="box-body">
				  <div class="box box-widget">
					<div style="font-weight:bold;color:green;" class="box-body">
						<ul>
						<li>KEWENANGAN KOMPETENSI SESUAI KEMENAKER NO 237 TAHUN 2020</li>
						<li>TENTANG PENETAPAN STANDAR KOMPETENSI KERJA NASIONAL INDONESIA</li>
						<li>GUNAKAN RANGE / PERIODE TANGGAL UNTUK MELIHAT DATA LOGBOOK LAMA</li>
            <li>SIFAT KOMPETENSI : <font color="red">MANDIRI</font> (DIKERJAKAN SENDIRI), <font color="maroon">KOLABORASI</font> (KELOMPOK MISAL CATHLAB), <font color="blue">MANDAT</font> (ATAS PERINTAH NAMUN TANGGUNG JAWAB OLEH PEMBERI PERINTAH), <font color="black">DELEGASI</font> (ATAS PERINTAH NAMUN TANGGUNG JAWAB SENDIRI), <font color="red">SUPERVISI (DI AWASI MENTOR / MENTORSHIP)</font></li>
            <li><font color="red">DATA YANG DI NILAI ADALAH KOMPETENSI, CUKUP MEMASUKKAN 1 KEWENANGAN / SUB KOMPETENSI JIKA ADA 2 DALAM 1 KOMPETENSI, MISAL TELAH MELAKUKAN</font> EPIDIDIMIS KIRI / KANAN, <font color="red"> CUKUP SALAH SATUNYA SAJA KARENA KEDUANYA TERMASUK KOMPETENSI</font> PEMERIKSAAN (USG) SKORTUM</li>
					</ul>						
					</div>
					<!-- /.box-body -->
				  </div>
				  </div>
			  </div>
			</div>
			<div class="col-md-12">
			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				   <h3 class="box-title">
					DATA LOGBOOK
				   </h3>
				  <div class="box-tools pull-right">
          <a href="<?php echo base_url('ol_logbook/logbook/pdf_logbook/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe.'/1'); ?>" target="_blank" class="btn btn-white btn-md">
            <i class="fa fa-file-pdf-o"></i> KP/Page
          </a> ||
          <a href="<?php echo base_url('ol_logbook/logbook/pdf_eukom/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe.'/1'); ?>" target="_blank" class="btn btn-white btn-md">
            <i class="fa fa-file-pdf-o"></i> KW/Page
          </a> ||
					<a href="<?php echo base_url('ol_logbook/logbook/pdf_logbook/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe.'/0'); ?>" target="_blank" class="btn btn-white btn-md">
						<i class="fa fa-file-pdf-o"></i> KP 
					</a> ||
					<a href="<?php echo base_url('ol_logbook/logbook/pdf_eukom/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe.'/0'); ?>" target="_blank" class="btn btn-white btn-md">
						<i class="fa fa-file-pdf-o"></i> KW
					</a> ||
          <a href="<?php echo base_url('ol_logbook/logbook/pdf_tahunan/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe.'/0/1'); ?>" target="_blank" class="btn btn-white btn-md">
            <i class="fa fa-file-pdf-o"></i> KP Rekap
          </a> ||
          <a href="<?php echo base_url('ol_logbook/logbook/pdf_tahunan/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe.'/0/0'); ?>" target="_blank" class="btn btn-white btn-md">
            <i class="fa fa-file-pdf-o"></i> KW Rekap
          </a> ||
          <a href="<?php echo base_url('ol_logbook/logbook/pdf_pasien/'.$first_date.'/'.$last_date.'/'.$id_ruangan.'/'.$pxe); ?>" target="_blank" class="btn btn-white btn-md">
            <i class="fa fa-file-pdf-o"></i> BCP
          </a>
				  </div>
				</div>
				<div class="box-body">
				  <div class="box-tools pull-right">
					<?php
						input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
					?>
				  </div>
					<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
						<thead>
							<tr>
                <th style="vertical-align:middle;font-weight:bold;width: 5%;"></th>                
							  <th style="vertical-align:middle;font-weight:bold;display:none;"></th>
							  <th style="vertical-align:middle;font-weight:bold;">Tanggal</th>
							  <th style="vertical-align:middle;font-weight:bold;">Kode Unit</th>
							  <th style="vertical-align:middle;font-weight:bold;width:50%;">Nama Kompetensi</th>
							  <th style="vertical-align:middle;font-weight:bold;text-align: right;width: 7%;">Q</th>
                <th style="vertical-align:middle;font-weight:bold;">Sifat</th>
                <th style="vertical-align:middle;font-weight:bold;">Instansi</th>
							</tr>
						</thead>
					</table>
				</div>
			  </div>
			  </div>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
       <?php echo $instance_name; ?>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="logbook_sign")
{
?>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_logbook/logbook/simpan_sign');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><b></button>KOSONGKAN JIKA TIDAK INGIN MUNCUL</b></h3>
      </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Header Atas</label>
                      <?php
                         input_text("header",$header,"maxlength='255' ","LAPORAN ........,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Header Tengah</label>
                      <?php
                         input_text("sub_header",$sub_header,"maxlength='255' ","PERIODE .......,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Header Bawah</label>
                      <?php
                         input_text("sub_sub_header",$sub_sub_header,"maxlength='255' ","RS .......,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <label>Opsi Text Sebelum Tabel</label>
                  <?php
                    input_textareacustom("sebelum",$sebelum," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Text");
                  ?>        
                </div>
                <div class="col-md-12">
                  <label>Opsi Text Sesudah Tabel</label>
                  <?php
                    input_textareacustom("sesudah",$sesudah," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Text");
                  ?>        
                </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Tanggal</label>
                      <?php
                         input_text("kiri_tgl",$kiri_tgl,"maxlength='255' ","Kota, Tanggal ....,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Tanggal</label>
                      <?php
                         input_text("tengah_tgl",$tengah_tgl,"maxlength='255' ","Kota, Tanggal ....,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Tanggal</label>
                      <?php
                         input_text("kanan_tgl",$kanan_tgl,"maxlength='255' ","Kota, Tanggal ....,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Atas</label>
                      <?php
                         input_text("kiri_top",$kiri_top,"maxlength='255' ","Mengetahui,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Atas</label>
                      <?php
                         input_text("tengah_top",$tengah_top,"maxlength='255' ","Mengetahui,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Atas</label>
                      <?php
                         input_text("kanan_top",$kanan_top,"maxlength='255' ","Mengetahui,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Tengah</label>
                      <?php
                         input_text("kiri_middle",$kiri_middle,"maxlength='255' ","Nama Jabatan","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Tengah</label>
                      <?php
                         input_text("tengah_middle",$tengah_middle,"maxlength='255' ","Nama Jabatan","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Tengah</label>
                      <?php
                         input_text("kanan_middle",$kanan_middle,"maxlength='255' ","Nama Jabatan","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Nama</label>
                      <?php
                         input_text("kiri_nama",$kiri_nama,"maxlength='255' ","Nama Penjabat","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Nama</label>
                      <?php
                         input_text("tengah_nama",$tengah_nama,"maxlength='255' ","Nama Penjabat","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Nama</label>
                      <?php
                         input_text("kanan_nama",$kanan_nama,"maxlength='255' ","Nama Penjabat","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Bawah</label>
                      <?php
                         input_text("kiri_nip",$kiri_nip,"maxlength='255' ","Nip Penjabat","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Bawah</label>
                      <?php
                         input_text("tengah_nip",$tengah_nip,"maxlength='255' ","Nip Penjabat","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Bawah</label>
                      <?php
                         input_text("kanan_nip",$kanan_nip,"maxlength='255' ","Nip Penjabat","text");
                      ?>        
                  </div>
               </div>
             </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="logbook_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('ol_logbook/logbook/tambah' ,' id="signupform" ');
  	input_text("id_jabatan",$this->session->id_jabatan,"","","hidden");
	?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
			<?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
		   </h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
		  <table id="example1" width="100%" class="table table-bordered table-striped">
			  <thead>
				<tr>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">
						<input name="select_all" class="checkall" type="checkbox" />
					</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Kode Unit</th>
					<th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Grade</th>
				</tr>
			  </thead>
			  <tbody>
					<?php
          $kondisi=array('id_logbooker'=>$this->session->id_pegawai,'tolak >'=> 0);
          $tolake = $this->m_umum->ambil_data_kondisi_result('ol_logbook',$kondisi);
          $kw_tolak = array();
          foreach($tolake as $valambil_kw_tolak){
              $kw_tolak[] = $valambil_kw_tolak['id_kewenangan'];
          }
          $eimplokw_tolak = implode(",", $kw_tolak);
					foreach($kr_kewenangan_detil as $row){
            if (in_array($row['id_kewenangan'],explode(",", $eimplokw_tolak))){ 
              $tol = ' - <b><font color="red">TOLAK</font></b>'; 
            }else{ 
              $tol = ''; 
            }
					?>
				<tr>
					<td style="vertical-align:middle;">
					  <div class="checkbox">
						<label>
						  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan'];?>" >
						</label>
					  </div>
					</td>
          <td style="vertical-align:middle;"><?php echo $row['kode_unit']; ?></td>
					<td style="vertical-align:middle;"><span style="font-weight:bold;color:green;"><?php echo $row['nama_kewenangan']; ?></span> [<?php echo $row['nama_kompetensi']; ?>] <?php echo $tol; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_grade']; ?></td>
				</tr>
					<?php
						}
					?>
			  </tbody>
		  </table>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
	<?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="logbook_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_logbook/logbook/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="barcode_logbook" value="<?= $barcode_logbook; ?>">
    <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
    <input type="hidden" name="id_logbook" value="<?= $id_logbook; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title ?></h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-3">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_logbook","tgl_logbook",$tgl_logbook,"Masukkan Tanggal Transaksi"," required");
                  ?>
              </div>  
              <div class="col-md-9">
                  <label>Pencatatan Registrasi Pasien</label>
                  <?php
                     input_text("rm",$rm," ","","text");
               //     input_text("rm",$rm," id='editor1' rows='2' cols='10' class='form-control' ","Keterangan");
                  ?>        
              </div>
              <div class="col-md-2">
                  <label>Jumlah</label>
                  <?php
                    input_textcustom("jml_logbook","$jml_logbook","maxlength='5' required class='form-control' onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan Jumlah","text");
                  ?>  
              </div>    
              <div class="col-md-7">
                  <label>Instansi</label>
                        <?php
                          input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
                        ?>
              </div>
              <div class="col-md-3">
                  <label>Sifat</label>
                        <?php
                          input_pdselect2("id_sifat_kewenangan",$sifat,$id_sifat_kewenangan);
                        ?>
              </div>
             </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_logbook').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_logbook").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="logbook_isi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
		<a href="<?php echo $link_awal;?>"
			class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
		</a>
    </section>
    <section class="content">
	<?php echo form_open_multipart('ol_logbook/logbook/isi/'.$first_date,' id="signupform" ');
	input_text("id_pegawai",$this->session->id_pegawai,"","","hidden");
	input_text("counter",$count,"","","hidden");
	?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <?= $title ?>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
        <div class="row">
      <div class="col-md-12">
        <div class="col-md-2">
            <label>Tanggal</label>
              <?php
                input_calendar("tgl_logbook","tgl_logbook",$tgl_logbook,"Masukkan Tanggal Transaksi"," required");
              ?>
        </div>
        <div class="col-md-6">
            <label>Instansi</label>
                  <?php
                    input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
                  ?>
        </div>
      </div>
				<?php
        $no =0;
				foreach($kr_kewenangan as $row){
					if(in_array($row['id_kewenangan'], $terpilih)){
						input_text("id_kewenangan[]",$row['id_kewenangan'],"","","hidden");
            $jml_log = $this->m_ol_rancak->jumlah_record_logbook($row['id_kewenangan']);
            if($jml_log == 0){
                $no++;  
				?>
      <div class="col-md-12">
        <div class="col-md-4">
        <label><strong>Kewenangan - Kompetensi</strong></label>
        <?php
        input_textarea("nama_kewenangan[]",$row['nama_kewenangan'].' - Kompetensi : '.$row['nama_kompetensi'],"readonly ","","text");
        ?>
      </div>
      <div class="col-md-5">
        <label><strong>Pencatatan Registrasi Pasien</strong></label>
        <?php
    input_text("rm[]","","","","text");
    //    input_textarea("rm[]","","  ","","text");
        ?>
      </div>      
			<div class="col-md-1">
        <label><strong>Jumlah</strong></label>
        <?php if($count=='0') { $read = 'readonly'; } else { $read = '';}
        input_textcustom("jml_logbook[]","1","maxlength='5' required class='form-control' $read
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan Jumlah","text"); ?>
        </div>
        <div class="col-md-2">
          <label><strong>Sifat</strong></label>
          <?php input_pdselect2('id_sifat_kewenangan[]',$sifat,$id_sifat_kewenangan); ?>
        </div>
      </div>
				<?php
      }
    }
  }
				?>
        </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	<?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="ps_pakai")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">RM : <?php echo $rm; ?> / NAMA PASIEN : <?php echo $nm_pasien; ?> (TAMBAH DATA BAKHP)</h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th style="display:none;">ID</th>
              <th>Nama BAKHP</th>
              <th>Jumlah</th>
            </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="ps_pakai_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
} 
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/ps_pakai/simpan_tambah');?>" onClick="return cek();">
          <input type="hidden" name="id_logbook_pasien" value="<?= $id; ?>">
          <input type="hidden" name="id_logbook" value="<?= $idp; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">BAKHP YANG SAMA TIDAK DISIMPAN</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?= $title ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
          <div class="col-md-12">
          <div class="table-responsive" tabindex="-1">
            <table id="item_table" class="table table-hover table-transaksi table-sm">
            <thead class="bg-light">
               <tr style="background-color: #800000;color: white;">
              <th class="text-sm text-label text-center border-0">Nama BAKHP</th>
              <th class="text-sm text-label text-center border-0" style="width: 15%">Jumlah</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%"></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            </table>
          </div>
          <div class="col-md-12">
          <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
          </div>
          </div>
             </div>
            </div>
          </div>
        </div>
      </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2();
$(document).on('click', '.add', function(){
var html = '';
html += '<tr>';
html += '<td class="text-sm text-label border-0"><select name="id_bahan[]" required="required" class="select_bahan form-control select2"><option value="0">Jenis BAKHP</option></select></td>';
html += '<td class="text-sm text-label border-0"><input type="text" name="jml_bahan[]" value="0" class="form-control" style="text-align:right;"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3"/></td>';
html += '<td class="text-sm text-label border-0"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
$('#item_table').append(html); 
$('.select2').select2();     
      $(".select_bahan").select2({
      ajax: {
        url: '<?php echo base_url();?>member/data_bahan',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            searchTerm: params.term // search term
          };
        },
        processResults: function (response) {
          return {
            results: response
          };
        },
        cache: true
      }
      }); 
/*      $(".select_reject").select2({
      ajax: {
        url: '?php echo base_url();?>ol_logbook/data_reject',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            searchTerm: params.term // search term
          };
        },
        processResults: function (response) {
          return {
            results: response
          };
        },
        cache: true
      }
      });*/ 
});
$(document).on('click', '.remove', function(){
$(this).closest('tr').remove();
}); 
});
</script>
<?php
}
elseif ($page=="ps_pakai_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/ps_pakai/simpan_edit');?>" onClick="return cek();">
          <input type="hidden" name="id_logbook" value="<?= $jml; ?>">
          <input type="hidden" name="id_logbook_pasien" value="<?= $idp; ?>">
          <input type="hidden" name="id_logbook_pakai" value="<?= $id; ?>">
          <input type="hidden" name="id_bahan_lama" value="<?= $id_bahan; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">RUBAH BAKHP</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-8">
                  <label>bakhp</label>
                  <?php
                input_pdselect2("id_bahan",$cmd_bahan,$id_bahan);
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Jumlah</label>
                  <?php
                input_textcustom("jml_bahan",$jml_bahan," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah BAKHP","text");  
                  ?>
              </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="ps_reject")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">RM : <?php echo $rm; ?> / NAMA PASIEN : <?php echo $nm_pasien; ?> (TAMBAH DATA BAKHP)</h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th style="display:none;">ID</th>
              <th>Nama BAKHP</th>
              <th>Jumlah</th>
              <th>Nama Reject</th>
            </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="ps_reject_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
} 
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/ps_reject/simpan_tambah');?>" onClick="return cek();">
          <input type="hidden" name="id_logbook_pasien" value="<?= $id; ?>">
          <input type="hidden" name="id_logbook" value="<?= $idp; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">BAKHP YANG SAMA TIDAK DISIMPAN</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?= $title ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
          <div class="col-md-12">
          <div class="table-responsive" tabindex="-1">
            <table id="item_table" class="table table-hover table-transaksi table-sm">
            <thead class="bg-light">
               <tr style="background-color: #800000;color: white;">
              <th class="text-sm text-label text-center border-0">Nama BAKHP</th>
              <th class="text-sm text-label text-center border-0" style="width: 15%">Jumlah</th>
              <th class="text-sm text-label text-center border-0">Reject</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%"></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            </table>
          </div>
          <div class="col-md-12">
          <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
          </div>
          </div>
             </div>
            </div>
          </div>
        </div>
      </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2();
$(document).on('click', '.add', function(){
var html = '';
html += '<tr>';
html += '<td class="text-sm text-label border-0"><select name="id_bahan[]" required="required" class="select_bahan form-control select2"><option value="0">Jenis BAKHP</option></select></td>';
html += '<td class="text-sm text-label border-0"><input type="text" name="jml_bahan[]" value="0" class="form-control" style="text-align:right;"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3"/></td>';
html += '<td class="text-sm text-label border-0"><select name="id_reject[]" required="required" class="select_reject form-control select2"><option value="0">Jenis Reject</option></select></td>';
html += '<td class="text-sm text-label border-0"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
$('#item_table').append(html); 
$('.select2').select2();     
      $(".select_bahan").select2({
      ajax: {
        url: '<?php echo base_url();?>member/data_bahan',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            searchTerm: params.term // search term
          };
        },
        processResults: function (response) {
          return {
            results: response
          };
        },
        cache: true
      }
      }); 
      $(".select_reject").select2({
      ajax: {
        url: '<?php echo base_url();?>member/data_reject',
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            searchTerm: params.term // search term
          };
        },
        processResults: function (response) {
          return {
            results: response
          };
        },
        cache: true
      }
      }); 
});
$(document).on('click', '.remove', function(){
$(this).closest('tr').remove();
}); 
});
</script>
<?php
}
elseif ($page=="ps_reject_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/ps_reject/simpan_edit');?>" onClick="return cek();">
          <input type="hidden" name="id_logbook" value="<?= $jml; ?>">
          <input type="hidden" name="id_logbook_pasien" value="<?= $idp; ?>">
          <input type="hidden" name="id_logbook_reject" value="<?= $id; ?>">
          <input type="hidden" name="id_bahan_lama" value="<?= $id_bahan; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">RUBAH BAKHP</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-5">
                  <label>BAKHP</label>
                  <?php
                input_pdselect2("id_bahan",$cmd_bahan,$id_bahan);
                  ?>
              </div>
              <div class="col-md-2">
                  <label>Jumlah</label>
                  <?php
                input_textcustom("jml_bahan",$jml_bahan," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah BAKHP","text");  
                  ?>
              </div>
              <div class="col-md-5">
                  <label>Reject</label>
                  <?php
                input_pdselect2("id_reject",$cmd_reject,$id_reject);
                  ?>
              </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="ps_pakai_tSambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?= $title ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
          <div class="col-md-12">
          <div class="table-responsive" tabindex="-1">
            <table id="item_table" class="table table-hover table-transaksi table-sm">
            <thead class="bg-light">
               <tr style="background-color: #800000;color: white;">
              <th class="text-sm text-label text-center border-0" style="display: none;"></th>
              <th class="text-sm text-label text-center border-0">Nama BAKHP</th>
              <th class="text-sm text-label text-center border-0" style="width: 15%">Jumlah</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%"></th>
              </tr>
            </thead>
            <tbody>
              <?php  
                foreach($data_pasien as $rowsoal){
              ?>
              <tr>
              <td class="text-sm text-label border-0" style="display: none;">
              <?php
                input_text("id_logbook_pakai_edit[]",$rowsoal['id_logbook_pakai'],"required ","","hidden");
              ?>               
              </td>    
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("id_bahan_edit[]",$cmd_bahan,$rowsoal['id_bahan']);
              ?>
              </td>      
              <td class="text-sm text-label border-0">
              <?php 
                input_textcustom("jml_bahan_edit[]",$rowsoal['jml_bahan']," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah BAKHP","text");          
              ?>              
              </td>                  
              <td class="text-sm text-label border-0"></td>
              </tr>
            <?php  
              }
            ?>
            </tbody>
            </table>
          </div>
          <div class="col-md-12">
          <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
          </div>
          </div>
             </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="pasien")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $nm_kewenangan; ?> <small>   </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">SILAHKAN PILIH RM PASIEN JIKA TIDAK ADA PILIH TAMBAH PASIEN</h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th>RM</th>
              <th>Nama Pasien</th>
              <th>Tanggal Lahir</th>
              <th>Jenis Kelamin</th>
            </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="pasien_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/pasien/simpan_tambah');?>" onClick="return cek();">
          <input type="hidden" name="id_logbook" value="<?= $id_logbook; ?>">
          <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
          <input type="hidden" name="jml_logbook" value="<?= $jml_logbook; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">SILAHKAN CARI DATA DI NAMA PASIEN BERDASARKAN RM / NAMA PASIEN</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text"); 
                  ?>
              </div>
              <div class="col-md-8">
                  <label for="autocomplete">Cari Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' required id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-2">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Alamat</label>
                  <?php
                     input_text("alamat",$alamat," maxlength='255' ","Alamat","text");
               //     input_text("rm",$rm," id='editor1' rows='2' cols='10' class='form-control' ","Keterangan");
                  ?>        
              </div>
              <div class="col-md-3">
                  <label>Pemakaian</label>
                  <?php
                input_textcustom("jml_bahan",$jml_bahan," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah Pemakaian","text"); 
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Bahan</label>
                  <?php
                input_pdselect2("id_bahan",$cmd_bahan,$id_bahan);
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Reject</label>
                  <?php
                input_textcustom("jml_reject",$jml_reject," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah Reject","text");  
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Bahan Reject</label>
                  <?php
                input_pdselect2("id_reject",$cmd_reject,$id_reject);
                  ?>
              </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
    </FORM>
<script type="text/javascript">
var status=0;
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>member/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>member/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="pasien_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/pasien/simpan_edit');?>" onClick="return cek();">
          <input type="hidden" name="id_logbook_pasien" value="<?= $id_logbook_pasien; ?>">
          <input type="hidden" name="id_logbook" value="<?= $id_logbook; ?>">
          <input type="hidden" name="jml_logbook" value="<?= $jml_logbook; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">SILAHKAN CARI DATA DI NAMA PASIEN BERDASARKAN RM / NAMA PASIEN</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-4">
                  <label>RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text"); 
                  ?>
              </div>
              <div class="col-md-8">
                  <label for="autocomplete">Cari Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' required id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
              <div class="col-md-3">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-2">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div>
              <div class="col-md-7">
                  <label>Alamat</label>
                  <?php
                     input_text("alamat",$alamat," maxlength='255' ","Alamat","text");
               //     input_text("rm",$rm," id='editor1' rows='2' cols='10' class='form-control' ","Keterangan");
                  ?>        
              </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
    </FORM>
<script type="text/javascript">
var status=0;
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>member/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>member/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="logbook_pasien")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?= $title ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
          <div class="col-md-12">
          <div class="table-responsive" tabindex="-1">
            <table id="item_table" class="table table-hover table-transaksi table-sm">
            <thead class="bg-light">
               <tr style="background-color: #800000;color: white;">
              <th class="text-sm text-label text-center border-0" style="display: none;"></th>
              <th class="text-sm text-label text-center border-0">Nama Pasien</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">RM</th>
              <th class="text-sm text-label text-center border-0" style="width: 7%;text-align:right;">Umur</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">&nbsp;</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">Jenis Kelamin</th>
              <th class="text-sm text-label text-center border-0" style="width: 7%">Film</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">Jenis FIlm</th>
              <th class="text-sm text-label text-center border-0" style="width: 7%">Reject</th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">Jenis Reject</th>
              <th class="text-sm text-label text-center border-0" style="width: 5%"></th>
              </tr>
            </thead>
            <tbody>
              <?php  
                foreach($data_pasien as $rowsoal){
              ?>
              <tr>
              <td class="text-sm text-label border-0" style="display: none;">
              <?php
                input_text("id_pasien_edit[]",$rowsoal['id_pasien'],"required ","","hidden");
              ?>               
              </td>
              <td class="text-sm text-label border-0">
              <?php
                input_text("nama_pasien_edit[]",$rowsoal['nama_pasien'],"required maxlength='255' ","","text");
              ?>               
              </td>
              <td class="text-sm text-label border-0">
              <?php
                input_textcustom("rm_edit[]",$rowsoal['rm']," style='text-align:right;' maxlength='20' required id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text"); 
            //    input_text("rm_edit[]",$rowsoal['rm'],"maxlength='10' ","","text");
              ?>               
              </td>
              <td class="text-sm text-label border-0">
              <?php 
                input_textcustom("umur_pasien_edit[]",$rowsoal['umur_pasien']," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text");          
              ?>              
              </td>     
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("satuan_pasien_edit[]",$cmd_satuan_umur,$rowsoal['satuan_pasien']);
              ?>
              </td>      
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("gender_pasien_edit[]",$cmd_jk,$rowsoal['gender_pasien']);
              ?>
              </td>
              <td class="text-sm text-label border-0">
              <?php 
                input_textcustom("jml_bahan_edit[]",$rowsoal['jml_bahan']," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text");          
              ?>              
              </td>     
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("id_bahan_edit[]",$cmd_bahan,$rowsoal['id_bahan']);
              ?>
              </td> 
              <td class="text-sm text-label border-0">
              <?php 
                input_textcustom("jml_reject_edit[]",$rowsoal['jml_reject']," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text");          
              ?>              
              </td>     
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("id_reject_edit[]",$cmd_reject,$rowsoal['id_reject']);
              ?>
              </td>               
              <td class="text-sm text-label border-0"></td>
              </tr>
            <?php  
              }
            ?>
            </tbody>
            </table>
          </div>
          <div class="col-md-12">
          <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
          </div>
          </div>
             </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="unit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
   //     input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Status</th>
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="unit_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/unit/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">     
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_unit",$ambil_data_unit_instansi,$id_unit);
                ?>
            </div>       
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pegawai_unit",$cmd_status,$status_pegawai_unit);
                  ?>
              </div>
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="unit_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/unit/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai_unit" value="<?= $id; ?>">
            <input type="hidden" name="id_unit_lama" value="<?= $id_unit; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_unit",$ambil_data_unit_instansi,$id_unit);
                ?>
            </div>       
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pegawai_unit",$cmd_status,$status_pegawai_unit);
                  ?>
              </div>
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="penilaian_kinerja")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('pegawai/penilaian_kinerja/view/'.$tahun,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Tahun</label>
						<?php
							input_pdselect2("tahun",$cmd_tahun_logbook,$tahun);
						?>
					</div>
				</div>
			</div>
		  </div>
			<div class="box-footer">
			  <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
			</div>
	  </div>
	<?php echo form_close(); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">LOGBOOK <?php echo $title; if($tahun > 0) {echo ' TAHUN '.$tahun;} ?></h3>

          <div class="box-tools pull-right">
			<a href="<?php echo base_url('pegawai/penilaian_kinerja/pdf/'); ?><?php echo $tahun;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
          </div>
        </div>
        <div class="box-body">
		   <table id="example1" width="100%" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th style="vertical-align:middle;text-align:center;font-weight:bold;">KEGIATAN</th>
					<th style="vertical-align:middle;text-align:center;font-weight:bold;">NILAI</th>
				</tr>
			</thead>
			<tbody>
			  <tr>
				<td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;">KINERJA KLINIS</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="vertical-align:middle;text-align:left;font-weight:bold;">KOMPETENSI</th>
								<th style="vertical-align:middle;text-align:right;font-weight:bold;width:10%;">JUMLAH</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$total_logbook = 0;$total =0;
							foreach($ambil_data_kompetensi_pegawai_oppe as $rowambil_data_kompetensi_pegawai_oppe){
								$total_logbook = $total_logbook + $rowambil_data_kompetensi_pegawai_oppe['jml_logbook'];
						?>
						  <tr>
							<td style="vertical-align:middle;text-align:left;"><?php echo $rowambil_data_kompetensi_pegawai_oppe['nama_kompetensi']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_data_kompetensi_pegawai_oppe['jml_logbook']; ?></td>
						  </tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</td>
				<td style="vertical-align:middle;text-align:center;font-weight:bold;">
					<?php
						$total_logbook = $this->m_rancak->get_oppe_in_year($this->session->id_pegawai,$tahun);
						if($total_logbook < 7){
							$nilai_logbook = "KURANG";
							$skor_logbook = 0;

						}elseif($total_logbook < 12){
							$nilai_logbook = "CUKUP";
							$skor_logbook = 1;
						}
						else{
							$nilai_logbook = "BAIK";
							$skor_logbook = 2;
						}
						echo $nilai_logbook;						
					?>
				</td>
			  </tr>
			  <tr>
				<td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;">PENGEMBANGAN PROFESI</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;width:10%;">Mulai</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;width:10%;">Akhir</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Nama Pelatihan</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Penyelenggara</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Kategori</th>
								<th style="vertical-align:middle;text-align:right;font-weight:bold;width:10%;">SKS / SKP</th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($ambil_data_pelatihan_pegawai_oppe as $rowambil_data_pelatihan_pegawai_oppe){
						?>
						  <tr>
							<td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_pelatihan_pegawai_oppe['tgl_a_berkas'])); ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_pelatihan_pegawai_oppe['tgl_b_berkas'])); ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_pelatihan_pegawai_oppe['nama_berkas']; ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_pelatihan_pegawai_oppe['penyelenggara']; ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_pelatihan_pegawai_oppe['nama_kategori_pelatihan']; ?></td>
							<td style="vertical-align:middle;text-align:right;"><?php echo $rowambil_data_pelatihan_pegawai_oppe['kredit']; ?></td>
						  </tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</td>
				<td style="vertical-align:middle;text-align:center;font-weight:bold;">
					<?php
						if($jml_pelatihan == 0){
							$nilai_pelatihan = "KURANG";
							$skor_pelatihan = 0;

						}elseif($jml_pelatihan < 4){
							$nilai_pelatihan = "CUKUP";
							$skor_pelatihan = 1;
						}
						else{
							$nilai_pelatihan = "BAIK";
							$skor_pelatihan = 2;
						}
						echo $nilai_pelatihan;
					?>
				</td>
			  </tr>
			  <tr>
				<td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;">ETIKA PROFESI</td>
			  </tr>
			  <tr>
				<td>
					<table width="100%" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Tanggal</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;">Penguji</th>
								<th style="vertical-align:middle;text-align:center;font-weight:bold;width:5%;"><i class="fa fa-print"></i></th>
							</tr>
						</thead>
						<tbody>
						<?php
							foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
						?>
						  <tr>
							<td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
							<td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
							<td style="vertical-align:middle;text-align:center;">
								<a href="<?php echo base_url('pegawai/pengajuan_kompetensi/pdf_etika/'.$rowambil_data_etik_pegawai_oppe['id_etik_pegawai']);?>" class="btn bg-green btn-xs" target="_blank">
								<i class="fa fa-file-pdf-o"></i></a>
							</td>
						  </tr>
						<?php
							}
						?>
						</tbody>
					</table>
				</td>
				<td style="vertical-align:middle;text-align:center;font-weight:bold;">
					<?php
						if($jml_etik == 0){
							$nilai_etik = "KURANG";
							$skor_etik = 0;
						}
						else{
							$nilai_etik = "BAIK";
							$skor_etik = 2;
						}
						echo $nilai_etik;
					?>
				</td>
			  </tr>
			</tbody>
			<tfoot>
			  <tr>
				<td style="vertical-align:middle;text-align:right;font-weight:bold;">RESULT</td>
				<td style="vertical-align:middle;text-align:center;font-weight:bold;">
				<?php
					$total = $skor_logbook + $skor_pelatihan + $skor_etik;
					if($total == 0){
						$nilai_total = "KURANG";

					}elseif($total < 3){
						$nilai_total = "CUKUP";
					}
					elseif($total < 5){
						$nilai_total = "BAIK";
					}
					else{
						$nilai_total = "EXCELLENT";
					}
					echo $nilai_total;
				?>
				</td>
			  </tr>
			</tfoot>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="fppe")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('pegawai/fppe/view/'.$tahun,' id="signupform" '); ?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Tahun</label>
						<?php
							input_pdselect2("tahun",$cmd_tahun_logbook,$tahun);
						?>
					</div>
				</div>
			</div>
		  </div>
			<div class="box-footer">
			  <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
			</div>
	  </div>
	<?php echo form_close(); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; if($tahun > 0) {echo ' TAHUN '.$tahun;} ?></h3>

          <div class="box-tools pull-right">
			<a href="<?php echo base_url('pegawai/fppe/pdf/'); ?><?php echo $id_pegawai;?>/<?php echo $tahun;?>" target="_blank" class="btn btn-white btn-md">
				<i class="fa fa-print"></i> PDF
			</a>
          </div>
        </div>
        <div class="box-body">
				   <table id="example1" width="100%" class="table table-bordered table-striped">
						<thead>
								<tr>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:5%;">ID</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:10%;">Tanggal Awal</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:10%;">Tanggal Akhir</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:15%">Nama</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:15%">Ruangan</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:15%">Penanggung Jawab</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;width:15%">Tempat</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
									<th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;font-weight:bold;">Catatan</th>
								</tr>
						</thead>
						<tbody>
						<?php
							$ambil_lobook_pemulihan_pertahun = $this->m_rancak->ambil_lobook_pemulihan_pertahun($this->session->id_user,$tahun);
							foreach($ambil_lobook_pemulihan_pertahun as $rowambil_lobook_pemulihan_pertahun){
						?>
					  <tr> 
					  	<td style="vertical-align:middle;text-align:center;"><?= $rowambil_lobook_pemulihan_pertahun['id_logbook_pemulihan'] ?></td>
					    <td style="vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_pertahun['tgl_awal'])) ?></td>
					    <td style="vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_pertahun['tgl_akhir'])) ?></td>
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['nama_pegawai'] ?></td>
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['nama_ruangan'] ?></td>
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['penanggungjawab'] ?></td>
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['tujuan'] ?></td>
					    <td style="vertical-align:middle;text-align:left;">
					    	<?php
					    		if($rowambil_lobook_pemulihan_pertahun['result_pemulihan'] == 0){
					    			echo 'Proses';
					    		}elseif($rowambil_lobook_pemulihan_pertahun['result_pemulihan'] == 1){
					    			echo 'Kompeten';
					    		}else{
					    			echo 'Tidak Kompeten';
					    		}
					    	?>
					    </td>
					    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_pertahun['catatan_pemulihan'] ?></td>
					  </tr>
								<tr>
									<th colspan="9" style="background-color: #e0e0e0;text-align: center;">KEGIATAN PEMULIHAN</th>
								</tr>
							  <tr>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">&nbsp;</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">Tanggal</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">RM</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">Penguji</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;" colspan="2">Kompetensi</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;">Hasil</th>
							    <th style="background-color: #e0e0e0;vertical-align:middle;text-align:center;" colspan="2">Catatan</th>
							  </tr>
								<?php
									$ambil_lobook_pemulihan_detil = $this->m_rancak->ambil_kewenangan_lobook_kegiatan_pemulihan_detil($rowambil_lobook_pemulihan_pertahun['id_logbook_pemulihan']);
									foreach($ambil_lobook_pemulihan_detil as $rowambil_lobook_pemulihan_detil){
								?>
							  <tr>
							  	<td style="vertical-align:middle;text-align:left;">&nbsp;</td>
							    <td style="vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_detil['tgl_kegiatan_pemulihan'])) ?></td>
							    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_detil['rm_kegiatan_pemulihan'] ?></td>
							    <td style="vertical-align:middle;text-align:left;"><?= $rowambil_lobook_pemulihan_detil['nama_pegawai'] ?></td>
							    <td style="vertical-align:middle;text-align:left;" colspan="2"><?= $rowambil_lobook_pemulihan_detil['nama_kewenangan'] ?></td>
							    <td style="vertical-align:middle;text-align:left;">
						    	<?php
						    		if($rowambil_lobook_pemulihan_detil['result_kegiatan_pemulihan'] == 0){
						    			echo 'Proses';
						    		}elseif($rowambil_lobook_pemulihan_detil['result_kegiatan_pemulihan'] == 1){
						    			echo 'Kompeten';
						    		}else{
						    			echo 'Tidak Kompeten';
						    		}
						    	?>
							    </td>
							    <td style="vertical-align:middle;text-align:left;" colspan="2"><?= $rowambil_lobook_pemulihan_detil['catatan_kegiatan_pemulihan'] ?></td>
							  </tr>
						<?php
									}
							}
						?>
							</tbody>
						</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="lt")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open('member/lt/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			<div class="col-md-4">
				<label>Range</label>
					<?php
						input_pdselect2("page",$array_page,$page);
					?>
			</div>
			<div class="col-md-4">
				<label>Bulan</label>
					<?php
						input_pdselect2("bln",$array_month,$bln);
					?>
			</div>
			<div class="col-md-4">
				<label>Tahun</label>
					<?php
						input_pdselect2("thn",$year_logbook,$thn);
					?>
			</div>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
             <div id="chartdiv"></div>
              
        </div>
        <div class="box-footer"><div id="legenddiv"></div>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="lb")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open('member/lb/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			<div class="col-md-4">
				<label>Range</label>
					<?php
						input_pdselect2("page",$array_page,$page);
					?>
			</div>
			<div class="col-md-4">
				<label>Bulan</label>
					<?php
						input_pdselect2("bln",$array_month,$bln);
					?>
			</div>
			<div class="col-md-4">
				<label>Tahun</label>
					<?php
						input_pdselect2("thn",$year_logbook,$thn);
					?>
			</div>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
             <div id="chartdiv"></div>
              
        </div>
        <div class="box-footer"><div id="legenddiv"></div>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="lh")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open('member/lh/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
			<div class="col-md-4">
				<label>Range</label>
					<?php
						input_pdselect2("page",$array_page,$page);
					?>
			</div>
			<div class="col-md-4">
				<label>Bulan</label>
					<?php
						input_pdselect2("bln",$array_month,$bln);
					?>
			</div>
			<div class="col-md-4">
				<label>Tahun</label>
					<?php
						input_pdselect2("thn",$year_logbook,$thn);
					?>
			</div>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
             <div id="chartdiv"></div>
              
        </div>
        <div class="box-footer"><div id="legenddiv"></div>
        </div>
      </div>
	  <?php echo form_close(); ?>
    </section>
</div>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="analisis")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('member/'.$page.'/view/'.$id.'/'.$id2.'/'.$id3.'/'.$id4,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id3",$all_kah,$id3);
                  ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kompetensi</label>
                  <?php
                    input_pdselect2fleksibel("id4","id4",$ambil_kompetensi_null,"id_kompetensi","nama_kompetensi",$id4,"Semua Kompetensi");
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      <div class="callout callout-success">
        <h4>LAPORAN INDIKATOR MUTU / QUALITY CONTROL PERSONAL</h4>
          Laporan ini dapat digunakan sebagai indikator mutu / QC personal yang outputnya berupa link dan di dalamnya berisi data yang dapat di print dan di download logbooknya. Link tersebut dapat di copy pastekan ke E-Kinerja BKN / Ujian Kompetensi lainnya. Klik Tabel / Grafik untuk menggenerate link nya.
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>            
            <th style="width:15%;text-align: center;vertical-align: middle;">Range</th>                                                        
            <th style="text-align: center;vertical-align: middle;">Judul</th>                                                        
            <th style="text-align: center;vertical-align: middle;">Tujuan</th>                            
            <th style="text-align: center;vertical-align: middle;">Instansi</th>                                       
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>                                       
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="analisis_share_unit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/analisis/simpan_share_unit');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;text-align: center;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_unit_instansi as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_unit'];?>" <?php if(in_array($row['id_unit'],explode(",", $share_it))) echo 'checked="checked"'; ?> > 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_unit'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="analisis_share_user")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/analisis/simpan_share_user');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;text-align: center;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_unit_instansi as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['barcode_pegawai'];?>" <?php if(in_array($row['barcode_pegawai'],explode(",", $share_peg))) echo 'checked="checked"'; ?> > 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_unit'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="analisis_share_instansi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/analisis/simpan_share_instansi');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;text-align: center;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_unit_instansi as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['barcode_working'];?>" <?php if(in_array($row['barcode_working'],explode(",", $share_ins))) echo 'checked="checked"'; ?> > 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_working'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="analisis_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/analisis/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
     <div class="box-body">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">TANGGAL LAPORAN DAN PERIODE PENGAMBILAN LAPORAN (SESUAI TANGGAL LOGBOOK)</h3>
        </div>
          <div class="box-body">
            <div class="row">         
              <div class="col-md-4">
                  <label>Tanggal Laporan</label>
                  <?php
                    input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Awal</label>
                  <?php
                    input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
                  ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-6">
                <label>Header Laporan</label>
                <?php
                  input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 1</label>
                <?php
                  input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 2</label>
                <?php
                  input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Tujuan</label>
                <?php
                  input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
                ?>
            </div>
            <div class="col-md-12">
                <label>Judul Laporan</label>
                <?php
                  input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-4">
                <label>Periode</label>
                <?php
                  input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-4">
                <label>Sumber Data</label>
                <?php
                  input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
                ?>
            </div>     
            <div class="col-md-4">
                <label>Unit</label>
                <?php
                  input_pdselect2("id_working",$ambil_punit_nonull,$id_working);
                ?>
            </div> 
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_laporan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_laporan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="analisis_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/analisis/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan" value="<?= $id; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
     <div class="box-body">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">TANGGAL LAPORAN DAN PERIODE PENGAMBILAN LAPORAN (SESUAI TANGGAL LOGBOOK)</h3>
        </div>
          <div class="box-body">
            <div class="row">         
              <div class="col-md-4">
                  <label>Tanggal Laporan</label>
                  <?php
                    input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Awal</label>
                  <?php
                    input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
                  ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-6">
                <label>Header Laporan</label>
                <?php
                  input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 1</label>
                <?php
                  input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 2</label>
                <?php
                  input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Tujuan</label>
                <?php
                  input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
                ?>
            </div>
            <div class="col-md-12">
                <label>Judul Laporan</label>
                <?php
                  input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-4">
                <label>Periode</label>
                <?php
                  input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-4">
                <label>Sumber Data</label>
                <?php
                  input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
                ?>
            </div>     
            <div class="col-md-4">
                <label>Unit</label>
                <?php
                  input_pdselect2("id_working",$ambil_punit_nonull,$id_working);
                ?>
            </div>    
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_laporan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_laporan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_seting_isi_kompetensi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/tabel/simpan_seting_isi_kompetensi');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 7%;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal Kompetensi</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Kompetensi</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jumlah Kompetensi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_isi_kompetensi as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_logbook'];?>" <?php if(in_array($row['id_logbook'],explode(",", $isi_kompetensi))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= date('d-m-Y', strtotime($row['tgl_logbook'])) ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_kewenangan'] ?> - [<?= $row['nama_kompetensi'] ?>]</td>
                    <td style="vertical-align:middle;"><?= $row['jml_logbook'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="tabel_seting_kompetensi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/tabel/simpan_seting_kompetensi');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Kompetensi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_kompetensi_range as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kompetensi'];?>" <?php if(in_array($row['id_kompetensi'],explode(",", $kompetensi))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_kompetensi'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="tabel_seting_i_mutu")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/tabel/simpan_seting_i_mutu');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - HANYA BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 7%;text-align: center;">Tanggal</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Mutu Detil</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;">Hasil</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pembuat</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_imutu_range as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_lhu_detil'];?>" <?php if(in_array($row['id_lhu_detil'],explode(",", $i_mutu))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align: center;"><?= date('d-m-Y',strtotime($row['tgl_lhu'])) ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_item_lhu'] ?> - <b>[<?= $row['nama_equipment'] ?>]</b></td>
                    <td style="vertical-align:middle;"><?= round($row['hasil_lhu_detil'],2) ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_pegawai'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="tabel_seting_berkas")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/tabel/simpan_seting_berkas');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - HANYA BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Tanggal</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Mutu Detil</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori Berkas</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori Pelatihan</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_imutu_range as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?php if(in_array($row['id_berkas'],explode(",", $berkas))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align: center;"><?php if(!empty($row['tgl_a_berkas'])){ echo date('d-m-Y',strtotime($row['tgl_a_berkas'])); } ?> <?php if(!empty($row['tgl_b_berkas'] && $row['lifetime_berkas'] == 0)){ echo date('d-m-Y',strtotime($row['tgl_b_berkas'])); } ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_berkas'] ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_berkas_kategori'] ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_kategori_pelatihan'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="tabel_seting_kewenangan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/tabel/simpan_seting_kewenangan');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
          <div class="row">         
          <div class="col-md-12">
            <label>Pilih Grafik Pie Kompetensi Berdasarkan Kewenangan / Kompetensi</label>
            <?php
              input_pdselect2("kewenangan",$cmd_komporke,$kewenangan);
            ?>  
          </div>                        
          </div>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
  });
</script>
<?php
}
elseif ($page=="tabel_seting_bahan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/tabel/simpan_seting_bahan');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Kompetensi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_kompetensi_range as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_bahan'];?>" <?php if(in_array($row['id_bahan'],explode(",", $bahan))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_bahan'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="tabel_seting_reject")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/tabel/simpan_seting_reject');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Kompetensi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_kompetensi_range as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_reject'];?>" <?php if(in_array($row['id_reject'],explode(",", $reject))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_reject'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="tabel_seting_item")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/tabel/simpan_seting_item');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - HANYA BERLAKU UNTUK SUMBER DATA LAINNYA DAN HARUS CEKLIS INDIKATOR MUTU / Quality Control</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama ITEM LHU</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_item_lhu as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_item_lhu'];?>" <?php if(in_array($row['id_item_lhu'],explode(",", $item_lhu))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_item_lhu'] ?> - <b>[<?= $row['nama_equipment'] ?>]</b></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-info">
        <h4><?php echo $judul_laporan; ?></h4>
        <h4>TABEL / GRAFIK INDIKATOR MUTU  / QUALITY CONTROL PERSONAL</h4>
          <h5>
            Tambahkan laporan bisa dipilih hanya tabel saja / grafik, silahkan isi datanya disesuaikan dengan menu di atas tabel<br>
            Untuk menggenerate linknya jika sudah selesai silahkan klik Buka Link Laporan, ada 2 halaman yang terdapat menu ini. Perbedaannya jika yang ini berikut semua tabel / laporan yang tersedia dalam leporan.
          </h5>
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="width:5%;vertical-align: middle;text-align: center;">Urutan</th>            
            <th style="vertical-align: middle;">Judul</th>            
            <th style="width:15%;vertical-align: middle;">Sumber Data</th>            
            <th style="width:30%;vertical-align: middle;">Tabel</th>                                                                                   
            <th style="width:15%;vertical-align: middle;">Instansi</th>                                                                                   
            <th style="width:15%;vertical-align: middle;">Sertakan</th>                                                                                   
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="tabel_tambah_tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tabel/simpan_tambah_tabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan" value="<?= $id; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MASUKKAN DATA TABEL / GRAFIK MINIMAL JUDUL</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Judul</label>
            <?php
              input_text("judul_laporan_tabel",$judul_laporan_tabel," maxlength='255' required ","","text");
            ?>  
          </div>                   
          <div class="col-md-12">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_tabel",$analisa_laporan_tabel," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Hasil / Rekomendasi</label>
            <?php
      input_textareacustom("rekomendasi_laporan_tabel",$rekomendasi_laporan_tabel," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>     
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="tabel_rubah_tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tabel/simpan_rubah_tabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH TABEL DAN GRAFIK</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Grafik</label>
            <?php
            //  input_pdselect2("tabel",$ambil_tabel,$tabel);
input_pdselect2fleksibel("tabel","tabel",$ambil_tabel,"id_tabel","nama_tabel",$tabel,"Tanpa Tabel dan Grafik");
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_seting_print")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tabel/simpan_seting_print');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">APAKAH DI LINK LAPORAN DI TAMPILKAN PRINT PDF??</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Grafik</label>
            <?php
              input_pdselect2("show_pdf",$cmd_ya_tidak,$show_pdf);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_rubah_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tabel/simpan_rubah_urutan');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">KETIK ANGKA</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Urutan</label>
            <?php
          input_textcustom("urutan_laporan_tabel",$urutan_laporan_tabel,"maxlength='3' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_rubah_lhu")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tabel/simpan_rubah_lhu');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH SUMBER DATA</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>Sumber Data</label>
            <?php
              input_pdselect2("lhu",$cmd_lhu_personal,$lhu);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_clone")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tabel/simpan_clone');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH JUDUL LAPORAN</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>JUDUL LAPORAN</label>
            <?php
              input_pdselect2("id_laporan",$cmd_judul_laporan,$id_laporan);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_disabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tabel/simpan_disabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">APAKAH TABEL INI AKAN DIMASUKKAN LAPORAN ??</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>YA / TIDAK</label>
            <?php
              input_pdselect2("status_urutan_tabel",$cmd_ya_tidak,$status_urutan_tabel);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_seting_range")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/tabel/simpan_seting_range');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_tabel" value="<?= $id; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">RANGE VALUE</h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-6">
            <label>Mininal Value (Kalau tidak ada isi 0)</label>
            <?php
          input_textcustom("min_laporan_tabel",$min_laporan_tabel,"maxlength='3' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>  
          <div class="col-md-6">
            <label>Maximal Value (Kalau tidak ada isi 0)</label>
            <?php
          input_textcustom("max_laporan_tabel",$max_laporan_tabel,"maxlength='3' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>                       
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="tabel_pasien")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
          <tr>
            <th>RM</th>
            <th>Nama Pasien</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
          </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="tabel_sesuaikan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#legenddiv {
  max-height: 150px;
  overflow: auto;
}
#chartdiv, #legendwrapper {
  width: 100%;
  height: 1000px;
}
#legenddiv {
  height: 150px;
}

#legendwrapper {
  max-height: 120px;
  overflow-x: none;
  overflow-y: auto;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?></h3>
          <div class="box-tools pull-right">
          <?php
            // input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
          ?>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-warning">
        <h4>PENYESUAIAN TABEL / GRAFIK INDIKATOR MUTU QUALITY CONTROL PERSONAL</h4>
          <h5>
            Link Laporan disini hanya halaman yang di tampilkan disini, dan pilih apakah pdf logbook ingin di tampilkan bisa klik menu di atas tabel
          </h5>
      </div>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="width:5%;vertical-align: middle;text-align: center;">Urutan</th>            
                <th style="vertical-align: middle;">Judul</th>            
                <th style="width:15%;vertical-align: middle;">Sumber Data</th>            
                <th style="width:30%;vertical-align: middle;">Tabel</th>                       
                <th style="vertical-align: middle;">Sertakan</th>                       
              </tr>
            </thead>
          </table>
        </div>
      </div>
<?php  
// =================================================================
if($tabel == 1 || $tabel == 14){
	// ============================= $tabel == 1 || $tabel == 14 ====================================
		if($tabel == 1){
	// ============================= $tabel == 1 ====================================
?>

			  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
				<div class="box-header with-border">
				   <h3 class="box-title"><?= $title ?></h3>
				  <div class="box-tools pull-right">
				  <?php
					// input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
				  ?>
				  </div>
				</div>
				<div class="box-body">
<?php 
    if($lhu == 2 || $lhu == 3){
?>
          <table id="example2" width="100%" class="table table-bordered table-striped">
            <thead>
              <tr>                   
                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Tanggal</th>
                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nama</th>
                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nilai</th>
              </tr>
            </thead>
              <tbody>
                <?php  
                $jmle =0;
                  foreach($ambil_lhu as $rowambil_lhu){
                    $jmle = $jmle + $rowambil_lhu['jml_logbook'];
                ?>
                <tr>
                  <?php 
                    if($lhu == 1){
/*                      if($rowambil_lhu['jml_logbook'] == 0 OR empty($rowambil_lhu['jml_logbook'])){
                        echo '<td colspan="3" style="vertical-align:middle;text-align: center;">TIDAK ADA DATA</td>';
                      }else{*/
                  ?>
                    <td style="vertical-align:middle;text-align: center;"><?= date('d-m-Y',strtotime($rowambil_lhu['tgl_logbook'])) ?></td>
                    <td><?= $rowambil_lhu['nama_kompetensi'] ?> [ <?= $rowambil_lhu['nama_kewenangan'] ?> ]</td>
                    <td style="vertical-align:middle;text-align: center;"><?= round($rowambil_lhu['jml_logbook'],3) ?></td>
                  <?php  
         //             }
                    }
                    if($lhu == 2){
/*                      if($rowambil_lhu['jml_bahan'] == 0 OR empty($rowambil_lhu['jml_bahan'])){
                        echo '<td colspan="3" style="vertical-align:middle;text-align: center;">TIDAK ADA DATA</td>';
                      }else{*/
                  ?>
                  <td style="vertical-align:middle;text-align: center;"><?= date('d-m-Y',strtotime($rowambil_lhu['tgl_logbook'])) ?></td>
                    <td><?= $rowambil_lhu['nama_bahan'] ?></td>
                    <td style="vertical-align:middle;text-align: center;"><?= round($rowambil_lhu['jml_bahan'],3) ?></td>
                  <?php  
                //      }
                    }
                    if($lhu == 3){
/*                      if($rowambil_lhu['jml_reject'] == 0 OR empty($rowambil_lhu['jml_reject'])){
                        echo '<td colspan="3" style="vertical-align:middle;text-align: center;">TIDAK ADA DATA</td>';
                      }else{*/
                  ?>
                    <td style="vertical-align:middle;text-align: center;"><?= date('d-m-Y',strtotime($rowambil_lhu['tgl_logbook'])) ?></td>
                    <td><?= $rowambil_lhu['nama_reject'] ?></td>
                    <td style="vertical-align:middle;text-align: center;"><?= round($rowambil_lhu['jml_reject'],3) ?></td>
                  <?php  
                //      }
                    }
                    if($lhu == 4){
/*                      if($rowambil_lhu['hasil_lhu_detil'] == 0 OR empty($rowambil_lhu['hasil_lhu_detil'])){
                        echo '<td colspan="3" style="vertical-align:middle;text-align: center;">TIDAK ADA DATA</td>';
                      }else{*/
                  ?>
                    <td style="vertical-align:middle;text-align: center;"><?= date('d-m-Y',strtotime($rowambil_lhu['tgl_lhu'])) ?></td>
                    <td><?= $rowambil_lhu['nama_lhu'] ?></td>
                    <td style="vertical-align:middle;text-align: center;"><?= round($rowambil_lhu['hasil_lhu_detil'],3) ?></td>
                  <?php  
            //          }
                    }
                    if($lhu == 5){
/*                      if($rowambil_lhu['hasil_lhu_detil'] == 0 OR empty($rowambil_lhu['hasil_lhu_detil'])){
                        echo '<td colspan="3" style="vertical-align:middle;text-align: center;">TIDAK ADA DATA</td>';
                      }else{*/
                  ?>
                    <td style="vertical-align:middle;text-align: center;"><?= date('d-m-Y',strtotime($rowambil_lhu['tgl_lhu'])) ?></td>
                    <td><?= $rowambil_lhu['nama_tindakan'] ?></td>
                    <td style="vertical-align:middle;text-align: center;"><?= $rowambil_lhu['nama_unit'] ?></td>
                  <?php  
            //          }
                    }
                    if($lhu == 6){
/*                      if($rowambil_lhu['hasil_lhu_detil'] == 0 OR empty($rowambil_lhu['hasil_lhu_detil'])){
                        echo '<td colspan="3" style="vertical-align:middle;text-align: center;">TIDAK ADA DATA</td>';
                      }else{*/
                  ?>
                    <td style="vertical-align:middle;text-align: center;"><?= date('d-m-Y',strtotime($rowambil_lhu['tgl_lhu'])) ?></td>
                    <td><?= $rowambil_lhu['nama_lhu'] ?></td>
                    <td style="vertical-align:middle;text-align: center;"><?= $rowambil_lhu['hasil_lhu_detil'] ?></td>
                  <?php  
            //          }
                    }
                  ?>
                </tr>
                <?php } ?>                 
              </tbody>
          </table>
<?php  
    }
    else{
    foreach($ambil_bulan as $rowambil_bulan){
      if($lhu == 4){
        $bln = date('m',strtotime($rowambil_bulan['tgl_lhu']));
        $thn = date('Y',strtotime($rowambil_bulan['tgl_lhu']));
        $ketbulan = date('Y-m',strtotime($rowambil_bulan['tgl_lhu']));
        $awal = $ketbulan.'-01';
        $tglakhir = date('t', strtotime($awal));
        $akhir  = $ketbulan.'-'.$tglakhir;
      }
      elseif($lhu == 5){
        $bln = date('m',strtotime($rowambil_bulan['tgl_daftar']));
        $thn = date('Y',strtotime($rowambil_bulan['tgl_daftar']));
        $ketbulan = date('Y-m',strtotime($rowambil_bulan['tgl_daftar']));
        $awal = $ketbulan.'-01';
        $tglakhir = date('t', strtotime($awal));
        $akhir  = $ketbulan.'-'.$tglakhir;
      }
      elseif($lhu == 6){
        $bln = date('m',strtotime($rowambil_bulan['tgl_lhu']));
        $thn = date('Y',strtotime($rowambil_bulan['tgl_lhu']));
        $ketbulan = date('Y-m',strtotime($rowambil_bulan['tgl_lhu']));
        $awal = $ketbulan.'-01';
        $tglakhir = date('t', strtotime($awal));
        $akhir  = $ketbulan.'-'.$tglakhir;
      }
      elseif($lhu == 7){
        $bln = date('m',strtotime($rowambil_bulan['tgl_lhu']));
        $thn = date('Y',strtotime($rowambil_bulan['tgl_lhu']));
        $ketbulan = date('Y-m',strtotime($rowambil_bulan['tgl_lhu']));
        $awal = $ketbulan.'-01';
        $tglakhir = date('t', strtotime($awal));
        $akhir  = $ketbulan.'-'.$tglakhir;
      }
      elseif($lhu == 8){
        $bln = date('m',strtotime($rowambil_bulan['tgl_even']));
        $thn = date('Y',strtotime($rowambil_bulan['tgl_even']));
        $ketbulan = date('Y-m',strtotime($rowambil_bulan['tgl_even']));
        $awal = $ketbulan.'-01';
        $tglakhir = date('t', strtotime($awal));
        $akhir  = $ketbulan.'-'.$tglakhir;
      }
      else{
        $bln = date('m',strtotime($rowambil_bulan['tgl_logbook']));
        $thn = date('Y',strtotime($rowambil_bulan['tgl_logbook']));
        $ketbulan = date('Y-m',strtotime($rowambil_bulan['tgl_logbook']));
        $awal = $ketbulan.'-01';
        $tglakhir = date('t', strtotime($awal));
        $akhir  = $ketbulan.'-'.$tglakhir;
      }  
?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">DATA TABEL PERIODE BULAN : <?= $this->m_rancak->getBulan($bln) ?> &nbsp;TAHUN : <?= $thn ?> </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body table-responsive no-padding">
          <?php  
          if($lhu == 6){
          ?>
          <table id="example2" width="100%" class="table table-bordered table-striped">
            <thead>
              <tr>                   
                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Tanggal</th>
                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nama</th>
                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nilai</th>
              </tr>
            </thead>
              <tbody>
                <?php  
                  $kondisi_lhue = array('status_tr'=>1,);
                  $lhue = $this->m_member->ambil_time_laporan($id,$slct_tr,$kondisi_lhue);                
                  foreach($lhue as $rowambil_lhu){
                ?>
                <tr>
                    <td style="vertical-align:middle;text-align: center;"><?= date('d-m-Y',strtotime($rowambil_lhu['tgl_lhu'])) ?></td>
                    <td><?= $rowambil_lhu['nama_lhu'] ?></td>
                    <td style="vertical-align:middle;text-align: center;"><?= $rowambil_lhu['hasil_lhu_detil'] ?></td>
                </tr>
                <?php } ?>                 
              </tbody>
          </table>
          <?php
          }
          if($lhu == 7){

          }
          else{
          ?>
          // 
              <table class="table table-responsive tableFixHead">
                <thead>
                <tr class="bg-dark">
                  <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
                  <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Nama</th>
                <?php
                  foreach (range(1, $tglakhir) as $number) {                  
                ?>
                  <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?php echo $number; ?></th>
                <?php
                  }
                ?>
                  <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">Jml</th>
                </tr>
                </thead>
                <tbody>   
                  <?php
                    $no = 0;
                  if($lhu == 1){
                    $print_logbook_bulanane = $this->m_member->print_logbook_laporan_bulanane($ketbulan,$id_laporan_tabel,$id_pegawai);
                  }
                  if($lhu == 4){
                    $print_logbook_bulanane = $this->m_member->print_laporan_universal_lhu($ketbulan,$id_laporan_tabel,$barcode_pegawai,$selectk);
                  }
                  if($lhu == 5){
                    $print_logbook_bulanane = $this->m_member->print_logbook_laporan_daftar_tindakan_bulanane($ketbulan,$id_laporan_tabel,$id_pegawai);
                  }
                    foreach($print_logbook_bulanane as $row){
                      $no++;
                  ?>
                <tr>
                  <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $no; ?></td>
                  <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?php echo $row['nama_kompetensi']; ?></td>
                  <?php   $hitung_dewek=0;
                  foreach (range(1, $tglakhir) as $numbers) {
                    $tglenya  = $ketbulan.'-'.$numbers;
                  if($lhu == 1){
                    $jml = $this->m_member->jumlah_record_logbook_laporan_kompetensi($id_pegawai,$tglenya,$row['id_kompetensi'],$id_instansi);
                  }
                    if($lhu == 4){
                      $jml = $this->m_member->jumlah_record_logbook_laporan_lhu($row['barcode_pegawai'],$tglenya,$row['id_kompetensi'],$id_instansi);
                    }
                  if($lhu == 5){
                    $jml = $this->m_member->jumlah_record_logbook_laporan_tindakan_daftar($id_laporan_tabel,$tglenya,$row['id_tindakan'],$id_instansi);
                  }
                    if($jml == 0){    
                  ?>
                  <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
                  <?php
                    }else{
                    if($lhu == 1){
                      $q = $this->m_member->total_record_logbook_laporan_kompetensi($id_pegawai,$tglenya,$row['id_kompetensi'],$id_instansi);
                    }
                    if($lhu == 4){
                      $q = $this->m_member->total_record_logbook_laporan_lhu($row['barcode_pegawai'],$tglenya,$row['id_kompetensi'],$id_instansi);
                    }
                    if($lhu == 5){
                      $q = $this->m_member->total_record_logbook_laporan_daftar_tindakan($id_laporan_tabel,$tglenya,$row['id_tindakan'],$id_instansi);
                    }
                      foreach($q as $row2){
                        $hitung_dewek = $hitung_dewek + $row2['jumlahe'];
                  ?>
                  <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color:grey;color: white;"><?php echo number_format($row2['jumlahe'],0); ?></td>
                  <?php
                      }
                    }
                  }
                  ?>
                  <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color:dimgrey;color: white;"><?php echo number_format($hitung_dewek,0); ?></td>
                </tr> 
                  <?php
                    }
                  ?>
                </tbody>
              </table> 
            <?php  
              }
            ?>
        </div>
      </div>
<?php
      }
    }
?>
				</div>
			  </div>
<?php
	// ============================= !$tabel == 1 ====================================
		}
		if($tabel == 14){
	// ============================= $tabel == 14 ====================================
  ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			   <h3 class="box-title"></h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			<div class="box-body">
			  <table id="example2" width="100%" class="table table-bordered table-striped">
				<thead>
				  <tr>                   
					<th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width:2%;">No</th>
					<th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nama</th>
					<th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Hasil</th>
				  </tr>
				</thead>
				  <tbody>  
				  <?php  
					if($lhu == 1){
					  $print_logbook_bulanane = $this->m_member->ambil_laporan_logbook_tabel14($id_laporan_tabel);
					}
					if($lhu == 2){
					  $print_logbook_bulanane = $this->m_member->ambil_data_bakhp_tabel14($id_laporan_tabel);
					}
					if($lhu == 3){
					  $print_logbook_bulanane = $this->m_member->ambil_data_reject_tabel14($id_laporan_tabel);
					}
					if($lhu == 4){
					  $print_logbook_bulanane = $this->m_member->ambil_laporan_lhu_tabel14($id_laporan_tabel);
					}
					if($lhu == 5){
					  $print_logbook_bulanane = $this->m_member->ambil_laporan_tindakan_daftar_tabel14($id_laporan_tabel);
					}
				  $no =0;
				  $jmle =0;
				  foreach($print_logbook_bulanane as $rowprint_logbook_bulanane){
					$jmle = $jmle + $rowprint_logbook_bulanane['jml_logbook'];
					$no++;
				  ?>
				<tr>
				  <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
				  <td><?= $rowprint_logbook_bulanane['nama_kompetensi'] ?></td>
				  <td style="vertical-align:middle;text-align: center;"><?= round($rowprint_logbook_bulanane['jml_logbook'],3) ?></td>
				</tr>
				<?php  
				  }
				?>
				</tbody>
			  </table> 
			</div>
		</div>
  <?php
		}
	// ============================= !$tabel == 14 ====================================
	
	// ============================= !$tabel == 1 || $tabel == 14 ====================================
}
elseif($tabel == 15){
	// ============================= $tabel == 15 ====================================
  ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			   <h3 class="box-title"></h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
						title="Collapse">
				  <i class="fa fa-minus"></i></button>
			  </div>
			</div>
			<div class="box-body">
			  <table id="example2" width="100%" class="table table-bordered table-striped">
				<thead>
				  <tr>                   
					<th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nama Berkas</th>
					<th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Keterangan</th>
				  </tr>
				</thead>
				  <tbody>  
				  <?php  
				  if($jml_berkas > 0){
					foreach($ambil_berkas as $rowambil_berkas){
				  ?>
				<tr>
				  <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS</td>
				</tr>
				<tr>
				  <td><?= $rowambil_berkas['nama_berkas'] ?></td>
				  <td style="vertical-align:middle;text-align: center;">
					<?php  
					  if(!empty($rowambil_berkas['no_berkas'])){
						echo 'No Berkas : '.$rowambil_berkas['no_berkas'];
					  }
					?>
					<br>
					Kategori : <?= $rowambil_berkas['nama_berkas_kategori'] ?>
				  </td>
				</tr>
				<tr>
				  <td colspan="2" style="vertical-align:middle;text-align: center;">
	<div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_berkas['link_berkas'] ?>" allowfullscreen></iframe>
	</div>
				  </td>
				</tr>
				<?php  
					}
				  }
				  if($jml_imut > 0){
					foreach($ambil_imut as $rowambil_imut){
				  ?>
				<tr>
				  <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS Quality Control / Indikator Mutu</td>
				</tr>
				<tr>
				  <td><?= $rowambil_imut['nama_berkas'] ?></td>
				  <td style="vertical-align:middle;text-align: center;">
					<?php  
					  if(!empty($rowambil_imut['no_berkas'])){
						echo 'No Berkas : '.$rowambil_imut['no_berkas'];
					  }
					?>
					<br>
					Kategori : <?= $rowambil_imut['nama_berkas_kategori'] ?>
				  </td>
				</tr>
				<tr>
				  <td colspan="2" style="vertical-align:middle;text-align: center;">
	<div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_imut['link_berkas'] ?>" allowfullscreen></iframe>
	</div>
				  </td>
				</tr>
				<?php  
					}
				  }
				  if($jml_ijasah > 0){
					foreach($ambil_ijasah as $rowambil_ijasah){
				  ?>
				<tr>
				  <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS IJASAH</td>
				</tr>
				<tr>
				  <td><?= $rowambil_ijasah['nama_berkas'] ?></td>
				  <td style="vertical-align:middle;text-align: center;">
					Kategori : <?= $rowambil_ijasah['nama_berkas_kategori'] ?><br>
					Jenjang Pendidikan : <?= $rowambil_ijasah['nama_pendidikan'] ?><br>
					No Ijasah : <?= $rowambil_ijasah['no_berkas'] ?><br>
					Tanggal Kelulusan : <?= $this->m_rancak->fullBulan($rowambil_ijasah['tgl_b_berkas']) ?><br>
				  </td>
				</tr>
				<tr>
				  <td colspan="2" style="vertical-align:middle;text-align: center;">
	<div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_ijasah['link_berkas'] ?>" allowfullscreen></iframe>
	</div>
				  </td>
				</tr>
				<?php  
					}
				  }
				  if($jml_pelatihan > 0){
					foreach($ambil_pelatihan as $rowambil_pelatihan){
				  ?>
				<tr>
				  <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS PELATIHAN</td>
				</tr>
				<tr>
				  <td><?= $rowambil_pelatihan['nama_berkas'] ?></td>
				  <td style="vertical-align:middle;text-align: center;">
	Kategori : <?= $rowambil_pelatihan['nama_berkas_kategori'] ?>
	Jenis Pelatihan : <?= $rowambil_pelatihan['nama_kategori_pelatihan'] ?><br>
	Penyelenggara : <?= $rowambil_pelatihan['penyelenggara'] ?><br>
	No Sertifikat : <?= $rowambil_pelatihan['no_sertifikat'] ?><br>
	Jumlah SKP : <?= number_format($rowambil_pelatihan['kredit'],2) ?><br>
	Tanggal Mulai : <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowambil_pelatihan['tgl_a_berkas']))) ?> s/d <?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowambil_pelatihan['tgl_b_berkas']))) ?>
				  </td>
				</tr>
				<tr>
				  <td colspan="2" style="vertical-align:middle;text-align: center;">
	<div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_pelatihan['link_berkas'] ?>" allowfullscreen></iframe>
	</div>
				  </td>
				</tr>
				<?php  
					}
				  }
				  if($jml_str > 0){
					foreach($ambil_str as $rowambil_str){
				  ?>
				<tr>
				  <td colspan="3" style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">BERKAS SURAT IJIN</td>
				</tr>
				<tr>
				  <td><?= $rowambil_str['nama_berkas'] ?></td>
				  <td style="vertical-align:middle;text-align: center;">
					Kategori : <?= $rowambil_str['nama_berkas_kategori'] ?><br>>
					No Surat Ijin : <?= $rowambil_str['no_berkas'] ?><br>>
					Berlaku Mulai : <?= $this->m_rancak->fullBulan($rowambil_str['tgl_a_berkas']) ?> s/d 
					<?php 
					  if($rowambil_str['lifetime_berkas'] == 1){
						echo "Seumur Hidup";
					  }else{
						$this->m_rancak->fullBulan($rowambil_str['tgl_b_berkas']);
					  }
					?>
				  </td>
				</tr>
				<tr>
				  <td colspan="2" style="vertical-align:middle;text-align: center;">
	<div class="embed-responsive embed-responsive-16by9">
	  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowambil_str['link_berkas'] ?>" allowfullscreen></iframe>
	</div>
				  </td>
				</tr>
				<?php  
					}
				  }
				?>
				</tbody>
			  </table> 
			</div>
		</div>
  <?php
	// ============================= !$tabel == 15 ====================================
}
else{
	// ============================= ELSE ====================================
?>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">GRAFIK</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
             <div id="chartdiv"></div>
              <div id="legenddiv"></div>
        </div>
      </div>
<?php
	// ============================= !ELSE ====================================
}
// =================================================================
    echo form_open_multipart('member/tabel/sesuaikan/'.$id,' id="signupform" '); ; 
    input_text("id_laporan",$id_laporan,"","","hidden");
    input_text("id_laporan_tabel",$id_laporan_tabel,"","","hidden");
  ?> 
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			   <h3 class="box-title">ANALISA DAN REKOMENDASI</h3>
			  <div class="box-tools pull-right">
			  <?php
				// input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			  ?>
			  </div>
			</div>
			<div class="box-body">
			  <div class="form-group">
				<label>Judul</label>
				<?php
				  input_text("judul_laporan_tabel",$judul_laporan_tabel," maxlength='255' required ","","text");
				?>  
			  </div>
			  <div class="form-group">
				<label>Analisa</label>
				<?php
				  input_textareacustom("analisa_laporan_tabel",$analisa_laporan_tabel," required id='editor1' rows='5' cols='50' class='form-control' ","");
				?>  
			  </div>  
			  <div class="form-group">
				<label>Hasil / Rekomendasi</label>
				<?php
		  input_textareacustom("rekomendasi_laporan_tabel",$rekomendasi_laporan_tabel," required id='editor2' rows='5' cols='50' class='form-control' ","");
				?>  
			  </div> 
			</div>
			<div class="box-footer">
				<?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
			</div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="clone_i_mutu")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('member/'.$page.'/view/'.$id.'/'.$id2,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      <div class="callout callout-success">
        <h4>INDIKATOR MUTU PERSONAL / QUALITY CONTROL</h4>
          Indikator mutu  / Quality Control ini dibuat diluar indikator Kompetensi, BAKHP dan Reject. Mengisinya sama dengan mengisi Logbook
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>            
            <th style="text-align: center;vertical-align: middle;">Judul</th>                                     
            <th style="text-align: center;vertical-align: middle;">Pemilik</th>                                     
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="clone_i_mutu_lihat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-3">
                  <label>Tanggal</label>
                    <?php
                      input_calendar("tgl_lhu","tgl_lhu",$tgl_lhu,"Masukkan Tanggal","");
                    ?>
              </div>
              <div class="col-md-9">
                  <label>Judul</label>
                  <?php
                    input_text("nama_lhu",$nama_lhu," maxlength='255' ","","text");
                  ?>
              </div> 
            </div>
            <div class="col-md-12">

            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama QC</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;">Hasil QC</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Keterangan</th>
              </tr>
              </thead>
              <tbody>

            <?php  
              foreach ($ambil_lhu_detil as $rowambil_lhu_detil){
            ?>
            <tr>
            <td style="vertical-align:middle;"><b>[<?= $rowambil_lhu_detil['nama_equipment'] ?>]</b>
              <?= $rowambil_lhu_detil['nama_item_lhu'] ?>
            </td>
            <td style="vertical-align:middle;text-align: center;"><?= number_format($rowambil_lhu_detil['hasil_lhu_detil'],0) ?></td>
            <td style="vertical-align:middle;"><?= $rowambil_lhu_detil['ket_lhu_detil'] ?></td>
          </tr>
              <?php  
                }
              ?>
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="clone_i_mutu_copy_user")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
    <?php echo form_open_multipart('member/clone_i_mutu/copy_user/'.$id,' id="signupform" ');
    input_text("id_lhu",$id_lhu,"","","hidden");
    input_text("barcode_pegawai",$barcode_pegawai,"","","hidden");
    input_text("share_lhu",$share_lhu,"","","hidden");
    ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-3">
                  <label>Tanggal</label>
                    <?php
                      input_calendar("tgl_lhu","tgl_lhu",$tgl_lhu,"Masukkan Tanggal","");
                    ?>
              </div>
              <div class="col-md-9">
                  <label>Judul</label>
                  <?php
                    input_text("nama_lhu",$nama_lhu," maxlength='255' ","","text");
                  ?>
              </div> 
            </div>
            <?php  
              foreach ($ambil_lhu_detil as $rowambil_lhu_detil){
                input_text("id_item_lhu[]",$rowambil_lhu_detil['id_item_lhu'],"  ","","hidden");
            ?>
              <div class="col-md-5">
                  <label>Nama</label><br>
                    <?= $rowambil_lhu_detil['nama_item_lhu'] ?> - <b>[<?= $rowambil_lhu_detil['nama_equipment'] ?>]</b>
              </div>
              <div class="col-md-2">
                  <label>Hasil</label>
                  <?php
            input_textcustom("hasil_lhu_detil[]",$rowambil_lhu_detil['hasil_lhu_detil'],"maxlength='6' required autofocus class='form-control' 
              onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                    ?>   
              </div>
              <div class="col-md-5">
                  <label>Keterangan</label>
                    <?php
                      input_text("ket_lhu_detil[]",$rowambil_lhu_detil['ket_lhu_detil']," maxlength='255' ","","text");
                    ?>
              </div>
              <?php  
                }
              ?>
          </div>
        </div>
        <div class="box-footer">
              <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="time_respon")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('member/'.$page.'/view/'.$id.'/'.$id2,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:15%;text-align: center;vertical-align: middle;">Tanggal</th>            
            <th style="text-align: center;vertical-align: middle;">Nama Time Respon</th>            
            <th style="width:15%;text-align: center;vertical-align: middle;">Time Respon</th>            
            <th style="text-align: center;vertical-align: middle;">Kewenangan</th>                                                                     
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="time_respon_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/time_respon/simpan_tambah');?>" onClick="return cek();">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-3">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_tr","tgl_tr",$tgl_tr,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-9">
                <label>Nama Time Respon</label>
                <?php
                  input_text("nama_time_respon",$nama_time_respon," maxlength='255' ","","text");
                ?>
            </div> 
            <div class="col-md-3">
                <label>Waktu Tunggu</label>
                <?php
                  input_text("waktu_tunggu",$waktu_tunggu," maxlength='255' ","","text");
                ?>
            </div> 
            <div class="col-md-9">
                <label>Pemeriksaan</label>
                  <?php
                    input_pdselect2("id_kewenangan",$cmd_kewenangan,$id_kewenangan);
                  ?>
            </div>
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_tr').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_tr").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
/*$('#waktu_tunggu').datepicker({
  format: 'dd-mm-yyyy HH:ii:ss',
  autoclose: true
})*/
$("#waktu_tunggu").inputmask("hh:mm:ss",{
  placeholder: "HH:MM:SS", 
  insertMode: false, 
  showMaskOnHover: false,
  alias: "datetime",
  hourFormat: 12
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="time_respon_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/time_respon/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_tr" value="<?= $id_tr; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-3">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_tr","tgl_tr",$tgl_tr,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-9">
                <label>Nama Time Respon</label>
                <?php
                  input_text("nama_time_respon",$nama_time_respon," maxlength='255' ","","text");
                ?>
            </div> 
            <div class="col-md-3">
                <label>Waktu Tunggu</label>
                <?php
                  input_text("waktu_tunggu",$waktu_tunggu," maxlength='255' ","","text");
                ?>
            </div> 
            <div class="col-md-9">
                <label>Pemeriksaan</label>
                  <?php
                    input_pdselect2("id_kewenangan",$cmd_kewenangan,$id_kewenangan);
                  ?>
            </div>
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_tr').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_tr").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
/*$('#waktu_tunggu').datepicker({
  format: 'dd-mm-yyyy HH:ii:ss',
  autoclose: true
})*/
$("#waktu_tunggu").inputmask("hh:mm:ss",{
  placeholder: "HH:MM:SS", 
  insertMode: false, 
  showMaskOnHover: false,
  alias: "datetime",
  hourFormat: 12
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="time_respon_copy_qc")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/time_respon/simpan_copy_qc');?>" onClick="return cek();">
            <input type="hidden" name="id_tr" value="<?= $id_tr; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-3">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_tr","tgl_tr",$tgl_tr,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-9">
                <label>Nama Time Respon</label>
                <?php
                  input_text("nama_time_respon",$nama_time_respon," maxlength='255' ","","text");
                ?>
            </div> 
            <div class="col-md-3">
                <label>Waktu Tunggu</label>
                <?php
                  input_text("waktu_tunggu",$waktu_tunggu," maxlength='255' ","","text");
                ?>
            </div> 
            <div class="col-md-9">
                <label>Pemeriksaan</label>
                  <?php
                    input_pdselect2("id_kewenangan",$cmd_kewenangan,$id_kewenangan);
                  ?>
            </div>
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_tr').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_tr").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
/*$('#waktu_tunggu').datepicker({
  format: 'dd-mm-yyyy HH:ii:ss',
  autoclose: true
})*/
$("#waktu_tunggu").inputmask("hh:mm:ss",{
  placeholder: "HH:MM:SS", 
  insertMode: false, 
  showMaskOnHover: false,
  alias: "datetime",
  hourFormat: 12
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="i_mutu")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('member/'.$page.'/view/'.$id.'/'.$id2,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      <div class="callout callout-success">
        <h4>INDIKATOR MUTU PERSONAL / QUALITY CONTROL</h4>
          Indikator mutu  / Quality Control ini dibuat diluar indikator Kompetensi, BAKHP dan Reject. Mengisinya sama dengan mengisi Logbook
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>            
            <th style="text-align: center;vertical-align: middle;">Judul</th>                                                                        
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="i_mutu_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/i_mutu/simpan_tambah');?>" onClick="return cek();">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-3">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_lhu","tgl_lhu",$tgl_lhu,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-9">
                <label>Judul</label>
                <?php
                  input_text("nama_lhu",$nama_lhu," maxlength='255' ","","text");
                ?>
            </div> 
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_lhu').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lhu").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="i_mutu_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/i_mutu/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_lhu" value="<?= $id_lhu; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-3">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_lhu","tgl_lhu",$tgl_lhu,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-9">
                <label>Judul</label>
                <?php
                  input_text("nama_lhu",$nama_lhu," maxlength='255' ","","text");
                ?>
            </div>
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_lhu').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lhu").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="mutu_detil")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="width:5%;display: none;">&nbsp;</th>            
            <th style="text-align: center;vertical-align: middle;">Nama Detil</th>            
            <th style="text-align: center;vertical-align: middle;">Hasil</th>                                     
            <th style="text-align: center;vertical-align: middle;">Keterangan</th>                                     
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>                                     
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="mutu_detil_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/mutu_detil/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_lhu" value="<?= $id; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-9">
                <label>Nama</label>
                  <?php
                    input_pdselect2("id_item_lhu",$cmd_item_lhu,$id_item_lhu);
                  ?>
            </div>
            <div class="col-md-3">
                <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_lhu_detil",$hasil_lhu_detil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-12">
                <label>Keterangan</label>
                  <?php
                    input_text("ket_lhu_detil",$ket_lhu_detil," maxlength='255' ","","text");
                  ?>
            </div>
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="mutu_detil_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/mutu_detil/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_lhu" value="<?= $id_lhu; ?>">
            <input type="hidden" name="id_lhu_detil" value="<?= $id_lhu_detil; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-9">
                <label>Nama</label>
                  <?php
                    input_pdselect2("id_item_lhu",$cmd_item_lhu,$id_item_lhu);
                  ?>
            </div>
            <div class="col-md-3">
                <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_lhu_detil",$hasil_lhu_detil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-12">
                <label>Keterangan</label>
                  <?php
                    input_text("ket_lhu_detil",$ket_lhu_detil," maxlength='255' ","","text");
                  ?>
            </div>
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="item_mutu")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="width:5%;display: none;">&nbsp;</th>            
            <th style="text-align: center;vertical-align: middle;">Nama Item</th>            
            <th style="text-align: center;vertical-align: middle;">Kategori</th>                                     
            <th style="text-align: center;vertical-align: middle;">Status</th>                                     
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="item_mutu_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/item_mutu/simpan_tambah');?>" onClick="return cek();">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">    
            <div class="col-md-4">
                <label>Kategori</label>
                <?php
                  input_pdselect2("id_equipment",$cmd_equipment,$id_equipment);
                ?>   
            </div>     
            <div class="col-md-4">
                <label>Nama Indikator Mutu / Quality Control</label>
                  <?php
                    input_text("nama_item_lhu",$nama_item_lhu," maxlength='255' ","","text");
                  ?>
            </div>
            <div class="col-md-4">
                <label>Status</label>
                <?php
                  input_pdselect2("status_item_lhu",$cmd_status,$status_item_lhu);
                ?>   
            </div>
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="item_mutu_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/item_mutu/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_item_lhu" value="<?= $id_item_lhu; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">      
            <div class="col-md-4">
                <label>Kategori</label>
                <?php
                  input_pdselect2("id_equipment",$cmd_equipment,$id_equipment);
                ?>   
            </div>                
            <div class="col-md-4">
                <label>Nama Indikator Mutu / Quality Control</label>
                  <?php
                    input_text("nama_item_lhu",$nama_item_lhu," maxlength='255' ","","text");
                  ?>
            </div>
            <div class="col-md-4">
                <label>Status</label>
                <?php
                  input_pdselect2("status_item_lhu",$cmd_status,$status_item_lhu);
                ?>   
            </div>
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="i_mutu_share_unit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/i_mutu/simpan_share_unit');?>" onClick="return cek();">
            <input type="hidden" name="id_lhu" value="<?= $id_lhu; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
            <input type="hidden" name="share_lhu" value="<?= $share_lhu; ?>">
            <input type="hidden" name="share_ins_lhu" value="<?= $share_ins_lhu; ?>">
            <input type="hidden" name="share_peg_lhu" value="<?= $share_peg_lhu; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;text-align: center;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_unit_instansi as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_unit'];?>" <?php if(in_array($row['id_unit'],explode(",", $share_lhu))) echo 'checked="checked"'; ?> > 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_unit'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="i_mutu_share_user")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/i_mutu/simpan_share_user');?>" onClick="return cek();">
            <input type="hidden" name="id_lhu" value="<?= $id_lhu; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
            <input type="hidden" name="share_lhu" value="<?= $share_lhu; ?>">
            <input type="hidden" name="share_ins_lhu" value="<?= $share_ins_lhu; ?>">
            <input type="hidden" name="share_peg_lhu" value="<?= $share_peg_lhu; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;text-align: center;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_unit_instansi as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['barcode_pegawai'];?>" <?php if(in_array($row['barcode_pegawai'],explode(",", $share_peg_lhu))) echo 'checked="checked"'; ?> > 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_unit'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="i_mutu_share_instansi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/i_mutu/simpan_share_instansi');?>" onClick="return cek();">
            <input type="hidden" name="id_lhu" value="<?= $id_lhu; ?>">
            <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
            <input type="hidden" name="share_lhu" value="<?= $share_lhu; ?>">
            <input type="hidden" name="share_ins_lhu" value="<?= $share_ins_lhu; ?>">
            <input type="hidden" name="share_peg_lhu" value="<?= $share_peg_lhu; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN - TIDAK BERLAKU UNTUK SUMBER DATA LAINNYA</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 10%;text-align: center;">No</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=0;
   /*                 $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_unit_instansi as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['barcode_working'];?>" <?php if(in_array($row['barcode_working'],explode(",", $share_ins_lhu))) echo 'checked="checked"'; ?> > 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
                    <td style="vertical-align:middle;"><?= $row['nama_working'] ?></td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="i_mutu_seting_share_lhu")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/i_mutu/simpan_seting_share_lhu');?>" onClick="return cek();">
            <input type="hidden" name="id_lhu" value="<?= $id_lhu; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
      </div>
        <div class="box-body">
          <div class="row">         
          <div class="col-md-12">
            <label>APAKAH AKAN DI SHARE KE RUANGAN</label>
            <?php
              input_pdselect2("share_lhu",$cmd_ya_tidak,$share_lhu);
            ?>  
          </div>                        
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="i_mutu_copy_qc")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
    <?php echo form_open_multipart('member/i_mutu/copy_qc/'.$id,' id="signupform" ');
    input_text("id_lhu",$id_lhu,"","","hidden");
    input_text("barcode_pegawai",$barcode_pegawai,"","","hidden");
    input_text("share_lhu",$share_lhu,"","","hidden");
    ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="col-md-3">
                  <label>Tanggal</label>
                    <?php
                      input_calendar("tgl_lhu","tgl_lhu",$tgl_lhu,"Masukkan Tanggal","");
                    ?>
              </div>
              <div class="col-md-9">
                  <label>Judul</label>
                  <?php
                    input_text("nama_lhu",$nama_lhu," maxlength='255' ","","text");
                  ?>
              </div> 
            </div>
            <?php  
              foreach ($ambil_lhu_detil as $rowambil_lhu_detil){
                input_text("id_item_lhu[]",$rowambil_lhu_detil['id_item_lhu'],"  ","","hidden");
            ?>
              <div class="col-md-5">
                  <label>Nama</label><br>
                    <?= $rowambil_lhu_detil['nama_item_lhu'] ?> - <b>[<?= $rowambil_lhu_detil['nama_equipment'] ?>]</b>
              </div>
              <div class="col-md-2">
                  <label>Hasil</label>
                  <?php
            input_textcustom("hasil_lhu_detil[]",$rowambil_lhu_detil['hasil_lhu_detil'],"maxlength='6' required autofocus class='form-control' 
              onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                    ?>   
              </div>
              <div class="col-md-5">
                  <label>Keterangan</label>
                    <?php
                      input_text("ket_lhu_detil[]",$rowambil_lhu_detil['ket_lhu_detil']," maxlength='255' ","","text");
                    ?>
              </div>
              <?php  
                }
              ?>
          </div>
        </div>
        <div class="box-footer">
              <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="working")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
   //     input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Status</th>
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="working_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/working/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pegawai_instansi",$cmd_status,$status_pegawai_instansi);
                  ?>
              </div>
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="working_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/working/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai_instansi" value="<?= $id; ?>">
            <input type="hidden" name="id_instansi_lama" value="<?= $id_instansi; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pegawai_instansi",$cmd_status,$status_pegawai_instansi);
                  ?>
              </div>
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="peminatan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <?php
      //        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
            ?>
          </div>
        </div>
        <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th style="display:none;"></th>
              <th>Nama</th>
              <th>Peminatan</th>
              <th>Status Peminatan</th>
            </tr>
          </thead>
        </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="peminatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/peminatan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_pdselect2("id_peminatan",$ambil_peminatan,$id_peminatan);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_minat",$cmd_status,$status_minat);
                  ?>
              </div>
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="peminatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/peminatan/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_minat" value="<?= $id; ?>">
            <input type="hidden" name="id_peminatan_lama" value="<?= $id_peminatan; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_pdselect2("id_peminatan",$ambil_peminatan,$id_peminatan);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_minat",$cmd_status,$status_minat);
                  ?>
              </div>
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="pengcab")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <?php
      //        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
            ?>
          </div>
        </div>
        <div class="box-body">
        <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
            <tr>
              <th style="display:none;"></th>
              <th>Wilayah</th>
            </tr>
          </thead>
        </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="pengcab_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/pengcab/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai" value="<?= $id; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Wilayah</label>
                <?php
                input_pdselect2fleksibel("id_pengcab","id_pengcab",$ambil_data_pengcab,"id_pengcab","nama_pengcab",$id_pengcab,"Tidak Ada Wilayah");                
                ?>
            </div>   
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="lt")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open('member/lt/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div class="col-md-4">
        <label>Range</label>
          <?php
            input_pdselect2("page",$array_page,$page);
          ?>
      </div>
      <div class="col-md-4">
        <label>Bulan</label>
          <?php
            input_pdselect2("bln",$array_month,$bln);
          ?>
      </div>
      <div class="col-md-4">
        <label>Tahun</label>
          <?php
            input_pdselect2("thn",$year_logbook,$thn);
          ?>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div id="chartdiv"></div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="lb")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open('member/lb/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div class="col-md-4">
        <label>Range</label>
          <?php
            input_pdselect2("page",$array_page,$page);
          ?>
      </div>
      <div class="col-md-4">
        <label>Bulan</label>
          <?php
            input_pdselect2("bln",$array_month,$bln);
          ?>
      </div>
      <div class="col-md-4">
        <label>Tahun</label>
          <?php
            input_pdselect2("thn",$year_logbook,$thn);
          ?>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div id="chartdiv"></div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="lh")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open('member/lh/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div class="col-md-4">
        <label>Range</label>
          <?php
            input_pdselect2("page",$array_page,$page);
          ?>
      </div>
      <div class="col-md-4">
        <label>Bulan</label>
          <?php
            input_pdselect2("bln",$array_month,$bln);
          ?>
      </div>
      <div class="col-md-4">
        <label>Tahun</label>
          <?php
            input_pdselect2("thn",$year_logbook,$thn);
          ?>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div id="chartdiv"></div>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="even")
{
?>
<style>
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="col-md-9">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title"><?php echo $title; ?></h3>

            <div class="box-tools pull-right">
        <?php
          input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
        ?>
            </div>
          </div>
          <div class="box-body">
            <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th style="display:none;">&nbsp;</th>
                  <th>Waktu</th>
                  <th>Nama Even</th>
                  <th>Alamat</th>
                  <th>Radius</th>
                  <th>Status</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">EVEN / KEGIATAN</h3>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="box-body">
          <div class="box box-solid">
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Even
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse">
                    <div class="box-body">
                      <ul class="list-unstyled">
                        <li><strong>Even / Kegiatan :</strong>
                          <ul>
                            <li>Fitur even / kegiatan ini adalah untuk melengkapi even / kegiatan dengan absensi berdasarkan lokasi dan dapat dibuatkan laporannya untuk akreditasi</li>
                            <li>Anggota Even Bisa Dari User Program</li>
                            <li>Untuk User Program Bisa Input Di Program</li>
                            <li>Untuk User Diluar Program Daftarkan Manual</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#fitur">
                        Fungsi Fitur
                      </a>
                    </h4>
                  </div>
                  <div id="fitur" class="panel-collapse collapse">
                    <div class="box-body">
                      <ul class="list-unstyled">
                        <li><strong>Kegunaan fitur ini :</strong>
                          <ul>
                            <li>Rapat rutin bulanan</li>
                            <li>Absensi berdasarkan lokasi untuk semua seminar/workshop dll di lms</li>
                            <li>dll</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#radius">
                        Radius
                      </a>
                    </h4>
                  </div>
                  <div id="radius" class="panel-collapse collapse">
                    <div class="box-body">
                      <ul class="list-unstyled">
                        <li><strong>Penjelasan Radius :</strong>
                          <ul>
                            <li>Ya, absensi sesuai radius lokasi</li>
                            <li>0, bisa absensi dimana saja</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#status">
                        Status
                      </a>
                    </h4>
                  </div>
                  <div id="status" class="panel-collapse collapse">
                    <div class="box-body">
                      <ul class="list-unstyled">
                        <li><strong>Penjelasan Status :</strong>
                          <ul>
                            <li>Proses, Tidak Bisa Melakukan Registrasi User</li>
                            <li>Pendaftaran, Sudah Bisa Melakukan Registrasi User</li>
                            <li>Mulai Acara, Tidak Bisa Melakukan Registrasi User dan Bisa Melakukan Absensi</li>
                            <li>Selesai, Tidak Bisa Merubah Data</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="acara")
{
?>
<style>
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">DATA EVEN / ACARA</h3>
          </div>
          <div class="box-body">
        <div class="col-md-12">
            <h4>Nama Even : <?= $nama_even ?></h4> 
            <h4>Waktu Even : <?= $tgl_even ?> <?= $time_even ?></h4>  
        </div>     
          </div>
        </div>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title"><?php echo $title; ?></h3>

            <div class="box-tools pull-right">
        <?php
          input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
        ?>
            </div>
          </div>
          <div class="box-body">
            <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
              <thead>
                <tr>
                  <th>&nbsp;</th>
                  <th style="display:none;">&nbsp;</th>
                  <th>Waktu</th>
                  <th>Nama Even</th>
                  <th>Pembicara</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="acara_absen")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/acara/simpan_absen');?>" onClick="return cek();">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">ABSENSI BERDASARKAN LOKASI, TIDAK KOMPATIBEL DENGAN GOOGLE CHROME MOBILE</h3>
      </div>
        <div class="box-body">
        <div class="box-footer">
<input type="hidden" name="id_even_detil" value="<?= $id_even_detil ?>" class="form-control text-center" readonly>
<input type="hidden" name="id_even" value="<?= $id_even ?>" class="form-control text-center" readonly>
<input type="hidden" name="location_even" value="<?= $location_even ?>" class="form-control text-center" readonly>
<input type="hidden" name="include_radius" value="<?= $include_radius ?>" class="form-control text-center" readonly>
<input type="hidden" name="location" id="location" class="form-control text-center" readonly>
<input type="hidden" name="location_even" value="<?= $location_even ?>" class="form-control text-center" readonly>
<input type="hidden" name="status_even" value="<?= $status_even ?>" class="form-control text-center" readonly>
<input type="hidden" name="seen_even" value="<?= $seen_even ?>" class="form-control text-center" readonly>
        </div>
          <div class="row">         
            <div class="col-md-12">
                <div id="map" style="width:100%; height:300px;"></div>                 
          </div>
        </div>
        <div class="box-footer">
          <?= $tombole ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }

  function showPosition(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    var latlong   = latitude + ', ' + longitude;
    $('#location').val(latlong);

    const map = L.map('map').setView([latitude, longitude], <?= $zoom ?>);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: ''
    }).addTo(map);

    var Mylocation = L.icon({
      iconUrl: '<?= base_url('assets/img/icon/mark-office.png'); ?>',

      iconSize:     [38, 38], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([latitude, longitude], {icon: Mylocation}).addTo(map)
      .bindPopup('My Location')
      .openPopup();

    var officeIcon = L.icon({
      iconUrl: '<?= base_url('assets/img/icon/office-center.png'); ?>',

      iconSize:     [38, 95], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([<?= $location_even ?>], {icon: officeIcon}).addTo(map)
      .bindPopup('Lokasi Even');

    L.circle([<?= $location_even ?>], {
      color: 'blue',
      fillColor: 'blue',
      fillOpacity: 0.5,
      radius: <?= $include_radius ?>
    }).addTo(map);
  }
</script>
<?php
}
//================================================ IM / QC
elseif ($page=="indikator")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $header; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="callout callout-success">
          Ini adalah laporan personal, bukan indikator mutu untuk ruangan / unit, digunakan untuk pelaporan saja dan jika diperlukan saja
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
       input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Nama</th>          
            <th>Ruangan</th>                 
            <th>Status</th>            
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="indikator_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/indikator/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_per_imqc",$nama_per_imqc,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
        <div class="col-md-12">
            <label>Status</label>
            <?php
              input_pdselect2("status_per_imqc",$cmd_status,$status_per_imqc);
            ?>   
        </div>          
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="indikator_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/indikator/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_per_imqc" value="<?= $id_per_imqc; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_per_imqc",$nama_per_imqc,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
        <div class="col-md-12">
            <label>Status</label>
            <?php
              input_pdselect2("status_per_imqc",$cmd_status,$status_per_imqc);
            ?>    
        </div>         
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="mutu")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $header; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="callout callout-success">
          Setelah Indikator dibuat maka inputlah mutu yang menjadi numerator dan denumeratornya
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
       input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Indikator</th>          
            <th>Mutu</th>            
            <th>Ruangan</th>            
            <th>Status</th>            
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="mutu_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/mutu/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MUTU</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <label>Indikator</label>
              <?php
                input_pdselect2("id_per_imqc",$ambil_per_imqc,$id_per_imqc);
              ?>   
            </div>
            <div class="col-md-12">
              <label>Mutu</label>
              <?php
                input_text("nama_per_imqc_detil",$nama_per_imqc_detil," required ","Masukkan Nama","text");
              ?>  
            </div>    
            <div class="col-md-12">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_detil",$cmd_status,$status_per_imqc_detil);
              ?>   
            </div>          
          </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="mutu_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/mutu/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_per_imqc_detil" value="<?= $id_per_imqc_detil; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MUTU</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <label>Indikator</label>
              <?php
                input_pdselect2("id_per_imqc",$ambil_per_imqc,$id_per_imqc);
              ?>   
            </div>
            <div class="col-md-12">
              <label>Mutu</label>
              <?php
                input_text("nama_per_imqc_detil",$nama_per_imqc_detil," required ","Masukkan Nama","text");
              ?>  
            </div>    
            <div class="col-md-12">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_detil",$cmd_status,$status_per_imqc_detil);
              ?>   
            </div>          
          </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="i_mutup")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('member/'.$page.'/view/'.$id.'/'.$id2.'/'.$id3.'/'.$id4,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
            <div class="col-md-8">
              <div class="form-group">
              <label>Indikator</label>
              <?php
input_pdselect2fleksibel("id3","id3",$opsi,"id_per_imqc","nama_per_imqc",$id3,"SEMUA");
             //   input_pdselect2("id3",$opsi,$id3);
              ?>   
            </div>
            </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id4",$all_kah,$id4);
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      <div class="callout callout-success">
          Data disini bersifat fleksibel, data tabel dan grafik tidak otomatis misal dalam persen maka input data hasil persentasenya langsung<br>
          Isi hasil mutu dan hasil bisa berupa nilai atau YA / TIDAK<br>
          Untuk yang menggunakan YA / TIDAK, pilih combo box Hasil YA/TIDAK kemudian nilai 1 untuk YA, dan 0 untuk TIDAK<br>
          Apabila hasilnya tidak ingin di tampilkan dalam tabel maupun grafik maka buat status menjadi NON AKTIF
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>            
            <th style="width:40%;text-align: center;vertical-align: middle;"><?php echo $title; ?></th>                                            
            <th style="text-align: center;vertical-align: middle;">Hasil</th>                                                                         
            <th style="text-align: center;vertical-align: middle;">Katerangan</th>
            <th style="text-align: center;vertical-align: middle;">Status</th>
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="i_mutup_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/i_mutup/simpan_tambah');?>" onClick="return cek();">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_per_imqc_hasil","tgl_per_imqc_hasil",$tgl_per_imqc_hasil,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_per_imqc_hasil",$cmd_ya_tidak,$yn_per_imqc_hasil);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_hasil",$cmd_status,$status_per_imqc_hasil);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_per_imqc_detil",$per_imqc,$id_per_imqc_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_per_imqc_hasil",$hasil_per_imqc_hasil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_per_imqc_hasil",$ket_per_imqc_hasil," maxlength='255' ","","text");
                ?>
            </div> 
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_per_imqc_hasil').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_per_imqc_hasil").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="i_mutup_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/i_mutup/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_per_imqc_hasil" value="<?= $id_per_imqc_hasil; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_per_imqc_hasil","tgl_per_imqc_hasil",$tgl_per_imqc_hasil,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_per_imqc_hasil",$cmd_ya_tidak,$yn_per_imqc_hasil);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_hasil",$cmd_status,$status_per_imqc_hasil);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_per_imqc_detil",$per_imqc,$id_per_imqc_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_per_imqc_hasil",$hasil_per_imqc_hasil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_per_imqc_hasil",$ket_per_imqc_hasil," maxlength='255' ","","text");
                ?>
            </div> 
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_per_imqc_hasil').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_per_imqc_hasil").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="i_mutup_clone")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/i_mutup/simpan_clone');?>" onClick="return cek();">
            <input type="hidden" name="id_per_imqc_hasil" value="<?= $id_per_imqc_hasil; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_per_imqc_hasil","tgl_per_imqc_hasil",$tgl_per_imqc_hasil,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_per_imqc_hasil",$cmd_ya_tidak,$yn_per_imqc_hasil);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_hasil",$cmd_status,$status_per_imqc_hasil);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_per_imqc_detil",$per_imqc,$id_per_imqc_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_per_imqc_hasil",$hasil_per_imqc_hasil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_per_imqc_hasil",$ket_per_imqc_hasil," maxlength='255' ","","text");
                ?>
            </div> 
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_per_imqc_hasil').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_per_imqc_hasil").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
//================================================ IM / QC
//================================================ QC
elseif ($page=="quality")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $header; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="callout callout-success">
          Ini adalah laporan personal, bukan indikator mutu untuk ruangan / unit, digunakan untuk pelaporan saja dan jika diperlukan saja
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
       input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Nama</th>          
            <th>Ruangan</th>            
            <th>Status</th>            
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="quality_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/quality/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_per_imqc",$nama_per_imqc,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
        <div class="col-md-12">
            <label>Status</label>
            <?php
              input_pdselect2("status_per_imqc",$cmd_status,$status_per_imqc);
            ?>   
        </div>          
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="quality_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/quality/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_per_imqc" value="<?= $id_per_imqc; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_per_imqc",$nama_per_imqc,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
        <div class="col-md-12">
            <label>Status</label>
            <?php
              input_pdselect2("status_per_imqc",$cmd_status,$status_per_imqc);
            ?>    
        </div>         
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="control")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $header; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="callout callout-success">
          Setelah Indikator dibuat maka inputlah mutu yang menjadi numerator dan denumeratornya
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
       input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Indikator</th>          
            <th>Mutu</th>            
            <th>Ruangan</th>            
            <th>Status</th>            
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="control_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/control/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MUTU</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <label>Indikator</label>
              <?php
                input_pdselect2("id_per_imqc",$ambil_per_imqc,$id_per_imqc);
              ?>   
            </div>
            <div class="col-md-12">
              <label>Mutu</label>
              <?php
                input_text("nama_per_imqc_detil",$nama_per_imqc_detil," required ","Masukkan Nama","text");
              ?>  
            </div>    
            <div class="col-md-12">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_detil",$cmd_status,$status_per_imqc_detil);
              ?>   
            </div>          
          </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="control_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/control/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_per_imqc_detil" value="<?= $id_per_imqc_detil; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MUTU</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <label>Indikator</label>
              <?php
                input_pdselect2("id_per_imqc",$ambil_per_imqc,$id_per_imqc);
              ?>   
            </div>
            <div class="col-md-12">
              <label>Mutu</label>
              <?php
                input_text("nama_per_imqc_detil",$nama_per_imqc_detil," required ","Masukkan Nama","text");
              ?>  
            </div>    
            <div class="col-md-12">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_detil",$cmd_status,$status_per_imqc_detil);
              ?>   
            </div>          
          </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="q_control")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('member/'.$page.'/view/'.$id.'/'.$id2.'/'.$id3.'/'.$id4,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
            <div class="col-md-8">
              <div class="form-group">
              <label>Indikator</label>
              <?php
input_pdselect2fleksibel("id3","id3",$opsi,"id_per_imqc","nama_per_imqc",$id3,"SEMUA");
             //   input_pdselect2("id3",$opsi,$id3);
              ?>   
            </div>
            </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id4",$all_kah,$id4);
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      <div class="callout callout-success">
          Data disini bersifat fleksibel, data tabel dan grafik tidak otomatis misal dalam persen maka input data hasil persentasenya langsung<br>
          Isi hasil mutu dan hasil bisa berupa nilai atau YA / TIDAK<br>
          Untuk yang menggunakan YA / TIDAK, pilih combo box Hasil YA/TIDAK kemudian nilai 1 untuk YA, dan 0 untuk TIDAK<br>
          Apabila hasilnya tidak ingin di tampilkan dalam tabel maupun grafik maka buat status menjadi NON AKTIF
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>            
            <th style="width:40%;text-align: center;vertical-align: middle;"><?php echo $title; ?></th>                                            
            <th style="text-align: center;vertical-align: middle;">Hasil</th>                                                                         
            <th style="text-align: center;vertical-align: middle;">Katerangan</th>
            <th style="text-align: center;vertical-align: middle;">Status</th>
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="q_control_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/q_control/simpan_tambah');?>" onClick="return cek();">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_per_imqc_hasil","tgl_per_imqc_hasil",$tgl_per_imqc_hasil,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_per_imqc_hasil",$cmd_ya_tidak,$yn_per_imqc_hasil);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_hasil",$cmd_status,$status_per_imqc_hasil);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_per_imqc_detil",$per_imqc,$id_per_imqc_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_per_imqc_hasil",$hasil_per_imqc_hasil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_per_imqc_hasil",$ket_per_imqc_hasil," maxlength='255' ","","text");
                ?>
            </div> 
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_per_imqc_hasil').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_per_imqc_hasil").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="q_control_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/q_control/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_per_imqc_hasil" value="<?= $id_per_imqc_hasil; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_per_imqc_hasil","tgl_per_imqc_hasil",$tgl_per_imqc_hasil,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_per_imqc_hasil",$cmd_ya_tidak,$yn_per_imqc_hasil);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_hasil",$cmd_status,$status_per_imqc_hasil);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_per_imqc_detil",$per_imqc,$id_per_imqc_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_per_imqc_hasil",$hasil_per_imqc_hasil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_per_imqc_hasil",$ket_per_imqc_hasil," maxlength='255' ","","text");
                ?>
            </div> 
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_per_imqc_hasil').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_per_imqc_hasil").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="q_control_clone")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/q_control/simpan_clone');?>" onClick="return cek();">
            <input type="hidden" name="id_per_imqc_hasil" value="<?= $id_per_imqc_hasil; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_per_imqc_hasil","tgl_per_imqc_hasil",$tgl_per_imqc_hasil,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_per_imqc_hasil",$cmd_ya_tidak,$yn_per_imqc_hasil);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_per_imqc_hasil",$cmd_status,$status_per_imqc_hasil);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_per_imqc_detil",$per_imqc,$id_per_imqc_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_per_imqc_hasil",$hasil_per_imqc_hasil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_per_imqc_hasil",$ket_per_imqc_hasil," maxlength='255' ","","text");
                ?>
            </div> 
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_per_imqc_hasil').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_per_imqc_hasil").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
//================================================ !QC
elseif ($page=="report")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('member/'.$page.'/view/'.$id.'/'.$id2.'/'.$id3.'/'.$id4,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE / PERIODE TANGGAL (OPSI TANGGAL SEMUA UNTUK TAMPILKAN SEMUA DATA)</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
            <div class="col-md-8">
              <div class="form-group">
              <label>Indikator</label>
              <?php
input_pdselect2fleksibel("id3","id3",$opsi,"id_equipment","nama_equipment",$id3,"SEMUA");
             //   input_pdselect2("id3",$opsi,$id3);
              ?>   
            </div>
            </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id4",$all_kah,$id4);
                  ?>
                </div>
              </div>
          </div>
          </div>
          <div class="box-footer">
            <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      <div class="callout callout-success">
          Isi form yang ingin di tampilkan, jika tidak ditampilkan, form dapat di kosongkan<br>
          Tanggal awal dan Tanggal akhir adalah range tanggal mutu dibuat<br>
          Laporan ini dalam bentuk tabel dan grafik, data dapat dipilih sesuai dengan tema dan tujuan laporan
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>
            <th style="width:15%;text-align: center;vertical-align: middle;">Range</th>                                                  
            <th style="text-align: center;vertical-align: middle;">Judul</th>                                                        
            <th style="text-align: center;vertical-align: middle;">Tujuan</th>                            
            <th style="text-align: center;vertical-align: middle;">Unit</th> 
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="report_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/report/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
     <div class="box-body">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">TANGGAL LAPORAN DAN PERIODE PENGAMBILAN LAPORAN (SESUAI TANGGAL LOGBOOK)</h3>
        </div>
          <div class="box-body">
            <div class="row">         
              <div class="col-md-4">
                  <label>Tanggal Laporan</label>
                  <?php
                    input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Awal</label>
                  <?php
                    input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
                  ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">     
            <div class="col-md-6">
                <label>Header Laporan</label>
                <?php
                  input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 1</label>
                <?php
                  input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 2</label>
                <?php
                  input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Tujuan</label>
                <?php
                  input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Judul Laporan</label>
                <?php
                  input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Periode</label>
                <?php
                  input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Sumber Data</label>
                <?php
                  input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
                ?>
            </div>      
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_laporan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_laporan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="report_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/report/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
     <div class="box-body">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">TANGGAL LAPORAN DAN PERIODE PENGAMBILAN LAPORAN (SESUAI TANGGAL LOGBOOK)</h3>
        </div>
          <div class="box-body">
            <div class="row">         
              <div class="col-md-4">
                  <label>Tanggal Laporan</label>
                  <?php
                    input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Awal</label>
                  <?php
                    input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
                  ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">       
            <div class="col-md-6">
                <label>Header Laporan</label>
                <?php
                  input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 1</label>
                <?php
                  input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 2</label>
                <?php
                  input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Tujuan</label>
                <?php
                  input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Judul Laporan</label>
                <?php
                  input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Periode</label>
                <?php
                  input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Sumber Data</label>
                <?php
                  input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
                ?>
            </div>      
          </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_laporan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_laporan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="sheet")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#legenddiv {
  max-height: 150px;
  overflow: auto;
}
#chartdiv, #legendwrapper {
  width: 100%;
  height: 1000px;
}
#legenddiv {
  height: 150px;
}

#legendwrapper {
  max-height: 120px;
  overflow-x: none;
  overflow-y: auto;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $link_awal;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?> - <?php echo $nama_unit; ?></h3>

          <div class="box-tools pull-right">
      <?php
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-info">
        <h5>Judul Laporan : <?php echo $judul_laporan; ?><?php if($iddet) echo '</h5><h5>Judul Tabel / Grafik : '.$judul_laporan_detil; ?></h5>
      </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-success">
          Urutan = urutan di dalam tampilan tabel ini<br>
          Judul = Judul untuk tampilan di tabel ini<br>
          Range = Jika min nilai data dan max nilai data diisi<br>
          Indikator = Data indikator sebagai sebagai master<br>
          Tabel = Bentuk tabel / grafik yang di pilih<br>
          Sub Tombol = Bila di dalam laporan di tampilkan tombol ke tabel lainnya<br>
      </div>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="width:5%;vertical-align: middle;text-align: center;">Urutan</th>            
                <th style="vertical-align: middle;">Judul</th>            
                <th style="vertical-align: middle;">Bentuk</th>            
                <th style="width:10%;vertical-align: middle;">Range</th>                     
                <th style="width:15%;vertical-align: middle;">Tabel</th>               
                <th style="width:15%;vertical-align: middle;">Unit</th>                                        
                <th style="width:15%;vertical-align: middle;">Jenis</th>                                        
                <th style="width:10%;vertical-align: middle;">Sub Tombol</th>               
              </tr>
            </thead>
          </table>

        </div>
      </div>
        </div>       
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="sheet_tambah_tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/sheet/simpan_tambah_tabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan" value="<?= $idlap; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">LENGKAPI DATA</h3>
      </div>
        <div class="box-body">
          <div class="row">     
          <div class="col-md-6">
            <label>Judul</label>
            <?php
              input_text("judul_laporan_detil",$judul_laporan_detil," maxlength='255' required ","","text");
            ?>  
          </div>
          <div class="col-md-4">
            <label>Grafik</label>
            <?php
            //  input_pdselect2("tabel",$ambil_tabel,$tabel);
input_pdselect2fleksibel("tabel","tabel",$ambil_tabel,"id_tabel","nama_tabel",$tabel,"Tanpa Tabel dan Grafik");
            ?>  
          </div> 
          <div class="col-md-2">
            <label>Urutan</label>
            <?php
          input_textcustom("urutan_laporan_detil",$urutan_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Angka","text"); 
            ?>  
          </div>
          <div class="col-md-3">
            <label>Bentuk Tabel / Grafik</label>
            <?php
              input_pdselect2("periode_laporan_detil",$periode,$periode_laporan_detil);
            ?>  
          </div>
          <div class="col-md-3">
            <label>Sumber Laporan</label>
            <?php
              input_pdselect2("jenis_per_laporan_detil",$jenis_imut,$jenis_per_laporan_detil);
            ?>  
          </div>
          <div class="col-md-2">
            <label>Mininal Value</label>
            <?php
          input_textcustom("min_laporan_detil",$min_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>  
          <div class="col-md-2">
            <label>Maximal Value</label>
            <?php
          input_textcustom("max_laporan_detil",$max_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>
          <div class="col-md-2">
            <label>Tombol</label>
            <?php
              input_pdselect2("button",$cmd_ya_tidak,$button);
            ?>  
          </div>
          <div class="col-md-12">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_detil",$analisa_laporan_detil," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Hasil / Rekomendasi</label>
            <?php
      input_textareacustom("rekomendasi_laporan_detil",$rekomendasi_laporan_detil," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>     
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
  CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="sheet_rubah_tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/sheet/simpan_rubah_tabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="jenis_per_laporan_lama" value="<?= $jenis_per_laporan_detil; ?>">
            <input type="hidden" name="id_equipment" value="<?= $id_equipment; ?>">
            <input type="hidden" name="equipment_detil" value="<?= $equipment_detil; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH TABEL DAN GRAFIK</h3>
      </div>
        <div class="box-body">
          <div class="row">          
          <div class="col-md-6">
            <label>Judul</label>
            <?php
              input_text("judul_laporan_detil",$judul_laporan_detil," maxlength='255' required ","","text");
            ?>  
          </div>
          <div class="col-md-4">
            <label>Grafik</label>
            <?php
            //  input_pdselect2("tabel",$ambil_tabel,$tabel);
input_pdselect2fleksibel("tabel","tabel",$ambil_tabel,"id_tabel","nama_tabel",$tabel,"Tanpa Tabel dan Grafik");
            ?>  
          </div> 
          <div class="col-md-2">
            <label>Urutan</label>
            <?php
          input_textcustom("urutan_laporan_detil",$urutan_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Angka","text"); 
            ?>  
          </div>
          <div class="col-md-3">
            <label>Bentuk Tabel / Grafik</label>
            <?php
              input_pdselect2("periode_laporan_detil",$periode,$periode_laporan_detil);
            ?>  
          </div>
          <div class="col-md-3">
            <label>Sumber Laporan</label>
            <?php
              input_pdselect2("jenis_per_laporan_detil",$jenis_imut,$jenis_per_laporan_detil);
            ?>  
          </div>
          <div class="col-md-2">
            <label>Mininal Value</label>
            <?php
          input_textcustom("min_laporan_detil",$min_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>  
          <div class="col-md-2">
            <label>Maximal Value</label>
            <?php
          input_textcustom("max_laporan_detil",$max_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>
          <div class="col-md-2">
            <label>Tombol</label>
            <?php
              input_pdselect2("button",$cmd_ya_tidak,$button);
            ?>  
          </div>
          <div class="col-md-12">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_detil",$analisa_laporan_detil," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Hasil / Rekomendasi</label>
            <?php
      input_textareacustom("rekomendasi_laporan_detil",$rekomendasi_laporan_detil," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>     
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="sheet_clone")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/sheet/simpan_clone');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
            <input type="hidden" name="id_equipment" value="<?= $id_equipment; ?>">
            <input type="hidden" name="equipment_detil" value="<?= $equipment_detil; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH TABEL DAN GRAFIK</h3>
      </div>
        <div class="box-body">
          <div class="row">          
          <div class="col-md-6">
            <label>Nama Tabel</label>
            <?php
              input_text("judul_laporan_detil",$judul_laporan_detil," maxlength='255' required ","","text");
            ?>  
          </div>
          <div class="col-md-4">
            <label>Grafik</label>
            <?php
            //  input_pdselect2("tabel",$ambil_tabel,$tabel);
input_pdselect2fleksibel("tabel","tabel",$ambil_tabel,"id_tabel","nama_tabel",$tabel,"Tanpa Tabel dan Grafik");
            ?>  
          </div> 
          <div class="col-md-2">
            <label>Urutan</label>
            <?php
          input_textcustom("urutan_laporan_detil",$urutan_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Angka","text"); 
            ?>  
          </div>
          <div class="col-md-3">
            <label>Bentuk Tabel / Grafik</label>
            <?php
              input_pdselect2("periode_laporan_detil",$periode,$periode_laporan_detil);
            ?>  
          </div>
          <div class="col-md-3">
            <label>Sumber Laporan</label>
            <?php
              input_pdselect2("jenis_per_laporan_detil",$jenis_imut,$jenis_per_laporan_detil);
            ?>  
          </div>
          <div class="col-md-2">
            <label>Mininal Value</label>
            <?php
          input_textcustom("min_laporan_detil",$min_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>  
          <div class="col-md-2">
            <label>Maximal Value</label>
            <?php
          input_textcustom("max_laporan_detil",$max_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>
          <div class="col-md-2">
            <label>Tombol</label>
            <?php
              input_pdselect2("button",$cmd_ya_tidak,$button);
            ?>  
          </div> 
          <div class="col-md-12">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_detil",$analisa_laporan_detil," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Hasil / Rekomendasi</label>
            <?php
      input_textareacustom("rekomendasi_laporan_detil",$rekomendasi_laporan_detil," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>     
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="sheet_seting_im")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.table-scroll {
  position: relative;
  width:100%;
  z-index: 1;
  margin: auto;
  overflow: auto;
  height: 350px;
}
.table-scroll table {
  width: 100%;
  margin: auto;
  border-collapse: separate;
  border-spacing: 0;
}
.table-wrap {
  position: relative;
}
.table-scroll th,
.table-scroll td {
  padding: 5px 10px;
  border: 1px solid #000;
  background: #fff;
  vertical-align: top;
}
.table-scroll thead th {
  color: #fff;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}
/* safari and ios need the tfoot itself to be position:sticky also */
.table-scroll tfoot,
.table-scroll tfoot th,
.table-scroll tfoot td {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  background: #666;
  color: #fff;
  z-index:4;
}

a:focus {
  background: red;
} /* testing links*/

th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
  background: #ccc;
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/sheet/simpan_seting_im');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN</h3>
            </div>
              <div class="box-body">      
      <div class="callout callout-success">
        Jika Dikosongkan Maka Data Mutu Akan Kosong
      </div>     
                <div id="table-scroll" class="table-scroll">
                <table id="main-table" class="table table-bordered table-striped main-table">
                  <thead class="header">
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 7%;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                  </tr>
                  </thead>
                  <tbody class="scrollable">
                    <?php
                    $no=0;
                    /*$arr = array();
                    foreach($arr_isi as $val){
                        $arr[] = $val['id_source'];
                    }
                    $eimplo = implode(",", $arr);*/
                    foreach($chk_eq_detil as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?= $row[$coun_kat_lv1] ?>" <?php if(in_array($row[$coun_kat_lv1],explode(",", $id_equipment))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;">
                        <?= $row[$nama_kat_lv1] ?>
                    </td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
                </div>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
/*    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });*/
  });
</script>
<?php
}
elseif ($page=="sheet_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.table-scroll {
  position: relative;
  width:100%;
  z-index: 1;
  margin: auto;
  overflow: auto;
  height: 350px;
}
.table-scroll table {
  width: 100%;
  margin: auto;
  border-collapse: separate;
  border-spacing: 0;
}
.table-wrap {
  position: relative;
}
.table-scroll th,
.table-scroll td {
  padding: 5px 10px;
  border: 1px solid #000;
  background: #fff;
  vertical-align: top;
}
.table-scroll thead th {
  color: #fff;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}
/* safari and ios need the tfoot itself to be position:sticky also */
.table-scroll tfoot,
.table-scroll tfoot th,
.table-scroll tfoot td {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  background: #666;
  color: #fff;
  z-index:4;
}

a:focus {
  background: red;
} /* testing links*/

th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
  background: #ccc;
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('member/sheet/simpan_seting');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN</h3>
            </div>
              <div class="box-body">      
      <div class="callout callout-success">
        Jika Dikosongkan Maka Sistem Akan Memilih Semua Data Dan Non Aktifkan Data Jika Tidak Ingin Dimunculkan
      </div>     
                <div id="table-scroll" class="table-scroll">
                <table id="main-table" class="table table-bordered table-striped main-table">
                  <thead class="header">
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 10%;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Data</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
                  </tr>
                  </thead>
                  <tbody class="scrollable">
                    <?php
                  if($id_equipment){
                    $no=0;
                    /*$arr = array();
                    foreach($arr_isi as $val){
                        $arr[] = $val['id_source'];
                    }
                    $eimplo = implode(",", $arr);*/
                    foreach($chk_eq_detil as $row){
                     $no++;
                    ?>
                    <tr>
                      <td style="vertical-align:middle;text-align: center;">
                        <div class="checkbox">
                        <label>
                          <input type="checkbox" class="child" name="chk[]" value="<?php echo $row[$coun_kat_lv2];?>" <?php if(in_array($row[$coun_kat_lv2],explode(",", $equipment_detil))) echo 'checked="checked"'; ?>> 
                        </label>
                        </div>
                      </td>
                      <td style="vertical-align:middle;">
                          <?= $row[$nama_kat_lv2] ?>                  
                      </td>
                      <td style="vertical-align:middle;">
                          <?= $row[$nama_kat_lv1] ?>
                      </td>
                    </tr>
                    <?php
                      }
                    }else{
                    ?>
                      <tr><td colspan="3" style="vertical-align:middle;">SEMUA DATA TERPILIH</td></tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
                </div>
              </div>
        <div class="box-footer">
          <?php if($cek > 0 && $id_equipment){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
/*    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });*/
  });
</script>
<?php
}
//================================================ !LAPORAN
elseif ($page=="pendaftaran")
{
?>
<style media="screen">
table.dataTable tbody tr.selected {
  background-color: #0088cc !important;
  color: white !important;
  border: 1px solid #2083eb;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
.anyClass {
  height:500px;
  overflow-y: scroll;
}
.bolded {
  font-weight:bold;
}
.table-scroll {
  position: relative;
  width:100%;
  z-index: 1;
  margin: auto;
  overflow: auto;
  height: 350px;
}
.table-scroll table {
  width: 100%;
  margin: auto;
  border-collapse: separate;
  border-spacing: 0;
}
.table-wrap {
  position: relative;
}
.table-scroll th,
.table-scroll td {
  padding: 5px 10px;
/*  border: 1px solid #000; */
  background: #fff;
  vertical-align: top;
}
.table-scroll thead th {
  color: #fff;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}
/* safari and ios need the tfoot itself to be position:sticky also */
.table-scroll tfoot,
.table-scroll tfoot th,
.table-scroll tfoot td {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  background: #666;
  color: #fff;
  z-index:4;
}

a:focus {
  background: red;
} /* testing links*/

th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
  background: #ccc;
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
} 
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section> 
    <section class="content">
      <div class="box">
        <div class="box-body">
      <div class="callout callout-success">
          Ini adalah tabel pemeriksaan yang pernah dilakukan user/ pegawai, berwarna merah jika masih dalam penginputan data dan hijau jika sudah selesai penginputan<br>
          Jika berwarna merah maka data kewenangan / kompetensi dapat dimasukkan ke dalam logbook, secara otomatis masuk beserta data pasien<br>
          Jika berwarna hijau data hanya di tampilkan, untuk merubahnya bisa dilakukan di menu logbook
      </div>
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
              <div class="box-header with-border">
                <h3 class="box-title"><?= $title ?></h3>
                  <div class="box-tools pull-right">
                  <?php
                //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
                  ?>
                  </div>
              </div>
              <div class="box-body">
                <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
                  <thead>
                    <tr>
                      <th style="width:5%;"></th>
                      <th style="width:5%;display: none;"></th>
                      <th style="width:10%;">Tanggal</th>
                      <th style="text-align: center;">Pasien</th>
                      <th>Pemeriksaan</th>
                      <th>Ruangan</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Silahkan Input Kewenangan / Kompetensi disini</h3>
              <div class="box-tools pull-right">

              </div>
            </div>
              <div class="box-body">
              <div class="box-header with-border">
                <div class="form-group">
                  <div id="table-scroll" class="table-scroll">
                  <table id="main-table" class="table table-bordered table-striped main-table">
                    <thead class="header">
              <tr>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: left;text-align: center;"><b>Tanggal</b></th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Nama Pasien</th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Pemeriksaan</th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Unit</th>
              </tr>
              <tr>
              <th colspan="2" style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: left;text-align: center;"><b>Nama Kewenangan / Kompetensi</b></th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 15%;"><i class="fa fa-pencil"></i></th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 15%;"><i class="fa fa-close"></i></th>
              </tr>
                    </thead>
                    <tbody class="scrollable">
                      <?php
                      $ope = $this->m_member->ambil_datatable_transaksi_pendaftaran();
                        foreach($ope as $rowope){
                      ?>
                    <tr>
                        <td style="vertical-align:middle;text-align: center;"><?= $rowope['tgl_transaksi'] ?></td>
                        <td style="vertical-align:middle;text-align: left;"><?= $rowope['nama_pasien'].' - Umur : '.$rowope['umur'] ?></td>
                        <td style="vertical-align:middle;text-align: center;"><?= $rowope['nama_tindakan'] ?></td>
                        <td style="vertical-align:middle;text-align: center;"><?= $rowope['nama_unit'] ?></td>
                    </tr>
                    <tr>
                       <td colspan="4" style="vertical-align:middle;">
 <button type="button" class="btn btn-success btn-xs SimpanKw" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $rowope['id_operator'] ?>" >
                <i class="fa fa-plus"></i> Tambah Kewenangan</button>                        
                       </td>
                    </tr>
                      <?php
                          $tkewenangan = $this->m_ol_rancak->ambil_data_tindakan_kewenangan($rowope['id_operator'],$rowope['id_pegawai']);
                          foreach($tkewenangan as $rowtkewenangan){
                      ?>
                      <tr>
                      <td style="vertical-align:middle;text-align: center;">&nbsp;</td>
                      <td style="vertical-align:middle;text-align: center;">
                        <?= $rowtkewenangan['nama_kewenangan'].' <b>['.$rowtkewenangan['nama_kompetensi'].']</b><br>Jumlah : '.$rowtkewenangan['jml_logbook'] ?>
                      </td>
                      <td style="vertical-align:middle;text-align: center;">
<button type="button" class="btn btn-success btn-xs EditKw" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $rowtkewenangan['id_tindakan_kewenangan'] ?>">
                <i class="fa fa-pencil"></i></button>
                      </td>
                      <td style="vertical-align:middle;text-align: center;">
    <a href="<?= base_url('member/pendaftaran/hapuskw/') ?><?= $rowtkewenangan['id_tindakan_kewenangan'] ?>" title="Hapus Data" class="btn btn-danger btn-xs"  onclick="confirmation(event)" > <i class="fa fa-trash-o"></i>
    </a> 
                      </td>
                    </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                </div>
              </div> 
              </div>
            </div> 
        </div>
      </div>
    </section> 
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="pendaftaran_tambah_kewenangan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/pendaftaran/simpan_tambah_kewenangan');?>" onClick="return cek();">
      <input type="hidden" name="id_operator" value="<?= $id_operator; ?>">
      <input type="hidden" name="rm" value="<?= $rm; ?>">
      <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>">
      <input type="hidden" name="tgl_transaksi" value="<?= $tgl_transaksi; ?>">
      <input type="hidden" name="status_transaksi" value="<?= $status_transaksi; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">   
          <div class="col-md-12">
              <label>Kewenangan / Tindakan</label>
              <?php
                input_pdselect2("id_kewenangan",$kewenangan,$id_kewenangan);
              ?>  
          </div>
          <div class="col-md-3">
              <label>Jumlah Tindakan</label>
              <?php
                input_textcustom("jml_logbook",$jml_logbook," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                          "Jumlah Tindakan","text");  
              ?>  
          </div>
              <div class="col-md-4">
                  <label>Sifat</label>
                        <?php
                          input_pdselect2("id_sifat_kewenangan",$sifat,$id_sifat_kewenangan);
                        ?>
              </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="pendaftaran_edit_kewenangan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('member/pendaftaran/simpan_edit_kewenangan');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_logbook" value="<?= $id_logbook; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">   
          <div class="col-md-12">
              <label>Kewenangan / Tindakan</label>
              <?php
                input_pdselect2("id_kewenangan",$kewenangan,$id_kewenangan);
              ?>  
          </div>
          <div class="col-md-3">
              <label>Jumlah Tindakan</label>
              <?php
                input_textcustom("jml_logbook",$jml_logbook," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                          "Jumlah Tindakan","text");  
              ?>  
          </div>
              <div class="col-md-4">
                  <label>Sifat</label>
                        <?php
                          input_pdselect2("id_sifat_kewenangan",$sifat,$id_sifat_kewenangan);
                        ?>
              </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}