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
	$peminatan = $this->m_admin_user->grafik_all_pegawai_result($select_1,$kondisi,'ope.id_jabatan_fungsional');
	$kerjae = $this->m_umum->ambil_data('kol_working','id_working',$id);
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $kerjae['nama_working'] ?></b></h3>
		<?= $nama_jabatan ?>
		<h3><b>DAFTAR JABATAN FUNGSIONAL</b></h3>	
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
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $rowpeminatan['nama_jabatan_fungsional'] ?></td>
</tr>	
		<?php
if(empty($id2)){
	$kondisit=array('status_pegawai'=>1,'visible'=>1,'opi.id_instansi'=>$id,'ope.id_jabatan_fungsional'=>$rowpeminatan['id_jabatan_fungsional']);
}else{
	$kondisit=array('status_pegawai'=>1,'visible'=>1,'jf.id_jabatan'=>$id2,'opi.id_instansi'=>$id,'ope.id_jabatan_fungsional'=>$rowpeminatan['id_jabatan_fungsional']);
}
$noe = 0;
	$pegminat = $this->m_admin_user->grafik_all_pegawai_result($select_1,$kondisit);
			foreach($pegminat as $rowpegminat){
				$noe++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $noe ?>. <?= $rowpegminat['nama_pegawai'] ?></td>
</tr>	
		<?php
			}
		}
		?>
</tbody>
</table>
	<div class="clear">&nbsp;</div>
</div>