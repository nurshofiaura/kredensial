<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];		
//	$ambil_peminatan=$this->m_ol_grafik->ambil_peminatan('peg.id_pengcab',$ambil_1_pengcab['id_pengcab'],'opm.id_peminatan');
	$kondisi=array('status_pegawai_instansi'=>1,'jf.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$id_pengcab);
	$peminatan = $this->m_ol_rancak->instansi_fr_opinstansi($kondisi,'opi.id_instansi');
	$pengcabe = $this->m_umum->ambil_data('ol_pengcab','id_pengcab',$id_pengcab);
?>
<div class="header-report">
	<div class="center">				
		<h3><b><?= $pengcabe['nama_pengcab'] ?></b></h3>
		<h3><b>DAFTAR INSTANSI</b></h3>	
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
  <td class="border-1 bg-dark" style="padding: 5px;vertical-align:middle;text-align:left;"><?= $rowpeminatan['nama_working'] ?> ( <?= $rowpeminatan['nama_kategori_work'] ?> )</td>
</tr>	
		<?php
			$kondisi2=array('status_pegawai_instansi'=>1,'jf.id_jabatan'=>$this->session->id_jabatan,'ope.id_pengcab'=>$id_pengcab,'opi.id_instansi'=>$rowpeminatan['id_instansi']);
			$pegminat = $this->m_ol_rancak->instansi_fr_opinstansi($kondisi2);
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