<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
$arrayboxBOX = array('aqua','green','yellow','red');
$resarrayBOX = array_rand($arrayboxBOX);
$thenarrayBOX = $arrayboxBOX[$resarrayBOX];
$btnarray = array('green','blue','yellow','red','purple','navy','maroon','olive','aqua','light-blue','teal','lime','orange','fuchsia');
$btnk = array_rand($btnarray);
$btnv = $btnarray[$btnk];
if ($page=="home")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small><?= $title ?></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?></h3>

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
elseif ($page=="indikator")
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
        <?php echo $title; ?> <small>  <?php echo $header; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="callout callout-success">
          Input indikator dari mutu, misal Ketepatan waktu distribusi, Waktu tunggu hasil pelayanan.<br>
          Hanya diinput oleh masing-masing ruangan / unit
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
            <th>Ruangan</th>                      
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
elseif ($page=="indikator_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/indikator/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_equipment",$nama_equipment,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Unit</label>
                  <?php
                    input_pdselect2("id_unit",$cmd_unit,$id_unit);
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
elseif ($page=="indikator_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/indikator/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_equipment" value="<?= $id_equipment; ?>">
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
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_equipment",$nama_equipment,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
              <div class="col-md-12">
                  <label>Unit</label>
                  <?php
                    input_pdselect2("id_unit",$cmd_unit,$id_unit);
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
elseif ($page=="mutu")
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
        <?php echo $title; ?> <small>  <?php echo $header; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="callout callout-success">
          Setelah Indikator dibuat maka inputlah mutu yang menjadi numerator dan denumeratornya
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
            <th>Indikator</th>          
            <th>Mutu</th>            
            <th>Ruangan</th>            
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
elseif ($page=="mutu_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/mutu/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MUTU</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <label>Indikator</label>
              <?php
                input_pdselect2("id_equipment",$equipment,$id_equipment);
              ?>   
            </div>
            <div class="col-md-12">
              <label>Mutu</label>
              <?php
                input_text("nama_eq_detil",$nama_eq_detil," required ","Masukkan Nama","text");
              ?>  
            </div>    
            <div class="col-md-12">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_detil",$cmd_status,$status_eq_detil);
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
elseif ($page=="mutu_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/mutu/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_eq_detil" value="<?= $id_eq_detil; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MUTU</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <label>Indikator</label>
              <?php
                input_pdselect2("id_equipment",$equipment,$id_equipment);
              ?>   
            </div>
            <div class="col-md-12">
              <label>Mutu</label>
              <?php
                input_text("nama_eq_detil",$nama_eq_detil," required ","Masukkan Nama","text");
              ?>  
            </div>    
            <div class="col-md-12">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_detil",$cmd_status,$status_eq_detil);
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
elseif ($page=="i_mutu")
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
      <?php echo form_open_multipart('ol_imut/'.$page.'/view/'.$id.'/'.$id2.'/'.$id3.'/'.$id4,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
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
            <div class="col-md-8">
              <div class="form-group">
              <label>Indikator</label>
              <?php
input_pdselect2fleksibel("id3","id3",$opsi,"id_equipment","nama_equipment",$id3,"SEMUA");
             //   input_pdselect2("id3",$opsi,$id3);
              ?>   
            </div>
            </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id4",$all_kah,$id4);
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
      <div class="callout callout-success">
          Data disini bersifat fleksibel, data tabel dan grafik tidak otomatis misal dalam persen maka input data hasil persentasenya langsung<br>
          Isi hasil mutu dan hasil bisa berupa nilai atau YA / TIDAK<br>
          Untuk yang menggunakan YA / TIDAK, pilih combo box Hasil YA/TIDAK kemudian nilai 1 untuk YA, dan 0 untuk TIDAK<br>
          Apabila hasilnya tidak ingin di tampilkan dalam tabel maupun grafik maka buat status menjadi NON AKTIF
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>            
            <th style="width:40%;text-align: center;vertical-align: middle;"><?php echo $title; ?></th>                                            
            <th style="text-align: center;vertical-align: middle;">Hasil</th>                                                                         
            <th style="text-align: center;vertical-align: middle;">Katerangan</th>
            <th style="text-align: center;vertical-align: middle;">Status</th>
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>
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
elseif ($page=="i_mutu_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/i_mutu/simpan_tambah');?>" onClick="return cek();">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_eq_imut","tgl_eq_imut",$tgl_eq_imut,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_eq_imut",$cmd_ya_tidak,$yn_eq_imut);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_imut",$cmd_status,$status_eq_imut);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_eq_detil",$equipment,$id_eq_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_eq_imut",$hasil_eq_imut,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_eq_imut",$ket_eq_imut," maxlength='255' ","","text");
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
$('#tgl_eq_imut').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_eq_imut").inputmask("datetime", {
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
elseif ($page=="i_mutu_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/i_mutu/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_eq_imut" value="<?= $id_eq_imut; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_eq_imut","tgl_eq_imut",$tgl_eq_imut,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_eq_imut",$cmd_ya_tidak,$yn_eq_imut);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_imut",$cmd_status,$status_eq_imut);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_eq_detil",$equipment,$id_eq_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_eq_imut",$hasil_eq_imut,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_eq_imut",$ket_eq_imut," maxlength='255' ","","text");
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
$('#tgl_eq_imut').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_eq_imut").inputmask("datetime", {
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
elseif ($page=="i_mutu_clone")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/i_mutu/simpan_clone');?>" onClick="return cek();">
            <input type="hidden" name="id_eq_imut" value="<?= $id_eq_imut; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_eq_imut","tgl_eq_imut",$tgl_eq_imut,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_eq_imut",$cmd_ya_tidak,$yn_eq_imut);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_imut",$cmd_status,$status_eq_imut);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_eq_detil",$equipment,$id_eq_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_eq_imut",$hasil_eq_imut,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_eq_imut",$ket_eq_imut," maxlength='255' ","","text");
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
$('#tgl_eq_imut').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_eq_imut").inputmask("datetime", {
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
//========================================================== QC
elseif ($page=="quality")
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
        <?php echo $title; ?> <small>  <?php echo $header; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="callout callout-success">
          Input indikator dari mutu, misal Ketepatan waktu distribusi, Waktu tunggu hasil pelayanan.<br>
          Hanya diinput oleh masing-masing ruangan / unit
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
            <th>Ruangan</th>            
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
elseif ($page=="quality_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/quality/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_equipment",$nama_equipment,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
        <div class="col-md-12">
            <label>Unit</label>
            <?php
              input_pdselect2("id_unit",$cmd_unit,$id_unit);
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
elseif ($page=="quality_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/quality/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_equipment" value="<?= $id_equipment; ?>">
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
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_equipment",$nama_equipment,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>    
        <div class="col-md-12">
            <label>Unit</label>
            <?php
              input_pdselect2("id_unit",$cmd_unit,$id_unit);
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
elseif ($page=="control")
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
        <?php echo $title; ?> <small>  <?php echo $header; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="callout callout-success">
          Setelah Kategori Quality dibuat maka inputlah yang menjadi poin kontrolnya
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
            <th>Kategori</th>          
            <th>Poin Control</th>            
            <th>Ruangan</th>            
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
elseif ($page=="control_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/control/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MUTU</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <label>Kategori</label>
              <?php
                input_pdselect2("id_equipment",$equipment,$id_equipment);
              ?>   
            </div>
            <div class="col-md-12">
              <label>Poin Control</label>
              <?php
                input_text("nama_eq_detil",$nama_eq_detil," required ","Masukkan Nama","text");
              ?>  
            </div>    
            <div class="col-md-12">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_detil",$cmd_status,$status_eq_detil);
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
elseif ($page=="control_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/control/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_eq_detil" value="<?= $id_eq_detil; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">MUTU</h3>
      </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <label>Kategori</label>
              <?php
                input_pdselect2("id_equipment",$equipment,$id_equipment);
              ?>   
            </div>
            <div class="col-md-12">
              <label>Poin Control</label>
              <?php
                input_text("nama_eq_detil",$nama_eq_detil," required ","Masukkan Nama","text");
              ?>  
            </div>    
            <div class="col-md-12">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_detil",$cmd_status,$status_eq_detil);
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
elseif ($page=="q_control")
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
      <?php echo form_open_multipart('ol_imut/'.$page.'/view/'.$id.'/'.$id2.'/'.$id3.'/'.$id4,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
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
            <div class="col-md-8">
              <div class="form-group">
              <label>Indikator</label>
              <?php
input_pdselect2fleksibel("id3","id3",$opsi,"id_equipment","nama_equipment",$id3,"SEMUA");
             //   input_pdselect2("id3",$opsi,$id3);
              ?>   
            </div>
            </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id4",$all_kah,$id4);
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
      <div class="callout callout-success">
          Data disini bersifat fleksibel, data tabel dan grafik tidak otomatis misal dalam persen maka input data hasil persentasenya langsung<br>
          Isi hasil mutu dan hasil bisa berupa nilai atau YA / TIDAK<br>
          Untuk yang menggunakan YA / TIDAK, pilih combo box Hasil YA/TIDAK kemudian nilai 1 untuk YA, dan 0 untuk TIDAK<br>
          Apabila hasilnya tidak ingin di tampilkan dalam tabel maupun grafik maka buat status menjadi NON AKTIF
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>            
            <th style="width:40%;text-align: center;vertical-align: middle;"><?php echo $title; ?></th>                                            
            <th style="text-align: center;vertical-align: middle;">Hasil</th>                                                                         
            <th style="text-align: center;vertical-align: middle;">Katerangan</th>
            <th style="text-align: center;vertical-align: middle;">Status</th>
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>
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
elseif ($page=="q_control_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/q_control/simpan_tambah');?>" onClick="return cek();">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_eq_imut","tgl_eq_imut",$tgl_eq_imut,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_eq_imut",$cmd_ya_tidak,$yn_eq_imut);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_imut",$cmd_status,$status_eq_imut);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_eq_detil",$equipment,$id_eq_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_eq_imut",$hasil_eq_imut,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_eq_imut",$ket_eq_imut," maxlength='255' ","","text");
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
$('#tgl_eq_imut').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_eq_imut").inputmask("datetime", {
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
elseif ($page=="q_control_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/q_control/simpan_edit');?>" onClick="return cek();">
            <input type="hidden" name="id_eq_imut" value="<?= $id_eq_imut; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_eq_imut","tgl_eq_imut",$tgl_eq_imut,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_eq_imut",$cmd_ya_tidak,$yn_eq_imut);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_imut",$cmd_status,$status_eq_imut);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_eq_detil",$equipment,$id_eq_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_eq_imut",$hasil_eq_imut,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_eq_imut",$ket_eq_imut," maxlength='255' ","","text");
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
$('#tgl_eq_imut').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_eq_imut").inputmask("datetime", {
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
elseif ($page=="q_control_clone")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/q_control/simpan_clone');?>" onClick="return cek();">
            <input type="hidden" name="id_eq_imut" value="<?= $id_eq_imut; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">         
            <div class="col-md-4">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_eq_imut","tgl_eq_imut",$tgl_eq_imut,"Masukkan Tanggal","");
                  ?>
            </div>
            <div class="col-md-4">
            <label>Apakah Hasil YA/TIDAK</label>
            <?php
              input_pdselect2("yn_eq_imut",$cmd_ya_tidak,$yn_eq_imut);
            ?>   
            </div>
            <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_eq_imut",$cmd_status,$status_eq_imut);
              ?>   
            </div>
            <div class="col-md-12">
            <label>Indikator</label>
            <?php
              input_pdselect2("id_eq_detil",$equipment,$id_eq_detil);
            ?>   
            </div>
            <div class="col-md-3">
            <label>Hasil</label>
                <?php
                  
          input_textcustom("hasil_eq_imut",$hasil_eq_imut,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
                  ?>   
            </div>
            <div class="col-md-9">
                <label>Keterangan</label>
                <?php
                  input_text("ket_eq_imut",$ket_eq_imut," maxlength='255' ","","text");
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
$('#tgl_eq_imut').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_eq_imut").inputmask("datetime", {
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
elseif ($page=="persen")
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
        <?php echo $title; ?> <small>  <?php echo $header; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="callout callout-success">
          Input indikator dari mutu, misal Ketepatan waktu distribusi, Waktu tunggu hasil pelayanan.<br>
          Hanya diinput oleh masing-masing ruangan / unit
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
            <th style="width:20%">Nama</th>                     
            <th style="width:20%">X</th>            
            <th style="width:20%">Y</th>
            <th>Target</th> 
            <th>Ruangan</th>                                  
            <th style="width:7%;">Status</th>            
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
elseif ($page=="persen_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/persen/simpan_tambah');?>" onClick="return cek();">
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
                  <label>Target</label>
                  <?php
                    input_text("target_eq_denum",$target_eq_denum,"maxlength='255' autofocus","Masukkan Target Jika Ada","text");
                  ?>  
              </div>    
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_eq_denum",$cmd_status,$status_eq_denum);
            ?>   
        </div> 
            <div class="col-md-12">
                <label>Isi X</label>
                <?php
                  input_pdselect2("num_eq_denum",$num,$num_eq_denum);
                ?>
            </div>
            <div class="col-md-12">
                <label>Isi Y</label>
                <?php
                  input_pdselect2("denum_eq_denum",$denum,$denum_eq_denum);
                ?>
            </div>
            <div class="col-md-12">
                <label>Indikator</label>
                <?php
          input_pdselect2fleksibel("id_equipment","id_equipment",$kol_equipment,"id_equipment","nama_equipment",$id_equipment,"Silahkan Pilih");
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
    $('select[name=id_equipment]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>ol_imut/equipment_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
                $("#num_eq_denum").empty();
                $("#denum_eq_denum").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_eq_detil"];
                    var name = data[i]["nama_eq_detil"];

                    $("#num_eq_denum").append("<option value='"+id+"'>"+name+"</option>");
                    $("#denum_eq_denum").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="persen_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/persen/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_eq_denum" value="<?= $id_eq_denum; ?>">
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
                  <label>Target</label>
                  <?php
                    input_text("target_eq_denum",$target_eq_denum,"maxlength='255' autofocus","Masukkan Target Jika Ada","text");
                  ?>  
              </div>    
        <div class="col-md-6">
            <label>Status</label>
            <?php
              input_pdselect2("status_eq_denum",$cmd_status,$status_eq_denum);
            ?>   
        </div> 
            <div class="col-md-12">
                <label>Isi X</label>
                <?php
                  input_pdselect2("num_eq_denum",$num,$num_eq_denum);
                ?>
            </div>
            <div class="col-md-12">
                <label>Isi Y</label>
                <?php
                  input_pdselect2("denum_eq_denum",$denum,$denum_eq_denum);
                ?>
            </div>
            <div class="col-md-12">
                <label>Indikator</label>
                <?php
          input_pdselect2fleksibel("id_equipment","id_equipment",$kol_equipment,"id_equipment","nama_equipment",$id_equipment,"Silahkan Pilih");
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
    $('select[name=id_equipment]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>ol_imut/equipment_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
                $("#num_eq_denum").empty();
                $("#denum_eq_denum").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_eq_detil"];
                    var name = data[i]["nama_eq_detil"];

                    $("#num_eq_denum").append("<option value='"+id+"'>"+name+"</option>");
                    $("#denum_eq_denum").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
//========================================================== QC
elseif ($page=="report")
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
      <?php echo form_open_multipart('ol_imut/'.$page.'/view/'.$id.'/'.$id2.'/'.$id3.'/'.$id4,' id="signupform" '); ?>
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE / PERIODE TANGGAL (OPSI TANGGAL SEMUA UNTUK TAMPILKAN SEMUA DATA)</h3>
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
            <div class="col-md-8">
              <div class="form-group">
              <label>Indikator</label>
              <?php
input_pdselect2fleksibel("id3","id3",$opsi,"id_equipment","nama_equipment",$id3,"SEMUA");
             //   input_pdselect2("id3",$opsi,$id3);
              ?>   
            </div>
            </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id4",$all_kah,$id4);
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
      <div class="callout callout-success">
          Isi form yang ingin di tampilkan, jika tidak ditampilkan, form dapat di kosongkan<br>
          Tanggal awal dan Tanggal akhir adalah range tanggal mutu dibuat<br>
          Laporan ini dalam bentuk tabel dan grafik, data dapat dipilih sesuai dengan tema dan tujuan laporan
      </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display: none;">&nbsp;</th>            
            <th style="width:10%;text-align: center;vertical-align: middle;">Tanggal</th>
            <th style="width:15%;text-align: center;vertical-align: middle;">Range</th>                                                  
            <th style="text-align: center;vertical-align: middle;">Judul</th>                                                        
            <th style="text-align: center;vertical-align: middle;">Tujuan</th>                            
            <th style="text-align: center;vertical-align: middle;">Unit</th> 
            <th style="text-align: center;vertical-align: middle;">Pembuat</th>
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
elseif ($page=="report_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/report/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
     <div class="box-body">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">TANGGAL LAPORAN DAN PERIODE PENGAMBILAN LAPORAN (SESUAI TANGGAL LOGBOOK)</h3>
        </div>
          <div class="box-body">
            <div class="row">         
              <div class="col-md-4">
                  <label>Tanggal Laporan</label>
                  <?php
                    input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Awal</label>
                  <?php
                    input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
                  ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">     
            <div class="col-md-6">
                <label>Header Laporan</label>
                <?php
                  input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 1</label>
                <?php
                  input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 2</label>
                <?php
                  input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Tujuan</label>
                <?php
                  input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Judul Laporan</label>
                <?php
                  input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Periode</label>
                <?php
                  input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Sumber Data</label>
                <?php
                  input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
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
$('#tgl_laporan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_laporan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
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
elseif ($page=="report_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/report/simpan_edit');?>" onClick="return cek();">
       <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
     <div class="box-body">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">TANGGAL LAPORAN DAN PERIODE PENGAMBILAN LAPORAN (SESUAI TANGGAL LOGBOOK)</h3>
        </div>
          <div class="box-body">
            <div class="row">         
              <div class="col-md-4">
                  <label>Tanggal Laporan</label>
                  <?php
                    input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Awal</label>
                  <?php
                    input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
                  ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
          <div class="row">       
            <div class="col-md-6">
                <label>Header Laporan</label>
                <?php
                  input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 1</label>
                <?php
                  input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Sub Header Laporan 2</label>
                <?php
                  input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Tujuan</label>
                <?php
                  input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
                ?>
            </div>
            <div class="col-md-6">
                <label>Judul Laporan</label>
                <?php
                  input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Periode</label>
                <?php
                  input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Sumber Data</label>
                <?php
                  input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
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
$('#tgl_laporan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_laporan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
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
elseif ($page=="sheet")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
#legenddiv {
  max-height: 150px;
  overflow: auto;
}
#chartdiv, #legendwrapper {
  width: 100%;
  height: 1000px;
}
#legenddiv {
  height: 150px;
}

#legendwrapper {
  max-height: 120px;
  overflow-x: none;
  overflow-y: auto;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $link_awal;?>"
        class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
      </a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?></h3>

          <div class="box-tools pull-right">
      <?php
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-info">
        <h5>Judul Laporan : <?php echo $judul_laporan; ?><?php if($iddet) echo '</h5><h5>Judul Tabel / Grafik : '.$judul_laporan_detil; ?></h5>
      </div>

      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?= $title ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
      <div class="callout callout-success">
        <div class="row">
        <div class="col-md-6">
          Urutan = urutan di dalam tampilan tabel ini<br>
          Judul = Judul untuk tampilan di tabel ini<br>
          Range = Jika min nilai data dan max nilai data diisi<br>
          Indikator = Data indikator sebagai sebagai master<br>
          Tabel = Bentuk tabel / grafik yang di pilih<br>
          Sub Tombol = Bila di dalam laporan di tampilkan tombol ke tabel lainnya<br>
        </div>
        <div class="col-md-6">
          UNTUK MEMBUAT TABEL DENGAN RANGE BISA MEMILIH TABEL GRAFIK GARIS RANGE COMBINE<br>
          UNTUK MEMBUAT RANGE ISI FORM MINIMAL VALUE DAN ATAU MAXIMAL VALUE<br>
          UNTUK NILAI YANG TIDAK DIPERLUKAN ISI SAJA NOL (0)
        </div>
        </div>
      </div>
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
            <thead>
              <tr>
                <th style="width:5%;vertical-align: middle;text-align: center;">Urutan</th>            
                <th style="vertical-align: middle;">Judul</th>            
                <th style="vertical-align: middle;">Bentuk</th>            
                <th style="width:10%;vertical-align: middle;">Range</th>                     
                <th style="width:15%;vertical-align: middle;">Tabel</th>               
                <th style="width:15%;vertical-align: middle;">Unit</th>                                        
                <th style="width:10%;vertical-align: middle;">Sub Tombol</th>               
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
elseif ($page=="sheet_tambah_tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/sheet/simpan_tambah_tabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan" value="<?= $idlap; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">LENGKAPI DATA</h3>
      </div>
        <div class="box-body">
          <div class="row">     
          <div class="col-md-6">
            <label>Judul</label>
            <?php
              input_text("judul_laporan_detil",$judul_laporan_detil," maxlength='255' required ","","text");
            ?>  
          </div>
          <div class="col-md-4">
            <label>Grafik</label>
            <?php
            //  input_pdselect2("tabel",$ambil_tabel,$tabel);
input_pdselect2fleksibel("tabel","tabel",$ambil_tabel,"id_tabel","nama_tabel",$tabel,"Tanpa Tabel dan Grafik");
            ?>  
          </div> 
          <div class="col-md-2">
            <label>Urutan</label>
            <?php
          input_textcustom("urutan_laporan_detil",$urutan_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Angka","text"); 
            ?>  
          </div>
          <div class="col-md-3">
            <label>Bentuk Tabel / Grafik</label>
            <?php
              input_pdselect2("periode_laporan_detil",$periode,$periode_laporan_detil);
            ?>  
          </div>
          <div class="col-md-3">
            <label>Mininal Value</label>
            <?php
          input_textcustom("min_laporan_detil",$min_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>  
          <div class="col-md-3">
            <label>Maximal Value</label>
            <?php
          input_textcustom("max_laporan_detil",$max_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>
          <div class="col-md-3">
            <label>Tampilkan Tombol</label>
            <?php
              input_pdselect2("button",$cmd_ya_tidak,$button);
            ?>  
          </div>
          <div class="col-md-12">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_detil",$analisa_laporan_detil," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Hasil / Rekomendasi</label>
            <?php
      input_textareacustom("rekomendasi_laporan_detil",$rekomendasi_laporan_detil," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>     
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
  CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="sheet_rubah_tabel")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/sheet/simpan_rubah_tabel');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH TABEL DAN GRAFIK</h3>
      </div>
        <div class="box-body">
          <div class="row">          
          <div class="col-md-6">
            <label>Judul</label>
            <?php
              input_text("judul_laporan_detil",$judul_laporan_detil," maxlength='255' required ","","text");
            ?>  
          </div>
          <div class="col-md-4">
            <label>Grafik</label>
            <?php
            //  input_pdselect2("tabel",$ambil_tabel,$tabel);
input_pdselect2fleksibel("tabel","tabel",$ambil_tabel,"id_tabel","nama_tabel",$tabel,"Tanpa Tabel dan Grafik");
            ?>  
          </div> 
          <div class="col-md-2">
            <label>Urutan</label>
            <?php
          input_textcustom("urutan_laporan_detil",$urutan_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Angka","text"); 
            ?>  
          </div>
          <div class="col-md-3">
            <label>Bentuk Tabel / Grafik</label>
            <?php
              input_pdselect2("periode_laporan_detil",$periode,$periode_laporan_detil);
            ?>  
          </div>
          <div class="col-md-3">
            <label>Mininal Value</label>
            <?php
          input_textcustom("min_laporan_detil",$min_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>  
          <div class="col-md-3">
            <label>Maximal Value</label>
            <?php
          input_textcustom("max_laporan_detil",$max_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>
          <div class="col-md-3">
            <label>Tampilkan Tombol</label>
            <?php
              input_pdselect2("button",$cmd_ya_tidak,$button);
            ?>  
          </div>
          <div class="col-md-12">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_detil",$analisa_laporan_detil," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Hasil / Rekomendasi</label>
            <?php
      input_textareacustom("rekomendasi_laporan_detil",$rekomendasi_laporan_detil," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>     
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="sheet_clone")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/sheet/simpan_clone');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH TABEL DAN GRAFIK</h3>
      </div>
        <div class="box-body">
          <div class="row">          
          <div class="col-md-6">
            <label>Nama Tabel</label>
            <?php
              input_text("judul_laporan_detil",$judul_laporan_detil," maxlength='255' required ","","text");
            ?>  
          </div>
          <div class="col-md-4">
            <label>Grafik</label>
            <?php
            //  input_pdselect2("tabel",$ambil_tabel,$tabel);
input_pdselect2fleksibel("tabel","tabel",$ambil_tabel,"id_tabel","nama_tabel",$tabel,"Tanpa Tabel dan Grafik");
            ?>  
          </div> 
          <div class="col-md-2">
            <label>Urutan</label>
            <?php
          input_textcustom("urutan_laporan_detil",$urutan_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Angka","text"); 
            ?>  
          </div>
          <div class="col-md-3">
            <label>Bentuk Tabel / Grafik</label>
            <?php
              input_pdselect2("periode_laporan_detil",$periode,$periode_laporan_detil);
            ?>  
          </div>
          <div class="col-md-3">
            <label>Mininal Value</label>
            <?php
          input_textcustom("min_laporan_detil",$min_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>  
          <div class="col-md-3">
            <label>Maximal Value</label>
            <?php
          input_textcustom("max_laporan_detil",$max_laporan_detil,"maxlength='3' required class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
            ?>  
          </div>
          <div class="col-md-3">
            <label>Tampilkan Tombol</label>
            <?php
              input_pdselect2("button",$cmd_ya_tidak,$button);
            ?>  
          </div> 
          <div class="col-md-12">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_detil",$analisa_laporan_detil," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Hasil / Rekomendasi</label>
            <?php
      input_textareacustom("rekomendasi_laporan_detil",$rekomendasi_laporan_detil," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>     
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="sheet_seting_im")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.table-scroll {
  position: relative;
  width:100%;
  z-index: 1;
  margin: auto;
  overflow: auto;
  height: 350px;
}
.table-scroll table {
  width: 100%;
  margin: auto;
  border-collapse: separate;
  border-spacing: 0;
}
.table-wrap {
  position: relative;
}
.table-scroll th,
.table-scroll td {
  padding: 5px 10px;
  border: 1px solid #000;
  background: #fff;
  vertical-align: top;
}
.table-scroll thead th {
  background: #333;
  color: #fff;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}
/* safari and ios need the tfoot itself to be position:sticky also */
.table-scroll tfoot,
.table-scroll tfoot th,
.table-scroll tfoot td {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  background: #666;
  color: #fff;
  z-index:4;
}

a:focus {
  background: red;
} /* testing links*/

th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
  background: #ccc;
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_imut/sheet/simpan_seting_im');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN</h3>
            </div>
              <div class="box-body">      
      <div class="callout callout-success">
        Jika Dikosongkan Maka Data Mutu Akan Kosong
      </div>     
                <div id="table-scroll" class="table-scroll">
                <table id="main-table" class="table table-bordered table-striped main-table">
                  <thead class="header">
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                  </tr>
                  </thead>
                  <tbody class="scrollable">
                    <?php
                    $no=0;
                    /*$arr = array();
                    foreach($arr_isi as $val){
                        $arr[] = $val['id_source'];
                    }
                    $eimplo = implode(",", $arr);*/
                    foreach($chk_eq_detil as $row){
                     $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['coun_equipment'];?>" <?php if(in_array($row['coun_equipment'],explode(",", $id_equipment))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;">
                        <?= $row['nama_equipment'] ?>
                    </td>
                  </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
                </div>
              </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
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
elseif ($page=="sheet_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
.table-scroll {
  position: relative;
  width:100%;
  z-index: 1;
  margin: auto;
  overflow: auto;
  height: 350px;
}
.table-scroll table {
  width: 100%;
  margin: auto;
  border-collapse: separate;
  border-spacing: 0;
}
.table-wrap {
  position: relative;
}
.table-scroll th,
.table-scroll td {
  padding: 5px 10px;
  border: 1px solid #000;
  background: #fff;
  vertical-align: top;
}
.table-scroll thead th {
  background: #333;
  color: #fff;
  position: -webkit-sticky;
  position: sticky;
  top: 0;
}
/* safari and ios need the tfoot itself to be position:sticky also */
.table-scroll tfoot,
.table-scroll tfoot th,
.table-scroll tfoot td {
  position: -webkit-sticky;
  position: sticky;
  bottom: 0;
  background: #666;
  color: #fff;
  z-index:4;
}

a:focus {
  background: red;
} /* testing links*/

th:first-child {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 2;
  background: #ccc;
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_imut/sheet/simpan_seting');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight:bold;">SILAHKAN PILIH DATA YANG DIINGINKAN</h3>
            </div>
              <div class="box-body">      
      <div class="callout callout-success">
        Jika Dikosongkan Maka Sistem Akan Memilih Semua Data <?= $id_equipment; ?>
      </div>     
                <div id="table-scroll" class="table-scroll">
                <table id="main-table" class="table table-bordered table-striped main-table">
                  <thead class="header">
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Data Mutu</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                  if($id_equipment){
                    $no=0;
                    /*$arr = array();
                    foreach($arr_isi as $val){
                        $arr[] = $val['id_source'];
                    }
                    $eimplo = implode(",", $arr);*/
                    foreach($chk_eq_detil as $row){
                     $no++;
                    ?>
                    <tr>
                      <td style="vertical-align:middle;text-align: center;">
                        <div class="checkbox">
                        <label>
                          <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['coun_eq_detil'];?>" <?php if(in_array($row['coun_eq_detil'],explode(",", $equipment_detil))) echo 'checked="checked"'; ?>> 
                        </label>
                        </div>
                      </td>
                      <td style="vertical-align:middle;">
                          <?= $row['nama_eq_detil'] ?>                  
                      </td>
                      <td style="vertical-align:middle;">
                          <?= $row['nama_equipment'] ?>
                      </td>
                    </tr>
                    <?php
                      }
                    }else{
                    ?>
                      <tr><td style="vertical-align:middle;">SEMUA DATA TERPILIH</td></tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
                </div>
              </div>
        <div class="box-footer">
          <?php if($cek > 0 && $id_equipment){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
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
elseif ($page=="sheet_persen")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/sheet/simpan_persen');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">PILIH KATEGORI</h3>
      </div>
        <div class="box-body">
          <div class="row">          
          <div class="col-md-12">
            <label>KATEGORI</label>
            <?php
            //  input_pdselect2("tabel",$ambil_tabel,$tabel);
input_pdselect2fleksibel("nudenum","nudenum",$chk_eq_detil,"id_equipment","nama_equipment",$nudenum,"TANPA PERSEN");
            ?>  
          </div>      
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
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
elseif ($page=="sheet_xy")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_imut/sheet/simpan_xy');?>" onClick="return cek();">
            <input type="hidden" name="id_laporan_detil" value="<?= $id_laporan_detil; ?>">
            <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">RUMUS : X / Y * 100%</h3>
      </div>
        <div class="box-body">
          <div class="row">          
          <div class="col-md-6">
            <label>X</label>
            <?php
             input_pdselect2("numerator_laporan_detil",$chk_eq_detil,$numerator_laporan_detil);
            ?>  
          </div>  
          <div class="col-md-6">
            <label>Y</label>
            <?php
             input_pdselect2("denumerator_laporan_detil",$chk_eq_detil,$denumerator_laporan_detil);
            ?>  
          </div>    
          </div>
        </div>
        <div class="box-footer">
          <?php if($cek > 0 && $nudenum){ echo '<button type="submit" class="btn btn-primary">Submit</button>';} ?>
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