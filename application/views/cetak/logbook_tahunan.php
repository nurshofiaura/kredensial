<?php 
$this->load->view('style');
$adata = $this->m_umum->ambil_data('a_data','id_data','1');
$member = $this->m_umum->ambil_data('pegawai','id_pegawai',$member_id);
$fcolor = $adata['fcolor'];
$color = $adata['color'];		

$tahun = date('Y', strtotime($first_date));
foreach(range(1, 12) as $bulan){
	$kondisi_dlm_bulan = array('month(tgl_logbook)'=>$bulan,'year(tgl_logbook)'=>$tahun,'id_pegawai'=>$member_id);
	$jml_dlm_bulan = $this->m_umum->jumlah_record_filter('logbook',$kondisi_dlm_bulan);
	if($jml_dlm_bulan > 0){
?>

<div class="header-report">
	<div class="center">				
		<h4><b><?= $header ?></b></h4>
		<h4><b>PERIODE : <?php echo $this->m_rancak->getBulan($bulan); ?> - <?php echo $tahun; ?></b></h4>
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
$awal	= $tahun.'-'.$bulan.'-01';
$tglakhir = date('t', strtotime($awal));	

foreach (range(1, $tglakhir) as $tanggal) {
	$akhir	= $tahun.'-'.$bulan.'-'.$tanggal;
	$ambil_range_detil = $this->m_profil->ambil_range_logbook_bulanane_detil($akhir,$member_id);
	foreach($ambil_range_detil as $rowambil_range_detil){
		  ?>
		<tr style="border: 1px solid black;">
			<td colspan="3" style="padding: 5px;vertical-align:middle;text-align:left;font-weight:bold;">
			Tanggal <?php echo $tanggal; ?>-<?php echo $bulan; ?>-<?php echo $tahun; ?>
			</td>
		</tr>	
		<tr style="border: 1px solid black;">
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $rowambil_range_detil['nama_kewenangan']; ?></td>
			<td style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:right;"><?php echo $rowambil_range_detil['jml_logbook']; ?></td>
		</tr>
	<?php
	}
}
	?>
		<tr style="border: 1px solid black;">
			<td colspan="3" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
		</tr>	
	  </tbody>
	</table>  	
</div>

<?php
	$kondisi_dlm_bulan_next = array('month(tgl_logbook)'=>$bulan+1,'year(tgl_logbook)'=>$tahun,'id_pegawai'=>$member_id);
	$jml_dlm_bulan_next = $this->m_umum->jumlah_record_filter('logbook',$kondisi_dlm_bulan_next);
	if($jml_dlm_bulan_next > 0){
		
?>
<pagebreak>
</pagebreak>
<?php
	}
	}
}
?>
<div class="clear">&nbsp;</div>