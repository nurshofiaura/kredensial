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
elseif ($page=="kategori")
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
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
//          "pageLength": 10,
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
                "url"  : "<?php echo base_url();?>ol_pendaftaran/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_golongan_pemeriksaan", "searchable":false, "visible":false },
                      { "data": "nama_golongan_pemeriksaan" },
                      { "data": "nama_unit", "searchable":false, "orderable":false },
                      { "data": "status_golongan_pemeriksaan", "searchable":false, "orderable":false, 
                        "render": function(data, type, row){
                            if (row.status_golongan_pemeriksaan === '1') {
                               return '<button class="btn btn-xs btn-success"> AKTIF</button>';
                           }  else {
                               return '<button class="btn btn-xs btn-danger"> NON AKTIF</button>';
                           }
                        }                          
                      }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('ol_pendaftaran/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_golongan_pemeriksaan'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('ol_pendaftaran/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="tindakan")
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
            "processing": true,
            "serverSide": true,
            "lengthChange": true,
//          "pageLength": 10,
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
                "url"  : "<?php echo base_url();?>ol_pendaftaran/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "wkt_tindakan_tarif", "searchable":false, "visible":false },
                      { "data": "nama_tindakan" },
                      { "data": "nama_golongan_pemeriksaan", "searchable":false, "orderable":false },
                      { "data": "tarif", "searchable":false, "orderable":false, className:"text-right" },
                      { "data": "nama_unit", "searchable":false, "orderable":false },
                      { "data": "status_tindakan", "searchable":false, "orderable":false, 
                        "render": function(data, type, row){
                            if (row.status_tindakan === '1') {
                               return '<button class="btn btn-xs btn-success"> AKTIF</button>';
                           }  else {
                               return '<button class="btn btn-xs btn-danger"> NON AKTIF</button>';
                           }
                        }                          
                      }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('ol_pendaftaran/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_tindakan'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('ol_pendaftaran/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="pendaftaran")
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
var status=0;
/*function load_pmr() {
  $('.pemeriksaane').load('<php echo base_url('jadwal_all/pengambilan/tabel/'); ?><= $first_date ?>/<= $last_date ?>/<= $key ?>');
}*/
  function format ( d ) {        // `d` is the original data object for the row
    return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr><td>Biaya:</td><td>'+d.harga_transaksi+'</td> <td></td><td>RM:</td><td>'+d.rm+'</td> </tr>'+
      '<tr><td>Umur:</td><td>'+d.umur+'</td> <td></td><td>Alamat:</td><td>'+d.alamat+'</td> </tr>'+
      '<tr><td>No:</td><td>'+d.no_transaksi+'</td> <td></td><td>Admin:</td><td>'+d.nama_pegawai+'</td> </tr>'+
      '<tr><td>Data Penunjang :</td><td colspan="4">'+d.data_transaksi+'</td> </tr>'+
      '</table>';
  }
    $(document).ready(function() {
//      load_pmr();
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
                "url"  : "<?php echo base_url();?>ol_pendaftaran/<?= $page ?>/data/<?= $id ?>/<?= $last_date ?>/<?= $key ?>",
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
              { "data": "tgl_sortir","searchable":false,"visible":false },
              { "data": "tgl_transaksi","searchable":false },
              { "data": "nama_pasien","orderable":false },
              { "data": "nama_tindakan","orderable":false, className: "bolded" },
              { "data": "unit_tindakan","orderable":false },
              { "data": "nama_unit","orderable":false },
              { "data": "status_transaksi","orderable":false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
/*      rowCallback: function(row, data, index){
        if(data[3]> 11.7){
          $(row).find('td:eq(3)').css('color', 'red');
        }
        if(data[2].toUpperCase() == 'EE'){
          $(row).find('td:eq(2)').css('color', 'blue');
        }
      },*/
/*            rowCallback: function(row, data, index){
                if(data['status_pembelian']=="Done"){                
                    $(row).find('td:eq(6)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(6)').css('color', 'red');
                }
              }, */
            rowCallback: function(row, data, index){
                if(data['status_transaksi'] == "Pendaftaran"){                
                    $(row).find('td:eq(2)').css('background-color','#F99');
                }
                else {
                    $(row).find('td:eq(2)').css('background-color','green');
                    $(row).find('td:eq(2)').css('color', 'white');
                }
        
    //    $(row).find('td:eq(3)').css('background-color','#F99');
      //  $(row).find('td:eq(7)').css('color', 'green');
      //  $(row).find('td:eq(8)').css('color', 'green');
              },
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                   action: function ( e, dt, node, config ) {  
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('ol_pendaftaran/'.$page.'/tambah'); ?>',
              function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_transaksi'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('ol_pendaftaran/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-cogs'></i> Proses Pendaftaran",
                  extend: "selected",
                  className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_transaksi'];
                        location.href = '<?php echo base_url('ol_pendaftaran/'.$page.'/isi/'); ?>'+data;
                    }
                },
                {
                  text: "<i class='fa fa-recycle'></i> Status Selesai (Tdk Bs Edit)",
                  extend: "selected",
                  className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_transaksi'];
                        location.href = '<?php echo base_url('ol_pendaftaran/'.$page.'/status/'); ?>'+data+'/1';
                    }
                },
                {
                  text: "<i class='fa fa-recycle'></i> Status Pendaftaran",
                  extend: "selected",
                  className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_transaksi'];
                        location.href = '<?php echo base_url('ol_pendaftaran/'.$page.'/status/'); ?>'+data+'/0';
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
  });
<?php
}
elseif ($page=="pendaftaran_master")
{
?>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Apakah Anda Yakin",
            text: "Data Akan Di Hapus!",
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
    }
$(document).ready(function() {
    $('#katbang').DataTable({
    "initComplete": function (settings, json) {  
      $("#katbang").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
    },
    'paging'        : false,
    'lengthChange'  : false,
    'searching'     : true,
    'ordering'      : false,
    'info'          : false
    })
  $('.TambahKatBar').on('click',function(){
    $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_katbang/'); ?><?php echo $id;?>',function(){
      $('#modal-default').modal({show:true});
    });
  });
  $('.EditKatBar').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_katbang/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
    $('#Bang').DataTable({
    "initComplete": function (settings, json) {  
      $("#Bang").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
    },
    'paging'        : false,
    'lengthChange'  : false,
    'searching'     : true,
    'ordering'      : false,
    'info'          : false
    })
  $('.TambahBar').on('click',function(){
    $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_bang/'); ?><?php echo $id;?>',function(){
      $('#modal-default').modal({show:true});
    });
  });
  $('.EditBar').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_bang/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
    $('#Stok').DataTable({
    "initComplete": function (settings, json) {  
      $("#Stok").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
    },
    'paging'        : false,
    'lengthChange'  : false,
    'searching'     : true,
    'ordering'      : false,
    'info'          : false
    })
  $('.TambahStok').on('click',function(){
    $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_stok/'); ?><?php echo $id;?>',function(){
      $('#modal-default').modal({show:true});
    });
  });
    $('#Hasil').DataTable({
    "initComplete": function (settings, json) {  
      $("#Hasil").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
    },
    'paging'        : false,
    'lengthChange'  : false,
    'searching'     : true,
    'ordering'      : false,
    'info'          : false
    })
  $('.TambahHasil').on('click',function(){
    $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_hasil/'); ?><?php echo $id;?>',function(){
      $('#modal-default').modal({show:true});
    });
  });
  $('.EditHasil').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_hasil/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.PFHasil').on('click',function(){
        var id = $(this).data('id');     
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_fhasil/'); ?>'+id,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.EditFhasil').on('click',function(){
        var id = $(this).data('id');     
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_fhasil/'); ?>'+id,function(){
          $('#modal-default').modal({show:true});
      });
  });
});
<?php
}
elseif ($page=="pendaftaran_isi")
{
?>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Apakah Anda Yakin",
            text: "Data Akan Di Hapus!",
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
    }
