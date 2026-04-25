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
        <main>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                    <h6>Where does it come from ?</h6>
                    <p class="text-secondary"> Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                      roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard
                      McClinton, a Latin professor at Hampered-Sydney College in Virginia, looked up one of the more
                      obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the
                      word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections
                      1.10.32 and 1.10.33 of "de Minibus Bono rum et Malo rum" (The Extremes of Good and Evil) by Cicero,
                      written in 45 BC. This book is a treatise on the theory of ethics, very popular during the
                      Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in
                      section 1.10.32 </p>
                  </div>
                  <div class="card-footer">
                    <p class="float-start text-secondary p-t-10 mb-0">1 days Ago</p>
                    <a href="#" class="float-end fw-bold"> Read More </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
<?php
}
elseif ($page=="validasi")
{
?>
        <main>
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Child Rows Example</h5>
                    <p>The DataTables API has a number of methods for attaching child rows to a parent row in the
                      DataTable. This can be used to show additional information about a row, useful for cases where you
                      wish to convey more information about a row than there is space for in the host table.</p>
                  </div>
                  <div class="card-body px-0">
                    <div class="app-datatable-default overflow-auto">
<table id="dttb"
  class="display w-100 datatable child-row-datatable"
  data-server-side="true"
  data-ajax="<?= base_url('ol_validasi/'.$page.'/data') ?>"
  data-columns='[
    {"data":null,"className":"dt-control","orderable":false},
    {"data":"nama_pegawai"},
    {"data":"tmp_lahir"},
    {"data":"email"},
    {"data":"no_hp"},
    {"data":"nik"},
    {"data":"nip"},
    {"data":"alamat"}
  ]'
  data-row-detail="true"
  data-row-group="alamat"
  data-buttons="validasi,reload,delete"
  data-page="<?= $page ?>"
  data-lang="id">
<thead>
<!-- <table class="display w-100 datatable child-row-datatable" data-server="false" data-buttons="reload">
                     
<table class="display w-100 datatable child-row-datatable" data-server="true" data-ajax="URL_SERVER_CI3">
<table class="display w-100 datatable child-row-datatable" data-responsive="true" data-page-length="10" data-order='[[0,"asc"]]'>
                      
<table class="display w-100 datatable child-row-datatable" data-server-side="true" data-ajax="< base_url('skp/ajax_list'); ?>" data-columns='[
         {"data":"nama"},
         {"data":"jabatan"},
         {"data":"tahun"},
         {"data":"aksi","orderable":false,"searchable":false}
       ]'>

                  -->
           <thead>
             <tr>
               <th></th> 
               <th>Nama Pegawai</th>
               <th>Tempat Lahir</th>
               <th>Email</th>
               <th>No HP</th>
               <th>NIK</th>
               <th>NIP</th>
               <th>Alamat</th>
             </tr>
           </thead>
           <tfoot>
           <tr>
               <th></th> 
               <th><input type="text" class="form-control" placeholder="Cari Nama"></th>
               <th><input type="text" class="form-control" placeholder="Cari Tempat Lahir"></th>
               <th><input type="text" class="form-control" placeholder="Cari Email"></th>
               <th><input type="text" class="form-control" placeholder="Cari No HP"></th>
               <th><input type="text" class="form-control" placeholder="Cari NIK"></th>
               <th><input type="text" class="form-control" placeholder="Cari NIP"></th>
               <th><input type="text" class="form-control" placeholder="Cari Alamat"></th>
           </tr>
           </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
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