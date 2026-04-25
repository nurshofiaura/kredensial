<?php 
$this->load->view('style');
$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($id);
$ceklist=base_url().'assets/images/ceklistblack.png';
$gbrclist = '<img src="'.$ceklist.'" class="user-image" alt="User Image" style="height: 15px;">';
$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',1);

$kondisi_asesor=array('barcode_pengajuan'=>$id,'npv.id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi'],'id_jenis_form'=>$form["id_jenis_form"]);
$apv = $this->m_kredensial->ambil_pengajuan_validasi_asesor($kondisi_asesor);
 $kesesuaian_bukti  = explode(",", $apv["kesesuaian_bukti_validasi"]);
 $ket_pengajuan_validasi  = $apv["ket_pengajuan_validasi"];
 $tgl_asesi  = set_value('tgl_asesi',$apv["tgl_asesi"]);
 $tgl_asesor  = set_value('tgl_asesor',$apv["tgl_asesor"]);
 $form2_detil = $this->m_kredensial->ambil_nkr_validasi_question_detil($apv['barcode_pengajuan_validasi']);
 $kompetensi = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);
 $ambil_data_etik_pegawai_oppe = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
 $ambil_berkas_data=$this->m_ol_rancak->ambil_id_berkas_data($apk['id_pegawai']);
 if($apk["jk"] == 1){ $jk = 'Laki-laki'; }else{ $jk = 'Perempuan'; }
 $id_berkas  = explode(",", $apk["id_berkas"]);
 $berkas  = $apk["id_berkas"];
 $barcode_pengajuan  = $apk["barcode_pengajuan"];
 $id_ijasah  = explode(",", $apk["id_ijasah"]);
 $ijasah  = $apk["id_ijasah"];
 $id_str  = explode(",", $apk["id_str"]);
 $str  = $apk["id_str"];
 $id_sertifikat  = explode(",", $apk["id_sertifikat"]);
 $sertifikat  = $apk["id_sertifikat"];
 $id_etik_pegawai  = explode(",", $apk["id_etik_pegawai"]);
?>
<div class="header-report">
 <div class="center">    
  <h3><b><?= $form['nama_jenis_form'] ?></b></h3>
 </div>
</div>
<div class="content-report">
  <div style="text-align:left;font-weight:bold;margin-left:10pt;margin-top: 7pt;margin-bottom: 7pt;">
  Bagian 1 : Rincian Data Asesi
  </div>
  <div style="margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
  <table style="width:100%;margin-left: 15pt;">
   <tbody>
    <tr>
     <td style="vertical-align: top; width:20%;">Nama Lengkap</td>
     <td style="vertical-align: top; text-align: center;width:4%;">:</td>
     <td style="vertical-align: top;"><?= $apk['nama_pegawai'] ?></td>
    </tr>
    <tr>
     <td style="vertical-align: top;">Tempat/ Tanggal Lahir</td>
     <td style="vertical-align: top; text-align: center;">:</td>
     <td style="vertical-align: top;"><?= $apk['tmp_lahir'] ?>, <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_lahir']))) ?></td>
    </tr>
    <tr>
     <td style="vertical-align: top;">Jenis Kelamin</td>
     <td style="vertical-align: top; text-align: center;">:</td>
     <td style="vertical-align: top;"><?= $jk ?></td>
    </tr>  
    <tr>
     <td style="vertical-align: top;">Kualifikasi</td>
     <td style="vertical-align: top; text-align: center;">:</td>
     <td style="vertical-align: top;"><?= $apk['nama_jabatan_fungsional'] ?></td>
    </tr>
    <tr>
     <td style="vertical-align: top;">Pendidikan</td>
     <td style="vertical-align: top; text-align: center;">:</td>
     <td style="vertical-align: top;"><?= $apk['nama_pendidikan'] ?></td>
    </tr>
    <tr>
     <td style="vertical-align: top;">Pekerjaan</td>
     <td style="vertical-align: top; text-align: center;">:</td>
     <td style="vertical-align: top;"><?= $apk['nama_jabatan'] ?> / <?= $apk['nama_status_pegawai'] ?></td>
    </tr>
    <tr>
     <td style="vertical-align: top;">Alamat</td>
     <td style="vertical-align: top; text-align: center;">:</td>
     <td style="vertical-align: top;"><?= $apk['alamat'] ?>, <?= $apk['nama_kel'] ?>, <?= $apk['nama_kec'] ?>, <?= $apk['nama_kab'] ?>, <?= $apk['nama_prov'] ?> </td>
    </tr>
    <tr>
     <td style="vertical-align: top;">No Telp - Email</td>
     <td style="vertical-align: top; text-align: center;">:</td>
     <td style="vertical-align: top;"><?= $apk['no_hp'] ?> - <?= $apk['email'] ?></td>
    </tr>
    <tr>
     <td style="vertical-align: top;">Tempat Bekerja</td>
     <td style="vertical-align: top; text-align: center;">:</td>
     <td style="vertical-align: top;"><?= $apk['nama_working'] ?></td>
    </tr>
   </tbody>
  </table>
  </div>
