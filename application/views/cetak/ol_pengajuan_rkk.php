<?php 
$this->load->view('style');
$adata = $this->m_umum->ambil_data('a_data','id_data','1');
$signature = $this->m_ol_rancak->ambil_data_pengajuan_signature($id);
$ceklist=base_url().'assets/images/ceklistblack.png';
$gbrclist = '<img src="'.$ceklist.'" class="user-image" alt="User Image" style="height: 15px;">';
$img = $this->m_umum->ambil_data('kol_gambar','id_gambar',$signature['id_gambar']);
$fcolor = $adata['fcolor'];
$color = $adata['color'];
if(!empty($signature['tambahan'])){
 $gabungan = $signature['kewenangan'].','.$signature['tambahan'];
}else{
 $gabungan = $signature['kewenangan'];
}
if($signature['kop_signature'] == 1){
 if(!empty($img['link_gambar']) && $img['id_gambar'] > 0){
?>
  <div class="header-report">
   <div class="center">
  <img src="<?= base_url('assets/berkas/kop/') ?><?= $img['link_gambar'] ?>" class="user-image" alt="User Image" style="width: 900px;">
   </div>
  </div>
  <br style="line-height:1;">
<?php
 }
}
?>
<div class="header-report">
 <div class="left">
  <table class="table">
<?php if(!empty($signature['lampiran'])){ echo '<tr><td style="text-align:left;width:15%;padding-left: 14px;" >Lampiran</td><td style="text-align:center;width:3%;" >:</td><td style="text-align:left;" >'.$signature['lampiran'].'</td></tr>'; } ?>
<?php if(!empty($signature['no'])){ echo '<tr><td style="text-align:left;width:15%;padding-left: 14px;" >No</td><td style="text-align:center;width:3%;" >:</td><td style="text-align:left;" >'.$signature['no'].'</td></tr>'; } ?>
<?php if(!empty($signature['tanggal'])){ echo '<tr><td style="text-align:left;width:15%;padding-left: 14px;" >Tanggal</td><td style="text-align:center;width:3%;" >:</td><td style="text-align:left;" >'.$signature['tanggal'].'</td></tr>'; } ?>
  </table>  
 </div>
 <br style="line-height:1;">
 <div class="center"> 
  <?php if(!empty($signature['header'])){ echo '<h4><b>'.$signature['header'].'</b></h4>'; } ?>
  <?php if(!empty($signature['sub_header'])){ echo '<h4><b>'.$signature['sub_header'].'</b></h4>'; } ?>
  <?php if(!empty($signature['sub_sub_header'])){ echo '<h4><b>'.$signature['sub_sub_header'].'</b></h4>'; } ?>
 </div>
</div>
<div class="content-report">
 <br style="line-height:1;">
 <div class="left" style="margin-left: 14px;"> 
  <?php if(!empty($signature['sebelum'])){ echo $signature['sebelum']; } ?>
 </div>
 <br style="line-height:1;">
 <table class="table">
   <tr> 
    <td rowspan="2" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;width: 15%;" class="border-1 bg-dark">Kode Unit</td>    
    <td rowspan="2" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">Nama Kompetensi</td>    
    <td colspan="3" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;" class="border-1 bg-dark">Batas Kewenangan</td>    
   </tr>
   <tr> 
    <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;width: 15%;" class="border-1 bg-dark">Kompeten</td>    
    <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;width: 15%;" class="border-1 bg-dark">Mentorship</td>    
    <td style="padding: 5px;vertical-align:middle;font-weight: bold;text-align: center;width: 15%;" class="border-1 bg-dark">Tidak Kompeten</td>    
   </tr>
