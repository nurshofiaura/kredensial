<?php
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$member = $this->m_umum->ambil_data('pegawai','id_pegawai',$id_pegawai);
	$ruangan = $this->m_umum->ambil_data('ruangan','id_ruangan',$member['id_ruangan']);
	$jabfunge = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$member['id_jabatan_fungsional']);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','3');
?>
<div class="header-report">
	<div class="center">
		<h3><b><?= $instansi['nama_instansi'] ?></b></h3>
		<h4><b><?= $title; ?> <?= $tahun; ?></b></h4>
	</div>
	<div class="right">
		<div class="right py-2">
			<table class="table">
				<tbody>
					<tr>
						<td align="center" class="border-1 bg-dark">Nama Pegawai</td>
						<td width="10"></td>
						<td align="center" class="border-1 bg-dark">Nomor Induk Pegawai / Karyawan</td>
					</tr>
					<tr>
						<td align="center" class="border-1"><?= $member['nama_pegawai'] ?></td>
						<td>&nbsp;</td>
						<td align="center" class="border-1"><?= $member['nip'] ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="left">
		<table class="table" style="margin-top: 5px;">
			<tbody>
					<tr>
						<td align="center" class="border-1 bg-dark">Jabatan Fungsional</td>
						<td width="10"></td>
						<td align="center" class="border-1 bg-dark">Ruangan</td>
					</tr>
					<tr>
						<td align="center" class="border-1"><?php echo $jabfunge['nama_jabatan_fungsional']; ?></td>
						<td>&nbsp;</td>
						<td align="center" class="border-1"><?= $ruangan['nama_ruangan'] ?></td>
					</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="content-report">
				   <table width="100%" class="table table-border">
						<thead>
								<tr>
									<th class="center py-1 px-1 bg-dark" style="font-size: 0.9em;vertical-align:middle;font-weight:bold;width:12%;">Tanggal Awal</th>
									<th class="center py-1 px-1 bg-dark" style="font-size: 0.9em;vertical-align:middle;font-weight:bold;width:12%;">Tanggal Akhir</th>
									<th class="center py-1 px-1 bg-dark" style="font-size: 0.9em;vertical-align:middle;font-weight:bold;width:15%">Ruangan</th>
									<th class="center py-1 px-1 bg-dark" style="font-size: 0.9em;vertical-align:middle;font-weight:bold;width:15%">Penanggung Jawab</th>
									<th class="center py-1 px-1 bg-dark" style="font-size: 0.9em;vertical-align:middle;font-weight:bold;width:15%">Tempat</th>
									<th class="center py-1 px-1 bg-dark" style="font-size: 0.9em;vertical-align:middle;font-weight:bold;">Hasil</th>
									<th class="center py-1 px-1 bg-dark" style="font-size: 0.9em;vertical-align:middle;font-weight:bold;">Catatan</th>
								</tr>
						</thead>
						<tbody>
						<?php
							$ambil_lobook_pemulihan_pertahun = $this->m_rancak->ambil_lobook_pemulihan_pertahun($member['id_pegawai'],$tahun);
							foreach($ambil_lobook_pemulihan_pertahun as $rowambil_lobook_pemulihan_pertahun){
						?>
					  <tr> 
					    <td class="center py-1 px-1" style="font-size: 0.9em;verfont-size: 0.9em;vertical-align:middle;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_pertahun['tgl_awal'])) ?></td>
					    <td class="center py-1 px-1" style="font-size: 0.9em;vertical-align:middle;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_pertahun['tgl_akhir'])) ?></td>
					    <td class="left py-1 px-1" style="font-size: 0.9em;vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['nama_ruangan'] ?></td>
					    <td class="left py-1 px-1" style="font-size: 0.9em;vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['penanggungjawab'] ?></td>
					    <td class="left py-1 px-1" style="font-size: 0.9em;vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['tujuan'] ?></td>
					    <td class="left py-1 px-1" style="font-size: 0.9em;vertical-align:middle;">
					    	<?php
					    		if($rowambil_lobook_pemulihan_pertahun['result_pemulihan'] == 0){
					    			echo 'Proses';
					    		}elseif($rowambil_lobook_pemulihan_pertahun['result_pemulihan'] == 1){
					    			echo 'Kompeten';
					    		}else{
					    			echo 'Tidak Kompeten';
					    		}
					    	?>
					    </td>
					    <td class="left py-1 px-1" style="vertical-align:middle;"><?= $rowambil_lobook_pemulihan_pertahun['catatan_pemulihan'] ?></td>
					  </tr>
								<tr>
									<th class="center py-1 px-1 bg-dark" colspan="7"  style="text-align: center;">KEGIATAN PEMULIHAN</th>
								</tr>
							  <tr>
							    <th style="font-size: 0.9em;vertical-align:middle;" class="center py-1 px-1 bg-dark" >Tanggal</th>
							    <th style="font-size: 0.9em;vertical-align:middle;" class="center py-1 px-1 bg-dark" >RM</th>
							    <th style="font-size: 0.9em;vertical-align:middle;" class="center py-1 px-1 bg-dark" >Penguji</th>
							    <th style="font-size: 0.9em;vertical-align:middle;" class="center py-1 px-1 bg-dark"  colspan="2">Kompetensi</th>
							    <th style="font-size: 0.9em;vertical-align:middle;" class="center py-1 px-1 bg-dark" >Hasil</th>
							    <th style="font-size: 0.9em;vertical-align:middle;" class="center py-1 px-1 bg-dark" >Catatan</th>
							  </tr>
								<?php
									$ambil_lobook_pemulihan_detil = $this->m_rancak->ambil_kewenangan_lobook_kegiatan_pemulihan_detil($rowambil_lobook_pemulihan_pertahun['id_logbook_pemulihan']);
									foreach($ambil_lobook_pemulihan_detil as $rowambil_lobook_pemulihan_detil){
								?>
							  <tr>
							    <td class="center py-1 px-1" style="font-size: 0.9em;vertical-align:middle;"><?= date('d-m-Y', strtotime($rowambil_lobook_pemulihan_detil['tgl_kegiatan_pemulihan'])) ?></td>
							    <td class="left py-1 px-1" style="font-size: 0.9em;vertical-align:middle"><?= $rowambil_lobook_pemulihan_detil['rm_kegiatan_pemulihan'] ?></td>
							    <td class="left py-1 px-1" style="font-size: 0.9em;vertical-align:middle"><?= $rowambil_lobook_pemulihan_detil['nama_pegawai'] ?></td>
							    <td class="left py-1 px-1" style="font-size: 0.9em;vertical-align:middle" colspan="2"><?= $rowambil_lobook_pemulihan_detil['nama_kewenangan'] ?></td>
							    <td class="left py-1 px-1" style="font-size: 0.9em;vertical-align:middle;">
						    	<?php
						    		if($rowambil_lobook_pemulihan_detil['result_kegiatan_pemulihan'] == 0){
						    			echo 'Proses';
						    		}elseif($rowambil_lobook_pemulihan_detil['result_kegiatan_pemulihan'] == 1){
						    			echo 'Kompeten';
						    		}else{
						    			echo 'Tidak Kompeten';
						    		}
						    	?>
							    </td>
							    <td class="left py-1 px-1" style="font-size: 0.9em;vertical-align:middle;" ><?= $rowambil_lobook_pemulihan_detil['catatan_kegiatan_pemulihan'] ?></td>
							  </tr>
						<?php
									}
							}
						?>
							</tbody>
						</table>
</div>
