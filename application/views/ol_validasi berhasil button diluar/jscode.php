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
window.DT_BUTTON_STYLE = (function(){

    const COLORS = {
        primary:   ['btn-primary','btn-outline-primary','btn-pastel-primary'],
        success:   ['btn-success','btn-outline-success','btn-pastel-success'],
        warning:   ['btn-warning','btn-outline-warning','btn-pastel-warning'],
        danger:    ['btn-danger','btn-outline-danger','btn-pastel-danger'],
        info:      ['btn-info','btn-outline-info','btn-pastel-info'],
        secondary: ['btn-secondary','btn-outline-secondary','btn-pastel-secondary'],
        dark:      ['btn-dark','btn-outline-dark']
    };

    const SHAPES = [
        '',
        'btn-pill',
        'btn-square',
        'btn-rounded-sm',
        'btn-rounded-lg'
    ];

    const EFFECTS = [
        '',
        'btn-soft-shadow',
        'btn-glow',
        'btn-ghost',
        'blinking'
    ];

    const SIZES = [
        '',
        'btn-xs',
        'btn-md'
    ];

    const rand = arr => arr[Math.floor(Math.random() * arr.length)];

    function resolveColor(base){
        if (base && COLORS[base]) return rand(COLORS[base]);
        return rand(Object.values(COLORS).flat());
    }

    function generate(opt = {}) {

        // ===== PERSIST MODE =====
        if (opt.persist && opt.key) {
            const k = 'dtbtn_style_' + opt.key;
            if (localStorage[k]) return localStorage[k];
            const cls = build(opt);
            localStorage[k] = cls;
            return cls;
        }

        return build(opt);
    }

    function build(opt){
        return [
            'btn',
            'btn-sm',
            resolveColor(opt.color),
            rand(SHAPES),
            rand(EFFECTS),
            rand(SIZES),
            opt.iconOnly ? 'btn-icon' : ''
        ].join(' ').trim();
    }

    return { generate };

})();
function debounce(fn, delay) {
    let t; return function () {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, arguments), delay);
    };
}
$(function() {
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
        dom: "tr<'row mt-2'<'col-md-5'i><'col-md-7 text-end'p>>",
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
  {
    extend: 'excel',
    className: 'd-none', // ⬅️ HIDDEN
    title: 'Validasi Pegawai'
  }
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

$('#btn-validasi').addClass(
  DT_BUTTON_STYLE.generate({ color:'success' })
);

$('#btn-edit').addClass(
  DT_BUTTON_STYLE.generate({
    color:'warning',
    iconOnly:true,
    persist:true,
    key:'btn_edit_validasi'
  })
);

$('#btn-reload').addClass(
  DT_BUTTON_STYLE.generate()
);

$('#btn-export').addClass(
  DT_BUTTON_STYLE.generate({ color:'info' })
);
table.on('select deselect', function () {
    const has = table.rows({ selected:true }).any();

    $('#btn-validasi').prop('disabled', !has);
    $('#btn-edit').prop('disabled', !has);
});
$('#btn-validasi').on('click', function () {
    const r = table.row({ selected:true }).data();
    if (!r) return;

    window.open(
      BASE_URL + 'ol_validasi/validasi/validasi/' + r.barcode_pegawai,
      '_blank'
    );
});
$('#btn-edit').on('click', function () {
    const r = table.row({ selected:true }).data();
    if (!r) return;

    $('#modal-default').modal('show')
      .find('.modal-body')
      .load(
        BASE_URL + 'ol_validasi/validasi/edit/' + r.barcode_pegawai
      );
});
$('#btn-reload').on('click', function () {
    table.ajax.reload(null, false);
});
$('#btn-export').on('click', function () {
    table.button('.buttons-excel').trigger();
});

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
        style: 'single',
        selector: 'td'
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
    },*/
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
    }
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
