<?php 
	$this->load->view('surat_style');
//	$this->load->view('style');
$apv = $this->m_kredensial->ambil_pengajuan_validasi_pengajuan_valiasi($data['id']);
$asesor = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv["id_asesor"]);
$kesesuaian_bukti  = explode(",", $apv["kesesuaian_bukti_validasi"]);
$nama_asesor  = set_value('nama_asesor',$asesor["nama_pegawai"]);
$barcode_pengajuan_validasi  = set_value('barcode_pengajuan_validasi',$apv["barcode_pengajuan_validasi"]);
$validasi  = set_value('validasi',$apv["validasi"]);
$tgl_asesi  = set_value('tgl_asesi',$apv["tgl_asesi"]);
$tgl_asesor  = set_value('tgl_asesor',$apv["tgl_asesor"]);
$ket_pengajuan_validasi  = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
$id_jenis_form  = set_value('id_jenis_form',$apv["id_jenis_form"]);
$nama_jenis_form  = set_value('nama_jenis_form',$apv["nama_jenis_form"]);
$barcode_pengajuan  = set_value('barcode_pengajuan',$apv["barcode_pengajuan"]);
//====================================================
$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($apv['barcode_pengajuan']);
$id_berkas  = explode(",", $apk["id_berkas"]);
$berkas  = $apk["id_berkas"];
$id_ijasah  = explode(",", $apk["id_ijasah"]);
$ijasah  = $apk["id_ijasah"];
$id_str  = explode(",", $apk["id_str"]);
$str  = $apk["id_str"];
$id_sertifikat  = explode(",", $apk["id_sertifikat"]);
$sertifikat  = $apk["id_sertifikat"];
$id_etik_pegawai  = explode(",", $apk["id_etik_pegawai"]);
$ambil_berkas_data = $this->m_ol_rancak->ambil_id_berkas_data($apk['id_pegawai']);
$kompetensi = $this->m_umum->ambil_data_explode('nkr_kompetensi','id_kompetensi',$apk['kode_unit_pengajuan']);

	$tgl_pengajuan	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
	$tgl_lahir	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_lahir'])));
	if($apk["jk"] == 1){ $jk = 'Laki-laki'; }else{ $jk = 'Perempuan'; }
	$ambil_nkr_kompetensi=$this->m_kredensial->ambil_nkr_kompetensi($apk["kode_unit_pengajuan"]);
	$ambil_berkas_data=$this->m_ol_rancak->ambil_id_berkas_data($apk['id_pegawai']);
		//		$kondisi_validasi=array('id_form'=>$form['id_form'],'barcode_pengajuan'=>$apk['barcode_pengajuan']);
		//		$pengavali = $this->m_umum->ambil_data_kondisi('nkr_pengajuan_validasi',$kondisi_validasi);
	$ambil_data_etik_pegawai_oppe = $this->m_ol_rancak->ambil_data_etik_pegawai_oppe($apk["id_pegawai"],date('Y'));
	$kesesuaian_bukti  = explode(",", $apk["kesesuaian_bukti"]);
	$ket_pengajuan_validasi = set_value('ket_pengajuan_validasi',$apk["ket_pengajuan"]);
	$kesesuaian_bukti = explode(",", $apk["kesesuaian_bukti"]);				
	$tgl_asesi = set_value('tgl_asesi',$apk["tgl_asesi_pengajuan"]);
	$id_berkas = explode(",", $apk["id_berkas"]);
	$berkas = $apk["id_berkas"];
	$id_ijasah = explode(",", $apk["id_ijasah"]);
	$ijasah = $apk["id_ijasah"];
	$id_str = explode(",", $apk["id_str"]);
	$str = $apk["id_str"];
	$id_sertifikat = explode(",", $apk["id_sertifikat"]);
	$id_etik_pegawai = explode(",", $apk["id_etik_pegawai"]);
	$sertifikat = $apk["id_sertifikat"];
	$asesore = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apk['id_asesor_pengajuan']);
	$ttd_asesor = $asesore['ttd_pegawai'];
	$nama_asesor = $asesore['nama_pegawai'];
	if(empty($apk['tgl_asesi_pengajuan'])){
		$tgl_asesi	= "";
	}else{
		$tgl_asesi	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_asesi_pengajuan'])));		
	}
	if(empty($apk['tgl_asesor_pengajuan'])){
		$tgl_asesor	= "";
	}else{
		$tgl_asesor	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_asesor_pengajuan'])));		
	}
	$url_cek=base_url().'assets/images/ceklist.png';
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