<div style="text-align:left;font-weight:bold;margin-left:10pt;margin-top: 25pt;margin-bottom: 7pt;">
Bagian 2 : Daftar Unit Kompetensi
</div>

 <table class="table">
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
<div style="text-align:left;font-weight:bold;margin-left:10pt;margin-top: 25pt;margin-bottom: 7pt;">
Bagian 3 : Kompetensi dan Bukti Portofolio
</div>
 <table class="table">
  <tr>
   <td rowspan="2" class="border-1 bg-dark" style="padding: 5px;font-weight: bold; vertical-align: middle;text-align: center;">Nama Berkas</u></td>
   <td colspan="4" class="border-1 bg-dark" style="padding: 5px;font-weight: bold; vertical-align: top;text-align: center;">KESESUAIAN BUKTI </td>
  </tr>
  <tr>
   <th class="border-1 bg-dark" style="padding: 5px;vertical-align: middle;text-align: center;width: 10%;">Memadai</th>
   <th class="border-1 bg-dark" style="padding: 5px;vertical-align: middle;text-align: center;width: 10%;">Valid</th>
   <th class="border-1 bg-dark" style="padding: 5px;vertical-align: middle;text-align: center;width: 10%;">Asli</th>
   <th class="border-1 bg-dark" style="padding: 5px;vertical-align: middle;text-align: center;width: 10%;">Terkini</th>
  </tr>
   <?php
   if(!empty($id_ijasah)){
     foreach($ambil_berkas_data as $row){
       if (in_array($row['id_berkas'],$id_ijasah)) {
   ?>
     <tr>
     <td class="border-1" style="padding: 5px;vertical-align: middle;">
          Jenis Berkas : <?php echo $row['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row['nama_berkas']; ?>,<br>
          Lulus Tahun : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))) ?>
     </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
     </tr>
   <?php
       }
     }
   }
   if($id_str!==""){
     foreach($ambil_berkas_data as $row2){
       if (in_array($row2['id_berkas'],$id_str)) {
   ?>
     <tr>
     <td class="border-1" style="padding: 5px;vertical-align: middle;">
         Jenis Berkas : <?php echo $row2['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row2['nama_berkas']; ?>,<br>
         Masa Berlaku : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row2['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row2['tgl_b_berkas']))) ?>
     </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
    <?php if(in_array($row2['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
    <?php if(in_array($row2['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row2['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row2['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
     </tr>
   <?php
       }
     }
   }
   if($id_sertifikat!==""){
     foreach($ambil_berkas_data as $row3){
       if (in_array($row3['id_berkas'],$id_sertifikat)) {
   ?>
     <tr>
     <td class="border-1" style="padding: 5px;vertical-align: middle;">
         Jenis Berkas : <?php echo $row3['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row3['nama_berkas']; ?>, <br>Penyelenggara : <?php echo $row3['penyelenggara']; ?>,<br>
         Tanggal : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row3['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row3['tgl_b_berkas']))) ?>, <br>SKS : <?= number_format($row3['kredit'],1) ?>
     </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row3['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row3['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row3['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row3['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
     </tr>
   <?php
       }
     }
   }
 //  if($id_ijasah!==""){
   if(!empty($id_berkas)){ 
     foreach($ambil_berkas_data as $row4){
       if (in_array($row4['id_berkas'],$id_berkas)) {
   ?>
     <tr>
   <td class="border-1" style="padding: 5px;vertical-align: middle;">
        Jenis Berkas : <?php echo $row4['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row4['nama_berkas']; ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row4['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row4['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row4['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
   <td class="border-1" style="vertical-align: middle;text-align: center; ">
     <?php if(in_array($row4['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)){ echo $gbrclist; } ?>
   </td>
     </tr>
   <?php
       }
     }
   }
   $kondisietik=array("id_pegawai"=>$apk["id_pegawai"],"DATE_FORMAT(tgl_etik_pegawai,'%Y')"=>date('Y'));
   $jml_etik = $this->m_umum->jumlah_record_filter('ol_etik_pegawai',$kondisietik);
   if($jml_etik > 0){
   ?>
   <tr>
   <td colspan="5" class="border-1" style="padding: 5px;vertical-align: middle;text-align: left;font-weight: bold; ">ETIKA PROFESI</td>
   </tr>
   <tr>
   <td colspan="5" class="border-1">
     <table class="table">
         <tr>
           <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;">Tanggal</td>
           <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;">Hasil</td>
           <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;">Penguji</td>
           <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;width: 10%;">Memadai</td>
           <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;width: 10%;">Valid</td>
           <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;width: 10%;">Asli</td>
           <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;width: 10%;">Terkini</td>
         </tr>
       <?php
         foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
           if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$id_etik_pegawai)) {
       ?>
         <tr>
         <td class="border-1" style="padding: 5px;vertical-align:middle;text-align: center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
         <td class="border-1" style="padding: 5px;vertical-align:middle;text-align: center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
         <td class="border-1" style="padding: 5px;vertical-align:middle;text-align: center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
         <td class="border-1" style="padding: 5px;vertical-align:middle;text-align: center;">
          <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)){ echo $gbrclist; } ?>
         </td>
         <td class="border-1" style="padding: 5px;vertical-align: middle;text-align: center; ">
           <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik2",$kesesuaian_bukti)){ echo $gbrclist; } ?>
         </td>
         <td class="border-1" style="padding: 5px;vertical-align: middle;text-align: center; ">
           <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik3",$kesesuaian_bukti)){ echo $gbrclist; } ?>
         </td>
         <td class="border-1" style="padding: 5px;vertical-align: middle;text-align: center; ">
           <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik4",$kesesuaian_bukti)){ echo $gbrclist; } ?>
         </td>
         </tr>
       <?php
           }
         }
       ?>
     </table>
   </td>
   </tr>
   <?php  
    }
   ?>
 </table>
 <br style="line-height:1;">
 <table class="table">
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