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
                   <h3 class="box-title">PENGUMUMAN</h3>
                  <div class="box-tools pull-right"></div>
                </div>
                <div class="box-body">
                  <div class="direct-chat-messages">
                  <?php
                  foreach($ambil_pengumuman as $rowumum){
                    if(empty($rowumum['foto'])){
                      $url_thumbex=base_url().'assets/images/noavatar.jpg';
                      $url_picbesarex=base_url().'assets/images/noavatar.jpg';
                    }else{
                      $cek_filesmall=FCPATH.'assets/foto/ol/'.$rowumum['foto'];
                      if(file_exists($cek_filesmall)){
                        $url_thumbex=base_url().'assets/foto/ol/'.$rowumum['foto'];
                        $url_picbesarex=base_url().'assets/foto/ol/'.$rowumum['foto'];
                      }else{
                        $url_thumbex=base_url().'assets/images/noavatar.jpg';
                        $url_picbesarex=base_url().'assets/images/noavatar.jpg';
                      }
                    }
                  ?>
                  <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left"><?php echo $rowumum['nama_pegawai']; ?></span>
                    <span class="direct-chat-timestamp pull-right">
                    <?php echo date('d-m-Y', strtotime($rowumum['tgl_pengumuman'])); ?> <?php echo $rowumum['jam_pengumuman']; ?></span>
                    </div>
                    <a class="example-image-link" href="<?php echo $url_picbesarex; ?>"
                      data-lightbox="example-set" data-title="<?php echo $rowumum['nama_ms_pengurus']; ?> - <?php echo $rowumum['nama_pengcab']; ?> : <?php echo $rowumum['nama_pegawai']; ?>">
                      <img class="direct-chat-img" src="<?php echo $url_thumbex; ?>" alt="message user image">
                    </a>
                    <div class="direct-chat-text">
                    <?php echo $rowumum['isi_pengumuman']; ?>
                    </div>
                    <!-- /.direct-chat-text -->
                  </div>
                  <!-- /.direct-chat-msg -->
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
elseif ($page=="kategori_kewenangan")
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
  <?php echo form_open_multipart('ol_master/kategori_kewenangan/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
  <div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">CATATAN MOHON DIPERHATIKAN</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <div class="box box-widget">
            <div class="box-body">
              <!-- post text -->
              <h5>
        <ul style="line-height: 1.6;">
        <li>KEWENANGAN INI KHUSUS UNTUK MENGISI BUKU PUTIH KEPERAWATAN</li>
        <li>SETELAH MENGISI INI HARAP MELINK KAN DENGAN BUTIR KEGIATAN AGAR DAPAT PRINT OUT UNTUK EUKOM</li>
        </ul>
        </h5>

            </div>
            <!-- /.box-body -->
          </div>          
        </div>
      </div>
    </div>
  <div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">OPSI KOMPETENSI</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label>Kompetensi</label>
              <?php
                input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id,"Semua");
              ?>
          </div>        
        </div>
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
            <th>PK</th>            
            <th>Kategori</th>
            <th>Jenis</th>
            <th>Jenjang</th>
            <th>Kompetensi</th>
            <th>Creator</th>
            <th width="5%">Waktu</th>
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
elseif ($page=="kategori_kewenangan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_master/kategori_kewenangan/simpan_tambah');?>" onClick="return cek();">
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
                    input_text("nama_kewenangan",$nama_kewenangan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kategori</label>
                    <?php
                      input_pdselect2("id_kompetensi",$cmd_kompetensi,$id_kompetensi);
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                      <label>Kode Kewenangan</label>
              <?php
              //  input_pdselect2("id_kode_kewenangan",$cmd_kode_kewenangan,$id_kode_kewenangan);
      input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Tanpa Kode Kewenangan");
              ?>
            </div>
            </div>
              <div class="col-md-12">
                <div class="form-group">
                      <label>Jenis Kewenangan</label>
              <?php
            //    input_pdselect2("id_sifat_kewenangan",$cmd_sifat_kewenangan,$id_sifat_kewenangan);
      input_pdselect2fleksibel("id_sifat_kewenangan","id_sifat_kewenangan",$cmd_sifat_kewenangan_null,"id_sifat_kewenangan","nama_sifat_kewenangan",$id_sifat_kewenangan,"Tanpa Jenis Kewenangan");
              ?>
            </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                      <label>Kompetensi</label>
              <?php
      input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Tanpa Kompetensi");
  //              input_pdselect2("id_ruangan",$cmd_ruangan,$id_ruangan);
              ?>
              </div>
            </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Waktu Pengerjaan Kewenangan</label>
            <?php
            input_textcustom("wkt_kewenangan","0"," style='text-align:right;' required maxlength='5'
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                      "Waktu","text");
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
elseif ($page=="kategori_kewenangan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_master/kategori_kewenangan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kewenangan" value="<?= $id; ?>">
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
                    input_text("nama_kewenangan",$nama_kewenangan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kategori</label>
                    <?php
                      input_pdselect2("id_kompetensi",$cmd_kompetensi,$id_kompetensi);
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                      <label>Kode Kewenangan</label>
              <?php
              //  input_pdselect2("id_kode_kewenangan",$cmd_kode_kewenangan,$id_kode_kewenangan);
      input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$cmd_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Tanpa Kode Kewenangan");
              ?>
            </div>
            </div>
              <div class="col-md-12">
                <div class="form-group">
                      <label>Jenis Kewenangan</label>
              <?php
            //    input_pdselect2("id_sifat_kewenangan",$cmd_sifat_kewenangan,$id_sifat_kewenangan);
      input_pdselect2fleksibel("id_sifat_kewenangan","id_sifat_kewenangan",$cmd_sifat_kewenangan_null,"id_sifat_kewenangan","nama_sifat_kewenangan",$id_sifat_kewenangan,"Tanpa Jenis Kewenangan");
              ?>
            </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                      <label>Kompetensi</label>
              <?php
      input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Tanpa Kompetensi");
  //              input_pdselect2("id_ruangan",$cmd_ruangan,$id_ruangan);
              ?>
              </div>
            </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Waktu Pengerjaan Kewenangan</label>
            <?php
            input_textcustom("wkt_kewenangan","0"," style='text-align:right;' required maxlength='5'
                  onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                      "Waktu","text");
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
elseif ($page=="relasi")
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
  <?php echo form_open_multipart('ol_master/relasi/view/'.$id_jabatan_fungsional,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $title; ?></h3>
    </div>
      <div class="box-body">
      <div class="row">
  <div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">CATATAN MOHON DIPERHATIKAN</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <div class="box box-widget">
            <div class="box-body">
              <!-- post text -->
              <h5>
        <ul style="line-height: 1.6;">
        <li>LINK KAN SETELAH MENGINPUT KEWENANGAN</li>
        </ul>
        </h5>

            </div>
            <!-- /.box-body -->
          </div>          
        </div>
      </div>
    </div>
        <div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">OPSI JABATAN FUNGSIONAL</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label>Jabatan Fungsional</label>
              <?php
                input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Silahkan Pilih Jabatan Fungsional");
              ?>
          </div>         
        </div>
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
            <th style="display: none;width:5%;">ID</th>
            <th>Kewenangan</th>
            <th>Butir Kegiatan</th>
            <th style="width:15%;">Jabatan Fungsional</th>
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
elseif ($page=="relasi_tambah")
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
    <h1><?= $header ?></h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_master/relasi/tambah/'.$id_jabatan_fungsional.'/'.$id_ruangan.'/'.$id_kode_kewenangan.'/'.$id_butir_kegiatan ,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">SILAHKAN PILIH BUTIR KEGIATAN YANG AKAN DI LINK KAN</h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Jabatan Fungsional</label>
              <?php
              input_pdselect2("id_jabatan_fungsional",$cmd_jabfung_buket,$id_jabatan_fungsional);
              ?>
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label>Butir Kegiatan</label>
              <?php
              input_pdselect2("id_butir_kegiatan",$butir_kegiatan_no_null,$id_butir_kegiatan);
              ?>
          </div>
        </div>
      </div>
      </div>
    </div>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">SILAHKAN PILIH OPSI KEWENANGANNYA</h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Kompetensi</label>
              <?php
        input_pdselect2fleksibel("id_ruangan","id_ruangan",$cmd_ruangan,"id_ruangan","nama_ruangan",$id_ruangan,"Semua Kewenangan");
              ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>PK</label>
              <?php
        input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$kol_kode_kewenangan_null_pk,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Pilih Jika Ingin Sesuai PK");
              ?>
          </div>
        </div>
      </div>
      </div>
      <div class="box-footer">
    <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"></h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
    <h5>KEWENANGAN YANG BELUM TERRELASI DENGAN BUTIR KEGIATAN</h5>
      <table id="example1" width="100%" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
            <input name="select_all" class="checkall" type="checkbox" />
          </th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kewenangan</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kode</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Sifat</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
          <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kompetensi</th>
        </tr>
        </thead>
        <tbody>
          <?php
/*          $arr = array();
          foreach($kewenangan_bk as $val){
              $arr[] = $val['id_kewenangan'];
          }
          $eimplo = implode(",", $arr);*/
          foreach($kewenangan_look as $row){
        //    if(!in_array($row['id_kewenangan'],explode(",", $eimplo))){
          ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_kewenangan'];?>" >
            </label>
            </div>
          </td>
          <td style="vertical-align:middle;"><?php echo $row['nama_kewenangan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_kompetensi']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_kode_kewenangan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_sifat_kewenangan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>
          <td style="vertical-align:middle;"><?php echo $row['nama_ruangan']; ?></td>
        </tr>
          <?php
       //       }
            }
          ?>
        </tbody>
      </table>
        </div>
        <div class="box-footer">
 <button type="submit" name="action" value="BtnSimpan" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </div>
  <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="relasi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_master/relasi/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_jabatan_fungsional" value="<?= $id_ruangan; ?>">
    <input type="hidden" name="id_kewenangan_bk" value="<?= $id_kewenangan_bk; ?>">
    <input type="hidden" name="id_butir_kegiatan_lama" value="<?= $id_butir_kegiatan; ?>">
    <input type="hidden" name="id_kewenangan_lama" value="<?= $id_kewenangan; ?>">
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
                  <label>Kewenangan</label>
                    <?php
                      input_pdselect2("id_kewenangan",$cmd_kewenangan,$id_kewenangan);
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Kewenangan</label>
                    <?php
                      input_pdselect2("id_butir_kegiatan",$butir_kegiatane,$id_butir_kegiatan);
                    ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Status</label>
                    <?php
                      input_pdselect2("status_kewenangan_bk",$cmd_status,$status_kewenangan_bk);
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
elseif ($page=="butir_kegiatan")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <div class="row">
  <div class="col-md-6">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">CATATAN MOHON DIPERHATIKAN</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
      <div class="box box-widget">
            <div class="box-body">
              <!-- post text -->
              <h5>
        <ul style="line-height: 1.6;">
        <li>MOHON UNTUK TIDAK MENGISI BUKU PUTIH KEPERAWATAN DISINI</li>
        <li>INPUTAN INI MENYANGKUT DENGAN ANALISA JABATAN DAN BEBAN KERJA, PENGISIAN BUTIR KEGIATAN UNTUK ANGKA KREDIT</li>
        <li>DENGAN MENGISI INI SECARA OTOMATIS MENAMBAH KEWENANGAN DAN SUDAH TERLINK DENGAN BUTIR KEGIATAN TERSEBUT</li>
        </ul>
        </h5>

            </div>
            <!-- /.box-body -->
          </div>          
        </div>
      </div>
    </div>
  <div class="col-md-6">
  <?php echo form_open_multipart('ol_master/butir_kegiatan/view/'.$id,' id="signupform" '); ; 
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-11">
          <div class="form-group">
            <label>Jabatan Fungsional</label>
              <?php
                input_pdselect2fleksibel("id","id",$cmd_jabfung_buket,"id_jabatan_fungsional","nama_jabatan_fungsional",$id,"Silahkan Pilih JabFung");
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
  </div>    
  </div>    
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
            <th style="display:none;">ID</th>           
            <th>Butir Kegiatan</th>           
            <th width="25%">Jabatan Fungsional</th>   
            <th>Angka Kredit</th>   
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
        <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:10px;">

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
elseif ($page=="butir_kegiatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_master/butir_kegiatan/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id" value="<?= $id; ?>">
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
            <label>Jabatan Fungsional</label>
            <?php
              input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional_id,$id_jabatan_fungsional);
            ?>  
          </div>    
          <div class="form-group">
            <label id="text_nama_butir_kegiatan">Butir Kegiatan</label>
            <?php
              input_text("nama_butir_kegiatan",$nama_butir_kegiatan,"maxlength='255' autofocus required","Masukkan Butir Kegiatan","text");
            ?>  
          </div>  
          <div class="form-group">
            <label id="text_ms_angka_kredit">Angka Kredit</label>
            <?php
              input_textcustom("angka_kredit",$angka_kredit," class='form-control' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
            ?>
          </div>          
          <div class="form-group">
            <label>Satuan Hasil</label>
            <?php
              input_text("satuan_hasil",$satuan_hasil,"maxlength='255' required","Masukkan Satuan Hasil","text");
            ?>  
          </div>          
          <div class="form-group">
            <label>Status</label>
              <?php
                input_pdselect2("status_butir_kegiatan",$cmd_status,$status_butir_kegiatan);
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
elseif ($page=="butir_kegiatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_master/butir_kegiatan/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id" value="<?= $id; ?>">
      <input type="hidden" name="id_butir_kegiatan" value="<?= $id_butir_kegiatan; ?>">
      <input type="hidden" name="id_kewenangan" value="<?= $id_kewenangan; ?>">
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
            <label>Jabatan Fungsional</label>
            <?php
              input_pdselect2("id_jabatan_fungsional",$cmd_jabatan_fungsional_id,$id_jabatan_fungsional);
            ?>  
          </div>    
          <div class="form-group">
            <label id="text_nama_butir_kegiatan">Butir Kegiatan</label>
            <?php
              input_text("nama_butir_kegiatan",$nama_butir_kegiatan,"maxlength='255' autofocus required","Masukkan Butir Kegiatan","text");
            ?>  
          </div>  
          <div class="form-group">
            <label id="text_ms_angka_kredit">Angka Kredit</label>
            <?php
              input_textcustom("angka_kredit",$angka_kredit," class='form-control' required onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' maxlength='7' autocomplete='off' ","","text");
            ?>
          </div>          
          <div class="form-group">
            <label>Satuan Hasil</label>
            <?php
              input_text("satuan_hasil",$satuan_hasil,"maxlength='255' required","Masukkan Satuan Hasil","text");
            ?>  
          </div>          
          <div class="form-group">
            <label>Status</label>
              <?php
                input_pdselect2("status_butir_kegiatan",$cmd_status,$status_butir_kegiatan);
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