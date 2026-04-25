<?php 
  $this->load->view('style');
?>
<div class="header-report">
  <div class="center">        
    <h3><b>DAFTAR PERTANYAAN ASESMEN FORM 2</b></h3>  
  </div>
  <br style="line-height:1;">
</div>
<div class="content-report">
<table class="table">
<thead>
  <tr>
    <th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:left;width: 5%;">No</th>
    <th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Pertanyaan</th>
    <th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Asesmen</th>
  </tr>
</thead>
<tbody> 
    <?php
    
    $kondisi = array('jabatan_elemen'=>$this->session->id_jabatan,'status_elemen'=>1,'instansi_elemen'=>$this->session->refer);
    $peminatan = $this->m_umum->ambil_data_kondisi_result('nkr_elemen',$kondisi);
    foreach($peminatan as $rowpeminatan){
      
    ?>
<tr style="border: 1px solid black;">
  <td colspan="3" class="border-1" style="padding: 10px;border-left: 0px solid;font-weight: bold;vertical-align:middle;text-align:left;"><?= $rowpeminatan['nama_elemen'] ?></td>
</tr> 
    <?php
      $no = 0;
      $kondisi2 = array('nkr_asesmen.id_elemen'=>$rowpeminatan['id_elemen']);
      $peminatant = $this->m_umum->ambil_data_kondisi_2tabel_result('nkr_question_f2',$kondisi2,'nkr_asesmen','id_asesmen');
      foreach($peminatant as $rowpeminatant){
        $no++;
    ?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="border-left: 0px solid;vertical-align:middle;text-align:center;width: 5%;"><?= $no ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowpeminatant['nama_question'] ?></td>
    <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowpeminatant['nama_asesmen'] ?></td>
</tr> 
  <?php
      }
    }
    ?>
</tbody>
</table>
  <div class="clear">&nbsp;</div>
</div>