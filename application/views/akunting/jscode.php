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
//================================================= INSTANSI =================================================
else if ($page=="transaksi")  
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
		$('.select2').select2();
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
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
                "url"  : "<?php echo base_url();?>akunting/<?php echo $page;?>/data/<?php echo $date;?>/<?php echo $first_date;?>/<?php echo $last_date;?>",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_transaksi","searchable":false },
                      { "data": "tgl_transaksi","searchable":false },
					  { "data": "no_transaksi" },
					  { "data": "nama_jenis_jurnal" },
					  { "data": "nama_unit","searchable":false },
                      { "data": "nama_dk","searchable":false },
                      { "data": "ket_transaksi","searchable":false,"orderable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_transaksi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('akunting/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-search'></i> Lihat",
                  extend: "selected",
                  className: "btnlime",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_transaksi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('akunting/'.$page.'/lihat/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Saldo Awal",
                    className: "btnaqua",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('akunting/saldo_awal/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Jurnal",
                    className: "btnnavy",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('akunting/jurnal/tambah'); ?>';
                    }
                },	
                {
                    text: "<i class='fa fa-plus'></i> Kas Masuk",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('akunting/kas_masuk/tambah'); ?>';
                    }
                },	
                {
                    text: "<i class='fa fa-plus'></i> Kas Keluar",
                    className: "btnolive",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('akunting/kas_keluar/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Bank Masuk",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('akunting/bank_masuk/tambah'); ?>';
                    }
                },	
                {
                    text: "<i class='fa fa-plus'></i> Bank Keluar",
                    className: "btnpurple",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('akunting/bank_keluar/tambah'); ?>';
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
<?php
}
elseif ( $page=="jurnal_tambah" )  
{
?>
$(document).ready(function() {
	  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
	  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());	
	$('.select2').select2();
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	 $(document).on('click', '.add', function(){
		  var html = '';
		  html += '<tr>';
		  html += '<td><select name="id_coa[]" required="required" class="select_coa form-control select2"><option value="">Pilih Rekening</option></select></td>';
		  html += '<td><input type="text" name="td_debet[]" id="td_debet" value="0" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Nominal Transaksi"/></td>';
		  html += '<td><input type="text" name="td_kredit[]" id="td_kredit" value="0" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Nominal Transaksi"/></td>';
		  html += '<td><input type="text" name="kurs_mata_uang[]" value="1" class="kurs_mata_uang form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Kurs Transaksi"/></td>';
		  html += '<td><select name="id_mata_uang[]" required="required" id="id_mata_uang" class="select_kurs form-control select2"><option value="">Mata Uang</option></select></td>';
		  html += '<td><input type="text" name="ket_transaksi_detil[]" class="form-control" placeholder="Keterangan Transaksi"/></td>';
		  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
		  $('#item_table').append(html); 
		  $('.select2').select2(); 		 
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	});
	$(document).on('click', '.remove', function(){
		  $(this).closest('tr').remove();
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
			if( $('#totaldebet').val() == $('#totalkredit').val() ) {
				$('.setuju').attr('disabled', false);
			}
			else {
				$('.setuju').attr('disabled', true);
			}

	}); 
	$('#item_table').keyup(function(event) {
		if (event.target.classList.contains("inputnumber")) {
		  // remove any commas from earlier formatting
		  const value = event.target.value.replace(/,/g, '');
		  // try to convert to an integer
		  const parsed = parseInt(value);
		  // check if the integer conversion worked and matches the expected value
		  if (!isNaN(parsed) && parsed == value) {
			// update the value
			event.target.value = new Intl.NumberFormat('en-US').format(value);
		  }
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
			if( $('#totaldebet').val() == $('#totalkredit').val() ) {
				$('.setuju').attr('disabled', false);
			}
			else {
				$('.setuju').attr('disabled', true);
			}
		}
	});
});
    $('#tgl_transaksi').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_transaksi").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
	$.fn.fonkTopladeb = function() {
	var sumdebet = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumdebet += deger;
	});document.getElementById('totaldebet').value = sumdebet.toLocaleString('en-US');
	//return sumdebet;
	};
	$.fn.fonkToplakre = function() {
	var sumkredit = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumkredit += deger;
	});document.getElementById('totalkredit').value = sumkredit.toLocaleString('en-US');
	//return sumkredit;
	};
	function fonkDeger(veri) {
		veri=veri.replace(/\,/g,'');
		return (veri != '') ? parseInt(veri) : 0;
	}