<?php
 $knds_grup = array('id_jabatan'=>$signature['id_jabatan']);
 $komp = $this->m_ol_rancak->kewenangan_kompetensi($knds_grup,'coun_kewenangan',$gabungan,'nama_kompetensi','ASC','nkr_kewenangan.id_kompetensi');
 foreach ($komp as $rowkomp){
?>
  <tr>
    <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align: center;"><?= $rowkomp['kode_unit'] ?></td>
    <td colspan="4" class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;"><?= $rowkomp['nama_kompetensi'] ?></td>
<!--    <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;">&nbsp;</td>
    <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;">&nbsp;</td>
    <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;">&nbsp;</td> -->
  </tr>
<?php 
$knds = array('id_jabatan'=>$signature['id_jabatan'],'nkr_kewenangan.id_kompetensi'=>$rowkomp['id_kompetensi']);
 $kw = $this->m_ol_rancak->kewenangan_kompetensi($knds,'coun_kewenangan',$gabungan,'nama_kewenangan','ASC');
  foreach ($kw as $rowkw){
?>
  <tr>
 <!--   <td class="border-1" style="padding: 5px;vertical-align:middle;">&nbsp;</td> -->
    <td colspan="2" class="border-1" style="padding-top: 5px; padding-right: 5px; padding-bottom: 5px; padding-left: 50px;vertical-align:middle;"><?= $rowkw['nama_kewenangan'] ?></td>
    <td class="border-1" style="padding: 5px;vertical-align:middle;text-align: center;">
     <?php
      $knds_st1 = array('barcode_pegawai'=>$signature['barcode_pegawai'],'id_kewenangan'=>$rowkw['id_kewenangan'],'status_rkk'=>1);
      $knds_kw = array('barcode_pegawai'=>$signature['barcode_pegawai'],'id_kewenangan'=>$rowkw['id_kewenangan']);
      $jml_kw = $this->m_umum->jumlah_record_filter('ol_rkk',$knds_kw); 
      $jml_st1 = $this->m_umum->jumlah_record_filter('ol_rkk',$knds_st1); 
      if($jml_kw == 0){
       echo $gbrclist;
      }else if($jml_st1 > 0){
       echo $gbrclist;
      }
     ?>
    </td>
    <td class="border-1" style="padding: 5px;vertical-align:middle;text-align: center;">
     <?php
      $knds_st2 = array('barcode_pegawai'=>$signature['barcode_pegawai'],'id_kewenangan'=>$rowkw['id_kewenangan'],'status_rkk'=>2);
      $jml_st2 = $this->m_umum->jumlah_record_filter('ol_rkk',$knds_st2); 
      if($jml_st2 > 0){
       echo $gbrclist;
      }
     ?>     
    </td>
    <td class="border-1" style="padding: 5px;vertical-align:middle;text-align: center;">
     <?php
      $knds_st3 = array('barcode_pegawai'=>$signature['barcode_pegawai'],'id_kewenangan'=>$rowkw['id_kewenangan'],'status_rkk'=>3);
      $jml_st3 = $this->m_umum->jumlah_record_filter('ol_rkk',$knds_st3); 
      if($jml_st3 > 0){
       echo $gbrclist;
      }
     ?>       
    </td>
  </tr>
<?php
   }
  }
?> 
 </table>
 <br style="line-height:1;">
 <div class="left" style="margin-left: 14px;"> 
  <?php if(!empty($signature['sesudah'])){ echo $signature['sesudah']; } ?>
 </div>
 <br style="line-height:1">
