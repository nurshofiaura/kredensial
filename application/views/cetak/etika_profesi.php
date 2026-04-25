<?php
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$kol_etik_detil_all = $this->m_ol_pengajuan->kol_etik_detil_all($id);
	$etik_pegawairow_all = $this->m_ol_pengajuan->etik_pegawairow_all($id);
	$member = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$etik_pegawairow_all['id_pegawai']);
	$penguji = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$etik_pegawairow_all['id_penguji']);
	$instansi = $this->m_ol_pengajuan->ambil_data_instansi_row($etik_pegawairow_all['id_pegawai']);
?>
<div class="header-report">
	<div class="center">
		<h3><b><?= $instansi['nama_working'] ?></b></h3>
		<h3><b>ETIKA PROFESI</b></h3>
	</div>
	<div class="right">
		
		<div class="right py-2">
			<table class="table">
				<tbody>
					<tr>
						<td align="center" class="border-1 bg-dark">Nama Pegawai</td>
						<td width="10"></td>
						<td align="center" class="border-1 bg-dark">Tanggal</td>
					</tr>
					<tr>
						<td align="center" class="border-1"><?= $member['nama_pegawai'] ?></td>
						<td>&nbsp;</td>
<td align="center" class="border-1"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($etik_pegawairow_all['tgl_etik_pegawai']))) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="left">
		<table class="table" style="margin-top: 5px;">
			<tbody>
					<tr>
						<td align="center" class="border-1 bg-dark">Nama Penguji</td>
						<td width="10"></td>
						<td align="center" class="border-1 bg-dark">Hasil</td>
					</tr>
					<tr>
						<td align="center" class="border-1"><?= $penguji['nama_pegawai'] ?></td>
						<td>&nbsp;</td>
						<td align="center" class="border-1"><?php echo $etik_pegawairow_all['hasil_etik']; ?></td>
					</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="content-report">
   <table class="table">
	<thead>
		<tr style="border: 1px solid black;">
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;">No</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;">Etik</th>
		  <th class="border-1 bg-dark" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;">Jawaban</th>
	  </tr>
	</thead>
	  <tbody>
				<?php
				$No = 0;
				foreach($kol_etik_detil_all as $row){
					$No++;
				?>
			<tr style="border: 1px solid black;">
				<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;"><?php echo $No; ?></td>
				<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:left;"><?php echo $row['nama_etik'];?></td>
				<td  class="border-1" style="padding: 5px;font-size: 1em;vertical-align:middle;text-align:center;">
				<?php
					if($row['answer']=="0") { // NO
						echo "TIDAK";
					}else if($row['answer']=="1"){
						echo "YA";
					}
				?>
				</td>
			</tr>
				<?php
					}
				?>
	  </tbody>
	</table>
	<div class="clear">&nbsp;</div>
</div>