<?php
}
elseif ( $page=="kas_masuk_tambah" )  
{
?>
$(document).ready(function() {
	  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
	  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
	$('.select2').select2();
		  $(".select_kas").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_kas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_nokas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });	
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	 $(document).on('click', '.add', function(){
		  var html = '';
		  html += '<tr>';
		  html += '<td><select name="id_coa[]" required="required" class="select_coa form-control select2"><option value="">Pilih Rekening</option></select></td>';
		  html += '<td><input type="text" name="td_kredit[]" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Nominal Transaksi"/><input type="hidden" name="td_debet[]" value="0" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Nominal Transaksi"/></td>';
		  html += '<td><input type="text" name="kurs_mata_uang[]" value="1" class="kurs_mata_uang form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Kurs Transaksi"/></td>';
		  html += '<td><select name="id_mata_uang[]" required="required" id="id_mata_uang" class="select_kurs form-control select2"><option value="">Mata Uang</option></select></td>';
		  html += '<td><input type="text" name="ket_transaksi_detil[]" class="form-control" placeholder="Keterangan Transaksi"/></td>';
		  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
		  $('#table_ini').append(html); 
		  $('.select2').select2(); 		 
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_nokas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	});
	$(document).on('click', '.remove', function(){
		  $(this).closest('tr').remove();
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
	}); 
	$('#item_table').keyup(function(event) {
		if (event.target.classList.contains("inputnumber")) {
		  // remove any commas from earlier formatting
		  const value = event.target.value.replace(/,/g, '');
		  // try to convert to an integer
		  const parsed = parseInt(value);
		  // check if the integer conversion worked and matches the expected value
		  if (!isNaN(parsed) && parsed == value) {
			// update the value
			event.target.value = new Intl.NumberFormat('en-US').format(value);
		  }
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
		}
	});
});
    $('#tgl_transaksi').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_transaksi").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
	$.fn.fonkTopladeb = function() {
	var sumdebet = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumdebet += deger;
	});//document.getElementById('totaldebet').value = sumdebet.toLocaleString('en-US');
	//return sumdebet;
	};
	$.fn.fonkToplakre = function() {
	var sumkredit = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumkredit += deger;
	});document.getElementById('totalkredit').value = sumkredit.toLocaleString('en-US');
	 $('#total').val($('#totalkredit').val());
	//return sumkredit;
	};
	function fonkDeger(veri) {
		veri=veri.replace(/\,/g,'');
		return (veri != '') ? parseInt(veri) : 0;
	}
<?php
}
elseif ( $page=="kas_keluar_tambah" )  
{
?>
$(document).ready(function() {
	  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
	  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
	$('.select2').select2();
		  $(".select_kas").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_kas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_nokas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });	
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	 $(document).on('click', '.add', function(){
		  var html = '';
		  html += '<tr>';
		  html += '<td><select name="id_coa[]" required="required" class="select_coa form-control select2"><option value="">Pilih Rekening</option></select></td>';
		  html += '<td><input type="text" name="td_kredit[]" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Nominal Transaksi"/><input type="hidden" name="td_debet[]" value="0" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Nominal Transaksi"/></td>';
		  html += '<td><input type="text" name="kurs_mata_uang[]" value="1" class="kurs_mata_uang form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Kurs Transaksi"/></td>';
		  html += '<td><select name="id_mata_uang[]" required="required" id="id_mata_uang" class="select_kurs form-control select2"><option value="">Mata Uang</option></select></td>';
		  html += '<td><input type="text" name="ket_transaksi_detil[]" class="form-control" placeholder="Keterangan Transaksi"/></td>';
		  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
		  $('#table_ini').append(html); 
		  $('.select2').select2(); 		 
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_nokas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	});
	$(document).on('click', '.remove', function(){
		  $(this).closest('tr').remove();
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
	}); 
	$('#item_table').keyup(function(event) {
		if (event.target.classList.contains("inputnumber")) {
		  // remove any commas from earlier formatting
		  const value = event.target.value.replace(/,/g, '');
		  // try to convert to an integer
		  const parsed = parseInt(value);
		  // check if the integer conversion worked and matches the expected value
		  if (!isNaN(parsed) && parsed == value) {
			// update the value
			event.target.value = new Intl.NumberFormat('en-US').format(value);
		  }
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
		}
	});
});
    $('#tgl_transaksi').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_transaksi").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
	$.fn.fonkTopladeb = function() {
	var sumdebet = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumdebet += deger;
	});//document.getElementById('totaldebet').value = sumdebet.toLocaleString('en-US');
	//return sumdebet;
	};
	$.fn.fonkToplakre = function() {
	var sumkredit = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumkredit += deger;
	});document.getElementById('totalkredit').value = sumkredit.toLocaleString('en-US');
	 $('#total').val($('#totalkredit').val());
	//return sumkredit;
	};
	function fonkDeger(veri) {
		veri=veri.replace(/\,/g,'');
		return (veri != '') ? parseInt(veri) : 0;
	}
