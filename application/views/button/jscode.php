<script type="text/javascript">
function Timer() {
   var hr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
   var bl = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
   var dt=new Date()
   document.getElementById('timer_waktu').innerHTML=hr[dt.getDay()]+", "+dt.getDate()+" "+bl[dt.getMonth()]+" "+dt.getFullYear()+" ["+ dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds()+"]";
   setTimeout("Timer()",1000);
}
Timer();
const dangerData = $('.danger-data').data('flashdata');
const suksesData = $('.sukses-data').data('flashdata');
if(suksesData) {
	swal({
		title: 'Sukses',
		text: suksesData,
		icon: "success",
	})
}
if(dangerData) {
	swal({
		title: 'Gagal',
		text: dangerData,
		icon: "error",
	})
}
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
          >",*/
   //     dom: "tr<'row mt-2'<'col-md-5'i><'col-md-7 text-end'p>>",
    dom:
      "<'row mb-2'\
        <'col-12 dt-buttons-wrap d-flex flex-wrap'B>\
      >" +
      "<'row'<'col-12'tr>>" +
      "<'row mt-2 align-items-center'\
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
         RA_BUTTON.init(document.querySelector('.dt-buttons'));
         initActionButtons(table);
            var api = this.api();
            api.columns().every(function (i) {
                if (i === 0) return;
                $('input', this.footer()).on(
                    'keyup change',
                    debounce(() => {
                        this.search(this.footer().querySelector('input').value).draw();
                    }, 500)
                );
            });
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
    row.child(childTableHtml(d.id_pegawai)).show();

    // =============================
    // 4. INIT CHILD DATATABLE (LAZY LOAD)
    // =============================
    $('#child-' + d.id_pegawai).DataTable({
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
                id_pegawai: d.id_pegawai
            }
        },
        columns: [
            { data: 'username' },
            {
                data: 'status_user',
                render: d =>
                    d == 1
                        ? '<span class="badge bg-success">Aktif</span>'
                        : '<span class="badge bg-secondary">Nonaktif</span>'
            }
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
                        <th>Username</th>
                        <th>Status</th>
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
  $('#btn-edit-modal').prop('disabled', !enable);
  $('#btn-delete').prop('disabled', !enable);
  $('#btn-setting').prop('disabled', !enable);
  $('#btn-print-selected').prop('disabled', !enable);
}

/*table.on('select deselect draw', function(){
  const hasSelect = table.row('.selected').any();

  $('#btn-edit-modal').prop('disabled', !hasSelect);
  $('#btn-delete').prop('disabled', !hasSelect);
  $('#btn-setting').prop('disabled', !hasSelect);
  $('#btn-print-selected').prop('disabled', !hasSelect);
});
table.on('select deselect draw', function () {

  const hasSelect = table.row('.selected').any();

  ACTION_BUTTONS.forEach(cfg => {
    if (cfg.enable === 'selected') {
      $('#' + cfg.id).prop('disabled', !hasSelect);
    }
  });

});*/

table.on('processing', function (e, settings, processing) {
  $('.ra-btn').prop('disabled', processing);
});

function syncActionButton() {
  const hasSelect = table.row('.selected').any();

  $('#btn-edit-modal, #btn-delete, #btn-setting, #btn-print-selected')
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
    id: 'btn-add-modal',
    enable: 'always',
    action() {
      $('#modal-default').modal();
      $('.modal-body').load(
        "<?= base_url('admin_kredensial/'.$page.'/tambah') ?>",
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
        "<?= base_url('admin_kredensial/'.$page.'/edit/') ?>" + data.id_form,
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
            "<?= base_url('admin_kredensial/'.$page.'/hapus_form/') ?>" +
            data.id_form + '/' + data.barcode_form;
        }
      });
    }
  },

  {
    id: 'btn-setting',
    disabled: true,
    enable: 'selected',
    action(data) {
      location.href =
        "<?= base_url('admin_kredensial/'.$page.'/seting/') ?>" +
        data.barcode_form;
    }
  },

  {
    id: 'btn-print',
    enable: 'always',
    action() {
      window.open(
        "<?= base_url('admin_kredensial/'.$page.'/pdf_question') ?>",
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
        "<?= base_url('admin_kredensial/'.$page.'/pdf_question') ?>" +
        data.barcode_form,
        '_blank'
      );
    }
  },

  {
    id: 'btn-reload',
    enable: 'always',
    action() {
      table.ajax.reload(null,false);
    }
  }

];

