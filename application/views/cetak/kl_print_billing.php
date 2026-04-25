<?php 
	$this->load->view('surat_style');
//	$this->load->view('style');
	$d	= $this->m_ol_rancak->ambil_print_pu_from_billing($id);
	$unit = $this->m_ol_rancak->ambil_print_unit($id);
	$tgl_pendaftaran_unit	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_pendaftaran_unit'])));
	$tgl_skr	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime(date('Y-m-d'))));
	$admin = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$this->session->id_pegawai);
?>
 <!DOCTYPE html>
<html>

<head>
<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico">
<style>
body{
	font-family: Times New Roman;
	font-size: 1em;
	line-height: 1.7;
    margin: 5;	
    background-color: white;   
}
table{
	font-size: 1em;
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
R I N C I A N   B I A Y A
</div>
<br style="line-height:1">
<table style="width:100%;">
	<tbody>
		<tr>
			<td style="width:25%;font-size: 0.8em;">No Pendaftaran</td>
			<td style="text-align: center;width:4%;font-size: 0.8em;">:</td>
			<td style="font-size: 0.8em;"><?= $d['no_pendaftaran'] ?></td>
		</tr>
		<tr>
			<td style="font-size: 0.8em;">Tanggal Periksa</td>
			<td style="text-align: center;font-size: 0.8em;">:</td>
			<td style="font-size: 0.8em;"><?= $tgl_pendaftaran_unit ?></td>
		</tr>
		<tr>
			<td style="font-size: 0.8em;">RM</td>
			<td style="text-align: center;font-size: 0.8em;">:</td>
			<td style="font-size: 0.8em;"><?= $d['rm'] ?></td>
		</tr>		
		<tr>
			<td style="font-size: 0.8em;">Nama</td>
			<td style="text-align: center;font-size: 0.8em;">:</td>
			<td style="font-size: 0.8em;"><?= $d['nama_pasien'] ?></td>
		</tr>
		<tr>
			<td style="font-size: 0.8em;">Umur</td>
			<td style="text-align: center;font-size: 0.8em;">:</td>
			<td style="font-size: 0.8em;"><?= $d['umur'] ?></td>
		</tr>
		<tr>
			<td style="font-size: 0.8em;">Pembayaran</td>
			<td style="text-align: center;font-size: 0.8em;">:</td>
			<td style="font-size: 0.8em;"><?= $d['nama_cara_bayar'] ?> - <?= $d['nama_detil_cara_bayar'] ?></td>
		</tr>
	</tbody>
</table>
<br style="line-height:2">
<table class="table">
	<thead>
<tr>
	<th colspan="2" style="font-weight: bold;text-align: center; font-size: 0.7em;" class="border-1 bg-dark py-1 px-1">PEMERIKSAAN</th>
	<th style="font-weight: bold; font-size: 0.7em;text-align: center;width: 10%;" class="border-1 bg-dark py-1 px-1">Q</th>
	<th style="font-weight: bold; font-size: 0.7em;text-align: center;width: 20%;" class="border-1 bg-dark py-1 px-1">HARGA</th>
</tr>
	</thead>
	<tbody>
		<?php
		$stotal = 0;
		foreach($unit as $rowunit){		
		?>
<tr>
	<td colspan="4" style="font-size: 0.7em;" class="border-1 bg-dark py-1 px-1"><?= $rowunit['nama_unit'] ?></td>								
</tr>
		<?php
			$tindakan	= $this->m_ol_rancak->ambil_print_tindakan($id,$rowunit['id_unit']);
			$total = 0;
			foreach($tindakan as $rowtindakan){	
			$kali = $rowtindakan['jml_billing'] * $rowtindakan['nominal_billing'];
			$total = $total + $kali;
			$stotal = $stotal + $kali;
		?>
<tr>
	<td style="font-size: 0.7em;width: 3%;border-right: 0;" class="border-1 py-1 px-1">&nbsp;</td>
	<td style="font-size: 0.7em;border-left: 0;" class="border-1 py-1 px-1"><?= $rowtindakan['nama_tindakan'] ?></td>
	<td style="font-size: 0.7em;text-align: right;width: 10%;" class="border-1 py-1 px-1"><?= $rowtindakan['jml_billing'] ?></td>
	<td style="font-size: 0.7em;text-align: right;width: 20%;" class="border-1 py-1 px-1">Rp.<?= number_format($rowtindakan['nominal_billing'],0) ?></td>
</tr>			
		<?php
			}		
		?>
<tr>
	<td colspan="3" style="font-size: 0.7em;font-weight: bold;text-align: right;" class="border-1 py-1 px-1">Jumlah</td>								
	<td style="font-size: 0.7em;font-weight: bold;text-align: right;" class="border-1 py-1 px-1">Rp.<?= number_format($total,0) ?></td>								
</tr>
		<?php
		}		
		?>		
<tr>
	<td colspan="3" style="font-size: 0.7em;font-weight: bold;text-align: right;" class="border-1 py-1 px-1">Total</td>								
	<td style="font-size: 0.7em;font-weight: bold;text-align: right;" class="border-1 py-1 px-1">Rp.<?= number_format($stotal,0) ?></td>								
</tr>	
	</tbody>
</table>
<br style="line-height:2">
<table cellspacing="0" style="text-align:center;line-height: 2;margin:7pt;border-collapse:collapse; border:none; width:100%;">
	<tbody>
	  <tr>
	    <td style="width:55%;font-size: 0.7em;">&nbsp;</td>
		<td style="font-size: 0.7em;"><?= $tgl_skr ?></td>
	  </tr>
	  <tr>
	    <td style="font-size: 0.7em;">&nbsp;</td>
		<td style="font-size: 0.7em;">ADMIN</td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <?php  
	  if(empty($admin['ttd_pegawai'])){
	  ?>
	  <tr>
	    <td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <?php
	  }else{
	  ?>
	  <tr>
	    <td>&nbsp;</td>
		<td><img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $admin['ttd_pegawai']; ?>" alt="User"></td>
	  </tr>
	  <?php	  	
	  }
	  ?>
	  <tr>
		<td style="text-align: center;font-size: 0.7em;">&nbsp;</td>
		<td style="text-align: center;font-size: 0.7em;">
			<?= $admin['nama_pegawai'] ?>
		</td>
	  </tr>
	</tbody>
</table>
</body>
</html>