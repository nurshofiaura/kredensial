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
elseif ($page=="pengajuan_kompetensi")
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

<?= ra_btn("Tambah Validator", [
    "icon" => "fa fa-plus",
    "data-size" => "btn-sm",
    "data-modal-url" => base_url("admin_asesor/pengajuan_kompetensi/tambah"),
    "data-modal-title" => "Tambah Validator",
    "data-modal-method" => "GET",
    "data-require-select" => "1"
]) ?>
</div>
                    <div class="app-datatable-default overflow-auto">
                      <!--<table id="dttb" class="display w-100 default-data-table">-->
                      <table id="dttb" class="table table-Variants table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Kompetensi</th>
                                <th>Kategori</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
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
  <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
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
elseif ($page=="tambah"){
?>
<style>
/* Warna-warni baris untuk DataTable di dalam Modal */
#dttb_pilih_validator tbody tr.table-primary { background-color: #cfe2ff !important; }
#dttb_pilih_validator tbody tr.table-secondary { background-color: #e2e3e5 !important; }
#dttb_pilih_validator tbody tr.table-success { background-color: #d1e7dd !important; }
#dttb_pilih_validator tbody tr.table-danger { background-color: #f8d7da !important; }
#dttb_pilih_validator tbody tr.table-warning { background-color: #fff3cd !important; }
#dttb_pilih_validator tbody tr.table-info { background-color: #cff4fc !important; }

/* Menghilangkan efek hover bawaan bootstrap agar warna rainbow tidak tertutup */
#dttb_pilih_validator.table-hover tbody tr:hover {
    filter: brightness(95%);
}

/* --- Mempermanis Header Tabel --- */
#dttb_pilih_validator thead {
    /* Gradasi linear: kuning keemasan ke kuning terang */
    background: linear-gradient(45deg, #f0c14b 0%, #f7d678 100%) !important;
    color: #fff !important; /* Teks header putih */
    text-transform: uppercase; /* Huruf kapital */
    font-size: 11px; /* Ukuran font sedikit dikecilkan */
    font-weight: 700;
}

/* Pastikan semua cell di header mendapatkan background dan warna teks */
#dttb_pilih_validator thead th {
    background-color: transparent !important;
    color: #fff !important;
    border-bottom: 2px solid rgba(255, 255, 255, 0.2) !important;
    border-left: 1px solid rgba(255, 255, 255, 0.1) !important;
    vertical-align: middle;
}

/* Memperbaiki warna icon sorting DataTable agar putih */
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after {
    color: #fff !important; 
    opacity: 0.8 !important;
}

/* Pastikan checkbox header berjarak pas */
#dttb_pilih_validator thead th:first-child {
    border-left: none !important;
}
</style>
<input type="hidden" id="id_pengajuan_hidden" value="<?= $id_pengajuan ?>">

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-none mb-0" style="border:none;">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">PILIH VALIDATOR</h5>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="dttb_pilih_validator" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" id="checkAll" disabled class="form-check-input"></th>
                                    <th>Nama Validator</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>NIP</th>
                                    <th>Jabatan</th>
                                    <th>Unit</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between">
                    <div id="count_selected" class="small fw-bold text-primary">0 terpilih</div>
                    <button type="button" id="btnProsesValidator" class="btn btn-primary">
                        Simpan Validator
                    </button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
