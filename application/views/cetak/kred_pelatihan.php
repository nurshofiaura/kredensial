<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];		
	if(empty($id2)){	
	$jabatane = $this->m_umum->ambil_data('jabatan','id_jabatan',$id2);
	$nama_jabatan = "";
}else{
	$jabatane = $this->m_umum->ambil_data('jabatan','id_jabatan',$id2);
	$nama_jabatan = "<h3><b>".$jabatane['nama_jabatan']."</b></h3>";
}
	$peminatan=$this->m_admin_user->ambil_berkas_pelatihan_biasa('ob.status_berkas','1',$id,$id2,'ob.id_pegawai');
	$kerjae = $this->m_umum->ambil_data('kol_working','id_working',$id);
	$jabatane = $this->m_umum->ambil_data('jabatan','id_jabatan',$id2);
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $kerjae['nama_working'] ?></b></h3>
		<?= $nama_jabatan ?>
		<h3><b>DAFTAR PELATIHAN</b></h3>	
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
<thead>
	<tr>
		<th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:left;">Nama Berkas</th>
		<th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Tanggal Mulai</th>
		<th class ="border-1 bg-dark" style="padding: 5px;font-weight: bold;vertical-align:middle;text-align:center;">Tanggal Berakhir</th>
	</tr>
</thead>
<tbody>	
		<?php
		foreach($peminatan as $rowpeminatan){
		?>
<tr style="border: 1px solid black;">
  <td colspan="3" class="border-1" style="padding: 10px;border-left: 0px solid;font-weight: bold;vertical-align:middle;text-align:left;"><?= $rowpeminatan['nama_pegawai'] ?> [<?= $rowpeminatan['nama_jabatan_fungsional'] ?>]</td>
</tr>	
		<?php
		$peminatant=$this->m_admin_user->ambil_berkas_pelatihan_biasa('ob.id_pegawai',$rowpeminatan['id_pegawai'],$id,$id2);
		foreach($peminatant as $rowpeminatant){
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowpeminatant['nama_berkas'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowpeminatant['tgl_a_berkas'])) ?></td>
    <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowpeminatant['tgl_b_berkas'])) ?></td>
</tr>	
	<?php
		}
		}
		?>
</tbody>
</table>
	<div class="clear">&nbsp;</div>
</div>