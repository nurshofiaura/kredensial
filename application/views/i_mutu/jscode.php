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
elseif ($page=="lhu")
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
                "url"  : "<?php echo base_url();?>i_mutu/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id4;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_lhu", "searchable":false, "visible":false },
                      { "data": "deskripsi_lhu" },
                      { "data": "nama_standar_mutu", "searchable":false, "orderable":false },
                      { "data": "tgl_lhu" },
                      { "data": "no_lhu" },
                      { "data": "nama_unit", "searchable":false },
/*                      { "data": "cp_lhu",
            "render": function ( data, type, row ) {
                return row.cp_lhu + ' (' + row.no_cp_lhu + ')';
            }
                      },*/
                      { 
                        "data": "link_lhu", "searchable":false, "orderable":false,
                        "render": function(data, type, row, meta){
                            if (data !== null && data !== '') {
        return '<a href="<?php echo base_url();?>assets/berkas/im/'+data+'" target="_blank"><i class="fa fa-search"></i> Lihat Lampiran</a>';
                            } else {
                               return '';
                            }
                        }
                      }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah Capaian Mutu",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('i_mutu/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Input Indikator Mutu",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_lhu'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('i_mutu/'.$page.'/input/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-upload'></i> Lampiran Indikator Mutu",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        barcode_lhu = dt.rows( { selected: true } ).data()[0]['barcode_lhu'];
                        pembuat_lhu = dt.rows( { selected: true } ).data()[0]['pembuat_lhu'];
                        if(pembuat_lhu == <?= $this->session->id_pegawai ?>){
                            data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                            // alert(JSON.stringify(data));
                            location.href = '<?php echo base_url('i_mutu/'.$page.'/input/'); ?>'+barcode_lhu;
                        }
                        else{
                            swal({
                              title: "TIDAK ADA HAK AKSES",
                              text: "Bukan Pembuat Laporan",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                    }
                },
/*               {
                text: "<i class='fa fa-trash'></i> Hapus",
                extend: "selected",
                className: "btnred",
                action: function ( e, dt, node, config ) {
                   data = dt.rows( { selected: true } ).data()[0];
                   swal({
                     title: "HATI-HATI MENGHAPUS DATA",
                     text: "Menghapus Data Akan Merubah Grafik dan Tabel", //+data['no_lhu'],
                     footer: '<b>ADMIN TIDAK BERTANGGUNG JAWAB</b>',
                     icon: "error",
                     buttons: true,
                     dangerMode: true
       //              ,               timer: 1500

                   })
                   .then((willDelete) => {
                    if (willDelete) {
                     location.href = ' echo base_url('admin_perawat/'.$page.'/hapus/'); ?>'+data['id_lhu'];
                        }
                   });
                }
               },*/
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
elseif ($page=="lhu_input")  
{
?>
    $('#tgl_lhu').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
    $("#tgl_lhu").inputmask("datetime", {
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
    $('.select2').select2();
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
                "url"  : "<?php echo base_url();?>i_mutu/lhu/data2/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [             
                      { "data": "id_lhu_detil", "searchable":false, "visible":false },
                      { "data": "nama_limbah" },                             
                      { "data": "hasil_lhu_detil", "searchable":false, className: "text-right" }
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
                          $('.modal-body').load('<?php echo base_url('i_mutu/lhu/isi/'); ?><?php echo $id;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_lhu_detil'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('i_mutu/lhu/rubah/'); ?><?php echo $id;?>/'+data,function(){
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
elseif ($page=="laporan")
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
"url"  : "<?php echo base_url();?>i_mutu/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id4;?>/<?php echo $id5;?>/<?php echo $id6;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_laporan", "searchable":false , "visible":false },
                      { "data": "nama_standar_mutu" },
                      { "data": "tgl_laporan" },
                      { "data": "judul_laporan" },
                      { "data": "nama_unit" }
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
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnteal",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('i_mutu/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-cogs'></i> Seting",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('i_mutu/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-copy'></i> Copy",
                    extend: "selected",
                    className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('i_mutu/'.$page.'/clone/'); ?>'+data;
                    }
                },
                {
                  text: "<i class='fa fa-file-pdf-o'></i> Print PDF",
                    extend: "selected",
                    className: "btnaqua",
                    action: function ( e, dt, node, config ) {
/*                        kredensial = dt.rows( { selected: true } ).data()[0]['kredensial'];
                        mutu = dt.rows( { selected: true } ).data()[0]['mutu'];
                        etika = dt.rows( { selected: true } ).data()[0]['etika'];
                        spk = dt.rows( { selected: true } ).data()[0]['spk'];
                        stspk = dt.rows( { selected: true } ).data()[0]['status_spk'];
                        if(stspk=='1' && kredensial !== null && kredensial !== '' && mutu !== null && mutu !== '' && etika !== null && etika !== '' && spk !== null && spk !== ''){*/
                         data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];
                         window.open('<?php echo base_url('i_mutu/'.$page.'/pdf_intro/'); ?>'+data);
/*                        }
                        else{
                            swal({
                              title: "BELUM DAPAT PRINT",
                              text: "Data Kelengkapan PK Belum Lengkap",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }*/
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
elseif ($page=="laporan_print_tabel2")
{
?>
function savePDF() {
  
  Promise.all([
    chart.exporting.pdfmake,
    chart.exporting.getImage("png"),
    chart2.exporting.getImage("png"),
    chart3.exporting.getImage("png"),
    chart4.exporting.getImage("png")
  ]).then(function(res) { 
    
    var pdfMake = res[0];
    
    // pdfmake is ready
    // Create document template
    var doc = {
      pageSize: "A4",
      pageOrientation: "portrait",
      pageMargins: [30, 30, 30, 30],
      styles: {
        kanan: {
          alignment: 'right'
        },
        miring: {
          italics: true
        },
        tebal: {
          bold: true
        }
      },
      content: []
    };
    
    doc.content.push({
      text: <?php echo '"'.$analisa_laporan_tabel.'"'; ?>,
      fontSize: 20,
      bold: true,
      margin: [0, 20, 0, 15]
    });

    doc.content.push({
      text: "In accumsan velit in orci tempor",
      fontSize: 20,
      bold: true,
      margin: [0, 20, 0, 15]
    });

    doc.content.push({
      text: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sem quam, sodales ac volutpat sed, vestibulum id quam. Sed quis arcu non elit fringilla mattis. Sed auctor mi sed efficitur vehicula. Sed bibendum odio urna, quis lobortis dui luctus ac. Duis eu lacus sodales arcu tincidunt ultrices viverra a risus. Vivamus justo massa, malesuada quis pellentesque ut, placerat in massa. Nunc bibendum diam justo, in consequat ipsum fringilla ac. Praesent porta nibh ac arcu viverra, at scelerisque neque venenatis. Donec aliquam lorem non ultrices ultrices. Aliquam efficitur eros quis tortor condimentum, id pellentesque metus iaculis. Aenean at consequat neque, a posuere lectus. In eu libero magna. Pellentesque molestie tellus nec nisi molestie, eu dignissim lacus tristique. Sed tellus nulla, suscipit a velit non, mattis dictum metus. Curabitur mi mi, convallis nec libero quis, venenatis vestibulum ante.",
      fontSize: 15,
      margin: [0, 0, 0, 15]
    });
    
    doc.content.push({
      text: "Aliquam lacinia justo",
      fontSize: 20,
      bold: true,
      margin: [0, 20, 0, 15]
    });
    
    doc.content.push({
      image: res[1],
      width: 530
    });
    
    doc.content.push({
      text: "Analisa",
      fontSize: 20,
      bold: true,
      margin: [0, 20, 0, 15]
    });

    
    doc.content.push({
      text: "Duis sed efficitur mauris",
      fontSize: 20,
      bold: true,
      margin: [0, 20, 0, 15]
    });
    
    doc.content.push({
      columns: [{
        image: res[2],
        width: 250  
      }, {
        image: res[3],
        width: 250  
      }],
      columnGap: 30
    });
    
    doc.content.push({
      text: "Aliquam semper lacinia",
      fontSize: 20,
      bold: true,
      margin: [0, 20, 0, 15]
    });
    
doc.content.push({
  columns: [{
    image: res[4],
    width: 150  
  }, {
    stack: [{
     text: "Maecenas congue leo vel tortor faucibus, non semper odio viverra. In ac libero rutrum libero elementum blandit vel in orci. Donec sit amet nisl ac eros mollis molestie. Curabitur ut urna vitae turpis bibendum malesuada sit amet imperdiet orci. Etiam pulvinar quam at lorem pellentesque congue. Integer sed odio enim. Maecenas eu nulla justo. Sed quis enim in est sodales facilisis non sed erat. Aenean vel ornare urna. Praesent viverra volutpat ex a aliquet.",
      fontSize: 15,
      margin: [0, 0, 0, 15]
    }, {
     text: "Fusce sed quam pharetra, ornare ligula id, maximus risus. Integer dignissim risus in placerat mattis. Fusce malesuada dui ut lectus ultricies, et sollicitudin nisl placerat. In dignissim elit in pretium lobortis. Fusce ornare enim at metus laoreet, ut convallis elit lacinia. Maecenas pharetra aliquet mi. Nulla orci nunc, egestas id nisi ut, volutpat sollicitudin mi.",
      fontSize: 15,
      margin: [0, 0, 0, 15]
    }],
    width: "*"  
  }],
  columnGap: 30
});
    
    pdfMake.createPdf(doc).download("report.pdf");
    
  });
}

var users = [
{
    first_name: 'Kaitlin',
    last_name: 'Burns',
    age: 23,
    email: 'kburns99753@usermail.com'
},
{
    first_name: 'Joshua',
    last_name: 'Feir',
    age: 31,
    email: 'josh319726@usermail.com'
},
{
    first_name: 'Stephen',
    last_name: 'Shaw',
    age: 28,
    email: 'steve.shaw47628@usermail.com'
},
{
    first_name: 'Timothy',
    last_name: 'McAlpine',
    age: 37,
    email: 'Timbo72469@usermail.com'
},
{
    first_name: 'Sarah',
    last_name: 'Connor',
    age: 19,
    email: 'SarahC6320@usermail.com'
}
];

// Themes
am4core.useTheme(am4themes_animated);
am4core.useTheme(am4themes_dataviz);

/**
 * Chart 1
 */

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

// Add data
chart.data = [{
  "date": new Date(2018, 0, 1),
  "value": 450,
  "value2": 362,
  "value3": 699
}, {
  "date": new Date(2018, 0, 2),
  "value": 269,
  "value2": 450,
  "value3": 841
}, {
  "date": new Date(2018, 0, 3),
  "value": 700,
  "value2": 358,
  "value3": 699
}, {
  "date": new Date(2018, 0, 4),
  "value": 490,
  "value2": 367,
  "value3": 500
}, {
  "date": new Date(2018, 0, 5),
  "value": 500,
  "value2": 485,
  "value3": 369
}, {
  "date": new Date(2018, 0, 6),
  "value": 550,
  "value2": 354,
  "value3": 250
}, {
  "date": new Date(2018, 0, 7),
  "value": 420,
  "value2": 350,
  "value3": 600
}];

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.labels.template.disabled = true;
categoryAxis.renderer.minGridDistance = 30;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.labels.template.disabled = true;

// Create series
function createSeries(field, name) {
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "date";
  series.name = name;
  series.tooltipText = "{dateX}: [b]{valueY}[/]";
  series.strokeWidth = 3;
  
  var bullet = series.bullets.push(new am4charts.CircleBullet());
  bullet.circle.stroke = am4core.color("#fff");
  bullet.circle.strokeWidth = 3;
  bullet.circle.radius = 7;
}

createSeries("value", "Series #1");
createSeries("value2", "Series #2");
createSeries("value3", "Series #3");

    var title = chart.titles.create();
    title.text = "Judul (Hasil Normal Dalam %)";
    title.fontSize = 18;
/**
 * Chart 2
 */

// Create chart instance
var chart2 = am4core.create("chartdiv2", am4charts.XYChart);
chart2.paddingBottom = 25;

// Add data
chart2.data = [{
  "country": "USA",
  "visits": 3025
}, {
  "country": "China",
  "visits": 1882
}, {
  "country": "Japan",
  "visits": 1809
}, {
  "country": "Germany",
  "visits": 1322
}, {
  "country": "UK",
  "visits": 1122
}, {
  "country": "France",
  "visits": 1114
}, {
  "country": "India",
  "visits": 984
}];

// Create axes
var categoryAxis = chart2.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.disabled = true;

var valueAxis = chart2.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.labels.template.disabled = true;

// Create series
var series = chart2.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.columns.template.strokeWidth = 0;

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;

// on hover, make corner radiuses bigger
var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", (fill, target)=>{
  return chart.colors.getIndex(target.dataItem.index);
});
    var title = chart2.titles.create();
    title.text = "Judul (Hasil Normal Dalam %)";
    title.fontSize = 18;

/**
 * Chart 3
 */

// Create chart instance
var chart3 = am4core.create("chartdiv3", am4charts.XYChart);
chart3.paddingBottom = 25;

// Add percent sign to all numbers
chart3.numberFormatter.numberFormat = "#.3'%'";

// Add data
chart3.data = [{
    "country": "USA",
    "year2004": 3.5,
    "year2005": 4.2
}, {
    "country": "UK",
    "year2004": 1.7,
    "year2005": 3.1
}, {
    "country": "Canada",
    "year2004": 2.8,
    "year2005": 2.9
}, {
    "country": "Japan",
    "year2004": 2.6,
    "year2005": 2.3
}, {
    "country": "France",
    "year2004": 1.4,
    "year2005": 2.1
}, {
    "country": "Brazil",
    "year2004": 2.6,
    "year2005": 4.9
}];

// Create axes
var categoryAxis = chart3.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.disabled = true;

var valueAxis = chart3.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.labels.template.disabled = true;

// Create series
var series = chart3.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "year2004";
series.dataFields.categoryX = "country";
series.clustered = false;

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;

var series2 = chart3.series.push(new am4charts.ColumnSeries());
series2.dataFields.valueY = "year2005";
series2.dataFields.categoryX = "country";
series2.clustered = false;
series2.columns.template.width = am4core.percent(50);

series2.columns.template.column.cornerRadiusTopLeft = 6;
series2.columns.template.column.cornerRadiusTopRight = 6;
    var title = chart3.titles.create();
    title.text = "Judul (Hasil Normal Dalam %)";
    title.fontSize = 18;

/**
 * Chart 4
 */

// Create chart
var chart4 = am4core.create("chartdiv4", am4charts.PieChart);
chart4.padding(0, 0, 0, 0);

chart4.data = [
  {
    country: "Lithuania",
    value: 260
  },
  {
    country: "Czech Republic",
    value: 230
  },
  {
    country: "Ireland",
    value: 200
  },
  {
    country: "Germany",
    value: 165
  },
  {
    country: "Australia",
    value: 139
  },
  {
    country: "Austria",
    value: 128
  }
];

var series = chart4.series.push(new am4charts.PieSeries());
series.dataFields.value = "value";
series.dataFields.radiusValue = "value";
series.dataFields.category = "country";
series.slices.template.cornerRadius = 6;
series.colors.step = 3;
series.radius = am4core.percent(100);

series.labels.template.disabled = true;
series.ticks.template.disabled = true;
var title = chart4.titles.create();
title.text = "Judul (Hasil Normal Dalam %)";
title.fontSize = 18;


// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

//

// Increase contrast by taking evey second color
chart.colors.step = 2;

// Add data
chart.data = generateChartData();

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.renderer.minGridDistance = 50;

// Create series
function createAxisAndSeries(field, name, opposite, bullet) {
  var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
  if(chart.yAxes.indexOf(valueAxis) != 0){
    valueAxis.syncWithAxis = chart.yAxes.getIndex(0);
  }
  
  var series = chart.series.push(new am4charts.LineSeries());
  series.dataFields.valueY = field;
  series.dataFields.dateX = "date";
  series.strokeWidth = 2;
  series.yAxis = valueAxis;
  series.name = name;
  series.tooltipText = "{name}: [bold]{valueY}[/]";
  series.tensionX = 0.8;
  series.showOnInit = true;
  
  var interfaceColors = new am4core.InterfaceColorSet();
  
  switch(bullet) {
    case "triangle":
      var bullet = series.bullets.push(new am4charts.Bullet());
      bullet.width = 12;
      bullet.height = 12;
      bullet.horizontalCenter = "middle";
      bullet.verticalCenter = "middle";
      
      var triangle = bullet.createChild(am4core.Triangle);
      triangle.stroke = interfaceColors.getFor("background");
      triangle.strokeWidth = 2;
      triangle.direction = "top";
      triangle.width = 12;
      triangle.height = 12;
      break;
    case "rectangle":
      var bullet = series.bullets.push(new am4charts.Bullet());
      bullet.width = 10;
      bullet.height = 10;
      bullet.horizontalCenter = "middle";
      bullet.verticalCenter = "middle";
      
      var rectangle = bullet.createChild(am4core.Rectangle);
      rectangle.stroke = interfaceColors.getFor("background");
      rectangle.strokeWidth = 2;
      rectangle.width = 10;
      rectangle.height = 10;
      break;
    default:
      var bullet = series.bullets.push(new am4charts.CircleBullet());
      bullet.circle.stroke = interfaceColors.getFor("background");
      bullet.circle.strokeWidth = 2;
      break;
  }
  
  valueAxis.renderer.line.strokeOpacity = 1;
  valueAxis.renderer.line.strokeWidth = 2;
  valueAxis.renderer.line.stroke = series.stroke;
  valueAxis.renderer.labels.template.fill = series.stroke;
  valueAxis.renderer.opposite = opposite;
  
  return series;
}

var series1 = createAxisAndSeries("visits", "Visits", false, "circle");
var series2 = createAxisAndSeries("views", "Views", true, "triangle");
var series3 = createAxisAndSeries("hits", "Hits", true, "rectangle");

// Configure axis tooltips
series3.yAxis.adapter.add("getTooltipText", function(text, target) {
  var cursorPosition = chart.cursor.yPosition;
  return text + " : " + series2.yAxis.getTooltipText(cursorPosition);
});
series2.yAxis.cursorTooltipEnabled = false;

// Add legend
chart.legend = new am4charts.Legend();

// Add cursor
chart.cursor = new am4charts.XYCursor();

// generate some random data, quite different range
function generateChartData() {
  var chartData = [];
  var firstDate = new Date();
  firstDate.setDate(firstDate.getDate() - 100);
  firstDate.setHours(0, 0, 0, 0);

  var visits = 1600;
  var hits = 2900;
  var views = 8700;

  for (var i = 0; i < 15; i++) {
    // we create date objects here. In your data, you can have date strings
    // and then set format of your dates using chart.dataDateFormat property,
    // however when possible, use date objects, as this will speed up chart rendering.
    var newDate = new Date(firstDate);
    newDate.setDate(newDate.getDate() + i);

    visits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    hits += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);
    views += Math.round((Math.random()<0.5?1:-1)*Math.random()*10);

    chartData.push({
      date: newDate,
      visits: visits,
      hits: hits,
      views: views
    });
  }
  return chartData;
}
<?php
}
elseif ($page=="laporan_print_tabel")
{
?>

/*function buildTableBody(data, columns) {
    var body = [];

    body.push(columns);

    data.forEach(function(row) {
        var dataRow = [];

        columns.forEach(function(column) {
            dataRow.push(row[column].toString());
        })

        body.push(dataRow);
    });

    return body;
}

function table(data, columns) {
    return {
        table: {
            headerRows: 1,
            body: buildTableBody(data, columns)
        }
    };
}

function Pdftest(){
  var externalDataRetrievedFromServer = [
    { name: 'Bartek', age: 34, height: 1.78 },
    { name: 'John', age: 27, height: 1.79 },
    { name: 'Elizabeth', age: 30, height: 1.80 }
  ];
    var dd = {
    content: [
        { text: 'Dynamic parts', style: 'header' },
        table(externalDataRetrievedFromServer, ['name', 'age', 'height'])
    ]
}
pdfMake.createPdf(dd).download();
}

Pdftest();
==================================================
var externalDataRetrievedFromServer = [
    { name: 'Bartek', age: 34 },
    { name: 'John', age: 27 },
    { name: 'Elizabeth', age: 30 },
];

function buildTableBody(data, columns) {
    var body = [];

    body.push(columns);

    data.forEach(function(row) {
        var dataRow = [];

        columns.forEach(function(column) {
            dataRow.push(row[column].toString());
        })

        body.push(dataRow);
    });

    return body;
}

function table(data, columns) {
    return {
        table: {
            headerRows: 1,
            body: buildTableBody(data, columns)
        }
    };
}

var dd = {
    content: [
        { text: 'Dynamic parts', style: 'header' },
        table(externalDataRetrievedFromServer, ['name', 'age'])
    ]
}
*/

function savePDF() {
  
  Promise.all([
    chart.exporting.pdfmake,
    chart.exporting.getImage("png")
  ]).then(function(res) { 
    
    var pdfMake = res[0];


    
    // pdfmake is ready
    // Create document template
    var doc = {
      pageSize: "A4",
      pageOrientation: "portrait",
      pageMargins: [30, 30, 30, 30],
      content: []
    };
    
    doc.content.push({
      image: res[1],
      width: 530
    });
    
//    pdfMake.createPdf(doc).download("report.pdf");
    pdfMake.createPdf(doc).print();
    
  });
}

//    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>i_mutu/laporan/pie/<?php echo $id;?>/<?php echo $id2;?>";
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

/*    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";*/
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
    title.text = "<?php echo $judul_laporan_tabel; ?> (Hasil Normal Dalam %)";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?> (Hasil Normal Dalam %)";
//    });

<?php
}
else if ($page=="laporan_tambah" || $page=="laporan_edit" || $page=="laporan_clone")
{
?>
$('#tgl_laporan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_laporan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_awal').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor3', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor4', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor5', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor6', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor7', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor8', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor9', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor10', {enterMode: CKEDITOR.ENTER_BR});
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
                "url"  : "<?php echo base_url();?>i_mutu/laporan/data2/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_laporan_tabel", "searchable":false , "visible":false },
                      { "data": "urutan_laporan_tabel", "searchable":false },
                      { "data": "judul_laporan_tabel" }