<div style="text-align:center;font-weight:bold;font-size: 12pt; line-height: 2;">
<?= $form['nama_jenis_form'] ?>
</div>
<div style="text-align:left;font-weight:bold;margin-left:10pt;margin-top: 25pt;margin-bottom: 7pt;">
Bagian 1 : Rincian Data Asesi
</div>
<br style="line-height:1">
<table style="width:100%;margin-left:20pt;">
	<tbody>
		<tr>
			<td style="vertical-align: top; width:25%;">Nama Lengkap</td>
			<td style="vertical-align: top; text-align: center;width:4%;">:</td>
			<td style="vertical-align: top; "><?= $apk['nama_pegawai'] ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; ">Tempat/ Tanggal Lahir</td>
			<td style="vertical-align: top; text-align: center;">:</td>
			<td style="vertical-align: top; "><?= $apk['tmp_lahir'] ?>, <?= $tgl_lahir ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; ">Jenis Kelamin</td>
			<td style="vertical-align: top; text-align: center;">:</td>
			<td style="vertical-align: top; "><?= $jk ?></td>
		</tr>		
		<tr>
			<td style="vertical-align: top; ">Kualifikasi</td>
			<td style="vertical-align: top; text-align: center;">:</td>
			<td style="vertical-align: top; "><?= $apk['nama_jabatan_fungsional'] ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; ">Pendidikan</td>
			<td style="vertical-align: top; text-align: center;">:</td>
			<td style="vertical-align: top; "><?= $apk['nama_pendidikan'] ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; ">Pekerjaan</td>
			<td style="vertical-align: top; text-align: center;">:</td>
			<td style="vertical-align: top; "><?= $apk['nama_jabatan'] ?> / <?= $apk['nama_status_pegawai'] ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; ">Alamat</td>
			<td style="vertical-align: top; text-align: center;">:</td>
			<td style="vertical-align: top; "><?= $apk['alamat'] ?>, <?= $apk['nama_kel'] ?>, <?= $apk['nama_kec'] ?>, <?= $apk['nama_kab'] ?>, <?= $apk['nama_prov'] ?> </td>
		</tr>
		<tr>
			<td style="vertical-align: top; ">No Telp - Email</td>
			<td style="vertical-align: top; text-align: center;">:</td>
			<td style="vertical-align: top; "><?= $apk['no_hp'] ?> - <?= $apk['email'] ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; ">Tempat Bekerja</td>
			<td style="vertical-align: top; text-align: center;">:</td>
			<td style="vertical-align: top; "><?= $apk['nama_working'] ?></td>
		</tr>
	</tbody>
</table>
<br />

<div style="text-align:left;font-weight:bold;margin-left:10pt;margin-top: 25pt;margin-bottom: 7pt;">
Bagian 2 : Daftar Unit Kompetensi
</div>
<div style="text-align:left;margin-left:10pt;margin-top: 7pt;margin-bottom: 7pt;">
Pada bagian ini, cantumkan unit kompetensi yang akan diajukan untuk dinilai. Unit kompetensi yang diajukan berupa Unit Kompetensi Tunggal
</div>

<table style="width:100%;" class="table-border">
	<thead>
		<tr>
			<th class="px-1" style="vertical-align: top; text-align: center;width:7%;">No</th>
			<th class="px-1" style="vertical-align: top; text-align: center;">Kode Unit</th>
			<th class="px-1" style="vertical-align: top; text-align: center;">Judul Unit</th>
		</tr>
	</thead>
	<tbody>
    <?php
    $no = 0;
    foreach($ambil_nkr_kompetensi as $rowambil_nkr_kompetensi){
    	$no++;
    ?>
		<tr>
			<td class="px-1" style="font-weight: bold; vertical-align: top; text-align: center;"><?= $no ?></td>
			<td class="px-1" style="font-weight: bold; vertical-align: top; "><?= $rowambil_nkr_kompetensi['kode_unit'] ?></td>
			<td class="px-1" style="font-weight: bold; vertical-align: top; "><?= $rowambil_nkr_kompetensi['nama_kompetensi'] ?></td>
		</tr>
		<tr>
			<td colspan="3" class="px-1" style="font-weight: bold; vertical-align: top; text-align: left;">
				STANDAR KOMPETENSI DAN SPO
			</td>
		</tr>
    <?php

    	$nkr_kewenangan=$this->m_kredensial->ambil_nkr_kewenangan_dari_nkr_kompetensi($rowambil_nkr_kompetensi["id_kompetensi"],$apk['id_pengajuan']);
    	foreach($nkr_kewenangan as $rownkr_kewenangan){
    		
    ?>
		<tr>
			<td class="px-1" style="vertical-align: top; text-align: left;padding-left: 15pt;">&nbsp;</td>
			<td colspan="2" class="px-1" style="vertical-align: top; text-align: left;padding-left: 15pt;"><?= $rownkr_kewenangan['nama_kewenangan'] ?></td>
		</tr>
		<?php  
			}
		}
		?>
	</tbody>
