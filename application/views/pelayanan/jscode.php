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
elseif ($page=="golongan")  
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_golongan_pemeriksaan", "searchable":false, "visible":false },
					  { "data": "nama_golongan_pemeriksaan" },
					  { "data": "nama_struktur_jabatan", "searchable":false },
					  { "data": "status_golongan_pemeriksaan", "searchable":false }
					
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
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_golongan_pemeriksaan']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/edit/'); ?>'+data,function(){
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
//================================================= TINDAKAN =================================================
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_tindakan", "searchable":false, "visible":false },
					  { "data": "nama_tindakan" },
					  { "data": "nama_golongan_pemeriksaan", "searchable":false },
					  { "data": "nama_unit", "searchable":false },
                    { "data": "status_tindakan", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.status_tindakan === '0') {
                               return '<button class="btn btn-xs btn-danger"> NON AKTIF</button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"> AKTIF</button>';
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
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/tambah'); ?>',function(){
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
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },			
                {
                  text: "<i class='fa fa-cogs'></i> Seting Paket",
                  extend: "selected",
                  className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_tindakan']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/paket/'); ?>'+data,function(){
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
//================================================= TINDAKAN =================================================
elseif ($page=="tindakan_tarif")  
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data/<?php echo $id_tindakan;?>/<?php echo $id_kelas;?>",
                "type" : "POST"
            },
            "columns": [  
					  { "data": "id_tindakan_tarif", "searchable":false, "visible":false },			
					  { "data": "tgl_berlaku", "searchable":false, "type": "date" },			
					  { "data": "nama_tindakan" },
					  { "data": "harga_tindakan", "searchable":false },
					  { "data": "nama_kelas", "searchable":false },				  			  
					  { "data": "status_tarif", "searchable":false }
					
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
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_tindakan_tarif']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/edit/'); ?>'+data,function(){
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
//================================================= ASURANSI =================================================
elseif ($page=="asuransi")  
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  
					  { "data": "id_detil_cara_bayar", "searchable":false, "visible":false },			
					  { "data": "nama_detil_cara_bayar" },
					  { "data": "nama_cara_bayar", "searchable":false }					
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
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_detil_cara_bayar']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="rujukan")  
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  
					  { "data": "id_rujukan_dokter", "searchable":false, "visible":false },			
					  { "data": "nama_rujukan_dokter" },
					  { "data": "id_kategori_dokter", "searchable":false },				
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
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/tambah'); ?>',function(){
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
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="faskes")  
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  
					  { "data": "id_rujukan_instansi", "searchable":false, "visible":false },			
					  { "data": "nama_rujukan_instansi" },
					  { "data": "nama_cara_masuk", "searchable":false },				
					  { "data": "email_rujukan_instansi", "searchable":false },				
					  { "data": "kontak_rujukan_instansi", "searchable":false },				
					  { "data": "alamat_rujukan_instansi", "searchable":false }					
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
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_rujukan_instansi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="ruangan")
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_unit", "searchable":false, "visible":false },
					  { "data": "nama_unit" },
                      { "data": "status_unit",
                        "render": function(data, type, row){
                            if (row.status_unit === '0') {
                               return '<button class="btn btn-xs btn-danger">TIDAK AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
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
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnEdit",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_unit'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/edit/'); ?>'+data,function(){
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
		$('#search-inp').keyup(function(){
		  table.search($(this).val()).draw() ;
		})
	});
<?php
}
elseif ($page=="user")
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
      '<tr> <td>M No Profesi:</td><td style="width:35%">'+d.no_profesi+'</td> <td></td><td>TTL:</td><td style="width:35%">'+d.umur+'</td> </tr>'+
      '<tr> <td>NIP:</td><td>'+d.nip+'</td> <td></td><td>Username:</td><td>'+d.username+'</td> </tr>'+
      '<tr> <td>M Status:</td><td>'+d.nama_status_kawin+'</td> <td></td><td>Agama:</td><td>'+d.nama_agama+'</td> </tr>'+
 	  '<tr> <td>Pendidikan:</td><td>'+d.nama_pendidikan+'</td><td></td><td>Pegawai:</td><td>'+d.nama_status_pegawai+'</td> </tr>'+
 	  '<tr> <td>Email:</td><td>'+d.email+'</td><td></td><td>JK:</td><td>'+d.jk+'</td> </tr>'+
 	  '<tr> <td>Alamat:</td><td colspan="4">'+d.alamat+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
              {
                  "className": 'details-control',
                  "orderable": false,
                  "searchable":false,
                  "data":      null,
                  "defaultContent": '<i class = "glyphicon glyphicon-plus-sign"> </ i>'
              },
					  { "data": "id_pegawai","searchable":false,"visible":false },
					  { "data": "nama_pegawai" },
					  { "data": "no_hp","searchable":false },
					  { "data": "nik","searchable":false },
					  { "data": "status_pegawai", "searchable":false,
						"render": function(data, type, row){
							if (row.status_pegawai === 'AKTIF') {
							   return '<button class="btn btn-xs btn-success"> AKTIF</button>';
						   } else {
							   return '<button class="btn btn-xs btn-danger"> NON AKTIF</button>';
						   }
						}						   
					  }
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
                        location.href = '<?php echo base_url('admin_pelayanan/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('admin_pelayanan/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                   text: "<i class='fa fa-key'></i> Reset Password to 7654321",
                   extend: "selected",
                   className: "btnolive",
                   action: function ( e, dt, node, config ) {
                       data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                   swal({
                     title: "Yakin ?",
                     text: "Yakin akan mereset password ",     //[Modif Disini]
                     icon: "warning",
                     buttons: true,
                     dangerMode: true,
                   })
                   .then((willDelete) => {
                     if (willDelete) {
                       location.href = '<?php echo base_url('admin_pelayanan/'.$page.'/reset/'); ?>'+data+'/<?php echo $id;?>'; //[Modif Disini]
                     }
                   });
                  }
                },
                {
                    text: "<i class='fa fa-cog'></i> Multi Akses",
                    extend: "selected",
                    className: "btnlime",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('admin_pelayanan/akses/view/'); ?>'+data;
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
<?php
}
else if ($page=="user_tambah" || $page=="user_edit")
{
?>
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>admin_pelayanan/kab_data/'+$(this).val(),
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
            url:'<?php echo base_url();?>admin_pelayanan/kec_data/'+$(this).val(),
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
            url:'<?php echo base_url();?>admin_pelayanan/kel_data/'+$(this).val(),
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
     $('select[name=id_jabatan_fungsional]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>admin_pelayanan/pengcab/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
            // alert(data[0]["nama_kab"]);
            // $('select[name=id_kab]').html(data);
               var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
                $("#id_pengcab").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id_pengcab"];
                    var name = data[i]["nama_pengcab"];

                    $("#id_pengcab").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
$(document).ready(function() {
	$('.select2').select2()
		$("#username").on("input", function(e) {
			$('#msg').hide();
			if ($('#username').val() == null || $('#username').val() == "") {
				$('#msg').show();
				$("#msg").html("Username Harus Diisi").css("color", "red");
			} else {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>admin_pelayanan/check_availability",
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
$('select[name=tipe_pegawai]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>admin_pelayanan/jabfung_data/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
        // alert(data[0]["nama_kab"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
            $("#id_jabatan_fungsional").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_jabatan_fungsional"];
                var name = data[i]["nama_jabatan_fungsional"];

                $("#id_jabatan_fungsional").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
function myUsername() {
  var x = document.getElementById("username");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myPassword() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
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
<?php
}
else if ($page=="akses")  
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_ol_akses","searchable":false,"visible":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_akses","searchable":false },
										  { "data": "status_ol_akses",
											"render": function(data, type, row){
												if (row.status_ol_akses === '0') {
												   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
											   } else {
												   return '<button class="btn btn-xs btn-success">AKTIF</button>';
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
                    className: "btnteal",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/tambah/'); ?><?php echo $id;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                 {
                     text: "<i class='fa fa-plus'></i> Status Aktif",
                     extend: "selected",
                     className: "btngreen",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_ol_akses'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan AKTIFKAN",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_pelayanan/'.$page.'/status/1/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },
                 {
                     text: "<i class='fa fa-minus'></i> Status Non Aktif",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_ol_akses'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan NON AKTIFKAN",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_pelayanan/'.$page.'/status/0/'); ?>'+data; //[Modif Disini]
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
elseif ($page=="pelayanan")  
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
                "url"  : "<?php echo base_url();?>admin_pelayanan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_unit", "searchable":false, "visible":false },
					  { "data": "nama_unit" }			
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [			
                {
                    text: "<i class='fa fa-cog'></i> Seting Pelayanan",
                    className: "btnteal",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_pelayanan/'.$page.'/seting'); ?>',function(){
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