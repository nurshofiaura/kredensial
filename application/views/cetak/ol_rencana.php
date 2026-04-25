<?php 
$this->load->view('style');
$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($id);
$ceklist=base_url().'assets/images/ceklistblack.png';
$gbrclist = '<img src="'.$ceklist.'" class="user-image" alt="User Image" style="height: 15px;">';
$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',3);

$kondisi_asesor=array('barcode_pengajuan'=>$id,'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"]);
$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
 $kesesuaian_bukti  = explode(",", $apv["kesesuaian_bukti_validasi"]);
 $ket_pengajuan_validasi  = $apv["ket_pengajuan_validasi"];
 $tgl_asesi  = set_value('tgl_asesi',$apv["tgl_asesi"]);
 $tgl_asesor  = set_value('tgl_asesor',$apv["tgl_asesor"]);
 $form2_detil = $this->m_kredensial->ambil_nkr_validasi_question_detil($apv['barcode_pengajuan_validasi']);
 $kompetensi = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
 $ambil_data_etik_pegawai_oppe = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
 $detil_elemen = $this->m_kredensial->ambil_nkr_grup_indikator_validasi($apv['barcode_pengajuan_validasi'],'nas.id_elemen','no_urut_detil','asc');
$alat = $this->m_umum->ambil_data('nkr_alat');
$perangkat = $this->m_umum->ambil_data('nkr_perangkat');
$metode = $this->m_umum->ambil_data('nkr_metode');
$perangkate = $this->m_umum->ambil_data('nkr_perangkat');
$metodee = $this->m_umum->ambil_data('nkr_metode');
$alatdanbahan = $this->m_umum->ambil_data('nkr_alat');
?>
<div class="header-report">
 <div class="center">    
  <h3><b><?= $form['nama_jenis_form'] ?></b></h3>
 </div>
 <br style="line-height:1;">
   <table class="table" style="font-size: 0.9em;">
   <tr>   
    <td style="font-weight: bold;width: 13%;">Nama Asesi</td>   
    <td style="font-weight: bold;width: 2%;">:</td>   
    <td style="font-weight: bold;"><?= $apk['nama_pegawai'] ?></td>  
    <td style="font-weight: bold;width: 20%;">&nbsp;</td>  
    <td style="font-weight: bold;text-align: right;width: 13%;">Nama Asesor</td>   
    <td style="font-weight: bold;width: 2%;">:</td>   
    <td style="font-weight: bold;text-align: left;"><?= $apv['nama_pegawai'] ?></td>   
   </tr>
   <tr>   
    <td style="font-weight: bold;">Tanggal</td>   
    <td style="font-weight: bold;">:</td>   
    <td style="font-weight: bold;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apv['tgl_asesor']))) ?></td>
    <td style="font-weight: bold;">&nbsp;</td>  
    <td style="font-weight: bold;text-align: right;">Tempat</td>   
    <td style="font-weight: bold;">:</td>   
    <td style="font-weight: bold;text-align: left;"><?= $apv['lokasi_pengajuan_validasi'] ?></td>   
   </tr>
   </table>
</div>
<div class="content-report">
<div style="text-align:left;font-weight:bold;margin-left:10pt;margin-top: 5pt;margin-bottom: 7pt;">
1. Pendekatan Asesmen
</div>
 <table class="table" style="font-size: 0.9em;">
<tr>   
 <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">Karateristik Peserta</td> 
 <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">Acuan Pembanding / benchmark</td>   
</tr>  
<?php
 $no = 0;
 foreach($kompetensi as $rowkomp){
  $no++;
?>
  <tr>
  <td class="border-1" style="padding: 5px;vertical-align: middle;text-align: center"><?= $apk['nama_jabatan_fungsional'] ?></td>
  <td class="border-1" style="padding: 5px 5px 5px 50px;vertical-align: top;text-align: left;">
   Standar Kompetensi dan SPO :
   <?php 
    $knds_kw = array('id_kompetensi'=>$apk['kode_unit_pengajuan']);
    $spo = $this->m_umum->ambil_data_kondisi_result('nkr_kewenangan',$knds_kw);
    echo '<ul>';
    foreach($spo as $rowspo){
     echo '<li>'.$rowspo['nama_kewenangan'].'</li>';
    }
    echo '</ul>';
   ?> 
   </td>
  </tr>
<?php
 }
?> 
 </table>
<div style="text-align:left;font-weight:bold;margin-left:10pt;margin-top: 10pt;margin-bottom: 7pt;">
2. Rencana Asesmen
</div>
 <table class="table" style="font-size: 0.9em;">
   <tr>   
    <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">No</td>   
    <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">Kode Unit</td>   
    <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">Judul Unit</td>   
   </tr>  
<?php
 $no = 0;
 foreach($kompetensi as $rowkomp){
  $no++;
?>
  <tr>
  <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;text-align: center;width: 5%;"><?= $no ?></td>
  <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;text-align: center;"><?= $rowkomp['kode_unit'] ?></td>
  <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;text-align: center;"><?= $rowkomp['nama_kompetensi'] ?></td>
  </tr>
<?php
 }
?> 
 </table>
 <br style="line-height:1;">
 <table class="table" style="font-size: 0.8em;">
   <?php
   foreach($detil_elemen as $rowdetil_elemen){
   ?>
   <tr>
     <td class="border-1 bg-dark" style="width:3%;border-right: 0;">&nbsp;</td>
     <td class="border-1 bg-dark" style="padding: 5px;vertical-align: middle; text-align: left;font-size: 0.9em;font-weight: bold;border-left: 0;" colspan="4">Elemen : <?= $rowdetil_elemen['nama_elemen'] ?></td>
   </tr>
     <?php
     $kondisialat = array('id_elemen'=>$rowdetil_elemen['id_elemen'],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
     $alatbahan = $this->m_umum->ambil_data_kondisi('nkr_alat_bahan',$kondisialat);
     if(!empty( $alatbahan['alat'])){
       echo'<tr><td class="border-1" style="border-bottom:0;border-right:0;">&nbsp;</td><td>&nbsp;</td><td class="border-1" colspan="3" style="font-weight:bold;font-size: 0.9em;padding: 5px;border-bottom:0;border-left:0;">ALAT DAN BAHAN</td></tr>';
     foreach($alat as $rowalat){
       if (in_array($rowalat['id_alat'],explode(",", $alatbahan['alat']))) {
     ?>
     <tr>
     <td class="border-1" style="border-top:0;border-right:0;">&nbsp;</td>
     <td>&nbsp;</td>
     <td style="font-size: 0.9em;text-align: center;">==</td>
     <td colspan="2" class="border-1" style="text-align: left;font-size: 0.9em;padding: 5px;border-left: 0;border-top: 0;">
       <?= $rowalat['nama_alat'] ?></td>
     </tr>
     <?php
       }
     }
   }
   $detil_asesmen = $this->m_kredensial->ambil_asesmen_nkr_elemen_validasi($apv['barcode_pengajuan_validasi'],$rowdetil_elemen['id_elemen']);
     foreach($detil_asesmen as $rowdetil_asesmen){
       $detil_indikator = $this->m_kredensial->ambil_indikator_nkr_form_validasi_detil($apv['barcode_pengajuan_validasi'],$rowdetil_asesmen['id_asesmen']);
     ?>
<tr>
<td class="border-1" style="width:3%;border-right: 0;">&nbsp;</td>
<td class="border-1" style="width:3%;border-right: 0;border-left: 0;">&nbsp;</td>
<td class="border-1" style="font-size: 0.9em;padding: 5px;border-left: 0;" colspan="3">Kriteria Unjuk Kerja : <?= $rowdetil_asesmen['nama_asesmen'] ?></td>
</tr>
   <?php
     foreach($detil_indikator as $rowdetil_indikator){
   ?>
<tr>
<td class="border-1" style="width:3%;border-right: 0;">&nbsp;</td>
<td class="border-1" style="width:3%;border-right: 0;border-left: 0;">&nbsp;</td>
<td class="border-1" style="vertical-align:middle;text-align: center;width:3%;border-right: 0;border-left: 0;">&nbsp;</td>
<td class="border-1" colspan="2" style="font-size: 0.9em;padding: 5px;border-left: 0;">Indikator Unjuk Kerja : <?= $rowdetil_indikator['nama_indikator'] ?></td>
</tr>
<?php  
if(!empty($rowdetil_indikator['metode_indikator']) || !empty($rowdetil_indikator['perangkat_indikator'])){
?>
<tr>
<td class="border-1" style="width:3%;border-right: 0;">&nbsp;</td>
<td class="border-1" style="width:3%;border-right: 0;border-left: 0;">&nbsp;</td>
<td class="border-1" style="width:3%;border-right: 0;border-left: 0;">&nbsp;</td>
<td class="border-1" style="text-align: left;font-size: 0.9em;padding: 5px;border-right: 0;border-left: 0;"><?php if(!empty($rowdetil_indikator['metode_indikator'])){ echo 'METODE ASESMEN'; } ?></td>
<td class="border-1" style="text-align: left;font-size: 0.9em;padding: 5px;border-left: 0;"><?php if(!empty($rowdetil_indikator['perangkat_indikator'])){ echo 'PERANGKAT ASESMEN'; } ?></td>
</tr>
<tr>
<td class="border-1" style="width:3%;border-right: 0;">&nbsp;</td>
<td class="border-1" style="width:3%;border-right: 0;border-left: 0;">&nbsp;</td>
<td class="border-1" style="width:3%;border-right: 0;border-left: 0;">&nbsp;</td>
<td class="border-1" style="text-align: left;font-size: 0.9em;padding: 5px;border-right: 0;border-left: 0;">
 <ul>
   <?php
   if(!empty($rowdetil_indikator['metode_indikator'])){
       foreach($metode as $rowmetode){
         if (in_array($rowmetode['id_metode'],explode(",", $rowdetil_indikator['metode_indikator']))) {
           echo '<li>'.$rowmetode['nama_metode'].'</li>';
         }
       }
   }
   ?>  
 </ul>          
</td>
<td class="border-1" style="text-align: left;font-size: 0.9em;padding: 5px;border-left: 0;">
  <ul>
   <?php
   if(!empty($rowdetil_indikator['perangkat_indikator'])){
     foreach($perangkat as $rowperangkat){
       if (in_array($rowperangkat['id_perangkat'],explode(",", $rowdetil_indikator['perangkat_indikator']))) {
         echo '<li>'.$rowperangkat['nama_perangkat'].'</li>';
       }
     }
   }
   ?>  </ul>               
</td>
</tr>
<?php   
}
     }
    }
   }
   ?>
 </table>
 <br style="line-height:1;">
 <table class="table" style="font-size: 0.9em;">
  <tr>
   <td rowspan="6" class="border-1" style="padding: 5px;vertical-align: top;">
    Pernyataan Asesi : <br>
    Dengan menandatangani form ini, saya menyatakan bersedia mengikuti seluruh prosedur asesmen kompetensi
    <hr>
    Rekomendasi :<br><?= $apv['ket_pengajuan_validasi'] ?>
  </td>
   <td colspan="2" class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;">ASESI :</td>
  </tr>
  <tr>
   <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;width: 30%;">NAMA</td>
   <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;width: 30%;"><?= $apk['nama_pegawai'] ?></td>
  </tr>
  <tr>
   <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;">Tanggal : <br>
    <?php if(!empty($apv['tgl_asesi'])){ echo $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apv['tgl_asesi']))); } ?></td>
   <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;">
    <br style="line-height:3;">
    <br style="line-height:3;">
    <br style="line-height:3;">
    <br style="line-height:3;">
    <br style="line-height:3;">
   </td>
  </tr>
  <tr>
   <td colspan="2" class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;">ASESOR :</td>
  </tr>
  <tr>
   <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;">NAMA</td>
   <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;"><?= $apv['nama_pegawai'] ?></td>
  </tr>
  <tr>
   <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;">Tanggal : <br>
    <?php if(!empty($apv['tgl_asesor'])){ echo $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apv['tgl_asesor']))); } ?></td>
   <td class="border-1" style="padding: 5px;font-weight: bold; vertical-align: top;">
    <br style="line-height:3;">
    <br style="line-height:3;">
    <br style="line-height:3;">
    <br style="line-height:3;">
    <br style="line-height:3;">
   </td>
  </tr>
 </table>
	<div class="clear">&nbsp;</div>
</div>