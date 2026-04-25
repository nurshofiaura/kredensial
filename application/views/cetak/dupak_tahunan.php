<?php 
$this->load->view('style');
$adata = $this->m_umum->ambil_data('a_data','id_data','1');
$fcolor = $adata['fcolor'];
$color = $adata['color'];		
foreach(range(1, 12) as $bulane){
	$kondisi_dlm_bulan = array('month(tgl_logbook)'=>$bulane,'year(tgl_logbook)'=>$tahun,'id_pegawai'=>$member_id);
	$jml_dlm_bulan = $this->m_umum->jumlah_record_filter('logbook',$kondisi_dlm_bulan);
	if($jml_dlm_bulan > 0){
?>

<div class="header-report">
	<div class="center">				
		<h4><b><?= $header ?></b></h4>
		<h4><b>PERIODE : <?php echo $this->m_rancak->getBulan($bulane); ?> - <?php echo $tahun; ?></b></h4>
	</div>
</div>
<br style="line-height:1">
<div class="content-report">	
	  <br style="line-height:1">
			<?php
			$awal	= $tahun.'-'.$bulane.'-01';
			$tglakhir = date('t', strtotime($awal));
			$akhir	= $tahun.'-'.$bulane.'-'.$tglakhir;
			?>
			<table class="table" style="overflow:wrap;">
			  <thead>
				<tr class="bg-dark">
					<th class="center py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;">No</th>
					<th class="center py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;">Kegiatan</th>
				<?php
					foreach (range(1, $tglakhir) as $number) {								
				?>
					<th class="center py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;"><?= $number ?></th>
				<?php
					}
				?>
					<th class="right py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;">Jml</th>
					<th class="center py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;">AK</th>
					<th class="right py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;">JmlxAK</th>
				</tr>
			  </thead>
			  <tbody>							
				<?php
				$no = 0;$jumlah = 0;
				$print_dupak_bulanane = $this->m_profil->print_dupak_bulanane($tahun,$bulane,$member_id);
				foreach($print_dupak_bulanane as $row){
					$no++;
					$jmlak = $row['jml_logbook'] * $row['angka_kredit'];
					$jumlah = $jumlah + $jmlak;
				?>
				<tr>
					<td class="center py-5 px-5" style="font-size: 0.7em;border: 1px solid black;"><?= $no ?></td>
					<td class="center py-5 px-5" style="font-size: 0.7em;border: 1px solid black;"><?= $row['nama_butir_kegiatan'] ?></td>
					<?php	
					foreach (range(1, $tglakhir) as $numbers) {
						$tglenya	= $tahun.'-'.$bulane.'-'.$numbers;	
						$jml = $this->m_profil->jumlah_record_logbook_dupak($member_id,$tglenya,$row['id_butir_kegiatan'],$tahun,$bulane);
						if($jml == 0){
					?>
					<td class="center py-5 px-5" style="font-size: 0.7em;border: 1px solid black;">0</td>
					<?php
						}
						else{
							$q = $this->m_profil->total_record_logbook_dupak($member_id,$tglenya,$row['id_butir_kegiatan'],$tahun,$bulane);
							foreach($q as $row2){
					?>
					<td class="center py-5 px-5" style="font-size: 0.7em;border: 1px solid black;"><?= $row2['jumlahe'] ?></td>
					<?php				
							}
						}
					?>
				</tr>	
					<?php
						}
					?>
					<td class="right py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;"><?= $row['jml_logbook'] ?></td>
					<td class="right py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;"><?= round($row['angka_kredit'],4) ?></td>
					<td class="right py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;"><?= round($jmlak,4) ?></td>
					<?php
				}
					?>					
			  </tbody>
			  <tfoot>
			    <tr>
					<th colspan="<?= $tglakhir+2 ?>" class="right py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;">JUMLAH TOTAL</th>
					<th colspan="3" class="right py-5 px-5" style="font-size: 0.7em;font-weight:bold;border: 1px solid black;"><?= round($jumlah,4) ?></th>
				</tr>
			  </tfoot>
			</table> 
</div> 
<?php
	$kondisi_dlm_bulan_next = array('month(tgl_logbook)'=>$bulane+1,'year(tgl_logbook)'=>$tahun,'id_pegawai'=>$member_id);
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