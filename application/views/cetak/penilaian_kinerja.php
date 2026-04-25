<?php
	$this->load->view('style');
	$adata = $this->m_umum->ambil_data('a_data','id_data','1');
	$fcolor = $adata['fcolor'];
	$color = $adata['color'];
	$member = $this->m_umum->ambil_data('pegawai','barcode_pegawai',$id_pegawai);
	$ruangan = $this->m_umum->ambil_data('ruangan','id_ruangan',$member['id_ruangan']);
	$jabfunge = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$member['id_jabatan_fungsional']);
	$instansi = $this->m_umum->ambil_data('a_instansi','id_instansi','3');
?>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <style type="text/css">
.component{
  font-family: "Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;
  width: 750px;
  margin:0 auto;
  padding: 3rem;
}

.component blockquote.quote {
    position: relative; 
    text-align: center;
    padding: 1rem 1.2rem;
    width: 80%;  /* create space for the quotes */
    color: #484748;
    margin: 1rem auto 2rem;
}
.component blockquote.EN {
    background:
    linear-gradient(to right, #039be5 4px, transparent 4px) 0 100%,
    linear-gradient(to left, #039be5 4px, transparent 4px) 100% 0,
    linear-gradient(to bottom, #039be5 4px, transparent 4px) 100% 0,
    linear-gradient(to top, #039be5 4px, transparent 4px) 0 100%;
    background-repeat: no-repeat;
    background-size: 20px 20px;
}

.component blockquote.DE {
    background:
    linear-gradient(to right, #039be5 4px, transparent 4px) 0% 0%,
    linear-gradient(to bottom, #039be5 4px, transparent 4px) 0% 0%,
    linear-gradient(to left, #039be5 4px, transparent 4px) 100% 100%,
    linear-gradient(to top, #039be5 4px, transparent 4px) 100% 100%;
    background-repeat: no-repeat;
    background-size: 20px 20px;
}
    

/* -- create the quotation marks -- */
.component blockquote.quote:before,
.component blockquote.quote:after{
    font-family: FontAwesome;
    position: absolute;
    color: #039be5;
    font-size: 34px;
}

.component blockquote.EN:before{
    content: "\f10d";
    top: -12px;
    margin-right: -20px;
    right: 100%;
}
.component blockquote.EN:after{
    content: "\f10e";
    margin-left: -20px;
    left: 100%;  
    top: auto;
    bottom: -20px;
}
.component blockquote.DE:before{
    content: "\f10e";
    margin-right: -20px;
    bottom: -20px;
    right: 100%;
}
.component blockquote.DE:after{
    content: "\f10d";
    margin-left: -20px;
    left: 100%;  
    top: -20px;
    bottom: auto;
}

.zitat1 {
  position: relative;
  font-family: 'Verdana', serif;
  font-size: 2.4em;
  line-height: 1.5em;
}
.zitat1 cite {
  font-family: 'Verdana', sans-serif;
  font-size: 0.6em;
  font-weight: 700;
  color: #bdbec0;
  float: right;
}
.zitat1 cite:before {
  content: '\2015'' ';
}
.zitat1:after {
  content: '\201d';
  position: absolute;
  top: 0.28em;
  right: 0px;
  font-size: 6em;
  font-style: italic;
  color: #bdbec0;
  z-index: -1;
}
.sidekick {
  position: relative;
  padding-left: 1em;
  border-left: 0.2em solid #039be5;
  font-family: 'Roboto', serif;
  font-size: 2.4em;
  line-height: 1.5em;
  font-weight: 100;
}
.sidekick:before, .sidekick:after {
  font-family: Calibri;
    color: #039be5;
    font-size: 34px;
}
.sidekick:before {content: '\201e'}
.sidekick:after {content: '\201c';}
.sidekick cite {font-size: 50%; text-align:center; top:50%}
.sidekick cite:before {content: ' \2015 '}
  </style>
</head>
<body>
<div class="header-report">
	<div class="center">
		<h3><b><?= $instansi['nama_instansi'] ?></b></h3>
		<h4><b><?= $title; ?> <?= $tahun; ?></b></h4>
	</div>
	<div class="right">

		<div class="right py-2">
			<table class="table">
				<tbody>
					<tr>
						<td align="center" class="border-1 bg-dark">Nama Pegawai</td>
						<td width="10"></td>
						<td align="center" class="border-1 bg-dark">Nomor Induk Pegawai / Karyawan</td>
					</tr>
					<tr>
						<td align="center" class="border-1"><?= $member['nama_pegawai'] ?></td>
						<td>&nbsp;</td>
						<td align="center" class="border-1"><?= $member['nip'] ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="left">
		<table class="table" style="margin-top: 5px;">
			<tbody>
					<tr>
						<td align="center" class="border-1 bg-dark">Jabatan Fungsional</td>
						<td width="10"></td>
						<td align="center" class="border-1 bg-dark">Ruangan</td>
					</tr>
					<tr>
						<td align="center" class="border-1"><?php echo $jabfunge['nama_jabatan_fungsional']; ?></td>
						<td>&nbsp;</td>
						<td align="center" class="border-1"><?= $ruangan['nama_ruangan'] ?></td>
					</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="content-report">
	<table width="100%" class="table table-border">
		<thead>
		 <tr class="bg-dark">
			<th class="center py-1 px-1"colspan="6" style="vertical-align:middle;text-align:center;font-weight:bold;"> KEGIATAN </th>
		  </tr>
		</thead>

	<tbody>
	  <tr class="bg-dark">
		<td class="left py-1 px-1" colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">KINERJA KLINIS</td>
	  </tr>
	  <tr class="bg-dark">
		<td class="left py-1 px-1" style="vertical-align:middle;text-align:left;font-weight:bold;" colspan="5"> KOMPETENSI </td>
		<td class="right py-1 px-1"style="vertical-align:middle;text-align:right;font-weight:bold;" > JUMLAH</td>
	  </tr>
	<?php
		$total_logbook = 0;$total =0;
		foreach($ambil_data_kompetensi_pegawai_oppe as $rowambil_data_kompetensi_pegawai_oppe){
			$total_logbook = $total_logbook + $rowambil_data_kompetensi_pegawai_oppe['jml_logbook'];
	?>
	  <tr>
		<td class="left py-1 px-1" colspan="5" style="vertical-align:middle;text-align:left;"><?php echo $rowambil_data_kompetensi_pegawai_oppe['nama_kompetensi']; ?></td>
		<td class="right py-1 px-1" style="vertical-align:middle;text-align:right;"><?php echo $rowambil_data_kompetensi_pegawai_oppe['jml_logbook']; ?></td>
	  </tr>
	<?php
		}
	?>
	  <tr class="bg-dark">
		<td class="left py-1 px-1"colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">Nilai</td>
		<td class="center py-1 px-1" style="vertical-align:middle;text-align:center;font-weight:bold;">
			<?php
						$total_logbook = $this->m_rancak->get_oppe_in_year($this->session->id_pegawai,$tahun);
						if($total_logbook < 7){
							$cat_logbook = $this->m_umum->ambil_data('kol_catatan','kode_catatan','oppe_logbook_kurang');
							$nama_cat_logbook = $cat_logbook['nama_catatan'];
							$quote_logbook = $cat_logbook['isi_catatan'];
							$nilai_logbook = "KURANG";
							$skor_logbook = 0;

						}elseif($total_logbook < 12){
							$nilai_logbook = "CUKUP";
							$skor_logbook = 1;
							$cat_logbook = $this->m_umum->ambil_data('kol_catatan','kode_catatan','oppe_logbook_cukup');
							$nama_cat_logbook = $cat_logbook['nama_catatan'];
							$quote_logbook = $cat_logbook['isi_catatan'];
						}
						else{
							$nilai_logbook = "BAIK";
							$skor_logbook = 2;
							$cat_logbook = $this->m_umum->ambil_data('kol_catatan','kode_catatan','oppe_logbook_baik');
							$nama_cat_logbook = $cat_logbook['nama_catatan'];
							$quote_logbook = $cat_logbook['isi_catatan'];
						}
						echo $nilai_logbook;
			?>
		</td>
	  </tr>
  <tr class="bg-dark">
  	<blockquote class="callout quote EN">
  	<td class="left py-1 px-1" style="vertical-align:middle;text-align:left;font-weight:bold;"><cite><?php echo $nama_cat_logbook; ?></cite></td>
	<td class="left py-1 px-1" colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">
		   <?php echo $quote_logbook; ?>
	</td>
	</blockquote>
	<!--	 
		    <p>Zitat nach deutschen Regeln</p>
		 <blockquote class="callout quote DE">
		   Es ist schön, Sie kennenzulernen, Dr. Banner. Ihre Arbeit an Anti-Elektronen-Kollisionen ist beispiellos. Und ich bin ein großer Fan davon, wie Sie Ihre Kontrolle verlieren und sich in ein riesiges grünes Wutmonster verwandeln.
		<cite> - Tony Stark</cite>
		  </blockquote>
		    <p><br>2 Line quote</p>
		    <blockquote class="zitat1">
		     Roads? Where we're going, we don't need... roads.
		    <cite>Dr. Emmett Brown</cite>
		  </blockquote>
		    <p>Sidekick quote german version</p>
		   <blockquote class="sidekick">
		     The only thing permanent in life is impermanence. <cite> Thor in Endgame</cite>
		  </blockquote>
		-->
  </tr>
  <tr class="bg-light">
	<td class="left py-1 px-1" colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
  </tr>
  <tr class="bg-dark">
	<td class="left py-1 px-1" colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">PENGEMBANGAN PROFESI</td>
  </tr>
	<tr class="bg-dark">
		<td class="center py-1 px-1" width="15%" style="vertical-align:middle;text-align:center;font-weight:bold;">Mulai</td>
		<td class="center py-1 px-1" width="15%" style="vertical-align:middle;text-align:center;font-weight:bold;">Akhir</td>
		<td class="center py-1 px-1" width="20%" style="vertical-align:middle;text-align:center;font-weight:bold;">Nama Pelatihan</td>
		<td class="center py-1 px-1" width="15%" style="vertical-align:middle;text-align:center;font-weight:bold;">Penyelenggara</td>
		<td class="center py-1 px-1" width="20%" style="vertical-align:middle;text-align:center;font-weight:bold;">Kategori</td>
		<td class="center py-1 px-1" width="15%" style="vertical-align:middle;text-align:center;font-weight:bold;">SKP</td>
	</tr>
	<?php
		foreach($ambil_data_pelatihan_pegawai_oppe as $rowambil_data_pelatihan_pegawai_oppe){
	?>
	  <tr>
		<td class="center py-1 px-1"><?php echo date('d-m-Y', strtotime($rowambil_data_pelatihan_pegawai_oppe['tgl_a_berkas'])); ?></td>
		<td class="center py-1 px-1"><?php echo date('d-m-Y', strtotime($rowambil_data_pelatihan_pegawai_oppe['tgl_b_berkas'])); ?></td>
		<td class="center py-1 px-1"><?php echo $rowambil_data_pelatihan_pegawai_oppe['nama_berkas']; ?></td>
		<td class="center py-1 px-1"><?php echo $rowambil_data_pelatihan_pegawai_oppe['penyelenggara']; ?></td>
		<td class="center py-1 px-1"><?php echo $rowambil_data_pelatihan_pegawai_oppe['nama_kategori_pelatihan']; ?></td>
		<td class="right py-1 px-1"><?php echo $rowambil_data_pelatihan_pegawai_oppe['kredit']; ?></td>
	  </tr>
	<?php
		}
	?>
	  <tr class="bg-dark">
		<td class="center py-1 px-1" colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">Nilai</td>
		<td class="center py-1 px-1" style="vertical-align:middle;text-align:center;font-weight:bold;">
			<?php
						if($jml_pelatihan == 0){
							$nilai_pelatihan = "KURANG";
							$skor_pelatihan = 0;
							$cat_pelatihan = $this->m_umum->ambil_data('kol_catatan','kode_catatan','oppe_pelatihan_kurang');
							$nama_cat_pelatihan = $cat_pelatihan['nama_catatan'];
							$quote_pelatihan = $cat_pelatihan['isi_catatan'];

						}elseif($jml_pelatihan < 4){
							$nilai_pelatihan = "CUKUP";
							$skor_pelatihan = 1;
							$cat_pelatihan = $this->m_umum->ambil_data('kol_catatan','kode_catatan','oppe_pelatihan_cukup');
							$nama_cat_pelatihan = $cat_pelatihan['nama_catatan'];
							$quote_pelatihan = $cat_pelatihan['isi_catatan'];
						}
						else{
							$nilai_pelatihan = "BAIK";
							$skor_pelatihan = 2;
							$cat_pelatihan = $this->m_umum->ambil_data('kol_catatan','kode_catatan','oppe_pelatihan_baik');
							$nama_cat_pelatihan = $cat_pelatihan['nama_catatan'];
							$quote_pelatihan = $cat_pelatihan['isi_catatan'];
						}
						echo $nilai_pelatihan;
			?>
		</td>
	  </tr>
  <tr class="bg-dark">
  	<blockquote class="callout quote EN">
  	<td class="left py-1 px-1" style="vertical-align:middle;text-align:left;font-weight:bold;"><cite><?php echo $nama_cat_pelatihan; ?></cite></td>
	<td class="left py-1 px-1" colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">
		   <?php echo $quote_pelatihan; ?>
	</td>
	</blockquote>
  </tr>
  <tr class="bg-light">
	<td class="left py-1 px-1" colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
  </tr>
	  <tr class="bg-dark">
		<td class="left py-1 px-1" colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">ETIKA PROFESI</td>
	  </tr>
	<tr class="bg-dark">
		<td colspan="2" class="center py-1 px-1" style="vertical-align:middle;text-align:center;font-weight:bold;" >Tanggal</td>
		<td colspan="2" class="center py-1 px-1" style="vertical-align:middle;text-align:center;font-weight:bold;" >Hasil</td>
		<td colspan="2" class="center py-1 px-1" style="vertical-align:middle;text-align:center;font-weight:bold;" >Penguji</td>
	</tr>
	<?php
		foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
	?>
	  <tr>
		<td colspan="2" class="center py-1 px-1" style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
		<td colspan="2" class="center py-1 px-1" style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
		<td colspan="2" class="center py-1 px-1" style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
	  </tr>
	<?php
		}
	?>
	  <tr class="bg-dark">
		<td class="center py-1 px-1" colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">Nilai</td>
		<td class="center py-1 px-1" style="vertical-align:middle;text-align:center;font-weight:bold;">
			<?php
				if($jml_etik == 0){
					$nilai_etik = "KURANG";
					$skor_etik = 0;
					$cat_etik = $this->m_umum->ambil_data('kol_catatan','kode_catatan','oppe_etik_kurang');
					$nama_cat_etik = $cat_etik['nama_catatan'];
					$quote_etik = $cat_etik['isi_catatan'];
				}
				else{
					$nilai_etik = "BAIK";
					$skor_etik = 2;
					$cat_etik = $this->m_umum->ambil_data('kol_catatan','kode_catatan','oppe_etik_baik');
					$nama_cat_etik = $cat_etik['nama_catatan'];
					$quote_etik = $cat_etik['isi_catatan'];
				}
				echo $nilai_etik;
			?>
		</td>
	  </tr>
  <tr class="bg-dark">
  	<blockquote class="callout quote EN">
  	<td class="left py-1 px-1" style="vertical-align:middle;text-align:left;font-weight:bold;"><cite><?php echo $nama_cat_etik; ?></cite></td>
	<td class="left py-1 px-1" colspan="5" style="vertical-align:middle;text-align:left;font-weight:bold;">
		   <?php echo $quote_etik; ?>
	</td>
	</blockquote>
  </tr>
  <tr class="bg-light">
	<td class="left py-1 px-1" colspan="6" style="vertical-align:middle;text-align:left;font-weight:bold;">&nbsp;</td>
  </tr>
	</tbody>
	  <tr class="bg-dark">
		<td class="left py-2 px-2" colspan="5"  style="vertical-align:middle;text-align:left;font-weight:bold;">RESULT</td>
		<td class="center py-2 px-2" style="vertical-align:middle;text-align:center;font-weight:bold;">
		<?php
			$total = $skor_logbook + $skor_pelatihan + $skor_etik;
			if($total < 2){
				$nilai_total = "KURANG";

			}elseif($total < 4){
				$nilai_total = "CUKUP";
			}
			elseif($total < 6){
				$nilai_total = "BAIK";
			}
			else{
				$nilai_total = "EXCELLENT";
			}
			echo $nilai_total;
		?>
		</td>
	  </tr>
	</table>
</div>
</body>