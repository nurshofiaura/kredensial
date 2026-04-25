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
                "url"  : "<?php echo base_url();?>s_pengajuan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan", "searchable":false, "visible":false },
                      { "data": "tgl_pengajuan", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "nama_status_diusulkan", "searchable":false },
                      { "data": "status_pengajuan",
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-danger"> Belum Terkirim</button>';
                           } else if (row.status_pengajuan === '1'){
                               return '<button class="btn btn-xs btn-info"> Proses</button>';
                           }else {
                               return '<button class="btn btn-xs btn-success"> Selesai</button>';
                           }
                        }
                      }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Pengajuan Kompetensi",
                    className: "btnlightblue",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                            $("#modal-default").modal();
                              $('.modal-body').load('<?php echo base_url('s_pengajuan/'.$page.'/tambah'); ?>',function(){
                                $('#modal-default').modal({show:true});
                              });
    
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Lengkapi Pengajuan",
                    extend: "selected",
                    className: "btnlime",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('s_pengajuan/'.$page.'/isi/'); ?>'+data;
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
      '<tr> <td colspan="2">RM:</td><td colspan="2">'+d.rm+'</td> <td colspan="2">Jumlah :</td><td colspan="2">'+d.jml_logbook+'</td></tr>'+
      '<tr> <td colspan="2">Nama:</td><td colspan="2">'+d.nama_pegawai+'</td> <td colspan="2">Instansi:</td><td colspan="2">'+d.nama_working+'</td></tr>'+
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
                "url"  : "<?php echo base_url();?>s_pengajuan/pengajuan_kompetensi/tabel/<?php echo $id;?>",
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
                      { "data": "id_logbook", "searchable":false, "visible":false },
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "nama_kode_kewenangan", "searchable":false },
                      { "data": "nama_kewenangan" }
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
                         location.href = '<?php echo base_url('s_pengajuan/pengajuan_kompetensi/reset_logbook/'.$id.'/'); ?>'+data; //[Modif Disini]
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
<?php
}
elseif ($page=="berkas_logbook")
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
      'searching'   : true,
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
elseif ($page=="berkas_ijasah")
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
                "url"  : "<?php echo base_url();?>s_pengajuan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_berkas", "searchable":false, "visible":false },
                      { "data": "nama_berkas" },
                      { "data": "nama_pendidikan", "searchable":false },
                      { "data": "no_berkas", "searchable":false },
                      { "data": "tgl_b_berkas", "searchable":false },
                      { "data": "link_berkas", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.link_berkas === '') {
                               return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else if (row.link_berkas === null) {
                                return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
                             } 
                         }
                       }

            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-plus'></i> Pilih Berkas",
                extend: "selected",
                className: "btnpurple",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){       
                        data2 = dt.rows( { selected: true } ).data()[0]['id_berkas'];              
                        location.href = '<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id.'/'); ?>';
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },  
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/sample/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
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
elseif ($page=="berkas_str")
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
                "url"  : "<?php echo base_url();?>s_pengajuan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_berkas", "searchable":false, "visible":false },
                      { "data": "nama_berkas" },
                      { "data": "nama_kategori_berkas" },
                      { "data": "no_berkas" },
                      { "data": "tgl_a_berkas" },
                      { "data": "tgl_b_berkas" },
                      { "data": "status_berkas", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.status_berkas === '0') {
                               return '<button class="btn btn-xs btn-danger"> EXPIRED</button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"> AKTIF</button>';
                             } 
                         }
                       },
                      { "data": "link_berkas", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.link_berkas === '') {
                               return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else if (row.link_berkas === null) {
                                return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
                             } 
                         }
                       }

            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-plus'></i> Pilih Berkas",
                extend: "selected",
                className: "btnpurple",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){       
                        data2 = dt.rows( { selected: true } ).data()[0]['id_berkas'];              
                        location.href = '<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id.'/'); ?>'+data2;
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },  
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/ol/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
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
elseif ($page=="berkas_sertifikat")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td>Penyelenggara :</td><td>'+d.penyelenggara+'</td> <td></td><td>No SK / Sertifikat :</td><td>'+d.no_sertifikat+'</td> </tr>'+
      '<tr> <td>Kategori Pelatihan :</td><td>'+d.nama_kategori_pelatihan+'</td> <td></td><td>Kategori :</td><td>'+d.nama_kategori_berkas+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>s_pengajuan/<?php echo $page;?>/data",
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
                      { "data": "id_berkas", "searchable":false, "visible":false },
                      { "data": "nama_berkas" },
                      { "data": "kredit", "searchable":false },
                      { "data": "tgl_a_berkas", "searchable":false },
                      { "data": "tgl_b_berkas", "searchable":false },
                      { "data": "link_berkas", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.link_berkas === '') {
                               return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else if (row.link_berkas === null) {
                                return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
                             } 
                         }
                       }

            ],
            "order": [[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-plus'></i> Pilih Berkas",
                extend: "selected",
                className: "btnpurple",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){       
                        data2 = dt.rows( { selected: true } ).data()[0]['id_berkas'];              
                        location.href = '<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id.'/'); ?>'+data2;
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },  
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/ol/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
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
elseif ($page=="berkaslain_berkas")
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
                "url"  : "<?php echo base_url();?>s_pengajuan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_berkas", "searchable":false, "visible":false },
                      { "data": "nama_berkas" },
                      { "data": "no_berkas" },
                      { "data": "nama_kategori_berkas", "searchable":false },
                      { "data": "link_berkas", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.link_berkas === '') {
                               return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else if (row.link_berkas === null) {
                                return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
                             } 
                         }
                       }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-plus'></i> Pilih Berkas",
                extend: "selected",
                className: "btnpurple",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){       
                        data2 = dt.rows( { selected: true } ).data()[0]['id_berkas'];              
                        location.href = '<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id.'/'); ?>'+data2;
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },  
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_berkas'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/ol/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
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
elseif ($page=="berkas_etik")
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
                "url"  : "<?php echo base_url();?>s_pengajuan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_etik_pegawai", "searchable":false },
                      { "data": "jam_etik_pegawai", "searchable":false },
                      { "data": "jumlah_etik", "searchable":false },
                      { "data": "total_etik", "searchable":false },
                      { "data": "hasil_etik", "searchable":false },
                      { "data": "nama_pegawai" }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Pilih Berkas",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_etik_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('s_pengajuan/pengajuan_kompetensi/isi/'.$id.'/'); ?>'+data;
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