$('#btn-reload').on('click', function(){
  RA_BUTTON.loading(this);

  table.ajax.reload(() => {
    RA_BUTTON.stop(this);
  }, false);
});

$('#btn-delete').on('click', function(){

  const btn = this;
  const row = table.row('.selected');
  if(!row.any()){
    Swal.fire('Info','Pilih data terlebih dahulu','info');
    return;
  }

  const d = row.data();

  Swal.fire({
    title: 'Yakin?',
    text: 'Hapus data: ' + d.nama_form,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus'
  }).then(res => {
    if(res.isConfirmed){
      RA_BUTTON.loading(btn);
      location.href =
        "<?= base_url('admin_kredensial/'.$page.'/hapus_form/') ?>"
        + d.id_form + '/' + d.barcode_form;
    }
  });
});

$('[disabled]').tooltip({title:'Pilih data terlebih dahulu'});

/*table.on('select deselect', function(){
  const c = table.rows({selected:true}).count();
  $('#info-selected').text(c ? c+' data terpilih' : '');
});*/

/*table.on('preXhr.dt', () => $('.ra-btn').prop('disabled', true));
table.on('xhr.dt', () => {
  $('.ra-btn').prop('disabled', false);

  const has = table.row('.selected').any();
  $('#btn-edit-modal, #btn-delete, #btn-setting, #btn-print-selected')
    .prop('disabled', !has);
});*/

function initActionButtons(table){
  ACTION_BUTTONS.forEach(btn => {
    const $btn = $('#' + btn.id);

    // ⛔ disable di awal
    if(btn.enable === 'selected'){
      $btn.prop('disabled', true);
    }

    // click
    $btn.on('click', () => {
      const row = table.row({ selected:true });
      if(!row.any()) return;
      btn.action(row.data());
    });
  });

  // toggle saat select
  table.on('select deselect draw', () => {
    const has = table.row({ selected:true }).any();
    ACTION_BUTTONS.forEach(btn => {
      if(btn.enable === 'selected'){
        $('#' + btn.id).prop('disabled', !has);
      }
    });
  });
}


/*ACTION_BUTTONS.forEach(cfg => {

  // click
  $(document).on('click', '#' + cfg.id, function () {

    const row = table.row('.selected');
    const data = row.any() ? row.data() : null;

    if (cfg.enable === 'selected' && !data) {
      Swal.fire({
        icon: 'info',
        title: 'Info',
        text: 'Pilih data terlebih dahulu'
      });
      return;
    }

    cfg.action(data);
  });

});*/

