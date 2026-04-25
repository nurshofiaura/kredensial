<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
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
			  <th class="left py-1 px-1">Nama Instansi</th>
			  <th class="left py-1 px-1">No Ijasah</th>
			  <th class="left py-1 px-1">Tanggal Lulus</th>				
			</tr>
		</thead>
		<tbody>
			<? 
			foreach ($cmd_ruangan as $rowcmd_ruangan) { 
			?>
			<tr class="bg-dark">		
				<td colspan="4" class="left py-1 px-2"><?= $rowcmd_ruangan['nama_ruangan'] ?></td>		
			</tr>			
			<?php
				$ambil_data_ijasah = $this->m_berkas->ambil_data_ijasah($rowcmd_ruangan['id_ruangan'],'0');
				foreach ($ambil_data_ijasah as $rowambil_data_surat_ijin) { 

			?>
			<tr>								
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['nama_pegawai'] ?></td>				
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['nama_berkas'] ?></td>			
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['no_berkas'] ?></td>
				<td class="left py-1 px-1"><?= date('d-m-Y', strtotime($rowambil_data_surat_ijin['tgl_b_berkas'])) ?></td>			
			</tr>
			<? 			
				} 
			}
			?>
		</tbody>
	</table>								
</div>