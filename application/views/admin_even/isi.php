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
elseif ($page=="even")
{
?>
<style>
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="col-md-9">
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
                  <th>&nbsp;</th>
                  <th style="display:none;">&nbsp;</th>
                  <th>Waktu</th>
                  <th>Nama Even</th>
                  <th>Alamat</th>
                  <th>Radius</th>
                  <th>Status</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
             <h3 class="box-title">EVEN / KEGIATAN</h3>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="box-body">
          <div class="box box-solid">
            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        Even
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse">
                    <div class="box-body">
                      <ul class="list-unstyled">
                        <li><strong>Even / Kegiatan :</strong>
                          <ul>
                            <li>Fitur even / kegiatan ini adalah untuk melengkapi even / kegiatan dengan absensi berdasarkan lokasi dan dapat dibuatkan laporannya untuk akreditasi</li>
                            <li>Anggota Even Bisa Dari User Program</li>
                            <li>Untuk User Program Bisa Input Di Program</li>
                            <li>Untuk User Diluar Program Daftarkan Manual</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#fitur">
                        Fungsi Fitur
                      </a>
                    </h4>
                  </div>
                  <div id="fitur" class="panel-collapse collapse">
                    <div class="box-body">
                      <ul class="list-unstyled">
                        <li><strong>Kegunaan fitur ini :</strong>
                          <ul>
                            <li>Rapat rutin bulanan</li>
                            <li>Absensi berdasarkan lokasi untuk semua seminar/workshop dll di lms</li>
                            <li>dll</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#radius">
                        Radius
                      </a>
                    </h4>
                  </div>
                  <div id="radius" class="panel-collapse collapse">
                    <div class="box-body">
                      <ul class="list-unstyled">
                        <li><strong>Penjelasan Radius :</strong>
                          <ul>
                            <li>Ya, absensi sesuai radius lokasi</li>
                            <li>0, bisa absensi dimana saja</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="panel box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#status">
                        Status
                      </a>
                    </h4>
                  </div>
                  <div id="status" class="panel-collapse collapse">
                    <div class="box-body">
                      <ul class="list-unstyled">
                        <li><strong>Penjelasan Status :</strong>
                          <ul>
                            <li>Proses, Tidak Bisa Melakukan Registrasi User</li>
                            <li>Pendaftaran, Sudah Bisa Melakukan Registrasi User</li>
                            <li>Mulai Acara, Tidak Bisa Melakukan Registrasi User dan Bisa Melakukan Absensi</li>
                            <li>Selesai, Tidak Bisa Merubah Data</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
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
elseif ($page=="even_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_even/even/simpan_tambah');?>" onClick="return cek();">
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
         <div class="col-md-3">
            <label>Tanggal Even</label>
            <?php
              input_calendar("tgl_even","tgl_even",$tgl_even,"Masukkan Tanggal"," required");
            ?>
        </div>
        <div class="col-md-3">
            <label>Jam Even</label>
            <?php
              input_calendar("time_even","time_even",$time_even,"Masukkan Jam"," required");
            ?>
        </div>
        <div class="col-md-6">
            <label>Nama Even</label>
            <?php
              input_text("nama_even",$nama_even,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Alamat Even</label>
            <?php
              input_text("alamat_even",$alamat_even,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div> 
        <div class="col-md-6">
            <label>Lokasi Google Maps (Absensi)</label>
            <?php
              input_text("location",$location,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div> 
        <div class="col-md-6">
            <label>Radius Lokasi (Set 0 untuk absen dimana saja)</label>
            <?php
                  input_textcustom("include_radius",$include_radius," required id='include_radius'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan Radius","text");
            ?>  
        </div>
        <div class="col-md-6">
            <label>Status Even</label>
            <?php
              input_pdselect2("status_even",$cmd_status_even,$status_even);
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
$("#time_even").inputmask("datetime", {
    mask: "h:s", 
    placeholder: "hh:mm"
});
$('#tgl_even').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_even").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }

  function showPosition(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;
    var latlong   = latitude + ', ' + longitude;
    $('#location').val(latlong);

/*    const map = L.map('map').setView([latitude, longitude], < ?= $setting->zoom_level; ?>);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: ''
    }).addTo(map);

    L.marker([latitude, longitude]).addTo(map)
      .bindPopup('My Location')
      .openPopup();

    var officeIcon = L.icon({
      iconUrl: '< ?= base_url('assets/img/icon/office-center.png'); ?>',

      iconSize:     [38, 95], // size of the icon
      shadowSize:   [50, 64], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    L.marker([< ?= $setting->location; ?>], {icon: officeIcon}).addTo(map)
      .bindPopup('< ?= $setting->company; ?>');

    L.circle([< ?= $setting->location; ?>], {
      color: 'blue',
      fillColor: 'blue',
      fillOpacity: 0.5,
      radius: < ?= $setting->radius; ?>
    }).addTo(map);*/
  }
$(document).ready(function() {
  $('.select2').select2()
}); 
</script>
<?php
}
elseif ($page=="even_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_even/even/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_even" value="<?= $id; ?>">
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
        <div class="col-md-3">
            <label>Tanggal Even</label>
            <?php
              input_calendar("tgl_even","tgl_even",$tgl_even,"Masukkan Tanggal"," required");
            ?>
        </div>
        <div class="col-md-3">
            <label>Jam Even</label>
            <?php
              input_calendar("time_even","time_even",$time_even,"Masukkan Jam"," required");
            ?>
        </div>
        <div class="col-md-6">
            <label>Nama Even</label>
            <?php
              input_text("nama_even",$nama_even,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Alamat Even</label>
            <?php
              input_text("alamat_even",$alamat_even,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div> 
        <div class="col-md-6">
            <label>Lokasi Google Maps (Absensi)</label>
            <?php
              input_text("location",$location,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div> 
        <div class="col-md-6">
            <label>Radius Lokasi (Set 0 untuk absen dimana saja)</label>
            <?php
                  input_textcustom("include_radius",$include_radius," required id='include_radius'
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                            "Masukkan Radius","text");
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Status Even</label>
            <?php
              input_pdselect2("status_even",$cmd_status_even,$status_even);
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
$("#time_even").inputmask("datetime", {
    mask: "h:s", 
    placeholder: "hh:mm"
});
$('#tgl_even').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_even").inputmask("datetime", {
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
elseif ($page=="acara")
{
?>
<style>
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
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
            <h3 class="box-title">DATA EVEN / ACARA</h3>
          </div>
          <div class="box-body">
        <div class="col-md-12">
            <h4>Nama Even : <?= $nama_even ?></h4> 
            <h4>Waktu Even : <?= $tgl_even ?> <?= $time_even ?></h4>  
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
                  <th>&nbsp;</th>
                  <th style="display:none;">&nbsp;</th>
                  <th>Waktu</th>
                  <th>Nama Even</th>
                  <th>Pembicara</th>
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
elseif ($page=="acara_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_even/acara/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
<input type="hidden" name="id_even" value="<?= $id; ?>">
          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><?php $title; ?></h3>
          </div>
          <div class="box-body">
         <div class="col-md-3">
            <label>Tanggal Acara</label>
            <?php
              input_calendar("tgl_even_detil","tgl_even_detil",$tgl_even_detil,"Masukkan Tanggal"," required");
            ?>
        </div>
        <div class="col-md-3">
            <label>Jam Acara</label>
            <?php
              input_calendar("time_even_detil","time_even_detil",$time_even_detil,"Masukkan Jam"," required");
            ?>
        </div>
        <div class="col-md-6">
            <label>Pembicara</label>
            <?php
              input_text("speaker_even_detil",$speaker_even_detil,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div> 
        <div class="col-md-12">
            <label>Nama Acara</label>
            <?php
              input_text("nama_even_detil",$nama_even_detil,"maxlength='255' required","Masukkan Nama","text");
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
$("#time_even_detil").inputmask("datetime", {
    mask: "h:s", 
    placeholder: "hh:mm"
});
$('#tgl_even_detil').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_even_detil").inputmask("datetime", {
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
elseif ($page=="acara_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_even/acara/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_even" value="<?= $id_even; ?>">
    <input type="hidden" name="id_even_detil" value="<?= $id_even_detil; ?>">
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
         <div class="col-md-3">
            <label>Tanggal Acara</label>
            <?php
              input_calendar("tgl_even_detil","tgl_even_detil",$tgl_even_detil,"Masukkan Tanggal"," required");
            ?>
        </div>
        <div class="col-md-3">
            <label>Jam Acara</label>
            <?php
              input_calendar("time_even_detil","time_even_detil",$time_even_detil,"Masukkan Jam"," required");
            ?>
        </div>
        <div class="col-md-6">
            <label>Pembicara</label>
            <?php
              input_text("speaker_even_detil",$speaker_even_detil,"maxlength='255' required","Masukkan Nama","text");
            ?>  
        </div> 
        <div class="col-md-12">
            <label>Nama Acara</label>
            <?php
              input_text("nama_even_detil",$nama_even_detil,"maxlength='255' required","Masukkan Nama","text");
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
$("#time_even_detil").inputmask("datetime", {
    mask: "h:s", 
    placeholder: "hh:mm"
});
$('#tgl_even_detil').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_even_detil").inputmask("datetime", {
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
elseif ($page=="hasil")
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
           <h3 class="box-title">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-success" > <i class="fa fa-reply"></i> Kembali
    </a>
           </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
      <?php echo form_open_multipart('admin_even/hasil',' id="signupform" ');
        input_text("id_even_detil",$id_even_detil,"","","hidden");
      ?>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $title; ?></h3>
      </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <label>Hasil</label>
            <?php
              input_textareacustom("hasil_even_detil",$hasil_even_detil," id='editor1' rows='5' cols='50' class='form-control' ","");
            ?>  
          </div>  
          <div class="col-md-12">
            <label>Kesimpulan</label>
            <?php
      input_textareacustom("kesimpulan_even_detil",$kesimpulan_even_detil," id='editor2' rows='5' cols='50' class='form-control' ","");
            ?>  
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
elseif ($page=="peserta")
{
?>
<style>
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
  .rainbow-text {
    background-image: linear-gradient(to left, violet, indigo, blue, green, yellow, orange, red);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
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
            <h3 class="box-title">DATA EVEN / ACARA</h3>
          </div>
          <div class="box-body">
        <div class="col-md-12">
            <h4>Nama Even : <?= $nama_even ?></h4> 
            <h4>Waktu Even : <?= $tgl_even ?> <?= $time_even ?></h4>  
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
                  <th>&nbsp;</th>
                  <th>Nama</th>
                  <th>Umur</th>
                  <th>NIK</th>
                  <th>No HP</th>
                  <th>Email</th>
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
elseif ($page=="peserta_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_even/peserta/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">
      <input type="hidden" name="id_even" value="<?= $id_even; ?>">
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
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Data User</th>
              </tr>
              </thead>
              <tbody>
                <?php
      /*          $arr = array();
                foreach($kewenangan_bk as $val){
                    $arr[] = $val['id_kewenangan'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($pegawaiee as $row){
                 if(in_array($row['barcode_pegawai'],explode(",", $peserta_even))){ 
                  $checked = "checked='checked'";
                 }else{
                  $checked = "";
                 }
                ?>
              <tr>
                <td style="vertical-align:middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['barcode_pegawai'];?>" <?= $checked?> >
                  </label>
                  </div>
                </td>
                <td style="vertical-align:middle;"><?php echo $row['nama_pegawai']; ?></td>
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