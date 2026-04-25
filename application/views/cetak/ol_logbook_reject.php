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
		<th class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:center;width: 10%%;">Tanggal</th>
		<th class="border-1 bg-dark" colspan="9" style="padding: 5px;vertical-align:middle;text-align:left;">Kompetensi - [Kewenangan]</th>
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
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;width: 10%;"><?= $rowpeminatan['tgl_logbook'] ?></td>
  <td class="border-1" colspan="9" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $px ?>. <?= $rowpeminatan['nama_kompetensi'] ?></td>
</tr>	
<tr style="border: 1px solid black;">
<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" colspan="9" style="padding: 5px;vertical-align:middle;"><b>Pencatatan Registrasi Pasien :</b><br><?= $rowpeminatan['rm'] ?></td>
</tr>	
	<?php 
	$kondisi_mine=array('id_logbook'=>$rowpeminatan['id_logbook']);
	$jml_mine=$this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi_mine);
	if($jml_mine == 0){
	?>
<tr style="border: 1px solid black;">
  <td class="border-1" colspan="10" style="padding: 5px;vertical-align:middle;text-align:center;">TIDAK ADA DATA PASIEN</td>
</tr>	
<?php
	}
	else{
	?>
<tr style="border: 1px solid black;">
	<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" colspan="9" style="padding: 5px;vertical-align:middle;text-align:left;font-weight: bold;">DATA PASIEN :</td>
</tr>	
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
		<td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:center;width: 10%%;">RM</td>
		<td class="border-1 bg-dark" colspan="6" style="padding: 5px;vertical-align:middle;text-align:left;">Nama Pasien</td>
		<td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:center;width: 15%%;">Jenis Kelamin</td>
		<td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:center;width: 15%%;">Umur</td>
</tr>	
		<?php
		$no = 0;
			$pegminat = $this->m_member->print_per_pasien($rowpeminatan['id_logbook']);
			foreach($pegminat as $rowpegminat){
				$no++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $rowpegminat['rm'] ?></td>
  <td class="border-1" colspan="6" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $no ?>. <?= $rowpegminat['nama_pasien'] ?></td>
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $rowpegminat['jk'] ?></td>
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $rowpegminat['umur'] ?></td>
</tr>	
		<?php
			}
		}
		?>
