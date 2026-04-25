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
  <?php echo form_open_multipart('admin_komunitas/data_user/view/'.$key,' id="signupform" ');
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
            <th>Jabfung</th>
            <th>Pengurus</th>
            <th>Komunitas</th>
            <th>Grade</th>
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
elseif ($page=="data_user_asesor")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/data_user/simpan_asesor');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/data_user/simpan_grade');?>" onClick="return cek();">
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
elseif ($page=="data_user_pengurus")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/data_user/simpan_pengurus');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
            <label>Pilih Pengurus</label>
              <?php
                input_pdselect2fleksibel("pengurus_pengcab","pengurus_pengcab",$pengurus,"id_ms_pengurus","nama_ms_pengurus",$pengurus_pengcab,"Anggota");
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
elseif ($page=="data_user_pengcab")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/data_user/simpan_pengcab');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
            <label>Pilih Cabang</label>
              <?php
                input_pdselect2fleksibel("id_pengcab","id_pengcab",$pengcab,"id_dpk","nama_dpk",$id_pengcab,"PILIH KOMUNITAS");
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/pendidikan/simpan_tambah');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/pendidikan/simpan_edit');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/berkas_kategori/simpan_tambah');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/berkas_kategori/simpan_edit');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/kategori_pelatihan/simpan_tambah');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/kategori_pelatihan/simpan_edit');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/kategori_surat/simpan_tambah');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_komunitas/kategori_surat/simpan_edit');?>" onClick="return cek();">
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
<?php echo form_open_multipart('admin_komunitas/demografi/view/'.$id,' id="signupform" '); ?>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Komunitas</label>
                <?php
                  input_pdselect2("id",$working,$id);
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
<?php  
$nografik_pegawai_kab = 0;
$kon_pengcab = array('id_pengcab'=>$id,'status_pegawai'=>1);
$ambil_list_pegawai = $this->m_umum->ambil_data_kondisi_result('ol_pegawai',$kon_pengcab);
foreach ($ambil_list_pegawai as $rowambil_list_pegawai){
$nografik_pegawai_kab++;
//---------- a ambil_list_pegawai
?>
<div class="col-md-6">
  <div class="box-body table-responsive no-padding">
    <table class="table table-hover">
      <tr>
        <th style="width: 5%;"><?= $nografik_pegawai_kab ?></th>
        <th colspan='6' style="background-color: maroon;color: white;font-weight:bold;"><?= $rowambil_list_pegawai['nama_pegawai'] ?></th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="font-weight:bold;">Gender : 
          <?php 
            if($rowambil_list_pegawai['jk'] == 0){ echo 'Perempuan';}else{ echo 'laki-laki'; }
          ?>
        </th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="font-weight:bold;">TTL : 
          <?php 
            echo $rowambil_list_pegawai['tmp_lahir'].", ". $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_list_pegawai['tgl_lahir'])));    
          ?>
        </th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="font-weight:bold;">Age : 
          <?php 
            echo $this->m_rancak->dob($rowambil_list_pegawai['tgl_lahir']);
          ?>
        </th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="font-weight:bold;">Agama : 
          <?php 
            $rel = $this->m_umum->ambil_data('kol_agama','id_agama',$rowambil_list_pegawai['id_agama']);
            echo $rel['nama_agama'];
          ?>
        </th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="font-weight:bold;">Marital : 
          <?php 
            $mar = $this->m_umum->ambil_data('kol_status_kawin','id_status_kawin',$rowambil_list_pegawai['id_status_kawin']);
            echo $mar['nama_status_kawin'];
          ?>
        </th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="font-weight:bold;">Status Pegawai : 
          <?php 
            $st = $this->m_umum->ambil_data('ol_status_pegawai','id_status_pegawai',$rowambil_list_pegawai['tipe_pegawai']);
            echo $st['nama_status_pegawai'];
          ?>
        </th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="font-weight:bold;">Jabatan : 
          <?php 
            $jf = $this->m_umum->ambil_data('jabatan_fungsional','id_jabatan_fungsional',$rowambil_list_pegawai['id_jabatan_fungsional']);
            echo $jf['nama_jabatan_fungsional'];
          ?>
        </th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="font-weight:bold;">Pendidikan Terakhir : 
          <?php 
            $pen = $this->m_umum->ambil_data('kol_pendidikan','id_pendidikan',$rowambil_list_pegawai['id_pendidikan']);
             echo $pen['nama_pendidikan'];        
          ?>
        </th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="font-weight:bold;">Grade : 
          <?php 
            $grade = $this->m_umum->ambil_data('ol_pegawai_grade','id_grade',$rowambil_list_pegawai['id_grade']);
            if(empty($grade['nama_grade'])){
              echo'<button class="btn btn-danger btn-xs">Grade Belum Di Set</button>';
            }else{
             echo $grade['nama_grade'];        
            }
          ?>
        </th>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">SURAT IJIN</th>
      </tr>
      <tr>
