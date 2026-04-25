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
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">PERHATIAN</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
<div class="row mb-2">
  <div class="col-md-3">
    <select id="filter_position" class="form-control">
      <option value="">All Position</option>
      <option value="Manager">Manager</option>
      <option value="Staff">Staff</option>
    </select>
  </div>

  <div class="col-md-3">
    <select id="filter_office" class="form-control">
      <option value="">All Office</option>
      <option value="Jakarta">Jakarta</option>
      <option value="Bandung">Bandung</option>
    </select>
  </div>

  <div class="col-md-3">
    <input type="date" id="date_from" class="form-control">
  </div>

  <div class="col-md-3">
    <input type="date" id="date_to" class="form-control">
  </div>
</div>

<table id="example4" width="100%" class="table table-bordered table-striped table-hover" >
<thead>
<tr>
  <th>Name</th>
  <th>Position</th>
  <th>Office</th>
  <th>Salary</th>
  <th>Created</th>
</tr>
<tr class="filters">
  <th><input class="form-control" placeholder="Search Name"></th>
  <th></th>
  <th></th>
  <th><input class="form-control" placeholder="Exact Salary"></th>
  <th></th>
</tr>
</thead>
</table>
        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="validasi")
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
            <th>Nama</th>
            <th>NIP</th>
            <th>Unit</th>
            <th>Status</th>
          </tr>
        </thead>
<tfoot>
<tr>
    <th><input type="text" class="form-control" placeholder="Search Nama"></th>
    <th><input type="text" class="form-control" placeholder="Search NIP"></th>
    <th><input type="text" class="form-control" placeholder="Search Unit"></th>
    <th><input type="text" class="form-control" placeholder="Search Status"></th>
</tr>
</tfoot>
      </table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="validasi_validasi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
    </a>
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
            <th>Pegawai</th>
            <th>Kewenangan</th>
            <th>Kompetensi</th>
            <th style="text-align: center;">Sifat Kewenangan</th>
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
elseif ($page=="validasi_rkk")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_validasi/validasi/simpan_rkk');?>" onClick="return cek();">
          <input type="hidden" name="id_kewenangan" value="<?= $id; ?>">
          <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title">VALIDASI RKK</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                  <label>Validasi</label>
                  <?php
                 input_pdselect2("id_sifat_kewenangan",$sifat_kewenangan,$id_sifat_kewenangan);
                  ?>
              </div>
              <div class="col-md-6">
                  <label>Status</label>
                  <?php
                 input_pdselect2("status_validasi",$rkk,$status_validasi);
                  ?>
              </div>
            </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="setuju btn btn-primary">Submit</button>
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