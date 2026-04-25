<?php 
	$this->load->view('surat_style');
//	$this->load->view('style');
	$d	= $this->m_ol_rancak->ambil_data_redres_to_punit($first_date);
	$tgl_lahir	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_lahir'])));
?>
 <!DOCTYPE html>
<html>

<head>
<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico">
<style>
body{
	font-family: Times New Roman;
	font-size: 10pt;
	line-height: 1.7;
    margin: 5;	
    background-color: white;   
}
table{
	font-size: 10pt;
	line-height: 1.7;  
}
</style>
</head>
<body>
<?php  
	if(!empty($d['kop_working'])){
?>

<div class="header-report">
	<div class="center">				
		<img src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $d['kop_working']; ?>" alt="User profile picture">
	</div>
</div>
<?php  
}
?>

<div style="text-align:center;font-weight:bold;font-size: 16pt;line-height: 2;margin:7pt;">
EXPERTISE RADIOLOGI
</div>
<br style="line-height:1">
<table style="width:100%;">
	<tbody>
		<tr>
			<td style="width:15%;">No Pendaftaran</td>
			<td style="text-align: center;width:4%;">:</td>
			<td><?= $d['no_pendaftaran'] ?></td>
		</tr>
		<tr>
			<td>No Radiologi</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['no_pemeriksaan'] ?></td>
		</tr>
		<tr>
			<td>RM</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['rm'] ?></td>
		</tr>		
		<tr>
			<td>Nama</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['nama_pasien'] ?></td>
		</tr>
		<tr>
			<td>Umur</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['umur'] ?></td>
		</tr>
		<tr>
			<td>Pemeriksaan</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['nama_tindakan'] ?></td>
		</tr>
	</tbody>
</table>
<br />
<br />
<?= $d['hasil_radiologi_result'] ?><br />
<br />
<?= $d['kesimpulan_radiologi_result'] ?>
<br /><br />

<table cellspacing="0" style="text-align:center;line-height: 2;margin:7pt;border-collapse:collapse; border:none; width:100%;">
	<tbody>
	  <tr>
	    <td style="width:45%;">&nbsp;</td>
		<td>DOKTER PEMBACA HASIL RADIOLOGI</td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <?php  
	  if(empty($d['ttd_pegawai'])){
	  ?>
	  <tr>
	    <td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <?php
	  }else{
	  ?>
	  <tr>
	    <td>&nbsp;</td>
		<td><img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $rowdp['ttd_pegawai']; ?>" alt="User"></td>
	  </tr>
	  <?php	  	
	  }
	  ?>
	  <tr>
		<td>&nbsp;</td>
		<td style="text-align: center;">
			<?= $d['nama_pegawai'] ?>
		</td>
	  </tr>
	</tbody>
</table>
</body>
</html>