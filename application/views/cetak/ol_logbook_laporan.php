<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$bagilhu = $this->m_external->ambil_logbook_laporan_tabellap($id); //id_laporan
	$lp = $this->m_ol_rancak->ambil_crew_logbook_laporan_tabel($tbl);
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$id_ruangan = $bagilhu['id_instansi']; 
	$first_date = date('d-m-Y', strtotime($bagilhu['tgl_awal'])); 
	$last_date = date('d-m-Y', strtotime($bagilhu['tgl_akhir'])); 

	$ins = $this->m_umum->ambil_data('kol_working','id_working',$id_ruangan);
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$first_date = date('d-m-Y', strtotime($first_date)); 
	$last_date = date('d-m-Y', strtotime($last_date));
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $bagilhu['header_laporan'] ?></b></h3>
		<h3><b><?= $bagilhu['sub_header_laporan'] ?></b></h3>
		<h3><b><?= $bagilhu['sub_sub_header_laporan'] ?></b></h3>
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
						<td align="center" class="border-1"><?= $bagilhu['nip'] ?></td>			
					</tr>				
				</tbody>
			</table>
	</div>
</div>
<div class="content-report">
<?php 
if($lp['lhu'] == 1){
?>
<table class="table">
<thead>
	<tr>
		<th class="border-1 bg-dark" style="font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;width: 10%%;">Tanggal</th>
		<th class="border-1 bg-dark" colspan="5" style="font-weight: bold; padding: 5px;vertical-align:middle;text-align:left;">Kompetensi - [Kewenangan]</th>
	</tr>
</thead>
<tbody>	
		<?php
		$px=0;
		$peminatan = $this->m_external->print_logbook_per_pasien($first_date,$last_date,$id_ruangan,$bagilhu['id_pegawai'],0);
		foreach($peminatan as $rowpeminatan){
			$px++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= date('d-m-Y',strtotime($rowpeminatan['tgl_logbook'])) ?></td>
  <td class="border-1" colspan="5" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $px ?>. <?= $rowpeminatan['nama_kompetensi'] ?></td>
</tr>	
<tr style="border: 1px solid black;">
<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" colspan="5" style="padding: 5px;vertical-align:middle;"><b>Pencatatan Registrasi Pasien :</b><br><?= $rowpeminatan['rm'] ?></td>
</tr>	
	<?php 
	$kondisi_mine=array('id_logbook'=>$rowpeminatan['id_logbook']);
	$jml_mine=$this->m_umum->jumlah_record_filter('ol_logbook_pasien',$kondisi_mine);
	if($jml_mine == 0){
	?>
<tr style="border: 1px solid black;">
  <td class="border-1" colspan="6" style="padding: 5px;vertical-align:middle;text-align:center;">TIDAK ADA DATA PASIEN</td>
</tr>	
<?php
	}
	else{
	?>
<tr style="border: 1px solid black;">
	<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" colspan="5" style="padding: 5px;vertical-align:middle;text-align:left;font-weight: bold;">DATA PASIEN :</td>
</tr>	
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
		<td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:center;width: 10%%;">RM</td>
		<td class="border-1 bg-dark" colspan="2" style="padding: 5px;vertical-align:middle;text-align:left;">Nama Pasien</td>
		<td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:center;width: 15%%;">Jenis Kelamin</td>
		<td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:center;width: 15%%;">Umur</td>
</tr>	
		<?php
		$no = 0;
			$pegminat = $this->m_external->print_per_pasien($rowpeminatan['id_logbook']);
			foreach($pegminat as $rowpegminat){
				$no++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $rowpegminat['rm'] ?></td>
  <td class="border-1" colspan="2" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $no ?>. <?= $rowpegminat['nama_pasien'] ?></td>
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $rowpegminat['jk'] ?></td>
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $rowpegminat['umur'] ?></td>
</tr>	
		<?php
			}
		}
	}
	?>
</tbody>
</table>
<?php 
}
elseif($lp['lhu'] == 2 || $lp['lhu'] == 3){
?>
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
		$peminatan = $this->m_member->print_logbook_per_pasien($first_date,$last_date,$id_ruangan,$this->session->id_pegawai,'0');
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
$tampil_bahan = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,'0',$kondisi_tampil_bahan);
$tampil_reject = $this->m_member->count_all_reject($first_date,$last_date,$id_ruangan,'0',$kondisi_tampil_reject);
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
		  	$jml_tampil_bahan_nonull = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,'0',$kondisi_tampil_bahan_nonull);
		  	$jml_tampil_reject_nonull = $this->m_member->count_all_reject($first_date,$last_date,$id_ruangan,'0',$kondisi_tampil_reject_nonull);
		  	if($jml_tampil_bahan_nonull > 0 OR $jml_tampil_reject_nonull > 0){

			  			$rejectebahanall = $this->m_umum->ambil_data_result('kol_reject','id_unit',$this->session->unit);
			  			$kondisi_jml_all_bahan = array('id_bahan'=>$rowbahanall['id_bahan']);			  			
			  			$jml_all_bahan = $this->m_member->jml_all_bakhp($first_date,$last_date,$id_ruangan,'0',$kondisi_jml_all_bahan);
			  	?>
				<tr>
						<td colspan="2" class="border-1" style="padding: 5px;vertical-align:middle;"><?= $rowbahanall['nama_bahan'] ?></td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $jml_all_bahan ?></td>
				</tr>
					<?php 
						foreach ($rejectebahanall as $rowrejectebahanall){
			$kondisi_tampil_bahanreject_nonull = array('id_bahan'=>$rowbahanall['id_bahan'],'id_reject'=>$rowrejectebahanall['id_reject'],'jml_reject >'=>'0');
			$tampil_bahanreject_nonull = $this->m_member->count_all_reject($first_date,$last_date,$id_ruangan,'0',$kondisi_tampil_bahanreject_nonull);
							if($tampil_bahanreject_nonull > 0){
			$kondisi_jml_bahanreject = array('id_reject'=>$rowrejectebahanall['id_reject'],'id_bahan'=>$rowbahanall['id_bahan']);
			$jml_bahanreject = $this->m_member->jml_all_reject($first_date,$last_date,$id_ruangan,'0',$kondisi_jml_bahanreject);
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
							$tampil_reject_nonull = $this->m_member->count_all_reject($first_date,$last_date,$id_ruangan,'0',$kondisi_tampil_reject_nonull);
							if($tampil_reject_nonull > 0){
			  			$kondisi_jml_all_reject = array('id_reject'=>$rowrejectall['id_reject'],'id_logbooker'=>$peminatan['id_pegawai']);	
			  			$jml_all_reject = $this->m_member->jml_all_reject($first_date,$last_date,$id_ruangan,'0',$kondisi_jml_all_reject);
echo '<tr>
			<td colspan="2" class="border-1" style="padding: 5px;vertical-align:middle;">'.$rowrejectall['nama_reject'].'</td><td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">'.$jml_all_reject.'</td></tr>';
							}
			  		}
			  	?>	
			</table>
<?php 
}
?>
<?php 
}
elseif($lp['lhu'] == 4){
?>
<table class="table">
<thead>
	<tr>
		<th class="border-1 bg-dark" style="font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;width: 10%%;">Tanggal</th>
		<th class="border-1 bg-dark" style="font-weight: bold; padding: 5px;vertical-align:middle;text-align:left;">Obyek</th>
		<th class="border-1 bg-dark" style="font-weight: bold; padding: 5px;vertical-align:middle;text-align:left;">Nilai</th>
	</tr>
</thead>
<tbody>	
		<?php
		$px=0;
		$select_lhu = ("*");
		$kondisi_lhue = array('oll.barcode_pegawai'=>$lp['barcode_pegawai']);
	//	$select_lhu = ("*,hasil_lhu_detil as jml_logbook,olp.id_item_lhu as id_lhu,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu");
    $peminatan = $this->m_external->ambil_universal_lhu($tbl,$select_lhu,$kondisi_lhue,'tgl_lhu');
	//	$peminatan = $this->m_external->print_logbook_per_pasien($first_date,$last_date,$id_ruangan,$bagilhu['id_pegawai'],0);
		foreach($peminatan as $rowpeminatan){
			$px++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;font-weight: bold;border-right: 0;"><?= date('d-m-Y',strtotime($rowpeminatan['tgl_lhu'])) ?></td>
  <td class="border-1" colspan="2" style="padding: 5px;vertical-align:middle;text-align:left;border-left: 0;">&nbsp;</td>
</tr>	
		<?php
		$no = 0;
		$select_lhus = ("*,concat(nama_item_lhu,' - ',nama_equipment) as nama_lhu");
		$kondisif = array('oll.barcode_pegawai'=>$lp['barcode_pegawai'],'tgl_lhu'=>$rowpeminatan['tgl_lhu']);
			$pegminat = $this->m_external->ambil_universal_lhu($tbl,$select_lhus,$kondisif);
			foreach($pegminat as $rowpegminat){
				$no++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">&nbsp;</td>
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $no ?>. <?= $rowpegminat['nama_lhu'] ?></td>
  <td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= number_format($rowpegminat['hasil_lhu_detil'],0) ?></td>
</tr>	
		<?php
			}
	}
	?>
</tbody>
</table>
<?php
}
elseif($lp['lhu'] == 5){
?>
<table class="table">
<thead>
	<tr>
		<th colspan="2" class="border-1 bg-dark" style="font-size: 0.8em;font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;">Tanggal</th>
		<th class="border-1 bg-dark" style="font-size: 0.8em;font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;">Pemeriksaan</th>
		<th class="border-1 bg-dark" style="font-size: 0.8em;font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;">Unit</th>
		<th class="border-1 bg-dark" style="font-size: 0.8em;font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;">Dokter</th>
		<th class="border-1 bg-dark" style="font-size: 0.8em;font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;">Pengirim</th>
		<th class="border-1 bg-dark" style="font-size: 0.8em;font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;">Dokter Pengirim</th>
		<th class="border-1 bg-dark" style="font-size: 0.8em;font-weight: bold; padding: 5px;vertical-align:middle;text-align:center;">Status</th>
	</tr>
</thead>
<tbody>	
		<?php
		$px=0;
		$select_lhu = ("*");
		$kondisi_lhue = array('kgp.id_unit'=>$lp['id_unit']);
    $peminatan = $this->m_external->ambil_daftar_tindakan_lhu($tbl,$select_lhu,$kondisi_lhue,'tgl_daftar');
		foreach($peminatan as $rowpeminatan){
			$px++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" colspan="8" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;font-weight: bold;"><?= date('d-m-Y',strtotime($rowpeminatan['tgl_daftar'])) ?></td>
</tr>	
		<?php
		
		$select_lhus = ("*,concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_tindakan,ou.nama_unit as kiriman,krj2.nama_rujukan_dokter as pengirim,ou2.nama_unit as u_tindakan,krj.nama_rujukan_dokter as dr");
		$kondisif = array('kgp.id_unit'=>$lp['id_unit'],'tgl_daftar'=>$rowpeminatan['tgl_daftar']);
			$pegminat = $this->m_external->ambil_daftar_tindakan_lhu($tbl,$select_lhus,$kondisif,'td.id_tindakan');
			foreach($pegminat as $rowpegminat){
		$select_lhus2 = ("*,
if (px.jk = '1' ,'Laki-laki','Perempuan') as jk,
CONCAT((TIMESTAMPDIFF( YEAR, px.tgl_lahir, tgl_daftar )), ' Tahun ', 
TIMESTAMPDIFF( MONTH, px.tgl_lahir, tgl_daftar ) % 12, ' Bulan ',
FLOOR( TIMESTAMPDIFF( DAY, px.tgl_lahir, tgl_daftar ) % 30.4375 ), ' Hari') as umur,
			concat(nama_tindakan,' - ',nama_golongan_pemeriksaan) as nama_tindakan,ou.nama_unit as kiriman,krj2.nama_rujukan_dokter as pengirim,ou2.nama_unit as u_tindakan,krj.nama_rujukan_dokter as dr
			");
		$kondisif2 = array('kgp.id_unit'=>$lp['id_unit'],'tgl_daftar'=>$rowpeminatan['tgl_daftar'],'td.id_tindakan'=>$rowpegminat['id_tindakan']);
				$pegminat2 = $this->m_external->ambil_daftar_tindakan_lhu($tbl,$select_lhus2,$kondisif2);
				
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;border-right: 0;">&nbsp;</td>
  <td class="border-1" colspan="7" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;border-left: 0;font-weight: bold;"><?= $rowpegminat['nama_tindakan'] ?></td>
</tr>	
		<?php
		$no = 0;
				foreach($pegminat2 as $rowpegminat2){
					$no++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;width: 3%;border-right: 0;">&nbsp;</td>
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;width: 2%;border-right: 0;border-left: 0;"><?= $no ?></td>
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;border-left: 0;">
  	<?= '['.$rowpegminat2['rm'].']  '.$rowpegminat2['nama_pasien'].' / '.$rowpegminat2['jk'].' { '.$rowpegminat2['umur'].' }' ?>
  		
  </td>
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;"><?= $rowpegminat2['u_tindakan'] ?></td>
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;"><?= $rowpegminat2['dr'] ?></td>
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;"><?= $rowpegminat2['kiriman'] ?></td>
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:left;"><?= $rowpegminat2['pengirim'] ?></td>
  <td class="border-1" style="font-size: 0.8em;padding: 5px;vertical-align:middle;text-align:center;">
  	<?php 
  		if($rowpegminat2['status_daftar'] == 0){
  			echo 'Proses';
  		}elseif($rowpegminat2['status_daftar'] == 1){
  			echo 'Selesai';
  		}else{
  			echo 'Batal';
  		}
  	?>
  </td>
</tr>	
		<?php
				}
			}
	}
	?>
</tbody>
</table>
<?php
}
?>
	<div class="clear">&nbsp;</div>
</div>