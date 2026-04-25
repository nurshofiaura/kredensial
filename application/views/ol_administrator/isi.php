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
                <div class="box-footer">

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
elseif ($page=="cabang")
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
            <th>Cabang</th>
            <th>Kota</th>
            <th>Ranting</th>           
            <th>Alamat</th>
            <th>Kontak</th>
            <th>Email</th>
            <th>Status</th>
            <th>Kop</th>
            <th>Stempel</th>
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
elseif ($page=="cabang_edit")
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
      <?php echo form_open_multipart('ol_administrator/cabang/edit/'.$id,' id="signupform" ');
        input_text("id_pengcab",$id_pengcab,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <div class="form-group">
                <label>Upload Kop Surat</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_pengcab",$nama_pengcab,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_pengcab",$email_pengcab,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_pengcab",$kontak_pengcab,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_pengcab",$alamat_pengcab,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="cabang_stempel")
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
      <?php echo form_open_multipart('ol_administrator/cabang/stempel/'.$id,' id="signupform" ');
        input_text("id_pengcab",$id_pengcab,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-2">
              <div class="form-group">
                <label>Upload Stempel Surat</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">gif, png, jpg, jpeg</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi Kepengurusan</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("nama_pengcab",$nama_pengcab,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_pengcab",$email_pengcab,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_pengcab",$kontak_pengcab,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_pengcab",$alamat_pengcab,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengurus")
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
              <th>Wilayah</th>
              <th style="width:10%;">Status Wilayah</th>
              <th>Nama Kepengurusan</th>
              <th>Status Kepengurusan</th>
              <th>Status Pengurus</th>
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
elseif ($page=="pengurus_tambah")
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
      <?php echo form_open_multipart('ol_administrator/pengurus/tambah/'.$id,' id="signupform" ');
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <label>Nama Kepengurusan</label>
                <?php
                  input_pdselect2("id_pengcab",$ambil_data_pengcab,$id_pengcab);
                ?>
            </div> 
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width:5%;background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Wilayah</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_data_ms_pengurus as $row){
                ?>
              <tr>
                <td style="vertical-align:middle;text-align: center;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_ms_pengurus'];?>">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_ms_pengurus']; ?></td>
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
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengurus_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_administrator/pengurus/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_proq" value="<?= $prov_id; ?>">
            <input type="hidden" name="id_pengurus" value="<?= $id; ?>">
            <input type="hidden" name="id_ms_pengurus_lama" value="<?= $id_ms_pengurus; ?>">
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
                <label>Nama Kepengurusan</label>
                <?php
                  input_pdselect2("id_pengcab",$ambil_data_pengcab,$id_pengcab);
                ?>
            </div>       
            <div class="col-md-12">
                <label>Nama Kepengurusan</label>
                <?php
                  input_pdselect2("id_ms_pengurus",$ambil_data_ms_pengurus_no_null,$id_ms_pengurus);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_pengurus",$cmd_status,$status_pengurus);
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
elseif ($page=="pegawai_pengurus")
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
              <th>Wilayah</th>
              <th>Pengurus</th>
              <th>Nama</th>
              <th>Signature</th>
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
<?php
}
elseif ($page=="pegawai_pengurus_tambah")
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
      <?php echo form_open_multipart('ol_administrator/pegawai_pengurus/tambah/'.$id,' id="signupform" ');
        
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <label>Jabatan Pengurus</label>
                <?php
                  input_pdselect2("id_pengurus",$ambil_data_pengurus_master_no_null,$id_pengurus);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama Pengurus</label>
                <?php
                  input_pdselect2("id_pegawai",$ambil_data_dropdown_pegawai,$id_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Upload Tanda Tangan</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
                <p class="help-block">Saran png</p>
              </div>
            </div>            
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pegawai_pengurus_edit")
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
      <?php echo form_open_multipart('ol_administrator/pegawai_pengurus/edit/'.$id,' id="signupform" ');
        input_text("barcode_pegawai_pengurus",$id,"","","hidden");
        input_text("id_pegawai_pengurus",$id_pegawai_pengurus,"","","hidden");
        input_text("id_pegawai_pengurus_lama",$id_pegawai_pengurus,"","","hidden");
        input_text("id_pegawai_lama",$id_pegawai,"","","hidden");
        input_text("id_pegawai",$id_pegawai,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="col-md-12">
              <div class="form-group">
                <label>Upload Tanda Tangan</label>
                <?php
                  input_textcustom("upload_Files[]","","class='form-control-file' id='exampleInputFile' ","","file");
                ?>
              </div>
            </div>
            </div>
            <div class="col-md-9">
          <div class="col-md-9">
              <div class="form-group">
                <label>Jabatan Pengurus</label>
                <?php
                  input_pdselect2("id_pengurus",$ambil_data_pengurus_master_no_null,$id_pengurus);
                ?>
              </div>
            </div>
            <div class="col-md-3">
                <label>Status</label>
                <?php
                input_pdselect2("status_pegawai_pengurus",$cmd_status,$status_pegawai_pengurus);
                ?>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Pengurus</label>
                <?php
                  input_pdselect2("id_pegawai",$ambil_data_dropdown_pegawai,$id_pegawai);
                ?>
              </div>
            </div>            
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengajuan_korespodensi")
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
            <th width="5%" style="display;none;"></th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Wilayah</th>
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
elseif ($page=="pengajuan_korespodensi_validasi")
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
           <h3 class="box-title">
      <?php echo $title; ?> <small style="color:white;font-weight:bold;"></small>
       </h3>
        </div>
        <div class="box-body">
    <?php echo form_open_multipart('ol_administrator/pengajuan_korespodensi/validasi/'.$id,' ');
    input_text("id_korespodensi",$id_korespodensi,"","","hidden");
 //   input_text("id_kategori",$id_kategori,"","","hidden");
    if(empty($foto_pengaju)){
      $url_thumbx=base_url().'assets/images/noavatar.jpg';
      $url_picbesarx=base_url().'assets/images/noavatar.jpg';
    }else{
      $cek_filesmall=FCPATH.'assets/foto/ol/'.$foto_pengaju;
      if(file_exists($cek_filesmall)){
        $url_thumbx=base_url().'assets/foto/ol/'.$foto_pengaju;
        $url_picbesarx=base_url().'assets/foto/ol/'.$foto_pengaju;
      }else{
        $url_thumbx=base_url().'assets/images/noavatar.jpg';
        $url_picbesarx=base_url().'assets/images/noavatar.jpg';
      }
    }
$arraywarna = array('red','navy','yellow','maroon','olive','purple','aqua','lightblue','blue','green','teal','lime','orange','fuchsia');
      ?>
      <div class="row">
      <div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">
              BERKAS <small style="color:white;font-weight:bold;">  </small>
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
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
            <td colspan="2" style="background-color:#9b0e27;color:white;text-weight:bold;">BERKAS</td>
            </tr>
              <?php
              if($sertifikat!==""){
                foreach($ambil_berkas_data as $row3){
                  if (in_array($row3['id_berkas'],$id_sertifikat)) {
              ?>
                <tr>
                <td width="5%"><input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox"> </td>
                <td class="mailbox-name">
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
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
                  <a href="<?php echo base_url('assets/berkas/ol/'.$row4['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                    <i class="fa fa-file-text"></i> <?php echo $row4['nama_berkas']; ?>
                  </a>
                </td>
                </tr>
              <?php
                  }
                }
              }
              ?>
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
           <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT
          </div>
          <!-- /.pull-right -->
          </div>
        </div>
            </div>
          </div>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">PRINT SURAT</h3>

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
                <th>Nama</th>
                <th>Kategori</th>
                <th>Asal</th>
              </tr>
            </thead>
          </table>
            </div>
            <div class="box-footer">

            </div>
          </div>
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
              <div class="box-header with-border">
                 <h3 class="box-title">SYARAT PENGAJUAN</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                    <i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <h4>                   <?php 
                          $syarat_kategori = strip_tags($syarat_kategori); 
                          $syarat_kategori = html_entity_decode($syarat_kategori); 
                          echo $syarat_kategori;  
                  ?> </h4>
              </div>
            </div>
        </div>
        <div class="col-md-6">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
            TIME LINE PENGAJUAN <small style="color:white;font-weight:bold;"></small>
            </h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- The time line -->
                  <ul class="timeline">
                    <li class="time-label">
                          <span class="bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
                            <i class="fa fa-envelope"></i> &nbsp;<?= strtoupper($nama_kategori) ?>
                          </span>
                    </li>
                    <li>
                      <i class="fa fa-file-text bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                      <div class="timeline-item">
                        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                          <div class="box-header with-border">
                             <h3 class="box-title">DATA SURAT</h3>
                            <div class="box-tools pull-right">ISI NO SURAT DAN SIFAT SURAT</div>
                          </div>
                          <div class="box-body">
                            <div class="form-group">
                              <label>No Surat</label>
                              <?php
                                input_text("no_korespodensi","$no_korespodensi","maxlength='255' required autofocus ","Ketikkan No Surat","text");
                              ?>
                            </div>
                            <div class="form-group">
                              <label>Sifat Surat</label>
                              <?php
                                input_pdselect2("sifat_surat",$cmd_sifat_surat,$sifat_surat);
                              ?>
                            </div>
                          </div>
                          <div class="box-footer">
                              <button type="submit" class="setuju btn btn-primary btn-sm">Submit</button>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <i class="fa fa-user bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                      <div class="timeline-item">
                        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                          <div class="box-header with-border">
                             <h3 class="box-title">DATA PENGIRIM</h3>
                              <div class="box-tools pull-right"><i class="fa fa-clock-o"></i> <?= $wkt_korespodensi; ?></div>
                          </div>
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-8">
                                <p>Nama : <?php echo $nama_pengaju; ?></p>  
                                <p>Gender : <?= $jk; ?></p>        
                                <p>Umur : <?= $umur; ?></p>   
                                <p>Tempat Bekerja : <?= $tempat_kerja; ?></p>        
                              </div>
                              <div class="col-md-4">
                                  <a class="example-image-link" href="<?php echo $url_picbesarx; ?>"
                                    data-lightbox="example-set" data-title="<?php echo $nama_pengaju; ?>">
                                    <img class="profile-user-img img-responsive img-circle"
                                      src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                                  </a>              
                              </div>
                            </div>
                          </div>
                          <div class="box-footer">
                              <?php  
                                if ($status_korespodensi == 0) {
                                   echo '<a class="btn btn-xs btn-warning">STATUS : REGISTRASI</a>';
                                } else if($status_korespodensi == 1){
                                   echo '<a class="btn btn-xs btn-info">STATUS : PROSES</a>';
                                } else if($status_korespodensi == 2){
                                   echo '<a class="btn btn-xs btn-primary">STATUS : Validasi</a>';
                                } else if($status_korespodensi == 3){
                                   echo '<a class="btn btn-xs btn-success">STATUS : Selesai</a>';
                                } else {
                                   echo '<a class="btn btn-xs btn-danger">STATUS : Ditolak</a>';
                                }
                              ?>
                          </div>
                        </div>
                      </div>
                    </li>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <li>
                      <i class="fa fa-envelope bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                      <div class="timeline-item">
                        <div class="timeline-body">
                          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                            <div class="box-header with-border">
                               <h3 class="box-title">TAMBAH SURAT</h3>
                                <div class="box-tools pull-right">MISAL SURAT BALASAN</div>
                            </div>
                            <div class="box-body">
                              <p>Silahkan Pilih Surat Lainnya misalkan perlu balasan</p>
                            </div>
                            <div class="box-footer">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-xs OpenTambahKat" data-toggle="tooltip" data-placement="right" data-id="<?php echo $id_korespodensi; ?>" data-id2="<?php echo $barcode_korespodensi; ?>"
  title="Pilih Kategori Surat" data-toggle="modal" data-target="#exampleModal">
  Tambah Surat
</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                <?php
                  $ambil_kategori_tambah = $this->m_ol_rancak->ambil_kategori_tambah($id_korespodensi);
                  foreach($ambil_kategori_tambah as $rowambil_kategori_tambah){
                ?>
                    <li class="time-label">
                        <span class="bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>">
                           <?= $rowambil_kategori_tambah['nama_kategori']; ?>
                        </span>
                    </li>
                    <li>
                      <i class="fa fa-send bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>

                      <div class="timeline-item">
                          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                            <div class="box-header with-border">
                               <h3 class="box-title"><b><?= $rowambil_kategori_tambah['nama_kategori']; ?></b></h3>
                                <div class="box-tools pull-right"></div>
                            </div>
                            <div class="box-body">
                                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                                  <div class="box-header with-border">
                                     <h3 class="box-title">TAMBAH VALIDATOR SURAT</h3>
                                      <div class="box-tools pull-right"><b><?= $rowambil_kategori_tambah['nama_kategori']; ?></b></div>
                                  </div>
                                  <div class="box-body text-right">Asal : <?= $rowambil_kategori_tambah['asale']; ?><br>Tujuan : <?= $rowambil_kategori_tambah['tujuane']; ?>
                                    <p>Silahkan Pilih Validator sesuai dengan signature yang diperlukan di surat</p>
<a class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>"><?= $rowambil_kategori_tambah['nama_kategori']; ?></a>
                                    
                                  </div>
                                  <div class="box-footer">
<button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-xs OpenPengurus" data-toggle="tooltip" data-placement="right" data-id="<?php echo $rowambil_kategori_tambah['id_kor_kategori']; ?>" data-id2="<?php echo $barcode_korespodensi; ?>"
  title="Pilih Validator" data-toggle="modal" data-target="#exampleModal">
  Pilih Validator
</button>
          <div class="pull-right">
<a href="<?php echo base_url('ol_administrator/pengajuan_korespodensi/hapus_kor_kategori/'.$rowambil_kategori_tambah['id_kor_kategori']);?>/<?= $id ?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
  <i class="fa fa-trash"></i>
  <span>Hapus</span>
</a> &nbsp; || &nbsp;
<a href="<?php echo base_url('ol_administrator/pengajuan_korespodensi/print/'); ?><?= $id ?>/<?= $rowambil_kategori_tambah['barcode_kor_kategori'] ?>"  class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-xs">
  <i class="fa fa-file-pdf-o"></i> REQ PRINT
</a> 
          </div>
                                  </div>
                                </div>
                <?php
                  $ambil_kor_detil_pengcab = $this->m_ol_rancak->ambil_kor_detil_pengcab($rowambil_kategori_tambah['id_kor_kategori']);
                  foreach($ambil_kor_detil_pengcab as $rowambil_data_pengurus_pengcab){
                      if(empty($rowambil_data_pengurus_pengcab['foto'])){
                        $url_thumbxpp=base_url().'assets/images/noavatar.jpg';
                        $url_picbesarxpp=base_url().'assets/images/noavatar.jpg';
                      }else{
                        $cek_filesmall=FCPATH.'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                        if(file_exists($cek_filesmall)){
                          $url_thumbxpp=base_url().'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                          $url_picbesarxpp=base_url().'assets/foto/ol/'.$rowambil_data_pengurus_pengcab['foto'];
                        }else{
                          $url_thumbxpp=base_url().'assets/images/noavatar.jpg';
                          $url_picbesarxpp=base_url().'assets/images/noavatar.jpg';
                        }
                      }
                ?>
                                <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                                  <div class="box-header with-border">
                                     <h3 class="box-title">DATA VALIDATOR</h3>
                                      <div class="box-tools pull-right"><b><?= $rowambil_kategori_tambah['nama_kategori']; ?></b></div>
                                  </div>
                                  <div class="box-body">
                                  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                                    <div class="box-header with-border">
                                       <h3 class="box-title"><?= $rowambil_data_pengurus_pengcab['nama_pengcab']; ?></h3>
                                        <div class="box-tools pull-right"></div>
                                    </div>
                                    <div class="box-body">
                          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                            <div class="box-header with-border">
                               <h3 class="box-title"><?= $rowambil_data_pengurus_pengcab['nama_pegawai_pengurus']; ?></h3>
                                <div class="box-tools pull-right">

                                </div>
                            </div>
                            <div class="box-body">
                                      <div class="row">
                                        <div class="col-md-8">
                                          <h5>Disposisi : <?= $rowambil_data_pengurus_pengcab['disposisi']; ?></h5>  
                          <?php
                            if($rowambil_data_pengurus_pengcab['acc'] == 0){
                              echo '<button class="btn btn-xs btn-warning"> Belum ACC</button>';
                            }else if($rowambil_data_pengurus_pengcab['acc'] == 1){
                              echo '<button class="btn btn-xs btn-success"> ACC</button>';
                            }else{
                              echo '<button class="btn btn-xs btn-danger"> Di Tolak</button>';
                            }
                          ?>      
                                        </div>
                                        <div class="col-md-4">
                                <a class="example-image-link" href="<?php echo $url_picbesarxpp; ?>"
                                  data-lightbox="example-set" data-title="<?php echo $rowambil_data_pengurus_pengcab['nama_pegawai']; ?>">
                                  <img class="profile-user-img img-responsive img-circle"
                                    src="<?php echo $url_thumbx; ?>" style="width:75px" alt="User profile picture">
                                </a>              
                                        </div>
                                      </div>
                            </div>
                          </div>
                                    </div>
                                    <div class="box-footer">




<a href="<?php echo base_url('ol_administrator/pengajuan_korespodensi/hapus_ttd/'.$rowambil_data_pengurus_pengcab['id_kor_detil']);?>/<?= $id ?>"  onclick="confirmation(event)" class="btn btn-danger btn-xs">
  <i class="fa fa-trash"></i>
  <span>Hapus <?= $rowambil_data_pengurus_pengcab['nama_pegawai']; ?></span>
</a> 
                                    </div>
                                  </div>
                                  </div>
                                  <div class="box-footer">

                                  </div>
                                </div> 
                <?php
                  }
                }
                ?>                                                                 
                            </div>
                            <div class="box-footer">

                            </div>
                          </div>
                      </div>
                    </li>
                    <li>
                      <i class="fa fa-clock-o bg-<?php echo $arraywarna[array_rand($arraywarna)]; ?>"></i>
                    </li>
                  </ul>
                </div>
                <!-- /.col -->
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php echo form_close(); ?>
        </div>
      </div>
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
elseif ($page=="pengajuan_korespodensi_print")
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
      <?php echo form_open_multipart('ol_administrator/pengajuan_korespodensi/print/'.$id.'/'.$id2,' id="signupform" ');
        input_text("barcode_korespodensi",$id,"","","hidden");
        input_text("id_korespodensi",$id_korespodensi,"","","hidden");
        input_text("id_kor_kategori",$id_kor_kategori,"","","hidden");
        input_text("barcode_kor_kategori",$id2,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">DATA INI AKAN TERCATAT SEBAGAI PERMINTAAN HASIL SURAT KE ANGGOTA MOHON DIBUAT SEKALI SAJA</h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>No Surat</label>
              <?php
                input_text("no_kor_print",$no_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Judul Surat</label>
              <?php
                input_text("title_kor_print",$title_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Judul (MODUL)</label>
              <?php
                input_text("modul",$modul,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tempat Modul (MODUL)</label>
              <?php
                input_text("tmp_modul",$tmp_modul,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tanggal Awal</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Kota Signature</label>
              <?php
                input_text("tmp_kor_print",$tmp_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Tanggal Signature</label>
              <?php
                input_calendar("tgl_kor_print","tgl_kor_print",$tgl_kor_print,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>Uk Font</label>
                <?php
                  input_textcustom("font_size",$font_size," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan Angka","text");
                ?>
                </div>
              </div>
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="width:5%;background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">YANG BERTANDA TANGAN</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_kor_detil_signature as $row){
                ?>
              <tr>
                <td style="vertical-align:middle;text-align: center;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pegawai_pengurus'];?>">
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_pegawai_pengurus']; ?><?php input_text("id_pegawai[]",$row['id_pegawai'],"","","hidden"); ?></td>
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
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="pengajuan_korespodensi_pengcab")
{
?>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_administrator/pengajuan_korespodensi/simpan_pengcab');?>" onClick="return cek();">
          <input type="hidden" name="barcode_korespodensi" value="<?= $id; ?>">
          <input type="hidden" name="id_korespodensi" value="<?= $id_korespodensi; ?>">
          <input type="hidden" name="id_kategori" value="<?= $id_kategori; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
          <h5>JIKA TIDAK MUNCUL PASTIKAN PENGURUS WILAYAH TERSEBUT SUDAH MASUK JABATAN ORGANISASI (KETUA DAN SEKRETARIS)</h5>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <tr>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">
                    <input name="select_all" class="checkall" type="checkbox" />
                  </th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
              </thead>
              <tbody>   
                <?php
                  foreach($ambil_data_pengcab as $rowambil_data_pengcab){
                ?>
              <tr>
                  <td style="vertical-align:middle;width:10%">
                    <div class="checkbox">
                    <label>
                      <input type="checkbox" class="child" name="chk[]" value="<?= $rowambil_data_pengcab['id_pengcab']; ?>" >
                    </label>
                    </div>        
                  </td>
                  <td style="vertical-align:middle;"><?= $rowambil_data_pengcab['nama_pengcab'];?></td>
              </tr> 
                <?php
                  }
                ?>
              </tbody>
            </table> 
        </div>
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
    $('.checkall').on('click', function() {
      $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      "initComplete": function (settings, json) {  
      $("#example1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
      },
      'paging'        : false,
      'lengthChange'  : false,
      'searching'     : false,
      'ordering'      : false,
      'info'          : true,
//    'scrollX'     : true,
//    'scrollY'     : '500px',
    'scrollCollapse'  : true
    })
  });
</script>
<?php
}
elseif ($page=="pengajuan_korespodensi_pengurus")
{
?>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_administrator/pengajuan_korespodensi/simpan_pengurus');?>" onClick="return cek();">
          <input type="hidden" name="id_kor_kategori" value="<?= $id; ?>">
          <input type="hidden" name="barcode_korespodensi" value="<?= $id2; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
          <h5>JIKA TIDAK MUNCUL PASTIKAN PENGURUS WILAYAH TERSEBUT SUDAH MASUK JABATAN ORGANISASI (KETUA DAN SEKRETARIS)</h5>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <tr>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;width:5%;">
                    <input name="select_all" class="checkall" type="checkbox" />
                  </th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
              </thead>
              <tbody>   
                <?php
                  foreach($ambil_data_pengcab as $rowambil_data_pengcab){
                ?>
              <tr>
                  <td style="vertical-align:middle;width:10%">
                    <div class="checkbox">
                    <label>
                      <input type="checkbox" class="child" name="chk[]" value="<?= $rowambil_data_pengcab['id_pegawai_pengurus']; ?>" >
                    </label>
                    </div>        
                  </td>
                  <td style="vertical-align:middle;">
                    <?= $rowambil_data_pengcab['nama_pegawai_pengurus'];?>
                    <?php  input_text("id_pegawai[]",$rowambil_data_pengcab['id_pegawai'],"","","hidden"); ?>
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
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
          </div>
    </div>  
    </FORM>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
    $('.checkall').on('click', function() {
      $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      "initComplete": function (settings, json) {  
      $("#example1").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
      },
      'paging'        : false,
      'lengthChange'  : false,
      'searching'     : true,
      'ordering'      : false,
      'info'          : true,
//    'scrollX'     : true,
//    'scrollY'     : '500px',
    'scrollCollapse'  : true
    })
  });
</script>
<?php
}
elseif ($page=="pengajuan_korespodensi_tambah_kategori")
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
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_administrator/pengajuan_korespodensi/simpan_tambah_kategori');?>" onClick="return cek();">
          <input type="hidden" name="barcode_korespodensi" value="<?= $id2; ?>">
          <input type="hidden" name="id_korespodensi" value="<?= $id; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
          <h5>PILIH KATEGORI SURAT</h5>

<?php input_pdselect2("id_kategori",$ambil_data_surat_kategori,$id_kategori); ?>
        </div>
<div class="col-md-12">
<label>Asal (NAMA PENGURUS INI YANG AKAN JADI VALIDATOR)</label>
<?php input_pdselect2("pengcab_asal",$ambil_data_pengcabnonull,$pengcab_asal); ?>
</div>
<div class="col-md-12">
<label>Tujuan</label>
<?php input_pdselect2("pengcab_tujuan",$ambil_data_pengcabnonull,$pengcab_tujuan); ?>
</div>
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
  }); 
</script>
<?php
}
elseif ($page=="pengajuan_korespodensi_edit_korprint")
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
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('ol_administrator/pengajuan_korespodensi/simpan_edit_korprint');?>" onClick="return cek();">
          <input type="hidden" name="barcode_korespodensi" value="<?= $id; ?>">
          <input type="hidden" name="id_kor_print" value="<?= $id2; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
              
          <div class="col-md-12">
            <div class="form-group">
              <label>No Surat</label>
              <?php
                input_text("no_kor_print",$no_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Judul Surat</label>
              <?php
                input_text("title_kor_print",$title_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Judul (MODUL)</label>
              <?php
                input_text("modul",$modul,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tempat Modul (MODUL)</label>
              <?php
                input_text("tmp_modul",$tmp_modul,"maxlength='255' ","Ketikkan","text");
              ?>
             </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tanggal Awal</label>
              <?php
                input_calendar("tgl_awal","tgl_awal",$tgl_awal,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tanggal Akhir</label>
              <?php
                input_calendar("tgl_akhir","tgl_akhir",$tgl_akhir,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Kota Signature</label>
              <?php
                input_text("tmp_kor_print",$tmp_kor_print,"maxlength='255' ","Ketikkan","text");
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Tanggal Signature</label>
              <?php
                input_calendar("tgl_kor_print","tgl_kor_print",$tgl_kor_print,"Masukkan Tanggal"," required");
              ?>
            </div>
          </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Uk Font</label>
                <?php
                  input_textcustom("font_size",$font_size," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan Angka","text");
                ?>
                </div>
              </div>
                
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
  });
$('#tgl_kor_print').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_kor_print").inputmask("datetime", {
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
</script>
<?php
}
elseif ($page=="registrasi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_administrator/registrasi/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk NIP, No Profesi dan Nama</label>
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
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body">
          <div class="box-tools pull-right">
      <?php
      //  input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th width="5%"></th>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Wilayah</th>
            <th>HP</th>
          </tr>
        </thead>
      </table>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="registrasi_aktifasi")
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
      <?php echo form_open_multipart('ol_administrator/registrasi/aktifasi/'.$id,' id="signupform" ');
        input_text("barcode_registrasi",$id,"","","hidden");
        input_text("status_registrasi",$status_registrasi,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-3">
              <div class="form-group">
                <label>Nama Pegawai</label>
                <?php
                  input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Lahir</label>
                <?php
                  input_text("tmp_lahir",$tmp_lahir,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <?php
                  input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir"," required");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?php
                  input_pdselect2("jk",$gender,$jk);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?php
                  input_pdselect2("id_status_kawin",$cmd_status_kawin,$id_status_kawin);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Agama</label>
                <?php
                  input_pdselect2("id_agama",$cmd_agama,$id_agama);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status Perawat</label>
                <?php
                  input_pdselect2("status_perawat",$opsi_status_perawat,$status_perawat);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>PK</label>
                <?php
                  input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$kol_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Belum Ada PK");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Jabatan Pegawai</label>
                <?php
                  input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Induk Karyawan","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP format kode negara","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Jabatan Fungsional</label>
                <?php
                  input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Nomor Profesi</label>
                <?php
                  input_textcustom("no_profesi",$no_profesi,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Profesi","text");
                ?>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group">
                <label>DPK / DPW</label>
                <?php
                  input_pdselect2("id_pengcab",$null_pengcab,$id_pengcab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>          
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Bekerja</label>
                <?php
                  input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_rujukan_working_null,"id_working","nama_working",$id_instansi,"Belum Bekerja");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <?php
                  input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi</label>
                <?php
                  input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dulu");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kota/Kabupaten</label>
                <?php
                  input_pdselect2("id_kab",$kab,$id_kab);
                //  echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kecamatan</label>
                <?php
                  input_pdselect2("id_kec",$kec,$id_kec);
                //  echo form_dropdown('id_kec',$kec,'0',array('id'=>'id_kec','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kelurahan</label>
                <?php
                  input_pdselect2("id_kel",$kel,$id_kel);
                //  echo form_dropdown('id_kel',$kel,'0',array('id'=>'id_kel','class'=>'form-control'));
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Level</label>
                  <?php
                    input_pdselect2("id_level",$cmd_level,$id_level);
                  ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
                <small><input type="checkbox" onclick="myUsername()"> Hide </small>
                <?php
                  input_textcustom("username",$username," maxlength='60' class='form-control' required autocomplete='off' id='username' ",
                          "Huruf kecil tanpa spasi dan spesial character kecuali -","text");
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="user")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_administrator/user/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk Wilayah, NIP, No Profesi dan Nama</label>
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
  //      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
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
            <th>JabFung</th>
            <th>No HP</th>
            <th>Username</th>
            <th>Wilayah</th>
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
elseif ($page=="user_edit")
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
      <?php echo form_open_multipart('ol_administrator/user/edit/'.$id,' id="signupform" ');
        input_text("barcode_pegawai",$id,"","","hidden");
        input_text("nik_lama",$nik,"","","hidden");
        input_text("username_lama",$username,"","","hidden");
        input_text("password_lama",$password_lama,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">USER</h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama Pegawai</label>
                <?php
                  input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tempat Lahir</label>
                <?php
                  input_text("tmp_lahir",$tmp_lahir,"maxlength='255' ","Ketikkan Tempat Lahir","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <?php
                  input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir"," required");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <?php
                  input_pdselect2("jk",$gender,$jk);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?php
                  input_pdselect2("id_status_kawin",$cmd_status_kawin,$id_status_kawin);
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Agama</label>
                <?php
                  input_pdselect2("id_agama",$cmd_agama,$id_agama);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
                  input_textcustom("nik",$nik," required id='nik'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No KTP","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Nomor Induk Karyawan</label>
                <?php
                  input_textcustom("nip",$nip,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Induk Karyawan","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Jabatan Pegawai</label>
                <?php
                  input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>DPK / DPW</label>
                <?php
                  input_pdselect2fleksibel("id_pengcab","id_pengcab",$null_pengcab,"id_pengcab","nama_pengcab",$id_pengcab,"Tidak Ada Pengcab");
                ?>
              </div>
            </div>    
            <div class="col-md-3">
              <div class="form-group">
                <label>Nomor Profesi (NIRA/PARI DLL)</label>
                <?php
                  input_textcustom("no_profesi",$no_profesi,"  
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan No Profesi (PARI / NIRA DLL)","text");
                ?>
              </div>
            </div>  
            <div class="col-md-2">
              <div class="form-group">
                <label>No WA </label>
                <?php
                  input_textcustom("no_hp",$no_hp," required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Ketikkan No HP format kode negara","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>          
            <div class="col-md-5">
              <div class="form-group">
                <label>Pendidikan Terakhir</label>
                <?php
                  input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
                ?>
              </div>
            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label>Status</label>
                <?php
                  input_pdselect2("status_pegawai",$cmd_status,$status_pegawai);
                ?>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary">Submit</button>
        </div>
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}