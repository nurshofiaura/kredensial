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
    <a href="<?php echo base_url('landing/#validasi');?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a> 
    </section>
    <section class="content">
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
            <th>Instansi</th>
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
elseif ($page=="pengajuan_kompetensi_seting")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('s_kompetensi/pengajuan_kompetensi');?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
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
                <th style="display;none;width: 5%;"></th>
                <th>Jabatan</th>
                <th>Validator</th>
                <th>Jabatan Validator</th>
                <th>Instansi Validator</th>
                <th>Result</th>
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
elseif ($page=="pengajuan_kompetensi_isi_validator")
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
    <a href="<?php echo base_url('s_kompetensi/pengajuan_kompetensi/seting/'.$barcode_pengajuan);?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
  <?php echo form_open_multipart('s_kompetensi/pengajuan_kompetensi/isi_validator/'.$id.'/'.$id2,' id="signupform" ');
  input_text("barcode_pengajuan_validasi",$id,"","","hidden");
  input_text("barcode_working",$id2,"","","hidden");
  input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
  ?>

  <?php echo form_close(); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
          <div class="box-tools pull-right">
      <?php
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Struktur</th>
            <th>NIP</th>
            <th>JabFung</th>
            <th>PK</th>
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
elseif ($page=="pengajuan_kompetensi_pelatihan_validator")
{
?>
      <div class="row">
        <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Nama Pelatihan</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Jenis</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Kategori</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Tgl Awal</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Tgl Selesai</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_struktur_lihat_pelatihan as $row){
                ?>
              <tr>
                <td style="text-align:left;"><?php echo $row['nama_berkas']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_kategori_berkas']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_kategori_pelatihan']; ?></td>
                <td style="text-align:center;"><?php echo date('d-m-Y', strtotime($row['tgl_a_berkas'])) ?></td>
                <td style="text-align:center;"><?php echo date('d-m-Y', strtotime($row['tgl_b_berkas'])) ?></td>
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
    </FORM>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
    var table =  $('#example1').DataTable({
      $('#modal-default').css( 'display', 'block' );
      table.columns.adjust().draw();
      'paging'        : false,
      'lengthChange'  : false,
      'searching'     : false,
      'ordering'      : false,
      'info'          : true,
//    'scrollX'     : true,
//    'scrollY'     : '500px',
    'scrollCollapse'  : true
    })
      });
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_validasi")
{
?>
<style>
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  table td {
    word-wrap: break-word;
  }
</style>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('s_kompetensi/pengajuan_kompetensi');?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
    <?php echo form_open_multipart('s_kompetensi/pengajuan_kompetensi/validasi/'.$id.'/'.$id2.'/'.$id3,' id="signupform" '); ;
        $url_thumbx=base_url().'assets/images/noavatar.jpg';
        $url_picbesarx=base_url().'assets/images/noavatar.jpg';
    ?>
    <div class="row">
      <div class="col-md-4">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PROFIL</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
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
                <strong><i class="fa fa-map-user-md margin-r-5"></i> Jabatan Fungsional</strong>
                <p class="text-muted">
                <?php echo $nama_jabatan_fungsional; ?>
              </p>
                <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
                <p class="text-muted">
                <?php echo $alamat; ?>            
                </p> 
                <strong><i class="fa fa-hospital-o margin-r-5"></i> Unit / Ruangan</strong>    
          </div>
        </div>  
      </div>  
      <div class="col-md-8">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">BERKAS DAN ETIK</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                <th rowspan="2" style="vertical-align:middle;text-align:center;background: #800000;color:white;width:10%;">PILIH</th>
                <th rowspan="2" style="vertical-align:middle;text-align:center;background: #800000;color:white;">Nama Berkas</th>
                <th colspan="4" style="vertical-align:middle;text-align:center;background: #800000;color:white;">KESESUAIAN BUKTI </th>
                </tr>
                <tr>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Tersedia</th>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Shahih</th>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Asli</th>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Terkini</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> IJASAH</td>
                  </tr>
                  <?php
                  if(!empty($id_ijasah)){
                    foreach($ambil_berkas_data as $row){
                      if (in_array($row['id_berkas'],$id_ijasah)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_ijasah[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/sample/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_1" <?php if(in_array($row['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_2" <?php if(in_array($row['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_3" <?php if(in_array($row['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_4" <?php if(in_array($row['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> STR</td>
                  </tr>
                  <?php
                  if($id_str!==""){
                    foreach($ambil_berkas_data as $row2){
                      if (in_array($row2['id_berkas'],$id_str)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_str[]" value="<?php echo $row2['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/sample/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row2['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_1" <?php if(in_array($row2['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_2" <?php if(in_array($row2['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_3" <?php if(in_array($row2['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_4" <?php if(in_array($row2['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> SERTIFIKAT </td>
                  </tr>
                  <?php
                  if($id_sertifikat!==""){
                    foreach($ambil_berkas_data as $row3){
                      if (in_array($row3['id_berkas'],$id_sertifikat)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/sample/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row3['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_1" <?php if(in_array($row3['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_2" <?php if(in_array($row3['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_3" <?php if(in_array($row3['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_4" <?php if(in_array($row3['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> Berkas Lainnya</td>
                  </tr>
                  <?php
                //  if($id_ijasah!==""){
                  if(!empty($id_berkas)){
                    foreach($ambil_berkas_data as $row){
                      if (in_array($row['id_berkas'],$id_berkas)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_berkas[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/sample/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_1" <?php if(in_array($row['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_2" <?php if(in_array($row['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_3" <?php if(in_array($row['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_4" <?php if(in_array($row['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-book"></i> LOGBOOK</td>
                  </tr>
                  <tr>
                  <td colspan="2" style="vertical-align:middle;text-align:center;">LOGBOOK BISA LIHAT GRAFIK </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="9" <?php if(in_array("9",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="10" <?php if(in_array("10",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="11" <?php if(in_array("11",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="12" <?php if(in_array("12",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  </tr>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-o"></i> ETIK PEGAWAI</td>
                  </tr>
                  <tr>
                  <td colspan="6">
                    <table width="100%" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Tanggal</th>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Hasil</th>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Penguji</th>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;"><i class="fa fa-search"></i></th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Tersedia</th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Shahih</th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Asli</th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Terkini</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
                          if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$id_etik_pegawai)) {
                      ?>
                        <tr>
                        <td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
                        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
                        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
                        <td style="vertical-align:middle;text-align:center;">

                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik1" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik2" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik3" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td style="vertical-align:middle;text-align:center;">
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
                  </td>
                  </tr>
              </tbody>
            </table>
            <!-- /.table -->
            </div>
          </div>
          <div class="box-footer">
            <div class="mailbox-controls">
            <!-- Check all button -->
                <div class="pull-right">
                  <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT BERKAS DAN UNCHECK UNTUK <i class="fa fa-trash"></i> MEMBUANG BERKAS
                  </button>
                </div>
            <!-- /.pull-right -->
            </div>
              <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>
          </div>
        </div>    
      </div>  
      <div class="col-md-12">
      <div class="col-md-8">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">VALIDASI DATA LOGBOOK</h3>

            <div class="box-tools pull-right">
              <?php
        //        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
              ?>
            </div>
          </div>
          <div class="box-body">
              <table id="dttb2" width="100%" class="table table-bordered table-striped table-hover" >
                <thead>
                  <tr>
                    <th style="display:none;width:5%;"></th>
                    <th>Kewenangan</th>
                  </tr>
                </thead>
              </table>
          </div>
        </div>    
      </div>  
      <div class="col-md-4">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
  <h3 class="box-title">DAFTAR SEMUA KOMPETENSI</h3>           
                <div class="box-tools pull-right">

                </div>
          </div>
          <div class="box-body">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Kewenangan</th>
                <th style="background-color:#9b0e27;color:white;text-align:right;">Jumlah</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_lobook_kompetensi_group_pengajuan as $row){
                ?>
              <tr>
                <td style="text-align:left;"><?php echo $row['nama_kewenangan']; ?></td>
                <td style="text-align:right;"><?php echo $row['num']; ?></td>
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
  <h3 class="box-title">DAFTAR KOMPETENSI TERVALIDASI</h3>           
                <div class="box-tools pull-right">

                </div>
          </div>
          <div class="box-body">
            <table id="example2" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;" rowspan="2">Waktu</th>
                <th style="background-color:#9b0e27;color:white;text-align:left;vertical-align: middle;" rowspan="2">Kewenangan</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;" rowspan="2">Jabatan</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;" rowspan="2">Nama</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;" rowspan="2">Hasil</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;" rowspan="2">Result Tolak</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;" colspan="3">Rubah Hasil</th>
              </tr>
              <tr>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Setuju</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Supervisi</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Tidak Kompeten</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_lobook_validasi_group_pengajuan as $row){
                ?>
              <tr>
                <td style="text-align:center;"><?php echo date('d-m-Y H:i:s', strtotime($row['wkt_logbook_validasi'])); ?></td>
                <td style="text-align:left;"><?php echo $row['nama_kewenangan']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_ms_struktur']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_pegawai']; ?></td>
                <td style="text-align:center;">
                  <?php  
                    if($row['validasi'] == 1){
                      echo '<button class="btn btn-xs btn-warning"> Setuju</button>';
                    }elseif($row['validasi'] == 2){
                      echo '<button class="btn btn-xs btn-danger"> Tolak</button>';
                    }else{
                      echo '<button class="btn btn-xs btn-success"> Proses</button>';
                    }
                  ?>
                </td>
                <td style="text-align:center;">
                  <?php  
                    if($row['result_tolak'] == 1){
                      echo '<button class="btn btn-xs btn-danger"> Supervisi</button>';
                    }elseif($row['result_tolak'] == 2){
                      echo '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
                    }else{
                      echo '';
                    }
                  ?>
                </td>
                <td style="text-align:center;">
<a href="<?php echo base_url('s_kompetensi/pengajuan_kompetensi/rubah_validasi');?>/<?= $id ?>/<?= $id2 ?>/<?= $id3 ?>/1/0/<?= $row['id_kewenangan'] ?>/<?= $row['id_pegawai_struktur'] ?>"  class="btn btn-success btn-xs">
  <i class="fa fa-check"></i>
  
</a>
                </td>
                <td style="text-align:center;">
<a href="<?php echo base_url('s_kompetensi/pengajuan_kompetensi/rubah_validasi');?>/<?= $id ?>/<?= $id2 ?>/<?= $id3 ?>/2/1/<?= $row['id_kewenangan'] ?>/<?= $row['id_pegawai_struktur'] ?>"  class="btn btn-danger btn-xs">
  <i class="fa fa-close"></i>
  
</a>
                </td>
                <td style="text-align:center;">
<a href="<?php echo base_url('s_kompetensi/pengajuan_kompetensi/rubah_validasi');?>/<?= $id ?>/<?= $id2 ?>/<?= $id3 ?>/2/2/<?= $row['id_kewenangan'] ?>/<?= $row['id_pegawai_struktur'] ?>"  class="btn btn-danger btn-xs">
  <i class="fa fa-close"></i>
  
</a>
                </td>
              </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
              <a href="<?php echo base_url('s_kompetensi/pengajuan_kompetensi/rubah_pengajuan');?>/<?= $id ?>/<?= $id2 ?>/<?= $id3 ?>/1" class="btn btn-app">
                <i class="fa fa-check"></i> Simpan & Setuju
              </a>
              <a href="<?php echo base_url('s_kompetensi/pengajuan_kompetensi/rubah_pengajuan');?>/<?= $id ?>/<?= $id2 ?>/<?= $id3 ?>/2" class="btn btn-app">
                <i class="fa fa-close"></i> Simpan & Tolak
              </a>
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
elseif ($page=="pengajuan_kompetensi_lihat")
{
?>
<style>
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  table td {
    word-wrap: break-word;
  }
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <a href="<?php echo $link_kembali;?>"
          class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
        </a>
      </h1>
    </section>
    <section class="content">
    <?php echo form_open_multipart('kompetensi/pengajuan_kompetensi/validasi/'.$id.'/'.$id2.'/'.$id3,' id="signupform" '); ;
      if(empty($foto)){
        $url_thumbx=base_url().'assets/images/noavatar.jpg';
        $url_picbesarx=base_url().'assets/images/noavatar.jpg';
      }else{
        $cek_filesmall=FCPATH.'assets/foto/member/small/'.$foto;
        if(file_exists($cek_filesmall)){
          $url_thumbx=base_url().'assets/foto/member/small/'.$foto;
          $url_picbesarx=base_url().'assets/foto/member/original/'.$foto;
        }else{
          $url_thumbx=base_url().'assets/images/noavatar.jpg';
          $url_picbesarx=base_url().'assets/images/noavatar.jpg';
        }
      }
    ?>
    <div class="row">
      <div class="col-md-4">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PROFIL</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
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
                <strong><i class="fa fa-map-user-md margin-r-5"></i> Jabatan Fungsional</strong>
                <p class="text-muted">
                <?php echo $nama_jabatan_fungsional; ?>
              </p>
                <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
                <p class="text-muted">
                <?php echo $alamat; ?>            
                </p> 
                <strong><i class="fa fa-hospital-o margin-r-5"></i> Unit / Ruangan</strong>
                <p class="text-muted">
                  <ul>
                <?php 
                $kondisi=array('id_pegawai'=>$id_pegawai,'id_instansi'=>$id_instansi);
                  $unite = $this->m_umum->ambil_data_kondisi_2tabel_result('ol_pegawai_unit',$kondisi,'ol_unit','id_unit');
                  foreach($unite as $rowunite){
                    echo '<ol>'.$rowunite['nama_unit'].'</ol>';
                  }
                ?>
                  </ul>
                </p>     
          </div>
        </div>  
      </div>  
      <div class="col-md-8">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">BERKAS DAN ETIK</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                <th rowspan="2" style="vertical-align:middle;text-align:center;background: #800000;color:white;width:10%;">PILIH</th>
                <th rowspan="2" style="vertical-align:middle;text-align:center;background: #800000;color:white;">Nama Berkas</th>
                <th colspan="4" style="vertical-align:middle;text-align:center;background: #800000;color:white;">KESESUAIAN BUKTI </th>
                </tr>
                <tr>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Tersedia</th>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Shahih</th>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Asli</th>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Terkini</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> IJASAH</td>
                  </tr>
                  <?php
                  if(!empty($id_ijasah)){
                    foreach($ambil_berkas_data as $row){
                      if (in_array($row['id_berkas'],$id_ijasah)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_ijasah[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/sample/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_1" <?php if(in_array($row['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_2" <?php if(in_array($row['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_3" <?php if(in_array($row['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_4" <?php if(in_array($row['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> STR</td>
                  </tr>
                  <?php
                  if($id_str!==""){
                    foreach($ambil_berkas_data as $row2){
                      if (in_array($row2['id_berkas'],$id_str)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_str[]" value="<?php echo $row2['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/sample/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row2['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_1" <?php if(in_array($row2['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_2" <?php if(in_array($row2['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_3" <?php if(in_array($row2['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_4" <?php if(in_array($row2['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> SERTIFIKAT </td>
                  </tr>
                  <?php
                  if($id_sertifikat!==""){
                    foreach($ambil_berkas_data as $row3){
                      if (in_array($row3['id_berkas'],$id_sertifikat)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/sample/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row3['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_1" <?php if(in_array($row3['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_2" <?php if(in_array($row3['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_3" <?php if(in_array($row3['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_4" <?php if(in_array($row3['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> Berkas Lainnya</td>
                  </tr>
                  <?php
                //  if($id_ijasah!==""){
                  if(!empty($id_berkas)){
                    foreach($ambil_berkas_data as $row){
                      if (in_array($row['id_berkas'],$id_berkas)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_berkas[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/sample/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_1" <?php if(in_array($row['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_2" <?php if(in_array($row['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_3" <?php if(in_array($row['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_4" <?php if(in_array($row['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-book"></i> LOGBOOK</td>
                  </tr>
                  <tr>
                  <td colspan="2" style="vertical-align:middle;text-align:center;">LOGBOOK BISA LIHAT GRAFIK </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="9" <?php if(in_array("9",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="10" <?php if(in_array("10",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="11" <?php if(in_array("11",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="12" <?php if(in_array("12",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  </tr>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-o"></i> ETIK PEGAWAI</td>
                  </tr>
                  <tr>
                  <td colspan="6">
                    <table width="100%" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Tanggal</th>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Hasil</th>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Penguji</th>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;"><i class="fa fa-search"></i></th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Tersedia</th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Shahih</th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Asli</th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Terkini</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
                          if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$id_etik_pegawai)) {
                      ?>
                        <tr>
                        <td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
                        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
                        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
                        <td style="vertical-align:middle;text-align:center;">

                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik1" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik2" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik3" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td style="vertical-align:middle;text-align:center;">
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
                  </td>
                  </tr>
              </tbody>
            </table>
            <!-- /.table -->
            </div>
          </div>
          <div class="box-footer">
            <div class="mailbox-controls">
            <!-- Check all button -->
                <div class="pull-right">
                  <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT BERKAS DAN UNCHECK UNTUK <i class="fa fa-trash"></i> MEMBUANG BERKAS
                  </button>
                </div>
            <!-- /.pull-right -->
            </div>
          </div>
        </div>    
      </div>       
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
  <h3 class="box-title">DAFTAR KOMPETENSI TERVALIDASI</h3>           
                <div class="box-tools pull-right">

                </div>
          </div>
          <div class="box-body">
            <table id="example2" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Waktu</th>
                <th style="background-color:#9b0e27;color:white;text-align:left;vertical-align: middle;">Kewenangan</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Jabatan</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Nama</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Hasil</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Result Tolak</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_lobook_validasi_group_pengajuan as $row){
                ?>
              <tr>
                <td style="text-align:center;"><?php echo date('d-m-Y H:i:s', strtotime($row['wkt_logbook_validasi'])); ?></td>
                <td style="text-align:left;"><?php echo $row['nama_kewenangan']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_ms_struktur']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_pegawai']; ?></td>
                <td style="text-align:center;">
                  <?php  
                    if($row['validasi'] == 1){
                      echo '<button class="btn btn-xs btn-warning"> Setuju</button>';
                    }elseif($row['validasi'] == 2){
                      echo '<button class="btn btn-xs btn-danger"> Tolak</button>';
                    }else{
                      echo '<button class="btn btn-xs btn-success"> Proses</button>';
                    }
                  ?>
                </td>
                <td style="text-align:center;">
                  <?php  
                    if($row['result_tolak'] == 1){
                      echo '<button class="btn btn-xs btn-danger"> Supervisi</button>';
                    }elseif($row['result_tolak'] == 2){
                      echo '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
                    }else{
                      echo '';
                    }
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
      </div>  
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
  <h3 class="box-title">DAFTAR SEMUA KOMPETENSI</h3>           
                <div class="box-tools pull-right">

                </div>
          </div>
          <div class="box-body">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Kewenangan</th>
                <th style="background-color:#9b0e27;color:white;text-align:right;">Jumlah</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_lobook_kompetensi_group_pengajuan as $row){
                ?>
              <tr>
                <td style="text-align:left;"><?php echo $row['nama_kewenangan']; ?></td>
                <td style="text-align:right;"><?php echo $row['num']; ?></td>
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
    </section>
</div>
<?php
}
elseif ($page=="spk")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo base_url('landing/#spk');?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
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
            <th>Nama Pegawai</th>
            <th>Kategori</th>
            <th><i class="fa fa-search"></i> Sub Kredensial</th>
            <th><i class="fa fa-search"></i> Sub Mutu</th>
            <th><i class="fa fa-search"></i> Sub Etika</th>
            <th><i class="fa fa-search"></i> Rekomendasi</th>
            <th>Status SPK</th>
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
elseif ($page=="spk_kelengkapan")
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
    <a href="<?php echo base_url('spk');?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
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
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
      <?php echo form_open_multipart('spk/spk/kelengkapan/'.$id,' id="signupform" ');
        input_text("id_pengajuan",$id_pengajuan,"","","hidden");
        input_text("id_status_diusulkan",$id_status_diusulkan,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Lampiran</label>
              <?php
                input_text("lampiran",$lampiran,"maxlength='255' ","Ketik","text");
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Nomor</label>
              <?php
                input_text("nomor",$nomor,"maxlength='255' ","Ketik","text");
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal</label>
              <?php
                input_calendar("tgl_nomor","tgl_nomor",$tgl_nomor,"Masukkan Tanggal","required");
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tentang</label>
              <?php
                input_text("tentang",$tentang,"maxlength='255' ","Ketik","text");
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Kewenangan Klinis / Area</label>
              <?php
                input_text("kewenangan_klinis",$kewenangan_klinis,"maxlength='255' ","Ketik","text");
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Ditetapkan</label>
              <?php
                input_text("ditetapkan",$ditetapkan,"maxlength='255' ","Ketik","text");
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal Ditetapkan</label>
              <?php
                input_calendar("tgl_ditetapkan","tgl_ditetapkan",$tgl_ditetapkan,"Masukkan Tanggal","required");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>KATEGORI KEWENANGAN</label>
              <?php
                input_text("kategori_kewenangan",$kategori_kewenangan," ","Ketik","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Direktur</label>
              <?php
                input_pdselect2("id_direktur",$cmd_ambil_direktur,$id_direktur);
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Pangkat (Untuk RS TNI / Polisi)</label>
              <?php
                input_text("pangkat",$pangkat,"maxlength='255' ","Ketik","text");
              ?>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}