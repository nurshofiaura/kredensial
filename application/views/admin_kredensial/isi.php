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
elseif ($page=="form1")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><hr>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:15%;">Instansi</th>
                <th style="width:15%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form1_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form1/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="1">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form1_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form1/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="elemen")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">DATA TIDAK BISA DIRUBAH BILA SUDAH MASUK ASESMEN</h3>

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
                <th style="display:none;"></th>
                <th style="width:60%;">Elemen Kompetensi</th>
                <th>Jabatan Fungsional</th>
                <th>Pembuat</th>
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
elseif ($page=="elemen_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/elemen/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Elemen</label>
                  <?php
                    input_text("nama_elemen",$nama_elemen,"required","Masukkan Nama","text");
                  ?>  
              </div>
              <div class="col-md-12">
                  <label>Jabatan</label>
                    <?php
                      input_pdselect2("jabatan_elemen",$cmd_jabatan,$jabatan_elemen);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("instansi_elemen",$working,$instansi_elemen);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="elemen_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/elemen/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_elemen" value="<?= $id_elemen; ?>">
    <input type="hidden" name="pembuat_elemen" value="<?= $pembuat_elemen; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Elemen Kompetensi</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama Elemen</label>
                  <?php
                    input_text("nama_elemen",$nama_elemen,"required","Masukkan Nama","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Jabatan</label>
                    <?php
                      input_pdselect2("jabatan_elemen",$cmd_jabatan,$jabatan_elemen);
                    ?>          
              </div>  
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("instansi_elemen",$working,$instansi_elemen);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="asesmen")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th style="width:30%;">Komponen Asesmen</th>
                <th style="width:30%;">Elemen</th>
                <th>Jabatan</th>
                <th>Pembuat</th>
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
elseif ($page=="asesmen_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/asesmen/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Asesmen</label>
                  <?php
                    input_text("nama_asesmen",$nama_asesmen," required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Jabatan</label>
                    <?php
                      input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Elemen</label>
                    <?php
                      input_pdselect2("id_elemen",$cmd_elemen,$id_elemen);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("instansi_asesmen",$working,$instansi_asesmen);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="asesmen_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/asesmen/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_asesmen" value="<?= $id_asesmen; ?>">
    <input type="hidden" name="pembuat_asesmen" value="<?= $pembuat_asesmen; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Asesmen</label>
                  <?php
                    input_text("nama_asesmen",$nama_asesmen," required","Masukkan Nama","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Jabatan</label>
                    <?php
                      input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                    ?>          
              </div>  
              <div class="col-md-12">
                  <label>Elemen</label>
                    <?php
                      input_pdselect2("id_elemen",$cmd_elemen,$id_elemen);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("instansi_asesmen",$working,$instansi_asesmen);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="qf_2")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Pertanyaan</th>
                <th style="width:25%;">Asesmen</th>
                <th style="width:25%;">Elemen</th>
                <th>Jabatan</th>
                <th>Instansi</th>
                <th>Pembuat</th>
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
elseif ($page=="qf_2_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/qf_2/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Pertanyaan</label>
                  <?php
                    input_text("nama_question",$nama_question,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Asemen</label>
                    <?php
                      input_pdselect2("id_asesmen",$cmd_asesmen,$id_asesmen);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="qf_2_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/qf_2/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_question" value="<?= $id_question; ?>">
    <input type="hidden" name="pembuat_question" value="<?= $pembuat_question; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Pertanyaan</label>
                  <?php
                    input_text("nama_question",$nama_question,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Asemen</label>
                    <?php
                      input_pdselect2("id_asesmen",$cmd_asesmen,$id_asesmen);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="format_question")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><hr>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="format_question_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/format_question/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="2">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="format_question_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/format_question/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="qf_2_hasil")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/qf_2/simpan_hasil');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Format Lain</label>
                    <?php
                      input_pdselect2("id_question",$hasil,$id_question);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="format_question_seting")
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
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/format_question/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
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
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pertanyaan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pembuat</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_question'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rownkr_asesmen['nama_question'] ?></td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rownkr_asesmen['nama_pegawai'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="display:none;"></th>
                <th style="width:9%;vertical-align: center;">Urut</th>
                <th style="vertical-align: middle;text-align: center;">Elemen</th>
                <th style="vertical-align: middle;text-align: center;">Asesmen</th>
                <th style="vertical-align: middle;text-align: center;">Pertanyaan</th>
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
elseif ($page=="format_question_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/format_question/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' autocomplete='OFF' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
elseif ($page=="indikator")
{
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
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
 <!--     <div class="box box-<php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><php echo $title; ?> <small style="color:white;font-weight:bold;">P = Pengetahuan, K = Ketrampilan, S = Sikap</small></h3>

          <div class="box-tools pull-right">
      <php
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th style="display:none;"></th>
                <th style="vertical-align:middle;text-align: center;width:50%;">Asesmen</th>
                <th style="vertical-align:middle;text-align: center;width:30%;">Indikator Unjuk Kerja</th>
                <th style="vertical-align:middle;text-align: center;">Pembuat</th>
                <th style="vertical-align:middle;text-align: center;">Status</th>
              </tr>
            </thead>
          </table>
        </div>
      </div> -->
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
      <a href="<?= base_url().'admin_kredensial/indikator/pdf_indikator' ?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" target="_blank"> <i class="fa fa-print"></i> Print
      </a>
           </h3>

          <div class="box-tools pull-right">
              <button type="button" class="btn btn-primary btn-md TambahKUK" data-toggle="tooltip" data-placement="right" 
                title="Tambah Data" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah Indikator Unjuk Kerja
              </button>
          </div>
        </div>
        <div class="box-body">
          <table id="examplex" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th>DAFTAR METODE DAN PERANGKAT ASESMEN</th>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach ($instansi as $rowinstansi)
            {
            ?>
            <tr>
              <td colspan="7" style="font-weight:bold;"><?= $rowinstansi['nama_working'] ?></td>
            </tr>
            <?php
        //    $kondisi1 = array('nas.instansi_asesmen'=>$rowinstansi['id_working'],'status_indikator'=>1);
            $kondisi1 = array('instansi_indikator'=>$rowinstansi['barcode_working'],'status_indikator'=>1);
$kompetensi = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nas.id_elemen','nas.id_elemen','ASC',$kondisi1);
              foreach ($kompetensi as $rowkompetensi)
              {
            ?>
            <tr>
              <td class="bg-dark">&nbsp;</td>
              <td class="bg-dark" colspan="6">Elemen : <?= $rowkompetensi['nama_elemen'] ?></td>
            </tr>
            <?php
            $kondisi11 = array('nas.id_elemen'=>$rowkompetensi['id_elemen'],'status_indikator'=>1);
$elemen = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nin.id_asesmen','nin.id_asesmen','ASC',$kondisi11);            
                foreach ($elemen as $rowelemen)
                {
            ?>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="5">Asesmen : <?= $rowelemen['nama_asesmen'] ?></td>
            </tr>
            <?php
            $kondisi111 = array('nin.id_asesmen'=>$rowelemen['id_asesmen'],'status_indikator'=>1);
$indikator = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nin.id_indikator','nin.id_indikator','ASC',$kondisi111,'nojoin');  
                foreach ($indikator as $rowindikator)
                {
            ?>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td colspan="2">Indikator : <?= $rowindikator['nama_indikator'] ?></td>
              <td>
<button type="button" class="btn btn-success btn-xs EditKUK" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $rowindikator['id_indikator'] ?>">
                <i class="fa fa-pencil"></i></button>
              </td>
              <td1>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td style="text-align: left;font-weight: bold;">
<button type="button" class="btn btn-info btn-xs TambahMetode" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $rowindikator['id_indikator'] ?>">
                <i class="fa fa-plus"></i> Tambah Metode Asesmen</button>
            </td>
            <td style="text-align: left;font-weight: bold;">
<button type="button" class="btn btn-info btn-xs TambahPerangkat" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $rowindikator['id_indikator'] ?>">
                <i class="fa fa-plus"></i>Tambah Perangkat Asesmen</button>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <?php  
            if(!empty($rowindikator['metode_indikator']) || !empty($rowindikator['perangkat_indikator'])){
            ?>
            <tr>
            <td style="width:5%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="text-align: left;font-weight: bold;"><?php if(!empty($rowindikator['metode_indikator'])){ echo 'METODE ASSMEN'; } ?></td>
            <td style="text-align: left;font-weight: bold;"><?php if(!empty($rowindikator['perangkat_indikator'])){ echo 'PERANGKAT ASSMEN'; } ?></td>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td style="text-align: left;">
                <ul>
            <?php
            if(!empty($rowindikator['metode_indikator'])){
                foreach($metode as $rowmetode){
                  if (in_array($rowmetode['id_metode'],explode(",", $rowindikator['metode_indikator']))) {
                    echo '<li>'.$rowmetode['nama_metode'].'</li>';
                  }
                }
            }
            ?>  </ul>          
              </td>
              <td style="text-align: left;">
                 <ul>
            <?php
            if(!empty($rowindikator['perangkat_indikator'])){
              foreach($perangkat as $rowperangkat){
                if (in_array($rowperangkat['id_perangkat'],explode(",", $rowindikator['perangkat_indikator']))) {
                  echo '<li>'.$rowperangkat['nama_perangkat'].'</li>';
                }
              }
            }
            ?>  </ul>               
              </td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <?php   
            }
                  }
                }
              }
            }
            ?>
          </tbody>
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
elseif ($page=="indikator_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/indikator/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Indikator</label>
                  <?php
                    input_text("nama_indikator",$nama_indikator,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Asesmen</label>
                    <?php
                      input_pdselect2("id_asesmen",$cmd_asesmen,$id_asesmen);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="indikator_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/indikator/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Indikator</label>
                  <?php
                    input_text("nama_indikator",$nama_indikator,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Asesmen</label>
                    <?php
                      input_pdselect2("id_asesmen",$cmd_asesmen,$id_asesmen);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_indikator",$status,$status_indikator);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="indikator_metode")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/indikator/simpan_metode');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Perangkat Asesmen</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($metode as $rowmetode){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowmetode['id_metode'];?>" <?php if(in_array($rowmetode['id_metode'],explode(",", $metode_indikator))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rowmetode['nama_metode'] ?></td>
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
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });  
  }); 
</script>
<?php
}
elseif ($page=="indikator_perangkat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/indikator/simpan_perangkat');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Perangkat Asesmen</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($perangkat as $rowperangkat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowperangkat['id_perangkat'];?>" <?php if(in_array($rowperangkat['id_perangkat'],explode(",", $perangkat_indikator))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rowperangkat['nama_perangkat'] ?></td>
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
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });  
  }); 
</script>
<?php
}
elseif ($page=="indikator_pertanyaan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/indikator/simpan_pertanyaan');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
          <div class="col-md-6">
              <label>Poin yang di amati</label>
              <?php
                input_textareacustom("poin_indikator",$poin_indikator," id='editor1' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>
          <div class="col-md-6">
              <label>Indikator Ketercapaian</label>
              <?php
                input_textareacustom("ketercapaian_indikator",$ketercapaian_indikator," id='editor3' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>          
          <div class="col-md-6">
              <label>Pertanyaan</label>
              <?php
                input_textareacustom("pertanyaan_indikator",$pertanyaan_indikator," id='editor2' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>

          <div class="col-md-6">
              <label>Standar Jawaban</label>
              <?php
                input_textareacustom("jawaban_indikator",$jawaban_indikator," id='editor4' rows='5' cols='50' class='form-control' ","");
              ?>
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
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor3', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor4', {enterMode: CKEDITOR.ENTER_BR});
    }); 
</script>
<?php
}
elseif ($page=="metode")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Metode Asesmen</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
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
elseif ($page=="metode_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/metode/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Metode</label>
                  <?php
                    input_text("nama_metode",$nama_metode,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="metode_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/metode/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_metode" value="<?= $id_metode; ?>">
    <input type="hidden" name="pembuat_metode" value="<?= $pembuat_metode; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Metode Asesmen</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama Metode</label>
                  <?php
                    input_text("nama_metode",$nama_metode,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="perangkat")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Perangkat Asesmen</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
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
elseif ($page=="perangkat_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/perangkat/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Perangkat</label>
                  <?php
                    input_text("nama_perangkat",$nama_perangkat,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="perangkat_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/perangkat/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_perangkat" value="<?= $id_perangkat; ?>">
    <input type="hidden" name="pembuat_perangkat" value="<?= $pembuat_perangkat; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Perangkat Asesmen</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama Perangkat</label>
                  <?php
                    input_text("nama_perangkat",$nama_perangkat,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="alat")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Alat dan Bahan</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
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
elseif ($page=="alat_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/alat/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Alat dan Bahan</label>
                  <?php
                    input_text("nama_alat",$nama_alat,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="alat_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/alat/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_alat" value="<?= $id_alat; ?>">
    <input type="hidden" name="pembuat_alat" value="<?= $pembuat_alat; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Alat dan Bahan</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama Alat dan Bahan</label>
                  <?php
                    input_text("nama_alat",$nama_alat,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="alatbahan")
{
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
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Kompetensi</th>
                <th>Elemen</th>
                <th>Instansi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">
          <table id="examplex" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th>DAFTAR ALAT DAN BAHAN</th>
              </tr>
            </thead>
            <tbody>
            <?php
            foreach ($instansi as $rowinstansi)
            {
            ?>
            <tr>
              <td colspan="4" style="font-weight:bold;"><?= $rowinstansi['nama_working'] ?></td>
            </tr>
            <?php
$kondisi1 = array('nab.id_instansi'=>$rowinstansi['id_working']);
$kompetensi = $this->m_admin_kredensial->ambil_kompetensi_dari_nkr_alat('nab.id_kompetensi','nab.id_kompetensi','ASC',$kondisi1);
              foreach ($kompetensi as $rowkompetensi)
              {
$kondisi2 = array('nab.id_kompetensi'=>$rowkompetensi['id_kompetensi']);
$elemen = $this->m_admin_kredensial->ambil_kompetensi_dari_nkr_alat('nab.id_elemen','nab.id_elemen','ASC',$kondisi2);
            ?>
            <tr>
              <td class="bg-dark" style="width:3%;">&nbsp;</td>
              <td class="bg-dark" colspan="3"><?= $rowkompetensi['nama_kompetensi'] ?> - <b>[<?= $rowkompetensi['nama_jabatan'] ?>]</b></td>
            </tr>
            <?php
                foreach ($elemen as $rowelemen)
                {
            ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td colspan="2"><?= $rowelemen['nama_elemen'] ?></td>
            </tr>
            <?php
                  foreach($alat as $rowalat){
                      if (in_array($rowalat['id_alat'],explode(",", $rowelemen['alat']))) {
            ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;text-align: center;">==</td>
              <td><?= $rowalat['nama_alat'] ?></td>
            </tr>
            <?php   
                      }
                  }
                }
              }
            }
            ?>
          </tbody>
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
elseif ($page=="alatbahan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/alatbahan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Elemen</label>
                    <?php
                      input_pdselect2("id_elemen",$cmd_elemen,$id_elemen);
                    ?>          
              </div>
              <div class="col-md-6">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Kompetensi</label>
                    <?php
                      input_pdselect2("id_kompetensi",$ambil_kompetensi,$id_kompetensi);
                    ?>          
              </div>              
              <div class="col-md-12">
                  <label>Alat dan Bahan</label>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Alat dan Bahan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($ambil_nkr_alat as $rowambil_nkr_alat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowambil_nkr_alat['id_alat'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rowambil_nkr_alat['nama_alat'] ?></td>
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
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="alatbahan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/alatbahan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_alat_bahan" value="<?= $id_alat_bahan; ?>">
    <input type="hidden" name="pembuat_alat_bahan" value="<?= $pembuat_alat_bahan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Alat dan Bahan</label>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Alat dan Bahan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($ambil_nkr_alat as $rowambil_nkr_alat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowambil_nkr_alat['id_alat'];?>" <?php if(in_array($rowambil_nkr_alat['id_alat'],explode(",", $alat))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rowambil_nkr_alat['nama_alat'] ?></td>
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
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="form3")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><hr>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form3_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form3/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="3">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form3_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form3/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form3_seting")
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
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/form3/seting/'.$id.'/'.$id2,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title">MASTER</h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table width="100%" id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="vertical-align:middle;width: 5%;text-align: left;" colspan="5">
                  INDIKATOR UNJUK KERJA
                </th>
              </tr>
            </thead>
            <tbody>
            <?php
            $kondisi1 = array('nas.id_elemen'=>$id2,'status_indikator'=>1);
$kompetensi = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nas.id_elemen','nas.id_elemen','ASC',$kondisi1);
              foreach ($kompetensi as $rowkompetensi)
              {
            ?>
            <tr>
              <td class="bg-dark" style="width:3%;">&nbsp;</td>
              <td class="bg-dark" colspan="4">Elemen : <?= $rowkompetensi['nama_elemen'] ?></td>
            </tr>
            <?php
            $kondisialat = array('id_elemen'=>$rowkompetensi['id_elemen'],'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi);
            $alatbahan = $this->m_umum->ambil_data_kondisi('nkr_alat_bahan',$kondisialat);
            if(!empty( $alatbahan['alat'])){
              echo'<tr><td>&nbsp;</td><td>&nbsp;</td><td colspan="3" style="font-weight:bold;">ALAT DAN BAHAN</td></tr>';
            foreach($alat as $rowalat){
              if (in_array($rowalat['id_alat'],explode(",", $alatbahan['alat']))) {
            ?>
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>==</td>
            <td colspan="2" style="text-align: left;">
              <?= $rowalat['nama_alat'] ?>
            </td>
            </tr>
            <?php
              }
            }
          }
$kondisi11 = array('nas.id_elemen'=>$rowkompetensi['id_elemen'],'status_indikator'=>1);
$elemen = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nin.id_asesmen','nin.id_asesmen','ASC',$kondisi11);            
                foreach ($elemen as $rowelemen)
                {
            ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td colspan="3">Asesmen : <?= $rowelemen['nama_asesmen'] ?></td>
            </tr>
            <?php
/*$kondisi111 = array('nin.id_indikator'=>$rowelemen['id_indikator'],'status_indikator'=>1,'nas.id_jabatan'=>$id3);
$indikator = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nin.id_indikator','nin.id_indikator','ASC',$kondisi111,'nojoin');  */


$kondisi111 = array('nin.id_asesmen'=>$rowelemen['id_asesmen'],'status_indikator'=>1);
$indikator = $this->m_admin_kredensial->ambil_asesmen_dari_indikator('nin.id_indikator','nin.id_indikator','ASC',$kondisi111,'nojoin');  
                foreach ($indikator as $rowindikator)
                {
            ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="vertical-align:middle;text-align: center;width:3%;">
                <div class="checkbox">
                <label>
                  <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowindikator['id_indikator'];?>" >
                </label>
                </div>
              </td>
              <td colspan="2" style="font-weight:bold;vertical-align:middle;">Indikator : <?= $rowindikator['nama_indikator'] ?></td>
            </tr>
            <?php  
            if(!empty($rowindikator['metode_indikator']) || !empty($rowindikator['perangkat_indikator'])){
            ?>
            <tr>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="text-align: left;font-weight: bold;"><?php if(!empty($rowindikator['metode_indikator'])){ echo 'METODE ASSMEN'; } ?></td>
            <td style="text-align: left;font-weight: bold;"><?php if(!empty($rowindikator['perangkat_indikator'])){ echo 'PERANGKAT ASSMEN'; } ?></td>
            </tr>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="text-align: left;">
                <ul>
            <?php
            if(!empty($rowindikator['metode_indikator'])){
                foreach($metode as $rowmetode){
                  if (in_array($rowmetode['id_metode'],explode(",", $rowindikator['metode_indikator']))) {
                    echo '<li>'.$rowmetode['nama_metode'].'</li>';
                  }
                }
            }
            ?>  </ul>          
              </td>
              <td style="text-align: left;">
                 <ul>
            <?php
            if(!empty($rowindikator['perangkat_indikator'])){
              foreach($perangkat as $rowperangkat){
                if (in_array($rowperangkat['id_perangkat'],explode(",", $rowindikator['perangkat_indikator']))) {
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
          </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
      </div> 
    </div>
  <?php echo form_close(); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">TEMPLATE FORM 3</h3>
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
                <th style="width: 5%;"></th>
                <th style="display:none;"></th>
                <th style="width: 9%;text-align: center;">Urut</th>
                <th>Elemen</th>
                <th>Asesmen</th>
                <th>Indikator</th>
              </tr>
            </thead>
          </table>
            <table id="example2" width="100%" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="vertical-align:middle;width: 5%;text-align: left;" colspan="5">
                  FORM 3
                </th>
              </tr>
            </thead>
            <tbody>
            <?php
            $kondisi2 = array('nfd.barcode_form'=>$id,'status_form_detil'=>1);
$kompetensi3 = $this->m_admin_kredensial->ambil_asesmen_dari_form_detil('nas.id_elemen','no_urut_detil','ASC',$kondisi2);
foreach ($kompetensi3 as $kompetensi3){
            ?>
            <tr>
              <td class="bg-dark" style="width:3%;">&nbsp;</td>
              <td class="bg-dark" colspan="4"><?= $kompetensi3['nama_elemen'] ?></td>
            </tr>
            <?php
            $kondisialat = array('id_elemen'=>$kompetensi3['id_elemen'],'id_kompetensi'=>$id_kompetensi,'id_instansi'=>$id_instansi);
            $alatbahan = $this->m_umum->ambil_data_kondisi('nkr_alat_bahan',$kondisialat);
            if(!empty( $alatbahan['alat'])){
              echo'<tr><td>&nbsp;</td><td>&nbsp;</td><td colspan="3" style="font-weight:bold;">ALAT DAN BAHAN</td></tr>';
            foreach($alat as $rowalat){
              if (in_array($rowalat['id_alat'],explode(",", $alatbahan['alat']))) {
            ?>
            <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>==</td>
            <td colspan="2" style="text-align: left;">
              <?= $rowalat['nama_alat'] ?>
            </td>
            </tr>
            <?php
              }
            }
          }
            $kondisi21 = array('nfd.barcode_form'=>$id,'status_form_detil'=>1,'nas.id_elemen'=>$kompetensi3['id_elemen']);
$elemen3 = $this->m_admin_kredensial->ambil_asesmen_dari_form_detil('nas.id_asesmen','no_urut_detil','ASC',$kondisi21,'nojoin');            
  foreach ($elemen3 as $rowelemen3)
  {
            ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td colspan="3"><?= $rowelemen3['nama_asesmen'] ?></td>
            </tr>
            <?php
            $kondisi211 = array('nfd.barcode_form'=>$id,'status_form_detil'=>1,'nfd.id_indikator'=>$rowelemen3['id_indikator']);
$indikator = $this->m_admin_kredensial->ambil_asesmen_dari_form_detil('nfd.id_indikator','no_urut_detil','ASC',$kondisi211,'nojoin');  
    foreach ($indikator as $rowindikator)
    {
            ?>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="vertical-align:middle;text-align: center;width:3%;">&nbsp;</td>
              <td colspan="2" style="font-weight:bold;"><?= $rowindikator['nama_indikator'] ?></td>
            </tr>
              <?php  
              if(!empty($rowindikator['metode_indikator']) || !empty($rowindikator['perangkat_indikator'])){
              ?>
            <tr>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="width:3%;">&nbsp;</td>
            <td style="text-align: left;font-weight: bold;"><?php if(!empty($rowindikator['metode_indikator'])){ echo 'METODE ASSMEN'; } ?></td>
            <td style="text-align: left;font-weight: bold;"><?php if(!empty($rowindikator['perangkat_indikator'])){ echo 'PERANGKAT ASSMEN'; } ?></td>
            </tr>
            <tr>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="width:3%;">&nbsp;</td>
              <td style="text-align: left;">
                <ul>
                  <?php
                  if(!empty($rowindikator['metode_indikator'])){
                      foreach($metode as $rowmetode){
                        if (in_array($rowmetode['id_metode'],explode(",", $rowindikator['metode_indikator']))) {
                          echo '<li>'.$rowmetode['nama_metode'].'</li>';
                        }
                      }
                  }
                  ?>  
                </ul>          
              </td>
              <td style="text-align: left;">
                 <ul>
                  <?php
                  if(!empty($rowindikator['perangkat_indikator'])){
                    foreach($perangkat as $rowperangkat){
                      if (in_array($rowperangkat['id_perangkat'],explode(",", $rowindikator['perangkat_indikator']))) {
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
          </tbody>
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
elseif ($page=="form3_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form3/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
elseif ($page=="form3_metode")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form3/simpan_metode');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <input type="hidden" name="id2" value="<?= $id2; ?>">
    <input type="hidden" name="id3" value="<?= $id3; ?>">
    <input type="hidden" name="id4" value="<?= $id4; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Perangkat Asesmen</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($metode as $rowmetode){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowmetode['id_metode'];?>" <?php if(in_array($rowmetode['id_metode'],explode(",", $metode_form_detil))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rowmetode['nama_metode'] ?></td>
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
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });  
  }); 
</script>
<?php
}
elseif ($page=="form3_perangkat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form3/simpan_perangkat');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <input type="hidden" name="id2" value="<?= $id2; ?>">
    <input type="hidden" name="id3" value="<?= $id3; ?>">
    <input type="hidden" name="id4" value="<?= $id4; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Perangkat Asesmen</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($perangkat as $rowperangkat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowperangkat['id_perangkat'];?>" <?php if(in_array($rowperangkat['id_perangkat'],explode(",", $perangkat_form_detil))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rowperangkat['nama_perangkat'] ?></td>
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
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });  
  }); 
</script>
<?php
}
elseif ($page=="form3_pertanyaan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form3/simpan_pertanyaan');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <input type="hidden" name="id2" value="<?= $id2; ?>">
    <input type="hidden" name="id3" value="<?= $id3; ?>">
    <input type="hidden" name="id4" value="<?= $id4; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
          <div class="col-md-6">
              <label>Poin yang di amati</label>
              <?php
                input_textareacustom("poin_indikator",$poin_indikator," id='editor1' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>
          <div class="col-md-6">
              <label>Indikator Ketercapaian</label>
              <?php
                input_textareacustom("ketercapaian_indikator",$ketercapaian_indikator," id='editor3' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>          
          <div class="col-md-6">
              <label>Pertanyaan</label>
              <?php
                input_textareacustom("pertanyaan_indikator",$pertanyaan_indikator," id='editor2' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>

          <div class="col-md-6">
              <label>Standar Jawaban</label>
              <?php
                input_textareacustom("jawaban_indikator",$jawaban_indikator," id='editor4' rows='5' cols='50' class='form-control' ","");
              ?>
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
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor3', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor4', {enterMode: CKEDITOR.ENTER_BR});
    }); 
</script>
<?php
}
elseif ($page=="form4_addition")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
<h4 class="box-title">JIKA DATA SUDAH MASUK VALIDASI MAKA TIDAK DAPAT DI RUBAH, SOLUSI BUAT INDIKATOR DAN TEMPLATE BARU</h4>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?> <small style="color:white;font-weight:bold;">P = Pengetahuan, K = Ketrampilan, S = Sikap</small></h3>

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
                <th style="display:none;"></th>
                <th style="vertical-align:middle;text-align: center;">Asesmen</th>
                <th style="vertical-align:middle;text-align: center;">Indikator Unjuk Kerja</th>
                <th style="vertical-align:middle;text-align: center;">Poin yang di amati</th>              
                <th style="vertical-align:middle;text-align: center;">Pertanyaan</th>
                <th style="vertical-align:middle;text-align: center;">Ketercapaian Indikator</th>  
                <th style="vertical-align:middle;text-align: center;">Standar Jawaban</th>
                <th style="vertical-align:middle;text-align: center;">Dokumen`</th>
                <th style="vertical-align:middle;text-align: center;">Pembuat</th>
                <th style="vertical-align:middle;text-align: center;">Status</th>
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
elseif ($page=="form4_addition_poin")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4_addition/simpan_poin');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
              <label>Poin yang di amati</label>
              <?php
                input_textareacustom("poin_indikator",$poin_indikator," id='editor1' rows='5' cols='50' class='form-control' ","");
              ?>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    }); 
</script>
<?php
}
elseif ($page=="form4_addition_ketercapaian")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4_addition/simpan_ketercapaian');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
              <label>Ketercapaian Indikator</label>
              <?php
                input_textareacustom("ketercapaian_indikator",$ketercapaian_indikator," id='editor1' rows='5' cols='50' class='form-control' ","");
              ?>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    }); 
</script>
<?php
}
elseif ($page=="form4_addition_dokumen")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4_addition/simpan_dokumen');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
              <label>Dokumen</label>
              <?php
                input_textareacustom("dokumen_indikator",$dokumen_indikator," id='editor1' rows='5' cols='50' class='form-control' ","");
              ?>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    }); 
</script>
<?php
}
elseif ($page=="form4_addition_pertanyaan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4_addition/simpan_pertanyaan');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
              <label>Pertanyaan</label>
              <?php
                input_textareacustom("pertanyaan_indikator",$pertanyaan_indikator," id='editor1' rows='5' cols='50' class='form-control' ","");
              ?>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    }); 
</script>
<?php
}
elseif ($page=="form4_addition_jawaban")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4_addition/simpan_jawaban');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
              <label>Standar Jawaban</label>
              <?php
                input_textareacustom("jawaban_indikator",$jawaban_indikator," id='editor1' rows='5' cols='50' class='form-control' ","");
              ?>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    }); 
</script>
<?php
}
elseif ($page=="form4_addition_rubah_opsi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.blinking {
  animation: opacity 2s ease-in-out infinite;
  opacity: 1;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4_addition/simpan_rubah_opsi');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><h3 class="box-title blinking">JANGAN LUPA ISI STANDAR JAWABAN</h3></h3>

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
          <h5>Nama Indikator : <?= $nama_indikator ?></h5>
            <p><u>KETERANGAN</u> : <br>Isian = Mengisi Jawaban
              <br>Pilihan = Memilih Salah Satu Jawaban<br>Berganda = Pilih lebih Dari 1</p>
              </div> <br>   
              <div class="col-md-12">
                  <label>Jenis Soal</label>
                    <?php
                      input_pdselect2("jenis_soal",$opsi_soal,$jenis_soal);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form4_addition_seting_jawaban")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.blinking {
  animation: opacity 2s ease-in-out infinite;
  opacity: 1;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4_addition/simpan_seting_jawaban');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title blinking">JANGAN LUPA ISI STANDAR JAWABAN</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">INI SEBAGAI STANDAR JAWABAN BUKAN PENILAIAN OTOMATIS</h3>
      </div>
        <div class="box-body">
            <div class="row">
          <div class="table-responsive" tabindex="-1">
          <div class="col-md-12">
            <table id="item_table" class="table table-hover table-transaksi table-sm">
            <thead class="bg-light">
               <tr style="background-color: #800000;color: white;">
              <th class="text-sm text-label text-center border-0" style="display: none;"></th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">No Urut</th>
              <th class="text-sm text-label text-center border-0">Soal</th>
              <th class="text-sm text-label text-center border-0" style="width: 15%">Status</th>
              <th class="text-sm text-label text-center border-0" style="width: 15%">Answer</th>
              <th class="text-sm text-label text-center border-0" style="width: 5%"></th>
              </tr>
            </thead>
            <tbody>
              <?php  
                foreach($soal as $rowsoal){
              ?>
              <tr>
              <td class="text-sm text-label border-0" style="display: none;">
              <?php
                input_text("id_soal_opsi_edit[]",$rowsoal['id_soal_opsi'],"required ","","hidden");
              ?>               
              </td>
              <td class="text-sm text-label border-0">
              <?php 
                input_textcustom("no_urut_soal_opsi_edit[]",$rowsoal['no_urut_soal_opsi']," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text");          
              ?>              
              </td>
              <td class="text-sm text-label border-0">
              <?php
                input_text("nama_soal_opsi_edit[]",$rowsoal['nama_soal_opsi'],"maxlength='255' ","Masukkan Keterangan","text");
              ?>
              </td>                            
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("status_soal_opsi_edit[]",$cmd_status,$rowsoal['status_soal_opsi']);
              ?>
              </td>
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("answer[]",$cmd_answer,$rowsoal['answer']);
              ?>
              </td>
              <td class="text-sm text-label border-0"></td>
              </tr>
            <?php  
              }
            ?>
            </tbody>
            </table>
          </div>
          <div class="col-md-12">
          <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
          </div>
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
}); 
   $(document).on('click', '.add', function(){
      var html = '';
      html += '<tr>';
      html += '<td class="text-sm text-label border-0"><input type="text" name="chk[]" value="0" class="form-control" style="text-align:right;"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3"/></td>';
      html += '<td class="text-sm text-label border-0"><input type="text" name="nama_soal_opsi[]" class="form-control"  maxlength="255" /></td>';
      html += '<td class="text-sm text-label border-0"><select name="status_soal_opsi[]" class="form-control select2"><option value="1">AKTIF</option><option value="0">NON AKTIF</option></select></td>';
      html += '<td class="text-sm text-label border-0"><select name="answer[]" class="form-control select2"><option value="1">ANSWER</option><option value="0">BUKAN</option></select></td>';
      html += '<td class="text-sm text-label border-0"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
      $('#item_table').append(html); 
      $('.select2').select2();          
  });
  $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
  }); 
</script>
<?php
}
elseif ($page=="form4")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><br>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form4_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="4">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form4_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form4_seting")
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
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/form4/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
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
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Poin yang di amati</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_indikator'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_indikator'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['poin_indikator'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;"></th>
                <th style="display:none;"></th>
                <th style="width:7%;text-align: center;">Urutan</th>
                <th>Elemen</th>
                <th>Asesmen</th>
                <th>Indikator Unjuk Kerja</th>
                <th>Poin yang diamati</th>
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
elseif ($page=="form4_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
elseif ($page=="form4b")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><br>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form4b_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4b/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="5">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form4b_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4b/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form4b_seting")
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
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/form4b/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
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
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pertanyaan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator Ketercapaian</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_indikator'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_indikator'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['pertanyaan_indikator'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['ketercapaian_indikator'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;"></th>
                <th style="display:none;"></th>
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Elemen</th>
                <th>Asesmen</th>
                <th>Indikator Unjuk Kerja</th>
                <th>Pertanyaan</th>
                <th>Indikator Ketercapaian</th>
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
elseif ($page=="form4b_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4b/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
elseif ($page=="form4c")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><br>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form4c_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4c/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="6">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div> 
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form4c_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4c/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div> 
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form4c_seting")
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
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/form4c/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
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
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pertanyaan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Standar Jawaban</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_indikator'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_indikator'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;">
            <?php 
            echo $rownkr_asesmen['pertanyaan_indikator']?>
            <br><div class="form-group">
            <?php
            if($rownkr_asesmen['jenis_soal'] > 0){ //pilihan
              $soal = $this->m_admin_kredensial->ambil_soal_opsie($rownkr_asesmen['id_indikator']);
              if($rownkr_asesmen['jenis_soal'] == 1){ // pilihan
                foreach($soal as $rowsoal){
            ?>
                <label>
                  <input type="radio" onclick="return false;" <?php if( $rowsoal['answer'] == 1){ echo 'checked'; } ?> class="minimal">&nbsp;&nbsp;<?= $rowsoal['nama_soal_opsi'] ?>
                </label><br>
            <?php
                }
              }
              if($rownkr_asesmen['jenis_soal'] == 2){ // ganda
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
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['jawaban_indikator'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;"></th>
                <th style="vertical-align: middle; display:none;"></th>
                <th style="vertical-align: middle; width: 5%;text-align: center;">Urutan</th>
                <th style="vertical-align:middle;">Elemen</th>
                <th style="vertical-align:middle;">Asesmen</th>
                <th style="vertical-align:middle;">Indikator Unjuk Kerja</th>
                <th style="vertical-align:middle;">Pertanyaan</th>
                <th style="vertical-align:middle;">Jenis</th>
                <th style="vertical-align:middle;">Standar Jawaban</th>
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
elseif ($page=="form4c_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4c/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
elseif ($page=="form4d")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
              <li>Input Untuk mengaktifkan form</li>
            </ul><br>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form4d_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4d/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="7">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form4d_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4d/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form4d_seting")
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
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/form4d/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
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
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Dokumen</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_indikator'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_indikator'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['dokumen_indikator'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;"></th>
                <th style="display:none;"></th>
                <th style="width:7%;text-align: center;">Urutan</th>
                <th>Elemen</th>
                <th>Asesmen</th>
                <th>Indikator Unjuk Kerja</th>
                <th>Dokumen</th>
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
elseif ($page=="form4d_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form4d/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
elseif ($page=="langkah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Langkah</th>
                <th>Pembuat</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
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
elseif ($page=="langkah_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/langkah/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Langkah</label>
                  <?php
                    input_text("nama_pra_asesmen",$nama_pra_asesmen,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="langkah_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/langkah/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="barcode_pra_asesmen" value="<?= $barcode_pra_asesmen; ?>">
    <input type="hidden" name="id_pra_asesmen" value="<?= $id_pra_asesmen; ?>">
    <input type="hidden" name="pembuat_pra_asesmen" value="<?= $pembuat_pra_asesmen; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Langkah</label>
                  <?php
                    input_text("nama_pra_asesmen",$nama_pra_asesmen,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="kegiatan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Langkah</th>
                <th>Kegiatan</th>
                <th>Profesi</th>
                <th>Pembuat</th>
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
elseif ($page=="kegiatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kegiatan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Kegiatan</label>
            <?php
              input_textareacustom("nama_pra_detil",$nama_pra_detil," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?> 
              </div>    
              <div class="col-md-12">
                  <label>Langkah</label>
                    <?php
                      input_pdselect2("barcode_pra_asesmen",$cmd_pra_asesmen,$barcode_pra_asesmen);

                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Profesi</label>
                    <?php
                  input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="kegiatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kegiatan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_pra_detil" value="<?= $id_pra_detil; ?>">
    <input type="hidden" name="barcode_pra_detil" value="<?= $barcode_pra_detil; ?>">
    <input type="hidden" name="pembuat_pra_detil" value="<?= $pembuat_pra_detil; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Kegiatan</label>
            <?php
              input_textareacustom("nama_pra_detil",$nama_pra_detil," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>  
              </div>    
              <div class="col-md-12">
                  <label>Langkah</label>
                    <?php
                      input_pdselect2("barcode_pra_asesmen",$cmd_pra_asesmen,$barcode_pra_asesmen);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Profesi</label>
                    <?php
                  input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="form5")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><br>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form5_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form5/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="8">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form5_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form5/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form5_seting")
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
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/form5/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
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
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
          //        input_pdselect2fleksibel("id3","id3",$cmd_jabatan,"id_jabatan","nama_jabatan",$id3,"Semua Profesi");
               input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Langkah</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kegiatan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_pra_detil'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_pra_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_pra_detil'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_jabatan'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Langkah</th>
                <th>Kegiatan</th>
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
elseif ($page=="form5_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form5/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
elseif ($page=="form6")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><br>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form6_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form6/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="9">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form6_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form6/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form6_seting")
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
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/form6/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
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
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
            //      input_pdselect2fleksibel("id3","id3",$cmd_jabatan,"id_jabatan","nama_jabatan",$id3,"Semua Profesi");
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Langkah</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kegiatan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_pra_detil'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_pra_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_pra_detil'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_jabatan'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="display:none;"></th>
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Langkah</th>
                <th>Kegiatan</th>
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
elseif ($page=="form6_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form6/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
elseif ($page=="form7")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><br>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form7_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form7/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="10">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form7_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form7/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div>
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form8")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><br>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form8_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form8/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="11">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div> 
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form8_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form8/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div> 
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="kat_kaji_ulang")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Kategori Komponen dan Aspek yang dikaji ulang</th>
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
elseif ($page=="kat_kaji_ulang_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kat_kaji_ulang/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama</label>
                  <?php
                    input_text("nama_kat_kaji",$nama_kat_kaji,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="kat_kaji_ulang_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kat_kaji_ulang/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kat_kaji" value="<?= $id_kat_kaji; ?>">
    <input type="hidden" name="pembuat_kat_kaji" value="<?= $pembuat_kat_kaji; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama</label>
                  <?php
                    input_text("nama_kat_kaji",$nama_kat_kaji,"maxlength='255' required","Masukkan Nama","text");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="kaji_ulang")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Komponen dan Aspek yang dikaji ulang</th>
                <th>Kategori</th>
                <th>Form</th>
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
elseif ($page=="kaji_ulang_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kaji_ulang/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama</label>
                  <?php
                    input_textareacustom("nama_kaji_ulang",$nama_kaji_ulang," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
                  ?>  
              </div>    
              <div class="col-md-6">
                  <label>Kategori</label>
                    <?php
                  input_pdselect2fleksibel("id_kat_kaji","id_kat_kaji",$cmd_kat_kaji,"id_kat_kaji","nama_kat_kaji",$id_kat_kaji,"Tanpa Kategori");
                    ?>          
              </div>
              <div class="col-md-6">
                  <label>Form</label>
                    <?php
                      input_pdselect2("id_jenis_form",$cmd_form,$id_jenis_form);

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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="kaji_ulang_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kaji_ulang/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kaji_ulang" value="<?= $id_kaji_ulang; ?>">
    <input type="hidden" name="pembuat_kaji_ulang" value="<?= $pembuat_kaji_ulang; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama</label>
                  <?php
                    input_textareacustom("nama_kaji_ulang",$nama_kaji_ulang," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
                  ?>  
              </div>    
              <div class="col-md-6">
                  <label>Kategori</label>
                    <?php
                  input_pdselect2fleksibel("id_kat_kaji","id_kat_kaji",$cmd_kat_kaji,"id_kat_kaji","nama_kat_kaji",$id_kat_kaji,"Tanpa Kategori");
                    ?>          
              </div>
              <div class="col-md-6">
                  <label>Form</label>
                    <?php
                      input_pdselect2("id_jenis_form",$cmd_form,$id_jenis_form);

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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="form9a")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
            <ul>
              <li>Templates ini dapat dipilih di semua asesor / admin pada instansi yang sama</li>
              <li>Hanya Pembuat form yang dapat merubah template</li>
              <li>Templates tidak bisa dihapus namun dapat di Non Aktifkan</li>
            </ul><br>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form9a_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form9a/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="12">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div> 
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form9a_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form9a/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div> 
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form9a_seting")
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
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/form9a/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
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
          <div class="box-body table-responsive">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Komponen Umpan Balik dan Kaji Ulang Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_kaji_ulang'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_kaji_ulang'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_kat_kaji'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="display:none;"></th>
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Komponen Umpan Balik dan Kaji Ulang Asesmen</th>
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
elseif ($page=="form9a_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form9a/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
elseif ($page=="form9b")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
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
                <th style="display:none;"></th>
                <th>Judul Form</th>
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
                <th>Pembuat</th>
                <th>Status</th>
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
elseif ($page=="form9b_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form9b/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="13">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div> 
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form9b_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form9b/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Judul Form</label>
                  <?php
                    input_text("nama_form",$nama_form,"maxlength='255' required","Masukkan Judul","text");
                  ?>  
              </div> 
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_form",$status,$status_form);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="form9b_seting")
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
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('admin_kredensial/form9b/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
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
          <div class="box-body table-responsive">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Umpan Balik dan Kaji Ulang Asesmen (Kesenjangan)</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_kaji_ulang'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_kaji_ulang'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_kat_kaji'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="display:none;"></th>
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Komponen Umpan Balik dan Kaji Ulang Asesmen</th>
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
elseif ($page=="form9b_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/form9b/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
}); 
</script>
<?php
}
// ======================================================================== EXCLUDE
elseif ($page=="kompetensi")
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
            <th style="display:none;width: 5%;">ID</th>
            <th style="width:10%;">Kode Unit</th>
            <th>Judul Unit</th>
            <th style="width:20%;">Jab Fung</th>
            <th style="width:10%;">Syarat</th>
            <th style="width:10%;">Status</th>
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
elseif ($page=="kompetensi_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kompetensi/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Kode Unit <span id="errmsg"></span></label>
                  <?php
                  input_textcustom("kode_unit",$kode_unit," required maxlength='35' id='kode_unit' class='form-control'",
                            "Masukkan Kode Unit","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Judul Unit</label>
                  <?php
                    input_text("nama_kompetensi",$nama_kompetensi,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Jabatan Fungsional</label>
                    <?php
                      input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Deskripsi</label>
                  <?php
                    input_textareacustom("deskripsi_kompetensi",$deskripsi_kompetensi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
$('#kode_unit').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9_]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});
$('#kode_unit').on("input",function(event) {
  var current = $(this).val();
  var replaced = current.replace(/[^a-zA-Z0-9 _]/g,'');
  $(this).val(replaced);
});
</script>
<?php
}
elseif ($page=="kompetensi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kompetensi/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kompetensi" value="<?= $id_kompetensi; ?>">
    <input type="hidden" name="creator_kompetensi" value="<?= $creator_kompetensi; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">TINDAKAN</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Kode Unit <span id="errmsg"></span></label>
                  <?php
                  input_textcustom("kode_unit",$kode_unit," required maxlength='35' id='kode_unit' class='form-control'",
                            "Masukkan Kode Unit","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Judul Unit</label>
                  <?php
                    input_text("nama_kompetensi",$nama_kompetensi,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Jabatan Fungsional</label>
                    <?php
                      input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Deskripsi</label>
                  <?php
                    input_textareacustom("deskripsi_kompetensi",$deskripsi_kompetensi," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
$('#kode_unit').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9_]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});
$('#kode_unit').on("input",function(event) {
  var current = $(this).val();
  var replaced = current.replace(/[^a-zA-Z0-9 _]/g,'');
  $(this).val(replaced);
});
</script>
<?php
}
elseif ($page=="kewenangan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('admin_kredensial/kewenangan/view/'.$key,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk Nama Kompetensi dan Kewenangan</label>
              <?php
                input_text("key",$key," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th style="width:10%;">Kode Unit</th>
                <th>Kompetensi</th>
                <th>Kewenangan</th>
                <th style="width:20%;">Jab Fung</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
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
elseif ($page=="kewenangan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kewenangan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

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
                  <label>Nama Kewenangan</label>
                  <?php
                    input_text("nama_kewenangan",$nama_kewenangan,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Kompetensi</label>
                    <?php
                      input_pdselect2("id_kompetensi",$cmd_kompetensi,$id_kompetensi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="kewenangan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kewenangan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kewenangan" value="<?= $id_kewenangan; ?>">
    <input type="hidden" name="creator_kewenangan" value="<?= $creator_kewenangan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">TINDAKAN</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama Kewenangan</label>
                  <?php
                    input_text("nama_kewenangan",$nama_kewenangan,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Kompetensi</label>
                    <?php
                      input_pdselect2("id_kompetensi",$cmd_kompetensi,$id_kompetensi);
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
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="kompetensi_syarat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kredensial/kompetensi/simpan_syarat');?>" onClick="return cek();">
    <input type="hidden" name="id_kompetensi" value="<?= $id_kompetensi; ?>">
    <input type="hidden" name="creator_kompetensi" value="<?= $creator_kompetensi; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Kompetensi <?= $kode_unit.' - '.$nama_kompetensi ?></h3>
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
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Alat dan Bahan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($kompetensi as $rowambil_nkr_alat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowambil_nkr_alat['id_kompetensi'];?>" <?php if(in_array($rowambil_nkr_alat['id_kompetensi'],explode(",", $syarat_kompetensi))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;">[ <b><?= $rowambil_nkr_alat['kode_unit'] ?></b> ] - <?= $rowambil_nkr_alat['nama_kompetensi'] ?></td>
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
      'scrollCollapse'  : true,
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}