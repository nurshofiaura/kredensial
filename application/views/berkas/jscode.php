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
elseif ($page=="berkas")  
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
                "url"  : "<?php echo base_url();?>berkas/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  
                      { "data": "id_berkas", "searchable":false, "visible":false },
					  { "data": "nama_pegawai" },					  
					  { "data": "nama_berkas" },					  
					  { "data": "no_berkas" },					  
					  { "data": "nama_kategori_berkas", "searchable":false },
					  { 
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  }
	
            ],
            "order": [[0, 'asc']] ,
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
	});	
<?php
}
elseif ($page=="surat_ijin")  
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
                "url"  : "<?php echo base_url();?>berkas/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  
					  { "data": "tgl_b_berkas", "searchable": false },		
                      { "data": "nama_pegawai" },
					  { "data": "nama_kategori_berkas","searchable": false },					  
					  { "data": "no_berkas", "searchable": false, "orderable": false },
					  { 
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  },
					  { "data": "status_berkas", "searchable": false, "orderable": false },
	
            ],
            "order": [[0, 'asc']] ,
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
	});	
<?php
}
elseif ($page=="ijasah")  
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
                "url"  : "<?php echo base_url();?>berkas/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_berkas", "searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_pendidikan" },
					  { "data": "nama_berkas", "searchable":false },					  
					  { "data": "no_berkas", "searchable":false },
					  { "data": "tgl_b_berkas", "searchable":false },
					  { 
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  }	
            ],
            "order": [[0, 'asc']] ,
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
	});	
<?php
}
elseif ($page=="fppe")  
{
?>
    $(document).ready(function() {
		$('.select2').select2()
	});	
<?php
}
elseif ($page=="pelatihan")
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
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);     
	});
	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>SKS :</td><td>'+d.kredit+'</td> <td style="width: 5%"></td><td>Judul :</td><td>'+d.nama_berkas+'</td> </tr>'+
	  '<tr> <td>Penyelenggara :</td><td>'+d.penyelenggara+'</td> <td style="width: 5%"></td><td>Ruangan :</td><td>'+d.nama_unit+'</td> </tr>'+
	  '<tr> <td>Judul :</td><td>'+d.nama_berkas+'</td> <td></td><td>PK :</td><td>'+d.nama_kode_kewenangan+'</td> </tr>'+
	  '<tr> <td>Tgl Mulai :</td><td>'+d.tgl_a_berkas+'</td> <td></td><td>tgl Selesai :</td><td>'+d.tgl_b_berkas+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>berkas/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id_kategori_pelatihan;?>/<?php echo $id_unit;?>",
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
                      { "data": "tgl_a_berkas", "searchable":false },
                      { "data": "tgl_b_berkas", "searchable":false },
					  { "data": "nama_pegawai" },					  
					  { "data": "nama_ruangan", "searchable":false },					  				  
					  { "data": "nama_kategori_pelatihan", "searchable":false },
					  { 
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  }	
            ],
            "order": [[0, 'asc']] ,
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
	});	

am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['tgl_logbook'].'"'; ?>,
  <?php
  $no = 0;
  $jsonx = $this->m_berkas->lt2($row1['tgl_logbook'],$id_unit,$id_kategori_pelatihan,$level_id,$room_id);
  foreach($jsonx as $row2){
	  $no++;
  ?>
  <?php echo '"'.$row2['id_kategori_pelatihan'].'"'; ?>:<?php echo $row2['jml_logbook']; ?>,
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
foreach($ambil_kol_kategori_pelatihan_graph as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox); 	  
?>
// Create series
var series<?php echo $row1x['id_kategori_pelatihan']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_kategori_pelatihan']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_kategori_pelatihan'].'"'; ?>;
series<?php echo $row1x['id_kategori_pelatihan']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_kategori_pelatihan']; ?>.name = <?php echo '"'.$row1x['nama_kategori_pelatihan'].'"'; ?>;
series<?php echo $row1x['id_kategori_pelatihan']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_kategori_pelatihan']; ?>.tooltipText = "{name} Thn {categoryX}: {valueY}";
series<?php echo $row1x['id_kategori_pelatihan']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_kategori_pelatihan']; ?>.visible  = false;

let hs<?php echo $row1x['id_kategori_pelatihan']; ?> = series<?php echo $row1x['id_kategori_pelatihan']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_kategori_pelatihan']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_kategori_pelatihan']; ?>.segments.template.strokeWidth = 1;

