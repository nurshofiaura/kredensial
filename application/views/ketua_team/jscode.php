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
elseif ($page=="surat_ijin")
{
?>
    $(document).ready(function() {
    $('.select2').select2()
    $('#example1').DataTable({
      'paging'        : false,
      'lengthChange'  : false,
      'searching'     : true,
      'ordering'      : false,
      'info'          : true,
      'scrollX'     : true,
      'scrollY'     : '500px',
      'scrollCollapse'  : true
    })
  });
<?php
}
//========================================================= QC
elseif ($page=="report")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
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
                "url"  : "<?php echo base_url();?>ketua_team/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>/<?php echo $id4;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_sort", "visible":false },
                      { "data": "tgl_laporan", "searchable":false, "orderable":false, className : "text-center"},
                      { "data": "tgl_awal", "searchable":false, className : "text-center",  "orderable":false,
                            "render": function ( data, type, row ) {
                                return '(' + row.tgl_awal + ' -' + row.tgl_akhir + ')';
                            }
                      },
                      { "data": "judul_laporan", "orderable":false, className : "text-center"},
                      { "data": "tujuan_laporan", "orderable":false, className : "text-center"},
                      { "data": "nama_unit", "searchable":false, "orderable":false, className : "text-center"},
                      { "data": "nama_pegawai", "searchable":false, "orderable":false, className : "text-center"}
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-area-chart'></i> Lihat Data Tabel / Grafik",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                        location.href = '<?php echo base_url('ketua_team/sheet/view/'); ?>'+data;
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
elseif ($page=="sheet"){
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
            "url"  : "<?php echo base_url();?>ketua_team/<?php echo $page;?>/data/<?php echo $idlap;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "urutan_laporan_detil", "searchable":false, className : "text-center"},
                      { "data": "judul_laporan_detil", "searchable":false },
                      { "data": "periode_laporan_detil", "searchable":false, "orderable":false },
                      { "data": "minimax", "searchable":false },
                      { "data": "nama_tabel", "orderable":false },
                      { "data": "nama_unit", "orderable":false },
                      { "data": "button", 
                        "render": function(data, type, row){
                            if (row.button === '1') {
                               return '<button class="btn btn-xs btn-success"> Sertakan</button>';
                           }  else {
                               return '<button class="btn btn-xs btn-danger"> Tidak disertakan</button>';
                           }
                        }                          
                      }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-send'></i> &nbsp; <i class='fa fa-link'></i>&nbsp; Tampilkan Laporan",
                  extend: "selected",
                  className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                    //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                        laporan = dt.rows( { selected: true } ).data()[0]['id_laporan'];              
                        tabel = dt.rows( { selected: true } ).data()[0]['id_laporan_detil'];              
                          window.open('<?php echo base_url('external/imut/view/'); ?>'+laporan+'/'+tabel);
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
elseif ($page=="demografi")  
{
?>
let mybutton = document.getElementById("myBtn");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
function autoAdjustColumns(table) {
    var container = table.table().container();
    var resizeObserver = new ResizeObserver(function () {
        table.columns.adjust();
    });
    resizeObserver.observe(container);
}


$(document).ready(function() {
  $('.select2').select2()
<?php 
$nourutantablejs=0;
foreach ($loop_unit as $rowloop_unit){
  $nourutantablejs++;
?>
var tablea<?= $nourutantablejs ?> =  $('#examplea<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tablea<?= $nourutantablejs ?>)
var tableb<?= $nourutantablejs ?> =  $('#exampleb<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tableb<?= $nourutantablejs ?>)
var tablec<?= $nourutantablejs ?> =  $('#examplec<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tablec<?= $nourutantablejs ?>)
var tabled<?= $nourutantablejs ?> =  $('#exampled<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tabled<?= $nourutantablejs ?>)
var tablee<?= $nourutantablejs ?> =  $('#examplee<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tablee<?= $nourutantablejs ?>)
var tablef<?= $nourutantablejs ?> =  $('#examplef<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tablef<?= $nourutantablejs ?>)
var tableg<?= $nourutantablejs ?> =  $('#exampleg<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tableg<?= $nourutantablejs ?>)
var tableh<?= $nourutantablejs ?> =  $('#exampleh<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tableh<?= $nourutantablejs ?>)
var tablei<?= $nourutantablejs ?> =  $('#examplei<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tablei<?= $nourutantablejs ?>)
var tablej<?= $nourutantablejs ?> =  $('#examplej<?= $nourutantablejs ?>').DataTable({
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
autoAdjustColumns(tablej<?= $nourutantablejs ?>)
<?php 
}
?>
/*  $('#modal-default').on('shown.bs.modal', function () {
         var table = $('#example1').DataTable();
         table.columns.adjust();
  });*/
});
<?php
}
elseif ($page=="kinerja_klinis_lbulanan")  
{
?>
    $('#bulan').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
    $("#bulan").inputmask("datetime", {
        mask: "1-2-y", 
        placeholder: "dd-mm-yyyy", 
        leapday: "-02-29", 
        separator: "-", 
        alias: "dd/mm/yyyy"
    });
    $('#tahun').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
    $("#tahun").inputmask("datetime", {
        mask: "1-2-y", 
        placeholder: "dd-mm-yyyy", 
        leapday: "-02-29", 
        separator: "-", 
        alias: "dd/mm/yyyy"
    });
    $(document).ready(function() {
        $('.select2').select2()
    $('#example1').DataTable({
      'paging'          : false,
      'lengthChange'    : false,
      'searching'       : false,
      'ordering'        : false,
      'info'            : true,
      'scrollX'         : true,
      'scrollY'         : '500px',
      'scrollCollapse'  : true
    })
    $('#example2').DataTable({
      'paging'          : false,
      'lengthChange'    : false,
      'searching'       : false,
      'ordering'        : false,
      'info'            : true,
      'scrollX'         : true,
      'scrollY'         : '500px',
      'scrollCollapse'  : true
    })
    }); 
<?php
}
elseif ($page=="pengembangan_profesi" || $page=="etik" || $page=="kinerja_unit")  
{
?>
    $('#first_date').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
    $("#first_date").inputmask("datetime", {
        mask: "1-2-y", 
        placeholder: "dd-mm-yyyy", 
        leapday: "-02-29", 
        separator: "-", 
        alias: "dd/mm/yyyy"
    });
    $('#last_date').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
    $("#last_date").inputmask("datetime", {
        mask: "1-2-y", 
        placeholder: "dd-mm-yyyy", 
        leapday: "-02-29", 
        separator: "-", 
        alias: "dd/mm/yyyy"
    });
    $(document).ready(function() {
        $('.select2').select2()
    $('#example1').DataTable({
      'paging'          : false,
      'lengthChange'    : false,
      'searching'       : false,
      'ordering'        : false,
      'info'            : true,
      'scrollX'         : true,
      'scrollY'         : '500px',
      'scrollCollapse'  : true
    })
    }); 
<?php
}
elseif ($page=="oppe")  
{
?>
    $('#first_date').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
    $("#first_date").inputmask("datetime", {
        mask: "1-2-y", 
        placeholder: "dd-mm-yyyy", 
        leapday: "-02-29", 
        separator: "-", 
        alias: "dd/mm/yyyy"
    });
    $('#last_date').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
    $("#last_date").inputmask("datetime", {
        mask: "1-2-y", 
        placeholder: "dd-mm-yyyy", 
        leapday: "-02-29", 
        separator: "-", 
        alias: "dd/mm/yyyy"
    });
    $(document).ready(function() {
        $('.select2').select2()
    $('#example1').DataTable({
      'paging'          : false,
      'lengthChange'    : false,
      'searching'       : false,
      'ordering'        : false,
      'info'            : true,
      'scrollX'         : true,
      'scrollY'         : '500px',
      'scrollCollapse'  : true
    })
    $('#example2').DataTable({
      'paging'          : false,
      'lengthChange'    : false,
      'searching'       : false,
      'ordering'        : false,
      'info'            : true,
      'scrollX'         : true,
      'scrollY'         : '500px',
      'scrollCollapse'  : true
    })
    $('#example3').DataTable({
      'paging'          : false,
      'lengthChange'    : false,
      'searching'       : false,
      'ordering'        : false,
      'info'            : true,
      'scrollX'         : true,
      'scrollY'         : '500px',
      'scrollCollapse'  : true
    })
    }); 
<?php
}
elseif ($page=="lihat")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
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
"url"  : "<?php echo base_url();?>admin_user/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_laporan", "searchable":false , "visible":false },
                      { "data": "nama_standar_mutu" },
                      { "data": "tgl_laporan" },
                      { "data": "judul_laporan" }
/*                      { "data": "cp_lhu",
            "render": function ( data, type, row ) {
                return row.cp_lhu + ' (' + row.no_cp_lhu + ')';
            }
                      },*/
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-file-text'></i> Profile",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('admin_user/'.$page.'/profil/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-image'></i> Galeri",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('admin_user/'.$page.'/galeri/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-file-text'></i> Laporan",
                    extend: "selected",
                    className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('admin_user/'.$page.'/laporan/'); ?>'+data;
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
elseif ($page=="lihat_tabel")
{
    if($grafik == 2){
    ?>
        am4core.ready(function() {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
            ?>
            {
              "year": new Date(<?php echo $rowgrafik_garis_opsi['thn']; ?>, <?php echo $rowgrafik_garis_opsi['bln']-1; ?>, <?php echo $rowgrafik_garis_opsi['hr']; ?>),
              <?php
              $no = 0;
              $jsonx = $this->m_admin_user->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
              foreach($jsonx as $row2){
                  $no++;
              ?>
              <?php echo '"'.$row2['id_limbah'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>
              <?php
              }
              ?>
            },
            <?php
            }
            ?>
            ];
            chart.responsive.enabled = true;
            chart.maskBullets = false;
            chart.dateFormatter.dateFormat = "dd-MM-yyyy";

            var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.minGridDistance = 30;

            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.minGridDistance = 30;
            dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");

            function createSeriesAndAxis(field, name, topMargin, bottomMargin, mutu, renge) {
              var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

              var series = chart.series.push(new am4charts.LineSeries());
              series.dataFields.valueY = field;
              series.dataFields.dateX = "year";
              series.name = name;
              series.strokeWidth = 2;
              series.yAxis = valueAxis;

              let hs = series.segments.template.states.create("hover")
              hs.properties.strokeWidth = 5;
              series.segments.template.strokeWidth = 1;

              // Add simple bullet
              var circleBullet = series.bullets.push(new am4charts.CircleBullet());
              circleBullet.circle.stroke = am4core.color("#fff");
              circleBullet.circle.strokeWidth = 2;

              var labelBullet = series.bullets.push(new am4charts.LabelBullet());
              labelBullet.label.text = "{name} : {valueY}";
              labelBullet.label.dy = -20;
              
              valueAxis.renderer.line.strokeOpacity = 1;
              valueAxis.renderer.line.stroke = series.stroke;
              valueAxis.renderer.grid.template.stroke = series.stroke;
              valueAxis.renderer.grid.template.strokeOpacity = 0.1;
              valueAxis.renderer.labels.template.fill = series.stroke;
              valueAxis.renderer.minGridDistance = 25;
              valueAxis.align = "right";
              
                if (topMargin && bottomMargin) {
                    valueAxis.marginTop = 10;
                    valueAxis.marginBottom = 10;
                }
                else {
                    if (topMargin) {
                      valueAxis.marginTop = 20;
                    }
                    if (bottomMargin) {
                      valueAxis.marginBottom = 20;
                    }
                }
              
                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.stroke = am4core.color("#fff");
                bullet.circle.strokeWidth = 2;
                bullet.adapter.add("dy", function(dy, target) {
                  hideBullet(target);
                  return dy;
                })

                function hideBullet(bullet) {
                  if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
                    bullet.visible = false;
                  }
                  else {
                    bullet.visible = true;
                  }
                }
            }

            <?php
            foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_limbah'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_limbah'].'"'; ?>, true, true, <?php echo round($rowambil_limbah_grafik['standar_mutu'],2); ?>, <?php echo round($rowambil_limbah_grafik['range_mutu'],2); ?>);
            <?php
            }
            ?>

            chart.cursor = new am4charts.XYCursor();
            chart.cursor.lineX.strokeOpacity = 0;
            chart.cursor.lineY.strokeOpacity = 0;

            chart.zoomOutButton.align = "left";
            chart.zoomOutButton.valign = "bottom";
            chart.zoomOutButton.marginLeft = 10;
            chart.zoomOutButton.marginBottom = 10;

            var scrollbar = new am4charts.XYChartScrollbar();

            chart.scrollbarX = scrollbar;
            chart.legend = new am4charts.Legend();
            chart.legend.labels.template.text = "[bold {color}]{name}[/]";

            chart.legend.scrollable = true
            chart.rightAxesContainer.layout = "vertical";


            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

            var watermark = chart.createChild(am4core.Label);
            watermark.text = "Source: [bold] kredensial.com [/]";
            watermark.align = "left";
            watermark.fillOpacity = 0.5;
            watermark.disabled = true;

            chart.exporting.events.on("exportstarted", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.events.on("exportfinished", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.validateSprites.push(watermark);

            var title = chart.titles.create();
            title.text = "<?php echo $judul_laporan_tabel; ?>";
            title.fontSize = 18;
            title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

        });
    <?php 
    }
    if($grafik == 4){
    ?>
        am4core.ready(function() {
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        chart.data = [
        <?php
        foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
        ?>
        {
          "year": new Date(<?php echo $rowgrafik_garis_opsi['thn']; ?>, <?php echo $rowgrafik_garis_opsi['bln']-1; ?>, <?php echo $rowgrafik_garis_opsi['hr']; ?>),
          <?php
          $no = 0;
          $jsonx = $this->m_admin_user->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
          foreach($jsonx as $row2){
              $no++;
          ?>
          <?php echo '"'.$row2['id_limbah'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>
          <?php
          }
          ?>
        },
        <?php
        }
        ?>
        ];
        chart.responsive.enabled = true;
        chart.maskBullets = false;
        chart.dateFormatter.dateFormat = "dd-MM-yyyy";

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
        //var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.minGridDistance = 30;

        // Set date label formatting
        dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
        //dateAxis.periodChangeDateFormats.setKey("month", "MMM");

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.min = <?php echo $min_standar; ?>;
        valueAxis.max = <?php echo $max_standar; ?>;
        valueAxis.strictMinMax = true; 
        valueAxis.title.text = "Hasil";
        valueAxis.renderer.minLabelPosition = 0.01;
        valueAxis.logarithmic = true;

        function createSeriesAndAxis(field, name, topMargin, bottomMargin, mutu, renge) {
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = field;
            series.dataFields.dateX = "year";
            series.name = name;
            series.strokeWidth = 2;
            series.yAxis = valueAxis;

            let hs = series.segments.template.states.create("hover")
            hs.properties.strokeWidth = 5;
            series.segments.template.strokeWidth = 1;

            var circleBullet = series.bullets.push(new am4charts.CircleBullet());
            circleBullet.circle.stroke = am4core.color("#fff");
            circleBullet.circle.strokeWidth = 2;

            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.text = "{name} : {valueY}";
            labelBullet.label.dy = -20;

            valueAxis.renderer.line.strokeOpacity = 1;
            valueAxis.renderer.line.stroke = series.stroke;
            valueAxis.renderer.grid.template.stroke = series.stroke;
            valueAxis.renderer.grid.template.strokeOpacity = 0.1;
            valueAxis.renderer.labels.template.fill = series.stroke;
            valueAxis.renderer.minGridDistance = 25;
            valueAxis.align = "right";

            if (topMargin && bottomMargin) {
                valueAxis.marginTop = 10;
                valueAxis.marginBottom = 10;
            }
            else {
                if (topMargin) {
                  valueAxis.marginTop = 20;
                }
                if (bottomMargin) {
                  valueAxis.marginBottom = 20;
                }
            }
          
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.stroke = am4core.color("#fff");
            bullet.circle.strokeWidth = 2;
            bullet.adapter.add("dy", function(dy, target) {
              hideBullet(target);
              return dy;
            })

            function hideBullet(bullet) {
              if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
                bullet.visible = false;
              }
              else {
                bullet.visible = true;
              }
            }

            var rangest = valueAxis.axisRanges.create();
            rangest.value = mutu;
            rangest.label.text = "Batas Min {name}";
            rangest.grid.stroke = am4core.color("#ff0000");
            rangest.grid.strokeWidth = 2;
            rangest.grid.strokeOpacity = 1;
        //    rangest.label.location = 0.4;
            rangest.label.inside = true;
            rangest.label.fill = rangest.grid.stroke;
            //rangest.label.align = "right";
            rangest.label.verticalCenter = "bottom";
            //rangest.label.dy = -20;

            var rangerg = valueAxis.axisRanges.create();
            rangerg.value = renge;
            rangerg.label.text = "Batas Max {name}"; 
            rangerg.grid.stroke = am4core.color("#ff0000");
            rangerg.grid.strokeWidth = 2;
            rangerg.grid.strokeOpacity = 1;
        //    rangerg.label.location = 0.4;
            rangerg.label.inside = true;
            rangerg.label.fill = rangerg.grid.stroke;
            //rangerg.label.align = "right";
            rangerg.label.verticalCenter = "bottom";
            //rangerg.label.dy = -20;
        }

        <?php
        foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
        ?>
        createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_limbah'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_limbah'].'"'; ?>, true, true, <?php echo round($rowambil_limbah_grafik['standar_mutu'],2); ?>, <?php echo round($rowambil_limbah_grafik['range_mutu'],2); ?>);
        <?php
        }
        ?>

        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineX.strokeOpacity = 0;
        chart.cursor.lineY.strokeOpacity = 0;

        chart.zoomOutButton.align = "left";
        chart.zoomOutButton.valign = "bottom";
        chart.zoomOutButton.marginLeft = 10;
        chart.zoomOutButton.marginBottom = 10;

        var scrollbar = new am4charts.XYChartScrollbar();

        chart.scrollbarX = scrollbar;
        chart.legend = new am4charts.Legend();
        chart.legend.labels.template.text = "[bold {color}]{name}[/]";

        chart.legend.scrollable = true
        chart.rightAxesContainer.layout = "vertical";

        chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.menu.align = "left";
        chart.exporting.menu.verticalAlign = "top";

        var watermark = chart.createChild(am4core.Label);
        watermark.text = "Source: [bold] kredensial.com [/]";
        watermark.align = "left";
        watermark.fillOpacity = 0.5;
        watermark.disabled = true;

        chart.exporting.events.on("exportstarted", function(ev) {
          watermark.disabled = true;
        });

        chart.exporting.events.on("exportfinished", function(ev) {
          watermark.disabled = true;
        });

        chart.exporting.validateSprites.push(watermark);

        var title = chart.titles.create();
        title.text = "<?php echo $judul_laporan_tabel; ?>";
        title.fontSize = 18;
        title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

    });
    <?php 
    }
    if($grafik == 5){
    ?>
        am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

        chart.data = [
        <?php
        foreach($ambil_dt_limbah_grafik as $rowambil_dt_limbah_grafik){
        ?>
        {
          category: <?php echo '"'.$rowambil_dt_limbah_grafik['nama_limbah'].'"'; ?>,
          <?php
          $ambil_all_limbah_grafik = $this->m_admin_user->ambil_all_limbah_grafik($id2,$rowambil_dt_limbah_grafik['id_limbah']);
          foreach($ambil_all_limbah_grafik as $rowambil_all_limbah_grafik){
          ?>
          value1:<?php echo $rowambil_all_limbah_grafik['cemua']; ?>,
          <?php
          }
          $ambil_sesuai_limbah_grafik = $this->m_admin_user->ambil_sesuai_limbah_grafik($id2,$rowambil_dt_limbah_grafik['id_limbah']);
          foreach($ambil_sesuai_limbah_grafik as $rowambil_sesuai_limbah_grafik){
          ?>
          value2:<?php echo $rowambil_sesuai_limbah_grafik['cesuai']; ?>,
          <?php
            }
            $tdkcesuai = $rowambil_all_limbah_grafik['cemua'] - $rowambil_sesuai_limbah_grafik['cesuai'];
          ?>
          value3:<?php echo $tdkcesuai; ?>,
        },
        <?php
        }
        ?>
        ];
        chart.responsive.enabled = true;
        chart.colors.step = 2;
        chart.padding(30, 30, 10, 30);

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "category";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.labels.template.rotation = -45;
        categoryAxis.renderer.minGridDistance = 20;
        categoryAxis.renderer.labels.template.fontSize = 11;

        var label = categoryAxis.renderer.labels.template;
        label.truncate = false;
        label.wrap = true;
        label.maxWidth = 120;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.min = 0;
        valueAxis.max = 100;
        valueAxis.strictMinMax = true;
        valueAxis.calculateTotals = true;
        valueAxis.renderer.minWidth = 50;

        var series2 = chart.series.push(new am4charts.ColumnSeries());
        series2.columns.template.width = am4core.percent(80);
        series2.columns.template.tooltipText =
          "{category}: {valueY.totalPercent.formatNumber('#.0')}% - {name} = {valueY}";
        series2.name = "Sesuai";
        series2.fill = am4core.color("#32A431");
        series2.dataFields.categoryX = "category";
        series2.dataFields.valueY = "value2";
        series2.dataFields.valueYShow = "totalPercent";
        series2.dataItems.template.locations.categoryX = 0.5;
        series2.stacked = true;
        series2.tooltip.pointerOrientation = "vertical";

        var bullet2 = series2.bullets.push(new am4charts.LabelBullet());
        bullet2.interactionsEnabled = false;
        bullet2.label.text = "{category}: {valueY.totalPercent.formatNumber('#.0')}% - {name} = {valueY}";
            bullet2.label.truncate = false;
            bullet2.label.wrap  = true;
        bullet2.locationY = 0.5;
        bullet2.label.fill = am4core.color("#ffffff");

        bullet2.label.adapter.add("text", function(text, target) {
            if (target.dataItem && target.dataItem.valueY == 0) {
                 return "";
            }
                return text;
        })

        var series3 = chart.series.push(new am4charts.ColumnSeries());
        series3.columns.template.width = am4core.percent(80);
        series3.columns.template.tooltipText = "{category}: {valueY.totalPercent.formatNumber('#.0')}% - {name} = {valueY}";
        series3.name = "Tidak Sesuai";
        series3.fill = am4core.color("#DC3545");
        series3.dataFields.categoryX = "category";
        series3.dataFields.valueY = "value3";
        series3.dataFields.valueYShow = "totalPercent";
        series3.dataItems.template.locations.categoryX = 0.5;
        series3.stacked = true;
        series3.tooltip.pointerOrientation = "vertical";

        var bullet3 = series3.bullets.push(new am4charts.LabelBullet());
        bullet3.interactionsEnabled = false;
        bullet3.label.text = "{category}: {valueY.totalPercent.formatNumber('#.0')}% - {name} = {valueY}";
            bullet3.label.truncate = false;
            bullet3.label.wrap  = true;
        bullet3.locationY = 0.5;
        bullet3.label.fill = am4core.color("#ffffff");

        bullet3.label.adapter.add("text", function(text, target) {
            if (target.dataItem && target.dataItem.valueY == 0) {
                 return "";
            }
                return text;
        })

        chart.scrollbarX = new am4core.Scrollbar();

        chart.legend = new am4charts.Legend();
        chart.legend.labels.template.text = "[bold {color}]{name}  {categoryX} : {valueY}[/]";
        chart.legend.scrollable = true

        var legendContainer = am4core.create("legenddiv", am4core.Container);
        legendContainer.width = am4core.percent(100);
        legendContainer.height = am4core.percent(100);
        chart.legend.parent = legendContainer;
        chart.responsive.enabled = true;

        chart.legend.itemContainers.template.events.on("out", function(event){
          var segments = event.target.dataItem.dataContext.segments;
          segments.each(function(segment){
            segment.isHover = false;
          })
        })

        chart.exporting.menu = new am4core.ExportMenu();
        chart.exporting.menu.align = "left";
        chart.exporting.menu.verticalAlign = "top";

        var watermark = chart.createChild(am4core.Label);
        watermark.text = "Source: [bold] kredensial.com [/]";
        watermark.align = "left";
        watermark.fillOpacity = 0.5;
        watermark.disabled = true;

        chart.exporting.events.on("exportstarted", function(ev) {
          watermark.disabled = true;
        });

        chart.exporting.events.on("exportfinished", function(ev) {
          watermark.disabled = true;
        });

        // Add watermark to validated sprites
        chart.exporting.validateSprites.push(watermark);

        var title = chart.titles.create();
        title.text = "<?php echo $judul_laporan_tabel; ?>";
        title.fontSize = 18;
        title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

        });
    <?php
    }
    if($grafik == 6){
    ?>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);

// some extra padding for range labels
chart.paddingBottom = 50;

chart.cursor = new am4charts.XYCursor();
chart.scrollbarX = new am4core.Scrollbar();


// will use this to store colors of the same items
var colors = {};

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
//categoryAxis.renderer.minGridDistance = 80;
categoryAxis.renderer.minGridDistance = 10;
categoryAxis.renderer.grid.template.location = 0;

//categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.labels.template.fontSize = 10;

var label = categoryAxis.renderer.labels.template;
label.truncate = false;
label.wrap = true;
label.maxWidth = 100;

  categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
    if (target.dataItem && target.dataItem.index & 2 == 2) {
      return dy + 25;
    }
    return dy;
  });

categoryAxis.dataItems.template.text = "{realName}";
categoryAxis.adapter.add("tooltipText", function(tooltipText, target){
  return categoryAxis.tooltipDataItem.dataContext.realName;
})

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.tooltip.disabled = true;
valueAxis.min = 0;

// single column series for all data
var columnSeries = chart.series.push(new am4charts.ColumnSeries());
columnSeries.columns.template.width = am4core.percent(90);
columnSeries.tooltipText = "{provider}: {realName}, {valueY}";
columnSeries.dataFields.categoryX = "category";
columnSeries.dataFields.valueY = "value";

// second value axis for quantity
var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis2.renderer.opposite = true;
valueAxis2.syncWithAxis = valueAxis;
valueAxis2.tooltip.disabled = true;

// quantity line series
var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.tooltipText = "{valueY}";
lineSeries.dataFields.categoryX = "category";
lineSeries.dataFields.valueY = "quantity";
lineSeries.yAxis = valueAxis2;
lineSeries.bullets.push(new am4charts.CircleBullet());
lineSeries.stroke = chart.colors.getIndex(13);
lineSeries.fill = lineSeries.stroke;
lineSeries.strokeWidth = 2;
lineSeries.snapTooltip = true;

var labelBullet = lineSeries.bullets.push(new am4charts.LabelBullet());
labelBullet.label.text = "{valueY}";
labelBullet.label.dy = -20;

// when data validated, adjust location of data item based on count
lineSeries.events.on("datavalidated", function(){
 lineSeries.dataItems.each(function(dataItem){
   // if count divides by two, location is 0 (on the grid)
   if(dataItem.dataContext.count / 2 == Math.round(dataItem.dataContext.count / 2)){
   dataItem.setLocation("categoryX", 0);
   }
   // otherwise location is 0.5 (middle)
   else{
    dataItem.setLocation("categoryX", 0.5);
   }
 })
})

// fill adapter, here we save color value to colors object so that each time the item has the same name, the same color is used
columnSeries.columns.template.adapter.add("fill", function(fill, target) {
 var name = target.dataItem.dataContext.realName;
 if (!colors[name]) {
   colors[name] = chart.colors.next();
 }
 target.stroke = colors[name];
 return colors[name];
})


var rangeTemplate = categoryAxis.axisRanges.template;
rangeTemplate.tick.disabled = false;
rangeTemplate.tick.location = 0;
rangeTemplate.tick.strokeOpacity = 0.6;
rangeTemplate.tick.length = 60;
rangeTemplate.grid.strokeOpacity = 0.5;
rangeTemplate.label.tooltip = new am4core.Tooltip();
rangeTemplate.label.tooltip.dy = -10;
rangeTemplate.label.cloneTooltip = false;

///// DATA
var chartData = [];
var lineSeriesData = [];

    var data = {
    <?php
    $tothasil = 0;
    $totoutput = 0;
    $totall = 0;
    foreach($grafik_batang_range_jejer as $rowgrafik_batang_range_jejer){
        $totall = $totall + $rowgrafik_batang_range_jejer['hasil_lhu_detil'];
        $limbah = $this->m_rancak->getsemiBulan(date('m',strtotime($rowgrafik_batang_range_jejer['tgl_lhu'])));
    ?>
         <?php echo '"'.$rowgrafik_batang_range_jejer['nama_limbah'].' : '.round($rowgrafik_batang_range_jejer['hasil_lhu_detil'],0).', Bln : '.$limbah.'"'; ?>: {
           "Min": <?php echo round($rowgrafik_batang_range_jejer['standar_mutu'],2); ?>,            
           "Hasil": <?php echo round($rowgrafik_batang_range_jejer['hasil_lhu_detil'],2); ?>,
           "Max": <?php echo round($rowgrafik_batang_range_jejer['range_mutu'],2); ?>,
           "quantity":<?php echo round($totall,0); ?>
         },
    <?php
    }
    ?>
    };

// process data ant prepare it for the chart
for (var providerName in data) {
 var providerData = data[providerName];

 // add data of one provider to temp array
 var tempArray = [];
 var count = 0;
 // add items
 for (var itemName in providerData) {
   if(itemName != "quantity"){
   count++;
   // we generate unique category for each column (providerName + "_" + itemName) and store realName
   tempArray.push({ category: providerName + "_" + itemName, realName: itemName, value: providerData[itemName], provider: providerName})
   }
 }
 // sort temp array
 tempArray.sort(function(a, b) {
   if (a.value > b.value) {
   return 1;
   }
   else if (a.value < b.value) {
   return -1
   }
   else {
   return 0;
   }
 })

 // add quantity and count to middle data item (line series uses it)
 var lineSeriesDataIndex = Math.floor(count / 2);
 tempArray[lineSeriesDataIndex].quantity = providerData.quantity;
 tempArray[lineSeriesDataIndex].count = count;
 // push to the final data
 am4core.array.each(tempArray, function(item) {
   chartData.push(item);
 })

 // create range (the additional label at the bottom)
 var range = categoryAxis.axisRanges.create();
 range.category = tempArray[0].category;
 range.endCategory = tempArray[tempArray.length - 1].category;
 range.label.text = tempArray[0].provider;
 range.label.dy = 30;
 range.label.truncate = false;
 range.label.wrap = true;
 range.label.fontWeight = "bold";
 range.label.tooltipText = tempArray[0].provider;

 range.label.adapter.add("maxWidth", function(maxWidth, target){
   var range = target.dataItem;
   var startPosition = categoryAxis.categoryToPosition(range.category, 0);
   var endPosition = categoryAxis.categoryToPosition(range.endCategory, 1);
   var startX = categoryAxis.positionToCoordinate(startPosition);
   var endX = categoryAxis.positionToCoordinate(endPosition);
   return endX - startX;
 })
}

chart.data = chartData;


// last tick
var range = categoryAxis.axisRanges.create();
range.category = chart.data[chart.data.length - 1].category;
range.label.disabled = true;
range.tick.location = 1;
range.grid.location = 1;

    // Add legend
    chart.legend = new am4charts.Legend();
    //chart.legend.markers.template.disabled = true;
    chart.legend.labels.template.text = "{provider}: {realName}, {valueY}";

    /*chart.legend.position = "right";
    chart.legend.valign = "bottom";
    chart.legend.margin(5,5,5,5);
    chart.legend.valign = "top";*/

    chart.legend.scrollable = true

    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.responsive.enabled = true;

    chart.legend.itemContainers.template.events.on("out", function(event){
      var segments = event.target.dataItem.dataContext.segments;
      segments.each(function(segment){
        segment.isHover = false;
      })
    })

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

});
    <?php  
    }
    if($grafik == 7){
    ?>
        am4core.useTheme(am4themes_animated);
        am4core.useTheme(am4themes_dataviz);

        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.numberFormatter.numberFormat = "#.0";

        chart.data = [
        <?php
        foreach($grafik_batang_range as $rowgrafik_batang_range){
        ?>
        {
          "year": <?php echo '"'.$rowgrafik_batang_range['nama_sumber_emisi'].'"'; ?>,
          <?php echo '"'.$rowgrafik_batang_range['nama_limbah'].'"'; ?>: <?php echo '"'.$rowgrafik_batang_range['hasil_lhu_detil'].'"'; ?>,

        },
        <?php
        }
        ?>
        ];
        chart.responsive.enabled = true;
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "year";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 20;
        categoryAxis.renderer.inside = true;
        categoryAxis.renderer.labels.template.valign = "top";
        categoryAxis.renderer.labels.template.fontSize = 20;
        categoryAxis.renderer.cellStartLocation = 0.1;
        categoryAxis.renderer.cellEndLocation = 0.9;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.min = 0;
        valueAxis.title.text = "Hasil Uji Sampel";

        function createSeries(field, name) {
          var series = chart.series.push(new am4charts.ColumnSeries());
          series.dataFields.valueY = field;
          series.dataFields.categoryX = "year";
          series.name = name;
          series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
          series.columns.template.width = am4core.percent(95);
          
          var bullet = series.bullets.push(new am4charts.LabelBullet);
          bullet.label.text = "{name}: [bold]{valueY}[/]";
          bullet.label.rotation = 45;
          bullet.label.truncate = false;
          bullet.label.hideOversized = false;
          bullet.label.horizontalCenter = "left";
          bullet.locationY = 1;
          bullet.dy = 10;
        }

        chart.paddingBottom = 150;
        chart.maskBullets = false;

            <?php
            foreach($grafik_batang_range2 as $rowgrafik_garis_opsi){
            ?>
                createSeries(<?php echo '"'.$rowgrafik_garis_opsi['nama_limbah'].'"'; ?>, <?php echo '"'.$rowgrafik_garis_opsi['nama_limbah'].'"'; ?>, true);
            <?php  
            }
            ?>

            chart.scrollbarX = new am4core.Scrollbar();

            chart.legend = new am4charts.Legend();
            chart.legend.labels.template.text = "[bold {color}]{name}  {categoryX} : {valueY}[/]";
            chart.legend.scrollable = true
            var legendContainer = am4core.create("legenddiv", am4core.Container);
            legendContainer.width = am4core.percent(100);
            legendContainer.height = am4core.percent(100);
            chart.legend.parent = legendContainer;
            chart.responsive.enabled = true;
            chart.legend.itemContainers.template.events.on("out", function(event){
              var segments = event.target.dataItem.dataContext.segments;
              segments.each(function(segment){
                segment.isHover = false;
              })
            })

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

            var watermark = chart.createChild(am4core.Label);
            watermark.text = "Source: [bold] kredensial.com [/]";
            watermark.align = "left";
            watermark.fillOpacity = 0.5;
            watermark.disabled = true;

            chart.exporting.events.on("exportstarted", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.events.on("exportfinished", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.validateSprites.push(watermark);

            var title = chart.titles.create();
            title.text = "<?php echo $judul_laporan_tabel; ?>";
            title.fontSize = 18;
            title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";
    <?php
    }
    if($grafik == 8){
    ?>
            am4core.ready(function() {
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);
            chart.paddingBottom = 50;

            chart.cursor = new am4charts.XYCursor();
            chart.scrollbarX = new am4core.Scrollbar();

            chart.legend = new am4charts.Legend();
            chart.legend.labels.template.text = "[bold {color}]{name}  {categoryX} : {valueY}[/]";

            chart.legend.scrollable = true

            var legendContainer = am4core.create("legenddiv", am4core.Container);
            legendContainer.width = am4core.percent(100);
            legendContainer.height = am4core.percent(100);
            chart.legend.parent = legendContainer;
            chart.responsive.enabled = true;

            chart.legend.itemContainers.template.events.on("out", function(event){
              var segments = event.target.dataItem.dataContext.segments;
              segments.each(function(segment){
                segment.isHover = false;
              })
            })

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

            var watermark = chart.createChild(am4core.Label);
            watermark.text = "Source: [bold] kredensial.com [/]";
            watermark.align = "left";
            watermark.fillOpacity = 0.5;
            watermark.disabled = true;

            chart.exporting.events.on("exportstarted", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.events.on("exportfinished", function(ev) {
              watermark.disabled = true;
            });

            // Add watermark to validated sprites
            chart.exporting.validateSprites.push(watermark);

            var title = chart.titles.create();
            title.text = "<?php echo $judul_laporan_tabel; ?>";
            title.fontSize = 18;
            title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

            var colors = {};

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "category";
            categoryAxis.renderer.minGridDistance = 10;
            categoryAxis.renderer.grid.template.location = 0;
            categoryAxis.renderer.labels.template.fontSize = 10;

            var label = categoryAxis.renderer.labels.template;
            label.truncate = false;
            label.wrap = true;
            label.maxWidth = 100;

              categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
                if (target.dataItem && target.dataItem.index & 2 == 2) {
                  return dy + 25;
                }
                return dy;
              });

            categoryAxis.dataItems.template.text = "{realName}";
            categoryAxis.adapter.add("tooltipText", function(tooltipText, target){
              return categoryAxis.tooltipDataItem.dataContext.realName;
            })

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.tooltip.disabled = true;
            valueAxis.min = 0;

            var columnSeries = chart.series.push(new am4charts.ColumnSeries());
            columnSeries.columns.template.width = am4core.percent(90);
            columnSeries.tooltipText = "{provider}: {realName}, {valueY}";
            columnSeries.dataFields.categoryX = "category";
            columnSeries.dataFields.valueY = "value";

            var valueAxis2 = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis2.renderer.opposite = true;
            valueAxis2.syncWithAxis = valueAxis;
            valueAxis2.tooltip.disabled = true;

            var lineSeries = chart.series.push(new am4charts.LineSeries());
            lineSeries.tooltipText = "{valueY}";
            lineSeries.dataFields.categoryX = "category";
            lineSeries.dataFields.valueY = "quantity";
            lineSeries.yAxis = valueAxis2;
            lineSeries.bullets.push(new am4charts.CircleBullet());
            lineSeries.stroke = chart.colors.getIndex(13);
            lineSeries.fill = lineSeries.stroke;
            lineSeries.strokeWidth = 2;
            lineSeries.snapTooltip = true;

            var labelBullet = lineSeries.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.text = "{valueY}";
            labelBullet.label.dy = -20;

            lineSeries.events.on("datavalidated", function(){
             lineSeries.dataItems.each(function(dataItem){
               if(dataItem.dataContext.count / 2 == Math.round(dataItem.dataContext.count / 2)){
               dataItem.setLocation("categoryX", 0);
               }
               else{
                dataItem.setLocation("categoryX", 0.5);
               }
             })
            })

            columnSeries.columns.template.adapter.add("fill", function(fill, target) {
             var name = target.dataItem.dataContext.realName;
             if (!colors[name]) {
               colors[name] = chart.colors.next();
             }
             target.stroke = colors[name];
             return colors[name];
            })


            var rangeTemplate = categoryAxis.axisRanges.template;
            rangeTemplate.tick.disabled = false;
            rangeTemplate.tick.location = 0;
            rangeTemplate.tick.strokeOpacity = 0.6;
            rangeTemplate.tick.length = 60;
            rangeTemplate.grid.strokeOpacity = 0.5;
            rangeTemplate.label.tooltip = new am4core.Tooltip();
            rangeTemplate.label.tooltip.dy = -10;
            rangeTemplate.label.cloneTooltip = false;

            var chartData = [];
            var lineSeriesData = [];
            var data = {
            <?php
            $tothasil = 0;
            $totoutput = 0;
            $totall = 0;
            foreach($grafik_batang_kelola as $rowgrafik_batang_kelola){
                $tothasil = $tothasil + $rowgrafik_batang_kelola['hasil_lhu_detil'];
                $totoutput = $totoutput + $rowgrafik_batang_kelola['output_lhu_detil'];
                $totall = $totall + $totoutput;
                $limbah = $this->m_rancak->getsemiBulan(date('m',strtotime($rowgrafik_batang_kelola['tgl_lhu'])));
            ?>
                 <?php echo '"'.$rowgrafik_batang_kelola['nama_limbah'].', Bln : '.$limbah.'"'; ?>: {
                   "Hasil": <?php echo round($rowgrafik_batang_kelola['hasil_lhu_detil'],0); ?>,
                   "Kelola": <?php echo round($rowgrafik_batang_kelola['output_lhu_detil'],0); ?>,
                   "Tot Hasil": <?php echo round($tothasil,0); ?>,
                   "Tot Kelola": <?php echo round($totoutput,0); ?>,
                   "quantity":<?php echo round($totall,0); ?>
                 },
            <?php
            }
            ?>
            };

            for (var providerName in data) {
             var providerData = data[providerName];

             var tempArray = [];
             var count = 0;
             // add items
             for (var itemName in providerData) {
               if(itemName != "quantity"){
               count++;
               tempArray.push({ category: providerName + "_" + itemName, realName: itemName, value: providerData[itemName], provider: providerName})
               }
             }
             // sort temp array
             tempArray.sort(function(a, b) {
               if (a.value > b.value) {
               return 1;
               }
               else if (a.value < b.value) {
               return -1
               }
               else {
               return 0;
               }
             })

             var lineSeriesDataIndex = Math.floor(count / 2);
             tempArray[lineSeriesDataIndex].quantity = providerData.quantity;
             tempArray[lineSeriesDataIndex].count = count;
             am4core.array.each(tempArray, function(item) {
               chartData.push(item);
             })

             var range = categoryAxis.axisRanges.create();
             range.category = tempArray[0].category;
             range.endCategory = tempArray[tempArray.length - 1].category;
             range.label.text = tempArray[0].provider;
             range.label.dy = 30;
             range.label.truncate = false;
             range.label.wrap = true;
             range.label.fontWeight = "bold";
             range.label.tooltipText = tempArray[0].provider;

             range.label.adapter.add("maxWidth", function(maxWidth, target){
               var range = target.dataItem;
               var startPosition = categoryAxis.categoryToPosition(range.category, 0);
               var endPosition = categoryAxis.categoryToPosition(range.endCategory, 1);
               var startX = categoryAxis.positionToCoordinate(startPosition);
               var endX = categoryAxis.positionToCoordinate(endPosition);
               return endX - startX;
             })
            }

            chart.data = chartData;
            var range = categoryAxis.axisRanges.create();
            range.category = chart.data[chart.data.length - 1].category;
            range.label.disabled = true;
            range.tick.location = 1;
            range.grid.location = 1;

            });
<?php
    }
    if($grafik == 3){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>admin_user/lihat/pie/<?php echo $id;?>/<?php echo $id2;?>";
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "total";
    pieSeries.dataFields.category = "nama_limbah";
    pieSeries.innerRadius = am4core.percent(0);

//  pieSeries.ticks.template.disabled = true;
//  pieSeries.alignLabels = false;
//  pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
    pieSeries.labels.template.text = "[bold {color}]{category} :  {value} ({value.percent.formatNumber('#.0')}%) [/]";
//  pieSeries.labels.template.radius = am4core.percent(-80);
//  pieSeries.labels.template.fill = am4core.color("white");
//  pieSeries.labels.template.maxWidth = 130;
    pieSeries.labels.template.paddingTop = 0;
    pieSeries.labels.template.paddingBottom = 0;
    pieSeries.labels.template.fontSize = 10;
    pieSeries.labels.template.wrap = true;
    pieSeries.labels.template.relativeRotation = 90;

    var rgm = new am4core.RadialGradientModifier();
    rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
    pieSeries.slices.template.fillModifier = rgm;
    pieSeries.slices.template.strokeModifier = rgm;
    pieSeries.slices.template.strokeOpacity = 0.4;
    pieSeries.slices.template.strokeWidth = 0;

    chart.legend = new am4charts.Legend();
    //chart.legend.labels.template.text = "[bold {color}]{category} : {value.percent.formatNumber('#.0')}% [/]";
    chart.legend.paddingTop = 0;
    chart.legend.paddingBottom = 0;
    chart.legend.fontSize = 11;
    chart.legend.wrap = true;
    chart.legend.labels.template.maxWidth = 150;
    chart.legend.labels.template.truncate = true;   
    //  chart.legend.position = "right";
        chart.legend.scrollable = true;


    /* Create a separate container to put legend in */
/*    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.responsive.enabled = true;*/

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";
/*    chart.exporting.menu.items[0].menu.push({
      label: "Zip",
      type: "custom",
      options: {
        callback: function() {
          Promise.all([
            chart.exporting.getExcel(),
            chart.exporting.getImage('png')
          ]).then(function(exportedItems) {
            var zip = new JSZip();
            zip.file("data.xlsx", exportedItems[0].split("base64,")[1], {base64: true});
            zip.file("chart.png", exportedItems[1].split("base64,")[1], {base64: true});
            zip.generateAsync({type: "blob"}).then(function(content) {
              saveAs(content, "chartpie.zip");
            });
          });
        }
      }
    })*/
    // Add watermark
    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = false;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";
    });
