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
    <?php
      //    echo '<pre>'; print_r($this->session->all_userdata());
    ?>

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="data_user")
{
?>
<style type="text/css">
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
    <a href="<?php echo $link_awal;?>"
      class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
  <?php echo form_open_multipart('instansi_user/data_user/view/'.$key,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik pisahkan dengan spasi untuk Pencarian Multi (Nama/Kompetensi/Kode Unit)</label>
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
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="width:5%;"></th>
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>status</th>
            <th>Instansi</th>
            <th>Unit</th>
            <th>Grade</th>
            <th>Expired</th>
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
elseif ($page=="data_user_unit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/data_user/simpan_unit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai" value="<?= $idas; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
            <label>Pilih Unit</label>
              <?php
                input_pdselect2("id_unit",$unit,$id_unit);
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
      });
</script>
<?php
}
elseif ($page=="data_user_asesor")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/data_user/simpan_asesor');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_user" value="<?= $id_user; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
            <label>Pilih Status</label>
              <?php
                input_pdselect2fleksibel("status_asesor","status_asesor",$komite,"id_komite","nama_komite",$status_asesor,"Anggota");
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
      });
</script>
<?php
}
elseif ($page=="data_user_grade")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/data_user/simpan_grade');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
            <label>Pilih Grade</label>
              <?php
                input_pdselect2("id_grade",$grade,$id_grade);
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
      });
