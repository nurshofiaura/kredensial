<script type="text/javascript">
function Timer() {
   var hr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
   var bl = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
   var dt=new Date()
   document.getElementById('timer_waktu').innerHTML=hr[dt.getDay()]+", "+dt.getDate()+" "+bl[dt.getMonth()]+" "+dt.getFullYear()+" ["+ dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds()+"]";
   setTimeout("Timer()",1000);
}
Timer();
document.querySelectorAll('.vertical-sidebar a[data-bs-toggle="collapse"]')
  .forEach(a => {
    a.addEventListener('click', e => {
      if (document.querySelector('.modal.show')) {
        e.stopPropagation();
      }
    });
  });

const BASE_URL = "<?= base_url(); ?>";
<?php
//================================================= H O M E =================================================
if ($page=="home")
{
	//	Agar saat home tidak ke universal
?>

<?php
}
elseif ($page=="validasi")
{
?>
function fixTextColor(el){
  if(el.classList.contains('btn-pastel')){
    el.classList.add('text-dark');
  }else{
    el.classList.remove('text-dark');
  }
}

window.RA_BUTTON = (function(){

/* ===== CONFIG ===== */
const COLORS_SOLID = [
  'btn-primary','btn-success','btn-warning',
  'btn-danger','btn-info','btn-secondary','btn-dark',
  'btn-outline-primary','btn-outline-success',
  'btn-outline-warning','btn-outline-danger'
];

const COLORS_PASTEL = [
  'primary','secondary','success',
  'danger','warning','info'
];

const SHAPES = [
  'btn-pill','btn-square','btn-rounded-sm','btn-rounded-lg'
];

const SIZES = ['btn-xs','btn-sm','btn-md'];

const EFFECTS = [
  'btn-soft-shadow','btn-glow','btn-ghost'
];

const rand = a => a[Math.floor(Math.random()*a.length)];

/* ===== CLEAN ===== */
function clean(el){
  [
    ...COLORS_SOLID,
    'btn-pastel',
    'btn-pastel-primary','btn-pastel-secondary',
    'btn-pastel-success','btn-pastel-danger',
    'btn-pastel-warning','btn-pastel-info',
    ...SHAPES,
    ...SIZES,
    ...EFFECTS,
    'ra-loading','d-inline-flex-center','icon-btn'
  ].forEach(c => el.classList.remove(c));
}

/* ===== PASTEL ===== */
function applyPastel(el){
  const tone = rand(COLORS_PASTEL);
  el.classList.add('btn-pastel','btn-pastel-' + tone);
}

/* ===== LOADING ===== */
function setLoading(el, type = 'border', pos = 'left') {

  if (el.classList.contains('ra-loading')) return;

  el.classList.add('ra-loading');

  const spinner = document.createElement('span');
  spinner.className = 'ra-spinner ' +
    (type === 'grow'
      ? 'spinner-grow spinner-grow-sm'
      : 'spinner-border spinner-border-sm');

  spinner.setAttribute('role','status');
  spinner.setAttribute('aria-hidden','true');

  if (pos === 'right') {
    spinner.classList.add('ms-2');
    el.appendChild(spinner);
  } else {
    spinner.classList.add('me-2');
    el.prepend(spinner);
  }
}

function stopLoading(el){
  el.classList.remove('ra-loading');
  el.querySelectorAll('.ra-spinner').forEach(s => s.remove());
}

/* ===== APPLY ===== */
function apply(el){

  clean(el);
  el.classList.add('btn');

  el.classList.add(el.dataset.size || rand(SIZES));
  el.classList.add(rand(SHAPES));

  /* WARNA */
  if(el.closest('.dt-buttons')){
    applyPastel(el);
  }else{
    el.classList.add(rand(COLORS_SOLID));
  }

  /* EFFECT (OPSIONAL) */
  if(Math.random() > 0.6){
    el.classList.add(rand(EFFECTS));
  }

  fixTextColor(el);

  /* AUTO LOADING */
  if(el.dataset.loading){
    const mode = el.dataset.loading;

    if(mode === 'icon'){
      el.classList.add('icon-btn');
      setLoading(el);
    }
    else if(mode === 'grow'){
      el.classList.add('icon-btn');
      setLoading(el,'grow');
    }
    else if(mode === 'right'){
      setLoading(el,'border','right');
    }
    else{
      setLoading(el);
    }
  }
}

/* ===== INIT ===== */
function init(ctx=document){
  ctx.querySelectorAll('.ra-btn').forEach(apply);
}

return {
  init,
  loading: setLoading,
  stop: stopLoading
};

})();

/* DOM READY */
document.addEventListener('DOMContentLoaded', ()=>{
  RA_BUTTON.init();
});


function debounce(fn, delay) {
    let t; return function () {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, arguments), delay);
    };
}

