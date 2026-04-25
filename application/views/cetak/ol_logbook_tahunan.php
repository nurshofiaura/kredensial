<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$member = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
		$kondisi_ttd = array('barcode_pegawai'=>$this->session->barcode_pegawai);
	$ttd = $this->m_umum->ambil_data_kondisi('ol_logbook_signature',$kondisi_ttd);
	$ins = $this->m_umum->ambil_data('kol_working','barcode_working',$id_ruangan);
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
/*	$thn_f = date('Y-m', strtotime($first_date)); 
	$thn_l = date('Y-m', strtotime($last_date)); 
	$start	= $thn_f.'-01';
	$end	= $thn_l.'-01';*/
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
$period = $this->m_member->laporan_tiap_bulan_logbook($select,$kondisi,$first_date,$last_date,$id_ruangan,$pxe,'YEAR(tgl_logbook)');
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
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:5%;">No</th>
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">Kegiatan</th>
	<?php
		foreach (range(1, 12) as $blan) {									
	?>
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">
			<?= $this->m_rancak->getBulan($blan) ?>
		</th>
	<?php
		}
	?>
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:5%;">Jml</th>
	</tr>
  </thead>
  <tbody>		
		<?php
			$no = 0;$total = 0;
			$kondisi2 = array('id_logbooker'=>$bcp_id_pegawai,'YEAR(tgl_logbook)'=>$tahun);
			$select3 = ("COUNT(*) as num");
			$select4 = ("SUM(jml_logbook) as jumlahe");
			if($kpkw == 0){ //kewenangan
$select2 = ("*,SUM(jml_logbook) as jumlaha,ol_logbook.id_kewenangan,nama_kewenangan as kompetensi");
$print_logbook_bulanane = $this->m_member->laporan_tiap_bulan_logbook_order($select2,$kondisi2,$first_date,$last_date,$id_ruangan,$pxe,'nkr_kewenangan.id_kompetensi','asc','ol_logbook.id_kewenangan');
			}else{
$select2 = ("*,SUM(jml_logbook) as jumlaha,nkr_kewenangan.id_kompetensi,nama_kompetensi as kompetensi");
$print_logbook_bulanane = $this->m_member->laporan_tiap_bulan_logbook_order($select2,$kondisi2,$first_date,$last_date,$id_ruangan,$pxe,'nkr_kewenangan.id_kompetensi','asc','nkr_kewenangan.id_kompetensi');				
			}
			foreach($print_logbook_bulanane as $row){
				$no++;$total = $total + $row['jumlaha'];
		?>
	<tr>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $no; ?></td>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?php echo $row['kompetensi']; ?></td>
		<?php		
		foreach (range(1, 12) as $numbers) {
			$blnrange = $tahun.'-'.sprintf("%02d", $numbers);
				if($kpkw == 0){
$kondisi3 = array('id_logbooker'=>$bcp_id_pegawai,'DATE_FORMAT(tgl_logbook,"%Y-%m")'=>$blnrange,'ol_logbook.id_kewenangan'=>$row['id_kewenangan']);
$jml = $this->m_member->jumlah_record_laporan_tiap_bulan_logbook($select3,$kondisi3,$id_ruangan,$pxe);
				}else{
$kondisi3 = array('id_logbooker'=>$bcp_id_pegawai,'DATE_FORMAT(tgl_logbook,"%Y-%m")'=>$blnrange,'nkr_kewenangan.id_kompetensi'=>$row['id_kompetensi']);
$jml = $this->m_member->jumlah_record_laporan_tiap_bulan_logbook($select3,$kondisi3,$id_ruangan,$pxe);
				}
			if($jml == 0){		
		?>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">0</td>
		<?php
			}else{
				$q = $this->m_member->total_laporan_tiap_bulan_logbook($select4,$kondisi3,$id_ruangan,$pxe);
				foreach($q as $row2){
		?>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?php echo $row2['jumlahe']; ?></td>
		<?php
				}
			}
		}
		?>
		<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?php echo $row['jumlaha']; ?></td>
	</tr>	
		<?php
			}
		?>
  </tbody>
  <thead>
	<tr class="bg-dark">
		<th colspan="2" style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;">&nbsp;</th>
		<th colspan="12" style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left;padding-left: 5px;">Total Pemeriksaan</th>
		<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;"><?= $total ?></th>
	</tr>
  </thead>
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
?>