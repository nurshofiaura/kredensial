<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
$arrayboxBOX = array('aqua','green','yellow','red');
$resarrayBOX = array_rand($arrayboxBOX);
$thenarrayBOX = $arrayboxBOX[$resarrayBOX];
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
           <h3 class="box-title">PERHATIAN</h3>

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
      </div>
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
        <small>
     <a href="<?php echo base_url($this->session->beranda);?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>         
        </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
                       <button style="font-weight:bold;" class="btn btn-xs btn-warning">
                       Pengajuan Pending : <?= $blm_lunas ?>
                      </button>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;width: 5%;">ID</th>
            <th style="width:15%;">Tanggal</th>
            <th>Nama Asesi</th>
            <th>Kategori</th>
            <th style="width:15%;">Status</th>
          </tr>
        </thead>
      </table>
        </div>
      </div>
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
elseif ($page=="pengajuan_kompetensi_sukses")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <ul class="timeline timeline-inverse">
              <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">
                    Tanggal Pengajuan : <?= $tgl_pengajuan ?>
                </h3>
                <div class="timeline-body">
                <ul>
                  <li>Jenis Pengajuan Kompetensi : <?= $nama_status_diusulkan ?></li>
                  <li>Nama Pegawai : <?= $nama_pegawai ?></li>
                  <li>Silahkan Kirim ke Email : <strong style="color: darkred;">aplikasisnars@gmail.com</strong> untuk konfirmasi pengajuan dengan menyertakan nomor pengajuan <strong style="color:green;"><?= $barcode_pengajuan_temp ?></strong></li>
                  <li>Konfirmasi hanya melalui email jadi mohon selalu mengecek email masing-masing</li>
                  <li>Dan jika mendapatkan konfirmasi mohon cek benar-benar pengirim email, Admin tidak bertanggung jawab atas kesalahan pembayaran</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
          </div>
        </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengajuan_kompetensi_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><?php $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $title ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <ul class="timeline timeline-inverse">
              <!-- timeline time label -->
              <li class="time-label">
                <span class="bg-red">
                  <?php echo date('d-m-Y'); ?>
                </span>
              </li>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">File</h3>
                <div class="timeline-body">
                <ul>
                  <li>Siapkan file surat ijin (STR) yang berlaku</li>
                  <li>Siapkan file ijasah pendidikan terakhir</li>
                  <li>Siapkan file sertifikat pelatihan, workshop, kongres, simposium dll</li>
                  <li>Siapkan file berkas lainnya (opsional)</li>
                  <li>Semua berkas di upload di menu berkas sesuai kategorinya (Surat Ijin, Seminar dll, Ijasah dan berkas lainnya) dalam format PDF</li>
                  <li>Semua berkas yang diupload tidak akan hilang dan dapat di download atau digunakan untuk pengajuan selanjutnya</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-user bg-aqua"></i>
              <div class="timeline-item">
                <h3 class="timeline-header">Logbook</h3>
                <div class="timeline-body">
                <ul>
                  <li>Pengajuan Kredensial / Non Keperawatan hanya akan divalidasi oleh komite / penilai</li>
                  <li>Pengajuan Kredensial setiap profesi berbeda-beda sesuai dengan komite</li>
                  <li>Pengajuan Pemulihan kewenangan diambil dari logbook yang ditolak</li>
                  <li>Ada biaya untuk pengajuan kompetensi</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <h3 class="timeline-header">Pengiriman</h3>

                <div class="timeline-body">
                <ul>
                  <li>Lengkapi berkas dan logbook terlebih dahulu baru kemudian pengajuan dapat diajukan</li>
                  <li>Setelah pengajuan terkirim mohon untuk menghubungi tim kompetensi</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-clock-o bg-gray"></i>
              </li>
            </ul>
            <br />
              <?php
              echo '<label>Jenis Pengajuan Kompetensi</label>';
              input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
              echo '<label>Tempat Bekerja</label>';
              input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
              ?>           
            <div class="box-body box-profile">
            <button type="submit" class="btn btn-primary btn-block"><b>AJUKAN</b></button>
            </div>
          </div>
        </div>
        </div>
      </div>
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
elseif ($page=="pengajuan_kompetensi_isi")
{
  $arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','blue','green','teal','lime','orange','fuchsia');
  $arrayfa = array('file-text','file-text-o','calendar','file-o','file','sticky-note','table');
?>
<style>
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
/*a:link {
  color: black;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: red;
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: black;
  background-color: transparent;
  text-decoration: underline;
}
a:active {
  color: black;
  background-color: transparent;
  text-decoration: underline;
}*/
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
        </div>
        <div class="box-body">
    <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/isi/'.$id,' ');
    input_text("id_pengajuan",$id_pengajuan,"","","hidden");
    ?>
      <div class="row">
       <div class="col-md-12">
      <div class="col-md-4">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">
                KELENGKAPAN
                </h3>
            </div>
            <div class="box-body">
              <div class="box-body box-profile">
      <?php
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
                <a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
                  data-lightbox="example-set" data-title="<?php echo $member_name; ?>">
                  <img class="profile-user-img img-responsive img-circle"
                    src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                </a>
                <h3 class="profile-username" style="color:green;text-align:center;"><?php echo $member_name; ?></h3>
                <h4 style="color:green;text-align:center;"><strong><?= strtoupper($nama_status_diusulkan) ?></strong></h4>
                <ul class="list-group list-group-unbordered">
                <?php
                if($status_pengajuan > 0){
                  echo '<h5 style="color:blue;text-align:left;"><strong>NAMA ASESOR</strong></h5>';
                  foreach($list_asesor as $rowlist_asesor){
                    echo '<li class="list-group-item"><font color="red"><b>'.$rowlist_asesor['nama_pegawai'].'</b></font></li>';
                  }
                }
              if($status_pengajuan=="0"){
                    ?>
                    <li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenTambahKat" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Kompetensi" data-toggle="modal" data-target="#exampleModal">
  Pilih Kompetensi
</button>
                    </li>
                    <?php  
              }
                    if($status_pengajuan=="0"){
                  ?><li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenIjasah" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Ijasah" data-toggle="modal" data-target="#exampleModal">
  Pilih Ijasah
</button>
                  </li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                  ?><li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenSurat" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Surat Ijin" data-toggle="modal" data-target="#exampleModal">
  Pilih Surat Ijin
</button>
                    </li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                  ?> <li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenSertifikat" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Sertifikat" data-toggle="modal" data-target="#exampleModal">
  Pilih Sertifikat
</button>
                    </li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                  ?><li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenBerkasOpsi" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Berkas Lain (opsional)" data-toggle="modal" data-target="#exampleModal">
  Pilih Berkas Lain (opsional)
</button>
                      </li>
                  <?php
                    }
                    if($status_pengajuan=="0"){
                      ?><li class="list-group-item">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block btn-xs OpenEtik" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_pengajuan; ?>" data-id2="<?php echo $id; ?>" title="Pilih Etik (opsional)" data-toggle="modal" data-target="#exampleModal">
  Pilih Etik (opsional)
</button>
                    </li>
                  <?php
                    }
                  ?>
                
                </ul>
                <?php  
                  if($status_pengajuan=="0"){
                ?>
                    <button name="action" value="Btnsimpan" class="btn btn-primary btn-block">
                      <i class="fa fa-save"></i> <b>SIMPAN KOMPETENSI</b>
                    </button>
                <?php  
                  }
                ?>
              </div>
            </div>
          </div>
            <?php 
            if($status_pengajuan == 1){
            ?>
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
  <span class="info-box-icon"><i class="fa fa-<?php echo $arrayfa[array_rand($arrayfa)]; ?> fa-lg"></i></span>

  <div class="info-box-content">
    <span class="info-box-text blinking" style="font-size:0.8em;font-weight: bold;"><?= $row_link['nama_pegawai'] ?></span>
    <span class="info-box-number" style="font-size:0.9em;"><?= $row_link['judul_link'] ?></span>

    <div class="progress">
      <div class="progress-bar" style="width: 100%"></div>
    </div>
        <a href="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/'.$row_link['url_link'].'/'.$row_link['barcode_pengajuan_validasi']);?>" class="progress-description" style="color: white;">
          Hasil <i class="fa fa-arrow-circle-right"></i>
        </a>
  </div>
</div>
                <?php
                    }
                ?>

                </div>
              </div>
                <?php
                    }
                ?>
        </div>
        <div class="col-md-8">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
             DATA BERKAS
            </h3>
            </div>
            <div class="box-body">
        <div class="box-body no-padding">
          <div class="mailbox-controls">

          </div>
          <div class="table-responsive mailbox-messages">
          <table class="table table-hover table-striped">
            <tbody>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">IJASAH</td>
            </tr>
              <?php
              if($ijasah!==""){
                foreach($ambil_berkas_data as $row){
                  if (in_array($row['id_berkas'],$id_ijasah)) {
                    if($status_pengajuan > 1){
              ?>
                <tr>
                  <td colspan="2">
Nama Instansi : <b><?= $row['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row['nama_berkas_kategori'] ?></b><br>Jenjang : <b><?= $row['nama_pendidikan']?></b><br>No Ijasah : <b><?= $row['no_berkas']?></b><br>Tanggal Lulus : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row['tgl_b_berkas']))) ?></b><br><br>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $row['link_berkas'] ?>" allowfullscreen></iframe>
</div><br><br>               
                  </td>
                </tr>
              <?php
                    }else{
              ?>
                <tr>
                <td width="5%"><input name="id_4_ijasah[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox"></td>
                <td class="mailbox-name">
                  <a style="color:black;" href="<?php echo base_url();?>assets/berkas/ol/<?= $row['link_berkas'] ?>" target="_blank">
Nama Instansi : <b><?= $row['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row['nama_berkas_kategori'] ?></b><br>Jenjang : <b><?= $row['nama_pendidikan']?></b><br>No Ijasah : <b><?= $row['no_berkas']?></b><br>Tanggal Lulus : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row['tgl_b_berkas']))) ?></b>
                  </a><br><br>
                </td>
                </tr>
              <?php
                    }
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">SURAT IJIN</td>
            </tr>
              <?php
              if($str!==""){
                foreach($ambil_berkas_data as $row2){
                  if (in_array($row2['id_berkas'],$id_str)){
                    if($status_pengajuan > 1){
              ?>
                <tr>
                  <td colspan="2">
Nama Berkas : <b><?= $row2['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row2['nama_berkas_kategori'] ?></b><br>No Surat Ijin : <b><?= $row2['no_berkas']?></b><br>Tanggal Berlaku : <b>
<?php if($row2['lifetime_berkas'] == 0){ $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row['tgl_b_berkas']))); }else{ echo 'Seumur Hidup'; } ?></b><br><br>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $row2['link_berkas'] ?>" allowfullscreen></iframe>
</div><br><br>               
                  </td>
                </tr>
              <?php
                    }else{
              ?>
                <tr>
                <td width="5%"><input name="id_4_str[]" value="<?php echo $row2['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a style="color:black;" href="<?php echo base_url();?>assets/berkas/ol/<?= $row2['link_berkas'] ?>" target="_blank">
Nama Berkas : <b><?= $row2['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row2['nama_berkas_kategori'] ?></b><br>No Surat Ijin : <b><?= $row2['no_berkas']?></b><br>Tanggal Berlaku : <b>
<?php if($row2['lifetime_berkas'] == 0){ $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row['tgl_b_berkas']))); }else{ echo 'Seumur Hidup'; } ?></b>
                  </a><br><br>
                </td>
                </tr>
              <?php
                    }
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">SERTIFIKAT</td>
            </tr>
              <?php
              if($sertifikat!==""){
                foreach($ambil_berkas_data as $row3){
                  if (in_array($row3['id_berkas'],$id_sertifikat)) {
                    if($status_pengajuan > 1){
              ?>
                <tr>
                  <td colspan="2">
Nama Pelatihan : <b><?= $row3['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row3['nama_berkas_kategori'] ?></b><br>Penyelenggara : <b><?= $row3['penyelenggara']?></b><br>Kategori Pelatihan : <b><?= $row3['nama_kategori_pelatihan']?></b><br>No Sertifikat : <b><?= $row3['no_sertifikat']?></b><br>Tanggal Mulai : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row3['tgl_a_berkas']))) ?></b><br>Tanggal Berakhir : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row3['tgl_b_berkas']))) ?></b><br><br>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $row3['link_berkas'] ?>" allowfullscreen></iframe>
</div><br><br>               
                  </td>
                </tr>
              <?php
                    }else{
              ?>
                <tr>
                <td width="5%"><input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a style="color:black;" href="<?php echo base_url();?>assets/berkas/ol/<?= $row3['link_berkas'] ?>" target="_blank">
Nama Pelatihan : <b><?= $row3['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row3['nama_berkas_kategori'] ?></b><br>Penyelenggara : <b><?= $row3['penyelenggara']?></b><br>Kategori Pelatihan : <b><?= $row3['nama_kategori_pelatihan']?></b><br>No Sertifikat : <b><?= $row3['no_sertifikat']?></b><br>Tanggal Mulai : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row3['tgl_a_berkas']))) ?></b><br>Tanggal Berakhir : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row3['tgl_b_berkas']))) ?></b>
                  </a><br><br>
                </td>
                </tr>
              <?php
                    }
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">BERKAS PELENGKAP</td>
            </tr>
              <?php
              if($berkas!==""){
                foreach($ambil_berkas_data as $row4){
                  if (in_array($row4['id_berkas'],$id_berkas)) {
                    if($status_pengajuan > 1){
              ?>
                <tr>
                  <td colspan="2">
Nama Berkas : <b><?= $row4['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row4['nama_berkas_kategori'] ?></b><br>No Berkas : <b><?= $row4['no_berkas']?></b><br><br>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo base_url();?>assets/berkas/ol/<?= $row4['link_berkas'] ?>" allowfullscreen></iframe>
</div><br><br>               
                  </td>
                </tr>
              <?php
                    }else{
              ?>
                <tr>
                <td width="5%"><input name="id_4_berkas[]" value="<?php echo $row4['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a style="color:black;" href="<?php echo base_url();?>assets/berkas/ol/<?= $row4['link_berkas'] ?>" target="_blank">
Nama Berkas : <b><?= $row4['nama_berkas'] ?></b><br>Jenis Berkas : <b><?= $row4['nama_berkas_kategori'] ?></b><br>No Berkas : <b><?= $row4['no_berkas']?></b>
                  </a><br><br>
                </td>
                </tr>
              <?php
                    }
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">ETIK</td>
            </tr>
              <?php
              if($id_etik_pegawai!==""){
                foreach($ambil_data_etik_pegawai_oppe as $row5){
                  if (in_array($row5['id_etik_pegawai'],$etike)) {
              ?>
                <tr>
              <td width="5%"><input name="id_etik_pegawai[]" value="<?php echo $row5['id_etik_pegawai']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
Tanggal Etik : <b><?= $this->m_rancak->fullBulan(date('d-m-Y',strtotime($row5['tgl_etik_pegawai']))) ?></b><br>
Hasil Etik : <b><?= $row5['hasil_etik'] ?></b><br>
Penguji : <b><?= $row5['nama_pegawai']?></b><br><br>
<!--<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<php echo base_url();?>member/tes/pdf_etika/<= $row5['id_etik_pegawai'] ?>" allowfullscreen></iframe>
</div><br><br>-->
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            </tbody>
          </table>
          <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
        <div class="box-footer no-padding">
          <div class="mailbox-controls">
          <!-- Check all button -->
          <div class="pull-right">
           <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT <i class="fa fa-trash-o"></i> UNCHECK KEMUDIAN SIMPAN UNTUK MEMBUANG BERKAS
          </div>
          <!-- /.pull-right -->
          </div>
        </div>
            </div>
          </div>
        </div>
        </div>
<!--        <div class="col-md-12">
        <div class="col-md-6">
          <div class="box box-<php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">
                <small style="color:white;font-weight:bold;">DAFTAR TOTAL PEMERIKSAAN</small>
              </h3>
            </div>
            <div class="box-body">
             <php 
              if($status_pengajuan > 0){
             ?>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<php echo base_url();?>ol_pengajuan/pengajuan_kompetensi/pdf_rkk/<= $id_pengajuan ?>" allowfullscreen></iframe>
</div>
             <php 
              }
             ?>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-<php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">
                <small style="color:white;font-weight:bold;">DAFTAR TOTAL PEMERIKSAAN</small>
              </h3>
            </div>
            <div class="box-body">
              <php 
                if(!empty($kode_unit_pengajuan)){
              ?>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<php echo base_url();?>ol_pengajuan/pengajuan_kompetensi/pdf_logbook/<= $id_pengajuan ?>" allowfullscreen></iframe>
</div>
              <php
                }
              ?>
            </div>
          </div>
        </div>
        </div> -->
      </div>
    <?php echo form_close(); ?>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $header; ?> <small><?php echo $instance_name; ?></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}
elseif ($page=="pengajuan_kompetensi_tambah_kompetensi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/simpan_tambah_kompetensi');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="barcode_pengajuan" value="<?= $barcode_pengajuan; ?>">
      <input type="hidden" name="kode_unit_pengajuan" value="<?= $kode_unit_pengajuan; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Struktur Validator</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_kompetensi'],explode(",", $kode_unit_pengajuan))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kompetensi'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_kompetensi']; ?></td>

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
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_tambah_logbook")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/simpan_tambah_logbook');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan ?>">
      <input type="hidden" name="id_status_diusulkan" value="<?= $id_status_diusulkan ?>">
      <input type="hidden" name="barcode_pengajuan" value="<?= $id2 ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Tanggal</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan-[Kompetensi] = Q</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Sifat</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
              //    if(!in_array($row['id_kewenangan'],explode(",", $eimplo))){
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_logbook'];?>" >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_logbook']))); ?></td>
                <td style="vertical-align:middle;"><input type="hidden" name="id_kewenangan[]" value="<?= $row['id_kewenangan'] ?>">
                  <?= $row['nama_kewenangan'] ?> - <b>[<?= $row['nama_kompetensi'] ?>]</b> = <?= $row['jml_logbook'] ?>
                </td>
                <td style="vertical-align:middle;"><?= $row['nama_sifat_kewenangan'] ?></td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_tambah_ijasah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="barcode_pengajuan" value="<?= $id2; ?>">
      <input type="hidden" name="id" value="id_ijasah">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Instansi</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jenjang Pendidikan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal Lulus</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_berkas'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_berkas']; ?> 
                <a href="<?= base_url('assets/berkas/ol/'.$row['link_berkas']) ?>" target="_blank"> &nbsp;&nbsp;<i class="fa fa-search"></i> Lihat</a>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_pendidikan']; ?></td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))); ?></td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_tambah_str")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="barcode_pengajuan" value="<?= $id2; ?>">
      <input type="hidden" name="id" value="id_str">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Data Surat Ijin</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal Expired</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_berkas'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;">
                  Berkas : <?= $row['nama_berkas'] ?><br>
                  Kategori : <?= $row['nama_berkas_kategori'] ?><br>
                  No : <?= $row['no_berkas'] ?><br>
                  Tanggal : <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_a_berkas']))); ?><br>
              <a href="<?= base_url('assets/berkas/ol/'.$row['link_berkas']) ?>" target="_blank"> &nbsp;&nbsp;<i class="fa fa-search"></i> Lihat</a>
                </td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))); ?></td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_tambah_sertifikat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="barcode_pengajuan" value="<?= $id2; ?>">
      <input type="hidden" name="id" value="id_sertifikat">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Data Sertifikat</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal Mulai</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 15%;">Tanggal Selesai</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_berkas'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;">
                  Berkas : <?= $row['nama_berkas'] ?><br>
                  Kategori : <?= $row['nama_berkas_kategori'] ?><br>
                  No : <?= $row['no_sertifikat'] ?><br>
                  SKP : <?= $row['kredit'] ?><br>
                  Penyelenggara : <?= $row['penyelenggara'] ?><br>
              <a href="<?= base_url('assets/berkas/ol/'.$row['link_berkas']) ?>" target="_blank"> &nbsp;&nbsp;<i class="fa fa-search"></i> Lihat</a>
                </td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_a_berkas']))); ?></td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_b_berkas']))); ?></td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_tambah_berkaslain")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="barcode_pengajuan" value="<?= $id2; ?>">
      <input type="hidden" name="id" value="id_berkas">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Berkas</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">No Berkas</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_berkas'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_berkas'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;">
                  Berkas : <?= $row['nama_berkas'] ?><br>
              <a href="<?= base_url('assets/berkas/ol/'.$row['link_berkas']) ?>" target="_blank"> &nbsp;&nbsp;<i class="fa fa-search"></i> Lihat</a>
                </td>
                <td style="vertical-align:middle;"><?= $row['no_berkas'] ?></td>
                <td style="vertical-align:middle;"><?= $row['nama_berkas_kategori'] ?></td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_tambah_etik")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/simpan_berkas');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
      <input type="hidden" name="barcode_pengajuan" value="<?= $id2; ?>">
      <input type="hidden" name="id" value="id_etik_pegawai">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">ETIK PEGAWAI</h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
          <tr>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
              <input name="select_all" class="checkall" type="checkbox" />
            </th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;">Tanggal</th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;">Soal</th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;">Penguji</th>
            <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;font-weight:bold;"><i class="fa fa-print"></i></th>
          </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($kompetensi as $row){
                 if(in_array($row['id_etik_pegawai'],explode(",", $berkase))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" style="vertical-align:middle;" class="child" name="chk[]" value="<?php echo $row['id_etik_pegawai'];?>" <?= $checked ?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($row['tgl_etik_pegawai']))); ?></td>
                <td style="vertical-align:middle;text-align: center;"><?= $row['jumlah_etik'] ?></td>
                <td style="vertical-align:middle;text-align: center;"><?= $row['hasil_etik'] ?></td>
                <td style="vertical-align:middle;text-align: center;"><?= $row['nama_pegawai'] ?></td>
                <td style="vertical-align:middle;text-align: center;">
  <a href="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/pdf_etika/'.$row['id_etik_pegawai']);?>" class="btn bg-green btn-xs" target="_blank">
                    == <i class="fa fa-file-pdf-o"></i> pdf ==</a>
                </td>
              </tr>
                <?php
             //       }
                  }
                ?>
              </tbody>
            </table>
          </div>          
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true
    })
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="berkas_logbook")
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
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_kembali;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_pengajuan/berkas_logbook/view/'.$first_date.'/'.$last_date.'/'.$id,' id="signupform" ');
  input_text("barcode_pengajuan",$id,"","","hidden");
  input_text("id_pengajuan",$id_pengajuan,"","","hidden");
  input_text("id_status_diusulkan",$id_status_diusulkan,"","","hidden");
  input_text("status_pengajuan",$status_pengajuan,"","","hidden");
  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PILIH KEWENANGAN</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
          <table id="example1" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
            <tr style="background-color: #29675B;color: white;">
              <th style="width:5%;text-align:center;vertical-align:middle;">
                <input name="select_all" class="checkall" type="checkbox" />
              </th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Tanggal</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $kondisi=array('id_logbooker'=>$this->session->id_pegawai,'tolak >'=> 0);
              $tolake = $this->m_umum->ambil_data_kondisi_result('ol_logbook',$kondisi);
              $kw_tolak = array();
              foreach($tolake as $valambil_kw_tolak){
                  $kw_tolak[] = $valambil_kw_tolak['id_kewenangan'];
              }
              $eimplokw_tolak = implode(",", $kw_tolak);
              foreach($logbook_pengajuan as $row){
                if (in_array($row['id_kewenangan'],explode(",", $eimplokw_tolak))){ 
                  $tol = ' - <b><font color="red">TOLAK</font></b>'; 
                }else{ 
                  $tol = ''; 
                }
              ?>
            <tr>
              <td style="vertical-align:middle;text-align:center;">
                <div class="checkbox">
                <label>
                  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_logbook'];?>">
                </label>
                </div>
              </td>
              <td style="vertical-align:middle;text-align:center;"><?php echo $row['tgl_logbook']; ?></td>
              <td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?> <?php echo $tol; ?></td>
            </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
          <button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-save"></i> SUBMIT</button>
        </div>
      </div>
      <?php 
        echo form_close(); 
      ?>
    </section>
</div>
<?php
}
elseif ($page=="berkas_ijasah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_kembali;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
                <th width="5%" style="display:none;">ID</th>
                <th>Nama Instansi</th>
                <th>Jenjang Pendidikan</th>
                <th>No Ijasah</th>
                <th>Lulus Tahun</th>
                <th><i class="fa fa-search"></i> </th>
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkas_str")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_kembali;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small></h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
          <tr>
            <th width="5%" style="display:none;">ID</th>
            <th>Nama File</th>
            <th>Nama Berkas</th>
            <th>No STR/SIK/SIP</th>
            <th>Berlaku</th>
            <th>Expired</th>
            <th>Status</th>
            <th><i class="fa fa-search"></i> </th>
          </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkas_sertifikat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_kembali;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small></h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
          <tr>
            <th width="5%"></th>
            <th width="5%" style="display:none;">ID</th>
            <th>Nama Pelatihan</th>
            <th>SKP / SKS</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th><i class="fa fa-search"></i> </th>
          </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkaslain_berkas")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_kembali;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small></h3>
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
          <thead>
          <tr>
            <th width="5%" style="display:none;">ID</th>
            <th>Nama File</th>
            <th>No File</th>
            <th>Kategori</th>
            <th><i class="fa fa-search"></i> </th>
          </tr>
          </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkas_etik")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_kembali;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Jumlah Soal</th>
            <th>Nilai</th>
            <th>Hasil</th>
            <th>Penguji</th>
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/permohonan/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
    input_text("barcode_pengajuan_validasi",$barcode_pengajuan_validasi,"","","hidden");
    input_text("status_pengajuan",$status_pengajuan,"","","hidden");
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
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title">DAFTAR SEMUA KOMPETENSI</h3>           
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
                <th rowspan="2" class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">Nama Berkas</th>
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
                  <td colspan="5" class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;"><i class="fa fa-file-text"></i> ETIK PEGAWAI</td>
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-4">
                <label>Catatan / Rekomendasi</label><br>
                <?php
                $ket_pengajuan = html_entity_decode($ket_pengajuan);
                 echo $ket_pengajuan ?> <br>
              </div>
              <div class="col-md-4">
                <label>Asesor</label><br>
                <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi_asesor == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?>
              </div>
              <div class="col-md-4">
                <label>Waktu Asesor</label><br>
                <?php if($tgl_asesor_pengajuan){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor_pengajuan))); } ?> 
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($validasi_asesor > 0 AND $tgl_asesi_pengajuan == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA TIDAK SETUJU HUBUNGI ASESOR DAN JANGAN KLIK DAHULU</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Konfirmasi
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
input[type="checkbox"]:disabled + label::before{
  background: gray;
}
input[type="checkbox"]:disabled + label:hover::before{
  background: gray;
  border: 1px solid #d4d4d5;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <a href="<?php echo $kembali;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
  </section>
  <section class="content">
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/asesmen/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("barcode_pengajuan_validasi",$barcode_pengajuan_validasi,"","","hidden");
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
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Komponen Asesmen Mandiri</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 10%;">Penilaian<br>(Kompeten)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_asesmen'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_question']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_question']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($validasi > 0 AND $tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA TIDAK SETUJU HUBUNGI ASESOR DAN JANGAN KLIK DAHULU</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Konfirmasi
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
elseif ($page=="pengajuan_kompetensi_rencana")
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
<?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/rencana/'.$id,' id="signupform" ');
input_text("id_jenis_form",$id_jenis_form,"","","hidden");
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
                      <td style="vertical-align: top; font-size: 12pt;">Kualifikasi</td>
                      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
                      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_jabatan_fungsional ?></td>
                    </tr>
                    <tr>
                      <td style="vertical-align: top; font-size: 12pt;">Tujuan Asesmen</td>
                      <td style="vertical-align: top; text-align: center;font-size: 12pt;">:</td>
                      <td style="vertical-align: top; font-size: 12pt;"><?= $nama_status_diusulkan ?></td>
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
                      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;">KODE UNIT</td>
                      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;"><?= $rowambil_nkr_kompetensi['kode_unit'] ?></td>
                    </tr>
                    <tr>
                      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;">JUDUL UNIT</td>
                      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;"><?= $rowambil_nkr_kompetensi['nama_kompetensi'] ?></td>
                    </tr>
                    <tr>
      <td colspan="2" class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;text-align: left;padding: 7pt;">
        STANDAR KOMPETENSI DAN SPO
      </td>
                    </tr>
                    <?php

$nkr_kewenangan=$this->m_kredensial->ambil_nkr_kewenangan_dari_nkr_kompetensi($id_pengajuan,$rowambil_nkr_kompetensi["id_kompetensi"]);
                      foreach($nkr_kewenangan as $rownkr_kewenangan){
                        
                    ?>
                    <tr>
                      <td class="px" style="vertical-align: top; text-align: left;font-size: 12pt;padding-left: 15pt;">&nbsp;</td>
                      <td colspan="2" class="px" style="vertical-align: top; text-align: left;font-size: 12pt;padding-left: 15pt;"><?= $rownkr_kewenangan['nama_kewenangan'] ?></td>
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
                  $detil_asesmen = $this->m_kredensial->ambil_asesmen_nkr_elemen_validasi($barcode_pengajuan_validasi,$rowdetil_elemen['id_elemen']);
                    foreach($detil_asesmen as $rowdetil_asesmen){
                      $detil_indikator = $this->m_kredensial->ambil_indikator_nkr_form_validasi_detil($barcode_pengajuan_validasi,$rowdetil_asesmen['id_asesmen']);
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
              if(!empty($rowindikator['metode_indikator']) || !empty($rowdetil_indikator['perangkat_indikator'])){
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
              </td>
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($validasi > 0 AND $tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA TIDAK SETUJU HUBUNGI ASESOR DAN JANGAN KLIK DAHULU</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Konfirmasi
              </button>          
          </div>
          <?php  
              }
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/observasi/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
    input_text("barcode_pengajuan_validasi",$barcode_pengajuan_validasi,"","","hidden");
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
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Komponen Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 10%;">Pencapaian<br>(YA)</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){      
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowform2_detil['id_indikator'],"","","hidden"); ?>
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_asesmen'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($validasi > 0 AND $tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA TIDAK SETUJU HUBUNGI ASESOR DAN JANGAN KLIK DAHULU</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Konfirmasi
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/lisan/'.$id,' id="signupform" ');
input_text("id_jenis_form",$id_jenis_form,"","","hidden");
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
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Pertanyaan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Jawaban Asesi</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Pencapaian</th>
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
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;padding-left: 35pt;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['pertanyaan_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= html_entity_decode($rowform2_detil['jawaban_validasi_detil']) ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($validasi > 0 AND $tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA TIDAK SETUJU HUBUNGI ASESOR DAN JANGAN KLIK DAHULU</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Konfirmasi
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/tulis/'.$id,' id="signupform" ');
input_text("id_jenis_form",$id_jenis_form,"","","hidden");
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
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 20%;">Indikator Unjuk Kerja</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 20%;">Pertanyaan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;">Jawaban Asesi</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 5%;">Pencapaian</th>
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
        <?php input_text("chk[]",$rowform2_detil['id_validasi_detil'],"","","hidden"); ?>
        <?php input_text("jenis_soal[]",$rowform2_detil['jenis_soal'],"","","hidden"); ?>
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_indikator'] ?></td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['pertanyaan_indikator'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: left; font-size: 12pt;">
      <div class="form-group">
      <?php
      if($rowform2_detil['jenis_soal'] == 0){
input_textareacustom("jawaban_validasi_detil[]",$rowform2_detil['jawaban_validasi_detil']," id='editor".$no."' rows='1' cols='10' class='form-control' ","Jawaban Asesi");
      }else{ 
        $soal = $this->m_kredensial->ambil_soal_opsi($rowform2_detil['id_indikator']);
          $no;
        if($rowform2_detil['jenis_soal'] == 1){
          foreach($soal as $rowsoal){
            if(in_array($rowsoal['id_soal_opsi'],explode(",", $rowform2_detil['jawaban_validasi_detil']))){
              $terpilih = "checked='checked'"; 
              }else{ 
              $terpilih = '';
              }
      ?>
      <label>
        <input type="radio" name="jawaban_validasi_detil[]" value="<?=$rowsoal['id_soal_opsi'] ?>" <?= $terpilih ?> class="minimal">&nbsp;&nbsp; <?= $rowsoal['nama_soal_opsi'] ?>
      </label><br>
      <?php
          }
        }
        if($rowform2_detil['jenis_soal'] == 2){ // ganda
          foreach($soal as $rowsoal){
            if(in_array($rowsoal['id_soal_opsi'],explode(",", $rowform2_detil['jawaban_validasi_detil']))){
              $terpilih = "checked='checked'"; 
              }else{ 
              $terpilih = '';
              }
      ?>
      <label>
      <input type="checkbox" name="jawaban_validasi_detil[]" value="<?=$rowsoal['id_soal_opsi'] ?>" <?= $terpilih ?> class="minimal">&nbsp;&nbsp; <?= $rowsoal['nama_soal_opsi'] ?>
      </label><br>
      <?php
          }                
        }
      }
        ?>
      </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator']; ?>_2_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator']."_2_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}
                  elseif($validasi == 0){ echo '<span style="color:orange;font-weight:bold;">Proses</span>'; }else{echo '<span style="color:danger;font-weight:bold;">Tidak Lanjut</span>';}
                  ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($locked == 1){
          ?>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button> 
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Selesai Lanjut Penilaian
              </button>          
          </div>
          <?php  
              }
              if($locked == 3){
          ?>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnKonfirmasi" class="btn btn-app">
                <i class="fa fa-save"></i> Konfirmasi
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/portofolio/'.$id,' id="signupform" ');
input_text("id_jenis_form",$id_jenis_form,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("barcode_pengajuan_validasi",$barcode_pengajuan_validasi,"","","hidden");
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
                <h3 class="box-title">STANDAR KOMPETENSI DAN SPO</h3>           
                  <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                  </div>
            </div>
            <div class="box-body">


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
      <td class="px-3 py" colspan="6" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_asesmen'] ?></td>
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($validasi > 0 AND $tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA TIDAK SETUJU HUBUNGI ASESOR DAN JANGAN KLIK DAHULU</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Konfirmasi
              </button>          
          </div>
          <?php  
              }
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/konsultasi/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
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
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" colspan="2" style="vertical-align: middle; text-align: center;font-size: 12pt;">Kegiatan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 10%;">Pencapaian</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){      
    ?>
    <tr>
      <th class="px" colspan="4" style="vertical-align: middle; text-align: left;font-size: 12pt;">
        <?= $rowform2_detil['nama_pra_asesmen'] ?>
      </th>
    </tr>
    <?php 
       $ambil_nkr_pra_detil = $this->m_kredensial->ambil_validasi_nkr_pra_detil($barcode_pengajuan_validasi,$rowform2_detil['barcode_pra_asesmen']);   
      foreach($ambil_nkr_pra_detil as $rowambil_nkr_pra_detil){
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowambil_nkr_pra_detil['id_pra_detil'],"","","hidden"); ?>
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;width: 5%;">&nbsp;</td>
      <td class="px" style="font-weight: bold;font-size: 12pt;"><?= $rowambil_nkr_pra_detil['nama_pra_detil'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_nkr_pra_detil['id_pra_detil']; ?>_8_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowambil_nkr_pra_detil['id_pra_detil']."_8_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($validasi > 0 AND $tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA TIDAK SETUJU HUBUNGI ASESOR DAN JANGAN KLIK DAHULU</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Konfirmasi
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/cek/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
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
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;display: none;"></th>
      <th class="px" colspan="2" style="vertical-align: middle; text-align: center;font-size: 12pt;">Kegiatan</th>
      <th class="px" style="vertical-align: middle; text-align: center;font-size: 12pt;width: 10%;">Pencapaian</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($form2_detil as $rowform2_detil){      
    ?>
    <tr>
      <th class="px" colspan="4" style="vertical-align: middle; text-align: left;font-size: 12pt;">
        <?= $rowform2_detil['nama_pra_asesmen'] ?>
      </th>
    </tr>
    <?php 
       $ambil_nkr_pra_detil = $this->m_kredensial->ambil_validasi_nkr_pra_detil($barcode_pengajuan_validasi,$rowform2_detil['barcode_pra_asesmen']);
      foreach($ambil_nkr_pra_detil as $rowambil_nkr_pra_detil){
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: top; font-size: 12pt;display: none;">
        <?php input_text("chk[]",$rowambil_nkr_pra_detil['id_pra_detil'],"","","hidden"); ?>
      </td>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;width: 5%;">&nbsp;</td>
      <td class="px" style="font-weight: bold;font-size: 12pt;"><?= $rowambil_nkr_pra_detil['nama_pra_detil'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_nkr_pra_detil['id_pra_detil']; ?>_8_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowambil_nkr_pra_detil['id_pra_detil']."_8_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($validasi > 0 AND $tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA TIDAK SETUJU HUBUNGI ASESOR DAN JANGAN KLIK DAHULU</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Konfirmasi
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/keputusan/'.$id,' id="signupform" ');
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
      $detil = $this->m_kredensial->ambil_validasi_detil_grup_form7($barcode_pengajuan,'nvd.id_indikator','nvd.id_indikator','ASC','nas.id_elemen',$rowform2_detil['id_elemen']);
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
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104A_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104A_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104B_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104B_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104C_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104C_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_104D_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_104D_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_indikator'].$no; ?>_10K_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_indikator'].$no."_10K_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> onclick="return false;" type="checkbox">
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
              </div>
            </div>
          </div>
          <?php  
            if($status_pengajuan == 1){
              if($validasi > 0 AND $tgl_asesi == NULL){
          ?>
          <div class="box-footer">
            <label>JIKA TIDAK SETUJU HUBUNGI ASESOR DAN JANGAN KLIK DAHULU</label><br>
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Konfirmasi
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/banding/'.$id,' id="signupform" ');
    input_text("id_jenis_form",$id_jenis_form,"","","hidden");
    input_text("id_kompetensi",$id_kompetensi,"","","hidden");
    input_text("id_instansi",$id_instansi,"","","hidden");
input_text("barcode_form",$barcode_form,"","","hidden");
input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
input_text("barcode_pengajuan_validasi",$barcode_pengajuan_validasi,"","","hidden");
input_text("status_pengajuan",$status_pengajuan,"","","hidden");
input_text("tgl_asesi",$tgl_asesi,"","","hidden");
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
        <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">Banding ini diajukan atas alasan sebagai berikut :</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <?php
            if($locked < 3){
              input_textareacustom("banding_asesi",$banding_asesi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            }
            ?>   
          </div>
          <?php  
            if($status_pengajuan == 1){
           //   if($validasi == 0){
                if($locked < 2){
          ?>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
               <button type="submit" name="action" value="BtnKonfirmasi" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut Ke Konfirmasi Asesor
              </button>   
          </div>
          <?php  
                }
                if($locked == 3){
          ?>
          <div class="box-footer">
              <label>Jika Klik Ini Asesi Menyentujui Hasil Banding</label><br>     
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Setuju
              </button>   
          </div>
          <?php

                }
        //      }
            }
          ?>
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}elseif($validasi == 0){ echo '<span style="color:blue;font-weight:bold;">Proses</span>'; }else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi.'<br><label>Catatan Asesi</label><br>';
                $banding_asesi = html_entity_decode($banding_asesi);
                echo $banding_asesi;
              ?>
              </div>
            </div>
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/komponen/'.$id,' id="signupform" ');
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
         input_text("id_validasi_detil[]",$rowform2_detil['id_validasi_detil'],"","","hidden"); 
    ?>
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_kaji_ulang'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
        <div class="checkbox">
          <label>
          <input name="kesesuaian_bukti[]" value="<?php echo $rowform2_detil['id_kaji_ulang']; ?>_12_<?php echo $barcode_pengajuan; ?>" <?php if(in_array($rowform2_detil['id_kaji_ulang']."_12_".$barcode_pengajuan,$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
          </label>
        </div>
      </td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
  <?php
    input_textareacustom("komentar_kesenjangan[]",$rowform2_detil['komentar_kesenjangan']," id='editor".$no."' rows='3' cols='20' class='form-control' ","Jawaban Asesi");
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
          <?php  
            if($status_pengajuan == 1){
             if($locked == 1){
          ?>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
               <button type="submit" name="action" value="BtnKonfirmasi" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut Ke Konfirmasi Asesor
              </button>   
          </div>
          <?php  
             }
                if($locked == 3){
          ?>
          <div class="box-footer">
              <label>Jika Klik Ini Asesi Menyentujui Hasil</label><br>     
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Setuju
              </button>   
          </div>
          <?php

                }
            }
          ?>
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}elseif($validasi == 0){ echo '<span style="color:blue;font-weight:bold;">Proses</span>'; }else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
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
  <?php echo form_open_multipart('ol_pengajuan/pengajuan_kompetensi/kesenjangan/'.$id,' id="signupform" ');
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
    $no = 0;
    foreach($form as $rowform2_detil){   
         
    ?>
     <tr>
      <td class="px py bg-dark" colspan="7" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowform2_detil['nama_kat_kaji'] ?>
      </td>
    </tr>
    <?php 
    
  $detil = $this->m_kredensial->ambil_kaji_ulang_nkr_form_validasi_detil($barcode_pengajuan_validasi,$rowform2_detil['id_kat_kaji']);
        foreach($detil as $rowdetil){ 
          $no++;
    if($rowdetil['komentar_kesenjangan'] == ""){
      $komentar_kesenjangan = "Valid : Tidak Ada Kesenjangan<br>Reliabel : Tidak Ada Kesenjangan<br>Flexible : Tidak Ada Kesenjangan<br>Fair : Tidak Ada Kesenjangan";
    }else{
      $komentar_kesenjangan = $rowdetil['komentar_kesenjangan'];
    }
          input_text("id_validasi_detil[]",$rowdetil['id_validasi_detil'],"","","hidden"); 
    ?>   
    <tr>
      <td class="px" style="font-weight: bold; vertical-align: middle; font-size: 12pt;"><?= $rowdetil['nama_kaji_ulang'] ?></td>
      <td class="px" style="vertical-align: middle;text-align: center; font-size: 12pt;">
  <?php
    input_textareacustom("komentar_kesenjangan[]",$komentar_kesenjangan," id='editor".$no."' rows='3' cols='20' class='form-control' ","Jawaban Asesi");
  ?>
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
          <?php  
            if($status_pengajuan == 1){
             if($locked == 1){
          ?>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
               <button type="submit" name="action" value="BtnKonfirmasi" class="btn btn-app">
                <i class="fa fa-check"></i> Lanjut Ke Konfirmasi Asesor
              </button>   
          </div>
          <?php  
             }
                if($locked == 3){
          ?>
          <div class="box-footer">
              <label>Jika Klik Ini Asesi Menyentujui Hasil</label><br>     
               <button type="submit" name="action" value="BtnSetuju" class="btn btn-app">
                <i class="fa fa-check"></i> Setuju
              </button>   
          </div>
          <?php

                }
            }
          ?>
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
            <div class="row" style="font-size:14pt;">
              <div class="col-md-12">
                <?php if($tgl_asesor){ echo $this->m_rancak->fullBulantime(date('d-m-Y H:i:s', strtotime($tgl_asesor))); } ?> <br>
                <label>Asesor</label> : <?= $nama_asesor ?> <br>
                <label>Validasi</label> : 
                <?php if($validasi == 1){ echo '<span style="color:green;font-weight:bold;">Lanjut</span>';}elseif($validasi == 0){ echo '<span style="color:blue;font-weight:bold;">Proses</span>'; }else{ echo '<span style="color:red;font-weight:bold;">Tidak Lanjut</span>'; } ?><br>
               <label>Catatan Asesor</label><br>
                <?php 
                $ket_pengajuan_validasi = html_entity_decode($ket_pengajuan_validasi);
                echo $ket_pengajuan_validasi 
              ?>
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