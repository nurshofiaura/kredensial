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
  border: 1px dotted #c99;
  margin: 1em 0;
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
<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
$arrayboxBOX = array('aqua','green','yellow','red');
$resarrayBOX = array_rand($arrayboxBOX);
$thenarrayBOX = $arrayboxBOX[$resarrayBOX];
$btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
$btnk = array_rand($btnarray);
$btnv = $btnarray[$btnk];
if ($page=="home")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-white box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">SELAMAT DATANG DI WEBSITE KREDENSIAL.COM</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
                   <?php 
                     //     $isi_whatsnew = strip_tags($isi_whatsnew); 
                     //     $isi_whatsnew = html_entity_decode($isi_whatsnew); 
                       //   $isi_whatsnew = substr($isi_whatsnew,0,70); 
                        echo $isi_whatsnew
/*                   echo $isi_whatsnew; 
                   if($this->session->id_level == 99){
                    echo '<pre>'; print_r($this->session->all_userdata());
                   }
                          $isi_whatsnew = strip_tags($isi_whatsnew); 
                          $isi_whatsnew = html_entity_decode($isi_whatsnew); 
                          $isi_whatsnew = substr($isi_whatsnew,0,70); 
                        echo $isi_whatsnew;  
                        $es = '3';
                        $session = 'id_pengcab-'.$es;
                        echo $this->session->$session;*/
                //          echo '<pre>'; print_r($this->session->all_userdata());
                          
  //  $_SESSION['matresult'][$i][$j] = $matrixa[$i][$j] + $matrixb[$i][$j]; 
 //   echo $_SESSION['nama_pengcab'][2];
                //          echo ;
                  ?> 

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="personal")
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
table {
  display: block;
  overflow-x: auto;
/*  white-space: nowrap; */
}
.fixed-column {
    position: sticky;
    left: 0;
    background-color: white; /* Or your desired background */
    z-index: 1; /* Ensure it's above other content */
}
</style>
<div class="content-wrapper"> <!-- //======================================= content-wrapper -->
  <section class="invoice"> <!-- //======================================= invoice -->
      <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
          <h4 style="font-weight:bold;text-align: center;"><?= $header_laporan ?></h4>
          <h4 style="font-weight:bold;text-align: center;"><?= $sub_header_laporan ?></h4>
          <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header_laporan ?></h4>
        </div><br style="line-height:2">
    </div><br style="line-height:2">
    <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
          <table class="table no-border">
              <tbody>
                <?php  
                  if(!empty($judul_laporan)){
                ?>
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                  <td style="width:25%;">Judul</td>
                  <td style="width:3%;text-align: center;">:</td>
                  <td><?= $judul_laporan ?></td>
                </tr>
                <?php  
                  }
                  if(!empty($tujuan_laporan)){
                    $tujuan_laporan = strip_tags($tujuan_laporan); 
                    $tujuan_laporan = html_entity_decode($tujuan_laporan);
                ?>    
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Tujuan</td>
                  <td style="text-align: center;">:</td>
                  <td><?= $tujuan_laporan ?></td>
                </tr>
                <?php  
                  }
                  if(!empty($periode_laporan)){
                ?>
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Periode Analisis dan Pelaporan Data</td>
                  <td style="text-align: center;">:</td>
                  <td><?= $periode_laporan ?></td>
                </tr>
                <?php  
                  }
                  if(!empty($sumber_laporan)){
                ?>
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Sumber Data</td>
                  <td style="text-align: center;">:</td>
                  <td><?= $sumber_laporan ?></td>
                </tr>
                <?php  
                  }
                ?>
               <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Pengambil Data</td>
                  <td style="text-align: center;">:</td>
                  <td><?= strtoupper($aran_pegawai) ?></td>
                </tr>
              </tbody>
          </table>
        </div>
        <div class="col-sm-12 huruf-12">
  <?php
//======================================= col-sm-12
if($iddet){
if($jenis_per_laporan_detil == 5){
  //======================================= $jenis_per_laporan_detil == 5
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
                <td><?= $rowambil_berkas[$nama_kat_lv2] ?></td>
                <td style="vertical-align:middle;text-align: center;">
                <?php  
                  if(!empty($rowambil_berkas['no_berkas'])){
                  echo 'No Berkas : '.$rowambil_berkas['no_berkas'];
                  }
                ?>
                <br>
                Kategori : <?= $rowambil_berkas[$nama_kat_lv1] ?>
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
                <td><?= $rowambil_imut[$nama_kat_lv2] ?></td>
                <td style="vertical-align:middle;text-align: center;">
                <?php  
                  if(!empty($rowambil_imut['no_berkas'])){
                  echo 'No Berkas : '.$rowambil_imut['no_berkas'];
                  }
                ?>
                <br>
                Kategori : <?= $rowambil_imut[$nama_kat_lv1] ?>
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
                <td><?= $rowambil_ijasah[$nama_kat_lv2] ?></td>
                <td style="vertical-align:middle;text-align: center;">
                Kategori : <?= $rowambil_ijasah[$nama_kat_lv1] ?><br>
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
                <td><?= $rowambil_pelatihan[$nama_kat_lv2] ?></td>
                <td style="vertical-align:middle;text-align: center;">
        Kategori : <?= $rowambil_pelatihan[$nama_kat_lv1] ?>
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
                <td><?= $rowambil_str[$nama_kat_lv2] ?></td>
                <td style="vertical-align:middle;text-align: center;">
                Kategori : <?= $rowambil_str[$nama_kat_lv1] ?><br>
                No Surat Ijin : <?= $rowambil_str['no_berkas'] ?><br>
                Berlaku Mulai : <?= date('d-m-Y',strtotime($rowambil_str['tgl_a_berkas'])) ?> s/d 
                <?php 
                  if($rowambil_str['lifetime_berkas'] == 1){
                  echo "Seumur Hidup";
                  }else{
                  echo date('d-m-Y',strtotime($rowambil_str['tgl_b_berkas']));
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
  //======================================= !$jenis_per_laporan_detil == 5
}else{
  //======================================= $jenis_per_laporan_detil == 5 ELSE
if($tabel == 1){
//======================================= TABEL= 1
  if($periode_laporan_detil == 1){
 //======================================= $periode_laporan_detil == 1 / HARIAN <h4 class="box-title">Bulan <?= $rowambil_bulan[$tgl_item]</h4>
    foreach($ambil_bulan as $rowambil_bulan){
?>

<?php
  $kndstperi = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>date('Y-m',strtotime($rowambil_bulan[$tgl_item])));
  //======================================= foreach($ambil_bulan)
    //$tbl_harian = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndsbln,$period);
/*  if($jenis_per_laporan_detil == 4){
    $tbl_harian = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndstperi,$Kat_lv1);
  }else{*/
    $tbl_harian = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndstperi,$Kat_lv1);
 // }
    
    foreach($tbl_harian as $rowkat){
    $bln = date('m',strtotime($rowkat[$tgl_item]));
    $thn = date('Y',strtotime($rowkat[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowkat[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;
    //======================================= foreach($tbl_harian)
  ?>
      <h4 class="box-title">Kategori : <?= $rowkat[$nama_kat_lv1] ?> Bulan <?= $this->m_rancak->getBulan($bln) ?> <?= $thn ?></h4>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $head2 ?></th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $number ?></th>
    <?php
      }
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">JML</th>
        </tr>
        </thead>
        <tbody>   
    <?php 
        $no = 0;
        $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv1=>$rowkat[$id_kat_lv1]);
  if($jenis_per_laporan_detil == 4){
    $tbl_grup = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv2);
  }else{
    $tbl_grup = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv2);
  }
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
              <?= $row[$nama_kat_lv2] ?>                      
            </td>
            <?php
            $jmle = 0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $ketbulan.'-'.$numbers;
              $kndsjml = array($ins=>$idinst,$tgl_item=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
  if($jenis_per_laporan_detil == 4){
    $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
  }else{
    $jml = $this->m_external->jumlah_sumber_data_personal($iddet,$tabel_item,$select_semua,$kndsjml);
  }          
              if($jml == 0){ 
                if($row[$yesno] == 1){
                  echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">-</td>';
                }else{
                  echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>';
                }
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
  if($jenis_per_laporan_detil == 4){
    $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
  }else{
    $q = $this->m_external->total_sumber_data_personal($iddet,$tabel_item,$slcjml,$kndsjml);
  }
                foreach($q as $row2){
                  $jmle = $jmle + $row2['jumlahe'];
                  if($row[$yesno] == 1){
                    echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">&#10003;</td>';
                  }else{
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            </td>
            <?php
                  }
                }
              }
            }
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmle,0) ?>
            </td>
          </tr> 
    <?php
        }
    ?>
        </tbody>
      </table>
  <?php 
    //======================================= !foreach($tbl_harian)
    }
   //======================================= !foreach($ambil_bulan)
    }
 //======================================= !$periode_laporan_detil == 1 / HARIAN
  }
  if($periode_laporan_detil == 2){
 //======================================= $periode_laporan_detil == 2 / BULANAN
 //   foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
  ?>

  <?php 
/*  if($jenis_per_laporan_detil == 4){
    $tbl_bulanan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,$Kat_lv1);
  }else{*/
    $tbl_bulanan = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndsbln,$Kat_lv1);
 // }
    foreach($tbl_bulanan as $rowkat){
    $bln = date('m',strtotime($rowkat[$tgl_item]));
    $thn = date('Y',strtotime($rowkat[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowkat[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = 12;
    $akhir  = $ketbulan.'-'.$tglakhir;
    //======================================= foreach($tbl_bulanan)
  ?>
      <h4 class="box-title">Kategori : <?= $rowkat[$nama_kat_lv1] ?> Tahun <?= $thn ?></h4>
      <table width="100%" class="table table-responsive">
        <thead class="bg-light sticky-top">
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $head2 ?></th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $this->m_rancak->getBulan($number) ?></th>
    <?php
      }
    ?>
    <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width: 2%;">JML</th>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv1=>$rowkat[$id_kat_lv1]);
/*  if($jenis_per_laporan_detil == 4){
    $tbl_grup = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv2);
  }else{*/
    $tbl_grup = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv2);
 // }
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
              <?= $row[$nama_kat_lv2] ?>                      
            </td>
            <?php
            $jmle = 0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $thn.'-'.sprintf("%02d", $numbers);
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
/*  if($jenis_per_laporan_detil == 4){
    $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
  }else{*/
    $jml = $this->m_external->jumlah_sumber_data_personal($iddet,$tabel_item,$select_semua,$kndsjml);
 // }
              if($jml == 0){    
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
            <?php
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
/*  if($jenis_per_laporan_detil == 4){
    $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
  }else{*/
    $q = $this->m_external->total_sumber_data_personal($iddet,$tabel_item,$slcjml,$kndsjml);
 // }
                foreach($q as $row2){
                  $jmle = $jmle + $row2['jumlahe'];
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            </td>
            <?php
                }
              }
            }
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmle,0) ?>
            </td>
          </tr> 
    <?php
        }
    ?>
      
        </tbody>
      </table>    
    <?php 
    //======================================= !foreach($tbl_bulanan)
    }
  ?>

<?php
   //======================================= !foreach($ambil_bulan)
//    }
 //======================================= !$periode_laporan_detil == 2 / BULANAN
  }
  if($periode_laporan_detil == 3){
 //======================================= $periode_laporan_detil == 3 / TAHUNAN
//    foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
/*    $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
    $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;*/
  ?>

  <?php
/*      if($jenis_per_laporan_detil == 4){
        $tbl_tahunan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,$Kat_lv1);
      }else{*/
        $tbl_tahunan = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndsbln,$Kat_lv1);
  //    }
    foreach($tbl_tahunan as $rowthn){
    //======================================= foreach($tbl_tahunan)
  ?>
      <h4 class="box-title">Kategori : <?= $rowthn[$nama_kat_lv1] ?></h4>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $head2 ?></th>
    <?php
      $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv1=>$rowthn[$id_kat_lv1]);
/*      if($jenis_per_laporan_detil == 4){
        $tbl_tahunanp = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndskat,$period);
      }else{*/
        $tbl_tahunanp = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndskat,$period);
   //   }
      foreach($tbl_tahunanp as $rowkat){           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= date('Y',strtotime($rowkat[$tgl_item])); ?></th>
    <?php
      }
    ?>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $kndseq = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y")'=>date('Y',strtotime($rowkat[$tgl_item])),$Kat_lv1=>$rowthn[$id_kat_lv1]);
/*      if($jenis_per_laporan_detil == 4){
        $tbl_eq = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndseq,$Kat_lv2);
      }else{*/
        $tbl_eq = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndseq,$Kat_lv2);
   //   }
        foreach($tbl_eq as $roweq){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $roweq[$nama_kat_lv2] ?></td>
            <?php 
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y")'=>date('Y',strtotime($rowthn[$tgl_item])),$Kat_lv2=>$roweq[$id_kat_lv2]);
/*      if($jenis_per_laporan_detil == 4){
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml,$Kat_lv2);
      }else{*/
        $jml = $this->m_external->jumlah_sumber_data_personal($iddet,$tabel_item,$select_semua,$kndsjml,$Kat_lv2);
    //  }
              if($jml == 0){
                echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>';
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
/*      if($jenis_per_laporan_detil == 4){
        $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml,$Kat_lv2);
      }else{*/
        $q = $this->m_external->total_sumber_data_personal($iddet,$tabel_item,$slcjml,$kndsjml,$Kat_lv2);
   //   }
                foreach($q as $row2){
            ?>
              <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            <?php
                }
              }
            ?>
          </tr>
      <?php 
        }
      ?>
        </tbody>
      </table>
  <?php 
    //======================================= !foreach($tbl_tahunan)
    }
  ?>

  <?php
   //======================================= !foreach($ambil_bulan)
 //   }
 //======================================= !$periode_laporan_detil == 3 / TAHUNAN
  }
