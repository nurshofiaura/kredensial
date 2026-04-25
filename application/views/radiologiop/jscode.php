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
  //  Agar saat home tidak ke universal
?>

<?php
}
elseif ($page=="daftar")
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
  $("#search-inp").keypress(function(event) {
    var character = String.fromCharCode(event.keyCode);
    return isValid(character);
  });
  function isValid(str) {
    return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
  }
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
        '<tr> <td>Tempat Lahir:</td><td>'+d.tmp_lahir+'</td> <td style="width: 5%"></td><td>Gol Darah:</td><td>'+d.nama_golongan_darah+'</td> </tr>'+
        '<tr> <td>Tanggal Lahir:</td><td>'+d.tgl_lahir+'</td> <td></td><td>Agama:</td><td>'+d.nama_agama+'</td> </tr>'+
        '<tr> <td>Jenis Kelamin:</td><td>'+d.jk+'</td><td></td><td>No Kontak:</td><td>'+d.telepon+'</td> </tr>'+
        '<tr> <td>Pendidikan:</td><td>'+d.nama_pendidikan+'</td><td></td><td>Pekerjaan:</td><td>'+d.nama_pekerjaan+'</td> </tr>'+
        '<tr> <td>Marital Status:</td><td>'+d.nama_status_kawin+'</td><td></td><td>Pasangan:</td><td>'+d.nama_pasangan+'</td> </tr>'+
        '<tr> <td>Ayah:</td><td>'+d.nama_ayah+'</td><td></td><td>Ibu:</td><td>'+d.nama_ibu+'</td> </tr>'+
        '<tr> <td>Propinsi:</td><td>'+d.nama_prov+'</td><td></td><td>Kota/Kab:</td><td>'+d.nama_kab+'</td> </tr>'+
        '<tr> <td>Keluhan:</td><td>'+d.nama_kel+'</td><td></td><td>Kecamatan:</td><td>'+d.nama_kec+'</td> </tr>'+
        '<tr> <td>No KTP:</td><td>'+d.nik+'</td><td></td><td>Admin:</td><td>'+d.petugas+'</td> </tr>'+
        '<tr> <td>Unit Daftar:</td><td>'+d.nama_ruangan+'</td><td style="width: 10%"></td><td>Cara Masuk:</td><td>'+d.nama_cara_masuk+'</td> </tr>'+
        '<tr> <td>Status Antri:</td><td>'+d.nama_status_pasien+'</td><td></td><td>JK:</td><td>'+d.jk+'</td> </tr>'+
        '<tr> <td>Cara Bayar:</td><td>'+d.nama_cara_bayar+'</td><td></td><td>Unit/Ruangan:</td><td>'+d.id_instansi_cara_masuk+'</td> </tr>'+
        '<tr> <td>Detil Bayar:</td><td>'+d.detil_cara_bayar+'</td><td></td><td>Unit Order:</td><td>'+d.order_unit+'</td> </tr>'+
        '<tr> <td>Keluhan:</td><td>'+d.keluhan+'</td> </td><td></td><td>Petugas:</td><td>'+d.petugas+'</td> </tr>'+
        '</table>';
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
                "url"  : "<?php echo base_url();?>radiologi/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $key;?>",
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
                      { "data": "id_pendaftaran_unit", "visible": false, "searchable": false },
                      { "data": "waktu_daftar", "searchable": false },
                      { "data": "rm", "orderable": false },
                      { "data": "nama_pasien" },
                      { "data": "umur", "searchable": false, "orderable": false },
                      { "data": "id_dokter_rujukan", "searchable": false, "orderable": false },
                      { "data": "id_instansi_cara_masuk", "searchable": false, "orderable": false },
                      { "data": "nama_status_pasien", "searchable": false, "orderable": false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
                if(data['nama_status_pasien']=="Antri"){
                    $(row).find('td:eq(7)').css('color', 'red');
                }
                else if(data['nama_status_pasien']=="Proses"){
                    $(row).find('td:eq(7)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(7)').css('color', 'blue');
                }
/*                 if(data['v_sign']=="TIDAK LENGKAP"){
                    $(row).find('td:eq(9)').css('color', 'red');
                }
                else {
                    $(row).find('td:eq(9)').css('color', 'blue');
                } */
              },
            "buttons": [
              {
                text: "<i class='fa fa-calendar'></i> Vital Sign",
                extend: "selected",
                className: "btnmaroon",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('radiologi/'.$page.'/penunjang/'); ?>'+data,function(){
                          $('#modal-default').modal({show:true});
                        });

                  }
              },
              {
                  text: "<i class='fa fa-stethoscope'></i> Input Pemeriksaan",
                  extend: "selected",
                  className: "btnteal",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data2 = dt.rows( { selected: true } ).data()[0]['penunjang'];
        //              if(data2>=1){
                          data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran_unit'];
                      // alert(JSON.stringify(data));
                      location.href = '<?php echo base_url('radiologi/'.$page.'/tambah/'); ?>'+data;
          //            }
          //            else{
          //                swal({
            //                title: "ISI VITAL SIGN",
              //              text: "Mohon isi Vital Sign untuk keperluan data lainnya",
                //            icon: "warning",
                  //          buttons: "Tutup",
                    //        dangerMode: true,
                      //    })
              //          }
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
    setInterval(function () {
      table.ajax.reload();
    }, 300000);
  });
