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
// $(document).on('click', '.update_data', function(){  
//            var update_id = $(this).attr("id");  
//            $.ajax({  
//                 url:"ajax.edit.php",  
//                 method:"post",  
//                 data:{update_id:update_id},  
//                 dataType:"json",  
//                 success:function(data){  
//                      $('#nim_m').val(data.nim);  
//                      $('#nama_mahasiswa_m').val(data.nama_mahasiswa); 
//                      $('#update_id_m').val(data.id);  
//                      $('#update').val("update");  
//                      $('#update_data').modal('show');  
//                 }  
//            });  
//       });
// $('#update_form').on("submit", function(event){  
//            event.preventDefault();  
//            if($('#nim_m').val() == "")  
//            {  
//                 alert("NIM Mahasiswa Harus Di isi");  
//            }  
//            else if($('#nama_mahasiswa_m').val() == "")  
//            {  
//                 alert("Nama Mahasiswa harus di isi");  
//            }  
           
//            else  
//            {  
//                 $.ajax({  
//                      url:"ajax.edit.proses.php",  
//                      method:"POST",
//                      data:$('#update_form').serialize(),  
//                      beforeSend:function(){  
//                           $('#update').val("Updating");  
//                      },  
//                      success:function(data){  
//                           $('#update_form')[0].reset();  
//                           $('#update_data').modal('hide');  
//                           $('#tabel_mahasiswa').html(data);  
//                      }  
//                 });  
//            }  
//       });
 
//  $('#insert_form').on("submit", function(event){  
//            event.preventDefault();  
//            if($('#nim').val() == "")  
//            {  
//                 alert("NIM Mahasiswa Harus Di isi");  
//            }  
//            else if($('#nama_mahasiswa').val() == "")  
//            {  
//                 alert("Nama Mahasiswa harus di isi");  
//            }  
           
//            else  
//            {  
//                 $.ajax({  
//                      url:"ajax.input.php",  
//                      method:"POST",
//                      data:$('#insert_form').serialize(),  
//                      beforeSend:function(){  
//                           $('#insert').val("Inserting");  
//                      },  
//                      success:function(data){  
//                           $('#insert_form')[0].reset();  
//                           $('#add_data_Modal').modal('hide');  
//                           $('#tabel_mahasiswa').html(data);  
//                      }  
//                 });  
//            }  
//       });

//     $(document).on('click', '.delete_data', function(){  
//            var delete_id = $(this).attr("id");
//            if(confirm("Are you sure to delete this category")){
            
//            $.ajax({  
//                 url:"ajax.delete.php",  
//                 method:"post",  
//                 data:{delete_id:delete_id},
//                 success:function(data){                    
//                     $('#tabel_mahasiswa').html(data);   
//                 }  
//            });
//            }  
//       });


//    $(document).on('click', '.lihat_data', function(){  
//            var detail_mahasiswa = $(this).attr("id");  
//            $.ajax({  
//                 url:"ajax.detail.php",  
//                 method:"post",  
//                 data:{detail_mahasiswa:detail_mahasiswa},  
//                 success:function(data){  
//                      $('#detail_mahasiswa').html(data);  
//                      $('#confirm-detail').modal("show");  
//                }  
//                 });  
//            });            
//   });  
//================================================= H O M E =================================================
if ($page=="home")
{
?>

<?php
}
// ==========================================================================================================
elseif ($page=="format_hasil")  
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
                "url"  : "<?php echo base_url();?>laboratorium/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_lformat", "searchable":false, "visible":false },
                      { "data": "nama_tindakan" },
                      { "data": "satuan_lformat", "orderable":false },
                      { "data": "nilai_rujukan_lformat", "orderable":false },
                      { "data": "metode_lformat", "orderable":false }
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
                          $('.modal-body').load('<?php echo base_url('laboratorium/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_lformat']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('laboratorium/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                 {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['barcode_lformat']; 
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('laboratorium/'.$page.'/status/0/'); ?>'+data; //[Modif Disini]
                       } 
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
    });