/*$('#btn-add-modal').on('click', function(){
  $('#modal-default').modal();
  $('.modal-body').load(
    "<?= base_url('admin_kredensial/'.$page.'/tambah') ?>",
    function(){
      $('#modal-default').modal('show');
    }
  );
});
$('#btn-edit-modal').on('click', function(){

  const data = table.row({selected:true}).data();
  if(!data) return;

  $('#modal-default').modal();
  $('.modal-body').load(
    "<?= base_url('admin_kredensial/'.$page.'/edit/') ?>" + data.id_form,
    function(){
      $('#modal-default').modal('show');
    }
  );

});

$(document).on('click', '#btn-delete', function () {

  const row = table.row('.selected');
  if (!row.any()) {
    Swal.fire({
      icon: 'info',
      title: 'Info',
      text: 'Pilih data terlebih dahulu'
    });
    return;
  }

  const data = row.data();

  Swal.fire({
    title: 'Yakin?',
    text: 'Yakin akan menghapus = ' + data.nama_form,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href =
        "<?= base_url('admin_kredensial/'.$page.'/hapus_form/') ?>" +
        data.id_form + '/' + data.barcode_form;
    }
  });

});



$('#btn-add').on('click', function(){
  location.href =
    "<?= base_url('komite/'.$page.'/tambah') ?>";
});
$('#btn-setting').on('click', function(){

  const data = table.row({selected:true}).data();
  if(!data) return;

  location.href =
    "<?= base_url('admin_kredensial/'.$page.'/seting/') ?>"
    + data.barcode_form;
});
$('#btn-print').on('click', function(){
  window.open(
    "<?= base_url('admin_kredensial/'.$page.'/pdf_question') ?>",
    '_blank'
  );
});
$('#btn-print-selected').on('click', function(){

  const data = table.row({selected:true}).data();
  if(!data) return;

  window.open(
    "<?= base_url('admin_kredensial/'.$page.'/pdf_question') ?>"
    + data.barcode_form,
    '_blank'
  );
});
$('#btn-reload').on('click', function(){
  setLoading(this);
  table.ajax.reload(null, false);
  setTimeout(() => stopLoading(this), 800);
});*/

});
<?php
}
elseif ($page=="validasi_20250101"){
?>
/* ================= RANDOM 3 LEVEL BUTTON ================= */
/*function randBtn(base) {
    const styles = {
        success:   ['btn-success','btn-outline-success','btn-pastel-success'],
        warning:   ['btn-warning','btn-outline-warning','btn-pastel-warning'],
        info:      ['btn-info','btn-outline-info','btn-pastel-info'],
        danger:    ['btn-danger','btn-outline-danger','btn-pastel-danger'],
        secondary: ['btn-secondary','btn-outline-secondary','btn-pastel-secondary']
    };

    const pick = styles[base] || ['btn-secondary'];
    return 'btn ' + pick[Math.floor(Math.random() * pick.length)];
}

const BASE_URL = "<?= base_url(); ?>";
window.DT_BTN = (function () {

    const ACTION_COLOR = {
        tambah:   'primary',
        edit:     'warning',
        validasi: 'success',
        lihat:    'info',
        hapus:    'danger',
        reload:   'secondary'
    };

    const BTN_COLORS = {
        primary:   ['btn-primary','btn-outline-primary'],
        success:   ['btn-success','btn-outline-success'],
        info:      ['btn-info','btn-outline-info'],
        warning:   ['btn-warning','btn-outline-warning'],
        danger:    ['btn-danger','btn-outline-danger'],
        secondary: ['btn-secondary','btn-outline-secondary']
    };

    const SHAPES = ['', 'btn-pill'];
    const rand = a => a[Math.floor(Math.random()*a.length)];

    // ===================== CLASS RESOLVER =====================
    function className({ action, level='byAction', key }) {

        if (level === 'persist') {
            const k = 'dtbtn_' + key;
            if (localStorage[k]) return localStorage[k];

            let base = ACTION_COLOR[action] || 'secondary';
            let cls  = `btn btn-sm ${rand(BTN_COLORS[base])} ${rand(SHAPES)}`;
            localStorage[k] = cls;
            return cls;
        }

        if (level === 'randomAll') {
            let base = rand(Object.keys(BTN_COLORS));
            return `btn btn-sm ${rand(BTN_COLORS[base])} ${rand(SHAPES)}`;
        }

        let base = ACTION_COLOR[action] || 'secondary';
        return `btn btn-sm ${rand(BTN_COLORS[base])} ${rand(SHAPES)}`;
    }

    // ===================== FACTORY =====================
function button(cfg) {
    return {
        text: `<i class="${cfg.icon}"></i> ${cfg.text || ''}`,
        tag: 'button', // ⬅️ WAJIB
        className: className(cfg),

            action: function (e, dt, node, config) {
                e.preventDefault();
                e.stopImmediatePropagation(); // ⬅️ PENTING

                let row = cfg.needSelect
                    ? dt.row({ selected: true }).data()
                    : null;

                if (cfg.needSelect && !row) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Data belum dipilih',
                        text: 'Silakan pilih satu baris data terlebih dahulu',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                if (cfg.confirm) {
                    Swal.fire(cfg.confirm).then(res => {
                        if (res.isConfirmed) cfg.onConfirm(row, dt);
                    });
                    return;
                }

                if (cfg.modal) {
                    $('#modal-default .modal-body')
                        .html('<div class="text-center p-3">Loading...</div>');

                    $('#modal-default')
                        .appendTo('body')
                        .modal('show');

                    setTimeout(() => {
                        $('#modal-default .modal-body')
                            .load(cfg.modal.url(row));
                    }, 100);

                    return;
                }

                if (cfg.url) {
                    window.location.href = cfg.url(row);
                }

                if (cfg.onClick) cfg.onClick(row, dt);
            }

    };
}

    return { button };

})();
window.DT_ACTION = {

    validasi: (opt) => DT_BTN.button({
        action: 'validasi',
        icon: 'fa fa-check',
        text: 'Validasi',
        needSelect: true,
        level: opt.level || 'byAction',
        modal: opt.modal
    }),

    edit: (opt) => DT_BTN.button({
        action: 'edit',
        icon: 'fa fa-edit',
        text: 'Edit',
        needSelect: true,
        level: opt.level || 'persist',
        key: opt.key,
        url: opt.url
    }),

    lihat: (opt) => DT_BTN.button({
        action: 'lihat',
        icon: 'fa fa-eye',
        needSelect: true,
        level: opt.level || 'randomAll',
        target: '_blank',
        url: opt.url
    }),

    hapus: (opt) => DT_BTN.button({
        action: 'hapus',
        icon: 'fa fa-trash',
        text: 'Hapus',
        needSelect: true,
        confirm: {
            title: 'Yakin?',
            text: 'Data akan dihapus',
            icon: 'warning',
            showCancelButton: true
        },
        onConfirm: opt.onConfirm
    }),

    reload: () => DT_BTN.button({
        action: 'reload',
        icon: 'fa fa-refresh',
        text: 'Reload',
        onClick: (r,dt)=>dt.ajax.reload(null,false)
    })

};*/
/* ================= RANDOM 3 LEVEL BUTTON ================= */
function randBtn(base) {
    const styles = {
        success:   ['btn-success','btn-outline-success','btn-pastel-success'],
        warning:   ['btn-warning','btn-outline-warning','btn-pastel-warning'],
        info:      ['btn-info','btn-outline-info','btn-pastel-info'],
        danger:    ['btn-danger','btn-outline-danger','btn-pastel-danger'],
        secondary: ['btn-secondary','btn-outline-secondary','btn-pastel-secondary']
    };

    const shapes = ['', 'btn-pill'];

    const pickStyle = styles[base] || styles.secondary;
    const clsStyle  = pickStyle[Math.floor(Math.random() * pickStyle.length)];
    const clsShape  = shapes[Math.floor(Math.random() * shapes.length)];

    return `btn btn-sm ${clsStyle} ${clsShape}`;
}
const BASE_URL = "<?= base_url(); ?>";
var table = $('#dttb').DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    lengthChange: true,
    pageLength: 10,
    scrollX: true,
    pagingType: "full_numbers",
    select: {
        style: 'single'
    },
    dom:
      "<'row mb-2'\
        <'col-12 dt-buttons-wrap d-flex flex-wrap'B>\
      >" +
      "<'row'<'col-12'tr>>" +
      "<'row mt-2 align-items-center'\
        <'col-md-5'i>\
        <'col-md-7 text-end'p>\
      >",
    ajax: {
        url: "<?= base_url() ?>ol_validasi/<?= $page ?>/data",
        type : "POST"
    },
    lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
    columns: [
            { data: 'nama_pegawai' },
            { data: 'nip' },
            { data: 'nama_unit' },
            { data: 'nama_komite' }
    ],
    buttons: [
/*        DT_ACTION.validasi({
            modal: {
                id: '#modal-default',
                body: '.modal-body',
                url: r =>
                    BASE_URL +
                    'ol_validasi/validasi/rkk/' +
                    r.id_kewenangan + '/' +
                    r.id_pegawai + '/' +
                    r.id_sifat_kewenangan
            }
        }),

        DT_ACTION.edit({
            key: 'edit_validasi',
            url: r =>
                BASE_URL +
                'ol_validasi/validasi/edit/' +
                r.id_kewenangan
        }),

        DT_ACTION.lihat({
            url: r =>
                BASE_URL +
                'ol_validasi/validasi/detail/' +
                r.id_kewenangan
        }),

        DT_ACTION.hapus({
            onConfirm: r => {
                location.href =
                    BASE_URL +
                    'ol_validasi/validasi/hapus/' +
                    r.id_kewenangan;
            }
        }),

        DT_ACTION.reload()*/
/*{
    text: '<i class="fa fa-check"></i> Validasi',
    className: 'btn btn-success',
    action: function (e, dt) {
        console.log('ACTION MASUK');

        const r = dt.row({ selected: true }).data();
        if (!r) {
            Swal.fire('Info', 'Pilih satu data dulu', 'info');
            return;
        }

        alert('CLICK WORKS');
    }
},*/
/*{
    extend: 'selected',
    text: '<i class="fa fa-check"></i> Validasi',
    className: 'btn btn-success',
    action: function (e, dt) {
        const r = dt.row({ selected: true }).data();
        if (!r) {
            Swal.fire('Info', 'Pilih satu data dulu', 'info');
            return;
        }

        $('#modal-default').appendTo('body').modal('show');

        $('#modal-default .modal-body')
            .html('<div class="text-center p-3">Loading...</div>');

        $.ajax({
            url:
                BASE_URL +
                'ol_validasi/validasi/rkk/' +
                r.id_kewenangan + '/' +
                r.id_pegawai + '/' +
                r.id_sifat_kewenangan,
            type: 'GET',
success: function (html) {
    console.log('RESPONSE:', html);
    $('#modal-default .modal-body').html(html || '<div class="p-3 text-danger">EMPTY RESPONSE</div>');
},
            error: function (xhr) {
                $('#modal-default .modal-body').html(
                    '<div class="text-danger p-3">Gagal load data</div>'
                );
                console.error(xhr.responseText);
            }
        });
    }
},

    {
        extend: 'selected',
        text: '<i class="fa fa-edit"></i> Edit',
        className: randBtn('warning'),
        action: function (e, dt) {
            const r = dt.row({ selected: true }).data();
            location.href =
                BASE_URL + 'ol_validasi/validasi/edit/' + r.id_kewenangan;
        }
    },

    {
        extend: 'selected',
        text: '<i class="fa fa-eye"></i> Lihat',
        className: randBtn('info'),
        action: function (e, dt) {
            const r = dt.row({ selected: true }).data();
            window.open(
                BASE_URL + 'ol_validasi/validasi/detail/' + r.id_kewenangan,
                '_blank'
            );
        }
    },

    {
        extend: 'selected',
        text: '<i class="fa fa-trash"></i> Hapus',
        className: randBtn('danger'),
        action: function (e, dt) {
            const r = dt.row({ selected: true }).data();

            Swal.fire({
                title: 'Yakin?',
                text: 'Data akan dihapus',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus'
            }).then(res => {
                if (res.isConfirmed) {
                    location.href =
                        BASE_URL +
                        'ol_validasi/validasi/hapus/' +
                        r.id_kewenangan;
                }
            });
        }
    },
    {
        text: '<i class="fa fa-check"></i> Validasi',
        extend: 'selected',
        className: randBtn('danger'),
        action: function ( e, dt, node, config ) {
            const r = dt.row({ selected: true }).data();
            location.href =
                BASE_URL + 'ol_validasi/validasi/validasi/' + r.barcode_pegawai;
        }
    },
    {
        text: '<i class="fa fa-sync"></i> Reload',
        className: randBtn('secondary'),
        action: function (e, dt) {
            dt.ajax.reload(null, false);
        }
    }*/
    ]
});
<?php
}
elseif ($page=="validasig")
{
?>
    function debounce(fn, delay) {
        let t; return function () {
            clearTimeout(t);
            t = setTimeout(() => fn.apply(this, arguments), delay);
        };
    }
    $(document).ready(function() {
     if ($(this).data('server') === true) {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
        processing: true,
        serverSide: true,
        responsive: false,
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
        ajax: {
            url: "<?= base_url() ?>ol_validasi/<?= $page ?>/data",
            type: "POST"
        },
        columns: [
            {
                className: 'details-control',
                orderable: false,
                searchable: false,
                data: null,
                defaultContent: ''
            },
            { data: 'nama_pegawai' },
            { data: 'nip' },
            { data: 'nama_unit' },
            { data: 'nama_komite' },
        ],
        order: [[4, 'asc'], [1, 'asc']]
        select: {
            style: 'single' // atau 'multi'
        },
        columnDefs: [
           {
               targets: 0,
               title: 'Aksi',
               className: 'no-vis'
           },
           {
               targets: 4,
             //  title: 'Aksi',
               className: 'no-vis'
           }
        ],
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-search'></i> Validasi",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_validasi/'.$page.'/validasi/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ]
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");
        $(".btnnavy").removeClass("dt-button").addClass("btn bg-navy btn-sm");
        $(".btnyellow").removeClass("dt-button").addClass("btn bg-yellow btn-sm");
        $(".btnmaroon").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
        $(".btnolive").removeClass("dt-button").addClass("btn bg-olive btn-sm");
        $(".btnpurple").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnred").removeClass("dt-button").addClass("btn bg-red btn-sm");
        $(".btnaqua").removeClass("dt-button").addClass("btn bg-aqua btn-sm");
        $(".btnlightblue").removeClass("dt-button").addClass("btn bg-light-blue btn-sm");
        $(".btnblue").removeClass("dt-button").addClass("btn bg-blue btn-sm");
        $(".btngreen").removeClass("dt-button").addClass("btn bg-green btn-sm");
        $(".btnteal").removeClass("dt-button").addClass("btn bg-teal btn-sm");
        $(".btnlime").removeClass("dt-button").addClass("btn bg-lime btn-sm");
        $(".btnorange").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnfuchsia").removeClass("dt-button").addClass("btn bg-fuchsia btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
      }
    });
<?php
}
elseif ($page=="validasi_ori")
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "pageLength": 10,
            "scrollX": true,
            "pagingType": "full_numbers",
            "oLanguage": {
                "sSearch": "Cari",
                "sLengthMenu": "Tampilkan _MENU_ baris",
                "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ baris",
                "sInfoEmpty": "Total Record _TOTAL_",
                "sInfoFiltered": "(Filter dari _TOTAL_ Records)",
                "sEmptyTable": "Tidak ada data untuk ditampilkan",
                "sZeroRecords": "Tidak ada data yang sesuai",
                "sProcessing": "Loading... Mohon Tunggu",
                "sInfoThousands": "'",
                "oPaginate": {
                    "sFirst": "Awal",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Akhir"
                },
                "select": {
                    "cells": {
                        "0": "",
                        "1": "1 cell Terpilih",
                        "_": "%d cells Terpilih"
                    },
                    "columns": {
                        "0": "",
                        "1": "1 column Terpilih",
                        "_": "%d columns Terpilih"
                    },
                    "rows": {
                        "_": "%d rows Terpilih",
                        "0": "",
                    }
                },
            },
            "ajax": {
                "url"  : "<?php echo base_url();?>ol_validasi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "nama_pegawai" },
                      { "data": "nip" },
                      { "data": "nama_unit", "searchable":false },
                      { "data": "nama_komite", "searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-search'></i> Validasi",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_validasi/'.$page.'/validasi/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ]
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");
        $(".btnnavy").removeClass("dt-button").addClass("btn bg-navy btn-sm");
        $(".btnyellow").removeClass("dt-button").addClass("btn bg-yellow btn-sm");
        $(".btnmaroon").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
        $(".btnolive").removeClass("dt-button").addClass("btn bg-olive btn-sm");
        $(".btnpurple").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnred").removeClass("dt-button").addClass("btn bg-red btn-sm");
        $(".btnaqua").removeClass("dt-button").addClass("btn bg-aqua btn-sm");
        $(".btnlightblue").removeClass("dt-button").addClass("btn bg-light-blue btn-sm");
        $(".btnblue").removeClass("dt-button").addClass("btn bg-blue btn-sm");
        $(".btngreen").removeClass("dt-button").addClass("btn bg-green btn-sm");
        $(".btnteal").removeClass("dt-button").addClass("btn bg-teal btn-sm");
        $(".btnlime").removeClass("dt-button").addClass("btn bg-lime btn-sm");
        $(".btnorange").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnfuchsia").removeClass("dt-button").addClass("btn bg-fuchsia btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
        $('#search-inp').keyup(function(){
          table.search($(this).val()).draw() ;
        })
    });