<?php
}
elseif ($page=="daftar_tambah")
{
?>
function load_data() {
  $('.tabelpenunjang').load('<?php echo base_url('radiologi/daftar/tabelpenunjang/'); ?><?php echo $first_date; ?>');
}
$(document).ready(function() {
  $('.select2').select2()
  load_data();
  load_pmr();
});
<?php
}
elseif ($page=="reject")
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
                "url"  : "<?php echo base_url();?>admin_radiologi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_reject", "searchable":false },
            { "data": "nama_reject" },
                      { "data": "status_reject", "searchable":false }
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
                          $('.modal-body').load('<?php echo base_url('admin_radiologi/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_reject'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_radiologi/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
        /*         {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_kompetensi'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_radiologi/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },   */
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
elseif ($page=="fokus")
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
                "url"  : "<?php echo base_url();?>admin_radiologi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_field_size", "searchable":false },
            { "data": "nama_field_size" }
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
                          $('.modal-body').load('<?php echo base_url('admin_radiologi/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_field_size'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_radiologi/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
        /*         {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_kompetensi'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_radiologi/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },   */
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
elseif ($page=="thickness")
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
                "url"  : "<?php echo base_url();?>admin_radiologi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_thickness", "searchable":false },
                      { "data": "nama_thickness" },
                      { "data": "fat" },
                      { "data": "thickness" },
                      { "data": "deskripsi_thickness" }
            ],
            "order": [[0, 'asc']] ,
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
                          $('.modal-body').load('<?php echo base_url('admin_radiologi/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_thickness'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_radiologi/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
        /*         {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_kompetensi'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_radiologi/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },   */
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
elseif ($page=="fe")
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
                "url"  : "<?php echo base_url();?>admin_radiologi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_fe", "searchable":false },
                      { "data": "nama_tindakan" },
                      { "data": "fat" },
                      { "data": "nama_field_size" },
                      { "data": "kv" }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                  text: "<i class='fa fa-plus'></i> / <i class='fa fa-minus'></i> Tambah / Rubah Faktor Eksposi",
                  className: "btnlime",
                  init: function(api, node, config) {
                      $(node).removeClass('btn-default')
                  },
                  action: function ( e, dt, node, config ) {
                      location.href = '<?php echo base_url('admin_radiologi/'.$page.'/tambah'); ?>';
                  }
              },
        /*         {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_kompetensi'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_radiologi/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },   */
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
elseif ($page=="bakhp")
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
                "url"  : "<?php echo base_url();?>admin_radiologi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pemeriksaan_bakhp", "searchable":false },
                      { "data": "nama_tindakan" },
                      { "data": "nama_barang" },
                      { "data": "jml_pemeriksaan_bakhp" },
                      { "data": "nama_satuan" },
                      { "data": "status_pemeriksaan_bakhp" }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                  text: "<i class='fa fa-plus'></i> / <i class='fa fa-minus'></i> Tambah / Rubah BAKHP",
                  className: "btnlime",
                  init: function(api, node, config) {
                      $(node).removeClass('btn-default')
                  },
                  action: function ( e, dt, node, config ) {
                      location.href = '<?php echo base_url('admin_radiologi/'.$page.'/tambah'); ?>';
                  }
              },
        /*         {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_kompetensi'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_radiologi/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },   */
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
elseif ($page=="fe_tambah")
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
                "url"  : "<?php echo base_url();?>admin_radiologi/fe/tindakan",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_tindakan", "searchable":false },
                      { "data": "nama_tindakan" },
                      { "data": "nama_golongan_pemeriksaan" },
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-cog'></i> Seting Faktor Eksposi",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_tindakan'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_radiologi/fe/tambah_fe/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
        /*         {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_kompetensi'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_radiologi/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },   */
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
elseif ($page=="bakhp_tambah")
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
                "url"  : "<?php echo base_url();?>admin_radiologi/bakhp/tindakan",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_tindakan", "searchable":false },
                      { "data": "nama_tindakan" },
                      { "data": "nama_golongan_pemeriksaan" },
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-cog'></i> Seting BAKHP",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_tindakan'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_radiologi/bakhp/tambah_bakhp/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
        /*         {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_kompetensi'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_radiologi/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },   */
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
elseif ($page=="program_tr")
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
                "url"  : "<?php echo base_url();?>Admin_radiologi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "nama_program_tr" },
                      { "data": "time", "searchable":false },
            { "data": "begin_time", "searchable":false },
                      { "data": "end_time", "searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-edit'></i> Setting Struktur Jabatan",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program_tr'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('Admin_radiologi/'.$page.'/unit/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Setting Tindakan",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program_tr'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('Admin_radiologi/'.$page.'/tindakan/'); ?>'+data;
                    }
                },
                {
                  text: "<i class='fa fa-clock-o'></i> Setting Waktu",
                  extend: "selected",
                  className: "btnblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program_tr'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('Admin_radiologi/'.$page.'/waktu/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-calendar'></i> Setting Hari",
                  extend: "selected",
                  className: "btnlime",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program_tr'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('Admin_radiologi/'.$page.'/dayofweek/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
if ($page=="program_tr_unit" || $page=="program_tr_tindakan")
{
?>
$(function(){
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
    'scrollX'   : true ,
    'scrollX'     : true,
    'scrollY'     : '500px',
    'scrollCollapse'  : true,
    })
});
<?php
}
elseif ($page=="pie"){
?>
  $('#first_date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
  })
  $('#last_date').datepicker({
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
  $("#last_date").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
  });

  am4core.ready(function() {
  am4core.useTheme(am4themes_dataviz);
  am4core.useTheme(am4themes_animated);
  var chart = am4core.create("chartdiv", am4charts.PieChart);
  chart.dataSource.url = "<?php echo base_url();?>admin_radiologi/pie/tabel/<?php echo $first_date;?>/<?php echo $last_date;?>";
  var pieSeries = chart.series.push(new am4charts.PieSeries());
  pieSeries.dataFields.value = "total";
  pieSeries.dataFields.category = "nama_golongan_pemeriksaan";
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
  title.text = "GRAFIK JUMLAH PEMERIKSAAN";
  title.fontSize = 25;
  title.tooltipText = "JIKA TIDAK TAMPIL TIDAK ADA TRANSAKSI";
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
  });
