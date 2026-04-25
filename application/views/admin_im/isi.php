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
          <div class="row">
            <div class="col-md-6">
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">WHATS NEW</h3>
                  <div class="box-tools pull-right"></div>
                </div>
                <div class="box-body">
                   <?php 
                     //     $isi_whatsnew = strip_tags($isi_whatsnew); 
                      //    $isi_whatsnew = html_entity_decode($isi_whatsnew); 
                          echo $isi_whatsnew;  
                  ?> 
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
elseif ($page=="kategori_im")
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
elseif ($page=="kategori_im_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/kategori_im/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">KATEGORI INDIKATOR MUTU</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_equipment",$nama_equipment,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
        <div class="col-md-12">
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
elseif ($page=="kategori_im_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/kategori_im/simpan_edit');?>" onClick="return cek();">
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
        <h3 class="box-title">KATEGORI INDIKATOR MUTU</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_equipment",$nama_equipment,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
        <div class="col-md-12">
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
elseif ($page=="indikator_mutu")
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
          <h3 class="box-title">CATATAN</h3>
        </div>
          <div class="box-body">
          <div class="box box-widget">
          <div style="font-weight:bold;color:green;" class="box-body">
            <ul>
            <li>Input semua Indikator Mutu dari semua kategori Agar dapat muncul di LHU dan Laporan</li>
            <li>Untuk Indikator Mutu yang tidak ada range mutunya cukup di beri nilai 0 (nol)</li>
            <li>Untuk Indikator yang tidak mempunyai nilai standar dan range maka cukup diberi nilai 0 (nol)</li>
            <li>Hasil dari semua Kategori Indikator Mutu nanti dibedakan di Laporan dan LHU</li>
          </ul>            
          </div>
          <!-- /.box-body -->
          </div>
          </div>
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Mutu</th>
            <th>Standar</th>
            <th>Range</th>
            <th>Satuan</th>
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
elseif ($page=="indikator_mutu_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/indikator_mutu/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">INDIKATOR MUTU</h3>
      </div>
        <div class="box-body">
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_limbah",$nama_limbah,"maxlength='255' required autofocus","Ketik","text");
                  ?>
              </div>
               <div class="col-md-6">
                  <label>Kategori Indikator Mutu</label>
                    <?php
                      input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
                    ?>
              </div>         
              <div class="col-md-6">
                  <label>Standar Mutu</label>
                  <?php
            input_textcustom("standar_mutu",$standar_mutu," style='text-align:right;' required maxlength='13'
                   onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control standar'",
                      "Isi Angka dan titik","text");
                  ?>
              </div>    
              <div class="col-md-6">
                  <label>Range Mutu</label>
                  <?php
            input_textcustom("range_mutu",$range_mutu," style='text-align:right;' required maxlength='13'
                   onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control range'",
                      "Isi Angka dan titik","text");
                  ?>
              </div> 
              <div class="col-md-6">
                  <label>Satuan</label>
                  <?php
                    input_text("satuan_limbah",$satuan_limbah,"maxlength='255' required autofocus","Ketik","text");
                  ?>
              </div>     
              <div class="col-md-6">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_limbah",$cmd_status,$status_limbah);
                    ?>
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
/*const numInputs = document.querySelectorAll('.standar, .range')
numInputs.forEach(function(input) {
  input.addEventListener('change', function(e) {
    if (e.target.value == '') {
      e.target.value = 0
    }
  })
})*/
</script>
<?php
}
elseif ($page=="indikator_mutu_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/indikator_mutu/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_limbah" value="<?= $id; ?>">
    <input type="hidden" name="pembuat_limbah" value="<?= $pembuat_limbah; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">INDIKATOR MUTU</h3>
      </div>
        <div class="box-body">
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_limbah",$nama_limbah,"maxlength='255' required autofocus","Ketik","text");
                  ?>
              </div>
               <div class="col-md-6">
                  <label>Kategori Indikator Mutu</label>
                    <?php
                      input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
                    ?>
              </div>         
              <div class="col-md-6">
                  <label>Standar Mutu</label>
                  <?php
            input_textcustom("standar_mutu",$standar_mutu," style='text-align:right;' required maxlength='13'
                   onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control standar'",
                      "Isi Angka dan titik","text");
                  ?>
              </div>    
              <div class="col-md-6">
                  <label>Range Mutu</label>
                  <?php
            input_textcustom("range_mutu",$range_mutu," style='text-align:right;' required maxlength='13'
                   onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control range'",
                      "Isi Angka dan titik","text");
                  ?>
              </div> 
              <div class="col-md-6">
                  <label>Satuan</label>
                  <?php
                    input_text("satuan_limbah",$satuan_limbah,"maxlength='255' required autofocus","Ketik","text");
                  ?>
              </div>     
              <div class="col-md-6">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_limbah",$cmd_status,$status_limbah);
                    ?>
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
/*const numInputs = document.querySelectorAll('.standar, .range')
numInputs.forEach(function(input) {
  input.addEventListener('change', function(e) {
    if (e.target.value == '') {
      e.target.value = 0
    }
  })
})*/
</script>
<?php
}
elseif ($page=="sumber_pengukuran")
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
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Sumber Pengukuran</th>
            <th>Mutu</th>
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
elseif ($page=="sumber_pengukuran_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/sumber_pengukuran/simpan_tambah');?>" onClick="return cek();">
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
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_sumber_emisi",$nama_sumber_emisi,"maxlength='255' required autofocus","Ketik","text");
                  ?>
                </div>
              </div>
               <div class="col-md-12">
                <div class="form-group">
                  <label>Opsi Pengukuran</label>
                    <?php
                      input_pdselect2("id_opsi_pengukuran",$opsi_sumes,$id_opsi_pengukuran);
                    ?>
                </div>
              </div>  
               <div class="col-md-12">
                <div class="form-group">
                  <label>Kategori Indikator Mutu</label>
                    <?php
                      input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
                    ?>
                </div>
              </div>       
              <div class="col-md-12">
                <div class="form-group">
                  <label>Deskripsi</label>
                    <?php
                      input_textareacustom("deskripsi_sumber_emisi",$deskripsi_sumber_emisi," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Deskripsi");
                    ?>
                </div>
              </div>        
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_sumber_emisi",$cmd_status,$status_sumber_emisi);
                    ?>
                </div>
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="sumber_pengukuran_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/sumber_pengukuran/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_sumber_emisi" value="<?= $id; ?>">
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
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_sumber_emisi",$nama_sumber_emisi,"maxlength='255' required autofocus","Ketik","text");
                  ?>
                </div>
              </div>
               <div class="col-md-12">
                <div class="form-group">
                  <label>Opsi Pengukuran</label>
                    <?php
                      input_pdselect2("id_opsi_pengukuran",$opsi_sumes,$id_opsi_pengukuran);
                    ?>
                </div>
              </div>  
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kategori Indikator Mutu</label>
                    <?php
                      input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
                    ?>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Deskripsi</label>
                    <?php
                      input_textareacustom("deskripsi_sumber_emisi",$deskripsi_sumber_emisi," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Deskripsi");
                    ?>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_sumber_emisi",$cmd_status,$status_sumber_emisi);
                    ?>
                </div>
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="pengolah_limbah")
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
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Mutu</th>
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
elseif ($page=="pengolah_limbah_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/pengolah_limbah/simpan_tambah');?>" onClick="return cek();">
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
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_pengolah_limbah",$nama_pengolah_limbah,"maxlength='255' required autofocus","Ketik","text");
                  ?>
                </div>
              </div>
               <div class="col-md-12">
                <div class="form-group">
                  <label>Kategori Indikator Mutu</label>
                    <?php
                      input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
                    ?>
                </div>
              </div>              
              <div class="col-md-12">
                <div class="form-group">
                  <label>Deskripsi</label>
                    <?php
                      input_textareacustom("deskripsi_pengolah_limbah",$deskripsi_pengolah_limbah," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Deskripsi");
                    ?>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_pengolah_limbah",$cmd_status,$status_pengolah_limbah);
                    ?>
                </div>
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="pengolah_limbah_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/pengolah_limbah/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_pengolah_limbah" value="<?= $id; ?>">
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
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_pengolah_limbah",$nama_pengolah_limbah,"maxlength='255' required autofocus","Ketik","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kategori Indikator Mutu</label>
                    <?php
                      input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
                    ?>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Deskripsi</label>
                    <?php
                      input_textareacustom("deskripsi_pengolah_limbah",$deskripsi_pengolah_limbah," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Deskripsi");
                    ?>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_pengolah_limbah",$cmd_status,$status_pengolah_limbah);
                    ?>
                </div>
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="tps")
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
elseif ($page=="tps_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/tps/simpan_tambah');?>" onClick="return cek();">
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
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_tps",$nama_tps,"maxlength='255' required autofocus","Ketik","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
                    ?>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_tps",$cmd_status,$status_tps);
                    ?>
                </div>
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
</script>
<?php
}
elseif ($page=="tps_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/tps/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_tps" value="<?= $id; ?>">
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
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_tps",$nama_tps,"maxlength='255' required autofocus","Ketik","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
                    ?>
                </div>
              </div> 
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_tps",$cmd_status,$status_tps);
                    ?>
                </div>
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
</script>
<?php
}
elseif ($page=="pembuangan")
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
elseif ($page=="pembuangan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/pembuangan/simpan_tambah');?>" onClick="return cek();">
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
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_perlakuan_emisi",$nama_perlakuan_emisi,"maxlength='255' required autofocus","Ketik","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_perlakuan_emisi",$cmd_status,$status_perlakuan_emisi);
                    ?>
                </div>
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
</script>
<?php
}
elseif ($page=="pembuangan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_im/pembuangan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_perlakuan_emisi" value="<?= $id; ?>">
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
          <div class="container col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama</label>
                  <?php
                    input_text("nama_perlakuan_emisi",$nama_perlakuan_emisi,"maxlength='255' required autofocus","Ketik","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_perlakuan_emisi",$cmd_status,$status_perlakuan_emisi);
                    ?>
                </div>
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
</script>
<?php
}