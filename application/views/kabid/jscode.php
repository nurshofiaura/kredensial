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
elseif ($page=="logbook")  
{
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
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>Tgl Acc Karu:</td><td>'+d.tgl_v_karu+'</td> <td style="width: 5%"></td><td>Acc Kabid:</td><td>'+d.v_kabid+'</td> </tr>'+
	  '<tr> <td>Acc Asesor:</td><td>'+d.v_asesor+'</td> <td style="width: 5%"></td><td>Acc Komite:</td><td>'+d.v_komite+'</td> </tr>'+
	  '<tr> <td>Tgl Acc Kabid:</td><td>'+d.tgl_v_kabid+'</td> <td style="width: 5%"></td><td>Tgl Acc Asesor:</td><td>'+d.tgl_v_asesor+'</td> </tr>'+
	  '<tr> <td>Tgl Acc Komite:</td><td>'+d.tgl_v_komite+'</td> <td style="width: 5%"></td><td>Tgl Acc Direktur:</td><td>'+d.tgl_v_direktur+'</td> </tr>'+
	  '<tr> <td>RM:</td><td>'+d.rm+'</td> <td style="width: 5%"></td><td>Jam Logbook:</td><td>'+d.jam_logbook+'</td> </tr>'+
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
			"searching": true,
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
                "url"  : "<?php echo base_url();?>kabid/<?php echo $page;?>/data/<?php echo $first_date; ?>/<?php echo $last_date; ?>/<?php echo $id; ?>",
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
                      { "data": "id_logbook", "searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "nama_ruangan", "searchable":false },
					  { "data": "nama_kode_kewenangan", "searchable":false },
					  { "data": "nama_kewenangan", "searchable":false },
					  { "data": "jml_logbook", "searchable":false },
					  { "data": "v_karu", "searchable":false,
						"render": function(data, type, row){
							if (row.v_karu === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_karu === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}						   
					  },
					  { "data": "v_kabid", "searchable":false,
						"render": function(data, type, row){
							if (row.v_kabid === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_kabid === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}						   
					  }
            ],
            "order": [[8, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> KARU PROSES",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook']; 
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_karu/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/0/'+data2;
                    }
                },		
                {
                    text: "<i class='fa fa-check'></i> KARU SETUJU",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook']; 
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai']; 						
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_karu/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/1/'+data2;
                    }
                },	
                {
                    text: "<i class='fa fa-close'></i> KARU TOLAK",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook']; 
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_karu/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/2/'+data2;
                    }
                },
                {
                    text: "<i class='fa fa-check'></i> KARU SETUJU SEMUA",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_karu_all/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/1';
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> KARU TOLAK SEMUA",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_karu_all/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/2';
                    }
                },		
                {
                    text: "<i class='fa fa-recycle'></i> KABID PROSES",
                    extend: "selected",
                    className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook']; 
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_kabid/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/0/'+data2;
                    }
                },		
                {
                    text: "<i class='fa fa-check'></i> KABID SETUJU",
                    extend: "selected",
                    className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook']; 
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai']; 						
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_kabid/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/1/'+data2;
                    }
                },	
                {
                    text: "<i class='fa fa-close'></i> KABID TOLAK",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook']; 
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_kabid/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/2/'+data2;
                    }
                },
                {
                    text: "<i class='fa fa-check'></i> KABID SETUJU SEMUA",
                    extend: "selected",
                    className: "btnolive",
                    action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_kabid_all/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/1';
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> KABID TOLAK SEMUA",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
						data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/logbook/v_kabid_all/'); ?><?php echo $first_date; ?>/<?php echo $last_date; ?>/'+data+'/2';
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
elseif ($page=="etik")  
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
			"searching": true,
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
                "url"  : "<?php echo base_url();?>kabid/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                           
                      { "data": "id_etik_pegawai","searchable":false },
					  { "data": "tgl_etik_pegawai","searchable":false },
					  { "data": "jam_etik_pegawai","searchable":false },
					  { "data": "nama_pegawai" },
					  { "data": "jumlah_etik","searchable":false },
					  { "data": "total_etik","searchable":false },
					  { "data": "hasil_etik","searchable":false },
					  { "data": "id_penguji","searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                 {
                    text: "<i class='fa fa-plus'></i> Tambah Etik",
                    className: "btnyellow",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('kabid/'.$page.'/tambah/'.$id.''); ?>';
                    }
                },		
                {
                    text: "<i class='fa fa-search'></i> Lihat Etik",
                    extend: "selected",
                    className: "btnblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_etik_pegawai']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/'.$page.'/lihat/'); ?>'+data;
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
if ($page=="etik_tambah" || $page=="etik_lihat")  
{
?>
$(function(){
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
	  'scrollX'		: true ,
	  'scrollX'			: true,
	  'scrollY'			: '350px',
	  'scrollCollapse'	: true,
    })
});
var $radios = $(':radio[name^="skor_etik"]').change(function() {

  var totalPrice = $radios.filter(function() {
    return this.checked && this.value === '1'
  }).length;

  $('#sub_total').val(totalPrice);

});