/*                      { "data": "cp_lhu",
            "render": function ( data, type, row ) {
                return row.cp_lhu + ' (' + row.no_cp_lhu + ')';
            }
                      },*/
            ],
            "order": [[1, 'asc'],[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-calendar-plus-o'></i> Tambah Tabel",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('i_mutu/laporan/tambah_tabel/'); ?><?php echo $id;?>';
                    }
                },
                {
                    text: "<i class='fa fa-calendar-minus-o'></i> Edit Tabel",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];
                        data2 = dt.rows( { selected: true } ).data()[0]['barcode_laporan_tabel'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('i_mutu/laporan/edit_tabel/'); ?>'+data+'/'+data2;
                    }
                },
              {
                text: "<i class='fa fa-sort-amount-desc'></i> Urutan",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('i_mutu/laporan/urutan/'); ?><?php echo $id;?>/'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              }, 
                {
                    text: "<i class='fa fa-print'></i> Print Tabel",
                    extend: "selected",
                    className: "btnaqua",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];
                        data2 = dt.rows( { selected: true } ).data()[0]['barcode_laporan_tabel'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('i_mutu/laporan/print_tabel/'); ?>'+data+'/'+data2;
                    }
                },
                {
                    text: "<i class='fa fa-table'></i> Print Tabel",
                    extend: "selected",
                    className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];
                        data2 = dt.rows( { selected: true } ).data()[0]['barcode_laporan_tabel'];
                        // alert(JSON.stringify(data));
                        window.open('<?php echo base_url('i_mutu/laporan/pdf_table/'); ?>'+data+'/'+data2);
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
else if ($page=="laporan_tambah_tabel")
{
?>
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
    }); 
