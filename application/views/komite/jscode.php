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
elseif ($page=="user")
{
?>
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);
	});
	$("#key").keypress(function(event) {
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
                "url"  : "<?php echo base_url();?>komite/<?php echo $page;?>/data1",
                "type" : "POST"
            },
            "columns": [
					  { "data": "id_pegawai","searchable":false,"visible":false },
					  { "data": "nama_pegawai" },
					  { "data": "no_hp","searchable":false },
					  { "data": "nama_ruangan","searchable":false },
					  { "data": "nip","searchable":false },
					  { "data": "no_profesi","searchable":false },
					  {
						"data": "foto",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a class='example-image-link' href='<?php echo base_url();?>assets/foto/"+oData.foto+"' data-lightbox='example-set' data-title='Foto User'>Klik Untuk Melihat</a>")
						}
					  }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('komite/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    extend: "selected",
                    className: "btnUbah",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/'.$page.'/edit/'); ?>'+data;
                    }
                },
/*                  {
                     text: "<i class='fa fa-edit'></i> Reset Password to 7654321",
                     extend: "selected",
                     className: "btnLulus",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_user'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan mereset password ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_perawat/'.$page.'/reset/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 }, */
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
		$(".btnTambah").removeClass("dt-button").addClass("btn bg-navy btn-sm");
		$(".btnEdit").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnUbah").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
		$(".btnCetak").removeClass("dt-button").addClass("btn bg-olive btn-sm");
		$(".btnLulus").removeClass("dt-button").addClass("btn btn-danger btn-sm");
		$(".btnHapus").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})
	});
