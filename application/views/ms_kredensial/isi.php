<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
$arrayboxBOX = array('aqua','green','yellow','red');
$resarrayBOX = array_rand($arrayboxBOX);
$thenarrayBOX = $arrayboxBOX[$resarrayBOX];
$arrayprev = array('fa-solid fa-caret-left fa-fw','fa-solid fa-caret-square-left fa-fw',
 'fa-solid fa-angle-double-left fa-fw','fa-solid fa-angle-left fa-fw',
 'fa-solid fa-arrow-left fa-fw','fa-solid fa-backward fa-fw',
 'fa-solid fa-chevron-circle-left fa-fw','fa-solid fa-chevron-left fa-fw',
 'fa-solid fa-fast-backward fa-fw','fa-solid fa-long-arrow-left fa-fw',
 'fa-solid fa-reply fa-fw','fa-solid fa-reply-all fa-fw',
);
$resarrayprev = array_rand($arrayprev);
$thenarrayprev = $arrayprev[$resarrayprev];
$arrayboxreload = array('fa-solid fa-refresh fa-fw','fa-solid fa-repeat fa-fw',
 'ti ti-analyze','ti ti-analyze-filled'
);
$resarrayreload = array_rand($arrayboxreload);
$thenarrayreload = $arrayboxreload[$resarrayreload];
$attr_ra = [
    'class' => 'select-example'
];
//=================================== H O M E ================================================
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
elseif ($page=="kompetensi")
{
?>
        <main>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header" style="vertical-align:middle;">
                    <?= $title ?>
                  </div>
                  <div class="card-body p-0">
<div id="action-buttons" class="mb-2 d-flex gap-2 flex-wrap" style="margin: 12px;vertical-align: middle;">
<?= ra_btn("Tambah Kompetensi", [
    "icon" => "fa fa-plus",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/kompetensi/tambah"),
    "data-modal-title" => "Tambah Kompetensi",
    "data-modal-method" => "GET"
]) ?>

<?= ra_btn("Edit Kompetensi", [
    "icon" => "fa fa-edit",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/kompetensi/edit"),
    "data-modal-title" => "Edit Kompetensi",
    "data-modal-method" => "GET",
    "data-require-select" => "1"
]) ?>
</div>
                    <div class="app-datatable-default overflow-auto">
                      <!--<table id="dttb" class="display w-100 default-data-table">-->
                      <table id="dttb" class="table table-Variants table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Kode Unit</th>
                                <th>Nama Kompetensi</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
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
$arraymodal = array('bg-primary','bg-secondary','bg-success','bg-warning','bg-info','bg-danger','bg-secondary-900');
$modalarray = array_rand($arraymodal);
$md = $arraymodal[$modalarray];
?>
<div class="modal fade" id="modal-default" aria-hidden="true" tabindex="-1">
<!-- GANTI UKURAN DI SINI -->
<!-- 
modal-sm | modal-lg | modal-xl | modal-fullscreen | modal-dialog-scrollable 
modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable
-->
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header <?= $md ?>">
        <h5 class="modal-title text-white" id="raModalTitle">Modal</h5>
        <button type="button" class="btn-close m-0 fs-5" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>

      <div class="modal-body" id="raModalBody">
        <div class="text-center py-4">
          <div class="spinner-border text-primary"></div>
          <div class="mt-2">Memuat...</div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php
}
elseif ($page=="kompetensi_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<form id="form-modal">
  <input type="hidden" name="id_kompetensi" value="<?= $id_kompetensi ?>">
  <input type="hidden" name="creator_kompetensi" value="<?= $creator_kompetensi ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">Kode Unit</label>
<?php
inputra('kode_unit', $kode_unit, [
    'placeholder' => 'Ketikkan Kode Unit',
    'maxlength' => '60',
    'autofocus' => 'autofocus'
]); 
?><small id="kode_unit_status" class="form-text"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
<?php
selectra(
  'id_jabatan',
  $get_jabatan,
  $id_jabatan,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">Status Kompetensi</label>
<?php
selectra(
  'status_kompetensi',
  $cmd_status,
  $status_kompetensi,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Kompetensi</label>
<?php
inputra('nama_kompetensi', $nama_kompetensi, [
    'placeholder' => 'Ketikkan Nama Kompetensi',
    'maxlength' => '255'
]); 
?>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});
  function checkField(fieldId) {
      var data = {};
      data[fieldId] = $('#' + fieldId).val();
      data['id_pegawai'] = $('#id_pegawai').val(); // ⬅️ PENTING

      $.post('<?= base_url("master_kredensial/check_unique") ?>', data, function(res){
          $('#' + fieldId + '_status').html(res);
      });
  }

    // realtime check
    $('#kode_unit').on('keyup change', function(){ checkField('kode_unit'); });
    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/kompetensi/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Kompetensi');
            }
        });
    });
});	
$('#kode_unit').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9_]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});
$('#kode_unit').on("input",function(event) {
  var current = $(this).val();
  var replaced = current.replace(/[^a-zA-Z0-9 _]/g,'');
  $(this).val(replaced);
});
</script>
<?php
}
elseif ($page=="kompetensi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<form id="form-modal">
  <input type="hidden" name="id_kompetensi" value="<?= $id_kompetensi ?>">
  <input type="hidden" name="creator_kompetensi" value="<?= $creator_kompetensi ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                         <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">Kode Unit</label>
<?php
inputra('kode_unit', $kode_unit, [
    'placeholder' => 'Ketikkan Kode Unit',
    'maxlength' => '60',
    'autofocus' => 'autofocus'
]); 
?><small id="kode_unit_status" class="form-text"></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
<?php
selectra(
  'id_jabatan',
  $get_jabatan,
  $id_jabatan,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label">Status Kompetensi</label>
<?php
selectra(
  'status_kompetensi',
  $cmd_status,
  $status_kompetensi,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Kompetensi</label>
<?php
inputra('nama_kompetensi', $nama_kompetensi, [
    'placeholder' => 'Ketikkan Nama Kompetensi',
    'maxlength' => '255'
]); 
?>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});
  function checkField(fieldId) {
      var data = {};
      data[fieldId] = $('#' + fieldId).val();
      data['id_pegawai'] = $('#id_pegawai').val(); // ⬅️ PENTING

      $.post('<?= base_url("master_kredensial/check_unique") ?>', data, function(res){
          $('#' + fieldId + '_status').html(res);
      });
  }

    // realtime check
    $('#kode_unit').on('keyup change', function(){ checkField('kode_unit'); });
    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/kompetensi/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Kompetensi');
            }
        });
    });
}); 
$('#kode_unit').keypress(function (e) {
    var regex = new RegExp("^[a-zA-Z0-9_]+$");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        return true;
    }
    e.preventDefault();
    return false;
});
$('#kode_unit').on("input",function(event) {
  var current = $(this).val();
  var replaced = current.replace(/[^a-zA-Z0-9 _]/g,'');
  $(this).val(replaced);
});
</script>
<?php
}
elseif ($page=="kewenangan")
{
?>
        <main>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header" style="vertical-align:middle;">
                    <?= $title ?>
                  </div>
                  <div class="card-body p-0">
<div id="action-buttons" class="mb-2 d-flex gap-2 flex-wrap" style="margin: 12px;vertical-align: middle;">

<?= ra_btn("Tambah Kewenangan", [
    "icon" => "fa fa-plus",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/kewenangan/tambah"),
    "data-modal-title" => "Tambah Kewenangan",
    "data-modal-method" => "GET"
]) ?>

<?= ra_btn("Edit Kewenangan", [
    "icon" => "fa fa-edit",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/kewenangan/edit"),
    "data-modal-title" => "Edit Kewenangan",
    "data-modal-method" => "GET",
    "data-require-select" => "1"
]) ?>

</div>
                    <div class="app-datatable-default overflow-auto">
                      <!--<table id="dttb" class="display w-100 default-data-table">-->
                      <table id="dttb" class="table table-Variants table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Kode Unit</th>
                                <th>Nama Kompetensi</th>
                                <th>Nama Kewenangan</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
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
$arraymodal = array('bg-primary','bg-secondary','bg-success','bg-warning','bg-info','bg-danger','bg-secondary-900');
$modalarray = array_rand($arraymodal);
$md = $arraymodal[$modalarray];
?>
<div class="modal fade" id="modal-default" aria-hidden="true" tabindex="-1">
<!-- GANTI UKURAN DI SINI -->
<!-- 
modal-sm | modal-lg | modal-xl | modal-fullscreen | modal-dialog-scrollable 
modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable
-->
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header <?= $md ?>">
        <h5 class="modal-title text-white" id="raModalTitle">Modal</h5>
        <button type="button" class="btn-close m-0 fs-5" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>

      <div class="modal-body" id="raModalBody">
        <div class="text-center py-4">
          <div class="spinner-border text-primary"></div>
          <div class="mt-2">Memuat...</div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php
}
elseif ($page=="kewenangan_tambah")
{
?>
<form id="form-modal">
  <input type="hidden" name="id_kewenangan" value="<?= $id_kewenangan ?>">
  <input type="hidden" name="creator_kewenangan" value="<?= $creator_kewenangan ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Kompetensi</label>
<?php
 selectra(
    'id_kompetensi',
    $get_kompetensi,
    $id_kompetensi,
    FALSE,
    [
        'class' => 'select-example'
    ]
);
?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Kewenangan</label>
<?php
inputra('nama_kewenangan', $nama_kewenangan, [
    'placeholder' => 'Ketikkan Nama Kewenangan',
    'maxlength' => '255'
]); 
?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Grade</label>
<?php
selectra(
  'id_grade',
  $get_grade,
  $id_grade,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Status Kompetensi</label>
<?php
selectra(
  'status_kewenangan',
  $cmd_status,
  $status_kewenangan,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});
  function checkField(fieldId) {
      var data = {};
      data[fieldId] = $('#' + fieldId).val();
      data['id_pegawai'] = $('#id_pegawai').val(); // ⬅️ PENTING

      $.post('<?= base_url("master_kredensial/check_unique") ?>', data, function(res){
          $('#' + fieldId + '_status').html(res);
      });
  }

    // realtime check
    $('#kode_unit').on('keyup change', function(){ checkField('kode_unit'); });
    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/kewenangan/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Kewenangan');
            }
        });
    });
});
</script>
<?php
}
elseif ($page=="kewenangan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<form id="form-modal">
  <input type="hidden" name="id_kewenangan" value="<?= $id_kewenangan ?>">
  <input type="hidden" name="creator_kewenangan" value="<?= $creator_kewenangan ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Kompetensi</label>
<?php
selectra(
  'id_kompetensi',
  $get_kompetensi,
  $id_kompetensi,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Kewenangan</label>
<?php
inputra('nama_kewenangan', $nama_kewenangan, [
    'placeholder' => 'Ketikkan Nama Kewenangan',
    'maxlength' => '255'
]); 
?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Grade</label>
<?php
selectra(
  'id_grade',
  $get_grade,
  $id_grade,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Status Kompetensi</label>
<?php
selectra(
  'status_kewenangan',
  $cmd_status,
  $status_kewenangan,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});
  function checkField(fieldId) {
      var data = {};
      data[fieldId] = $('#' + fieldId).val();
      data['id_pegawai'] = $('#id_pegawai').val(); // ⬅️ PENTING

      $.post('<?= base_url("master_kredensial/check_unique") ?>', data, function(res){
          $('#' + fieldId + '_status').html(res);
      });
  }

    // realtime check
    $('#kode_unit').on('keyup change', function(){ checkField('kode_unit'); });
    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/kewenangan/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Kewenangan');
            }
        });
    });
}); 
</script>
<?php
}
elseif ($page=="grade")
{
?>
        <main>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header" style="vertical-align:middle;">
                    <?= $title ?>
                  </div>
                  <div class="card-body p-0">
<div id="action-buttons" class="mb-2 d-flex gap-2 flex-wrap" style="margin: 12px;vertical-align: middle;">
<?= ra_btn("Tambah Grade", [
    "icon" => "fa fa-plus",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/grade/tambah"),
    "data-modal-title" => "Tambah Grade",
    "data-modal-method" => "GET"
]) ?>

<?= ra_btn("Edit Grade", [
    "icon" => "fa fa-edit",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/grade/edit"),
    "data-modal-title" => "Edit Grade",
    "data-modal-method" => "GET",
    "data-require-select" => "1"
]) ?>
</div>
                    <div class="app-datatable-default overflow-auto">
                      <!--<table id="dttb" class="display w-100 default-data-table">-->
                      <table id="dttb" class="table table-Variants table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Urutan</th>
                                <th>Nama Grade</th>
                                <th>Nama Jabatan</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
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
$arraymodal = array('bg-primary','bg-secondary','bg-success','bg-warning','bg-info','bg-danger','bg-secondary-900');
$modalarray = array_rand($arraymodal);
$md = $arraymodal[$modalarray];
?>
<div class="modal fade" id="modal-default" aria-hidden="true" tabindex="-1">
<!-- GANTI UKURAN DI SINI -->
<!-- 
modal-sm | modal-lg | modal-xl | modal-fullscreen | modal-dialog-scrollable 
modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable
-->
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header <?= $md ?>">
        <h5 class="modal-title text-white" id="raModalTitle">Modal</h5>
        <button type="button" class="btn-close m-0 fs-5" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>

      <div class="modal-body" id="raModalBody">
        <div class="text-center py-4">
          <div class="spinner-border text-primary"></div>
          <div class="mt-2">Memuat...</div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php
}
elseif ($page=="grade_tambah")
{
?>
<form id="form-modal">
  <input type="hidden" name="id_grade" value="<?= $id_grade ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-2">
                            <label class="form-label">Urutan</label>
<?php
inputra('urutan_grade', $urutan_grade, [
    'placeholder' => 'Masukkan Urutan Grade',
    'maxlength' => '255',
    'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'
]); 
?>
                        </div>
                            <div class="col-md-5">
                                <label class="form-label">Nama Grade</label>
<?php
inputra('nama_grade', $nama_grade, [
    'placeholder' => 'Ketikkan Nama Grade',
    'maxlength' => '255'
]); 
?>
                            </div>
                        <div class="col-md-5">
                                <label class="form-label">Jabatan</label>
<?php
selectra(
  'id_jabatan',
  $get_jabatan,
  $id_jabatan,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});

    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/grade/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Grade');
            }
        });
    });
});
</script>
<?php
}
elseif ($page=="grade_edit")
{
?>
<form id="form-modal">
  <input type="hidden" name="id_grade" value="<?= $id_grade ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-2">
                            <label class="form-label">Urutan</label>
<?php
inputra('urutan_grade', $urutan_grade, [
    'placeholder' => 'Masukkan Urutan Grade',
    'maxlength' => '255',
    'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'
]); 
?>
                        </div>
                            <div class="col-md-5">
                                <label class="form-label">Nama Grade</label>
<?php
inputra('nama_grade', $nama_grade, [
    'placeholder' => 'Ketikkan Nama Grade',
    'maxlength' => '255'
]); 
?>
                            </div>
                        <div class="col-md-5">
                                <label class="form-label">Jabatan</label>
<?php
selectra(
  'id_jabatan',
  $get_jabatan,
  $id_jabatan,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});

    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/grade/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Grade');
            }
        });
    });
});
</script>
<?php
}
elseif ($page=="area_klinis")
{
?>
        <main>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header" style="vertical-align:middle;">
                    <?= $title ?>
                  </div>
                  <div class="card-body p-0">
<div id="action-buttons" class="mb-2 d-flex gap-2 flex-wrap" style="margin: 12px;vertical-align: middle;">
<?= ra_btn("Tambah Area Klinis", [
    "icon" => "fa fa-plus",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/area_klinis/tambah"),
    "data-modal-title" => "Tambah Area Klinis",
    "data-modal-method" => "GET"
]) ?>

<?= ra_btn("Edit Area Klinis", [
    "icon" => "fa fa-edit",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/area_klinis/edit"),
    "data-modal-title" => "Edit Area Klinis",
    "data-modal-method" => "GET",
    "data-require-select" => "1"
]) ?>
</div>
                    <div class="app-datatable-default overflow-auto">
                      <!--<table id="dttb" class="display w-100 default-data-table">-->
                      <table id="dttb" class="table table-Variants table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nama Area Klinis</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
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
$arraymodal = array('bg-primary','bg-secondary','bg-success','bg-warning','bg-info','bg-danger','bg-secondary-900');
$modalarray = array_rand($arraymodal);
$md = $arraymodal[$modalarray];
?>
<div class="modal fade" id="modal-default" aria-hidden="true" tabindex="-1">
<!-- GANTI UKURAN DI SINI -->
<!-- 
modal-sm | modal-lg | modal-xl | modal-fullscreen | modal-dialog-scrollable 
modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable
-->
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header <?= $md ?>">
        <h5 class="modal-title text-white" id="raModalTitle">Modal</h5>
        <button type="button" class="btn-close m-0 fs-5" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>

      <div class="modal-body" id="raModalBody">
        <div class="text-center py-4">
          <div class="spinner-border text-primary"></div>
          <div class="mt-2">Memuat...</div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php
}
elseif ($page=="area_klinis_tambah")
{
?>
<form id="form-modal">
  <input type="hidden" name="id_area_klinis" value="<?= $id_area_klinis ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Nama Area Klinis</label>
<?php
inputra('nama_area_klinis', $nama_area_klinis, [
    'placeholder' => 'Ketikkan Nama Area Klinis',
    'maxlength' => '255'
]); 
?>
                            </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});

    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/area_klinis/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Grade');
            }
        });
    });
});
</script>
<?php
}
elseif ($page=="area_klinis_edit")
{
?>
<form id="form-modal">
  <input type="hidden" name="id_area_klinis" value="<?= $id_area_klinis ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Nama Area Klinis</label>
<?php
inputra('nama_area_klinis', $nama_area_klinis, [
    'placeholder' => 'Ketikkan Nama Area Klinis',
    'maxlength' => '255'
]); 
?>
                            </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});

    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/area_klinis/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Grade');
            }
        });
    });
});
</script>
<?php
}
elseif ($page=="kewenangan_klinis")
{
?>
        <main>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header" style="vertical-align:middle;">
                    <?= $title ?>
                  </div>
                  <div class="card-body p-0">
<div id="action-buttons" class="mb-2 d-flex gap-2 flex-wrap" style="margin: 12px;vertical-align: middle;">
<?= ra_btn("Tambah Kewenangan Klinis", [
    "icon" => "fa fa-plus",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/kewenangan_klinis/tambah"),
    "data-modal-title" => "Tambah Kewenangan Klinis",
    "data-modal-method" => "GET"
]) ?>

<?= ra_btn("Edit Kewenangan Klinis", [
    "icon" => "fa fa-edit",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("master_kredensial/kewenangan_klinis/edit"),
    "data-modal-title" => "Edit Kewenangan Klinis",
    "data-modal-method" => "GET",
    "data-require-select" => "1"
]) ?>
</div>
                    <div class="app-datatable-default overflow-auto">
                      <!--<table id="dttb" class="display w-100 default-data-table">-->
                      <table id="dttb" class="table table-Variants table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="display: none;">id</th>
                                <th>Kewenangan</th>
                                <th>Area Klinis</th>
                                <th>Sifat Kewenangan</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
                            <th><input type="text" class="form-control" placeholder="Cari... "></th>
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
$arraymodal = array('bg-primary','bg-secondary','bg-success','bg-warning','bg-info','bg-danger','bg-secondary-900');
$modalarray = array_rand($arraymodal);
$md = $arraymodal[$modalarray];
?>
<div class="modal fade" id="modal-default" aria-hidden="true" tabindex="-1">
<!-- GANTI UKURAN DI SINI -->
<!-- 
modal-sm | modal-lg | modal-xl | modal-fullscreen | modal-dialog-scrollable 
modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable
-->
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header <?= $md ?>">
        <h5 class="modal-title text-white" id="raModalTitle">Modal</h5>
        <button type="button" class="btn-close m-0 fs-5" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>

      <div class="modal-body" id="raModalBody">
        <div class="text-center py-4">
          <div class="spinner-border text-primary"></div>
          <div class="mt-2">Memuat...</div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<?php
}
elseif ($page=="kewenangan_klinis_tambah")
{
?>
<form id="form-modal">
  <input type="hidden" name="id_kewenangan_area" value="<?= $id_kewenangan_area ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-9">
                                <label class="form-label">Kewenangan</label>
<?php 
selectra_ajax(
    'id_kewenangan',                         // Nama field & ID
    site_url('master_kredensial/get_data_ajax'), // URL API
    '',                                      // selected_text (kosongkan)
    '',                                      // selected_id (kosongkan)
    'Cari Data Kewenangan ...'               // Placeholder
);
?>
                        </div>
                        <div class="col-md-3">
                                <label class="form-label">Sifat Kewenangan</label>
<?php
selectra(
  'id_sifat_kewenangan',
  $get_sifat_kewenangan,
  $id_sifat_kewenangan,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                        </div>
                        <div class="col-md-6">
                                <label class="form-label">Grade</label>
<?php
selectra(
  'id_grade',
  $get_grade,
  $id_grade,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                        </div>
                        <div class="col-md-6">
                                <label class="form-label">Area Klinis</label>
<?php
selectra(
  'id_area_klinis',
  $get_area_klinis,
  $id_area_klinis,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});

    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/kewenangan_klinis/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Grade');
            }
        });
    });
});
</script>
<?php
}
elseif ($page=="kewenangan_klinis_edit")
{
?>
<form id="form-modal">
  <input type="hidden" name="id_kewenangan_area" value="<?= $id_kewenangan_area ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-9">
                                <label class="form-label">Kewenangan</label>
<?php 
// Cari label teks berdasarkan ID yang terpilih dari array hasil model
$label_edit = '';
if (!empty($id_kewenangan) && isset($get_kewenangan[$id_kewenangan])) {
    $label_edit = $get_kewenangan[$id_kewenangan];
}

selectra_ajax(
    'id_kewenangan', 
    site_url('master_kredensial/get_data_ajax'), 
    $label_edit,     // Masukkan label (String)
    $id_kewenangan,  // Masukkan ID (Value)
    'Cari Data Kewenangan ...'
);
?>
                        </div>
                        <div class="col-md-3">
                                <label class="form-label">Sifat Kewenangan</label>
<?php
selectra(
  'id_sifat_kewenangan',
  $get_sifat_kewenangan,
  $id_sifat_kewenangan,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                        </div>
                        <div class="col-md-6">
                                <label class="form-label">Grade</label>
<?php
selectra(
  'id_grade',
  $get_grade,
  $id_grade,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                        </div>
                        <div class="col-md-6">
                                <label class="form-label">Area Klinis</label>
<?php
selectra(
  'id_area_klinis',
  $get_area_klinis,
  $id_area_klinis,
  FALSE,
  [
      'class' => 'form-control select2 select-example'
  ]
);
?>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Simpan
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
$('.select-example').select2({
    width: '100%',
    dropdownParent: $('#modal-default')
});

    $('#form-modal').on('submit', function(e){
        e.preventDefault();
        let $form = $(this);
        let formData = $form.serialize();

        // tombol loading
        let $btn = $('#btnSaveLogbook');
        $btn.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: "<?= base_url('master_kredensial/kewenangan_klinis/simpan') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(res){
                if(res.ok){
                    Swal.fire({
                        toast: false,
                        icon: 'success',
                        title: 'Sukses',
                        text: res.msg,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // tutup modal
                    const raModalEl = document.getElementById('modal-default');
                    const raModal = bootstrap.Modal.getInstance(raModalEl);
                    raModal.hide();
                    if (window.tableLogbook) {
                        window.tableLogbook.ajax.reload(null, false);
                    }
                    // reload DataTable jika ada
                    if (typeof table !== 'undefined') table.ajax.reload(null,false);
                } else {
                    Swal.fire('Gagal', res.msg, 'error');
                }
            },
            error: function(xhr, status, err){
                Swal.fire('Error', 'Terjadi kesalahan server', 'error');
            },
            complete: function(){
                $btn.prop('disabled', false).text('Simpan Grade');
            }
        });
    });
});
</script>
<?php
}
elseif ($page=="kompetensi_syarat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/kompetensi/simpan_syarat');?>" onClick="return cek();">
    <input type="hidden" name="id_kompetensi" value="<?= $id_kompetensi; ?>">
    <input type="hidden" name="creator_kompetensi" value="<?= $creator_kompetensi; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Kompetensi <?= $kode_unit.' - '.$nama_kompetensi ?></h3>
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
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Alat dan Bahan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($kompetensi as $rowambil_nkr_alat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowambil_nkr_alat['id_kompetensi'];?>" <?php if(in_array($rowambil_nkr_alat['id_kompetensi'],explode(",", $syarat_kompetensi))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;">[ <b><?= $rowambil_nkr_alat['kode_unit'] ?></b> ] - <?= $rowambil_nkr_alat['nama_kompetensi'] ?></td>
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
elseif ($page=="elemen")
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
		            <th>Elemen Kompetensi</th>
                <th>Jabatan Fungsional</th>
		          </tr>
		        </thead>
		      </table>
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
elseif ($page=="elemen_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/elemen/simpan_tambah');?>" onClick="return cek();">
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
							<div class="col-md-12">
								  <label>Nama Elemen</label>
									<?php
										input_text("nama_elemen",$nama_elemen,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>
              <div class="col-md-12">
                  <label>Jabatan</label>
                    <?php
                      input_pdselect2("jabatan_elemen",$cmd_jabatan,$jabatan_elemen);
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
elseif ($page=="elemen_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/elemen/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_elemen" value="<?= $id_elemen; ?>">
		<input type="hidden" name="pembuat_elemen" value="<?= $pembuat_elemen; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">     
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">Elemen Kompetensi</h3>
			</div>
			  <div class="box-body">
						<div class="row">
							<div class="col-md-12">
								  <label>Nama Elemen</label>
									<?php
										input_text("nama_elemen",$nama_elemen,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>	
              <div class="col-md-12">
                  <label>Jabatan</label>
                    <?php
                      input_pdselect2("jabatan_elemen",$cmd_jabatan,$jabatan_elemen);
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
elseif ($page=="asesmen")
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
                <th>Komponen Asesmen</th>
		            <th>Elemen</th>
		            <th>Jabatan</th>
		          </tr>
		        </thead>
		      </table>
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
elseif ($page=="asesmen_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/asesmen/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Jabatan</label>
                    <?php
                      input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                    ?>          
              </div>
							<div class="col-md-12">
								  <label>Nama Asesmen</label>
									<?php
										input_text("nama_asesmen",$nama_asesmen,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-12">
								  <label>Elemen</label>
										<?php
											input_pdselect2("id_elemen",$cmd_elemen,$id_elemen);
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
elseif ($page=="asesmen_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/asesmen/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_asesmen" value="<?= $id_asesmen; ?>">
		<input type="hidden" name="pembuat_asesmen" value="<?= $pembuat_asesmen; ?>">
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
              <div class="col-md-12">
                  <label>Jabatan</label>
                    <?php
                      input_pdselect2("id_jabatan",$cmd_jabatan,$id_jabatan);
                    ?>          
              </div>
							<div class="col-md-12">
								  <label>Nama Asesmen</label>
									<?php
										input_text("nama_asesmen",$nama_asesmen,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-12">
								  <label>Elemen</label>
										<?php
											input_pdselect2("id_elemen",$cmd_elemen,$id_elemen);
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
elseif ($page=="asesmen_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/asesmen/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_asesmen" value="<?= $id_asesmen; ?>">
    <input type="hidden" name="pembuat_asesmen" value="<?= $pembuat_asesmen; ?>">
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
              <div class="col-md-12">
                <label>Urutan</label>
                <?php
                input_textcustom("no_urut_asesmen",$no_urut_asesmen,"maxlength='5' required class='form-control' 
                  onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urut","text"); ?>
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
elseif ($page=="qf_2")
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
		            <th>Pertanyaan</th>
		            <th style="width:25%;">Asesmen</th>
		            <th style="width:25%;">Elemen</th>
		            <th style="width:20%;">Jabatan</th>
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
elseif ($page=="qf_2_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/qf_2/simpan_tambah');?>" onClick="return cek();">
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
							<div class="col-md-12">
								  <label>Pertanyaan</label>
									<?php
										input_text("nama_question",$nama_question,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-12">
								  <label>Asemen</label>
										<?php
											input_pdselect2("id_asesmen",$cmd_asesmen,$id_asesmen);
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
elseif ($page=="qf_2_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/qf_2/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_question" value="<?= $id_question; ?>">
		<input type="hidden" name="pembuat_question" value="<?= $pembuat_question; ?>">
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
							<div class="col-md-12">
								  <label>Pertanyaan</label>
									<?php
										input_text("nama_question",$nama_question,"maxlength='255' required","Masukkan Nama","text");
									?>	
							</div>		
							<div class="col-md-12">
								  <label>Asemen</label>
										<?php
											input_pdselect2("id_asesmen",$cmd_asesmen,$id_asesmen);
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
elseif ($page=="format_question")
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
                <th>Kode Unit</th>
		            <th>Judul Unit</th>
		            <th style="width:15%;">Form</th>
                <th style="width:15%;">Instansi</th>
		            <th style="width:15%;">Jabatan</th>
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
elseif ($page=="format_question_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/format_question/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="2">
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
							<div class="col-md-12">
								  <label>Kode Unit</label>
									<?php
										input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
									?>	
							</div>		
							<div class="col-md-12">
								  <label>Instansi</label>
										<?php
											input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="format_question_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/format_question/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
		<input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
							<div class="col-md-12">
								  <label>Kode Unit</label>
									<?php
										input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
									?>	
							</div>		
							<div class="col-md-12">
								  <label>Instansi</label>
										<?php
											input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="format_question_seting")
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
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('master_kredensial/format_question/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
  	input_text("id_form",$id_form,"","","hidden");
  	input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
  						<h3 class="box-title"><?= $title ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pertanyaan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
              </tr>
              </thead>
              <tbody>
		    <?php
		    foreach($nkr_asesmen as $rownkr_asesmen){
		    ?>
				<tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_question'];?>" >
            </label>
            </div>
          </td>
					<td style="font-weight: bold; vertical-align: top;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
					<td style="font-weight: bold; vertical-align: top;"><?= $rownkr_asesmen['nama_question'] ?></td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rownkr_asesmen['nama_jabatan'] ?></td>
				</tr>
				<?php  
				}
				?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>       	
          </div>
        </div>    
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
		            <th style="display:none;"></th>
                <th style="width:9%;vertical-align: center;">Urut</th>
		            <th style="vertical-align: middle;text-align: center;">Elemen</th>
		            <th style="vertical-align: middle;text-align: center;">Asesmen</th>
		            <th style="vertical-align: middle;text-align: center;">Pertanyaan</th>
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
elseif ($page=="format_question_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/format_question/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
              <div class="col-md-12">
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
elseif ($page=="indikator")
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
           <h3 class="box-title"><?php echo $title; ?> <small style="color:white;font-weight:bold;">P = Pengetahuan, K = Ketrampilan, S = Sikap</small></h3>

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
                <th style="display:none;"></th>
                <th style="vertical-align:middle;text-align: center;">Asesmen</th>
                <th style="vertical-align:middle;text-align: center;">Indikator Unjuk Kerja</th>
                <th style="vertical-align:middle;text-align: center;">Poin yang di amati</th>
                <th style="vertical-align:middle;text-align: center;">Ketercapaian Indikator</th>                
                <th style="vertical-align:middle;text-align: center;">Pertanyaan</th>
                <th style="vertical-align:middle;text-align: center;">Standar Jawaban</th>
                <th style="vertical-align:middle;text-align: center;">Opsi Soal</th>
                <th style="vertical-align:middle;text-align: center;">Metode</th>
                <th style="vertical-align:middle;text-align: center;">Perangkat</th>
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
elseif ($page=="indikator_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/indikator/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama Indikator</label>
                  <?php
                    input_text("nama_indikator",$nama_indikator,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Asesmen</label>
                    <?php
                      input_pdselect2("id_asesmen",$cmd_asesmen,$id_asesmen);
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/indikator/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
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
              <div class="col-md-12">
                  <label>Nama Indikator</label>
                  <?php
                    input_text("nama_indikator",$nama_indikator,"maxlength='255' required","Masukkan Nama","text");
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Asesmen</label>
                    <?php
                      input_pdselect2("id_asesmen",$cmd_asesmen,$id_asesmen);
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
elseif ($page=="indikator_metode")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/indikator/simpan_metode');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
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
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Perangkat Asesmen</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($metode as $rowmetode){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowmetode['id_metode'];?>" <?php if(in_array($rowmetode['id_metode'],explode(",", $metode_indikator))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rowmetode['nama_metode'] ?></td>
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
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });  
  }); 
</script>
<?php
}
elseif ($page=="indikator_perangkat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/indikator/simpan_perangkat');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
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
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Perangkat Asesmen</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($perangkat as $rowperangkat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowperangkat['id_perangkat'];?>" <?php if(in_array($rowperangkat['id_perangkat'],explode(",", $perangkat_indikator))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rowperangkat['nama_perangkat'] ?></td>
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
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });  
  }); 
</script>
<?php
}
elseif ($page=="indikator_pertanyaan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/indikator/simpan_pertanyaan');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
          <div class="col-md-6">
              <label>Poin yang di amati</label>
              <?php
                input_textareacustom("poin_indikator",$poin_indikator," id='editor1' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>
          <div class="col-md-6">
              <label>Indikator Ketercapaian</label>
              <?php
                input_textareacustom("ketercapaian_indikator",$ketercapaian_indikator," id='editor3' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>          
          <div class="col-md-6">
              <label>Pertanyaan</label>
              <?php
                input_textareacustom("pertanyaan_indikator",$pertanyaan_indikator," id='editor2' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>

          <div class="col-md-6">
              <label>Standar Jawaban</label>
              <?php
                input_textareacustom("jawaban_indikator",$jawaban_indikator," id='editor4' rows='5' cols='50' class='form-control' ","");
              ?>
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
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor3', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor4', {enterMode: CKEDITOR.ENTER_BR});
    }); 
</script>
<?php
}
elseif ($page=="indikator_rubah_opsi")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/indikator/simpan_rubah_opsi');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
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
              <div class="col-md-12"> 
          <h5>Nama Indikator : <?= $nama_indikator ?></h5>
            <p><u>KETERANGAN</u> : <br>Isian = Mengisi Jawaban
              <br>Pilihan = Memilih Salah Satu Jawaban<br>Berganda = Pilih lebih Dari 1</p>
              </div> <br>   
              <div class="col-md-12">
                  <label>Jenis Soal</label>
                    <?php
                      input_pdselect2("jenis_soal",$opsi_soal,$jenis_soal);
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
elseif ($page=="indikator_seting_jawaban")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/indikator/simpan_seting_jawaban');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="pembuat_indikator" value="<?= $pembuat_indikator; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">INI SEBAGAI STANDAR JAWABAN BUKAN PENILAIAN OTOMATIS</h3>
      </div>
        <div class="box-body">
            <div class="row">
          <div class="table-responsive" tabindex="-1">
          <div class="col-md-12">
            <table id="item_table" class="table table-hover table-transaksi table-sm">
            <thead class="bg-light">
               <tr style="background-color: #800000;color: white;">
              <th class="text-sm text-label text-center border-0" style="display: none;"></th>
              <th class="text-sm text-label text-center border-0" style="width: 10%">No Urut</th>
              <th class="text-sm text-label text-center border-0">Soal</th>
              <th class="text-sm text-label text-center border-0" style="width: 15%">Status</th>
              <th class="text-sm text-label text-center border-0" style="width: 15%">Answer</th>
              <th class="text-sm text-label text-center border-0" style="width: 5%"></th>
              </tr>
            </thead>
            <tbody>
              <?php  
                foreach($soal as $rowsoal){
              ?>
              <tr>
              <td class="text-sm text-label border-0" style="display: none;">
              <?php
                input_text("id_soal_opsi_edit[]",$rowsoal['id_soal_opsi'],"required ","","hidden");
              ?>               
              </td>
              <td class="text-sm text-label border-0">
              <?php 
                input_textcustom("no_urut_soal_opsi_edit[]",$rowsoal['no_urut_soal_opsi']," style='text-align:right;' maxlength='3' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "No Urut","text");          
              ?>              
              </td>
              <td class="text-sm text-label border-0">
              <?php
                input_text("nama_soal_opsi_edit[]",$rowsoal['nama_soal_opsi'],"maxlength='255' ","Masukkan Keterangan","text");
              ?>
              </td>                            
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("status_soal_opsi_edit[]",$cmd_status,$rowsoal['status_soal_opsi']);
              ?>
              </td>
              <td class="text-sm text-label border-0">
              <?php
                input_pdselect2("answer[]",$cmd_answer,$rowsoal['answer']);
              ?>
              </td>
              <td class="text-sm text-label border-0"></td>
              </tr>
            <?php  
              }
            ?>
            </tbody>
            </table>
          </div>
          <div class="col-md-12">
          <button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span>Tambah Data</button>
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
   $(document).on('click', '.add', function(){
      var html = '';
      html += '<tr>';
      html += '<td class="text-sm text-label border-0"><input type="text" name="chk[]" value="0" class="form-control" style="text-align:right;"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="3"/></td>';
      html += '<td class="text-sm text-label border-0"><input type="text" name="nama_soal_opsi[]" class="form-control"  maxlength="255" /></td>';
      html += '<td class="text-sm text-label border-0"><select name="status_soal_opsi[]" class="form-control select2"><option value="1">AKTIF</option><option value="0">NON AKTIF</option></select></td>';
      html += '<td class="text-sm text-label border-0"><select name="answer[]" class="form-control select2"><option value="1">ANSWER</option><option value="0">BUKAN</option></select></td>';
      html += '<td class="text-sm text-label border-0"><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
      $('#item_table').append(html); 
      $('.select2').select2();          
  });
  $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
  }); 
</script>
<?php
}
elseif ($page=="metode")
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
                <th>Metode Asesmen</th>
              </tr>
            </thead>
          </table>
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
elseif ($page=="metode_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/metode/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama Metode</label>
                  <?php
                    input_text("nama_metode",$nama_metode,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="metode_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/metode/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_metode" value="<?= $id_metode; ?>">
    <input type="hidden" name="pembuat_metode" value="<?= $pembuat_metode; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Metode Asesmen</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama Metode</label>
                  <?php
                    input_text("nama_metode",$nama_metode,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="perangkat")
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
                <th>Perangkat Asesmen</th>
              </tr>
            </thead>
          </table>
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
elseif ($page=="perangkat_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/perangkat/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama Perangkat</label>
                  <?php
                    input_text("nama_perangkat",$nama_perangkat,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="perangkat_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/perangkat/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_perangkat" value="<?= $id_perangkat; ?>">
    <input type="hidden" name="pembuat_perangkat" value="<?= $pembuat_perangkat; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Perangkat Asesmen</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama Perangkat</label>
                  <?php
                    input_text("nama_perangkat",$nama_perangkat,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="alat")
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
                <th>Alat dan Bahan</th>
              </tr>
            </thead>
          </table>
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
elseif ($page=="alat_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/alat/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama Alat dan Bahan</label>
                  <?php
                    input_text("nama_alat",$nama_alat,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="alat_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/alat/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_alat" value="<?= $id_alat; ?>">
    <input type="hidden" name="pembuat_alat" value="<?= $pembuat_alat; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Alat dan Bahan</h3>
      </div>
        <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <label>Nama Alat dan Bahan</label>
                  <?php
                    input_text("nama_alat",$nama_alat,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="alatbahan")
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
                <th>Kompetensi</th>
                <th>Elemen</th>
                <th>Instansi</th>
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
elseif ($page=="alatbahan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/alatbahan/simpan_tambah');?>" onClick="return cek();">
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
                  <label>Elemen</label>
                    <?php
                      input_pdselect2("id_elemen",$cmd_elemen,$id_elemen);
                    ?>          
              </div>
              <div class="col-md-6">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_working,$id_instansi);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Kompetensi</label>
                    <?php
                      input_pdselect2("id_kompetensi",$ambil_kompetensi,$id_kompetensi);
                    ?>          
              </div>              
              <div class="col-md-12">
                  <label>Alat dan Bahan</label>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Alat dan Bahan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($ambil_nkr_alat as $rowambil_nkr_alat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowambil_nkr_alat['id_alat'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rowambil_nkr_alat['nama_alat'] ?></td>
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
elseif ($page=="alatbahan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/alatbahan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_alat_bahan" value="<?= $id_alat_bahan; ?>">
    <input type="hidden" name="pembuat_alat_bahan" value="<?= $pembuat_alat_bahan; ?>">
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
              <div class="col-md-12">
                  <label>Alat dan Bahan</label>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Alat dan Bahan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($ambil_nkr_alat as $rowambil_nkr_alat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowambil_nkr_alat['id_alat'];?>" <?php if(in_array($rowambil_nkr_alat['id_alat'],explode(",", $alat))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rowambil_nkr_alat['nama_alat'] ?></td>
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
elseif ($page=="form1")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form1_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form1/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="1">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form1_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form1/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form3")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form3_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form3/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="3">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form3_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form3/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form3_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('master_kredensial/form3/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $title ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_indikator'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rownkr_asesmen['nama_indikator'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;"></th>
                <th style="display:none;"></th>
                <th style="width: 9%;text-align: center;">Urut</th>
                <th>Elemen</th>
                <th>Asesmen</th>
                <th>Indikator</th>
                <th>Metode</th>
                <th>Perangkat</th>
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
elseif ($page=="form3_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form3/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
              <div class="col-md-12">
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
elseif ($page=="form3_metode")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form3/simpan_metode');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <input type="hidden" name="id2" value="<?= $id2; ?>">
    <input type="hidden" name="id3" value="<?= $id3; ?>">
    <input type="hidden" name="id4" value="<?= $id4; ?>">
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
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Perangkat Asesmen</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($metode as $rowmetode){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowmetode['id_metode'];?>" <?php if(in_array($rowmetode['id_metode'],explode(",", $metode_form_detil))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rowmetode['nama_metode'] ?></td>
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
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });  
  }); 
</script>
<?php
}
elseif ($page=="form3_perangkat")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form3/simpan_perangkat');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <input type="hidden" name="id2" value="<?= $id2; ?>">
    <input type="hidden" name="id3" value="<?= $id3; ?>">
    <input type="hidden" name="id4" value="<?= $id4; ?>">
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
          <div class="col-md-12">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Perangkat Asesmen</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($perangkat as $rowperangkat){
        ?>
        <tr>
          <td style="vertical-align:middle;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rowperangkat['id_perangkat'];?>" <?php if(in_array($rowperangkat['id_perangkat'],explode(",", $perangkat_form_detil))) echo 'checked="checked"'; ?> >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: top;"><?= $rowperangkat['nama_perangkat'] ?></td>
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
    $('#modal-default').on('shown.bs.modal', function () {
           var table = $('#example1').DataTable();
           table.columns.adjust();
    });  
  }); 
</script>
<?php
}
elseif ($page=="form3_pertanyaan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form3/simpan_pertanyaan');?>" onClick="return cek();">
    <input type="hidden" name="id_indikator" value="<?= $id_indikator; ?>">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <input type="hidden" name="id2" value="<?= $id2; ?>">
    <input type="hidden" name="id3" value="<?= $id3; ?>">
    <input type="hidden" name="id4" value="<?= $id4; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">     
          <div class="col-md-6">
              <label>Poin yang di amati</label>
              <?php
                input_textareacustom("poin_indikator",$poin_indikator," id='editor1' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>
          <div class="col-md-6">
              <label>Indikator Ketercapaian</label>
              <?php
                input_textareacustom("ketercapaian_indikator",$ketercapaian_indikator," id='editor3' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>          
          <div class="col-md-6">
              <label>Pertanyaan</label>
              <?php
                input_textareacustom("pertanyaan_indikator",$pertanyaan_indikator," id='editor2' rows='5' cols='50' class='form-control' ","");
              ?>
          </div>

          <div class="col-md-6">
              <label>Standar Jawaban</label>
              <?php
                input_textareacustom("jawaban_indikator",$jawaban_indikator," id='editor4' rows='5' cols='50' class='form-control' ","");
              ?>
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
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor3', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor4', {enterMode: CKEDITOR.ENTER_BR});
    }); 
</script>
<?php
}
elseif ($page=="form4")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form4_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="4">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form4_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form4_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('master_kredensial/form4/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $title ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Poin yang di amati</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_indikator'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_indikator'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['poin_indikator'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;"></th>
                <th style="display:none;"></th>
                <th style="width:7%;text-align: center;">Urutan</th>
                <th>Elemen</th>
                <th>Asesmen</th>
                <th>Indikator Unjuk Kerja</th>
                <th>Poin yang diamati</th>
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
elseif ($page=="form4_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
              <div class="col-md-12">
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
elseif ($page=="form4b")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form4b_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4b/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="5">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form4b_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4b/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form4b_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('master_kredensial/form4b/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $title ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pertanyaan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator Ketercapaian</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_indikator'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_indikator'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['pertanyaan_indikator'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['ketercapaian_indikator'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;"></th>
                <th style="display:none;"></th>
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Elemen</th>
                <th>Asesmen</th>
                <th>Indikator Unjuk Kerja</th>
                <th>Pertanyaan</th>
                <th>Indikator Ketercapaian</th>
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
elseif ($page=="form4b_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4b/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
              <div class="col-md-12">
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
elseif ($page=="form4c")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form4c_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4c/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="6">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form4c_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4c/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form4c_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('master_kredensial/form4c/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $title ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Indikator</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Pertanyaan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Standar Jawaban</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_indikator'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_indikator'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;">
            <?php 
            echo $rownkr_asesmen['pertanyaan_indikator']?>
            <br><div class="form-group">
            <?php
            if($rownkr_asesmen['jenis_soal'] > 0){ //pilihan
              $soal = $this->m_kredensial->ambil_soal_opsie($rownkr_asesmen['id_indikator']);
              if($rownkr_asesmen['jenis_soal'] == 1){ // pilihan
                foreach($soal as $rowsoal){
            ?>
                <label>
                  <input type="radio" onclick="return false;" <?php if( $rowsoal['answer'] == 1){ echo 'checked'; } ?> class="minimal">&nbsp;&nbsp;<?= $rowsoal['nama_soal_opsi'] ?>
                </label><br>
            <?php
                }
              }
              if($rownkr_asesmen['jenis_soal'] == 2){ // ganda
                foreach($soal as $rowsoal){
            ?>
                <label>
                  <input type="checkbox" onclick="return false;" <?php if( $rowsoal['answer'] == 1){ echo 'checked'; } ?> class="minimal">&nbsp;&nbsp;<?= $rowsoal['nama_soal_opsi'] ?>
                </label><br>
            <?php
                }                
              }
              ?>
              </div>
            <?php
            }
            ?>            
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['jawaban_indikator'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;"></th>
                <th style="vertical-align: middle; display:none;"></th>
                <th style="vertical-align: middle; width: 5%;text-align: center;">Urutan</th>
                <th style="vertical-align:middle;">Elemen</th>
                <th style="vertical-align:middle;">Asesmen</th>
                <th style="vertical-align:middle;">Indikator Unjuk Kerja</th>
                <th style="vertical-align:middle;">Pertanyaan</th>
                <th style="vertical-align:middle;">Jenis</th>
                <th style="vertical-align:middle;">Standar Jawaban</th>
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
elseif ($page=="form4c_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4c/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
              <div class="col-md-12">
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
elseif ($page=="form4d")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form4d_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4d/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="7">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form4d_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form4d/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="langkah")
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
                <th>Langkah</th>
              </tr>
            </thead>
          </table>
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
elseif ($page=="langkah_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/langkah/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama Langkah</label>
                  <?php
                    input_text("nama_pra_asesmen",$nama_pra_asesmen,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="langkah_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/langkah/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="barcode_pra_asesmen" value="<?= $barcode_pra_asesmen; ?>">
    <input type="hidden" name="id_pra_asesmen" value="<?= $id_pra_asesmen; ?>">
    <input type="hidden" name="pembuat_pra_asesmen" value="<?= $pembuat_pra_asesmen; ?>">
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
              <div class="col-md-12">
                  <label>Nama Langkah</label>
                  <?php
                    input_text("nama_pra_asesmen",$nama_pra_asesmen,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="kegiatan")
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
                <th>Langkah</th>
                <th>Kegiatan</th>
                <th>Profesi</th>
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
elseif ($page=="kegiatan_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/kegiatan/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama Kegiatan</label>
            <?php
              input_textareacustom("nama_pra_detil",$nama_pra_detil," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?> 
              </div>    
              <div class="col-md-12">
                  <label>Langkah</label>
                    <?php
                      input_pdselect2("barcode_pra_asesmen",$cmd_pra_asesmen,$barcode_pra_asesmen);

                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Profesi</label>
                    <?php
                  input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"Semua Profesi");
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="kegiatan_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/kegiatan/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_pra_detil" value="<?= $id_pra_detil; ?>">
    <input type="hidden" name="barcode_pra_detil" value="<?= $barcode_pra_detil; ?>">
    <input type="hidden" name="pembuat_pra_detil" value="<?= $pembuat_pra_detil; ?>">
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
              <div class="col-md-12">
                  <label>Nama Kegiatan</label>
            <?php
              input_textareacustom("nama_pra_detil",$nama_pra_detil," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
            ?>  
              </div>    
              <div class="col-md-12">
                  <label>Langkah</label>
                    <?php
                      input_pdselect2("barcode_pra_asesmen",$cmd_pra_asesmen,$barcode_pra_asesmen);
                    ?>          
              </div>
              <div class="col-md-12">
                  <label>Profesi</label>
                    <?php
                  input_pdselect2fleksibel("id_jabatan","id_jabatan",$cmd_jabatan_null,"id_jabatan","nama_jabatan",$id_jabatan,"Semua Profesi");
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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="form5")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form5_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form5/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="8">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form5_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form5/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form5_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('master_kredensial/form5/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $title ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                  input_pdselect2fleksibel("id3","id3",$cmd_jabatan,"id_jabatan","nama_jabatan",$id3,"Semua Profesi");
            //    input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Langkah</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kegiatan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_pra_detil'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_pra_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_pra_detil'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_jabatan'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Langkah</th>
                <th>Kegiatan</th>
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
elseif ($page=="form5_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form5/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
              <div class="col-md-12">
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
elseif ($page=="form6")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form6_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form6/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="9">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form6_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form6/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form6_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('master_kredensial/form6/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $title ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title"><?= $kode_unit ?> : <?= $nama_kompetensi ?> : <?= $nama_jabatan ?></h3>
    </div>
      <div class="box-body">
        <div class="col-md-6">
            <label>Elemen</label>
              <?php
                input_pdselect2("id2",$cmd_elemen,$id2);
              ?>
        </div>
        <div class="col-md-6">
            <label>Jabatan</label>
              <?php
                  input_pdselect2fleksibel("id3","id3",$cmd_jabatan,"id_jabatan","nama_jabatan",$id3,"Semua Profesi");
            //    input_pdselect2("id3",$cmd_jabatan,$id3);
              ?>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
      </div>
    </div>
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Langkah</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kegiatan</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Jabatan</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_pra_detil'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_pra_asesmen'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_pra_detil'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_jabatan'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="display:none;"></th>
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Langkah</th>
                <th>Kegiatan</th>
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
elseif ($page=="form6_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form6/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
              <div class="col-md-12">
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
elseif ($page=="form7")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form7_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form7/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="10">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form7_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form7/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form8")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form8_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form8/simpan_tambah');?>" onClick="return cek();">
            <input type="hidden" name="id_jenis_form" value="11">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form8_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form8/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="kat_kaji_ulang")
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
                <th>Kategori Komponen dan Aspek yang dikaji ulang</th>
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
elseif ($page=="kat_kaji_ulang_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/kat_kaji_ulang/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_kat_kaji",$nama_kat_kaji,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="kat_kaji_ulang_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/kat_kaji_ulang/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kat_kaji" value="<?= $id_kat_kaji; ?>">
    <input type="hidden" name="pembuat_kat_kaji" value="<?= $pembuat_kat_kaji; ?>">
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
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_text("nama_kat_kaji",$nama_kat_kaji,"maxlength='255' required","Masukkan Nama","text");
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
elseif ($page=="kaji_ulang")
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
                <th>Komponen dan Aspek yang dikaji ulang</th>
                <th>Kategori</th>
                <th>Form</th>
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
elseif ($page=="kaji_ulang_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/kaji_ulang/simpan_tambah');?>" onClick="return cek();">
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
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_textareacustom("nama_kaji_ulang",$nama_kaji_ulang," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
                  ?>  
              </div>    
              <div class="col-md-6">
                  <label>Kategori</label>
                    <?php
                  input_pdselect2fleksibel("id_kat_kaji","id_kat_kaji",$cmd_kat_kaji,"id_kat_kaji","nama_kat_kaji",$id_kat_kaji,"Tanpa Kategori");
                    ?>          
              </div>
              <div class="col-md-6">
                  <label>Form</label>
                    <?php
                      input_pdselect2("id_jenis_form",$cmd_form,$id_jenis_form);

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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="kaji_ulang_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/kaji_ulang/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_kaji_ulang" value="<?= $id_kaji_ulang; ?>">
    <input type="hidden" name="pembuat_kaji_ulang" value="<?= $pembuat_kaji_ulang; ?>">
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
              <div class="col-md-12">
                  <label>Nama</label>
                  <?php
                    input_textareacustom("nama_kaji_ulang",$nama_kaji_ulang," id='editor1' rows='3' cols='20' class='form-control' ","Keterangan");
                  ?>  
              </div>    
              <div class="col-md-6">
                  <label>Kategori</label>
                    <?php
                  input_pdselect2fleksibel("id_kat_kaji","id_kat_kaji",$cmd_kat_kaji,"id_kat_kaji","nama_kat_kaji",$id_kat_kaji,"Tanpa Kategori");
                    ?>          
              </div>
              <div class="col-md-6">
                  <label>Form</label>
                    <?php
                      input_pdselect2("id_jenis_form",$cmd_form,$id_jenis_form);

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
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
}); 
</script>
<?php
}
elseif ($page=="form9a")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form9a_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form9a/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="12">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form9a_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form9a/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form9a_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('master_kredensial/form9a/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $title ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Komponen Umpan Balik dan Kaji Ulang Asesmen</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_kaji_ulang'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_kaji_ulang'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_kat_kaji'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="display:none;"></th>
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Komponen Umpan Balik dan Kaji Ulang Asesmen</th>
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
elseif ($page=="form9a_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form9a/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
              <div class="col-md-12">
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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
elseif ($page=="form9b")
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
                <th>Kode Unit</th>
                <th>Judul Unit</th>
                <th style="width:20%;">Instansi</th>
                <th style="width:20%;">Jabatan</th>
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
elseif ($page=="form9b_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form9b/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_jenis_form" value="13">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form9b_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form9b/simpan_edit');?>" onClick="return cek();">
    <input type="hidden" name="id_form" value="<?= $id_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
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
              <div class="col-md-12">
                  <label>Kode Unit</label>
                  <?php
                    input_pdselect2("id_kompetensi",$cmd_kompetensi_in,$id_kompetensi);
                  ?>  
              </div>    
              <div class="col-md-12">
                  <label>Instansi</label>
                    <?php
                      input_pdselect2("id_instansi",$ambil_data_rujukan_working,$id_instansi);
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
elseif ($page=="form9b_seting")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('<?php echo base_url();?>assets/images/details_close.png') no-repeat center center;
}
</style>
<div class="content-wrapper">
  <section class="content-header">
      <h1>
        <?php echo $header; ?> 
      </h1>
  </section>
  <section class="content">
  <?php echo form_open_multipart('master_kredensial/form9b/seting/'.$id.'/'.$id2.'/'.$id3,' id="signupform" ');
    input_text("id_form",$id_form,"","","hidden");
    input_text("barcode_form",$id,"","","hidden");
  ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
          <div class="box-header with-border">
              <h3 class="box-title"><?= $title ?></h3>           
                <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
                </div>
          </div>
          <div class="box-body table-responsive">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;text-align: center;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Umpan Balik dan Kaji Ulang Asesmen (Kesenjangan)</th>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Kategori</th>
              </tr>
              </thead>
              <tbody>
        <?php
        foreach($nkr_asesmen as $rownkr_asesmen){
        ?>
        <tr>
          <td style="vertical-align:middle;text-align: center;">
            <div class="checkbox">
            <label>
              <input type="checkbox" class="child" name="chk[]" value="<?php echo $rownkr_asesmen['id_kaji_ulang'];?>" >
            </label>
            </div>
          </td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_kaji_ulang'] ?></td>
          <td style="font-weight: bold; vertical-align: middle;"><?= $rownkr_asesmen['nama_kat_kaji'] ?></td>
        </tr>
        <?php  
        }
        ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
               <button type="submit" name="action" value="BtnSimpan" class="btn btn-app">
                <i class="fa fa-save"></i> Simpan
              </button>         
          </div>
        </div>    
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
                <th style="display:none;"></th>
                <th style="width: 5%;text-align: center;">Urutan</th>
                <th>Komponen Umpan Balik dan Kaji Ulang Asesmen</th>
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
elseif ($page=="form9b_urutan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('master_kredensial/form9b/simpan_urutan');?>" onClick="return cek();">
    <input type="hidden" name="id_form_detil" value="<?= $id_form_detil; ?>">
    <input type="hidden" name="id_jenis_form" value="<?= $id_jenis_form; ?>">
    <input type="hidden" name="pembuat_form" value="<?= $pembuat_form; ?>">
    <input type="hidden" name="barcode_form" value="<?= $barcode_form; ?>">
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
              <div class="col-md-12">
                  <label>No Urut</label>
        <?php 
        input_textcustom("no_urut_detil",$no_urut_detil,"maxlength='3' required class='form-control'
          onkeypress='return event.keyCode > 47 && event.keyCode < 58'" ,"Masukkan No Urutan","text"); ?>
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