<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];	
if ($page=="home")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

        </div>
        <div class="box-footer">
          
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="signature")
{
if(empty($ttd_pegawai)){
  $standar_ft=base_url().'assets/images/noavatar.jpg';
}else{
  $cek_filesmall=FCPATH.'assets/berkas/im/'.$ttd_pegawai;
  if(file_exists($cek_filesmall)){
    $standar_ft=base_url().'assets/berkas/im/'.$ttd_pegawai;
  }else{
    $standar_ft=base_url().'assets/images/noavatar.jpg';
  }
}
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?= $link_awal ?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <?php echo form_open_multipart('validasi/signature',' id="signupform" ');
        input_text("id_pegawai",$id_pegawai,"","","hidden");
      ?>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?= $title ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                   <div class="form-group">
                      <div class="box-body box-profile">
                        <a class="example-image-link" href="<?php echo $standar_ft; ?>"
                          data-lightbox="example-set" data-title="<?php echo $nama_pegawai; ?>">
                          <img class="profile-user-img img-responsive img-circle" src="<?php echo $standar_ft; ?>" alt="Photo">
                        </a>

                        <p class="text-center">Signature <?php echo $nama_pegawai; ?></p>

                      </div>

                  </div>                 
                </div>
                <div class="col-md-4">
                   <div class="form-group">
                    <label for="exampleInputFile">Ganti Signature</label>
                    <?php
                      input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","required","file");
                    ?>
                    <p class="help-block">png Ukuran 300 Pixel</p>
                  </div>                 
                </div>
              </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="pengajuan_kompetensi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik pisahkan dengan spasi untuk Pencarian Banyak Nama</label>
              <?php
                input_text("id",$id," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
              ?>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
  <?php echo form_close(); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
		      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
		        <thead>
		          <tr>
		            <th width="5%" style="display;none;"></th>
		            <th>Tanggal</th>
		            <th>Nama</th>
		            <th>Kategori</th>
		            <th>No Surat</th>
		            <th>Status</th>
		          </tr>
		        </thead>
		      </table>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengajuan_kompetensi_beranda")
{
  $arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
a:hover { text-decoration: underline; font-weight: bold; }
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('ol_kompetensi/pengajuan_kompetensi/validasi/'.$id.'/'.$id2.'/'.$id3,' id="signupform" '); ;
    if(empty($foto)){
      $url_thumbx=base_url().'assets/images/noavatar.jpg';
      $url_picbesarx=base_url().'assets/images/noavatar.jpg';
    }else{
      $cek_filesmall=FCPATH.'assets/foto/ol/'.$foto;
      if(file_exists($cek_filesmall)){
        $url_thumbx=base_url().'assets/foto/ol/'.$foto;
        $url_picbesarx=base_url().'assets/foto/ol/'.$foto;
      }else{
        $url_thumbx=base_url().'assets/images/noavatar.jpg';
        $url_picbesarx=base_url().'assets/images/noavatar.jpg';
      }
    }
  ?>
    <div class="row">
      <div class="col-md-8">
    <!--    <div class="box box-<php echo $arraybox[array_rand($arraybox)]; ?> box-solid collapsed-box"> Collapse -->
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PROFIL</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-plus"></i></button>
            </div>
          </div>
          <div class="box-body box-profile">
            <a class="example-image-link" href="<?php echo $url_picbesarx; ?>" 
              data-lightbox="example-set" data-title="<?php echo $nama_pegawai; ?>">
              <img class="profile-user-img img-responsive img-circle" 
                src="<?php echo $url_thumbx; ?>" style="width:50px;height:50px;" alt="User profile picture">
            </a>

            <h3 class="profile-username text-center"><?php echo $nama_pegawai; ?><br><?php echo $nama_status_diusulkan; ?></h3>

            <p class="text-muted text-center"></p>  
            <strong><i class="fa fa-book margin-r-5"></i> TTL / Umur</strong>
            <p class="text-muted">
            <?php echo $tmp_lahir; ?>, <?php echo date('d-m-Y', strtotime($tgl_lahir)); ?> / 
            <?php
              $birthage = $tgl_lahir;
              $interval = date_diff(date_create(), date_create($birthage));
              $umur = $interval->format("%Y Tahun, %M Bulan, %d Hari");
              echo $umur;           
            ?>
            </p>
            <strong><i class="fa fa-book margin-r-5"></i> Agama</strong>
            <p class="text-muted">
            <?php echo $nama_agama; ?>
            </p>
            <strong><i class="fa fa-book margin-r-5"></i> Marital Status</strong>
            <p class="text-muted">
            <?php echo $nama_status_kawin; ?>
            </p>
            <strong><i class="fa fa-pencil margin-r-5"></i> No</strong>
            <p>
            NIP : <?php echo $nip; ?><br>
            No Profesi : <?php echo $no_profesi; ?>
            </p>
            <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>
            <p class="text-muted">
            <?php echo $nama_pendidikan; ?>
            </p>      
            <strong><i class="fa fa-phone margin-r-5"></i> No HP</strong>
            <p class="text-muted">
            <a href="tel:<?php echo $no_hp; ?>" target="_blank"><?php echo $no_hp; ?></a>
            </p>
            <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
            <p class="text-muted">
            <a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
            </p>
            <strong><i class="fa fa-book margin-r-5"></i> Status Pegawai</strong>
            <p class="text-muted">
            <?php echo $nama_status_pegawai; ?>
            </p>
            <strong><i class="fa fa-user-md margin-r-5"></i> Jabatan Fungsional</strong>
            <p class="text-muted">
            <?php echo $nama_jabatan_fungsional; ?>
          </p>
            <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
            <p class="text-muted">
            <?php echo $alamat; ?>            
            </p>
            <strong><i class="fa fa-share"></i> Pengajuan</strong>
            <p class="text-muted">
            <?php echo $nama_kompetensi; ?>            
            </p>
          </div>
        </div>  
 <!--       <div class="box box-<php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
        <h3 class="box-title">DAFTAR SEMUA KOMPETENSI</h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<php echo base_url();?>validasi/pengajuan_kompetensi/pdf_rkk/<= $id_pengajuan ?>" allowfullscreen></iframe>
</div>
          </div>
        </div> -->
      </div> 
      <div class="col-md-4">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
  						<h3 class="box-title">LINK KOMPETENSI</h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
                <?php  
                  foreach($ambil_link as $row_link) {
                ?>
<div class="info-box bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
  <span class="info-box-icon"><i class="fa fa-<?php echo $arrayfa[array_rand($arrayfa)]; ?>"></i></span>

  <div class="info-box-content">
    <span class="info-box-text"  style="font-size:1em;"><?= $row_link['judul_link'] ?></span>
    <span class="info-box-number"  style="font-size:1.2em;">
      <?php 
      $jml_nkr = $this->m_kredensial->jumlah_pengajuan_validasi($id,$this->session->id_pegawai,$row_link['id_jenis_form']);
        if($jml_nkr == 0){
          echo $row_link['nama_link'];
        }else{
$kondisi_linklink=array('barcode_pengajuan'=>$id,'nf.id_jenis_form'=>$row_link['id_jenis_form'],'id_asesor'=>$this->session->id_pegawai);
          $row_linklink = $this->m_kredensial->ambil_link_kompetensi($kondisi_linklink);
          if(!empty($row_link['pdf_pengajuan'])){
        ?>
    <a href="<?php echo base_url('validasi/pengajuan_kompetensi/'.$row_link['pdf_pengajuan'].'/'.$id);?>" class="progress-description"target="_blank" style="color: white;">
            <?= $row_link['nama_link'] ?> - Print <i class="fa fa-print"></i>
          </a>
        <?php
        }
       }
      ?>
      
      </span>

    <div class="progress">
      <div class="progress-bar" style="width: 100%"></div>
    </div>
        <a href="<?php echo base_url('validasi/pengajuan_kompetensi/'.$row_link['url_link'].'/'.$id);?>" class="progress-description" style="color: white;">
          Start <i class="fa fa-arrow-circle-right"></i>
        </a>
  </div>
</div>
                <?php
                  }
                ?>

          </div>
        </div>    
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
       <?php echo $instance_name; ?>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_permohonan")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
?>
<style>
.table-border tfoot td {
	border: none;
}
.table-border thead th {
	border-left: .5px solid #000;
	border-right: .5px solid #000;	
}
.table-border th,
.table-border td {
	border-top: .5px solid #000;
	border-bottom: .5px solid #000;
	border-left: .5px solid #000;	
	border-right: .5px solid #000;		
}
.table-border tfoot th {
	font-weight: normal;
}
.bg-light{
	background-color: #f8f9fa;
}
.bg-dark{
	background-color: #ddd;
}
.px{
	padding-left: 1rem;
	padding-right: 1rem; 
}	
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/permohonan/'.$id,' id="signupform" ');
  	input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
  	input_text("barcode_form",$barcode_form,"","","hidden");
    input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
  	input_text("status_pengajuan",$status_pengajuan,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
  						<h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 7pt;">
<?= $nama_jenis_form ?>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 7pt;">
Bagian 1 : Rincian Data Asesi
</div>
<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
	<tbody>
		<tr>
			<td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Lengkap</td>
			<td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
			<td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; font-size: 12pt;">Tempat/ Tanggal Lahir</td>
			<td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
			<td style="vertical-align: top; font-size: 12pt;"><?= $tmp_lahir ?>, <?= $tgl_lahir ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; font-size: 12pt;">Jenis Kelamin</td>
			<td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
			<td style="vertical-align: top; font-size: 12pt;"><?= $jk ?></td>
		</tr>		
		<tr>
			<td style="vertical-align: top; font-size: 12pt;">Kualifikasi</td>
			<td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
			<td style="vertical-align: top; font-size: 12pt;"><?= $nama_jabatan_fungsional ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; font-size: 12pt;">Pendidikan</td>
			<td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
			<td style="vertical-align: top; font-size: 12pt;"><?= $nama_pendidikan ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; font-size: 12pt;">Pekerjaan</td>
			<td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
			<td style="vertical-align: top; font-size: 12pt;"><?= $nama_jabatan ?> / <?= $nama_status_pegawai ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; font-size: 12pt;">Alamat</td>
			<td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
			<td style="vertical-align: top; font-size: 12pt;"><?= $alamat ?>, <?= $nama_kel ?>, <?= $nama_kec ?>, <?= $nama_kab ?>, <?= $nama_prov ?> </td>
		</tr>
		<tr>
			<td style="vertical-align: top; font-size: 12pt;">No Telp - Email</td>
			<td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
			<td style="vertical-align: top; font-size: 12pt;"><?= $no_hp ?> - <?= $email ?></td>
		</tr>
		<tr>
			<td style="vertical-align: top; font-size: 12pt;">Tempat Bekerja</td>
			<td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
			<td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
		</tr>
	</tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 7pt;">
Bagian 2 : Daftar Unit Kompetensi
</div>
<div style="text-align:left;font-size: 12pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 7pt;">
Pada bagian ini, cantumkan unit kompetensi yang akan diajukan untuk dinilai. Unit kompetensi yang diajukan berupa Unit Kompetensi Tunggal
</div>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
	<thead>
		<tr>
			<th class="px" style="vertical-align: top; text-align: center;width:7%;font-size: 12pt;">No</th>
			<th class="px" style="vertical-align: top; text-align: center;font-size: 12pt;">Kode Unit</th>
			<th class="px" style="vertical-align: top; text-align: center;font-size: 12pt;">Judul Unit</th>
		</tr>
	</thead>
	<tbody>
    <?php
    $no = 0;
    foreach($kompetensi as $rowambil_nkr_kompetensi){
    	$no++;
    ?>
		<tr>
			<td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;text-align: center;width: 5%;"><?= $no ?></td>
			<td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;"><?= $rowambil_nkr_kompetensi['kode_unit'] ?></td>
			<td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;"><?= $rowambil_nkr_kompetensi['nama_kompetensi'] ?></td>
		</tr>
		<tr>
			<td colspan="3" class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;text-align: left;padding: 7pt;">
				STANDAR KOMPETENSI DAN SPO
			</td>
		</tr>
    <?php

    	$nkr_kewenangan=$this->m_kredensial->ambil_nkr_kewenangan_dari_nkr_kompetensi($id_pengajuan,$rowambil_nkr_kompetensi["id_kompetensi"]);
    	foreach($nkr_kewenangan as $rownkr_kewenangan){
    		
    ?>
		<tr>
			<td class="px" style="vertical-align: top; text-align: left;font-size: 12pt;padding-left: 15pt;border-right: 0;">&nbsp;</td>
			<td colspan="2" class="px" style="vertical-align: top; text-align: left;font-size: 12pt;padding-left: 15pt;border-left: 0;"><?= $rownkr_kewenangan['nama_kewenangan'] ?></td>
		</tr>
		<?php  
			}
		}
		?>
	</tbody>
</table>
</div>

<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 7pt;">
Bagian 3 : Kompetensi dan Bukti Portofolio
</div>
<div style="text-align:left;font-size: 12pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 7pt;">
Pada bagian ini, cantumkan bukti-bukti pendukung yang relevan dengan unit kompetensi yang diusulkan.
</div>
						<div class="box-body table-responsive no-padding">
            <table class="table-border" style="width:100%;">
              <thead>
                <tr>
                <th rowspan="2" class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">Nama Berkas <u>(KLIK BERKAS UNTUK MELIHAT)</u></th>
                <th colspan="4" class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">KESESUAIAN BUKTI </th>
                </tr>
                <tr>
                <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;width: 5%;">Memadai</th>
                <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;width: 5%;">Valid</th>
                <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;width: 5%;">Asli</th>
                <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;width: 5%;">Terkini</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  if(!empty($id_ijasah)){
                    foreach($ambil_berkas_data as $row){
                      if (in_array($row['id_berkas'],$id_ijasah)) {
                  ?>
                    <tr>
                    <td class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">
                      <a href="<?php echo base_url('assets/berkas/ol/'.$row['link_berkas']);?>" target="_blank" style="color: black;" >
                         Jenis Berkas : <?php echo $row['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row['nama_berkas']; ?>,<br>
                         Lulus Tahun : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))) ?>
                      </a>
                    </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_1_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_3_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_4_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
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
                    <td class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">
                      <a href="<?php echo base_url('assets/berkas/ol/'.$row2['link_berkas']);?>" target="_blank" style="color: black;" >
                        Jenis Berkas : <?php echo $row2['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row2['nama_berkas']; ?>,<br>
                        Masa Berlaku : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row2['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row2['tgl_b_berkas']))) ?>
                      </a>
                    </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_1_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row2['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row2['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_3_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row2['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_4_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row2['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
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
                    <td class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">
                      <a href="<?php echo base_url('assets/berkas/ol/'.$row3['link_berkas']);?>" target="_blank" style="color: black;" >
                        Jenis Berkas : <?php echo $row3['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row3['nama_berkas']; ?>, <br>Penyelenggara : <?php echo $row3['penyelenggara']; ?>,<br>
                        Tanggal : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row3['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row3['tgl_b_berkas']))) ?>, <br>SKS : <?= number_format($row3['kredit'],1) ?>
                      </a>
                    </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_1_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row3['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row3['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_3_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row3['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_4_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row3['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
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
                  <td class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">
                    <a href="<?php echo base_url('assets/berkas/ol/'.$row4['link_berkas']);?>" style="color:black;" target="_blank">
                       Jenis Berkas : <?php echo $row4['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row4['nama_berkas']; ?>
                    </a>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row4['id_berkas']; ?>_1_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row4['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row4['id_berkas']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row4['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row4['id_berkas']; ?>_3_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row4['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row4['id_berkas']; ?>_4_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row4['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
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
                  <td colspan="5" class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">ETIKA PROFESI</td>
                  </tr>
                  <tr>
                  <td colspan="5">
                  	<div class="box-body table-responsive no-padding">
                    <table style="width:100%;" class="table-bordered">
                      <thead>
                        <tr>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">Tanggal</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">Hasil</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">Penguji</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;"><i class="fa fa-search"></i></th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;width: 5%;">Memadai</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;width: 5%;">Valid</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;width: 5%;">Asli</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;width: 5%;">Terkini</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
                          if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$id_etik_pegawai)) {
                      ?>
                        <tr>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                    <a href="<?php echo base_url('validasi/pengajuan_kompetensi/pdf_etika/'.$rowambil_data_etik_pegawai_oppe['id_etik_pegawai']);?>" class="btn bg-green btn-xs" target="_blank">
                    <i class="fa fa-file-pdf-o"></i> pdf</a>
                        </td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik1" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik2" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik3" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik4" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
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
            </table>
          	</div>
          </div>
        </div>    
      </div>
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div>
          <?php  
          	if($status_pengajuan == 1){
         // 		if(!empty($cek_kesesuaian_bukti)){
          			if($tgl_asesi == NULL){
          ?>
          <div class="box-footer">
          	<label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>        	
          </div>
          <?php  
          			}
     //     		}
          	}
          ?>
        </div>  
      </div> 
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_asesmen")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','lightblue','blue','green','teal','lime','orange','fuchsia');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 1rem;
  padding-right: 1rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/asesmen/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
    input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
    input_text("barcode_form",$barcode_form,"","","hidden");
    input_text("status_pengajuan",$status_pengajuan,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
  <br>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: top; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Komponen Asesmen Mandiri</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Daftar Pertanyaan</th>
      <th class="px" style="vertical-align: top; text-align: center;font-size: 12pt;width: 10%;">Penilaian<br>(Kompeten)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){      
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowform2_detil['id_question'],"","","hidden"); ?>
        <?php input_text("no_urut_detil[]",$rowform2_detil['no_urut_detil'],"","","hidden"); ?>
      </td>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;"><?= $rowform2_detil['nama_asesmen'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;"><?= $rowform2_detil['nama_question'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_question']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_question']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>
</div>
          </div>
        </div>    
      </div>
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php  
                }
     //         }
            }
          ?>
        </div>  
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_rencana")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 1rem;
  padding-right: 1rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
<?php echo form_open_multipart('validasi/pengajuan_kompetensi/rencana/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title"><?= $nama_jenis_form ?></h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
            <?= $nama_jenis_form ?>
            </div>
            <div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 7pt;">
            Bagian 1 : Rincian Data Asesi
            </div>
              <div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
                <table style="width:100%;margin-left: 15pt;">
                  <tbody>
                    <tr>
                      <td style="vertical-align: middle; width:20%;font-size: 12pt;">Nama Lengkap</td>
                      <td style="vertical-align: middle; text-align: center;width:4%;font-size: 12pt;">:</td>
                      <td style="vertical-align: middle; font-size: 12pt;"><?= $nama_pegawai ?></td>
                    </tr>   
                    <tr>
                      <td style="vertical-align: middle; font-size: 12pt;">Kualifikasi</td>
                      <td style="vertical-align: middle; text-align: center;font-size: 12pt;">:</td>
                      <td style="vertical-align: middle; font-size: 12pt;"><?= $nama_jabatan_fungsional ?></td>
                    </tr>
                    <tr>
                      <td style="vertical-align: middle; font-size: 12pt;">Tujuan Asesmen</td>
                      <td style="vertical-align: middle; text-align: center;font-size: 12pt;">:</td>
                      <td style="vertical-align: middle; font-size: 12pt;"><?= $nama_status_diusulkan ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 7pt;">
              Bagian 2 : RENCANA ASESMEN
              </div>
              <div class="box-body table-responsive no-padding">
                <table style="width:100%;" class="table-border">
                  <tbody>
                    <?php
                    foreach($kompetensi as $rowambil_nkr_kompetensi){
                    ?>
                    <tr>
                      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;">KODE UNIT</td>
                      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowambil_nkr_kompetensi['kode_unit'] ?></td>
                    </tr>
                    <tr>
                      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;">JUDUL UNIT</td>
                      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowambil_nkr_kompetensi['nama_kompetensi'] ?></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;padding: 7pt;">STANDAR KOMPETENSI DAN SPO</td>
                    </tr>
                    <?php

            $nkr_kewenangan=$this->m_kredensial->ambil_nkr_kewenangan_dari_nkr_kompetensi($id_pengajuan,$rowambil_nkr_kompetensi["id_kompetensi"]);
                      foreach($nkr_kewenangan as $rownkr_kewenangan){
                        
                    ?>
                    <tr>
                      <td class="px" style="vertical-align: middle; text-align: left;font-size: 12pt;padding-left: 15pt;border-right: 0;">&nbsp;</td>
                      <td colspan="2" class="px" style="vertical-align: top; text-align: left;font-size: 12pt;padding-left: 15pt;border-left: 0;"><?= $rownkr_kewenangan['nama_kewenangan'] ?></td>
                    </tr>
                    <?php  
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <br style="line-height:2;">
                <div class="box-body table-responsive no-padding">
                  <table id="example1" width="100%" class="table table-bordered table-striped">
                  <?php
                  foreach($detil_elemen as $rowdetil_elemen){
                  ?>
                  <tr>
                    <td class="px bg-dark" style="width:3%;">&nbsp;</td>
                    <td class="px bg-dark" style="vertical-align: middle; text-align: left;font-size: 12pt;font-weight: bold;" colspan="4"><?= $rowdetil_elemen['nama_elemen'] ?></td>
                  </tr>
                    <?php
                    $kondisialat = array('id_elemen'=>$rowdetil_elemen['id_elemen'],'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi);
                    $alatbahan = $this->m_umum->ambil_data_kondisi('nkr_alat_bahan',$kondisialat);
                    if(!empty( $alatbahan['alat'])){
                      echo'<tr><td>&nbsp;</td><td>&nbsp;</td><td colspan="3" style="font-weight:bold;font-size: 12pt;">ALAT DAN BAHAN</td></tr>';
                    foreach($alat as $rowalat){
                      if (in_array($rowalat['id_alat'],explode(",", $alatbahan['alat']))) {
                    ?>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="font-size: 12pt;text-align: center;">==</td>
                    <td colspan="2" style="text-align: left;font-size: 12pt;">
                      <?= $rowalat['nama_alat'] ?>
                    </td>
                    </tr>
                    <?php
                      }
                    }
                  }
                    if($jml_validasi == 0){
                  $detil_asesmen = $this->m_kredensial->ambil_asesmen_nkr_form_detil($barcode_form,$rowdetil_elemen['id_elemen']);
                    }
                    else{
                  $detil_asesmen = $this->m_kredensial->ambil_asesmen_nkr_elemen_validasi($barcode_pengajuan_validasi,$rowdetil_elemen['id_elemen']);
                    }
                    foreach($detil_asesmen as $rowdetil_asesmen){
                    if($jml_validasi == 0){
                      $detil_indikator = $this->m_kredensial->ambil_indikator_nkr_form_detil($barcode_form,$rowdetil_asesmen['id_asesmen']);
                    }
                    else{
                      $detil_indikator = $this->m_kredensial->ambil_indikator_nkr_form_validasi_detil($barcode_pengajuan_validasi,$rowdetil_asesmen['id_asesmen']);
                    }
                    ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="font-size: 12pt;" colspan="3"><?= $rowdetil_asesmen['nama_asesmen'] ?></td>
            </tr>
                  <?php
                    foreach($detil_indikator as $rowdetil_indikator){
                    input_text("chk[]",$rowdetil_indikator['id_indikator'],"","","hidden");
                    input_text("no_urut_detil[]",$rowdetil_indikator['no_urut_detil'],"","","hidden");
                    input_text("metode_indikator[]",$rowdetil_indikator['metode_indikator'],"","","hidden");
                    input_text("perangkat_indikator[]",$rowdetil_indikator['perangkat_indikator'],"","","hidden");
                  ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="vertical-align:middle;text-align: center;width:3%;">&nbsp;</td>
              <td colspan="2" style="font-weight:bold;font-size: 12pt;"><?= $rowdetil_indikator['nama_indikator'] ?></td>
            </tr>
              <?php  
              if(!empty($rowdetil_indikator['metode_indikator']) || !empty($rowdetil_indikator['perangkat_indikator'])){
              ?>
            <tr>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="text-align: left;font-weight: bold;font-size: 12pt;"><?php if(!empty($rowdetil_indikator['metode_indikator'])){ echo 'METODE ASSMEN'; } ?></td>
            <td style="text-align: left;font-weight: bold;font-size: 12pt;"><?php if(!empty($rowdetil_indikator['perangkat_indikator'])){ echo 'PERANGKAT ASSMEN'; } ?></td>
            </tr>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="text-align: left;font-size: 12pt;">
                <ul>
                  <?php
                  if(!empty($rowdetil_indikator['metode_indikator'])){
                      foreach($metode as $rowmetode){
                        if (in_array($rowmetode['id_metode'],explode(",", $rowdetil_indikator['metode_indikator']))) {
                          echo '<li>'.$rowmetode['nama_metode'].'</li>';
                        }
                      }
                  }
                  ?>  
                </ul>          
              </td>
              <td style="text-align: left;font-size: 12pt;">
                 <ul>
                  <?php
                  if(!empty($rowdetil_indikator['perangkat_indikator'])){
                    foreach($perangkat as $rowperangkat){
                      if (in_array($rowperangkat['id_perangkat'],explode(",", $rowdetil_indikator['perangkat_indikator']))) {
                        echo '<li>'.$rowperangkat['nama_perangkat'].'</li>';
                      }
                    }
                  }
                  ?>  </ul>               
              </td>
            </tr>
            <?php   
              }
                    }
                   }
                  }
                  ?>
                  </table>
                </div>
        </div>
      </div>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php  
                }
     //         }
            }
          ?>
        </div>  
    </div>
<?php echo form_close(); ?>
  </section>
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_observasi")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 1rem;
  padding-right: 1rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/observasi/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
  <br>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Komponen Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Poin yang di amati</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 10%;">Pencapaian<br>(YA)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){      
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowform2_detil['id_indikator'],"","","hidden"); ?><?php input_text("no_urut_detil[]",$rowform2_detil['no_urut_detil'],"","","hidden"); ?>
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_asesmen'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['poin_indikator'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table><b>Note : P : Pengetahuan, K = Ketrampilan, S : Sikap</b>
</div>
          </div>
        </div>    
      </div>
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php  
                }
     //         }
            }
          ?>
        </div>
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_lisan")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 1rem;
  padding-right: 1rem; 
}
.px-3{
  padding-left: 3rem;
  padding-right: 3rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/lisan/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
  <br>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 15%;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 15%;">Pertanyaan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 15%;">Indikator Pencapaian</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Jawaban Asesi</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Pencapaian<br>(YA)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no =0;
    foreach($form2_detil as $rowform2_detil){  
    $no++;    
    ?>
    <tr>
      <td class="px-3 py bg-dark" colspan="6" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_asesmen'] ?></td>
    </tr>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowform2_detil['id_indikator'],"","","hidden"); ?>
        <?php input_text("no_urut_detil[]",$rowform2_detil['no_urut_detil'],"","","hidden"); 
          if($jml_validasi > 0){ input_text("id_validasi_detil[]",$rowform2_detil['id_validasi_detil'],"","","hidden"); }
        ?>

      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['pertanyaan_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['ketercapaian_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;">
  <?php
  if($tgl_asesi == NULL){
    input_textareacustom("jawaban_validasi_detil[]",$rowform2_detil['jawaban_validasi_detil']," id='editor".$no."' rows='1' cols='10' class='form-control' ","Jawaban Asesi");
  }else{
    echo html_entity_decode($rowform2_detil['jawaban_validasi_detil']);
  }
  ?>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table><b>Note : P : Pengetahuan, K = Ketrampilan, S : Sikap</b>
</div>
          </div>
        </div>    
      </div>
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editorx' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php  
                }
     //         }
            }
          ?>
        </div> 
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_tulis")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 1rem;
  padding-right: 1rem; 
}
.px-3{
  padding-left: 3rem;
  padding-right: 3rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/tulis/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
  <br>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Pertanyaan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Standar Jawaban</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Jawaban Asesi</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Pencapaian<br>(YA)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no =0;
    foreach($form2_detil as $rowform2_detil){  
    $no++;    
    ?>
    <tr>
      <td class="px-3 py bg-dark" colspan="6" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_asesmen'] ?></td>
    </tr>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowform2_detil['id_indikator'],"","","hidden"); ?><?php input_text("no_urut_detil[]",$rowform2_detil['no_urut_detil'],"","","hidden"); ?>
        <?php input_text("pertanyaan_indikator[]",$rowform2_detil['pertanyaan_indikator'],"","","hidden"); ?>
        <?php input_text("jawaban_indikator[]",$rowform2_detil['jawaban_indikator'],"","","hidden"); ?>
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;">
            <?php 
            echo $rowform2_detil['pertanyaan_indikator']?>
            <br><div class="form-group">
            <?php
            if($rowform2_detil['jenis_soal'] > 0){ //pilihan
              $soal = $this->m_kredensial->ambil_soal_opsie($rowform2_detil['id_indikator']);
              if($rowform2_detil['jenis_soal'] == 1){ // pilihan
                foreach($soal as $rowsoal){
            ?>
                <label>
                  <input type="radio" onclick="return false;" <?php if( $rowsoal['answer'] == 1){ echo 'checked'; } ?> class="minimal">&nbsp;&nbsp;<?= $rowsoal['nama_soal_opsi'] ?>
                </label><br>
            <?php
                }
              }
              if($rowform2_detil['jenis_soal'] == 2){ // ganda
                foreach($soal as $rowsoal){
            ?>
                <label>
                  <input type="checkbox" onclick="return false;" <?php if( $rowsoal['answer'] == 1){ echo 'checked'; } ?> class="minimal">&nbsp;&nbsp;<?= $rowsoal['nama_soal_opsi'] ?>
                </label><br>
            <?php
                }                
              }
              ?>
              </div>
            <?php
            }
            ?>  
        </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['jawaban_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?php
      if($rowform2_detil['jenis_soal'] == 0){
        echo html_entity_decode($rowform2_detil['jawaban_validasi_detil']);
      }else{
        if($rowform2_detil['jenis_soal'] > 0){ //pilihan
          $soal = $this->m_kredensial->ambil_soal_opsi($rowform2_detil['id_indikator']);
          foreach($soal as $rowsoal){
            if (in_array($rowsoal['id_soal_opsi'],explode(',',$rowform2_detil['jawaban_validasi_detil']))) {
              echo '['.$rowsoal['no_urut_soal_opsi'].'] - '.$rowsoal['nama_soal_opsi'].'<br>';
            }
          }
          ?>
          </div>
        <?php
        }
      }
      ?>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>
</div>
          </div>
        </div>    
      </div>
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($locked == 2 || $locked == 3){
          ?>
          <div class="box-footer">
            <label>JIKA PROSES KREDENSIAL SELESAI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php 
                }
                if($locked == 1){
          ?>          
          <div class="box-footer">
               <button type="submit" name="action" value="BtnEdit" class="btn btn-app">
                <i class="fa fa-pencil"></i> Edit
              </button>         
          </div>
          <?php  
                }
                if($locked == NULL){
          ?>          
          <div class="box-footer">
               <button type="submit" name="action" value="BtnAktif" class="btn btn-app">
                <i class="fa fa-check"></i> Aktifkan Soal
              </button>         
          </div>
          <?php  
                }
     //         }
            }
          ?>
        </div>  
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_portofolio")
{
  $arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
a:hover { text-decoration: underline; font-weight: bold; }
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 1rem;
  padding-right: 1rem; 
} 
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/portofolio/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
  ?>
  <div class="box box-<?php echo $thenarray; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?php echo $title; ?></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">DAFTAR SEMUA KOMPETENSI</h3>           
                  <div class="box-tools pull-right">
          <?php
            input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
          ?>
                  </div>
            </div>
            <div class="box-body">
              <div class="box-tools pull-right">

              </div>
              <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
                <thead>
                  <tr style="background-color: #29675B;color: white;">
                    <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kompetensi</th>
                    <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
                    <th style="text-align:center;vertical-align:middle;font-weight:bold;">Sifat</th>
                    <th style="text-align:center;vertical-align:middle;font-weight:bold;">Validasi</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div style="font-weight:bold;color:green;" class="box-footer">
              <ul>
<li>VALIDASI KOMPETENSI INI WAJIB DILAKUKAN KARENA DISINI VALIDASI RKK DI REKAM</li>
<li>VALIDASI 1 KEWENANGAN HANYA BISA UNTUK LOGBOOK YANG BELUM DI VALIDASI</li>
<li>SIFAT KOMPETENSI : <font color="red">MANDIRI</font> (DIKERJAKAN SENDIRI), <font color="maroon">KOLABORASI</font> (KELOMPOK MISAL CATHLAB), <font color="blue">MANDAT</font> (ATAS PERINTAH NAMUN TANGGUNG JAWAB OLEH PEMBERI PERINTAH), <font color="black">DELEGASI</font> (ATAS PERINTAH NAMUN TANGGUNG JAWAB SENDIRI), SUPERVISI (DI AWASI MENTOR / MENTORSHIP)</li>
            </ul>           
            </div>
          </div> 
    <!--       <div class="box box-<php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">JUMLAH KOMPETENSI</h3>           
                  <div class="box-tools pull-right">
          <php
         //   input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
          ?>
                  </div>
            </div>
            <div class="box-body">
              <div class="box-tools pull-right">

              </div>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<php echo base_url();?>validasi/pengajuan_kompetensi/pdf_rkk/<= $id_pengajuan ?>" allowfullscreen></iframe>
</div>
            </div>
          </div>  -->
        </div>
        <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>




<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 15%;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 15%;">Dokumen</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Pencapaian<br>(YA)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no =0;
    foreach($form2_detil as $rowform2_detil){  
    $no++;    
    ?>
    <tr>
      <td class="px-3 py bg-dark" colspan="6" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_asesmen'] ?></td>
    </tr>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowform2_detil['id_indikator'],"","","hidden"); ?>
        <?php input_text("no_urut_detil[]",$rowform2_detil['no_urut_detil'],"","","hidden"); 
          if($jml_validasi > 0){ input_text("id_validasi_detil[]",$rowform2_detil['id_validasi_detil'],"","","hidden"); }
        ?>

      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['dokumen_indikator'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
    }
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">&nbsp;</td>
      <td class="px" colspan="2" style="font-weight: bold; vertical-align: middle; text-align: left;font-size: 12pt;">
        Logbook Pencatatan Kompetensi
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="7_<?php echo $barcode_pengajuan; ?>" <?php if(in_array("7_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</div>
<hr>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div><hr>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php  
                }
     //         }
            }
          ?>
        </div>  
        </div>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?>
  </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_rkk")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('validasi/pengajuan_kompetensi/simpan_rkk');?>" onClick="return cek();">
          <input type="hidden" name="barcode_pengajuan" value="<?= $id; ?>">
          <input type="hidden" name="id_kewenangan" value="<?= $id2; ?>">
          <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">VALIDASI RKK</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                  <label>Validasi</label>
                  <?php
                 input_pdselect2("id_sifat_kewenangan",$sifat_kewenangan,$id_sifat_kewenangan);
                  ?>
              </div>
              <div class="col-md-6">
                  <label>Status</label>
                  <?php
                 input_pdselect2("status_rkk",$rkk,$status_rkk);
                  ?>
              </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
            </div>
          </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_konsultasi")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 4rem;
  padding-right: 4rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/konsultasi/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
input_text("banding_form",$banding_form,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-7">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
  <br>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" colspan="2" style="vertical-align: middle; text-align: center;font-size: 12pt;">Kegiatan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 10%;">Pencapaian<br>(YA)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){      
    ?>
    <tr>
      <th class="px bg-dark py" colspan="4" style="vertical-align: middle; text-align: left;font-size: 12pt;">
        <?= $rowform2_detil['nama_pra_asesmen'] ?>
      </th>
    </tr>
    <?php 
    if($jml_validasi == 0){
       $ambil_nkr_pra_detil = $this->m_kredensial->ambil_val_nkr_pra_detil($barcode_form,$rowform2_detil['barcode_pra_asesmen']); 
    }else{
       $ambil_nkr_pra_detil = $this->m_kredensial->ambil_validasi_nkr_pra_detil($barcode_pengajuan_validasi,$rowform2_detil['barcode_pra_asesmen']);   
    }
      foreach($ambil_nkr_pra_detil as $rowambil_nkr_pra_detil){
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowambil_nkr_pra_detil['id_pra_detil'],"","","hidden"); ?>
        <?php input_text("no_urut_detil[]",$rowambil_nkr_pra_detil['no_urut_detil'],"","","hidden"); ?>
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;width: 1%;border-right: none;">&nbsp;</td>
      <td class="px" style="font-weight: bold;font-size: 12pt;border-left: none;"><?= $rowambil_nkr_pra_detil['nama_pra_detil'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_nkr_pra_detil['id_pra_detil']; ?>_8_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowambil_nkr_pra_detil['id_pra_detil']."_8_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
      }
    }
    ?>
  </tbody>
</table>
</div>
          </div>
        </div>    
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php  
                }
     //         }
            }
          ?>
        </div>
      </div>
      <div class="col-md-5">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">HASIL PENILAIAN KOMPETENSI</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
              <label>Hasil Penilaian</label>
              <?php
                input_pdselect2fleksibel("url_link","url_link",$format,"url_link","nama_jenis_form","","Pilih Form");
              ?>
          </div>
          <div class="box-footer">
            <div class="awaktextarea"></div>
          </div>
          </div>
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:5px; font-size:10px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_cek")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 4rem;
  padding-right: 4rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/cek/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
input_text("banding_form",$banding_form,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-7">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
  <br>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" colspan="2" style="vertical-align: middle; text-align: center;font-size: 12pt;">Kegiatan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 10%;">Pencapaian<br>(YA)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){      
    ?>
    <tr>
      <th class="px bg-dark py" colspan="4" style="vertical-align: middle; text-align: left;font-size: 12pt;">
        <?= $rowform2_detil['nama_pra_asesmen'] ?>
      </th>
    </tr>
    <?php 
    if($jml_validasi == 0){
       $ambil_nkr_pra_detil = $this->m_kredensial->ambil_val_nkr_pra_detil($barcode_form,$rowform2_detil['barcode_pra_asesmen']);    
    }else{
       $ambil_nkr_pra_detil = $this->m_kredensial->ambil_validasi_nkr_pra_detil($barcode_pengajuan_validasi,$rowform2_detil['barcode_pra_asesmen']);
    }
      foreach($ambil_nkr_pra_detil as $rowambil_nkr_pra_detil){
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowambil_nkr_pra_detil['id_pra_detil'],"","","hidden"); ?>
        <?php input_text("no_urut_detil[]",$rowambil_nkr_pra_detil['no_urut_detil'],"","","hidden"); ?>
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;width: 1%;border-right: none;">&nbsp;</td>
      <td class="px" style="font-weight: bold;font-size: 12pt;border-left: none;"><?= $rowambil_nkr_pra_detil['nama_pra_detil'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_nkr_pra_detil['id_pra_detil']; ?>_8_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowambil_nkr_pra_detil['id_pra_detil']."_8_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
      }
    }
    ?>
  </tbody>
</table>
</div>
          </div>
        </div>   
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php  
                }
     //         }
            }
          ?>
        </div> 
      </div>
      <div class="col-md-5">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">HASIL PENILAIAN KOMPETENSI</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
              <label>Hasil Penilaian</label>
              <?php
                input_pdselect2fleksibel("url_link","url_link",$format,"url_link","nama_jenis_form","","Pilih Form");
              ?>
          </div>
          <div class="box-footer">
            <div class="awaktextarea"></div>
          </div>
          </div>
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:5px; font-size:10px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_keputusan")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 2rem;
  padding-right: 2rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/keputusan/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
input_text("banding_form",$banding_form,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-7">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
  <br>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;" rowspan="2">Kriteria Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;" rowspan="2">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;" colspan="4">Bukti</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Keputusan</th>
    </tr>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">4A</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">4B</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">4C</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">4D</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Kompeten</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){    
    ?>
    <tr>
      <td class="px py bg-dark" colspan="7" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_elemen'] ?>
      </td>
    </tr>
    <?php 
      $detil = $this->m_kredensial->ambil_validasi_detil_grup_form7($barcode_pengajuan,'nvd.id_indikator','no_urut_detil','ASC','nas.id_elemen',$rowform2_detil['id_elemen']);
        $no = 0;
        foreach($detil as $rowdetil){ 
          $no++;
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowdetil['nama_asesmen'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowdetil['nama_indikator'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104A_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104A_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104B_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104B_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104C_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104C_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104D_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104D_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_10K_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_10K_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
        }
    }
    ?>
  </tbody>
</table>
</div>
          </div>
        </div>  
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <label>Catatan / Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>   
          </div>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Kompeten
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Belum Kompeten
              </button>         
          </div>
          <?php  
                }
     //         }
            }
          ?>
        </div>  
      </div>
      <div class="col-md-5">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">HASIL PENILAIAN KOMPETENSI</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
              <label>Hasil Penilaian</label>
              <?php
                input_pdselect2fleksibel("url_link","url_link",$format,"url_link","nama_jenis_form","","Pilih Form");
              ?>
          </div>
          <div class="box-footer">
            <div class="awaktextarea"></div>
          </div>
          </div>
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:5px; font-size:10px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_banding")
{
  $arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
a:hover { text-decoration: underline; font-weight: bold; }
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 1rem;
  padding-right: 1rem; 
} 
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/banding/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("barcode_pengajuan_validasi",$barcode_pengajuan_validasi,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
input_text("banding_form","","","","hidden");
input_text("banding_form_lama",$banding_form_lama,"","","hidden");
  ?>
  <div class="box box-<?php echo $thenarray; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title"><?php echo $title; ?></h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Banding Asesmen</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_banding_form ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
          </div>
        </div>    
      </div>
        <div class="col-md-6">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">CATATAN ASESOR ATAS BANDING ASESMEN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <?php 
            if($locked < 2){
            ?>
            <label>Catatan Asesor</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            }
            ?>  
            <hr>

            <?php 
             $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
              echo $ket_pengajuan_validasi.'<hr>'; 
             $banding_asesi = html_entity_decode($banding_asesi);
            echo $banding_asesi; 
            ?> 
          </div>
          <?php  
            if($status_pengajuan == 1){
         //     if(!empty($cek_kesesuaian_bukti)){
                if($locked == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnBuka" class="btn btn-app">
                <i class="fa fa-check"></i> Lakukan Banding Asesmen
              </button>           
          </div>
          <?php  
                }
                if($locked == 1){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>           
          </div>
          <?php
                }
                if($locked == 2){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php
                }
     //         }
            }
          ?>
        </div>           
        </div>
      <div class="col-md-6">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PILIH FORM ATAS BANDING ASESMEN (TIDAK BOLEH KOSONG)</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
              <?php
                input_pdselect2fleksibel("url_link","url_link",$format,"url_link","nama_jenis_form","","Pilih Form");
              ?>
          </div>
          <div class="box-footer">
            <div class="awaktextarea"></div>
          </div>
          </div>
      </div>
      </div>
    </div>
  </div>
  <?php echo form_close(); ?>
  </section>
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_komponen")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 2rem;
  padding-right: 2rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/komponen/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("barcode_pengajuan_validasi",$barcode_pengajuan_validasi,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
  <br>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 40%;">Komponen</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 5%;">YA</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Catatan / Komentar Peserta</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
    foreach($form as $rowform2_detil){   
    $no++; 
    if(empty($rowform2_detil['komentar_kesenjangan'])){
      $komentar_kesenjangan = $this->input->post('komentar_kesenjangan');
    }else{
      $komentar_kesenjangan = $rowform2_detil['komentar_kesenjangan'];
    }
         input_text("id_kaji_ulang[]",$rowform2_detil['id_kaji_ulang'],"","","hidden"); 
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_kaji_ulang'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_kaji_ulang']; ?>_12_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_kaji_ulang']."_12_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">
        <?= 
        $komentar_kesenjangan = html_entity_decode($komentar_kesenjangan);
       ?>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
  <tfoot>
    <tr>
      <td style="font-weight: bold;">
        DI ISI OLEH ASESI
      </td>
    </tr>
  </tfoot>
</table>
</div>
          </div>
        </div>  
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <?php 
            if($locked < 2){
            ?>
            <label>Catatan Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            }else{
             $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
              echo $ket_pengajuan_validasi; 
            }
            ?>  
            <hr>  
          </div>
          <?php  
            if($status_pengajuan == 1){
                if($locked == NULL){
          ?>
          <div class="box-footer">
            <label>KLIK INI UNTUK MEMULAI PENGERJAAN SOAL</label><br>
               <button type="submit" name="action" value="BtnAktif" class="btn btn-app">
                <i class="fa fa-exclamation"></i> Aktifkan Soal
              </button>           
          </div>
          <?php  
                }
                if($locked == 2){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php  
              }
            }
          ?>
        </div>  
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<?php  
}
elseif ($page=="pengajuan_kompetensi_kesenjangan")
{
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
.table-border tfoot td {
  border: none;
}
.table-border thead th {
  border-left: .5px solid #000;
  border-right: .5px solid #000;  
}
.table-border th,
.table-border td {
  border-top: .5px solid #000;
  border-bottom: .5px solid #000;
  border-left: .5px solid #000; 
  border-right: .5px solid #000;    
}
.table-border tfoot th {
  font-weight: normal;
}
.border-1 {
  border-bottom: .1px solid #000;
  border-left: .1px solid #000; 
  border-right: .1px solid #000;    
  border-top: .1px solid #000;      
}
.bg-light{
  background-color: #f8f9fa;
}
.bg-dark{
  background-color: #ddd;
}
.px{
  padding-left: 2rem;
  padding-right: 2rem; 
}
.py{
  padding-top: .4rem;   
  padding-bottom: .4rem; 
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('validasi/pengajuan_kompetensi/kesenjangan/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("barcode_pengajuan_validasi",$barcode_pengajuan_validasi,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $nama_jenis_form ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body">
<div style="text-align:center;font-weight:bold;font-size: 14pt;margin-left:10pt;margin-top: 7pt;margin-bottom: 25pt;">
<?= $nama_jenis_form ?>
</div>

<div style="font-size: 12pt;margin-top: 7pt;margin-bottom: 7pt;margin-right: 7pt;">
<table style="width:100%;margin-left: 15pt;">
  <tbody>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tanggal Pengajuan</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $tgl_pengajuan ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; width:20%;font-size: 12pt;">Nama Asesi</td>
      <td style="vertical-align: top; text-align: center;width:4%;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_pegawai ?></td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Nama Asesor</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_asesor ?></td>
    </tr>   
    <tr>
      <td style="vertical-align: top; font-size: 12pt;">Tempat</td>
      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_working ?></td>
    </tr>
  </tbody>
</table>
</div>
<div style="text-align:left;font-weight:bold;font-size: 12pt;margin-left:10pt;margin-top: 25pt;margin-bottom: 25pt;">
  <table style="width:100%;">
    <tbody>
      <tr>
        <td style="font-size: 12pt;" class="py px">UNIT KOMPETENSI</td>        
  
      </tr>
      <tr>
        <td style="font-size: 12pt;" class="py px">
          <?php 
          foreach($kompetensi as $rowkompetensi){
            echo $rowkompetensi['kode_unit'].' : '.$rowkompetensi['nama_kompetensi'].'<br>';
          }
          ?>          
        </td>                                        
      </tr>       
    </tbody>
  </table>
</div>
  <br>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 40%;">Aspek Yang di kaji ulang</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Kesenjangan yang ditemukan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form as $rowform2_detil){   
         
    ?>
     <tr>
      <td class="px py bg-dark" colspan="7" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_kat_kaji'] ?>
      </td>
    </tr>
    <?php 
if($jml_validasi == 0){
  $detil = $this->m_kredensial->ambil_kaji_ulang_nkr_form_detil($barcode_form,$rowform2_detil['id_kat_kaji']);
}
else{
  $detil = $this->m_kredensial->ambil_kaji_ulang_nkr_form_validasi_detil($barcode_pengajuan_validasi,$rowform2_detil['id_kat_kaji']);
}
        foreach($detil as $rowdetil){ 
    if(empty($rowdetil['komentar_kesenjangan'])){
      $komentar_kesenjangan = $this->input->post('komentar_kesenjangan');
    }else{
      $komentar_kesenjangan = $rowdetil['komentar_kesenjangan'];
    }
          input_text("id_kaji_ulang[]",$rowdetil['id_kaji_ulang'],"","","hidden"); 
    ?>   
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowdetil['nama_kaji_ulang'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">
        <?= 
        $komentar_kesenjangan = html_entity_decode($komentar_kesenjangan);
       ?>
      </td>
    </tr>
    <?php 
      }
    }
    ?>
  </tbody>
  <tfoot>
    <tr>
      <td style="font-weight: bold;">
        DI ISI OLEH ASESI
      </td>
    </tr>
  </tfoot>
</table>
</div>
          </div>
        </div>  
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PENILAIAN</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <?php 
            if($locked < 2){
            ?>
            <label>Catatan Rekomendasi</label>
            <?php
              input_textareacustom("ket_pengajuan_validasi",$ket_pengajuan_validasi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            }else{
             $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
              echo $ket_pengajuan_validasi; 
            }
            ?>  
            <hr>  
          </div>
          <?php  
            if($status_pengajuan == 1){
                if($locked == NULL){
          ?>
          <div class="box-footer">
            <label>KLIK INI UNTUK MEMULAI PENGERJAAN SOAL</label><br>
               <button type="submit" name="action" value="BtnAktif" class="btn btn-app">
                <i class="fa fa-exclamation"></i> Aktifkan Soal
              </button>           
          </div>
          <?php  
                }
                if($locked == 2){
          ?>
          <div class="box-footer">
            <label>JIKA ASESI SUDAH KONFIRMASI TOMBOL INI AKAN HILANG</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut
              </button>   
               <button type="submit" name="action" value="BtnTolak" class="btn btn-app">
                <i class="fa fa-close"></i> Tidak Lanjut
              </button>         
          </div>
          <?php  
              }
            }
          ?>
        </div>  
      </div>
    </div>
  <?php echo form_close(); ?>
  </section>
</div>
<?php  
}
// ==================================================== MODAL
elseif ($page=="pengajuan_kompetensi_permohonan_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">     
            <div class="box-body table-responsive no-padding">
            <table class="table-border" style="width:100%;">
              <thead>
                <tr>
                <th rowspan="2" class="px" style="vertical-align: middle;text-align: left; font-size: 0.8em;">Nama Berkas (Klik Untuk Melihat)</th>
                <th colspan="4" class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">KESESUAIAN BUKTI </th>
                </tr>
                <tr>
                <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;width: 5%;">Memadai</th>
                <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;width: 5%;">Valid</th>
                <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;width: 5%;">Asli</th>
                <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;width: 5%;">Terkini</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  if(!empty($id_ijasah)){
                    foreach($ambil_berkas_data as $row){
                      if (in_array($row['id_berkas'],$id_ijasah)) {
                  ?>
                    <tr>
                    <td class="px" style="vertical-align: middle;text-align: left; font-size: 0.8em;">
                      <a href="<?php echo base_url('assets/berkas/ol/'.$row['link_berkas']);?>" target="_blank" style="color: black;" >
                         Jenis Berkas : <?php echo $row['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row['nama_berkas']; ?>,<br>
                         Lulus Tahun : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))) ?>
                      </a>
                    </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row['id_berkas']; ?>_1_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row['id_berkas']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row['id_berkas']; ?>_3_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row['id_berkas']; ?>_4_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
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
                    <td class="px" style="vertical-align: middle;text-align: left; font-size: 0.8em;">
                      <a href="<?php echo base_url('assets/berkas/ol/'.$row2['link_berkas']);?>" target="_blank" style="color: black;" >
                        Jenis Berkas : <?php echo $row2['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row2['nama_berkas']; ?>,<br>
                        Masa Berlaku : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row2['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row2['tgl_b_berkas']))) ?>
                      </a>
                    </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row2['id_berkas']; ?>_1_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row2['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row2['id_berkas']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row2['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row2['id_berkas']; ?>_3_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row2['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row2['id_berkas']; ?>_4_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row2['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
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
                    <td class="px" style="vertical-align: middle;text-align: left; font-size: 0.8em;">
                      <a href="<?php echo base_url('assets/berkas/ol/'.$row3['link_berkas']);?>" target="_blank" style="color: black;" >
                        Jenis Berkas : <?php echo $row3['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row3['nama_berkas']; ?>, <br>Penyelenggara : <?php echo $row3['penyelenggara']; ?>,<br>
                        Tanggal : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row3['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row3['tgl_b_berkas']))) ?>, <br>SKS : <?= number_format($row3['kredit'],1) ?>
                      </a>
                    </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row3['id_berkas']; ?>_1_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row3['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row3['id_berkas']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row3['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row3['id_berkas']; ?>_3_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row3['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row3['id_berkas']; ?>_4_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row3['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
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
                  <td class="px" style="vertical-align: middle;text-align: left; font-size: 0.8em;">
                    <a href="<?php echo base_url('assets/berkas/ol/'.$row4['link_berkas']);?>" style="color:black;" target="_blank">
                       Jenis Berkas : <?php echo $row4['nama_berkas_kategori']; ?><br>Nama Berkas : <?php echo $row4['nama_berkas']; ?>
                    </a>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row4['id_berkas']; ?>_1_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row4['id_berkas']."_1_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row4['id_berkas']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row4['id_berkas']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row4['id_berkas']; ?>_3_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row4['id_berkas']."_3_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                    <div class="checkbox">
                      <label>
                      <input value="<?php echo $row4['id_berkas']; ?>_4_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($row4['id_berkas']."_4_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
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
                  <td colspan="5" class="px" style="vertical-align: middle;text-align: left; font-size: 0.8em;"><i class="fa fa-file-text"></i> ETIK PEGAWAI</td>
                  </tr>
                  <tr>
                  <td colspan="5">
                    <div class="box-body table-responsive no-padding">
                    <table style="width:100%;" class="table-bordered">
                      <thead>
                        <tr>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">Tanggal</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">Hasil</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">Penguji</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;"><i class="fa fa-search"></i></th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;width: 5%;">Memadai</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;width: 5%;">Valid</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;width: 5%;">Asli</th>
                          <th class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;width: 5%;">Terkini</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
                          if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$id_etik_pegawai)) {
                      ?>
                        <tr>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">

                        </td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                          <div class="checkbox">
                            <label>
                            <input value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik1" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                          <div class="checkbox">
                            <label>
                            <input value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik2" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                          <div class="checkbox">
                            <label>
                            <input value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik3" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
                          <div class="checkbox">
                            <label>
                            <input value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik4" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
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
            </table>
            </div>
  </div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_asesmen_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">     
    <div class="box-body table-responsive no-padding">
    <table style="width:100%;" class="table-border">
      <thead>
        <tr>
          <th class="px" style="vertical-align: top; text-align: center;font-size: 0.8em;">Komponen Asesmen Mandiri</th>
          <th class="px" style="vertical-align: top; text-align: center;font-size: 0.8em;">Daftar Pertanyaan</th>
          <th class="px" style="vertical-align: top; text-align: center;font-size: 0.8em;width: 10%;">Penilaian</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach($form as $rowform2_detil){
        ?>
        <tr>
          <td class="px" style="font-weight: bold; vertical-align: top; font-size: 0.8em;"><?= $rowform2_detil['nama_asesmen'] ?></td>
          <td class="px" style="font-weight: bold; vertical-align: top; font-size: 0.8em;"><?= $rowform2_detil['nama_question'] ?></td>
          <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
            <div class="checkbox">
              <label>
              <input value="<?php echo $rowform2_detil['id_question']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_question']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
              </label>
            </div>
          </td>
        </tr>
        <?php 
        }
        ?>
      </tbody>
    </table>
    </div>
  </div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_rencana_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>  
    <div class="box-body table-responsive no-padding">
                  <table id="example1" width="100%" class="table table-bordered table-striped">
                  <?php
                  foreach($detil_elemen as $rowdetil_elemen){
                  ?>
                  <tr>
                    <td class="px bg-dark" style="width:3%;">&nbsp;</td>
                    <td class="px bg-dark" style="vertical-align: middle; text-align: left;font-size: 0.8em;font-weight: bold;" colspan="4"><?= $rowdetil_elemen['nama_elemen'] ?></td>
                  </tr>
                    <?php
                    $kondisialat = array('id_elemen'=>$rowdetil_elemen['id_elemen'],'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi);
                    $alatbahan = $this->m_umum->ambil_data_kondisi('nkr_alat_bahan',$kondisialat);
                    if(!empty( $alatbahan['alat'])){
                      echo'<tr><td>&nbsp;</td><td>&nbsp;</td><td colspan="3" style="font-weight:bold;font-size: 0.8em;">ALAT DAN BAHAN</td></tr>';
                    foreach($alat as $rowalat){
                      if (in_array($rowalat['id_alat'],explode(",", $alatbahan['alat']))) {
                    ?>
                    <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td style="font-size: 0.8em;text-align: center;">==</td>
                    <td colspan="2" style="text-align: left;font-size: 0.8em;">
                      <?= $rowalat['nama_alat'] ?>
                    </td>
                    </tr>
                    <?php
                      }
                    }
                  }
                  $detil_asesmen = $this->m_kredensial->ambil_asesmen_nkr_elemen_validasi($barcode_pengajuan_validasi,$rowdetil_elemen['id_elemen']);
                    foreach($detil_asesmen as $rowdetil_asesmen){
                      $detil_indikator = $this->m_kredensial->ambil_indikator_nkr_form_validasi_detil($barcode_pengajuan_validasi,$rowdetil_asesmen['id_asesmen']);
                    ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="font-size: 0.8em;" colspan="3"><?= $rowdetil_asesmen['nama_asesmen'] ?></td>
            </tr>
                  <?php
                    foreach($detil_indikator as $rowdetil_indikator){
                  ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="vertical-align:middle;text-align: center;width:3%;">&nbsp;</td>
              <td colspan="2" style="font-weight:bold;font-size: 0.8em;"><?= $rowdetil_indikator['nama_indikator'] ?></td>
            </tr>
              <?php  
              if(!empty($rowdetil_indikator['metode_indikator']) || !empty($rowdetil_indikator['perangkat_indikator'])){
              ?>
            <tr>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="text-align: left;font-weight: bold;font-size: 0.8em;"><?php if(!empty($rowdetil_indikator['metode_indikator'])){ echo 'METODE ASSMEN'; } ?></td>
            <td style="text-align: left;font-weight: bold;font-size: 0.8em;"><?php if(!empty($rowdetil_indikator['perangkat_indikator'])){ echo 'PERANGKAT ASSMEN'; } ?></td>
            </tr>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="text-align: left;font-size: 0.8em;">
                <ul>
                  <?php
                  if(!empty($rowdetil_indikator['metode_indikator'])){
                      foreach($metode as $rowmetode){
                        if (in_array($rowmetode['id_metode'],explode(",", $rowdetil_indikator['metode_indikator']))) {
                          echo '<li>'.$rowmetode['nama_metode'].'</li>';
                        }
                      }
                  }
                  ?>  
                </ul>          
              </td>
              <td style="text-align: left;font-size: 0.8em;">
                 <ul>
                  <?php
                  if(!empty($rowdetil_indikator['perangkat_indikator'])){
                    foreach($perangkat as $rowperangkat){
                      if (in_array($rowperangkat['id_perangkat'],explode(",", $rowdetil_indikator['perangkat_indikator']))) {
                        echo '<li>'.$rowperangkat['nama_perangkat'].'</li>';
                      }
                    }
                  }
                  ?>  </ul>               
              </td>
            </tr>
            <?php   
              }
                    }
                   }
                  }
                  ?>
                  </table>
    </div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_observasi_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">     
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Komponen Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Poin yang di amati</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;width: 10%;">Penilaian</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form as $rowform2_detil){      
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 0.8em;display: none;">
       
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['nama_asesmen'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['poin_indikator'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>
</div>
  </div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_lisan_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">     
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Pertanyaan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Indikator Pencapaian</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Jawaban Asesi</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Pencapaian</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no =0;
    foreach($form as $rowform2_detil){  
    $no++;    
    ?>
    <tr>
      <td class="px-3 py bg-dark" colspan="6" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['nama_asesmen'] ?></td>
    </tr>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 0.8em;display: none;">
        
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['pertanyaan_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['ketercapaian_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['jawaban_validasi_detil'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>
</div>
  </div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_tulis_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">     
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Pertanyaan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Standar Jawaban</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Jawaban Asesi</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Pencapaian<br>(YA)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no =0;
    foreach($form as $rowform2_detil){  
    $no++;    
    ?>
    <tr>
      <td class="px-3 py bg-dark" colspan="6" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['nama_asesmen'] ?></td>
    </tr>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 0.8em;display: none;">

      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;">
            <?php 
            echo $rowform2_detil['pertanyaan_indikator']?>
            <br><div class="form-group">
            <?php
            if($rowform2_detil['jenis_soal'] > 0){ //pilihan
              $soal = $this->m_kredensial->ambil_soal_opsie($rowform2_detil['id_indikator']);
              if($rowform2_detil['jenis_soal'] == 1){ // pilihan
                foreach($soal as $rowsoal){
            ?>
                <label>
                  <input type="radio" onclick="return false;" <?php if( $rowsoal['answer'] == 1){ echo 'checked'; } ?> class="minimal">&nbsp;&nbsp;<?= $rowsoal['nama_soal_opsi'] ?>
                </label><br>
            <?php
                }
              }
              if($rowform2_detil['jenis_soal'] == 2){ // ganda
                foreach($soal as $rowsoal){
            ?>
                <label>
                  <input type="checkbox" onclick="return false;" <?php if( $rowsoal['answer'] == 1){ echo 'checked'; } ?> class="minimal">&nbsp;&nbsp;<?= $rowsoal['nama_soal_opsi'] ?>
                </label><br>
            <?php
                }                
              }
              ?>
              </div>
            <?php
            }
            ?>  
        </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['jawaban_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?php
      if($rowform2_detil['jenis_soal'] == 0){
        echo html_entity_decode($rowform2_detil['jawaban_validasi_detil']);
      }else{
        if($rowform2_detil['jenis_soal'] > 0){ //pilihan
          $soal = $this->m_kredensial->ambil_soal_opsi($rowform2_detil['id_indikator']);
          foreach($soal as $rowsoal){
            if (in_array($rowsoal['id_soal_opsi'],explode(',',$rowform2_detil['jawaban_validasi_detil']))) {
              echo '['.$rowsoal['no_urut_soal_opsi'].'] - '.$rowsoal['nama_soal_opsi'].'<br>';
            }
          }
          ?>
          </div>
        <?php
        }
      }
      ?>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>
</div>
  </div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_portofolio_modal")
{
?>
<style>
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
  <div class="box-body">    
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: centerwidth: 15%;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: centerwidth: 15%;">Dokumen</th>
      <th class="px" style="vertical-align: middle; text-align: center">Pencapaian<br>(YA)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no =0;
    foreach($form2_detil as $rowform2_detil){  
    $no++;    
    ?>
    <tr>
      <td class="px-3 py bg-dark" colspan="4" style="font-weight: bold; vertical-align: middle;"><?= $rowform2_detil['nama_asesmen'] ?></td>
    </tr>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle;"><?= $rowform2_detil['dokumen_indikator'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
    }
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top;display: none;">&nbsp;</td>
      <td class="px" colspan="2" style="font-weight: bold; vertical-align: middle; text-align: left">
        Logbook Pencatatan Kompetensi
      </td>
      <td class="px" style="vertical-align: middle;text-align: center;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="7_<?php echo $barcode_pengajuan; ?>" <?php if(in_array("7_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title">SKETSA RINCIAN KEWENANGAN KLINIS</h3>           
        <div class="box-tools pull-right">
<?php
//  input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
?>
        </div>
  </div>
  <div class="box-body">
    <div class="box-tools pull-right">

    </div>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>validasi/pengajuan_kompetensi/pdf_rkk/<?= $id_pengajuan ?>" allowfullscreen></iframe>
</div>
  </div>
</div> 
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td>Nama:</td><td>'+d.nama_pegawai+'</td> <td>Instansi:</td><td colspan="2">'+d.nama_working+'</td></tr>'+
      '<tr> <td>Pencatatan Registrasi Pasien:</td><td colspan="4">'+d.rm+'</td></tr>'+
      '</table>';
    }
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb2').DataTable( {
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "pageLength": 10,
            "scrollX": true,
            "pagingType": "full_numbers",
            "oLanguage": {
                "sSearch": "Cari",
                "sLengthMenu": "Tampilkan _MENU_ baris",
                "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ baris",
                "sInfoEmpty": "Total Record _TOTAL_",
                "sInfoFiltered": "(Filter dari _TOTAL_ Records)",
                "sEmptyTable": "Tidak ada data untuk ditampilkan",
                "sZeroRecords": "Tidak ada data yang sesuai",
                "sProcessing": "Loading... Mohon Tunggu",
                "sInfoThousands": "'",
                "oPaginate": {
                    "sFirst": "Awal",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Akhir"
                },
                "select": {
                    "cells": {
                        "0": "",
                        "1": "1 cell Terpilih",
                        "_": "%d cells Terpilih"
                    },
                    "columns": {
                        "0": "",
                        "1": "1 column Terpilih",
                        "_": "%d columns Terpilih"
                    },
                    "rows": {
                        "_": "%d rows Terpilih",
                        "0": "",
                    }
                },
            },
            "ajax": {
                "url"  : "<?php echo base_url();?>validasi/pengajuan_kompetensi/logbook/<?php echo $barcode_pengajuan;?>",
                "type" : "POST"
            },
            "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable":false,
                        "data":      null,
                        "defaultContent": ''
                    },
                      { "data": "id_logbook", "searchable":false, "visible":false },
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "nama_kompetensi" },
                      { "data": "nama_kewenangan" },
                      { "data": null, "orderable": false, "searchable":false, className:"text-center",
                        "render": function(data, type, row){
                            if (row.result_tolak === '1') {
                               return '<button class="btn btn-xs btn-danger"> Supervisi</button>';
                           } else if (row.result_tolak === '2') {
                               return '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
                           } else if (row.validasi === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           }else {
                               return '<button class="btn btn-xs btn-info"> Belum Di Validasi</button>';
                           }
                        }
                      },
            ],
            "order": [[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ]
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");
        $(".btnnavy").removeClass("dt-button").addClass("btn bg-navy btn-sm");
        $(".btnyellow").removeClass("dt-button").addClass("btn bg-yellow btn-sm");
        $(".btnmaroon").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
        $(".btnolive").removeClass("dt-button").addClass("btn bg-olive btn-sm");
        $(".btnpurple").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnred").removeClass("dt-button").addClass("btn bg-red btn-sm");
        $(".btnaqua").removeClass("dt-button").addClass("btn bg-aqua btn-sm");
        $(".btnlightblue").removeClass("dt-button").addClass("btn bg-light-blue btn-sm");
        $(".btnblue").removeClass("dt-button").addClass("btn bg-blue btn-sm");
        $(".btngreen").removeClass("dt-button").addClass("btn bg-green btn-sm");
        $(".btnteal").removeClass("dt-button").addClass("btn bg-teal btn-sm");
        $(".btnlime").removeClass("dt-button").addClass("btn bg-lime btn-sm");
        $(".btnorange").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnfuchsia").removeClass("dt-button").addClass("btn bg-fuchsia btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
        $('#dttb2').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        });
        $('#search-inp').keyup(function(){
          table.search($(this).val()).draw() ;
        })
    });
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_konsultasi_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;display: none;"></th>
      <th class="px" colspan="2" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Kegiatan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;width: 10%;">Pencapaian</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form as $rowform2_detil){      
    ?>
    <tr>
      <th class="px" colspan="4" style="vertical-align: middle; text-align: left;font-size: 0.8em;">
        <?= $rowform2_detil['nama_pra_asesmen'] ?>
      </th>
    </tr>
    <?php 
       $ambil_nkr_pra_detil = $this->m_kredensial->ambil_validasi_nkr_pra_detil($barcode_pengajuan_validasi,$rowform2_detil['barcode_pra_asesmen']);   
      foreach($ambil_nkr_pra_detil as $rowambil_nkr_pra_detil){
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 0.8em;display: none;">
       
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;width: 5%;">&nbsp;</td>
      <td class="px" style="font-weight: bold;font-size: 0.8em;"><?= $rowambil_nkr_pra_detil['nama_pra_detil'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowambil_nkr_pra_detil['id_pra_detil']; ?>_8_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowambil_nkr_pra_detil['id_pra_detil']."_8_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
      }
    }
    ?>
  </tbody>
</table>
</div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_cek_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;display: none;"></th>
      <th class="px" colspan="2" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Kegiatan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;width: 10%;">Pencapaian</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form as $rowform2_detil){      
    ?>
    <tr>
      <th class="px" colspan="4" style="vertical-align: middle; text-align: left;font-size: 0.8em;">
        <?= $rowform2_detil['nama_pra_asesmen'] ?>
      </th>
    </tr>
    <?php 
       $ambil_nkr_pra_detil = $this->m_kredensial->ambil_validasi_nkr_pra_detil($barcode_pengajuan_validasi,$rowform2_detil['barcode_pra_asesmen']);   
      foreach($ambil_nkr_pra_detil as $rowambil_nkr_pra_detil){
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 0.8em;display: none;">
        
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;width: 5%;">&nbsp;</td>
      <td class="px" style="font-weight: bold;font-size: 0.8em;"><?= $rowambil_nkr_pra_detil['nama_pra_detil'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowambil_nkr_pra_detil['id_pra_detil']; ?>_8_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowambil_nkr_pra_detil['id_pra_detil']."_8_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
      }
    }
    ?>
  </tbody>
</table>
</div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_keputusan_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;" rowspan="2">Kriteria Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;" rowspan="2">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;" colspan="4">Bukti</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Keputusan</th>
    </tr>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">4A</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">4B</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">4C</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">4D</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Kompeten</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form as $rowform2_detil){    
    ?>
    <tr>
      <td class="px py bg-dark" colspan="7" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['nama_elemen'] ?>
      </td>
    </tr>
    <?php 
      $detil = $this->m_kredensial->ambil_validasi_detil_grup_form7($barcode_pengajuan,'nvd.id_indikator','no_urut_detil','ASC','nas.id_elemen',$rowform2_detil['id_elemen']);
        $no = 0;
        foreach($detil as $rowdetil){ 
          $no++;
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowdetil['nama_asesmen'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowdetil['nama_indikator'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104A_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104A_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104B_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104B_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104C_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104C_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104D_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104D_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_10K_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_10K_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
    </tr>
    <?php 
        }
    }
    ?>
  </tbody>
</table>
</div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Kompeten</span>';}else{ echo '<span style="color:red;font-weight:bold;">Belum Kompeten</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_banding_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div style="font-size: 0.8em;margin-top: 7pt;margin-bottom: 15pt;margin-right: 7pt;">
    <table style="width:100%;margin-left: 15pt;">
      <tbody>
        <tr>
          <td style="vertical-align: top; font-size: 0.8em;">Tanggal Pengajuan</td>
          <td style="vertical-align: top; text-align: center;font-size: 0.8em;">:</td>
          <td style="vertical-align: top; font-size: 0.8em;"><?= $tgl_pengajuan ?></td>
        </tr>
        <tr>
          <td style="vertical-align: top; width:20%;font-size: 0.8em;">Nama Asesi</td>
          <td style="vertical-align: top; text-align: center;width:4%;font-size: 0.8em;">:</td>
          <td style="vertical-align: top; font-size: 0.8em;"><?= $nama_pegawai ?></td>
        </tr>
        <tr>
          <td style="vertical-align: top; font-size: 0.8em;">Nama Asesor</td>
          <td style="vertical-align: top; text-align: center;font-size: 0.8em;">:</td>
          <td style="vertical-align: top; font-size: 0.8em;"><?= $nama_asesor ?></td>
        </tr>   
        <tr>
          <td style="vertical-align: top; font-size: 0.8em;">Tempat</td>
          <td style="vertical-align: top; text-align: center;font-size: 0.8em;">:</td>
          <td style="vertical-align: top; font-size: 0.8em;"><?= $nama_working ?></td>
        </tr>
        <tr>
          <td style="vertical-align: top; font-size: 0.8em;">Banding Asesmen</td>
          <td style="vertical-align: top; text-align: center;font-size: 0.8em;">:</td>
          <td style="vertical-align: top; font-size: 0.8em;"><?= $nama_banding_form ?></td>
        </tr>
        <tr>
          <td colspan="3" style="vertical-align: top; font-size: 0.8em;">Banding ini di ajukan atas alasan sebagai berikut</td>
        </tr>
        <tr>
          <td colspan="3" style="vertical-align: top; font-size: 0.8em;"><?= $banding_asesi ?></td>
        </tr>
      </tbody>
    </table>
    </div>
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan Asesor</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Disetujui</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Disetujui</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_komponen_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;width: 40%;">Komponen</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;width: 5%;">YA</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Catatan / Komentar Peserta</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
    foreach($form as $rowform2_detil){   
    $no++; 
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['nama_kaji_ulang'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;">
        <div class="checkbox">
          <label>
          <input value="<?php echo $rowform2_detil['id_kaji_ulang'].$no; ?>_12_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_kaji_ulang'].$no."_12_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?>  type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;"><?= $rowform2_detil['komentar_kesenjangan'] ?>
  <?php
  //  input_textareacustom("komentar_kesenjangan[]",$komentar_kesenjangan," id='editor".$no."' rows='3' cols='20' class='form-control' ","Jawaban Asesi");
  ?>
      </td>
    </tr>
    <?php 
    }
    ?>
  </tbody>
</table>
</div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Kompeten</span>';}else{ echo '<span style="color:red;font-weight:bold;">Belum Kompeten</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
elseif ($page=="pengajuan_kompetensi_kesenjangan_modal")
{
?>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
      <div class="box-tools pull-right"></div>
  </div>
<div class="box-body table-responsive no-padding">
<table style="width:100%;" class="table-border">
  <thead>
    <tr>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;width: 40%;">Aspek Yang di kaji ulang</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 0.8em;">Kesenjangan yang ditemukan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form as $rowform2_detil){   
         
    ?>
     <tr>
      <td class="px py bg-dark" colspan="7" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowform2_detil['nama_kat_kaji'] ?>
      </td>
    </tr>
    <?php 
  $detil = $this->m_kredensial->ambil_kaji_ulang_nkr_form_validasi_detil($barcode_pengajuan_validasi,$rowform2_detil['id_kat_kaji']);
        foreach($detil as $rowdetil){ 
    ?>   
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 0.8em;"><?= $rowdetil['nama_kaji_ulang'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 0.8em;"><?= $rowdetil['komentar_kesenjangan'] ?>      </td>
    </tr>
    <?php 
      }
    }
    ?>
  </tbody>
</table>
</div>
</div>
<div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
  <div class="box-header with-border">
     <h3 class="box-title">PENILAIAN</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
              title="Collapse">
        <i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row" style="font-size:0.8em;">
      <div class="col-md-4">
        <label>Catatan / Rekomendasi</label><br>
        <?= 
        $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
       ?> <br>
      </div>
      <div class="col-md-4">
        <label>Asesor</label><br>
        <?= $nama_asesor ?> <br>
        <label>Validasi</label> : 
        <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Kompeten</span>';}else{ echo '<span style="color:red;font-weight:bold;">Belum Kompeten</span>'; } ?>
      </div>
      <div class="col-md-4">
        <label>Waktu Acc Asesor</label><br>
        <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
        <label>Waktu Acc Asesi</label><br>
        <?php if($tgl_asesi){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesi))); } ?> 
      </div>
    </div>
  </div>
</div> 
<?php
}
// ==================================================== END MODAL