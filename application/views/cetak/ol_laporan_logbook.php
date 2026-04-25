<?php 
$this->load->view('style');
$adata = $this->m_umum->ambil_data('a_data','id_data','1');
$fcolor = $adata['fcolor'];
$color = $adata['color'];		
foreach($ambil_bulan as $rowambil_bulan){
$bln = date('m',strtotime($rowambil_bulan[$tgl_item]));
$thn = date('Y',strtotime($rowambil_bulan[$tgl_item]));
$ketbulan = date('Y-m',strtotime($rowambil_bulan[$tgl_item]));
$awal = $ketbulan.'-01';
$tglakhir = date('t', strtotime($awal));
$akhir  = $ketbulan.'-'.$tglakhir;
?>
<style>
@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
</style>
<div class="header-report">
	<div class="center">				
		<h4><b><?= $header_laporan ?></b></h4>
    <h4><b><?= $judul_laporan_tabel ?></b></h4>
		<h4><b>PERIODE BULAN : <?= $this->m_rancak->getBulan($bln) ?> &nbsp;TAHUN : <?= $thn ?> </b></h4>
	</div>
</div>
<div class="content-report">	
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
              <div class="clear">&nbsp;</div>
              <h3 class="box-title" style="font-weight: bold;"><?= $rowkat[$nama_kat] ?></h3>
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
<div class="pagebreak"> </div>
<?php
	}
?>
<div class="clear">&nbsp;</div>