// change first one on page load for demo
$radios.first().change()

function total_GR() {
var atas = parseInt(document.getElementById('sub_total').value);
var bawah = parseInt(document.getElementById('total').value);
var hasile_GR = atas / bawah * 100;

	if (hasile_GR >= 0 && hasile_GR <= 49) {
		document.getElementById("hasilGR").value = "D : Buruk";
	}
	if (hasile_GR >= 50 && hasile_GR <= 69) {
		document.getElementById("hasilGR").value = "C : Cukup";
	}
	if (hasile_GR >= 70 && hasile_GR <= 89) {
		document.getElementById("hasilGR").value = "B : Baik";
	}
	if (hasile_GR >= 90) {
		document.getElementById("hasilGR").value = "A : Prima";
	}

}
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
			"searching": true,
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
                "url"  : "<?php echo base_url();?>kabid/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                           
                      { "data": "id_pengajuan","searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "tgl_pengajuan","searchable":false },
					  { "data": "nama_status_diusulkan","searchable":false },					  
					  { "data": "id_asesor","searchable":false },					  
					  { "data": "acc_kabid", 
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
							}else if (row.acc_kabid === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.acc_kabid === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}					  
					  },
					  { "data": "tgl_acc_kabid","searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-search'></i> Lihat Pengajuan",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/'.$page.'/isi/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-user-plus'></i> Pilih Asesor",
                    extend: "selected",
                    className: "btnblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/'.$page.'/asesor/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-recycle'></i> Return Data Kabid",
                    extend: "selected",
                    className: "btnlime",
                    action: function ( e, dt, node, config ) {
                       kabid = dt.rows( { selected: true } ).data()[0]['acc_kabid'];  
                       asesor = dt.rows( { selected: true } ).data()[0]['acc_asesor'];  
                       komite = dt.rows( { selected: true } ).data()[0]['acc_komite'];  
                       direktur = dt.rows( { selected: true } ).data()[0]['acc_direktur'];  
                       idp = dt.rows( { selected: true } ).data()[0]['id_status_diusulkan'];  
                       if( idp=='1'){
	                        if( asesor=='Proses' && komite=='Proses' && direktur=='Proses'){
								data = dt.rows( { selected: true } ).data()[0]['id_pengajuan']; 
								// alert(JSON.stringify(data));
								location.href = '<?php echo base_url('kabid/'.$page.'/proses_kabid/'); ?>'+data;
	                        }
	                        else{
	                            swal({
	                              title: "Data Sudah diValidasi Team Lain",
	                              text: "Data Sudah Tidak Bisa di Edit ",
	                              icon: "warning",
	                              buttons: "Tutup",
	                              dangerMode: true,
	                            })
							}
						}else{
	                            swal({
	                              title: "Bukan Data Kenaikan Tingkat",
	                              text: "Tidak Bisa Di Return",
	                              icon: "warning",
	                              buttons: "Tutup",
	                              dangerMode: true,
	                            })							
						}
                    }
                },
                {
                    text: "<i class='fa fa-recycle'></i> Perbaiki Data ke Asesi",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                     kabid = dt.rows( { selected: true } ).data()[0]['acc_kabid'];  
                     asesor = dt.rows( { selected: true } ).data()[0]['acc_asesor'];  
                     komite = dt.rows( { selected: true } ).data()[0]['acc_komite'];  
                     direktur = dt.rows( { selected: true } ).data()[0]['acc_direktur'];  
                     idp = dt.rows( { selected: true } ).data()[0]['id_status_diusulkan'];  
                       if( idp=='1'){
	                        if( asesor=='Proses' && komite=='Proses' && direktur=='Proses'){
								data = dt.rows( { selected: true } ).data()[0]['id_pengajuan']; 
								// alert(JSON.stringify(data));
								location.href = '<?php echo base_url('kabid/'.$page.'/perbaiki/'); ?>'+data;
	                        }
	                        else{
	                            swal({
	                              title: "Data Sudah diValidasi Team Lain",
	                              text: "Data Sudah Tidak Bisa di Edit ",
	                              icon: "warning",
	                              buttons: "Tutup",
	                              dangerMode: true,
	                            })
							}
						}else{
	                            swal({
	                              title: "Bukan Data Kenaikan Tingkat",
	                              text: "Tidak Bisa Di Perbaiki Ke Asesi",
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
			"searching": true,
			"lengthChange": true,
			"pageLength": 10,
			"scrollX": true, 
		  "initComplete": function (settings, json) {  
			$("#dttb").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
		  },
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
                "url"  : "<?php echo base_url();?>kabid/pengajuan_kompetensi/data2/<?php echo $id; ?>",
                "type" : "POST"
            },
            "columns": [                           
                      { "data": "id_logbook","searchable":false },
                      { "data": "tgl_logbook","searchable":false },
                      { "data": "jam_logbook","searchable":false },
					  { "data": "nama_kode_kewenangan","searchable":false },
					  { "data": "nama_kewenangan" },					  
					  { "data": "jml_logbook","searchable":false },
					  { "data": "v_kabid",
						"render": function(data, type, row){
							if (row.v_kabid === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_kabid === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}						   
					  }	
            ],
            "order": [[6, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> PROSES",
                    extend: "selected",
                    className: "btnyellow",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/v_kabid_kompetensi/0/0/'); ?>'+data+'/<?php echo $id; ?>';
                    }
                },	
                {
                    text: "<i class='fa fa-check'></i> KOMPETEN",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/v_kabid_kompetensi/1/0/'); ?>'+data+'/<?php echo $id; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> TOLAK",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/v_kabid_kompetensi/2/0/'); ?>'+data+'/<?php echo $id; ?>';
                    }
                },				
                {
                    text: "<i class='fa fa-check'></i> KOMPETEN SEMUA",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/v_kabid_kompetensi_all/1/'); ?><?php echo $id; ?>';
                    }
                },	
                {
                    text: "<i class='fa fa-close'></i> TOLAK SEMUA",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/v_kabid_kompetensi_all/2/'); ?><?php echo $id; ?>';
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
	    $('#example1').DataTable({
	      'paging'      : false,
	      'lengthChange': false,
	      'searching'   : false,
	      'ordering'    : false,
	      'info'        : true,
		  'scrollX'		: true ,
		  'scrollX'			: true,
		  'scrollY'			: '350px',
		  'scrollCollapse'	: true,
	    })
	});	
