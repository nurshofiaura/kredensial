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
        }
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
});
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
