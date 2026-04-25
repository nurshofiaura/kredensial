<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$cmd_ruangan = $this->m_rancak->cmd_ruangan();
?>
<div class="header-report">
	<div class="center">	
		<h4><b><?= $instance_name; ?></b></h4>				
		<h4><b><?= $header ?></b></h4>
	</div>
</div>
<div class="content-report">
	<table class="table table-border">
		<thead>
			<tr class="bg-dark">
			  <th class="left py-1 px-1">Nama</th>
			  <th class="left py-1 px-1">Nama Berkas</th>
			  <th class="left py-1 px-1">Nama Kategori</th>
			  <th class="left py-1 px-1">No</th>				
			</tr>
		</thead>
		<tbody>
			<? 
			foreach ($cmd_ruangan as $rowcmd_ruangan) { 
				$jml=$this->m_berkas->jumlah_berkasumum_ruangan($rowcmd_ruangan['id_ruangan'],$id);	
				if($jml > 0){
			?>
			<tr class="bg-dark">		
				<td colspan="4" class="left px-1 py-2"><?= $rowcmd_ruangan['nama_ruangan'] ?></td>		
			</tr>			
			<?php
				$ambil_data_surat_ijin = $this->m_berkas->ambil_data_berkas_umum($rowcmd_ruangan['id_ruangan'],$id);
				foreach ($ambil_data_surat_ijin as $rowambil_data_surat_ijin) { 
			?>
			<tr>
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['nama_pegawai'] ?></td>
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['nama_berkas'] ?></td>			
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['nama_kategori_berkas'] ?></td>			
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['no_berkas'] ?></td>			
			</tr>
			<? 		
				}			
				}
			}
			?>
		</tbody>
	</table>								
</div>