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
            <th style="width:15%;">Instansi</th>
            <th style="width:10%;">Grade</th>
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kompetensi/kompetensi/simpan_tambah');?>" onClick="return cek();">
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
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("instansi_kompetensi",$working,$instansi_kompetensi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Grade</label>
                  <?php
                    input_pdselect2("id_grade",$grade,$id_grade);
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kompetensi/kompetensi/simpan_edit');?>" onClick="return cek();">
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
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("instansi_kompetensi",$working,$instansi_kompetensi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Instansi</label>
                  <?php
                    input_pdselect2("id_grade",$grade,$id_grade);
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
  <?php echo form_open_multipart('admin_kompetensi/kewenangan/view/'.$key,' id="signupform" ');
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
                <th style="width:25%;">Kompetensi</th>
                <th>Kewenangan</th>
                <th style="width:15%;">Jab Fung</th>
                <th style="width:15%;">Instansi</th>
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kompetensi/kewenangan/simpan_tambah');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kompetensi/kewenangan/simpan_edit');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_kompetensi/kompetensi/simpan_syarat');?>" onClick="return cek();">
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