<?php
}
?>
// Add chart cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "zoomY";

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
chart.legend.scrollable = true;
chart.legend.itemContainers.template.events.on("out", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = false;
  })
})
chart.exporting.menu = new am4core.ExportMenu();
}); // end am4core.ready()
<?php
}
elseif ($page=="pengembangan_profesi")  
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
	$("#search-inp").keypress(function(event) {
		var character = String.fromCharCode(event.keyCode);
		return isValid(character);     
	});
	function isValid(str) {
		return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
	}
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>SKS :</td><td>'+d.kredit+'</td> <td style="width: 5%"></td><td>Judul :</td><td>'+d.nama_berkas+'</td> </tr>'+
	  '<tr> <td>Penyelenggara :</td><td>'+d.penyelenggara+'</td> <td style="width: 5%"></td><td>Ruangan :</td><td>'+d.nama_unit+'</td> </tr>'+
	  '<tr> <td>Judul :</td><td>'+d.nama_berkas+'</td> <td></td><td>PK :</td><td>'+d.nama_kode_kewenangan+'</td> </tr>'+
	  '<tr> <td>Tgl Mulai :</td><td>'+d.tgl_a_berkas+'</td> <td></td><td>tgl Selesai :</td><td>'+d.tgl_b_berkas+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>berkas/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>/<?php echo $id_kategori_pelatihan;?>/<?php echo $id_pegawai;?>",
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
                      { "data": "tgl_a_berkas", "searchable":false },
                      { "data": "tgl_b_berkas", "searchable":false },
					  { "data": "nama_pegawai" },					  
					  { "data": "nama_ruangan", "searchable":false },					  				  
					  { "data": "nama_kategori_pelatihan", "searchable":false },
					  { 
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  }	
            ],
            "order": [[0, 'asc']] ,
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
	});	