<?php  
    }
if($grafik == 9){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.data = [
    <?php
    foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
    ?>
    {
      "year": new Date(<?php echo $rowgrafik_garis_opsi['thn']; ?>, <?php echo $rowgrafik_garis_opsi['bln']-1; ?>, <?php echo $rowgrafik_garis_opsi['hr']; ?>),
      <?php
      $no = 0;
      $jsonx = $this->m_admin_user->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
      foreach($jsonx as $row2){
          $no++;
      ?>
      <?php echo '"'.$row2['id_limbah'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>
      <?php
      }
      ?>
    },
    <?php
    }
    ?>
    ];

    chart.maskBullets = false;
    chart.dateFormatter.dateFormat = "dd-MM-yyyy";

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;

// Set date label formatting
dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");

function createSeriesAndAxis(field, name, topMargin, bottomMargin, mutu, renge) {
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minLabelPosition = 0.01;
  
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "year";
  series.name = name;
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
//  series.legendSettings.valueText = "{valueY}";

  let hs = series.segments.template.states.create("hover")
  hs.properties.strokeWidth = 5;
  series.segments.template.strokeWidth = 1;

  var circleBullet = series.bullets.push(new am4charts.CircleBullet());
  circleBullet.circle.stroke = am4core.color("#fff");
  circleBullet.circle.strokeWidth = 2;

  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.label.text = "{name} : {valueY}";
  labelBullet.label.dy = -20;
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.grid.template.stroke = series.stroke;
  valueAxis.renderer.grid.template.strokeOpacity = 0.1;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.minGridDistance = 25;
  valueAxis.align = "right";
  
  if (topMargin && bottomMargin) {
    valueAxis.marginTop = 10;
    valueAxis.marginBottom = 10;
  }
  else {
    if (topMargin) {
      valueAxis.marginTop = 20;
    }
    if (bottomMargin) {
      valueAxis.marginBottom = 20;
    }
  }
  
  var bullet = series.bullets.push(new am4charts.CircleBullet());
  bullet.circle.stroke = am4core.color("#fff");
  bullet.circle.strokeWidth = 2;
    bullet.adapter.add("dy", function(dy, target) {
      hideBullet(target);
      return dy;
    })

    function hideBullet(bullet) {
      if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
        bullet.visible = false;
      }
      else {
        bullet.visible = true;
      }
    }

    var rangest = valueAxis.axisRanges.create();
    rangest.value = mutu;
    rangest.label.text = "Max {name}";
    rangest.grid.stroke = am4core.color("#ff0000");
    rangest.grid.strokeWidth = 2;
    rangest.grid.strokeOpacity = 1;
//    rangest.label.location = 0.4;
    rangest.label.inside = true;
    rangest.label.fill = rangest.grid.stroke;
    //rangest.label.align = "right";
    rangest.label.verticalCenter = "bottom";
    //rangest.label.dy = -20;

    var rangerg = valueAxis.axisRanges.create();
    rangerg.value = renge;
    rangerg.label.text = "Min {name}"; 
    rangerg.grid.stroke = am4core.color("#ff0000");
    rangerg.grid.strokeWidth = 2;
    rangerg.grid.strokeOpacity = 1;
//    rangerg.label.location = 0.4;
    rangerg.label.inside = true;
    rangerg.label.fill = rangerg.grid.stroke;
    //rangerg.label.align = "right";
    rangerg.label.verticalCenter = "bottom";
    //rangerg.label.dy = -20;
}