//======================================= !TABEL= 1
}else if($tabel == 14){
//======================================= TABEL= 14
    if($periode_laporan_detil == 1){
 //======================================= $periode_laporan_detil == 1 / HARIAN
      foreach($ambil_bulan as $rowambil_bulan){
  ?>
<h4 class="box-title">Bulan <?= $this->m_rancak->getBulan(date('m',strtotime($rowambil_bulan[$tgl_item]))) ?> <?= date('Y',strtotime($rowambil_bulan[$tgl_item])) ?></h4>
  <?php
  $kndstperi = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>date('Y-m',strtotime($rowambil_bulan[$tgl_item])));
/*      if($jenis_per_laporan_detil == 4){
        $tbl_harian = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,'YEAR('.$tgl_item.')');
      }else{*/
        $tbl_harian = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndsbln,'YEAR('.$tgl_item.')');
 //     }
    foreach($tbl_harian as $rowkat){
    $bln = date('m',strtotime($rowkat[$tgl_item]));
    $thn = date('Y',strtotime($rowkat[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowkat[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;
    //======================================= foreach($tbl_harian)
  ?>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $head1 ?></th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $head2 ?></th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $number ?></th>
    <?php
      }
    ?>
      <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">JML</th>
        </tr>
        </thead>
        <tbody>   
    <?php 
        $no = 0;
        $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst);
/*      if($jenis_per_laporan_detil == 4){
       $tbl_grup = $this->m_external->ambil_isi_order($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv1,'asc',$Kat_lv2);
      }else{*/
        $tbl_grup = $this->m_external->ambil_isi_personal_order($iddet,$tabel_item,$select_semua,$kndstperi,$Kat_lv1,'asc',$Kat_lv2);
   //   }
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$nama_kat_lv1] ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$nama_kat_lv2] ?></td>
            <?php
            $jmle = 0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $ketbulan.'-'.$numbers;
              $kndsjml = array($ins=>$idinst,$tgl_item=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
/*      if($jenis_per_laporan_detil == 4){
       $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
      }else{*/
        $jml = $this->m_external->jumlah_sumber_data_personal($iddet,$tabel_item,$select_semua,$kndsjml);
   //   }
              if($jml == 0){    
                if($row[$yesno] == 1){
                  echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">-</td>';
                }else{
                  echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>';
                }
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
/*      if($jenis_per_laporan_detil == 4){
       $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
      }else{*/
        $q = $this->m_external->total_sumber_data_personal($iddet,$tabel_item,$slcjml,$kndsjml);
   //   }
                foreach($q as $row2){
                  $jmle = $jmle + $row2['jumlahe'];
                  if($row[$yesno] == 1){
                    echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">&#10003;</td>';
                  }else{
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            </td>
            <?php
                  }
                }
              }
            }
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmle,0) ?>
            </td>
          </tr> 
    <?php
        }
    ?>
        </tbody>
      </table>
  <?php 
    //======================================= !foreach($tbl_harian)
    }
  }
 //======================================= $periode_laporan_detil == 1 / HARIAN
    }
  if($periode_laporan_detil == 2){
 //======================================= $periode_laporan_detil == 2 / BULANAN
 //   foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
  ?>

  <?php
/*      if($jenis_per_laporan_detil == 4){
       $tbl_bulanan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,'YEAR('.$tgl_item.')');
      }else{*/
        $tbl_bulanan = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndsbln,'YEAR('.$tgl_item.')');
   //   }
    foreach($tbl_bulanan as $rowkat){
    $bln = date('m',strtotime($rowkat[$tgl_item]));
    $thn = date('Y',strtotime($rowkat[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowkat[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = 12;
    $akhir  = $ketbulan.'-'.$tglakhir;
    //======================================= foreach($tbl_bulanan)
  ?>
      <h4 class="box-title">Tahun <?= $thn ?></h4>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $head1 ?></th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $head2 ?></th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $this->m_rancak->getBulan($number) ?></th>
    <?php
      }
    ?>
        <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">JML</th>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst);
/*      if($jenis_per_laporan_detil == 4){
        $tbl_grup = $this->m_external->ambil_isi_order($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv1,'asc',$Kat_lv2);
      }else{*/
         $tbl_grup = $this->m_external->ambil_isi_personal_order($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv1,'asc',$Kat_lv2);
   //   }
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$nama_kat_lv1] ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$nama_kat_lv2] ?></td>
            <?php
            $jmle = 0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $thn.'-'.sprintf("%02d", $numbers);
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
/*      if($jenis_per_laporan_detil == 4){
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
      }else{*/
         $jml = $this->m_external->jumlah_sumber_data_personal($iddet,$tabel_item,$select_semua,$kndsjml);
   //   }
              if($jml == 0){    
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
            <?php
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
/*      if($jenis_per_laporan_detil == 4){
        $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
      }else{*/
         $q = $this->m_external->total_sumber_data_personal($iddet,$tabel_item,$slcjml,$kndsjml);
   //   }
                foreach($q as $row2){
                  $jmle = $jmle + $row2['jumlahe'];
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            </td>
            <?php
                }
              }
            }
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmle,0) ?>
            </td>
          </tr> 
    <?php
        }
    ?>
      
        </tbody>
      </table>    
    <?php 
    //======================================= !foreach($tbl_bulanan)
    }
  ?>

<?php
   //======================================= !foreach($ambil_bulan)
//    }
 //======================================= !$periode_laporan_detil == 2 / BULANAN
  }
  if($periode_laporan_detil == 3){
 //======================================= $periode_laporan_detil == 3 / TAHUNAN
//    foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
/*    $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
    $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;*/
  ?>

  <?php
/*      if($jenis_per_laporan_detil == 4){
        $tbl_tahunan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,'YEAR('.$tgl_item.')');
      }else{*/
         $tbl_tahunan = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndsbln,'YEAR('.$tgl_item.')');
    //  }
    foreach($tbl_tahunan as $rowthn){
    //======================================= foreach($tbl_tahunan)
  ?>
      <h4 class="box-title"></h4>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $head1 ?></th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $head2 ?></th>
    <?php
      $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv1=>$rowthn[$id_kat_lv1]);
/*      if($jenis_per_laporan_detil == 4){
        $tbl_tahunanp = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndskat,$period);
      }else{*/
         $tbl_tahunanp = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndskat,$period);
   //   }
      foreach($tbl_tahunanp as $rowkat){           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= date('Y',strtotime($rowkat[$tgl_item])); ?></th>
    <?php
      }
    ?>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $kndskata = array('DATE_FORMAT('.$tgl_item.',"%Y")'=>date('Y',strtotime($rowkat[$tgl_item])),$ins=>$idinst);
/*      if($jenis_per_laporan_detil == 4){
        $tbl_grup = $this->m_external->ambil_isi_order($iddet,$tabel_item,$select_semua,$kndskata,$Kat_lv1,'asc',$Kat_lv2);
      }else{*/
         $tbl_grup = $this->m_external->ambil_isi_personal_order($iddet,$tabel_item,$select_semua,$kndskata,$Kat_lv1,'asc',$Kat_lv2);
   //   }
        foreach($tbl_grup as $roweq){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $roweq[$nama_kat_lv1] ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $roweq[$nama_kat_lv2] ?></td>
            <?php 
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y")'=>date('Y',strtotime($rowthn[$tgl_item])),$Kat_lv2=>$roweq[$id_kat_lv2]);
/*      if($jenis_per_laporan_detil == 4){
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml,$Kat_lv2);
      }else{*/
        $jml = $this->m_external->jumlah_sumber_data_personal($iddet,$tabel_item,$select_semua,$kndsjml,$Kat_lv2);
   //   }
              if($jml == 0){
                echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>';
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
/*      if($jenis_per_laporan_detil == 4){
        $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml,$Kat_lv2);
      }else{*/
        $q = $this->m_external->total_sumber_data_personal($iddet,$tabel_item,$slcjml,$kndsjml,$Kat_lv2);
    //  }
                foreach($q as $row2){
            ?>
              <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            <?php
                }
              }
            ?>
          </tr>
      <?php 
        }
      ?>
        </tbody>
      </table>
  <?php 
    //======================================= !foreach($tbl_tahunan)
    }
  ?>

  <?php
   //======================================= !foreach($ambil_bulan)
 //   }
 //======================================= !$periode_laporan_detil == 3 / TAHUNAN
  }
//======================================= !TABEL= 14
}
else{
  ?>
               <div id="chartdiv"></div>
                <div id="legenddiv"></div>
  <?php
}
//======================================= $jenis_per_laporan_detil == 5 ELSE
}
} //iddet
//======================================= !col-sm-12
  ?>
        </div>
        <br style="line-height:2">
        <div class="col-sm-12 huruf-12">
          <?php 
            if(!empty($analisa_laporan_detil) || !empty($rekomendasi_laporan_detil)){
              if(!empty($judul_laporan_detil)){
          ?>
          <h4 style="font-weight:bold;text-align: left;"><?= $judul_laporan_detil ?></h4>
          <?php 
              }
            }
            if(!empty($analisa_laporan_detil)){
              $analisa_laporan_detil = strip_tags($analisa_laporan_detil); 
              $analisa_laporan_detil = html_entity_decode($analisa_laporan_detil);
              echo $analisa_laporan_detil.'<br style="line-height:2">';
            }
            if(!empty($rekomendasi_laporan_detil)){
              $rekomendasi_laporan_detil = strip_tags($rekomendasi_laporan_detil); 
              $rekomendasi_laporan_detil = html_entity_decode($rekomendasi_laporan_detil);
              echo $rekomendasi_laporan_detil;
            }
          ?>
        </div>
      </div>
      <?php 
        if($button== 1){
      ?>
    <div class="row no-print">
    <section class="invoice">
        <div class="row invoice-info">
          <h4 style="font-weight:bold;">TABEL DAN GRAFIK LAINNYA</h4>
        <?php
            foreach($ambil_tabel as $rowambil_tabel){
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/'.$page.'/view/'.$rowambil_tabel['id_laporan'].'/'.$rowambil_tabel['id_laporan_detil']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"><i class="fa fa-line-chart"></i> <?= $rowambil_tabel['judul_laporan_detil'] ?>
            </a>
          </div>
          <?php
            }
          ?>
        </div>
    </section>
    </div>
      <?php 
        }
      ?>
    <!-- /.content -->
    <div class="clearfix"></div>
  </section> <!-- //======================================= !invoice -->
</div> <!-- //======================================= !content-wrapper -->
<?php
}
elseif ($page=="imut")
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
table {
  display: block;
  overflow-x: auto;
/*  white-space: nowrap; */
}
.fixed-column {
    position: sticky;
    left: 0;
    background-color: white; /* Or your desired background */
    z-index: 1; /* Ensure it's above other content */
}
</style>
<div class="content-wrapper"> <!-- //======================================= content-wrapper -->
  <section class="invoice"> <!-- //======================================= invoice -->
      <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
          <h4 style="font-weight:bold;text-align: center;"><?= $header_laporan ?></h4>
          <h4 style="font-weight:bold;text-align: center;"><?= $sub_header_laporan ?></h4>
          <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header_laporan ?></h4>
        </div><br style="line-height:2">
    </div><br style="line-height:2">
    <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
          <table class="table no-border">
              <tbody>
                <?php  
                  if(!empty($judul_laporan)){
                ?>
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                  <td style="width:25%;">Judul</td>
                  <td style="width:3%;text-align: center;">:</td>
                  <td><?= $judul_laporan ?></td>
                </tr>
                <?php  
                  }
                  if(!empty($tujuan_laporan)){
                    $tujuan_laporan = strip_tags($tujuan_laporan); 
                    $tujuan_laporan = html_entity_decode($tujuan_laporan);
                ?>    
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Tujuan</td>
                  <td style="text-align: center;">:</td>
                  <td><?= $tujuan_laporan ?></td>
                </tr>
                <?php  
                  }
                  if(!empty($periode_laporan)){
                ?>
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Periode Analisis dan Pelaporan Data</td>
                  <td style="text-align: center;">:</td>
                  <td><?= $periode_laporan ?></td>
                </tr>
                <?php  
                  }
                  if(!empty($sumber_laporan)){
                ?>
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Sumber Data</td>
                  <td style="text-align: center;">:</td>
                  <td><?= $sumber_laporan ?></td>
                </tr>
                <?php  
                  }
                ?>
               <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Pengambil Data</td>
                  <td style="text-align: center;">:</td>
                  <td><?= strtoupper($aran_pegawai) ?></td>
                </tr>
              </tbody>
          </table>
        </div>
        <div class="col-sm-12 huruf-12">
  <?php
//======================================= col-sm-12
if($iddet){
if($tabel == 1){
//======================================= TABEL= 1

  if($periode_laporan_detil == 1){
 //======================================= $periode_laporan_detil == 1 / HARIAN

    foreach($ambil_bulan as $rowambil_bulan){
?>
<h4 class="box-title"></h4>
<?php
  $kndstperi = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>date('Y-m',strtotime($rowambil_bulan[$tgl_item])));
  //======================================= foreach($ambil_bulan)
    $tbl_harian = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndstperi,$Kat_lv1);
    foreach($tbl_harian as $rowkat){
    $bln = date('m',strtotime($rowkat[$tgl_item]));
    $thn = date('Y',strtotime($rowkat[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowkat[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;
    //======================================= foreach($tbl_harian)
  ?>
      <h4 class="box-title">Kategori : <?= $rowkat[$nama_kat_lv1] ?> Bulan <?= $this->m_rancak->getBulan($bln) ?> <?= $thn ?></h4>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Nama</th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $number ?></th>
    <?php
      }
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">JML</th>
        </tr>
        </thead>
        <tbody>   
    <?php 
        $no = 0;
        $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv1=>$rowkat[$id_kat_lv1],'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan);
        $tbl_grup = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv2);
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
              <?= $row[$nama_kat_lv2] ?>                      
            </td>
            <?php
            $jmle = 0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $ketbulan.'-'.$numbers;
              $kndsjml = array($ins=>$idinst,$tgl_item=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
              if($jml == 0){ 
                if($row[$yesno] == 1){
                  echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">-</td>';
                }else{
                  echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>';
                }
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
        $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
                foreach($q as $row2){
                  $jmle = $jmle + $row2['jumlahe'];
                  if($row[$yesno] == 1){
                    echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">&#10003;</td>';
                  }else{
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            </td>
            <?php
                  }
                }
              }
            }
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmle,0) ?>
          </tr> 
    <?php
        }
    ?>
        </tbody>
      </table>
  <?php 
    //======================================= !foreach($tbl_harian)
    }
   //======================================= !foreach($ambil_bulan)
    }
 //======================================= !$periode_laporan_detil == 1 / HARIAN
  }
  if($periode_laporan_detil == 2){
 //======================================= $periode_laporan_detil == 2 / BULANAN
 //   foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
  ?>

  <?php 
        $tbl_bulanan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,$Kat_lv1);
    foreach($tbl_bulanan as $rowkat){
    $bln = date('m',strtotime($rowkat[$tgl_item]));
    $thn = date('Y',strtotime($rowkat[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowkat[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = 12;
    $akhir  = $ketbulan.'-'.$tglakhir;
    //======================================= foreach($tbl_bulanan)
  ?>
      <h4 class="box-title">Kategori : <?= $rowkat[$nama_kat_lv1] ?> Tahun <?= $thn ?></h4>
      <table width="100%" class="table table-responsive">
        <thead class="bg-light sticky-top">
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Nama</th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $this->m_rancak->getBulan($number) ?></th>
    <?php
      }
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">JML</th>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv1=>$rowkat[$id_kat_lv1]);
      if($page == 'imut'){
        $tbl_grup = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv2);
      }else{
        $tbl_grup = $this->m_external->ambil_isi_personal($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv2);
      }
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
              <?= $row[$nama_kat_lv2] ?>                      
            </td>
            <?php
            $jmle = 0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $thn.'-'.sprintf("%02d", $numbers);
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
              if($jml == 0){    
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
            <?php
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
        $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
                foreach($q as $row2){
                  $jmle = $jmle + $row2['jumlahe'];
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            </td>
            <?php
                }
              }
            }
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmle,0) ?>
            </td>
          </tr> 
    <?php
        }
    ?>
      
        </tbody>
      </table>    
    <?php 
    //======================================= !foreach($tbl_bulanan)
    }
  ?>

<?php
   //======================================= !foreach($ambil_bulan)
//    }
 //======================================= !$periode_laporan_detil == 2 / BULANAN
  }
  if($periode_laporan_detil == 3){
 //======================================= $periode_laporan_detil == 3 / TAHUNAN
//    foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
/*    $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
    $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;*/
  ?>

  <?php
    $tbl_tahunan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,$Kat_lv1);
    foreach($tbl_tahunan as $rowthn){
    //======================================= foreach($tbl_tahunan)
  ?>
      <h4 class="box-title">Kategori : <?= $rowthn[$nama_kat_lv1] ?></h4>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Nama Indikator Mutu</th>
    <?php
      $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv1=>$rowthn[$id_kat_lv1]);
      $tbl_tahunanp = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndskat,$period);
      foreach($tbl_tahunanp as $rowkat){           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= date('Y',strtotime($rowkat[$tgl_item])); ?></th>
    <?php
      }
    ?>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $kndseq = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y")'=>date('Y',strtotime($rowkat[$tgl_item])),$Kat_lv1=>$rowthn[$id_kat_lv1]);
        $tbl_eq = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndseq,$Kat_lv2);
        foreach($tbl_eq as $roweq){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $roweq[$nama_kat_lv2] ?></td>
            <?php 
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y")'=>date('Y',strtotime($rowthn[$tgl_item])),$Kat_lv2=>$roweq[$id_kat_lv2]);
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml,$Kat_lv2);
              if($jml == 0){
                echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>';
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
        $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml,$Kat_lv2);
                foreach($q as $row2){
            ?>
              <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            <?php
                }
              }
            ?>
          </tr>
      <?php 
        }
      ?>
        </tbody>
      </table>
  <?php 
    //======================================= !foreach($tbl_tahunan)
    }
  ?>

  <?php
   //======================================= !foreach($ambil_bulan)
 //   }
 //======================================= !$periode_laporan_detil == 3 / TAHUNAN
  }