$(function() {
 //  RA_RANDOM_BTN.init();
    var table = $('#dttb').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        pagingType: "full_numbers",
        oLanguage: {
            sProcessing: "Memuat data...",
            sSearch: "Cari:",
            sLengthMenu: "Tampilkan _MENU_ baris",
            sInfo: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            sInfoEmpty: "Menampilkan 0 data",
            sInfoFiltered: "(difilter dari _MAX_ data)",
            sEmptyTable: "Tidak ada data",
            sZeroRecords: "Data tidak ditemukan",
            sInfoThousands: ".",

            oPaginate: {
                sFirst: "Awal",
                sPrevious: "Sebelumnya",
                sNext: "Selanjutnya",
                sLast: "Akhir"
            },

            // ===== SELECT TRANSLATION =====
            select: {
                rows: {
                    _: "%d baris terpilih",
                    0: "",
                    1: "1 baris terpilih"
                },
                columns: {
                    _: "%d kolom terpilih",
                    0: "",
                    1: "1 kolom terpilih"
                },
                cells: {
                    _: "%d sel terpilih",
                    0: "",
                    1: "1 sel terpilih"
                }
            }
        },
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],        
        select: {
            style: 'single'
        },
/*        dom:
          "<'row mb-2'\
            <'col-12 dt-buttons-wrap d-flex flex-wrap'B>\
          >" +
          "<'row'<'col-12'tr>>" +
          "<'row mt-2 align-items-center'\
            <'col-md-5'i>\
            <'col-md-7 text-end'p>\
          >",
   //     dom: "tr<'row mt-2'<'col-md-5'i><'col-md-7 text-end'p>>",
    dom:
      "<'row mb-2'\
        <'col-12 dt-buttons-wrap d-flex flex-wrap'B>\
      >" +
      "<'row'<'col-12'tr>>" +
      "<'row mt-2 align-items-center'\
        <'col-md-5'i>\
        <'col-md-7 text-end'p>\
      >",*/
dom:
  "<'row mb-2'\
    <'col-md-6'l>\
    <'col-md-6 text-end'B>\
  >" +
  "tr" +
  "<'row mt-2'\
    <'col-md-5'i>\
    <'col-md-7 text-end'p>\
  >",
        ajax: {
            url: "<?= base_url() ?>ol_validasi/validasi/data",
            type : "POST"
        },
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        columns: [
                {
                    "className":      'dt-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ''
                },
                { data: 'nama_pegawai' },
                { data: 'nip' },
                { data: 'nama_unit' },
                { data: 'nama_komite' }
        ],
        order: [[4,'asc'],[1,'asc']],
        initComplete: function () {

          const api = this.api();

          /* ===============================
           * INIT RA BUTTON (WAJIB DI SINI)
           * =============================== */
          const btnContainer = api.table().container()
            .querySelector('.dt-buttons');

          if (btnContainer) {
            RA_BUTTON.init(btnContainer);
          }
          initActionButtons(api);
          /* ===============================
           * FOOTER CLONE (scrollX FIX)
           * =============================== */
          const $footer = $(api.table().container())
            .find('.dataTables_scrollFootInner tfoot th');
          // inputbox index 0 hilang
        $footer.each(function (i) {
          if (i === 0) {
            $(this).html('');
          } else {
            $(this).html(
              '<input type="text" class="form-control form-control-sm" placeholder="Cari..." />'
            );
          }
        });
          // semua index pakai input
/*          $footer.each(function () {
            $(this).html(
              '<input type="text" class="form-control form-control-sm" placeholder="Cari..." />'
            );
          });*/

          /* ===============================
           * COLUMN SEARCH
           * =============================== */
          $(api.table().container())
            .find('.dataTables_scrollFootInner tfoot input')
            .on('keyup change', debounce(function () {
              const colIdx = $(this).parent().index();
              api.column(colIdx).search(this.value).draw();
            }, 500));
        },
        buttons: [
/*        {
            text: '<i class="fa fa-check"></i> Validasi',
            extend: 'selected',
            className: DT_BUTTON_STYLE.generate({ color:'success' }),
            action: function ( e, dt, node, config ) {
                const r = dt.row({ selected: true }).data();
                location.href =
                    BASE_URL + 'ol_validasi/validasi/validasi/' + r.barcode_pegawai;
            }
        },
{
    text: '<i class="fa fa-edit"></i>',
    className: DT_BUTTON_STYLE.generate({
        color:'warning',
        iconOnly:true,
        persist:true,
        key:'btn_edit_validasi'
    }),
    action: ()=>alert('EDIT')
},
        {
            text: '<i class="fa fa-sync"></i> Reload',
            className: DT_BUTTON_STYLE.generate(),
            action: function (e, dt) {
                dt.ajax.reload(null, false);
            }
        }*/
        ]
    });

