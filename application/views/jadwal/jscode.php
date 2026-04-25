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
elseif ($page=="elemen")
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
                "url"  : "<?php echo base_url();?>jadwal/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_dinas_jaga", "searchable":false },
					  { "data": "nama_dinas_jaga" },
					  { "data": "nama_warna", "searchable":false },
					  { "data": "text", "searchable":false }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
			"columnDefs": [
				{
					"targets": [ 0 ],
					"visible": false,
					"searchable": false
				}
			],
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
				$(row).css('background-color', data['kode_warna']);
				$(row).css('color', data['text_warna']);
              },
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah Elemen Dinas",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Rubah Elemen Dinas",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                    //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                    //    data2 = dt.rows( { selected: true } ).data()[0]['protect'];
/*                         if(data2=='PROTEKSI'){
                            swal({
                              title: "DATA STANDAR TIDAK BISA DI EDIT",
                              text: "Silahkan Tambah Elemen",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                        else{ */
							data1 = dt.rows( { selected: true } ).data()[0]['id_dinas_jaga'];
							$("#modal-default").modal();
							  $('.modal-body').load('<?php echo base_url('jadwal/'.$page.'/edit/'); ?>'+data1,function(){
								$('#modal-default').modal({show:true});
							  });
					//	}
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
elseif ($page=="pelengkap")
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
                "url"  : "<?php echo base_url();?>jadwal/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "no_urutan", "searchable":false },
					  { "data": "nama_pegawai", "searchable":false }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Sesuaikan Signature",
                    className: "btnolive",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal/'.$page.'/signature/'); ?><?php echo $id;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Sesuaikan Urutan",
                    extend: "selected",
                    className: "btnaqua",
                    action: function ( e, dt, node, config ) {
						data1 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
						$("#modal-default").modal();
						  $('.modal-body').load('<?php echo base_url('jadwal/'.$page.'/urutan/'); ?>'+data1,function(){
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
elseif ($page=="jadwal_dinas")
{
?>
	$('#tahun').inputmask("9999",{
		placeholder: "yyyy"
	});
    $(document).ready(function() {
	$('.select2').select2();
   	var example1 = $('#example1').DataTable({
      'paging'      	: false,
      'lengthChange'	: false,
      'searching'   	: false,
      'ordering'    	: false,
      'info'        	: false,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true,
	  'fixedColumns'	: true
    });new $.fn.dataTable.FixedColumns(example1, { leftColumns: 1 }); 

        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
			"scrollX": true,
            "ajax": {
                "url"  : "<?php echo base_url();?>jadwal/<?php echo $page;?>/pegawai",
                "type" : "POST"
            },
            "columns": [
					  { "data": "no_urutan", "visible":false },
					  { "data": "nama_pegawai" }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
/*            rowCallback: function(row, data, index){
				$(row).css('background-color', data['kode_warna']);
				$(row).css('color', data['text_warna']);
              },*/
            "buttons": [
                {
                    text: "<i class='fa fa-calendar'></i> Input Hari Libur",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('jadwal/'.$page.'/hari_libur/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>';
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Input Jadwal",
                    extend: "selected",
                    className: "btnTambah",
                    action: function ( e, dt, node, config ) {
						data1 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
						$("#modal-default").modal();
						  $('.modal-body').load('<?php echo base_url('jadwal/'.$page.'/tambah_dinas/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/'+data1,function(){
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
		$(".btnTambah").removeClass("dt-button").addClass("btn bg-navy btn-sm");
		$(".btnEdit").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnUbah").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
		$(".btnCetak").removeClass("dt-button").addClass("btn bg-olive btn-sm");
		$(".btnHapus").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
	});
<?php
}
elseif ($page=="jadwal_dinasx")
{
?>
	$('#tahun').inputmask("9999",{
		placeholder: "yyyy"
	});

$(document).ready(function() { 
	var table = $('#example').DataTable({
	scrollY: "300px", 
	scrollX: true, 
	scrollCollapse: true, 
	paging: false 
});
	new $.fn.dataTable.FixedColumns(table, { leftColumns: 2 }); 
});

    $(document).ready(function() {
	$('.select2').select2();
   	var example1 = $('#example1').DataTable({
      'paging'      	: false,
      'lengthChange'	: false,
      'searching'   	: false,
      'ordering'    	: false,
      'info'        	: false,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true,
	  'fixedColumns'	: true
    });new $.fn.dataTable.FixedColumns(example1, { leftColumns: 1 }); 
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
			"scrollX": true,
            "ajax": {
                "url"  : "<?php echo base_url();?>jadwal/<?php echo $page;?>/data/<?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $id_pegawai;?>",
                "type" : "POST"
            },
            "columns": [
					  { "data": "no_urutan", "visible":false },
					  { "data": "tgl_jadwal", "orderable":false },
					  { "data": "nama_pegawai", "orderable":false },
					  { "data": "nama_dinas_jaga", "orderable":false }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
				$(row).css('background-color', data['kode_warna']);
				$(row).css('color', data['text_warna']);
              },
            "buttons": [
                {
                    text: "<i class='fa fa-calendar'></i> Input Hari Libur",
                    className: "btnReload",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('jadwal/'.$page.'/hari_libur/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $id_pegawai;?>';
                    }
                },
                {
                    text: "<i class='fa fa-plus'></i> Input Jadwal",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('jadwal/'.$page.'/tanggal/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $id_pegawai;?>';
                    }
                },
                {
                    text: "<i class='fa fa-edit'></i> Rubah Jadwal",
                    extend: "selected",
                    className: "btnCetak",
                    action: function ( e, dt, node, config ) {
						data1 = dt.rows( { selected: true } ).data()[0]['id_jadwal'];
						$("#modal-default").modal();
						  $('.modal-body').load('<?php echo base_url('jadwal/'.$page.'/rubah_dinas/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $id_pegawai;?>/'+data1,function(){
							$('#modal-default').modal({show:true});
						  });
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    extend: "selected",
                    className: "btnHapus",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_jadwal'];
                    swal({
                      title: "Yakin ?",
                      text: "Yakin akan Menghapus ",     //[Modif Disini]
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        location.href = '<?php echo base_url('jadwal/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
                      }
                    });
                   }
                },
                {
                    text: "<i class='fa fa-file-pdf-o'></i> Pdf",
                    className: "btnEdit",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_unit'];
						window.open('<?php echo base_url('jadwal/'.$page.'/pdf/'); ?><?php echo $bulan;?>/<?php echo $tahun;?>/<?php echo $ruangan;?>');
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
		$(".btnTambah").removeClass("dt-button").addClass("btn bg-navy btn-sm");
		$(".btnEdit").removeClass("dt-button").addClass("btn bg-orange btn-sm");
        $(".btnUbah").removeClass("dt-button").addClass("btn bg-maroon btn-sm");
		$(".btnCetak").removeClass("dt-button").addClass("btn bg-olive btn-sm");
		$(".btnHapus").removeClass("dt-button").addClass("btn bg-purple btn-sm");
        $(".btnReload").removeClass("dt-button").addClass("btn btn-success btn-sm");
	});


am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['showtgl_jadwal'].'"'; ?>,
  <?php
  $jsonx = $this->m_jadwal->lb2($row1['tgl_jadwal'],$row1['id_pegawai']);
  foreach($jsonx as $row2){
  ?>
  <?php echo '"'.$row2['id_pegawai'].'"'; ?>:<?php echo $row2['jml_dinas_jaga']; ?>,
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
foreach($ambil_data_pegawai as $row1x){
?>
// Create series
var series<?php echo $row1x['id_pegawai']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_pegawai']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_pegawai'].'"'; ?>;
series<?php echo $row1x['id_pegawai']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_pegawai']; ?>.name = <?php echo '"'.$row1x['nama_pegawai'].'"'; ?>;
series<?php echo $row1x['id_pegawai']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_pegawai']; ?>.tooltipText = "{name} : {valueY} Jam";
series<?php echo $row1x['id_pegawai']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_pegawai']; ?>.visible  = false;

let hs<?php echo $row1x['id_pegawai']; ?> = series<?php echo $row1x['id_pegawai']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_pegawai']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_pegawai']; ?>.segments.template.strokeWidth = 1;

<?php
}
?>
// Add chart cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "zoomY";
    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;
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
chart.legend.scrollable = true
        
chart.legend.itemContainers.template.events.on("out", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = false;
  })
})
//chart.rightAxesContainer.layout = "vertical";
chart.exporting.menu = new am4core.ExportMenu();
}); // end am4core.ready()
<?php
}
else if($page=='jadwal_dinas_tanggal' || $page=='jadwal_dinas_hari_libur')
{
?>
    $(document).ready(function() {
		$('.select2').select2()
		$('.checkall').on('click', function() {
			$('.child').prop('checked', this.checked)
		});
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
	  radioClass   : 'iradio_minimal-blue'
    })
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
	  radioClass   : 'iradio_minimal-red'
    })
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
	  radioClass   : 'iradio_flat-green'
    })
   	var example1 = $('#example1').DataTable({
      'paging'      	: false,
      'lengthChange'	: false,
      'searching'   	: false,
      'ordering'    	: false,
      'info'        	: false,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true,
	  'fixedColumns'	: true
    });new $.fn.dataTable.FixedColumns(example1, { leftColumns: 1 }); 
	});
