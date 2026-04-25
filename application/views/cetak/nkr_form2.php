<?php 
	$this->load->view('surat_style');
//	$this->load->view('style');
	$form = $this->m_umum->ambil_data('kol_jenis_form','id_jenis_form',2);
	$apk = $this->m_kredensial->ambil_pengajuan_kompetensi($id);
	$tgl_pengajuan	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apk['tgl_pengajuan'])));
	$kompetensi = $this->m_kredensial->ambil_nkr_kompetensi($apk['kode_unit_pengajuan']);
	$kondisi_form=array('id_jenis_form'=>$form["id_jenis_form"],'id_kompetensi'=>$apk['kode_unit_pengajuan'],'id_instansi'=>$apk['id_instansi']);
	$nkre_form = $this->m_umum->ambil_data_kondisi('nkr_form',$kondisi_form);
	$apv = $this->m_kredensial->ambil_pengajuan_validasi($id,$nkre_form["barcode_form"]);
	$form2_detil = $this->m_kredensial->ambil_nkr_validasi_question_detil($apv['barcode_pengajuan_validasi']);
	$barcode_pengajuan = set_value('barcode_pengajuan',$apk["barcode_pengajuan"]);
	$asesore = $this->m_umum->ambil_data('ol_pegawai','id_pegawai',$apv['id_asesor']);
	$ttd_asesor = $asesore['ttd_pegawai'];
	$nama_asesor = $asesore['nama_pegawai'];
	if(empty($apv['tgl_asesi'])){
		$tgl_asesi	= "";
	}else{
		$tgl_asesi	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apv['tgl_asesi'])));		
	}
	if(empty($apv['tgl_asesi'])){
		$tgl_asesor	= "";
	}else{
		$tgl_asesor	= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($apv['tgl_asesor'])));		
	}
	$ket_pengajuan_validasi = set_value('ket_pengajuan_validasi',$apv["ket_pengajuan_validasi"]);
	$kesesuaian_bukti  = explode(",", $apv["kesesuaian_bukti_validasi"]);
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


<div style="text-align:center;font-weight:bold; font-size: 12pt; line-height: 2;">
<?= $form['nama_jenis_form'] ?>
</div>
<br style="line-height:1">
<table style="width:100%;margin-left: 20pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;">:</td>
      <td style="vertical-align: top;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%">:</td>
      <td style="vertical-align: top;"><?= $apk['nama_pegawai'] ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;">:</td>
      <td style="vertical-align: top;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top;">Tempat</td>
      <td style="vertical-align: top; text-align: center;">:</td>
      <td style="vertical-align: top;"><?= $apk['nama_working'] ?></td>
    </tr>
  </tbody>
</table>
<br />

  <div style="text-align:left;font-weight:bold;margin-left:10pt;margin-top: 25pt;margin-bottom: 7pt;">
UNIT KOMPETENSI<br>
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>   
</div>
            <br style="line-height: 2;">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th style="vertical-align: top; text-align: center;">Komponen Asesmen Mandiri</th>
      <th style="vertical-align: top; text-align: center;">Daftar Pertanyaan</th>
      <th style="vertical-align: top; text-align: center;width: 15%;">Penilaian</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){
    ?>
    <tr>
      <td class="border-1 px-1 py-1" style="vertical-align: top; "><?= $rowform2_detil['nama_asesmen'] ?></td>
      <td class="border-1 px-1 py-1" style="vertical-align: top; "><?= $rowform2_detil['nama_question'] ?></td>
      <td class="border-1 px-1 py-1" style="vertical-align: middle;text-align: center; ">
		<?php if(in_array($rowform2_detil['id_question']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo '<img src="'.$url_cek.'" width="10px">'; ?>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
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