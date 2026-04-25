<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$member = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
	if(empty($id_ruangan)){
		$id_ruangan = $this->session->refer;
	}
	$ins = $this->m_umum->ambil_data('kol_working','barcode_working',$id_ruangan);
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$first_date = date('d-m-Y', strtotime($first_date)); 
	$last_date = date('d-m-Y', strtotime($last_date)); 
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $ins['nama_working'] ?></b></h3>
		<h3><b>LAPORAN KEGIATAN HARIAN / LOGBOOK</b></h3>	
		<h3><b><?= $member['nama_pegawai'] ?></b></h3>	
	</div>
	<br style="line-height:1;">
	<div class="right">	
			<table class="table">
				<tbody>
					<tr>		
						<td width="40%" align="center" class="border-1 bg-dark">Periode Tanggal</td>	
						<td>&nbsp;</td>	
						<td width="40%" align="center" class="border-1 bg-dark">NIP</td>							
					</tr>
					<tr>						
						<td align="center" class="border-1"><?= $this->m_rancak->fullBulan($first_date) ?> s.d <?= $this->m_rancak->fullBulan($last_date) ?></td>
						<td>&nbsp;</td>	
						<td align="center" class="border-1"><?= $member['nip'] ?></td>			
					</tr>				
				</tbody>
			</table>
	</div>
</div>
<div class="content-report">
<table class="table">
<thead>
	<tr>
		<th class="border-1 bg-dark" style="font-size: 0.8em;font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;width: 10%%;">Tanggal</th>
		<th class="border-1 bg-dark" colspan="5" style="font-size: 0.8em;font-weight: bold; padding: 5px;vertical-align:middle;text-align:left;">Kompetensi - [Kewenangan]</th>
	</tr>
</thead>
<tbody>	
		<?php
		$px=0;
		$peminatan = $this->m_member->print_logbook_per_pasien($first_date,$last_date,$id_ruangan,$this->session->id_pegawai,$pxe);
		foreach($peminatan as $rowpeminatan){
			$px++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;"><?= $rowpeminatan['tgl_logbook'] ?></td>
  <td class="border-1" colspan="5" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;"><?= $px ?>. <?= $rowpeminatan['nama_kompetensi'] ?></td>
</tr>	
<tr style="border: 1px solid black;">
<td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" colspan="5" style="font-size: 0.8em;padding: 5px;vertical-align:middle;"><b>Pencatatan Registrasi Pasien :</b><br><?= $rowpeminatan['rm'] ?></td>
</tr>	
	<?php 
	$kondisi_mine=array('id_logbook'=>$rowpeminatan['id_logbook']);
	$jml_mine=$this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi_mine);
	if($jml_mine == 0){
	?>
<tr style="border: 1px solid black;">
  <td class="border-1" colspan="6" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;">TIDAK ADA DATA PASIEN</td>
</tr>	
<?php
	}
	else{
	?>
<tr style="border: 1px solid black;">
	<td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" colspan="5" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;font-weight: bold;">DATA PASIEN :</td>
</tr>	
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
		<td class="border-1 bg-dark" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;width: 10%%;">RM</td>
		<td class="border-1 bg-dark" colspan="2" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;">Nama Pasien</td>
		<td class="border-1 bg-dark" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;width: 15%%;">Jenis Kelamin</td>
		<td class="border-1 bg-dark" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;width: 15%%;">Umur</td>
</tr>	
		<?php
		$no = 0;
			$pegminat = $this->m_member->print_per_pasien($rowpeminatan['id_logbook']);
			foreach($pegminat as $rowpegminat){
				$no++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;"><?= $rowpegminat['rm'] ?></td>
  <td class="border-1" colspan="2" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;"><?= $no ?>. <?= $rowpegminat['nama_pasien'] ?></td>
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;"><?= $rowpegminat['jk'] ?></td>
  <td class="border-1" style="font-size: 0.8em;adding: 5px;vertical-align:middle;text-align:center;"><?= $rowpegminat['umur'] ?></td>
</tr>	
		<?php
			}
		}
	}
	?>
</tbody>
</table> 
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
	<div class="clear">&nbsp;</div>
</div>