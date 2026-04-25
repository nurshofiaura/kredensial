<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];		
	$select_1 = "*";
if(empty($id2)){
	$kondisi=array('status_pegawai'=>1,'visible'=>1,'opi.id_instansi'=>$id);	
	$jabatane = $this->m_umum->ambil_data('jabatan','id_jabatan',$id2);
	$nama_jabatan = "";
}else{
	$kondisi=array('status_pegawai'=>1,'visible'=>1,'jf.id_jabatan'=>$id2,'opi.id_instansi'=>$id);
	$jabatane = $this->m_umum->ambil_data('jabatan','id_jabatan',$id2);
	$nama_jabatan = "<h3><b>".$jabatane['nama_jabatan']."</b></h3>";
}
	$peminatan = $this->m_admin_user->grafik_all_pegawai_result($select_1,$kondisi,'jf.id_jabatan');
	$kerjae = $this->m_umum->ambil_data('kol_working','id_working',$id);
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $kerjae['nama_working'] ?></b></h3>
		<?= $nama_jabatan ?>
		<h3><b>DAFTAR GRADE</b></h3>	
	</div>
	<br style="line-height:1;">
	<div class="right">	
			<table class="table">
				<tbody>
					<tr>
						<td>&nbsp;</td>				
						<td>&nbsp;</td>	
						<td width="15%" align="center" class="border-1 bg-dark">Tanggal Print</td>				
			
					</tr>
					<tr>
						<td>&nbsp;</td>												
						<td>&nbsp;</td>	
						<td align="center" class="border-1"><?= $this->m_rancak->fullBulan(date('d-m-Y')) ?></td>												
											
					</tr>				
				</tbody>
			</table>
	</div>
</div>
<div class="content-report">
<table class="table">
<tbody>	
		<?php
		foreach($peminatan as $rowpeminatan){
		?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;font-weight: bold;"><?= $rowpeminatan['nama_jabatan'] ?></td>
</tr>	
		<?php
	if(empty($id2)){
	$kondisit=array('status_pegawai'=>1,'visible'=>1,'opi.id_instansi'=>$id,'jf.id_jabatan'=>$rowpeminatan['id_jabatan']);
}else{
	$kondisit=array('status_pegawai'=>1,'visible'=>1,'jf.id_jabatan'=>$id2,'opi.id_instansi'=>$id,'jf.id_jabatan'=>$rowpeminatan['id_jabatan']);
}
	$pegminat = $this->m_admin_user->grafik_all_pegawai_result($select_1,$kondisit,'ope.id_grade');
			foreach($pegminat as $rowpegminat){
		?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;font-weight: bold;padding-left: 25px;"><?= $rowpegminat['nama_grade'] ?></td>
</tr>		
		<?php
	if(empty($id2)){
	$kondisitt=array('status_pegawai'=>1,'visible'=>1,'opi.id_instansi'=>$id,'ope.id_grade'=>$rowpegminat['id_grade']);
}else{
	$kondisitt=array('status_pegawai'=>1,'visible'=>1,'jf.id_jabatan'=>$id2,'opi.id_instansi'=>$id,'ope.id_grade'=>$rowpegminat['id_grade']);
}
	$pegminatt = $this->m_admin_user->grafik_all_pegawai_result($select_1,$kondisitt,'ope.id_grade');
	$noe=0;
			foreach($pegminatt as $rowpegminatt){
				$noe++;
		?>

<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $noe ?>. <?= $rowpegminatt['nama_pegawai'] ?> <b>[<?= $rowpegminatt['nama_jabatan_fungsional'] ?>]</b></td>
</tr>	
		<?php
			}
			}
		}
		?>
</tbody>
</table>
	<div class="clear">&nbsp;</div>
</div>