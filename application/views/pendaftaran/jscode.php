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
elseif ($page=="pasien")
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
'<tr> <td>Gol Darah:</td><td>'+d.nama_golongan_darah+'</td> <td style="width: 5%"></td><td>Agama:</td><td>'+d.nama_agama+'</td> </tr>'+
'<tr> <td>Jenis Kelamin:</td><td>'+d.jk+'</td><td></td><td>No Kontak:</td><td>'+d.telepon+'</td> </tr>'+
'<tr> <td>Pendidikan:</td><td>'+d.nama_pendidikan+'</td><td></td><td>Pekerjaan:</td><td>'+d.nama_pekerjaan+'</td> </tr>'+
'<tr> <td>Marital Status:</td><td>'+d.nama_status_kawin+'</td><td></td><td>Pasangan:</td><td>'+d.nama_pasangan+'</td> </tr>'+
'<tr> <td>Alamat:</td><td colspan="4">'+d.alamat+'</td> </tr>'+
'<tr> <td>Propinsi:</td><td>'+d.nama_prov+'</td><td></td><td>Kota/Kab:</td><td>'+d.nama_kab+'</td> </tr>'+
'<tr> <td>Kelurahan:</td><td>'+d.nama_kel+'</td><td></td><td>Kecamatan:</td><td>'+d.nama_kec+'</td> </tr>'+
'<tr> <td>Waktu Daftar:</td><td>'+d.dibuat+'</td><td></td><td>Admin:</td><td>'+d.nama_pegawai+'</td> </tr>'+
        '</table>';
    }
    $(document).ready(function() {
		$('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"searching": false,
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
                "url"  : "<?php echo base_url();?>pendaftaran/<?php echo $page;?>/data/<?php echo $key;?>",
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
					  { "data": "id_pasien","visible":false },
{ "data": null, "orderable": false, 
"render" : function ( data, type, full ) { 
return 'RM : '+full['rm']+' - NIK : '+full['nik']+' - '+full['nama_pasien']+' TTL : ('+full['tmp_lahir']+', '+full['tgl_lahir']+') - [ '+full['umur']+' ]';
}
},
                      { "data": "data_lain","searchable":false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Pasien Baru",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('pendaftaran/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-user'></i> Daftarkan",
                    extend: "selected",
                    className: "btnlime",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pasien'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('pendaftaran/daftar/tambah/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit Data",
                    extend: "selected",
                    className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pasien'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('pendaftaran/'.$page.'/edit/'); ?>'+data;
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
else if ($page=="pasien_tambah" || $page=="pasien_edit")
{
?>
	var status=0;
    $(document).ready(function() {
		$('.select2').select2()
		$("#nik").on("input", function(e) {
			$('#msg').hide();
			if ($('#nik').val() == null || $('#nik').val() == "") {
				$('#msg').show();
				$("#msg").html("NIK Harus Diisi").css("color", "red");
			} else {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>pendaftaran/check_nik",
					data: $('#signupform').serialize(),
					dataType: "html",
					cache: false,
					success: function(msg) {
						$('#msg').show();
						$("#msg").html(msg);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						$('#msg').show();
						$("#msg").html(textStatus + " " + errorThrown);
					}
				});
			}
		});
	});
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/kab_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
                $("#id_kab").empty();
                $("#id_kec").empty();
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kab"];
                    var name = data[i]["nama_kab"];

                    $("#id_kab").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });

    $('select[name=id_kab]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/kec_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_kec").empty();
                $("#id_kel").empty();

                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kec"];
                    var name = data[i]["nama_kec"];

                    $("#id_kec").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });

    $('select[name=id_kec]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/kel_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_kel").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_kel"];
                    var name = data[i]["nama_kel"];

                    $("#id_kel").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
	$("#tgl_lahir").inputmask("datetime", {
		mask: "1-2-y",
		placeholder: "dd-mm-yyyy",
		leapday: "-02-29",
		separator: "-",
		alias: "dd/mm/yyyy"
	});
	var keycode;
	$('.nospace').keypress(function (event) {
		keycode = (event.charCode) ? event.charCode : ((event.which) ? event.which : event.keyCode);
		if (keycode == 32) {
			return false
		};
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
'<tr> <td>Cara Bayar:</td><td>'+d.nama_cara_bayar+'</td>          <td></td>   <td>Instansi:</td><td>'+d.id_instansi_cara_masuk+'</td> </tr>'+
'<tr> <td>Detil Bayar:</td><td>'+d.detil_cara_bayar+'</td>    <td></td>   <td>Cara Masuk</td><td>'+d.nama_cara_masuk+'</td> </tr>'+
'<tr> <td>Pengirim:</td><td>'+d.id_dokter_rujukan+'</td> </td>        <td></td>   <td>Instansi:</td><td>'+d.id_instansi_cara_masuk+'</td> </tr>'+
'<tr> <td>Keluhan:</td><td>'+d.keluhan+'</td> </td>        <td></td>   <td>Diagnosa:</td><td>'+d.nama_icd10+'</td> </tr>'+
'<tr> <td>ID ICD10:</td><td>'+d.id_icd10+'</td> </td>        <td></td>   <td>Kode ICD10:</td><td>'+d.code_icd10+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>pendaftaran/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $key;?>",
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
                      { "data": "id_pendaftaran", "visible": false, "searchable": false },
                      { "data": "no_pendaftaran", "searchable": false },
                      { "data": "wkt_daftar", "searchable": false },
{ "data": null, "orderable": false, 
"render" : function ( data, type, full ) { 
return 'RM : '+full['rm']+' - NIK : '+full['nik']+' - '+full['nama_pasien']+' TTL : ('+full['tmp_lahir']+', '+full['tgl_lahir']+') - [ '+full['umur']+' ]';
}
},
   
                      { "data": "nama_icd10", "searchable": false, "orderable": false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
                if(data['nama_status_pasien']=="Batal"){
                    $(row).find('td:eq(4)').css('color', 'red');
                }
                else if(data['nama_status_pasien']=="Proses"){
                    $(row).find('td:eq(4)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(4)').css('color', 'blue');
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
                  text: "<i class='fa fa-user-plus'></i> Tambah Pemeriksaan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran_unit'];
						location.href = '<?php echo base_url('pendaftaran/'.$page.'/edit/'); ?>'+data;

                    }
                },                
 /*               {
                  text: "<i class='fa fa-user-plus'></i> Tambah Pemeriksaan",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran'];
                        $("#modal-default").modal();
                          $('.modal-body').load('?php echo base_url('pendaftaran/'.$page.'/send/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-pencil-square'></i> Perbaiki Pendaftaran",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        statusps = dt.rows( { selected: true } ).data()[0]['nama_status_pasien'];
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran_unit'];
                        if( statusps=='Batal'){
                            swal({
                              title: "Pemeriksaan Batal",
                              text: "Data Sudah Tidak Bisa di Edit, Silahkan Tambah ",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                        else{
	                        $("#modal-default").modal();
	                          $('.modal-body').load('?php echo base_url('pendaftaran/'.$page.'/edit/'); ?>'+data,function(){
	                            $('#modal-default').modal({show:true});
	                          });
						}
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Batal",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        statusps = dt.rows( { selected: true } ).data()[0]['nama_status_pasien'];
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran_unit'];
                        isp = dt.rows( { selected: true } ).data()[0]['id_status_pasien'];
                        if( statusps=='Batal'){
                            swal({
                              title: "Pemeriksaan Batal",
                              text: "Data Sudah Tidak Bisa di Edit, Silahkan Tambah ",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                        else{
		                     swal({
		                       title: "Yakin ?",
		                       text: "Yakin akan Membatalkan ",     //[Modif Disini]
		                       icon: "warning",
		                       buttons: true,
		                       dangerMode: true,
		                     })
		                     .then((willDelete) => {
		                       if (willDelete) {
		                         location.href = '?php echo base_url('pendaftaran/'.$page.'/batal/'); ?>'+data+'/'+isp; //[Modif Disini]
		                       }
		                     });
						}
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
else if ($page=="daftar_tambah")
{
?>
$("#input_mask_date_time").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#input_mask_date_time').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
    $(document).ready(function() {
		$('.select2').select2()
 		$('#id_petugas').next(".select2-container").hide();
		$('#id_rujukan_dokter').next(".select2-container").hide();
		$('#id_rujukan_instansi').next(".select2-container").hide();
		$('#ruangan').next(".select2-container").hide();
		$('#pengirim').next(".select2-container").hide();
		$('#no_bpjs').hide();
		$('#labelbpjs').hide();
		$('#labeldokter').hide();
		$('#labelinstansi').hide();
		$('#labelpetugas').hide();
		$('#labelunit').hide();
		$('#labelpengirim').hide();
	});
      $('#nama_icd10').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>pendaftaran/cari_icd10',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_icd10").value = data.data;
            $('#nama_icd10').val(data.nama);
            $('#id_icd10').val(data.data);
            status=1;
        }
      });
    $('select[name=id_jabatan]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/pegawai_daftar/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_pegawai").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_pegawai"];
                    var name = data[i]["nama_pegawai"];

                    $("#id_pegawai").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
    $('select[name=id_cara_bayar]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/cara_bayar_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_detil_cara_bayar").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_detil_cara_bayar"];
                    var name = data[i]["nama_detil_cara_bayar"];

                    $("#id_detil_cara_bayar").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
    $('select[name=id_cara_masuk]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/cara_rujukan_instansi/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_rujukan_instansi").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_rujukan_instansi"];
                    var name = data[i]["nama_rujukan_instansi"];

                    $("#id_rujukan_instansi").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
    $('select[name=id_cara_masuk]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/rujukan_dokter_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_rujukan_dokter").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_rujukan_dokter"];
                    var name = data[i]["nama_rujukan_dokter"];

                    $("#id_rujukan_dokter").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
    $('select[name=id_cara_masuk]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/unit_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#ruangan").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_unit"];
                    var name = data[i]["nama_unit"];

                    $("#ruangan").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
    $('select[name=id_cara_masuk]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/pengirim_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#pengirim").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_pegawai"];
                    var name = data[i]["nama_pegawai"];

                    $("#pengirim").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
 	$('#id_cara_bayar').change(function () {
		if ($('#id_cara_bayar').val() == 6) {
			$('#id_petugas').next(".select2-container").show();
			$("#id_petugas").val("0").trigger("change");
			$('#labelpetugas').show();
			$('#labelbpjs').hide();
			$('#no_bpjs').hide();
		}
		else if ($('#id_cara_bayar').val() == 2){
			$('#id_petugas').next(".select2-container").hide();
			$("#id_petugas").val("0").trigger("change");
			$('#labelpetugas').hide();
			$('#labelbpjs').show();
			$('#no_bpjs').show();
		}
		else {
			$('#id_petugas').next(".select2-container").hide();
			$("#id_petugas").val("0").trigger("change");
			$('#labelpetugas').hide();
			$('#labelbpjs').hide();
			$('#no_bpjs').hide();
		}
	});
	$('#id_cara_masuk').change(function () {
		if ($('#id_cara_masuk').val() == '1') { // datang sendiri
			$('#id_rujukan_dokter').next(".select2-container").hide();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$('#labeldokter').hide();
			$('#labelinstansi').hide();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_rujukan_dokter").val("0").trigger("change");
			$("#ruangan").val("0").trigger("change");
			$("#pengirim").val("0").trigger("change");
		}else if ($('#id_cara_masuk').val() == '2') { // dokter praktek
			$('#id_rujukan_dokter').next(".select2-container").show();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$('#labeldokter').show();
			$('#labelinstansi').hide();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_rujukan_dokter").val("0").trigger("change");
			$("#ruangan").val("0").trigger("change");
			$("#pengirim").val("0").trigger("change");
		}else if ($('#id_cara_masuk').val() == '6') { // bidan
			$('#id_rujukan_dokter').next(".select2-container").show();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_rujukan_dokter").val("0").trigger("change");
			$("#ruangan").val("0").trigger("change");
			$("#pengirim").val("0").trigger("change");
			$('#labelinstansi').hide();
			$('#labeldokter').show();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
		}else if ($('#id_cara_masuk').val() == '7') { //internal
			$('#id_rujukan_dokter').next(".select2-container").hide();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").show();
			$('#pengirim').next(".select2-container").show();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_rujukan_dokter").val("0").trigger("change");
			$('#labelinstansi').hide();
			$('#labeldokter').hide();
			$('#labelunit').show();
			$('#labelpengirim').show();

		}
		else {
			$('#id_rujukan_dokter').next(".select2-container").show();
			$('#id_rujukan_instansi').next(".select2-container").show();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_rujukan_dokter").val("0").trigger("change");
			$("#ruangan").val("0").trigger("change");
			$("#pengirim").val("0").trigger("change");
			$('#labeldokter').show();
			$('#labelinstansi').show();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
		}
	});
    $("#gonobpjs").click(function(e){
        $("#responnobpjs").val('');
        
        $.ajax({
        url : "<?php echo base_url('pendaftaran/get_nokartu');?>",
        method : "POST",
        data : {nokartu: $("#nokartu").val()},
        dataType : 'json',
        success: function(data){
            var dataResult = JSON.stringify(data, undefined, 4);
            $("#responnobpjs").val(dataResult);
        }
        });
    });
    $("#gonik").click(function(e){
        $("#responnik").val('');
        
        $.ajax({
        url : "<?php echo base_url('pendaftaran/get_nik');?>",
        method : "POST",
        data : {nokartu: $("#nik").val()},
        dataType : 'json',
        success: function(data){
            var dataResult = JSON.stringify(data, undefined, 4);
            $("#responnik").val(dataResult);
        }
        });
    });
<?php
}
elseif ($page=="daftar_edit")
{
?>
function load_pmr() {
  $('.pemeriksaane').load('<?php echo base_url('pendaftaran/daftar/pemeriksaane/'); ?><?php echo $first_date; ?>');
}
$(document).ready(function() {
  $('.select2').select2()
    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
    } );
	load_pmr();
/*	$(window).scroll(function(){
	    
	    var position = $(window).scrollTop();
	    var bottom = $(document).height() - $(window).height();

	    if( position == bottom ){

	        var row = Number($('#row').val());
	        var allcount = Number($('#all').val());
	        var rowperpage = 3;
	        row = row + rowperpage;

	        if(row <= allcount){
	            $('#row').val(row);
	            $.ajax({
	                url:'echo base_url();?>ugd/ambil_data_rm/echo $rm;?>',
	                type: 'post',
	                data: {row:row},
	                success: function(response){
	                    $(".post:last").after(response).show().fadeIn("slow");
	                }
	            });
	        }
	    }

	});*/
});
<?php
}
else if ($page=="daftar_edit2")
{
?>
$("#input_mask_date_time").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#input_mask_date_time').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
    $(document).ready(function() {
		$('.select2').select2()
		if ($('#id_cara_bayar').val() == '6') {
			$('#id_petugas').next(".select2-container").show();
			$('#labelpetugas').show();
		}
		else {
			$('#id_petugas').next(".select2-container").hide();
			$('#labelpetugas').hide();
		}
		if ($('#id_cara_masuk').val() == '1') {
			$('#id_dokter_rujukan').next(".select2-container").hide();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$('#labeldokter').hide();
			$('#labelinstansi').hide();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
		}else if ($('#id_cara_masuk').val() == '2') {
			$('#id_dokter_rujukan').next(".select2-container").show();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$('#labeldokter').show();
			$('#labelinstansi').hide();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
		}else if ($('#id_cara_masuk').val() == '6') {
			$('#id_dokter_rujukan').next(".select2-container").show();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$('#labelinstansi').hide();
			$('#labeldokter').show();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
		}else if ($('#id_cara_masuk').val() == '7') { //internal
			$('#id_dokter_rujukan').next(".select2-container").hide();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").show();
			$('#pengirim').next(".select2-container").show();
			$('#labelinstansi').hide();
			$('#labeldokter').hide();
			$('#labelunit').show();
			$('#labelpengirim').show();

		}
		else {
			$('#id_dokter_rujukan').next(".select2-container").show();
			$('#id_rujukan_instansi').next(".select2-container").show();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$('#labeldokter').show();
			$('#labelinstansi').show();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
		}
	});
    $('select[name=id_cara_bayar]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/cara_bayar_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_detil_cara_bayar").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_detil_cara_bayar"];
                    var name = data[i]["nama_detil_cara_bayar"];

                    $("#id_detil_cara_bayar").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
    $('select[name=id_cara_masuk]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/cara_rujukan_instansi/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_rujukan_instansi").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_rujukan_instansi"];
                    var name = data[i]["nama_rujukan_instansi"];

                    $("#id_rujukan_instansi").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
    $('select[name=id_cara_masuk]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/rujukan_dokter_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_dokter_rujukan").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_rujukan_dokter"];
                    var name = data[i]["nama_rujukan_dokter"];

                    $("#id_dokter_rujukan").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
    $('select[name=id_cara_masuk]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/unit_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#ruangan").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_unit"];
                    var name = data[i]["nama_unit"];

                    $("#ruangan").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
    $('select[name=id_cara_masuk]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>pendaftaran/pengirim_data/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#pengirim").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_pengirim"];
                    var name = data[i]["nama_pengirim"];

                    $("#pengirim").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
	$('#id_cara_bayar').change(function () {
		if ($('#id_cara_bayar').val() == '6') {
			$('#id_petugas').next(".select2-container").show();
			$("#id_petugas").val("0").trigger("change");
			$('#labelpetugas').show();
		}
		else {
			$('#id_petugas').next(".select2-container").hide();
			$("#id_petugas").val("0").trigger("change");
			$('#labelpetugas').hide();
		}
	});
	$('#id_cara_masuk').change(function () {
		if ($('#id_cara_masuk').val() == '1') { // datang sendiri
			$('#id_dokter_rujukan').next(".select2-container").hide();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$('#labeldokter').hide();
			$('#labelinstansi').hide();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_dokter_rujukan").val("0").trigger("change");
			$("#ruangan").val("0").trigger("change");
			$("#pengirim").val("0").trigger("change");
		}else if ($('#id_cara_masuk').val() == '2') { // dokter praktek
			$('#id_dokter_rujukan').next(".select2-container").show();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$('#labeldokter').show();
			$('#labelinstansi').hide();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_dokter_rujukan").val("0").trigger("change");
			$("#ruangan").val("0").trigger("change");
			$("#pengirim").val("0").trigger("change");
		}else if ($('#id_cara_masuk').val() == '6') { // bidan
			$('#id_dokter_rujukan').next(".select2-container").show();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_dokter_rujukan").val("0").trigger("change");
			$("#ruangan").val("0").trigger("change");
			$("#pengirim").val("0").trigger("change");
			$('#labelinstansi').hide();
			$('#labeldokter').show();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
		}else if ($('#id_cara_masuk').val() == '7') { //internal
			$('#id_dokter_rujukan').next(".select2-container").hide();
			$('#id_rujukan_instansi').next(".select2-container").hide();
			$('#ruangan').next(".select2-container").show();
			$('#pengirim').next(".select2-container").show();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_dokter_rujukan").val("0").trigger("change");
			$('#labelinstansi').hide();
			$('#labeldokter').hide();
			$('#labelunit').show();
			$('#labelpengirim').show();

		}
		else {
			$('#id_dokter_rujukan').next(".select2-container").show();
			$('#id_rujukan_instansi').next(".select2-container").show();
			$('#ruangan').next(".select2-container").hide();
			$('#pengirim').next(".select2-container").hide();
			$("#id_rujukan_instansi").val("0").trigger("change");
			$("#id_dokter_rujukan").val("0").trigger("change");
			$("#ruangan").val("0").trigger("change");
			$("#pengirim").val("0").trigger("change");
			$('#labeldokter').show();
			$('#labelinstansi').show();
			$('#labelunit').hide();
			$('#labelpengirim').hide();
		}
	});
<?php
}
else if ($page=="daftar_tes")
{
?>
function addInputField(t) {
    var row = $("#normalinvoice tbody tr").length;
    var count = row + 1;
    var limits = 500;
     var taxnumber = $("#txfieldnum").val();
    var tbfild ='';
    for(var i=0;i<taxnumber;i++){
        var taxincrefield = '<input id="total_tax'+i+'_'+count+'" class="total_tax'+i+'_'+count+'" type="hidden"><input id="all_tax'+i+'_'+count+'" class="total_tax'+i+'" type="hidden" name="tax[]">';
         tbfild +=taxincrefield;
    }
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name_" + count,
            tabindex = count * 5,
            e = document.createElement("tr"),
            tab1 = tabindex + 1,
            tab2 = tabindex + 2,
            tab3 = tabindex + 3,
            tab4 = tabindex + 4,
            tab5 = tabindex + 5,
            tab6 = tabindex + 6,
            tab7 = tabindex + 7,
            tab8 = tabindex + 8,
            tab9 = tabindex + 9,
            tab10 = tabindex + 10,
            tab11 = tabindex + 11;
        e.innerHTML = "<td><input type='text' name='product_name' onkeyup='invoice_productList(" + count + ")' onkeypress='invoice_productList(" + count + ")' class='form-control productSelection' placeholder='Medicine Name' id='" + a + "' required tabindex='"+tab1+"'><input type='hidden' class='autocomplete_hidden_value  product_id_" + count + "' name='product_id[]' id='product_id_" + count + "'/></td><td><select class='form-control' required id='batch_id_" + count + "'  name='batch_id[]' onchange='product_stock(" + count + ")' tabindex='"+tab2+"'><option></option></select>     <td><input type='text' name='available_quantity[]' id='available_quantity_" + count + "' class='form-control text-right available_quantity_" + count + "' value='0' readonly='readonly' /></td> <td id='expire_date_" + count + "'></td><td><input class='form-control text-right unit_" + count + " valid' value='None' readonly='' aria-invalid='false' type='text'></td><td> <input type='text' name='product_quantity[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='total_qntt_" + count + " form-control text-right allownumericwithdecimal' placeholder='0.00' min='0' tabindex='"+tab3+"' required/></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' class='price_item"+count+" form-control text-right allownumericwithdecimal' required placeholder='0.00' readonly min='0' tabindex='"+tab4+"'/></td><td><input type='text' name='discount[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right allownumericwithdecimal' placeholder='0.00' min='0' tabindex='"+tab5+"' /><input type='hidden' value='' name='discount_type' id='discount_type_" + count + "'></td><td class='text-right'><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' readonly='readonly'/></td><td>" + tbfild + "<input type='hidden' id='all_discount_" + count + "' class='total_discount dppr'/><a tabindex='"+tab6+"' style='text-align: right;' class='btn btn-danger'  value='Delete' onclick='deleteRow(this)'><i class='fa fa-close'></i></a></td>", 
        document.getElementById(t).appendChild(e), 
        document.getElementById(a).focus(),
        document.getElementById("add_invoice_item").setAttribute("tabindex", tab7);
        document.getElementById("invdcount").setAttribute("tabindex", tab8);
         document.getElementById("paidAmount").setAttribute("tabindex", tab9);
        document.getElementById("full_paid_tab").setAttribute("tabindex", tab10);
        document.getElementById("add_invoice").setAttribute("tabindex", tab11);
        count++
    }
}
<?php
}
else if ($page=="diagnosa")
{
?>
    $("#go").click(function(e){
        $("#respon").val('');
        
        $.ajax({
        url : "<?php echo base_url('pendaftaran/get_diagnosa');?>",
        method : "POST",
        data : {diagnosa: $("#diagnosa").val()},
        dataType : 'json',
        success: function(data){
            var dataResult = JSON.stringify(data, undefined, 4);
            $("#respon").val(dataResult);
        }
        });
    });
<?php
}
else if ($page=="poli")
{
?>
    $("#go").click(function(e){
        $("#respon").val('');
        
        $.ajax({
        url : "<?php echo base_url('pendaftaran/get_poli');?>",
        method : "POST",
        data : {poli: $("#poli").val()},
        dataType : 'json',
        success: function(data){
            var dataResult = JSON.stringify(data, undefined, 4);
            $("#respon").val(dataResult);
        }
        });
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
                "url"  : "<?php echo base_url();?>pendaftaran/daftar/radiolog/<?php echo $first_date;?>",
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
                "url"  : "<?php echo base_url();?>pendaftaran/daftar/hasil_lab_all/<?php echo $first_date;?>",
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
                          $('.modal-body').load('<?php echo base_url('pendaftaran/daftar/lab_view/'); ?>'+data,function(){
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
                "url"  : "<?php echo base_url();?>pendaftaran/daftar/sparkling/<?php echo $first_date;?>",
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
                "url"  : "<?php echo base_url();?>pendaftaran/daftar/histori/<?php echo $first_date;?>",
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
                    { "data": "no_pendaftaran", "searchable": false },
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
                  text: "<i class='fa fa-search'></i> lihat Riwayat",
                  extend: "selected",
                  className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran_unit']; 
						window.open('<?php echo base_url('pendaftaran/daftar/data_ps/'); ?>'+data);
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
                "url"  : "<?php echo base_url();?>pendaftaran/daftar/penunjang/<?php echo $first_date;?>",
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
elseif ($page=="billing")
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
                "url"  : "<?php echo base_url();?>pendaftaran/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pendaftaran", "visible": false, "searchable": false },
                      { "data": "no_pendaftaran", "searchable": false },
                      { "data": "wkt_daftar", "searchable": false },
					  { "data": null, "orderable": false, 
					    "render" : function ( data, type, full ) { 
					    return 'RM : '+full['rm']+' - '+full['nama_pasien']+' [ '+full['umur']+' ] ';
						}
					  },
                      { "data": "id_instansi_cara_masuk", "searchable": false, "orderable": false },
                      { "data": "id_dokter_rujukan", "searchable": false, "orderable": false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-money'></i> Rincian Billing",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('pendaftaran/billing/lihats/'); ?>'+data;
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
elseif ($page=="billing_lihats")
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
                "url"  : "<?php echo base_url();?>pendaftaran/billing/lihat/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_billing", "visible": false, "searchable": false },
                      { "data": "wkt_pemeriksaan", "searchable": false },
                      { "data": "nama_unit", "searchable": false, "orderable": false },
                      { "data": "nama_tindakan", "searchable": false, "orderable": false },
                      { "data": "nama_status_pasien", "searchable": false, "orderable": false },
                      { "data": "nama_cara_bayar", "searchable": false, "orderable": false },
                      { "data": "nama_detil_cara_bayar", "searchable": false, "orderable": false },
                      { "data": "nominal_billing", "searchable": false, "orderable": false, className: "text-right" },
                      { "data": "jml_billing", "searchable": false, "orderable": false, className: "text-right" },
                      { "data": "total_billing", "searchable": false, "orderable": false, className: "text-right" }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
                if(data['nama_status_pasien']=="Batal"){
                    $(row).find('td:eq(3)').css('color', 'red');
                }
                else if(data['nama_status_pasien']=="Selesai"){
                    $(row).find('td:eq(3)').css('color', 'Green');
                }
                else if(data['nama_status_pasien']=="Proses"){
                    $(row).find('td:eq(3)').css('color', 'yellow');
                }
                else {
                    $(row).find('td:eq(3)').css('color', 'blue');
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
                    text: "<i class='fa fa-pencil-square'></i> Perbaiki Pendaftaran",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        statusps = dt.rows( { selected: true } ).data()[0]['nama_status_pasien'];
                        data = dt.rows( { selected: true } ).data()[0]['barcode_billing'];
                        if( statusps=='Batal'){
                            swal({
                              title: "Pemeriksaan Batal",
                              text: "Data Sudah Tidak Bisa di Edit, Silahkan Tambah ",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                        else{
	                        $("#modal-default").modal();
	                          $('.modal-body').load('<?php echo base_url('pendaftaran/billing/edit/'); ?>'+data+'/<?php echo $id;?>',function(){
	                            $('#modal-default').modal({show:true});
	                          });
						}
                    }
                },
              {
                text: "<i class='fa fa-file-pdf-o'></i> Print Billing",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['barcode_pendaftaran'];
                  //    if(data !== null && data !== ''){                     
                   //     data2 = dt.rows( { selected: true } ).data()[0]['barcode_radiologi_result']; 
                        window.open('<?php echo base_url('pendaftaran/billing/pdf_hasil/'); ?>'+data);
                  //    }
/*                      else{
                          swal({
                            title: "HASIL BELUM DIBACA",
                            text: "SILAHKAN HUBUNGI RADIOLOG",
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
?>
</script>
		</div>
	</body>
</html>
