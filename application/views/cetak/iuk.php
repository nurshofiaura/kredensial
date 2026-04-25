<?php 
  $this->load->view('style');
?>
<div class="header-report">
  <div class="center">        
    <h3><b>DAFTAR PERTANYAAN LISAN</b></h3>  
  </div>
  <br style="line-height:1;">
</div>
<div class="content-report">
<table class="table">
<thead>
  <tr>
    <th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Asesmen</th>
    <th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Indikator Unjuk Kerja</th>
    <th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Poin Yang Di Amati</th>
    <th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Pertanyaan</th>
    <th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Indikator Ketercapaian</th>
    <th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Stndar Jawaban</th>
  </tr>
</thead>
  <tbody>
  <?php
  $kondisi1 = array('nas.instansi_asesmen'=>$this->session->refer,'status_indikator'=>1);
$kompetensi = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nas.id_elemen','nas.id_elemen','ASC',$kondisi1);
    foreach ($kompetensi as $rowkompetensi)
    {
  ?>
<tr style="border: 1px solid black;">
  <td colspan="6" class="border-1" style="padding: 10px;border-left: 0px solid;font-weight: bold;vertical-align:middle;text-align:left;">
    <?= $rowkompetensi['nama_elemen'] ?>
  </td>
</tr> 
  <?php
    $kondisi11 = array('nas.id_elemen'=>$rowkompetensi['id_elemen'],'status_indikator'=>1);
    $elemen = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nin.id_asesmen','nin.id_asesmen','ASC',$kondisi11);            
      foreach ($elemen as $rowelemen)
      {
  ?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowelemen['nama_asesmen'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowelemen['nama_indikator'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowelemen['poin_indikator'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowelemen['pertanyaan_indikator'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowelemen['ketercapaian_indikator'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowelemen['jawaban_indikator'] ?></td>
</tr> 
  <?php   
      }
    }
  ?>
</tbody>
</table>
  <div class="clear">&nbsp;</div>
</div>