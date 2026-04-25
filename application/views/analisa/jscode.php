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
            "url"  : "<?php echo base_url();?>analisa/<?php echo $page;?>/data_pengajuan/<?php echo $id;?>",
            "type" : "POST"
        },
        "columns": [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable":false,
                    "data":      null,
                    "defaultContent": ''
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
                    location.href = '<?php echo base_url('analisa/'.$page.'/logbook/'); ?>'+data;
                }
            },
            {
                text: "<i class='fa fa-search'></i> Analisa BCP",
                extend: "selected",
                className: "btnlime",
                action: function ( e, dt, node, config ) {
                    data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                    // alert(JSON.stringify(data));
                    location.href = '<?php echo base_url('analisa/'.$page.'/bcp/'); ?>'+data;
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
                        window.open('<?php echo base_url('analisa/'.$page.'/pdf/'); ?>'+data);
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
                "url"  : "<?php echo base_url();?>analisa/pengajuan_kompetensi/data_logbook/<?php echo $id; ?>",
                "type" : "POST"
            },
            "columns": [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "searchable":false,
                    "data":      null,
                    "defaultContent": ''
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
                "url"  : "<?php echo base_url();?>analisa/pengajuan_kompetensi/pemulihan/<?php echo $id;?>",
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
            "url"  : "<?php echo base_url();?>analisa/pengajuan_kompetensi/tabel_logbook/<?php echo $id;?>/<?php echo $all;?>/<?php echo $first_date;?>/<?php echo $last_date;?>",
            "type" : "POST"
        },
        "columns": [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable":false,
                        "data":      null,
                        "defaultContent": ''
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
elseif ($page=="multi_akses")
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
            "url"  : "<?php echo base_url();?>analisa/<?php echo $page;?>/data/<?php echo $id;?>",
            "type" : "POST"
        },
        "columns": [
                  { "data": "id_akses", "searchable":false },
                  { "data": "id_pegawai","searchable":false },
                  { "data": "nama_pegawai" },
                  { "data": "nama_akses","searchable":false },
                  { "data": "status_pegawai_akses", "searchable":false,
                    "render": function(data, type, row){
                        if (row.status_pegawai_akses === '0') {
                           return '<button class="btn btn-xs btn-danger"> Non Aktif</button>';
                       } else {
                           return '<button class="btn btn-xs btn-success"> Aktif</button>';
                       }
                    }
                  }
        ],
        "order": [[0, 'desc']] ,
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
