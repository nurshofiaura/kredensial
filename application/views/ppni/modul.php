<?php 
	$this->load->view('surat_style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$d	= $this->m_ol_rancak->ambil_data_kor_print_4_print($id);
	$dp	= $this->m_ol_rancak->ambil_data_kprin_detil_4_print($d['id_kor_print']);
	$tgl_lahir	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_lahir'])));
	$kop = $d['kop_pengcab'];
	$kategori = $d['nama_kategori'];
?>
 <!DOCTYPE html>
<html>

<head>
<link rel="icon" href="<?php echo base_url();?>assets/images/ppni.ico">
<style>
body{
	font-family: Times New Roman;
	font-size: <?= $d['font_size'] ?>pt;
	line-height: 1.7;
    margin: 0;	
    background-color: white;   
}
</style>
</head>
<body>
<?php  
	if(!empty($kop)){
?>

<div class="header-report">
	<div class="center">				
		<img src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $kop; ?>" alt="User profile picture">
	</div>
</div>
<?php  
}
?>
<br style="line-height:1">
<div style="text-align:center">
<strong><span><?= $d['title_kor_print'] ?></span></strong><br />
Nomor : <?= $d['no_kor_print'] ?>
</div>
<br />
Dewan Pengurus Daerah <?= $d['asal'] ?> atas nama Dewan Pengurus Pusat Persatuan Perawat Nasional Indonesia menerangkan bahwa :<br />
<table cellspacing="0" style="border-collapse:collapse; border:none; width:100%;">
	<tbody>
		<tr>
			<td>Nama</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['nama_pegawai'] ?></td>
		</tr>
		<tr>
			<td>Tempat dan tanggal lahir</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['tmp_lahir'].', '.$tgl_lahir ?></td>
		</tr>
		<tr>
			<td>NIRA</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['no_profesi'] ?></td>
		</tr>
		<tr>
			<td>Telp/HP</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['no_hp'] ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['email'] ?></td>
		</tr>
		<tr>
			<td>Tempat Praktik</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['nama_working'] ?></ul>
		</tr>
		<tr>
			<td>Alamat</td>
			<td style="text-align: center;">:</td>
			<td><?= $d['alamat'] ?></td>
		</tr>
	</tbody>
</table>
<br />
Oleh karena yang bersangkutan telah membuat Modul Makalah Berjudul "<?= $d['modul'] ?>" untuk kurun waktu kegiatan <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_awal']))) ?> s.d <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_akhir']))) ?> dan sudah dilakukan penilaian.<br />
<br />
Dengan ini kepadanya diberikan surat rekomendasi untuk melengkapi persyaratan perpanjangan STR, agar dapat aktif bekerja mengelola pasien secara langsung di <?= $d['tmp_modul'] ?>
<br /><br />
Demikian surat rekomendasi ini diberikan untuk digunakan sebagaimana mestinya.<br/>
<table cellspacing="0" style="border-collapse:collapse; border:none; width:100%;">
	<tbody>
		<?php  
	 		$kondisi=array('id_kor_print'=>$d['id_kor_print']);
	 		$jml = $this->m_umum->jumlah_record_filter('ol_kprint_detil',$kondisi);
	 		if($jml == 1){
				foreach($dp as $rowdp){

		?>

  <tr>
    <td style="width:35%;">&nbsp;</td>
    <td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td><td>&nbsp;</td>
	<td style="text-align: center;"><?= $d['tmp_kor_print'] ?>, <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_kor_print']))) ?></td>
  </tr>
  <tr>
	<td>&nbsp;</td><td>&nbsp;</td>
	<td style="text-align: center;">
		<?= $rowdp['nama_ms_pengurus'].'<br />'.$rowdp['nama_pengcab'] ?>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>			
	<td rowspan="3" style="text-align: center;">
		<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $rowdp['stempel_pengcab']; ?>" alt="User">
	</td>
	<?php 
		if(empty($rowdp['ttd_pegawai'])){
			echo '<td>&nbsp;</td>';
		}else{
	?>				
	<td style="text-align: center;">
		<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $rowdp['ttd_pegawai']; ?>" alt="User">
	</td>
	<?php  
		}
	?>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
	<td style="text-align: center;"><span><?= $rowdp['nama_pegawai'] ?></span><br />
	NIRA PPNI <?= $rowdp['no_profesi'] ?></td>
  </tr>
		<?php  
				}
			}elseif($jml == 2){
				foreach($dp as $rowdp){
					$nama_ms_pengurus[] = $rowdp['nama_ms_pengurus'];
					$nama_pengcab[] = $rowdp['nama_pengcab'];
					$nama_pegawai[] = $rowdp['nama_pegawai'];
					$no_profesi[] = $rowdp['no_profesi'];
					$ttd_pegawai[] = $rowdp['ttd_pegawai'];
				}
		?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	<td style="text-align: center;"><?= $d['tmp_kor_print'] ?>, <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_kor_print']))) ?></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				 <?= $nama_ms_pengurus[0].'<br />'.$nama_pengcab[0] ?>
			</td>
			<td>&nbsp;</td>
			<td style="text-align: center;">
				 <?= $nama_ms_pengurus[1].'<br />'.$nama_pengcab[1] ?>
			</td>
		</tr>
		<tr>
			<td rowspan="2" style="text-align:center;">
				<?php
				if(empty($ttd_pegawai[0])){ echo '&nbsp;'; }else{
				?>
				<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?= $ttd_pegawai[0] ?>" alt="User profile picture">
				<?php 
				}
				?>
			</td>
			<td rowspan="2" style="text-align:center;">
				<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $rowdp['stempel_pengcab']; ?>" alt="User">
			</td>
			<td rowspan="2" style="text-align:center;">
				<?php
				if(empty($ttd_pegawai[1])){ echo '&nbsp;'; }else{
				?>
				<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?= $ttd_pegawai[1] ?>" alt="User profile picture">
				<?php 
				}
				?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;"><span><?= $nama_pegawai[0] ?></span><br />
			NIRA PPNI <?= $no_profesi[0] ?></td>			
			<td>&nbsp;</td>
			<td style="text-align: center;"><span><?= $nama_pegawai[1] ?></span><br />
			NIRA PPNI <?= $no_profesi[1] ?></td>
		</tr>
		<?php
			}elseif($jml == 3){
				foreach($dp as $rowdp){
					$nama_ms_pengurus[] = $rowdp['nama_ms_pengurus'];
					$nama_pengcab[] = $rowdp['nama_pengcab'];
					$nama_pegawai[] = $rowdp['nama_pegawai'];
					$no_profesi[] = $rowdp['no_profesi'];
				}
		?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
	<td style="text-align: center;"><?= $d['tmp_kor_print'] ?>, <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($d['tgl_kor_print']))) ?></td>
		</tr>
		<tr>
			<td style="text-align: center;">
				 <?= $nama_ms_pengurus[0].'<br />'.$nama_pengcab[0] ?>
			</td>
			<td>&nbsp;</td>
			<td style="text-align: center;">
				 <?= $nama_ms_pengurus[1].'<br />'.$nama_pengcab[1] ?>
			</td>
		</tr>
		<tr>
			<td rowspan="2" style="text-align:center;">
				<?php
				if(empty($ttd_pegawai[0])){ echo '&nbsp;'; }else{
				?>
				<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?= $ttd_pegawai[0] ?>" alt="User profile picture">
				<?php 
				}
				?>
			</td>
			<td rowspan="2" style="text-align:center;">
				<img width="100px" src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $rowdp['stempel_pengcab']; ?>" alt="User">
			</td>
			<td rowspan="2" style="text-align:center;">
				<?php
				if(empty($ttd_pegawai[1])){ echo '&nbsp;'; }else{
				?>
				<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?= $ttd_pegawai[1] ?>" alt="User profile picture">
				<?php 
				}
				?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: center;"><span><?= $nama_pegawai[0] ?></span><br />
			NIRA PPNI <?= $no_profesi[0] ?></td>			
			<td>&nbsp;</td>
			<td style="text-align: center;"><span><?= $nama_pegawai[1] ?></span><br />
			NIRA PPNI <?= $no_profesi[1] ?></td>
		</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr>
			<td colspan="3" style="text-align: center;">
				<?= $nama_ms_pengurus[2].'<br />'.$nama_pengcab[2] ?>
			</td>
</tr>
<?php  
	if(empty($ttd_pegawai[2])){
?>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
<tr>
	<td colspan="3">&nbsp;</td>
</tr>
<?php 
	}else{
?>
<tr>
	<td colspan="3" style="text-align: center;">
		<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?= $ttd_pegawai[2] ?>" alt="User">
	</td>
</tr>
<?php 
	}
?>
<tr>
			<td colspan="3" style="text-align: center;"><span><?= $nama_pegawai[2] ?></span><br />
			NIRA PPNI <?= $no_profesi[2] ?></td>
</tr>
		<?php
			}
		?>
	</tbody>
</table>
</body>
</html>