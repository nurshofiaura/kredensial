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

        </div>
        <div class="box-footer">
          Footer
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengajuan_korespodensi")
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
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
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
            <th>Wilayah</th>
            <th>No Surat</th>
            <th>Status</th>
          </tr>
        </thead>
      </table>
        </div>
        <div class="box-footer">

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
elseif ($page=="pengajuan_korespodensi_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_korespodensi/pengajuan_korespodensi/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="pengcab_asal" value="<?= $pengcab_id; ?>">
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
          <label>Jenis Pengajuan</label>
<?php input_pdselect2("id_kategori",$ambil_data_surat_kategori,$id_kategori); ?>
<label>Tujuan</label>
<?php input_pdselect2("pengcab_tujuan",$ambil_data_pengcabnonull,$pengcab_tujuan); ?>
<label>Tempat Bekerja</label>
<?php input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi); ?>
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
                  <li>Siapkan file berkas yang diperlukan</li>
                  <li>Semua berkas di upload di menu berkas sesuai kategorinya (Surat Ijin, Seminar dll, Ijasah dan berkas lainnya) dalam format PDF</li>
                  <li>Semua berkas yang diupload tidak akan hilang dan dapat di download atau digunakan untuk keperluan lainnya</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-user bg-aqua"></i>
              <div class="timeline-item">
                <h3 class="timeline-header">Validasi</h3>
                <div class="timeline-body">
                <ul>
                  <li>Setelah semua lengkap kirim berkas dan tunggu balasan</li>
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
elseif ($page=="pengajuan_korespodensi_mutasi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_korespodensi/pengajuan_korespodensi/simpan_mutasi');?>" onClick="return cek();">
      <input type="hidden" name="id_kategori" value="1">
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
<label>Asal</label>
<?php input_pdselect2("pengcab_asal",$ambil_data_pengcabnonull,$pengcab_id); ?>
<label>Tujuan</label>
<?php input_pdselect2("pengcab_tujuan",$ambil_data_pengcabnonull,$pengcab_tujuan); ?>
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
                  <li>Siapkan file berkas yang diperlukan</li>
                  <li>Semua berkas di upload di menu berkas sesuai kategorinya (Surat Ijin, Seminar dll, Ijasah dan berkas lainnya) dalam format PDF</li>
                  <li>Semua berkas yang diupload tidak akan hilang dan dapat di download atau digunakan untuk keperluan lainnya</li>
                </ul>
                </div>
              </div>
              </li>
              <li>
              <i class="fa fa-user bg-aqua"></i>
              <div class="timeline-item">
                <h3 class="timeline-header">Validasi</h3>
                <div class="timeline-body">
                <ul>
                  <li>Setelah semua lengkap kirim berkas dan tunggu balasan</li>
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
elseif ($page=="pengajuan_korespodensi_isi")
{
  $arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','lightblue','blue','green','teal','lime','orange','fuchsia');
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
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;"></small>
       </h3>
        </div>
        <div class="box-body">
      <div class="row">
      <div class="col-md-4">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">
              <?php echo $title; ?> <small style="color:white;font-weight:bold;">  </small>
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
                <h3 class="profile-username" style="color:green;text-align:center;"><?php echo $nama_kategori; ?></h3>
                <div class="form-group">
                </div>
                <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <?php
                    if($status_korespodensi=="0"){
                  ?>
                      <a href="<?php echo base_url('ol_korespodensi/berkas_ijasah/view/'.$barcode_korespodensi);?>" class="btn bg-green btn-block btn-xs">
                      Pilih Ijasah</a>
                  <?php
                    }else{
                  ?>
                      <a class="btn bg-red btn-block btn-xs"> Ijasah</a>
                  <?php
                    }
                  ?>
                </li>
                <li class="list-group-item">
                  <?php
                    if($status_korespodensi=="0"){
                  ?>
                      <a href="<?php echo base_url('ol_korespodensi/berkas_str/view/'.$barcode_korespodensi);?>" class="btn bg-green btn-block btn-xs">
                      Pilih Surat Ijin</a>
                  <?php
                    }else{
                  ?>
                      <a class="btn bg-red btn-block btn-xs"> Surat Ijin</a>
                  <?php
                    }
                  ?>
                </li>
                <li class="list-group-item">
                  <?php
                    if($status_korespodensi=="0"){
                  ?>
                      <a href="<?php echo base_url('ol_korespodensi/berkas_sertifikat/view/'.$barcode_korespodensi);?>" class="btn bg-green btn-block btn-xs">
                      Pilih Sertifikat</a>
                  <?php
                    }else{
                  ?>
                      <a class="btn bg-red btn-block btn-xs"> Sertifikat</a>
                  <?php
                    }
                  ?>
                </li>
                <li class="list-group-item">
                  <?php
                    if($status_korespodensi=="0"){
                  ?>
                        <a href="<?php echo base_url('ol_korespodensi/berkaslain_berkas/view/'.$barcode_korespodensi);?>" class="btn bg-green btn-block btn-xs">
                        Pilih Berkas Lain</a>
                  <?php
                    }else{
                  ?>
                      <a class="btn bg-red btn-block btn-xs"> Berkas</a>
                  <?php
                    }
                  ?>
                </li>
                </ul>

                  <?php
                      echo form_open_multipart('ol_korespodensi/pengajuan_korespodensi/isi/'.$id,' ');
                      input_text("id_korespodensi",$id,"","","hidden");
                  if($status_korespodensi=="0"){
                  ?>

                    <button name="action" value="Btnsimpan" class="btn btn-primary btn-block">
                      <i class="fa fa-save"></i> <b>SIMPAN PENGAJUAN</b>
                    </button>
                   
                  <?php
                  }else{
                    ?>
                    <a class="btn bg-red btn-block"><i class="fa fa-send"></i> <b>PENGAJUAN SUDAH DIKIRIM</b></a>
                  <?php
                  }
                  echo form_close(); ?>
              </div>
            </div>
          </div>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
             BERKAS JIKA DIPERLUKAN <small style="color:white;font-weight:bold;"></small>
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
              ?>
                <tr>
                <td width="5%"><input name="id_4_ijasah[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox"></td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row['nama_berkas']; ?> - <?php echo $row['penyelenggara']; ?>
                  </a>
                </td>
                </tr>
              <?php
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
                  if (in_array($row2['id_berkas'],$id_str)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_str[]" value="<?php echo $row2['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row2['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">BERKAS</td>
            </tr>
              <?php
              if($sertifikat!==""){
                foreach($ambil_berkas_data as $row3){
                  if (in_array($row3['id_berkas'],$id_sertifikat)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row3['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              if($berkas!==""){
                foreach($ambil_berkas_data as $row4){
                  if (in_array($row4['id_berkas'],$id_berkas)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_berkas[]" value="<?php echo $row4['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row4['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row4['nama_berkas']; ?>
                  </a>
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
        <div class="col-md-8">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">PRINT SURAT</h3>

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
                <th>Nama</th>
                <th>Kategori</th>
                <th>Asal</th>
              </tr>
            </thead>
          </table>
            </div>
          </div>
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
              <div class="box-header with-border">
                 <h3 class="box-title">SYARAT DAN TIME LINE PENGAJUAN</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Syarat Pengajuan</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Time Line Pengajuan</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                      <h4>
                    <?php 
                              $syarat_kategori = strip_tags($syarat_kategori); 
                              $syarat_kategori = html_entity_decode($syarat_kategori); 
                              echo $syarat_kategori;  
                      ?>
                      </h4>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">



          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
            TIME LINE PENGAJUAN <small style="color:white;font-weight:bold;"></small>
            </h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- The time line -->
                  <ul class="timeline">
                    <li class="time-label">
                          <span class="bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
                            <i class="fa fa-envelope"></i> &nbsp;<?= strtoupper($nama_kategori) ?>
                          </span>
                    </li>
                    <li>
                      <i class="fa fa-file-text bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                      <div class="timeline-item">
                        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                          <div class="box-header with-border">
                             <h3 class="box-title">DATA SURAT</h3>
                            <div class="box-tools pull-right">ISI NO SURAT DAN SIFAT SURAT</div>
                          </div>
                          <div class="box-body">
                            <div class="form-group">
                              <label>No Surat</label>
                              <?php
                                echo $no_korespodensi;
                              ?>
                            </div>
                            <div class="form-group">
                          <?php
                            if ($sifat_surat === '3') {
                               echo '<a class="btn btn-xs btn-danger">SIFAT SURAT : SANGAT PENTING</a>';
                            } else if($sifat_surat === '1'){
                               echo '<a class="btn btn-xs btn-success">SIFAT SURAT : BIASA</a>';
                            } else if($sifat_surat === '2'){
                               echo '<a class="btn btn-xs btn-warning">SIFAT SURAT : PENTING</a>';
                            }else{
                              echo '<a class="btn btn-xs btn-danger">SIFAT SURAT : KOSONG</a>';
                            }
                          ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <i class="fa fa-user bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                      <div class="timeline-item">
                        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                          <div class="box-header with-border">
                             <h3 class="box-title">DATA PENGIRIM</h3>
                              <div class="box-tools pull-right"><i class="fa fa-clock-o"></i> <?= $wkt_korespodensi; ?></div>
                          </div>
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-8">
                                <p>Nama : <?php echo $nama_pengaju; ?></p>  
                                <p>Gender : <?= $jk; ?></p>        
                                <p>Umur : <?= $umur; ?></p>   
                                <p>Tempat Bekerja : <?= $tempat_kerja; ?></p>      
                              </div>
                              <div class="col-md-4">
                                  <a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
                                    data-lightbox="example-set" data-title="<?php echo $nama_pengaju; ?>">
                                    <img class="profile-user-img img-responsive img-circle"
                                      src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                                  </a>              
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                              <?php  
                                if ($status_korespodensi == 0) {
                                   echo '<button class="btn btn-xs btn-warning">STATUS : REGISTRASI</button>';
                                } else if($status_korespodensi == 1){
                                   echo '<button class="btn btn-xs btn-info">STATUS : PROSES</button>';
                                } else if($status_korespodensi == 2){
                                   echo '<button class="btn btn-xs btn-primary">STATUS : Validasi</button>';
                                } else if($status_korespodensi == 3){
                                   echo '<button class="btn btn-xs btn-success">STATUS : Selesai</button>';
                                } else {
                                   echo '<button class="btn btn-xs btn-danger">STATUS : Ditolak</button>';
                                }
                              ?>
                          </div>
                        </div>
                      </div>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-envelope bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                      <div class="timeline-item">
                        <div class="timeline-body">
                        </div>
                      </div>
                    </li>
                <?php
                  $ambil_kategori_tambah = $this->m_ol_rancak->ambil_kategori_tambah($id_korespodensi);
                  foreach($ambil_kategori_tambah as $rowambil_kategori_tambah){
                ?>
                    <li class="time-label">
                        <span class="bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
                           <?= $rowambil_kategori_tambah['nama_kategori']; ?>
                        </span>
                    </li>
                    <li>
                      <i class="fa fa-send bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>

                      <div class="timeline-item">
                          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                            <div class="box-header with-border">
                               <h3 class="box-title"><b><?= $rowambil_kategori_tambah['nama_kategori']; ?></b></h3>
                                <div class="box-tools pull-right"></div>
                            </div>
                            <div class="box-body">
                <?php
                  $ambil_kor_detil_pengcab = $this->m_ol_rancak->ambil_kor_detil_pengcab($rowambil_kategori_tambah['id_kor_kategori']);
                  foreach($ambil_kor_detil_pengcab as $rowambil_data_pengurus_pengcab){
                      if(empty($rowambil_data_pengurus_pengcab['foto'])){
                        $url_thumbxpp=base_url().'assets/images/noavatar.jpg';
                        $url_picbesarxpp=base_url().'assets/images/noavatar.jpg';
                      }else{
                        $cek_filesmall=FCPATH.'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                        if(file_exists($cek_filesmall)){
                          $url_thumbxpp=base_url().'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                          $url_picbesarxpp=base_url().'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                        }else{
                          $url_thumbxpp=base_url().'assets/images/noavatar.jpg';
                          $url_picbesarxpp=base_url().'assets/images/noavatar.jpg';
                        }
                      }
                ?>
                                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                                  <div class="box-header with-border">
                                     <h3 class="box-title">DATA VALIDATOR</h3>
                                      <div class="box-tools pull-right"><b><?= $rowambil_kategori_tambah['nama_kategori']; ?></b></div>
                                  </div>
                                  <div class="box-body">
                                  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                                    <div class="box-header with-border">
                                       <h3 class="box-title"><?= $rowambil_data_pengurus_pengcab['nama_pengcab']; ?></h3>
                                        <div class="box-tools pull-right"><i class="fa fa-clock-o"></i> <?= date('d-m-Y H:i:s', strtotime($rowambil_data_pengurus_pengcab['wkt_kor_detil'])); ?></div>
                                    </div>
                                    <div class="box-body">
                          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                            <div class="box-header with-border">
                               <h3 class="box-title"><?= $rowambil_data_pengurus_pengcab['nama_pegawai_pengurus']; ?></h3>
                                <div class="box-tools pull-right">
                          <?php  
                            if(!empty($rowambil_data_pengurus_pengcab['wkt_terbaca'])){
                              echo date('d-m-Y H:i:s', strtotime($rowambil_data_pengurus_pengcab['wkt_kor_detil']));
                            }
                          ?>
                                </div>
                            </div>
                            <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-8">
                                          <p>Disposisi : <?= $rowambil_data_pengurus_pengcab['disposisi']; ?></p>  
                          <?php
                            if($rowambil_data_pengurus_pengcab['acc'] == 0){
                              echo '<button class="btn btn-xs btn-warning"> Belum ACC</button>';
                            }else if($rowambil_data_pengurus_pengcab['acc'] == 1){
                              echo '<button class="btn btn-xs btn-success"> ACC</button>';
                            }else{
                              echo '<button class="btn btn-xs btn-danger"> Di Tolak</button>';
                            }
                          ?>      
                                        </div>
                                        <div class="col-md-4">
                                <a class="example-image-link" href="<?php echo $url_picbesarxpp; ?>"
                                  data-lightbox="example-set" data-title="<?php echo $rowambil_data_pengurus_pengcab['nama_pegawai']; ?>">
                                  <img class="profile-user-img img-responsive img-circle"
                                    src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                                </a>              
                                        </div>
                                      </div>
                            </div>
                          </div>
                                    </div>
                                  </div>
                                  </div>
                                </div> 
                <?php
                  }
                }
                ?>                                                                 
                            </div>
                          </div>
                      </div>
                    </li>
                    <li>
                      <i class="fa fa-clock-o bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                    </li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
            </div>
          </div>




                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
              </div>
              <div class="box-footer">

              </div>
            </div>
        </div>
      </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="berkas_ijasah")
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
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
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
elseif ($page=="berkas_sertifikat")
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
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
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
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
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
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
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