$('#dttb tbody').on('click', 'td.dt-control', function () {

    const tr  = $(this).closest('tr');
    const row = table.row(tr);
    const d   = row.data();

    // =============================
    // 1. JIKA ROW INI SUDAH OPEN → TOGGLE CLOSE
    // =============================
    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
        return;
    }

    // =============================
    // 2. TUTUP ROW LAIN (AUTO CLOSE)
    // =============================
    table.rows().every(function () {
        if (this.child.isShown()) {
            this.child.hide();
            $(this.node()).removeClass('shown');
        }
    });

    // =============================
    // 3. OPEN ROW INI
    // =============================
    tr.addClass('shown');
    row.child(childTableHtml(d.barcode_pegawai)).show();

    // =============================
    // 4. INIT CHILD DATATABLE (LAZY LOAD)
    // =============================
    $('#child-' + d.barcode_pegawai).DataTable({
        processing: true,
        serverSide: true,
        searching: true,
        paging: true,
        lengthChange: false,
        pageLength: 5,
        destroy: true, // ⬅️ WAJIB
        ajax: {
            url: BASE_URL + 'ol_validasi/validasi/child_pegawai',
            type: 'POST',
            data: {
                barcode_pegawai: d.barcode_pegawai
            }
        },
        columns: [
            { data: 'nama_kewenangan' },
            { data: 'nama_kompetensi' },
            { data: 'nama_sifat_kewenangan' }
        ]
    });

});


function childTableHtml(id) {
    return `
        <div class="p-2 bg-light">
            <table class="table table-bordered table-sm table-hover w-100"
                   id="child-${id}">
                <thead>
                    <tr>
                        <th>Kewenangan</th>
                        <th>Kompetensi</th>
                        <th>Sifat</th>
                    </tr>
                </thead>
            </table>
        </div>
    `;
}

function getSelectedRow(){
  const row = table.row({ selected:true });
  if(!row.any()) return null;
  return row.data();
}
function toggleActionButton(enable){
  $('#btn-validasi').prop('disabled', !enable);
}