<?php  
$dateb = date("Y-m-d", strtotime("+3 month"));
$expired_str_kab=$this->m_admin_user->ambil_berkas_from_list($rowambil_list_pegawai['id_pegawai'],1,$id,$id2);
foreach ($expired_str_kab as $rowexpired_str_kab){
?>
      <th>&nbsp;</th>
      <th>STR</th>
      <th>
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
      </th>
<?php  
} 
$expired_sip_kab=$this->m_admin_user->ambil_berkas_from_list($rowambil_list_pegawai['id_pegawai'],2,$id,$id2);
foreach ($expired_sip_kab as $rowexpired_sip_kab){
?>
          <th>SIP</th>
          <th>
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
                  </button>            
          <?php             
            }
          ?>
          </th>
<?php  
}
$expired_sik_kab=$this->m_admin_user->ambil_berkas_from_list($rowambil_list_pegawai['id_pegawai'],3,$id,$id2);
foreach ($expired_sik_kab as $rowexpired_sik_kab){
?>
          <th>SIK</th>
          <th>
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
          </th>
<?php  
}
?>
      </tr>
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PEMINATAN</th>
      </tr>
<?php
$select_minat = "*";
$kondisi_minat = array('opm.id_pegawai'=>$rowambil_list_pegawai['id_pegawai']);
$minat=$this->m_admin_user->grafik_all_pegawai_minat($select_minat,$kondisi_minat);
foreach ($minat as $rowminat){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowminat['nama_peminatan'] ?></th>
        </tr>
<?php  
}
?> 
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">PELATIHAN KHUSUS</th>
      </tr>
<?php
$ambil_pelatihan_person=$this->m_admin_user->ambil_berkas_pelatihan_person_pengcab('peg.id_pegawai',$rowambil_list_pegawai['id_pegawai'],$id,$id2);
foreach ($ambil_pelatihan_person as $rowambil_pelatihan_person){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><u>Kategori Pelatihan : <?= $rowambil_pelatihan_person['nama_kategori_pelatihan'] ?></u><br><?= $rowambil_pelatihan_person['nama_berkas'] ?><br>Tanggal :  <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_a_berkas']))) ?> - <?= $this->m_rancak->fullBulan(date('d-m-Y', strtotime($rowambil_pelatihan_person['tgl_b_berkas']))) ?></th>
        </tr>
<?php  
}
?>     
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="background-color: #e0e0e0;font-weight:bold;">TEMPAT BEKERJA</th>
      </tr>
<?php
$select_tempat_gawe = "*";
$kondisi_gawe = array('opi.id_pegawai'=>$rowambil_list_pegawai['id_pegawai'],'status_pegawai'=>1);
$tempat_gawe=$this->m_admin_user->grafik_all_pegawai_result($select_tempat_gawe,$kondisi_gawe);
foreach ($tempat_gawe as $rowtempat_gawe){
?>
        <tr>
          <th style="width: 5%;">&nbsp;</th>
          <th colspan='6'><?= $rowtempat_gawe['nama_working'] ?>, Status : <?php if($rowtempat_gawe['status_pegawai_instansi'] == 0){ echo 'RESIGN'; }else{ echo 'MASIH BEKERJA'; } ?></th>
        </tr>
<?php  
}
?>  
      <tr>
        <th style="width: 5%;">&nbsp;</th>
        <th colspan='6' style="background-color: darkred;color: white; font-weight:bold;">FOTO</th>
      </tr>
        <tr>
          <th colspan='3'>
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
          </th>
        </tr>
    </table>
  </div>
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
$dateb = date("Y-m-d", strtotime("+3 month"));
$kondisi_1=array('status_pegawai'=>1,'visible'=>1,'ope.id_pengcab'=>$id);
$select_gender = "SUM(CASE WHEN jk = '1' THEN 1 END) as mlc,SUM(CASE WHEN jk = '0' THEN 1 END) as flc";
$gender=$this->m_admin_user->grafik_all_pegawai($select_gender,$kondisi_1);

$select_agama = "COUNT(ope.id_agama) as total_agama,nama_agama,ope.id_agama";
$agama=$this->m_admin_user->grafik_all_pegawai_result($select_agama,$kondisi_1,'ope.id_agama');