</table>

<div style="text-align:left;font-weight:bold;margin-left:10pt;margin-top: 25pt;margin-bottom: 7pt;">
Bagian 3 : Kompetensi dan Bukti Portofolio
</div>
<div style="text-align:left;margin-left:10pt;margin-top: 7pt;margin-bottom: 7pt;">
Pada bagian ini, cantumkan bukti-bukti pendukung yang relevan dengan unit kompetensi yang diusulkan.
</div>

            <table class="table-border" style="width:100%;">
              <thead>
                <tr>
                <th rowspan="2" class="px-1" style="vertical-align: middle;text-align: left; ">Nama Berkas</th>
                <th colspan="4" class="px-1" style="vertical-align: middle;text-align: center; ">KESESUAIAN BUKTI </th>
                </tr>
                <tr>
                <th class="px-1" style="vertical-align: middle;text-align: center; width: 5%;">M</th>
                <th class="px-1" style="vertical-align: middle;text-align: center; width: 5%;">V</th>
                <th class="px-1" style="vertical-align: middle;text-align: center; width: 5%;">O</th>
                <th class="px-1" style="vertical-align: middle;text-align: center; width: 5%;">T</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  if(!empty($id_ijasah)){
                    foreach($ambil_berkas_data as $row){
                      if (in_array($row['id_berkas'],$id_ijasah)) {
                  ?>
                    <tr>
                    <td class="px-1" style="vertical-align: middle;text-align: left; ">
                         Jenis Berkas : <?php echo $row['nama_kategori_berkas']; ?><br>Nama Berkas : <?php echo $row['nama_berkas']; ?>,<br>
                         Lulus Tahun : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))) ?>
                    </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
		<?php if(in_array($row['id_berkas']."_1",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
		<?php if(in_array($row['id_berkas']."_2",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
		<?php if(in_array($row['id_berkas']."_3",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
		<?php if(in_array($row['id_berkas']."_4",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  if($id_str!==""){
                    foreach($ambil_berkas_data as $row2){
                      if (in_array($row2['id_berkas'],$id_str)) {
                  ?>
                    <tr>
                    <td class="px-1" style="vertical-align: middle;text-align: left; ">
                        Jenis Berkas : <?php echo $row2['nama_kategori_berkas']; ?><br>Nama Berkas : <?php echo $row2['nama_berkas']; ?>,<br>
                        Masa Berlaku : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row2['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row2['tgl_b_berkas']))) ?>
                    </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row2['id_berkas']."_1",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row2['id_berkas']."_2",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row2['id_berkas']."_3",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row2['id_berkas']."_4",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  if($id_sertifikat!==""){
                    foreach($ambil_berkas_data as $row3){
                      if (in_array($row3['id_berkas'],$id_sertifikat)) {
                  ?>
                    <tr>
                    <td class="px-1" style="vertical-align: middle;text-align: left; ">
                        Jenis Berkas : <?php echo $row3['nama_kategori_berkas']; ?><br>Nama Berkas : <?php echo $row3['nama_berkas']; ?>, <br>Penyelenggara : <?php echo $row3['penyelenggara']; ?>,<br>
                        Tanggal : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row3['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row3['tgl_b_berkas']))) ?>, <br>SKS : <?= number_format($row3['kredit'],1) ?>
                    </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row3['id_berkas']."_1",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row3['id_berkas']."_2",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row3['id_berkas']."_3",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row3['id_berkas']."_4",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                //  if($id_ijasah!==""){
                  if(!empty($id_berkas)){ 
                    foreach($ambil_berkas_data as $row4){
                      if (in_array($row4['id_berkas'],$id_berkas)) {
                  ?>
                    <tr>
                  <td class="px-1" style="vertical-align: middle;text-align: left; ">
                       Jenis Berkas : <?php echo $row4['nama_kategori_berkas']; ?><br>Nama Berkas : <?php echo $row4['nama_berkas']; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row4['id_berkas']."_1",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px"><img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row4['id_berkas']."_2",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px"><img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row4['id_berkas']."_3",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px"><img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                  <td class="px-1" style="vertical-align: middle;text-align: center; ">
				<?php if(in_array($row4['id_berkas']."_4",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px"><img src="'.$url_cek.'" width="10px">'; ?>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  $kondisietik=array("id_pegawai"=>$this->session->id_pegawai,"DATE_FORMAT(tgl_etik_pegawai,'%Y')"=>date('Y'));
                  $jml_etik = $this->m_umum->jumlah_record_tabel('ol_etik_pegawai',$kondisietik);
                  if($jml_etik > 0){
                  ?>
                  <tr>
                  <td colspan="5" class="px-1" style="vertical-align: middle;text-align: left; "><i class="fa fa-file-text"></i> ETIK PEGAWAI</td>
                  </tr>
                  <tr>
                  <td colspan="5">
                  	<div class="box-body table-responsive no-padding">
                    <table style="width:100%;" class="table-bordered">
                      <thead>
                        <tr>
                          <th class="px-1" style="vertical-align: middle;text-align: center; ">Tanggal</th>
                          <th class="px-1" style="vertical-align: middle;text-align: center; ">Hasil</th>
                          <th class="px-1" style="vertical-align: middle;text-align: center; ">Penguji</th>
                          <th class="px-1" style="vertical-align: middle;text-align: center; "><i class="fa fa-search"></i></th>
                          <th class="px-1" style="vertical-align: middle;text-align: center; width: 5%;">M</th>
                          <th class="px-1" style="vertical-align: middle;text-align: center; width: 5%;">V</th>
                          <th class="px-1" style="vertical-align: middle;text-align: center; width: 5%;">O</th>
                          <th class="px-1" style="vertical-align: middle;text-align: center; width: 5%;">T</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
                          if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$id_etik_pegawai)) {
                      ?>
                        <tr>
                        <td class="px-1" style="vertical-align: middle;text-align: center; "><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
                        <td class="px-1" style="vertical-align: middle;text-align: center; "><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
                        <td class="px-1" style="vertical-align: middle;text-align: center; "><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
                        <td class="px-1" style="vertical-align: middle;text-align: center; ">

                        </td>
                        <td class="px-1" style="vertical-align: middle;text-align: center; ">
   <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">"'; ?>
                        </td>
                        <td class="px-1" style="vertical-align: middle;text-align: center; ">
   <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">"'; ?>
                        </td>
                        <td class="px-1" style="vertical-align: middle;text-align: center; ">
   <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">"'; ?>
                        </td>
                        <td class="px-1" style="vertical-align: middle;text-align: center; ">
   <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">"'; ?>
                        </td>
                        </tr>
                      <?php
                          }
                        }
                      ?>
                      </tbody>
                    </table>
                  	</div>
                  </td>
                  </tr>
                  <?php  
                  	}
                  ?>
              </tbody>
                      <tfoot>
                      	<tr><td colspan="5" style="font-size:9pt;font-weight: bold;">
                      		Keterangan : M = Memadai, V = Valid, O = Asli, T = Terkini
                      	</td></tr>
                      </tfoot>              
            </table>
            <br style="line-height: 2;">
            <br style="line-height: 2;">
<table style="line-height: 2;font-size:9pt;margin:7pt;border-collapse:collapse; width:100%;">
	<tbody>
	  <tr>
	    <td style="width:40%;vertical-align: top;font-weight: bold;" class="border-1 px-1 py-1"  rowspan="8">
	    	Catatan / Rekomendasi<br><?= $ket_pengajuan_validasi ?>
	    </td>
	    <td class="border-1 px-1 py-1" style="font-weight: bold;" colspan="2">Asesi : <?= $apk['nama_pegawai'] ?></td>
	  </tr>
	  <tr>
	    <td class="border-1 px-1 py-1" >&nbsp;</td>
	    <td class="border-1 px-1 py-1"  rowspan="3">
	  <?php  
	  	if(!empty($apk['ttd_pegawai'])){
	  ?>
<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $apk['ttd_pegawai']; ?>" alt="User">
	  <?php  
	  	}
	  ?>
	    </td>
	  </tr>
	  <tr>
	    <td style="width:25%;" class="border-1 px-1 py-1" >Tanggal :</td>
	  </tr>
	  <tr>
	    <td class="border-1 px-1 py-1" ><?= $tgl_asesi ?></td>
	  </tr>
	  <tr>
	    <td class="border-1 px-1 py-1" style="font-weight: bold;" colspan="2">Asesor : <?= $nama_asesor ?></td>
	  </tr>
	  <tr>
	    <td class="border-1 px-1 py-1" >&nbsp;</td>
	    <td class="border-1 px-1 py-1" rowspan="3">
	  <?php  
	  	if(!empty($ttd_asesor)){
	  ?>
<img width="150px" src="<?php echo base_url('assets/berkas/kop/'); ?><?php echo $ttd_asesor; ?>" alt="User">
	  <?php  
	  	}
	  ?>
	    </td>
	  </tr>
	  <tr>
	    <td class="border-1 px-1 py-1" >Tanggal</td>
	  </tr>
	  <tr>
	    <td class="border-1 px-1 py-1" ><?= $tgl_asesor ?></td>
	  </tr>
	</tbody>
</table>
</body>
</html>