<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$member = $this->m_umum->ambil_data('pegawai','id_pegawai',$member_id);
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$tahun = date('Y', strtotime($first_date)); 
	$bulan = date('m', strtotime($first_date)); 	
?>
<div class="header-report">
	<div class="center">				
		<h4><b><?= $header ?></b></h4>
		<h4><b>Periode : <?= $this->m_rancak->getBulan($bulan) ?> <?= $tahun ?></b></h4>
	</div>
</div>
	  <br style="line-height:1">
			<?php
			$awal	= $tahun.'-'.$bulan.'-01';
			$tglakhir = date('t', strtotime($awal));
			$akhir	= $tahun.'-'.$bulan.'-'.$tglakhir;
			?>
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
						foreach($print_logbook_bulanane as $row){
							$no++;
					?>
				<tr>
					<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $no; ?></td>
					<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?php echo $row['nama_kewenangan']; ?></td>
					<?php		
					foreach (range(1, $tglakhir) as $numbers) {
						$tglenya	= $tahun.'-'.$bulan.'-'.$numbers;
						$jml = $this->m_profil->jumlah_record_logbook($member_id,$tglenya,$row['id_kewenangan']);
						if($jml == 0){		
					?>
					<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
					<?php
						}else{
							$q = $this->m_profil->total_record_logbook($member_id,$tglenya,$row['id_kewenangan']);
							foreach($q as $row2){		
					?>
					<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $row2['jumlahe']; ?></td>
					<?php
							}
						}
					}
					?>
					<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $row['jumlaha']; ?></td>
				</tr>	
					<?php
						}
					?>
			  </tbody>
			</table> 		