<?php
}
elseif ( $page=="bank_masuk_tambah" )  
{
?>
$(document).ready(function() {
	  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
	  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
	$('.select2').select2();
		  $(".select_kas").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_bank',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_nokas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });	
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	 $(document).on('click', '.add', function(){
		  var html = '';
		  html += '<tr>';
		  html += '<td><select name="id_coa[]" required="required" class="select_coa form-control select2"><option value="">Pilih Rekening</option></select></td>';
		  html += '<td><input type="text" name="td_kredit[]" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Nominal Transaksi"/><input type="hidden" name="td_debet[]" value="0" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Nominal Transaksi"/></td>';
		  html += '<td><input type="text" name="kurs_mata_uang[]" value="1" class="kurs_mata_uang form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Kurs Transaksi"/></td>';
		  html += '<td><select name="id_mata_uang[]" required="required" id="id_mata_uang" class="select_kurs form-control select2"><option value="">Mata Uang</option></select></td>';
		  html += '<td><input type="text" name="ket_transaksi_detil[]" class="form-control" placeholder="Keterangan Transaksi"/></td>';
		  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
		  $('#table_ini').append(html); 
		  $('.select2').select2(); 		 
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_nokas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	});
	$(document).on('click', '.remove', function(){
		  $(this).closest('tr').remove();
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
	}); 
	$('#item_table').keyup(function(event) {
		if (event.target.classList.contains("inputnumber")) {
		  // remove any commas from earlier formatting
		  const value = event.target.value.replace(/,/g, '');
		  // try to convert to an integer
		  const parsed = parseInt(value);
		  // check if the integer conversion worked and matches the expected value
		  if (!isNaN(parsed) && parsed == value) {
			// update the value
			event.target.value = new Intl.NumberFormat('en-US').format(value);
		  }
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
		}
	});
});
    $('#tgl_transaksi').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_transaksi").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
	$.fn.fonkTopladeb = function() {
	var sumdebet = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumdebet += deger;
	});//document.getElementById('totaldebet').value = sumdebet.toLocaleString('en-US');
	//return sumdebet;
	};
	$.fn.fonkToplakre = function() {
	var sumkredit = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumkredit += deger;
	});document.getElementById('totalkredit').value = sumkredit.toLocaleString('en-US');
	 $('#total').val($('#totalkredit').val());
	//return sumkredit;
	};
	function fonkDeger(veri) {
		veri=veri.replace(/\,/g,'');
		return (veri != '') ? parseInt(veri) : 0;
	}
