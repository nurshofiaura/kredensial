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
                "url"  : "<?php echo base_url();?>ol_pengajuan/<?php echo $page;?>/data",
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
                           } else if (row.status_pengajuan === '1') {
                               return '<button class="btn btn-xs btn-success"> Terkirim</button>';
                           } else if (row.status_pengajuan === '2') {
                               return '<button class="btn btn-xs btn-success"> Selesai</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success"> Terbit RKK </button>';
                           }
                        }
                      }
            ],
            "order": [[0, 'desc']] ,
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
                              $('.modal-body').load('<?php echo base_url('ol_pengajuan/'.$page.'/tambah'); ?>',function(){
                                $('#modal-default').modal({show:true});
                              });
    
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Lengkapi Pengajuan",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        status_lunas = dt.rows( { selected: true } ).data()[0]['status_lunas'];
                        if(status_lunas=='blm'){
                            swal({
                              title: "DATA MASIH PENDING",
                              text: "Silahkan Hubungi Administrator ",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                        else{
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        location.href = '<?php echo base_url('ol_pengajuan/'.$page.'/isi/'); ?>'+data;
                        }
                    }
                },
              {
                    text: "<i class='fa fa-send'></i> Kirim Proses",
                    extend: "selected",
                    className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['kode_unit_pengajuan'];
                      if(data !== null && data !== ''){                     
                        peng = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_pengajuan/'.$page.'/kirim/1/'); ?>'+peng;
                      }
                      else{
                          swal({
                            title: "BELUM ADA KOMPETENSI",
                            text: "SILAHKAN ISI KOMPETENSI DAN JANGAN LUPA BERKAS LENGKAPI",
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
elseif ($page=="pengajuan_kompetensi_isi")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td>Q:</td><td>'+d.jml_logbook+'</td> <td>Instansi:</td><td colspan="2">'+d.nama_working+'</td></tr>'+
      '<tr> <td>Pencatatan Registrasi Pasien:</td><td colspan="4">'+d.rm+'</td></tr>'+
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
    });
    $('.OpenTambahKat').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/tambah_kompetensi/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenIjasah').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/tambah_ijasah/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenSurat').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/tambah_str/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenSertifikat').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/tambah_sertifikat/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenBerkasOpsi').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/tambah_berkaslain/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenEtik').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/tambah_etik/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenLogbook').on('click',function(){
          var id = $(this).data('id');    
          var id2 = $(this).data('id2');    
        $('.modal-body').load('<?php echo base_url('ol_pengajuan/pengajuan_kompetensi/tambah_logbook/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
<?php
}
elseif ($page=="pengajuan_kompetensi_rencana")  
{
?>
    $(document).ready(function() {
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
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
elseif ($page=="berkas_logbook")
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
                "url"  : "<?php echo base_url();?>ol_pengajuan/<?php echo $page;?>/data",
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
                        location.href = '<?php echo base_url('ol_pengajuan/'.$page.'/simpan/'.$id.'/'); ?>'+data2;
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
elseif ($page=="berkass_ijasah")
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
                        location.href = '<?php echo base_url('ol_pengajuan/'.$page.'/simpan/'.$id.'/'); ?>'+data2;
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
                "url"  : "<?php echo base_url();?>ol_pengajuan/<?php echo $page;?>/data",
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
                        location.href = '<?php echo base_url('ol_pengajuan/'.$page.'/simpan/'.$id.'/'); ?>'+data2;
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
                "url"  : "<?php echo base_url();?>ol_pengajuan/<?php echo $page;?>/data",
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
                        location.href = '<?php echo base_url('ol_pengajuan/'.$page.'/simpan/'.$id.'/'); ?>'+data2;
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
                "url"  : "<?php echo base_url();?>ol_pengajuan/<?php echo $page;?>/data",
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
                        location.href = '<?php echo base_url('ol_pengajuan/'.$page.'/simpan/'.$id.'/'); ?>'+data2;
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
                "url"  : "<?php echo base_url();?>ol_pengajuan/<?php echo $page;?>/data",
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
                        location.href = '<?php echo base_url('ol_pengajuan/'.$page.'/simpan/'.$id.'/'); ?>'+data;
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
elseif ($page=="pengajuan_kompetensi_portofolio")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr> <td>Nama:</td><td>'+d.nama_pegawai+'</td> <td>Instansi:</td><td colspan="2">'+d.nama_working+'</td></tr>'+
      '<tr> <td>Pencatatan Registrasi Pasien:</td><td colspan="4">'+d.rm+'</td></tr>'+
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
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
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
                "url"  : "<?php echo base_url();?>ol_pengajuan/pengajuan_kompetensi/logbook/<?php echo $id;?>",
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
                      { "data": "id_logbook", "searchable":false, "visible":false },
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "nama_kompetensi" },
                      { "data": "nama_kewenangan" },
                      { "data": null, "orderable": false, "searchable":false, className:"text-center",
                        "render": function(data, type, row){
                            if (row.result_tolak === '1') {
                               return '<button class="btn btn-xs btn-danger"> Supervisi</button>';
                           } else if (row.result_tolak === '2') {
                               return '<button class="btn btn-xs btn-danger">  Tidak Kompeten</button>';
                           } else if (row.validasi === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           }else {
                               return '<button class="btn btn-xs btn-info"> Belum Di Validasi</button>';
                           }
                        }
                      },
            ],
            "order": [[1, 'asc']] ,
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
elseif ($page=="pengajuan_kompetensi_banding")  
{
?>
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    });
<?php
}
elseif ($page=="pengajuan_kompetensi_komponen")  
{
?>
    $(document).ready(function() {
    <?php
    $no =0;
    foreach($form as $rowform2_detil){  
    $no++;    
    ?>
        CKEDITOR.replace('editor<?= $no ?>', {enterMode: CKEDITOR.ENTER_BR});
    <?php 
    }
    ?>
    });
<?php
}
elseif ($page=="pengajuan_kompetensi_tulis")  
{
?>
    $(document).ready(function() {
    <?php
    $no =0;
    foreach($form2_detil as $rowform2_detil){  
    $no++;    
    ?>
        CKEDITOR.replace('editor<?= $no ?>', {enterMode: CKEDITOR.ENTER_BR});
    <?php 
    }
    ?>
    });
<?php
}
elseif ($page=="pengajuan_kompetensi_kesenjangan")  
{
?>
    $(document).ready(function() {
    <?php
    $no =0;
    foreach($form as $rowform2_detil){  
          $detil = $this->m_kredensial->ambil_kaji_ulang_nkr_form_validasi_detil($barcode_pengajuan_validasi,$rowform2_detil['id_kat_kaji']);
    
        foreach($detil as $rowdetil){ 
    $no++;    
    ?>
        CKEDITOR.replace('editor<?= $no ?>', {enterMode: CKEDITOR.ENTER_BR});
    <?php 
        }
    }
    ?>
    });
<?php
}
?>
</script>
		</div>
	</body>
</html>