<br style="line-height:1">
<?php 
if(empty($signature['tengah_nama'])){
?>
<table width="100%" style="border:none;" cellspacing="0" cellpadding="0">
<tr>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:45%;">
<?= $signature['kiri_tgl'] ?><br style="line-height:1">
<?= $signature['kiri_top'] ?><br style="line-height:1">
<?= $signature['kiri_middle'] ?>
<?php
if($signature['kiri_signature'] == 1){
 $left_ttd = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$signature['kiri_nama']);
  if(empty($signature['kiri_nama']) || $signature['kiri_nama'] == 0){
    echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
  }else{
    if(empty($left_ttd['ttd_pegawai'])){
      echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
    }else{
    ?>
      <div class="center"><img src='<?=base_url("assets/berkas/im/".$left_ttd['ttd_pegawai']) ?>' class="user-image" alt="User Image" style="height: 60px"></div>
    <?php
    }
  }
}else{
  echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
}
?>
<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">
<?php 
if(empty($signature['kiri_nama'])){
  echo $signature['kiri_nama'];
}else{
 if($signature['kiri_signature'] == 1){
  echo $left_ttd['nama_pegawai'];
 }else{
  echo "";
 }
}
?>
<br style="line-height:1">
<?= $signature['kiri_nip'] ?>
</td>
<td style="vertical-align:middle;text-align:center;width:10%;">&nbsp;</td>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:45%;">
<?= $signature['kanan_tgl'] ?><br style="line-height:1">
<?= $signature['kanan_top'] ?><br style="line-height:1">
<?= $signature['kanan_middle'] ?><br style="line-height:1">
<?php
if($signature['kanan_signature'] == 1){
 $right_ttd = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$signature['kanan_nama']);
  if(empty($signature['kanan_nama']) || $signature['kanan_nama'] == 0){
    echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
  }else{
    if(empty($right_ttd['ttd_pegawai'])){
      echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
    }else{
    ?>
      <div class="center"><img src='<?=base_url("assets/berkas/im/".$right_ttd['ttd_pegawai']) ?>' class="user-image" alt="User Image" style="height: 60px"></div>
    <?php
    }
  }
}else{
  echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
}
?>
<?php 
if(empty($signature['kanan_nama'])){
  echo $signature['kanan_nama'];
}else{
 if($signature['kanan_signature'] == 1){
  echo $right_ttd['nama_pegawai'];
 }else{
  echo "";
 }
}
?>
<br style="line-height:1">
<?= $signature['kanan_nip'] ?>
</td>
</tr>
</table>
<?php
}else{
?>
<table width="100%" style="border:none;" cellspacing="0" cellpadding="0">
<tr>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;">
<?= $signature['kiri_tgl'] ?><br style="line-height:1">
<?= $signature['kiri_top'] ?><br style="line-height:1">
<?= $signature['kiri_middle'] ?><br style="line-height:1"><br style="line-height:1">
<?php
if($signature['kiri_signature'] == 1){
 $left_ttd = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$signature['kiri_nama']);
  if(empty($signature['kiri_nama']) || $signature['kiri_nama'] == 0){
    echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
  }else{
    if(empty($left_ttd['ttd_pegawai'])){
      echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
    }else{
    ?>
      <div class="center"><img src='<?=base_url("assets/berkas/im/".$left_ttd['ttd_pegawai']) ?>' class="user-image" alt="User Image" style="height: 60px"></div>
    <?php
    }
  }
}else{
  echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
}
?>
<?php 
if(empty($signature['kiri_nama'])){
  echo $signature['kiri_nama'];
}else{
 if($signature['kiri_signature'] == 1){
  echo $left_ttd['nama_pegawai'];
 }else{
  echo "";
 }
}
?>
<br style="line-height:1">
<?= $signature['kiri_nip'] ?>
</td>
<td style="vertical-align:middle;text-align:center;width:5%;">&nbsp;</td>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;">
<?= $signature['tengah_tgl'] ?><br style="line-height:1">
<?= $signature['tengah_top'] ?><br style="line-height:1">
<?= $signature['tengah_middle'] ?><br style="line-height:1"><br style="line-height:1">
<?php
if($signature['tengah_signature'] == 1){
  $mid_ttd = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$signature['tengah_nama']);
  if(empty($signature['tengah_nama']) || $signature['tengah_nama'] == 0){
    echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
  }else{
    if(empty($mid_ttd['ttd_pegawai'])){
      echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
    }else{
    ?>
      <div class="center"><img src='<?=base_url("assets/berkas/im/".$mid_ttd['ttd_pegawai']) ?>' class="user-image" alt="User Image" style="height: 60px"></div>
    <?php
    }
  }
}else{
  echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
}
?>
<?php 
if(empty($signature['tengah_nama'])){
  echo $signature['tengah_nama'];
}else{
 if($signature['tengah_signature'] == 1){
  echo $mid_ttd['nama_pegawai'];
 }else{
  echo "";
 }
}
?>
<br style="line-height:1">
<?= $signature['tengah_nip'] ?>
</td>
<td style="vertical-align:middle;text-align:center;width:5%;">&nbsp;</td>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;">
<?= $signature['kanan_tgl'] ?><br style="line-height:1">
<?= $signature['kanan_top'] ?><br style="line-height:1">
<?= $signature['kanan_middle'] ?><br style="line-height:1"><br style="line-height:1">
<?php
if($signature['kanan_signature'] == 1){
 $right_ttd = $this->m_umum->ambil_data('ol_pegawai','barcode_pegawai',$signature['kanan_nama']);
  if(empty($signature['kanan_nama']) || $signature['kanan_nama'] == 0){
    echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
  }else{
    if(empty($right_ttd['ttd_pegawai'])){
      echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
    }else{
    ?>
      <div class="center"><img src='<?=base_url("assets/berkas/im/".$right_ttd['ttd_pegawai']) ?>' class="user-image" alt="User Image" style="height: 60px"></div>
    <?php
    }
  }
}else{
  echo '<br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">';
}
?>
<?php 
if(empty($signature['kanan_nama'])){
  echo $signature['kanan_nama'];
}else{
 if($signature['kanan_signature'] == 1){
  echo $right_ttd['nama_pegawai'];
 }else{
  echo "";
 }
}
?>
<br style="line-height:1">
<?= $signature['kanan_nip'] ?>
</td>
</tr>
</table>
<?php
}
?>

  <div class="clear">&nbsp;</div>
</div>