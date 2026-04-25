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
                "url"  : "<?php echo base_url();?>asesor/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan","searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "tgl_pengajuan","searchable":false },
					  { "data": "nama_status_diusulkan","searchable":false },
					  { "data": "acc_asesor",
						"render": function(data, type, row){
							if (row.status_pengajuan === 'Belum Terkirim') {
							   return '<button class="btn btn-xs btn-default"> Belum Terkirim</button>';
							}else if (row.acc_asesor === 'Proses') {
							   return '<button class="btn btn-xs btn-default"> Proses</button>';
						   } else if (row.acc_asesor === 'Kompeten') {
							   return '<button class="btn btn-xs btn-success"> Kompeten</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> Ditolak</button>';
						   }
						}
					  },
					  { "data": "tgl_acc_asesor","searchable":false }
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
                        location.href = '<?php echo base_url('asesor/'.$page.'/isi/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-recycle'></i> Return Data Asesor",
                    extend: "selected",
                    className: "btnlime",
                    action: function ( e, dt, node, config ) {
                       kabid = dt.rows( { selected: true } ).data()[0]['acc_kabid'];  
                       asesor = dt.rows( { selected: true } ).data()[0]['acc_asesor'];  
                       komite = dt.rows( { selected: true } ).data()[0]['acc_komite'];  
                       direktur = dt.rows( { selected: true } ).data()[0]['acc_direktur'];  
                       idp = dt.rows( { selected: true } ).data()[0]['id_status_diusulkan'];  
                       if( idp=='1'){
	                        if( komite=='Proses' && direktur=='Proses'){
								data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
								// alert(JSON.stringify(data));
								location.href = '<?php echo base_url('asesor/'.$page.'/proses_kabid/'); ?>'+data;
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
	                        if( komite=='Proses' && direktur=='Proses'){
								data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
								// alert(JSON.stringify(data));
								location.href = '<?php echo base_url('asesor/'.$page.'/perbaiki/'); ?>'+data;
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
                "url"  : "<?php echo base_url();?>asesor/pengajuan_kompetensi/data2/<?php echo $id; ?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook","searchable":false },
                      { "data": "tgl_logbook","searchable":false },
                      { "data": "jam_logbook","searchable":false },
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
                    text: "<i class='fa fa-recycle'></i> Balik Ke Proses",
                    extend: "selected",
                    className: "btnyellow",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('asesor/v_kabid_kompetensi/0/0/'); ?>'+data+'/<?php echo $id; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-check'></i> Kompeten",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('asesor/v_kabid_kompetensi/1/0/'); ?>'+data+'/<?php echo $id; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Supervisi",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('asesor/v_kabid_kompetensi/2/1/'); ?>'+data+'/<?php echo $id; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Tidak Kompeten",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan_detil'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('asesor/v_kabid_kompetensi/2/2/'); ?>'+data+'/<?php echo $id; ?>';
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
	chart.dataSource.url = "<?php echo base_url();?>asesor/pengajuan_kompetensi/tabel/<?php echo $id;?>";
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