<?php 
}
else if ($page=="laporan_edit_tabel")
{
?>
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
        $('#example2').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : false,
          'ordering'    : false,
          'info'        : true,
          'scrollX'         : true,
          'scrollY'         : '250px',
          'scrollCollapse'  : true,
        })
    }); 
    $('.OpenRubahData').on('click',function(){
          var id = $(this).data('id');   
          var id2 = $(this).data('id2');   
        $('.modal-body').load('<?php echo base_url('i_mutu/laporan/rubah_data/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
    $('.OpenRubahLimbah').on('click',function(){
          var id = $(this).data('id');   
          var id2 = $(this).data('id2');   
        $('.modal-body').load('<?php echo base_url('i_mutu/laporan/rubah_limbah/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
<?php 
    if($tabel == 3){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>i_mutu/laporan/pie/<?php echo $id;?>/<?php echo $id2;?>";
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
    if($tabel == 13){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>i_mutu/laporan/pie_all/<?php echo $id;?>/<?php echo $id2;?>";
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
if($tabel == 9){
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
      $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
if($tabel == 10){
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
      $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
if($tabel == 11){
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
      $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
if($tabel == 12){
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
      $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
    if($tabel == 2){
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
              $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
    if($tabel == 4){
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
          $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
    if($tabel == 5){
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
          $ambil_all_limbah_grafik = $this->m_im->ambil_all_limbah_grafik($id2,$rowambil_dt_limbah_grafik['id_limbah']);
          foreach($ambil_all_limbah_grafik as $rowambil_all_limbah_grafik){
          ?>
          value1:<?php echo $rowambil_all_limbah_grafik['cemua']; ?>,
          <?php
          }
          $ambil_sesuai_limbah_grafik = $this->m_im->ambil_sesuai_limbah_grafik($id2,$rowambil_dt_limbah_grafik['id_limbah']);
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
    if($tabel == 6){
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
    if($tabel == 7){
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
    if($tabel == 8){
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
}
//=================================================================== LIHAT
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
"url"  : "<?php echo base_url();?>i_mutu/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id4;?>/<?php echo $id5;?>/<?php echo $id6;?>",
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
                        location.href = '<?php echo base_url('i_mutu/'.$page.'/profil/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-image'></i> Galeri",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('i_mutu/'.$page.'/galeri/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-file-text'></i> Laporan",
                    extend: "selected",
                    className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_laporan'];                       
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('i_mutu/'.$page.'/laporan/'); ?>'+data;
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
              $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
          $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
          $ambil_all_limbah_grafik = $this->m_im->ambil_all_limbah_grafik($id2,$rowambil_dt_limbah_grafik['id_limbah']);
          foreach($ambil_all_limbah_grafik as $rowambil_all_limbah_grafik){
          ?>
          value1:<?php echo $rowambil_all_limbah_grafik['cemua']; ?>,
          <?php
          }
          $ambil_sesuai_limbah_grafik = $this->m_im->ambil_sesuai_limbah_grafik($id2,$rowambil_dt_limbah_grafik['id_limbah']);
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
          $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
    if($grafik == 3){
?>
    am4core.ready(function() {
    am4core.useTheme(am4themes_dataviz);
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv", am4charts.PieChart);
    chart.dataSource.url = "<?php echo base_url();?>i_mutu/lihat/pie/<?php echo $id;?>/<?php echo $id2;?>";
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
      $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
      $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
      $jsonx = $this->m_im->grafik_garis_hasil($rowgrafik_garis_opsi['tgl_lhu'],$rowgrafik_garis_opsi['id_limbah']);
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
    chart.dataSource.url = "<?php echo base_url();?>i_mutu/lihat/pie_all/<?php echo $id;?>/<?php echo $id2;?>";
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
else if ($page=="berkas")
{
?>
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
                "url"  : "<?php echo base_url();?>i_mutu/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_berkas", "searchable":false , "visible":false },
                      { "data": "nama_berkas" },
                      { "data": "no_berkas" },
                      { 
                        "data": "link_berkas", "searchable":false, className: "text-center",
                        "render": function(data, type, row, meta){
                            if (row.id_kategori_pelatihan === '50') {
return '<a href="<?php echo base_url();?>assets/berkas/im/'+data+'" target="_blank"><i class="fa fa-search"></i> Lihat Berkas</a>';
                            } else if (row.id_kategori_pelatihan === '60') {
return '<a href="<?php echo base_url();?>assets/berkas/im/'+data+'" class="example-image-link" data-lightbox="example-set" data-title="Berkas Gambar" ><img class="margin" src="<?php echo base_url();?>assets/berkas/resize/'+data+'"" style="width: 50px;height:50px;" alt="Photo"></a>'
                            } else {
                               return '';
                            }
                        }
                      } 
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_berkas'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('i_mutu/'.$page.'/rubah/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              }, 
/*               {
                text: "<i class='fa fa-trash'></i> Hapus",
                extend: "selected",
                className: "btnred",
                action: function ( e, dt, node, config ) {
                   data = dt.rows( { selected: true } ).data()[0];
                   swal({
                     title: "Yakin ?",
                     text: "Yakin akan menghapus = "+data['nama_berkas'],     //[Modif Disini]
                     icon: "warning",
                     buttons: true,
                     dangerMode: true,
                   })
                   .then((willDelete) => {
                    if (willDelete) {
                     location.href = ' echo base_url('sanitasi/'.$page.'/hapus/'); ?>'+data['id_berkas']+'/'+data['link_berkas'];
                        }
                   });
                }
               },*/
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
