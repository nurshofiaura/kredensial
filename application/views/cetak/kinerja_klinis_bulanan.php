<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$member = $this->m_umum->ambil_data('pegawai','id_pegawai',$id_pegawai);
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];		
	$ambil_range = $this->m_berkas->ambil_range_logbook_bulanane($bulan,$tahun,$id_pegawai);
?>
<div class="header-report">
	<div class="center">				
		<h4><b><?= $header ?></b></h4>
	</div>
</div>
	  <br style="line-height:1">
<div class="content-report">
   <table class="table">
	<thead>
		<tr style="border: 1px solid black;">
		  <th colspan="2" style="background-color: #808080;color: white;padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;">KATEGORI PEMERIKSAAN</th>
		  <th style="background-color: #808080;color: white;padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;">JUMLAH PEMERIKSAAN</th>
	  </tr>
	</thead>
	  <tbody>	
		  <?php
			foreach($ambil_range as $rowambil_range){
		  ?>
		<tr style="border: 1px solid black;">
			<td colspan="3" style="padding: 5px;vertical-align:middle;text-align:left;font-weight:bold;">PERIODE : 
			<?php echo $this->m_rancak->getBulan($rowambil_range['bulan']); ?> - <?php echo $rowambil_range['tahun']; ?>
			</td>
		</tr>				  
		  <?php
				$ambil_range_detil = $this->m_berkas->ambil_range_logbook_bulanane_detil($rowambil_range['bulan'],$rowambil_range['tahun'],$id_pegawai);
				foreach($ambil_range_detil as $rowambil_range_detil){
		  ?>
		<tr style="border: 1px solid black;">
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_detil['nama_kewenangan']; ?></td>
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;"><?php echo $rowambil_range_detil['jumlah']; ?></td>
		</tr>
		  <?php
				}
		  ?>
		<tr style="border: 1px solid black;">
			<td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
		</tr>	
		  <?php
			}
		  ?>
	  </tbody>
	</table>
	<div class="clear">&nbsp;</div>
</div>