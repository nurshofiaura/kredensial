<?php 
$this->load->view('style');
$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($id);
$ceklist=base_url().'assets/images/ceklistblack.png';
$gbrclist = '<img src="'.$ceklist.'" class="user-image" alt="User Image" style="height: 15px;">';
$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',2);

$kondisi_asesor=array('barcode_pengajuan'=>$id,'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"]);
$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
 $kesesuaian_bukti  = explode(",", $apv["kesesuaian_bukti_validasi"]);
 $ket_pengajuan_validasi  = $apv["ket_pengajuan_validasi"];
 $tgl_asesi  = set_value('tgl_asesi',$apv["tgl_asesi"]);
 $tgl_asesor  = set_value('tgl_asesor',$apv["tgl_asesor"]);
 $form2_detil = $this->m_kredensial->ambil_nkr_validasi_question_detil($apv['barcode_pengajuan_validasi']);
 $kompetensi = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
 $ambil_data_etik_pegawai_oppe = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));

?>
<div class="header-report">
 <div class="center">    
  <h3><b><?= $form['nama_jenis_form'] ?></b></h3>
 </div>
 <br style="line-height:1;">
 <div class="right"> 
   <table class="table"  style="font-size: 0.9em;">
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
</div>
<div class="content-report">
 <table class="table"  style="font-size: 0.9em;">
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
 <table class="table"  style="font-size: 0.8em;">
  <tr>
   <td class="border-1 bg-dark" rowspan="2" style="font-weight: bold;padding: 5px;vertical-align: middle;text-align: center;">Komponen Asesmen Mandiri</td>
   <td class="border-1 bg-dark" rowspan="2" style="font-weight: bold;padding: 5px;vertical-align: middle;text-align: center;">Daftar Pertanyaan<br>(Asesmen Mandiri / Self Asesmen)</td>
   <td class="border-1 bg-dark" colspan="2" style="font-weight: bold;padding: 5px;vertical-align: middle;text-align: center;">Penilaian</td>
   <td class="border-1 bg-dark" rowspan="2" style="font-weight: bold;padding: 5px;vertical-align: middle;text-align: center;">Verifikasi Asesor</td>
  </tr>
  <tr>
   <td class="border-1 bg-dark" style="font-weight: bold;padding: 5px;vertical-align: middle;text-align: center;">Kompeten</td>
   <td class="border-1 bg-dark" style="font-weight: bold;padding: 5px;vertical-align: middle;text-align: center;">Tidak Kompeten</td>
  </tr>
    <?php
    foreach($form2_detil as $rowform2_detil){      
    ?>
    <tr>
      <td class="border-1" style="vertical-align: middle;padding: 5px;"><?= $rowform2_detil['nama_asesmen'] ?></td>
      <td class="border-1" style="vertical-align: middle;padding: 5px;"><?= $rowform2_detil['nama_question'] ?></td>
      <td class="border-1" style="vertical-align: middle;padding: 5px;text-align: center;">
       <?php if(in_array($rowform2_detil['id_question']."_2_".$id,$kesesuaian_bukti)){ echo $gbrclist; } ?>
      </td>
      <td class="border-1" style="vertical-align: middle;padding: 5px;text-align: center;">
       <?php if(!in_array($rowform2_detil['id_question']."_2_".$id,$kesesuaian_bukti)){ echo $gbrclist; } ?>
      </td>
      <td class="border-1" style="vertical-align: middle;padding: 5px;">&nbsp;</td>
    </tr>
    <?php 
    }
    ?>
 </table>
 <br style="line-height:1;">
 <table class="table"  style="font-size: 0.9em;">
  <tr>
   <td rowspan="6" class="border-1" style="padding: 5px;vertical-align: top;">
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