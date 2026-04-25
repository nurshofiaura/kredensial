<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$member = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
	$kondisi_ttd = array('barcode_pegawai'=>$this->session->barcode_pegawai);
	$ttd = $this->m_umum->ambil_data_kondisi('ol_logbook_signature',$kondisi_ttd);
	$ins = $this->m_umum->ambil_data('kol_working','barcode_working',$id_ruangan);
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];	
?>
<style>
@media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
}
</style>
<?php 
/*$interval = DateInterval::createFromDateString('1 month');
$period   = new DatePeriod($start, $interval, $end);*/
$select = ("*");
$kondisi = array('id_logbooker'=>$bcp_id_pegawai);
$period = $this->m_member->ambil_bulan_print_logbook_perbulanane($select,$kondisi,$first_date,$last_date,'MONTH(tgl_logbook)');
foreach ($period as $dt) {
	$bt = date('Y-m',strtotime($dt['tgl_logbook']));
//    $bt = $dt->format("Y-m");
    $awal = $bt.'-01';
    $bulan = date('m',strtotime($dt['tgl_logbook']));
    $tahun = date('Y',strtotime($dt['tgl_logbook']));
	$tglakhir = date('t', strtotime($awal));
	$akhir	= $bt.'-'.$tglakhir;	
	?>
<div class="header-report">
	<div class="center">				
		<table class="table">
			<tbody>
				<tr>
					<td style="font-weight:bold;text-align: center;"><h4>
						<?php
						if(!empty($ttd['header'])){
							echo $ttd['header'];
						}
						 ?>						
					</h4></td>
				</tr>
				<tr>
					<td style="font-weight:bold;text-align: center;"><h4>
						<?php
						if(!empty($ttd['sub_header'])){
							echo $ttd['sub_header'];
						}
						 ?>			
					</h4></td>
				</tr>
				<tr>
					<td style="font-weight:bold;text-align: center;"><h4>
						<?php
						if(!empty($ttd['sub_sub_header'])){
							echo $ttd['sub_sub_header'];
						}
						 ?>						
					</h4></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<br style="line-height:1">
<?php
if(!empty($ttd['sebelum'])){
?>
		<table class="table">
			<tbody>
				<tr>
					<td>
						<?= $ttd['sebelum'] ?>		
					</td>
				</tr>
			</tbody>
		</table>
<?php
}
?>		
<br style="line-height:1">
<table class="table">
  <thead>
	<tr class="bg-dark">
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">No</th>
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Kegiatan</th>
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
			$print_eukom_bulanane = $this->m_member->print_eukom_perbulanane($bcp_id_pegawai,$bt,$id_ruangan,$pxe);
			foreach($print_eukom_bulanane as $row){
				$no++;
		?>
	<tr>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $no; ?></td>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?php echo $row['nama_kewenangan']; ?></td>
		<?php		
		foreach (range(1, $tglakhir) as $numbers) {
			$tglenya	= $tahun.'-'.$bulan.'-'.$numbers;
			$jml = $this->m_member->jumlah_record_logbook_kewenangan($bcp_id_pegawai,$tglenya,$row['id_kewenangan'],$id_ruangan,$pxe);
			if($jml == 0){		
		?>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
		<?php
			}else{
				$q = $this->m_member->total_record_logbook_kewenangan($bcp_id_pegawai,$tglenya,$row['id_kewenangan'],$id_ruangan,$pxe);
				foreach($q as $row2){		
		?>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color: dimgrey;color: white;"><?php echo $row2['jumlahe']; ?></td>
		<?php
				}
			}
		}
		?>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;background-color: dimgrey;color: white;"><?php echo $row['jumlaha']; ?></td>
	</tr>	
		<?php
			}
		?>
  </tbody>
</table>
<br style="line-height:1">
<?php
if(!empty($ttd['sesudah'])){
?>
		<table class="table">
			<tbody>
				<tr>
					<td>
						<?= $ttd['sesudah'] ?>		
					</td>
				</tr>
			</tbody>
		</table>
<?php
}
?>						
<br style="line-height:1">
<?php 
if($break ==1){
?> 
<br style="line-height:1">
<br style="line-height:1">
<table width="100%" style="border:none;" cellspacing="0" cellpadding="0">
<tr>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;font-size:13px;">
<?= $ttd['kiri_tgl'] ?><br style="line-height:1">
<?= $ttd['kiri_top'] ?><br style="line-height:1">
<?= $ttd['kiri_middle'] ?><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">
<?= $ttd['kiri_nama'] ?><br style="line-height:1">
<?= $ttd['kiri_nip'] ?>
</td>
<td style="vertical-align:middle;text-align:center;width:5%;font-size:13px;">&nbsp;</td>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;font-size:13px;">
<?= $ttd['tengah_tgl'] ?><br style="line-height:1">
<?= $ttd['tengah_top'] ?><br style="line-height:1">
<?= $ttd['tengah_middle'] ?><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">
<?= $ttd['tengah_nama'] ?><br style="line-height:1">
<?= $ttd['tengah_nip'] ?>
</td>
<td style="vertical-align:middle;text-align:center;width:5%;font-size:13px;">&nbsp;</td>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;font-size:13px;">
<?= $ttd['kanan_tgl'] ?><br style="line-height:1">
<?= $ttd['kanan_top'] ?><br style="line-height:1">
<?= $ttd['kanan_middle'] ?><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">
<?= $ttd['kanan_nama'] ?><br style="line-height:1">
<?= $ttd['kanan_nip'] ?>
</td>
</tr>
</table>
<?php 
}
if($break ==1){ echo '<div class="pagebreak"> </div>'; }?>
<br>
<br>
<br>
<?php 
}
?>
<div class="header-report">
	<div class="center">				
		<h4><b><?= $ins['nama_working'] ?></b></h4>	
		<h4><b>REKAPITULASI PEMERIKSAAN</b></h4>
		<h4><b><?= $this->m_rancak->fullBulan($first_date) ?> s.d <?= $this->m_rancak->fullBulan($last_date) ?></b></h4>
	</div>
	<div class="right px-0 py-1">
		<table class="table">
			<tbody>
				<tr>
					<td style="font-weight:bold;" align="left" width="15%">Nama Pegawai</td>
					<td style="font-weight:bold;" align="left" width="3%">:</td>
					<td style="font-weight:bold;" align="left"><?= $member['nama_pegawai'] ?></td>
					<td style="font-weight:bold;" align="right">NIP :</td>
					<td style="font-weight:bold;" align="right" width="20%"><?= $member['nip'] ?></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<table class="table">
  <thead>
	<tr class="bg-dark">
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:5%;">No</th>
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left;">Kegiatan</th>
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:10%;">Jml</th>
	</tr>
  </thead>
  <tbody>	
