<?php 
  $this->load->view('style');
$metode = $this->m_umum->ambil_data('nkr_metode');
$perangkat  = $this->m_umum->ambil_data('nkr_perangkat');
?>
<div class="header-report">
  <div class="center">        
    <h3><b>DAFTAR METODE DAN PERANGKAT ASESMEN</b></h3>  
  </div>
  <br style="line-height:1;">
</div>
<div class="content-report">
<table class="table">
  <tbody>
  <?php
  $kondisi1 = array('nas.instansi_asesmen'=>$this->session->refer,'status_indikator'=>1);
$kompetensi = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nas.id_elemen','nas.id_elemen','ASC',$kondisi1);
    foreach ($kompetensi as $rowkompetensi)
    {
  ?>
  <tr>
    <td colspan="6" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:left;"><?= $rowkompetensi['nama_elemen'] ?></td>
  </tr>
  <?php
  $kondisi11 = array('nas.id_elemen'=>$rowkompetensi['id_elemen'],'status_indikator'=>1);
$elemen = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nin.id_asesmen','nin.id_asesmen','ASC',$kondisi11);            
      foreach ($elemen as $rowelemen)
      {
  ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="5" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $rowelemen['nama_asesmen'] ?></td>
  </tr>
  <?php
  $kondisi111 = array('nin.id_asesmen'=>$rowelemen['id_asesmen'],'status_indikator'=>1);
$indikator = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nin.id_indikator','nin.id_indikator','ASC',$kondisi111,'nojoin');  
      foreach ($indikator as $rowindikator)
      {
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $rowindikator['nama_indikator'] ?></td>
    <td>&nbsp;</td>
    <td1>&nbsp;</td>
  </tr>
  <?php  
  if(!empty($rowindikator['metode_indikator']) || !empty($rowindikator['perangkat_indikator'])){
  ?>
  <tr>
  <td style="width:3%;">&nbsp;</td>
  <td style="width:3%;">&nbsp;</td>
  <td style="padding: 5px;vertical-align:middle;text-align:left;"><?php if(!empty($rowindikator['metode_indikator'])){ echo 'METODE ASSMEN'; } ?></td>
  <td style="padding: 5px;vertical-align:middle;text-align:left;"><?php if(!empty($rowindikator['perangkat_indikator'])){ echo 'PERANGKAT ASSMEN'; } ?></td>
  <td style="width:3%;">&nbsp;</td>
  <td style="width:3%;">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="padding: 5px;vertical-align:middle;text-align:left;">
      <ul>
  <?php
  if(!empty($rowindikator['metode_indikator'])){
      foreach($metode as $rowmetode){
        if (in_array($rowmetode['id_metode'],explode(",", $rowindikator['metode_indikator']))) {
          echo '<li>'.$rowmetode['nama_metode'].'</li>';
        }
      }
  }
  ?>  </ul>          
    </td>
    <td style="padding: 5px;vertical-align:middle;text-align:left;">
       <ul>
  <?php
  if(!empty($rowindikator['perangkat_indikator'])){
    foreach($perangkat as $rowperangkat){
      if (in_array($rowperangkat['id_perangkat'],explode(",", $rowindikator['perangkat_indikator']))) {
        echo '<li>'.$rowperangkat['nama_perangkat'].'</li>';
      }
    }
  }
  ?>  </ul>               
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php   
  }
        }
      }
    }
  ?>
</tbody>
</table>
  <div class="clear">&nbsp;</div>
</div>