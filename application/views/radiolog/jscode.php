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
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
    '<tr> <td>Hasil:</td><td>'+d.hasil_pemeriksaan_format+'</td></tr>'+
    '<tr> <td>Kesimpulan:</td><td>'+d.kesimpulan_pemeriksaan_format+'</td> </tr>'+
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
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
			"scrollX": true, 
            "ajax": {
                "url"  : "<?php echo base_url();?>radiolog/<?php echo $page;?>/data",
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
                      { "data": "id_pemeriksaan_format", "searchable":false, "visible":false },
                      { "data": "nama_tindakan" },
                      { "data": "nama_pemeriksaan_format", "orderable":false }
            ],
            "order": [[1, 'desc']] ,
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
                          $('.modal-body').load('<?php echo base_url('radiolog/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pemeriksaan_format']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('radiolog/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                 {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pemeriksaan_format']; 
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('radiolog/'.$page.'/status/0/'); ?>'+data; //[Modif Disini]
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
// ==========================================================================================================
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
                "url"  : "<?php echo base_url();?>radiolog/daftar/hasil_lab_all/<?php echo $first_date;?>",
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
                          $('.modal-body').load('<?php echo base_url('radiolog/daftar/lab_view/'); ?>'+data,function(){
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
        '<tr> <td>Ket PU:</td><td>'+d.ket_pendaftaran_unit+'</td></td><td></td><td>Ket PMR:</td><td>'+d.ket_pemeriksaan+'</td> </tr>'+
        '<tr> <td>ID ICD10:</td><td>'+d.id_icd10+'</td> </td><td></td><td>Kode ICD10:</td><td>'+d.code_icd10+'</td> </tr>'+
        '<tr> <td>Keluhan:</td><td>'+d.keluhan+'</td> </td><td></td><td>ICD10:</td><td>'+d.nama_icd10+'</td> </tr>'+
        '<tr> <td>Hasil Ro:</td><td>'+d.hasil_radiologi_result+'</td> </td><td></td><td>Kesimpulan Ro:</td><td>'+d.kesimpulan_radiologi_result+'</td> </tr>'+
        '<tr> <td>Ket V Sign:</td><td>'+d.ket_pemeriksaan_vital_sign+'</td> </td><td></td><td>Status Kritis:</td><td>'+d.nilai_kritis+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>radiolog/daftar/histori/<?php echo $first_date;?>",
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
                "url"  : "<?php echo base_url();?>radiolog/daftar/penunjang/<?php echo $first_date;?>",
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
                "url"  : "<?php echo base_url();?>radiolog/daftar/radiolog/<?php echo $first_date;?>",
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
                    { "data": "waktu_radiologi_result", "searchable": false },
                    { "data": "barcode_radiologi_result", "orderable": false },
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
elseif ($page=="daftar_grafik_vital")
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
                "url"  : "<?php echo base_url();?>radiolog/daftar/sparkling/<?php echo $first_date;?>",
                "type" : "POST"
            },
            "columns": [
                    { "data": "waktu_pemeriksaan_vital_sign", "searchable": false },
                    { "data": "sistole", "orderable": false },
                    { "data": "diastole", "orderable": false },
                    { "data": "rr", "orderable": false },
                    { "data": "nadi", "orderable": false },
                    { "data": "suhu", "orderable": false },
                    { "data": "spo2", "orderable": false }
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
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);
	});
	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-black style="padding-left:50px; ">'+
        '<tr> <td>Ket Pendaftaran:</td><td>'+d.ket_pendaftaran_unit+'</td> </td><td></td>   <td>Ket PMR:</td><td>'+d.ket_pemeriksaan+'</td> </tr>'+
        '<tr> <td>ID ICD10:</td><td>'+d.id_icd10+'</td> </td>        <td></td>   <td>Kode ICD10:</td><td>'+d.code_icd10+'</td> </tr>'+
        '<tr> <td>ICD10:</td><td>'+d.nama_icd10+'</td> </td>        <td></td>   <td>No:</td><td>'+d.no_pemeriksaan+'</td> </tr>'+
        '<tr> <td>Hasil:</td><td>'+d.hasil_radiologi_result+'</td> </td>        <td></td>   <td>Kesimpulan:</td><td>'+d.kesimpulan_radiologi_result+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>radiolog/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $key;?>",
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
                      { "data": "id_radiologi_result", "visible": false, "searchable": false },
                      { "data": "tgl_pendaftaran_unit", "searchable": false },
					  { "data": null, "orderable": false, 
					    "render" : function ( data, type, full ) { 
					    return 'RM : '+full['rm']+' - '+full['nama_pasien']+' [ '+full['umur']+' ] ';
						}
					  },
                      { "data": "nama_tindakan", "searchable": false, "orderable": false },
                      { "data": "keluhan","searchable":false, "orderable": false  },
                      { "data": "nama_working","searchable":false },
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
                  text: "<i class='fa fa-user-md'></i> Baca Hasil",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_radiologi_result'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('radiolog/'.$page.'/read/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-stethoscope'></i> E Rekam Medis",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran_unit'];
	                    location.href = '<?php echo base_url('radiolog/'.$page.'/data_radiologi/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-file-pdf-o'></i> Print Hasil Radiologi",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['hasil_radiologi_result'];
                      if(data !== null && data !== ''){                     
                        data2 = dt.rows( { selected: true } ).data()[0]['barcode_radiologi_result']; 
                        window.open('<?php echo base_url('radiolog/'.$page.'/pdf_hasil/'); ?>'+data2);
                      }
                      else{
                          swal({
                            title: "HASIL BELUM DIBACA",
                            text: "SILAHKAN HUBUNGI RADIOLOG",
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
/*    setInterval(function () {
		  table.ajax.reload();
		}, 300000);*/
	});
<?php
}
elseif ($page=="daftar_tambah")
{
?>
/*$(document).ready(function() {
  $('.select2').select2()
	$('#id_radiologi_normal').on('change', function(){
		inputValue = document.getElementById("id_radiologi_normal").value;
		$('.awaktextarea').load('?php echo base_url('radiolog/tabel_daftar/format_hasil_awal_clicked/'); ?>'+inputValue);
	});
	$('.awaktextarea').load('?php echo base_url('radiolog/tabel_daftar/format_hasil_awal'); ?>');

    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );
});*/
function load_pmr() {
  $('.pemeriksaane').load('<?php echo base_url('radiolog/daftar/pemeriksaane'); ?>');
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
?>
</script>
		</div>
	</body>
</html>
