<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$arraybg = array('navy','yellow','maroon','olive','purple','red','aqua','light-blue','blue',
					'green','teal','lime','orange','fuchsia');
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
elseif ($page=="kategori")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_kembali;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pendaftaran
    </a> ||
    <a href="<?php echo $link_1;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kategori Tindakan
    </a> ||
    <a href="<?php echo $link_2;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Tindakan / Pemeriksaan
    </a> ||
    <a href="<?php echo $link_3;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Input Stok
    </a>
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
            <th>Ruangan / Unit</th>
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/kategori/simpan_tambah');?>" onClick="return cek();">
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
                    input_text("nama_golongan_pemeriksaan",$nama_golongan_pemeriksaan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-3">
            <label>Unit</label>
            <?php
              input_pdselect2("id_unit",$cmd_unit,$id_unit);
            ?>  
        </div>  
        <div class="col-md-3">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/kategori/simpan_edit');?>" onClick="return cek();">
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
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_golongan_pemeriksaan",$nama_golongan_pemeriksaan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-3">
            <label>Unit</label>
            <?php
              input_pdselect2("id_unit",$cmd_unit,$id_unit);
            ?>  
        </div>  
        <div class="col-md-3">
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
    <a href="<?php echo $link_kembali;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pendaftaran
    </a> ||
    <a href="<?php echo $link_1;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kategori Tindakan
    </a> ||
    <a href="<?php echo $link_2;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Tindakan / Pemeriksaan
    </a> ||
    <a href="<?php echo $link_3;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Input Stok
    </a>
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
            <th style="text-align:right;">Harga</th>
            <th>Ruangan / Unit</th>
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/tindakan/simpan_tambah');?>" onClick="return cek();">
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
                    input_text("nama_tindakan",$nama_tindakan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Golongan Pemeriksaan</label>
            <?php
              input_pdselect2("id_golongan_pemeriksaan",$cmd_golongan,$id_golongan_pemeriksaan);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Tarif Tindakan</label>
            <?php
                input_textcustom("tarif",$tarif," style='text-align:right;' required id='tanpa-rupiah'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                          "Harga","text");  
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
function formatRupiah(angka, prefix)
{
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa  = split[0].length % 3,
    rupiah  = split[0].substr(0, sisa),
    ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
var tanpa_rupiah = document.getElementById('tanpa-rupiah');
tanpa_rupiah.addEventListener('keyup', function(e)
{
  tanpa_rupiah.value = formatRupiah(this.value);
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/tindakan/simpan_edit');?>" onClick="return cek();">
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
              <div class="col-md-6">
                  <label>Nama</label>
                  <?php
                    input_text("nama_tindakan",$nama_tindakan,"maxlength='255' required autofocus","Masukkan Nama","text");
                  ?>  
              </div>  
        <div class="col-md-6">
            <label>Golongan Pemeriksaan</label>
            <?php
              input_pdselect2("id_golongan_pemeriksaan",$cmd_golongan,$id_golongan_pemeriksaan);
            ?>  
        </div>  
        <div class="col-md-6">
            <label>Tarif Tindakan</label>
            <?php
                input_textcustom("tarif",$tarif," style='text-align:right;' required id='tanpa-rupiah'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                          "Harga","text");  
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
function formatRupiah(angka, prefix)
{
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa  = split[0].length % 3,
    rupiah  = split[0].substr(0, sisa),
    ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
var tanpa_rupiah = document.getElementById('tanpa-rupiah');
tanpa_rupiah.addEventListener('keyup', function(e)
{
  tanpa_rupiah.value = formatRupiah(this.value);
});
</script>
<?php
}
elseif ($page=="pendaftaran")
{
?>
<style media="screen">
table.dataTable tbody tr.selected {
  background-color: #0088cc !important;
  color: white !important;
  border: 1px solid #2083eb;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
.anyClass {
  height:500px;
  overflow-y: scroll;
}
.bolded {
  font-weight:bold;
}
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
    <a href="<?php echo $link_kembali;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pendaftaran
    </a> ||
    <a href="<?php echo $link_1;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kategori Tindakan
    </a> ||
    <a href="<?php echo $link_2;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Tindakan / Pemeriksaan
    </a> ||
    <a href="<?php echo $link_3;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Input Stok
    </a>
      </h1>
    </section>
      <?php echo form_open_multipart('ol_pendaftaran/pendaftaran/view/'.$id.'/'.$last_date.'/'.$key,' id="signupform" ');
      ?>   
    <section class="content">
      <div class="box">
        <div class="box-body">
    <div class="col-md-12">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <button type="submit" name="action" value="BtnProses" class="btn btn-primary btn-xs pull-left"><i class="fa fa-recycle"></i> Proses</button>
    </div>
        <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tanggal Awal</label>
                <?php
                  input_calendar("id","id",$id,"Masukkan Tanggal Transaksi","required");
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
          <div class="col-md-12">
            <div class="form-group">
            <label> Ketik multiple pisahkan dengan spasi untuk Nama Pasien dan RM</label>
              <?php
                input_text("key",$key," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
                <h3 class="box-title">DATA TANGGAL <?= $this->m_rancak->fullBulan($id) .' &nbsp;S/D&nbsp; '. $this->m_rancak->fullBulan($last_date) ?></h3>
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
                      <th style="width:5%;display: none;"></th>
                      <th style="width:10%;">Tanggal</th>
                      <th style="text-align: center;">Pasien</th>
                      <th>Pemeriksaan</th>
                      <th>Ruangan</th>
                      <th>Pengirim</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>

        
   </div>
        </div>
      </div>
    </section>
    <?php echo form_close(); ?>   
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
elseif ($page=="pendaftaran_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah');?>" onClick="return cek();">
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
            <div class="col-md-4">
              <label>Tanggal</label>
              <?php
                input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal","");
              ?>  
            </div>
            <div class="col-md-4">
              <label>No Transaksi</label>
              <?php
                input_text("no_transaksi",$no_transaksi," ","Masukkan No Transaksi","text");
              ?>  
            </div> 
              <div class="col-md-4">
                  <label for="autocomplete">RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text");
                  ?>
              </div>
              <div class="col-md-4">
                  <label for="autocomplete">Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div> 
            <div class="col-md-6">
              <label>Alamat</label>
              <?php
                input_text("alamat",$alamat," ","Masukkan Alamat Pasien","text");
              ?>  
            </div> 
            <div class="col-md-6">
              <label>Unit Transaksi</label>
              <?php
                input_pdselect2("unit_tindakan",$ambil_unit_transaksi,$unit_tindakan);
              ?>  
            </div>
            <div class="col-md-12">
              <label>Pemeriksaan</label>
              <?php
                input_pdselect2("id_tindakan",$ambil_pemeriksaan,$id_tindakan);
              ?>  
            </div> 
            <div class="col-md-12">
              <label>Data Penunjang</label>
                <?php
                  input_textareacustom("data_transaksi",$data_transaksi," id='editor1' rows='5' cols='100' class='form-control' ","");
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    $('#tgl_transaksi').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
  $("#tgl_transaksi").inputmask("datetime", {
    mask: "1-2-y", 
    placeholder: "dd-mm-yyyy", 
    leapday: "-02-29", 
    separator: "-", 
    alias: "dd/mm/yyyy"
  });
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>ol_pendaftaran/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>ol_pendaftaran/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="pendaftaran_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { display: block; border-bottom: 1px solid #000; } 
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
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
            <div class="col-md-4">
              <label>Tanggal</label>
              <?php
                input_calendar("tgl_transaksi","tgl_transaksi",$tgl_transaksi,"Masukkan Tanggal","");
              ?>  
            </div>
            <div class="col-md-4">
              <label>No Transaksi</label>
              <?php
                input_text("no_transaksi",$no_transaksi," ","Masukkan No Transaksi","text");
              ?>  
            </div> 
              <div class="col-md-4">
                  <label for="autocomplete">RM</label>
                  <?php
                 input_textcustom("rm",$rm," maxlength='15' id='rm'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control autocomplete'",
                          "RM","text");
                  ?>
              </div>
              <div class="col-md-4">
                  <label for="autocomplete">Nama Pasien</label>
                  <?php
                input_textcustom("nama_pasien",$nama_pasien," maxlength='70' id='nama_pasien'
                      class='form-control autocomplete'",
                          "Cari RM / Nama Pasien","text"); 
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Tanggal Lahir</label>
                  <?php
                 input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal","");  
                  ?>
              </div>
              <div class="col-md-4">
                  <label>Jenis Kelamin</label>
                  <?php
                 input_pd("jk",$cmd_jk,$jk);
                  ?>
              </div> 
            <div class="col-md-6">
              <label>Alamat</label>
              <?php
                input_text("alamat",$alamat," ","Masukkan Alamat Pasien","text");
              ?>  
            </div> 
            <div class="col-md-6">
              <label>Unit Transaksi</label>
              <?php
                input_pdselect2("unit_tindakan",$ambil_unit_transaksi,$unit_tindakan);
              ?>  
            </div>
            <div class="col-md-8">
              <label>Pemeriksaan</label>
              <?php
                input_pdselect2("id_tindakan",$ambil_pemeriksaan,$id_tindakan);
              ?>  
            </div> 
        <div class="col-md-4">
            <label>Tarif Tindakan</label>
            <?php
                input_textcustom("harga_transaksi",$harga_transaksi," style='text-align:right;' required id='tanpa-rupiah'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                          "Harga","text");  
            ?>  
        </div>
            <div class="col-md-12">
              <label>Data Penunjang</label>
                <?php
                  input_textareacustom("data_transaksi",$data_transaksi," id='editor1' rows='5' cols='100' class='form-control' ","");
                ?>  
            </div>
        </div>
      </div>
        </div>
        <div class="box-footer">
            <?php  
              if($cek > 0){
            ?>
      <button type="submit" class="btn btn-primary">Submit</button>
            <?php  
              }
            ?>
        </div>
      </div>
    </FORM>
<script type="text/javascript">
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    $('#tgl_transaksi').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
  $("#tgl_transaksi").inputmask("datetime", {
    mask: "1-2-y", 
    placeholder: "dd-mm-yyyy", 
    leapday: "-02-29", 
    separator: "-", 
    alias: "dd/mm/yyyy"
  });
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
function formatRupiah(angka, prefix)
{
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa  = split[0].length % 3,
    rupiah  = split[0].substr(0, sisa),
    ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
var tanpa_rupiah = document.getElementById('tanpa-rupiah');
tanpa_rupiah.addEventListener('keyup', function(e)
{
  tanpa_rupiah.value = formatRupiah(this.value);
});
$(document).ready(function() {
  $('.select2').select2()
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>ol_pendaftaran/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>ol_pendaftaran/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
});
</script>
<?php
}
elseif ($page=="pendaftaran_master")
{
?>
<style>
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
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
    <a href="<?php echo $link_kembali;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pendaftaran
    </a> ||
    <a href="<?php echo $link_1;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kategori Tindakan
    </a> ||
    <a href="<?php echo $link_2;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Tindakan / Pemeriksaan
    </a> ||
    <a href="<?php echo $link_3;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Input Stok
    </a>
      </h1>
    </section>

    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">MASTER KELENGKAPAN DATA</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="col-md-4">
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">KATEGORI BARANG</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-primary btn-xs TambahKatBar" data-toggle="tooltip" data-placement="right" 
                title="Tambah Data" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah
              </button>
              </div>
            </div>
              <div class="box-body">
              <div class="box-header with-border">
                <div class="form-group">
                  <div id="table-scroll" class="table-scroll">
                  <table id="katbang" width="100%" class="table table-bordered table-striped main-table">
                    <thead class="header">
                      <tr>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Nama Kategori</th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;"><i class="fa fa-pencil"></i></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;"><i class="fa fa-close"></i></th>
                      </tr>
                    </thead>
                    <tbody class="scrollable">
                      <?php
                        $no = 0;
                        foreach($katbarang as $rowkatbarang){
                          $no++;
                      ?>
                    <tr>
                        <td style="vertical-align:middle;text-align: center;"><?php echo $rowkatbarang['nama_kategori_barang']; ?></td>
                        <td style="vertical-align:middle;text-align: center;">
<button type="button" class="btn btn-success btn-xs EditKatBar" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $id ?>" data-id2="<?= $rowkatbarang['id_kategori_barang'] ?>">
                <i class="fa fa-pencil"></i></button>
                        </td>
                        <td style="vertical-align:middle;text-align: center;">
    <a href="<?= base_url('ol_pendaftaran/pendaftaran/hapuskatbang/') ?><?= $id ?>/<?= $rowkatbarang['id_kategori_barang'] ?>" title="Hapus Data" class="btn btn-danger btn-xs"  onclick="confirmation(event)" > <i class="fa fa-trash-o"></i>
    </a> 
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
          </div> 
          <div class="col-md-4">
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">INPUT BARANG</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-primary btn-xs TambahBar" data-toggle="tooltip" data-placement="right" 
                title="Tambah Data" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah
              </button>
              </div>
            </div>
              <div class="box-body">
              <div class="box-header with-border">
                <div class="form-group">
                  <div id="table-scroll" class="table-scroll">
                  <table id="Bang" width="100%" class="table table-bordered table-striped main-table">
                    <thead class="header">
                      <tr>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Nama Barang</th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;"><i class="fa fa-pencil"></i></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;"><i class="fa fa-close"></i></th>
                      </tr>
                    </thead>
                    <tbody class="scrollable">  
                      <?php
                        $no = 0;
                        foreach($barang as $rowbarang){
                          $no++;
                      ?>
                    <tr>
                        <td style="vertical-align:middle;text-align: center;"><?php echo $rowbarang['nama_barang']; ?></td>
                        <td style="vertical-align:middle;text-align: center;">
<button type="button" class="btn btn-success btn-xs EditBar" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $id ?>" data-id2="<?= $rowbarang['id_barang'] ?>">
                <i class="fa fa-pencil"></i></button>
                        </td>
                        <td style="vertical-align:middle;text-align: center;">
    <a href="<?= base_url('ol_pendaftaran/pendaftaran/hapusbang/') ?><?= $id ?>/<?= $rowbarang['id_barang'] ?>" title="Hapus Data" class="btn btn-danger btn-xs"  onclick="confirmation(event)" > <i class="fa fa-trash-o"></i>
    </a> 
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
          </div> 
          <div class="col-md-4">
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">DATA STOK BARANG</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-primary btn-xs TambahStok" data-toggle="tooltip" data-placement="right" 
                title="Tambah Data" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah
              </button>
              </div>
            </div>
              <div class="box-body">
              <div class="box-header with-border">
                <div class="form-group">
                  <div id="table-scroll" class="table-scroll">
                  <table id="Stok" width="100%" class="table table-bordered table-striped main-table">
                    <thead class="header">
                      <tr>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Nama Barang</th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Stok</th>
                      </tr>
                    </thead>
                    <tbody class="scrollable"> 
                      <?php
                        $no = 0;
                        foreach($ambil_stok as $rowambil_stok){
                          $no++;
                      ?>
                    <tr>
                        <td style="vertical-align:middle;text-align: center;"><?php echo $rowambil_stok['nama_barang']; ?></td>
                        <td style="vertical-align:middle;text-align: center;"><?php echo $rowambil_stok['jml_stok']; ?></td>
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
          </div>  
          <div class="col-md-12">
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">DATA KELENGKAPAN</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-primary btn-xs TambahHasil" data-toggle="tooltip" data-placement="right" 
                title="Tambah Data" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah
              </button>
              </div>
            </div>
              <div class="box-body">
              <div class="box-header with-border">
                <div class="form-group">
                  <div id="table-scroll" class="table-scroll">
                  <table id="main-table" width="100%" class="table table-bordered table-striped main-table">
                    <thead class="header">
                      <tr>
                      <th colspan="4" style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">Nama Kelengkapan</th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width:5%;"><i class="fa fa-pencil"></i></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width:5%;"><i class="fa fa-close"></i></th>
                      </tr>
                    </thead>
                    <tbody class="scrollable">  
                      <?php
                        foreach($hasil as $rowhasil){
                      ?>
                    <tr>
                        <td colspan="4" style="vertical-align:middle;text-align: center;"><?php echo $rowhasil['nama_hasil']; ?></td>
                        <td style="vertical-align:middle;text-align: center;">
<button type="button" class="btn btn-success btn-xs EditHasil" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $id ?>" data-id2="<?= $rowhasil['id_hasil'] ?>">
                <i class="fa fa-pencil"></i></button>
                        </td>
                        <td style="vertical-align:middle;text-align: center;">
    <a href="<?= base_url('ol_pendaftaran/pendaftaran/hapushasil/') ?><?= $id ?>/<?= $rowhasil['id_hasil'] ?>" title="Hapus Data" class="btn btn-danger btn-xs"  onclick="confirmation(event)" > <i class="fa fa-trash-o"></i>
    </a> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="vertical-align:middle;text-align: left;">
<button type="button" class="btn btn-success btn-xs PFHasil" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $rowhasil['id_hasil'] ?>">
                <i class="fa fa-plus"></i> Tambah Format Hasil (Jika Ada)
                        </td>
                    </tr>
                      <?php
                          $fhasile = $this->m_ol_rancak->ambil_data_tindakan_fhasil($rowhasil['id_hasil']);
                          foreach($fhasile as $rowfhasile){
                          $format_fhasil = strip_tags($rowfhasile['format_fhasil']); 
                          $format_fhasil = html_entity_decode($format_fhasil);
                      ?>
                      <tr>
                      <td style="vertical-align:middle;text-align: center;width: 5%;">&nbsp;</td>
                      <td style="vertical-align:middle;text-align: left;">
                        <?= $rowfhasile['nama_fhasil'] ?>
                      </td>
                      <td style="vertical-align:middle;text-align: center;width: 5%;">
<button type="button" class="btn btn-info btn-xs EditFhasil" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $rowfhasile['id_fhasil'] ?>">
                <i class="fa fa-pencil"></i></button>
                      </td>
                      <td style="vertical-align:middle;text-align: center;width: 5%;">
    <a href="<?= base_url('ol_pendaftaran/pendaftaran/hapusFhasil/') ?><?= $rowfhasile['id_fhasil'] ?>" title="Hapus Data" class="btn btn-danger btn-xs"  onclick="confirmation(event)" > <i class="fa fa-trash-o"></i>
    </a> 
                      </td>
                      <td style="vertical-align:middle;text-align: center;">&nbsp;</td>
                      <td style="vertical-align:middle;text-align: center;">&nbsp;</td>
                    </tr>
                    <tr>
                      <td style="vertical-align:middle;text-align: center;width: 5%;">&nbsp;</td>
                      <td colspan="3" style="vertical-align:middle;text-align: left;"><?= $format_fhasil ?></td>
                    </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                </div>
              </div>          
              </div>
            </div>      
          </div> 
        </div>
        <div class="box-footer">
          <div class="col-md-4">
          <label>Kategori Barang</label><br>
             <ul>
              <li>Buatlah kategori barang sebelum mengisi barang habis pakai tujuannya untuk memudahkan pengelompokkan</li>
              <li>Contoh : Saat akan membuat BAKHP Iopamiro (Bahan Kontras untuk imging), kita membuat kategori di unit Radiologi dengan nama Bahan Kontras</li>
            </ul>
          </div>
          <div class="col-md-4">
          <label>Input Barang</label><br>
             <ul>
              <li>Setelah dibuat kategori maka dibuatkan data barang beserta merk dan data lainnya</li>
              <li>Contoh : Ketik Nama Barang Habis Pakai misal Iopamiro 350 uk 100ml dengan Kategori Bahan Kontras, isi juga satuannya</li>
            </ul>
          </div>
          <div class="col-md-4">
          <label>Data Stok Barang</label><br>
             <ul>
              <li>Masukkan Jumlah pemasukkan sesuai barang yang dipakai, ini baru masuk ke stok tapi bila ingin langsung di masukkan ke pemakaian barang, bisa klik Data langsung masuk daftar pemakaian barang habis pakai</li>
            </ul>
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
elseif ($page=="pendaftaran_tambah_fhasil")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah_fhasil');?>" onClick="return cek();">
      <input type="hidden" name="id_hasil" value="<?= $id; ?>">
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
                input_text("nama_fhasil",$nama_fhasil,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>  
          </div>   
          <div class="col-md-6">
              <label>Status</label>
              <?php
                input_pdselect2("status_fhasil",$cmd_status,$status_fhasil);
              ?>  
          </div>
          <div class="col-md-12">
              <label>Format Hasil</label>
              <?php
                  input_textareacustom("format_fhasil",$format_fhasil," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Text"); 
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="pendaftaran_edit_fhasil")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit_fhasil');?>" onClick="return cek();">
      <input type="hidden" name="id_fhasil" value="<?= $id_fhasil; ?>">
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
                input_text("nama_fhasil",$nama_fhasil,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>  
          </div>   
          <div class="col-md-6">
              <label>Status</label>
              <?php
                input_pdselect2("status_fhasil",$cmd_status,$status_fhasil);
              ?>  
          </div>
          <div class="col-md-12">
              <label>Format Hasil</label>
              <?php
                  input_textareacustom("format_fhasil",$format_fhasil," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Text"); 
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="pendaftaran_tambah_katbang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah_katbang');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
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
          <div class="col-md-4">
              <label>Nama</label>
              <?php
                input_text("nama_kategori_barang",$nama_kategori_barang,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>  
          </div>   
          <div class="col-md-4">
              <label>Unit</label>
              <?php
                input_pdselect2("id_unit",$ambil_all_unit_ins,$id_unit);
              ?>  
          </div>
          <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_kategori_barang",$cmd_status,$status_kategori_barang);
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
elseif ($page=="pendaftaran_edit_katbang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit_katbang');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_kategori_barang" value="<?= $id_kategori_barang; ?>">
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
          <div class="col-md-4">
              <label>Nama</label>
              <?php
                input_text("nama_kategori_barang",$nama_kategori_barang,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>  
          </div>   
          <div class="col-md-4">
              <label>Unit</label>
              <?php
                input_pdselect2("id_unit",$ambil_all_unit_ins,$id_unit);
              ?>  
          </div>
          <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_kategori_barang",$cmd_status,$status_kategori_barang);
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
elseif ($page=="pendaftaran_tambah_bang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah_bang');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
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
              <label>Nama</label>
              <?php
                input_text("nama_barang",$nama_barang,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>  
          </div>   
          <div class="col-md-3">
              <label>Kategori</label>
              <?php
                input_pdselect2("id_kategori_barang",$ambil_katbang,$id_kategori_barang);
              ?>  
          </div>
          <div class="col-md-3">
              <label>Satuan</label>
              <?php
                input_text("satuan_barang",$satuan_barang,"maxlength='30' required autofocus","Masukkan Nama","text");
              ?>  
          </div> 
          <div class="col-md-3">
              <label>Status</label>
              <?php
                input_pdselect2("status_barang",$cmd_status,$status_barang);
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
elseif ($page=="pendaftaran_edit_bang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit_bang');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
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
              <label>Nama</label>
              <?php
                input_text("nama_barang",$nama_barang,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>  
          </div>   
          <div class="col-md-3">
              <label>Kategori</label>
              <?php
                input_pdselect2("id_kategori_barang",$ambil_katbang,$id_kategori_barang);
              ?>  
          </div>
          <div class="col-md-3">
              <label>Satuan</label>
              <?php
                input_text("satuan_barang",$satuan_barang,"maxlength='30' required autofocus","Masukkan Nama","text");
              ?>  
          </div> 
          <div class="col-md-3">
              <label>Status</label>
              <?php
                input_pdselect2("status_barang",$cmd_status,$status_barang);
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
elseif ($page=="pendaftaran_tambah_stok")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah_stok');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
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
          <div class="col-md-10">
              <label>Nama Barang Habis Pakai</label>
              <?php
                input_pdselect2("id_barang",$ambil_tinbang,$id_barang);
              ?>  
          </div>
          <div class="col-md-2">
              <label>Jumlah</label>
              <?php
                  input_textcustom("jml_stok",$jml_stok," style='text-align:right;' required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                            "Jumlah","text");  
              ?>  
          </div>
      <!--    <div class="col-sm-offset-2 col-sm-10"> 
          <div class="col-md-10">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="chkpakai" checked='checked'> Data Langsung Digunakan / Masuk Daftar Pemasukkan Barang Habis Pakai
              </label>
            </div>
          </div>-->
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
elseif ($page=="pendaftaran_edit_stok")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit_stok');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_stok" value="<?= $id_stok; ?>">
      <input type="hidden" name="id_stok_lama" value="<?= $id_stok; ?>">
      <input type="hidden" name="id_barang_lama" value="<?= $id_barang; ?>">
      <input type="hidden" name="jml_stok_lama" value="<?= $jml_stok; ?>">
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
          <div class="col-md-10">
              <label>Nama Barang Habis Pakai</label>
              <?php
                input_pdselect2("id_barang",$ambil_tinbang,$id_barang);
              ?>  
          </div>
          <div class="col-md-2">
              <label>Jumlah</label>
              <?php
                  input_textcustom("jml_stok",$jml_stok," style='text-align:right;' required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                            "Jumlah","text");  
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
elseif ($page=="pendaftaran_tambah_hasil")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah_hasil');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
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
          <div class="col-md-4">
              <label>Nama</label>
              <?php
                input_text("nama_hasil",$nama_hasil,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>  
          </div>   
          <div class="col-md-4">
              <label>Unit</label>
              <?php
                input_pdselect2("id_unit",$ambil_all_unit_ins,$id_unit);
              ?>  
          </div>
          <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_hasil",$cmd_status,$status_hasil);
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="pendaftaran_edit_hasil")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit_hasil');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_hasil" value="<?= $id_hasil; ?>">
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
          <div class="col-md-4">
              <label>Nama</label>
              <?php
                input_text("nama_hasil",$nama_hasil,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>  
          </div>   
          <div class="col-md-4">
              <label>Unit</label>
              <?php
                input_pdselect2("id_unit",$ambil_all_unit_ins,$id_unit);
              ?>  
          </div>
          <div class="col-md-4">
              <label>Status</label>
              <?php
                input_pdselect2("status_hasil",$cmd_status,$status_hasil);
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
elseif ($page=="pendaftaran_tambah_operator")
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
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
}
</style>
      <div class="row">
        <div class="col-md-12">
    <FORM method="POST" class="form-horizontal" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah_operator');?>" onClick="return cek();">
          <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
          <input type="hidden" name="status_transaksi" value="<?= $status_transaksi; ?>">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
        <div class="col-md-12">
          <div id="table-scroll" class="table-scroll">
            <table id="main-table" class="table table-bordered table-striped main-table">
              <thead class="header">
              <tr>
                  <tr>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;">
                    <input name="select_all" class="checkall" type="checkbox" />
                  </th>
                  <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Nama</th>
                  </tr>
              </thead>
              <tbody class="scrollable">   
                <?php
/*                $arr = array();
                foreach($ope as $val){
                    $arr[] = $val['id_pegawai'];
                }
                $eimplo = implode(",", $arr);*/
                  foreach($data_operator as $row){
                ?>
              <tr>
                  <td style="vertical-align:middle;width:5%;text-align: center;">
                    <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['barcode_pegawai'];?>" >
                  </label>
                    </div>        
                  </td>
                  <td style="vertical-align:middle;"><?php echo $row['nama_pegawai'];?></td>
              </tr> 
                <?php
                  }
                ?>
              </tbody>
            </table>
            </tr> 
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
/*    $('#Operat0r').DataTable({
      "initComplete": function (settings, json) {  
      $("#Operat0r").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
      },
    'paging'        : false,
    'lengthChange'  : false,
    'searching'     : true,
    'ordering'      : false,
    'info'          : true,
  //      'scrollX'     : true,
    'scrollY'   : '200px',
    'scrollCollapse'  : true
    })
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#Operat0r').DataTable();
           table.columns.adjust();
    });*/
  });
</script>
<?php
}
elseif ($page=="pendaftaran_tambah_kewenangan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah_kewenangan');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_operator" value="<?= $last_date; ?>">
      <input type="hidden" name="rm" value="<?= $rm; ?>">
      <input type="hidden" name="id_pasien" value="<?= $id_pasien; ?>">
      <input type="hidden" name="tgl_transaksi" value="<?= $tgl_transaksi; ?>">
      <input type="hidden" name="admin_operator" value="<?= $admin_operator; ?>">
      <input type="hidden" name="status_transaksi" value="<?= $status_transaksi; ?>">
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
              <label>Kewenangan / Tindakan</label>
              <?php
                input_pdselect2("id_kewenangan",$kewenangan,$id_kewenangan);
              ?>  
          </div>
          <div class="col-md-3">
              <label>Jumlah Tindakan</label>
              <?php
                input_textcustom("jml_logbook",$jml_logbook," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                          "Jumlah Tindakan","text");  
              ?>  
          </div>
              <div class="col-md-4">
                  <label>Sifat</label>
                        <?php
                          input_pdselect2("id_sifat_kewenangan",$sifat,$id_sifat_kewenangan);
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
elseif ($page=="pendaftaran_edit_kewenangan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit_kewenangan');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_logbook" value="<?= $id_logbook; ?>">
      <input type="hidden" name="status_transaksi" value="<?= $status_transaksi; ?>">
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
              <label>Kewenangan / Tindakan</label>
              <?php
                input_pdselect2("id_kewenangan",$kewenangan,$id_kewenangan);
              ?>  
          </div>
          <div class="col-md-3">
              <label>Jumlah Tindakan</label>
              <?php
                input_textcustom("jml_logbook",$jml_logbook," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                          "Jumlah Tindakan","text");  
              ?>  
          </div>
              <div class="col-md-4">
                  <label>Sifat</label>
                        <?php
                          input_pdselect2("id_sifat_kewenangan",$sifat,$id_sifat_kewenangan);
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
elseif ($page=="pendaftaran_isi")
{
?>
<style>
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
/*  border: 1px solid #000; */
  background: #fff;
  vertical-align: top;
}
.table-scroll thead th {
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
}
thead th:first-child,
tfoot th:first-child {
  z-index: 5;
} 
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
    <a href="<?php echo $link_kembali;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Pendaftaran
    </a> ||
    <a href="<?php echo $link_1;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Kategori Tindakan
    </a> ||
    <a href="<?php echo $link_2;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Tindakan / Pemeriksaan
    </a> ||
    <a href="<?php echo $link_3;?>"
      class="btn bg-<?php echo $arraybg[array_rand($arraybg)]; ?> btn-sm" > <i class="fa fa-reply"></i> Input Stok
    </a>
      </h1>
    </section>
    <section class="content">
      <?php echo form_open_multipart('ol_pendaftaran/pendaftaran/isi/'.$id,' id="signupform" '); ?>   
      <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12" style="margin-bottom: 15px;font-size: 14px;">
              <div class="col-md-2">
              <label>Tanggal</label><br>
              <?= $this->m_rancak->fullBulan($tgl_transaksi) ?>  
              </div>
              <div class="col-md-2">
              <label>No Transaksi</label><br>
              <?= $no_transaksi ?>
              </div> 
              <div class="col-md-2">
              <label>Tarif Tindakan</label><br>
              <?= $harga_transaksi ?>  
              </div>
              <div class="col-md-2">
              <label>Unit Transaksi</label><br>
              <?= $nama_unit ?>  
              </div>
              <div class="col-md-4">
              <label>Pemeriksaan</label><br>
              <?= $nama_tindakan ?>  
              </div>
            </div>
            <div class="col-md-12" style="margin-bottom: 15px;font-size: 14px;">
              <div class="col-md-1">
              <label for="autocomplete">RM</label><br>
              <?= $rm ?>  
              </div>
              <div class="col-md-3">
              <label for="autocomplete">Nama Pasien</label><br>
              <?= $nama_pasien ?>  
              </div>
              <div class="col-md-3">
              <label>Tanggal Lahir</label><br>
              <?= $this->m_rancak->fullBulan($tgl_lahir) ?> 
              <b>[
              <?php
                $birthage = $tgl_lahir;
                $interval = date_diff(date_create($tgl_transaksi), date_create($birthage));
                $umur = $interval->format("%Y Tahun, %M Bulan, %d Hari");
                echo $umur;           
              ?> 
              ]</b>
              </div>
              <div class="col-md-2">
              <label>Jenis Kelamin</label><br>
              <?= $jk ?>  
              </div> 
              <div class="col-md-3">
              <label>Alamat</label><br>
              <?= $alamat ?>  
              </div> 
            </div>
            <div class="col-md-12" style="margin-bottom: 15px;font-size: 14px;">
              <div class="col-md-12">
              <label>Data Penunjang</label><br>
                <?= $data_transaksi ?>  
              </div> 
            </div>  
          </div>
        </div>
        <div class="box-footer">
          <div class="col-md-4">
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Data Operator</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-xs TambahOpe" data-toggle="tooltip" data-placement="right" title="Tambah Data" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah Operator / Petugas
              </button>
              </div>
            </div>
              <div class="box-body">
              <div class="box-header with-border">
                <div class="form-group">
                  <div id="table-scroll" class="table-scroll">
                  <table id="main-table" class="table table-bordered table-striped main-table">
                    <thead class="header">
                      <tr>
                      <th colspan="2" style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: left;text-align: center;"><b>Nama</b></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 10%;"><i class="fa fa-pencil"></i></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 10%;"><i class="fa fa-close"></i></th>
                      </tr>
                    </thead>
                    <tbody class="scrollable">
                      <?php
                        foreach($ope as $rowope){
                      ?>
                    <tr>
                        <td colspan="2" style="vertical-align:middle;text-align: left;"><b><?= $rowope['nama_pegawai'] ?></b></td>
                        <td style="vertical-align:middle;text-align: center;">
<button type="button" class="btn btn-info btn-xs EditOpe" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $id ?>" data-id2="<?= $rowope['id_operator'] ?>">
                <i class="fa fa-pencil"></i></button>
                        </td>
                        <td style="vertical-align:middle;text-align: center;">
    <a href="<?= base_url('ol_pendaftaran/pendaftaran/hapusoperator/') ?><?= $id ?>/<?= $rowope['id_operator'] ?>" title="Hapus Data" class="btn btn-danger btn-xs"  onclick="confirmation(event)" > <i class="fa fa-trash-o"></i>
    </a> 
                        </td>
                    </tr>
                    <tr>
                       <td colspan="4" style="vertical-align:middle;">
 <button type="button" class="btn btn-success btn-xs SimpanKw" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $id ?>" data-id2="<?= $rowope['id_operator'] ?>">
                <i class="fa fa-plus"></i> Tambah Kewenangan</button>                        
                       </td>
                    </tr>
                      <?php
                          $tkewenangan = $this->m_ol_rancak->ambil_data_tindakan_kewenangan($rowope['id_operator'],$rowope['id_pegawai']);
                          foreach($tkewenangan as $rowtkewenangan){
                      ?>
                      <tr>
                      <td style="vertical-align:middle;text-align: center;">&nbsp;</td>
                      <td style="vertical-align:middle;text-align: center;">
                        <?= $rowtkewenangan['nama_kewenangan'].' <b>['.$rowtkewenangan['nama_kompetensi'].']</b><br>Jumlah : '.$rowtkewenangan['jml_logbook'] ?>
                      </td>
                      <td style="vertical-align:middle;text-align: center;">
<button type="button" class="btn btn-success btn-xs EditKw" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $id ?>" data-id2="<?= $rowtkewenangan['id_tindakan_kewenangan'] ?>">
                <i class="fa fa-pencil"></i></button>
                      </td>
                      <td style="vertical-align:middle;text-align: center;">
    <a href="<?= base_url('ol_pendaftaran/pendaftaran/hapuskw/') ?><?= $id ?>/<?= $rowtkewenangan['id_tindakan_kewenangan'] ?>" title="Hapus Data" class="btn btn-danger btn-xs"  onclick="confirmation(event)" > <i class="fa fa-trash-o"></i>
    </a> 
                      </td>
                    </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                </div>
              </div> 
              </div>
            </div>      
          </div> 
          <div class="col-md-4">
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Data Pemakaian BAKHP</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-xs TambahKeluar" data-toggle="tooltip" data-placement="right" title="Tambah Data" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah Pemakaian
              </button>
              </div>
            </div>
              <div class="box-body">
              <div class="box-header with-border">
                <div class="form-group">
                  <div id="table-scroll" class="table-scroll">
                  <table id="main-table" class="table table-bordered table-striped main-table">
                    <thead class="header">
                      <tr>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: left;text-align: center;"><b>Nama</b></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: left;text-align: center;"><b>JML</b></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 10%;"><i class="fa fa-pencil"></i></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 10%;"><i class="fa fa-close"></i></th>
                      </tr>
                    </thead>
                    <tbody class="scrollable">
                      <?php
                        foreach($tkeluar as $rowtkeluar){
                      ?>
                    <tr>
                        <td style="vertical-align:middle;text-align: left;"><b><?= $rowtkeluar['nama_barang'] ?></b></td>
                        <td style="vertical-align:middle;text-align: right;"><b><?= $rowtkeluar['jml_keluar'].' '.$rowtkeluar['satuan_keluar'] ?></b></td>
                        <td style="vertical-align:middle;text-align: center;">
<button type="button" class="btn btn-info btn-xs EditKeluar" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $id ?>" data-id2="<?= $rowtkeluar['id_keluar'] ?>">
                <i class="fa fa-pencil"></i></button>
                        </td>
                        <td style="vertical-align:middle;text-align: center;">
    <a href="<?= base_url('ol_pendaftaran/pendaftaran/hapuskeluar/') ?><?= $id ?>/<?= $rowtkeluar['id_keluar'] ?>" title="Hapus Data" class="btn btn-danger btn-xs"  onclick="confirmation(event)" > <i class="fa fa-trash-o"></i>
    </a> 
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
          </div>
          <div class="col-md-4">
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Data Hasil</h3>
              <div class="box-tools pull-right">
              <button type="button" class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?> btn-xs TambahKelengkapan" data-toggle="tooltip" data-placement="right" title="Tambah Data" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah Hasil
              </button>
              </div>
            </div>
              <div class="box-body">
              <div class="box-header with-border">
                <div class="form-group">
                  <div id="table-scroll" class="table-scroll">
                  <table id="main-table" class="table table-bordered table-striped main-table">
                    <thead class="header">
                      <tr>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: left;text-align: center;"><b>Nama</b></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 10%;"><i class="fa fa-pencil"></i></th>
                      <th style="background-color:#9b0e27;color:white;vertical-align:middle;text-align: center;width: 10%;"><i class="fa fa-close"></i></th>
                      </tr>
                    </thead>
                    <tbody class="scrollable">
                      <?php
                        foreach($tkelengkapan as $rowtkelengkapan){
                          $hasil_kelengkapan = strip_tags($rowtkelengkapan['hasil_kelengkapan']); 
                          $hasil_kelengkapan = html_entity_decode($hasil_kelengkapan);
                      ?>
                    <tr>
                        <td style="vertical-align:middle;text-align: left;"><b><?= $rowtkelengkapan['nama_hasil'] ?></b></td>
                        <td style="vertical-align:middle;text-align: center;">
<button type="button" class="btn btn-info btn-xs EditKelengkapan" data-toggle="tooltip" data-placement="right" title="Edit Data" data-toggle="modal" data-target="#modal-default" data-id="<?= $id ?>" data-id2="<?= $rowtkelengkapan['id_kelengkapan'] ?>">
                <i class="fa fa-pencil"></i></button>
                        </td>
                        <td style="vertical-align:middle;text-align: center;">
    <a href="<?= base_url('ol_pendaftaran/pendaftaran/hapuskelengkapan/') ?><?= $id ?>/<?= $rowtkelengkapan['id_kelengkapan'] ?>" title="Hapus Data" class="btn btn-danger btn-xs"  onclick="confirmation(event)" > <i class="fa fa-trash-o"></i>
    </a> 
                        </td>
                    </tr>
                    <tr>
                      <td colspan="3" style="vertical-align:middle;text-align: left;"><?= $hasil_kelengkapan ?></td>
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
          </div>
        </div>
      </div>
      <?php echo form_close(); ?> 
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
elseif ($page=="pendaftaran_edit_operator")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit_operator');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_operator" value="<?= $id_operator; ?>">
      <input type="hidden" name="status_transaksi" value="<?= $status_transaksi; ?>">
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
              <label>Operator</label>
              <?php
                input_pdselect2("admin_operator",$ope_nonull,$admin_operator);
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
elseif ($page=="pendaftaran_tambah_keluar")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah_keluar');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="status_transaksi" value="<?= $status_transaksi; ?>">
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
          <div class="col-md-10">
              <label>Nama Barang Habis Pakai</label>
              <?php
                input_pdselect2("id_barang",$data_barang,$id_barang);
              ?>  
          </div>
          <div class="col-md-2">
              <label>Jumlah</label>
              <?php
                  input_textcustom("jml_keluar",$jml_keluar," style='text-align:right;' required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                            "Jumlah","text");  
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
elseif ($page=="pendaftaran_edit_keluar")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit_keluar');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_keluar" value="<?= $id_keluar; ?>">
      <input type="hidden" name="id_barang_lama" value="<?= $id_barang; ?>">
      <input type="hidden" name="jml_keluar_lama" value="<?= $jml_keluar; ?>">
      <input type="hidden" name="status_transaksi" value="<?= $status_transaksi; ?>">
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
          <div class="col-md-10">
              <label>Nama Barang Habis Pakai</label>
              <?php
                input_pdselect2("id_barang",$data_barang,$id_barang);
              ?>  
          </div>
          <div class="col-md-2">
              <label>Jumlah</label>
              <?php
                  input_textcustom("jml_keluar",$jml_keluar," style='text-align:right;' required
                        onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control' ",
                            "Jumlah","text");  
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
elseif ($page=="pendaftaran_awal" || $page=="pendaftaran_clicked")
{
?>
<label>Hasil</label>
<?php
    input_textareacustom("hasil_kelengkapan",$hasil_kelengkapan," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Text"); 
?> 
<script type="text/javascript">
    $(document).ready(function() {
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});   
  }); 
</script>
<?php
}
elseif ($page=="pendaftaran_tambah_kelengkapan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_tambah_kelengkapan');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="status_transaksi" value="<?= $status_transaksi; ?>">
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
              <label>Nama Kelengkapan</label>
              <?php
                input_pdselect2("id_hasil",$data_hasil,$id_hasil);
              ?>  
          </div>
          <div class="col-md-6">
              <label>Nama Format</label>
              <?php
            //      input_pdselect2fleksibel("id_fhasil","id_fhasil",$data_fhasil,"id_fhasil","nama_fhasil",$id_fhasil,"Pilih Format");
                input_pdselect2("id_fhasil",$data_fhasil,$id_fhasil);
              ?>  
          </div>
          <div class="col-md-12">
            <div class="formate"></div>
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
    $('#id_fhasil').on('change', function(){
      inputValue = document.getElementById("id_fhasil").value;
      $('.formate').load('<?php echo base_url('ol_pendaftaran/pendaftaran/clicked/'); ?>'+inputValue);
    });
    $('.formate').load('<?php echo base_url('ol_pendaftaran/pendaftaran/awal/'); ?><?= $id ?>');
});
    $('select[name=id_hasil]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>ol_pendaftaran/fhasil_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_fhasil").empty();
                $("#nama_fhasil").empty();

                for( var i = 0; i<len; i++){
                    var id = data[i]["id_fhasil"];
                    var name = data[i]["nama_fhasil"];

                    $("#id_fhasil").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
</script>
<?php
}
elseif ($page=="pendaftaran_edit_kelengkapan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Ol_pendaftaran/pendaftaran/simpan_edit_kelengkapan');?>" onClick="return cek();">
      <input type="hidden" name="id_transaksi" value="<?= $id; ?>">
      <input type="hidden" name="id_kelengkapan" value="<?= $id_kelengkapan; ?>">
      <input type="hidden" name="status_transaksi" value="<?= $status_transaksi; ?>">
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
              <label>Nama Kelengkapan</label>
              <?php
                input_pdselect2("id_hasil",$data_hasil,$id_hasil);
              ?>  
          </div>
          <div class="col-md-12">
<label>Hasil</label>
<?php
    input_textareacustom("hasil_kelengkapan",$hasil_kelengkapan," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Text"); 
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR}); 
});
</script>
<?php
}