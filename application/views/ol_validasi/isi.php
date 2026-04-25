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
<style>
/* FORCE hover pagination datatables */
.app-datatable-default
.dataTables_wrapper
.dataTables_paginate
a.paginate_button:not(.current):not(.disabled):hover {
  background-color: rgba(var(--primary), 1) !important;
  color: var(--white) !important;
  border: 1px dashed rgba(var(--primary), 0.8) !important;
}

/* reset hover bawaan browser */
.app-datatable-default
.dataTables_wrapper
.dataTables_paginate
a.paginate_button {
  transition: all .15s ease;
}

</style>
        <main>
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Tabel pegawai</h5><br>

<!--<button class="ra-btn" data-mode="rb-rs">Simpan</button>
<button class="ra-btn"
        data-mode="fw-rs"
        data-color="btn-success">
  Approve
</button>
<button class="ra-btn"
        data-mode="fs-rw"
        data-shape="btn-pill">
  Update
</button>
<button class="ra-btn" data-mode="rb-rs-icon">
  <i class="fa fa-trash"></i>
</button>
<button class="ra-btn" data-size="btn-xs">XS</button>
<button class="ra-btn" data-size="btn-md">MD</button>
<button class="ra-btn" data-loading="left">Loading</button>
<button class="ra-btn" data-loading="right">Wait</button>
<button class="ra-btn" data-loading="icon"></button>
<button class="ra-btn" data-loading="grow"></button>
<hr>-->
<div id="action-buttons">
<!--  <button id="btn-add-modal" class="ra-btn"  data-size="btn-sm">Tambah</button>
  <button id="btn-edit-modal" class="ra-btn"  data-size="btn-sm" disabled>Edit</button>
  <button id="btn-delete" class="ra-btn"  data-size="btn-sm" disabled>Hapus</button>-->
  <button id="btn-validasi" class="ra-btn"  data-size="btn-sm" disabled>Validasi</button>
<!--  <button id="btn-print" class="ra-btn"  data-size="btn-sm">Print</button>
  <button id="btn-print-selected" class="ra-btn"  data-size="btn-sm" disabled>Print Selected</button>-->
  <button id="btn-reload" class="ra-btn"  data-size="btn-sm"> <i class="<?= $thenarrayreload ?>"></i> Reload</button>
</div>



                  </div>
                  <div class="card-body px-0">
                    <div class="app-datatable-default overflow-auto">
                      <table id="dttb" class="display w-100 child-row-datatable" data-server="true">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Unit</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th><input type="text" class="form-control" placeholder="Cari Nama"></th>
                            <th><input type="text" class="form-control" placeholder="Cari NIP"></th>
                            <th><input type="text" class="form-control" placeholder="Cari Unit"></th>
                            <th><input type="text" class="form-control" placeholder="Cari Status"></th>
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
        <!-- MODAL DEFAULT -->
        <div class="modal fade" id="modal-default" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Validasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <!-- ajax load -->
              </div>
            </div>
          </div>
        </div>
