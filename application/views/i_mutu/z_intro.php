<?php
	$this->load->view('style'); 
	// $this->load->view('surat_style');
	// $adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$d	= $this->m_im->ambil_sn_laporan_4_print($id);
//	$tgl_lahir	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_lahir'])));
?>
 <!DOCTYPE html>
<html>

<head>
<link rel="icon" href="<?php echo base_url();?>assets/berkas/icon/logosim.ico">
<style>
body{
	font-family: Times New Roman;
	font-size: 10pt;
	line-height: 1.7;
    margin: 0;	
    background-color: white;   
}
</style>
</head>
<body>
<div class="header-report">
		<p style="font-weight:bold;font-size: 14pt;line-height:0.5"><?= $d['header_laporan'] ?></p>
		<p style="font-weight:bold;font-size: 14pt;"><?= $d['sub_header_laporan'] ?></p>
</div>	
<br style="line-height:1">

	<table class="table">
		<tbody>
		<tr>
			<td class="border-1 py-1 px-1" colspan="3" style="border-bottom: 0;border-top: 0;border-left: 0;border-right: 0;"><p style="font-weight:bold;"><?= $d['sub_sub_header_laporan'] ?></p></td>
		</tr>
		<?php  
			if(!empty($d['judul_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
			<td class="border-1 py-1 px-1" style="width:35%;">Judul</td>
			<td class="border-1 py-1 px-1"><?= $d['judul_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['dimensi_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Dimensi Mutu</td>
			<td class="border-1 py-1 px-1" ><?= $d['dimensi_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['tujuan_laporan'])){
		?>		
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Tujuan</td>
			<td class="border-1 py-1 px-1" ><?= $d['tujuan_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['definisi_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Definisi Operasional</td>
			<td class="border-1 py-1 px-1" ><?= $d['definisi_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['dasar_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Dasar Pemikiran</td>
			<td class="border-1 py-1 px-1" ><?= $d['dasar_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['frekuensi_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Frekuensi Pengumpulan Data</td>
			<td class="border-1 py-1 px-1" ><?= $d['frekuensi_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['periode_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Periode Analisis</td>
			<td class="border-1 py-1 px-1" ><?= $d['periode_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['numerator_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Numerator</td>
			<td class="border-1 py-1 px-1" ><?= $d['numerator_laporan'] ?></ul>
		</tr>
		<?php  
			}
			if(!empty($d['denominator_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Denomerator</td>
			<td class="border-1 py-1 px-1" ><?= $d['denominator_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['sumber_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Sumber Data</td>
			<td class="border-1 py-1 px-1" ><?= $d['sumber_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['standar_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Standar</td>
			<td class="border-1 py-1 px-1" ><?= $d['standar_laporan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['id_jabatan'] OR $d['id_jabatan'] == 0)){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Pengumpul Data</td>
			<td class="border-1 py-1 px-1" ><?= $d['nama_jabatan'] ?></td>
		</tr>
		<?php  
			}
			if(!empty($d['teknis_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Teknis Pengumpulan Data</td>
			<td class="border-1 py-1 px-1" ><?= $d['teknis_laporan'] ?></td>
		</tr>			
		<?php  
			}
			if(!empty($d['tgjawab_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Penanggung Jawab</td>
			<td class="border-1 py-1 px-1" ><?= $d['tgjawab_laporan'] ?></td>
		</tr>			
		<?php  
			}
			if(!empty($d['jenis_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Penanggung Jawab</td>
			<td class="border-1 py-1 px-1" ><?= $d['jenis_laporan'] ?></td>
		</tr>			
		<?php  
			}
			if(!empty($d['satuan_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Penanggung Jawab</td>
			<td class="border-1 py-1 px-1" ><?= $d['satuan_laporan'] ?></td>
		</tr>			
		<?php  
			}
			if(!empty($d['kriteria_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Penanggung Jawab</td>
			<td class="border-1 py-1 px-1" ><?= $d['kriteria_laporan'] ?></td>
		</tr>			
		<?php  
			}
			if(!empty($d['formula_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Penanggung Jawab</td>
			<td class="border-1 py-1 px-1" ><?= $d['formula_laporan'] ?></td>
		</tr>			
		<?php  
			}
			if(!empty($d['metode_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Penanggung Jawab</td>
			<td class="border-1 py-1 px-1" ><?= $d['metode_laporan'] ?></td>
		</tr>			
		<?php  
			}
			if(!empty($d['instrumen_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Penanggung Jawab</td>
			<td class="border-1 py-1 px-1" ><?= $d['instrumen_laporan'] ?></td>
		</tr>			
		<?php  
			}
			if(!empty($d['sampel_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Penanggung Jawab</td>
			<td class="border-1 py-1 px-1" ><?= $d['sampel_laporan'] ?></td>
		</tr>			
		<?php  
			}
			if(!empty($d['penyajian_laporan'])){
		?>
		<tr>
			<td class="border-1 py-1 px-1" style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
			<td class="border-1 py-1 px-1" >Penanggung Jawab</td>
			<td class="border-1 py-1 px-1" ><?= $d['penyajian_laporan'] ?></td>
		</tr>			
		<?php  
			}
		?>
		?>
		</tbody>
	</table>	
</body>
</html>