<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];		
	$dateb = date("Y-m-d", strtotime("+3 month"));
	if(empty($id2)){
$nama_jabatan = "";
$kondisi_aktif_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id);
$kondisi_aktif_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id);
$kondisi_aktif_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id);	
	}else{
	$jabatane = $this->m_umum->ambil_data('jabatan','id_jabatan',$id2);
	$nama_jabatan = "<h3><b>".$jabatane['nama_jabatan']."</b></h3>";
$kondisi_aktif_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
$kondisi_aktif_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
$kondisi_aktif_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);	
	}
$str=$this->m_instansi_user->ambil_berkas_ijin_print($kondisi_aktif_str);
$sip=$this->m_instansi_user->ambil_berkas_ijin_print($kondisi_aktif_sip);
$sik=$this->m_instansi_user->ambil_berkas_ijin_print($kondisi_aktif_sik);
$kerjae = $this->m_umum->ambil_data('kol_working','id_working',$id);
$jabatane = $this->m_umum->ambil_data('jabatan','id_jabatan',$id2);
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $kerjae['nama_working'] ?></b></h3>
		<?= $nama_jabatan ?>
		<h3><b>DAFTAR SURAT IJIN AKTIF</b></h3>	
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
<tr style="border: 1px solid black;">
  <th class="border-1 bg-dark" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;width: 5%;">No</th>
  <th class="border-1 bg-dark" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;">Nama Pegawai</th>
  <th class="border-1 bg-dark" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;width: 15%;">Mulai</th>
  <th class="border-1 bg-dark" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;width: 15%;">Berakhir</th>
</tr>		
</thead>
<tbody>	
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" colspan="4" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;">STR</td>
</tr>	
		<?php
		$nostr=0;
			foreach($str as $rowstr){
				$nostr++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;"><?= $nostr ?></td>
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowstr['nama_pegawai'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowstr['tgl_a_berkas'])) ?></td>
  	<?php 
  		if(($rowstr['tgl_b_berkas'] >= date('Y-m-d')) && ($rowstr['tgl_b_berkas'] <= $dateb)){
  	?>
  <td class="border-1" style="padding: 5px;background-color:#DAE83C ; border-left: 0px solid;vertical-align:middle;text-align:center;">
  	<?= date('d-m-Y', strtotime($rowstr['tgl_b_berkas'])) ?>	
  </td>
  	<?php
  		}else{
  	?>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;">
  	<?= date('d-m-Y', strtotime($rowstr['tgl_b_berkas'])) ?>	
  </td>
  	<?php
  		}
  	?>	
</tr>	
		<?php
			}
		?>
<tr>
  <td class="border-0" colspan="4" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;">&nbsp;</td>
</tr>	
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" colspan="4" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;">SIP</td>
</tr>	
		<?php
		$nosip=0;
			foreach($sip as $rowsip){
				$nosip++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;"><?= $nosip ?></td>
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowsip['nama_pegawai'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowsip['tgl_a_berkas'])) ?></td>
  	<?php 
  		if(($rowsip['tgl_b_berkas'] >= date('Y-m-d')) && ($rowsip['tgl_b_berkas'] <= $dateb)){
  	?>
  <td class="border-1" style="padding: 5px;background-color:#DAE83C ; border-left: 0px solid;vertical-align:middle;text-align:center;">
  	<?= date('d-m-Y', strtotime($rowsip['tgl_b_berkas'])) ?>	
  </td>
  	<?php
  		}else{
  	?>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;">
  	<?= date('d-m-Y', strtotime($rowsip['tgl_b_berkas'])) ?>	
  </td>
  	<?php
  		}
  	?>
</tr>	
		<?php
			}
		?>
<tr>
  <td class="border-0" colspan="4" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;">&nbsp;</td>
</tr>	
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" colspan="4" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;">SIK</td>
</tr>	
		<?php
		$nosik=0;
			foreach($sik as $rowsik){
				$nosik++;
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;"><?= $nosik ?></td>
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowsik['nama_pegawai'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;"><?= date('d-m-Y', strtotime($rowsik['tgl_a_berkas'])) ?></td>
  	<?php 
  		if(($rowsik['tgl_b_berkas'] >= date('Y-m-d')) && ($rowsik['tgl_b_berkas'] <= $dateb)){
  	?>
  <td class="border-1" style="padding: 5px;background-color:#DAE83C ; border-left: 0px solid;vertical-align:middle;text-align:center;">
  	<?= date('d-m-Y', strtotime($rowsik['tgl_b_berkas'])) ?>	
  </td>
  	<?php
  		}else{
  	?>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:center;">
  	<?= date('d-m-Y', strtotime($rowsik['tgl_b_berkas'])) ?>	
  </td>
  	<?php
  		}
  	?>
</tr>	
		<?php
			}
		?>
</tbody>
</table>
	<div class="clear">&nbsp;</div>
</div>