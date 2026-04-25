<script type="text/javascript">
function Timer() {
   var hr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
   var bl = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
   var dt=new Date()
   document.getElementById('timer_waktu').innerHTML=hr[dt.getDay()]+", "+dt.getDate()+" "+bl[dt.getMonth()]+" "+dt.getFullYear()+" ["+ dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds()+"]";
   setTimeout("Timer()",1000);
}
Timer();
const base_url = "<?= base_url(); ?>";
<?php
//================================================= H O M E =================================================
if ($page=="home")
{
	//	Agar saat home tidak ke universal
?>
$(document).ready(function() {
    $('.select2').select2()
});
<?php
}
elseif ($page=="pengajuan_kompetensi")
{
?>
const RA_BUTTON = {

    colors: [
        "btn-primary",
        "btn-secondary",
        "btn-success",
        "btn-danger",
        "btn-warning",
        "btn-info",
        "btn-dark"
    ],

    init: function () {

        $(".ra-btn").each(function () {

            // hapus semua warna bootstrap lama
            $(this).removeClass(
                "btn-primary btn-secondary btn-success btn-danger btn-warning btn-info btn-dark " +
                "btn-outline-primary btn-outline-secondary btn-outline-success btn-outline-danger btn-outline-warning btn-outline-info btn-outline-dark"
            );

            // random color
            let randomColor = RA_BUTTON.colors[Math.floor(Math.random() * RA_BUTTON.colors.length)];

            // apply
            $(this).addClass(randomColor);

        });

    }
};

//============================================
function debounce(fn, delay) {
    let t; return function () {
        clearTimeout(t);
        t = setTimeout(() => fn.apply(this, arguments), delay);
    };
}
$(document).ready(function(){
    $.fn.dataTable.ext.errMode = 'none';
  let table = $('#dttb').DataTable({
      processing: true,
      serverSide: true,
      searching: true,
      ordering: true,
      pageLength: 10,
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
      ajax: {
          url: "<?= base_url('admin_asesor/pengajuan_kompetensi/data') ?>",
          type: "POST"
    },
      select: {
          style: 'single',
          selector: 'td:not(.dt-control)'
      },
      order: [[1, "asc"]],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      dom:
        "<'row mb-2'\
          <'col-md-6'l>\
          <'col-md-6 text-end'B>\
        >" +
        "rt" +
        "<'row mt-2'\
          <'col-md-5'i>\
          <'col-md-7 text-end'p>\
        >",
      columns: [
            {
                "className":      'dt-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            {
                data: "tgl_pengajuan",
                name: "tgl_sort"
            },
            { data: "nama_pegawai" },
            { data: "nama_kompetensi" },
            { data: "nama_status_diusulkan" },
            { 
                data: "pengajuan_status", // Field baru dari controller
                name: "ol_pengajuan.status_pengajuan", // 'name' tetap merujuk ke kolom asli untuk keperluan sorting/search
                searchable: false,
                orderable: false 
            }
      ],
createdRow: function(row, data, dataIndex){

    const warna = [
      "table-primary",
      "table-secondary",
      "table-success",
      "table-danger",
      "table-warning",
      "table-info"
    ];

    let idx = this.api().page.info().start + dataIndex;

    $(row).addClass(warna[idx % warna.length]);

},
initComplete: function () {
    const api = this.api();

    api.columns().every(function (colIdx) {

        if (colIdx === 0 || colIdx === 1) return;

        let that = this;

        $('input', this.footer()).on('keyup change', debounce(function () {
            that.search(this.value).draw();
        }, 500));
    });
  //  RA_BUTTON.init();
},
        buttons: [

        ]
  });
window.tableLogbook = table;

function toQueryString(obj){
    return Object.keys(obj)
        .map(k => encodeURIComponent(k) + "=" + encodeURIComponent(obj[k] ?? ""))
        .join("&");
}

// Perbaiki fungsi HTML agar header tabel sesuai dengan kolom validator
function childTableHtml(id) {
    return `
        <div class="p-3 bg-light">
            <h6 class="mb-2"><b>Daftar Validator / Asesor</b></h6>
            <table class="table table-bordered table-sm table-hover w-100 bg-white" id="child-${id}">
                <thead>
                    <tr class="table-dark">
                        <th>Nama Pegawai</th>
                        <th>No. HP</th>
                        <th>Email</th>
                        <th>Status Form</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    `;
}

// Handler Click
$('#dttb tbody').on('click', 'td.dt-control', function () {
    const tr = $(this).closest('tr');
    const row = table.row(tr);
    const d = row.data();

    if (row.child.isShown()) {
        row.child.hide();
        tr.removeClass('shown');
        return;
    }

    // Tutup child row lain yang sedang terbuka
    table.rows().every(function () {
        if (this.child.isShown()) {
            this.child.hide();
            $(this.node()).removeClass('shown');
        }
    });

    tr.addClass('shown');
    let childId = d.barcode_pengajuan;
    let child_table_id = "child-" + d.barcode_pengajuan;
    row.child(childTableHtml(childId)).show();

    // Inisialisasi DataTable pada elemen yang baru dibuat
    $('#child-' + childId).DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        searching: true,
        paging: true,
        lengthChange: false,
        pageLength: 5,
        destroy: true,
        ajax: {
            url: base_url + 'admin_asesor/pengajuan_kompetensi/child_validator', // PASTIKAN URL BENAR
            type: 'POST',
            data: function(x) {
                x.barcode_pengajuan = d.barcode_pengajuan; // Kirim parameter barcode
            }
        },
        columns: [
            { data: 'nama_pegawai' },
            { data: 'no_hp' },
            { data: 'email' },
            { data: "status_form_label" },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: "text-center",
/*                render: function(data, type, row) {
                    let urlHapus = base_url + "pengajuan_kompetensi/hapus?" + toQueryString(row);
                    return `
                        <button class="btn btn-xs btn-warning ra-btn" data-modal-url="${urlHapus}" data-modal-title="Edit Validator">
                            <i class="fa fa-trash"></i>
                        </button>
                    `;
                }*/
                render: function(data, type, row){

                    // tambahan biar bisa reload child table yang benar
                    row.child_table_id = child_table_id;

                    let urlHapus = base_url + "admin_asesor/pengajuan_kompetensi/modal_hapus_validator?" + toQueryString(row);
                    let urlForm = base_url + "admin_asesor/pengajuan_kompetensi/form?" + toQueryString(row);

                    return `
                        <button class="btn btn-sm btn-danger ra-btn"
                            data-modal-url="${urlHapus}"
                            data-modal-title="Hapus"
                            data-modal-method="GET">
                            Hapus
                        </button>

                        <button class="btn btn-sm btn-info ra-btn"
                            data-modal-url="${urlForm}"
                            data-modal-title="Seting Form"
                            data-modal-method="GET">
                            Seting Form
                        </button>
                    `;
                }
            }
        ]
    });
});

    // ================================
    // RA BUTTON INIT
    // ================================
    RA_BUTTON.init();

    // ================================
    // MODAL INSTANCE
    // ================================
    const modalEl = document.getElementById("modal-default");
    const raModal = new bootstrap.Modal(modalEl);

    function getSelectedRow() {
        return table.row({ selected: true }).data() || null;
    }
    function openRaModal({ title, url, method = "GET", params = {} }) {

        $("#raModalTitle").text(title);

        $("#raModalBody").html(`
            <div class="text-center py-4">
                <div class="spinner-border text-primary"></div>
                <div class="mt-2">Memuat...</div>
            </div>
        `);

        raModal.show();
        //scroll paling bawah
        setTimeout(function(){
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        }, 150);

        $.ajax({
            url: url,
            type: method,
            data: params,
            success: function (res) {
                $("#raModalBody").html(res);
                RA_BUTTON.init();
            },
            error: function () {
                $("#raModalBody").html(`
                    <div class="alert alert-danger">
                        Gagal memuat data
                    </div>
                `);
            }
        });
    }
    // ================================
    // ACTION BUTTON CLICK HANDLER
    // ================================
