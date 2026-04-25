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
elseif ($page=="penolakan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_pemulihan/penolakan/view/'.$id,' id="signupform" '); ?>
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
                <th>Kewenangan</th>
                <th>Nama</th>
                <th>Instansi</th>
                <th>Result</th>
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
elseif ($page=="penolakan_pendaftaran")
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
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_pemulihan/penolakan/pendaftaran/'.$id,' id="signupform" '); 
    input_text("barcode_pegawai",$id,"","","hidden");
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">SILAHKAN PILIH PENANGGUNG JAWAB DAN RUANGAN</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Instansi Pegawai</label>
                <?php
                input_pdselect2fleksibel("id_instansi_pegawai","id_instansi_pegawai",$ambil_id_instansi_pegawai,"id_working","nama_working",$id_instansi_pegawai,"Silahkan Pilih Pegawai");
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Unit Pegawai</label>
                <?php
                  input_pdselect2("id_unit_pegawai",$cmd_id_unit_pegawai,$id_unit_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label>Tanggal Mulai</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"","required");
              ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label>Tanggal Selesai</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"","required");
              ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Instansi Kegiatan Pemulihan</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Unit Kegiatan Pemulihan</label>
                <?php
                  input_pdselect2("id_unit_pemulihan",$cmd_data_ruangan,$id_unit_pemulihan);
                ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Penanggung Jawab</label>
                <?php
                  input_pdselect2("id_pemulihan",$ambil_data_etik_instansi_no_null_all,$id_pemulihan);
                ?>
              </div>
            </div>
           </div>
        </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="kegiatan")
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
  <?php echo form_open_multipart('ol_pemulihan/kegiatan/view/'.$id,' id="signupform" '); ?>
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
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="width:5%;display:none;">ID</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Mulai</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Akhir</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Nama</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Instansi Kegiatan Pemulihan</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Unit Kegiatan Pemulihan</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Result</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Status</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Catatan</th>
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
  <div class="modal-dialog modal-xl">
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
elseif ($page=="kegiatan_edit")
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
           <h3 class="box-title">EDIT DATA</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
    <?php echo form_open_multipart('ol_pemulihan/kegiatan/edit/'.$id,' ');
    input_text("barcode_logbook_pemulihan",$id,"","","hidden");
    input_text("id_logbook_pemulihan",$id_logbook_pemulihan,"","","hidden");
    input_text("result_pemulihan",$result_pemulihan,"","","hidden");
    ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Instansi Pegawai</label>
                <?php
                input_pdselect2fleksibel("id_instansi_pegawai","id_instansi_pegawai",$ambil_id_instansi_pegawai,"id_working","nama_working",$id_instansi_pegawai,"Silahkan Pilih Pegawai");
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Unit Pegawai</label>
                <?php
                  input_pdselect2("id_unit_pegawai",$cmd_id_unit_pegawai,$id_unit_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label>Tanggal Mulai</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"","required");
              ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
              <label>Tanggal Selesai</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"","required");
              ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Instansi Kegiatan Pemulihan</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Unit Kegiatan Pemulihan</label>
                <?php
                  input_pdselect2("id_unit_pemulihan",$cmd_data_ruangan,$id_unit_pemulihan);
                ?>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Penanggung Jawab</label>
                <?php
                  input_pdselect2("id_pemulihan",$ambil_data_etik_instansi_no_null_all,$id_pemulihan);
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
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
            <th style="display: none;">ID</th>
            <th>Tanggal</th>
            <th>Kewenangan</th>
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
elseif ($page=="kegiatan_tambah")
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
  <?php echo form_open_multipart('ol_pemulihan/kegiatan/tambah/'.$id,' id="signupform" ');
  input_text("barcode_logbook_pemulihan",$id,"","","hidden");
  input_text("id_logbook_pemulihan",$id_logbook_pemulihan,"","","hidden");
  input_text("result_pemulihan",$result_pemulihan,"","","hidden");
  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PILIH KEWENANGAN TERTOLAK</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="width:3%;background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tanggal</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tolak</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($ambil_lobook_perorang as $row){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_logbook'];?>">
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo date('d-m-Y', strtotime($row['tgl_logbook'])); ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?><?php input_text("id_logbook_validasi[]",$row['id_logbook_validasi'],"","","hidden"); ?></td>
          <td style="vertical-align:middle;">
            <?php
              if($row['tolak'] == 1){
                echo'<button class="btn btn-xs btn-danger">Supervisi</button>';
              }else if($row['tolak'] == 2){
                echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
              }
              else{
                echo'<button class="btn btn-xs btn-success">Kompeten</button>';
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
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="kegiatan_hasil")
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
      <div class="row">
        <div class="col-md-12">
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">LOGBOOK TERTOLAK SEBELUM KEGIATAN</h3>

                  <div class="box-tools pull-right">

                  </div>
                </div>
                <div class="box-body">
              <table id="example1" width="100%" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tanggal</th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tolak</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  foreach($ambil_lobook_pemulihan_detile as $row){
                  ?>
                <tr>
                  <td style="vertical-align:middle;"><?php echo date('d-m-Y', strtotime($row['tgl_logbook'])); ?></td>
                  <td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
                  <td style="vertical-align:middle;">
                    <?php
                      if($row['result_tolak'] == 1){
                        echo'<button class="btn btn-xs btn-danger">Supervisi</button>';
                      }elseif($row['result_tolak'] == 2){
                        echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
                      }else{
                        echo'';
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
          <?php echo form_open_multipart('ol_pemulihan/kegiatan/hasil/'.$id,' id="signupform" ');
          input_text("barcode_logbook_pemulihan",$id,"","","hidden");
          input_text("id_logbook_pemulihan",$id_logbook_pemulihan,"","","hidden");
          input_text("jml_hasil_kegiatan",$jml_hasil_kegiatan,"","","hidden");
          ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
             <div class="box-header with-border">
                 <h3 class="box-title">SILAHKAN CEK HASIL KEGIATAN KEMUDIAN VALIDASI HASILNYA</h3>

               <div class="box-tools pull-right">

               </div>
             </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-4">
                  <label>Result / Hasil</label>
                  <?php
                    input_pdselect2("result_pemulihan",$cmd_kompeten,$result_pemulihan);
                  ?>
              </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Status</label>
                <?php
                  input_pdselect2("status_pemulihan",$cmd_result,$status_pemulihan);
                ?>
              </div>
            </div>
              <div class="col-md-4">
                <label>Catatan</label>
                <?php
                  input_text("catatan_pemulihan",$catatan_pemulihan,"maxlength='255' ","Masukkan Catatan","text");
                ?>
              </div>
           </div>
             <div class="box-footer">
              <?php
              if($jml_hasil_kegiatan == 0){
              ?>
                <button type="submit" disabled class="btn btn-primary">Submit</button>
              <?php
              }else{
              ?>
                <button type="submit" class="btn btn-primary">Submit</button>
              <?php
              }
              ?>
             </div>
           </div>
           </div>
           <?php echo form_close(); ?>
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">HASIL KEGIATAN</h3>

                  <div class="box-tools pull-right">

                  </div>
                </div>
                <div class="box-body">
                  <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
                    <thead>
                      <tr>
                        <th style="width:5%">ID</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Tanggal</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Kewenangan</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Penguji</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">RM</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Catatan</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Result</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="list_kegiatan")
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
            <th style="width:5%;display:none;">ID</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Mulai</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Akhir</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Nama</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Instansi Kegiatan Pemulihan</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Unit Kegiatan Pemulihan</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Status</th>
            <th style="text-align:left;vertical-align:middle;font-weight:bold;">Result</th>
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
  <div class="modal-dialog modal-xl">
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
elseif ($page=="list_kegiatan_isi")
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
           <h3 class="box-title">DATA PEMULIHAN</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
    <?php echo form_open_multipart('ol_kegiatan/list_kegiatan/isi/'.$id,' ');
    input_text("barcode_logbook_pemulihan",$id,"","","hidden");
    input_text("id_logbook_pemulihan",$id_logbook_pemulihan,"","","hidden");
    ?>
        <div class="box-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Instansi Pegawai</label>
                <?php
                input_pdselect2fleksibel("id_instansi_pegawai","id_instansi_pegawai",$ambil_id_instansi_pegawai,"id_working","nama_working",$id_instansi_pegawai,"Silahkan Pilih Pegawai");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Unit Pegawai</label>
                <?php
                  input_pdselect2("id_unit_pegawai",$cmd_id_unit_pegawai,$id_unit_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <label>Tanggal Mulai</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"","required");
              ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              <label>Tanggal Selesai</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"","required");
              ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Instansi Kegiatan Pemulihan</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Unit Kegiatan Pemulihan</label>
                <?php
                  input_pdselect2("id_unit_pemulihan",$cmd_data_ruangan,$id_unit_pemulihan);
                ?>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>Penanggung Jawab</label>
                <?php
                  input_pdselect2("id_pemulihan",$ambil_data_etik_instansi_no_null_all,$id_pemulihan);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Hasil</label>
                <?php
                  input_pdselect2("result_pemulihan",$cmd_kompeten,$result_pemulihan);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status</label>
                <?php
                  input_pdselect2("status_pemulihan",$cmd_result,$status_pemulihan);
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="box-footer">
  <!--        <button type="submit" class="btn btn-primary">Submit</button> -->
        </div>
    <?php echo form_close(); ?>
      </div>
      <div class="row">
        <div class="col-md-12">
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">LOGBOOK TERTOLAK SEBELUM KEGIATAN</h3>

                  <div class="box-tools pull-right">

                  </div>
                </div>
                <div class="box-body">
              <table id="example1" width="100%" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tanggal</th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:10%;">Tolak</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  foreach($ambil_lobook_pemulihan_detile as $row){
                  ?>
                <tr>
                  <td style="vertical-align:middle;"><?php echo date('d-m-Y', strtotime($row['tgl_logbook'])); ?></td>
                  <td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
                  <td style="vertical-align:middle;">
                    <?php
                      if($row['result_tolak'] == 1){
                        echo'<button class="btn btn-xs btn-danger">Supervisi</button>';
                      }elseif($row['result_tolak'] == 2){
                        echo'<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
                      }else{
                        echo'';
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
                   <h3 class="box-title">HASIL KEGIATAN</h3>

                  <div class="box-tools pull-right">

                  </div>
                </div>
                <div class="box-body"> 
                  <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
                    <thead>
                      <tr>
                        <th style="width:5%;display:none;">ID</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Tanggal</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Kewenangan</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Penguji</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">RM</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Catatan</th>
                        <th style="text-align:left;vertical-align:middle;font-weight:bold;">Result</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>         
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
elseif ($page=="list_kegiatan_input")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_kegiatan/list_kegiatan/simpan_input');?>" onClick="return cek();">
       <input type="hidden" name="barcode_logbook_pemulihan" value="<?= $id; ?>">
       <input type="hidden" name="id_logbook_pemulihan" value="<?= $id_logbook_pemulihan; ?>">
       <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
       <input type="hidden" name="id_instansi_pemulihan" value="<?= $id_instansi_pemulihan; ?>">
       <input type="hidden" name="result_pemulihan" value="<?= $result_pemulihan; ?>">
     <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-7">
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">PILIH KEWENANGAN TERTOLAK</h3>

                  <div class="box-tools pull-right">

                  </div>
                </div>
                <div class="box-body">
                  <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                    <tbody>
                      <?php
                      foreach($ambil_kewenangan_lobook_pemulihan_detil as $row2){
                      ?>
                    <tr>
                      <td style="vertical-align:middle;">
                        <div class="checkbox">
                        <label>
                          <input type="checkbox" class="child" name="chk[]" value="<?php echo $row2['id_kewenangan'];?>">
                        </label>
                        </div>
                      </td>
                      <td style="vertical-align:middle;"><?php echo $row2['nama_kewenangan']; ?></td>
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
        <div class="col-md-5">
          <div class="col-md-12">
            <label>Tanggal</label><p>
            <?php
              input_calendar("tgl_kegiatan_pemulihan","tgl_kegiatan_pemulihan",$tgl_kegiatan_pemulihan,"","required");
            ?></p>
          </div>
          <div class="col-md-12">
              <label>Penguji</label>
              <?php
                input_pdselect2("id_penguji",$cmd_pegawai,$id_penguji);
              ?>
          </div>
          <div class="col-md-12">
            <label>RM</label>
            <?php
              input_text("rm_kegiatan_pemulihan",$rm_kegiatan_pemulihan,"maxlength='255' ","Masukkan RM","text");
            ?>
          </div>
          <div class="col-md-12">
            <label>Jumlah</label>
            <?php
        input_textcustom("jml_kegiatan_pemulihan","1","maxlength='5' required class='form-control' 
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan Jumlah","text");
            ?>
          </div>
        </div>
       </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_kegiatan_pemulihan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_kegiatan_pemulihan").inputmask("datetime", {
  mask: "1-2-y",
  placeholder: "dd-mm-yyyy",
  leapday: "-02-29",
  separator: "-",
  alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="list_kegiatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_kegiatan/list_kegiatan/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="barcode_logbook_pemulihan" value="<?= $id; ?>">
       <input type="hidden" name="id_logbook_pemulihan" value="<?= $id_logbook_pemulihan; ?>">
       <input type="hidden" name="id_kegiatan_pemulihan" value="<?= $id2; ?>">
       <input type="hidden" name="id_kewenangan" value="<?= $id_kewenangan; ?>">
       <input type="hidden" name="tgl_kegiatan_pemulihan_lama" value="<?= $tgl_kegiatan_pemulihan; ?>">
       <input type="hidden" name="result_pemulihan" value="<?= $result_pemulihan; ?>">
     <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <label>Tanggal</label><p>
          <?php
            input_calendar("tgl_kegiatan_pemulihan","tgl_kegiatan_pemulihan",$tgl_kegiatan_pemulihan,"","required");
          ?></p>
        </div>
          <div class="col-md-12">
              <label>Penguji</label>
              <?php
                input_pdselect2("id_penguji",$cmd_pegawai,$id_penguji);
              ?>
          </div>
          <div class="col-md-6">
            <label>RM</label>
            <?php
              input_text("rm_kegiatan_pemulihan",$rm_kegiatan_pemulihan,"maxlength='255' ","Masukkan RM","text");
            ?>
          </div>
          <div class="col-md-6">
              <label>Result / Hasil</label>
              <?php
                input_pdselect2("result_kegiatan_pemulihan",$cmd_kompeten,$result_kegiatan_pemulihan);
              ?>
          </div>
          <div class="col-md-12">
            <label>Catatan</label>
            <?php
              input_text("catatan_kegiatan_pemulihan",$catatan_kegiatan_pemulihan,"maxlength='255' ","Masukkan Catatan","text");
            ?>
          </div>
       </div>
        <div class="box-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      </div>
    </FORM>
<script type="text/javascript">
$('#tgl_kegiatan_pemulihan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_kegiatan_pemulihan").inputmask("datetime", {
  mask: "1-2-y",
  placeholder: "dd-mm-yyyy",
  leapday: "-02-29",
  separator: "-",
  alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}