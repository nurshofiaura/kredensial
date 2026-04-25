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
elseif ($page=="lhu")
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
            <li>Masukkan Semua Data Baik Hasil Pengujian dan Penelitian Pengendalian</li>
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
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
        </div>
        <div class="box-body">
      <?php echo form_open_multipart('i_mutu/lhu/view/'.$id.'/'.$id2.'/'.$id4,' id="signupform" '); ?>
        <div class="col-md-9">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">RANGE /PERIODE TANGGAL</h3>
        </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tanggal Awal</label>
                    <?php
                      input_calendar("id","id",$id,"Masukkan Tanggal","");
                    ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <?php
                    input_calendar("id2","id2",$id2,"Masukkan Tanggal","");
                  ?>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Pilihan Data</label>
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
        </div>
        <div class="col-md-3">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">CATATAN</h3>
        </div>
          <div class="box-body">
          <div class="box box-widget">
          <div style="font-weight:bold;color:green;" class="box-body">
            <ul>
            <li>Mohon Untuk Tidak Mengisi Dobel untuk setiap Indikator Mutu agar Tabel Pie Muncul 100%</li>
          </ul>            
          </div>
          <!-- /.box-body -->
          </div>
          </div>
        </div>
        </div>
        <?php echo form_close(); ?>
        </div>
      </div>
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
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Deskripsi</th> 
            <th>Kategori</th>
            <th>Tanggal LHU</th>            
            <th>No LHU</th>                                           
            <th>Unit</th>                                           
            <th>Lampiran</th>                       
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
elseif ($page=="lhu_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('i_mutu/lhu/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-6">
                  <label>Tanggal LHU</label>
                  <?php
                    input_calendar("tgl_lhu","tgl_lhu",$tgl_lhu,"Masukkan Tanggal Transaksi","required");
                  ?>
              </div> 
              <div class="col-md-6">
                  <label>Kategori Indikator Mutu</label>
                    <?php
                      input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
                    ?>
              </div> 
              <div class="col-md-12">
                  <label>NO LHU</label>
                  <?php
                    input_text("no_lhu",$no_lhu,"maxlength='40' ","Kosongkan Jika Tidak Ada Nomor","text");
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
    $('#tgl_lhu').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
  $("#tgl_lhu").inputmask("datetime", {
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
elseif ($page=="lhu_upload")
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
        <?php echo form_open_multipart('i_mutu/lhu/upload/'.$id,' ');
        input_text("id_lhu",$id_lhu,"","","hidden");
        input_text("barcode_lhu",$barcode_lhu,"","","hidden");
        ?>
        <div class="box-body">
          <div class="form-group">
            <label>Pilih Berkas</label>
            <?php
              input_text("upload_Files[]",""," required","","file");
            ?><p class="help-block">Format harus PDF</p>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <?php echo form_close(); ?>
      </div>
    </section>
  </div>
<?php
}
elseif ($page=="lhu_input")
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
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
      <?php echo form_open_multipart('i_mutu/lhu/input/'.$id,' id="signupform" ');  
    input_text("id_lhu",$id_lhu,"","","hidden");
    input_text("barcode_lhu",$barcode_lhu,"","","hidden");
    input_text("pembuat_lhu",$pembuat_lhu,"","","hidden");
      ?>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">HASIL UJI</h3>
      </div>
        <div class="box-body">
        <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label>Tanggal</label>
                  <?php
                    input_calendar("tgl_lhu","tgl_lhu",$tgl_lhu,"Masukkan Tanggal"," required");
                  ?>  
              </div>          
            </div> 
            <div class="col-md-3">
              <div class="form-group">
                <label>No LHU</label>
                <?php
                  input_text("no_lhu",$no_lhu,"maxlength='40' ","Masukkan No","text");
                ?>  
              </div>        
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Kategori Indikator Mutu</label>
                <?php
                  input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
                ?>  
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Deskripsi (Untuk label dalam pencarian data)</label>
                <?php
                      input_text("deskripsi_lhu",$deskripsi_lhu,"autofocus required","Masukkan Judul / Deskripsi","text");
                ?>  
              </div>        
            </div>                        
        </div>  
        </div>
        <div class="box-footer">
      <button type="submit" name="action" value="BtnSave" class="btn btn-primary pull-left">
        <i class="glyphicon glyphicon-edit"></i> Simpan
      </button>
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">DAFTAR INDIKATOR MUTU</h3>
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
                <th>Nama Indikator Mutu</th>
                <th style="text-align:right;">Hasil</th>                                                     
              </tr>
            </thead>
          </table>  
        </div>
      </div>
        </div>
    <?php echo form_close(); ?>
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
elseif ($page=="lhu_isi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('i_mutu/lhu/simpan_isi');?>" onClick="return cek();">
       <input type="hidden" name="id_lhu" value="<?= $id_lhu; ?>">
       <input type="hidden" name="barcode_lhu" value="<?= $barcode_lhu; ?>">
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
                  <label>Indikator Mutu</label>
                  <?php
                    input_pdselect2("id_limbah",$ambil_limbah,$id_limbah);
                  ?>  
              </div>
              <div class="col-md-12">
                  <label>Hasil</label>
                  <?php
          input_textcustom("hasil_lhu_detil",$hasil_lhu_detil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
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
elseif ($page=="lhu_rubah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('i_mutu/lhu/simpan_rubah');?>" onClick="return cek();">
       <input type="hidden" name="id_lhu" value="<?= $id_lhu; ?>">
       <input type="hidden" name="barcode_lhu" value="<?= $barcode_lhu; ?>">
       <input type="hidden" name="id_lhu_detil" value="<?= $id_lhu_detil; ?>">
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
                  <label>Indikator Mutu</label>
                  <?php
                    input_pdselect2("id_limbah",$ambil_limbah,$id_limbah);
                  ?>  
              </div>
              <div class="col-md-12">
                  <label>Hasil</label>
                  <?php
          input_textcustom("hasil_lhu_detil",$hasil_lhu_detil,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' " ,"Masukkan Angka dan Titik","text"); 
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
elseif ($page=="laporan")
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
      <?php echo form_open_multipart('i_mutu/laporan/view/'.$id.'/'.$id2.'/'.$id4.'/'.$id5.'/'.$id6,' id="signupform" '); ?>
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
              <div class="col-md-6">
                <div class="form-group">
                  <label>Opsi Tanggal</label>
                  <?php
                    input_pdselect2("id5",$all_kah,$id5);
                  ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Opsi Kategori</label>
                  <?php
                    input_pdselect2("id6",$kategori_kah,$id6);
                  ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kategori</label>
                  <?php
                    input_pdselect2("id4",$ambil_sn_standar_mutu,$id4);
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
            <th style="display:none;">ID</th>
            <th>Kategori</th>
            <th>Tanggal Laporan</th>            
            <th>Judul</th>                                 
            <th>Unit</th>                       
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
elseif ($page=="laporan_tambah")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small><?= $title ?></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('i_mutu/laporan/tambah',' id="signupform" '); ; 

  ?>  
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">Kosongkan Jika Tidak Diperlukan</h3>
          <div class="box-tools pull-right">
            <button type="submit" class="btn btn-primary btn-xs">Submit</button>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-2">
            <div class="form-group">
              <label>Tanggal</label>
              <?php
                input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Kategori</label>
              <?php
               input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal Awal</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Header Profil</label>
              <?php
                input_text("header_profil",$header_profil," maxlength='255' ","Header Profil","text");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Sub Header Profil</label>
              <?php
                input_text("sub_header_profil",$sub_header_profil," maxlength='255' ","Sub Header Profil","text");
              ?>
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group">
              <label>Sejarah</label>
              <?php
                input_textareacustom("sejarah",$sejarah," id='editor7' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Visi Misi</label>
              <?php
                input_textareacustom("visi_misi",$visi_misi," id='editor8' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tujuan dan Fungsi</label>
              <?php
                input_textareacustom("tujuan_fungsi",$tujuan_fungsi," id='editor9' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Informasi Layanan / Standar Mutu</label>
              <?php
                input_textareacustom("informasi_layanan",$informasi_layanan," id='editor10' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Header Laporan</label>
              <?php
                input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Sub Header Laporan</label>
              <?php
                input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Sub Header Laporan2</label>
              <?php
                input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Judul Laporan</label>
              <?php
                input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Dimensi Mutu</label>
              <?php
                input_text("dimensi_laporan",$dimensi_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tujuan</label>
              <?php
                input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Jenis Indikator</label>
              <?php
                input_text("jenis_laporan",$jenis_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Satuan Pengukuran</label>
              <?php
                input_text("satuan_laporan",$satuan_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Target Pencapaian</label>
              <?php
                input_text("standar_laporan",$standar_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Metode Pengumpulan Data</label>
              <?php
                input_text("metode_laporan",$metode_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Sumber Data</label>
              <?php
                input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>     
          <div class="col-md-4">
            <div class="form-group">
              <label>Instrumen Pengambilan Data</label>
              <?php
                input_text("instrumen_laporan",$instrumen_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>   
          <div class="col-md-4">
            <div class="form-group">
              <label>Besaran Sample</label>
              <?php
                input_text("sampel_laporan",$sampel_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Cara Pengambilan Sample</label>
              <?php
                input_text("teknis_laporan",$teknis_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Periode Pengumpulan Data</label>
              <?php
                input_text("frekuensi_laporan",$frekuensi_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Periode Analisa dan Pelaporan Data</label>
              <?php
                input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Penyajian Data</label>
              <?php
                input_text("penyajian_laporan",$penyajian_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Penanggung Jawab</label>
              <?php
                input_text("tgjawab_laporan",$tgjawab_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Pengumpul Data</label>
              <?php
                input_pdselect2("pengumpul_data",$cmd_jabatan,$this->session->id_jabatan);
              ?>
            </div>
          </div>
        <div class="col-md-12">      
          <div class="form-group">
            <label>Dasar Pemikiran</label>
          <?php
            input_textareacustom("dasar_laporan",$dasar_laporan," id='editor4' rows='5' cols='50' class='form-control' ","");
          ?>  
          </div>     
        <div class="form-group">
          <label>Definisi Operasional</label>
          <?php
            input_textareacustom("definisi_laporan",$definisi_laporan," id='editor3' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div>  
        <div class="form-group">
          <label>Numerator</label>
          <?php
            input_textareacustom("numerator_laporan",$numerator_laporan," id='editor1' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div>  
        <div class="form-group">
          <label>Denominator</label>
          <?php
            input_textareacustom("denominator_laporan",$denominator_laporan," id='editor2' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div>  
        <div class="form-group">
          <label>Kriteria</label>
          <?php
            input_textareacustom("kriteria_laporan",$kriteria_laporan," id='editor5' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div> 
        <div class="form-group">
          <label>Formula</label>
          <?php
            input_textareacustom("formula_laporan",$formula_laporan," id='editor6' rows='5' cols='50' class='form-control' ","");
          ?>  
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
elseif ($page=="laporan_clone")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('i_mutu/laporan/clone/'.$id,' id="signupform" '); ; 

  ?>  
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-2">
            <div class="form-group">
              <label>Tanggal</label>
              <?php
                input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Kategori</label>
              <?php
               input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal Awal</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Header Profil</label>
              <?php
                input_text("header_profil",$header_profil," maxlength='255' ","Header Profil","text");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Sub Header Profil</label>
              <?php
                input_text("sub_header_profil",$sub_header_profil," maxlength='255' ","Sub Header Profil","text");
              ?>
            </div>
          </div>
           <div class="col-md-6">
            <div class="form-group">
              <label>Sejarah</label>
              <?php
                input_textareacustom("sejarah",$sejarah," id='editor7' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Visi Misi</label>
              <?php
                input_textareacustom("visi_misi",$visi_misi," id='editor8' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Tujuan dan Fungsi</label>
              <?php
                input_textareacustom("tujuan_fungsi",$tujuan_fungsi," id='editor9' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Informasi Layanan / Standar Mutu</label>
              <?php
                input_textareacustom("informasi_layanan",$informasi_layanan," id='editor10' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Header Laporan</label>
              <?php
                input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Sub Header Laporan</label>
              <?php
                input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Sub Header Laporan2</label>
              <?php
                input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Judul Laporan</label>
              <?php
                input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Dimensi Mutu</label>
              <?php
                input_text("dimensi_laporan",$dimensi_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tujuan</label>
              <?php
                input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Jenis Indikator</label>
              <?php
                input_text("jenis_laporan",$jenis_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Satuan Pengukuran</label>
              <?php
                input_text("satuan_laporan",$satuan_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Target Pencapaian</label>
              <?php
                input_text("standar_laporan",$standar_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Metode Pengumpulan Data</label>
              <?php
                input_text("metode_laporan",$metode_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Sumber Data</label>
              <?php
                input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>     
          <div class="col-md-4">
            <div class="form-group">
              <label>Instrumen Pengambilan Data</label>
              <?php
                input_text("instrumen_laporan",$instrumen_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>   
          <div class="col-md-4">
            <div class="form-group">
              <label>Besaran Sample</label>
              <?php
                input_text("sampel_laporan",$sampel_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Cara Pengambilan Sample</label>
              <?php
                input_text("teknis_laporan",$teknis_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Periode Pengumpulan Data</label>
              <?php
                input_text("frekuensi_laporan",$frekuensi_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Periode Analisa dan Pelaporan Data</label>
              <?php
                input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Penyajian Data</label>
              <?php
                input_text("penyajian_laporan",$penyajian_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Penanggung Jawab</label>
              <?php
                input_text("tgjawab_laporan",$tgjawab_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Pengumpul Data</label>
              <?php
                input_pdselect2("pengumpul_data",$cmd_jabatan,$this->session->id_jabatan);
              ?>
            </div>
          </div>
        <div class="col-md-12">      
          <div class="form-group">
            <label>Dasar Pemikiran</label>
          <?php
            input_textareacustom("dasar_laporan",$dasar_laporan," id='editor4' rows='5' cols='50' class='form-control' ","");
          ?>  
          </div>     
        <div class="form-group">
          <label>Definisi Operasional</label>
          <?php
            input_textareacustom("definisi_laporan",$definisi_laporan," id='editor3' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div>  
        <div class="form-group">
          <label>Numerator</label>
          <?php
            input_textareacustom("numerator_laporan",$numerator_laporan," id='editor1' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div>  
        <div class="form-group">
          <label>Denominator</label>
          <?php
            input_textareacustom("denominator_laporan",$denominator_laporan," id='editor2' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div>  
        <div class="form-group">
          <label>Kriteria</label>
          <?php
            input_textareacustom("kriteria_laporan",$kriteria_laporan," id='editor5' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div> 
        <div class="form-group">
          <label>Formula</label>
          <?php
            input_textareacustom("formula_laporan",$formula_laporan," id='editor6' rows='5' cols='50' class='form-control' ","");
          ?>  
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
elseif ($page=="laporan_edit")
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
           <h3 class="box-title">DAFTAR TABEL DAN GRAFIK</h3>

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
                <th style="width:10%;">Urutan</th>
                <th>Judul</th>                                 
              </tr>
            </thead>
          </table>
        </div>
      </div>
  <?php echo form_open_multipart('i_mutu/laporan/edit/'.$id,' id="signupform" '); ; 
    input_text("barcode_laporan",$barcode_laporan,"","","hidden");
  ?>  
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-2">
            <div class="form-group">
              <label>Tanggal</label>
              <?php
                input_calendar("tgl_laporan","tgl_laporan",$tgl_laporan,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Kategori</label>
              <?php
               input_pdselect2("id_standar_mutu",$ambil_sn_standar_mutu,$id_standar_mutu);
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal Awal</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal","");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Header Profil</label>
              <?php
                input_text("header_profil",$header_profil," maxlength='255' ","Header Profil","text");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Sub Header Profil</label>
              <?php
                input_text("sub_header_profil",$sub_header_profil," maxlength='255' ","Sub Header Profil","text");
              ?>
            </div>
          </div>
           <div class="col-md-12">
            <div class="form-group">
              <label>Sejarah</label>
              <?php
                input_textareacustom("sejarah",$sejarah," id='editor7' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Visi Misi</label>
              <?php
                input_textareacustom("visi_misi",$visi_misi," id='editor8' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tujuan dan Fungsi</label>
              <?php
                input_textareacustom("tujuan_fungsi",$tujuan_fungsi," id='editor9' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Informasi Layanan / Standar Mutu</label>
              <?php
                input_textareacustom("informasi_layanan",$informasi_layanan," id='editor10' rows='5' cols='50' class='form-control' ","");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Header Laporan</label>
              <?php
                input_text("header_laporan",$header_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Sub Header Laporan</label>
              <?php
                input_text("sub_header_laporan",$sub_header_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Sub Header Laporan2</label>
              <?php
                input_text("sub_sub_header_laporan",$sub_sub_header_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Judul Laporan</label>
              <?php
                input_text("judul_laporan",$judul_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Dimensi Mutu</label>
              <?php
                input_text("dimensi_laporan",$dimensi_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tujuan</label>
              <?php
                input_text("tujuan_laporan",$tujuan_laporan,"  ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Jenis Indikator</label>
              <?php
                input_text("jenis_laporan",$jenis_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Satuan Pengukuran</label>
              <?php
                input_text("satuan_laporan",$satuan_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Target Pencapaian</label>
              <?php
                input_text("standar_laporan",$standar_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Metode Pengumpulan Data</label>
              <?php
                input_text("metode_laporan",$metode_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Sumber Data</label>
              <?php
                input_text("sumber_laporan",$sumber_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>     
          <div class="col-md-4">
            <div class="form-group">
              <label>Instrumen Pengambilan Data</label>
              <?php
                input_text("instrumen_laporan",$instrumen_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>   
          <div class="col-md-4">
            <div class="form-group">
              <label>Besaran Sample</label>
              <?php
                input_text("sampel_laporan",$sampel_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div> 
          <div class="col-md-4">
            <div class="form-group">
              <label>Cara Pengambilan Sample</label>
              <?php
                input_text("teknis_laporan",$teknis_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Periode Pengumpulan Data</label>
              <?php
                input_text("frekuensi_laporan",$frekuensi_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Periode Analisa dan Pelaporan Data</label>
              <?php
                input_text("periode_laporan",$periode_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Penyajian Data</label>
              <?php
                input_text("penyajian_laporan",$penyajian_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Penanggung Jawab</label>
              <?php
                input_text("tgjawab_laporan",$tgjawab_laporan," maxlength='255' ","","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Pengumpul Data</label>
              <?php
                input_pdselect2("pengumpul_data",$cmd_jabatan,$this->session->id_jabatan);
              ?>
            </div>
          </div>
        <div class="col-md-12">      
          <div class="form-group">
            <label>Dasar Pemikiran</label>
          <?php
            input_textareacustom("dasar_laporan",$dasar_laporan," id='editor4' rows='5' cols='50' class='form-control' ","");
          ?>  
          </div>     
        <div class="form-group">
          <label>Definisi Operasional</label>
          <?php
            input_textareacustom("definisi_laporan",$definisi_laporan," id='editor3' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div>  
        <div class="form-group">
          <label>Numerator</label>
          <?php
            input_textareacustom("numerator_laporan",$numerator_laporan," id='editor1' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div>  
        <div class="form-group">
          <label>Denominator</label>
          <?php
            input_textareacustom("denominator_laporan",$denominator_laporan," id='editor2' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div>  
        <div class="form-group">
          <label>Kriteria</label>
          <?php
            input_textareacustom("kriteria_laporan",$kriteria_laporan," id='editor5' rows='5' cols='50' class='form-control' ","");
          ?>  
        </div> 
        <div class="form-group">
          <label>Formula</label>
          <?php
            input_textareacustom("formula_laporan",$formula_laporan," id='editor6' rows='5' cols='50' class='form-control' ","");
          ?>  
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
elseif ($page=="laporan_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('i_mutu/laporan/simpan_urutan');?>" onClick="return cek();">
       <input type="hidden" name="barcode_laporan" value="<?= $id; ?>">
       <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
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
                  <label>No Urut</label>
                  <?php
          input_textcustom("urutan_laporan_tabel",$urutan_laporan_tabel,"maxlength='6' required autofocus class='form-control' 
            onkeypress='return event.keyCode > 47 && event.keyCode < 58' " ,"Masukkan Angka","text"); 
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
elseif ($page=="laporan_tambah_tabel")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('i_mutu/laporan/tambah_tabel/'.$id,' id="signupform" '); ; 
    input_text("id_laporan",$id_laporan,"","","hidden");
    input_text("barcode_laporan",$barcode_laporan,"","","hidden");
  ?>  
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">  
          <div class="form-group">
            <label>Judul</label>
            <?php
              input_text("judul_laporan_tabel",$judul_laporan_tabel," maxlength='255' required ","","text");
            ?>  
          </div>                   
          <div class="form-group">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_tabel",$analisa_laporan_tabel," required id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="form-group">
            <label>Hasil</label>
            <?php
      input_textareacustom("rekomendasi_laporan_tabel",$rekomendasi_laporan_tabel," required id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
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
elseif ($page=="laporan_edit_tabel")
{
?> 
<style>
.select2-container{
    width: 100% !important;
    padding: 0;
}
#chartdiv {
  width: 100%;
  height: 700px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('i_mutu/laporan/edit_tabel/'.$id.'/'.$id2,' id="signupform" '); ; 
    input_text("id_laporan",$id_laporan,"","","hidden");
    input_text("barcode_laporan",$barcode_laporan,"","","hidden");
    input_text("id_laporan_tabel",$id_laporan_tabel,"","","hidden");
    input_text("barcode_laporan_tabel",$barcode_laporan_tabel,"","","hidden");
  ?>  
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">  
          <div class="col-md-12">
            <div class="form-group">
              <label>Judul</label>
              <?php
                input_text("judul_laporan_tabel",$judul_laporan_tabel," maxlength='255' required ","","text");
              ?>
            </div>
          </div>  
           <div class="col-md-6">
            <div class="form-group">
              <label>Rubah Data</label><br>
<button type="button" class="btn btn-block btn-<?php echo $arraybox[array_rand($arraybox)]; ?> OpenRubahData" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id; ?>" data-id2="<?php echo $id2; ?>" title="Rubah Data" data-toggle="modal" data-target="#modal-default">
  Rubah Tabel dan LHU
</button>
            </div>
          </div>  
           <div class="col-md-6">
          <div class="form-group">
            <label>Rubah Data</label><br>
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-block OpenRubahLimbah" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id; ?>" data-id2="<?php echo $id2; ?>" title="Rubah Data" data-toggle="modal" data-target="#modal-default">
  Rubah Data Indikator Mutu
</button>
          </div>
          </div>   
  <div class="col-md-12">   
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">TABLE</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
              <table id="example2" width="100%" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <?php  
                    $cols = $jumlah_bulan * 2;
                  ?>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;" rowspan="2">Parameter</th>
                  <?php
                    if($rec_baku_mutu > 0){
                  ?>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;" rowspan="2">Baku Mutu</th>
                  <?php
                    }
                  ?>                    
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;" rowspan="2">Satuan</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;" colspan="<?= $jumlah_bulan ?>">Realisasi Bulan</th>
                  </tr>
                  <tr>
                    <?php  
                      foreach ($only_blnyear_lhu as $rowonly_blnyear_lhu){
                    ?>
                   <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;"><?php echo $this->m_rancak->getsemiBulan($rowonly_blnyear_lhu['buln']); ?></th>
                   <?php  
                    }
                   ?>
                  </tr>
                </thead>
              <tbody>
                <?php  foreach($tabel_limbah_detil as $rowtabel_limbah_detil){
                ?>
                <tr>
                  <td><?= $rowtabel_limbah_detil['nama_limbah'] ?></td>
                  <?php
                    if($rec_baku_mutu > 0){
                  ?>
                  <td class="text-right"><?= ROUND($rowtabel_limbah_detil['standar_mutu'],3) ?> <?php if($rowtabel_limbah_detil['range_mutu'] > 0){ echo ' s.d '.ROUND($rowtabel_limbah_detil['range_mutu'],3); } ?></td>
                  <?php
                    }
                  ?>
                  <td><?= $rowtabel_limbah_detil['satuan_limbah'] ?></td>
                    <?php            
                      foreach ($only_blnyear_lhu as $rowonly_blnyear_lhu){
                         $rec_tabel_detil = $this->m_im->tabel_detil($id2,$rowtabel_limbah_detil['id_limbah'],$rowonly_blnyear_lhu['blnyear'],$min_tanggal,$max_tanggal,$rowtabel_limbah_detil['id_sumber_emisi']); 
                      if($rec_tabel_detil == 0){
                    ?>
                    <td style="vertical-align:middle;text-align: center;"> - </td>
                    <?php  
                      }else{    
                        $tabel_detil = $this->m_im->tabel_detil($id2,$rowtabel_limbah_detil['id_limbah'],$rowonly_blnyear_lhu['blnyear'],$min_tanggal,$max_tanggal,$rowtabel_limbah_detil['id_sumber_emisi']);
                        foreach($tabel_detil as $rowtabel_detil){
                    ?>
                   <td style="vertical-align:middle;text-align: center;"><?= round($rowtabel_detil['hasil_lhu_detil'],3) ?></td>
                   <?php  
                        }
                      }
                    }
                   ?>
                </tr> 
                <?php } ?>                 
              </tbody>
              </table>
        </div>

      </div>
      <?php  
        if($tabel > 1){
        ?>
      <div class="box box-<?php echo $thenarray; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">GRAFIK</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
             <div id="chartdiv"></div>
              <div id="legenddiv"></div>
        </div>
      </div>
        <?php
        }
        ?>                   
          <div class="form-group">
            <label>Analisa</label>
            <?php
              input_textareacustom("analisa_laporan_tabel",$analisa_laporan_tabel," required id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="form-group">
            <label>Hasil</label>
            <?php
      input_textareacustom("rekomendasi_laporan_tabel",$rekomendasi_laporan_tabel," required id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
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
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $header; ?> <small><?php echo $instance_name; ?></small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
}
elseif ($page=="laporan_print_tabel")
{
?>
<style>
.select2-container{
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
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content"> 
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">
    <a href="<?php echo base_url('i_mutu/laporan/edit/');?><?= $id ?>"
      class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
    </a>              
           </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">     
<div class="main">
  
  <input type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-md" value="Save as PDF" onclick="savePDF();" />

  
<h1>In accumsan velit in orci tempor</h1>
<p><?= $analisa_laporan_tabel ?></h2>
<div id="chartdiv"></div>
<div id="legenddiv"></div>

<h2>Phasellus suscipit in diam a interdum</h2>
<table class="table table-bordered">
  <tr>
    <th>USA</th>
    <th>Japan</th>
    <th>France</th>
    <th>Mexico</th>
  </tr>
  <tr>
    <td>2500</td>
    <td>1900</td>
    <td>2200</td>
    <td>1200</td>
  </tr>
  <tr>
    <td>800</td>
    <td>1200</td>
    <td>990</td>
    <td>708</td>
  </tr>
  <tr>
    <td>2100</td>
    <td>2150</td>
    <td>900</td>
    <td>1260</td>
  </tr>
</table>

<h2>Duis sed efficitur mauris</h2>
<div>
  <div class="col">
    <div id="chartdiv2" class="chart"></div>
  </div>
  <div class="col">
    <div id="chartdiv3" class="chart"></div>
  </div>
</div>

<br>
<h2>Aliquam semper lacinia</h2>
<div id="chartdiv4" class="chart"></div>
<p>Maecenas congue leo vel tortor faucibus, non semper odio viverra. In ac libero rutrum libero elementum blandit vel in orci. Donec sit amet nisl ac eros mollis molestie. Curabitur ut urna vitae turpis bibendum malesuada sit amet imperdiet orci. Etiam pulvinar quam at lorem pellentesque congue. Integer sed odio enim. Maecenas eu nulla justo. Sed quis enim in est sodales facilisis non sed erat. Aenean vel ornare urna. Praesent viverra volutpat ex a aliquet.</p>

<p>Fusce sed quam pharetra, ornare ligula id, maximus risus. Integer dignissim risus in placerat mattis. Fusce malesuada dui ut lectus ultricies, et sollicitudin nisl placerat. In dignissim elit in pretium lobortis. Fusce ornare enim at metus laoreet, ut convallis elit lacinia. Maecenas pharetra aliquet mi. Nulla orci nunc, egestas id nisi ut, volutpat sollicitudin mi.</p>
  
</div>  
        </div>  
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="laporan_print_tabel2")
{
?>
<style>
.select2-container{
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
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('i_mutu/laporan/edit_tabel/'.$id.'/'.$id2,' id="signupform" '); ; 
    input_text("id_laporan",$id_laporan,"","","hidden");
    input_text("barcode_laporan",$barcode_laporan,"","","hidden");
    input_text("id_laporan_tabel",$id_laporan_tabel,"","","hidden");
    input_text("barcode_laporan_tabel",$barcode_laporan_tabel,"","","hidden");
  ?>  
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">     
<div class="main">
  
  <input type="button" class="btn btn-primary btn-md" value="Save as PDF" onclick="savePDF();" />

<table id="tbl">

</table>
  
<h1>In accumsan velit in orci tempor</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sem quam, sodales ac volutpat sed, vestibulum id quam. Sed quis arcu non elit fringilla mattis. Sed auctor mi sed efficitur vehicula. Sed bibendum odio urna, quis lobortis dui luctus ac. Duis eu lacus sodales arcu tincidunt ultrices viverra a risus. Vivamus justo massa, malesuada quis pellentesque ut, placerat in massa. Nunc bibendum diam justo, in consequat ipsum fringilla ac. Praesent porta nibh ac arcu viverra, at scelerisque neque venenatis. Donec aliquam lorem non ultrices ultrices. Aliquam efficitur eros quis tortor condimentum, id pellentesque metus iaculis. Aenean at consequat neque, a posuere lectus. In eu libero magna. Pellentesque molestie tellus nec nisi molestie, eu dignissim lacus tristique. Sed tellus nulla, suscipit a velit non, mattis dictum metus. Curabitur mi mi, convallis nec libero quis, venenatis vestibulum ante.</p>
<h2>Aliquam lacinia justo</h2>
<div id="chartdiv" class="chart"></div>

<h2>Phasellus suscipit in diam a interdum</h2>
<table class="table table-bordered">
  <tr>
    <th>USA</th>
    <th>Japan</th>
    <th>France</th>
    <th>Mexico</th>
  </tr>
  <tr>
    <td>2500</td>
    <td>1900</td>
    <td>2200</td>
    <td>1200</td>
  </tr>
  <tr>
    <td>800</td>
    <td>1200</td>
    <td>990</td>
    <td>708</td>
  </tr>
  <tr>
    <td>2100</td>
    <td>2150</td>
    <td>900</td>
    <td>1260</td>
  </tr>
</table>

<h2>Duis sed efficitur mauris</h2>
<div>
  <div class="col">
    <div id="chartdiv2" class="chart"></div>
  </div>
  <div class="col">
    <div id="chartdiv3" class="chart"></div>
  </div>
</div>

<br>
<h2>Aliquam semper lacinia</h2>
<div id="chartdiv4" class="chart"></div>
<p>Maecenas congue leo vel tortor faucibus, non semper odio viverra. In ac libero rutrum libero elementum blandit vel in orci. Donec sit amet nisl ac eros mollis molestie. Curabitur ut urna vitae turpis bibendum malesuada sit amet imperdiet orci. Etiam pulvinar quam at lorem pellentesque congue. Integer sed odio enim. Maecenas eu nulla justo. Sed quis enim in est sodales facilisis non sed erat. Aenean vel ornare urna. Praesent viverra volutpat ex a aliquet.</p>

<p>Fusce sed quam pharetra, ornare ligula id, maximus risus. Integer dignissim risus in placerat mattis. Fusce malesuada dui ut lectus ultricies, et sollicitudin nisl placerat. In dignissim elit in pretium lobortis. Fusce ornare enim at metus laoreet, ut convallis elit lacinia. Maecenas pharetra aliquet mi. Nulla orci nunc, egestas id nisi ut, volutpat sollicitudin mi.</p>
  
</div>  
        </div>  
      </div>
    <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="laporan_rubah_data")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('i_mutu/laporan/simpan_rubah_data');?>" onClick="return cek();">
          <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
          <input type="hidden" name="barcode_laporan" value="<?= $barcode_laporan; ?>">
          <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
          <input type="hidden" name="barcode_laporan_tabel" value="<?= $barcode_laporan_tabel; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DAFTAR HASIL UJI JIKA MEMILIH SEMUA MAKA CHECKLIST AKAN KOSONG</h3>
            </div>
              <div class="box-body">
              <div class="col-md-12">
                <label>Opsi Tabel</label>
                  <?php
                    input_pdselect2("tabel",$tabelkah,$tabel);
                  ?>
              </div>         
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">No LHU</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Tanggal</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Deskripsi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
    /*                $no=0;
                    $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_data_sn_lhu as $row){
                  //    $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_lhu'];?>" <?php if(in_array($row['id_lhu'],explode(",", $id_lhu))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?php echo $row['no_lhu'];?></td>
                    <td style="vertical-align:middle;"><?php echo date('d-m-Y', strtotime($row['tgl_lhu'])); ?></td>
                    <td style="vertical-align:middle;"><?php echo $row['nama_standar_mutu']; ?></td>
                    <td style="vertical-align:middle;"><?php echo $row['deskripsi_lhu']; ?></td>
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
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="laporan_rubah_limbah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('i_mutu/laporan/simpan_rubah_limbah');?>" onClick="return cek();">
          <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
          <input type="hidden" name="barcode_laporan" value="<?= $barcode_laporan; ?>">
          <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
          <input type="hidden" name="barcode_laporan_tabel" value="<?= $barcode_laporan_tabel; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DAFTAR HASIL UJI JIKA MEMILIH SEMUA MAKA CHECKLIST AKAN KOSONG</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Limbah</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
    /*                $no=0;
                    $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_data_sn_lhu_detil as $row){
                  //    $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_limbah'];?>" <?php if(in_array($row['id_limbah'],explode(",", $id_limbah))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?php echo $row['nama_limbah'];?></td>
                    <td style="vertical-align:middle;"><?php echo $row['nama_standar_mutu']; ?></td>
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
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
elseif ($page=="laporan_rubah_ukur")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('i_mutu/laporan/simpan_rubah_ukur');?>" onClick="return cek();">
          <input type="hidden" name="id_laporan" value="<?= $id_laporan; ?>">
          <input type="hidden" name="barcode_laporan" value="<?= $barcode_laporan; ?>">
          <input type="hidden" name="id_laporan_tabel" value="<?= $id_laporan_tabel; ?>">
          <input type="hidden" name="barcode_laporan_tabel" value="<?= $barcode_laporan_tabel; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">DAFTAR HASIL UJI JIKA MEMILIH SEMUA MAKA CHECKLIST AKAN KOSONG</h3>
            </div>
              <div class="box-body">           
                <table id="example1" width="100%" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                      <input name="select_all" class="checkall" type="checkbox" />
                    </th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama Sumber Pengukuran</th>
                    <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
    /*                $no=0;
                    $arr = array();
                    foreach($kr_jabatan_fungsional as $val){
                        $arr[] = $val['id_kewenangan'];
                    }
                    $eimplo = implode(",", $id_lhu);*/
                    foreach($ambil_data_sn_lhu_detil as $row){
                  //    $no++;
                    ?>
                  <tr>
                    <td style="vertical-align:middle;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_sumber_emisi'];?>" <?php if(in_array($row['id_sumber_emisi'],explode(",", $id_sumber_emisi))) echo 'checked="checked"'; ?>> 
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?php echo $row['nama_sumber_emisi'];?></td>
                    <td style="vertical-align:middle;"><?php echo $row['nama_standar_mutu']; ?></td>
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
    $('#exampleModal').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
  });
</script>
<?php
}
//============================================= LIHAT
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
      <?php echo form_open_multipart('i_mutu/lihat/view/'.$id.'/'.$id2.'/'.$id4.'/'.$id5.'/'.$id6,' id="signupform" '); ?>
      <input type="hidden" name="id5" value="0">
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
              <div class="col-md-6">
                <div class="form-group">
                  <label>Opsi Kategori</label>
                  <?php
                    input_pdselect2("id6",$kategori_kah,$id6);
                  ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Kategori</label>
                  <?php
                    input_pdselect2("id4",$ambil_sn_standar_mutu,$id4);
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
            <th style="display:none;">ID</th>
            <th>Kategori</th>
            <th>Tanggal Laporan</th>            
            <th>Judul</th>                                 
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
  $br_struktur = $this->m_im->ol_berkas_in($struktur_organisasi,'60');
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
  $br_regulasi = $this->m_im->ol_berkas_in($regulasi,'50');
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
  $br_berkas_laporan = $this->m_im->ol_berkas_in($berkas_laporan,'50');
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
          <a href="<?php echo base_url('i_mutu/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
            Laporan <i class="fa fa-share"></i>
          </a>
          <a href="<?php echo base_url('i_mutu/lihat/galeri/'.$id);?>" class="btn btn-success pull-right" style="margin-right: 5px;">
            Galeri <i class="fa fa-image"></i>
          </a>          
        </div>
          <div class="col-xs-12">
            <hr>        
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('i_mutu/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
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
  $br_galeri_laporan = $this->m_im->ol_berkas_in($galeri_laporan,'60');
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
          <a href="<?php echo base_url('i_mutu/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right" style="margin-right: 5px;">
            Laporan <i class="fa fa-share"></i>
          </a>
           <a href="<?php echo base_url('i_mutu/lihat/profil/'.$id);?>" class="btn btn-warning pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Profil
            </a>
        </div>
          <div class="col-xs-12">
            <hr>        
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('i_mutu/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
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
               <a href="<?php echo base_url('i_mutu/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right">
              Laporan <i class="fa fa-share"></i>
            </a>
           <a href="<?php echo base_url('i_mutu/lihat/profil/'.$id);?>" class="btn btn-warning pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Profil
            </a>
          <a href="<?php echo base_url('i_mutu/lihat/galeri/'.$id);?>" class="btn btn-success pull-right" style="margin-right: 5px;">
            Galeri <i class="fa fa-image"></i>
          </a>   
          </div>
          <div class="col-xs-12">
            <hr>          
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('i_mutu/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
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
elseif ($page=="lihat_tabel")
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
                          $tabel_detil = $this->m_im->tabel_detil($id2,$rowtabel_limbah_detil['id_limbah'],$rowonly_blnyear_lhu['blnyear'],$min_tanggal,$max_tanggal,$rowtabel_limbah_detil['id_sumber_emisi']);
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
          <a href="<?php echo base_url('assets/berkas/i_mutu/'.$rowambil_berkas_lhu['link_lhu']);?>" target="_blank">
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
               <a href="<?php echo base_url('i_mutu/lihat/laporan/'.$id);?>" class="btn btn-primary pull-right">
              Laporan <i class="fa fa-share"></i>
            </a>
           <a href="<?php echo base_url('i_mutu/lihat/profil/'.$id);?>" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-reply"></i> Profil
            </a>
          </div>
          <div class="col-xs-12">
            <hr>          
          <?php 
            foreach($ambil_sn_laporan_tabel as $rowambil_sn_laporan_tabel){
          ?>
          <div class="col-xs-6">
           <a href="<?php echo base_url('i_mutu/lihat/tabel/'.$id.'/'.$rowambil_sn_laporan_tabel['barcode_laporan_tabel']);?>" class="btn btn-block btn-sm bg-<?php echo $btnarray[array_rand($btnarray)]; ?>" style="margin: 5px;"><i class="fa fa-line-chart"></i> <?= $rowambil_sn_laporan_tabel['judul_laporan_tabel'] ?>
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
elseif ($page=="berkas")
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
            <th>Nama Berkas</th>
            <th>No Berkas</th>            
            <th>Link</th>                                  
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
elseif ($page=="berkas_rubah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('i_mutu/berkas/simpan_rubah');?>" onClick="return cek();">
       <input type="hidden" name="id_berkas" value="<?= $id_berkas; ?>">
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
              <div class="col-md-6">
                  <label>Nama Berkas</label>
                  <?php
                    input_text("nama_berkas",$nama_berkas,"maxlength='255'  ","Ketik","text");
                  ?>
              </div> 
              <div class="col-md-6">
                  <label>No Berkas</label>
                  <?php
                    input_text("no_berkas",$no_berkas,"maxlength='255'  ","Ketik","text");
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
<?php
}