<?php
}
else if ($page=="user_tambah" || $page=="user_edit")
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
                "url"  : "<?php echo base_url();?>komite/user/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
					  { "data": "id_user","searchable":false,"visible":false },
					  { "data": "username" },
					  { "data": "nama_level" },
					  { "data": "status_user","searchable":false }
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
                          $('.modal-body').load('<?php echo base_url('komite/user/user_tambah/'); ?><?php echo $id;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_user'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('komite/user/user_edit/'); ?>'+data+'/<?php echo $id;?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                 {
                     text: "<i class='fa fa-edit'></i> Reset Password to 7654321",
                     extend: "selected",
                     className: "btnolive",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_user'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan mereset password ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('komite/user/reset/'); ?>'+data+'/<?php echo $id;?>'; //[Modif Disini]
                       }
                     });
                    }
                 },
                 {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_user'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('komite/user/hapus/'); ?>'+data+'/<?php echo $id;?>'; //[Modif Disini]
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})
});
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
	  '<tr> <td>Tgl Acc Karu:</td><td>'+d.tgl_v_karu+'</td> <td style="width: 5%"></td><td>Jam Logbook:</td><td>'+d.jam_logbook+'</td> </tr>'+
	  '<tr> <td>Acc Karu:</td><td>'+d.v_karu+'</td> <td style="width: 5%"></td><td>Acc Kabid:</td><td>'+d.v_kabid+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>komite/<?php echo $page;?>/data/<?php echo $first_date; ?>/<?php echo $last_date; ?>/<?php echo $id; ?>",
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
                      { "data": "id_logbook","searchable":false },
                      { "data": "tgl_logbook","searchable":false },
					  { "data": "nama_pegawai","searchable":false },
					  { "data": "nama_kode_kewenangan","searchable":false },
					  { "data": "nama_kewenangan" },
					  { "data": "jml_logbook","searchable":false },
					  { "data": "v_asesor",
						"render": function(data, type, row){
							if (row.v_asesor === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_asesor === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "v_komite",
						"render": function(data, type, row){
							if (row.v_komite === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_komite === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "result_tolak",
						"render": function(data, type, row){
							if (row.result_tolak === '') {
							   return '';
						   } else if (row.result_tolak === 'Supervisi') {
							   return '<button class="btn btn-xs btn-danger"> Supervisi</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
						   }
						}
					  }
            ],
            "order": [[9, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> PROSES",
                    extend: "selected",
                    className: "btnyellow",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        data3 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/v_kabid_logbook/0/0/'); ?>'+data+'/'+data3+'/'+data2+'/<?php echo $first_date; ?>/<?php echo $last_date; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-check'></i> SETUJU",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
						data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
						data3 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/v_kabid_logbook/1/0/'); ?>'+data+'/'+data3+'/'+data2+'/<?php echo $first_date; ?>/<?php echo $last_date; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Supervisi",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
						data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
						data3 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/v_kabid_logbook/2/1/'); ?>'+data+'/'+data3+'/'+data2+'/<?php echo $first_date; ?>/<?php echo $last_date; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Tidak Kompeten",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
						data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
						data3 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/v_kabid_logbook/2/2/'); ?>'+data+'/'+data3+'/'+data2+'/<?php echo $first_date; ?>/<?php echo $last_date; ?>';
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
elseif ($page=="pengajuan_kompetensi")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>Kabid:</td><td>'+d.id_kabid+'</td> <td style="width: 5%"></td><td>Tgl Acc Kabid:</td><td>'+d.tgl_acc_kabid+'</td> </tr>'+
	  '<tr> <td>Asesor:</td><td>'+d.id_asesor+'</td> <td style="width: 5%"></td><td>Tgl Acc Asesor:</td><td>'+d.tgl_acc_asesor+'</td> </tr>'+
	  '<tr> <td>Komite:</td><td>'+d.id_komite+'</td> <td style="width: 5%"></td><td>Tgl Acc Komite:</td><td>'+d.tgl_acc_komite+'</td> </tr>'+
	  '<tr> <td>Sub Kredensial:</td><td>'+d.id_kredensial+'</td> <td style="width: 5%"></td><td>Tgl Acc Sub Kredensial:</td><td>'+d.tgl_kredensial+'</td> </tr>'+
	  '<tr> <td>Sub Mutu:</td><td>'+d.id_mutu+'</td> <td style="width: 5%"></td><td>Tgl Acc Sub Mutu:</td><td>'+d.tgl_mutu+'</td> </tr>'+
	  '<tr> <td>Sub Etika:</td><td>'+d.id_etika+'</td> <td style="width: 5%"></td><td>Tgl Acc Sub Etika:</td><td>'+d.tgl_etika+'</td> </tr>'+
	  '<tr> <td>Direktur:</td><td>'+d.id_direktur+'</td> <td style="width: 5%"></td><td>Tgl Acc Direktur:</td><td>'+d.tgl_acc_direktur+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>komite/<?php echo $page;?>/data",
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
                      { "data": "id_pengajuan", "searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_status_diusulkan","searchable":false },
                      { "data": "tgl_pengajuan","searchable":false },
					  { "data": "acc_komite", "searchable":false,
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
							}else if (row.acc_komite === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.acc_komite === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  {
						"data": "kredensial", "searchable":false,
							"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
								if (oData.kredensial === '') {

								}else{
									$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.kredensial+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
								}
							}
					  },
					  {
						"data": "mutu", "searchable":false,
							"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
								if (oData.mutu === '') {

								}else{
									$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.mutu+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
								}
							}
					  },
					  {
						"data": "etika", "searchable":false,
							"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
								if (oData.etika === '') {

								}else{
									$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.etika+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
								}
							}
					  },
            {
						"data": "spk", "searchable":false,
							"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
								if (oData.spk === '') {

								}else{
									$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.spk+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
								}
							}
					  },
					  { "data": "status_terbitkan", "searchable":false,
						"render": function(data, type, row){
							if (row.status_terbitkan === 'Belum Diterbitkan') {
							   return '<button class="btn btn-xs btn-warning"> Belum Diterbitkan</button>';
						   } else if (row.status_terbitkan === 'Terbitkan') {
							   return '<button class="btn btn-xs btn-success"> Terbitkan</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Tidak diterbitkan</button>';
						   }
						}
					  }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-search'></i> Lihat Pengajuan",
                    extend: "selected",
                    className: "btnyellow",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/'.$page.'/isi/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-recycle'></i> Perbaiki Data Pengajuan Pegawai",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        kabid = dt.rows( { selected: true } ).data()[0]['acc_kabid'];
                        asesor = dt.rows( { selected: true } ).data()[0]['acc_asesor'];
                        komite = dt.rows( { selected: true } ).data()[0]['acc_komite'];
                        direktur = dt.rows( { selected: true } ).data()[0]['acc_direktur'];
                        if( direktur=='Proses'){
							data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
							// alert(JSON.stringify(data));
							location.href = '<?php echo base_url('komite/'.$page.'/proses_kabid/'); ?>'+data;
                        }
                        else{
                            swal({
                              title: "Data Sudah diValidasi Direktur",
                              text: "Data Sudah Tidak Bisa di Edit ",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
						}
                    }
                },
                {
                    text: "<i class='fa fa-recycle'></i> Return Data Komite",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        kabid = dt.rows( { selected: true } ).data()[0]['acc_kabid'];
                        asesor = dt.rows( { selected: true } ).data()[0]['acc_asesor'];
                        komite = dt.rows( { selected: true } ).data()[0]['acc_komite'];
                        direktur = dt.rows( { selected: true } ).data()[0]['acc_direktur'];
                      //  if( data=='Pendaftaran' || data=='Diambil' || data=='Triase IGD'){
                        if(direktur=='Proses'){
							data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
							// alert(JSON.stringify(data));
							location.href = '<?php echo base_url('komite/'.$page.'/perbaiki/'); ?>'+data;
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
                    }
                },
                {
                    text: "<i class='fa fa-upload'></i> Sub Kredensial",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/'.$page.'/upload_kredensial/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-upload'></i> Sub Mutu",
                    extend: "selected",
                    className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/'.$page.'/upload_mutu/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-upload'></i> Sub Etika",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/'.$page.'/upload_etika/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-upload'></i> Rekomendasi",
                    extend: "selected",
                    className: "btnyellow",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/'.$page.'/upload_spk/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-recycle'></i> Return Terbitkan SPK",
                    extend: "selected",
                    className: "btnblue",
                    action: function ( e, dt, node, config ) {
                        kabid = dt.rows( { selected: true } ).data()[0]['acc_kabid'];
                        no_terbitkan = dt.rows( { selected: true } ).data()[0]['no_terbitkan'];
                        komite = dt.rows( { selected: true } ).data()[0]['acc_komite'];
                        direktur = dt.rows( { selected: true } ).data()[0]['acc_direktur'];
                        status_terbitkan = dt.rows( { selected: true } ).data()[0]['status_terbitkan'];
                        if(komite=='Kompeten' && no_terbitkan>0){
							data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
							// alert(JSON.stringify(data));
							location.href = '<?php echo base_url('komite/'.$page.'/terbitkan/'); ?>'+data+'/0';
                        }
                        else{
                            swal({
                              title: "Cek Validasi Data",
                              text: "Mohon Cek Validasi / Return Terbitkan SPK",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
						}
                    }
                },
                {
                    text: "<i class='fa fa-check'></i> Terbitkan SPK",
                    extend: "selected",
                    className: "btngreen",
                    action: function ( e, dt, node, config ) {
                        kabid = dt.rows( { selected: true } ).data()[0]['acc_kabid'];
                        no_terbitkan = dt.rows( { selected: true } ).data()[0]['no_terbitkan'];
                        komite = dt.rows( { selected: true } ).data()[0]['acc_komite'];
                        direktur = dt.rows( { selected: true } ).data()[0]['acc_direktur'];
                        status_terbitkan = dt.rows( { selected: true } ).data()[0]['status_terbitkan'];
                        if(komite=='Kompeten' && no_terbitkan==0){
							data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
							// alert(JSON.stringify(data));
							location.href = '<?php echo base_url('komite/'.$page.'/terbitkan/'); ?>'+data+'/1';
                        }
                        else{
                            swal({
                              title: "Cek Validasi Data",
                              text: "Mohon Cek Validasi / Return Terbitkan SPK",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
						}
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Tidak Terbitkan SPK",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        kabid = dt.rows( { selected: true } ).data()[0]['acc_kabid'];
                        no_terbitkan = dt.rows( { selected: true } ).data()[0]['no_terbitkan'];
                        komite = dt.rows( { selected: true } ).data()[0]['acc_komite'];
                        direktur = dt.rows( { selected: true } ).data()[0]['acc_direktur'];
                        status_terbitkan = dt.rows( { selected: true } ).data()[0]['status_terbitkan'];
                        if(komite=='Kompeten' && no_terbitkan==0){
							data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
							// alert(JSON.stringify(data));
							location.href = '<?php echo base_url('komite/'.$page.'/terbitkan/'); ?>'+data+'/2';
                        }
                        else{
                            swal({
                              title: "Cek Validasi Data",
                              text: "Mohon Cek Validasi / Return Terbitkan SPK",
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
                "url"  : "<?php echo base_url();?>komite/pengajuan_kompetensi/data2/<?php echo $id; ?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook","searchable":false },
                      { "data": "tgl_logbook","searchable":false },
                      { "data": "jam_logbook","searchable":false },
					  { "data": "nama_kode_kewenangan","searchable":false },
					  { "data": "nama_kewenangan" },
					  { "data": "jml_logbook","searchable":false },
					  { "data": "v_komite",
						"render": function(data, type, row){
							if (row.v_komite === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_komite === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "result_tolak",
						"render": function(data, type, row){
							if (row.result_tolak === '') {
							   return '';
						   } else if (row.result_tolak === 'Supervisi') {
							   return '<button class="btn btn-xs btn-danger"> Supervisi</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
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
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/v_kabid_kompetensi/0/0/'); ?>'+data+'/<?php echo $id; ?>/'+data2;
                    }
                },
                {
                    text: "<i class='fa fa-check'></i> SETUJU",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
						data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/v_kabid_kompetensi/1/0/'); ?>'+data+'/<?php echo $id; ?>/'+data2;
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Supervisi",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
						data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/v_kabid_kompetensi/2/1/'); ?>'+data+'/<?php echo $id; ?>/'+data2;
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Tidak Kompeten",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
						data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('komite/v_kabid_kompetensi/2/2/'); ?>'+data+'/<?php echo $id; ?>/'+data2;
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
        var table2 = $('#dttb2').DataTable( {
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
                "url"  : "<?php echo base_url();?>komite/pengajuan_kompetensi/pemulihan/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook_pemulihan", "searchable":false, "visible":true },
                      { "data": "tgl_awal", "searchable":false },
					  { "data": "tgl_akhir", "searchable":false },
					  { "data": "nama_pegawai", "searchable":false },
                      { "data": "nama_ruangan", "searchable":false },
					  { "data": "result_pemulihan",
						"render": function(data, type, row){
							if (row.result_pemulihan === '0') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.result_pemulihan === '1') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "catatan_pemulihan", "searchable":false },
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-search'></i> Lihat Pemulihan",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook_pemulihan'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('komite/pengajuan_kompetensi/lihat_pemulihan/'); ?>'+data,function(){
                          $('#modal-default').modal({show:true});
                        });

                  }
              },
              {
                text: "<i class='fa fa-search'></i> Lihat Kegiatan Pemulihan",
                extend: "selected",
                className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook_pemulihan'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('komite/pengajuan_kompetensi/lihat_kegiatan/'); ?>'+data,function(){
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
	chart.dataSource.url = "<?php echo base_url();?>komite/pengajuan_kompetensi/tabel/<?php echo $id;?>";
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
	}); */
<?php
}
?>
</script>
		</div>
	</body>
</html>