<?php
}
elseif ( $page=="bank_keluar_tambah" )  
{
?>
$(document).ready(function() {
	  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
	  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
	$('.select2').select2();
		  $(".select_kas").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_bank',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_nokas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });	
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	 $(document).on('click', '.add', function(){
		  var html = '';
		  html += '<tr>';
		  html += '<td><select name="id_coa[]" required="required" class="select_coa form-control select2"><option value="">Pilih Rekening</option></select></td>';
		  html += '<td><input type="text" name="td_kredit[]" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Nominal Transaksi"/><input type="hidden" name="td_debet[]" value="0" class="form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Nominal Transaksi"/></td>';
		  html += '<td><input type="text" name="kurs_mata_uang[]" value="1" class="kurs_mata_uang form-control inputnumber" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Kurs Transaksi"/></td>';
		  html += '<td><select name="id_mata_uang[]" required="required" id="id_mata_uang" class="select_kurs form-control select2"><option value="">Mata Uang</option></select></td>';
		  html += '<td><input type="text" name="ket_transaksi_detil[]" class="form-control" placeholder="Keterangan Transaksi"/></td>';
		  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
		  $('#table_ini').append(html); 
		  $('.select2').select2(); 		 
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_nokas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_kurs").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_mata_uang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	});
	$(document).on('click', '.remove', function(){
		  $(this).closest('tr').remove();
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
	}); 
	$('#item_table').keyup(function(event) {
		if (event.target.classList.contains("inputnumber")) {
		  // remove any commas from earlier formatting
		  const value = event.target.value.replace(/,/g, '');
		  // try to convert to an integer
		  const parsed = parseInt(value);
		  // check if the integer conversion worked and matches the expected value
		  if (!isNaN(parsed) && parsed == value) {
			// update the value
			event.target.value = new Intl.NumberFormat('en-US').format(value);
		  }
		  $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
		  $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());
		}
	});
});
    $('#tgl_transaksi').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_transaksi").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
	$.fn.fonkTopladeb = function() {
	var sumdebet = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumdebet += deger;
	});//document.getElementById('totaldebet').value = sumdebet.toLocaleString('en-US');
	//return sumdebet;
	};
	$.fn.fonkToplakre = function() {
	var sumkredit = 0;
	this.each(function() {
	   var deger = fonkDeger($(this).val());
	   sumkredit += deger;
	});document.getElementById('totalkredit').value = sumkredit.toLocaleString('en-US');
	 $('#total').val($('#totalkredit').val());
	//return sumkredit;
	};
	function fonkDeger(veri) {
		veri=veri.replace(/\,/g,'');
		return (veri != '') ? parseInt(veri) : 0;
	}
<?php
}
elseif ( $page=="saldo_awal_tambah" )  
{
?>
$(document).ready(function() {
$(function(){
  $('.inpt').on('keyup', function(){
    var val = $(this).val();
    $('.inpt').val(val);
  })
})
	$('.select2').select2();
		  $(".select_kas").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_saldo_awal',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_coa").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_coa_nokas',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });	
	$('#item_table').keyup(function(event) {
		if (event.target.classList.contains("inputnumber")) {
		  // remove any commas from earlier formatting
		  const value = event.target.value.replace(/,/g, '');
		  // try to convert to an integer
		  const parsed = parseInt(value);
		  // check if the integer conversion worked and matches the expected value
		  if (!isNaN(parsed) && parsed == value) {
			// update the value
			event.target.value = new Intl.NumberFormat('en-US').format(value);
		  }
		}
	});
});
    $('#tgl_transaksi').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_transaksi").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