(function() {
    let selectedIds = [];

    $(document).ready(function() {
        const table = $('#dttb_pilih_validator').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('admin_asesor/pengajuan_kompetensi/data_validator') ?>",
                type: "POST"
            },
            createdRow: function(row, data, dataIndex) {
                    const warna = [
                        "table-primary",
                        "table-secondary",
                        "table-success",
                        "table-danger",
                        "table-warning",
                        "table-info"
                    ];

                    // Hitung index baris secara global (lintas halaman)
                    let globalIndex = this.api().page.info().start + dataIndex;
                    
                    // Pasang class warna berdasarkan sisa bagi (modulo)
                    $(row).addClass(warna[globalIndex % warna.length]);
                },
dom: "<'row mb-3'<'col-md-6'l><'col-md-6 text-end'f>>" + // Tambahkan mb-3 di sini
     "tr" + 
     "<'row mt-3'<'col-md-5'i><'col-md-7 text-end'p>>",
            columns: [
                {
                    data: "id_pegawai",
                    className: "text-center",
                    orderable: false,
                    render: function(data) {
                        let checked = selectedIds.includes(data.toString()) ? "checked" : "";
                        return `<input type="checkbox" class="row-check form-check-input" value="${data}" ${checked}>`;
                    }
                },
                { data: "nama_pegawai" },
                { data: "no_hp" },
                { data: "email" },
                { data: "nip" },
                { data: "nama_jabatan" },
                { data: "nama_unit" }
            ]
        });

        // Event: Checkbox Satuan
        $('#dttb_pilih_validator').on('change', '.row-check', function() {
            let id = $(this).val().toString();
            if (this.checked) {
                if (!selectedIds.includes(id)) selectedIds.push(id);
            } else {
                selectedIds = selectedIds.filter(x => x !== id);
            }
            $('#count_selected').text(selectedIds.length + " terpilih");
        });

        // Event: Tombol Simpan (Tanpa Serialize Form)
        $('#btnProsesValidator').on('click', function() {
            if (selectedIds.length === 0) {
                Swal.fire("Peringatan", "Pilih minimal satu!", "warning");
                return;
            }

            // Ambil ID Pengajuan langsung dari elemen ID
            let id_pengajuan = $('#id_pengajuan_hidden').val(); 

            $.ajax({
                url: "<?= base_url('admin_asesor/pengajuan_kompetensi/simpan_validator_pilih') ?>",
                type: "POST",
                data: {
                    id_pengajuan: id_pengajuan,
                    ids_validator: selectedIds // Kirim array langsung
                },
                dataType: "json",
                success: function(res) {
                    if (res.ok) {
                        Swal.fire("Sukses", res.msg, "success").then(() => {
                            bootstrap.Modal.getInstance(document.getElementById('modal-default')).hide();
                            if (window.tableLogbook) window.tableLogbook.ajax.reload(null, false);
                        });
                    }
                }
            });
        });
    });
})();
</script>
<?php
}
elseif ($page=="modal_hapus_validator")
{
?>
<form id="form-logbook-modal">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?= $header ?></h5>
                  </div>
                  <input type="hidden" name="id_pengajuan_validator" value="<?= $id_pengajuan_validator ?>">
    <input type="hidden" name="child_table_id" value="<?= $child_table_id ?>">
                  <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">YAKIN AKAN MENGHAPUS : <br>Nama Validator : <?= $nama_pegawai ?></label>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-footer">
                <button type="submit" id="btnSaveLogbook" class="btn btn-success">
                    Hapus
                </button>
                  </div>
                </div>
              </div>
            </div>
</form>
<script>
$(document).ready(function(){
  // =========================
  // SUBMIT FORM AJAX
  // =========================
  $('#form-logbook-modal').on('submit', function(e){
      e.preventDefault();
      let $form = $(this);
      let formData = $form.serialize();

      // tombol loading
      let $btn = $('#btnSaveLogbook');
      $btn.prop('disabled', true).text('Menyimpan...');

      $.ajax({
          url: "<?= base_url('admin_asesor/pengajuan_kompetensi/delete_validator') ?>",
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
              $btn.prop('disabled', false).text('Hapus');
          }
      });
  });
});
</script>
<?php
}
elseif ($page=="form"){
?>
<style>
/* Warna-warni baris untuk DataTable di dalam Modal */
#dttb_pilih_form tbody tr.table-primary { background-color: #cfe2ff !important; }
#dttb_pilih_form tbody tr.table-secondary { background-color: #e2e3e5 !important; }
#dttb_pilih_form tbody tr.table-success { background-color: #d1e7dd !important; }
#dttb_pilih_form tbody tr.table-danger { background-color: #f8d7da !important; }
#dttb_pilih_form tbody tr.table-warning { background-color: #fff3cd !important; }
#dttb_pilih_form tbody tr.table-info { background-color: #cff4fc !important; }

/* Menghilangkan efek hover bawaan bootstrap agar warna rainbow tidak tertutup */
#dttb_pilih_form.table-hover tbody tr:hover {
    filter: brightness(95%);
}