<?php
}
// ==========================================================================================================
elseif ($page=="daftar_data_asuhan")
{
?>
$(document).ready(function() {
  $('.select2').select2()
  CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );

    $(window).resize(function() {
		$('.select2').css('width', "100%");
	});	
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
    })
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
    })
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
    })
});
<?php
}
elseif ($page=="daftar_data_ps")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-black style="padding-left:50px; ">'+
        '<tr> <td>Kode Daftar:</td><td>'+d.barcode_pendaftaran+'</td></td><td></td><td>Kode Unit:</td><td>'+d.barcode_pendaftaran_unit+'</td> </tr>'+
        '<tr> <td>No Pendaftaran:</td><td>'+d.no_pendaftaran+'</td></td><td></td><td>Tanggal Daftar:</td><td>'+d.tgl_pendaftaran_unit+'</td> </tr>'+
        '<tr> <td>Cara Bayar:</td><td>'+d.nama_bayar+'</td></td><td></td><td>Pengirim:</td><td>'+d.nama_instansi+','+d.nama_dokter+'</td> </tr>'+
        '<tr> <td>Admin:</td><td>'+d.nama_pegawai+'</td></td><td></td><td>Pengirim:</td><td>'+d.perawate+'</td> </tr>'+
        '<tr> <td>Keluhan:</td><td>'+d.keluhan+'</td></td><td></td><td>Keterangan:</td><td>'+d.ket_pendaftaran_unit+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>laboratorium/daftar/histori/<?php echo $first_date;?>",
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
                    { "data": "wkt_daftar_unit", "searchable": false },
                    { "data": "barcode_pendaftaran", "searchable": false },
                    { "data": "nama_unit", "searchable": false },
                    { "data": "keluhan", "searchable": false, "orderable": false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
                if(data['id_nilai_kritis'] > "0"){
                    $(row).css("background-color", "red");
                    $(row).css('color', 'white');
                }
              },
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
/*    setInterval(function () {
		  table.ajax.reload();
		}, 300000);*/
	});
<?php
}
elseif ($page=="daftar_data_penunjang")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-black style="padding-left:50px; ">'+
      	'<tr> <td>Hasil:</td><td>'+d.hasil_pemeriksaan_penunjang+'</td></td><td></td><td>Dokter / Instansi:</td><td>'+d.dokter_pemeriksaan_penunjang+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>laboratorium/daftar/penunjang/<?php echo $first_date;?>",
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
                    { "data": "wkt_daftar", "searchable": false },
                    { "data": "tgl_pemeriksaan_penunjang", "searchable": false },
                    { "data": "nama_tindakan", "searchable": false }
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
/*    setInterval(function () {
		  table.ajax.reload();
		}, 300000);*/
	});
<?php
}
elseif ($page=="daftar_data_radiologi")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-black style="padding-left:50px; ">'+
  '<tr> <td>Hasil Ro:</td><td>'+d.hasil_radiologi_result+'</td> </td><td></td><td>Kesimpulan Ro:</td><td>'+d.kesimpulan_radiologi_result+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>laboratorium/daftar/radiolog/<?php echo $first_date;?>",
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
                    { "data": "wkt_daftar_unit", "searchable": false },
                    { "data": "waktu_radiologi_result", "searchable": false },
                    { "data": "selisih", "searchable": false },
                    { "data": "no_pendaftaran", "orderable": false },
                    { "data": "nama_tindakan", "orderable": false },
                    { "data": "nama_pegawai", "orderable": false },
                      { "data": "id_nilai_kritis",
                        "render": function(data, type, row){
                        	if(row.id_status_pemeriksaan === '3'){
	                           if (row.id_nilai_kritis === '0') {
	                               return '<button class="btn btn-xs btn-success">TIDAK KRITIS</button>';
	                           } else {
	                               return '<button class="btn btn-xs btn-danger">KRITIS</button>';
	                           }
                        	}else{
                        		return '<button class="btn btn-xs btn-info">Belum Baca</button>';
                        	}
                        }
                     },
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
                if(data['id_nilai_kritis'] > "0"){
                    $(row).css("background-color", "red");
                    $(row).css('color', 'white');
                }
              },
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
	});