<?php
foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
?>
createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_limbah'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_limbah'].'"'; ?>, true, true, <?php echo round($rowambil_limbah_grafik['standar_mutu'],2); ?>, <?php echo round($rowambil_limbah_grafik['range_mutu'],2); ?>);
<?php
}
?>

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();
    chart.scrollbarX = scrollbar;
    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

    }); 
<?php 
}
if($grafik == 10){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.data = [
    <?php
    foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
    ?>
    {
      "year": new Date(<?php echo $rowgrafik_garis_opsi['thn']; ?>, <?php echo $rowgrafik_garis_opsi['bln']-1; ?>, <?php echo $rowgrafik_garis_opsi['hr']; ?>),
      <?php
      $no = 0;
      $jsonx = $this->m_admin_user->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
      foreach($jsonx as $row2){
          $no++;
      ?>
      <?php echo '"'.$row2['id_limbah'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>
      <?php
      }
      ?>
    },
    <?php
    }
    ?>
    ];

    chart.maskBullets = false;
    chart.dateFormatter.dateFormat = "dd-MM-yyyy";

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
//var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;

// Set date label formatting
dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");

function createSeriesAndAxis(field, name, topMargin, bottomMargin, mutu, renge) {
  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "year";
  series.name = name;
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
//  series.legendSettings.valueText = "{valueY}";
// series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";

  let hs = series.segments.template.states.create("hover")
  hs.properties.strokeWidth = 5;
  series.segments.template.strokeWidth = 1;

  // Add simple bullet
  var circleBullet = series.bullets.push(new am4charts.CircleBullet());
  circleBullet.circle.stroke = am4core.color("#fff");
  circleBullet.circle.strokeWidth = 2;

  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.label.text = "{name} : {valueY}";
  labelBullet.label.dy = -20;
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.grid.template.stroke = series.stroke;
  valueAxis.renderer.grid.template.strokeOpacity = 0.1;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.minGridDistance = 25;
  valueAxis.align = "right";
  
  if (topMargin && bottomMargin) {
    valueAxis.marginTop = 10;
    valueAxis.marginBottom = 10;
  }
  else {
    if (topMargin) {
      valueAxis.marginTop = 20;
    }
    if (bottomMargin) {
      valueAxis.marginBottom = 20;
    }
  }
  
    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.stroke = am4core.color("#fff");
    bullet.circle.strokeWidth = 2;
    bullet.adapter.add("dy", function(dy, target) {
      hideBullet(target);
      return dy;
    })

    function hideBullet(bullet) {
      if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
        bullet.visible = false;
      }
      else {
        bullet.visible = true;
      }
    }

    var rangest = valueAxis.axisRanges.create();
    rangest.value = mutu;
    rangest.label.text = "Max {name}";
    rangest.grid.stroke = am4core.color("#ff0000");
    rangest.grid.strokeWidth = 2;
    rangest.grid.strokeOpacity = 1;
//    rangest.label.location = 0.4;
    rangest.label.inside = true;
    rangest.label.fill = rangest.grid.stroke;
    //rangest.label.align = "right";
    rangest.label.verticalCenter = "bottom";
    //rangest.label.dy = -20;

    var rangerg = valueAxis.axisRanges.create();
    rangerg.value = renge;
    rangerg.label.text = "Min {name}"; 
    rangerg.grid.stroke = am4core.color("#ff0000");
    rangerg.grid.strokeWidth = 2;
    rangerg.grid.strokeOpacity = 1;
//    rangerg.label.location = 0.4;
    rangerg.label.inside = true;
    rangerg.label.fill = rangerg.grid.stroke;
    //rangerg.label.align = "right";
    rangerg.label.verticalCenter = "bottom";
    //rangerg.label.dy = -20;
}

    <?php
    foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
    ?>
    createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_limbah'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_limbah'].'"'; ?>, true, true, <?php echo round($rowambil_limbah_grafik['standar_mutu'],2); ?>, <?php echo round($rowambil_limbah_grafik['range_mutu'],2); ?>);
    <?php
    }
    ?>

    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;
    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
    chart.rightAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

    });