//======================================= !TABEL= 1
}else if($tabel == 14){
//======================================= TABEL= 14
    if($periode_laporan_detil == 1){
 //======================================= $periode_laporan_detil == 1 / HARIAN
      foreach($ambil_bulan as $rowambil_bulan){
  ?>
<h4 class="box-title">Bulan <?= $this->m_rancak->getBulan(date('m',strtotime($rowambil_bulan[$tgl_item]))) ?> <?= date('Y',strtotime($rowambil_bulan[$tgl_item])) ?></h4>
  <?php
  $kndstperi = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>date('Y-m',strtotime($rowambil_bulan[$tgl_item])));
  //======================================= foreach($ambil_bulan)
/*    $tbl_harian = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndstperi,$Kat_lv1);
    foreach($tbl_harian as $rowkat){*/
    $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
    $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;
    //======================================= foreach($tbl_harian)
  ?>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Indikator</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Poin Mutu</th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $number ?></th>
    <?php
      }
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">JML</th>
        </tr>
        </thead>
        <tbody>   
    <?php 
        $no = 0;
        $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst);
       $tbl_grup = $this->m_external->ambil_isi_order($iddet,$tabel_item,$select_semua,$kndstperi,$Kat_lv1,'asc',$Kat_lv2);
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$nama_kat_lv1] ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$nama_kat_lv2] ?></td>
            <?php
            $jmle = 0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $ketbulan.'-'.$numbers;
              $kndsjml = array($ins=>$idinst,$tgl_item=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
       $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
              if($jml == 0){    
                if($row[$yesno] == 1){
                  echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">-</td>';
                }else{
                  echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>';
                }
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
       $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
                foreach($q as $row2){
                  $jmle = $jmle + $row2['jumlahe'];
                  if($row[$yesno] == 1){
                    echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">&#10003;</td>';
                  }else{
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            </td>
            <?php
                  }
                }
              }
            }
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmle,0) ?>
            </td>
          </tr> 
    <?php
        }
    ?>
        </tbody>
      </table>

  <?php 
    //======================================= !foreach($tbl_harian)
    // }
      }
 //======================================= $periode_laporan_detil == 1 / HARIAN
    }
  if($periode_laporan_detil == 2){
 //======================================= $periode_laporan_detil == 2 / BULANAN
 //   foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan) 
    $tbl_bulanan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,'YEAR('.$tgl_item.')');
    foreach($tbl_bulanan as $rowkat){
    $bln = date('m',strtotime($rowkat[$tgl_item]));
    $thn = date('Y',strtotime($rowkat[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowkat[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = 12;
    $akhir  = $ketbulan.'-'.$tglakhir;
    //======================================= foreach($tbl_bulanan)
  ?>
      <h4 class="box-title">Tahun <?= $thn ?></h4>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Indikator</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Poin Mutu</th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $this->m_rancak->getBulan($number) ?></th>
    <?php
      }
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">JML</th>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst);
        $tbl_grup = $this->m_external->ambil_isi_order($iddet,$tabel_item,$select_semua,$kndskat,$Kat_lv1,'asc',$Kat_lv2);
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$nama_kat_lv1] ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$nama_kat_lv2] ?></td>
            <?php
            $jmle = 0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $thn.'-'.sprintf("%02d", $numbers);
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
              if($jml == 0){    
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
            <?php
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
        $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
                foreach($q as $row2){
                  $jmle = $jmle + $row2['jumlahe'];
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            </td>
            <?php
                }
              }
            }
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmle,0) ?>
            </td>
          </tr> 
    <?php
        }
    ?>
        </tbody>
      </table>    
    <?php 
    //======================================= !foreach($tbl_bulanan)
    }
   //======================================= !foreach($ambil_bulan)
//    }
 //======================================= !$periode_laporan_detil == 2 / BULANAN
  }
  if($periode_laporan_detil == 3){
 //======================================= $periode_laporan_detil == 3 / TAHUNAN
//    foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
/*    $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
    $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;*/
  ?>

  <?php
        $tbl_tahunan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,'YEAR('.$tgl_item.')');
    foreach($tbl_tahunan as $rowthn){
    //======================================= foreach($tbl_tahunan)
  ?>
      <h4 class="box-title"></h4>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Indikator</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Poin Mutu</th>
    <?php
      $kndskat = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv1=>$rowthn[$id_kat_lv1]);
        $tbl_tahunanp = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndskat,$period);
      foreach($tbl_tahunanp as $rowkat){           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= date('Y',strtotime($rowkat[$tgl_item])); ?></th>
    <?php
      }
    ?>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $kndskata = array('DATE_FORMAT('.$tgl_item.',"%Y")'=>date('Y',strtotime($rowkat[$tgl_item])),$ins=>$idinst);
        $tbl_grup = $this->m_external->ambil_isi_order($iddet,$tabel_item,$select_semua,$kndskata,$Kat_lv1,'asc',$Kat_lv2);
        foreach($tbl_grup as $roweq){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $roweq[$nama_kat_lv1] ?></td>
            <td style="position: sticky;font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $roweq[$nama_kat_lv2] ?></td>
            <?php 
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y")'=>date('Y',strtotime($rowthn[$tgl_item])),$Kat_lv2=>$roweq[$id_kat_lv2]);
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml,$Kat_lv2);
              if($jml == 0){
                echo '<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>';
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
         $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml,$Kat_lv2);
                foreach($q as $row2){
            ?>
              <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
            <?php
                }
              }
            ?>
          </tr>
      <?php 
        }
      ?>
        </tbody>
      </table>
  <?php 
    //======================================= !foreach($tbl_tahunan)
    }
  ?>

  <?php
   //======================================= !foreach($ambil_bulan)
 //   }
 //======================================= !$periode_laporan_detil == 3 / TAHUNAN
  }
}
else if($tabel == 16){
//======================================= TABEL= 16
$knds_cek = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst);
$cek_jml = $this->m_external->jumlah_record_filter_select($iddet,$tabel_persen,$knds_cek);
if($cek_jml == 0){
  echo'<h4 style="font-weight:bold;text-align: center;">DATA SETING PERSEN MASIH KOSONG</h4>';
}else{
    $tbl_bulanan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_semua,$kndsbln,'YEAR('.$tgl_item.')');
    foreach($tbl_bulanan as $rowkat){
    $bln = date('m',strtotime($rowkat[$tgl_item]));
    $thn = date('Y',strtotime($rowkat[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowkat[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = 12;
    $akhir  = $ketbulan.'-'.$tglakhir;
    //======================================= foreach($tbl_bulanan)
  ?>
      <h4 class="box-title">Tahun <?= $thn ?></h4>
      <table width="100%" class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Indikator</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Target</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Poin Mutu</th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $this->m_rancak->getBulan($number) ?></th>
    <?php
      }
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">JML</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">%</th>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $tbl_grup_kp = $this->m_external->ambil_isi_persen($iddet,$tabel_persen,$selectpersen,$kndspersen);
        foreach($tbl_grup_kp as $row){
          $no++;
    ?>
          <tr>
<td rowspan="2" style="font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center;width: 7%;"><?= $no ?></td>
<td rowspan="2" style="position: sticky;font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$nama_kat_lv1] ?></td>
<td rowspan="2" style="position: sticky;font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:center"><?= $row[$target_persen] ?></td>
<td style="font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$xas_nama_persen] ?></td>
            <?php
// ================== 1            
            $jmlx = 0;
            //$qy = 0;$qx=0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $thn.'-'.sprintf("%02d", $numbers);
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$tglenya,$Kat_lv2=>$row[$xas_persen]);
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
              if($jml == 0){    
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
            <?php
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahx");
                $kndspersn = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv2=>$row[$xas_persen]);
        $qx = $this->m_external->total_range_tabel_persen($iddet,$tabel_item,$jml_item,$kndspersn,$Kat_lv2);
        $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
                foreach($q as $row2){
                  $jmlx = $jmlx + $row2['jumlahx'];
            ?>
          <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahx'],0) ?>        </td>
            <?php
                }
              }
            }
// ================== !1            
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmlx,0) ?></td>
            <td style="font-size: 0.8em;font-weight:bold;border-bottom: 0;border-right: 1px solid black;vertical-align:middle;text-align:center">&nbsp;</td>
            <?php 
              $tbl_prsn = $this->m_external->ambil_isi_persen($iddet,$tabel_persen,$selectpersen,$kndspersen);
            ?>
          </tr>
          <tr>
<td style="font-size: 0.8em;border: 1px solid black;vertical-align:middle;text-align:left"><?= $row[$yas_nama_persen] ?></td>
            <?php
// ================== 2            
            $jmly = 0;
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $thn.'-'.sprintf("%02d", $numbers);
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$tglenya,$Kat_lv2=>$row[$yas_persen]);
        $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_semua,$kndsjml);
              if($jml == 0){    
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
            <?php
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahy");
        $kndspersn = array($tgl_item.' >='=>$tgl_awal,$tgl_item.' <='=>$tgl_akhir,$ins=>$idinst,$Kat_lv2=>$row[$yas_persen]);
        $qy = $this->m_external->total_range_tabel_persen($iddet,$tabel_item,$jml_item,$kndspersn,$Kat_lv2);
        if ($qy <= 0) $qy = 1;
        $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
                foreach($q as $row2){
                  $jmly = $jmly + $row2['jumlahy'];
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahy'],0) ?>
            </td>
            <?php
                }
              }
            }
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($jmly,0) ?></td>
            <td style="font-size: 0.8em;font-weight:bold;border-top:0;border-right: 1px solid black;border-bottom: 1px solid black;vertical-align:top;text-align:center"><?= number_format($qx/$qy*100,2) ?>%
            </td>
          </tr> 
    <?php
        }
// ================== !2 
    ?>
        </tbody>
      </table>    
    <?php 
    //======================================= !foreach($tbl_bulanan)
    }
  }
//======================================= !TABEL= 16 AND $cek_jml
}
else{
  ?>
               <div id="chartdiv"></div>
                <div id="legenddiv"></div>
  <?php
}
} //iddet
//======================================= !col-sm-12
  ?>
        </div>
        <br style="line-height:2">
        <div class="col-sm-12 huruf-12">
          <?php 
            if(!empty($analisa_laporan_detil) || !empty($rekomendasi_laporan_detil)){
              if(!empty($judul_laporan_detil)){
          ?>
          <h4 style="font-weight:bold;text-align: left;"><?= $judul_laporan_detil ?></h4>
          <?php 
              }
            }
            if(!empty($analisa_laporan_detil)){
              $analisa_laporan_detil = strip_tags($analisa_laporan_detil); 
              $analisa_laporan_detil = html_entity_decode($analisa_laporan_detil);
              echo $analisa_laporan_detil.'<br style="line-height:2">';
            }
            if(!empty($rekomendasi_laporan_detil)){
              $rekomendasi_laporan_detil = strip_tags($rekomendasi_laporan_detil); 
              $rekomendasi_laporan_detil = html_entity_decode($rekomendasi_laporan_detil);
              echo $rekomendasi_laporan_detil;
            }
          ?>
        </div>
      </div>
      <?php 
        if($button== 1){
      ?>
    <div class="row no-print">
    <section class="invoice">
        <div class="row invoice-info">
          <h4 style="font-weight:bold;">TABEL DAN GRAFIK LAINNYA</h4>
        <?php
            foreach($ambil_tabel as $rowambil_tabel){
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/'.$page.'/view/'.$rowambil_tabel['id_laporan'].'/'.$rowambil_tabel['id_laporan_detil']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"><i class="fa fa-line-chart"></i> <?= $rowambil_tabel['judul_laporan_detil'] ?>
            </a>
          </div>
          <?php
            }
          ?>
        </div>
    </section>
    </div>
      <?php 
        }
      ?>
    <!-- /.content -->
    <div class="clearfix"></div>
  </section> <!-- //======================================= !invoice -->
</div> <!-- //======================================= !content-wrapper -->
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
<div class="content-wrapper"> <!-- //======================================= content-wrapper -->
  <section class="invoice"> <!-- //======================================= invoice -->
      <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
          <h4 style="font-weight:bold;text-align: center;"><?= $header_laporan ?></h4>
          <h4 style="font-weight:bold;text-align: center;"><?= $sub_header_laporan ?></h4>
          <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header_laporan ?></h4>
        </div><br style="line-height:2">
    </div><br style="line-height:2">
    <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
          <table class="table no-border">
              <tbody>
                <?php  
                  if(!empty($judul_laporan)){
                ?>
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                  <td style="width:25%;">Judul</td>
                  <td style="width:3%;text-align: center;">:</td>
                  <td><?= $judul_laporan ?></td>
                </tr>
                <?php  
                  }
                  if(!empty($tujuan_laporan)){
                    $tujuan_laporan = strip_tags($tujuan_laporan); 
                    $tujuan_laporan = html_entity_decode($tujuan_laporan);
                ?>    
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Tujuan</td>
                  <td style="text-align: center;">:</td>
                  <td><?= $tujuan_laporan ?></td>
                </tr>
                <?php  
                  }
                  if(!empty($periode_laporan)){
                ?>
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Periode Analisis dan Pelaporan Data</td>
                  <td style="text-align: center;">:</td>
                  <td><?= $periode_laporan ?></td>
                </tr>
                <?php  
                  }
                  if(!empty($sumber_laporan)){
                ?>
                <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Sumber Data</td>
                  <td style="text-align: center;">:</td>
                  <td><?= $sumber_laporan ?></td>
                </tr>
                <?php  
                  }
                ?>
               <tr>
                  <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <td>Pengambil Data</td>
                  <td style="text-align: center;">:</td>
                  <td><?= strtoupper($aran_pegawai) ?></td>
                </tr>
              </tbody>
          </table>
        </div>
        <div class="col-sm-12 huruf-12">
  <?php