/* 	am4core.ready(function() {
	am4core.useTheme(am4themes_dataviz);
	am4core.useTheme(am4themes_animated);
	var chart = am4core.create("chartdiv", am4charts.PieChart);
	chart.dataSource.url = "<?php echo base_url();?>kabid/pengajuan_kompetensi/tabel/<?php echo $id;?>";
	var pieSeries = chart.series.push(new am4charts.PieSeries());
	pieSeries.dataFields.value = "total";
	pieSeries.dataFields.category = "nama_kompetensi";
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
		title.text = "GRAFIK PERSENTASE KOMPETENSI";
		title.fontSize = 25;

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
	});	 */
<?php
}
elseif ($page=="pengajuan_kompetensi_asesor")  
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
			"searching": true,
			"lengthChange": true,
			"pageLength": 10,
			"scrollX": true, 
		  "initComplete": function (settings, json) {  
			$("#dttb").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
		  },
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
                "url"  : "<?php echo base_url();?>kabid/pengajuan_kompetensi/data3",
                "type" : "POST"
            },
            "columns": [                        
                      { "data": "id_pegawai","searchable":false, "orderable":false },
					  { "data": "nama_pegawai" },
                      { "data": "no_hp", "orderable": false,"searchable":false, "orderable":false },
                      { "data": "nama_kode_kewenangan", "searchable":false }	
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                 {
                  text: "<i class='fa fa-search'></i> Detil Asesor",
                  extend: "selected",
                  className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];  
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('kabid/pengajuan_kompetensi/histori/'); ?>'+data,
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },			
                {
                    text: "<i class='fa fa-user-plus'></i> Pilih",
                    extend: "selected",
                    className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai']; 
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('kabid/pengajuan_kompetensi/simpan_asesor/'); ?><?php echo $id; ?>/'+data;
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