<tr style="border: 1px solid black;">
	<?php
		$kondisi_bkhp_bahan = array('id_logbook'=>$rowpeminatan['id_logbook'],'jml_bahan >'=>'0');
		$jml_bkhp_bahan = $this->m_member->count_bakhp($kondisi_bkhp_bahan);
		$kondisi_bkhp_reject = array('id_logbook'=>$rowpeminatan['id_logbook'],'jml_reject >'=>'0');
		$jml_bkhp_reject = $this->m_member->count_reject($kondisi_bkhp_reject);
		if($jml_bkhp_bahan == 0 AND $jml_bkhp_reject == 0){
			echo'
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" colspan="9" style="padding: 5px;vertical-align:middle;font-weight:bold;text-align:center;">TIDAK ADA PENGGUNAAN BAHAN DAN REJECT</td>';
		}else{
	?>



<tr style="border: 1px solid black;">
<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
	<td colspan="5" class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">
			<table class="table">
					<tr>	
						<td style="padding: 5px;vertical-align:middle;font-weight: bold;" class="border-1 bg-dark">Nama Bahan</td>					
						<td style="padding: 5px;vertical-align:middle;font-weight: bold;" align="center" class="border-1 bg-dark">Jumlah</td>					
					</tr>		
  	<?php
  		$bahane = $this->m_umum->ambil_data_result('ol_bahan','id_unit',$this->session->unit);
  		foreach ($bahane as $rowbahan){
		  	$kondisi_bkhp_bahan_nonull = array('id_logbook'=>$rowpeminatan['id_logbook'],'id_bahan'=>$rowbahan['id_bahan'],'jml_bahan >'=>'0');
		  //	$kondisi_bkhp_reject_nonull = array('id_logbook'=>$rowpeminatan['id_logbook'],'id_bahan'=>$rowbahan['id_bahan'],'jml_reject >'=>'0');
		  	$jml_bkhp_bahan_nonull = $this->m_member->count_bakhp($kondisi_bkhp_bahan_nonull);
		  //	$jml_bkhp_reject_nonull = $this->m_member->count_reject($kondisi_bkhp_reject_nonull);
		  	if($jml_bkhp_bahan_nonull > 0){
				$kondisi_jml_bahan = array('id_logbook'=>$rowpeminatan['id_logbook'],'id_bahan'=>$rowbahan['id_bahan']);
				$jml_bahane = $this->m_member->jml_bakhp($kondisi_jml_bahan);
  	?>
					<tr>
						<td class="border-1" style="padding: 5px;vertical-align:middle;"><?= $rowbahan['nama_bahan'] ?></td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $jml_bahane ?></td>
					</tr>
					<?php 
				}
			}
			  	?>	
			</table>
	</td>
	<td colspan="4"  class="border-1" style="padding: 5px;vertical-align:middle;">
<?php
  		$bahane = $this->m_umum->ambil_data_result('ol_bahan','id_unit',$this->session->unit);
  		foreach ($bahane as $rowbahan){
	$kondisi_bkhp_reject_nonull = array('id_logbook'=>$rowpeminatan['id_logbook'],'id_bahan'=>$rowbahan['id_bahan'],'jml_reject >'=>'0');
		  	$jml_bkhp_reject_nonull = $this->m_member->count_reject($kondisi_bkhp_reject_nonull);
		  	if($jml_bkhp_reject_nonull > 0){
?>
			<table class="table">
					<tr>	
						<td colspan="2" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align:center;" class="border-1 bg-dark">Nama Reject</td>					
						<td colspan="2" width="15%" style="padding: 5px;vertical-align:middle;font-weight: bold;text-align:center;" class="border-1 bg-dark">Jumlah</td>					
					</tr>		
  	<?php

		 //	$kondisi_bkhp_bahan_nonull = array('id_logbook'=>$rowpeminatan['id_logbook'],'id_bahan'=>$rowbahan['id_bahan'],'jml_bahan >'=>'0');
		  	
		  //	$jml_bkhp_bahan_nonull = $this->m_member->count_bakhp($kondisi_bkhp_bahan_nonull);
  	?>
					<tr>
						<td colspan="2" class="border-1" style="padding: 5px;vertical-align:middle;"><?= $rowbahan['nama_bahan'] ?></td>
						<td class="border-1" colspan="2" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
					</tr>
					<?php 
			//	if($jml_bkhp_reject_nonull > 0){
							$rejecte = $this->m_umum->ambil_data_result('kol_reject','id_unit',$this->session->unit);
							foreach ($rejecte as $rowreject){
$kondisi_bkhp_rejectbahan_nonull = array('id_logbook'=>$rowpeminatan['id_logbook'],'id_reject'=>$rowreject['id_reject'],'id_bahan'=>$rowbahan['id_bahan'],'jml_reject >'=>'0');
$jml_bkhp_rejectbahan_nonull = $this->m_member->count_reject($kondisi_bkhp_rejectbahan_nonull);
							if($jml_bkhp_rejectbahan_nonull > 0){
			$kondisi_jml_reject = array('id_logbook'=>$rowpeminatan['id_logbook'],'id_reject'=>$rowreject['id_reject'],'id_bahan'=>$rowbahan['id_bahan']);
							$jml_reject = $this->m_member->jml_reject($kondisi_jml_reject);
					?>
					<tr>
						<td class="border-1" style="padding: 5px;vertical-align:middle;width: 5%;border-right: 0;">&nbsp;</td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;border-left: 0;"><?= $rowreject['nama_reject'] ?></td>
						<td class="border-1" colspan="2" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $jml_reject ?></td>
					</tr>
				<?php
								}
							}
			//	}
			  	?>	
			</table>
			<?php 
			}
		}
			?>
	</td>
</tr>	





  <?php 
		}
	?>
</tr>	
		<?php
	}
	?>