am4core.ready(function() {
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.data = [
<?php
foreach($json as $row1){
?>
{
  "year": <?php echo '"'.$row1['tgl_logbook'].'"'; ?>,
  <?php
  $no = 0;
  $jsonx = $this->m_berkas->lt2_pengembangan($row1['tgl_logbook'],$id_pegawai,$id_kategori_pelatihan);
  foreach($jsonx as $row2){
	  $no++;
  ?>
  <?php echo '"'.$row2['id_kategori_pelatihan'].'"'; ?>:<?php echo $row2['jml_logbook']; ?>,
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
foreach($ambil_kol_kategori_pelatihan_graph as $row1x){
//  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox); 	  
?>
// Create series
var series<?php echo $row1x['id_kategori_pelatihan']; ?> = chart.series.push(new am4charts.LineSeries());
series<?php echo $row1x['id_kategori_pelatihan']; ?>.dataFields.valueY = <?php echo '"'.$row1x['id_kategori_pelatihan'].'"'; ?>;
series<?php echo $row1x['id_kategori_pelatihan']; ?>.dataFields.categoryX = "year";
series<?php echo $row1x['id_kategori_pelatihan']; ?>.name = <?php echo '"'.$row1x['nama_kategori_pelatihan'].'"'; ?>;
series<?php echo $row1x['id_kategori_pelatihan']; ?>.bullets.push(new am4charts.CircleBullet());
series<?php echo $row1x['id_kategori_pelatihan']; ?>.tooltipText = "{name} Thn {categoryX}: {valueY}";
series<?php echo $row1x['id_kategori_pelatihan']; ?>.legendSettings.valueText = "{valueY}";
series<?php echo $row1x['id_kategori_pelatihan']; ?>.visible  = false;

let hs<?php echo $row1x['id_kategori_pelatihan']; ?> = series<?php echo $row1x['id_kategori_pelatihan']; ?>.segments.template.states.create("hover")
hs<?php echo $row1x['id_kategori_pelatihan']; ?>.properties.strokeWidth = 5;
series<?php echo $row1x['id_kategori_pelatihan']; ?>.segments.template.strokeWidth = 1;

<?php
}
?>
// Add chart cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "zoomY";

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
chart.legend.scrollable = true;
chart.legend.itemContainers.template.events.on("out", function(event){
  var segments = event.target.dataItem.dataContext.segments;
  segments.each(function(segment){
    segment.isHover = false;
  })
})
chart.exporting.menu = new am4core.ExportMenu();
}); // end am4core.ready()
<?php
}
elseif ($page=="kinerja_klinis_lharian" || $page=="kinerja_klinis_ltahunan" )  
{
?>
    $(document).ready(function() {
		$('.select2').select2()
		$('#example1').DataTable({
		  'paging'      	: false,
		  'lengthChange'	: false,
		  'searching'   	: false,
		  'ordering'    	: false,
		  'info'        	: true,
		  'scrollX'			: true,
		  'scrollY'			: '500px',
		  'scrollCollapse'	: true
		})
	});	
<?php
}
elseif ($page=="penilaian_kinerja")  
{
?>
    $(document).ready(function() {
		$('.select2').select2()
		$('#example1').DataTable({
		  'paging'      	: false,
		  'lengthChange'	: false,
		  'searching'   	: false,
		  'ordering'    	: false,
		  'info'        	: true,
		  'scrollX'			: true,
		  'scrollY'			: '500px',
		  'scrollCollapse'	: true
		})
	});	
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart3D);


// Add data
chart.data = [
	<?php
	foreach($json as $row1){
$jml_kompetensi = $row1['jml_logbook'];
$kondisi_pelatihan=array('id_pegawai'=>$row1['id_pegawai'],'year(tgl_a_berkas)'=>$row1['tgl_logbook']);
$jml_pelatihan=$this->m_umum->jumlah_record_filter('berkas',$kondisi_pelatihan);
$kondisi_etik=array('kr_etik_pegawai.id_pegawai'=>$row1['id_pegawai'],'year(tgl_etik_pegawai)'=>$row1['tgl_logbook']);
$jml_etik=$this->m_umum->jumlah_record_filter('kr_etik_pegawai',$kondisi_etik);
if($jml_kompetensi == 0){
	$skor_logbook = 0;								

}elseif($jml_kompetensi < 12){
	$skor_logbook = 1;						
}
else{
	$skor_logbook = 2;							
}
if($jml_pelatihan == 0){
	$skor_pelatihan = 0;								

}elseif($jml_pelatihan < 4){
	$skor_pelatihan = 1;						
}
else{
	$skor_pelatihan = 2;							
}
if($jml_etik == 0){
	$skor_etik = 0;								

}elseif($jml_etik < 2){
	$skor_etik = 1;						
}
else{
	$skor_etik = 2;							
}
$total = $skor_logbook + $skor_pelatihan + $skor_etik;
if($total == 0){
	$nilai_total = "KURANG";						

}elseif($total < 3){
	$nilai_total = "CUKUP";					
}
elseif($total < 5){
	$nilai_total = "BAIK";					
}
else{
	$nilai_total = "EXCELLENT";						
}	
	?>
	{
  "nama": "<?php echo $row1['nama_pegawai']; ?>",
  "total": <?php echo $total; ?>,
  "skor": "<?php echo $nilai_total; ?>"
  },
	<?php
	}
	?>

];

// Create axes
let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "nama";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.renderer.labels.template.hideOversized = false;
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.tooltip.label.rotation = 270;
categoryAxis.tooltip.label.horizontalCenter = "right";
categoryAxis.tooltip.label.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 315;

let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Skor";
valueAxis.title.fontWeight = "bold";

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "total";
series.dataFields.categoryX = "nama";
series.name = "T";
//series.tooltipText = "{categoryX}: [bold]{skor}[/]";
series.tooltipText = "[bold]{categoryX}[/] \nTotal Skor : {valueY}[/] \n[bold] Result: {skor}";
//series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;
columnTemplate.stroke = am4core.color("#FFFFFF");

columnTemplate.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

columnTemplate.adapter.add("stroke", function(stroke, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

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

var title = chart.titles.create();
title.text = "GRAFIK PENILAIAN KINERJA";
title.fontSize = 25;
title.tooltipText = "On going Professional Practice Evaluation";

}); // end am4core.ready()
<?php
}
elseif ($page=="kinerja_klinis_lbulanan")  
{
?>
    $('#bulan').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#bulan").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
    $('#tahun').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tahun").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
    $(document).ready(function() {
		$('.select2').select2()
    $('#example1').DataTable({
      'paging'      	: false,
      'lengthChange'	: false,
      'searching'   	: false,
      'ordering'    	: false,
      'info'        	: true,
	  'scrollX'			: true,
	  'scrollY'			: '500px',
	  'scrollCollapse'	: true
    })
	});	
<?php
}
elseif ($page=="etika_profesi")  
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
                "url"  : "<?php echo base_url();?>berkas/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_etik_pegawai", "searchable":false },
					  { "data": "tgl_etik_pegawai", "searchable":false },
					  { "data": "jam_etik_pegawai", "searchable":false },
					  { "data": "nama_pegawai" },
					  { "data": "jumlah_etik", "searchable":false },
					  { "data": "total_etik", "searchable":false },
					  { "data": "hasil_etik", "searchable":false },
					  { "data": "penguji", "searchable":false }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',       		
            dom: 'Blrtip',  
            "buttons": [		
                {
                  text: "<i class='fa fa-file-pdf-o'></i> PDF",
                  extend: "selected",
                  className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_etik_pegawai']; 
						window.open('<?php echo base_url('berkas/'.$page.'/pdf/'); ?>'+data);
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
if ($page=="riwayat")  
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td></td><td></td> <td style="width: 5%"></td><td>Tgl Acc Karu:</td><td>'+d.tgl_v_karu+'</td> </tr>'+
	  '<tr> <td>Tgl Acc Kabid:</td><td>'+d.tgl_v_kabid+'</td> <td style="width: 5%"></td><td>Tgl Acc Asesor:</td><td>'+d.tgl_v_asesor+'</td> </tr>'+
	  '<tr> <td>Tgl Acc Komite:</td><td>'+d.tgl_v_komite+'</td> <td style="width: 5%"></td><td>Tgl Acc Direktur:</td><td>'+d.tgl_v_direktur+'</td> </tr>'+
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
		$('select[name=id_pegawai]').on('change',function(){
			$.ajax({
				url:'<?php echo base_url();?>berkas/kewenangan_data/'+$(this).val(),
				type: "POST",
				dataType: 'json'
			 }).done(function(data) {
				// alert(data[0]["nama_kab"]);
				// $('select[name=id_kab]').html(data);
				   var len = data.length;
	// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
					$("#id_kewenangan").empty();
					for( var i = 0; i<len; i++){
						var id = data[i]["id_kewenangan"];
						var name = data[i]["nama_kewenangan"];
						
						$("#id_kewenangan").append("<option value='"+id+"'>"+name+"</option>");

					}            
			 }).fail(function() {
				
			 }).always(function() {
			 
			});
		});
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
                "url"  : "<?php echo base_url();?>berkas/<?php echo $page;?>/data/<?php echo $id_pegawai;?>/<?php echo $id_kewenangan;?>",
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
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "jam_logbook", "searchable":false },
					  { "data": "nama_kode_kewenangan", "searchable":false },
					  { "data": "nama_kewenangan" },
					  { "data": "jml_logbook", "searchable":false },
					  { "data": "v_karu", 
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
					  },
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
                      { "data": "v_direktur",
						"render": function(data, type, row){
							if (row.v_direktur === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.v_direktur === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  }	
            ],
            "order": [[1, 'asc']] ,
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
});
<?php
}
elseif ($page=="gender" || $page=="pendidikan" || $page=="agama" || $page=="marital" || $page=="status" || $page=="ruangan" 
		|| $page=="pk" || $page=="jabatan_fungsional")  
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
            "ajax": {
                "url"  : "<?php echo base_url();?>berkas/<?php echo $page;?>/tabel/<?php echo $id_ruangan;?>",
                "type" : "POST"
            },