<?php
}
elseif ($page=="validasi_validasi")
{
?>
        <main>
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Tabel pegawai</h5><br>

<!--<button class="ra-btn" data-mode="rb-rs">Simpan</button>
<button class="ra-btn"
        data-mode="fw-rs"
        data-color="btn-success">
  Approve
</button>
<button class="ra-btn"
        data-mode="fs-rw"
        data-shape="btn-pill">
  Update
</button>
<button class="ra-btn" data-mode="rb-rs-icon">
  <i class="fa fa-trash"></i>
</button>
<button class="ra-btn" data-size="btn-xs">XS</button>
<button class="ra-btn" data-size="btn-md">MD</button>
<button class="ra-btn" data-loading="left">Loading</button>
<button class="ra-btn" data-loading="right">Wait</button>
<button class="ra-btn" data-loading="icon"></button>
<button class="ra-btn" data-loading="grow"></button>
<hr>-->
<div id="action-buttons">
<!--<button id="btn-validasi"
        class="ra-btn"
        data-size="btn-sm"
        disabled>
  <i class="fa fa-pencil"></i> Validasi
</button>-->
  <button id="btn-kembali" class="ra-btn"  data-size="btn-sm">  <i class="<?= $thenarrayprev ?>"></i> Kembali</button>
<button id="btn-validasi"
        class="ra-btn"
        data-size="btn-sm"
        disabled>
  <i class="fa fa-pencil"></i> Validasi
</button>
<!--  <button id="btn-add-modal" class="ra-btn"  data-size="btn-sm">Tambah</button>
  <button id="btn-edit-modal" class="ra-btn"  data-size="btn-sm" disabled>Edit</button>
  <button id="btn-delete" class="ra-btn"  data-size="btn-sm" disabled>Hapus</button>-->
<!--  <button id="btn-validasi" class="ra-btn"  data-size="btn-sm" disabled>Validasi</button>-->
<!--  <button id="btn-print" class="ra-btn"  data-size="btn-sm">Print</button>
  <button id="btn-print-selected" class="ra-btn"  data-size="btn-sm" disabled>Print Selected</button>-->
  <button id="btn-reload" class="ra-btn"  data-size="btn-sm" > <i class="<?= $thenarrayreload ?>"></i> Reload</button>
</div>



                  </div>
                  <div class="card-body px-0">
                    <div class="app-datatable-default overflow-auto">
                      <table id="dttb" class="display w-100 datatable child-row-datatable" data-server="true" data-barcode="<?= $this->uri->segment(4) ?>">
                        <thead>
                          <tr>
                            <th>Nama</th>
                            <th>Kewenangan</th>
                            <th>Kompetensi</th>
                            <th>Sifat Kewenangan</th>
                          </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th><input type="text" class="form-control" placeholder="Cari Nama"></th>
                            <th><input type="text" class="form-control" placeholder="Cari Kewenangan"></th>
                            <th><input type="text" class="form-control" placeholder="Cari Kompetensi"></th>
                            <th><input type="text" class="form-control" placeholder="Cari Sifat Kewenangan"></th>
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
        <!-- MODAL DEFAULT -->
<?php  
 $array_modal = array('secondary','danger','info','warning','success','primary');
 $m = array_rand($array_modal);
 $bgm = $array_modal[$m];
 /*
  modal-dialog modal-dialog-centered modal-fullscreen-xl-down
  modal-dialog modal-dialog-centered modal-fullscreen
  modal-dialog modal-dialog-centered
  modal-dialog modal-dialog-centered modal-dialog-scrollable
 */
?>
<div class="modal fade" id="box_7" tabindex="-1" aria-hidden="true">
    <!-- GANTI UKURAN DI SINI -->
    <!-- modal-sm | modal-lg | modal-xl | modal-fullscreen | modal-dialog-scrollable 
    modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable
    -->
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header bg-<?= $bgm ?>-900">
        <h5 class="modal-title text-white"><?= $header ?></h5>
      <button type="button" class="btn-close m-0 fs-5" data-size="btn-sm" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        
      </div>

      <div class="modal-footer">
        <button type="button" class="btn ra-btn" data-size="btn-sm" data-bs-dismiss="modal">
          Close
        </button>
      </div>
    </div>
  </div>
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
<?php 
 $array_modal = array('secondary','danger','info','warning','success','primary');
 $m = array_rand($array_modal);
 $bgm = $array_modal[$m];
?>
    <FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('ol_validasi/validasi/simpan_rkk');?>" onClick="return cek();">
          <input type="hidden" name="id_kewenangan" value="<?= $id_kewenangan; ?>">
          <input type="hidden" name="barcode_pegawai" value="<?= $barcode_pegawai; ?>">


          <div class="card hover-effect">
            <div class="card-header">
              <h5>Silahkan Pilih Sifat Kewenangan</h5>
            </div>
            <div class="card-body">
              <form class="app-form">
                <div class="row">
                 <div class="col-md-6">
                     <label>Validasi</label>
                     <?php
                    input_pdselect2("id_sifat_kewenangan",$sifat_kewenangan,$id_sifat_kewenangan,$attr_ra);
                     ?>
                 </div>
                 <div class="col-md-6">
                     <label>Status</label>
                     <?php
                    input_pdselect2("status_validasi",$rkk,$status_validasi,$attr_ra);
                     ?>
                 </div>
                </div>
              </form>
            </div>
            <div class="card-footer d-flex justify-content-between">
              <div class="text-end">
               <button type="submit" id="btn-submit" class="setuju ra-btn" data-size="btn-sm">Submit</button>
             </div>            
            </div>
          </div>
    </FORM>
<script type="text/javascript">
$(document).ready(function() {
  $('.select-example').select2();
});

$('#box_7').on('shown.bs.modal', function () {
  $(this).find('select').each(function () {
    if (!$(this).data('select2')) {
      $(this).select2({
        dropdownParent: $('#box_7'),
        width: '100%'
      });
    }
  });
});


$('#signupform').on('submit', function (e) {
  e.preventDefault();

  const $form = $(this);

  $.ajax({
    url: $form.attr('action'),
    type: 'POST',
    data: $form.serialize(),
    dataType: 'json',

    success: function (res) {
      handleResponse(res);
    },

    error: function (xhr) {
      console.error('AJAX ERROR:', xhr.responseText);

      Swal.fire({
        icon: 'error',
        title: 'Server Error',
        html: `
          <div class="text-start">
            <small>Status: ${xhr.status}</small>
            <pre style="max-height:300px;overflow:auto">
${xhr.responseText || 'Tidak ada response'}
            </pre>
          </div>
        `
      });
    }
  });
});

async function handleResponse(res, options = {}) {

  /* ========== BUILD BUTTONS ========== */
  let footer = '';
  if (res.ra_btn && Object.keys(res.ra_btn).length) {
    footer = '<div class="d-flex gap-2 justify-content-center">';
    Object.entries(res.ra_btn).forEach(([key, btn]) => {
      footer += `
        <button class="btn ${btn.class || 'btn-secondary'}"
                data-url="${btn.url || ''}"
                data-method="${btn.method || 'GET'}"
                onclick="raAction(this)">
          ${btn.icon ? `<i class="fa fa-${btn.icon}"></i>` : ''}
          ${btn.label}
        </button>`;
    });
    footer += '</div>';
  }

  /* ========== SHOW ALERT ========== */
  await Swal.fire({
    icon: res.status === 'confirm' ? 'question' : res.status,
    title: res.title,
    html: res.message,
    footer: footer,
    showConfirmButton: !footer
  });

  /* ========== POST ACTION ========== */
  if (res.reload) location.reload();
  if (res.redirect) location.href = res.redirect;
}

/* ========== BUTTON ACTION ========== */
function raAction(el) {
  const url = el.dataset.url;
  const method = el.dataset.method || 'GET';

  fetch(url, { method })
    .then(r => r.json())
    .then(r => handleResponse(r))
    .catch(() => {
      Swal.fire('Error', 'Gagal memproses permintaan', 'error');
    });
}
</script>
<?php
}