table.on('processing', function (e, settings, processing) {
  $('.ra-btn').prop('disabled', processing);
});

function syncActionButton() {
  const hasSelect = table.row('.selected').any();

  $('#btn-edit-modal, #btn-delete, #btn-validasi, #btn-print-selected')
    .prop('disabled', !hasSelect);
}

table.on('select deselect draw', syncActionButton);

RA_BUTTON.loading = function(el){
  if(el.classList.contains('ra-loading')) return;

  el.classList.add('ra-loading');
  el.disabled = true;

  if(!el.querySelector('.ra-spinner')){
    const sp = document.createElement('span');
    sp.className = 'spinner-border spinner-border-sm ra-spinner me-1';
    el.prepend(sp);
  }
};

RA_BUTTON.stop = function(el){
  el.classList.remove('ra-loading');
  el.disabled = false;
  el.querySelector('.ra-spinner')?.remove();
};


const ACTION_BUTTONS = [

/*  {
    id: 'btn-add-modal',
    enable: 'always',
    action() {
      $('#modal-default').modal();
      $('.modal-body').load(
        "<= base_url('admin_kredensial/'.$page.'/tambah') ?>",
        () => $('#modal-default').modal('show')
      );
    }
  },

  {
    id: 'btn-edit-modal',
    disabled: true,
    enable: 'selected',
    action(data) {
      $('#modal-default').modal();
      $('.modal-body').load(
        "<= base_url('admin_kredensial/'.$page.'/edit/') ?>" + data.id_form,
        () => $('#modal-default').modal('show')
      );
    }
  },

  {
    id: 'btn-delete',
    disabled: true,
    enable: 'selected',
    action(data) {
      Swal.fire({
        title: 'Yakin?',
        text: 'Yakin akan menghapus = ' + data.nama_form,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
      }).then(res => {
        if (res.isConfirmed) {
          location.href =
            "<= base_url('admin_kredensial/'.$page.'/hapus_form/') ?>" +
            data.id_form + '/' + data.barcode_form;
        }
      });
    }
  },*/

  {
    id: 'btn-validasi',
    disabled: true,
    enable: 'selected',
    action(data) {
      //   const data = table.row({selected:true}).data();
      location.href =
        "<?= base_url('ol_validasi/'.$page.'/validasi/') ?>" +data.barcode_pegawai;
    }
  },
/*
  {
    id: 'btn-print',
    enable: 'always',
    action() {
      window.open(
        "<= base_url('admin_kredensial/'.$page.'/pdf_question') ?>",
        '_blank'
      );
    }
  },

  {
    id: 'btn-print-selected',
    disabled: true,
    enable: 'selected',
    action(data) {
      window.open(
        "<= base_url('admin_kredensial/'.$page.'/pdf_question') ?>" +
        data.barcode_form,
        '_blank'
      );
    }
  },*/

{
  id: 'btn-reload',
  enable: 'always',
  action() {
    const btn = document.getElementById('btn-reload');

    // tampilkan spinner manual
    RA_BUTTON.loading(btn);

    table.ajax.reload(() => {
      RA_BUTTON.stop(btn);
    }, false);
  }
}

];

$('[disabled]').tooltip({title:'Pilih data terlebih dahulu'});