//======================================= col-sm-12
if($iddet){
if($tabel == 1){
//======================================= TABEL= 1
  if($periode_laporan_detil == 1){
 //======================================= $periode_laporan_detil == 1 / HARIAN
    foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
    $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
    $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;
  ?>

  <?php 
    $tbl_harian = $this->m_external->ambil_isi($iddet,$tabel_item,$select_all,$kndsbln,$Kat_lv1);
    foreach($tbl_harian as $rowkat){
    //======================================= foreach($tbl_harian)
  ?>
      <h4 class="box-title">Indikator : <?= $rowkat[$nama_kat_lv1] ?></h4>
      <table class="table table-responsive">
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
        </tr>
        </thead>
        <tbody>   
    <?php 
        $no = 0;
        $tbl_grup = $this->m_external->ambil_isi($iddet,$tabel_item,$select_all,$kndsbln,$Kat_lv2);
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
              <?= $row['nama_eq_detil'] ?>                      
            </td>
            <?php
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $ketbulan.'-'.$numbers;
              $kndsjml = array($ins=>$idinst,$tgl_item=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
              $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_all,$kndsjml);
              if($jml == 0){    
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
            <?php
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
                $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
                foreach($q as $row2){
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
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
  <?php 
    //======================================= !foreach($tbl_harian)
    }
  ?>

  <?php
   //======================================= !foreach($ambil_bulan)
    }
 //======================================= !$periode_laporan_detil == 1 / HARIAN
  }
  if($periode_laporan_detil == 2){
 //======================================= $periode_laporan_detil == 2 / BULANAN
    foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
    $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
    $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = 12;
    $akhir  = $ketbulan.'-'.$tglakhir;
  ?>

  <?php 
    $tbl_bulanan = $this->m_external->ambil_isi($iddet,$tabel_item,$select_all,$kndsbln,$Kat_lv1);
    foreach($tbl_bulanan as $rowkat){
    //======================================= foreach($tbl_bulanan)
  ?>
      <h4 class="box-title">Indikator : <?= $rowkat[$nama_kat_lv1] ?></h4>
      <table class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Nama</th>
    <?php
      foreach (range(1, $tglakhir) as $number) {           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= $this->m_rancak->getBulan($number) ?></th>
    <?php
      }
    ?>
        </tr>
        </thead>
        <tbody>
    <?php 
        $no = 0;
        $tbl_grup = $this->m_external->ambil_isi($iddet,$tabel_item,$select_all,$kndsbln,$Kat_lv2);
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
              <?= $row['nama_eq_detil'] ?>                      
            </td>
            <?php
            foreach (range(1, $tglakhir) as $numbers) {
              $tglenya  = $thn.'-'.sprintf("%02d", $numbers);
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
            //  $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%m")'=>date('Y-m',strtotime($bln)),'DATE_FORMAT('.$tgl_item.',"%Y")'=>date('Y-m',strtotime($thn)),$Kat_lv2=>$row[$id_kat_lv2]);
              $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_all,$kndsjml);
              if($jml == 0){    
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
            <?php
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
                $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
                foreach($q as $row2){
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
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
    <?php 
    //======================================= !foreach($tbl_bulanan)
    }
  ?>

<?php
   //======================================= !foreach($ambil_bulan)
    }
 //======================================= !$periode_laporan_detil == 2 / BULANAN
  }
  if($periode_laporan_detil == 3){
 //======================================= $periode_laporan_detil == 3 / TAHUNAN
//    foreach($ambil_bulan as $rowambil_bulan){
  //======================================= foreach($ambil_bulan)
/*    $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
    $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
    $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
    $awal = $ketbulan.'-01';
    $tglakhir = date('t', strtotime($awal));
    $akhir  = $ketbulan.'-'.$tglakhir;*/
  ?>

  <?php 
  //  $tbl_harian = $this->m_external->ambil_isi($iddet,$tabel_item,$select_all,$kndsbln,$Kat_lv1);
  //  foreach($ambil_bulan as $rowkat){
    //======================================= foreach($tbl_harian)
  ?>
      <h4 class="box-title">Indikator : <?= $rowkat[$nama_kat_lv1] ?></h4>
      <table class="table table-responsive">
        <thead>
        <tr class="bg-dark">
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Nama</th>
    <?php
      foreach($ambil_bulan as $rowkat){           
    ?>
          <th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;"><?= date('Y',strtotime($rowkat[$tgl_item])); ?></th>
    <?php
      }
    ?>
        </tr>
        </thead>
        <tbody>   
    <?php 
        $no = 0;
        $tbl_grup = $this->m_external->ambil_isi($iddet,$tabel_item,$select_all,$kndsbln,$Kat_lv2);
        foreach($tbl_grup as $row){
          $no++;
    ?>
          <tr>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $no ?></td>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
              <?= $row['nama_eq_detil'] ?>                      
            </td>
            <?php
            foreach($ambil_bulan as $row){ 
              $tglenya  = date('Y',strtotime($row[$tgl_item]));
              $kndsjml = array($ins=>$idinst,'DATE_FORMAT('.$tgl_item.',"%Y")'=>$tglenya,$Kat_lv2=>$row[$id_kat_lv2]);
              $jml = $this->m_external->jumlah_sumber_data($iddet,$tabel_item,$select_all,$kndsjml);
              if($jml == 0){    
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
            <?php
              }else{
                $slcjml = ("sum(".$jml_item.") as jumlahe");
                $q = $this->m_external->total_sumber_data($iddet,$tabel_item,$slcjml,$kndsjml);
                foreach($q as $row2){
            ?>
            <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($row2['jumlahe'],0) ?>
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
  <?php 
    //======================================= !foreach($tbl_harian)
  //  }
  ?>

  <?php
   //======================================= !foreach($ambil_bulan)
 //   }
 //======================================= !$periode_laporan_detil == 3 / TAHUNAN
  }
//======================================= !TABEL= 1
}else{
  ?>
               <div id="chartdiv"></div>
                <div id="legenddiv"></div>
  <?php
}
} //iddet
//======================================= !col-sm-12
  ?>
        </div>
        <br style="line-height:2">
        <div class="col-sm-12 huruf-12">
          <?php 
            if(!empty($analisa_laporan_detil) || !empty($rekomendasi_laporan_detil)){
              if(!empty($judul_laporan_detil)){
          ?>
          <h4 style="font-weight:bold;text-align: left;"><?= $judul_laporan_detil ?></h4>
          <?php 
              }
            }
            if(!empty($analisa_laporan_detil)){
              $analisa_laporan_detil = strip_tags($analisa_laporan_detil); 
              $analisa_laporan_detil = html_entity_decode($analisa_laporan_detil);
              echo $analisa_laporan_detil.'<br style="line-height:2">';
            }
            if(!empty($rekomendasi_laporan_detil)){
              $rekomendasi_laporan_detil = strip_tags($rekomendasi_laporan_detil); 
              $rekomendasi_laporan_detil = html_entity_decode($rekomendasi_laporan_detil);
              echo $rekomendasi_laporan_detil;
            }
          ?>
        </div>
      </div>
      <?php 
        if($button== 1){
      ?>
    <div class="row no-print">
    <section class="invoice">
        <div class="row invoice-info">
          <h4 style="font-weight:bold;">TABEL DAN GRAFIK LAINNYA</h4>
        <?php
            foreach($ambil_tabel as $rowambil_tabel){
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/imut/view/'.$rowambil_tabel['id_laporan'].'/'.$rowambil_tabel['id_laporan_detil']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"><i class="fa fa-line-chart"></i> <?= $rowambil_tabel['judul_laporan_detil'] ?>
            </a>
          </div>
          <?php
            }
          ?>
        </div>
    </section>
    </div>
      <?php 
        }
      ?>
    <!-- /.content -->
    <div class="clearfix"></div>
  </section> <!-- //======================================= !invoice -->
</div> <!-- //======================================= !content-wrapper -->
<?php
}
elseif ($page=="forward")
{  
?>
  <div class="content-wrapper">
    <section class="invoice">
        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
            <h4 style="font-weight:bold;text-align: center;"><?= $header_laporan ?></h4>
            <h4 style="font-weight:bold;text-align: center;"><?= $sub_header_laporan ?></h4>
            <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header_laporan ?></h4>
          </div><br style="line-height:2">
          <div class="col-sm-12 huruf-12">
                <table class="table no-border">
                    <tbody>
                      <?php  
                        if(!empty($judul_laporan)){
                      ?>
                      <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                        <td style="width:25%;">Judul</td>
                        <td style="width:3%;text-align: center;">:</td>
                        <td><?= $judul_laporan ?></td>
                      </tr>
                      <?php  
                        }
                        if(!empty($tujuan_laporan)){
                          $tujuan_laporan = strip_tags($tujuan_laporan); 
                          $tujuan_laporan = html_entity_decode($tujuan_laporan);
                      ?>    
                      <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                        <td>Tujuan</td>
                        <td style="text-align: center;">:</td>
                        <td><?= $tujuan_laporan ?></td>
                      </tr>
                      <?php  
                        }
                        if(!empty($periode_laporan)){
                      ?>
                      <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                        <td>Periode Analisis dan Pelaporan Data</td>
                        <td style="text-align: center;">:</td>
                        <td><?= $periode_laporan ?></td>
                      </tr>
                      <?php  
                        }
                        if(!empty($sumber_laporan)){
                      ?>
                      <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                        <td>Sumber Data</td>
                        <td style="text-align: center;">:</td>
                        <td><?= $sumber_laporan ?></td>
                      </tr>
                      <?php  
                        }
                      ?>
                     <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                        <td>Pengambil Data</td>
                        <td style="text-align: center;">:</td>
                        <td><?= strtoupper($aran_pegawai) ?></td>
                      </tr>
                    </tbody>
                </table>
          </div>
          <br style="line-height:2">
          <div class="col-sm-12 huruf-12">
                  <?php 
                    if(!empty($analisa_laporan_tabel) || !empty($rekomendasi_laporan_tabel)){
                  ?>
                  <h4 style="font-weight:bold;text-align: center;">PEMBAHASAN ANALISA DAN REKOMENDASI</h4>
                  <table class="table no-border">
                      <tbody>
                        <?php  
                          if(!empty($judul_laporan_tabel)){
                        ?>
                        <tr>
                          <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                          <td style="width:25%;">Judul</td>
                          <td style="width:3%;text-align: center;">:</td>
                          <td><?= $judul_laporan_tabel ?></td>
                        </tr>
                        <?php  
                          }
                          if(!empty($analisa_laporan_tabel)){
                            $analisa_laporan_tabel = strip_tags($analisa_laporan_tabel); 
                            $analisa_laporan_tabel = html_entity_decode($analisa_laporan_tabel);
                        ?>    
                        <tr>
                          <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                          <td>Tujuan</td>
                          <td style="text-align: center;">:</td>
                          <td><?= $analisa_laporan_tabel ?></td>
                        </tr>
                        <?php  
                          }
                          if(!empty($rekomendasi_laporan_tabel)){
                            $rekomendasi_laporan_tabel = strip_tags($rekomendasi_laporan_tabel); 
                            $rekomendasi_laporan_tabel = html_entity_decode($rekomendasi_laporan_tabel);
                        ?>    
                        <tr>
                          <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                          <td>Tujuan</td>
                          <td style="text-align: center;">:</td>
                          <td><?= $rekomendasi_laporan_tabel ?></td>
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
          <div class="col-sm-12 huruf-12">
            <?php  
      if($idtab){
    // =================================================================
        if($tabel == 1){
      // ============================= $tabel == 1 ====================================
          if($lhu == 1 || $lhu == 4 || $lhu == 5){
          //      if($show_pdf == 1){
              ?>
          <a  href="<?php echo base_url('ol_laporan/tabel/pdf_logbook/'.$idlap.'/'.$idtab); ?>" target="_blank" class="btn btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>">
            <i class="fa fa-file-pdf-o"></i> PRINT PDF
          </a><br><br>
              <?php
           //     }
            foreach($ambil_bulan as $rowambil_bulan){
            $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
            $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
            $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
            $awal = $ketbulan.'-01';
            $tglakhir = date('t', strtotime($awal));
            $akhir  = $ketbulan.'-'.$tglakhir;
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
            <div class="box-body">
              <?php  
              if($lhu == 4 && $qc_self == 0){
                $kondisi_groupkat = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$ins=>$idinst);
              }elseif($lhu == 5){
                $kondisi_groupkat = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$ins=>$idinst);
              }
              else{
                $kondisi_groupkat = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$id_peg=>$pegawai,$ins=>$idinst);
              }
          $ambil_lhu_grupkat = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$select_all,$kondisi_groupkat,$lhu,$kat_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$kat_item);
              foreach($ambil_lhu_grupkat as $rowkat){            
              ?>
              <h3 class="box-title"><?= $rowkat[$nama_kat] ?></h3>
                <table class="table table-responsive">
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
                      if($lhu == 4 && $qc_self == 0){
                        $kondisi_group = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$kat_item=>$rowkat[$ins_item],$ins=>$idinst);
                      }elseif($lhu == 5){
                        $kondisi_group = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$kat_item=>$rowkat[$ins_item],$ins=>$idinst);
                      }
                      else{
                        $kondisi_group = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$kat_item=>$rowkat[$ins_item],$id_peg=>$pegawai,$ins=>$idinst);
                      }
                    $ambil_lhu_grup = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$select_all,$kondisi_group,$lhu,$order,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
                      foreach($ambil_lhu_grup as $row){
                        $no++;
                    ?>
                  <tr>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $no; ?></td>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
                      <?php 
                      if($lhu == 4){
                        echo $row[$nama_item1].' <b>['.$row[$nama_item2].']</b>';
                      }else{
                        echo $row[$nama_item];
                      }
                      ?>                      
                    </td>
                    <?php   $hitung_dewek=0;$jml4=0;
                    foreach (range(1, $tglakhir) as $numbers) {
                      $tglenya  = $ketbulan.'-'.$numbers;
                      if($lhu == 4 && $qc_self == 0){
                        $kondisi_jml = array($tgl_item=>$tglenya,$ins=>$idinst,$grup_item=>$row[$id_item]);
                        $select_jml = $select_all;
                      }else{
                        $kondisi_jml = array($tgl_item=>$tglenya,$id_peg=>$pegawai,$ins=>$idinst,$grup_item=>$row[$id_item]);
                        $select_jml = $selectgrup;
                      }
                    $jml = $this->m_ol_laporan->jumlah_sumber_data($idtab,$tabel_item,$kondisi_jml,$lhu,$jml_isi,$arr_isi,$jml_seting,$arr_seting);
                      if($jml == 0){    
                    ?>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
                    <?php
                      }else{
                        $q = $this->m_ol_laporan->total_sumber_data($idtab,$tabel_item,$select_jml,$kondisi_jml,$lhu,$jml_isi,$arr_isi,$jml_seting,$arr_seting);
                        foreach($q as $row2){
                      if($lhu == 4){
                        $jml4++;
                        $hitung_dewek = $jml4;
                      }else{
                        $hitung_dewek = $hitung_dewek + $row2[$sumeas];
                      }
                    ?>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color:grey;color: white;">
                      <?php 
                      if($lhu == 1){
                        echo number_format($row2[$sumeas],0); 
                      }else{
                        echo number_format($row2[$jml_item],0); 
                      }
                      ?>
                    </td>
                    <?php
                        }
                      }
                    }
                    ?>
                    <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color:dimgrey;color: white;"><?php if($hitung_dewek != '-') echo number_format($hitung_dewek,0); ?></td>
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
            //============= !foreach($ambil_bulan as $rowambil_bulan){
            }
            //============= !if($lhu == 1 || $lhu == 4 || $lhu == 5){
          }
          if($lhu == 7){
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
                Kategori : <?= $rowambil_str['nama_berkas_kategori'] ?><br>
                No Surat Ijin : <?= $rowambil_str['no_berkas'] ?><br>
                Berlaku Mulai : <?= date('d-m-Y',strtotime($rowambil_str['tgl_a_berkas'])) ?> s/d 
                <?php 
                  if($rowambil_str['lifetime_berkas'] == 1){
                  echo "Seumur Hidup";
                  }else{
                  echo date('d-m-Y',strtotime($rowambil_str['tgl_b_berkas']));
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
        //=========================================================== !lhu = 7
          }
          if($lhu == 8){
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
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width:15%;">Waktu</th>
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nama</th>
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width: 20%;">Hasil</th>
                  <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width: 20%;">Kesimpulan</th>
                  </tr>
                </thead>
                <tbody>  
                  <?php  
                  $no =0;
                  foreach($ambil_lhu as $rowgrup){
                  $no++;
                  ?>
                    <tr>
                      <td style="text-align: center;"><h5><?= $no ?></h5></td>
                      <td colspan="2">
                        <h5>Nama Even : <?= $rowgrup['nama_even'] ?></h5>
                        <h5>Lokasi : <?= $rowgrup['alamat_even'] ?></h5>
                        <h5>Waktu : <?= date('d-m-Y',strtotime($rowgrup['tgl_even']))  ?> <?= $rowgrup['time_even'] ?></h5>
  
                      </td>
                      <td colspan="2">
                        <h5>Peserta :</h5>
                        <ol>
                          <?php 
                            $ambpeserta = $this->m_umum->ambil_data_explode('ol_pegawai','barcode_pegawai',$rowgrup['peserta_even']);
                            foreach($ambpeserta as $rowambpeserta){
                          ?>
                            <li style="margin-left: 27px; float:left;"> &nbsp;&nbsp;<?= $rowambpeserta['nama_pegawai'] ?></li>
                          <?php } ?>
                          <div style="clear:both"></div>
                        </ol>
                      </td>
                    </tr>
                    <tr>
                      <td style="vertical-align:middle;text-align: left;font-weight: bold;">&nbsp;</td>
                      <td colspan="4" style="vertical-align:middle;text-align: left;font-weight: bold;">DETAIL EVEN</td>
                    </tr>
                          <?php 
                            $kondisidet = array('id_even'=>$rowgrup['id_even']);
                            $ambdetail = $this->m_umum->ambil_data_kondisi_result('abs_even_detil',$kondisidet);
                            foreach($ambdetail as $rowambdetail){
                          ?>
                    <tr>
                      <td style="vertical-align:middle;text-align: center;">&nbsp;</td>
                      <td style="vertical-align:middle;text-align: center;vertical-align: middle;"><h5><?= date('d-m-Y',strtotime($rowambdetail['tgl_even_detil']))  ?> <?= $rowambdetail['time_even_detil'] ?></h5></td>
                      <td>
                        <h5>Nama Sub Even : <?= $rowambdetail['nama_even_detil'] ?></h5>
                        <h5>Pembicara : <?= $rowambdetail['speaker_even_detil'] ?></h5>
                      </td>
                      <td><?= $rowambdetail['hasil_even_detil'] ?></td>
                      <td><?= $rowambdetail['kesimpulan_even_detil'] ?></td>
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
        //=========================================================== !lhu = 8
          }
        ?>
    <?php
        }else
        // ============================= !$tabel == 1 ====================================
        if($tabel == 14){
        // ============================= $tabel == 14 ====================================
          if($lhu == 1 || $lhu == 4 || $lhu == 5 || $lhu == 7){
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
                  $no =0;
                  $jmle =0;
                  foreach($grup_lhu as $rowgrup){
                  $jmle = $jmle + $rowgrup[$jml_item];
                  $no++;
                  ?>
                    <tr>
                      <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
                      <td><?= $rowgrup[$nama_item1] ?> [<b><?= $rowgrup[$nama_item2] ?></b>]</td>
                      <td style="vertical-align:middle;text-align: center;"><?= round($rowgrup[$jml_item],3) ?></td>
                    </tr>
                <?php  
                  }
                ?>
                </tbody>
              </table> 
            </div>
          </div>
    <?php
        // ============================= !if($lhu == 1 || $lhu == 4 || $lhu == 5 || $lhu == 7) ====================================
          }
        // ============================= !$tabel == 14 ====================================
        }else{
        //============================================================================ ELSE GRAFIK ============================= 
    ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">GRAFIK</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
               <div id="chartdiv"></div>
                <div id="legenddiv"></div>
            </div>
          </div> 
        <?php //============================================================================ ! ELSE GRAFIK ============================= 
            } 
          }
        ?>
          </div>
      </div>
          <br style="line-height:2">
    </section>
      <?php 
        if($sub== 1){
      ?>
    <div class="row no-print">
    <section class="invoice">
        <div class="row invoice-info">
          <h3 style="font-weight:bold;">TABEL DAN GRAFIK LAINNYA</h3>
        <?php
            foreach($ambil_tabel as $rowambil_tabel){
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/forward/view/'.$rowambil_tabel['id_laporan'].'/'.$rowambil_tabel['id_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"><i class="fa fa-line-chart"></i> <?= $rowambil_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
        </div>
    </section>
    </div>
      <?php 
        }
      ?>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}
elseif ($page=="laporan")
{  
?>
  <div class="content-wrapper">
    <section class="invoice">
        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
            <h4 style="font-weight:bold;text-align: center;"><?= $header_laporan ?></h4>
            <h4 style="font-weight:bold;text-align: center;"><?= $sub_header_laporan ?></h4>
            <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header_laporan ?></h4>
          </div><br style="line-height:2">
          <div class="col-sm-12 huruf-12">
                <table class="table no-border">
                    <tbody>
                      <?php  
                        if(!empty($judul_laporan)){
                      ?>
                      <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                        <td style="width:25%;">Judul</td>
                        <td style="width:3%;text-align: center;">:</td>
                        <td><?= $judul_laporan ?></td>
                      </tr>
                      <?php  
                        }
                        if(!empty($tujuan_laporan)){
                          $tujuan_laporan = strip_tags($tujuan_laporan); 
                          $tujuan_laporan = html_entity_decode($tujuan_laporan);
                      ?>    
                      <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                        <td>Tujuan</td>
                        <td style="text-align: center;">:</td>
                        <td><?= $tujuan_laporan ?></td>
                      </tr>
                      <?php  
                        }
                        if(!empty($periode_laporan)){
                      ?>
                      <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                        <td>Periode Analisis dan Pelaporan Data</td>
                        <td style="text-align: center;">:</td>
                        <td><?= $periode_laporan ?></td>
                      </tr>
                      <?php  
                        }
                        if(!empty($sumber_laporan)){
                      ?>
                      <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                        <td>Sumber Data</td>
                        <td style="text-align: center;">:</td>
                        <td><?= $sumber_laporan ?></td>
                      </tr>
                      <?php  
                        }
                      ?>
                     <tr>
                        <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                        <td>Pengambil Data</td>
                        <td style="text-align: center;">:</td>
                        <td><?= strtoupper($aran_pegawai) ?></td>
                      </tr>
                    </tbody>
                </table>
          </div>
          <br style="line-height:2">
          <div class="col-sm-12 huruf-12">
                  <?php 
                    if(!empty($analisa_laporan_tabel) || !empty($rekomendasi_laporan_tabel)){
                  ?>
                  <h4 style="font-weight:bold;text-align: center;">PEMBAHASAN ANALISA DAN REKOMENDASI</h4>
                  <table class="table no-border">
                      <tbody>
                        <?php  
                          if(!empty($judul_laporan_tabel)){
                        ?>
                        <tr>
                          <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                          <td style="width:25%;">Judul</td>
                          <td style="width:3%;text-align: center;">:</td>
                          <td><?= $judul_laporan_tabel ?></td>
                        </tr>
                        <?php  
                          }
                          if(!empty($analisa_laporan_tabel)){
                            $analisa_laporan_tabel = strip_tags($analisa_laporan_tabel); 
                            $analisa_laporan_tabel = html_entity_decode($analisa_laporan_tabel);
                        ?>    
                        <tr>
                          <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                          <td>Tujuan</td>
                          <td style="text-align: center;">:</td>
                          <td><?= $analisa_laporan_tabel ?></td>
                        </tr>
                        <?php  
                          }
                          if(!empty($rekomendasi_laporan_tabel)){
                            $rekomendasi_laporan_tabel = strip_tags($rekomendasi_laporan_tabel); 
                            $rekomendasi_laporan_tabel = html_entity_decode($rekomendasi_laporan_tabel);
                        ?>    
                        <tr>
                          <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                          <td>Tujuan</td>
                          <td style="text-align: center;">:</td>
                          <td><?= $rekomendasi_laporan_tabel ?></td>
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
          <div class="col-sm-12">
                <?php 
                    // ================================================================= col-sm-12 huruf-12
                      if($tabel == 1){
                    // ============================= $tabel == 1 ====================================
                        if($lhu == 1 || $lhu == 4 || $lhu == 5){
                          // ============================= $lhu == 1 || $lhu == 4 || $lhu == 5 ====================================
                            foreach($ambil_bulan as $rowambil_bulan){
                              // ============================= foreach($ambil_bulan as $rowambil_bulan) ====================================
                            $bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
                            $thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
                            $ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
                            $awal = $ketbulan.'-01';
                            $tglakhir = date('t', strtotime($awal));
                            $akhir  = $ketbulan.'-'.$tglakhir;
                  ?>
                   <h3>DATA TABEL PERIODE BULAN : <?= $this->m_rancak->getBulan($bln) ?> &nbsp;TAHUN : <?= $thn ?> </h3>
              <?php  
              if($lhu == 4 && $qc_self == 0){
                $kondisi_groupkat = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$ins=>$idinst);
              }elseif($lhu == 5){
                $kondisi_groupkat = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$ins=>$idinst);
              }
              else{
                $kondisi_groupkat = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$id_peg=>$pegawai,$ins=>$idinst);
              }
              $ambil_lhu_grupkat = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$select1,$kondisi_groupkat,$lhu,$kat_item,'asc',$kat_item);
              foreach($ambil_lhu_grupkat as $rowkat){            
              ?>
              <h3 class="box-title"><?= $rowkat[$nama_kat] ?></h3>
                    <table class="table table-responsive">
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
                      if($lhu == 4 && $qc_self == 0){
                        $kondisi_group = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$kat_item=>$rowkat[$ins_item],$ins=>$idinst);
                      }elseif($lhu == 5){
                        $kondisi_group = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$kat_item=>$rowkat[$ins_item],$ins=>$idinst);
                      }
                      else{
                        $kondisi_group = array('DATE_FORMAT('.$tgl_item.',"%Y-%m")'=>$ketbulan,$kat_item=>$rowkat[$ins_item],$id_peg=>$pegawai,$ins=>$idinst);
                      }
                    $ambil_lhu_grup = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$select1,$kondisi_group,$lhu,$order,'asc',$grup_item);
                      foreach($ambil_lhu_grup as $row){
                        $no++;
                        ?>
                      <tr>
                        <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $no; ?></td>
                        <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left">
                          <?php 
                          if($lhu == 4){
                            echo $row[$nama_item1].' <b>['.$row[$nama_item2].']</b>';
                          }else{
                            echo $row[$nama_item];
                          }
                          ?>                      
                        </td>
                        <?php   $hitung_dewek=0;$jml4=0;
                        foreach (range(1, $tglakhir) as $numbers) {
                          $tglenya  = $ketbulan.'-'.$numbers;
                          if($lhu == 4 && $qc_self == 0){
                            $kondisi_jml = array($tgl_item=>$tglenya,$ins=>$idinst,$grup_item=>$row[$id_item]);
                            $select_jml = $select1;
                          }else{
                            $kondisi_jml = array($tgl_item=>$tglenya,$id_peg=>$pegawai,$ins=>$idinst,$grup_item=>$row[$id_item]);
                            $select_jml = $selectgrup;
                          }
                        $jml = $this->m_ol_laporan->jumlah_sumber_data($idtab,$tabel_item,$kondisi_jml,$lhu);
                          if($jml == 0){    
                        ?>
                        <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
                        <?php
                          }else{
                            $q = $this->m_ol_laporan->total_sumber_data($idtab,$tabel_item,$select_jml,$kondisi_jml,$lhu);
                            foreach($q as $row2){
                          if($lhu == 4){
                            $jml4++;
                            $hitung_dewek = $jml4;
                          }else{
                            $hitung_dewek = $hitung_dewek + $row2[$sumeas];
                          }
                        ?>
                        <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color:grey;color: white;">
                          <?php 
                          if($lhu == 1){
                            echo number_format($row2[$sumeas],0); 
                          }else{
                            echo number_format($row2[$jml_item],0); 
                          }
                          ?>
                        </td>
                        <?php
                            }
                          }
                        }
                        ?>
                        <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color:dimgrey;color: white;"><?php if($hitung_dewek != '-') echo number_format($hitung_dewek,0); ?></td>
                      </tr> 
                        <?php
                          }
                        ?>
                      </tbody>
                    </table> 
                <?php
                            }
                             // ============================= !foreach($ambil_bulan as $rowambil_bulan) ====================================
                          }
                          // ============================= !$lhu == 1 || $lhu == 4 || $lhu == 5 ====================================
                        }
                        if($lhu == 7){
                          // ============================= $lhu == 7 ====================================
                ?>
                          <div class="row no-print">
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
                              Kategori : <?= $rowambil_str['nama_berkas_kategori'] ?><br>
                              No Surat Ijin : <?= $rowambil_str['no_berkas'] ?><br>
                              Berlaku Mulai : <?= date('d-m-Y',strtotime($rowambil_str['tgl_a_berkas'])) ?> s/d 
                              <?php 
                                if($rowambil_str['lifetime_berkas'] == 1){
                                echo "Seumur Hidup";
                                }else{
                                echo date('d-m-Y',strtotime($rowambil_str['tgl_b_berkas']));
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
                <?php 
                          // ============================= !$lhu == 7 ====================================
                        }
                        if($lhu == 8){
                          // ============================= $lhu == 8 ====================================
                ?>
                            <table id="example2" width="100%" class="table table-bordered table-striped">
                              <thead>
                                <tr>                   
                                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width:2%;">No</th>
                                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width:15%;">Waktu</th>
                                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;">Nama</th>
                                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width: 20%;">Hasil</th>
                                <th style="background-color:#DC143C;color:white;vertical-align:middle;text-align: center;width: 20%;">Kesimpulan</th>
                                </tr>
                              </thead>
                              <tbody>  
                                <?php  
                                $no =0;
                                foreach($ambil_lhu as $rowgrup){
                                $no++;
                                ?>
                                  <tr>
                                    <td style="text-align: center;"><h5><?= $no ?></h5></td>
                                    <td colspan="2">
                                      <h5>Nama Even : <?= $rowgrup['nama_even'] ?></h5>
                                      <h5>Lokasi : <?= $rowgrup['alamat_even'] ?></h5>
                                      <h5>Waktu : <?= date('d-m-Y',strtotime($rowgrup['tgl_even']))  ?> <?= $rowgrup['time_even'] ?></h5>
                
                                    </td>
                                    <td colspan="2">
                                      <h5>Peserta :</h5>
                                      <ol>
                                        <?php 
                                          $ambpeserta = $this->m_umum->ambil_data_explode('ol_pegawai','barcode_pegawai',$rowgrup['peserta_even']);
                                          foreach($ambpeserta as $rowambpeserta){
                                        ?>
                                          <li style="margin-left: 27px; float:left;"> &nbsp;&nbsp;<?= $rowambpeserta['nama_pegawai'] ?></li>
                                        <?php } ?>
                                        <div style="clear:both"></div>
                                      </ol>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="vertical-align:middle;text-align: left;font-weight: bold;">&nbsp;</td>
                                    <td colspan="4" style="vertical-align:middle;text-align: left;font-weight: bold;">DETAIL EVEN</td>
                                  </tr>
                                        <?php 
                                          $kondisidet = array('id_even'=>$rowgrup['id_even']);
                                          $ambdetail = $this->m_umum->ambil_data_kondisi_result('abs_even_detil',$kondisidet);
                                          foreach($ambdetail as $rowambdetail){
                                        ?>
                                  <tr>
                                    <td style="vertical-align:middle;text-align: center;">&nbsp;</td>
                                    <td style="vertical-align:middle;text-align: center;vertical-align: middle;"><h5><?= date('d-m-Y',strtotime($rowambdetail['tgl_even_detil']))  ?> <?= $rowambdetail['time_even_detil'] ?></h5></td>
                                    <td>
                                      <h5>Nama Sub Even : <?= $rowambdetail['nama_even_detil'] ?></h5>
                                      <h5>Pembicara : <?= $rowambdetail['speaker_even_detil'] ?></h5>
                                    </td>
                                    <td><?= $rowambdetail['hasil_even_detil'] ?></td>
                                    <td><?= $rowambdetail['kesimpulan_even_detil'] ?></td>
                                  </tr>
                              <?php  
                                          }
                                }
                              ?>
                              </tbody>
                            </table> 
                <?php  
                          // ============================= !$lhu == 8 ====================================
                        }
                      // ============================= !$tabel == 1 ====================================
                      }
                      elseif($tabel == 14){
                        // ============================= $tabel == 14 ====================================
                        if($lhu == 1 || $lhu == 4 || $lhu == 5 || $lhu == 7){
                          // ============================= $lhu == 1 || $lhu == 4 || $lhu == 5 || $lhu == 7 ====================================
                ?>
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
                              $no =0;
                              $jmle =0;
                              foreach($grup_lhu as $rowgrup){
                              $jmle = $jmle + $rowgrup[$jml_item];
                              $no++;
                              ?>
                                <tr>
                                  <td style="vertical-align:middle;text-align: center;"><?= $no ?></td>
                                  <td><?= $rowgrup[$nama_item1] ?> [<b><?= $rowgrup[$nama_item2] ?></b>]</td>
                                  <td style="vertical-align:middle;text-align: center;"><?= round($rowgrup[$jml_item],3) ?></td>
                                </tr>
                            <?php  
                              }
                            ?>
                            </tbody>
                          </table> 
                <?php
                          // ============================= !$lhu == 1 || $lhu == 4 || $lhu == 5 || $lhu == 7 ====================================
                        }
                        // ============================= !$tabel == 14 ====================================
                      }else{
                        // ============================= else ====================================
                ?>
               <div id="chartdiv"></div>
                <div id="legenddiv"></div>
                <?php
                        // ============================= !else ====================================
                      }
                    // ================================================================= !col-sm-12 huruf-12
                ?>
          </div>
      </div>
          <br style="line-height:2">
    </section>
      <?php 
        if($sub== 1){
      ?>
    <div class="row no-print">
    <section class="invoice">
        <div class="row invoice-info">
          <h3 style="font-weight:bold;">TABEL DAN GRAFIK LAINNYA</h3>
        <?php
            foreach($ambil_tabel as $rowambil_tabel){
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/laporan/view/'.$rowambil_tabel['id_laporan'].'/'.$rowambil_tabel['id_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"><i class="fa fa-line-chart"></i> <?= $rowambil_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
        </div>
    </section>
    </div>
      <?php 
        }
      ?>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}
elseif ($page=="lihat_laporan")
{  
?>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
        <h4 style="font-weight:bold;text-align: center;"><?= $header_laporan ?></h4>
        <h4 style="font-weight:bold;text-align: center;"><?= $sub_header_laporan ?></h4>
        <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header_laporan ?></h4>
          </div><br style="line-height:2">
          <div class="col-sm-12 huruf-12">
            <table class="table no-border">
                <tbody>
                  <?php  
                    if(!empty($judul_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                    <td style="width:25%;">Judul</td>
                    <td style="width:3%;text-align: center;">:</td>
                    <td><?= $judul_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($tujuan_laporan)){
                      $tujuan_laporan = strip_tags($tujuan_laporan); 
                      $tujuan_laporan = html_entity_decode($tujuan_laporan);
                  ?>    
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Tujuan</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $tujuan_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($periode_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Periode Analisis dan Pelaporan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $periode_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($sumber_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Sumber Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $sumber_laporan ?></td>
                  </tr>
                  <?php  
                    }
                  ?>
                 <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Pengambil Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= strtoupper($aran_pegawai) ?></td>
                  </tr>
                </tbody>
            </table>
          </div><br style="line-height:2">
          <div class="col-sm-12 huruf-12">
        <?php 
          if(!empty($analisa_laporan_tabel) || !empty($rekomendasi_laporan_tabel)){
        ?>
       <h4 style="font-weight:bold;text-align: center;">PEMBAHASAN ANALISA DAN REKOMENDASI</h4>
            <table class="table no-border">
                <tbody>
                  <?php  
                    if(!empty($judul_laporan_tabel)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                    <td style="width:25%;">Judul</td>
                    <td style="width:3%;text-align: center;">:</td>
                    <td><?= $judul_laporan_tabel ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($analisa_laporan_tabel)){
                      $analisa_laporan_tabel = strip_tags($analisa_laporan_tabel); 
                      $analisa_laporan_tabel = html_entity_decode($analisa_laporan_tabel);
                  ?>    
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Tujuan</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $analisa_laporan_tabel ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($rekomendasi_laporan_tabel)){
                      $rekomendasi_laporan_tabel = strip_tags($rekomendasi_laporan_tabel); 
                      $rekomendasi_laporan_tabel = html_entity_decode($rekomendasi_laporan_tabel);
                  ?>    
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Tujuan</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $rekomendasi_laporan_tabel ?></td>
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
<br style="line-height:2">
        <div class="col-sm-12">   
          <?php 
if($tabel == 1 || $tabel == 14){
?>
<div class="box box-white box-solid">
  <div class="box-header with-border">
     <h3 class="box-title"><?= $judul_laporan_tabel ?></h3>
  </div>
  <div class="box-body">
<?php  
//================= BOX BODY ============================================================================
  if($tabel == 1){
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
      else{
        $bln = date('m',strtotime($rowambil_bulan['tgl_logbook']));
        $thn = date('Y',strtotime($rowambil_bulan['tgl_logbook']));
        $ketbulan = date('Y-m',strtotime($rowambil_bulan['tgl_logbook']));
        $awal = $ketbulan.'-01';
        $tglakhir = date('t', strtotime($awal));
        $akhir  = $ketbulan.'-'.$tglakhir;
      }  
?>
      <div class="box box-white box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">DATA TABEL PERIODE BULAN : <?= $this->m_rancak->getBulan($bln) ?> &nbsp;TAHUN : <?= $thn ?> </h3>
        </div>
        <div class="box-body table-responsive no-padding">
              <table class="table table-responsive">
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
                  <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;position:sticky;"><?php echo $no; ?></td>
                  <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left;position:sticky;"><?php echo $row['nama_kompetensi']; ?></td>
                  <?php   $hitung_dewek=0;
                  foreach (range(1, $tglakhir) as $numbers) {
                    $tglenya  = $ketbulan.'-'.$numbers;
                  if($lhu == 1){
                    $jml = $this->m_member->jumlah_record_logbook_laporan_kompetensi($id_pegawai,$tglenya,$row['id_kompetensi'],$id_instansi);
                  }
                    if($lhu == 4){
                      $jml = $this->m_member->jumlah_record_logbook_laporan_lhu($barcode_pegawai,$tglenya,$row['id_kompetensi'],$id_instansi);
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
                      $q = $this->m_member->total_record_logbook_laporan_lhu($barcode_pegawai,$tglenya,$row['id_kompetensi'],$id_instansi);
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
        </div>
      </div>
<?php
      }
    }
  }
  if($tabel == 14){
  ?>
        <div class="box box-white box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
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
//===========================================================================================
//================= ! BOX BODY ==========================================================================
?>
  </div>
</div>
<?php  
}
if($tabel == 15){
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
          ?>
             <div id="chartdiv"></div>
              <div id="legenddiv"></div> 
          <?php 
            }
          ?>
         </div> 
          <br style="line-height:2">
    </section>
    <div class="row no-print">
    <?php 
    //================================ row no-print
              if(!empty($berkasere)){
    ?>
    <section class="invoice">
        <div class="row invoice-info">
        <div class="col-md-12">
          <h3 style="font-weight:bold;">BERKAS_BERKAS</h3>
        </div>
    <?php
                foreach($all_berkas as $rowberkas){
                  if (in_array($rowberkas['id_berkas'],explode(',', $berkasere))) {
          ?>
          <?php 
            if(!empty($rowberkas['nama_berkas'])){
          ?>
        <div class="col-md-12">
          <h4 style="font-weight:bold;">Nama Berkas : <?= $rowberkas['nama_berkas'] ?></h4>
        </div>
          <?php 
            }
            if(!empty($rowberkas['no_berkas'])){
          ?>
        <div class="col-md-12">
          <h4 style="font-weight:bold;">No Berkas : <?= $rowberkas['no_berkas'] ?></h4>
        </div>
          <?php 
            }
          ?><hr>
          <br style="line-height:2">
        <div class="col-md-12">
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowberkas['link_berkas'] ?>" allowfullscreen></iframe>
</div>
        </div>

          <?php
                }
              }
          ?>
      </div>
    </section>
<?php
            }

              if($show_pdf == 1){
            ?> 
    <section class="invoice">
        <div class="row invoice-info">
        <div class="col-md-12">
          <h3 style="font-weight:bold;">DATA PASIEN</h3>
        </div>
        <div class="col-md-12">
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>external/lihat/pdf_logbook/<?= $id_laporan ?>/<?= $id_laporan_tabel ?>" allowfullscreen></iframe>
</div>
        </div>
      </div>
    </section>
          <?php  
            }
?>
    <section class="invoice">
        <div class="row invoice-info">
        <div class="col-md-12">
          <h3 style="font-weight:bold;">TABEL DAN GRAFIK LAINNYA</h3>
        </div>
        <?php
            foreach($ambil_tabel as $rowambil_tabel){
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/lihat/laporan/'.$rowambil_tabel['id_laporan'].'/'.$rowambil_tabel['id_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"><i class="fa fa-line-chart"></i> <?= $rowambil_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
        ?>
        </div>
    </section>
  </div>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}
elseif ($page=="lihat_tabel")
{
?>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
        <h4 style="font-weight:bold;text-align: center;"><?= $header_laporan ?></h4>
        <h4 style="font-weight:bold;text-align: center;"><?= $sub_header_laporan ?></h4>
        <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header_laporan ?></h4>
          </div><br style="line-height:2">
          <div class="col-sm-12 huruf-12">
            <table class="table no-border">
                <tbody>
                  <?php  
                    if(!empty($judul_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                    <td style="width:25%;">Judul</td>
                    <td style="width:3%;text-align: center;">:</td>
                    <td><?= $judul_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($tujuan_laporan)){
                      $tujuan_laporan = strip_tags($tujuan_laporan); 
                      $tujuan_laporan = html_entity_decode($tujuan_laporan);
                  ?>    
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Tujuan</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $tujuan_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($periode_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Periode Analisis dan Pelaporan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $periode_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($sumber_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Sumber Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $sumber_laporan ?></td>
                  </tr>
                  <?php  
                    }
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Pengambil Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= strtoupper($aran_pegawai) ?></td>
                  </tr>
                </tbody>
            </table>
          </div><br style="line-height:2">
          <div class="col-sm-12 huruf-12">
        <?php 
          if(!empty($analisa_laporan_tabel) || !empty($rekomendasi_laporan_tabel)){
        ?>
       <h4 style="font-weight:bold;text-align: center;">PEMBAHASAN ANALISA DAN REKOMENDASI</h4>
            <table class="table no-border">
                <tbody>
                  <?php  
                    if(!empty($judul_laporan_tabel)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                    <td style="width:25%;">Judul</td>
                    <td style="width:3%;text-align: center;">:</td>
                    <td><?= $judul_laporan_tabel ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($analisa_laporan_tabel)){
                      $analisa_laporan_tabel = strip_tags($analisa_laporan_tabel); 
                      $analisa_laporan_tabel = html_entity_decode($analisa_laporan_tabel);
                  ?>    
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Tujuan</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $analisa_laporan_tabel ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($rekomendasi_laporan_tabel)){
                      $rekomendasi_laporan_tabel = strip_tags($rekomendasi_laporan_tabel); 
                      $rekomendasi_laporan_tabel = html_entity_decode($rekomendasi_laporan_tabel);
                  ?>    
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Tujuan</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $rekomendasi_laporan_tabel ?></td>
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
        <div class="col-sm-12">   
          <?php 
if($tabel == 1 || $tabel == 14){
?>
<div class="box box-white box-solid">
  <div class="box-header with-border">
     <h3 class="box-title"><?= $judul_laporan_tabel ?></h3>
  </div>
  <div class="box-body">
<?php  
//================= BOX BODY ============================================================================
  if($tabel == 1){
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
      else{
        $bln = date('m',strtotime($rowambil_bulan['tgl_logbook']));
        $thn = date('Y',strtotime($rowambil_bulan['tgl_logbook']));
        $ketbulan = date('Y-m',strtotime($rowambil_bulan['tgl_logbook']));
        $awal = $ketbulan.'-01';
        $tglakhir = date('t', strtotime($awal));
        $akhir  = $ketbulan.'-'.$tglakhir;
      }  
?>
      <div class="box box-white box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">DATA TABEL PERIODE BULAN : <?= $this->m_rancak->getBulan($bln) ?> &nbsp;TAHUN : <?= $thn ?> </h3>
        </div>
        <div class="box-body table-responsive no-padding">
              <table class="table table-responsive">
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
                  <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;position:sticky;"><?php echo $no; ?></td>
                  <td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left;position:sticky;"><?php echo $row['nama_kompetensi']; ?></td>
                  <?php   $hitung_dewek=0;
                  foreach (range(1, $tglakhir) as $numbers) {
                    $tglenya  = $ketbulan.'-'.$numbers;
                  if($lhu == 1){
                    $jml = $this->m_member->jumlah_record_logbook_laporan_kompetensi($id_pegawai,$tglenya,$row['id_kompetensi'],$id_instansi);
                  }
                    if($lhu == 4){
                      $jml = $this->m_member->jumlah_record_logbook_laporan_lhu($barcode_pegawai,$tglenya,$row['id_kompetensi'],$id_instansi);
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
                      $q = $this->m_member->total_record_logbook_laporan_lhu($barcode_pegawai,$tglenya,$row['id_kompetensi'],$id_instansi);
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
        </div>
      </div>
<?php
      }
    }
  }
  if($tabel == 14){
  ?>
        <div class="box box-white box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
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
//===========================================================================================
//================= ! BOX BODY ==========================================================================
?>
  </div>
</div>
<?php  
}
if($tabel == 15){
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
          ?>
             <div id="chartdiv"></div>
              <div id="legenddiv"></div> 
          <?php 
            }
          ?>
         </div> 
    </section>
    <?php 
              if(!empty($berkasere)){
    ?>
    <div class="row no-print">
    <section class="invoice">
        <div class="row invoice-info">
        <div class="col-md-12">
          <h3 style="font-weight:bold;">BERKAS_BERKAS</h3>
        </div>
    <?php
                foreach($all_berkas as $rowberkas){
                  if (in_array($rowberkas['id_berkas'],explode(',', $berkasere))) {
          ?>
          <?php 
            if(!empty($rowberkas['nama_berkas'])){
          ?>
        <div class="col-md-12">
          <h4 style="font-weight:bold;">Nama Berkas : <?= $rowberkas['nama_berkas'] ?></h4>
        </div>
          <?php 
            }
            if(!empty($rowberkas['no_berkas'])){
          ?>
        <div class="col-md-12">
          <h4 style="font-weight:bold;">No Berkas : <?= $rowberkas['no_berkas'] ?></h4>
        </div>
          <?php 
            }
          ?><hr>
          <br style="line-height:2">
        <div class="col-md-12">
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $rowberkas['link_berkas'] ?>" allowfullscreen></iframe>
</div>
        </div>

          <?php
                }
              }
          ?>
      </div>
    </section>
  </div>
          <?php
            }
?>



            <?php 
              if($show_pdf == 1){
            ?> 
    <div class="row no-print">
    <section class="invoice">
        <div class="row invoice-info">
        <div class="col-md-12">
          <h3 style="font-weight:bold;">DATA PASIEN</h3>
        </div>
        <div class="col-md-12">
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>external/lihat/pdf_logbook/<?= $id_laporan ?>/<?= $id_laporan_tabel ?>" allowfullscreen></iframe>
</div>
        </div>
      </div>
    </section>
  </div>
          <?php  
            }
          ?>




    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php 
}
elseif ($page=="anjababk_abk")
{  
?>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
        <div class="row invoice-info">
          <div class="col-md-12 huruf-12">
        <h4 style="font-weight:bold;text-align: center;"><?= $aheader ?></h4>
        <h4 style="font-weight:bold;text-align: center;"><?= $sub_header ?></h4>
        <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header ?></h4>
          </div><br style="line-height:2">
          <div class="col-md-12 huruf-12">
            <div class="box-body table-responsive no-padding">
            <table class="table no-border">
                <tbody>
    <tr>
      <td style="text-align:left;width:5%;">1.</td>
      <td colspan="4" style="text-align:left;">IDENTITAS JABATAN</td>
    </tr>
    <tr>
      <td style="text-align:center;" >&nbsp;</td>
      <td style="text-align:left;width:8%;" >1.1</td>
      <td style="text-align:left;width:15%" >NAMA JABATAN</td>
      <td style="text-align:center;width:3%;" >:</td>
      <td style="text-align:left;" ><?= $nama_jabatan_fungsional ?></td>
    </tr>
    <tr>
      <td style="text-align:center;" >&nbsp;</td>
      <td style="text-align:left;" >1.2</td>
      <td style="text-align:left;" >ATASAN LANGSUNG</td>
      <td style="text-align:center;" >:</td>
      <td style="text-align:left;" ><?= $nama_struktur_jabatan ?></td>
    </tr>
    <tr>
      <td style="text-align:center;" >&nbsp;</td>
      <td style="text-align:left;" >1.3</td>
      <td style="text-align:left;" >UNIT</td>
      <td style="text-align:center;" >:</td>
      <td style="text-align:left;" ><?= $nama_unit ?></td>
    </tr>
    <tr>
      <td style="text-align:center;" >&nbsp;</td>
      <td style="text-align:left;" >1.4</td>
      <td style="text-align:left;" >UNIT KERJA</td>
      <td style="text-align:center;" >:</td>
      <td style="text-align:left;" ><?= $nama_working ?></td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <?php 
      if(!empty($iktisar_jabatan)){
    ?>
    <tr>
      <td style="text-align:left;">2.</td>
      <td colspan="4" style="text-align:left;">IKTISAR JABATAN</td>
    </tr>
    <tr>
      <td style="text-align:center;" >&nbsp;</td>
      <td colspan="4" style="text-align:left;line-height: 1.6;" ><?= $iktisar_jabatan ?></td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <?php 
      }
    ?>
    <tr>
      <td style="text-align:left;">3.</td>
      <td colspan="4" style="text-align:left;">SYARAT JABATAN</td>
    </tr>
    <tr>
      <td style="text-align:left;">&nbsp;</td>
      <td colspan="4" style="text-align:left;">
      <table width="100%">
        <tbody>   
        <tr>
          <td style="text-align:left;width:3%;" >a.</td>
          <td style="text-align:left;width:15%;">Pendidikan Formal</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;line-height:1.6;" >
          <?php 
            $pendidikan_terpilih = $this->m_anjababk->pendidikan_terpilih($pendidikan_formal);
            foreach($pendidikan_terpilih as $rowpendidikan){  
          ?>  
            <?= $rowpendidikan['nama_pendidikan'] ?><br>
          <?php 
            }
          ?>          
          </td>
        </tr> 
        <tr>
          <td style="text-align:left;width:3%;vertical-align: top;" >b.</td>
          <td style="text-align:left;width:15%;vertical-align: top;">Pelatihan/Kursus</td>
          <td style="text-align:center;width:3%;vertical-align: top;" >:</td>
          <td style="text-align:left;vertical-align: top;" ><?= html_entity_decode($pelatihan) ?></td>
        </tr>     
        <tr>
          <td style="text-align:left;width:3%;" >c.</td>
          <td style="text-align:left;width:15%;">Pengalaman Kerja</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;" ><?= $pengalaman ?></td>
        </tr>       
        </tbody>      
      </table>      
      </td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align:left;">4.</td>
      <td colspan="4" style="text-align:left;">TUGAS POKOK</td>
    </tr>
    <tr>
      <td style="text-align:left;">&nbsp;</td>
      <td colspan="4" style="text-align:left;">
      <table width="100%" style="font-size: 0.8em;border: solid black 1px;" class="table table-border">
        <tbody> 
        <tr class="bg-dark">
          <td style="vertical-align:middle;text-align:center;width:5%;border: solid black 1px;background-color: #ccc;font-weight: bold;" >No</td>
          <td style="vertical-align:middle;text-align:center;border: solid black 1px;background-color: #ccc;font-weight: bold;" >HASIL KERJA</td>
          <td style="vertical-align:middle;text-align:center;border: solid black 1px;background-color: #ccc;font-weight: bold;" >JUMLAH BEBAN KERJA 1 TAHUN</td>
          <td style="vertical-align:middle;text-align:center;border: solid black 1px;background-color: #ccc;font-weight: bold;" >WAKTU PENYELESAIAN</td>
          <td style="vertical-align:middle;text-align:center;border: solid black 1px;background-color: #ccc;font-weight: bold;" >WAKTU EFEKTIF PENYELESAIAN</td>
          <td style="vertical-align:middle;text-align:center;border: solid black 1px;background-color: #ccc;font-weight: bold;" >KEBUTUHAN PEGAWAI</td>
        </tr>
        <?php           
        $noa = 0;$twvp=0;$tformasi=0;
        $butir_kegiatan_terpilih = $this->m_rancak->ambil_bk_detil4new($id_abk_detil);
        foreach($butir_kegiatan_terpilih as $rowbutir_kegiatan_terpilih){
          $twvp = $twvp + $rowbutir_kegiatan_terpilih['wpv'];
          $tformasi = $tformasi + $rowbutir_kegiatan_terpilih['formasi'];
        $noa++;
        ?>
        <tr>
          <td style="text-align:center;border: solid black 1px;" >4.<?= $noa ?></td>
          <td style="text-align:left;border: solid black 1px;" ><?= $rowbutir_kegiatan_terpilih['nama_kompetensi'] ?></td>
          <td style="text-align:center;border: solid black 1px;" ><?= round($rowbutir_kegiatan_terpilih['vol1th'],0) ?></td>
          <td style="text-align:center;border: solid black 1px;" ><?= round($rowbutir_kegiatan_terpilih['wpk'],4) ?></td>
          <td style="text-align:center;border: solid black 1px;" ><?= round($rowbutir_kegiatan_terpilih['wpv'],4) ?></td>
          <td style="text-align:center;border: solid black 1px;" ><?= round($rowbutir_kegiatan_terpilih['formasi'],4) ?></td>
        </tr>
        <?php
          }
        ?>      
        <tr class="bg-dark">
          <td colspan="5" style="text-align:center;border: solid black 1px;font-weight: bold;" >JUMLAH</td>
          <td style="text-align:center;border: solid black 1px;font-weight: bold;" ><?= round($tformasi,4) ?></td>
        </tr>
        <tr class="bg-dark">
          <td colspan="5" style="text-align:center;border: solid black 1px;font-weight: bold;" >KEBUTUHAN PEGAWAI</td>
          <td style="text-align:center;border: solid black 1px;font-weight: bold;" ><?= round($tformasi,0) ?></td>
        </tr>       
        </tbody>      
      </table>      
      </td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align:left;">5.</td>
      <td colspan="4" style="text-align:left;">WEWENANG</td>
    </tr>
    <?php           
      $nob = 0;
      $wewenang_terpilih = $this->m_anjababk->wewenang_terpilih($wewenang);
      foreach($wewenang_terpilih as $rowwewenang_terpilih){     
      $nob++;
    ?>
    <tr>
      <td style="text-align:center;" >&nbsp;</td>
      <td style="text-align:left;" >5.<?= $nob ?></td>
      <td colspan="3" style="text-align:left;" ><?= $rowwewenang_terpilih['nama_wewenang'] ?></td>
    </tr>
    <?php
      }
    ?>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align:left;">6.</td>
      <td colspan="4" style="text-align:left;">TANGGUNG JAWAB</td>
    </tr>
    <?php           
      $noc = 0;
      $tanggung_jawab_terpilih = $this->m_anjababk->tanggung_jawab_terpilih($tanggung_jawab);
      foreach($tanggung_jawab_terpilih as $rowtanggung_jawab_terpilih){   
      $noc++;
    ?>
    <tr>
      <td style="text-align:center;" >&nbsp;</td>
      <td style="text-align:left;" >6.<?= $noc ?></td>
      <td colspan="3" style="text-align:left;" ><?= $rowtanggung_jawab_terpilih['nama_tanggung_jawab'] ?></td>
    </tr>
    <?php
      }
    ?>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align:left;">7.</td>
      <td colspan="4" style="text-align:left;">HASIL KERJA</td>
    </tr>
    <?php           
      $nod = 0;
      $hasil_kerja_terpilih = $this->m_anjababk->hasil_kerja_terpilih($hasil_kerja);
      foreach($hasil_kerja_terpilih as $rowhasil_kerja_terpilih){   
      $nod++;
    ?>
    <tr>
      <td style="text-align:center;" >&nbsp;</td>
      <td style="text-align:left;" >7.<?= $nod ?></td>
      <td colspan="3" style="text-align:left;" ><?= $rowhasil_kerja_terpilih['nama_hasil_kerja'] ?></td>
    </tr>
    <?php
      }
    ?>    
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">
      <table width="100%" class="table table-border">
        <tbody> 
        <tr>
          <td style="text-align:left;border-left:0;border-top:0;border-bottom:0;" >8.</td>
          <td class="bg-dark" style="text-align:left;" >No</td>
          <td class="bg-dark" style="text-align:left;" >BAHAN KERJA</td>
          <td class="bg-dark" style="text-align:left;" >PENGGUNAAN DALAM TUGAS</td>
        </tr>
        <?php           
          $noe = 0;
          $bahan_kerja_terpilih = $this->m_anjababk->bahan_kerja_terpilih($bahan_kerja);
          foreach($bahan_kerja_terpilih as $rowhasil_bahan_terpilih){
          $noe++;
        ?>
        <tr>
          <td style="text-align:left;width:5%;border-left:0;border-top:0;border-bottom:0;" >&nbsp;</td>
          <td style="text-align:left;width:5%;" >8.<?= $noe ?></td>
          <td style="text-align:left;" ><?= $rowhasil_bahan_terpilih['nama_bahan_kerja'] ?></td>
          <td style="text-align:left;" ><?= $rowhasil_bahan_terpilih['penggunaan'] ?></td>
        </tr>
        <?php
          }
        ?>        
        </tbody>      
      </table>      
      </td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">
      <table width="100%" class="table table-border">
        <tbody> 
        <tr>
          <td style="text-align:left;border-left:0;border-top:0;border-bottom:0;" >9.</td>
          <td class="bg-dark" style="text-align:left;" >No</td>
          <td class="bg-dark" style="text-align:left;" >PERANGKAT KERJA</td>
          <td class="bg-dark" style="text-align:left;" >PENGGUNAAN DALAM TUGAS</td>
        </tr>
        <?php           
          $nof = 0;
          $perangkat_kerja_terpilih = $this->m_anjababk->perangkat_kerja_terpilih($perangkat_kerja);
          foreach($perangkat_kerja_terpilih as $rowperangkat_kerja_terpilih){     
          $nof++;
        ?>
        <tr>
          <td style="text-align:left;width:5%;border-left:0;border-top:0;border-bottom:0;" >&nbsp;</td>
          <td style="text-align:left;width:5%;" >9.<?= $nof ?></td>
          <td style="text-align:left;" ><?= $rowperangkat_kerja_terpilih['nama_perangkat_kerja'] ?></td>
          <td style="text-align:left;" ><?= $rowperangkat_kerja_terpilih['penggunaan'] ?></td>
        </tr>
        <?php
          }
        ?>        
        </tbody>      
      </table>      
      </td>
    </tr>   
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align:left;">10.</td>
      <td colspan="4" style="text-align:left;">KORELASI JABATAN</td>
    </tr>
    <tr>
      <td style="text-align:left;">&nbsp;</td>
      <td colspan="4" style="text-align:left;">
      <table width="100%" class="table table-border">
        <tbody> 
        <tr class="bg-dark">
          <td style="text-align:left;width:5%;" >No</td>
          <td style="text-align:left;" >NAMA JABATAN</td>
          <td style="text-align:left;" >UNIT KERJA</td>
          <td style="text-align:left;" >DALAM HAL</td>
        </tr>
        <?php           
          $nog = 0;
          $hubungan_jabatan_terpilih = $this->m_anjababk->hubungan_jabatan_terpilih($hubungan_jabatan);
          foreach($hubungan_jabatan_terpilih as $rowhubungan_jabatan){    
          $nog++;
        ?>
        <tr>
          <td style="text-align:left;width:5%;" >10.<?= $nog ?></td>
          <td style="text-align:left;" ><?= $rowhubungan_jabatan['nama_hubungan_jabatan'] ?></td>
          <td style="text-align:left;" ><?= $rowhubungan_jabatan['unit_kerja'] ?></td>
          <td style="text-align:left;" ><?= $rowhubungan_jabatan['hal'] ?></td>
        </tr>
        <?php
          }
        ?>        
        </tbody>      
      </table>      
      </td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align:left;">11.</td>
      <td colspan="4" style="text-align:left;">KONDISI LINGKUNGAN KERJA </td>
    </tr>
    <tr>
      <td style="text-align:left;">&nbsp;</td>
      <td colspan="4" style="text-align:left;">
      <table width="100%" class="table table-border taborder">
        <tbody> 
        <tr class="bg-dark">
          <td style="text-align:left;width:5%;" >No</td>
          <td style="text-align:left;" >ASPEK</td>
          <td style="text-align:left;" >FAKTOR</td>
        </tr>
        <?php           
          $noh = 0;
          $kondisi_tempat_terpilih = $this->m_anjababk->kondisi_tempat_terpilih($kondisi_tempat_kerja);
          foreach($kondisi_tempat_terpilih as $rowkondisi_tempat){    
          $noh++;
        ?>
        <tr>
          <td style="text-align:left;width:5%;" >11.<?= $noh ?></td>
          <td style="text-align:left;" ><?= $rowkondisi_tempat['aspek'] ?></td>
          <td style="text-align:left;" ><?= $rowkondisi_tempat['faktor'] ?></td>
        </tr>
        <?php
          }
        ?>        
        </tbody>      
      </table>      
      </td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td style="text-align:left;">12.</td>
      <td colspan="4" style="text-align:left;">RESIKO BAHAYA</td>
    </tr>
    <tr>
      <td style="text-align:left;">&nbsp;</td>
      <td colspan="4" style="text-align:left;">
      <table width="100%" class="table table-border">
        <tbody> 
        <tr class="bg-dark">
          <td style="text-align:left;width:5%;" >No</td>
          <td style="text-align:left;" >FISIK / MENTAL</td>
          <td style="text-align:left;" >PENYEBAB</td>
        </tr>
        <?php           
          $noi = 0;
          $resiko_bahaya_terpilih = $this->m_anjababk->resiko_bahaya_terpilih($resiko_bahaya);
          foreach($resiko_bahaya_terpilih as $rowresiko_bahaya){    
          $noi++;
        ?>
        <tr>
          <td style="text-align:left;width:5%;" >12.<?= $noi ?></td>
          <td style="text-align:left;" ><?= $rowresiko_bahaya['fisik'] ?></td>
          <td style="text-align:left;" ><?= $rowresiko_bahaya['penyebab'] ?></td>
        </tr>
        <?php
          }
        ?>        
        </tbody>      
      </table>      
      </td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="5" style="text-align:left;">
      <table width="100%">
        <tbody> 
        <tr>
          <td style="text-align:left;width:5%">13.</td>
          <td colspan="4" style="text-align:left;">SYARAT JABATAN LAINNYA</td>
        </tr>
        <tr>
          <td style="text-align:left;" >&nbsp;</td>
          <td style="text-align:left;width:3%;" >a.</td>
          <td style="text-align:left;width:15%;">Pangkat/Golongan</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;line-height:1.6;" >
          <?php 
            $pangkat_terpilih = $this->m_anjababk->pangkat_terpilih($pangkat);
            foreach($pangkat_terpilih as $rowpangkat){  
          ?>  
            <?= $rowpangkat['nama_pangkat'] ?> / <?= $rowpangkat['golongan_ruang'] ?><br>
          <?php 
            }
          ?>          
          </td>
        </tr>  
        <tr>
         <td style="text-align:left;" >&nbsp;</td>
          <td style="text-align:left;width:3%;" >b.</td>
          <td style="text-align:left;width:15%;">Pengetahuan Kerja</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;" >
            <?= $pengetahuan_kerja ?>             
            </td>
        </tr>
        <tr>
         <td style="text-align:left;" >&nbsp;</td>
          <td style="text-align:left;width:3%;" >c.</td>
          <td style="text-align:left;width:15%;">Keterampilan kerja</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;" ><?= $ketrampilan ?></td>
        </tr> 
        <tr>
         <td style="text-align:left;" >&nbsp;</td>
          <td style="text-align:left;width:3%;" >d.</td>
          <td style="text-align:left;width:15%;">Bakat Kerja</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;line-height:1.6;" >
          <?php 
            $bakat_kerja_terpilih = $this->m_anjababk->bakat_kerja_terpilih($bakat_kerja);
            foreach($bakat_kerja_terpilih as $rowbakat_kerja){  
          ?>  
            <?= $rowbakat_kerja['id_bakat_kerja'] ?> (<?= $rowbakat_kerja['arti'] ?>),
          <?php 
            }
          ?>          
          </td>
        </tr>       
        <tr>
         <td style="text-align:left;" >&nbsp;</td>
          <td style="text-align:left;width:3%;" >e.</td>
          <td style="text-align:left;width:15%;">Temperamen Kerja</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;line-height:1.6;" >
          <?php 
            $temperamen_kerja_terpilih = $this->m_anjababk->temperamen_kerja_terpilih($temperamen_kerja);
            foreach($temperamen_kerja_terpilih as $rowtemperamen_kerja){
          ?>  
            <?= $rowtemperamen_kerja['id_temperamen_kerja'] ?> (<?= $rowtemperamen_kerja['arti'] ?>),
          <?php 
            }
          ?>          
          </td>
        </tr>     
        <tr>
         <td style="text-align:left;" >&nbsp;</td>
          <td style="text-align:left;width:3%;" >f.</td>
          <td style="text-align:left;width:15%;">Minat Kerja</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;line-height:1.6;" >
          <?php 
            $minat_kerja_terpilih = $this->m_anjababk->minat_kerja_terpilih($minat_kerja);
            foreach($minat_kerja_terpilih as $rowminat_kerja){  
          ?>  
            <?= $rowminat_kerja['id_minat_kerja'] ?> (<?= $rowminat_kerja['deskripsi'] ?>),
          <?php 
            }
          ?>          
          </td>
        </tr>       
        <tr>
         <td style="text-align:left;" >&nbsp;</td>
          <td style="text-align:left;width:3%;" >g.</td>
          <td style="text-align:left;width:15%;">Upaya Fisik</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;line-height:1.6;" >
          <?php 
            $upaya_fisik_terpilih = $this->m_anjababk->upaya_fisik_terpilih($upaya_fisik);
            foreach($upaya_fisik_terpilih as $rowupaya_fisik_terpilih){ 
          ?>  
            <?= $rowupaya_fisik_terpilih['arti'] ?>,
          <?php 
            }
          ?>          
          </td>
        </tr>     
        <tr>
         <td style="text-align:left;" >&nbsp;</td>
          <td style="text-align:left;width:3%;" >h.</td>
          <td style="text-align:left;width:15%;">Fungsi Kerja</td>
          <td style="text-align:center;width:3%;" >:</td>
          <td style="text-align:left;line-height:1.6;" >
          <?php 
            $fungsi_kerja_terpilih = $this->m_anjababk->fungsi_kerja_terpilih($fungsi_kerja);
            foreach($fungsi_kerja_terpilih as $rowfungsi_kerja_terpilih){ 
          ?>  
            <?= $rowfungsi_kerja_terpilih['arti'] ?>,
          <?php 
            }
          ?>          
          </td>
        </tr>       
        </tbody>      
      </table>      
      </td>
    </tr>
                </tbody>
            </table>
          </div>
          </div>
          <br style="line-height:2">
          <div class="row no-print">
          <h4 style="font-weight:bold;text-align: center;">&nbsp;</h4>
          <div class="col-sm-12">
            <?php 
            foreach($ambil_anjab as $rowambil_tabel){
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/anjababk/abk/'.$rowambil_tabel['id_abk'].'/'.$rowambil_tabel['id_abk_detil']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;">ABK <?= $rowambil_tabel['nama_jabatan_fungsional'] ?>
            </a>
          </div>
          <?php
            }
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/anjababk/pola/'.$id_abk.'/'.$id_abk_detil);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"> Pola Ketenagaan
            </a>
           <a href="<?php echo base_url('external/anjababk/evaluasi/'.$id_abk.'/'.$id_abk_detil);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"> Evaluasi Perencanaan
            </a>            
          </div>
          </div>
          </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}
elseif ($page=="anjababk_pola")
{  
?>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
            <h4 style="font-weight:bold;text-align: center;"><?= $header_pemenuhan ?></h4>
            <h4 style="font-weight:bold;text-align: center;"><?= $sub_header_pemenuhan ?></h4>
            <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header_pemenuhan ?></h4>
          </div>
          <br style="line-height:2">
<div class="col-md-12">
<div class="box-body table-responsive no-padding taborder">
<table width="100%" class="table table-border" style="font-size: 0.8em;">
<thead>
  <tr class="bg-dark px-1 py-1">
    <th rowspan="2" style="border: solid black 1px;text-align:center;vertical-align:middle;width:3%;">No</th>
    <th rowspan="2" style="border: solid black 1px;text-align:center;vertical-align:middle;width:10%;">NAMA JABATAN</th>
    <th rowspan="2" style="border: solid black 1px;text-align:center;vertical-align:middle;">SYARAT JABATAN</th>
    <th colspan="4" style="border: solid black 1px;text-align:center;vertical-align:middle;">KETERSEDIAAN TENAGA</th>
    <th colspan="3" style="border: solid black 1px;text-align:center;vertical-align:middle;">RENCANA PEMENUHAN KEKURANGAN</th>
  </tr>
  <tr class="bg-dark  px-1 py-1">
    <th colspan="2" class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:10%;">KETERSEDIAAN</th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">KEBUTUHAN</th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">KELEBIHAN</th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+1; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+2; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+3; ?></th>
  </tr>
</thead>
<tbody>
<?php           
  $noa = 0;$allpns = 0;$allcpns = 0;$allblud = 0;$allcpb = 0;$totale = 0;
  foreach($ambil_anjab as $rowinjabdet){     
  $noa++;
  $totale = $rowinjabdet['pns'] + $rowinjabdet['cpns'] + $rowinjabdet['blud'];
  $allpns = $allpns + $rowinjabdet['pns'];
  $allcpns = $allcpns + $rowinjabdet['cpns'];
  $allblud = $allblud + $rowinjabdet['blud'];
  $allcpb = $allpns + $allcpns + $allblud;  
?>
  <tr>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;"><?= $noa ?></td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:left;vertical-align:middle;"><?= $rowinjabdet['nama_jabatan_fungsional'] ?></td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:left;vertical-align:middle;">
  <table width="100%" class="asktable" style="border-left:0;border-right:0;">
    <tbody>   
    <tr>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:3%;vertical-align: top;" >a.</td>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:15%;vertical-align: top;">Pendidikan Formal</td>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:center;width:3%;vertical-align: top;" >:</td>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;line-height:1.6;vertical-align: top;" >
      <?php 
      if(!empty($rowinjabdet['pendidikan_formal'])){
        $pendidikan_terpilih = $this->m_anjababk->pendidikan_terpilih($rowinjabdet['pendidikan_formal']);
        foreach($pendidikan_terpilih as $rowpendidikan){
      ?>  
        <?= $rowpendidikan['nama_pendidikan'] ?><br>
      <?php 
        }
      }
      ?>          
      </td>
    </tr> 
    <tr>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:3%;vertical-align: top;" >b.</td>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:15%;vertical-align: top;">Pelatihan/Kursus</td>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:center;width:3%;vertical-align: top;" >:</td>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;vertical-align: top;" >
        <?php 
        if(!empty($rowinjabdet['pelatihan'])){
        echo $rowinjabdet['pelatihan'];
        }
        ?>
      </td>
    </tr>     
    <tr>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:3%;vertical-align: top;" >c.</td>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;width:15%;vertical-align: top;">Pengalaman Kerja</td>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:center;width:3%;vertical-align: top;" >:</td>
      <td class="px-1 py-1" style="border-left:0;border-right:0;text-align:left;vertical-align: top;" >
        <?php 
        if(!empty($rowinjabdet['pengalaman'])){
        echo $rowinjabdet['pengalaman'];
        }
        ?></td>
    </tr>       
    </tbody>      
  </table>  
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:bottom;line-height:1.6;width:5%;">
  CPNS : <?= $allcpns ?><br>
  PNS : <?= $allpns ?><br>
  BLUD : <?= $allblud ?>
  </td> 
  <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:4%;"><?= $totale ?></td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?= $rowinjabdet['total'] ?></td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?= $rowinjabdet['average'] ?></td> 
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  if(!empty($thn0['jml_pemenuhan'])){
  echo $thn0['jml_pemenuhan'];
  }else{ echo '0'; }
  ?>
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  if(!empty($thn1['jml_pemenuhan'])){
  echo $thn1['jml_pemenuhan'];
  }else{ echo '0'; }
  ?>  
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  if(!empty($rowinjabdet['jml_pemenuhan'])){
  echo $thn2['thn2'];
  }else{ echo '0'; }
  ?>  
  </td>
  </tr> 
<?php
  }
?>   
</tbody>
</table>
</div>
</div>
          <br style="line-height:2">
          <div class="row no-print">
          <h4 style="font-weight:bold;text-align: center;">&nbsp;</h4>
          <div class="col-sm-12">
            <?php 
            foreach($ambil_anjab as $rowambil_tabel){
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/anjababk/abk/'.$rowambil_tabel['id_abk'].'/'.$rowambil_tabel['id_abk_detil']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;">ABK <?= $rowambil_tabel['nama_jabatan_fungsional'] ?>
            </a>
          </div>
          <?php
            }
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/anjababk/pola/'.$id_abk.'/'.$id_abk_detil);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"> Pola Ketenagaan
            </a>
           <a href="<?php echo base_url('external/anjababk/evaluasi/'.$id_abk.'/'.$id_abk_detil);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"> Evaluasi Perencanaan
            </a>            
          </div>
          </div>
          </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}
elseif ($page=="anjababk_evaluasi")
{  
?>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
            <h4 style="font-weight:bold;text-align: center;"><?= $header_realisasi ?></h4>
            <h4 style="font-weight:bold;text-align: center;"><?= $sub_header_realisasi ?></h4>
            <h4 style="font-weight:bold;text-align: center;"><?= $sub_sub_header_realisasi ?></h4>
          </div>
          <br style="line-height:2">
<div class="col-md-12">
<div class="box-body table-responsive no-padding taborder">
<table width="100%" class="table table-border" style="font-size: 0.8em;">
<thead>
  <tr class="bg-dark px-1 py-1">
    <th rowspan="2" style="border: solid black 1px;text-align:center;vertical-align:middle;width:3%;">No</th>
    <th rowspan="2" style="border: solid black 1px;text-align:center;vertical-align:middle;width:10%;">NAMA JABATAN</th>
    <th colspan="4" style="border: solid black 1px;text-align:center;vertical-align:middle;">KETERSEDIAAN TENAGA</th>
    <th colspan="3" style="border: solid black 1px;text-align:center;vertical-align:middle;">RENCANA PEMENUHAN KEKURANGAN</th>
    <th colspan="3" style="border: solid black 1px;text-align:center;vertical-align:middle;">EVALUASI PERENCANAAN</th>
    <th colspan="3" style="border: solid black 1px;text-align:center;vertical-align:middle;">PROSENTASE TINGKAT PEMENUHAN RENCANA</th>
  </tr>
  <tr class="bg-dark  px-1 py-1">
    <th colspan="2" class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:10%;">KETERSEDIAAN</th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">KEBUTUHAN</th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">KELEBIHAN</th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+1; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+2; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+3; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+1; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+2; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+3; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+1; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+2; ?></th>
    <th class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?php echo $perid+3; ?></th>
  </tr>
</thead>
<tbody>
<?php           
  $noa = 0;$allpns = 0;$allcpns = 0;$allblud = 0;$allcpb = 0;$totale = 0;
  foreach($ambil_anjab as $rowinjabdet){     
  $noa++;
  $totale = $rowinjabdet['pns'] + $rowinjabdet['cpns'] + $rowinjabdet['blud'];
  $allpns = $allpns + $rowinjabdet['pns'];
  $allcpns = $allcpns + $rowinjabdet['cpns'];
  $allblud = $allblud + $rowinjabdet['blud'];
  $allcpb = $allpns + $allcpns + $allblud;  
?>
  <tr>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;"><?= $noa ?></td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:left;vertical-align:middle;"><?= $rowinjabdet['nama_jabatan_fungsional'] ?></td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:bottom;line-height:1.6;width:5%;">
  CPNS : <?= $allcpns ?><br>
  PNS : <?= $allpns ?><br>
  BLUD : <?= $allblud ?>
  </td> 
  <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:4%;"><?= $totale ?></td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?= $rowinjabdet['total'] ?></td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;"><?= $rowinjabdet['average'] ?></td> 
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  if(!empty($thn0['jml_pemenuhan'])){
  echo $thn0['jml_pemenuhan'];
  }else{ echo '0'; }
  ?>
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  if(!empty($thn1['jml_pemenuhan'])){
  echo $thn1['jml_pemenuhan'];
  }else{ echo '0'; }
  ?>  
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  if(!empty($thn2['jml_pemenuhan'])){
  echo $thn2['jml_pemenuhan'];
  }else{ echo '0'; }
  ?>  
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  if(!empty($thn0['jml_realisasi'])){
  echo $thn0['jml_realisasi'];
  }else{ echo '0'; }
  ?>
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  if(!empty($thn1['jml_realisasi'])){
  echo $thn1['jml_realisasi'];
  }else{ echo '0'; }
  ?>  
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  if(!empty($thn2['jml_realisasi'])){
  echo $thn2['jml_realisasi'];
  }else{ echo '0'; }
  ?>  
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  echo round($prsn0,1);
  ?> %
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  echo round($prsn1,1);
  ?>  %
  </td>
    <td class="px-1 py-1" style="border: solid black 1px;text-align:center;vertical-align:middle;width:7%;">
  <?php
  echo round($prsn2,1);
  ?>  %
  </td>
  </tr> 
<?php
  }
?>   
</tbody>
</table>
</div>
</div>
          <br style="line-height:2">
          <div class="row no-print">
          <h4 style="font-weight:bold;text-align: center;">&nbsp;</h4>
          <div class="col-sm-12">
            <?php 
            foreach($ambil_anjab as $rowambil_tabel){
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/anjababk/abk/'.$rowambil_tabel['id_abk'].'/'.$rowambil_tabel['id_abk_detil']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;">ABK <?= $rowambil_tabel['nama_jabatan_fungsional'] ?>
            </a>
          </div>
          <?php
            }
          ?>
          <div class="col-md-12">
           <a href="<?php echo base_url('external/anjababk/pola/'.$id_abk.'/'.$id_abk_detil);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"> Pola Ketenagaan
            </a>
           <a href="<?php echo base_url('external/anjababk/evaluasi/'.$id_abk.'/'.$id_abk_detil);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;white-space: normal;"> Evaluasi Perencanaan
            </a>            
          </div>
          </div>
          </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}