/* --- Mempermanis Header Tabel --- */
#dttb_pilih_form thead {
    /* Gradasi linear: kuning keemasan ke kuning terang */
    background: linear-gradient(45deg, #f0c14b 0%, #f7d678 100%) !important;
    color: #fff !important; /* Teks header putih */
    text-transform: uppercase; /* Huruf kapital */
    font-size: 11px; /* Ukuran font sedikit dikecilkan */
    font-weight: 700;
}

/* Pastikan semua cell di header mendapatkan background dan warna teks */
#dttb_pilih_form thead th {
    background-color: transparent !important;
    color: #fff !important;
    border-bottom: 2px solid rgba(255, 255, 255, 0.2) !important;
    border-left: 1px solid rgba(255, 255, 255, 0.1) !important;
    vertical-align: middle;
}

/* Memperbaiki warna icon sorting DataTable agar putih */
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after {
    color: #fff !important; 
    opacity: 0.8 !important;
}

/* Pastikan checkbox header berjarak pas */
#dttb_pilih_form thead th:first-child {
    border-left: none !important;
}
</style>
<input type="hidden" id="id_pengajuan_validator" value="<?= $id_pengajuan_validator ?>">

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-none mb-0" style="border:none;">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">PILIH FORM</h5>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="dttb_pilih_form" class="table table-bordered table-hover w-100">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" id="checkAll" disabled class="form-check-input"></th>
                                    <th>Nama Form</th>
                                    <th>Jenis Form</th>
                                    <th>Kompetensi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex justify-content-between">
                    <div id="count_selected" class="small fw-bold text-primary">0 terpilih</div>
                    <button type="button" id="btnProsesValidator" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