function initActionButtons(table){
  ACTION_BUTTONS.forEach(btn => {
    const $btn = $('#' + btn.id);

    // disable jika tombol hanya untuk selected
    if(btn.enable === 'selected'){
      $btn.prop('disabled', true);
    }

    // hapus binding lama
    $btn.off('click').on('click', () => {
      let rowData = null;

      // ambil row hanya jika tombol require selected
      if(btn.enable === 'selected'){
        const row = table.row({ selected:true });
        if(!row.any()) return;
        rowData = row.data();
      }

      // jalankan action
      btn.action(rowData);
    });
  });

  // toggle tombol enable/disable saat row selection
  table.on('select deselect draw', () => {
    const has = table.row({ selected:true }).any();
    ACTION_BUTTONS.forEach(btn => {
      if(btn.enable === 'selected'){
        $('#' + btn.id).prop('disabled', !has);
      }
    });
  });
}
});
<?php
}
elseif ($page=="validasi_validasi"){
?>
function fixTextColor(el){
  if(el.classList.contains('btn-pastel')){
    el.classList.add('text-dark');
  }else{
    el.classList.remove('text-dark');
  }
}

window.RA_BUTTON = (function(){

/* ===== CONFIG ===== */
const COLORS_SOLID = [
  'btn-primary','btn-success','btn-warning',
  'btn-danger','btn-info','btn-secondary','btn-dark',
  'btn-outline-primary','btn-outline-success',
  'btn-outline-warning','btn-outline-danger'
];

const COLORS_PASTEL = [
  'primary','secondary','success',
  'danger','warning','info'
];

const SHAPES = [
  'btn-pill','btn-square','btn-rounded-sm','btn-rounded-lg'
];

const SIZES = ['btn-xs','btn-sm','btn-md'];

const EFFECTS = [
  'btn-soft-shadow','btn-glow','btn-ghost'
];

const rand = a => a[Math.floor(Math.random()*a.length)];

/* ===== CLEAN ===== */
function clean(el){
  [
    ...COLORS_SOLID,
    'btn-pastel',
    'btn-pastel-primary','btn-pastel-secondary',
    'btn-pastel-success','btn-pastel-danger',
    'btn-pastel-warning','btn-pastel-info',
    ...SHAPES,
    ...SIZES,
    ...EFFECTS,
    'ra-loading','d-inline-flex-center','icon-btn'
  ].forEach(c => el.classList.remove(c));
}

/* ===== PASTEL ===== */
function applyPastel(el){
  const tone = rand(COLORS_PASTEL);
  el.classList.add('btn-pastel','btn-pastel-' + tone);
}

/* ===== LOADING ===== */
function setLoading(el, type = 'border', pos = 'left') {

  if (el.classList.contains('ra-loading')) return;

  el.classList.add('ra-loading');

  const spinner = document.createElement('span');
  spinner.className = 'ra-spinner ' +
    (type === 'grow'
      ? 'spinner-grow spinner-grow-sm'
      : 'spinner-border spinner-border-sm');

  spinner.setAttribute('role','status');
  spinner.setAttribute('aria-hidden','true');

  if (pos === 'right') {
    spinner.classList.add('ms-2');
    el.appendChild(spinner);
  } else {
    spinner.classList.add('me-2');
    el.prepend(spinner);
  }
}

function stopLoading(el){
  el.classList.remove('ra-loading');
  el.querySelectorAll('.ra-spinner').forEach(s => s.remove());
}

/* ===== APPLY ===== */
function apply(el){

  clean(el);
  el.classList.add('btn');

  el.classList.add(el.dataset.size || rand(SIZES));
  el.classList.add(rand(SHAPES));

  /* WARNA */
  if(el.closest('.dt-buttons')){
    applyPastel(el);
  }else{
    el.classList.add(rand(COLORS_SOLID));
  }

  /* EFFECT (OPSIONAL) */
  if(Math.random() > 0.6){
    el.classList.add(rand(EFFECTS));
  }

  fixTextColor(el);

  /* AUTO LOADING */
  if(el.dataset.loading){
    const mode = el.dataset.loading;

    if(mode === 'icon'){
      el.classList.add('icon-btn');
      setLoading(el);
    }
    else if(mode === 'grow'){
      el.classList.add('icon-btn');
      setLoading(el,'grow');
    }
    else if(mode === 'right'){
      setLoading(el,'border','right');
    }
    else{
      setLoading(el);
    }
  }
}

/* ===== INIT ===== */
function init(ctx=document){
  ctx.querySelectorAll('.ra-btn').forEach(apply);
}

return {
  init,
  loading: setLoading,
  stop: stopLoading
};

})();

/* DOM READY */
document.addEventListener('DOMContentLoaded', ()=>{
  RA_BUTTON.init();
});

// 🔥 RANDOM ULANG BUTTON SETIAP MODAL MUNCUL
document.addEventListener('shown.bs.modal', function (e) {
  const modal = e.target;

  // hanya proses jika ada ra-btn di modal
  if (modal.querySelector('.ra-btn')) {
    RA_BUTTON.init(modal);
  }
});

/* =========================
 * UTIL
 * ========================= */
function debounce(fn, delay = 400){
  let t;
  return function(){
    clearTimeout(t);
    t = setTimeout(() => fn.apply(this, arguments), delay);
  };
}
$(function() {
 //  RA_RANDOM_BTN.init();
 //   const barcode = $('#dttb').data('barcode');
 const BARCODE_PEGAWAI = <?= json_encode($this->uri->segment(4)) ?>;
 //========================================== datatable
    var table = $('#dttb').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        pagingType: "full_numbers",
        oLanguage: {
            sProcessing: "Memuat data...",
            sSearch: "Cari:",
            sLengthMenu: "Tampilkan _MENU_ baris",
            sInfo: "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            sInfoEmpty: "Menampilkan 0 data",
            sInfoFiltered: "(difilter dari _MAX_ data)",
            sEmptyTable: "Tidak ada data",
            sZeroRecords: "Data tidak ditemukan",
            sInfoThousands: ".",

            oPaginate: {
                sFirst: "Awal",
                sPrevious: "Sebelumnya",
                sNext: "Selanjutnya",
                sLast: "Akhir"
            },

            // ===== SELECT TRANSLATION =====
            select: {
                rows: {
                    _: "%d baris terpilih",
                    0: "",
                    1: "1 baris terpilih"
                },
                columns: {
                    _: "%d kolom terpilih",
                    0: "",
                    1: "1 kolom terpilih"
                },
                cells: {
                    _: "%d sel terpilih",
                    0: "",
                    1: "1 sel terpilih"
                }
            }
        },      
        select: {
            style: 'single',
            selector: 'td:not(.dt-control)'
        },
dom:
  "<'row mb-2'\
    <'col-md-6'l>\
    <'col-md-6 text-end'B>\
  >" +
  "tr" +
  "<'row mt-2'\
    <'col-md-5'i>\
    <'col-md-7 text-end'p>\
  >",
      ajax: {
        url: "<?= base_url('ol_validasi/validasi/logbook') ?>",
        type: "POST",
        data: function(d){
          d.barcode_pegawai = BARCODE_PEGAWAI;
        }
      },
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        columns: [
           { "data": "nama_pegawai" },
           { "data": "nama_kewenangan" },
           { "data": "nama_kompetensi" },
           { "data": "nama_sifat_kewenangan", className: "text-center" }
        ],
        order: [0,'asc'],
      /* =========================
       * INIT COMPLETE (PENTING!)
       * ========================= */
        initComplete: function () {

          const api = this.api();

          /* ===============================
           * INIT RA BUTTON (WAJIB DI SINI)
           * =============================== */
          const btnContainer = api.table().container()
            .querySelector('.dt-buttons');

          if (btnContainer) {
            RA_BUTTON.init(btnContainer);
          }
          initActionButtons(api);
          /* ===============================
           * FOOTER CLONE (scrollX FIX)
           * =============================== */
          const $footer = $(api.table().container())
            .find('.dataTables_scrollFootInner tfoot th');
          // inputbox index 0 hilang
        $footer.each(function (i) {
          if (i === 0) {
            $(this).html('');
          } else {
            $(this).html(
              '<input type="text" class="form-control form-control-sm" placeholder="Cari..." />'
            );
          }
        });
          /* ===============================
           * COLUMN SEARCH
           * =============================== */
          $(api.table().container())
            .find('.dataTables_scrollFootInner tfoot input')
            .on('keyup change', debounce(function () {
              const colIdx = $(this).parent().index();
              api.column(colIdx).search(this.value).draw();
            }, 500));
        },
        buttons: [

        ]
    });
    //============================================================== datatable
    function getSelectedRow(){
      const row = table.row({ selected:true });
      if(!row.any()) return null;
      return row.data();
    }
    function toggleActionButton(enable){
      $('#btn-validasi').prop('disabled', !enable);
    }
    table.on('processing', function (e, settings, processing) {
      $('.ra-btn').prop('disabled', processing);
    });

    function syncActionButton() {
      const hasSelect = table.row('.selected').any();

      $('#btn-edit-modal, #btn-delete, #btn-validasi, #btn-print-selected')
        .prop('disabled', !hasSelect);
    }

    table.on('select deselect draw', syncActionButton);

    RA_BUTTON.loading = function(el){
      if(el.classList.contains('ra-loading')) return;

      el.classList.add('ra-loading');
      el.disabled = true;

      if(!el.querySelector('.ra-spinner')){
        const sp = document.createElement('span');
        sp.className = 'spinner-border spinner-border-sm ra-spinner me-1';
        el.prepend(sp);
      }
    };

    RA_BUTTON.stop = function(el){
      el.classList.remove('ra-loading');
      el.disabled = false;
      el.querySelector('.ra-spinner')?.remove();
    };
    const ACTION_BUTTONS = [
  {
    id: 'btn-kembali',
    enable: 'always',
    action(data) {
      //   const data = table.row({selected:true}).data();
      location.href =
        "<?= base_url('ol_validasi/validasi') ?>";
    }
  },
  {
    id: 'btn-validasi',
    disabled: true,
    enable: 'selected',
    action(data) {

      // 🔒 SAFETY
      if (!data) {
        return; // modal TIDAK AKAN PERNAH kebuka
      }

      const url =
        "<?= base_url('ol_validasi/validasi/rkk/') ?>" +
        data.id_kewenangan + '/' +
        data.id_pegawai + '/' +
        data.id_sifat_kewenangan + '/' +
        data.barcode_pegawai;

      const modal = document.getElementById('box_7');
      const body  = modal.querySelector('.modal-body');

      body.innerHTML = '<div class="text-center py-4">Loading...</div>';

      $(body).load(url, function () {
        // 🔥 MODAL BARU BOLEH DIBUKA SETELAH DATA ADA
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
      });
    }
  },
{
  id: 'btn-reload',
  enable: 'always',
  action() {
    const btn = document.getElementById('btn-reload');

    // tampilkan spinner manual
    RA_BUTTON.loading(btn);

    table.ajax.reload(() => {
      RA_BUTTON.stop(btn);
    }, false);
  }
}
    ];

    $('[disabled]').tooltip({title:'Pilih data terlebih dahulu'});

function initActionButtons(table){
  ACTION_BUTTONS.forEach(btn => {
    const $btn = $('#' + btn.id);

    // disable jika tombol hanya untuk selected
    if(btn.enable === 'selected'){
      $btn.prop('disabled', true);
    }

    // hapus binding lama
    $btn.off('click').on('click', () => {
      let rowData = null;

      // ambil row hanya jika tombol require selected
      if(btn.enable === 'selected'){
        const row = table.row({ selected:true });
        if(!row.any()) return;
        rowData = row.data();
      }

      // jalankan action
      btn.action(rowData);
    });
  });

  // toggle tombol enable/disable saat row selection
  table.on('select deselect draw', () => {
    const has = table.row({ selected:true }).any();
    ACTION_BUTTONS.forEach(btn => {
      if(btn.enable === 'selected'){
        $('#' + btn.id).prop('disabled', !has);
      }
    });
  });
}
});
<?php
}
?>
</script>
</body>
</html>