$(document).on("click", ".ra-btn[data-modal-url]", function (e) {

    e.preventDefault();
 //   if (!modalUrl) return true;
    let $btn = $(this);

    let modalUrl      = $btn.data("modal-url");
    let modalTitle    = $btn.data("modal-title") || "Modal";
    let method        = ($btn.data("modal-method") || "GET").toUpperCase();
    let requireSelect = $btn.data("require-select");

    if (!modalUrl) return;

    let params = {};

    // =============================
    // Jika butuh row terpilih
    // =============================
    if (requireSelect) {

        let row = getSelectedRow();

        if (!row) {
            Swal.fire("Info", "Pilih data dulu!", "warning");
            return;
        }

        // kirim seluruh data row
        params = { ...row };
    }

    // =============================
    // Optional: ambil parameter tambahan dari tombol
    // =============================
    if ($btn.data("extra")) {
        try {
            let extraParams = JSON.parse($btn.attr("data-extra"));
            params = { ...params, ...extraParams };
        } catch (e) {
            console.warn("Format data-extra salah (harus JSON)");
        }
    }

    openRaModal({
        title: modalTitle,
        url: modalUrl,
        method: method,
        params: params
    });

});

});
<?php
}
elseif ($page=="pengajuan_kompetensis")
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
                "url"  : "<?php echo base_url();?>admin_asesor/<?php echo $page;?>/data/<?php echo $key;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan","searchable":false,"visible":false },
                      { "data": "tgl_pengajuan", "searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_kompetensi", "searchable":false },
                      { "data": "nama_status_diusulkan", "searchable":false },
                      { "data": "status_pengajuan", "searchable":false,
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-warning">REGISTRASI</button>';
                            } else if(row.status_pengajuan === '1'){
                               return '<button class="btn btn-xs btn-info">PROSES</button>';
                            } else if(row.status_pengajuan === '2'){
                               return '<button class="btn btn-xs btn-primary">Selesai</button>';
                            } else if(row.status_pengajuan === '3'){
                               return '<button class="btn btn-xs btn-success">RKK</button>';
                            } else {
                               return '<button class="btn btn-xs btn-danger">Ditolak</button>';
                            }
                        }
                      }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [ 
              {
                text: "<i class='fa fa-edit'></i> Pilih Validator",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('admin_asesor/'.$page.'/pilih/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              }, 
              {
                text: "<i class='fa fa-cog'></i> Seting Form Validator",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                    data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                    location.href = '<?php echo base_url('admin_asesor/'.$page.'/form/'); ?>'+data;
                  }
              }, 
/*                {
                  text: "<i class='fa fa-pencil'></i> Selesai Kredensial",
                  extend: "selected",
                  className: "btnred",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0];
                  swal({
                    title: "Yakin ?",
                    text: "Yakin akan Selesai Kredensial = "+data['nama_kompetensi'],     //[Modif Disini]
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        location.href = '<php echo base_url('admin_asesor/'.$page.'/selesai/'); ?>'+data+'/2';
                    }
                  });
                 }
                },*/
             {
              text: "<i class='fa fa-recycle'></i> Buat RKK",
              extend: "selected",
              className: "btnlightblue",
              action: function ( e, dt, node, config ) {
              status = dt.rows( { selected: true } ).data()[0]['status_pengajuan'];
               if(status=='1'){
                // alert(JSON.stringify(data));
                data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                $("#modal-default").modal();
                  $('.modal-body').load('<?php echo base_url('admin_asesor/pengajuan_rkk/tambah_sign/'); ?>'+data+'/2',function(){
                    $('#modal-default').modal({show:true});
                  });
               }
               else{
                swal({
                 title: "Data Sudah Print",
                 text: "Data Sudah Tidak Bisa di Edit ",
                 icon: "warning",
                 buttons: "Tutup",
                 dangerMode: true,
                })
               }
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
elseif ($page=="pengajuan_kompetensi_form")
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
                "url"  : "<?php echo base_url();?>admin_asesor/pengajuan_kompetensi/nkr_validator/<?php echo $key;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan_validator", "searchable":false, "visible":false },
                      { "data": "nama_pegawai","searchable":false,"orderable":false },
                      { "data": null, "searchable":false,"orderable":false, 
                        "render": function(data, type, row){
                            if (row.nkr_form === 'BELUM') {
                               return '<button class="btn btn-xs btn-danger"> Belum Set Form</button>';
                             } else {
                               return '<button class="btn btn-xs btn-success"> Sudah Set Form</button>';
                             } 
                        }
                    },
                      { "data": null, "searchable":false,"orderable":false, 
                        "render": function(data, type, row){
                            if (row.status_pengajuan_validator === '1') {
                               return '<button class="btn btn-xs btn-success"> AKTIF</button>';
                             } else {
                               return '<button class="btn btn-xs btn-success"> NON AKTIF</button>';
                             } 
                        }
                    }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-edit'></i> Pilih Akses Form",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan_validator'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('admin_asesor/pengajuan_kompetensi/pilih_form/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-search'></i> Lihat / Edit Akses Form",
                extend: "selected",
                className: "btnmaroon",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan_validator'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('admin_asesor/pengajuan_kompetensi/lihat_form/'); ?>'+data,function(){
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
        $('#search-inp').keyup(function(){
          table.search($(this).val()).draw() ;
        })
    });
<?php
}
elseif ($page=="pengajuan_rkk")
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
                "url"  : "<?php echo base_url();?>admin_asesor/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "barcode_pengajuan","searchable":false,"orderable":false, className:"text-center" },
                      { "data": "tgl_pengajuan", "searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_kompetensi", "searchable":false },
                      { "data": "nama_status_diusulkan", "searchable":false },
                      { "data": "status_pengajuan", "searchable":false,
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-warning">REGISTRASI</button>';
                            } else if(row.status_pengajuan === '1'){
                               return '<button class="btn btn-xs btn-info">PROSES</button>';
                            } else if(row.status_pengajuan === '2'){
                               return '<button class="btn btn-xs btn-primary">Selesai</button>';
                            } else if(row.status_pengajuan === '3'){
                               return '<button class="btn btn-xs btn-success">RKK</button>';
                            } else {
                               return '<button class="btn btn-xs btn-danger">Ditolak</button>';
                            }
                        }
                      }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [ 
             {
              text: "<i class='fa fa-recycle'></i> Edit RKK",
              extend: "selected",
              className: "btnlime",
              action: function ( e, dt, node, config ) {
              status = dt.rows( { selected: true } ).data()[0]['status_pengajuan'];
               if(status=='3'){
                // alert(JSON.stringify(data));
                data = dt.rows( { selected: true } ).data()[0]['id_signature'];
                $("#modal-default").modal();
                  $('.modal-body').load('<?php echo base_url('admin_asesor/'.$page.'/edit_sign/'); ?>'+data,function(){
                    $('#modal-default').modal({show:true});
                  });
               }
               else{
                swal({
                 title: "Data Sudah Print",
                 text: "Data Sudah Tidak Bisa di Edit ",
                 icon: "warning",
                 buttons: "Tutup",
                 dangerMode: true,
                })
               }
              }
             },
             {
              text: "<i class='fa fa-recycle'></i> Tambah Kewenangan Manual",
              extend: "selected",
              className: "btnyellow",
              action: function ( e, dt, node, config ) {
              status = dt.rows( { selected: true } ).data()[0]['status_pengajuan'];
               if(status=='3'){
                // alert(JSON.stringify(data));
                data = dt.rows( { selected: true } ).data()[0]['id_signature'];
                $("#modal-default").modal();
                  $('.modal-body').load('<?php echo base_url('admin_asesor/'.$page.'/tambah_kewenangan/'); ?>'+data,function(){
                    $('#modal-default').modal({show:true});
                  });
               }
               else{
                swal({
                 title: "Data Sudah Print",
                 text: "Data Sudah Tidak Bisa di Edit ",
                 icon: "warning",
                 buttons: "Tutup",
                 dangerMode: true,
                })
               }
              }
             },
             {
               text: "<i class='fa fa-pencil'></i> Status Final / Terbit RKK",
               extend: "selected",
               className: "btnred",
               action: function ( e, dt, node, config ) {
               data = dt.rows( { selected: true } ).data()[0];
               swal({
                 title: "Yakin ? Data Final Tidak Bisa Di Edit",
                 text: "Yakin akan Terbitkan RKK = "+data['nama_kompetensi'],     //[Modif Disini]
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
               })
               .then((willDelete) => {
                 if (willDelete) {
                     data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                     location.href = '<?php echo base_url('admin_asesor/pengajuan_kompetensi/selesai/'); ?>'+data+'/3';
                 }
               });
              }
             },
             {
              text: "<i class='fa fa-print'></i> Keluarkan PDF RKK",
              extend: "selected",
              className: "btnfuchsia",
              action: function ( e, dt, node, config ) {
              status = dt.rows( { selected: true } ).data()[0]['status_pengajuan'];
               if(status=='3'){
                // alert(JSON.stringify(data));
                data = dt.rows( { selected: true } ).data()[0]['id_signature'];
                $(window.open('<?php echo base_url('admin_asesor/'.$page.'/pdf_rkk/'); ?>'+data));
               }
               else{
                swal({
                 title: "Data Harus Di Finalkan",
                 text: "Data Sudah Tidak Bisa di Edit Jika Di Finalkan ",
                 icon: "warning",
                 buttons: "Tutup",
                 dangerMode: true,
                })
               }
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
?>
</script>
		</div>
	</body>
</html>