<?php
}
elseif ($page=="order_beli")  
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>Kontak:</td><td>'+d.kontak+'</td> <td style="width: 5%"></td><td>Alamat:</td><td>'+d.address+'</td> </tr>'+
        '<tr> <td>Keterangan:</td><td>'+d.ket_order_beli+'</td> <td></td><td>Pajak:</td><td>'+d.pajak+'</td> </tr>'+
        '<tr> <td>Diskon:</td><td>'+d.diskon_order_beli+'</td><td></td><td>Persen:</td><td>'+d.persen_order_beli+'</td> </tr>'+
		'<tr> <td>SubTotal:</td><td>'+d.subtotal_order_beli+'</td>            <td></td>   <td>PPN:</td><td>'+d.ppn_order_beli+'</td> </tr>'+
		'<tr> <td>Total:</td><td>'+d.total_order_beli+'</td>            <td></td>   <td>User:</td><td>'+d.nama_pegawai+'</td> </tr>'+
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
		$('.select2').select2();
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": false,
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
                "url"  : "<?php echo base_url();?>akunting/<?php echo $page;?>/data/<?php echo $date;?>/<?php echo $first_date;?>/<?php echo $last_date;?>",
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
                      { "data": "id_order_beli","searchable":false },
                      { "data": "tgl_order_beli","searchable":false },
					  { "data": "no_order_beli" },
					  { "data": "nama_unit" },
					  { "data": "nama_dk" },
					  { "data": "nama_termin","searchable":false },
					  { "data": "status_order_beli","searchable":false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
                if(data['status_order_beli']=="Done"){                
                    $(row).find('td:eq(7)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(7)').css('color', 'red');
                }
              }, 
            "buttons": [		
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnaqua",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('akunting/'.$page.'/tambah'); ?>';
                    }
                },		
                {
                    text: "<i class='fa fa-pencil'></i> Edit / <i class='fa fa-search'></i> Lihat",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_order_beli'];  
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('akunting/'.$page.'/edit/'); ?>'+data;
                    }
                },		
                {
                  text: "<i class='fa fa-file-pdf-o'></i> PDF",
                  extend: "selected",
                  className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_order_beli']; 
						window.open('<?php echo base_url('akunting/'.$page.'/pdf/'); ?>'+data);
                    }
                },
                {
                  text: "<i class='fa fa-file-excel-o'></i> Excell",
                  extend: "selected",
                  className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_order_beli']; 
						window.open('<?php echo base_url('akunting/'.$page.'/xls/'); ?>'+data);
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
	    // Add event listener for opening and closing details
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
<?php
}
elseif ($page=="order_beli_tambahx")  
{
?>
//const numInputs = document.querySelectorAll("#myCircle1, #myCircle2, #myCircle3, #myCircle4")
const numInputs = document.querySelectorAll('.jml, .harga, .diskon, .persen, .dob, .pob')

numInputs.forEach(function(input) {
  input.addEventListener('change', function(e) {
    if (e.target.value == '') {
      e.target.value = 0
    }
  })
})

$(document).ready(function() {
	// https://jsbin.com/gevocahihu/edit?html,js,output
	$('.select2').select2();
		  $(".select_barang").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_barang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_satuan").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_satuan',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });	
	 $(document).on('click', '.add', function(){
  var new_raw = $(
      '<tr>'+
          '<td><select name="id_barang[]" required="required" class="select_barang form-control select2"><option value="">Pilih Barang</option></select></td>'+
          '<td><input type="text" name="merk_ob_detil[]" class="form-control" placeholder="Merk"/></td>'+
          '<td><input type="text" name="jml_ob_detil[]" value="0" class="form-control jml" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Jumlah"/></td>'+
          '<td><select name="satuan_besar[]" required="required" class="select_satuan form-control select2"><option value="">Satuan Besar</option></select></td>'+
          '<td><input type="text" name="harga_ob_detil[]" value="0" class="form-control text-right inputnumber harga" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Harga"/></td>'+
          '<td><input type="text" name="diskon_ob_detil[]" value="0" class="form-control text-right inputnumber diskon" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Diskon Rp"/></td>'+
          '<td><input type="text" name="persen_order_beli[]" value="0" class="form-control text-right persen" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Diskon Rp"/></td>'+
          '<td><input type="text" name="total_ob_detil[]" readonly value="0" class="form-control text-right inputnumber total" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder=""/></td>'+
          '<td><input type="text" name="ket_ob_detil[]" class="form-control" placeholder="Keterangan"/></td>'+
          '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr'+
      '</tr>'
  );
  new_raw.insertBefore('#addDepIt');
		  $('.select2').select2(); 		 
		  $(".select_barang").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_barang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_satuan").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_satuan',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });
	});
	$(document).on('click', '.remove', function(){
//	  $(this).closest('tr').remove();
      var row = $(this).closest('tr');
      var prev = row.prev();
      row.remove();
      prev.find('.jml').trigger('input');
	}); 
	$('#item_table').keyup(function(event) {
		if (event.target.classList.contains("inputnumber")) {
		  // remove any commas from earlier formatting
		  const value = event.target.value.replace(/,/g, '');
		  // try to convert to an integer
		  const parsed = parseInt(value);
		  // check if the integer conversion worked and matches the expected value
		  if (!isNaN(parsed) && parsed == value) {
			// update the value
			event.target.value = new Intl.NumberFormat('en-US').format(value);
		  }
		}
	});		  
});
$(document).on('input', '.jml, .harga, .diskon, .persen, .dob', updateDepIT);

function updateDepIT() {
    updateDepTotal($(this).closest("table"));

	updateDepRow($(this).closest("tr")); //updateDepColumn($(this).closest("td"), $(this));
	
}
function updateDepTotal($table) {
    var sum = 0;
    $table.find('.total').each(function(i) {
		var vl = this.value.replace(/,/g, '');
		if(!isNaN(vl) && vl.length!=0){
			sum+=parseInt(vl);
			}
    });
	sums = sum.toLocaleString('en-US');
    $('#subtotal_order_beli').val(sums);
}
function updateDepColumn($col, $input) {
    var index = $col.index() + 1;
    var sum = 0;

    $('#item_table td:nth-child(' + index + ')').find('input').each(function(i) {
        if (!isNaN(this.value) && this.value.length != 0 && !$(this).attr('id')) {
            sum += parseFloat(this.value);
        }
    });

    if ($input.hasClass('total')) {
        $('#subtotal_order_beli').val(sum);
    } 
}
function updateDepRow($row) {
    $row.find('.jml, .harga, .diskon, .persen').each(function(i) {
        if (!isNaN(this.value) && this.value.length != 0) {
			var jml = $row.find('.jml').val();
			var harga = $row.find('.harga').val();
			var diskon = $row.find('.diskon').val();
			var persen = $row.find('.persen').val();
			if (jml == '') {
				jml = 0;
			} else {
				jml = $row.find('.jml').val();
			}
			if (harga == '') {
				harga = 0;
			} else {
				harga = $row.find('.harga').val();
			}
			if (diskon == '') {
				diskon = 0;
			} else {
				diskon = $row.find('.diskon').val();
			}
			if (persen == '') {
				persen = 0;
			} else {
				persen = $row.find('.persen').val();
			}
			if (diskon == 0) {
				percent = Math.round((parseInt(jml) * parseInt(harga.replace(/,/g, ''))) * (parseInt(persen)/100));
			}else if(persen == 0) {
				percent = parseInt(diskon.replace(/,/g, ''));
			}else if(persen == 0 && diskon == 0) {
				percent = 0;
			}else{
				percent = Math.round((parseInt(jml) * parseInt(harga.replace(/,/g, ''))) * (parseInt(persen)/100));
			}
			calcu = (parseInt(jml) * parseInt(harga.replace(/,/g, ''))) - percent;
			calcu = parseFloat(calcu).toLocaleString('en-US');
        }
    });
    $row.find('.total').val(calcu);
//    $row.find('.total').val(calcu);
}
    function getValues()
  {
//	var dep_all_total  = $('#dep_all_total').val();  // sub total
//    var diskon_order_beli = document.getElementById('diskon_order_beli').value;
//    var persen_order_beli = document.getElementById('persen_order_beli').value;
//    if (diskon_order_beli=="") { diskon_order_beli = 0; }
 //   if (persen_order_beli=="") { persen_order_beli = 0; }
//	$('#ppn_order_beli').val($('#dep_all_total').val()); // apa yang diketik muncul
	$('#total_order_beli').val($('#diskon_order_beli').val()); // apa yang diketik muncul
/*     document.getElementById("ppn_order_beli").innerHTML = diskon_order_beli;
    document.getElementById("total_order_beli").innerHTML = persen_order_beli; */
	
	
	
/* 	if (diskon_order_beli == 0) {
		percentase = Math.round(parseInt(dep_all_total.replace(/,/g, '')) * (parseInt(persen_order_beli)/100));
	}else if(persen_order_beli == 0) {
		percentase = parseInt(diskon_order_beli.replace(/,/g, ''));
	}else if(persen_order_beli == 0 && diskon_order_beli == 0) {
		percentase = 0;
	}else{
		percentase = Math.round(parseInt(dep_all_total.replace(/,/g, '')) * (parseInt(persen_order_beli)/100));
	} */
//	var pajak = document.getElementById("pajak").value;
//	var subtotale = (parseFloat(dep_all_total.replace(/,/g, '')));
/* 	if(pajak == 2) { // belum pajak
		pajake = subtotale * 10 / 100;
	}else{
		pajake = 0;
	} */		
//	var totale = (subtotale - pajak);
//	var totale = (subtotale);
//	document.getElementById('total_order_beli').value = totale.toLocaleString('en-US');
//	document.getElementById('diskon_order_beli').value = totale.toLocaleString('en-US');
//	document.getElementById('ppn_order_beli').value = diskon_order_beli.toLocaleString('en-US');
  }
 
$('#tgl_order_beli').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
<?php
}
elseif ($page=="order_beli_tambah" || $page=="order_beli_edit" || $page=="proses_order_beli_proses")  
{
?>
const numInputs = document.querySelectorAll('.jml, .harga, .diskon, .persen, .dob, .pob, .konversi')
numInputs.forEach(function(input) {
  input.addEventListener('change', function(e) {
    if (e.target.value == '') {
      e.target.value = 0
    }
  })
})
$(document).ready(function() {
	$('.select2').select2();
	total();
		  $(".select_barang").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_barang',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });		  
		  $(".select_satuan").select2({
			ajax: {
				url: '<?php echo base_url();?>akunting/data_satuan',
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function (params) {
					return {
						searchTerm: params.term // search term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				},
				cache: true
			}
		  });	
	$('#item_table').keyup(function(event) {
		if (event.target.classList.contains("inputnumber")) {
		  // remove any commas from earlier formatting
		  const value = event.target.value.replace(/,/g, '');
		  // try to convert to an integer
		  const parsed = parseInt(value);
		  // check if the integer conversion worked and matches the expected value
		  if (!isNaN(parsed) && parsed == value) {
			// update the value
			event.target.value = new Intl.NumberFormat('en-US').format(value);
		  }
		}
	});			  
	$("#pajak").change(function(){
	  total();
	});
 });
 
$('#tgl_order_beli').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$(document).on('input', '.jml, .harga, .diskon, .persen, .dob', updateDepIT);

function updateDepIT() {
	updateDepRow($(this).closest("tr"));	
}
function updateDepRow($row) {
    $row.find('.jml, .harga, .diskon, .persen').each(function(i) {
        if (!isNaN(this.value) && this.value.length != 0) {
			var jml = $row.find('.jml').val();
			var harga = $row.find('.harga').val();
			var diskon = $row.find('.diskon').val();
			var persen = $row.find('.persen').val();
			if (jml == '') {
				jml = 0;
			} else {
				jml = $row.find('.jml').val();
			}
			if (harga == '') {
				harga = 0;
			} else {
				harga = $row.find('.harga').val();
			}
			if (diskon == '') {
				diskon = 0;
			} else {
				diskon = $row.find('.diskon').val();
			}
			if (persen == '') {
				persen = 0;
			} else {
				persen = $row.find('.persen').val();
			}
			if (diskon == 0) {
				percent = Math.round((parseInt(jml) * parseInt(harga.replace(/,/g, ''))) * (parseInt(persen)/100));
			}else if(persen == 0) {
				percent = parseInt(diskon.replace(/,/g, ''));
			}else if(persen == 0 && diskon == 0) {
				percent = 0;
			}else{
				percent = Math.round((parseInt(jml) * parseInt(harga.replace(/,/g, ''))) * (parseInt(persen)/100));
			}
			calcu = (parseInt(jml) * parseInt(harga.replace(/,/g, ''))) - percent;
			calcu = parseFloat(calcu).toLocaleString('en-US');
        }
    });
    $row.find('.total').val(calcu);
}
function total() {
	var pajak = document.getElementById('pajak').value;
	var subtotal_order_beli = parseInt(document.getElementById('subtotal_order_beli').value.replace(/,/g, ''));
	var diskon_order_beli = parseInt(document.getElementById('diskon_order_beli').value.replace(/,/g, ''));
	var persen_order_beli = parseInt(document.getElementById('persen_order_beli').value);
	if (diskon_order_beli == 0) {
		percentase = Math.round(subtotal_order_beli * (persen_order_beli/100));
	}else if(persen_order_beli == 0) {
		percentase = diskon_order_beli;
	}else if(persen_order_beli == 0 && diskon_order_beli == 0) {
		percentase = 0;
	}else{
		percentase = Math.round(subtotal_order_beli * (persen_order_beli/100));
	}	  
	if (pajak == 0) { //tanpa
		pajak = 0;
		var total = subtotal_order_beli - percentase;
		document.getElementById('ppn_order_beli').value = pajak.toLocaleString('en-US');
		document.getElementById('total_order_beli').value = total.toLocaleString('en-US');
	}else if(pajak == 1) {  //pajak tpph22 = Math.floor((tpph22*100)/100);
		var total = subtotal_order_beli - percentase;
		var dpp = Math.floor(total * 100/110);			
		pajak = Math.floor(10/100 * dpp);			
		document.getElementById('ppn_order_beli').value = pajak.toLocaleString('en-US');
		document.getElementById('total_order_beli').value = total.toLocaleString('en-US');	
	}else{
		var betotal = subtotal_order_beli - percentase;
		pajak = Math.floor((betotal * 10)/100);
		var total = betotal + pajak;
		document.getElementById('ppn_order_beli').value = pajak.toLocaleString('en-US');
		document.getElementById('total_order_beli').value = total.toLocaleString('en-US');		
	
	}
}
function confirmation(ev) {
	ev.preventDefault();
	var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
	console.log(urlToRedirect); // verify if this is the right URL
	swal({
		title: "Apakah Anda Yakin Data Di Hapus",
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
<?php
}
elseif ($page=="proses_order_beli")  
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>Kontak:</td><td>'+d.kontak+'</td> <td style="width: 5%"></td><td>Alamat:</td><td>'+d.address+'</td> </tr>'+
        '<tr> <td>Keterangan:</td><td>'+d.ket_order_beli+'</td> <td></td><td>Pajak:</td><td>'+d.pajak+'</td> </tr>'+
        '<tr> <td>Diskon:</td><td>'+d.diskon_order_beli+'</td><td></td><td>Persen:</td><td>'+d.persen_order_beli+'</td> </tr>'+
		'<tr> <td>SubTotal:</td><td>'+d.subtotal_order_beli+'</td>            <td></td>   <td>PPN:</td><td>'+d.ppn_order_beli+'</td> </tr>'+
		'<tr> <td>Total:</td><td>'+d.total_order_beli+'</td>            <td></td>   <td>User:</td><td>'+d.nama_pegawai+'</td> </tr>'+
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
		$('.select2').select2();
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": false,
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
                "url"  : "<?php echo base_url();?>akunting/<?php echo $page;?>/data/<?php echo $date;?>/<?php echo $first_date;?>/<?php echo $last_date;?>",
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
                      { "data": "id_order_beli","searchable":false },
                      { "data": "tgl_order_beli","searchable":false },
					  { "data": "no_order_beli" },
					  { "data": "nama_unit" },
					  { "data": "nama_dk" },
					  { "data": "nama_termin","searchable":false },
					  { "data": "status_order_beli","searchable":false }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
                if(data['status_order_beli']=="Done"){                
                    $(row).find('td:eq(7)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(7)').css('color', 'red');
                }
              }, 
            "buttons": [				
                {
                    text: "<i class='fa fa-file-o'></i> Proses",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_order_beli'];  
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('akunting/'.$page.'/proses/'); ?>'+data;
                    }
                },		
                {
                  text: "<i class='fa fa-file-pdf-o'></i> PDF",
                  extend: "selected",
                  className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_order_beli']; 
						window.open('<?php echo base_url('akunting/'.$page.'/pdf/'); ?>'+data);
                    }
                },
                {
                  text: "<i class='fa fa-file-excel-o'></i> Excell",
                  extend: "selected",
                  className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_order_beli']; 
						window.open('<?php echo base_url('akunting/'.$page.'/xls/'); ?>'+data);
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
	    // Add event listener for opening and closing details
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
<?php
}
?>
</script>
		</div>
	</body>
</html>