<?php 
}
if($grafik == 11){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.data = [
    <?php
    foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
    ?>
    {
      "year": new Date(<?php echo $rowgrafik_garis_opsi['thn']; ?>, <?php echo $rowgrafik_garis_opsi['bln']-1; ?>, <?php echo $rowgrafik_garis_opsi['hr']; ?>),
      <?php
      $no = 0;
      $jsonx = $this->m_admin_user->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
      foreach($jsonx as $row2){
          $no++;
      ?>
      <?php echo '"'.$row2['id_limbah'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>
      <?php
      }
      ?>
    },
    <?php
    }
    ?>
    ];

    chart.maskBullets = false;
    chart.dateFormatter.dateFormat = "dd-MM-yyyy";

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
//var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;

// Set date label formatting
dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
// Create series
function createSeriesAndAxis(field, name, topMargin, bottomMargin, mutu, renge) {
    // Create value axis
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minLabelPosition = 0.01;

  
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "year";
//  series.dataFields.categoryX = "year";
  series.name = name;
//  series.tooltipText = "{dateX}: [b]{valueY}[/]";
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
//  series.legendSettings.valueText = "{valueY}";

//  series.visible  = false;

  let hs = series.segments.template.states.create("hover")
  hs.properties.strokeWidth = 5;
  series.segments.template.strokeWidth = 1;

  // Add simple bullet
  var circleBullet = series.bullets.push(new am4charts.CircleBullet());
  circleBullet.circle.stroke = am4core.color("#fff");
  circleBullet.circle.strokeWidth = 2;

  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.label.text = "{name} : {valueY}";
  labelBullet.label.dy = -20;
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.grid.template.stroke = series.stroke;
  valueAxis.renderer.grid.template.strokeOpacity = 0.1;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.minGridDistance = 25;
  valueAxis.align = "right";
  
  if (topMargin && bottomMargin) {
    valueAxis.marginTop = 10;
    valueAxis.marginBottom = 10;
  }
  else {
    if (topMargin) {
      valueAxis.marginTop = 20;
    }
    if (bottomMargin) {
      valueAxis.marginBottom = 20;
    }
  }
  
    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.stroke = am4core.color("#fff");
    bullet.circle.strokeWidth = 2;
    bullet.adapter.add("dy", function(dy, target) {
      hideBullet(target);
      return dy;
    })

    function hideBullet(bullet) {
      if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
        bullet.visible = false;
      }
      else {
        bullet.visible = true;
      }
    }
}

    <?php
    foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
    ?>
    createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_limbah'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_limbah'].'"'; ?>, true, true, <?php echo round($rowambil_limbah_grafik['standar_mutu'],2); ?>, <?php echo round($rowambil_limbah_grafik['range_mutu'],2); ?>);
    <?php
    }
    ?>

    // createSeriesAndAxis("value", "Series #1", false, true);
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    // Add scrollbar
    var scrollbar = new am4charts.XYChartScrollbar();
    //scrollbar.series.push(series)

    chart.scrollbarX = scrollbar;

    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

    }); 