$select_status_kawin = "COUNT(ope.id_status_kawin) as total_status_kawin,nama_status_kawin";
$status_kawin=$this->m_admin_user->grafik_all_pegawai_result($select_status_kawin,$kondisi_1,'ope.id_status_kawin');

$select_status_pegawai = "COUNT(ope.tipe_pegawai) as total_status_pegawai,nama_status_pegawai";
$status_pegawai=$this->m_admin_user->grafik_all_pegawai_result($select_status_pegawai,$kondisi_1,'ope.tipe_pegawai');

$select_pendidikan = "COUNT(ope.id_pendidikan) as total_pendidikan,nama_pendidikan";
$pendidikan=$this->m_admin_user->grafik_all_pegawai_result($select_pendidikan,$kondisi_1,'ope.id_pendidikan');

$select_jabatan_fungsional = "COUNT(ope.id_jabatan_fungsional) as total_jabatan_fungsional,nama_jabatan_fungsional";
$jf=$this->m_admin_user->grafik_all_pegawai_result($select_jabatan_fungsional,$kondisi_1,'ope.id_jabatan_fungsional');

$select_grade = "COUNT(ope.id_grade) as total_grade,nama_grade";
$gradee=$this->m_admin_user->grafik_all_pegawai_result($select_grade,$kondisi_1,'ope.id_grade');

$select_peminatan = "COUNT(opm.id_peminatan) as total_peminatan,nama_peminatan";
$minate=$this->m_admin_user->grafik_all_pegawai_minat($select_peminatan,$kondisi_1,'opm.id_peminatan');

$select_pelatihan = "COUNT(peg.id_pegawai) as total_pelatihan,nama_kategori_pelatihan";
$pelatihan=$this->m_admin_user->ambil_berkas_pelatihan_person_pengcab('status_pegawai',1,$id,$id2,'ob.id_kategori_pelatihan',$select_pelatihan);

$select_jml_bekerja = "COUNT(opi.id_instansi) as total_instansie,nama_working";
$jml_bekerja=$this->m_admin_user->grafik_all_pegawai_result($select_jml_bekerja,$kondisi_1);

$kondisi_expired_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas <='=>date('Y-m-d'),'peg.id_pengcab'=>$id);
$expired_str=$this->m_admin_user->ambil_berkas_ijin($kondisi_expired_str);
$kondisi_expired_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas <='=>date('Y-m-d'),'peg.id_pengcab'=>$id);
$expired_sip=$this->m_admin_user->ambil_berkas_ijin($kondisi_expired_sip);
$kondisi_expired_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas <='=>date('Y-m-d'),'peg.id_pengcab'=>$id);
$expired_sik=$this->m_admin_user->ambil_berkas_ijin($kondisi_expired_sik);

$kondisi_aktif_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >'=>date('Y-m-d'),'peg.id_pengcab'=>$id);
$aktif_str=$this->m_admin_user->ambil_berkas_ijin($kondisi_aktif_str);
$kondisi_aktif_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >'=>date('Y-m-d'),'peg.id_pengcab'=>$id);
$aktif_sip=$this->m_admin_user->ambil_berkas_ijin($kondisi_aktif_sip);
$kondisi_aktif_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >'=>date('Y-m-d'),'peg.id_pengcab'=>$id);
$aktif_sik=$this->m_admin_user->ambil_berkas_ijin($kondisi_aktif_sik);

$kondisi_tenggang_str=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>1,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'peg.id_pengcab'=>$id);
$tenggang_str=$this->m_admin_user->ambil_berkas_ijin($kondisi_tenggang_str);
$kondisi_tenggang_sip=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>2,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'peg.id_pengcab'=>$id);
$tenggang_sip=$this->m_admin_user->ambil_berkas_ijin($kondisi_tenggang_sip);
$kondisi_tenggang_sik=array('status_pegawai'=>1,'status_berkas'=>1,'id_kategori_berkas'=>3,'tgl_b_berkas >='=>date('Y-m-d'),'tgl_b_berkas <='=>$dateb,'peg.id_pengcab'=>$id);
$tenggang_sik=$this->m_admin_user->ambil_berkas_ijin($kondisi_tenggang_sik);

