<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];		
	$kondisi=array('status_pegawai'=>1,'visible'=>1,'jf.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working);
	$peminatan = $this->m_ol_rancak->attr_fr_pegawai_instansi($kondisi,'ope.id_agama');
	$pengcabe = $this->m_umum->ambil_data('kol_working','id_working',$id_working);
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $pengcabe['nama_working'] ?></b></h3>
		<h3><b>DAFTAR STATUS AGAMA</b></h3>	
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
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $rowpeminatan['nama_agama'] ?></td>
</tr>	
		<?php
			$kondisit=array('status_pegawai'=>1,'visible'=>1,'jf.id_jabatan'=>$this->session->id_jabatan,'opi.id_instansi'=>$id_working,'ope.id_agama'=>$rowpeminatan['id_agama']);
			$pegminat = $this->m_ol_rancak->attr_fr_pegawai_instansi($kondisit);
			foreach($pegminat as $rowpegminat){
		?>
<tr style="border: 1px solid black;">
  <td class="border-1" style="padding-left: 30px;padding-top: 5px;padding-bottom: 5px;border-left: 0px solid;vertical-align:middle;text-align:left;"><?= $rowpegminat['nama_pegawai'] ?></td>
</tr>	
		<?php
			}
		}
		?>
</tbody>
</table>
	<div class="clear">&nbsp;</div>
</div>