(function() {
    let selectedIds = <?= json_encode($existing_ids) ?>;

    $(document).ready(function() {
    // Pastikan ID tabel yang digunakan unik, misal: #dttb_pilih_form
        const tableId = '#dttb_pilih_form'; 

        // Jika tabel sudah pernah ada, hancurkan dulu (clean up)
        if ($.fn.DataTable.isDataTable(tableId)) {
            $(tableId).DataTable().destroy();
            $(tableId).empty(); // Mengosongkan isi tabel agar header tidak duplikat
        }
        const tableForm = $(tableId).DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('admin_asesor/pengajuan_kompetensi/data_form') ?>",
                type: "POST",
                data: function(d) {
                    d.id_kompetensi = '<?= $id_kompetensi ?>';
                    d.id_instansi   = '<?= $id_instansi ?>';
                }
            },
            createdRow: function(row, data, dataIndex) {
                    const warna = [
                        "table-primary",
                        "table-secondary",
                        "table-success",
                        "table-danger",
                        "table-warning",
                        "table-info"
                    ];

                    // Hitung index baris secara global (lintas halaman)
                    let globalIndex = this.api().page.info().start + dataIndex;
                    
                    // Pasang class warna berdasarkan sisa bagi (modulo)
                    $(row).addClass(warna[globalIndex % warna.length]);
                },
dom: "<'row mb-3'<'col-md-6'l><'col-md-6 text-end'f>>" + // Tambahkan mb-3 di sini
     "tr" + 
     "<'row mt-3'<'col-md-5'i><'col-md-7 text-end'p>>",
            columns: [
                {
                    data: "coun_form",
                    className: "text-center",
                    orderable: false,
                    render: function(data, type, row) {
                        // Logika pengecekan otomatis:
                        // Jika id_form ada di dalam array selectedIds, maka tambahkan atribut "checked"
                        let isChecked = selectedIds.includes(data.toString()) ? "checked" : "";
                        return `<input type="checkbox" class="row-check form-check-input" value="${data}" ${isChecked}>`;
                    }
                },
                { data: "nama_form" },
                { data: "nama_jenis_form" },
                { data: "nama_kompetensi" }
            ]
        });

        // Event: Checkbox Satuan
        $('#dttb_pilih_form').on('change', '.row-check', function() {
            let id = $(this).val().toString();
            if (this.checked) {
                if (!selectedIds.includes(id)) selectedIds.push(id);
            } else {
                selectedIds = selectedIds.filter(x => x !== id);
            }
            $('#count_selected').text(selectedIds.length + " terpilih");
        });

        // Event: Tombol Simpan (Tanpa Serialize Form)
        $('#btnProsesValidator').on('click', function() {
            if (selectedIds.length === 0) {
                Swal.fire("Peringatan", "Pilih minimal satu!", "warning");
                return;
            }

            // Ambil ID Pengajuan langsung dari elemen ID
            let id_pengajuan_validator = $('#id_pengajuan_validator').val(); 

            $.ajax({
                url: "<?= base_url('admin_asesor/pengajuan_kompetensi/simpan_form') ?>",
                type: "POST",
                data: {
                    id_pengajuan_validator: id_pengajuan_validator,
                    ids_validator: selectedIds // Kirim array langsung
                },
                dataType: "json",
                success: function(res) {
                    if (res.ok) {
                        Swal.fire("Sukses", res.msg, "success").then(() => {
                            bootstrap.Modal.getInstance(document.getElementById('modal-default')).hide();
                            if (window.tableLogbook) window.tableLogbook.ajax.reload(null, false);
                        });
                    }
                }
            });
        });
    });
})();
</script>
<?php
}
//=======================================================
elseif ($page=="pengajuan_kompetensis")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
    <a href="<?php echo $link_awal;?>"
      class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
    </a>
    </section>
    <section class="content">
  <?php echo form_open_multipart('admin_asesor/pengajuan_kompetensi/view/'.$key,' id="signupform" ');
  ?>
    <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">MULTIPLE SEARCH</h3>
    </div>
      <div class="box-body">
        <div class="col-md-12">
          <div class="form-group">
            <label> Ketik pisahkan dengan spasi untuk Pencarian Multi (Nama/Kompetensi/Kode Unit)</label>
              <?php
                input_text("key",$key," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
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
            <th>Kompetensi</th>
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_asesor/pengajuan_kompetensi/simpan_pilih');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_pengajuan" value="<?= $id_pengajuan; ?>">
            <input type="hidden" name="barcode_pengajuan" value="<?= $barcode_pengajuan; ?>">
            <input type="hidden" name="status_pengajuan" value="<?= $status_pengajuan; ?>">
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
                $no=0;
                $arr = array();
                foreach($nkrpengva as $val){
                    $arr[] = $val['id_asesor'];
                }
                $eimplo = implode(",", $arr);
                foreach($struktur as $row){
                ?>
              <tr>
                <td>
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_pegawai'];?>" <?php if(in_array($row['id_pegawai'],explode(",", $eimplo))) echo 'checked="checked"'; ?> >
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_asesor/pengajuan_kompetensi/simpan_pilih_form');?>" onClick="return cek();">
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
elseif ($page=="pengajuan_kompetensi_lihat_form")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_asesor/pengajuan_kompetensi/simpan_lihat_form');?>" onClick="return cek();">
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
                <th style="background-color:#9b0e27;color:white;text-align:center;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Nama</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach($form as $row){
                  if(in_array($row['id_jenis_form'],explode(",", $nkr_form)))
                ?>
              <tr>
                <td style="text-align:center;vertical-align: middle;">
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_jenis_form'];?>" checked="checked" >
                  </label> 
                  </div>
                </td>
                <td style="text-align:left;vertical-align: middle;"><?php echo $row['nama_form']; ?></td>
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
  <?php echo form_open_multipart('admin_asesor/pengajuan_kompetensi/isi_validator/'.$id.'/'.$id2,' id="signupform" ');
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
  <?php echo form_open_multipart('admin_asesor/direktur/view/'.$id,' id="signupform" ');
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_asesor/direktur/simpan_tambah');?>" onClick="return cek();">
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
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_asesor/direktur/simpan_edit');?>" onClick="return cek();">
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
elseif ($page=="pengajuan_rkk")
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
            <th style="text-align:center;width: 8%;">ID</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Kompetensi</th>
            <th>Kategori</th>
            <th>Status</th>
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
elseif ($page=="pengajuan_rkk_tambah_sign")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_asesor/pengajuan_rkk/simpan_tambah_sign');?>" onClick="return cek();">
 <input type="hidden" name="barcode_pengajuan" value="<?= $id ?>">
 <input type="hidden" name="status_pengajuan" value="<?= $id2 ?>">
 <input type="hidden" name="kewenangan" value="<?= $eimplo ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><b></button>KOSONGKAN JIKA TIDAK INGIN MUNCUL</b></h3>
      </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                  <div class="col-md-9">
                      <label>Ambil Kop</label>
                      <?php
                         input_pdselect2("id_gambar",$gambar,$id_gambar);
                      ?>        
                  </div>
                  <div class="col-md-3">
                      <label>Menggunakan KOP?</label>
                      <?php
                         input_pdselect2("kop_signature",$yatidak,$kop_signature);
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Lampiran</label>
                      <?php
                         input_text("lampiran",$lampiran,"maxlength='255' ","Lampiran : ........,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>No</label>
                      <?php
                         input_text("no",$no,"maxlength='255' ","No : .......,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tanggal</label>
                      <?php
                         input_text("tanggal",$tanggal,"maxlength='35' ","Tanggal ....,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Header Atas</label>
                      <?php
                         input_text("header",$header,"maxlength='255' ","LAPORAN ........,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Header Tengah</label>
                      <?php
                         input_text("sub_header",$sub_header,"maxlength='255' ","PERIODE .......,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Header Bawah</label>
                      <?php
                         input_text("sub_sub_header",$sub_sub_header,"maxlength='255' ","RS .......,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                 <div class="col-md-12">
                   <label>Opsi Text Sebelum Tabel</label>
                   <?php
                     input_textareacustom("sebelum",$sebelum," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Text");
                   ?>        
                 </div>
                 <div class="col-md-12">
                   <label>Opsi Text Sesudah Tabel</label>
                   <?php
                     input_textareacustom("sesudah",$sesudah," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Text");
                   ?><div style="font-size: 0.8em;">Untuk opsi tampilkan TTD harap upload TTD di masing-masing akun yang tertera di Nama</div><br>  
                 </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Tampilkan TTD</label>
                      <?php
                         input_pdselect2("kiri_signature",$yatidak,$kiri_signature);
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Tampilkan TTD</label>
                      <?php
                         input_pdselect2("tengah_signature",$yatidak,$tengah_signature);
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Tampilkan TTD</label>
                      <?php
                         input_pdselect2("kanan_signature",$yatidak,$kanan_signature);
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Tanggal</label>
                      <?php
                         input_text("kiri_tgl",$kiri_tgl,"maxlength='255' ","Kota, Tanggal ....,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Tanggal</label>
                      <?php
                         input_text("tengah_tgl",$tengah_tgl,"maxlength='255' ","Kota, Tanggal ....,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Tanggal</label>
                      <?php
                         input_text("kanan_tgl",$kanan_tgl,"maxlength='255' ","Kota, Tanggal ....,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Atas</label>
                      <?php
                         input_text("kiri_top",$kiri_top,"maxlength='255' ","Mengetahui,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Atas</label>
                      <?php
                         input_text("tengah_top",$tengah_top,"maxlength='255' ","Mengetahui,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Atas</label>
                      <?php
                         input_text("kanan_top",$kanan_top,"maxlength='255' ","Mengetahui,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Tengah</label>
                      <?php
                         input_text("kiri_middle",$kiri_middle,"maxlength='255' ","Nama Jabatan","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Tengah</label>
                      <?php
                         input_text("tengah_middle",$tengah_middle,"maxlength='255' ","Nama Jabatan","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Tengah</label>
                      <?php
                         input_text("kanan_middle",$kanan_middle,"maxlength='255' ","Nama Jabatan","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12" style="padding-bottom: 15px;">
                  <div class="col-md-4">
                      <label>Kiri Nama</label>
                      <?php
                         input_pdselect2fleksibel("kiri_nama","kiri_nama",$struktur,"barcode_pegawai","nama_pegawai",$kiri_nama,"Kosongkan");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Nama</label>
                      <?php
                         input_pdselect2fleksibel("tengah_nama","tengah_nama",$struktur,"barcode_pegawai","nama_pegawai",$tengah_nama,"Kosongkan");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Nama</label>
                      <?php
                         input_pdselect2fleksibel("kanan_nama","kanan_nama",$struktur,"barcode_pegawai","nama_pegawai",$kanan_nama,"Kosongkan");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Bawah</label>
                      <?php
                         input_text("kiri_nip",$kiri_nip,"maxlength='255' ","Nip Penjabat","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Bawah</label>
                      <?php
                         input_text("tengah_nip",$tengah_nip,"maxlength='255' ","Nip Penjabat","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Bawah</label>
                      <?php
                         input_text("kanan_nip",$kanan_nip,"maxlength='255' ","Nip Penjabat","text");
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
$(document).ready(function() {
  $('.select2').select2()
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}
elseif ($page=="pengajuan_rkk_tambah_kewenangan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_asesor/pengajuan_rkk/simpan_tambah_kewenangan');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            <input type="hidden" name="id_signature" value="<?= $id; ?>">
            <input type="hidden" name="status_pengajuan" value="<?= $status_pengajuan; ?>">
            <input type="hidden" name="barcode_pengajuan" value="<?= $barcode_pengajuan; ?>">
          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">SILAHKAN PILIH KEWENANGAN</h3>
      </div>
        <div class="box-body">
            <table id="example1" width="100%" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th style="background-color:#9b0e27;color:white;vertical-align:middle;width: 5%;">
                  <input name="select_all" class="checkall" type="checkbox" />
                </th>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Kewenangan</th>
                <th style="background-color:#9b0e27;color:white;text-align:left;">Kode Unit [Kompetensi]</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $no=0;
/*                $arr = array();
                foreach($nkrpengva as $val){
                    $arr[] = $val['id_asesor'];
                }
                $eimplo = implode(",", $arr);*/
                foreach($struktur as $row){
                ?>
              <tr>
                <td>
                  <div class="checkbox">
                  <label>
                    <input type="checkbox" class="child" name="chk[]" value="<?= $row['coun_kewenangan'] ?>" <?php if(in_array($row['coun_kewenangan'],explode(",", $nkrpengva['tambahan']))) echo 'checked="checked"'; ?> >
                  </label>
                  </div>
                </td>
                <td style="text-align:left;"><?= $row['nama_kewenangan'] ?></td>
                <td style="text-align:left;"><?= $row['kode_unit'].' <strong>['.$row['nama_kompetensi'].']</strong>' ?></td>
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
elseif ($page=="pengajuan_rkk_edit_sign")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_asesor/pengajuan_rkk/simpan_edit_sign');?>" onClick="return cek();">
 <input type="hidden" name="id_signature" value="<?= $id ?>">
 <input type="hidden" name="barcode_pengajuan" value="<?= $barcode_pengajuan ?>">
 <input type="hidden" name="status_pengajuan" value="<?= $status_pengajuan ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
    <div class="box-body">     
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><b></button>KOSONGKAN JIKA TIDAK INGIN MUNCUL</b></h3>
      </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                  <div class="col-md-9">
                      <label>Ambil Kop</label>
                      <?php
                         input_pdselect2("id_gambar",$gambar,$id_gambar);
                      ?>        
                  </div>
                  <div class="col-md-3">
                      <label>Menggunakan KOP?</label>
                      <?php
                         input_pdselect2("kop_signature",$yatidak,$kop_signature);
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Lampiran</label>
                      <?php
                         input_text("lampiran",$lampiran,"maxlength='255' ","Lampiran : ........,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>No</label>
                      <?php
                         input_text("no",$no,"maxlength='255' ","No : .......,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tanggal</label>
                      <?php
                         input_text("tanggal",$tanggal,"maxlength='35' ","Tanggal ....,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Header Atas</label>
                      <?php
                         input_text("header",$header,"maxlength='255' ","LAPORAN ........,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Header Tengah</label>
                      <?php
                         input_text("sub_header",$sub_header,"maxlength='255' ","PERIODE .......,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Header Bawah</label>
                      <?php
                         input_text("sub_sub_header",$sub_sub_header,"maxlength='255' ","RS .......,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                 <div class="col-md-12">
                   <label>Opsi Text Sebelum Tabel</label>
                   <?php
                     input_textareacustom("sebelum",$sebelum," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Text");
                   ?>        
                 </div>
                 <div class="col-md-12">
                   <label>Opsi Text Sesudah Tabel</label>
                   <?php
                     input_textareacustom("sesudah",$sesudah," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Text");
                   ?><div style="font-size: 0.8em;">Untuk opsi tampilkan TTD harap upload TTD di masing-masing akun yang tertera di Nama</div><br>  
                 </div>
                </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Tampilkan TTD</label>
                      <?php
                         input_pdselect2("kiri_signature",$yatidak,$kiri_signature);
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Tampilkan TTD</label>
                      <?php
                         input_pdselect2("tengah_signature",$yatidak,$tengah_signature);
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Tampilkan TTD</label>
                      <?php
                         input_pdselect2("kanan_signature",$yatidak,$kanan_signature);
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Tanggal</label>
                      <?php
                         input_text("kiri_tgl",$kiri_tgl,"maxlength='255' ","Kota, Tanggal ....,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Tanggal</label>
                      <?php
                         input_text("tengah_tgl",$tengah_tgl,"maxlength='255' ","Kota, Tanggal ....,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Tanggal</label>
                      <?php
                         input_text("kanan_tgl",$kanan_tgl,"maxlength='255' ","Kota, Tanggal ....,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Atas</label>
                      <?php
                         input_text("kiri_top",$kiri_top,"maxlength='255' ","Mengetahui,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Atas</label>
                      <?php
                         input_text("tengah_top",$tengah_top,"maxlength='255' ","Mengetahui,","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Atas</label>
                      <?php
                         input_text("kanan_top",$kanan_top,"maxlength='255' ","Mengetahui,","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Tengah</label>
                      <?php
                         input_text("kiri_middle",$kiri_middle,"maxlength='255' ","Nama Jabatan","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Tengah</label>
                      <?php
                         input_text("tengah_middle",$tengah_middle,"maxlength='255' ","Nama Jabatan","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Tengah</label>
                      <?php
                         input_text("kanan_middle",$kanan_middle,"maxlength='255' ","Nama Jabatan","text");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12" style="padding-bottom: 15px;">
                  <div class="col-md-4">
                      <label>Kiri Nama</label>
                      <?php
                         input_pdselect2fleksibel("kiri_nama","kiri_nama",$struktur,"barcode_pegawai","nama_pegawai",$kiri_nama,"Kosongkan");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Nama</label>
                      <?php
                         input_pdselect2fleksibel("tengah_nama","tengah_nama",$struktur,"barcode_pegawai","nama_pegawai",$tengah_nama,"Kosongkan");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Nama</label>
                      <?php
                         input_pdselect2fleksibel("kanan_nama","kanan_nama",$struktur,"barcode_pegawai","nama_pegawai",$kanan_nama,"Kosongkan");
                      ?>        
                  </div>
               </div>
                <div class="col-md-12">
                  <div class="col-md-4">
                      <label>Kiri Bawah</label>
                      <?php
                         input_text("kiri_nip",$kiri_nip,"maxlength='255' ","Nip Penjabat","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Tengah Bawah</label>
                      <?php
                         input_text("tengah_nip",$tengah_nip,"maxlength='255' ","Nip Penjabat","text");
                      ?>        
                  </div>
                  <div class="col-md-4">
                      <label>Kanan Bawah</label>
                      <?php
                         input_text("kanan_nip",$kanan_nip,"maxlength='255' ","Nip Penjabat","text");
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
$(document).ready(function() {
  $('.select2').select2()
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
});
</script>
<?php
}