</script>
<?php
}
elseif ($page=="pendidikan")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
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
elseif ($page=="pendidikan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/pendidikan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Pendidikan</label>
                  <?php
                    input_text("nama_pendidikan",$nama_pendidikan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
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
elseif ($page=="pendidikan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/pendidikan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_pendidikan" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Pendidikan</label>
                  <?php
                    input_text("nama_pendidikan",$nama_pendidikan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
                </div>
              </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_pendidikan",$cmd_status,$status_pendidikan);
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
elseif ($page=="unit")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Struktur</th>
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
elseif ($page=="unit_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/unit/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_unit",$nama_unit,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Struktur</label>
            <?php
              input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_unit",$cmd_status,$status_unit);
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
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="unit_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/unit/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_unit" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_unit",$nama_unit,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Struktur</label>
            <?php
              input_pdselect2("id_struktur_jabatan",$cmd_struktur_jabatan,$id_struktur_jabatan);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_unit",$cmd_status,$status_unit);
            ?>  
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
elseif ($page=="equipment")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
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
elseif ($page=="equipment_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/equipment/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Peralatan</label>
                  <?php
                    input_text("nama_equipment",$nama_equipment,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
                </div>
              </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_equipment",$cmd_status,$status_equipment);
            ?>  
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
elseif ($page=="equipment_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/equipment/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_equipment" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Peralatan</label>
                  <?php
                    input_text("nama_equipment",$nama_equipment,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
                </div>
              </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_equipment",$cmd_status,$status_equipment);
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
elseif ($page=="bahan")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
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
elseif ($page=="bahan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/bahan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_bahan",$nama_bahan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>   
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_bahan",$cmd_status,$status_bahan);
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
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="bahan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/bahan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_bahan" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_bahan",$nama_bahan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_bahan",$cmd_status,$status_bahan);
            ?>  
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
elseif ($page=="berkas_kategori")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Pembuat</th>
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
elseif ($page=="berkas_kategori_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/berkas_kategori/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
            <?php
              input_text("nama_berkas_kategori",$nama_berkas_kategori,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
          </div>
        </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Instansi</label>
            <?php
              input_pdselect2("instansi_berkas_kategori",$working,$instansi_berkas_kategori);
            ?>  
          </div>    
        </div>  
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_berkas_kategori",$cmd_status,$status_berkas_kategori);
            ?>  
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
elseif ($page=="berkas_kategori_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/berkas_kategori/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_berkas_kategori" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
            <?php
              input_text("nama_berkas_kategori",$nama_berkas_kategori,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
          </div>
        </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Instansi</label>
            <?php
              input_pdselect2("instansi_berkas_kategori",$working,$instansi_berkas_kategori);
            ?>  
          </div>    
        </div>  
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_berkas_kategori",$cmd_status,$status_berkas_kategori);
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
elseif ($page=="kategori_pelatihan")
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
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Instansi</th>
            <th>Pembuat</th>
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
elseif ($page=="kategori_pelatihan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/kategori_pelatihan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
            <?php
              input_text("nama_kategori_pelatihan",$nama_kategori_pelatihan,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
          </div>
        </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Instansi</label>
            <?php
              input_pdselect2("instansi_kategori_pelatihan",$working,$instansi_kategori_pelatihan);
            ?>  
          </div>    
        </div>  
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_pelatihan",$cmd_status,$status_kategori_pelatihan);
            ?>  
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
elseif ($page=="kategori_pelatihan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/kategori_pelatihan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kategori_pelatihan" value="<?= $id; ?>">
    <input type="hidden" name="pembuat_kategori_pelatihan" value="<?= $pembuat_kategori_pelatihan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Nama</label>
            <?php
              input_text("nama_kategori_pelatihan",$nama_kategori_pelatihan,"maxlength='255' required autofocus","Masukkan Nama","text");
            ?>  
          </div>
        </div>    
        <div class="col-md-12">
          <div class="form-group">
            <label>Instansi</label>
            <?php
              input_pdselect2("instansi_kategori_pelatihan",$working,$instansi_kategori_pelatihan);
            ?>  
          </div>    
        </div>  
        <div class="col-md-12">
          <div class="form-group">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_pelatihan",$cmd_status,$status_kategori_pelatihan);
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
elseif ($page=="struktur_jabatan")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
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
elseif ($page=="struktur_jabatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/struktur_jabatan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_struktur_jabatan",$nama_struktur_jabatan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_struktur_jabatan",$cmd_status,$status_struktur_jabatan);
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
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="struktur_jabatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/struktur_jabatan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_struktur_jabatan" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_struktur_jabatan",$nama_struktur_jabatan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_struktur_jabatan",$cmd_status,$status_struktur_jabatan);
            ?>  
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
elseif ($page=="kategori_surat")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
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
elseif ($page=="kategori_surat_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/kategori_surat/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_kategori_surat",$nama_kategori_surat,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_surat",$cmd_status,$status_kategori_surat);
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
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="kategori_surat_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/kategori_surat/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kategori_surat" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_kategori_surat",$nama_kategori_surat,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_working,$id_instansi);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_kategori_surat",$cmd_status,$status_kategori_surat);
            ?>  
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
elseif ($page=="kategori")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Unit</th>
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
elseif ($page=="kategori_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/kategori/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_golongan_pemeriksaan",$nama_golongan_pemeriksaan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_unit",$ambil_unit,$id_unit);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_golongan_pemeriksaan",$cmd_status,$status_golongan_pemeriksaan);
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
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="kategori_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/kategori/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_golongan_pemeriksaan" value="<?= $id_golongan_pemeriksaan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_golongan_pemeriksaan",$nama_golongan_pemeriksaan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_unit",$ambil_unit,$id_unit);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_golongan_pemeriksaan",$cmd_status,$status_golongan_pemeriksaan);
            ?>  
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
elseif ($page=="tindakan")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Golongan Pemeriksaan</th>
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
elseif ($page=="tindakan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/tindakan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_tindakan",$nama_tindakan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Golongan Pemeriksaan</label>
            <?php
              input_pdselect2("id_golongan_pemeriksaan",$ambil_golongan,$id_golongan_pemeriksaan);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_tindakan",$cmd_status,$status_tindakan);
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
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="tindakan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/tindakan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_tindakan" value="<?= $id_tindakan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_tindakan",$nama_tindakan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Golongan Pemeriksaan</label>
            <?php
              input_pdselect2("id_golongan_pemeriksaan",$ambil_golongan,$id_golongan_pemeriksaan);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_tindakan",$cmd_status,$status_tindakan);
            ?>  
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
elseif ($page=="pengirim")
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
            <th>Nama</th>
            <th>Email</th>
            <th>Kontak</th>
            <th>Alamat</th>
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
elseif ($page=="pengirim_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/pengirim/simpan_tambah');?>" onClick="return cek();">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                      <label>Nama</label>
                      <?php
                        input_text("nama_rujukan_dokter",$nama_rujukan_dokter,"maxlength='255' required autofocus","Masukkan Angka dan Huruf","text");
                      ?>  
                  </div>    
                  <div class="col-md-6">
                      <label>Email</label>
                        <?php
                          input_text("email_rujukan_dokter",$email_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>
                  <div class="col-md-6">
                      <label>Kontak</label>
                        <?php
                          input_text("kontak_rujukan_dokter",$kontak_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>    
                  <div class="col-md-6">
                      <label>Alamat</label>
                        <?php
                          input_text("alamat_rujukan_dokter",$alamat_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>  
                  <div class="col-md-6">
                      <label>Propinsi</label>
                      <?php
                        input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dulu");
                      ?>
                  </div>
                  <div class="col-md-6">
                      <label>Kota/Kabupaten</label>
                      <?php
                        input_pdselect2("id_kab",$kab,$id_kab);
                      //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                      ?>
                  </div>
                  <div class="col-md-6">
                      <label>Kecamatan</label>
                      <?php
                        input_pdselect2("id_kec",$kec,$id_kec);
                      //  echo form_dropdown('id_kec',$kec,'0',array('id'=>'id_kec','class'=>'form-control'));
                      ?>
                  </div>
                  <div class="col-md-6">
                      <label>Kelurahan</label>
                      <?php
                        input_pdselect2("id_kel",$kel,$id_kel);
                      //  echo form_dropdown('id_kel',$kel,'0',array('id'=>'id_kel','class'=>'form-control'));
                      ?>
                  </div>      
                </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>instansi_user/kab_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
                $("#id_kab").empty();
                $("#id_kec").empty();
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kab"];
                    var name = data[i]["nama_kab"];

                    $("#id_kab").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });

    $('select[name=id_kab]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>instansi_user/kec_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_kec").empty();
                $("#id_kel").empty();

                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kec"];
                    var name = data[i]["nama_kec"];

                    $("#id_kec").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });

    $('select[name=id_kec]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>instansi_user/kel_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kel"];
                    var name = data[i]["nama_kel"];

                    $("#id_kel").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
</script>
<?php
}
elseif ($page=="pengirim_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/pengirim/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_rujukan_dokter" value="<?= $id_rujukan_dokter; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title; ?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                  <div class="col-md-6">
                      <label>Nama</label>
                      <?php
                        input_text("nama_rujukan_dokter",$nama_rujukan_dokter,"maxlength='255' required autofocus","Masukkan Angka dan Huruf","text");
                      ?>  
                  </div>   
                  <div class="col-md-6">
                      <label>Email</label>
                        <?php
                          input_text("email_rujukan_dokter",$email_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>
                  <div class="col-md-6">
                      <label>Kontak</label>
                        <?php
                          input_text("kontak_rujukan_dokter",$kontak_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>    
                  <div class="col-md-6">
                      <label>Alamat</label>
                        <?php
                          input_text("alamat_rujukan_dokter",$alamat_rujukan_dokter,"maxlength='255' ","Masukkan Angka dan Huruf","text");
                        ?>          
                  </div>  
                  <div class="col-md-6">
                      <label>Propinsi</label>
                      <?php
                        input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dulu");
                      ?>
                  </div>
                  <div class="col-md-6">
                      <label>Kota/Kabupaten</label>
                      <?php
                        input_pdselect2("id_kab",$kab,$id_kab);
                      //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                      ?>
                  </div>
                  <div class="col-md-6">
                      <label>Kecamatan</label>
                      <?php
                        input_pdselect2("id_kec",$kec,$id_kec);
                      //  echo form_dropdown('id_kec',$kec,'0',array('id'=>'id_kec','class'=>'form-control'));
                      ?>
                  </div>
                  <div class="col-md-6">
                      <label>Kelurahan</label>
                      <?php
                        input_pdselect2("id_kel",$kel,$id_kel);
                      //  echo form_dropdown('id_kel',$kel,'0',array('id'=>'id_kel','class'=>'form-control'));
                      ?>
                  </div>      
                </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
}); 
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>instansi_user/kab_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
                $("#id_kab").empty();
                $("#id_kec").empty();
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kab"];
                    var name = data[i]["nama_kab"];

                    $("#id_kab").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });

    $('select[name=id_kab]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>instansi_user/kec_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_kec").empty();
                $("#id_kel").empty();

                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kec"];
                    var name = data[i]["nama_kec"];

                    $("#id_kec").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });

    $('select[name=id_kec]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>instansi_user/kel_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kel"];
                    var name = data[i]["nama_kel"];

                    $("#id_kel").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
</script>
<?php
}
elseif ($page=="other")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kontak</th>
            <th>Alamat</th>
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
elseif ($page=="other_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/other/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_other",$nama_other,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
              <div class="col-md-6">
                  <label>Email</label>
                  <?php
                    input_text("email_other",$email_other,"maxlength='255' required autofocus","Masukkan Email","text");
                  ?>  
              </div>  
              <div class="col-md-6">
                  <label>Kontak</label>
                  <?php
                    input_text("kontak_other",$kontak_other,"maxlength='255' required autofocus","Masukkan Kontak No HP / WA","text");
                  ?>  
              </div> 
              <div class="col-md-6">
                  <label>Alamat</label>
                  <?php
                    input_text("alamat_other",$alamat_other,"maxlength='255' required autofocus","Masukkan Alamat","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Propinsi</label>
            <?php
              input_pdselect2("id_prov",$kol_provinsi,$id_prov);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Kabupaten</label>
            <?php
              input_pdselect2("id_kab",$kab,$id_kab);
            ?>  
        </div> 
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_other",$cmd_status,$status_other);
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
$(document).ready(function() {
  $('.select2').select2()
}); 
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>instansi_user/kab_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
                $("#id_kab").empty();
                $("#id_kec").empty();
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kab"];
                    var name = data[i]["nama_kab"];

                    $("#id_kab").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
</script>
<?php
}
elseif ($page=="other_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('instansi_user/other/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_other" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_other",$nama_other,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
              <div class="col-md-6">
                  <label>Email</label>
                  <?php
                    input_text("email_other",$email_other,"maxlength='255' required autofocus","Masukkan Email","text");
                  ?>  
              </div>  
              <div class="col-md-6">
                  <label>Kontak</label>
                  <?php
                    input_text("kontak_other",$kontak_other,"maxlength='255' required autofocus","Masukkan Kontak No HP / WA","text");
                  ?>  
              </div> 
              <div class="col-md-6">
                  <label>Alamat</label>
                  <?php
                    input_text("alamat_other",$alamat_other,"maxlength='255' required autofocus","Masukkan Alamat","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Propinsi</label>
            <?php
              input_pdselect2("id_prov",$kol_provinsi,$id_prov);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Kabupaten</label>
            <?php
              input_pdselect2("id_kab",$kab,$id_kab);
            ?>  
        </div> 
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_other",$cmd_status,$status_other);
            ?>  
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
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>instansi_user/kab_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
                $("#id_kab").empty();
                $("#id_kec").empty();
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kab"];
                    var name = data[i]["nama_kab"];

                    $("#id_kab").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
</script>
<?php
}
elseif ($page=="rs")
{
?>
<style type="text/css">
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}

.table-y {
  table-layout: fixed;
  display: block;
  height: 500px;
  overflow-y: auto;
}
.table-y          { overflow: auto; height: 500px; }
.table-y thead th { position: sticky; top: 0; z-index: 1; }
.table-y tbody th { position: sticky; left: 0; }
</style>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
<div class="content-wrapper">
  <section class="content-header">
  <a href="<?php echo $link_awal;?>"
    class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
  </a>
  </section>
  <section class="content">
    <div class="box box-<?php echo $thenarray; ?> box-solid">
      <div class="box-header with-border">
         <h3 class="box-title">Silahkan Pilih Instansi</h3>
        <div class="box-tools pull-right"></div>
      </div>
<?php echo form_open_multipart('instansi_user/rs/view/'.$id.'/'.$id2,' id="signupform" '); ?>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Instansi</label>
                <?php
                  input_pdselect2("id",$working,$id);
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Profesi</label>
                <?php
                  input_pdselect2fleksibel("id2","id2",$jabatan,"id_jabatan","nama_jabatan",$id2,"Semua Profesi");
                //  input_pdselect2("id2",$jabatan,$id2);
                ?>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
<?php echo form_close(); ?>
    </div>
<?php  
  if(empty($id2)){
    $kondisi_grup_unit = array('opi.id_instansi'=>$id);
  }else{
    $kondisi_grup_unit = array('opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);        
  }
  $ambil_unit_pegawai = $this->m_instansi_user->ambil_list_unit_pegawai($kondisi_grup_unit,'opu.id_unit');
  foreach($ambil_unit_pegawai as $rowambil_unit_pegawai){
  ?>
    <div class="box box-<?php echo $thenarray; ?> box-solid">
      <div class="box-header with-border">
         <h3 class="box-title"><?= $rowambil_unit_pegawai['nama_unit'] ?></h3>
        <div class="box-tools pull-right"></div>
      </div>
      <div class="box-body">
        <div class="row">
<!-- start 1 -->
        <div class="col-md-8">
<?php  
  if(empty($id2)){
    $kondisi_per_unit = array('opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
  }else{
    $kondisi_per_unit = array('opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);        
  }
$nografik_pegawai_kab = 0;
$ambil_list_pegawai = $this->m_instansi_user->ambil_list_unit_pegawai($kondisi_per_unit);
foreach ($ambil_list_pegawai as $rowambil_list_pegawai){
$nografik_pegawai_kab++;
//---------- a ambil_list_pegawai
?>
<div class="col-md-6">
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover table-y">
      <thead>
      <tr>
        <th style="width: 5%;"><?= $nografik_pegawai_kab ?></th>
        <th colspan='6' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowambil_list_pegawai['nama_pegawai'] ?></th>
      </tr>        
      </thead>
      <tbody>
         <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='5' style="font-weight:bold;">Gender : 
            <?php 
              if($rowambil_list_pegawai['jk'] == 0){ echo 'Perempuan';}else{ echo 'laki-laki'; }
            ?>
          </td>
          <td rowspan="2" style="width: 15%;">
  <?php 
  if(empty($rowambil_list_pegawai['foto'])){
    $picprofile=base_url().'assets/images/noavatar.jpg';        
  }else{
    $cek_filesmall=FCPATH.'assets/foto/ol/'.$rowambil_list_pegawai['foto'];
    if(file_exists($cek_filesmall)){
      $picprofile=base_url().'assets/foto/ol/'.$rowambil_list_pegawai['foto'];
    }else{
      $picprofile=base_url().'assets/images/noavatar.jpg';
    }       
  }
  ?>
  <a class="example-image-link" href="<?php echo $picprofile; ?>"
    data-lightbox="example-set" data-title="<?php echo $rowambil_list_pegawai['nama_pegawai']; ?>">
    <img class="profile-user-img img-responsive img-circle" src="<?php echo $picprofile; ?>" style="width: 50px;height: 50px;" alt="Photo">
  </a>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='5' style="font-weight:bold;">TTL : 
            <?php 
              echo $rowambil_list_pegawai['tmp_lahir'].", ". $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_list_pegawai['tgl_lahir'])));    
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Age : 
            <?php 
              echo $this->m_rancak->dob($rowambil_list_pegawai['tgl_lahir']);
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Agama : 
            <?php 
              $rel = $this->m_umum->ambil_data('kol_agama','id_agama',$rowambil_list_pegawai['id_agama']);
              echo $rel['nama_agama'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Marital : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowambil_list_pegawai['id_status_kawin']);
              echo $mar['nama_status_kawin'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Status Pegawai : 
            <?php 
              $st = $this->m_umum->ambil_data('ol_status_pegawai','id_status_pegawai',$rowambil_list_pegawai['id_status_pegawai']);
              echo $st['nama_status_pegawai'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Jabatan : 
            <?php 
              $jf = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowambil_list_pegawai['id_jabatan_fungsional']);
              echo $jf['nama_jabatan_fungsional'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Pendidikan Terakhir : 
            <?php 
              $pen = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowambil_list_pegawai['id_pendidikan']);
               echo $pen['nama_pendidikan'];        
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Ruangan : 
            <?php 
              $kondisi_unit = array('id_instansi'=>$id,'id_pegawai'=>$rowambil_list_pegawai['id_pegawai']);
              $unitpeg = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_pegawai_unit',$kondisi_unit,'ol_unit','id_unit');
              if(empty($unitpeg['nama_unit'])){
                echo'<button class="btn btn-danger btn-xs">Unit Belum Di Tambah</button>';
              }else{
               echo $unitpeg['nama_unit'];        
              }
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Grade : 
            <?php 
              $grade = $this->m_umum->ambil_data('ol_pegawai_grade','id_grade',$rowambil_list_pegawai['id_grade']);
              if(empty($grade['nama_grade'])){
                echo'<button class="btn btn-danger btn-xs">Grade Belum Di Set</button>';
              }else{
               echo $grade['nama_grade'];        
              }
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</td>
        </tr>
        <tr>
  <?php  
  $dateb = date("Y-m-d", strtotime("+3 month"));
  $expired_str_kab=$this->m_instansi_user->ambil_berkas_from_list($rowambil_list_pegawai['id_pegawai'],1,$id,$id2);
  foreach ($expired_str_kab as $rowexpired_str_kab){
  ?>
        <td>&nbsp;</td>
        <td>STR</td>
        <td>
        <?php 
          if($rowexpired_str_kab['tgl_b_berkas'] <= date('Y-m-d')){
        ?>
               <button class="btn btn-danger btn-xs">
                  <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                </button>    
        <?php 
          }elseif(($rowexpired_str_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_str_kab['tgl_b_berkas'] <= $dateb)){
        ?>
               <button class="btn btn-warning btn-xs">
                  <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                </button> 
        <?php 
          }else{
         ?>
               <button class="btn btn-success btn-xs">
                  <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                </button>            
        <?php             
          }
        ?>
        </td>
  <?php  
  } 
  $expired_sip_kab=$this->m_instansi_user->ambil_berkas_from_list($rowambil_list_pegawai['id_pegawai'],2,$id,$id2);
  foreach ($expired_sip_kab as $rowexpired_sip_kab){
  ?>
            <td>SIP</td>
            <td>
            <?php 
              if($rowexpired_sip_kab['tgl_b_berkas'] <= date('Y-m-d')){
            ?>
                   <button class="btn btn-danger btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                    </button>    
            <?php 
              }elseif(($rowexpired_sip_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sip_kab['tgl_b_berkas'] <= $dateb)){
            ?>
                   <button class="btn btn-warning btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                    </button> 
            <?php 
              }else{
             ?>
                   <button class="btn btn-success btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                    </buttotd>            
            <?php             
              }
            ?>
            </td>
  <?php  
  }
  $expired_sik_kab=$this->m_instansi_user->ambil_berkas_from_list($rowambil_list_pegawai['id_pegawai'],3,$id,$id2);
  foreach ($expired_sik_kab as $rowexpired_sik_kab){
  ?>
            <td>SIK</td>
            <td>
            <?php 
              if($rowexpired_sik_kab['tgl_b_berkas'] <= date('Y-m-d')){
            ?>
                   <button class="btn btn-danger btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                    </button>    
            <?php 
              }elseif(($rowexpired_sik_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sik_kab['tgl_b_berkas'] <= $dateb)){
            ?>
                   <button class="btn btn-warning btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                    </button> 
            <?php 
              }else{
             ?>
                   <button class="btn btn-success btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                    </button>            
            <?php             
              }
            ?>
            </td>
  <?php  
  }
  ?>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: darkred;color: white; font-weight:bold;">PENILAIAN KINERJA</td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">KINERJA KLINIS</td>
        </tr>
  <?php
  $logbook_person=$this->m_instansi_user->ambil_grafik_logbook_person($rowambil_list_pegawai['id_pegawai']);
  foreach ($logbook_person as $rowlogbook_person){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='3'><?= $rowlogbook_person['thnlg'] ?></td>
            <td style="text-align:right;" colspan='3'><?= $rowlogbook_person['jml_logbookp'] ?></td>
          </tr>
  <?php  
  }
  ?>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">ETIKA PROFESI</td>
        </tr>
  <?php
  $etikae=$this->m_instansi_user->ambil_grafik_etik_person($rowambil_list_pegawai['id_pegawai']);
  foreach ($etikae as $rowetikae){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='3'>
              <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowetikae['tgl_etik_pegawai']))) ?> [Penguji : <?= $rowetikae['nama_pegawai'] ?>]
            </td>
            <td style="text-align:left;" colspan='3'><?= $rowetikae['hasil_etik'] ?></td>
          </tr>
  <?php  
  }
  ?>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PENGEMBANGAN PROFESI</td>
        </tr>
  <?php
  $ambil_pelatihan_person=$this->m_instansi_user->ambil_berkas_pelatihan_biasa('peg.id_pegawai',$rowambil_list_pegawai['id_pegawai'],$id,$id2);
  foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='6'><?= $rowambil_pelatihan_person['nama_berkas'] ?><br>Tanggal :  <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_b_berkas']))) ?></td>
          </tr>
  <?php  
  }
  $ambil_pelatihan_person=$this->m_instansi_user->ambil_berkas_pelatihan_person('peg.id_pegawai',$rowambil_list_pegawai['id_pegawai'],$id,$id2);
  foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='6'><u>Kategori Pelatihan : <?= $rowambil_pelatihan_person['nama_kategori_pelatihan'] ?></u><br><?= $rowambil_pelatihan_person['nama_berkas'] ?><br>Tanggal :  <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_b_berkas']))) ?></td>
          </tr>
  <?php  
  }
  ?>            
      </tbody>

    </table>
  </div><br style="line-height:50px;">
</div>
<?php  
//---------- z ambil_list_pegawai
}
?>
        </div>
<!-- end 1 -->
<!-- start 2 -->
        <div class="col-md-4">
          <h5 class="box-title" style="font-weight:bold;">DEMOGRAFI</h5>
<?php 
$laki = 0;$pr = 0;
if(empty($id2)){
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
}else{
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);  
}

$select_gender = "SUM(CASE WHEN jk = '1' THEN 1 END) as mlc,SUM(CASE WHEN jk = '0' THEN 1 END) as flc";
$gender=$this->m_instansi_user->grafik_all_unit_pegawai($select_gender,$kondisi_1);

$select_unitpegawai = "COUNT(opi.id_unit) as total_unit,nama_unit,opi.id_unit";
$unitpegawai=$this->m_instansi_user->unit_all_pegawai($select_unitpegawai,$kondisi_1,'opi.id_unit');

$select_agama = "COUNT(ope.id_agama) as total_agama,nama_agama,ope.id_agama";
$agama=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_agama,$kondisi_1,'ope.id_agama');

$select_status_kawin = "COUNT(ope.id_status_kawin) as total_status_kawin,nama_status_kawin";
$status_kawin=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_status_kawin,$kondisi_1,'ope.id_status_kawin');

$select_status_pegawai = "COUNT(ope.tipe_pegawai) as total_status_pegawai,nama_status_pegawai";
$status_pegawai=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_status_pegawai,$kondisi_1,'ope.tipe_pegawai');

$select_pendidikan = "COUNT(ope.id_pendidikan) as total_pendidikan,nama_pendidikan";
$pendidikan=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_pendidikan,$kondisi_1,'ope.id_pendidikan');

$select_jabatan_fungsional = "COUNT(ope.id_jabatan_fungsional) as total_jabatan_fungsional,nama_jabatan_fungsional";
$jf=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_jabatan_fungsional,$kondisi_1,'ope.id_jabatan_fungsional');

$select_bebankerja = "sum(jml_logbook) as jml_logbooku,DATE_FORMAT(tgl_logbook,'%Y') as thnlgu";
$bebankerja=$this->m_instansi_user->ambil_grafik_logbook($select_bebankerja,$kondisi_1,'ope.id_jabatan_fungsional');

$select_grade = "COUNT(ope.id_grade) as total_grade,nama_grade";
$gradee=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_grade,$kondisi_1,'ope.id_grade');

$select_pelatihan = "COUNT(peg.id_pegawai) as total_pelatihan,if(ob.id_kategori_pelatihan=0,'Pelatihan Umum',nama_kategori_pelatihan) as nama_kategori_pelatihan";
$pelatihan=$this->m_instansi_user->ambil_berkas_unit_pelatihan_person($kondisi_1,'ob.id_kategori_pelatihan',$select_pelatihan);
if(empty($id2)){
$kondisi_expired_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
$kondisi_expired_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
$kondisi_expired_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
$kondisi_aktif_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >'=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
$kondisi_aktif_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >'=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
$kondisi_aktif_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >'=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
$kondisi_tenggang_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
$kondisi_tenggang_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
$kondisi_tenggang_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
}else{
  $kondisi_expired_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
  $kondisi_expired_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
  $kondisi_expired_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas <='=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
  $kondisi_aktif_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >'=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
  $kondisi_aktif_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >'=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
  $kondisi_aktif_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >'=>date('Y-m-d'),'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
  $kondisi_tenggang_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
  $kondisi_tenggang_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
  $kondisi_tenggang_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
}

$expired_str=$this->m_instansi_user->ambil_berkas_ijin_unit($kondisi_expired_str);

$expired_sip=$this->m_instansi_user->ambil_berkas_ijin_unit($kondisi_expired_sip);

$expired_sik=$this->m_instansi_user->ambil_berkas_ijin_unit($kondisi_expired_sik);


$aktif_str=$this->m_instansi_user->ambil_berkas_ijin_unit($kondisi_aktif_str);

$aktif_sip=$this->m_instansi_user->ambil_berkas_ijin_unit($kondisi_aktif_sip);

$aktif_sik=$this->m_instansi_user->ambil_berkas_ijin_unit($kondisi_aktif_sik);

$tenggang_str=$this->m_instansi_user->ambil_berkas_ijin_unit($kondisi_tenggang_str);

$tenggang_sip=$this->m_instansi_user->ambil_berkas_ijin_unit($kondisi_tenggang_sip);

$tenggang_sik=$this->m_instansi_user->ambil_berkas_ijin_unit($kondisi_tenggang_sik);

$select_prov = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov";
$prov=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_prov,$kondisi_1,'ope.id_prov');
?>
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
      <tr>
        <td style="background-color:#063970;color:white;vertical-align:middle;">Gender</td>
        <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;">Laki-laki</td>
        <td style="vertical-align:middle;text-align: right;"><?= $gender['mlc'] ?></td>
      </tr>
      <tr>
        <td style="vertical-align:middle;">Perempuan</td>
        <td style="vertical-align:middle;text-align: right;"><?= $gender['flc'] ?></td>
      </tr>
      <tr>
        <td style="background-color:#979915;color:white;vertical-align:middle;">Agama</td>
        <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
      </tr>
<?php
foreach ($agama as $rowagama){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowagama['nama_agama'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowagama['total_agama'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Marital</td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($status_kawin as $rowstatus_kawin){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_kawin['nama_status_kawin'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_kawin['total_status_kawin'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Status Pegawai</td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($status_pegawai as $rowstatus_pegawai){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_pegawai['nama_status_pegawai'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_pegawai['total_status_pegawai'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">Pendidikan</td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pendidikan as $rowpendidikan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpendidikan['nama_pendidikan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpendidikan['total_pendidikan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Jabatan Fungsional</td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($jf as $rowjf){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowjf['nama_jabatan_fungsional'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowjf['total_jabatan_fungsional'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">Ruangan / Unit 
      </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($unitpegawai as $rowunitpegawai){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowunitpegawai['nama_unit'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowunitpegawai['total_unit'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Grade</td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($gradee as $rowgrade){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowgrade['nama_grade'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowgrade['total_grade'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Kinerja Klinis</td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($bebankerja as $rowbebankerja){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowbebankerja['thnlgu'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowbebankerja['jml_logbooku'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Pengembangan Profesi</td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pelatihan as $rowpelatihan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpelatihan['nama_kategori_pelatihan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpelatihan['total_pelatihan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">Surat Ijin</td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($aktif_str as $rowaktif_str){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif STR</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($aktif_sip as $rowaktif_sip){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif SIP</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($aktif_sik as $rowaktif_sik){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif SIK</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_sik['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($tenggang_str as $rowtenggang_str){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang STR</td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($tenggang_sip as $rowtenggang_sip){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang SIP</td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($tenggang_sik as $rowtenggang_sik){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang SIK</td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_sik['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_str as $rowexpired_str){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired STR</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_sip as $rowexpired_sip){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIP</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_sik as $rowexpired_sik){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIK</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sik['total_str'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="vertical-align:middle;">Alamat</td>
      <td style="vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($prov as $rowprov){
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;"><?= $rowprov['nama_prov'] ?></td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;"><?= $rowprov['total_prov'] ?></td>
    </tr>
<?php 
if(empty($id2)){
$kondisi_kab=array('status_pegawai'=>1,'visible'=>1,'ope.id_prov'=>$rowprov['id_prov'],'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
}else{
$kondisi_kab=array('status_pegawai'=>1,'visible'=>1,'ope.id_prov'=>$rowprov['id_prov'],'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);  
}
$select_kab = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kab=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_kab,$kondisi_kab,'ope.id_kab');

  foreach ($kab as $rowkab){
?>
    <tr>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;padding-left: 20px;">&nbsp;&nbsp;<?= $rowkab['nama_kab'] ?></td>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;text-align: right;"><?= $rowkab['total_kab'] ?></td>
    </tr>
<?php
if(empty($id2)){
$kondisi_kec=array('status_pegawai'=>1,'visible'=>1,'ope.id_kab'=>$rowkab['id_kab'],'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
}else{
$kondisi_kec=array('status_pegawai'=>1,'visible'=>1,'ope.id_kab'=>$rowkab['id_kab'],'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
}
$select_kec = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kec=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_kec,$kondisi_kec,'ope.id_kec');

    foreach ($kec as $rowkec){
?>
    <tr>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;padding-left: 35px;"><?= $rowkec['nama_kec'] ?></td>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;text-align: right;"><?= $rowkec['total_kec'] ?></td>
    </tr>
<?php
if(empty($id2)){
$kondisi_kel=array('status_pegawai'=>1,'visible'=>1,'ope.id_kec'=>$rowkec['id_kec'],'opu.id_unit'=>$rowambil_unit_pegawai['id_unit']);
}else{
$kondisi_kel=array('status_pegawai'=>1,'visible'=>1,'ope.id_kec'=>$rowkec['id_kec'],'opu.id_unit'=>$rowambil_unit_pegawai['id_unit'],'jf.id_jabatan'=>$id2);
}
$select_kel = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kel=$this->m_instansi_user->grafik_all_unit_pegawai_result($select_kel,$kondisi_kel,'ope.id_kel');

      foreach ($kel as $rowkel){
?>
    <tr>
      <td style="background-color:#238C07;color:white;vertical-align:middle;padding-left: 50px;"><?= $rowkel['nama_kel'] ?></td>
      <td style="background-color:#238C07;color:white;vertical-align:middle;text-align: right;"><?= $rowkel['total_kel'] ?></td>
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
<!-- end 2 -->
        </div>
      </div>
    </div>
  <?php
  }
?>
  </section>
</div>
<?php
}
elseif ($page=="demografi")
{
?>
<style type="text/css">
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
#myBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  font-size: 18px;
  border: none;
  outline: none;
  background-color: red;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 4px;
}

#myBtn:hover {
  background-color: #555;
}

.table-y {
  table-layout: fixed;
  display: block;
  height: 500px;
  overflow-y: auto;
}
.table-y          { overflow: auto; height: 500px; }
.table-y thead th { position: sticky; top: 0; z-index: 1; }
.table-y tbody th { position: sticky; left: 0; }
</style>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
<div class="content-wrapper">
  <section class="content-header">
  <a href="<?php echo $link_awal;?>"
    class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
  </a>
  </section>
  <section class="content">
    <div class="box box-<?php echo $thenarray; ?> box-solid">
      <div class="box-header with-border">
         <h3 class="box-title">Silahkan Pilih Instansi</h3>
        <div class="box-tools pull-right"></div>
      </div>
<?php echo form_open_multipart('instansi_user/demografi/view/'.$id.'/'.$id2,' id="signupform" '); ?>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Instansi</label>
                <?php
                  input_pdselect2("id",$working,$id);
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Profesi</label>
                <?php
                  input_pdselect2fleksibel("id2","id2",$jabatan,"id_jabatan","nama_jabatan",$id2,"Semua Profesi");
                //  input_pdselect2("id2",$jabatan,$id2);
                ?>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
<?php echo form_close(); ?>
    </div>
    <div class="box box-<?php echo $thenarray; ?> box-solid">
      <div class="box-header with-border">
         <h3 class="box-title"><?= $title ?></h3>
        <div class="box-tools pull-right"></div>
      </div>
      <div class="box-body">
      <div class="row">
<!-- start 1 -->
        <div class="col-md-8">
          <h5 class="box-title" style="font-weight:bold;">Pegawai di instansi : <?= $gawe_sekien ?> dengan jabatan : <?= $jab_sekien ?></h5>
<?php  
$nografik_pegawai_kab = 0;
$ambil_list_pegawai = $this->m_instansi_user->ambil_list_pegawai($id,$id2);
foreach ($ambil_list_pegawai as $rowambil_list_pegawai){
$nografik_pegawai_kab++;
//---------- a ambil_list_pegawai
?>
<div class="col-md-6">
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover table-y">
      <thead>
      <tr>
        <th style="width: 5%;"><?= $nografik_pegawai_kab ?></th>
        <th colspan='6' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowambil_list_pegawai['nama_pegawai'] ?></th>
      </tr>        
      </thead>
      <tbody>
         <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='5' style="font-weight:bold;">Gender : 
            <?php 
              if($rowambil_list_pegawai['jk'] == 0){ echo 'Perempuan';}else{ echo 'laki-laki'; }
            ?>
          </td>
          <td rowspan="2" style="width: 15%;">
  <?php 
  if(empty($rowambil_list_pegawai['foto'])){
    $picprofile=base_url().'assets/images/noavatar.jpg';        
  }else{
    $cek_filesmall=FCPATH.'assets/foto/ol/'.$rowambil_list_pegawai['foto'];
    if(file_exists($cek_filesmall)){
      $picprofile=base_url().'assets/foto/ol/'.$rowambil_list_pegawai['foto'];
    }else{
      $picprofile=base_url().'assets/images/noavatar.jpg';
    }       
  }
  ?>
  <a class="example-image-link" href="<?php echo $picprofile; ?>"
    data-lightbox="example-set" data-title="<?php echo $rowambil_list_pegawai['nama_pegawai']; ?>">
    <img class="profile-user-img img-responsive img-circle" src="<?php echo $picprofile; ?>" style="width: 50px;height: 50px;" alt="Photo">
  </a>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='5' style="font-weight:bold;">TTL : 
            <?php 
              echo $rowambil_list_pegawai['tmp_lahir'].", ". $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_list_pegawai['tgl_lahir'])));    
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Age : 
            <?php 
              echo $this->m_rancak->dob($rowambil_list_pegawai['tgl_lahir']);
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Agama : 
            <?php 
              $rel = $this->m_umum->ambil_data('kol_agama','id_agama',$rowambil_list_pegawai['id_agama']);
              echo $rel['nama_agama'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Marital : 
            <?php 
              $mar = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowambil_list_pegawai['id_status_kawin']);
              echo $mar['nama_status_kawin'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Status Pegawai : 
            <?php 
              $st = $this->m_umum->ambil_data('ol_status_pegawai','id_status_pegawai',$rowambil_list_pegawai['id_status_pegawai']);
              echo $st['nama_status_pegawai'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Jabatan : 
            <?php 
              $jf = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowambil_list_pegawai['id_jabatan_fungsional']);
              echo $jf['nama_jabatan_fungsional'];
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Pendidikan Terakhir : 
            <?php 
              $pen = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowambil_list_pegawai['id_pendidikan']);
               echo $pen['nama_pendidikan'];        
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Ruangan : 
            <?php 
              $kondisi_unit = array('id_instansi'=>$id,'id_pegawai'=>$rowambil_list_pegawai['id_pegawai']);
              $unitpeg = $this->m_umum->ambil_data_kondisi_2tabel_row('ol_pegawai_unit',$kondisi_unit,'ol_unit','id_unit');
              if(empty($unitpeg['nama_unit'])){
                echo'<button class="btn btn-danger btn-xs">Unit Belum Di Tambah</button>';
              }else{
               echo $unitpeg['nama_unit'];        
              }
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="font-weight:bold;">Grade : 
            <?php 
              $grade = $this->m_umum->ambil_data('ol_pegawai_grade','id_grade',$rowambil_list_pegawai['id_grade']);
              if(empty($grade['nama_grade'])){
                echo'<button class="btn btn-danger btn-xs">Grade Belum Di Set</button>';
              }else{
               echo $grade['nama_grade'];        
              }
            ?>
          </td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</td>
        </tr>
        <tr>
  <?php  
  $dateb = date("Y-m-d", strtotime("+3 month"));
  $expired_str_kab=$this->m_instansi_user->ambil_berkas_from_list($rowambil_list_pegawai['id_pegawai'],1,$id,$id2);
  foreach ($expired_str_kab as $rowexpired_str_kab){
  ?>
        <td>&nbsp;</td>
        <td>STR</td>
        <td>
        <?php 
          if($rowexpired_str_kab['tgl_b_berkas'] <= date('Y-m-d')){
        ?>
               <button class="btn btn-danger btn-xs">
                  <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                </button>    
        <?php 
          }elseif(($rowexpired_str_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_str_kab['tgl_b_berkas'] <= $dateb)){
        ?>
               <button class="btn btn-warning btn-xs">
                  <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                </button> 
        <?php 
          }else{
         ?>
               <button class="btn btn-success btn-xs">
                  <?= date('d-m-Y', strtotime($rowexpired_str_kab['tgl_b_berkas'])) ?>
                </button>            
        <?php             
          }
        ?>
        </td>
  <?php  
  } 
  $expired_sip_kab=$this->m_instansi_user->ambil_berkas_from_list($rowambil_list_pegawai['id_pegawai'],2,$id,$id2);
  foreach ($expired_sip_kab as $rowexpired_sip_kab){
  ?>
            <td>SIP</td>
            <td>
            <?php 
              if($rowexpired_sip_kab['tgl_b_berkas'] <= date('Y-m-d')){
            ?>
                   <button class="btn btn-danger btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                    </button>    
            <?php 
              }elseif(($rowexpired_sip_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sip_kab['tgl_b_berkas'] <= $dateb)){
            ?>
                   <button class="btn btn-warning btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                    </button> 
            <?php 
              }else{
             ?>
                   <button class="btn btn-success btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sip_kab['tgl_b_berkas'])) ?>
                    </buttotd>            
            <?php             
              }
            ?>
            </td>
  <?php  
  }
  $expired_sik_kab=$this->m_instansi_user->ambil_berkas_from_list($rowambil_list_pegawai['id_pegawai'],3,$id,$id2);
  foreach ($expired_sik_kab as $rowexpired_sik_kab){
  ?>
            <td>SIK</td>
            <td>
            <?php 
              if($rowexpired_sik_kab['tgl_b_berkas'] <= date('Y-m-d')){
            ?>
                   <button class="btn btn-danger btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                    </button>    
            <?php 
              }elseif(($rowexpired_sik_kab['tgl_b_berkas'] >= date('Y-m-d')) && ($rowexpired_sik_kab['tgl_b_berkas'] <= $dateb)){
            ?>
                   <button class="btn btn-warning btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                    </button> 
            <?php 
              }else{
             ?>
                   <button class="btn btn-success btn-xs">
                      <?= date('d-m-Y', strtotime($rowexpired_sik_kab['tgl_b_berkas'])) ?>
                    </button>            
            <?php             
              }
            ?>
            </td>
  <?php  
  }
  ?>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: darkred;color: white; font-weight:bold;">PENILAIAN KINERJA</td>
        </tr>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">KINERJA KLINIS</td>
        </tr>
  <?php
  $logbook_person=$this->m_instansi_user->ambil_grafik_logbook_person($rowambil_list_pegawai['id_pegawai']);
  foreach ($logbook_person as $rowlogbook_person){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='3'><?= $rowlogbook_person['thnlg'] ?></td>
            <td style="text-align:right;" colspan='3'><?= $rowlogbook_person['jml_logbookp'] ?></td>
          </tr>
  <?php  
  }
  ?>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">ETIKA PROFESI</td>
        </tr>
  <?php
  $etikae=$this->m_instansi_user->ambil_grafik_etik_person($rowambil_list_pegawai['id_pegawai']);
  foreach ($etikae as $rowetikae){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='3'>
              <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowetikae['tgl_etik_pegawai']))) ?> [Penguji : <?= $rowetikae['nama_pegawai'] ?>]
            </td>
            <td style="text-align:left;" colspan='3'><?= $rowetikae['hasil_etik'] ?></td>
          </tr>
  <?php  
  }
  ?>
        <tr>
          <td style="width: 5%;">&nbsp;</td>
          <td colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PENGEMBANGAN PROFESI</td>
        </tr>
  <?php
  $ambil_pelatihan_person=$this->m_instansi_user->ambil_berkas_pelatihan_biasa('peg.id_pegawai',$rowambil_list_pegawai['id_pegawai'],$id,$id2);
  foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='6'><?= $rowambil_pelatihan_person['nama_berkas'] ?><br>Tanggal :  <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_b_berkas']))) ?></td>
          </tr>
  <?php  
  }
  $ambil_pelatihan_person=$this->m_instansi_user->ambil_berkas_pelatihan_person('peg.id_pegawai',$rowambil_list_pegawai['id_pegawai'],$id,$id2);
  foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
  ?>
          <tr>
            <td style="width: 5%;">&nbsp;</td>
            <td colspan='6'><u>Kategori Pelatihan : <?= $rowambil_pelatihan_person['nama_kategori_pelatihan'] ?></u><br><?= $rowambil_pelatihan_person['nama_berkas'] ?><br>Tanggal :  <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_b_berkas']))) ?></td>
          </tr>
  <?php  
  }
  ?>            
      </tbody>

    </table>
  </div><br style="line-height:50px;">
</div>
<?php  
//---------- z ambil_list_pegawai
}
?>
        </div>
<!-- end 1 -->
<!-- start 2 -->
        <div class="col-md-4">
          <h5 class="box-title" style="font-weight:bold;">DEMOGRAFI</h5>
<?php 
$laki = 0;$pr = 0;
if(empty($id2)){
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'opi.id_instansi'=>$id);
}else{
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);  
}

$select_gender = "SUM(CASE WHEN jk = '1' THEN 1 END) as mlc,SUM(CASE WHEN jk = '0' THEN 1 END) as flc";
$gender=$this->m_instansi_user->grafik_all_pegawai($select_gender,$kondisi_1);

$select_unitpegawai = "COUNT(opi.id_unit) as total_unit,nama_unit,opi.id_unit";
$unitpegawai=$this->m_instansi_user->unit_all_pegawai($select_unitpegawai,$kondisi_1,'opi.id_unit');

$select_agama = "COUNT(ope.id_agama) as total_agama,nama_agama,ope.id_agama";
$agama=$this->m_instansi_user->grafik_all_pegawai_result($select_agama,$kondisi_1,'ope.id_agama');

$select_status_kawin = "COUNT(ope.id_status_kawin) as total_status_kawin,nama_status_kawin";
$status_kawin=$this->m_instansi_user->grafik_all_pegawai_result($select_status_kawin,$kondisi_1,'ope.id_status_kawin');

$select_status_pegawai = "COUNT(ope.tipe_pegawai) as total_status_pegawai,nama_status_pegawai";
$status_pegawai=$this->m_instansi_user->grafik_all_pegawai_result($select_status_pegawai,$kondisi_1,'ope.tipe_pegawai');

$select_pendidikan = "COUNT(ope.id_pendidikan) as total_pendidikan,nama_pendidikan";
$pendidikan=$this->m_instansi_user->grafik_all_pegawai_result($select_pendidikan,$kondisi_1,'ope.id_pendidikan');

$select_jabatan_fungsional = "COUNT(ope.id_jabatan_fungsional) as total_jabatan_fungsional,nama_jabatan_fungsional";
$jf=$this->m_instansi_user->grafik_all_pegawai_result($select_jabatan_fungsional,$kondisi_1,'ope.id_jabatan_fungsional');

$select_grade = "COUNT(ope.id_grade) as total_grade,nama_grade";
$gradee=$this->m_instansi_user->grafik_all_pegawai_result($select_grade,$kondisi_1,'ope.id_grade');

$select_pelatihan = "COUNT(peg.id_pegawai) as total_pelatihan,nama_kategori_pelatihan";
$pelatihan=$this->m_instansi_user->ambil_berkas_pelatihan_person('peg.id_pegawai',$rowambil_list_pegawai['id_pegawai'],$id,$id2,'ob.id_kategori_pelatihan',$select_pelatihan);
if(empty($id2)){
$kondisi_expired_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas <='=>date('Y-m-d'),'opi.id_instansi'=>$id);
$kondisi_expired_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas <='=>date('Y-m-d'),'opi.id_instansi'=>$id);
$kondisi_expired_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas <='=>date('Y-m-d'),'opi.id_instansi'=>$id);
$kondisi_aktif_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id);
$kondisi_aktif_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id);
$kondisi_aktif_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id);
$kondisi_tenggang_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opi.id_instansi'=>$id);
$kondisi_tenggang_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opi.id_instansi'=>$id);
$kondisi_tenggang_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opi.id_instansi'=>$id);
}else{
  $kondisi_expired_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas <='=>date('Y-m-d'),'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
  $kondisi_expired_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas <='=>date('Y-m-d'),'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
  $kondisi_expired_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas <='=>date('Y-m-d'),'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
  $kondisi_aktif_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
  $kondisi_aktif_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
  $kondisi_aktif_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >'=>date('Y-m-d'),'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
  $kondisi_tenggang_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
  $kondisi_tenggang_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
  $kondisi_tenggang_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
}

$expired_str=$this->m_instansi_user->ambil_berkas_ijin($kondisi_expired_str);

$expired_sip=$this->m_instansi_user->ambil_berkas_ijin($kondisi_expired_sip);

$expired_sik=$this->m_instansi_user->ambil_berkas_ijin($kondisi_expired_sik);


$aktif_str=$this->m_instansi_user->ambil_berkas_ijin($kondisi_aktif_str);

$aktif_sip=$this->m_instansi_user->ambil_berkas_ijin($kondisi_aktif_sip);

$aktif_sik=$this->m_instansi_user->ambil_berkas_ijin($kondisi_aktif_sik);

$tenggang_str=$this->m_instansi_user->ambil_berkas_ijin($kondisi_tenggang_str);

$tenggang_sip=$this->m_instansi_user->ambil_berkas_ijin($kondisi_tenggang_sip);

$tenggang_sik=$this->m_instansi_user->ambil_berkas_ijin($kondisi_tenggang_sik);

$select_prov = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov";
$prov=$this->m_instansi_user->grafik_all_pegawai_result($select_prov,$kondisi_1,'ope.id_prov');
?>
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
      <tr>
        <td style="background-color:#063970;color:white;vertical-align:middle;">Gender || PDF &nbsp;
          <a href="<?php echo base_url('instansi_user/demografi/pdf_gender/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
            <i class="fa fa-file-pdf-o text-white"></i>
          </a>
        </td>
        <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
      </tr>
      <tr>
        <td style="vertical-align:middle;">Laki-laki</td>
        <td style="vertical-align:middle;text-align: right;"><?= $gender['mlc'] ?></td>
      </tr>
      <tr>
        <td style="vertical-align:middle;">Perempuan</td>
        <td style="vertical-align:middle;text-align: right;"><?= $gender['flc'] ?></td>
      </tr>
      <tr>
        <td style="background-color:#979915;color:white;vertical-align:middle;">Agama || PDF &nbsp;
          <a href="<?php echo base_url('instansi_user/demografi/pdf_religi/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
            <i class="fa fa-file-pdf-o text-white"></i>
          </a>
        </td>
        <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
      </tr>
<?php
foreach ($agama as $rowagama){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowagama['nama_agama'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowagama['total_agama'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Marital || PDF &nbsp;
          <a href="<?php echo base_url('instansi_user/demografi/pdf_marital/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
            <i class="fa fa-file-pdf-o text-white"></i>
          </a> 
      </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($status_kawin as $rowstatus_kawin){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_kawin['nama_status_kawin'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_kawin['total_status_kawin'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Status Pegawai || PDF &nbsp;
          <a href="<?php echo base_url('instansi_user/demografi/pdf_asn/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
            <i class="fa fa-file-pdf-o text-white"></i>
          </a> 
      </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($status_pegawai as $rowstatus_pegawai){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowstatus_pegawai['nama_status_pegawai'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowstatus_pegawai['total_status_pegawai'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">Pendidikan || PDF &nbsp;
          <a href="<?php echo base_url('instansi_user/demografi/pdf_pendidikan/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
            <i class="fa fa-file-pdf-o text-white"></i>
          </a> 
      </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pendidikan as $rowpendidikan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpendidikan['nama_pendidikan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpendidikan['total_pendidikan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Jabatan Fungsional || PDF &nbsp;
          <a href="<?php echo base_url('instansi_user/demografi/pdf_jabfung/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
            <i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($jf as $rowjf){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowjf['nama_jabatan_fungsional'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowjf['total_jabatan_fungsional'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">Ruangan / Unit 
      </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($unitpegawai as $rowunitpegawai){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowunitpegawai['nama_unit'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowunitpegawai['total_unit'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Grade || PDF &nbsp;
          <a href="<?php echo base_url('instansi_user/demografi/pdf_grade/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
            <i class="fa fa-file-pdf-o text-white"></i>
          </a> 
    </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($gradee as $rowgrade){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowgrade['nama_grade'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowgrade['total_grade'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Pelatihan Biasa || PDF &nbsp;
        <a href="<?php echo base_url('instansi_user/demografi/pdf_pelatihan/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
          <i class="fa fa-file-pdf-o text-white"></i> </a> - &nbsp;
        Pelatihan Khusus || PDF &nbsp;
        <a href="<?php echo base_url('instansi_user/demografi/pdf_pelatihankhusus/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
          <i class="fa fa-file-pdf-o text-white"></i>
        </a>
      </td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($pelatihan as $rowpelatihan){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowpelatihan['nama_kategori_pelatihan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowpelatihan['total_pelatihan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
        Surat Ijin &nbsp; <i class="fa fa-file-pdf-o text-white"></i>
        || 
          <a href="<?php echo base_url('instansi_user/demografi/pdf_surat_ijin_aktif/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank"> Aktif
          </a> 
        || 
          <a href="<?php echo base_url('instansi_user/demografi/pdf_surat_ijin_tenggang/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank"> Tenggang
          </a> 
        || 
          <a href="<?php echo base_url('instansi_user/demografi/pdf_surat_ijin_expired/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank"> Expired
          </a> 
      </td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php
foreach ($aktif_str as $rowaktif_str){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif STR</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($aktif_sip as $rowaktif_sip){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif SIP</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($aktif_sik as $rowaktif_sik){
?>
    <tr>
      <td style="background-color:#008000;color:white;vertical-align:middle;">Aktif SIK</td>
      <td style="background-color:#008000;color:white;vertical-align:middle;text-align: right;"><?= $rowaktif_sik['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($tenggang_str as $rowtenggang_str){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang STR</td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($tenggang_sip as $rowtenggang_sip){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang SIP</td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($tenggang_sik as $rowtenggang_sik){
?>
    <tr>
      <td style="background-color:#f37220;color:white;vertical-align:middle;">Tenggang SIK</td>
      <td style="background-color:#f37220;color:white;vertical-align:middle;text-align: right;"><?= $rowtenggang_sik['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_str as $rowexpired_str){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired STR</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_str['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_sip as $rowexpired_sip){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIP</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sip['total_str'] ?></td>
    </tr>
<?php 
}
foreach ($expired_sik as $rowexpired_sik){
?>
    <tr>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;">Expired SIK</td>
      <td style="background-color:#FE0101;color:white;vertical-align:middle;text-align: right;"><?= $rowexpired_sik['total_str'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="vertical-align:middle;">Alamat || PDF &nbsp;
        <a href="<?php echo base_url('instansi_user/demografi/pdf_alamat/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
          <i class="fa fa-file-pdf-o text-white"></i>
        </a>
      </td>
      <td style="vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($prov as $rowprov){
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;"><?= $rowprov['nama_prov'] ?></td>
      <td style="background-color:#063970;color:white;vertical-align:middle;text-align: right;"><?= $rowprov['total_prov'] ?></td>
    </tr>
<?php 
if(empty($id2)){
$kondisi_kab=array('status_pegawai'=>1,'visible'=>1,'ope.id_prov'=>$rowprov['id_prov'],'opi.id_instansi'=>$id);
}else{
$kondisi_kab=array('status_pegawai'=>1,'visible'=>1,'ope.id_prov'=>$rowprov['id_prov'],'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);  
}
$select_kab = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kab=$this->m_instansi_user->grafik_all_pegawai_result($select_kab,$kondisi_kab,'ope.id_kab');

  foreach ($kab as $rowkab){
?>
    <tr>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;padding-left: 20px;">&nbsp;&nbsp;<?= $rowkab['nama_kab'] ?></td>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;text-align: right;"><?= $rowkab['total_kab'] ?></td>
    </tr>
<?php
if(empty($id2)){
$kondisi_kec=array('status_pegawai'=>1,'visible'=>1,'ope.id_kab'=>$rowkab['id_kab'],'opi.id_instansi'=>$id);
}else{
$kondisi_kec=array('status_pegawai'=>1,'visible'=>1,'ope.id_kab'=>$rowkab['id_kab'],'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
}
$select_kec = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kec=$this->m_instansi_user->grafik_all_pegawai_result($select_kec,$kondisi_kec,'ope.id_kec');

    foreach ($kec as $rowkec){
?>
    <tr>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;padding-left: 35px;"><?= $rowkec['nama_kec'] ?></td>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;text-align: right;"><?= $rowkec['total_kec'] ?></td>
    </tr>
<?php
if(empty($id2)){
$kondisi_kel=array('status_pegawai'=>1,'visible'=>1,'ope.id_kec'=>$rowkec['id_kec'],'opi.id_instansi'=>$id);
}else{
$kondisi_kel=array('status_pegawai'=>1,'visible'=>1,'ope.id_kec'=>$rowkec['id_kec'],'opi.id_instansi'=>$id,'jf.id_jabatan'=>$id2);
}
$select_kel = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kel=$this->m_instansi_user->grafik_all_pegawai_result($select_kel,$kondisi_kel,'ope.id_kel');

      foreach ($kel as $rowkel){
?>
    <tr>
      <td style="background-color:#238C07;color:white;vertical-align:middle;padding-left: 50px;"><?= $rowkel['nama_kel'] ?></td>
      <td style="background-color:#238C07;color:white;vertical-align:middle;text-align: right;"><?= $rowkel['total_kel'] ?></td>
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
<!-- end 2 -->
      </div>
      </div>
    </div>
  </section>
</div>
<?php
}
elseif ($page=="kinerja_klinis_lbulanan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('instansi_user/kinerja_klinis/lbulanan/'.$bulan.'/'.$tahun.'/'.$id_pegawai,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Silahkan Pilih Pegawai Dahulu");
              ?>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("bulan","bulan",$bulan,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("tahun","tahun",$tahun,"Masukkan Tanggal Transaksi","required");
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
           <h3 class="box-title">TOTAL KINERJA KLINIS</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example1" width="100%" class="table table-bordered table-striped">
          <?php
          foreach($ambil_range as $rowambil_rangex){
            $ambil_range_logbook_kompetensix = $this->m_instansi_user->ambil_range_logbook_kompetensi($rowambil_rangex['bulan'],$rowambil_rangex['tahun'],$id_pegawai,'hasile');
            foreach($ambil_range_logbook_kompetensix as $rowambil_rangex_logbook_kompetensi){
          ?>
        <tr>
          <td colspan="2" style="vertical-align:middle;text-align:left;">
            [<?php echo $rowambil_rangex_logbook_kompetensi['kode_unit']; ?>] : <?php echo $rowambil_rangex_logbook_kompetensi['nama_kompetensi']; ?>
            </td>
            <td colspan="2" style="vertical-align:middle;text-align:right;"><?php echo $rowambil_rangex_logbook_kompetensi['jumlahk']; ?></td>
        </tr>
          <?php
            $ambil_range_logbook_bulanane_detilx = $this->m_instansi_user->ambil_range_logbook_bulanane_detil($rowambil_rangex['bulan'],$rowambil_rangex['tahun'],$rowambil_rangex_logbook_kompetensi['id_kompetensi'],$id_pegawai,'hasile');
              foreach($ambil_range_logbook_bulanane_detilx as $rowambil_range_logbook_bulanane_detilx){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;">
            <?php echo $rowambil_range_logbook_bulanane_detilx['nama_kewenangan']; ?>
            </td>
            <td style="vertical-align:middle;text-align:right;width: 5%;"><?php echo $rowambil_range_logbook_bulanane_detilx['jumlah']; ?></td>
            <td style="vertical-align:middle;text-align:right;">&nbsp;</td>
        </tr>
          <?php
              }
            }
          }
          ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">RINCIAN KINERJA KLINIS</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example2" width="100%" class="table table-bordered table-striped">
          <?php
          foreach($ambil_range as $rowambil_range){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;font-weight:bold;">PERIODE</td>
          <td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $this->m_rancak->getBulan($rowambil_range['bulan']); ?> - <?php echo $rowambil_range['tahun']; ?></td>
          <td colspan="2" style="vertical-align:middle;text-align:center;font-weight:bold;width: 10%;">Jumlah</td>
        </tr>
          <?php
            $ambil_range_logbook_kompetensi = $this->m_instansi_user->ambil_range_logbook_kompetensi($rowambil_range['bulan'],$rowambil_range['tahun'],$id_pegawai);
            foreach($ambil_range_logbook_kompetensi as $rowambil_range_logbook_kompetensi){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td colspan="2" style="vertical-align:middle;text-align:left;">
            [<?php echo $rowambil_range_logbook_kompetensi['kode_unit']; ?>] : <?php echo $rowambil_range_logbook_kompetensi['nama_kompetensi']; ?>
            </td>
            <td colspan="2" style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_logbook_kompetensi['jumlahk']; ?></td>
        </tr>
          <?php
            $ambil_range_logbook_bulanane_detil = $this->m_instansi_user->ambil_range_logbook_bulanane_detil($rowambil_range['bulan'],$rowambil_range['tahun'],$rowambil_range_logbook_kompetensi['id_kompetensi'],$id_pegawai);
              foreach($ambil_range_logbook_bulanane_detil as $rowambil_range_logbook_bulanane_detil){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;">
            <?php echo $rowambil_range_logbook_bulanane_detil['nama_kewenangan']; ?>
            </td>
            <td style="vertical-align:middle;text-align:right;width: 5%;"><?php echo $rowambil_range_logbook_bulanane_detil['jumlah']; ?></td>
            <td style="vertical-align:middle;text-align:right;">&nbsp;</td>
        </tr>
          <?php
              }
            }
          }
          ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengembangan_profesi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('instansi_user/pengembangan_profesi/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Pilih Pegawai Lebih Dulu");
              ?>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal Transaksi","required");
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
           <h3 class="box-title">PENGEMBANGAN PROFESI</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
      <tr>
        <td colspan="3" style="vertical-align:middle;text-align:center;">NAMA PELATIHAN</td>
          <td style="vertical-align:middle;text-align:center;">PENYELENGGARA</td>
          <td style="vertical-align:middle;text-align:center;">TGL MULAI</td>
          <td style="vertical-align:middle;text-align:center;">TGL SELESAI</td>
          <td style="vertical-align:middle;text-align:right;">SKP</td>
      </tr>          
        </thead>
        <?php
        $nue=0;
        foreach($ambil_range as $rowambil_rangex){
          $nue = $nue + $rowambil_rangex['jml_kredit'];
        ?>
      <tr>
        <td colspan="5" style="vertical-align:middle;text-align:left;font-weight: bold;"><?php echo $rowambil_rangex['nama_kategori_pelatihan']; ?></td>
          <td style="vertical-align:middle;text-align:right;font-weight: bold;"> Jumlah SKP</td>
          <td style="vertical-align:middle;text-align:right;font-weight: bold;"><?= number_format($rowambil_rangex['jml_kredit'],1) ?></td>
      </tr>
        <?php
        $noe=0;
  $berkase = $this->m_instansi_user->ambil_berkas_kategori_pelatihan($first_date,$last_date,$id_pegawai,$rowambil_rangex['id_kategori_pelatihan']);
          foreach($berkase as $rowberkase){
            $noe++;
        ?>
      <tr>
        <td style="vertical-align:middle;text-align:center;width: 5%;"><?= $noe ?></td>
        <td colspan="2" style="vertical-align:middle;text-align:left;"><?php echo $rowberkase['nama_berkas']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowberkase['penyelenggara']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowberkase['tgl_a_berkas']))); ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowberkase['tgl_b_berkas']))); ?></td>
        <td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowberkase['kredit'],1); ?></td>
      </tr>
        <?php
          }
        ?>
      <tr>
        <td colspan="6" style="vertical-align:middle;text-align:right;font-weight: bold;">Total SKP</td>
        <td style="vertical-align:middle;text-align:right;font-weight: bold;"><?php echo number_format($nue,1); ?></td>
      </tr>
        <?php
        }
        ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="etik")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('instansi_user/etik/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Pilih Pegawai Lebih Dulu");
              ?>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal Transaksi","required");
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
           <h3 class="box-title">ETIKA PROFESI</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
      <tr>
          <td style="vertical-align:middle;text-align:center;">TANGGAL</td>
          <td style="vertical-align:middle;text-align:center;">JUMLAH SOAL</td>
          <td style="vertical-align:middle;text-align:center;">NILAI</td>
          <td style="vertical-align:middle;text-align:center;">HASIL</td>
          <td style="vertical-align:middle;text-align:center;">PENGUJI</td>
      </tr>          
        </thead>
        <?php
        foreach($ambil_range as $rowambil_rangex){
        ?>
      <tr>
        <td style="vertical-align:middle;text-align:left;">
          <?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowambil_rangex['tgl_etik_pegawai']))); ?>
        </td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_rangex['jumlah_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_rangex['total_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_rangex['hasil_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_rangex['penguji']; ?></td>
      </tr>
        <?php
        }
        ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="oppe")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('instansi_user/oppe/view/'.$first_date.'/'.$last_date.'/'.$id_pegawai,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pegawai</label>
              <?php
                input_pdselect2fleksibel("id_pegawai","id_pegawai",$cmd_pegawai,"barcode_pegawai","nama_pegawai",$id_pegawai,"Pilih Pegawai Lebih Dulu");
              ?>
          </div>
        </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal Transaksi","required");
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
           <h3 class="box-title">ETIKA PROFESI</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
      <tr>
          <td style="vertical-align:middle;text-align:center;">TANGGAL</td>
          <td style="vertical-align:middle;text-align:center;">JUMLAH SOAL</td>
          <td style="vertical-align:middle;text-align:center;">NILAI</td>
          <td style="vertical-align:middle;text-align:center;">HASIL</td>
          <td style="vertical-align:middle;text-align:center;">PENGUJI</td>
      </tr>          
        </thead>
        <?php
        foreach($etika as $rowetik){
        ?>
      <tr>
        <td style="vertical-align:middle;text-align:left;">
          <?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowetik['tgl_etik_pegawai']))); ?>
        </td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowetik['jumlah_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowetik['total_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowetik['hasil_etik']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowetik['penguji']; ?></td>
      </tr>
        <?php
        }
        ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PENGEMBANGAN PROFESI</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example2" width="100%" class="table table-bordered table-striped">
        <thead>
      <tr>
        <td colspan="3" style="vertical-align:middle;text-align:center;">NAMA PELATIHAN</td>
          <td style="vertical-align:middle;text-align:center;">PENYELENGGARA</td>
          <td style="vertical-align:middle;text-align:center;">TGL MULAI</td>
          <td style="vertical-align:middle;text-align:center;">TGL SELESAI</td>
          <td style="vertical-align:middle;text-align:right;">SKP</td>
      </tr>          
        </thead>
        <?php
        $nue=0;
        foreach($pelatihan as $rowpelatihan){
          $nue = $nue + $rowpelatihan['jml_kredit'];
        ?>
      <tr>
        <td colspan="5" style="vertical-align:middle;text-align:left;font-weight: bold;"><?php echo $rowpelatihan['nama_kategori_pelatihan']; ?></td>
          <td style="vertical-align:middle;text-align:right;font-weight: bold;"> Jumlah SKP</td>
          <td style="vertical-align:middle;text-align:right;font-weight: bold;"><?= number_format($rowpelatihan['jml_kredit'],1) ?></td>
      </tr>
        <?php
        $noe=0;
  $berkase = $this->m_instansi_user->ambil_berkas_kategori_pelatihan($first_date,$last_date,$id_pegawai,$rowpelatihan['id_kategori_pelatihan']);
          foreach($berkase as $rowberkase){
            $noe++;
        ?>
      <tr>
        <td style="vertical-align:middle;text-align:center;width: 5%;"><?= $noe ?></td>
        <td colspan="2" style="vertical-align:middle;text-align:left;"><?php echo $rowberkase['nama_berkas']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $rowberkase['penyelenggara']; ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowberkase['tgl_a_berkas']))); ?></td>
        <td style="vertical-align:middle;text-align:center;"><?php echo $this->m_rancak->fullBulan(date('d-m-Y',strtotime($rowberkase['tgl_b_berkas']))); ?></td>
        <td style="vertical-align:middle;text-align:right;"><?php echo number_format($rowberkase['kredit'],1); ?></td>
      </tr>
        <?php
          }
        ?>
      <tr>
        <td colspan="6" style="vertical-align:middle;text-align:right;font-weight: bold;">Total SKP</td>
        <td style="vertical-align:middle;text-align:right;font-weight: bold;"><?php echo number_format($nue,1); ?></td>
      </tr>
        <?php
        }
        ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">KINERJA KLINIS</h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
       <table id="example3" width="100%" class="table table-bordered table-striped">
          <?php
          foreach($logbook as $rowlogbook){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;font-weight:bold;">PERIODE</td>
          <td colspan="2" style="vertical-align:middle;text-align:left;font-weight:bold;"><?php echo $this->m_rancak->getBulan($rowlogbook['bulan']); ?> - <?php echo $rowlogbook['tahun']; ?></td>
          <td colspan="2" style="vertical-align:middle;text-align:center;font-weight:bold;width: 10%;">Jumlah</td>
        </tr>
          <?php
            $ambil_range_logbook_kompetensi = $this->m_instansi_user->ambil_range_logbook_kompetensi($rowlogbook['bulan'],$rowlogbook['tahun'],$id_pegawai);
            foreach($ambil_range_logbook_kompetensi as $rowambil_range_logbook_kompetensi){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td colspan="2" style="vertical-align:middle;text-align:left;">
            [<?php echo $rowambil_range_logbook_kompetensi['kode_unit']; ?>] : <?php echo $rowambil_range_logbook_kompetensi['nama_kompetensi']; ?>
            </td>
            <td colspan="2" style="vertical-align:middle;text-align:right;"><?php echo $rowambil_range_logbook_kompetensi['jumlahk']; ?></td>
        </tr>
          <?php
            $ambil_range_logbook_bulanane_detil = $this->m_instansi_user->ambil_range_logbook_bulanane_detil($rowlogbook['bulan'],$rowlogbook['tahun'],$rowambil_range_logbook_kompetensi['id_kompetensi'],$id_pegawai);
              foreach($ambil_range_logbook_bulanane_detil as $rowambil_range_logbook_bulanane_detil){
          ?>
        <tr>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
          <td style="vertical-align:middle;text-align:left;">
            <?php echo $rowambil_range_logbook_bulanane_detil['nama_kewenangan']; ?>
            </td>
            <td style="vertical-align:middle;text-align:right;width: 5%;"><?php echo $rowambil_range_logbook_bulanane_detil['jumlah']; ?></td>
            <td style="vertical-align:middle;text-align:right;">&nbsp;</td>
        </tr>
          <?php
              }
            }
          }
          ?>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="kinerja_unit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('instansi_user/kinerja_unit/view/'.$first_date.'/'.$last_date,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal Transaksi","required");
                ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal Transaksi","required");
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
<?php
  foreach($ambil_range as $rowambil_range){
?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $rowambil_range['nama_unit'] ?></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">TOTAL KINERJA KLINIS</h3>
              <div class="box-tools pull-right">

              </div>
            </div>
            <div class="box-body">
           <table id="example1" width="100%" class="table table-bordered table-striped">
              <?php
              $nou=0;
                $ambil_range_logbook_kompetensix = $this->m_instansi_user->ambil_range_logbook_kompetensi_unit($first_date,$last_date,$rowambil_range['id_unit']);
                foreach($ambil_range_logbook_kompetensix as $rowambil_rangex_logbook_kompetensi){
                  $nou = $nou + $rowambil_rangex_logbook_kompetensi['jumlahk'];
              ?>
            <tr>
              <td colspan="2" style="vertical-align:middle;text-align:left;">
                [<?php echo $rowambil_rangex_logbook_kompetensi['kode_unit']; ?>] : <?php echo $rowambil_rangex_logbook_kompetensi['nama_kompetensi']; ?>
                </td>
                <td colspan="2" style="vertical-align:middle;text-align:right;"><?php echo $rowambil_rangex_logbook_kompetensi['jumlahk']; ?></td>
            </tr>
              <?php
                $ambil_range_logbook_bulanane_detilx = $this->m_instansi_user->ambil_range_logbook_bulanane_detil_unit($first_date,$last_date,$rowambil_rangex_logbook_kompetensi['id_kompetensi'],$rowambil_range['id_unit']);
                  foreach($ambil_range_logbook_bulanane_detilx as $rowambil_range_logbook_bulanane_detilx){
              ?>
            <tr>
              <td style="vertical-align:middle;text-align:left;width:3%;">&nbsp;</td>
              <td style="vertical-align:middle;text-align:left;">
                <?php echo $rowambil_range_logbook_bulanane_detilx['nama_kewenangan']; ?>
                </td>
                <td style="vertical-align:middle;text-align:right;width: 5%;"><?php echo $rowambil_range_logbook_bulanane_detilx['jumlah']; ?></td>
                <td style="vertical-align:middle;text-align:right;">&nbsp;</td>
            </tr>
              <?php
                  }
              ?>
            <tr>
              <td colspan="2" style="vertical-align:middle;text-align:left;font-weight: bold;">
                TOTAL KINERJA KLINIS
                </td>
                <td colspan="2" style="vertical-align:middle;text-align:right;font-weight: bold;"><?php echo $nou; ?></td>
            </tr>
              <?php 
                }
              ?>
          </table>
            </div>
          </div>
        </div>
      </div>
<?php 
  }
?>
    </section>
</div>
<?php
}
elseif ($page=="lihat")
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
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('instansi_user/lihat/view/'.$id.'/'.$id2.'/'.$id3,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE / PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Pegawai</label>
                  <?php
input_pdselect2fleksibel("id3","id3",$ambil_sn_standar_mutu,"barcode_pegawai","nama_pegawai",$id3,"SEMUA");
              //      input_pdselect2("id3",$ambil_sn_standar_mutu,$id3);
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
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Range</th>            
            <th>Judul</th>                                 
            <th>Tujuan</th>                                 
            <th>Share</th>                                 
            <th>Pembuat</th>                                 
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
elseif ($page=="lihat_tabel")
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
                <th style="width:5%;vertical-align: middle;text-align: center;">Urutan</th>            
                <th style="vertical-align: middle;">Judul</th>            
                <th style="width:15%;vertical-align: middle;">Sumber Data</th>            
                <th style="width:30%;vertical-align: middle;">Tabel</th>                                   
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
elseif ($page=="lihat_profil")
{
  $btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
  $btnk = array_rand($btnarray);
  $btnv = $btnarray[$btnk];
?>
<style type="text/css">
.huruf-12 {
  font-family: Times New Roman;
  font-size: 12pt;
  line-height: 2;  
}
@media print {
a {
  color: black;
}
 a[href]:after {
    display: none;
    visibility: hidden;
 }
}
</style>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
      <section class="content-header text-center">

      </section>
      <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
         <h3 style="font-weight:bold;text-align: center;"><?= $header_profil ?></h3>
        <h3 style="font-weight:bold;text-align: center;"><?= $sub_header_profil ?></h3>                 <br style="line-height:2">
<?php
if(!empty($sejarah))
$sejarah = strip_tags($sejarah); 
$sejarah = html_entity_decode($sejarah); 
 echo '<br style="line-height:1"><br style="line-height:1">'. $sejarah;

if(!empty($visi_misi))
$visi_misi = strip_tags($visi_misi); 
$visi_misi = html_entity_decode($visi_misi); 
 echo '<br style="line-height:1"><br style="line-height:1">'.  $visi_misi;

if(!empty($tujuan_fungsi))
$tujuan_fungsi = strip_tags($tujuan_fungsi); 
$tujuan_fungsi = html_entity_decode($tujuan_fungsi); 
 echo '<br style="line-height:1"><br style="line-height:1">'.  $tujuan_fungsi;

if(!empty($struktur_organisasi)){
   echo '<br style="line-height:1"><br style="line-height:1">';
?>
  <div class="timeline-item">            
    <h3 style="font-weight:bold;" class="timeline-header">STRUKTUR ORGANISASI</h3>
    <div class="timeline-body">
<?php
  $br_struktur = $this->m_instansi_user->ol_berkas_in($struktur_organisasi,'60');
  foreach($br_struktur as $rowbr_struktur){
?>
<a class="example-image-link" href="<?php echo base_url('assets/berkas/im/'.$rowbr_struktur['link_berkas']);?>" 
  data-lightbox="example-set" data-title="<?php echo $rowbr_struktur['no_berkas'].' - '.$rowbr_struktur['nama_berkas']; ?>">
  <img class="margin" src="<?php echo base_url('assets/berkas/im/'.$rowbr_struktur['link_berkas']);?>" style="width: 700px;" alt="Photo">
</a>
<?php
  }
?>
    </div>
  </div>
<?php
}

if(!empty($informasi_layanan))
$informasi_layanan = strip_tags($informasi_layanan); 
$informasi_layanan = html_entity_decode($informasi_layanan); 
 echo '<br style="line-height:1"><br style="line-height:1">'.  $informasi_layanan;

if(!empty($regulasi)){
   echo '<br style="line-height:1"><br style="line-height:1">';
?>
  <div class="timeline-item">     
    <h3 style="font-weight:bold;" class="timeline-header">REGULASI / BERKAS TERKAIT</h3>       
    <div class="timeline-body">
<?php  
  $br_regulasi = $this->m_instansi_user->ol_berkas_in($regulasi,'50');
  foreach($br_regulasi as $rowbr_regulasi){
?>
  <table class="table no-border">
      <tbody>
        <tr>
          <td style="width:4%;">&nbsp;</td>
          <td style="width:25%;">
              <?= $rowbr_regulasi['nama_berkas'] ?>
          </td>
          <td style="width:3%;text-align: center;">:</td>
          <td>
            <a href="<?php echo base_url('assets/berkas/im/'.$rowbr_regulasi['link_berkas']);?>" target="_blank">
              <?= $rowbr_regulasi['no_berkas'] ?>
            </a> 
          </td>
        </tr>
      </tbody>
  </table>
<?php
  }
?>
    </div>
  </div>
<?php
}
if(!empty($berkas_laporan)){
   echo '<br style="line-height:1"><br style="line-height:1">';
?>
  <div class="timeline-item">     
    <h3 style="font-weight:bold;" class="timeline-header">BERKAS</h3>       
    <div class="timeline-body">
<?php  
  $br_berkas_laporan = $this->m_instansi_user->ol_berkas_in($berkas_laporan,'50');
  foreach($br_berkas_laporan as $rowbr_berkas_laporan){
?>
  <table class="table no-border">
      <tbody>
        <tr>
          <td style="width:4%;">&nbsp;</td>
          <td style="width:25%;">
              <?= $rowbr_berkas_laporan['nama_berkas'] ?>
          </td>
          <td style="width:3%;text-align: center;">:</td>
          <td>
            <a href="<?php echo base_url('assets/berkas/im/'.$rowbr_berkas_laporan['link_berkas']);?>" target="_blank">
              <?= $rowbr_berkas_laporan['no_berkas'] ?>
            </a> 
          </td>
        </tr>
      </tbody>
  </table>
<?php
  }
?>
    </div>
  </div>
<?php
}
?>
        </div>
      </div>
      <hr/>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
 <!--          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
         <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>-->
          <a href="<?php echo base_url('instansi_user/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
            Laporan <i class="fa fa-share"></i>
          </a>
          <a href="<?php echo base_url('instansi_user/lihat/galeri/'.$id);?>" class="btn btn-success pull-right" style="margin-right: 5px;">
            Galeri <i class="fa fa-image"></i>
          </a>          
        </div>
          <div class="col-xs-12">
            <hr>        
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('instansi_user/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
         </div>          
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}
elseif ($page=="lihat_galeri")
{
  $btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
  $btnk = array_rand($btnarray);
  $btnv = $btnarray[$btnk];
?>
<style type="text/css">
.huruf-12 {
  font-family: Times New Roman;
  font-size: 12pt;
  line-height: 2;  
}
* {
    margin: 0;
    padding: 0;
}
.imgbox {
    display: grid;
    height: 100%;
}
.center-fit {
    max-width: 100%;
    max-height: 100vh;
    margin: auto;
}
</style>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">

      <div class="row invoice-info">
        <div class="col-sm-12 huruf-12">
      <section class="text-center">
        <h3 style="font-weight:bold;">GALERI</h3>
      </section>
<?php
if(!empty($galeri_laporan)){
   echo '<br style="line-height:1">';
  $br_galeri_laporan = $this->m_instansi_user->ol_berkas_in($galeri_laporan,'60');
  foreach($br_galeri_laporan as $rowbr_galeri_laporan){
?>
<div class="col-md-12">
  <table class="table no-border">
      <tbody>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="imgbox">
<a class="example-image-link" href="<?php echo base_url('assets/berkas/im/'.$rowbr_galeri_laporan['link_berkas']);?>" 
  data-lightbox="example-set" data-title="<?php echo $rowbr_galeri_laporan['no_berkas'].' - '.$rowbr_galeri_laporan['nama_berkas']; ?>">
  <img class="center-fit" src="<?php echo base_url('assets/berkas/im/'.$rowbr_galeri_laporan['link_berkas']);?>" alt="Photo">
</a>
            </div>
          </td>
        </tr>
        <tr>
          <td style="vertical-align:top;text-align: center;"><?= $rowbr_galeri_laporan['nama_berkas'] ?></td>
        </tr>
      </tbody>
  </table>  
</div>

<?php
  }
}
?>
        </div>
      </div>
      <hr/>
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
 <!--          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
         <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>-->
          <a href="<?php echo base_url('instansi_user/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
            Laporan <i class="fa fa-share"></i>
          </a>
           <a href="<?php echo base_url('instansi_user/lihat/profil/'.$id);?>" class="btn btn-warning pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Profil
            </a>
        </div>
          <div class="col-xs-12">
            <hr>        
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('instansi_user/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
         </div>          
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}

elseif ($page=="lihat_laporan")
{
  $btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
  $btnk = array_rand($btnarray);
  $btnv = $btnarray[$btnk];  
?>
<style type="text/css">
.huruf-12 {
  font-family: Times New Roman;
  font-size: 12pt;
  line-height: 2;  
}
</style>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
<!--
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header text-center">
            AdminLTE, Inc.
            <small class="pull-right"></small>
          </h2>
        </div>
      </div>
-->
      <section class="content-header text-center">

      </section>

        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
        <h3 style="font-weight:bold;text-align: center;"><?= $header_laporan ?></h3>
        <h3 style="font-weight:bold;text-align: center;"><?= $sub_header_laporan ?></h3>
                <br style="line-height:2">
            <table class="table no-border">
                <tbody>
                  <tr>
                    <td colspan="4" style="border-bottom: 0;border-top: 0;border-left: 0;border-right: 0;">
                      <p style="font-weight:bold;"><?= $sub_sub_header_laporan ?></p>
                    </td>
                  </tr>
                  <?php  
                    if(!empty($judul_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;width:4%;">&nbsp;</td>
                    <td style="width:25%;">Judul</td>
                    <td style="width:3%;text-align: center;">:</td>
                    <td><?= $judul_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($dimensi_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td >Dimensi Mutu</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $dimensi_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($tujuan_laporan)){
                      $tujuan_laporan = strip_tags($tujuan_laporan); 
                      $tujuan_laporan = html_entity_decode($tujuan_laporan);
                  ?>    
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Tujuan</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $tujuan_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($definisi_laporan)){
                      $definisi_laporan = strip_tags($definisi_laporan); 
                      $definisi_laporan = html_entity_decode($definisi_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Definisi Operasional</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $definisi_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($dasar_laporan)){
                      $dasar_laporan = strip_tags($dasar_laporan); 
                      $dasar_laporan = html_entity_decode($dasar_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Dasar Pemikiran</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $dasar_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($frekuensi_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Frekuensi Pengumpulan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $frekuensi_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($periode_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Periode Analisis dan Pelaporan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $periode_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($numerator_laporan)){
                      $numerator_laporan = strip_tags($numerator_laporan); 
                      $numerator_laporan = html_entity_decode($numerator_laporan); 
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Numerator</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $numerator_laporan ?></ul>
                  </tr>
                  <?php  
                    }
                    if(!empty($denominator_laporan)){
                      $denominator_laporan = strip_tags($denominator_laporan); 
                      $denominator_laporan = html_entity_decode($denominator_laporan); 
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Denomerator</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $denominator_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($sumber_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Sumber Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $sumber_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($standar_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Metode Pengumpulan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $standar_laporan ?></td>
                  </tr>
                  <?php  
                    }
                    if(!empty($teknis_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Teknis Pengambilan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $teknis_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($tgjawab_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Penanggung Jawab</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $tgjawab_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($jenis_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Jenis Indikator</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $jenis_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($satuan_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Satuan Pengukuran</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $satuan_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($kriteria_laporan)){
                      $kriteria_laporan = strip_tags($kriteria_laporan); 
                      $kriteria_laporan = html_entity_decode($kriteria_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Kriteria</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $kriteria_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($formula_laporan)){
                      $formula_laporan = strip_tags($formula_laporan); 
                      $formula_laporan = html_entity_decode($formula_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Formula</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $formula_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($metode_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Metode Pengumpulan Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $metode_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($sampel_laporan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Besar Sampel</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $sampel_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($penyajian_laporan)){
                      $penyajian_laporan = strip_tags($penyajian_laporan); 
                      $penyajian_laporan = html_entity_decode($penyajian_laporan);
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Penyajian Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $penyajian_laporan ?></td>
                  </tr>     
                  <?php  
                    }
                    if(!empty($id_jabatan)){
                  ?>
                  <tr>
                    <td style="border-top: 0;border-left: 0;border-bottom: 0;">&nbsp;</td>
                    <td>Pengumpul Data</td>
                    <td style="text-align: center;">:</td>
                    <td><?= $nama_jabatan ?></td>
                  </tr>
                  <?php  
                    }
                  ?>
                </tbody>
            </table>
          </div>
        </div>
        <hr/>
        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-xs-12">
   <!--          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
               <a href="<?php echo base_url('instansi_user/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right">
              Laporan <i class="fa fa-share"></i>
            </a>
           <a href="<?php echo base_url('instansi_user/lihat/profil/'.$id);?>" class="btn btn-warning pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Profil
            </a>
          <a href="<?php echo base_url('instansi_user/lihat/galeri/'.$id);?>" class="btn btn-success pull-right" style="margin-right: 5px;">
            Galeri <i class="fa fa-image"></i>
          </a>   
          </div>
          <div class="col-xs-12">
            <hr>          
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('instansi_user/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
          </div>          
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
<?php
}
elseif ($page=="lihat_tabelx")
{
  $btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
  $btnk = array_rand($btnarray);
  $btnv = $btnarray[$btnk];
?>
<style type="text/css">
.huruf-12 {
  font-family: Times New Roman;
  font-size: 12pt;
  line-height: 2;  
}
#chartdiv {
  width: 100%;
  height: 500px;
}
td, th {
  padding-top:5px;
  padding-bottom:5px;
  padding-right:10px;   
  padding-left:10px;   
}
@media print {
a {
  color: black;
}
 a[href]:after {
    display: none;
    visibility: hidden;
 }
}
</style>
  <div class="content-wrapper">
    <section class="content-header"></section>
    <section class="invoice">
      <section class="content-header">
        
      </section>
        
        <div class="row invoice-info">
          <div class="col-sm-12 huruf-12">
            <h4 style="font-weight:bold;"><?= $judul_laporan_tabel ?></h4><br style="line-height:2">
            <table style="width:100%;" class="table-bordered">
                <thead>
                  <tr>
                  <?php  
                    if($jumlah_record_tabel_limbah_detil > 0){
                  ?>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">Sumber Pengukuran</th>
                  <?php  
                    }
                  ?>
                  <?php  
                    if($jumlah_record_tps > 0){
                  ?>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">TPS</th>
                  <?php  
                    }
                    $cols = $jumlah_bulan * 2;
                  ?>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">Parameter</th>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">Baku Mutu</th>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" rowspan="2">Satuan</th>
                    <th style="background-color:lightgray;vertical-align:middle;text-align: center;" colspan="<?= $cols ?>">Realisasi Bulan</th>
                  </tr>
                  <tr>
                    <?php  
                      foreach ($only_blnyear_lhu as $rowonly_blnyear_lhu){
                    ?>
                   <th style="background-color:lightgray;vertical-align:middle;text-align: center;"><?php echo $this->m_rancak->getsemiBulan($rowonly_blnyear_lhu['buln']); ?></th>
                   <?php  
                    }
                   ?>
                  </tr>
                </thead>
                <tbody>
                  <?php  foreach($tabel_limbah_detil as $rowtabel_limbah_detil){
                  ?>
                  <tr>
                    <?php  
                      if($jumlah_record_tabel_limbah_detil > 0){
                    ?>
                    <td><?= $rowtabel_limbah_detil['nama_sumber_emisi'] ?></td>
                    <?php  
                      }
                    ?>
                    <?php  
                      if($jumlah_record_tps > 0){
                    ?>
                    <td><?= $rowtabel_limbah_detil['nama_tps'] ?></td>
                    <?php  
                      }
                    ?>
                    <td><?= $rowtabel_limbah_detil['nama_limbah'] ?></td>
                    <td class="text-right"><?= ROUND($rowtabel_limbah_detil['standar_mutu'],3) ?> <?php if($rowtabel_limbah_detil['range_mutu'] > 0){ echo ' s.d '.ROUND($rowtabel_limbah_detil['range_mutu'],3); } ?></td>
                    <td><?= $rowtabel_limbah_detil['satuan_limbah'] ?></td>
                      <?php  
                        foreach ($only_blnyear_lhu as $rowonly_blnyear_lhu){
                          $tabel_detil = $this->m_instansi_user->tabel_detil($id2,$rowtabel_limbah_detil['id_limbah'],$rowonly_blnyear_lhu['blnyear'],$min_tanggal,$max_tanggal,$rowtabel_limbah_detil['id_sumber_emisi']);
                          foreach($tabel_detil as $rowtabel_detil){
                      ?>
                     <td style="vertical-align:middle;text-align: center;"><?= round($rowtabel_detil['hasil_lhu_detil'],3) ?></td>
                     <?php  
                          }
                      }
                     ?>
                  </tr> 
                  <?php } ?>                 
                </tbody>
            </table>
          </div>
        </div>
        <br style="line-height:4">
            <?php  
            if($grafik > 1){
            ?>
            <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
              <div class="box-body">
                <div id="chartdiv"></div>
                <div id="legenddiv"></div>          
              </div>
            </div>
            <?php
            }
            ?>
        <hr/> 
        <div class="col-sm-12 huruf-12">     
<?php 
if(!empty($analisa_laporan_tabel))
$analisa_laporan_tabel = strip_tags($analisa_laporan_tabel); 
//$analisa_laporan_tabel = html_entity_decode($analisa_laporan_tabel); 
/*$analisa_laporan_tabel = htmlentities($analisa_laporan_tabel); 
$analisa_laporan_tabel = preg_replace('/<span[^>]+\>|<\/span>/i', '', $analisa_laporan_tabel);
$analisa_laporan_tabel = htmlspecialchars_decode($analisa_laporan_tabel, ENT_QUOTES);
$analisa_laporan_tabel = strip_tags($analisa_laporan_tabel);*/
$analisa_laporan_tabel = htmlspecialchars_decode($analisa_laporan_tabel);  
 echo '<br style="line-height:1"><br style="line-height:2">'.  $analisa_laporan_tabel;

if(!empty($rekomendasi_laporan_tabel))
$rekomendasi_laporan_tabel = strip_tags($rekomendasi_laporan_tabel); 
/*$rekomendasi_laporan_tabel = html_entity_decode($rekomendasi_laporan_tabel); 
$rekomendasi_laporan_tabel = htmlentities($rekomendasi_laporan_tabel); */
$rekomendasi_laporan_tabel = htmlspecialchars_decode($rekomendasi_laporan_tabel);  
 echo '<br style="line-height:1"><br style="line-height:2">'.  $rekomendasi_laporan_tabel;
?>
        </div>
        <?php 
          if($count_berkas_lhu > 0){
        ?>
        <div class="col-sm-12"> 
<br style="line-height:1"><br style="line-height:4">
  <div class="timeline-item">     
    <h4 style="font-weight:bold;" class="timeline-header">BERKAS HASIL PENGUJIAN</h4>       
    <div class="timeline-body">
<?php  
  foreach($ambil_berkas_lhu as $rowambil_berkas_lhu){
?>
  <table style="width:100%;" class="table table-border">
    <thead>
      <tr>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="width:4%;">&nbsp;</td>
        <td>
            <?= date('d-m-Y', strtotime($rowambil_berkas_lhu['tgl_lhu'])) ?>
        </td>
        <td><?= $rowambil_berkas_lhu['deskripsi_lhu'] ?></td>
        <td style="text-align:center;">
          <a href="<?php echo base_url('assets/berkas/instansi_user/'.$rowambil_berkas_lhu['link_lhu']);?>" target="_blank">
            <?= $rowambil_berkas_lhu['no_lhu'] ?>
          </a> 
        </td>
      </tr>
    </tbody>
  </table>
<?php
  }
?>
    </div>
  </div>
        </div>
        <?php 
          }
        ?>
        <div class="row no-print">
          <div class="col-xs-12">
   <!--          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>-->
               <a href="<?php echo base_url('instansi_user/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right">
              Laporan <i class="fa fa-share"></i>
            </a>
           <a href="<?php echo base_url('instansi_user/lihat/profil/'.$id);?>" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Profil
            </a>
          </div>
          <div class="col-xs-12">
            <hr>          
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('instansi_user/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
            </a>
          </div>
          <?php
            }
          ?>
          </div>          
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div> 
<?php 
}
elseif ($page=="informasi_jabatan")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('instansi_user/informasi_jabatan/view/'.$id.'/'.$id2,' id="signupform" '); ; 
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
          <div class="form-group">
            <label>Ruangan / Unit</label>
              <?php
                input_pdselect2fleksibel("id2","id2",$cmd_unit,"id_unit","nama_unit",$id2,"Silahkan Pilih Ruangan / Unit");
              ?>  
          </div>          
        </div> 
        <div class="col-md-6">
          <div class="form-group">
            <label>Periode</label>
              <?php
                input_pdselect2fleksibel("id","id",$year_periode,"periode","periode",$id,"Silahkan Pilih Periode");
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
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
            <th>Unit</th>
            <th width="10%">No Urut</th>
            <th width="10%">Periode</th>
            <th>Nama Jabatan</th>           
            <th>Atasan Langsung</th>              
            <th>PNS</th>              
            <th>CPNS</th>             
            <th>BLUD</th>             
            <th>ABK</th>              
            <th>+ / -</th>              
          </tr>
        </thead>
      </table>          
        </div>
      </div>
    </section>
</div>
<?php
}