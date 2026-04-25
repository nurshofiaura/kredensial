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
elseif ($page=="pengajuan_kompetensi")
{
?>
function format ( d ) {        // `d` is the original data object for the row
  return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
  '<tr> <td>Kabid:</td><td>'+d.id_kabid+'</td> <td style="width: 5%"></td><td>Tgl Acc Kabid:</td><td>'+d.tgl_acc_kabid+'</td> </tr>'+
  '<tr> <td>Asesor:</td><td>'+d.id_asesor+'</td> <td style="width: 5%"></td><td>Tgl Acc Asesor:</td><td>'+d.tgl_acc_asesor+'</td> </tr>'+
  '<tr> <td>Komite:</td><td>'+d.id_komite+'</td> <td style="width: 5%"></td><td>Tgl Acc Komite:</td><td>'+d.tgl_acc_komite+'</td> </tr>'+
  '<tr> <td>Sub Kredensial:</td><td>'+d.id_kredensial+'</td> <td style="width: 5%"></td><td>Tgl Acc Sub Kredensial:</td><td>'+d.tgl_kredensial+'</td> </tr>'+
  '<tr> <td>Sub Mutu:</td><td>'+d.id_mutu+'</td> <td style="width: 5%"></td><td>Tgl Acc Sub Mutu:</td><td>'+d.tgl_mutu+'</td> </tr>'+
  '<tr> <td>Sub Etika:</td><td>'+d.id_etika+'</td> <td style="width: 5%"></td><td>Tgl Acc Sub Etika:</td><td>'+d.tgl_etika+'</td> </tr>'+
  '<tr> <td>Direktur:</td><td>'+d.id_direktur+'</td> <td style="width: 5%"></td><td>Tgl Acc Direktur:</td><td>'+d.tgl_acc_direktur+'</td> </tr>'+
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
    var table = $('#dttb').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": true,
        "ordering": false,
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
            "url"  : "<?php echo base_url();?>developer/<?php echo $page;?>/data_pengajuan/<?php echo $id;?>",
            "type" : "POST"
        },
        "columns": [
                {
                    "className": 'details-control text-center',
                    "orderable": false,
                    "searchable":false,
                    "data":      null,
                    "defaultContent": '<i class = "glyphicon glyphicon-plus-sign"> </ i>'
                },
                  { "data": "id_pengajuan", "searchable":false },
                  { "data": "tgl_pengajuan","searchable":false },
                  { "data": "nama_pegawai" },
                  { "data": "nama_status_diusulkan","searchable":false },
                  { "data": "status_pengajuan", "searchable":false,
                    "render": function(data, type, row){
                        if (row.status_pengajuan === '0') {
                           return '<button class="btn btn-xs btn-warning"> Belum Terkirim</button>';
                       } else {
                           return '<button class="btn btn-xs btn-success"> Terkirim</button>';
                       }
                    }
                  },
                  { "data": "acc_kabid", "searchable":false,
                    "render": function(data, type, row){
                        if (row.acc_kabid === '0') {
                           return '<button class="btn btn-xs btn-default"> Proses</button>';
                        }else if (row.acc_kabid === '1') {
                           return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                       }else {
                           return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                       }
                    }
                  },
                  { "data": "acc_logbook_kabid", "searchable":false,
                    "render": function(data, type, row){
                        if (row.acc_logbook_kabid === '0') {
                           return '<button class="btn btn-xs btn-default"> Proses</button>';
                        }else{
                           return '<button class="btn btn-xs btn-success"> ACC</button>';
                       }
                    }
                  },
                  { "data": "acc_asesor", "searchable":false,
                    "render": function(data, type, row){
                        if (row.acc_asesor === '0') {
                           return '<button class="btn btn-xs btn-default"> Proses </button>';
                        }else if (row.acc_asesor === '1') {
                           return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                       }else {
                           return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                       }
                    }
                  },
                  { "data": "acc_logbook_asesor", "searchable":false,
                    "render": function(data, type, row){
                        if (row.acc_logbook_asesor === '0') {
                           return '<button class="btn btn-xs btn-default"> Proses</button>';
                        }else{
                           return '<button class="btn btn-xs btn-success"> ACC</button>';
                       }
                    }
                  },
                  { "data": "acc_komite", "searchable":false,
                    "render": function(data, type, row){
                        if (row.acc_komite === '0') {
                           return '<button class="btn btn-xs btn-default"> Proses</button>';
                        }else if (row.acc_komite === '1') {
                           return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                       }else {
                           return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                       }
                    }
                  },
                  { "data": "acc_logbook_komite", "searchable":false,
                    "render": function(data, type, row){
                        if (row.acc_logbook_komite === '0') {
                           return '<button class="btn btn-xs btn-default"> Proses</button>';
                        }else{
                           return '<button class="btn btn-xs btn-success"> ACC</button>';
                       }
                    }
                  },
                  { "data": "acc_direktur", "searchable":false,
                    "render": function(data, type, row){
                        if (row.acc_direktur === '0') {
                           return '<button class="btn btn-xs btn-default"> Proses</button>';
                        }else if (row.acc_direktur === '1') {
                           return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                       }else {
                           return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                       }
                    }
                  },
                  { "data": "acc_logbook_direktur", "searchable":false,
                    "render": function(data, type, row){
                        if (row.acc_logbook_direktur === '0') {
                           return '<button class="btn btn-xs btn-default"> Proses</button>';
                        }else{
                           return '<button class="btn btn-xs btn-success"> ACC</button>';
                       }
                    }
                  },
                  { "data": "status_terbitkan", "searchable":false,
                    "render": function(data, type, row){
                        if (row.status_terbitkan === '0') {
                           return '<button class="btn btn-xs btn-warning"> Belum Diterbitkan</button>';
                       } else if (row.status_terbitkan === '1') {
                           return '<button class="btn btn-xs btn-success"> Terbitkan</button>';
                       } else {
                           return '<button class="btn btn-xs btn-danger"> Tidak diterbitkan</button>';
                       }
                    }
                  }
        ],
        "order": [[1, 'desc']] ,
        select: 'single',
        dom: 'Blrtip',
        "buttons": [
            {
                text: "<i class='fa fa-search'></i> Lihat Logbook",
                extend: "selected",
                className: "btnyellow",
                action: function ( e, dt, node, config ) {
                    data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                    // alert(JSON.stringify(data));
                    location.href = '<?php echo base_url('developer/'.$page.'/logbook/'); ?>'+data;
                }
            },
            {
                text: "<i class='fa fa-search'></i> Analisa BCP",
                extend: "selected",
                className: "btnlime",
                action: function ( e, dt, node, config ) {
                    data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                    // alert(JSON.stringify(data));
                    location.href = '<?php echo base_url('developer/'.$page.'/bcp/'); ?>'+data;
                }
            },
            {
              text: "<i class='fa fa-file-pdf-o'></i> Penugasan Klinis",
                extend: "selected",
                className: "btnfuchsia",
                action: function ( e, dt, node, config ) {
                    kabid = dt.rows( { selected: true } ).data()[0]['acc_kabid'];
                    no_terbitkan = dt.rows( { selected: true } ).data()[0]['no_terbitkan'];
                    komite = dt.rows( { selected: true } ).data()[0]['acc_komite'];
                    direktur = dt.rows( { selected: true } ).data()[0]['acc_direktur'];
                    status_terbitkan = dt.rows( { selected: true } ).data()[0]['status_terbitkan'];
                    if(direktur=='1' && komite=='1' && status_terbitkan=='1'){
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        window.open('<?php echo base_url('developer/'.$page.'/pdf/'); ?>'+data);
                    }
                    else{
                        swal({
                          title: "Data Validasi Direktur",
                          text: "Validasi Harus Kompeten, Acc dan Terbitkan",
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
<?php
}
elseif ($page=="pengajuan_kompetensi_logbook")
{
?>
function format ( d ) {        // `d` is the original data object for the row
  return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
    '<tr> <td>Karu:</td><td>'+d.id_karu+'</td> <td style="width: 5%"></td><td>Tgl Acc Karu:</td><td>'+d.tgl_v_karu+'</td> </tr>'+
  '<tr> <td>Kabid:</td><td>'+d.id_kabid+'</td> <td style="width: 5%"></td><td>Tgl Acc Kabid:</td><td>'+d.tgl_v_kabid+'</td> </tr>'+
  '<tr> <td>Asesor:</td><td>'+d.id_asesor+'</td> <td style="width: 5%"></td><td>Tgl Acc Asesor:</td><td>'+d.tgl_v_asesor+'</td> </tr>'+
  '<tr> <td>Komite:</td><td>'+d.id_komite+'</td> <td style="width: 5%"></td><td>Tgl Acc Komite:</td><td>'+d.tgl_v_komite+'</td> </tr>'+
  '<tr> <td>Direktur:</td><td>'+d.id_direktur+'</td> <td style="width: 5%"></td><td>Tgl Acc Direktur:</td><td>'+d.tgl_v_direktur+'</td> </tr>'+
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "searching": true,
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
                "url"  : "<?php echo base_url();?>developer/pengajuan_kompetensi/data_logbook/<?php echo $id; ?>",
                "type" : "POST"
            },
            "columns": [
                {
                    "className": 'details-control text-center',
                    "orderable": false,
                    "searchable":false,
                    "data":      null,
                    "defaultContent": '<i class = "glyphicon glyphicon-plus-sign"> </ i>'
                },
                      { "data": "id_logbook","searchable":false },
                      { "data": "id_pengajuan","searchable":false },
                      { "data": "tgl_logbook","searchable":false },
                      { "data": "jam_logbook","searchable":false },
                      { "data": "nama_kode_kewenangan","searchable":false },
                      { "data": "nama_kewenangan" },
                      { "data": "jml_logbook","searchable":false },
                      { "data": "v_karu",
                        "render": function(data, type, row){
                            if (row.v_karu === 'Proses') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_karu === 'Kompeten') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "v_kabid",
                        "render": function(data, type, row){
                            if (row.v_kabid === 'Proses') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_kabid === 'Kompeten') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "v_asesor",
                        "render": function(data, type, row){
                            if (row.v_asesor === 'Proses') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_asesor === 'Kompeten') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "v_komite",
                        "render": function(data, type, row){
                            if (row.v_komite === 'Proses') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_komite === 'Kompeten') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "v_direktur",
                        "render": function(data, type, row){
                            if (row.v_direktur === 'Proses') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_direktur === 'Kompeten') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           }
                        }
                      },
                      { "data": "result_tolak",
                        "render": function(data, type, row){
                            if (row.result_tolak === '') {
                               return '';
                           } else if (row.result_tolak === 'Supervisi') {
                               return '<button class="btn btn-xs btn-danger"> Supervisi</button>';
                           } else {
                               return '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
                           }
                        }
                      }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btnReload",
                    action: function ( e, dt, node, config ) {
                        dt.ajax.reload();
                    }
                }
            ]
        });
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
                "url"  : "<?php echo base_url();?>developer/pengajuan_kompetensi/pemulihan/<?php echo $id;?>",
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
                        $('.modal-body').load('<?php echo base_url('komite/pengajuan_kompetensi/lihat_pemulihan/'); ?>'+data,function(){
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
                        $('.modal-body').load('<?php echo base_url('komite/pengajuan_kompetensi/lihat_kegiatan/'); ?>'+data,function(){
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
        $('#example1').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : true,
          'scrollX'     : true ,
          'scrollX'         : true,
          'scrollY'         : '350px',
          'scrollCollapse'  : true
        })
    });
<?php
}
elseif ($page=="pengajuan_kompetensi_bcp")
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
function format ( d ) {        // `d` is the original data object for the row
  return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
  '<tr> <td>Karu:</td><td>'+d.id_karu+'</td> <td style="width: 5%"></td><td>Tgl Acc Karu:</td><td>'+d.tgl_v_karu+'</td> </tr>'+
  '<tr> <td>Kabid:</td><td>'+d.id_kabid+'</td> <td style="width: 5%"></td><td>Tgl Acc Kabid:</td><td>'+d.tgl_v_kabid+'</td> </tr>'+
  '<tr> <td>Asesor:</td><td>'+d.id_asesor+'</td> <td style="width: 5%"></td><td>Tgl Acc Asesor:</td><td>'+d.tgl_v_asesor+'</td> </tr>'+
  '<tr> <td>Komite:</td><td>'+d.id_komite+'</td> <td style="width: 5%"></td><td>Tgl Acc Komite:</td><td>'+d.tgl_v_komite+'</td> </tr>'+
  '<tr> <td>Direktur:</td><td>'+d.id_direktur+'</td> <td style="width: 5%"></td><td>Tgl Acc Direktur:</td><td>'+d.tgl_v_direktur+'</td> </tr>'+
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
    var table = $('#dttb').DataTable( {
        "processing": true,
        "serverSide": true,
        "searching": true,
        "ordering": false,
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
            "url"  : "<?php echo base_url();?>developer/pengajuan_kompetensi/tabel_logbook/<?php echo $id;?>/<?php echo $all;?>/<?php echo $first_date;?>/<?php echo $last_date;?>",
            "type" : "POST"
        },
        "columns": [
                    {
                        "className": 'details-control text-center',
                        "orderable": false,
                        "searchable":false,
                        "data":      null,
                        "defaultContent": '<i class = "glyphicon glyphicon-plus-sign"> </ i>'
                    },
                      { "data": "id_logbook", "searchable":false, "visible":true },
                      { "data": "id_pengajuan", "searchable":false, "visible":true },
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "nama_kode_kewenangan", "searchable":false },
                      { "data": "nama_kewenangan" },
                      { "data": "nama_status_diusulkan", "searchable":false },
                      { "data": "v_karu",
                        "render": function(data, type, row){
                            if (row.v_karu === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_karu === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else if (row.v_karu === '2') {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           } else {
                               return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
                           }
                        }
                      },
                      { "data": "v_kabid",
                        "render": function(data, type, row){
                            if (row.v_kabid === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_kabid === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else if (row.v_kabid === '2') {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           } else {
                               return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
                           }
                        }
                      },
                      { "data": "v_asesor",
                        "render": function(data, type, row){
                            if (row.v_asesor === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_asesor === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else if (row.v_asesor === '2') {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           } else {
                               return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
                           }
                        }
                      },
                      { "data": "v_komite",
                        "render": function(data, type, row){
                            if (row.v_komite === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_komite === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else if (row.v_komite === '2') {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           } else {
                               return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
                           }
                        }
                      },
                      { "data": "v_direktur",
                        "render": function(data, type, row){
                            if (row.v_direktur === '0') {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           } else if (row.v_direktur === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else if (row.v_direktur === '2') {
                               return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
                           } else {
                               return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
                           }
                        }
                      }
        ],
        "order": [[1, 'desc']] ,
        select: 'single',
        dom: 'Blrtip',
        "buttons": [
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
"url"  : "<?php echo base_url();?>developer/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>/<?php echo $id4;?>/<?php echo $id5;?>/<?php echo $id6;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_laporan", "searchable":false , "visible":false },
                      { "data": "nama_standar_mutu" },
                      { "data": "tgl_laporan" },
                      { "data": "nama_unit" },
                      { "data": "nama_jabatan" },
                      { "data": "nama_working" }
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
                        location.href = '<?php echo base_url('developer/'.$page.'/profil/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-image'></i> Galeri",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('developer/'.$page.'/galeri/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-file-text'></i> Laporan",
                    extend: "selected",
                    className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('developer/'.$page.'/laporan/'); ?>'+data;
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
              $jsonx = $this->m_developer->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
          $jsonx = $this->m_developer->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
          $ambil_all_limbah_grafik = $this->m_developer->ambil_all_limbah_grafik($id2,$rowambil_dt_limbah_grafik['id_limbah']);
          foreach($ambil_all_limbah_grafik as $rowambil_all_limbah_grafik){
          ?>
          value1:<?php echo $rowambil_all_limbah_grafik['cemua']; ?>,
          <?php
          }
          $ambil_sesuai_limbah_grafik = $this->m_developer->ambil_sesuai_limbah_grafik($id2,$rowambil_dt_limbah_grafik['id_limbah']);
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
          $jsonx = $this->m_developer->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
// --------------------------------------------------
    if($grafik == 3){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>developer/lihat/pie/<?php echo $id;?>/<?php echo $id2;?>";
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

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

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
    if($grafik == 13){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>developer/lihat/pie_all/<?php echo $id;?>/<?php echo $id2;?>";
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

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

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
      $jsonx = $this->m_developer->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
      $jsonx = $this->m_developer->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
      $jsonx = $this->m_developer->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
}
?>
</script>
		</div>
	</body>
</html>