<?php
if($page=="pendidikan"){
	$cat = 'nama_pendidikan';
?>
            "columns": [                          
					  { "data": "nama_pegawai" },
                      { "data": "nama_pendidikan" },
					  { "data": "nama_berkas", "searchable":false },					  
					  { "data": "no_berkas", "searchable":false },
					  { "data": "tgl_b_berkas", "searchable":false },
					  { 
						"data": "link_berkas",
						"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
							$(nTd).html("<a href='<?php echo base_url();?>assets/berkas/"+oData.link_berkas+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
						}
					  }	
            ],
<?php
}else{	
?>
            "columns": [                          
					  { "data": "nama_pegawai" },
					  { "data": "jk", "searchable":false },
					  { "data": "nama_agama", "searchable":false },
					  { "data": "nama_status_kawin", "searchable":false },
					  { "data": "nama_status_pegawai", "searchable":false },
					  { "data": "nama_ruangan", "searchable":false },
					  { "data": "nama_kode_kewenangan", "searchable":false },
					  { "data": "nama_jabatan_fungsional", "searchable":false }
            ],
<?php
}
if($page=="gender"){
	$cat = 'jk';
}
if($page=="agama"){
	$cat = 'nama_agama';
}
if($page=="marital"){
	$cat = 'nama_status_kawin';
}
if($page=="status"){
	$cat = 'nama_status_pegawai';
}
if($page=="ruangan"){
	$cat = 'nama_ruangan';
}
if($page=="pk"){
	$cat = 'nama_kode_kewenangan';
}
if($page=="jabatan_fungsional"){
	$cat = 'nama_jabatan_fungsional';
}
?>
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
	am4core.ready(function() {
	am4core.useTheme(am4themes_dataviz);
	am4core.useTheme(am4themes_animated);
	var chart = am4core.create("chartdiv", am4charts.PieChart);
	chart.dataSource.url = "<?php echo base_url();?>berkas/<?php echo $page;?>/data/<?php echo $id_ruangan;?>";
	var pieSeries = chart.series.push(new am4charts.PieSeries());
	pieSeries.dataFields.value = "total";
	pieSeries.dataFields.category = "<?php echo $cat;?>";
	pieSeries.innerRadius = am4core.percent(50);
	pieSeries.ticks.template.disabled = true;
	pieSeries.labels.template.disabled = true;
	var rgm = new am4core.RadialGradientModifier();
	rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
	pieSeries.slices.template.fillModifier = rgm;
	pieSeries.slices.template.strokeModifier = rgm;
	pieSeries.slices.template.strokeOpacity = 0.4;
	pieSeries.slices.template.strokeWidth = 0;
	chart.legend = new am4charts.Legend();
	chart.legend.position = "right";
	chart.legend.scrollable = true;
	});
