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
		<h3><b>LAPORAN ANALISIS PEMAKAIAN FILM DAN REJECT</b></h3>	
		<h3><b><?= $member['nama_pegawai'] ?></b></h3>	
	</div>
	<br style="line-height:1;">
	<div class="right">	
			<table class="table">
				<tbody>
					<tr>
						<td>&nbsp;</td>				
						<td width="50%" align="center" class="border-1 bg-dark">Periode Tanggal</td>	
						<td>&nbsp;</td>							
					</tr>
					<tr>
						<td>&nbsp;</td>												
						<td align="center" class="border-1"><?= $this->m_rancak->fullBulan($first_date) ?> s.d <?= $this->m_rancak->fullBulan($last_date) ?></td>
						<td>&nbsp;</td>	
											
					</tr>				
				</tbody>
			</table>
	</div>
</div>
<div class="content-report">
<?php 
$kondisi_tampil_bahan = array('jml_bahan >'=>'0');
$kondisi_tampil_reject = array('jml_reject >'=>'0');
$tampil_bahan = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_bahan);
$tampil_reject = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_reject);
if($tampil_bahan > 0 OR $tampil_reject > 0){
?>
<br style="line-height:1px;"><h3 style="font-weight:bold;">TOTAL PENGGUNAAN FILM DAN REJECT</h3><br>
			<table width="50%">
					<tr>	
						<td colspan="2" style="padding: 5px;vertical-align:middle;" class="border-1 bg-dark">Nama Bahan | Reject</td>					
						<td colspan="2" width="15%" style="padding: 5px;vertical-align:middle;" align="center" class="border-1 bg-dark">Jumlah</td>					
					</tr>		
			  	<?php
			  		$bahaneall = $this->m_umum->ambil_data_result('ol_bahan','id_unit',$this->session->unit);
			  		foreach ($bahaneall as $rowbahanall){
		  	$kondisi_tampil_bahan_nonull = array('id_bahan'=>$rowbahanall['id_bahan'],'jml_bahan >'=>'0');
		  	$kondisi_tampil_reject_nonull = array('id_bahan'=>$rowbahanall['id_bahan'],'jml_reject >'=>'0');
		  	$jml_tampil_bahan_nonull = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_bahan_nonull);
		  	$jml_tampil_reject_nonull = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_reject_nonull);
		  	if($jml_tampil_bahan_nonull > 0 OR $jml_tampil_reject_nonull > 0){

			  			$rejectebahanall = $this->m_umum->ambil_data_result('kol_reject','id_unit',$this->session->unit);
			  			$kondisi_jml_all_bahan = array('id_bahan'=>$rowbahanall['id_bahan']);			  			
			  			$jml_all_bahan = $this->m_member->jml_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_jml_all_bahan);
			  	?>
				<tr>
						<td colspan="3" class="border-1" style="padding: 5px;vertical-align:middle;"><?= $rowbahanall['nama_bahan'] ?></td>
						<td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;"><?= $jml_all_bahan ?></td>
				</tr>
					<?php 
						foreach ($rejectebahanall as $rowrejectebahanall){
			$kondisi_tampil_bahanreject_nonull = array('id_bahan'=>$rowbahanall['id_bahan'],'id_reject'=>$rowrejectebahanall['id_reject'],'jml_reject >'=>'0');
			$tampil_bahanreject_nonull = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_bahanreject_nonull);
							if($tampil_bahanreject_nonull > 0){
			$kondisi_jml_bahanreject = array('id_reject'=>$rowrejectebahanall['id_reject'],'id_bahan'=>$rowbahanall['id_bahan']);
			$jml_bahanreject = $this->m_member->jml_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_jml_bahanreject);
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
						<td colspan="2" style="padding: 5px;vertical-align:middle;" class="border-1 bg-dark">Nama Reject</td>					
						<td width="15%" style="padding: 5px;vertical-align:middle;" align="center" class="border-1 bg-dark">Jumlah</td>					
					</tr>		
			  	<?php
			  		$rejecteall = $this->m_umum->ambil_data_result('kol_reject','id_unit',$this->session->unit);
			  		foreach ($rejecteall as $rowrejectall){
			  			$kondisi_tampil_reject_nonull = array('id_reject'=>$rowrejectall['id_reject'],'jml_reject >'=>'0');
							$tampil_reject_nonull = $this->m_member->count_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_tampil_reject_nonull);
							if($tampil_reject_nonull > 0){
			  			$kondisi_jml_all_reject = array('id_reject'=>$rowrejectall['id_reject']);	
			  			$jml_all_reject = $this->m_member->jml_all_bakhp($first_date,$last_date,$id_ruangan,$pxe,$kondisi_jml_all_reject);
echo '<tr>
			<td colspan="2" class="border-1" style="padding: 5px;vertical-align:middle;">'.$rowrejectall['nama_reject'].'</td><td class="border-1" style="padding: 5px;vertical-align:middle;text-align:center;">'.$jml_all_reject.'</td></tr>';
							}
			  		}
			  	?>	
			</table>
<?php 
}
?>
	<div class="clear">&nbsp;</div>
</div>