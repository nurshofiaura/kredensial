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
elseif ($page=="butir_kegiatan")  
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
                "url"  : "<?php echo base_url();?>anjababk/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [                           
                      { "data": "id_butir_kegiatan", "searchable":false, "visible":false },
                      { "data": "nama_butir_kegiatan" },
                      { "data": "nama_jabatan_fungsional", "searchable":false },
                      { "data": "angka_kredit", "searchable":false },
                      { "data": "satuan_hasil", "searchable":false },
                      { "data": "status_butir_kegiatan", "searchable":false }
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
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/tambah/'); ?><?php echo $id;?>',
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-edit'></i> Edit",
                    extend: "selected",
                    className: "btnlime",
                   action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_butir_kegiatan']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/edit/'); ?><?php echo $id;?>/'+data,
						  function(){
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
else if ($page=="informasi_jabatan_abk")
{
?>
    $(document).ready(function() {
		$('.select2').select2()
		if ($('#status_butir_kegiatan').val() == '0' || $('#status_butir_kegiatan').val() == '3') {
			document.getElementById('vol1th').style.display = 'block';									
			document.getElementById('wpk').style.display = 'block';	
			document.getElementById('keterangan_jumlah').style.display = 'block';
			document.getElementById('jam_efektif').style.display = 'block';
			document.getElementById('angka_kredit').style.display = 'block';
			document.getElementById('wpv').style.display = 'block';
			document.getElementById('konstanta').style.display = 'block';
			
			$('#text_ms_vol1th').show();			
			$('#text_ms_wpk').show();	
			$('#text_ms_keterangan_jumlah').show();	
			$('#text_ms_jam_efektif').show();	
			$('#text_ms_angka_kredit').show();	
			$('#text_ms_wpv').show();	
			$('#text_ms_konstanta').show();	
			
			document.getElementById('text_ms_vol1th').innerHTML = 'Volume 1 Tahun';
			document.getElementById('text_ms_wpk').innerHTML = 'Waktu Penyelesaian Kegiatan';						
			document.getElementById('text_ms_keterangan_jumlah').innerHTML = 'Keterangan Jumlah';						
			document.getElementById('text_ms_jam_efektif').innerHTML = 'Jam Waktu Efektif';						
			document.getElementById('text_ms_angka_kredit').innerHTML = 'Angka Kredit';						
			document.getElementById('text_ms_wpv').innerHTML = 'Waktu Penyelesaian Volume';						
			document.getElementById('text_ms_konstanta').innerHTML = 'Konstanta';						
		}else if ($('#status_butir_kegiatan').val() == '1'  || $('#status_butir_kegiatan').val() == '4') {
			document.getElementById('vol1th').style.display = 'block';									
			document.getElementById('wpk').style.display = 'none';	
			document.getElementById('keterangan_jumlah').style.display = 'block';
			document.getElementById('jam_efektif').style.display = 'none';
			document.getElementById('angka_kredit').style.display = 'none';
			document.getElementById('wpv').style.display = 'none';
			document.getElementById('konstanta').style.display = 'block';
			
			$('#text_ms_vol1th').show();			
			$('#text_ms_wpk').hide();	
			$('#text_ms_keterangan_jumlah').show();	
			$('#text_ms_jam_efektif').hide();	
			$('#text_ms_angka_kredit').hide();	
			$('#text_ms_wpv').hide();	
			$('#text_ms_konstanta').show();	
			
			document.getElementById('text_ms_vol1th').innerHTML = 'Beban Kerja';
			document.getElementById('text_ms_keterangan_jumlah').innerHTML = 'Waktu Penyelesaian Rata-rata';						
			document.getElementById('text_ms_konstanta').innerHTML = 'Waktu Kerja Efektif';
		}else if ($('#status_butir_kegiatan').val() == '2' || $('#status_butir_kegiatan').val() == '5') {
			document.getElementById('vol1th').style.display = 'block';									
			document.getElementById('wpk').style.display = 'block';	
			document.getElementById('keterangan_jumlah').style.display = 'block';
			document.getElementById('jam_efektif').style.display = 'block';
			document.getElementById('angka_kredit').style.display = 'none';
			document.getElementById('wpv').style.display = 'block';
			document.getElementById('konstanta').style.display = 'none';
			
			$('#text_ms_vol1th').show();			
			$('#text_ms_wpk').show();	
			$('#text_ms_keterangan_jumlah').show();	
			$('#text_ms_jam_efektif').show();	
			$('#text_ms_angka_kredit').hide();	
			$('#text_ms_wpv').show();	
			$('#text_ms_konstanta').hide();	
			
			document.getElementById('text_ms_vol1th').innerHTML = 'Volume 1 Tahun';
			document.getElementById('text_ms_wpk').innerHTML = 'Waktu Penyelesaian Kegiatan';						
			document.getElementById('text_ms_keterangan_jumlah').innerHTML = 'Keterangan Jumlah';						
			document.getElementById('text_ms_jam_efektif').innerHTML = 'Jam Waktu Efektif';						
			document.getElementById('text_ms_wpv').innerHTML = 'Waktu Penyelesaian Volume';						
		}
	});		
	$('#status_butir_kegiatan').change(function () {
		if ($('#status_butir_kegiatan').val() == '0' || $('#status_butir_kegiatan').val() == '3') {
			document.getElementById('vol1th').style.display = 'block';									
			document.getElementById('wpk').style.display = 'block';	
			document.getElementById('keterangan_jumlah').style.display = 'block';
			document.getElementById('jam_efektif').style.display = 'block';
			document.getElementById('angka_kredit').style.display = 'block';
			document.getElementById('wpv').style.display = 'block';
			document.getElementById('konstanta').style.display = 'block';
			
			$('#text_ms_vol1th').show();			
			$('#text_ms_wpk').show();	
			$('#text_ms_keterangan_jumlah').show();	
			$('#text_ms_jam_efektif').show();	
			$('#text_ms_angka_kredit').show();	
			$('#text_ms_wpv').show();	
			$('#text_ms_konstanta').show();	
			
			document.getElementById('text_ms_vol1th').innerHTML = 'Volume 1 Tahun';
			document.getElementById('text_ms_wpk').innerHTML = 'Waktu Penyelesaian Kegiatan';						
			document.getElementById('text_ms_keterangan_jumlah').innerHTML = 'Keterangan Jumlah';						
			document.getElementById('text_ms_jam_efektif').innerHTML = 'Jam Waktu Efektif';						
			document.getElementById('text_ms_angka_kredit').innerHTML = 'Angka Kredit';						
			document.getElementById('text_ms_wpv').innerHTML = 'Waktu Penyelesaian Volume';						
			document.getElementById('text_ms_konstanta').innerHTML = 'Konstanta';						
		}else if ($('#status_butir_kegiatan').val() == '1'  || $('#status_butir_kegiatan').val() == '4') {
			document.getElementById('vol1th').style.display = 'block';									
			document.getElementById('wpk').style.display = 'none';	
			document.getElementById('keterangan_jumlah').style.display = 'block';
			document.getElementById('jam_efektif').style.display = 'none';
			document.getElementById('angka_kredit').style.display = 'none';
			document.getElementById('wpv').style.display = 'none';
			document.getElementById('konstanta').style.display = 'block';
			
			$('#text_ms_vol1th').show();			
			$('#text_ms_wpk').hide();	
			$('#text_ms_keterangan_jumlah').show();	
			$('#text_ms_jam_efektif').hide();	
			$('#text_ms_angka_kredit').hide();	
			$('#text_ms_wpv').hide();	
			$('#text_ms_konstanta').show();	
			
			document.getElementById('text_ms_vol1th').innerHTML = 'Beban Kerja';
			document.getElementById('text_ms_wpk').innerHTML = 'Waktu Penyelesaian Kegiatan';						
			document.getElementById('text_ms_keterangan_jumlah').innerHTML = 'Waktu Penyelesaian Rata-rata';						
			document.getElementById('text_ms_jam_efektif').innerHTML = 'Jam Waktu Efektif';						
			document.getElementById('text_ms_angka_kredit').innerHTML = 'Angka Kredit';						
			document.getElementById('text_ms_wpv').innerHTML = 'Waktu Penyelesaian Volume';						
			document.getElementById('text_ms_konstanta').innerHTML = 'Waktu Kerja Efektif';
		}else if ($('#status_butir_kegiatan').val() == '2' || $('#status_butir_kegiatan').val() == '5') {
			document.getElementById('vol1th').style.display = 'block';									
			document.getElementById('wpk').style.display = 'block';	
			document.getElementById('keterangan_jumlah').style.display = 'block';
			document.getElementById('jam_efektif').style.display = 'block';
			document.getElementById('angka_kredit').style.display = 'none';
			document.getElementById('wpv').style.display = 'block';
			document.getElementById('konstanta').style.display = 'none';
			
			$('#text_ms_vol1th').show();			
			$('#text_ms_wpk').show();	
			$('#text_ms_keterangan_jumlah').show();	
			$('#text_ms_jam_efektif').show();	
			$('#text_ms_angka_kredit').hide();	
			$('#text_ms_wpv').show();	
			$('#text_ms_konstanta').hide();	
			
			document.getElementById('text_ms_vol1th').innerHTML = 'Volume 1 Tahun';
			document.getElementById('text_ms_wpk').innerHTML = 'Waktu Penyelesaian Kegiatan';						
			document.getElementById('text_ms_keterangan_jumlah').innerHTML = 'Keterangan Jumlah';						
			document.getElementById('text_ms_jam_efektif').innerHTML = 'Jam Waktu Efektif';						
			document.getElementById('text_ms_angka_kredit').innerHTML = 'Angka Kredit';						
			document.getElementById('text_ms_wpv').innerHTML = 'Waktu Penyelesaian Volume';						
			document.getElementById('text_ms_konstanta').innerHTML = 'Konstanta';	
		}
	});
	$('input').keyup(function(){ // run anytime the value changes
		if ($('#status_butir_kegiatan').val() == '0') {
			var AngkaKredit  = Number($('#angka_kredit').val());   // get value of field
			var Keterangan = Number($('#keterangan_jumlah').val()); // convert it to a float
			var Konstantae  = Number($('#konstanta').val());				
			var vol1the  = Number($('#vol1th').val());
			var ms_jam_efektif  = Number($('#jam_efektif').val());
		
			document.getElementById('wpk').value = (AngkaKredit / Konstantae);
			var wepeke = AngkaKredit / Konstantae;
	//		wepeke.toFixed(5);
			var wepekedua = vol1the / Keterangan;
	//		wepekedua.toFixed(5);
			document.getElementById('wpv').value = (wepeke * wepekedua);
			document.getElementById('formasi').value = (wepeke * wepekedua / ms_jam_efektif);			
		}else if ($('#status_butir_kegiatan').val() == '1') {
				var Keterangan = Number($('#keterangan_jumlah').val()); // convert it to a float
				var Konstantae  = Number($('#konstanta').val());				
				var vol  = Number($('#vol1th').val());
				var ms_jam_efektif  = Number($('#jam_efektif').val());
				document.getElementById('formasi').value = Keterangan * vol / Konstantae; 
				// formasi = waktu penyelesaian rata2 x beban kerja / waktu kerja efektif
		}else if ($('#status_butir_kegiatan').val() == '2') {		
				var AngkaKredit  = Number($('#angka_kredit').val());   // get value of field
				var Keterangan = Number($('#keterangan_jumlah').val()); // convert it to a float
				var vol1the  = Number($('#vol1th').val());
				var wpke  = Number($('#wpk').val());
				var ms_jam_efektif  = Number($('#jam_efektif').val());

				var wepekedua = vol1the / Keterangan;
			//	wepekedua.toFixed(5);
				document.getElementById('wpv').value = (wpke * wepekedua);
				document.getElementById('formasi').value = (wpke * wepekedua / ms_jam_efektif);
		}

	//	$('#total_expenses1').html(firstValue + secondValue + thirdValue + fourthValue);  pake span
	//	document.getElementById('total_expenses2').value = firstValue + secondValue / thirdValue + fourthValue; // pake textbox
	
	});
<?php 
}
elseif ($page=="pegawai")  
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
                "url"  : "<?php echo base_url();?>anjababk/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [                           
					  { "data": "nama_pegawai" },
					  { "data": "nama_jabatan_fungsional" }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [	
                {
                    text: "<i class='fa fa-user-md'></i> Rubah Jabfung",
                    extend: "selected",
                    className: "btnorange",
                   action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_pegawai']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/edit/'); ?>'+data,
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
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
elseif ($page=="informasi_jabatan")  
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
                "url"  : "<?php echo base_url();?>anjababk/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [                           
                      { "data": "no_urut", "searchable":false },
                      { "data": "periode", "searchable":false },
					  { "data": "nama_jabatan_fungsional" },
					  { "data": "nama_struktur_jabatan", "searchable":false },
					  { "data": "pns", "searchable":false, className: "text-right" },
					  { "data": "cpns", "searchable":false, className: "text-right" },
					  { "data": "blud", "searchable":false, className: "text-right" },
					  { "data": "pppk", "searchable":false, className: "text-right" },
					  { "data": "total", "searchable":false, className: "text-right" },
					  { "data": "average", "searchable":false, className: "text-right" }
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
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/periode'); ?>',
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-edit'></i> Edit Jabfung dan Header Footer",
                    extend: "selected",
                    className: "btnlime",
                   action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/edit/'); ?>'+data,
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-sort-amount-asc'></i> Urutan",
                    extend: "selected",
                    className: "btnorange",
                   action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/urutan/'); ?>'+data,
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Isian",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('anjababk/'.$page.'/isi/'); ?>'+data;
                    }
                },		
                {
                    text: "<i class='fa fa-file-o'></i> Pilihan",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('anjababk/'.$page.'/pilihan/'); ?>'+data;
                    }
                },	
                {
                    text: "<i class='fa fa-clone'></i> Copy",
                    extend: "selected",
                    className: "btnolive",
                   action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/copy/'); ?>'+data,
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },	
                {
                    text: "<i class='fa fa-users'></i> Isi Jumlah Pegawai",
                    extend: "selected",
                    className: "btnnavy",
                   action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/isi_pegawai/'); ?>'+data,
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-plus'></i> Tambah Pemenuhan Dan Realisasi",
                    extend: "selected",
                    className: "btnpurple",
                   action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/pemenuhan_tambah/'); ?>'+data,
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-pencil'></i> Pemenuhan Dan Realisasi",
                    extend: "selected",
                    className: "btnred",
                   action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
						data2 = dt.rows( { selected: true } ).data()[0]['periode']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('anjababk/'.$page.'/pemenuhan_edit/'); ?>'+data+'/'+data2,
						  function(){
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
                },			
                {
                  text: "<i class='fa fa-file-pdf-o'></i> Uraian Jabatan",
                  extend: "selected",
                  className: "btnaqua",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
						window.open('<?php echo base_url('anjababk/'.$page.'/pdf_uraian/'); ?>'+data);
                    }
                },	
                {
                  text: "<i class='fa fa-file-pdf-o'></i> ABK",
                  extend: "selected",
                  className: "btnaqua",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
						window.open('<?php echo base_url('anjababk/'.$page.'/pdf_abk/'); ?>'+data);
                    }
                },
                {
                  text: "<i class='fa fa-file-pdf-o'></i> Pola Ketenagaan",
                  extend: "selected",
                  className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
						window.open('<?php echo base_url('anjababk/'.$page.'/pdf_ketenagaan/'); ?>'+data);
                    }
                },
                {
                  text: "<i class='fa fa-file-pdf-o'></i> Evaluasi Perencanaan",
                  extend: "selected",
                  className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_abk_detil']; 
						window.open('<?php echo base_url('anjababk/'.$page.'/pdf_evaluasi/'); ?>'+data);
                    }
                },
              {
                text: "<i class='fa fa-send'></i> &nbsp; <i class='fa fa-link'></i>&nbsp; Buka Link Laporan",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      laporan = dt.rows( { selected: true } ).data()[0]['id_abk'];				
                      tabel = dt.rows( { selected: true } ).data()[0]['id_abk_detil'];				
						window.open('<?php echo base_url('external/anjababk/abk/'); ?>'+laporan+'/'+tabel);
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
else if ($page=="informasi_jabatan_isi")
{
?>
    $(document).ready(function() {
		$('.select2').select2()
		CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
		CKEDITOR.replace('editor2', {enterMode: CKEDITOR.ENTER_BR});
		CKEDITOR.replace('editor3', {enterMode: CKEDITOR.ENTER_BR});
		CKEDITOR.replace('editor4', {enterMode: CKEDITOR.ENTER_BR});
		CKEDITOR.replace('editor5', {enterMode: CKEDITOR.ENTER_BR});
		CKEDITOR.replace('editor6', {enterMode: CKEDITOR.ENTER_BR});
	});	
<?php 
}
else if ($page=="informasi_jabatan_pilihan")
{
?>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Apakah Anda Yakin Kosongkan",
            text: "Data Akan Di Kosongkan, Data Dapat Dipilih Kembali!",
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
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);     
	});

	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>Angka Kredit:</td><td>'+d.angka_kredit+'</td> <td style="width: 5%"></td><td>Keterangan Jumlah/Waktu Penyelesaian Rata-rata:</td><td>'+d.keterangan_jumlah+'</td> </tr>'+
	  '<tr> <td>Konstanta/Waktu Kerja Efektif:</td><td>'+d.konstanta+'</td> <td style="width: 5%"></td><td>Waktu Penyelesaian Kegiatan:</td><td>'+d.wpk+'</td> </tr>'+
	  '<tr> <td>Satuan Hasil:</td><td>'+d.satuan_hasil+'</td> <td style="width: 5%"></td><td>Waktu Penyelesaian Volume:</td><td>'+d.wpv+'</td> </tr>'+
	  '<tr> <td>Teknik Rumus Uraian Tugas:</td><td>'+d.status_bk_detil+'</td> <td style="width: 5%"></td><td>Jam Efektif:</td><td>'+d.jam_efektif+'</td> </tr>'+
        '</table>';
    }
