<?php 
$this->load->view('style');
$adata = $this->m_umum->ambil_data('a_data','id_data','1');
$member = $this->m_umum->ambil_data('pegawai','id_pegawai',$member_id);
$fcolor = $adata['fcolor'];
$color = $adata['color'];		
$ambil_range_detil = $this->m_profil->pdf_logbook($id);
$ambil_tgl_awal_logbook = $this->m_profil->ambil_tgl_awal_logbook($id);
$ambil_tgl_akhir_logbook = $this->m_profil->ambil_tgl_akhir_logbook($id);
?>
<div class="header-report">
	<div class="center">				
		<h4><b><?= $header ?></b></h4>
		<h4><b>BUKU CATATAN PRIBADI</b></h4>
		<h4><b>PERIODE : <?php echo $ambil_tgl_awal_logbook['tgl_logbook']; ?> - <?php echo $ambil_tgl_akhir_logbook['tgl_logbook']; ?></b></h4>
	</div>
</div>
<br style="line-height:1">
<div class="content-report">	
   <table class="table">
	<thead>
		<tr style="border: 1px solid black;">
		  <th style="background-color: #808080;color: white;padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;">TANGGAL</th>
		  <th style="background-color: #808080;color: white;padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;">KEWENANGAN</th>
		  <th style="background-color: #808080;color: white;padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;">KOMPETENSI</th>
		  <th style="background-color: #808080;color: white;padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;">JUMLAH</th>
	  </tr>
	</thead>
	  <tbody>		  
		  <?php
	
	foreach($ambil_range_detil as $rowambil_range_detil){
		  ?>	
		<tr style="border: 1px solid black;">
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_detil['tgl_logbook']; ?></td>
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_detil['nama_kewenangan']; ?></td>
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_detil['nama_kompetensi']; ?></td>
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;"><?php echo $rowambil_range_detil['jml_logbook']; ?></td>
		</tr>
		<?php
	}
		?>
	  </tbody>
	</table>  
	<br style="line-height:1">	
</div>
<div class="clear">&nbsp;</div>