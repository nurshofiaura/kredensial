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
// =================================================================== OL_ETIK
elseif ($page=="etik")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content">
  <?php echo form_open_multipart('ol_etik/etik/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
                input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id,"Semua");
              ?>
          </div>
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
                <th style="display:none;">ID</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th style="width:10%;">Status</th>
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
         <small><?php echo $instance_name; ?></small>
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
elseif ($page=="etik_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content">
  <?php echo form_open_multipart('ol_etik/etik/tambah',' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Etik</label>
            <?php
              input_text("nama_etik",$nama_etik,"maxlength='255' autofocus required","Masukkan Nama Etik","text");
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Jawaban</label>
            <?php
              input_pdselect2("answer",$cmd_ya_tidak,$answer);
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_etik",$cmd_status,$status_etik);
            ?>
          </div>
        </div>

      </div>
      </div>
      <div class="box-footer">

      </div>
    </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($cmd_jabatan_null as $row){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_jabatan'];?>" >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan'];?></td>
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
elseif ($page=="etik_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content">
  <?php echo form_open_multipart('ol_etik/etik/edit/'.$id,' id="signupform" ');
  input_text("id_etik",$id,"","","hidden");
  input_text("pembuat",$pembuat,"","","hidden");
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Etik</label>
            <?php
              input_text("nama_etik",$nama_etik,"maxlength='255' autofocus required","Masukkan Nama Etik","text");
            ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Jabatan</label>
            <?php
              input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
            ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Jawaban</label>
            <?php
              input_pdselect2("answer",$cmd_ya_tidak,$answer);
            ?>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_etik",$cmd_status,$status_etik);
            ?>
          </div>
        </div>
      </div>
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
elseif ($page=="ms_etik")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content">
  <?php echo form_open_multipart('ol_etik/ms_etik/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $title ?></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
                input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id,"Semua");
              ?>
          </div>
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
                <th style="display:none;">ID</th>
                <th>Jabatan</th>
                <th>Instansi</th>
                <th style="width:10%;">Status</th>
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
         <small><?php echo $instance_name; ?></small>
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
elseif ($page=="ms_etik_tambah")
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
        <h3 class="box-title"><?= $title ?></h3>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_etik/ms_etik/tambah/'.$id ,' id="signupform" ');

  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
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
        <div class="col-md-6">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2("id_instansi",$ambil_data_rujukan_working_kab_null,$id_instansi);
              ?>
          </div>
        </div>
      </div>
      </div>
    </div>
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:70%;">Etik</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">Jawaban</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($ambil_pilih_ms_etik as $row){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_etik'];?>" >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['nama_etik']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['answer']; ?></td>
        </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="ms_etik_edit")
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
        <h3 class="box-title"><?= $title ?></h3>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_etik/ms_etik/edit/'.$id ,' id="signupform" ');
  input_text("id_etik_instansi",$id,"","","hidden");
  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
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
        <div class="col-md-4">
          <div class="form-group">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
              ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2("id_instansi",$ambil_data_rujukan_working_kab_null,$id_instansi);
              ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2("status_etik_instansi",$cmd_status,$status_etik_instansi);
              ?>
          </div>
        </div>
      </div>
      </div>
    </div>
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:70%;">Etik</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">Jawaban</th>
        </tr>
        </thead>
        <tbody>
          <?php
          foreach($ambil_pilih_ms_etik as $row){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_etik'];?>" <?php if(in_array($row['id_etik'],explode(",", $etik))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['nama_etik']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['answer']; ?></td>
        </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="etik_pegawai")
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
           <h3 class="box-title"><?= $title ?></h3>
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
                <th style="display:none;">ID</th>
                <th>Tanggal</th>
                <th>Instansi</th>
                <th>Nama</th>
                <th>Jumlah Soal</th>
                <th>Nilai</th>
                <th>Hasil</th>
                <th>Penguji</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="etik_pegawai_tambah")
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
        <h3 class="box-title"><?= $title ?></h3>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_etik/etik_pegawai/tambah/'.$id ,' id="signupform" ');
/*    if($num_kol_etik_all['count_koletik']==0){
      $disableded = "disabled";
    }else{
      $disableded = "";
    }*/
  ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
       </h3>
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
        <div class="col-md-6">
          <div class="form-group">
            <label>Format Etik</label>
              <?php
                input_pdselect2("id",$ambil_etik_instansi,$id);
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Instansi</label>
              <?php
                input_pdselect2("id_instansi",$ambil_working,$id_instansi);
              ?>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2("id_pegawai",$ambil_data_etik_instansi_no_null,$id_pegawai);
              ?>
          </div>
        </div>
      </div>
      </div>
      <div class="box-footer">
    <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;width:5%;">No</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:70%;">Etik</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Jabatan</th>
          <th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;width:5%;">YA</th>
          <th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;width:5%;">TIDAK</th>
        </tr>
        </thead>
        <tbody>
          <?php
          $no =0;
          foreach($ambil_pilih_ms_etik as $row){
            if (in_array($row['id_etik'],explode(",", $etik))) {
              $no++;
          ?>
        <tr>
                <td style="vertical-align:middle;"><?php echo $no;?></td>
                <td style="vertical-align:middle;"><?php input_text("id_etik[]",$row['id_etik'],"","","hidden"); ?><?php echo $row['nama_etik'];?></td>
          <td style="vertical-align:middle;text-align: center;"><?php echo $row['nama_jabatan']; ?></td>
                <td style="vertical-align:middle;text-align: center;text-align:center;">
                  <div class="radio">
                  <label>
                    <input type="radio" onchange="total_GR()" name="skor_etik<?php echo $row['id_etik']; ?>" value="<?php if($row['answer']=="1") {echo "1";}else{echo "0";}?>" checked="checked">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;text-align: center;text-align:center;">
                  <div class="radio">
                  <label>
                    <input type="radio" onchange="total_GR()" name="skor_etik<?php echo $row['id_etik']; ?>" value="<?php if($row['answer']=="0") {echo "1";}else{echo "0";}?>">
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
      <hr>
              <label>Hasil</label>
              <?php
                input_text("sub_total",0,"maxlength='255' onchange='total_GR()' readonly","","hidden");
                input_text("hasilGR",0,"maxlength='255' readonly","","text");
                input_text("total",$no,"maxlength='255' ","","hidden");
              ?>
        </div>
        <div class="box-footer">
<button type="submit" name="action" value="BtnSimpan" class="btn btn-primary pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="etik_pegawai_lihat")
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
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">No</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Etik</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Jawaban</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Terpilih</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Skor</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align:center;">Jumlah</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $jumlahe = 0; $No = 0;
                foreach($ambil_data_etik_pegawai as $row){
                  $jumlahe = $jumlahe + $row['skor_etik'];
                  $No++;
                ?>
              <tr>
                <td style="vertical-align:middle;"><?php echo $No; ?></td>
                <td style="vertical-align:middle;"><?php echo $row['nama_etik'];?></td>
                <td style="vertical-align:middle;text-align:center;">
                <?php
                  if($row['answer']=="0") { // NO
                    echo "TIDAK";
                  }else if($row['answer']=="1"){
                    echo "YA";
                  }
                ?>
                </td>
                <td style="vertical-align:middle;text-align:center;">
                <?php
                  if($row['answer']=="0" AND $row['skor_etik']=="0") { // NO
                    echo "YA";
                  }else if($row['answer']=="0" AND $row['skor_etik']=="1"){
                    echo "TIDAK";
                  }else if($row['answer']=="1" AND $row['skor_etik']=="1"){
                    echo "YA";
                  }else if($row['answer']=="1" AND $row['skor_etik']=="0"){
                    echo "TIDAK";
                  }
                ?>
                </td>
                <td style="vertical-align:middle;text-align:center;"><?php echo $row['skor_etik'];?></td>
                <td style="vertical-align:middle;text-align:center;"><?php echo $jumlahe;?></td>
              </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
            <hr>
            <div class="col-md-6">
            <div class="form-group">
              <label>Hasil</label>
              <?php
                input_text("total",$hasil_etik,"maxlength='255' readonly","","text");
              ?>
            </div>
             </div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
// ========================================================================== END ETIK
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
            <th style="display:none;width: 5%;">ID</th>
            <th>Tanggal</th>
            <th>Status Usulan</th>
            <th>Status</th>
            <th>ACC Kabid</th>
            <th>ACC Asesor</th>
            <th>Asesor</th>
            <th>ACC Komite</th>
            <th>ACC Direktur</th>
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
      <input type="hidden" name="id_status_diusulkan" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><?php $title; ?></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?= $nama_status_diusulkan ?></h3>
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
                  <li>Minta kepala ruangan untuk membuat Penilaian Etik</li>
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
                  <li>Pengajuan Kredensial / Non Keperawatan hanya akan divlidasi oleh komite / penilai</li>
                  <li>Pengajuan Kenaikan Tingkat (Keperawatan) akan divlidasi sesuai alur kabid=>asesor=>komite=>direktur</li>
                  <li>Pengajuan Pemulihan kewenangan diambil dari logbook yang ditolak</li>
                  <li>Pengajuan Penambahan Kewenangan / Kompetensi hanya divlidasi oleh komite</li>
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
            <div class="box-body box-profile">
            <button type="submit" class="btn btn-primary btn-block"><b>AJUKAN <?= strtoupper($nama_status_diusulkan) ?></b></button>
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
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
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
      <div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">
              <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
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
                <div class="form-group">
                </div>
                <ul class="list-group list-group-unbordered">
                  <?php
              if($status_pengajuan=="0"){
                    ?>
                        <li class="list-group-item">
                            <a href="<?php echo base_url('ol_pengajuan/berkas_logbook/view/01-'.date("m-Y").'/'.date("d-m-Y").'/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">Pilih Data LogBook</a>
                        </li>
                    <?php
              }else{
                  ?>
                      <li class="list-group-item">
                          <a href="<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/pdf/'.$id_pengajuan);?>"
                          target="_blank" class="btn bg-purple btn-block btn-xs">
                            <i class="fa fa-print"> &nbsp;PRINT LOGBOOK</i>
                          </a>
                      </li>
                  <?php
              }
                  ?>
                <li class="list-group-item">
                  <?php
                    if($status_pengajuan=="0"){
                  ?>
                      <a href="<?php echo base_url('ol_pengajuan/berkas_ijasah/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
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
                    if($status_pengajuan=="0"){
                  ?>
                      <a href="<?php echo base_url('ol_pengajuan/berkas_str/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
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
                    if($status_pengajuan=="0"){
                  ?>
                      <a href="<?php echo base_url('ol_pengajuan/berkas_sertifikat/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
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
                    if($status_pengajuan=="0"){
                  ?>
                        <a href="<?php echo base_url('ol_pengajuan/berkaslain_berkas/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">
                        Pilih Berkas Lain (opsional)</a>
                  <?php
                    }else{
                  ?>
                      <a class="btn bg-red btn-block btn-xs"> Berkas Opsional</a>
                  <?php
                    }
                  ?>
                </li>
                      <li class="list-group-item">
                  <?php
                    if($status_pengajuan=="0"){
                      ?>
                      <a href="<?php echo base_url('ol_pengajuan/berkas_etik/view/'.$id_pengajuan);?>" class="btn bg-green btn-block btn-xs">Pilih Etik</a>
                  <?php
                    }else{
                  ?>
                      <a class="btn bg-red btn-block btn-xs"> Etik</a>
                  <?php
                    }
                  ?>
                </li>
                </ul>

                  <?php
                      input_text("id_pengajuan",$id,"","","hidden");
                  if($status_pengajuan=="0"){
                  if(($ijasah !== '') AND ($str !== '') AND ($sertifikat !== '') AND
                  ($jml_logbooke > 0) AND  ($id_etik_pegawai !== '')){
                  ?>

                    <button name="action" value="BtnKirim" class="btn btn-primary btn-block">
                      <i class="fa fa-send"></i> <b>KIRIM KOMPETENSI</b>
                    </button>
                  <?php
                      }else{
                  ?>
                    <button name="action" value="Btnsimpan" class="btn btn-primary btn-block">
                      <i class="fa fa-save"></i> <b>SIMPAN KOMPETENSI</b>
                    </button>
                  <?php
                      }
                  }else{
                    ?>
                    <a class="btn bg-red btn-block"><i class="fa fa-send"></i> <b>KIRIM KOMPETENSI</b></a>
                  <?php
                  }
                   ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
             <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
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
                  <a href="<?php echo base_url('assets/berkas/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
                  <a href="<?php echo base_url('assets/berkas/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">SERTIFIKAT</td>
            </tr>
              <?php
              if($sertifikat!==""){
                foreach($ambil_berkas_data as $row3){
                  if (in_array($row3['id_berkas'],$id_sertifikat)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
                  <a href="<?php echo base_url('assets/berkas/'.$row4['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row4['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
            <tr>
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">ETIK&nbsp;
            <?php if($id_etik_pegawai == 0){ echo 'TIDAK MENCUKUPI SILAHKAN HUBUNGI KEPALA RUANGAN'; } ?>
            </td>
            </tr>
            <td colspan="2" class="mailbox-name">
      <table width="100%" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="vertical-align:middle;text-align:center;font-weight:bold;width:5%;"></th>
            <th style="vertical-align:middle;text-align:center;font-weight:bold;">Tanggal</th>
            <th style="vertical-align:middle;text-align:center;font-weight:bold;">Hasil</th>
            <th style="vertical-align:middle;text-align:center;font-weight:bold;">Penguji</th>
            <th style="vertical-align:middle;text-align:center;font-weight:bold;"><i class="fa fa-print"></i></th>
          </tr>
        </thead>
        <tbody>
        <?php
          foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
            if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$etike)) {
        ?>
          <tr>
          <td style="vertical-align:middle;text-align:center;"><input name="id_etik_pegawai[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>" checked="checked" type="checkbox"></td>
          <td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
          <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
          <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
          <td style="vertical-align:middle;text-align:center;">
          <a href="<?php echo base_url('pegawai/pengajuan_kompetensi/pdf_etika/'.$rowambil_data_etik_pegawai_oppe['id_etik_pegawai']);?>" class="btn bg-green btn-xs" target="_blank">
          <i class="fa fa-file-pdf-o"></i> pdf</a>
          </td>
          </tr>
        <?php
            }
          }
        ?>
        </tbody>
      </table>
            </td>
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
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
             <?php echo $title; ?> <small style="color:white;font-weight:bold;">  <?php echo $instance_name; ?> </small>
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
            <td style="background-color:#9b0e27;color:white;text-weight:bold;">DOWNLOAD FILES</td>
            </tr>
            <tr>
            <td class="mailbox-name">
            <?php
            if(!empty($kredensial)){
            ?>
              <a href="<?php echo base_url('assets/berkas/'.$kredensial);?>" target="_blank" class="btn bg-maroon btn-xs">
                <i class="fa fa-download"></i> Sub Kredensial
              </a>
            <?php
            }
            if(!empty($mutu)){
            ?>
              <a href="<?php echo base_url('assets/berkas/'.$mutu);?>" target="_blank" class="btn bg-maroon btn-xs">
                <i class="fa fa-download"></i> Sub Mutu
              </a>
            <?php
            }
            if(!empty($etika)){
            ?>
              <a href="<?php echo base_url('assets/berkas/'.$etika);?>" target="_blank" class="btn bg-maroon btn-xs">
                <i class="fa fa-download"></i> Sub Etika
              </a>
            <?php
            }
            if(!empty($spk)){
            ?>
              <a href="<?php echo base_url('assets/berkas/'.$spk);?>" target="_blank" class="btn bg-maroon btn-xs">
                <i class="fa fa-download"></i> Rekomendasi
              </a>
            <?php
            }
            ?>
            </td>
            </tr>
            </tbody>
          </table>
          <!-- /.table -->
          </div>
          <!-- /.mail-box-messages -->
        </div>
            </div>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      LOGBOOK YANG DIAJUKAN
       </h3>
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
                <th width="5%"></th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">ID</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Tanggal</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">PK</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Nama Kewenangan</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">JML</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Karu</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Kabid</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Asesor</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Komite</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Direktur</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <?php if($id_status_diusulkan == 4){ ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      LOGBOOK DAN KEGIATAN PEMULIHAN
       </h3>
        </div>
        <div class="box-body">
          <div class="box-tools pull-right">
              
          </div>
          <table id="dttb2" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;width:5%;">ID</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Awal</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Akhir</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Penanggung Jawab</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Ruangan</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Hasil</th>
                <th style="text-align:center;vertical-align:middle;font-weight:bold;">Catatan</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    <?php } ?>
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
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<?php
}