<?php  
}
if($grafik == 12){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.XYChart);
    chart.data = [
    <?php
    foreach($grafik_garis_opsi as $rowgrafik_garis_opsi){
    ?>
    {
      "year": new Date(<?php echo $rowgrafik_garis_opsi['thn']; ?>, <?php echo $rowgrafik_garis_opsi['bln']-1; ?>, <?php echo $rowgrafik_garis_opsi['hr']; ?>),
      <?php
      $no = 0;
      $jsonx = $this->m_admin_user->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
      foreach($jsonx as $row2){
          $no++;
      ?>
      <?php echo '"'.$row2['id_limbah'].'"'; ?>:<?php echo round($row2['hasil_lhu_detil'],2); ?>
      <?php
      }
      ?>
    },
    <?php
    }
    ?>
    ];

    chart.maskBullets = false;
    chart.dateFormatter.dateFormat = "dd-MM-yyyy";

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
//var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 30;

// Set date label formatting
dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
// Create series
function createSeriesAndAxis(field, name, topMargin, bottomMargin, mutu, renge) {
    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minLabelPosition = 0.01;
  
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "year";
  series.name = name;
  series.strokeWidth = 2;
  series.yAxis = valueAxis;

  let hs = series.segments.template.states.create("hover")
  hs.properties.strokeWidth = 5;
  series.segments.template.strokeWidth = 1;

  // Add simple bullet
  var circleBullet = series.bullets.push(new am4charts.CircleBullet());
  circleBullet.circle.stroke = am4core.color("#fff");
  circleBullet.circle.strokeWidth = 2;

  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.label.text = "{name} : {valueY}";
  labelBullet.label.dy = -20;
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.grid.template.stroke = series.stroke;
  valueAxis.renderer.grid.template.strokeOpacity = 0.1;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.minGridDistance = 25;
  valueAxis.align = "right";
  
  if (topMargin && bottomMargin) {
    valueAxis.marginTop = 10;
    valueAxis.marginBottom = 10;
  }
  else {
    if (topMargin) {
      valueAxis.marginTop = 20;
    }
    if (bottomMargin) {
      valueAxis.marginBottom = 20;
    }
  }
  
    var bullet = series.bullets.push(new am4charts.CircleBullet());
    bullet.circle.stroke = am4core.color("#fff");
    bullet.circle.strokeWidth = 2;
    bullet.adapter.add("dy", function(dy, target) {
      hideBullet(target);
      return dy;
    })

    function hideBullet(bullet) {
      if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
        bullet.visible = false;
      }
      else {
        bullet.visible = true;
      }
    }
}

    <?php
    foreach($ambil_limbah_grafik as $rowambil_limbah_grafik){
    ?>
    createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik['id_limbah'].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik['nama_limbah'].'"'; ?>, true, true, <?php echo round($rowambil_limbah_grafik['standar_mutu'],2); ?>, <?php echo round($rowambil_limbah_grafik['range_mutu'],2); ?>);
    <?php
    }
    ?>

    // createSeriesAndAxis("value", "Series #1", false, true);
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;

    chart.legend = new am4charts.Legend();
    chart.legend.labels.template.text = "[bold {color}]{name}[/]";

    chart.legend.scrollable = true
    chart.rightAxesContainer.layout = "vertical"; 

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

    }); 