<?php 
$nomer=0;
$select_total = ("*,SUM(jml_logbook) as jml_logbook");
$kondisi_total = array('id_logbooker'=>$bcp_id_pegawai);
$total = $this->m_member->ambil_bulan_total_logbook_perbulanane($select_total,$kondisi_total,$first_date,$last_date,'ol_logbook.id_kewenangan');
foreach ($total as $rowtotal) {
	$nomer++;
?>
<tr>
	<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= $nomer ?></td>
	<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?= $rowtotal['nama_kewenangan'] ?></td>
	<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?= number_format($rowtotal['jml_logbook'],0) ?></td>
</tr>
<?php 
}
?>
  </tbody>

<br style="line-height:1">
<br style="line-height:1">
<table width="100%" style="border:none;" cellspacing="0" cellpadding="0">
<tr>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;font-size:13px;">
<?= $ttd['kiri_tgl'] ?><br style="line-height:1">
<?= $ttd['kiri_top'] ?><br style="line-height:1">
<?= $ttd['kiri_middle'] ?><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">
<?= $ttd['kiri_nama'] ?><br style="line-height:1">
<?= $ttd['kiri_nip'] ?>
</td>
<td style="vertical-align:middle;text-align:center;width:5%;font-size:13px;">&nbsp;</td>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;font-size:13px;">
<?= $ttd['tengah_tgl'] ?><br style="line-height:1">
<?= $ttd['tengah_top'] ?><br style="line-height:1">
<?= $ttd['tengah_middle'] ?><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">
<?= $ttd['tengah_nama'] ?><br style="line-height:1">
<?= $ttd['tengah_nip'] ?>
</td>
<td style="vertical-align:middle;text-align:center;width:5%;font-size:13px;">&nbsp;</td>
<td style="font-weight:bold;vertical-align:middle;text-align:center;width:30%;font-size:13px;">
<?= $ttd['kanan_tgl'] ?><br style="line-height:1">
<?= $ttd['kanan_top'] ?><br style="line-height:1">
<?= $ttd['kanan_middle'] ?><br style="line-height:1"><br style="line-height:1"><br style="line-height:1">
<?= $ttd['kanan_nama'] ?><br style="line-height:1">
<?= $ttd['kanan_nip'] ?>
</td>
</tr>
</table>