$(document).ready(function() {
/*    $('#oper').DataTable({
    "initComplete": function (settings, json) {  
      $("#oper").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
    },
    'paging'        : false,
    'lengthChange'  : false,
    'searching'     : true,
    'ordering'      : false,
    'info'          : false
    });*/
  $('.TambahOpe').on('click',function(){
    $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_operator/'); ?><?php echo $id;?>',function(){
      $('#modal-default').modal({show:true});
    });
  });
  $('.EditOpe').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_operator/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.SimpanKw').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_kewenangan/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.EditKw').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_kewenangan/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.TambahKeluar').on('click',function(){
    $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_keluar/'); ?><?php echo $id;?>',function(){
      $('#modal-default').modal({show:true});
    });
  });
  $('.EditKeluar').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_keluar/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.TambahKelengkapan').on('click',function(){
    $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_kelengkapan/'); ?><?php echo $id;?>',function(){
      $('#modal-default').modal({show:true});
    });
  });
  $('.EditKelengkapan').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_kelengkapan/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
});
<?php
}
elseif ($page=="pendaftaran_kewenangan")
{
?>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Apakah Anda Yakin",
            text: "Data Akan Di Hapus!",
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
    }
$(document).ready(function() {
/*    $('#oper').DataTable({
    "initComplete": function (settings, json) {  
      $("#oper").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
    },
    'paging'        : false,
    'lengthChange'  : false,
    'searching'     : true,
    'ordering'      : false,
    'info'          : false
    });*/
  $('.TambahOpe').on('click',function(){
    $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_operator/'); ?><?php echo $id;?>',function(){
      $('#modal-default').modal({show:true});
    });
  });
  $('.EditOpe').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_operator/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.SimpanKw').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_kewenangan/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.EditKw').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_kewenangan/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
  $('.TambahKeluar').on('click',function(){
    $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/tambah_keluar/'); ?><?php echo $id;?>',function(){
      $('#modal-default').modal({show:true});
    });
  $('.EditKeluar').on('click',function(){
        var id = $(this).data('id');    
        var id2 = $(this).data('id2');    
      $('.modal-body').load('<?php echo base_url('ol_pendaftaran/pendaftaran/edit_keluar/'); ?>'+id+'/'+id2,function(){
          $('#modal-default').modal({show:true});
      });
  });
  });
});
<?php
}
?>
</script>
		</div>
	</body>
</html>
