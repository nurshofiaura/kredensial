<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];		
$dateb = date("Y-m-d", strtotime("+3 month"));	
$kondisi_str=array('status_pegawai'=>1,'visible'=>1,'jf.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'status_berkas'=>1,'ol_berkas.id_kategori_berkas'=>1,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb);
$kondisi_sip=array('status_pegawai'=>1,'visible'=>1,'jf.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'status_berkas'=>1,'ol_berkas.id_kategori_berkas'=>2,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb);
$kondisi_sik=array('status_pegawai'=>1,'visible'=>1,'jf.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'status_berkas'=>1,'ol_berkas.id_kategori_berkas'=>3,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb);
	$pengcabe = $this->m_umum->ambil_data('kol_working','id_working',$id_working);
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $pengcabe['nama_working'] ?></b></h3>
		<h3><b>DAFTAR SURAT IJIN DALAM MASA TENGGANG (3 BULAN)</b></h3>	
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
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;">STR</td>
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;width: 15%;">Mulai</td>
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;width: 15%;">Berakhir</td>
</tr>	
		<?php
			$str = $this->m_ol_rancak->ambil_berkas_ijin_instansi($kondisi_str);
			foreach($str as $rowstr){
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowstr['nama_pegawai'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= date('d-m-Y', strtotime($rowstr['tgl_a_berkas'])) ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= date('d-m-Y', strtotime($rowstr['tgl_b_berkas'])) ?></td>
</tr>	
		<?php
			}
		?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;">SIP</td>
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;">Mulai</td>
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;">Berakhir</td>
</tr>	
		<?php
			$sip = $this->m_ol_rancak->ambil_berkas_ijin_instansi($kondisi_sip);
			foreach($sip as $rowsip){
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowsip['nama_pegawai'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= date('d-m-Y', strtotime($rowsip['tgl_a_berkas'])) ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= date('d-m-Y', strtotime($rowsip['tgl_b_berkas'])) ?></td>
</tr>	
		<?php
			}
		?>
<tr style="border: 1px solid black;">
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;">SIK</td>
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;">Mulai</td>
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;">Berakhir</td>
</tr>	
		<?php
			$sik = $this->m_ol_rancak->ambil_berkas_ijin_instansi($kondisi_sik);
			foreach($sik as $rowsik){
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowsik['nama_pegawai'] ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= date('d-m-Y', strtotime($rowsik['tgl_a_berkas'])) ?></td>
  <td class="border-1" style="padding: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= date('d-m-Y', strtotime($rowsik['tgl_b_berkas'])) ?></td>
</tr>	
		<?php
			}
		?>
</tbody>
</table>
	<div class="clear">&nbsp;</div>
</div>