<?php
}
elseif ($page=="grafik")  
{
?>
$(document).ready(function() {
		$('.select2').select2()
});
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart3D);


// Add data
chart.data = [
	<?php
	foreach($json as $row1){
$jml_kompetensi = $row1['jml_logbook'];
$kondisi_pelatihan=array('id_pegawai'=>$row1['id_pegawai'],'year(tgl_a_berkas)'=>$row1['tgl_logbook']);
$jml_pelatihan=$this->m_umum->jumlah_record_filter('berkas',$kondisi_pelatihan);
$kondisi_etik=array('kr_etik_pegawai.id_pegawai'=>$row1['id_pegawai'],'year(tgl_etik_pegawai)'=>$row1['tgl_logbook']);
$jml_etik=$this->m_umum->jumlah_record_filter('kr_etik_pegawai',$kondisi_etik);
if($jml_kompetensi == 0){
	$skor_logbook = 0;								

}elseif($jml_kompetensi < 12){
	$skor_logbook = 1;						
}
else{
	$skor_logbook = 2;							
}
if($jml_pelatihan == 0){
	$skor_pelatihan = 0;								

}elseif($jml_pelatihan < 4){
	$skor_pelatihan = 1;						
}
else{
	$skor_pelatihan = 2;							
}
if($jml_etik == 0){
	$skor_etik = 0;								

}elseif($jml_etik < 2){
	$skor_etik = 1;						
}
else{
	$skor_etik = 2;							
}
$total = $skor_logbook + $skor_pelatihan + $skor_etik;
if($total == 0){
	$nilai_total = "KURANG";						

}elseif($total < 3){
	$nilai_total = "CUKUP";					
}
elseif($total < 5){
	$nilai_total = "BAIK";					
}
else{
	$nilai_total = "EXCELLENT";						
}	
	?>
	{
  "nama": "<?php echo $row1['nama_pegawai']; ?>",
  "total": <?php echo $total; ?>,
  "skor": "<?php echo $nilai_total; ?>"
  },
	<?php
	}
	?>

];

// Create axes
let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "nama";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.renderer.labels.template.hideOversized = false;
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.tooltip.label.rotation = 270;
categoryAxis.tooltip.label.horizontalCenter = "right";
categoryAxis.tooltip.label.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 315;

let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Skor";
valueAxis.title.fontWeight = "bold";

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "total";
series.dataFields.categoryX = "nama";
series.name = "T";
//series.tooltipText = "{categoryX}: [bold]{skor}[/]";
series.tooltipText = "[bold]{categoryX}[/] \nTotal Skor : {valueY}[/] \n[bold] Result: {skor}";
//series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;
columnTemplate.stroke = am4core.color("#FFFFFF");

columnTemplate.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

columnTemplate.adapter.add("stroke", function(stroke, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

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

var title = chart.titles.create();
title.text = "GRAFIK PENILAIAN KINERJA";
title.fontSize = 25;
title.tooltipText = "On going Professional Practice Evaluation";

}); // end am4core.ready()
<?php
}
?>
</script>
		</div>
	</body>
</html>