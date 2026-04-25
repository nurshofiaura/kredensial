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
$('#pop1,#pop2,#pop3').popover({ trigger: "hover" });
<?php
//================================================= H O M E =================================================
if ($page=="home")
{
	//	Agar saat home tidak ke universal
?>

<?php
}
else if ($page=="etik_tambah" || $page=="ms_etik_tambah" || $page=="ms_etik_edit"  || $page=="etik_pegawai_lihat")
{
?>
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })    
});
<?php
}
else if ($page=="etik_edit")
{
?>
$(document).ready(function() {
    $('.select2').select2()   
});
<?php
}
elseif ($page=="etik")
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
                "url"  : "<?php echo base_url();?>ol_etik/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_etik", "searchable":false, "visible":false },
                      { "data": "nama_etik" },
                      { "data": "nama_jabatan", "searchable":false },
                      { "data": "status_etik",
                        "render": function(data, type, row){
                            if (row.status_etik === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah Poin Etik",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('ol_etik/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Rubah Etik",
                    extend: "selected",
                    className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_etik'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_etik/'.$page.'/edit/'); ?>'+data;
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
elseif ($page=="ms_etik")
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
                "url"  : "<?php echo base_url();?>ol_etik/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_etik_instansi", "searchable":false, "visible":false },
                      { "data": "nama_jabatan", "searchable":false },
                      { "data": "nama_working", "searchable":false },
                      { "data": "status_etik_instansi", "searchable":false,
                        "render": function(data, type, row){
                            if (row.status_etik_instansi === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                            } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                            }
                        }
                      }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah Poin Etik",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('ol_etik/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Rubah Etik",
                    extend: "selected",
                    className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_etik_instansi'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_etik/'.$page.'/edit/'); ?>'+data;
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
elseif ($page=="etik_pegawai")
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
                "url"  : "<?php echo base_url();?>ol_etik/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_etik_pegawai","searchable":false,"visible":false },
                      { "data": "tgl_etik_pegawai","searchable":false },
                      { "data": "nama_working","searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "jumlah_etik","searchable":false },
                      { "data": "total_etik","searchable":false },
                      { "data": "hasil_etik","searchable":false },
                      { "data": "penguji","searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                 {
                    text: "<i class='fa fa-plus'></i> Nilai Etik",
                    className: "btnyellow",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('ol_etik/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-search'></i> Hasil Etik",
                    extend: "selected",
                    className: "btnblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_etik_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_etik/'.$page.'/lihat/'); ?>'+data;
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
if ($page=="etik_pegawai_tambah")
{
?>
$(function(){
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
});
var $radios = $(':radio[name^="skor_etik"]').change(function() {

  var totalPrice = $radios.filter(function() {
    return this.checked && this.value === '1'
  }).length;

  $('#sub_total').val(totalPrice);

});

// change first one on page load for demo
$radios.first().change()

function total_GR() {
var atas = parseInt(document.getElementById('sub_total').value);
var bawah = parseInt(document.getElementById('total').value);
var hasile_GR = atas / bawah * 100;

    if (hasile_GR >= 0 && hasile_GR <= 49) {
        document.getElementById("hasilGR").value = "D : Buruk";
    }
    if (hasile_GR >= 50 && hasile_GR <= 69) {
        document.getElementById("hasilGR").value = "C : Cukup";
    }
    if (hasile_GR >= 70 && hasile_GR <= 89) {
        document.getElementById("hasilGR").value = "B : Baik";
    }
    if (hasile_GR >= 90) {
        document.getElementById("hasilGR").value = "A : Prima";
    }

}
<?php
}
elseif ($page=="pengajuan_kompetensi")
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
                "url"  : "<?php echo base_url();?>ol_pengajuan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan", "searchable":false, "visible":false },
                      { "data": "tgl_pengajuan", "searchable":false },
                      { "data": "nama_status_diusulkan", "searchable":false },
                      { "data": "status_pengajuan",
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-danger"> Belum Terkirim</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success"> Terkirim</button>';
                           }
                        }
                      },
                      { "data": "acc_kabid",
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
                            }else if (row.acc_kabid === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.acc_kabid === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "acc_asesor",
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
                           } else if (row.acc_asesor === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.acc_asesor === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                     { "data": "nama_pegawai", "searchable":false },
                      { "data": "acc_komite",
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
                           } else if (row.acc_komite === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.acc_komite === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "acc_direktur",
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
                           } else if (row.acc_direktur === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.acc_direktur === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "status_terbitkan",
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
                           } else if (row.status_terbitkan === '0') {
                               return '<button class="btn btn-xs btn-warning"> Belum Diterbitkan</button>';
                           } else if (row.status_terbitkan === '1') {
                               return '<button class="btn btn-xs btn-success"> Terbitkan</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Tidak diterbitkan</button>';
                           }
                        }
                      }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Lengkapi Pengajuan",
                    extend: "selected",
                    className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_pengajuan/'.$page.'/isi/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Kredensial / Non Perawat",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        <?php
                            if($perawat_stat > 0){
                        ?>
                           swal({
                            title: "NON KEPERAWATAN",
                            text: "Ada Data Penugasan Klinis",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })                    
                        <?php       
                            }else{
                        ?>
                             $("#modal-default").modal();
                              $('.modal-body').load('<?php echo base_url('ol_pengajuan/'.$page.'/tambah/2'); ?>',function(){
                                $('#modal-default').modal({show:true});
                              });
                          <?php
                            }
                          ?>
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Perawat Kenaikan Tingkat",
                    className: "btnlightblue",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        <?php
                            if($perawat_stat == 0){
                        ?>
                           swal({
                            title: "KEPERAWATAN",
                            text: "Tidak Ada Data Penugasan Klinis",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })                    
                        <?php       
                            }else{
                        ?>
                            $("#modal-default").modal();
                              $('.modal-body').load('<?php echo base_url('ol_pengajuan/'.$page.'/tambah/1'); ?>',function(){
                                $('#modal-default').modal({show:true});
                              });
                          <?php
                            }
                          ?>
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Perawat Pemulihan Kewenangan",
                    className: "btnpurple",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                <?php
                            if($perawat_stat == 0  OR $jml_yang_ditolak == 0){
                        ?>
                           swal({
                            title: "KEPERAWATAN",
                            text: "Tidak Ada Data Penugasan Klinis / Kewenangan Tertolak",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })                    
                        <?php       
                            }else{
                        ?>
                            $("#modal-default").modal();
                              $('.modal-body').load('<?php echo base_url('ol_pengajuan/'.$page.'/tambah/4'); ?>',function(){
                                $('#modal-default').modal({show:true});
                              });
                          <?php
                            }
                          ?>
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Perawat Penambahan Kompetensi",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        <?php
                            if($perawat_stat == 0){
                        ?>
                           swal({
                            title: "KEPERAWATAN",
                            text: "Tidak Ada Data Penugasan Klinis",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })                    
                        <?php       
                            }else{
                        ?>
                          $("#modal-default").modal();
                              $('.modal-body').load('<?php echo base_url('ol_pengajuan/'.$page.'/tambah/3'); ?>',function(){
                                $('#modal-default').modal({show:true});
                              });
                          <?php
                            }
                          ?>
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
elseif ($page=="pengajuan_kompetensi_isi")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td colspan="2">RM:</td><td colspan="2">'+d.rm+'</td> <td colspan="2">Jam :</td><td colspan="2">'+d.jam_logbook+'</td></tr>'+
      '<tr> <td colspan="2">Tgl Karu:</td><td colspan="2">'+d.tgl_v_karu+'</td> <td colspan="2">Acc Kabid:</td><td colspan="2">'+d.tgl_v_kabid+'</td></tr>'+
      '<tr> <td colspan="2">Acc Asesor:</td><td colspan="2">'+d.tgl_v_asesor+'</td> <td colspan="2">Acc Komite:</td><td colspan="2">'+d.tgl_v_komite+'</td></tr>'+
      '<tr> <td colspan="2">Acc Direktur:</td><td colspan="2">'+d.tgl_v_direktur+'</td> <td colspan="2">Acc Komite:</td><td colspan="2">'+d.tgl_v_komite+'</td></tr>'+
      '</table>';
    }
    $("#search-inp").keypress(function(event) {
        var character = String.fromCharCode(event.keyCode);
        return isValid(character);
    });
    function isValid(str) {
        return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
    }
    $(document).ready(function() {
        $('.select2').select2()
        <?php if($id_status_diusulkan == 4){ ?>
        var table2 = $('#dttb2').DataTable( {
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
                "url"  : "<?php echo base_url();?>ol_pengajuan/pengajuan_kompetensi/pemulihan/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook_pemulihan", "searchable":false, "visible":true },
                      { "data": "tgl_awal", "searchable":false },
                      { "data": "tgl_akhir", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "nama_ruangan", "searchable":false },
                      { "data": "result_pemulihan",
                        "render": function(data, type, row){
                            if (row.result_pemulihan === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.result_pemulihan === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "catatan_pemulihan", "searchable":false },
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-search'></i> Lihat Pemulihan",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook_pemulihan'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/lihat_pemulihan/'); ?>'+data,function(){
                          $('#modal-default').modal({show:true});
                        });

                  }
              },
              {
                text: "<i class='fa fa-search'></i> Lihat Kegiatan Pemulihan",
                extend: "selected",
                className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook_pemulihan'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/lihat_kegiatan/'); ?>'+data,function(){
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
        <?php } ?>
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
                "url"  : "<?php echo base_url();?>ol_pengajuan/pengajuan_kompetensi/tabel/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable":false,
                        "data":      null,
                        "defaultContent": '<i class = "glyphicon glyphicon-plus-sign"> </ i>'
                    },
                      { "data": "id_logbook", "searchable":false, "visible":true },
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "nama_kode_kewenangan", "searchable":false },
                      { "data": "nama_kewenangan" },
                      { "data": "jml_logbook", "searchable":false },
                      { "data": "v_karu",
                        "render": function(data, type, row){
                            if (row.v_karu === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_karu === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "v_kabid",
                        "render": function(data, type, row){
                            if (row.v_kabid === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_kabid === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "v_asesor",
                        "render": function(data, type, row){
                            if (row.v_asesor === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_asesor === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "v_komite",
                        "render": function(data, type, row){
                            if (row.v_komite === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_komite === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "v_direktur",
                        "render": function(data, type, row){
                            if (row.v_direktur === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_direktur === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      }
            ],
            "order": [[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
            <?php if($status_pengajuan == 0){ ?>
                 {
                     text: "<i class='fa fa-close'></i> Hilangkan Logbook Dari Daftar",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                     swal({
                       title: "Logbook Tidak Di hapus",
                       text: "Yakin akan mereset logbook ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/reset_logbook/'); ?>'+data+'/<?php echo $id;?>'; //[Modif Disini]
                       }
                     });
                    }
                 },
            <?php } ?>
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
        $('#dttb').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        });
        $('#search-inp').keyup(function(){
          table.search($(this).val()).draw() ;
        })
    });
/*      am4core.ready(function() {
        am4core.useTheme(am4themes_dataviz);
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv", am4charts.PieChart);
        chart.dataSource.url = "";
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "total";
        pieSeries.dataFields.category = "nama_kompetensi";
        pieSeries.innerRadius = am4core.percent(50);
        pieSeries.ticks.template.disabled = true;
        pieSeries.labels.template.disabled = true;
        var rgm = new am4core.RadialGradientModifier();
        rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
        pieSeries.slices.template.fillModifier = rgm;
        pieSeries.slices.template.strokeModifier = rgm;
        pieSeries.slices.template.strokeOpacity = 0.4;
        pieSeries.slices.template.strokeWidth = 0;
        var title = chart.titles.create();
        title.text = "GRAFIK PERSENTASE KOMPETENSI";
        title.fontSize = 25;
        title.tooltipText = "JIKA TIDAK TAMPIL PERBAIKI ID AWAL DAN AKHIR LOGBOOK";
        chart.legend = new am4charts.Legend();
        chart.legend.position = "right";
        chart.legend.valign = "bottom";
        chart.legend.margin(5,5,5,5);
        chart.legend.valign = "top";
        chart.legend.scrollable = true;
        chart.legend.itemContainers.template.events.on("out", function(event){
          var segments = event.target.dataItem.dataContext.segments;
          segments.each(function(segment){
            segment.isHover = false;
          })
        })
        chart.exporting.menu = new am4core.ExportMenu();
  }); */
<?php
}
elseif ($page=="Setik")
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
                "url"  : "<?php echo base_url();?>ol_karu/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_etik_pegawai","searchable":false,"visible":false },
                      { "data": "tgl_etik_pegawai","searchable":false },
                      { "data": "jam_etik_pegawai","searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "jumlah_etik","searchable":false },
                      { "data": "total_etik","searchable":false },
                      { "data": "hasil_etik","searchable":false },
                      { "data": "id_penguji","searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                 {
                    text: "<i class='fa fa-plus'></i> Nilai Etik",
                    className: "btnyellow",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('ol_karu/'.$page.'/tambah/'.$id.''); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-search'></i> Hasil Etik",
                    extend: "selected",
                    className: "btnblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_etik_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_karu/'.$page.'/lihat/'); ?>'+data;
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
<?php
}
if ($page=="Setik_tambah" || $page=="Setik_lihat")
{
?>
$(function(){
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
});
var $radios = $(':radio[name^="skor_etik"]').change(function() {

  var totalPrice = $radios.filter(function() {
    return this.checked && this.value === '1'
  }).length;

  $('#sub_total').val(totalPrice);

});

// change first one on page load for demo
$radios.first().change()

function total_GR() {
var atas = parseInt(document.getElementById('sub_total').value);
var bawah = parseInt(document.getElementById('total').value);
var hasile_GR = atas / bawah * 100;

    if (hasile_GR >= 0 && hasile_GR <= 49) {
        document.getElementById("hasilGR").value = "D : Buruk";
    }
    if (hasile_GR >= 50 && hasile_GR <= 69) {
        document.getElementById("hasilGR").value = "C : Cukup";
    }
    if (hasile_GR >= 70 && hasile_GR <= 89) {
        document.getElementById("hasilGR").value = "B : Baik";
    }
    if (hasile_GR >= 90) {
        document.getElementById("hasilGR").value = "A : Prima";
    }

}
<?php
}
?>
</script>
		</div>
	</body>
</html>
