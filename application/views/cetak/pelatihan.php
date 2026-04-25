<?php 
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
?>
<div class="header-report">
	<div class="center">				
		<h4><b><?= $header ?></b></h4>
	</div>
</div>
<div class="content-report">
	<table class="table table-border">
		<thead>
			<tr class="bg-dark">
			  <th class="left py-1 px-1">Mulai</th>
			  <th class="left py-1 px-1">Sampai</th>
			  <th class="left py-1 px-1">Pegawai</th>
			  <th class="left py-1 px-1">Judul</th>
			  <th class="left py-1 px-1">Penyelenggara</th>
			  <th class="left py-1 px-1">Kategori</th>				
			</tr>
		</thead>
		<tbody>
			<? 
			$cmd_ruangan_with_berkas = $this->m_berkas->cmd_ruangan_with_berkas($id_kategori_pelatihan,$first_date,$last_date);
			foreach ($cmd_ruangan_with_berkas as $rowcmd_ruangan) { 
			?>
			<tr class="bg-dark">		
				<td colspan="6" class="left px-1 py-2"><?= $rowcmd_ruangan['nama_ruangan'] ?></td>		
			</tr>			
			<?php
				$ambil_data_surat_ijin = $this->m_berkas->ambil_data_pelatihan($id_kategori_pelatihan,$rowcmd_ruangan['id_ruangan'],$first_date,$last_date,'0');
				foreach ($ambil_data_surat_ijin as $rowambil_data_surat_ijin) { 

			?>
			<tr>
				<td class="left py-1 px-1"><?= date('d-m-Y', strtotime($rowambil_data_surat_ijin['tgl_a_berkas'])) ?></td>				
				<td class="left py-1 px-1"><?= date('d-m-Y', strtotime($rowambil_data_surat_ijin['tgl_b_berkas'])) ?></td>				
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['nama_pegawai'] ?></td>
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['nama_berkas'] ?></td>			
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['penyelenggara'] ?></td>			
				<td class="left py-1 px-1"><?= $rowambil_data_surat_ijin['nama_kategori_pelatihan'] ?></td>			
			</tr>
			<? 			
				}
			}
			?>
		</tbody>
	</table>								
</div>