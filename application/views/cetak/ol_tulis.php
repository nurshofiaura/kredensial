<?php 
$this->load->view('style');
$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($id);
$ceklist=base_url().'assets/images/ceklistblack.png';
$gbrclist = '<img src="'.$ceklist.'" class="user-image" alt="User Image" style="height: 15px;">';
$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',6);

$kondisi_asesor=array('barcode_pengajuan'=>$id,'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"]);
$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
 $grup_detil = $this->m_kredensial->ambil_nkr_validasi_indikator_detil($apv['barcode_pengajuan_validasi'],'nas.id_elemen');
 $kompetensi = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
 $kesesuaian_bukti  = explode(",", $apv["kesesuaian_bukti_validasi"]);
/* $ket_pengajuan_validasi  = $apv["ket_pengajuan_validasi"];
 $tgl_asesi  = set_value('tgl_asesi',$apv["tgl_asesi"]);
 $tgl_asesor  = set_value('tgl_asesor',$apv["tgl_asesor"]);
 $ambil_data_etik_pegawai_oppe = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
 $detil_elemen = $this->m_kredensial->ambil_nkr_grup_indikator_validasi($apv['barcode_pengajuan_validasi'],'nas.id_elemen','no_urut_detil','asc');
$alat = $this->m_umum->ambil_data('nkr_alat');
$perangkat = $this->m_umum->ambil_data('nkr_perangkat');
$metode = $this->m_umum->ambil_data('nkr_metode');
$perangkate = $this->m_umum->ambil_data('nkr_perangkat');
$metodee = $this->m_umum->ambil_data('nkr_metode');
$alatdanbahan = $this->m_umum->ambil_data('nkr_alat');*/
?>
<div class="header-report">
 <div class="center">    
  <h3><b><?= $form['nama_jenis_form'] ?></b></h3>
 <!-- <h4><b>Pengembangan instrumen asesmen kompetensi untuk metode observasi</b></h4> -->
 </div>
 <br style="line-height:1;">
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
<div class="content-report">
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
    <tr>
<td class="border-1 bg-dark" rowspan="2" style="vertical-align: middle; text-align: center;padding: 5px;font-weight: bold;">Komponen Unjuk Kerja</td>
<td class="border-1 bg-dark" rowspan="2" style="vertical-align: middle; text-align: center;padding: 5px;font-weight: bold;">Indikator Unjuk Kerja</td>
<td class="border-1 bg-dark" rowspan="2" style="vertical-align: middle; text-align: center;padding: 5px;font-weight: bold;">Pertanyaan</td>
<td class="border-1 bg-dark" rowspan="2" style="vertical-align: middle; text-align: center;padding: 5px;font-weight: bold;">Standar Jawaban</td>
<td class="border-1 bg-dark" rowspan="2" style="vertical-align: middle; text-align: center;padding: 5px;font-weight: bold;">Jawaban Asesi</td>
<td class="border-1 bg-dark" colspan="2" style="vertical-align: middle; text-align: center;padding: 5px;font-weight: bold;">Pencapaian</td>
    </tr>
    <tr>
<td class="border-1 bg-dark" style="vertical-align: middle; text-align: center;padding: 5px;font-weight: bold;width: 7%;">YA</td>      
<td class="border-1 bg-dark" style="vertical-align: middle; text-align: center;padding: 5px;font-weight: bold;width: 7%;">TIDAK</td>      
    </tr>
    <?php
    foreach($grup_detil as $rowgrup_detil){
     ?>
     <tr>
<td colspan="5" class="border-1" style="font-weight: bold; vertical-align: middle;padding: 5px;"><?= $rowgrup_detil['nama_elemen'] ?></td>
     </tr>
     <?php
     $knds_detil = array('nas.id_elemen'=>$rowgrup_detil['id_elemen']);
     $form2_detil = $this->m_kredensial->ambil_nkr_validasi_indikator_detil_select($apv['barcode_pengajuan_validasi'],$knds_detil);
     foreach($form2_detil as $rowform2_detil){
   // $poin_indikator = strip_tags($rowform2_detil['poin_indikator']); 
$poin_indikator = html_entity_decode($rowform2_detil['poin_indikator']);
/*$rekomendasi_laporan_tabel = html_entity_decode($rekomendasi_laporan_tabel); 
$rekomendasi_laporan_tabel = htmlentities($rekomendasi_laporan_tabel); 
$analisa_laporan_tabel = preg_replace('/<span[^>]+\>|<\/span>/i', '', $analisa_laporan_tabel);*/
//$poin_indikator = htmlspecialchars_decode($poin_indikator); 
    ?>
    <tr>
 <td class="border-1" style="vertical-align: middle;padding: 5px;"><?= $rowform2_detil['nama_asesmen'] ?></td>
 <td class="border-1" style="vertical-align: middle;padding: 5px;"><?= $rowform2_detil['nama_indikator'] ?></td>
 <td class="border-1" style="vertical-align: middle;padding: 5px;"><?= $rowform2_detil['pertanyaan_indikator'] ?></td>
 <td class="border-1" style="vertical-align: middle;padding: 5px;"><?= $rowform2_detil['jawaban_indikator'] ?></td>
 <td class="border-1" style="vertical-align: middle;padding: 5px;"><?= $rowform2_detil['jawaban_validasi_detil'] ?></td>
 <td class="border-1" style="vertical-align: middle;padding: 5px;text-align: center;"><?php if(in_array($rowform2_detil['id_indikator']."_2_".$id,$kesesuaian_bukti)){ echo $gbrclist; } ?></td>
 <td class="border-1" style="vertical-align: middle;padding: 5px;text-align: center;"><?php if(!in_array($rowform2_detil['id_indikator']."_2_".$id,$kesesuaian_bukti)){ echo $gbrclist; } ?></td>
    </tr>
    <?php 
    }
   }
    ?>
 </table><br><div style="font-weight:bold;font-size: 0.8em;"> Note : P : Pengetahuan, K = Ketrampilan, S : Sikap</div>
  <br style="line-height:1;">
 <table class="table" style="font-size: 0.9em;">
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