<?php 
}
elseif ($page=="daftar_data_lab")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-black style="padding-left:50px; ">'+
        '<tr> <td>Kode Daftar:</td><td>'+d.barcode_pendaftaran+'</td></td><td></td><td>Kode Unit:</td><td>'+d.barcode_pendaftaran_unit+'</td> </tr>'+
        '<tr> <td>No Pendaftaran:</td><td>'+d.no_pendaftaran+'</td></td><td></td><td>Tanggal Daftar:</td><td>'+d.tgl_pendaftaran_unit+'</td> </tr>'+
        '<tr> <td>Cara Bayar:</td><td>'+d.nama_bayar+'</td></td><td></td><td>Pengirim:</td><td>'+d.nama_instansi+','+d.nama_dokter+'</td> </tr>'+
        '<tr> <td>Admin:</td><td>'+d.nama_pegawai+'</td></td><td></td><td>Pengirim:</td><td>'+d.perawate+'</td> </tr>'+
        '<tr> <td>Keluhan:</td><td>'+d.keluhan+'</td></td><td></td><td>Keterangan:</td><td>'+d.ket_pendaftaran_unit+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>laboratorium/daftar/hasil_lab_all/<?php echo $first_date;?>",
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
                    { "data": "tgl_pendaftaran_unit", "searchable": false },
                    { "data": "no_pendaftaran", "orderable": false },
                    { "data": "no_pemeriksaan", "orderable": false },
                    { "data": "nama_pegawai", "orderable": false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
                if(data['id_nilai_kritis'] > "0"){
                    $(row).css("background-color", "red");
                    $(row).css('color', 'white');
                }
              },
            "buttons": [
                {
                  text: "<i class='fa fa-search'></i> Lihat Hasil",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pemeriksaan']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('laboratorium/daftar/lab_view/'); ?>'+data,function(){
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
    });
<?php 
}
elseif ($page=="daftar_grafik_vital")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-black style="padding-left:50px; ">'+
        '<tr> <td>No Pendaftaran:</td><td>'+d.no_pendaftaran+'</td></td><td></td><td>Tanggal Daftar:</td><td>'+d.tgl_pendaftaran_unit+'</td> </tr>'+
        '<tr> <td>Cara Bayar:</td><td>'+d.nama_bayar+'</td></td><td></td><td>Pengirim:</td><td>'+d.nama_instansi+','+d.nama_dokter+'</td> </tr>'+
        '<tr> <td>Admin:</td><td>'+d.nama_pegawai+'</td></td><td></td><td>Pemeriksa:</td><td>'+d.perawate+'</td> </tr>'+
        '<tr> <td>Keluhan:</td><td>'+d.keluhan+'</td></td><td></td><td>Keterangan:</td><td>'+d.ket_pendaftaran_unit+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>laboratorium/daftar/sparkling/<?php echo $first_date;?>",
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
                    { "data": "waktu_pemeriksaan_vital_sign", "searchable": false },
                    { "data": "sistole", "orderable": false },
                    { "data": "diastole", "orderable": false },
                    { "data": "rr", "orderable": false },
                    { "data": "nadi", "orderable": false },
                    { "data": "suhu", "orderable": false },
                    { "data": "spo2", "orderable": false }
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
	});
  $(function () {

    $(".sparkline").each(function () {
      var $this = $(this);
      $this.sparkline('html', $this.data());
    });

  });


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
                "url"  : "<?php echo base_url();?>laboratorium/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $key;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pendaftaran_unit", "visible": false, "searchable": false },
                      { "data": "tgl_pendaftaran_unit", "searchable": false },
					  { "data": null, "orderable": false, 
					    "render" : function ( data, type, full ) { 
					    return 'RM : '+full['rm']+' - '+full['nama_pasien']+' [ '+full['umur']+' ] ';
						}
					  },
                       { "data": "no_pendaftaran", "searchable": false },                     
                      { "data": "keluhan", "searchable": false, "orderable": false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-stethoscope'></i> Pemeriksaan",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran_unit'];
	                    location.href = '<?php echo base_url('laboratorium/'.$page.'/tambah/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-file-pdf-o'></i> Print Hasil",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran_unit'];
                        window.open('<?php echo base_url('laboratorium/'.$page.'/pdf_hasil/'); ?>'+data);
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
/*    setInterval(function () {
		  table.ajax.reload();
		}, 300000);*/
	});
<?php
}
elseif ($page=="daftar_hasil")
{
?>
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
                "url"  : "<?php echo base_url();?>laboratorium/daftar/hasil_lab/<?php echo $first_date;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pemeriksaan", "visible": false, "searchable": false },
                      { "data": "tgl_pendaftaran_unit", "searchable": false },
                      { "data": "nama_pegawai", "searchable": false, "orderable": false },
                      { "data": "no_pendaftaran", "searchable": false, "orderable": false },
                      { "data": "no_pemeriksaan", "searchable": false, "orderable": false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-pencil'></i> Isi Hasil",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pemeriksaan']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('laboratorium/daftar/isi_hasil/'); ?>'+data,function(){
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
/*    setInterval(function () {
          table.ajax.reload();
        }, 300000);*/
    });
