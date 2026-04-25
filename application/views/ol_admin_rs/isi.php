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
elseif ($page=="instansi")
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
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

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
            <th style="width:30%;">Nama Instansi</th>           
            <th style="width:30%;">Alamat</th>
            <th>Email</th>
            <th>Stempel</th>            
            <th>Kop</th>
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
elseif ($page=="instansi_edit")
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
      <?php echo form_open_multipart('ol_admin_rs/instansi/edit/'.$id,' id="signupform" ');
        input_text("id_working",$id_working,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
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
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("title",$title,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_working",$email_working,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_working",$kontak_working,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_working",$alamat_working,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi</label>
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
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kecamatan</label>
                <?php
                  input_pdselect2("id_kec",$kec,$id_kec);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kelurahan</label>
                <?php
                  input_pdselect2("id_kel",$kel,$id_kel);
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
elseif ($page=="instansi_edit_stempel")
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
      <?php echo form_open_multipart('ol_admin_rs/instansi/edit_stempel/'.$id,' id="signupform" ');
        input_text("id_working",$id_working,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
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
            <div class="col-md-4">
              <div class="form-group">
                <label>Nama</label>
                <?php
                  input_text("title",$title,"maxlength='255' required autofocus ","Ketikkan Nama","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Email</label>
                <?php
                  input_text("email_working",$email_working,"maxlength='255' ","Ketikkan Email","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Telepon / Fax</label>
                <?php
                  input_text("kontak_working",$kontak_working,"maxlength='255' ","Ketikkan No Telepon","text");
                ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Alamat</label>
                <?php
                  input_text("alamat_working",$alamat_working,"maxlength='255' ","Ketikkan Alamat","text");
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Propinsi</label>
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
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kecamatan</label>
                <?php
                  input_pdselect2("id_kec",$kec,$id_kec);
                ?>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Kelurahan</label>
                <?php
                  input_pdselect2("id_kel",$kel,$id_kel);
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
elseif ($page=="format_validator")
{
?> 
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
    <?php echo form_open_multipart('ol_admin_rs/format_validator/view/'.$id,' id="signupform" '); ; 
    ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-11">
            <div class="form-group">
              <label>Instansi</label>
                <?php
                  input_pdselect2("id",$ambil_data_rujukan_working_null,$id);
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
            <th>Instansi</th>           
            <th>Jabatan</th>           
            <th>Jenis Pengajuan</th>   
            <th>Struktur</th>     
            <th>Kunci</th>   
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
elseif ($page=="format_validator_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/format_validator/simpan_tambah');?>" onClick="return cek();">
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
        <div class="row">
          <div class="col-md-4">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_rujukan_working_null,$id_instansi);
            ?>  
          </div>    
          <div class="col-md-4">
            <label>Jabatan</label>
            <?php
              input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"SEMUA");
            ?>  
          </div>    
          <div class="col-md-4">
            <label>Hanya Admin Yang Bisa Rubah</label>
              <?php
                input_pdselect2("kunci",$cmd_ya_tidak,$kunci);
              ?>  
          </div>           
          <div class="col-md-4">
            <label>Jenis Pengajuan</label>
            <?php
              input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
            ?>  
          </div>         
          <div class="col-md-4">
            <label>Status</label>
              <?php
                input_pdselect2("status_pengajuan_format_rs",$cmd_status,$status_pengajuan_format_rs);
              ?>  
          </div> 
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Struktur Validator</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($ambil_data_ms_struktur_no_syarat as $row){
              //    if(!in_array($row['id_kewenangan'],explode(",", $eimplo))){
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_ms_struktur'];?>" >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_ms_struktur']; ?></td>

              </tr>
                <?php
             //       }
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
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
<?php
}
elseif ($page=="format_validator_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/format_validator/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pengajuan_format_rs" value="<?= $id; ?>">
      <input type="hidden" name="id_instansi_lama" value="<?= $id_instansi; ?>">
      <input type="hidden" name="id_status_diusulkan_lama" value="<?= $id_status_diusulkan; ?>">
      <input type="hidden" name="id_jabatan_lama" value="<?= $id_jabatan; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <label>Instansi</label>
            <?php
              input_pdselect2("id_instansi",$ambil_data_rujukan_working_null,$id_instansi);
            ?>  
          </div>    
          <div class="col-md-4">
            <label>Jabatan</label>
            <?php
              input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"SEMUA");
            ?>  
          </div> 
          <div class="col-md-4">
            <label>Jenis Pengajuan</label>
            <?php
              input_pdselect2("id_status_diusulkan",$status_diusulkan_all,$id_status_diusulkan);
            ?>  
          </div>      
          <div class="col-md-4">
            <label>Hanya Admin Yang Bisa Rubah</label>
              <?php
                input_pdselect2("kunci",$cmd_ya_tidak,$kunci);
              ?>  
          </div>    
          <div class="col-md-4">
            <label>Status</label>
              <?php
                input_pdselect2("status_pengajuan_format_rs",$cmd_status,$status_pengajuan_format_rs);
              ?>  
          </div> 
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Struktur Validator</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($ambil_data_ms_struktur_no_syarat as $row){
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
<label>
  <input type="checkbox" class="child" name="chk[]" value="<?= $row['id_ms_struktur']; ?>" <?php if(in_array($row['id_ms_struktur'],explode(",", $ms_struktur))) echo 'checked="checked"'; ?> >
</label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_ms_struktur']; ?></td>

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
elseif ($page=="struktur")
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
              <th>Instansi</th>
              <th>Nama Struktur</th>
              <th>Status Struktur</th>
              <th>Status Struktur Instansi</th>
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
elseif ($page=="struktur_tambah")
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
      <?php echo form_open_multipart('ol_admin_rs/struktur/tambah',' id="signupform" ');
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <label>Nama Instansi</label>
                <?php
                  input_pdselect2("id_working",$ambil_data_rujukan_kab_working,$id_working);
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
                foreach($ambil_data_ms_struktur_no_syarat as $row){
                ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_ms_struktur'];?>">
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;"><?php echo $row['nama_ms_struktur']; ?></td>
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
    <?php echo form_close(); ?>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="struktur_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/struktur/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_struktur" value="<?= $id_struktur; ?>">
            <input type="hidden" name="id_working_lama" value="<?= $id_working; ?>">
            <input type="hidden" name="id_ms_struktur_lama" value="<?= $id_ms_struktur; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">     
            <div class="col-md-12">
                <label>Nama Instansi</label>
                <?php
                  input_pdselect2("id_working",$ambil_data_rujukan_kab_working,$id_working);
                ?>
            </div>     
            <div class="col-md-12">
                <label>Nama Kepengurusan</label>
                <?php
                  input_pdselect2("id_ms_struktur",$ambil_data_ms_struktur_no_syarat_no_null,$id_ms_struktur);
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_struktur",$cmd_status,$status_struktur);
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
elseif ($page=="pegawai_struktur")
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
              <th>Instansi</th>
              <th>Struktur</th>
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
elseif ($page=="pegawai_struktur_tambah")
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
      <?php echo form_open_multipart('ol_admin_rs/pegawai_struktur/tambah',' id="signupform" ');
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <label>Struktur Instansi</label>
                <?php
                  input_pdselect2("id_struktur",$ambil_data_struktur,$id_struktur);
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
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Wilayah</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_data_dropdown_pegawai_no_null_instansi as $row){
                ?>
                  <tr>
                    <td style="vertical-align:middle;text-align: center;">
                      <div class="checkbox">
                      <label>
                        <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pegawai'];?>">
                      </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;">
                      <b><font color="blue"><?php echo $row['nama_pegawai'].'</font></b> - PK : <b>'.$row['nama_kode_kewenangan'].'</b> - <font color="red">NIP : <b>'.$row['nip'].'</font></b> - JabFung : <b>'.$row['nama_jabatan_fungsional'].'</b> - <b><font color="green">'.$row['nama_working']; ?></font></b>
                    </td>
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
elseif ($page=="pegawai_struktur_edit")
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

          </div>
        </div>
      <?php echo form_open_multipart('ol_admin_rs/pegawai_struktur/edit/'.$id,' id="signupform" ');
        input_text("barcode_pegawai_struktur",$id,"","","hidden");
        input_text("id_pegawai_struktur",$id_pegawai_struktur,"","","hidden");
        input_text("id_pegawai_lama",$id_pegawai,"","","hidden");
        input_text("id_struktur_lama",$id_struktur,"","","hidden");
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
                <label>Struktur Instansi</label>
                <?php
                  input_pdselect2("id_struktur",$ambil_data_struktur,$id_struktur);
                ?>
              </div>
            </div>
            <div class="col-md-3">
                <label>Status</label>
                <?php
                input_pdselect2("status_pegawai_struktur",$cmd_status,$status_pegawai_struktur);
                ?>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Pengurus</label>
                <?php
                  input_pdselect2("id_pegawai",$ambil_data_dropdown_pegawai_instansi_no_nulls,$id_pegawai);
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
elseif ($page=="pegawai_struktur_jabatan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/pegawai_struktur/simpan_jabatan');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_pegawai_struktur" value="<?= $id_pegawai_struktur; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php $title; ?></h3>
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
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($cmd_jabatan_null as $row){
  //                if(in_array($row['id_jabatan'],explode(",", $id_jabatan))){
                ?>
              <tr>
                <td style="vertical-align:middle;">
  <div class="checkbox">
  <label>
    <input type="checkbox" <?php if(in_array($row['id_jabatan'],$id_jabatan)) echo 'checked="checked"'; ?> class="child" name="chk[]" value="<?= $row['id_jabatan'] ?>" >
  </label>
  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_jabatan']; ?></td>

              </tr>
                <?php
  //                  }
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
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
}); 
</script>
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
  <?php echo form_open_multipart('ol_admin_rs/user/view/'.$id,' id="signupform" ');
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
elseif ($page=="ol_akses")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
            <div class="col-md-12">
              <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                <div class="box-header with-border">
                   <h3 class="box-title">HAK AKSES LAINNYA</h3>

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
                    <th style="width:5%">ID</th>
                    <th>Nama</th>
                    <th>Akses</th>
                    <th>Status</th>
                  </tr>
                </thead>
              </table>
                </div>
                <div class="box-footer">

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
elseif ($page=="ol_akses_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/ol_akses/simpan_tambah');?>" onClick="return cek();">
       <input type="hidden" name="id_pegawai" value="<?= $id_pegawai; ?>">
       <input type="hidden" name="barcode_pegawai" value="<?= $id; ?>">
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
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th><input name="select_all" class="checkall" type="checkbox" /></th>
                  <th>ID</th>
                  <th>Hak Akses</th>
                </tr>
              <?php
              foreach($hak_akses as $row){
              ?>
                <tr>
                  <td>
                    <div class="checkbox">
                    <label>
                      <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_akses'];?>">
                    </label>
                    </div>
                  </td>
                  <td><?= $row['id_akses'] ?></td>
                  <td><?= $row['nama_akses'] ?></td>
                </tr>
              <?php
              }
              ?>
              </table>
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
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_admin_rs/unit/view/'.$id,' id="signupform" '); ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
    </div>
      <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Wilayah Kepengurusan</label>
              <?php
                input_pdselect2fleksibel("id_working","id_working",$ambil_data_rujukan_working_null,"id_working","nama_working",$id,"Semua");
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
           <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>

          <div class="box-tools pull-right">
      <?php
   //     input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
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
elseif ($page=="unit_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/unit/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">     
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
            </div>    
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_unit",$nama_unit,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_unit",$cmd_status,$status_unit);
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
elseif ($page=="unit_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/unit/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_unit" value="<?= $id; ?>">
            <input type="hidden" name="nama_unit_lama" value="<?= $nama_unit; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $aran_jabatan; ?></h3>
      </div>
        <div class="box-body">
            <div class="row">         
            <div class="col-md-12">
                <label>Instansi</label>
                <?php
                  input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
                ?>
            </div>    
            <div class="col-md-12">
                <label>Nama</label>
                <?php
                  input_text("nama_unit",$nama_unit,"maxlength='255' ","Ketikkan Nama","text");
                ?>
            </div>   
              <div class="col-md-12">
                  <label>Status</label>
                  <?php
                  input_pdselect2("status_unit",$cmd_status,$status_unit);
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

          </div>
        </div>
      <?php echo form_open_multipart('ol_admin_rs/user/edit/'.$id,' id="signupform" ');
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
            <div class="col-md-3">
              <div class="form-group">
                <label>Status Perkawinan</label>
                <?php
                  input_pdselect2("id_status_kawin",$cmd_status_kawin,$id_status_kawin);
                ?>
              </div>
            </div>
            <div class="col-md-3">
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
            <div class="col-md-3">
              <div class="form-group">
                <label>Jabatan Pegawai</label>
                <?php
                  input_pdselect2("tipe_pegawai",$cmd_tipe_pegawai,$tipe_pegawai);
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
            <div class="col-md-3">
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
  <?php echo form_open_multipart('ol_admin_rs/registrasi/view/'.$id,' id="signupform" ');
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
      <?php echo form_open_multipart('ol_admin_rs/registrasi/aktifasi/'.$id,' id="signupform" ');
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
  <?php echo form_open_multipart('ol_admin_rs/pengajuan_kompetensi/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik pisahkan dengan spasi untuk Pencarian Banyak Nama</label>
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
    //    input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
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
            <th>Kategori</th>
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
elseif ($page=="pengajuan_kompetensi_pilih")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/pengajuan_kompetensi/simpan_pilih');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
            <input type="hidden" name="barcode_pengajuan" value="<?= $barcode_pengajuan; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">TAMBAH VALIDATOR - NAMA DOBEL TIDAK DISIMPAN</h3>
      </div>
        <div class="box-body">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Nama</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($struktur as $row){
                ?>
              <tr>
                <td>
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pegawai'];?>" >
                  </label>
                  </div>
                </td>
                <td style="text-align:left;"><?php echo $row['nama_pegawai']; ?></td>
              </tr>
                <?php
                  }
                ?>
              </tbody>
            </table> 
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
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
      });
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_form")
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
                <th style="display;none;width: 5%;"></th>
                <th>Jabatan</th>
                <th>Form</th>
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
elseif ($page=="pengajuan_kompetensi_pilih_form")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/pengajuan_kompetensi/simpan_pilih_form');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="status_pengajuan" value="<?= $status_pengajuan; ?>">
            <input type="hidden" name="id_pengajuan_validator" value="<?= $id_pengajuan_validator; ?>">
            <input type="hidden" name="barcode_pengajuan_validator" value="<?= $barcode_pengajuan_validator; ?>">
            <input type="hidden" name="barcode_pengajuan" value="<?= $barcode_pengajuan; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">SETING FORM</h3>
      </div>
        <div class="box-body">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Nama</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($form as $row){
                ?>
              <tr>
                <td>
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_jenis_form'];?>" <?php if(in_array($row['id_jenis_form'],explode(",", $nkr_form))) echo 'checked="checked"'; ?> >
                  </label> 
                  </div>
                </td>
                <td style="text-align:left;"><?php echo $row['nama_form']; ?></td>
              </tr>
                <?php
                  }
                ?>
              </tbody>
            </table> 
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
      'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });
      });
</script>
<?php
}
elseif ($page=="pengajuan_kompetensi_seting")
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
                <th style="display;none;width: 5%;"></th>
                <th>Jabatan</th>
                <th>Validator</th>
                <th>Jabatan V</th>
                <th>Instansi Validator</th>
                <th>Result</th>
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
elseif ($page=="pengajuan_kompetensi_isi_validator")
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
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_admin_rs/pengajuan_kompetensi/isi_validator/'.$id.'/'.$id2,' id="signupform" ');
  input_text("barcode_pengajuan_validasi",$id,"","","hidden");
  input_text("barcode_working",$id2,"","","hidden");
  input_text("barcode_pengajuan",$barcode_pengajuan,"","","hidden");
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">INSTANSI</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Pilih Instansi</label>
              <?php
                input_pdselect2fleksibel("barcode_working","barcode_working",$ambil_data_working,"barcode_working","nama_working",$id2,"Silahkan Pilih Intansi");
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
        input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
      ?>
          </div>
      <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
        <thead>
          <tr>
            <th style="display:none;">ID</th>
            <th>Nama</th>
            <th>Struktur</th>
            <th>Instansi</th>
            <th>NIP</th>
            <th>JabFung</th>
            <th>PK</th>
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
elseif ($page=="pengajuan_kompetensi_pelatihan_validator")
{
?>
      <div class="row">
        <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Nama Pelatihan</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Jenis</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Kategori</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Tgl Awal</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;">Tgl Selesai</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_struktur_lihat_pelatihan as $row){
                ?>
              <tr>
                <td style="text-align:left;"><?php echo $row['nama_berkas']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_kategori_berkas']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_kategori_pelatihan']; ?></td>
                <td style="text-align:center;"><?php echo date('d-m-Y', strtotime($row['tgl_a_berkas'])) ?></td>
                <td style="text-align:center;"><?php echo date('d-m-Y', strtotime($row['tgl_b_berkas'])) ?></td>
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
    </FORM>
    </div>
<script type="text/javascript">
    $(document).ready(function() {
    var table =  $('#example1').DataTable({
      $('#modal-default').css( 'display', 'block' );
      table.columns.adjust().draw();
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
elseif ($page=="pengajuan_kompetensi_lihat")
{
?>
<style>
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
  table td {
    word-wrap: break-word;
  }
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <a href="<?php echo $link_kembali;?>"
          class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
        </a>
      </h1>
    </section>
    <section class="content">
    <?php echo form_open_multipart('ol_kompetensi/pengajuan_kompetensi/validasi/'.$id.'/'.$id2.'/'.$id3,' id="signupform" '); ;
      if(empty($foto)){
        $url_thumbx=base_url().'assets/images/noavatar.jpg';
        $url_picbesarx=base_url().'assets/images/noavatar.jpg';
      }else{
        $cek_filesmall=FCPATH.'assets/foto/member/small/'.$foto;
        if(file_exists($cek_filesmall)){
          $url_thumbx=base_url().'assets/foto/member/small/'.$foto;
          $url_picbesarx=base_url().'assets/foto/member/original/'.$foto;
        }else{
          $url_thumbx=base_url().'assets/images/noavatar.jpg';
          $url_picbesarx=base_url().'assets/images/noavatar.jpg';
        }
      }
    ?>
    <div class="row">
      <div class="col-md-4">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">PROFIL</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body box-profile">
                <a class="example-image-link" href="<?php echo $url_picbesarx; ?>" 
                  data-lightbox="example-set" data-title="<?php echo $nama_pegawai; ?>">
                  <img class="profile-user-img img-responsive img-circle" 
                    src="<?php echo $url_thumbx; ?>" style="width:50px;height:50px;" alt="User profile picture">
                </a>

                <h3 class="profile-username text-center"><?php echo $nama_pegawai; ?><br><?php echo $nama_status_diusulkan; ?></h3>

                <p class="text-muted text-center"></p>  
                <strong><i class="fa fa-book margin-r-5"></i> TTL / Umur</strong>
                <p class="text-muted">
                <?php echo $tmp_lahir; ?>, <?php echo date('d-m-Y', strtotime($tgl_lahir)); ?> / 
                <?php
                  $birthage = $tgl_lahir;
                  $interval = date_diff(date_create(), date_create($birthage));
                  $umur = $interval->format("%Y Tahun, %M Bulan, %d Hari");
                  echo $umur;           
                ?>
                </p>
                <strong><i class="fa fa-book margin-r-5"></i> Agama</strong>
                <p class="text-muted">
                <?php echo $nama_agama; ?>
                </p>
                <strong><i class="fa fa-book margin-r-5"></i> Marital Status</strong>
                <p class="text-muted">
                <?php echo $nama_status_kawin; ?>
                </p>
                <strong><i class="fa fa-pencil margin-r-5"></i> No</strong>
                <p>
                NIP : <?php echo $nip; ?><br>
                No Profesi : <?php echo $no_profesi; ?>
                </p>
                <strong><i class="fa fa-book margin-r-5"></i> Pendidikan</strong>
                <p class="text-muted">
                <?php echo $nama_pendidikan; ?>
                </p>      
                <strong><i class="fa fa-phone margin-r-5"></i> No HP</strong>
                <p class="text-muted">
                <a href="tel:<?php echo $no_hp; ?>" target="_blank"><?php echo $no_hp; ?></a>
                </p>
                <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                <p class="text-muted">
                <a href="mailto:<?php echo $email; ?>" target="_blank"><?php echo $email; ?></a>
                </p>
                <strong><i class="fa fa-book margin-r-5"></i> Status Pegawai</strong>
                <p class="text-muted">
                <?php echo $nama_status_pegawai; ?>
                </p>
                <strong><i class="fa fa-map-user-md margin-r-5"></i> Jabatan Fungsional</strong>
                <p class="text-muted">
                <?php echo $nama_jabatan_fungsional; ?>
              </p>
                <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
                <p class="text-muted">
                <?php echo $alamat; ?>            
                </p> 
                <strong><i class="fa fa-hospital-o margin-r-5"></i> Unit / Ruangan</strong>
                <p class="text-muted">
                  <ul>
                <?php 
                $kondisi=array('id_pegawai'=>$id_pegawai,'id_instansi'=>$id_instansi);
                  $unite = $this->m_umum->ambil_data_kondisi_2tabel_result('ol_pegawai_unit',$kondisi,'ol_unit','id_unit');
                  foreach($unite as $rowunite){
                    echo '<ol>'.$rowunite['nama_unit'].'</ol>';
                  }
                ?>
                  </ul>
                </p>     
          </div>
        </div>  
      </div>  
      <div class="col-md-8">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">BERKAS DAN ETIK</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
              <thead>
                <tr>
                <th rowspan="2" style="vertical-align:middle;text-align:center;background: #800000;color:white;width:10%;">PILIH</th>
                <th rowspan="2" style="vertical-align:middle;text-align:center;background: #800000;color:white;">Nama Berkas</th>
                <th colspan="4" style="vertical-align:middle;text-align:center;background: #800000;color:white;">KESESUAIAN BUKTI </th>
                </tr>
                <tr>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Tersedia</th>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Shahih</th>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Asli</th>
                <th style="vertical-align:middle;text-align:center;width:5%;background: #800000;color:white;">Terkini</th>
                </tr>
              </thead>
              <tbody>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> IJASAH</td>
                  </tr>
                  <?php
                  if(!empty($id_ijasah)){
                    foreach($ambil_berkas_data as $row){
                      if (in_array($row['id_berkas'],$id_ijasah)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_ijasah[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_1" <?php if(in_array($row['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_2" <?php if(in_array($row['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_3" <?php if(in_array($row['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_4" <?php if(in_array($row['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> STR</td>
                  </tr>
                  <?php
                  if($id_str!==""){
                    foreach($ambil_berkas_data as $row2){
                      if (in_array($row2['id_berkas'],$id_str)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_str[]" value="<?php echo $row2['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/'.$row2['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row2['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_1" <?php if(in_array($row2['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_2" <?php if(in_array($row2['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_3" <?php if(in_array($row2['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row2['id_berkas']; ?>_4" <?php if(in_array($row2['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> SERTIFIKAT </td>
                  </tr>
                  <?php
                  if($id_sertifikat!==""){
                    foreach($ambil_berkas_data as $row3){
                      if (in_array($row3['id_berkas'],$id_sertifikat)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_sertifikat[]" value="<?php echo $row3['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/'.$row3['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row3['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_1" <?php if(in_array($row3['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_2" <?php if(in_array($row3['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_3" <?php if(in_array($row3['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row3['id_berkas']; ?>_4" <?php if(in_array($row3['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-text"></i> Berkas Lainnya</td>
                  </tr>
                  <?php
                //  if($id_ijasah!==""){
                  if(!empty($id_berkas)){
                    foreach($ambil_berkas_data as $row){
                      if (in_array($row['id_berkas'],$id_berkas)) {
                  ?>
                    <tr>
                    <td style="vertical-align:middle;text-align:center;">
                      <div class="checkbox">
                        <label>
                        <input name="id_4_berkas[]" value="<?php echo $row['id_berkas']; ?>" checked="checked" type="checkbox">
                        </label>
                      </div>
                    </td>
                    <td style="vertical-align:middle;text-align:left;">
                      <a href="<?php echo base_url('assets/berkas/'.$row['link_berkas']);?>" target="_blank" class="btn bg-maroon btn-xs">
                        <i class="fa fa-search"> <?php echo substr($row['nama_berkas'], 0, 50); ?> ...</i>
                      </a>
                    </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_1" <?php if(in_array($row['id_berkas']."_1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_2" <?php if(in_array($row['id_berkas']."_2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_3" <?php if(in_array($row['id_berkas']."_3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="<?php echo $row['id_berkas']; ?>_4" <?php if(in_array($row['id_berkas']."_4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                    </tr>
                  <?php
                      }
                    }
                  }
                  ?>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-book"></i> LOGBOOK</td>
                  </tr>
                  <tr>
                  <td colspan="2" style="vertical-align:middle;text-align:center;">LOGBOOK BISA LIHAT GRAFIK </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="9" <?php if(in_array("9",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="10" <?php if(in_array("10",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="11" <?php if(in_array("11",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  <td style="vertical-align:middle;text-align:center;">
                    <div class="checkbox">
                      <label>
                      <input name="kesesuaian_bukti[]" value="12" <?php if(in_array("12",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                      </label>
                    </div>
                  </td>
                  </tr>
                  <tr>
                  <td colspan="6" style="vertical-align:middle;text-align:left;background: #800000;color:white;"><i class="fa fa-file-o"></i> ETIK PEGAWAI</td>
                  </tr>
                  <tr>
                  <td colspan="6">
                    <table width="100%" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Tanggal</th>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Hasil</th>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;">Penguji</th>
                          <th style="vertical-align:middle;text-align:center;font-weight:bold;background: #800000;color:white;"><i class="fa fa-search"></i></th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Tersedia</th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Shahih</th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Asli</th>
                          <th style="vertical-align:middle;text-align:center;width:5%;font-weight:bold;background: #800000;color:white;">Terkini</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        foreach($ambil_data_etik_pegawai_oppe as $rowambil_data_etik_pegawai_oppe){
                          if (in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai'],$id_etik_pegawai)) {
                      ?>
                        <tr>
                        <td style="vertical-align:middle;text-align:center;"><?php echo date('d-m-Y', strtotime($rowambil_data_etik_pegawai_oppe['tgl_etik_pegawai'])); ?></td>
                        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['hasil_etik']; ?></td>
                        <td style="vertical-align:middle;text-align:center;"><?php echo $rowambil_data_etik_pegawai_oppe['nama_pegawai']; ?></td>
                        <td style="vertical-align:middle;text-align:center;">

                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik1" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik1",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik2" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik2",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik3" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik3",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
                            </label>
                          </div>
                        </td>
                        <td style="vertical-align:middle;text-align:center;">
                          <div class="checkbox">
                            <label>
                            <input name="kesesuaian_bukti[]" value="<?php echo $rowambil_data_etik_pegawai_oppe['id_etik_pegawai']; ?>_etik4" <?php if(in_array($rowambil_data_etik_pegawai_oppe['id_etik_pegawai']."_etik4",$kesesuaian_bukti)) echo 'checked="checked"'; ?> type="checkbox">
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
                  </td>
                  </tr>
              </tbody>
            </table>
            <!-- /.table -->
            </div>
          </div>
          <div class="box-footer">
            <div class="mailbox-controls">
            <!-- Check all button -->
                <div class="pull-right">
                  <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                  <i class="fa fa-search"></i> KLIK BERKAS UNTUK MELIHAT BERKAS DAN UNCHECK UNTUK <i class="fa fa-trash"></i> MEMBUANG BERKAS
                  </button>
                </div>
            <!-- /.pull-right -->
            </div>
          </div>
        </div>    
      </div>       
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
  <h3 class="box-title">DAFTAR KOMPETENSI TERVALIDASI</h3>           
                <div class="box-tools pull-right">

                </div>
          </div>
          <div class="box-body">
            <table id="example2" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Waktu</th>
                <th style="background-color:#9b0e27;color:white;text-align:left;vertical-align: middle;">Kewenangan</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Jabatan</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Nama</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Hasil</th>
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align: middle;">Result Tolak</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_lobook_validasi_group_pengajuan as $row){
                ?>
              <tr>
                <td style="text-align:center;"><?php echo date('d-m-Y H:i:s', strtotime($row['wkt_logbook_validasi'])); ?></td>
                <td style="text-align:left;"><?php echo $row['nama_kewenangan']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_ms_struktur']; ?></td>
                <td style="text-align:center;"><?php echo $row['nama_pegawai']; ?></td>
                <td style="text-align:center;">
                  <?php  
                    if($row['validasi'] == 1){
                      echo '<button class="btn btn-xs btn-warning"> Setuju</button>';
                    }elseif($row['validasi'] == 2){
                      echo '<button class="btn btn-xs btn-danger"> Tolak</button>';
                    }else{
                      echo '<button class="btn btn-xs btn-success"> Proses</button>';
                    }
                  ?>
                </td>
                <td style="text-align:center;">
                  <?php  
                    if($row['result_tolak'] == 1){
                      echo '<button class="btn btn-xs btn-danger"> Supervisi</button>';
                    }elseif($row['result_tolak'] == 2){
                      echo '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
                    }else{
                      echo '';
                    }
                  ?>
                </td>
              </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>    
      </div>  
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
  <h3 class="box-title">DAFTAR SEMUA KOMPETENSI</h3>           
                <div class="box-tools pull-right">

                </div>
          </div>
          <div class="box-body">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Kewenangan</th>
                <th style="background-color:#9b0e27;color:white;text-align:right;">Jumlah</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($ambil_lobook_kompetensi_group_pengajuan as $row){
                ?>
              <tr>
                <td style="text-align:left;"><?php echo $row['nama_kewenangan']; ?></td>
                <td style="text-align:right;"><?php echo $row['num']; ?></td>
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
    </section>
</div>
<?php
}
elseif ($page=="direktur")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
    </section>
    <section class="content">
  <?php echo form_open_multipart('ol_admin_rs/direktur/view/'.$id,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">SEARCH</h3>
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
            <th style="display:none;"></th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Status Pegawai</th>
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
elseif ($page=="direktur_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/direktur/simpan_tambah');?>" onClick="return cek();">
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
                  <label>Nama</label>
                  <?php
                input_text("nama_direktur",$nama_direktur,"maxlength='60' required autofocus ","Ketik","text");
                  ?>  
              </div>          
              <div class="col-md-6">
                  <label>Gender</label>
                    <?php
                input_pdselect2("jk",$gender,$jk);
                    ?>          
              </div>    
              <div class="col-md-6">
                  <label>NIP</label>
                  <?php
                input_text("nip",$nip,"maxlength='25' required ","Ketik","text");
                  ?>  
              </div>          
              <div class="col-md-6">
                  <label>Status Pegawai</label>
                    <?php
                input_pdselect2("id_status_pegawai",$cmd_tipe_pegawai,$id_status_pegawai);
                    ?>          
              </div> 
              <div class="col-md-6">
                  <label>Instansi</label>
                  <?php
                 input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
                  ?>  
              </div>          
              <div class="col-md-6">
                  <label>Status</label>
                    <?php
                input_pdselect2("status_direktur",$cmd_status,$status_direktur);
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
elseif ($page=="direktur_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_admin_rs/direktur/simpan_edit');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
          <input type="hidden" name="id_direktur" value="<?= $id_direktur; ?>">
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
                  <label>Nama</label>
                  <?php
                input_text("nama_direktur",$nama_direktur,"maxlength='60' required autofocus ","Ketik","text");
                  ?>  
              </div>          
              <div class="col-md-6">
                  <label>Gender</label>
                    <?php
                input_pdselect2("jk",$gender,$jk);
                    ?>          
              </div>    
              <div class="col-md-6">
                  <label>NIP</label>
                  <?php
                input_text("nip",$nip,"maxlength='25' required ","Ketik","text");
                  ?>  
              </div>          
              <div class="col-md-6">
                  <label>Status Pegawai</label>
                    <?php
                input_pdselect2("id_status_pegawai",$cmd_tipe_pegawai,$id_status_pegawai);
                    ?>          
              </div> 
              <div class="col-md-6">
                  <label>Instansi</label>
                  <?php
                 input_pdselect2("id_instansi",$ambil_data_instansi,$id_instansi);
                  ?>  
              </div>          
              <div class="col-md-6">
                  <label>Status</label>
                    <?php
                input_pdselect2("status_direktur",$cmd_status,$status_direktur);
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