<?php
}
    if($grafik == 13){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>admin_user/lihat/pie_all/<?php echo $id;?>/<?php echo $id2;?>";
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "total";
    pieSeries.dataFields.category = "nama_limbah";
    pieSeries.innerRadius = am4core.percent(0);

//  pieSeries.ticks.template.disabled = true;
//  pieSeries.alignLabels = false;
//  pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
    pieSeries.labels.template.text = "[bold {color}]{category} :  {value} ({value.percent.formatNumber('#.0')}%) [/]";
//  pieSeries.labels.template.radius = am4core.percent(-80);
//  pieSeries.labels.template.fill = am4core.color("white");
//  pieSeries.labels.template.maxWidth = 130;
    pieSeries.labels.template.paddingTop = 0;
    pieSeries.labels.template.paddingBottom = 0;
    pieSeries.labels.template.fontSize = 10;
    pieSeries.labels.template.wrap = true;
    pieSeries.labels.template.relativeRotation = 90;

    var rgm = new am4core.RadialGradientModifier();
    rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
    pieSeries.slices.template.fillModifier = rgm;
    pieSeries.slices.template.strokeModifier = rgm;
    pieSeries.slices.template.strokeOpacity = 0.4;
    pieSeries.slices.template.strokeWidth = 0;

    chart.legend = new am4charts.Legend();
    //chart.legend.labels.template.text = "[bold {color}]{category} : {value.percent.formatNumber('#.0')}% [/]";
    chart.legend.paddingTop = 0;
    chart.legend.paddingBottom = 0;
    chart.legend.fontSize = 11;
    chart.legend.wrap = true;
    chart.legend.labels.template.maxWidth = 150;
    chart.legend.labels.template.truncate = true;   
    //  chart.legend.position = "right";
        chart.legend.scrollable = true;


    /* Create a separate container to put legend in */
/*    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.responsive.enabled = true;*/

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";
/*    chart.exporting.menu.items[0].menu.push({
      label: "Zip",
      type: "custom",
      options: {
        callback: function() {
          Promise.all([
            chart.exporting.getExcel(),
            chart.exporting.getImage('png')
          ]).then(function(exportedItems) {
            var zip = new JSZip();
            zip.file("data.xlsx", exportedItems[0].split("base64,")[1], {base64: true});
            zip.file("chart.png", exportedItems[1].split("base64,")[1], {base64: true});
            zip.generateAsync({type: "blob"}).then(function(content) {
              saveAs(content, "chartpie.zip");
            });
          });
        }
      }
    })*/
    // Add watermark
    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = false;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";
    });
<?php  
} 
}
?>
</script>
		</div>
	</body>
</html>