<?php
}
elseif ($page=="daftar_tambah")
{
?>
function load_pmr() {
  $('.pemeriksaane').load('<?php echo base_url('laboratorium/daftar/pemeriksaane/'); ?><?php echo $first_date; ?>');
}
$(document).ready(function() {
  $('.select2').select2()
    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );
    load_pmr();
});
<?php
}
elseif ($page=="lobby")
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
      return '<table class="table table-striped text-black style="padding-left:50px; ">'+
        '<tr> <td>No KTP:</td><td>'+d.nik+'</td>            <td></td>   <td>RM:</td><td>'+d.rm+'</td> </tr>'+     
      '<tr> <td>Tempat Lahir:</td><td>'+d.tmp_lahir+'</td> <td style="width: 5%"></td><td>Gol Darah:</td><td>'+d.nama_golongan_darah+'</td> </tr>'+
        '<tr> <td>Tanggal Lahir:</td><td>'+d.tgl_lahir+'</td> <td></td><td>Agama:</td><td>'+d.nama_agama+'</td> </tr>'+
        '<tr> <td>Jenis Kelamin:</td><td>'+d.jk+'</td>            <td></td>   <td>No Kontak:</td><td>'+d.telepon+'</td> </tr>'+
        '<tr> <td>Pendidikan:</td><td>'+d.nama_pendidikan+'</td>            <td></td>   <td>Pekerjaan:</td><td>'+d.nama_pekerjaan+'</td> </tr>'+
        '<tr> <td>Marital Status:</td><td>'+d.nama_status_kawin+'</td>            <td></td>   <td>Pasangan:</td><td>'+d.nama_pasangan+'</td> </tr>'+
        '<tr> <td>Ayah:</td><td>'+d.nama_ayah+'</td>            <td></td>   <td>Ibu:</td><td>'+d.nama_ibu+'</td> </tr>'+
        '<tr> <td>NIK Ayah:</td><td>'+d.nik_ayah+'</td>            <td></td>   <td>NIK Ibu:</td><td>'+d.nik_ibu+'</td> </tr>'+
        '<tr> <td>Alamat:</td><td colspan="4">'+d.alamat+'</td> </tr>'+
        '<tr> <td>Propinsi:</td><td>'+d.nama_prov+'</td>            <td></td>   <td>Kota/Kab:</td><td>'+d.nama_kab+'</td> </tr>'+
        '<tr> <td>Kelurahan:</td><td>'+d.nama_kel+'</td>            <td></td>   <td>Kecamatan:</td><td>'+d.nama_kec+'</td> </tr>'+      
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
                "url"  : "<?php echo base_url();?>laboratorium/<?php echo $page;?>/data/<?php echo $id;?>",
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
                      { "data": "id_lobby", "visible": false, "searchable": false },
                      { "data": "waktu_lobby", "searchable": false },
                      { "data": null, "orderable": false, 
                        "render" : function ( data, type, full ) { 
                        return 'RM : '+full['rm']+' - '+full['nama_pasien']+' [ '+full['umur']+' ] ';
                        }
                      },
                      { "data": "nama_bayar", "searchable": false, "orderable": false },
                      { "data": "nama_dokter", "searchable": false, "orderable": false },
                      { "data": "nama_instansi", "searchable": false, "orderable": false },
                      { "data": "keluhan", "searchable": false, "orderable": false },
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "ket_lobby","searchable":false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-stethoscope'></i> Pemeriksaan",
                    extend: "selected",
                    className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        statusps = dt.rows( { selected: true } ).data()[0]['status_lobby'];
                        data = dt.rows( { selected: true } ).data()[0]['barcode_lobby'];
                        if( statusps=='0'){
                            swal({
                              title: "Pemeriksaan Batal",
                              text: "Data Di Batalkan ",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                        else{
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('laboratorium/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });
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
/*    setInterval(function () {
          table.ajax.reload();
        }, 300000);*/
    });
<?php
}
?>
</script>
		</div>
	</body>
</html>