<?php
}
else if($page=="lt" || $page=="lb" || $page=="lh")
{
?>
$(function(){
  $('.select2').select2()
});

am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['tgl_logbook'].'"'; ?>,
  <?php
  $no = 0;
  $jsonx = $this->m_radiologi->grafik_range2($page,$row1['tgl_logbook'],$ruangan);
  foreach($jsonx as $row2){
    $no++;
  ?>
  <?php echo '"'.$row2['id_golongan_pemeriksaan'].'"'; ?>:<?php echo $row2['jml_logbook']; ?>,
  <?php
  }
  ?>
},
<?php
}
?>
];

// Create category axis
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.opposite = true;

// Create value axis
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.inversed = false;
valueAxis.title.text = "Jumlah Pemeriksaan";
valueAxis.renderer.minLabelPosition = 0.01;

<?php
foreach($ambil_kol_golongan_pemeriksaan_graph as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
?>
// Create series
var series<?php echo $row1x['id_golongan_pemeriksaan']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_golongan_pemeriksaan']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_golongan_pemeriksaan'].'"'; ?>;
series<?php echo $row1x['id_golongan_pemeriksaan']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_golongan_pemeriksaan']; ?>.name = <?php echo '"'.$row1x['nama_golongan_pemeriksaan'].'"'; ?>;
series<?php echo $row1x['id_golongan_pemeriksaan']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_golongan_pemeriksaan']; ?>.tooltipText = "{name} Thn {categoryX}: {valueY}";
series<?php echo $row1x['id_golongan_pemeriksaan']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_golongan_pemeriksaan']; ?>.visible  = false;