</tbody>
</table>
<?php 
$kondisi_tampil_bahan = array('jml_bahan >'=>'0');
$kondisi_tampil_reject = array('jml_reject >'=>'0');
$tampil_bahan = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_bahan);
$tampil_reject = $this->m_member->count_all_reject($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_reject);
if($tampil_bahan > 0 OR $tampil_reject > 0){
?>
<br style="line-height:1px;"><h3 style="font-weight:bold;">TOTAL PENGGUNAAN FILM DAN REJECT</h3><br>
			<table width="50%">
					<tr>	
						<td colspan="2" style="padding: 5px;vertical-align:middle;font-weight: bold;" class="border-1 bg-dark">Nama Bahan | Reject</td>					
						<td colspan="2" width="15%" style="padding: 5px;vertical-align:middle;font-weight: bold;" align="center" class="border-1 bg-dark">Jumlah Reject | Bahan</td>					
					</tr>		
			  	<?php
			  		$bahaneall = $this->m_umum->ambil_data_result('ol_bahan','id_unit',$this->session->unit);
			  		foreach ($bahaneall as $rowbahanall){
		  	$kondisi_tampil_bahan_nonull = array('id_bahan'=>$rowbahanall['id_bahan'],'jml_bahan >'=>'0');
		  	$kondisi_tampil_reject_nonull = array('id_bahan'=>$rowbahanall['id_bahan'],'jml_reject >'=>'0');
		  	$jml_tampil_bahan_nonull = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_bahan_nonull);
		  	$jml_tampil_reject_nonull = $this->m_member->count_all_reject($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_reject_nonull);
		  	if($jml_tampil_bahan_nonull > 0 OR $jml_tampil_reject_nonull > 0){

			  			$rejectebahanall = $this->m_umum->ambil_data_result('kol_reject','id_unit',$this->session->unit);
			  			$kondisi_jml_all_bahan = array('id_bahan'=>$rowbahanall['id_bahan']);			  			
			  			$jml_all_bahan = $this->m_member->jml_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_jml_all_bahan);
			  	?>
				<tr>
						<td colspan="2" class="border-1" style="padding: 5px;vertical-align:middle;"><?= $rowbahanall['nama_bahan'] ?></td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $jml_all_bahan ?></td>
				</tr>
					<?php 
						foreach ($rejectebahanall as $rowrejectebahanall){
			$kondisi_tampil_bahanreject_nonull = array('id_bahan'=>$rowbahanall['id_bahan'],'id_reject'=>$rowrejectebahanall['id_reject'],'jml_reject >'=>'0');
			$tampil_bahanreject_nonull = $this->m_member->count_all_reject($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_bahanreject_nonull);
							if($tampil_bahanreject_nonull > 0){
			$kondisi_jml_bahanreject = array('id_reject'=>$rowrejectebahanall['id_reject'],'id_bahan'=>$rowbahanall['id_bahan']);
			$jml_bahanreject = $this->m_member->jml_all_reject($first_date,$last_date,$id_ruangan,$pxe,$kondisi_jml_bahanreject);
					?>
					<tr>
						<td class="border-1" style="padding: 5px;vertical-align:middle;width: 5%;border-right: 0;">&nbsp;</td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;border-left: 0;"><?= $rowrejectebahanall['nama_reject'] ?></td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $jml_bahanreject ?></td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;">&nbsp;</td>
					</tr>				
					<?php 
							}
						}
						}
			  		}
			  	?>	
			</table>
<?php 
}
if($tampil_reject > 0){
?>
<br style="line-height:1px;"><h3 style="font-weight:bold;">TOTAL REJECT</h3><br>
			<table width="50%">
					<tr>	
						<td colspan="2" style="padding: 5px;vertical-align:middle;font-weight: bold;" class="border-1 bg-dark">Nama Reject</td>					
						<td width="15%" style="padding: 5px;vertical-align:middle;font-weight: bold;" align="center" class="border-1 bg-dark">Jumlah</td>					
					</tr>		
			  	<?php
			  		$rejecteall = $this->m_umum->ambil_data_result('kol_reject','id_unit',$this->session->unit);
			  		foreach ($rejecteall as $rowrejectall){
			  			$kondisi_tampil_reject_nonull = array('id_reject'=>$rowrejectall['id_reject'],'jml_reject >'=>'0','id_logbooker'=>$peminatan['id_pegawai']);
							$tampil_reject_nonull = $this->m_member->count_all_reject($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_reject_nonull);
							if($tampil_reject_nonull > 0){
			  			$kondisi_jml_all_reject = array('id_reject'=>$rowrejectall['id_reject'],'id_logbooker'=>$peminatan['id_pegawai']);	
			  			$jml_all_reject = $this->m_member->jml_all_reject($first_date,$last_date,$id_ruangan,$pxe,$kondisi_jml_all_reject);
echo '<tr>
			<td colspan="2" class="border-1" style="padding: 5px;vertical-align:middle;">'.$rowrejectall['nama_reject'].'</td><td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">'.$jml_all_reject.'</td></tr>';
							}
			  		}
			  	?>	
			</table>
<?php 
}
?>
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