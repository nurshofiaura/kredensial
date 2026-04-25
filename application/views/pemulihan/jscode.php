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
elseif ($page=="daftar")
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td colspan="2">RM:</td><td colspan="2">'+d.rm+'</td> <td colspan="2">Jam :</td><td colspan="2">'+d.jam_logbook+'</td></tr>'+
	  '<tr> <td colspan="2">Tgl Karu:</td><td colspan="2">'+d.tgl_v_karu+'</td> <td colspan="2">Acc Kabid:</td><td colspan="2">'+d.tgl_v_kabid+'</td></tr>'+
	  '<tr> <td colspan="2">Acc Asesor:</td><td colspan="2">'+d.tgl_v_asesor+'</td> <td colspan="2">Acc Komite:</td><td colspan="2">'+d.tgl_v_komite+'</td></tr>'+
	  '<tr> <td colspan="2">Acc Direktur:</td><td colspan="2">'+d.tgl_v_direktur+'</td> <td colspan="2">Acc Komite:</td><td colspan="2">'+d.tgl_v_komite+'</td></tr>'+
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
                "url"  : "<?php echo base_url();?>pemulihan/<?php echo $page;?>/data/<?php echo $id;?>",
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
                      { "data": "id_logbook", "searchable":false, "visible":false },
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
					            { "data": "nama_kewenangan" },
					  { "data": "v_karu",
						"render": function(data, type, row){
							if (row.v_karu === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_karu === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else if (row.v_karu === 'Ditolak') {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   } else {
							   return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
						   }
						}
					  },
                      { "data": "v_kabid",
						"render": function(data, type, row){
							if (row.v_kabid === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_kabid === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else if (row.v_kabid === 'Ditolak') {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   } else {
							   return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
						   }
						}
					  },
                      { "data": "v_asesor",
						"render": function(data, type, row){
							if (row.v_asesor === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_asesor === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else if (row.v_asesor === 'Ditolak') {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   } else {
							   return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
						   }
						}
					  },
                      { "data": "v_komite",
						"render": function(data, type, row){
							if (row.v_komite === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_komite === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else if (row.v_komite === 'Ditolak') {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   } else {
							   return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
						   }
						}
					  },
                      { "data": "v_direktur",
						"render": function(data, type, row){
							if (row.v_direktur === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_direktur === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else if (row.v_direktur === 'Ditolak') {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   } else {
							   return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
						   }
						}
          },
            { "data": "result_tolak",
            "render": function(data, type, row){
              if (row.result_tolak === 'Supervisi') {
                 return '<button class="btn btn-xs btn-danger"> Supervisi</button>';
               } else if (row.result_tolak === 'Tidak Kompeten') {
                 return '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
               } else {
                 return '';
               }
            }
            }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-user'></i> Daftarkan Pegawai Untuk Pemulihan",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('pemulihan/'.$page.'/pendaftaran/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})
	});
<?php
}
elseif ($page=="kegiatan")
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
                "url"  : "<?php echo base_url();?>pemulihan/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook_pemulihan", "searchable":false },
                      { "data": "tgl_awal", "searchable":false },
                      { "data": "tgl_akhir", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
					            { "data": "nama_ruangan" },
                      { "data": "result_pemulihan",
						"render": function(data, type, row){
							if (row.result_pemulihan === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.result_pemulihan === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else if (row.result_pemulihan === 'Tidak Kompeten') {
							   return '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
						   }
						}
          },
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                  text: "<i class='fa fa-cog'></i> Seting Pemulihan",
                  extend: "selected",
                  className: "btnpurple",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook_pemulihan'];
                      // alert(JSON.stringify(data));
                      location.href = '<?php echo base_url('pemulihan/'.$page.'/edit/'); ?>'+data;
                  }
              },
              {
                  text: "<i class='fa fa-search'></i> Hasil Kegiatan",
                  extend: "selected",
                  className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_logbook_pemulihan'];
                      // alert(JSON.stringify(data));
                      location.href = '<?php echo base_url('pemulihan/'.$page.'/hasil/'); ?>'+data;
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
elseif ($page=="kegiatan_edit")
{
?>
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
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);
	});
	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
  function format ( d ) {        // `d` is the original data object for the row
    return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
  '<tr> <td colspan="4">VALIDASI SEBELUM KEGIATAN PEMULIHAN</td></tr>'+
  '<tr> <td>V Karu:</td><td>'+d.v_karub+'</td> <td>Tgl Karu:</td><td>'+d.tgl_v_karub+'</td></tr>'+
  '<tr> <td>V Kabid:</td><td>'+d.v_kabidb+'</td> <td>Tgl Kabid:</td><td>'+d.tgl_v_kabidb+'</td></tr>'+
  '<tr> <td>V Asesor:</td><td>'+d.v_asesorb+'</td> <td>Tgl Asesor:</td><td>'+d.tgl_v_asesorb+'</td></tr>'+
  '<tr> <td>V Komite:</td><td>'+d.v_komiteb+'</td> <td>Tgl Komite:</td><td>'+d.tgl_v_komiteb+'</td></tr>'+
  '<tr> <td>V Direktur:</td><td>'+d.v_direkturb+'</td> <td>Tgl Direktur:</td><td>'+d.tgl_v_direkturb+'</td></tr>'+
  '<tr> <td>Result Tolak:</td><td>'+d.result_tolakb+'</td> <td>RM:</td><td>'+d.rm+'</td></tr>'+
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
                "url"  : "<?php echo base_url();?>pemulihan/kegiatan/data2/<?php echo $id;?>",
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
                      { "data": "id_logbook_pemulihan_detil", "searchable":false },
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "nama_kewenangan" },
					            { "data": "nama_ruangan", "searchable":false }
            ],
            "order": [[1, 'desc']] ,
    //        select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                  text: "<i class='fa fa-plus'></i> Tambah Penolakan Kewenangan",
                  className: "btnmaroon",
                  init: function(api, node, config) {
                      $(node).removeClass('btn-default')
                  },
                  action: function ( e, dt, node, config ) {
                      location.href = '<?php echo base_url('pemulihan/kegiatan/tambah/'); ?><?php echo $id;?>';
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
elseif($page=='kegiatan_tambah')
{
?>
$(function(){
	$('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
	  'scrollX'		: true ,
	  'scrollX'			: true,
	  'scrollY'			: '350px',
	  'scrollCollapse'	: true,
    })
});
<?php
}
elseif ($page=="kegiatan_hasil")
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
                "url"  : "<?php echo base_url();?>pemulihan/kegiatan/data3/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_kegiatan_pemulihan", "searchable":false },
                      { "data": "tgl_kegiatan_pemulihan", "searchable":false },
                      { "data": "nama_kewenangan" },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "rm_kegiatan_pemulihan", "searchable":false },
					            { "data": "catatan_kegiatan_pemulihan", "searchable":false },
                      { "data": "result_pemulihan",
						"render": function(data, type, row){
							if (row.result_kegiatan_pemulihan === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.result_kegiatan_pemulihan === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else if (row.result_kegiatan_pemulihan === 'Tidak Kompeten') {
							   return '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-warning"> Non Keperawatan</button>';
						   }
						}
          },
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
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
<?php
}
?>
</script>
		</div>
	</body>
</html>
