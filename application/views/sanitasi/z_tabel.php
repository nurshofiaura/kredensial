<?php
	$this->load->view('style'); 
	$d	= $this->m_sanitasi->ambil_sn_laporan_detil($id2);
    $jumlah_record_tabel_limbah_detil = $this->m_sanitasi->jumlah_record_tabel_limbah_detil($id2);
    $jumlah_record_tps = $this->m_sanitasi->jumlah_record_tps($id2);
	$max_tanggal = $this->m_sanitasi->max_tanggal_lhu($id2);
	$min_tanggal = $this->m_sanitasi->min_tanggal_lhu($id2);	
	$only_blnyear_lhu = $this->m_sanitasi->only_blnyear_lhu($id2,$min_tanggal,$max_tanggal);
    $jumlah_bulan = $this->m_rancak->hitung_jumlah_bulan($min_tanggal,$max_tanggal);	
	$tabel_limbah_detil = $this->m_sanitasi->tabel_limbah_detil($id2);
 // 	$rec_baku_mutu = $this->m_sanitasi->rec_baku_mutu($id2);
?>
 <!DOCTYPE html>
<html>

<head>
<link rel="icon" href="<?php echo base_url();?>assets/berkas/icon/logosim.ico">
<style>
body{
	font-family: Times New Roman;
	font-size: 10pt;
	line-height: 1.7;
    margin: 0;	
    background-color: white;   
}
td, th {
     border: 1px solid black;
}
</style>
</head>
<body>
<div class="header-report">
		<p style="font-weight:bold;font-size: 14pt;line-height:0.5"><?= $d['judul_laporan_tabel'] ?></p>
</div>	
<br style="line-height:1">
              <table class="table">
                <tr class="px-1 py-1">
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;width:3%;"><h3>1</h3></td>
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;"><h3>TABEL</h3></td>
                </tr>                
              </table>

              <table class="table">
                <thead>
                  <tr class="bg-dark px-1 py-1">
                  	<th class="border-1 bg-light py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</th>
                  <?php  
                    if($jumlah_record_tabel_limbah_detil > 0){
                  ?>
                    <th class="px-1 py-1" style="vertical-align:middle;text-align: center;" rowspan="2">Sumber Pengukuran</th>
                  <?php  
                    }
                  ?>
                  <?php  
                    if($jumlah_record_tps > 0){
                  ?>
                    <th class="px-1 py-1" style="vertical-align:middle;text-align: center;" rowspan="2">TPS</th>
                  <?php  
                    }
                    $cols = $jumlah_bulan * 2;
                  ?>
                    <th class="px-1 py-1" style="vertical-align:middle;text-align: center;" rowspan="2">Parameter</th>
                    <th class="px-1 py-1" style="vertical-align:middle;text-align: center;" rowspan="2">Baku Mutu</th>
                    <th class="px-1 py-1" style="vertical-align:middle;text-align: center;" rowspan="2">Satuan</th>
                    <th class="px-1 py-1" style="vertical-align:middle;text-align: center;" colspan="<?= $cols ?>">Realisasi Bulan</th>
                  </tr>
                  <tr class="bg-dark px-1 py-1">
                  	<th class="border-1 bg-light py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</th>
                    <?php  
                      foreach ($only_blnyear_lhu as $rowonly_blnyear_lhu){
                    ?>
                   <th class="px-1 py-1" style="vertical-align:middle;text-align: center;"><?php echo $this->m_rancak->getsemiBulan($rowonly_blnyear_lhu['buln']); ?></th>
                   <?php  
                    }
                   ?>
                  </tr>
                </thead>
              <tbody>
                <?php  foreach($tabel_limbah_detil as $rowtabel_limbah_detil){
                ?>
                <tr class="px-1 py-1">
                	<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                  <?php  
                    if($jumlah_record_tabel_limbah_detil > 0){
                  ?>
                  <td style="vertical-align:middle;text-align: left;" class="px-1 py-1"><?= $rowtabel_limbah_detil['nama_sumber_emisi'] ?></td>
                  <?php  
                    }
                  ?>
                  <?php  
                    if($jumlah_record_tps > 0){
                  ?>
                  <td style="vertical-align:middle;text-align: left;" class="px-1 py-1"><?= $rowtabel_limbah_detil['nama_tps'] ?></td>
                  <?php  
                    }
                  ?>
                  <td style="vertical-align:middle;text-align: center;" class="px-1 py-1"><?= $rowtabel_limbah_detil['nama_limbah'] ?></td>
                  <td style="vertical-align:middle;text-align: center;" class="px-1 py-1"><?= ROUND($rowtabel_limbah_detil['standar_mutu'],3) ?> <?php if($rowtabel_limbah_detil['range_mutu'] > 0){ echo ' s.d '.ROUND($rowtabel_limbah_detil['range_mutu'],3); } ?></td>
                  <td style="vertical-align:middle;text-align: center;" class="px-1 py-1"><?= $rowtabel_limbah_detil['satuan_limbah'] ?></td>
                    <?php  
                      foreach ($only_blnyear_lhu as $rowonly_blnyear_lhu){
                         $rec_tabel_detil = $this->m_sanitasi->rec_tabel_detil($id2,$rowtabel_limbah_detil['id_limbah'],$rowonly_blnyear_lhu['blnyear'],$min_tanggal,$max_tanggal,$rowtabel_limbah_detil['id_sumber_emisi']); 
                      if($rec_tabel_detil == 0){
                    ?>
                    <td style="vertical-align:middle;text-align: center;"> - </td>
                    <?php  
                      }else{ 
                        $tabel_detil = $this->m_sanitasi->tabel_detil($id2,$rowtabel_limbah_detil['id_limbah'],$rowonly_blnyear_lhu['blnyear'],$min_tanggal,$max_tanggal,$rowtabel_limbah_detil['id_sumber_emisi']);
                        foreach($tabel_detil as $rowtabel_detil){
                    ?>
                   <td style="vertical-align:middle;text-align: center;" class="px-1 py-1"><?= round($rowtabel_detil['hasil_lhu_detil'],3) ?></td>
                   <?php  
                        }
                    }
                }
                   ?>
                </tr> 
                <?php } ?>                 
              </tbody>
              </table>
<br style="line-height:1">
              <table class="table">
                <tr class="px-1 py-1">
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;width:3%;"><h3>2</h3></td>
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;"><h3>ANALISA</h3></td>
                </tr>  
                <tr class="px-1 py-1">
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;"><p><?= $d['analisa_laporan_tabel'] ?></p></td>
                </tr>                
              </table>
<br style="line-height:1">
              <table class="table">
                <tr class="px-1 py-1">
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;width:3%;"><h3>3</h3></td>
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;"><h3>REKOMENDASI</h3></td>
                </tr>  
                <tr class="px-1 py-1">
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                	<td class="border-1 py-1 px-1" style="border-right: 0;border-top: 0;border-left: 0;border-bottom: 0;"><p><?= $d['rekomendasi_laporan_tabel'] ?></p></td>
                </tr>                
              </table>
</body>
</html>