$select_prov = "COUNT(ope.id_prov) as total_prov,nama_prov,ope.id_prov";
$prov=$this->m_admin_user->grafik_all_pegawai_result($select_prov,$kondisi_1,'ope.id_prov');
?>
<div class="box-body table-responsive no-padding">
  <table width="100%" class="table table-hover">
    <tbody>
      <tr>
        <td style="background-color:#063970;color:white;vertical-align:middle;">Gender || PDF &nbsp;
          <a href="<?php echo base_url('admin_user/demografi/pdf_gender/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
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
          <a href="<?php echo base_url('admin_user/demografi/pdf_religi/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
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
          <a href="<?php echo base_url('admin_user/demografi/pdf_marital/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
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
          <a href="<?php echo base_url('admin_user/demografi/pdf_asn/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
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
          <a href="<?php echo base_url('admin_user/demografi/pdf_pendidikan/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
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
          <a href="<?php echo base_url('admin_user/demografi/pdf_jabfung/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
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
      <td style="background-color:#979915;color:white;vertical-align:middle;">Grade || PDF &nbsp;
          <a href="<?php echo base_url('admin_user/demografi/pdf_grade/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
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
        <a href="<?php echo base_url('admin_user/demografi/pdf_pelatihan/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
          <i class="fa fa-file-pdf-o text-white"></i> </a> - &nbsp;
        Pelatihan Khusus || PDF &nbsp;
        <a href="<?php echo base_url('admin_user/demografi/pdf_pelatihankhusus/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
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
      <td style="background-color:#979915;color:white;vertical-align:middle;">Peminatan</td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($minate as $rowminate){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowminate['nama_peminatan'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowminate['total_peminatan'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#979915;color:white;vertical-align:middle;">Tempat Bekerja</td>
      <td style="background-color:#979915;color:white;vertical-align:middle;text-align: right;width: 15%;">Jumlah</td>
    </tr>
<?php 
foreach ($jml_bekerja as $rowjml_bekerja){
?>
    <tr>
      <td style="vertical-align:middle;"><?= $rowjml_bekerja['nama_working'] ?></td>
      <td style="vertical-align:middle;text-align: right;"><?= $rowjml_bekerja['total_instansie'] ?></td>
    </tr>
<?php 
}
?>
    <tr>
      <td style="background-color:#063970;color:white;vertical-align:middle;">
        Surat Ijin &nbsp; <i class="fa fa-file-pdf-o text-white"></i>
        || 
          <a href="<?php echo base_url('admin_user/demografi/pdf_surat_ijin_aktif/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank"> Aktif
          </a> 
        || 
          <a href="<?php echo base_url('admin_user/demografi/pdf_surat_ijin_tenggang/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank"> Tenggang
          </a> 
        || 
          <a href="<?php echo base_url('admin_user/demografi/pdf_surat_ijin_expired/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank"> Expired
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
        <a href="<?php echo base_url('admin_user/demografi/pdf_alamat/'); ?><?= $id ?>/<?= $id2 ?>" target="_blank">
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
$kondisi_kab=array('status_pegawai'=>1,'visible'=>1,'ope.id_prov'=>$rowprov['id_prov'],'ope.id_pengcab'=>$id);
$select_kab = "COUNT(ope.id_kab) as total_kab,nama_kab,ope.id_kab";
$kab=$this->m_admin_user->grafik_all_pegawai_result($select_kab,$kondisi_kab,'ope.id_kab');

  foreach ($kab as $rowkab){
?>
    <tr>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;padding-left: 20px;">&nbsp;&nbsp;<?= $rowkab['nama_kab'] ?></td>
      <td style="background-color:#8C0720;color:white;vertical-align:middle;text-align: right;"><?= $rowkab['total_kab'] ?></td>
    </tr>
<?php
$kondisi_kec=array('status_pegawai'=>1,'visible'=>1,'ope.id_kab'=>$rowkab['id_kab'],'ope.id_pengcab'=>$id);
$select_kec = "COUNT(ope.id_kec) as total_kec,nama_kec,ope.id_kec";
$kec=$this->m_admin_user->grafik_all_pegawai_result($select_kec,$kondisi_kec,'ope.id_kec');

    foreach ($kec as $rowkec){
?>
    <tr>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;padding-left: 35px;"><?= $rowkec['nama_kec'] ?></td>
      <td style="background-color:#078C8A;color:white;vertical-align:middle;text-align: right;"><?= $rowkec['total_kec'] ?></td>
    </tr>
<?php
$kondisi_kel=array('status_pegawai'=>1,'visible'=>1,'ope.id_kec'=>$rowkec['id_kec'],'ope.id_pengcab'=>$id);
$select_kel = "COUNT(ope.id_kel) as total_kel,nama_kel,ope.id_kel";
$kel=$this->m_admin_user->grafik_all_pegawai_result($select_kel,$kondisi_kel,'ope.id_kel');

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