<?php
}
elseif ($page=="validasir")
{
?>
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
$(document).ready(function() {
    var table = $('#dttb').DataTable( {
            "pagingType": "full_numbers",
            "oLanguage": {
                "sSearch": "Cari",
                "sLengthMenu": "Tampilkan _MENU_ baris",
                "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ baris",
                "sInfoEmpty": "Total Record _TOTAL_",
                "sInfoFiltered": "(Filter dari _TOTAL_ Records)",
                "sEmptyTable": "Tidak ada data untuk ditampilkan",
                "sZeroRecords": "Tidak ada data yang sesuai",
                "sProcessing": "Loading... Mohon Tunggu",
                "sInfoThousands": "'",
                "oPaginate": {
                    "sFirst": "Awal",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Akhir"
                },
                "select": {
                    "cells": {
                        "0": "",
                        "1": "1 cell Terpilih",
                        "_": "%d cells Terpilih"
                    },
                    "columns": {
                        "0": "",
                        "1": "1 column Terpilih",
                        "_": "%d columns Terpilih"
                    },
                    "rows": {
                        "_": "%d rows Terpilih",
                        "0": "",
                    }
                },
            },
        "ajax": {
            "url"  : "<?= base_url() ?>ol_validasi/<?= $page ?>/data",
            "type" : "POST"
        },
    //    "rowId": 'id',
        "columns": [
            { "data": "nama_pegawai" },
            { "data": "nip" },
            { "data": "nama_unit" },
            { "data": "nama_komite" }
        ],
        "order": [[0, 'asc']],
        select: 'single',
        dom: 'Blfrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-search'></i> Validasi",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_validasi/'.$page.'/validasi/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ]
    });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");
        $(".btnnavy").removeClass("dt-button").addClass("btn bg-navy btn-sm");
        $(".btnyellow").removeClass("dt-button").addClass("btn bg-yellow btn-sm");
        $(".btnmaroon").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
        $(".btnolive").removeClass("dt-button").addClass("btn bg-olive btn-sm");
        $(".btnpurple").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnred").removeClass("dt-button").addClass("btn bg-red btn-sm");
        $(".btnaqua").removeClass("dt-button").addClass("btn bg-aqua btn-sm");
        $(".btnlightblue").removeClass("dt-button").addClass("btn bg-light-blue btn-sm");
        $(".btnblue").removeClass("dt-button").addClass("btn bg-blue btn-sm");
        $(".btngreen").removeClass("dt-button").addClass("btn bg-green btn-sm");
        $(".btnteal").removeClass("dt-button").addClass("btn bg-teal btn-sm");
        $(".btnlime").removeClass("dt-button").addClass("btn bg-lime btn-sm");
        $(".btnorange").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnfuchsia").removeClass("dt-button").addClass("btn bg-fuchsia btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
        $('#search-inp').keyup(function(){
          table.search($(this).val()).draw() ;
        })
});


/*    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
            "pageLength": 10,
            "scrollX": true,
            "pagingType": "full_numbers",
            "oLanguage": {
                "sSearch": "Cari",
                "sLengthMenu": "Tampilkan _MENU_ baris",
                "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ baris",
                "sInfoEmpty": "Total Record _TOTAL_",
                "sInfoFiltered": "(Filter dari _TOTAL_ Records)",
                "sEmptyTable": "Tidak ada data untuk ditampilkan",
                "sZeroRecords": "Tidak ada data yang sesuai",
                "sProcessing": "Loading... Mohon Tunggu",
                "sInfoThousands": "'",
                "oPaginate": {
                    "sFirst": "Awal",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Akhir"
                },
                "select": {
                    "cells": {
                        "0": "",
                        "1": "1 cell Terpilih",
                        "_": "%d cells Terpilih"
                    },
                    "columns": {
                        "0": "",
                        "1": "1 column Terpilih",
                        "_": "%d columns Terpilih"
                    },
                    "rows": {
                        "_": "%d rows Terpilih",
                        "0": "",
                    }
                },
            },
            "ajax": {
                "url"  : "<?php echo base_url();?>ol_validasi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "nama_pegawai" },
                      { "data": "nip" },
                      { "data": "nama_unit", "searchable":false },
                      { "data": "nama_komite", "searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-search'></i> Validasi",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_validasi/'.$page.'/validasi/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ]
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");
        $(".btnnavy").removeClass("dt-button").addClass("btn bg-navy btn-sm");
        $(".btnyellow").removeClass("dt-button").addClass("btn bg-yellow btn-sm");
        $(".btnmaroon").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
        $(".btnolive").removeClass("dt-button").addClass("btn bg-olive btn-sm");
        $(".btnpurple").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnred").removeClass("dt-button").addClass("btn bg-red btn-sm");
        $(".btnaqua").removeClass("dt-button").addClass("btn bg-aqua btn-sm");
        $(".btnlightblue").removeClass("dt-button").addClass("btn bg-light-blue btn-sm");
        $(".btnblue").removeClass("dt-button").addClass("btn bg-blue btn-sm");
        $(".btngreen").removeClass("dt-button").addClass("btn bg-green btn-sm");
        $(".btnteal").removeClass("dt-button").addClass("btn bg-teal btn-sm");
        $(".btnlime").removeClass("dt-button").addClass("btn bg-lime btn-sm");
        $(".btnorange").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnfuchsia").removeClass("dt-button").addClass("btn bg-fuchsia btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
        $('#search-inp').keyup(function(){
          table.search($(this).val()).draw() ;
        })
    });*/
<?php
}
elseif ($page=="validasi_validasi")
{
?>
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "searching": false,
            "lengthChange": true,
            "pageLength": 10,
            "scrollX": true,
            "pagingType": "full_numbers",
            "oLanguage": {
                "sSearch": "Cari",
                "sLengthMenu": "Tampilkan _MENU_ baris",
                "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ baris",
                "sInfoEmpty": "Total Record _TOTAL_",
                "sInfoFiltered": "(Filter dari _TOTAL_ Records)",
                "sEmptyTable": "Tidak ada data untuk ditampilkan",
                "sZeroRecords": "Tidak ada data yang sesuai",
                "sProcessing": "Loading... Mohon Tunggu",
                "sInfoThousands": "'",
                "oPaginate": {
                    "sFirst": "Awal",
                    "sPrevious": "Sebelumnya",
                    "sNext": "Selanjutnya",
                    "sLast": "Akhir"
                },
                "select": {
                    "cells": {
                        "0": "",
                        "1": "1 cell Terpilih",
                        "_": "%d cells Terpilih"
                    },
                    "columns": {
                        "0": "",
                        "1": "1 column Terpilih",
                        "_": "%d columns Terpilih"
                    },
                    "rows": {
                        "_": "%d rows Terpilih",
                        "0": "",
                    }
                },
            },
            "ajax": {
                "url"  : "<?php echo base_url();?>ol_validasi/validasi/logbook/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "nama_kewenangan","searchable":false },
                      { "data": "nama_kompetensi","searchable":false },
                      { "data": "nama_sifat_kewenangan","searchable":false, className: "text-center" }
            ],
            "order": [[2, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                  {
                    text: "<i class='fa fa-pencil'></i> Validasi",
                    extend: "selected",
                    className: "btnolive",
                      action: function ( e, dt, node, config ) { 
                       data1 = dt.rows( { selected: true } ).data()[0]['id_kewenangan'];
                       data2 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                       data3 = dt.rows( { selected: true } ).data()[0]['id_sifat_kewenangan'];
                       $("#modal-default").modal();
                         $('.modal-body').load('<?php echo base_url('ol_validasi/validasi/rkk/'); ?>'+data1+'/'+data2+'/'+data3,function(){
                           $('#modal-default').modal({show:true});
                         });
                      }
                  },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ]
        });
        $(".dt-buttons").addClass("rapikan_tb_dtgrid");
        $(".btnnavy").removeClass("dt-button").addClass("btn bg-navy btn-sm");
        $(".btnyellow").removeClass("dt-button").addClass("btn bg-yellow btn-sm");
        $(".btnmaroon").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
        $(".btnolive").removeClass("dt-button").addClass("btn bg-olive btn-sm");
        $(".btnpurple").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnred").removeClass("dt-button").addClass("btn bg-red btn-sm");
        $(".btnaqua").removeClass("dt-button").addClass("btn bg-aqua btn-sm");
        $(".btnlightblue").removeClass("dt-button").addClass("btn bg-light-blue btn-sm");
        $(".btnblue").removeClass("dt-button").addClass("btn bg-blue btn-sm");
        $(".btngreen").removeClass("dt-button").addClass("btn bg-green btn-sm");
        $(".btnteal").removeClass("dt-button").addClass("btn bg-teal btn-sm");
        $(".btnlime").removeClass("dt-button").addClass("btn bg-lime btn-sm");
        $(".btnorange").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnfuchsia").removeClass("dt-button").addClass("btn bg-fuchsia btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
    });
/*    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Apakah Anda Yakin Hapus Data",
            text: "Data Dapat Dipilih Kembali!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // redirect with javascript here as per your logic after showing the alert using the urlToRedirect value
                window.location.href = urlToRedirect;
            } else {
                swal("Data Tidak Jadi Di Hapus");
            }
        });
    }*/
<?php  
}
?>
</script>
</body>
</html>
