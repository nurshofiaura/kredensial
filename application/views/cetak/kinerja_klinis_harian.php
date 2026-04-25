<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$member = $this->m_umum->ambil_data('pegawai','id_pegawai',$id_pegawai);
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
?>
<div class="header-report">
	<div class="center">				
		<h4><b><?= $header ?></b></h4>
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
					<th style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center;width:2%;">PK</th>
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
						$print_logbook_bulanane = $this->m_berkas->print_logbook_bulanane($bulan,$tahun,$id_pegawai);
						foreach($print_logbook_bulanane as $row){
							$no++;
					?>
				<tr>
					<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo $no; ?></td>
					<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:left"><?php echo $row['nama_kewenangan']; ?></td>
					<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center"><?php echo substr($row['nama_kode_kewenangan'],3); ?></td>
					<?php		
					foreach (range(1, $tglakhir) as $numbers) {
						$tglenya	= $tahun.'-'.$bulan.'-'.$numbers;
						$this->db->select("COUNT(*) as num");
						$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
						$this->db->where('tgl_logbook',$tglenya);
						$this->db->where("id_pegawai", $id_pegawai);
						$this->db->where("tgl_logbook", $tglenya);
						$this->db->where("id_kewenangan", $row['id_kewenangan']);
						$qx = $this->db->get('logbook lp')->row();
						$jml = $qx->num;
						if($jml == 0){		
					?>
					<td style="font-size: 0.8em;font-weight:bold;border: 1px solid black;vertical-align:middle;text-align:center">0</td>
					<?php
						}else{
							$this->db->select('SUM(jml_logbook) as jumlahe');
							$this->db->join('kr_kewenangan_detil kd', 'kd.id_kewenangan_detil=lp.id_kewenangan_detil','left');
							$this->db->where("id_pegawai", $id_pegawai);
							$this->db->where("tgl_logbook", $tglenya);
							$this->db->where("id_kewenangan", $row['id_kewenangan']);
							$q = $this->db->get('logbook lp')->result_array();	
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