$(document).ready(function(){
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
                "url"  : "<?php echo base_url();?>anjababk/informasi_jabatan/data_butir_kegiatan/<?php echo $id;?>",
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
					  { "data": "nama_kompetensi" },
					  { "data": "angka_kredit" },
                      { "data": "vol1th", "searchable":false },					  
                      { "data": "formasi", "searchable":false }
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
/*                {
                    text: "<i class='fa fa-plus'></i> Tambah Kompetensi ABK",
                    className: "btnteal",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#exampleModal").modal();
                          $('.modal-body').load('?php echo base_url('anjababk/informasi_jabatan/tambah_bk/'); ?>?php echo $id; ?>',
						  function(){
                            $('#exampleModal').modal({show:true});
                          });

                    }
                },*/
                {
                    text: "<i class='fa fa-search'></i> Pilih Kompetensi",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#exampleModal").modal();
                          $('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/pilih_bk/'); ?><?php echo $id; ?>',
						  function(){
                            $('#exampleModal').modal({show:true});
                          });

                    }
                },		
                {
                    text: "<i class='fa fa-calculator'></i> Isi Formasi Beban Kerja",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_bk_detil']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('anjababk/informasi_jabatan/abk/'); ?><?php echo $id;?>/'+data;
                    }
                },			
                 {
                     text: "<i class='fa fa-close'></i> Hapus",
                     extend: "selected",
                     className: "btnDelete",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_bk_detil'];
                     swal({
                       title: "WARNING HAPUS DATA",
                       text: "Yakin akan hapus data ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('anjababk/informasi_jabatan/hapus/'.$id.'/'); ?>'+data; //[Modif Disini]
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
        $(".btnDelete").removeClass("dt-button").addClass("btn btn-danger btn-sm");
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
	$('#wewenang').DataTable({
	"initComplete": function (settings, json) {  
		$("#wewenang").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
	//	  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenWewenang').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/wewenang/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahWewenang').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_wewenang/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#tanggung_jawab').DataTable({
	"initComplete": function (settings, json) {  
		$("#tanggung_jawab").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
	//	  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenTanggungJawab').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tanggung_jawab/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahTanggungJawab').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_tanggung_jawab/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#hasil_kerja').DataTable({
	"initComplete": function (settings, json) {  
		$("#hasil_kerja").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
	//	  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenHasilKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/hasil_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahHasilKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_hasil_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#bahan_kerja').DataTable({
	"initComplete": function (settings, json) {  
		$("#bahan_kerja").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})	
	$('.OpenBahanKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/bahan_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahBahanKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_bahan_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#perangkat_kerja').DataTable({
	"initComplete": function (settings, json) {  
		$("#perangkat_kerja").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})		
	$('.OpenPerangkatKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/perangkat_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahPerangkatKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_perangkat_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#hubungan_jabatan').DataTable({
	"initComplete": function (settings, json) {  
		$("#hubungan_jabatan").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})		
	$('.OpenHubunganJabatan').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/hubungan_jabatan/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahHubunganJabatan').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_hubungan_jabatan/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#kondisi_tempat').DataTable({
	"initComplete": function (settings, json) {  
		$("#kondisi_tempat").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenKondisiTempat').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/kondisi_tempat/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahKondisiTempat').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_kondisi_tempat/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#upaya_fisik').DataTable({
	"initComplete": function (settings, json) {  
		$("#upaya_fisik").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenUpayaFisik').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/upaya_fisik/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#resiko_bahaya').DataTable({
	"initComplete": function (settings, json) {  
		$("#resiko_bahaya").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenResikoBahaya').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/resiko_bahaya/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahResikoBahaya').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_resiko_bahaya/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#pendidikan').DataTable({
	"initComplete": function (settings, json) {  
		$("#pendidikan").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenPendidikan').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/pendidikan/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahPendidikan').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_pendidikan/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#pangkat').DataTable({
	"initComplete": function (settings, json) {  
		$("#pangkat").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenPangkat').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/pangkat/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#bakat_kerja').DataTable({
	"initComplete": function (settings, json) {  
		$("#bakat_kerja").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenBakatKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/bakat_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#temperamen_kerja').DataTable({
	"initComplete": function (settings, json) {  
		$("#temperamen_kerja").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenTemperamenKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/temperamen_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#minat_kerja').DataTable({
	"initComplete": function (settings, json) {  
		$("#minat_kerja").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenMinatKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/minat_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('#fungsi_kerja').DataTable({
	"initComplete": function (settings, json) {  
		$("#fungsi_kerja").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
	},
	'paging'      	: false,
	'lengthChange'	: false,
	'searching'   	: false,
	'ordering'    	: false,
	'info'        	: true,
//		  'scrollX'			: true,
	'scrollY'		: '200px',
	'scrollCollapse'	: true
	})
	$('.OpenFungsiKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/fungsi_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
		});
	});
	$('.openTambahFungsiKerja').on('click',function(){
		$('.modal-body').load('<?php echo base_url('anjababk/informasi_jabatan/tambah_fungsi_kerja/'); ?><?php echo $id;?>',function(){
			$('#exampleModal').modal({show:true});
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