<?php
}
elseif ($page=="lihat_jadwal")
{
?>
$('#tahun').inputmask("9999",{
	placeholder: "yyyy"
});
    $(document).ready(function() {
	$('.select2').select2()
   	var example1 = $('#example1').DataTable({
      'paging'      	: false,
      'lengthChange'	: false,
      'searching'   	: false,
      'ordering'    	: false,
      'info'        	: false,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true,
	  'fixedColumns'	: true
    });new $.fn.dataTable.FixedColumns(example1, { leftColumns: 1 }); 
	});
<?php
}
elseif ($page=="chat")
{
?>
$('#tahun').inputmask("9999",{
	placeholder: "yyyy"
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
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);
	});
	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    $(document).ready(function() {
		$('.select2').select2()
		CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": true,
//			"pageLength": 10,
			"scrollX": true,
	  "lengthMenu"		: [5,10],
	//  "lengthMenu"		: [[10, 20, 30, -1], [10, 20, 30, "All"]]
	"pageLength": 1,
            "ajax": {
                "url"  : "<?php echo base_url();?>jadwal_all/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>",
                "type" : "POST"
            },
            "columns": [
					  { "data": "wkt_chat", "searchable":false, "visible":false },
					  { "data": "isi_chat", "orderable":false  }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
/*            rowCallback: function(row, data, index){
				$(row).css('background-color', data['kode_warna']);
				$(row).css('color', data['text_warna']);
              },*/
            "buttons": [
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_chat'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_chat'];
                    swal({
                      title: "Yakin ?",
                      text: "Yakin akan Menghapus ",     //[Modif Disini]
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        location.href = '<?php echo base_url('jadwal_all/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
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
elseif ($page=="pasien")
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
				"url"  : "<?php echo base_url();?>jadwal_all/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "rm", className : "text-center"},
                      { "data": "nama_pasien", "orderable":false,
                            "render": function ( data, type, row ) {
                                return row.nama_pasien + ' <b>(umur : ' + row.umur + ', alamat : ' + row.alamat + ')</b>';
                            }
                      },
                      { "data": "nama_working", "searchable":false, "orderable":false }
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
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/tambah'); ?>',
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pasien'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="pengambilan")
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
    $('#tgl_ambil').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_ambil").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
var status=0;
$('#tgl_lahir').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_lahir").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
/*function load_pmr() {
  $('.pemeriksaane').load('<?php echo base_url('jadwal_all/pengambilan/tabel/'); ?><?= $first_date ?>/<?= $last_date ?>/<?= $key ?>');
}*/
  function format ( d ) {        // `d` is the original data object for the row
    return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
      '<tr><td>Tujuan:</td><td>'+d.unit_tindakan+'</td> <td></td><td>Dokter:</td><td>'+d.dr_tindakan+'</td> </tr>'+
      '<tr><td>Pengirim:</td><td>'+d.unit_pengirim+'</td> <td></td><td>Pengirim:</td><td>'+d.dr_pengirim+'</td> </tr>'+
      '<tr><td>RM:</td><td>'+d.rm+'</td> <td></td><td>Pasien:</td><td>'+d.nama_pasien+'</td> </tr>'+
      '<tr><td>Umur:</td><td>'+d.umur+'</td> <td></td><td>Alamat:</td><td>'+d.alamat+'</td> </tr>'+
      '<tr><td>Status Pengambilan :</td><td colspan="4">'+d.status_ambil+'</td> </tr>'+
      '</table>';
  }
    $(document).ready(function() {
//    	load_pmr();
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
                "url"  : "<?php echo base_url();?>jadwal_all/pengambilan/data/<?= $first_date ?>/<?= $last_date ?>/<?= $key ?>",
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
  					  { "data": "tgl_ambil","searchable":false },
  					  { "data": "nama_pasien","orderable":false },
  					  { "data": "nama_tindakan","orderable":false, className: "bolded" },
  					  { "data": "dr_tindakan","orderable":false },
  					  { "data": "unit_pengirim","orderable":false },
  					  { "data": "dr_pengirim","orderable":false },
  					  { "data": "nama_pengambil","orderable":false } 
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
/*			rowCallback: function(row, data, index){
		  	if(data[3]> 11.7){
		    	$(row).find('td:eq(3)').css('color', 'red');
		    }
		    if(data[2].toUpperCase() == 'EE'){
		    	$(row).find('td:eq(2)').css('color', 'blue');
		    }
		  },*/
/*            rowCallback: function(row, data, index){
                if(data['status_pembelian']=="Done"){                
                    $(row).find('td:eq(6)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(6)').css('color', 'red');
                }
              }, */
            rowCallback: function(row, data, index){
				$(row).find('td:eq(2)').css('background-color','#F99');
		//		$(row).find('td:eq(3)').css('background-color','#F99');
			//	$(row).find('td:eq(7)').css('color', 'green');
			//	$(row).find('td:eq(8)').css('color', 'green');
              },
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                   action: function ( e, dt, node, config ) {  
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/tambah'); ?>',
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_ambil'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/pengambilan/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_ambil'];
                    swal({
                      title: "Yakin ?",
                      text: "Yakin akan Menghapus ",     //[Modif Disini]
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        location.href = '<?php echo base_url('jadwal_all/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
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
      $('#nama_pasien').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/pasien_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("nama_pasien").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
      $('#rm').autocomplete({
        minChars : '3',
        type: 'GET',
        serviceUrl: '<?php echo base_url();?>jadwal_all/rm_cari_data',
        dataType: 'json',
        onSelect: function (data) {
            document.getElementById("rm").value = data.data;
            $('#nama_pasien').val(data.nama_pasien);
            $('#rm').val(data.rm);
            $('#tgl_lahir').val(data.tgl_lahir);
            $('#jk').val(data.jk);
            $('#alamat').val(data.alamat);
            status=1;
        }
      });
	});
<?php
}
elseif ($page=="daftar_pengambilan")
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
      '<tr><td>Tujuan:</td><td>'+d.unit_tindakan+'</td> <td></td><td>Dokter:</td><td>'+d.dr_tindakan+'</td> </tr>'+
      '<tr><td>Tujuan:</td><td>'+d.unit_pengirim+'</td> <td></td><td>Dokter:</td><td>'+d.dr_pengirim+'</td> </tr>'+
      '<tr><td>RM:</td><td>'+d.rm+'</td> <td></td><td>Pasien:</td><td>'+d.nama_pasien+'</td> </tr>'+
      '<tr><td>Hasil :</td><td colspan="4">'+d.hasil+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>jadwal_all/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $key;?>",
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
  					  { "data": "tgl_daftar","searchable":false },
  					  { "data": "nama_pasien","orderable":false },
  					  { "data": "umur","orderable":false },
  					  { "data": "nama_tindakan","orderable":false, className: "bolded" },
  					  { "data": "unit_tindakan","orderable":false },
  					  { "data": "dr_tindakan","orderable":false },
  					  { "data": "unit_pengirim","orderable":false },
  					  { "data": "dr_pengirim","orderable":false },
                      { "data": "status_daftar", "searchable":false,"orderable":false, 
                        "render": function(data, type, row){
                            if (row.status_daftar === '0') {
                               return '<button class="btn btn-xs btn-info"> Proses</button>';
                             } else if (row.status_daftar === '1') {
                                return '<button class="btn btn-xs btn-success"> Selesai</button>';
                             } else {
                                return '<button class="btn btn-xs btn-danger">Batal</button>';
                             } 
                         }
                       }, 
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
/*			rowCallback: function(row, data, index){
		  	if(data[3]> 11.7){
		    	$(row).find('td:eq(3)').css('color', 'red');
		    }
		    if(data[2].toUpperCase() == 'EE'){
		    	$(row).find('td:eq(2)').css('color', 'blue');
		    }
		  },*/
/*            rowCallback: function(row, data, index){
                if(data['status_pembelian']=="Done"){                
                    $(row).find('td:eq(6)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(6)').css('color', 'red');
                }
              }, */
            rowCallback: function(row, data, index){
				$(row).find('td:eq(2)').css('background-color','#F99');
				$(row).find('td:eq(3)').css('background-color','#F99');
			//	$(row).find('td:eq(7)').css('color', 'green');
			//	$(row).find('td:eq(8)').css('color', 'green');
              },
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                   action: function ( e, dt, node, config ) {  
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/tambah'); ?>',
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_daftar'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Hasil",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_daftar'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/hasil/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-user-md'></i> Tambah Dokter",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
							location.href = '<?php echo base_url('jadwal_all/pengirim'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-stethoscope'></i> Tambah Pemeriksaan",
                    className: "btnnavy",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
							location.href = '<?php echo base_url('jadwal_all/tindakan'); ?>';
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
elseif ($page=="daftar_tindakan")
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
$('#tahun').inputmask("9999",{
	placeholder: "yyyy"
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
      '<tr><td>Tujuan:</td><td>'+d.unit_tindakan+'</td> <td></td><td>Dokter:</td><td>'+d.dr_tindakan+'</td> </tr>'+
      '<tr><td>Tujuan:</td><td>'+d.unit_pengirim+'</td> <td></td><td>Dokter:</td><td>'+d.dr_pengirim+'</td> </tr>'+
      '<tr><td>RM:</td><td>'+d.rm+'</td> <td></td><td>Pasien:</td><td>'+d.nama_pasien+'</td> </tr>'+
      '<tr><td>Hasil :</td><td colspan="4">'+d.hasil+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>jadwal_all/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id;?>",
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
  					  { "data": "tgl_daftar","searchable":false },
  					  { "data": "nama_pasien","orderable":false },
  					  { "data": "umur","orderable":false },
  					  { "data": "nama_tindakan","orderable":false, className: "bolded" },
  					  { "data": "unit_tindakan","orderable":false },
  					  { "data": "dr_tindakan","orderable":false },
  					  { "data": "unit_pengirim","orderable":false },
  					  { "data": "dr_pengirim","orderable":false },
                      { "data": "status_daftar", "searchable":false,"orderable":false, 
                        "render": function(data, type, row){
                            if (row.status_daftar === '0') {
                               return '<button class="btn btn-xs btn-info"> Proses</button>';
                             } else if (row.status_daftar === '1') {
                                return '<button class="btn btn-xs btn-success"> Selesai</button>';
                             } else {
                                return '<button class="btn btn-xs btn-danger">Batal</button>';
                             } 
                         }
                       }, 
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
/*			rowCallback: function(row, data, index){
		  	if(data[3]> 11.7){
		    	$(row).find('td:eq(3)').css('color', 'red');
		    }
		    if(data[2].toUpperCase() == 'EE'){
		    	$(row).find('td:eq(2)').css('color', 'blue');
		    }
		  },*/
/*            rowCallback: function(row, data, index){
                if(data['status_pembelian']=="Done"){                
                    $(row).find('td:eq(6)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(6)').css('color', 'red');
                }
              }, */
            rowCallback: function(row, data, index){
				$(row).find('td:eq(2)').css('background-color','#F99');
				$(row).find('td:eq(3)').css('background-color','#F99');
			//	$(row).find('td:eq(7)').css('color', 'green');
			//	$(row).find('td:eq(8)').css('color', 'green');
              },
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                   action: function ( e, dt, node, config ) {  
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/tambah'); ?>',
						  function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_daftar'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Hasil",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_daftar'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/hasil/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-user-md'></i> Tambah Dokter",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
							location.href = '<?php echo base_url('jadwal_all/pengirim'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-stethoscope'></i> Tambah Pemeriksaan",
                    className: "btnnavy",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
							location.href = '<?php echo base_url('jadwal_all/tindakan'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-trash'></i> Hapus",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_daftar'];
                    swal({
                      title: "Yakin ?",
                      text: "Yakin akan Menghapus ",     //[Modif Disini]
                      icon: "warning",
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        location.href = '<?php echo base_url('jadwal_all/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
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
elseif ($page=="pengirim")  
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
//          "pageLength": 10,
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
                "url"  : "<?php echo base_url();?>jadwal_all/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  
                      { "data": "id_rujukan_dokter", "searchable":false, "visible":false },         
                      { "data": "nama_rujukan_dokter" },             
                      { "data": "email_rujukan_dokter", "searchable":false },                   
                      { "data": "kontak_rujukan_dokter", "searchable":false },                  
                      { "data": "alamat_rujukan_dokter", "searchable":false }                   
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
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_rujukan_dokter']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="tindakan")
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
//          "pageLength": 10,
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
                "url"  : "<?php echo base_url();?>jadwal_all/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "wkt_tindakan_tarif", "searchable":false, "visible":false },
                      { "data": "nama_tindakan" },
                      { "data": "nama_golongan_pemeriksaan", "searchable":false, "orderable":false },
                      { "data": "tarif", "searchable":false, "orderable":false, className:"text-right" },
                      { "data": "status_tindakan", "searchable":false, "orderable":false, 
                        "render": function(data, type, row){
                            if (row.status_tindakan === '1') {
                               return '<button class="btn btn-xs btn-success"> AKTIF</button>';
                           }  else {
                               return '<button class="btn btn-xs btn-danger"> NON AKTIF</button>';
                           }
                        }                          
                      }
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
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_tindakan'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('jadwal_all/'.$page.'/edit/'); ?>'+data,function(){
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
?>
</script>
		</div>
	</body>
</html>
