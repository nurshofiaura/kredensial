<?php 
	$this->load->view('surat_style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$d	= $this->m_ol_rancak->ambil_data_korespodensi_4_print($id,$id2);
	$nama = $d['nama_pegawai'];
	$no_profesi = $d['no_profesi'];
	$alamat = $d['alamat'];
	$no_hp = $d['no_hp'];
	$tmp_lahir = $d['tmp_lahir'];
	$tahun_lahir = date('Y', strtotime($d['tgl_lahir'])); 
	$hari_lahir = date('d', strtotime($d['tgl_lahir'])); 
	$bulan_lahir = $this->m_rancak->getBulan(date('m', strtotime($d['tgl_lahir'])));	
	$tgl_lahir = $hari_lahir." ".$bulan_lahir." ".$tahun_lahir;
	$asal = $d['asal'];
	$tujuan = $d['tujuan'];
	$kop = $d['kop'];
	$kategori = $d['nama_kategori'];
	$phrase  = "Kamu harus makan daging, sayur dan telor";
	$healthy = ["$nama", "sayur", "telor"];
	$yummy   = ["<?= $nama ?>", "beer", "ice cream"];

	$newPhrase = str_replace($healthy, $yummy, $d['isi_format']);
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
<?= $newPhrase ?>	
<div style="text-align:center">
<strong><span>SURAT PENGANTAR</span></strong><br />
SURAT PENGANTAR
</div>
<br />
&nbsp;
<table cellspacing="0" style="border-collapse:collapse; border:none; width:100%;">
	<tbody>
		<tr>
			<td colspan="3">Saya yang bertanda tangan dibawah ini :</td>
		</tr>
		<tr>
			<td style="width:25%">Nama</td>
			<td style="width:5%;text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Tempat dan tanggal lahir</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3">Dengan ini menerangkan bahwa :</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Tempat dan tanggal lahir</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>NIRA</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Telp/HP</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Email</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Tempat Praktik</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Alamat</td>
			<td style="text-align: center;">:</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>
<br />
Adalah benar berprofesi sebagai perawat dan telah terdaftar sebagai anggota PPNI DPK RSUD dr. H. Moch.Ansari Saleh Banjarmasin.<br />
<br />
Surat pengantar ini dibuat untuk permohonan pembuatan Surat Rekomendasi dari PPNI DPD Kota Banjarmasin untuk melengkapi syarat pembuatan SIPP (Surat Ijin Praktik Perawat) yang bertempat praktik di RSUD dr. H.Moch. Ansari Saleh Banjarmasin<br />
<br />
Demikian surat pengantar ini dikeluarkan untuk digunakan sebagaimana mestinya.<br />
&nbsp;
<table cellspacing="0" style="border-collapse:collapse; border:none; width:100%;">
	<tbody>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2" style="text-align: right;">Banjarmasin, 13 Februari 2023</td>
		</tr>
		<tr>
			<td style="width:40%">&nbsp;</td>
			<td colspan="2" style="text-align: center;">
			Ketua PPNI Komisariat<br />
			RSUD Dr. H. Moch. Ansari Saleh Banjarmasin</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2" style="text-align: center;">Supriadi, S.Kep., Ns<br />
			NIRA PPNI 63710053403</td>
		</tr>
	</tbody>
</table>
 