let hs<?php echo $row1x['id_golongan_pemeriksaan']; ?> = series<?php echo $row1x['id_golongan_pemeriksaan']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_golongan_pemeriksaan']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_golongan_pemeriksaan']; ?>.segments.template.strokeWidth = 1;

<?php
}
?>
// Add chart cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "zoomY";

// Add legend
chart.legend = new am4charts.Legend();
chart.legend.itemContainers.template.events.on("over", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = true;
  })
})
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
}); // end am4core.ready()
<?php
}
elseif ($page=="format_radiologi")
{
?>
  $("#search-inp").keypress(function(event) {
    var character = String.fromCharCode(event.keyCode);
    return isValid(character);
  });
  function isValid(str) {
    return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
  }
  function format ( d ) {        // `d` is the original data object for the row
    return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
  '<tr> <td>Hasil:</td><td colspan="4">'+d.hasil_normal+'</td></tr>'+
  '<tr> <td>Kesimpulan:</td><td colspan="4">'+d.kesimpulan_normal+'</td></tr>'+
      '</table>';
  }
    $(document).ready(function() {
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
                "url"  : "<?php echo base_url();?>normal/<?php echo $page;?>/data",
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
              { "data": "id_normal", "searchable":false },
              { "data": "nama_tindakan" },
              { "data": "nama_normal" },
              { "data": "nama_pegawai", "searchable":false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                  text: "<i class='fa fa-plus'></i> Tambah Format",
                  className: "btnmaroon",
                  init: function(api, node, config) {
                      $(node).removeClass('btn-default')
                  },
                  action: function ( e, dt, node, config ) {
                      location.href = '<?php echo base_url('normal/'.$page.'/tambah'); ?>';
                  }
              },
              {
                  text: "<i class='fa fa-edit'></i> Rubah Format",
                  extend: "selected",
                  className: "btnblue",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_normal'];
                      // alert(JSON.stringify(data));
                      location.href = '<?php echo base_url('normal/'.$page.'/edit/'); ?>'+data;
                  }
              },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
else if ($page=="format_radiologi_tambah" || $page=="format_radiologi_edit")
{
?>
    $(document).ready(function() {
    $('.select2').select2()
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
  });
<?php
}
?>
</script>
    </div>
  </body>
</html>
