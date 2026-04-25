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
elseif ($page=="pabrik")  
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
                "url"  : "<?php echo base_url();?>admin_apotek/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_pabrik", "searchable":false, "visible":false },
					  { "data": "nama_pabrik" },
					  { "data": "kontak_pabrik", "searchable":false },
					  { "data": "alamat_pabrik", "searchable":false },
					  { "data": "status_pabrik", "searchable":false,
						"render": function(data, type, row){
							if (row.status_pabrik === '0') {
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
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pabrik']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="supplier")  
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
                "url"  : "<?php echo base_url();?>admin_apotek/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_supplier", "searchable":false, "visible":false },
					  { "data": "nama_supplier" },
					  { "data": "kontak_supplier", "searchable":false },
					  { "data": "alamat_supplier", "searchable":false },
					  { "data": "status_supplier", "searchable":false,
						"render": function(data, type, row){
							if (row.status_supplier === '0') {
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
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_supplier']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="customer")  
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
                "url"  : "<?php echo base_url();?>admin_apotek/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_customer", "searchable":false, "visible":false },
					  { "data": "nama_customer" },
					  { "data": "kontak_customer", "searchable":false },
					  { "data": "alamat_customer", "searchable":false },
					  { "data": "status_customer", "searchable":false,
						"render": function(data, type, row){
							if (row.status_customer === '0') {
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
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_customer']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="barang")  
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
                "url"  : "<?php echo base_url();?>admin_apotek/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_barang", "searchable":false, "visible":false },
					  { "data": "nama_barang" },
					  { "data": "nama_item_kategori", "searchable":false },
					  { "data": "status_barang", "searchable":false,
						"render": function(data, type, row){
							if (row.status_barang === '0') {
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
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_barang']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="termin")  
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
                "url"  : "<?php echo base_url();?>admin_apotek/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [  			
                      { "data": "id_termin", "searchable":false, "visible":false },
					  { "data": "nama_termin" },
					  { "data": "tempo_termin", "searchable":false },
					  { "data": "ket_termin", "searchable":false },
					  { "data": "status_termin", "searchable":false,
						"render": function(data, type, row){
							if (row.status_termin === '0') {
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
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_termin']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="pembelian")  
{
?>
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>Kontak:</td><td>'+d.cp+'</td> <td style="width: 5%"></td><td>Alamat:</td><td>'+d.address+'</td> </tr>'+
        '<tr> <td>Keterangan:</td><td>'+d.ket_pembelian+'</td> <td></td><td>Pajak:</td><td>'+d.pajak+'</td> </tr>'+
        '<tr> <td>Diskon:</td><td>'+d.diskon_pembelian+'</td><td></td><td>Persen:</td><td>'+d.persen_pembelian+'</td> </tr>'+
		'<tr> <td>SubTotal:</td><td>'+d.subtotal_pembelian+'</td><td></td><td>PPN:</td><td>'+d.ppn_pembelian+'</td> </tr>'+
		'<tr> <td>Total:</td><td>'+d.total_pembelian+'</td><td></td><td>User:</td><td>'+d.nama_pegawai+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>admin_apotek/<?php echo $page;?>/data/<?php echo $date;?>/<?php echo $first_date;?>/<?php echo $last_date;?>",
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
                      { "data": "id_pembelian", "searchable":false, "visible":false },
					  { "data": "tgl_pembelian", "searchable":false },
					  { "data": "no_pembelian", "searchable":false },
					  { "data": "nama_supplier" },					
					  { "data": "nama_termin", "searchable":false },					
					  { "data": "status_pembelian", "searchable":false }					
            ],
            "order": [[1, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            rowCallback: function(row, data, index){
                if(data['status_pembelian']=="Done"){                
                    $(row).find('td:eq(6)').css('color', 'green');
                }
                else {
                    $(row).find('td:eq(6)').css('color', 'red');
                }
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
                          $('.modal-body').load('<?php echo base_url('admin_apotek/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },	
                {
                    text: "<i class='fa fa-pencil'></i> Input",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pembelian'];  
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('admin_apotek/'.$page.'/edit/'); ?>'+data;
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
elseif ($page=="pembelian_editssss")  
{
?>
//const numInputs = document.querySelectorAll("#myCircle1, #myCircle2, #myCircle3, #myCircle4")
const numInputs = document.querySelectorAll('.jml, .harga, .diskon, .persen, .dob, .pob, .konversi')

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
				url: '<?php echo base_url();?>admin_apotek/data_barang',
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
				url: '<?php echo base_url();?>admin_apotek/data_satuan',
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
		  $(".select_pabrik").select2({
			ajax: {
				url: '<?php echo base_url();?>admin_apotek/data_pabrik',
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
  '<td><input type="text" name="jml_pembelian_detil[]" value="0" class="form-control jml" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Jumlah"/></td>'+
  '<td><select name="id_pabrik[]" required="required" class="select_pabrik form-control select2"><option value="">Pilih Pabrik</option></select></td>'+

  '<td><input type="text" name="harga_pembelian_detil[]" value="0" class="form-control text-right inputnumber harga" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Harga"/></td>'+
  '<td><input type="text" name="diskon_pembelian_detil[]" value="0" class="form-control text-right inputnumber diskon" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Diskon Rp"/></td>'+
  '<td><input type="text" name="persen_pembelian[]" value="0" class="form-control text-right persen" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Diskon Rp"/></td>'+
  '<td><input type="text" name="total_pembelian_detil[]" readonly value="0" class="form-control text-right inputnumber total" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder=""/></td>'+
  '<td><button type="button" name="remove" class="btn btn-block btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td>'+
'</tr>'+
'<tr>'+
  '<td><select name="satuan_besar[]" required="required" class="select_satuan form-control select2"><option value="">Satuan Besar</option></select></td>'+
  '<td><input type="text" name="konversi[]" value="0" class="form-control jml" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Jumlah"/></td>'+
  '<td><select name="satuan_besar[]" required="required" class="select_satuan form-control select2"><option value="">Satuan Besar</option></select></td>'+
  '<td colspan="5"><input type="text" name="ket_pembelian_detil[]" class="form-control" placeholder="Keterangan"/></td>'+
'</tr>'
  );
  new_raw.insertBefore('#addDepIt');
		  $('.select2').select2(); 		 
		  $(".select_barang").select2({
			ajax: {
				url: '<?php echo base_url();?>admin_apotek/data_barang',
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
				url: '<?php echo base_url();?>admin_apotek/data_satuan',
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
		  $(".select_pabrik").select2({
			ajax: {
				url: '<?php echo base_url();?>admin_apotek/data_pabrik',
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
/*	  $(this).closest('tr').remove();
      var row = $(this).closest('tr');
      var prev = row.prev();
      row.remove();*/
    var closestRow = $(this).closest('tr');
 //   closestRow.add(closestRow.prev()).add(closestRow.next()).remove();
closestRow.add(closestRow.next()).remove();
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
    $('#subtotal_pembelian').val(sums);
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
        $('#subtotal_pembelian').val(sum);
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
//    var diskon_pembelian = document.getElementById('diskon_pembelian').value;
//    var persen_pembelian = document.getElementById('persen_pembelian').value;
//    if (diskon_pembelian=="") { diskon_pembelian = 0; }
 //   if (persen_pembelian=="") { persen_pembelian = 0; }
//	$('#ppn_pembelian').val($('#dep_all_total').val()); // apa yang diketik muncul
	$('#total_pembelian').val($('#diskon_pembelian').val()); // apa yang diketik muncul
/*     document.getElementById("ppn_pembelian").innerHTML = diskon_pembelian;
    document.getElementById("total_pembelian").innerHTML = persen_pembelian; */
	
	
	
/* 	if (diskon_pembelian == 0) {
		percentase = Math.round(parseInt(dep_all_total.replace(/,/g, '')) * (parseInt(persen_pembelian)/100));
	}else if(persen_pembelian == 0) {
		percentase = parseInt(diskon_pembelian.replace(/,/g, ''));
	}else if(persen_pembelian == 0 && diskon_pembelian == 0) {
		percentase = 0;
	}else{
		percentase = Math.round(parseInt(dep_all_total.replace(/,/g, '')) * (parseInt(persen_pembelian)/100));
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
//	document.getElementById('total_pembelian').value = totale.toLocaleString('en-US');
//	document.getElementById('diskon_pembelian').value = totale.toLocaleString('en-US');
//	document.getElementById('ppn_pembelian').value = diskon_pembelian.toLocaleString('en-US');
  }
<?php
}
elseif ($page=="pembeliggan_edit")  
{
?>
//const numInputs = document.querySelectorAll("#myCircle1, #myCircle2, #myCircle3, #myCircle4")
const numInputs = document.querySelectorAll('.jml, .harga, .diskon, .persen, .dob, .pob, .konversi')

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
				url: '<?php echo base_url();?>admin_apotek/data_barang',
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
				url: '<?php echo base_url();?>admin_apotek/data_satuan',
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
		  $(".select_pabrik").select2({
			ajax: {
				url: '<?php echo base_url();?>admin_apotek/data_pabrik',
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
  '<td><input type="text" name="jml_pembelian_detil[]" value="0" class="form-control jml" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Jumlah"/></td>'+
  '<td><select name="id_pabrik[]" required="required" class="select_pabrik form-control select2"><option value="">Pilih Pabrik</option></select></td>'+

  '<td><input type="text" name="harga_pembelian_detil[]" value="0" class="form-control text-right inputnumber harga" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Harga"/></td>'+
  '<td><input type="text" name="diskon_pembelian_detil[]" value="0" class="form-control text-right inputnumber diskon" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Diskon Rp"/></td>'+
  '<td><input type="text" name="persen_pembelian[]" value="0" class="form-control text-right persen" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder="Diskon Rp"/></td>'+
  '<td><input type="text" name="total_pembelian_detil[]" readonly value="0" class="form-control text-right inputnumber total" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46" placeholder=""/></td>'+
  '<td><button type="button" name="remove" class="btn btn-block btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td>'+
'</tr>'+
'<tr>'+
  '<td><select name="satuan_besar[]" required="required" class="select_satuan form-control select2"><option value="">Satuan Besar</option></select></td>'+
  '<td><input type="text" name="konversi[]" value="0" class="form-control jml" style="text-align:right;" required onkeypress="return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46"  placeholder="Jumlah"/></td>'+
  '<td><select name="satuan_besar[]" required="required" class="select_satuan form-control select2"><option value="">Satuan Besar</option></select></td>'+
  '<td colspan="5"><input type="text" name="ket_pembelian_detil[]" class="form-control" placeholder="Keterangan"/></td>'+
'</tr>'
  );
  new_raw.insertBefore('#addDepIt');
		  $('.select2').select2(); 		 
		  $(".select_barang").select2({
			ajax: {
				url: '<?php echo base_url();?>admin_apotek/data_barang',
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
				url: '<?php echo base_url();?>admin_apotek/data_satuan',
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
		  $(".select_pabrik").select2({
			ajax: {
				url: '<?php echo base_url();?>admin_apotek/data_pabrik',
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
/*	  $(this).closest('tr').remove();
      var row = $(this).closest('tr');
      var prev = row.prev();
      row.remove();*/
    var closestRow = $(this).closest('tr');
 //   closestRow.add(closestRow.prev()).add(closestRow.next()).remove();
closestRow.add(closestRow.next()).remove();
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
    $('#subtotal_pembelian').val(sums);
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
        $('#subtotal_pembelian').val(sum);
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
//    var diskon_pembelian = document.getElementById('diskon_pembelian').value;
//    var persen_pembelian = document.getElementById('persen_pembelian').value;
//    if (diskon_pembelian=="") { diskon_pembelian = 0; }
 //   if (persen_pembelian=="") { persen_pembelian = 0; }
//	$('#ppn_pembelian').val($('#dep_all_total').val()); // apa yang diketik muncul
	$('#total_pembelian').val($('#diskon_pembelian').val()); // apa yang diketik muncul
/*     document.getElementById("ppn_pembelian").innerHTML = diskon_pembelian;
    document.getElementById("total_pembelian").innerHTML = persen_pembelian; */
	
	
	
/* 	if (diskon_pembelian == 0) {
		percentase = Math.round(parseInt(dep_all_total.replace(/,/g, '')) * (parseInt(persen_pembelian)/100));
	}else if(persen_pembelian == 0) {
		percentase = parseInt(diskon_pembelian.replace(/,/g, ''));
	}else if(persen_pembelian == 0 && diskon_pembelian == 0) {
		percentase = 0;
	}else{
		percentase = Math.round(parseInt(dep_all_total.replace(/,/g, '')) * (parseInt(persen_pembelian)/100));
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
//	document.getElementById('total_pembelian').value = totale.toLocaleString('en-US');
//	document.getElementById('diskon_pembelian').value = totale.toLocaleString('en-US');
//	document.getElementById('ppn_pembelian').value = diskon_pembelian.toLocaleString('en-US');
  }
<?php
}
elseif ($page=="pembelian_edit")  
{
?>
    $('#tgl_pembelian').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_pembelian").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
    $('#tgl_expired').datepicker({
      format: 'dd-mm-yyyy',
      autoclose: true
    })
	$("#tgl_expired").inputmask("datetime", {
		mask: "1-2-y", 
		placeholder: "dd-mm-yyyy", 
		leapday: "-02-29", 
		separator: "-", 
		alias: "dd/mm/yyyy"
	});
const numInputs = document.querySelectorAll('.jml, .harga, .diskon, .dob, .pob, .konversi, .diskonsemua')
numInputs.forEach(function(input) {
  input.addEventListener('change', function(e) {
    if (e.target.value == '') {
      e.target.value = 0
    }
  })
})
    function format ( d ) {        // `d` is the original data object for the row
      return '<table class="table table-striped text-muted style="padding-left:50px; ">'+
	  '<tr> <td>Barcode:</td><td>'+d.barcode_pembelian_detil+'</td> <td style="width: 5%"></td><td>S Besar:</td><td>'+d.satuan_besar+'</td> </tr>'+
        '<tr> <td>Konversi:</td><td>'+d.konversi+'</td> <td></td><td>S Kecil:</td><td>'+d.satuan_kecil+'</td> </tr>'+
		'<tr> <td>Keterangan:</td><td>'+d.ket_pembelian_detil+'</td><td></td><td>% / Rp:</td><td>'+d.persen_pembelian_detil+'</td> </tr>'+
        '</table>';
    }
$(document).ready(function() {
	$('.select2').select2();
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
			"lengthChange": false,
			"pageLength": 20,
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
                "url"  : "<?php echo base_url();?>admin_apotek/pembelian/data2/<?php echo $date;?>",
                "type" : "POST"
            },
            "columns": [  			
                    {
                        "className": 'details-control text-center',
                        "orderable": false,
                        "searchable":false,
                        "data":      null,
                        "defaultContent": '<i class = "glyphicon glyphicon-plus-sign"> </ i>'
                    },  
                      { "data": "id_pembelian_detil", "searchable":false, "visible":false },
					  { "data": "id_pembelian_detil", "searchable":false },
					  { "data": "barcode_pembelian_detil", "searchable":false },				
					  { "data": "jml_pembelian_detil", "searchable":false },					
					  { "data": "harga_pembelian_detil", "searchable":false, className: "text-right" },			
					  { "data": "diskon_pembelian_detil", "searchable":false, className: "text-right" },				
					  { "data": "total_pembelian_detil", "searchable":false, className: "text-right" },
					  { "data": "tgl_expired", "searchable":false },
					  { "data": "qty", "searchable":false, className: "text-right" },
					  { "data": "harga_jual", "searchable":false, className: "text-right" },
            ],
            "order": [[1, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-tag fa-lg'></i> &nbsp; Diskon Seluruhnya",
                    className: "btnteal",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_apotek/pembelian/diskon/'); ?><?php echo $date;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-money fa-lg'></i> &nbsp; Input Harga Jual",
                  extend: "selected",
                  className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pembelian_detil'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('admin_apotek/pembelian/jual/'); ?>'+data+'/<?php echo $date;?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                 {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pembelian_detil'];
                         data2 = dt.rows( { selected: true } ).data()[0]['barcode_pembelian_detil'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Menghapus ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_apotek/pembelian/hapus/'); ?>'+data+'/'+data2+'/<?php echo $date;?>'; //[Modif Disini]
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
	  $(".select_barang").select2({
		ajax: {
			url: '<?php echo base_url();?>admin_apotek/data_barang',
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
			url: '<?php echo base_url();?>admin_apotek/data_satuan',
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
	  $(".select_pabrik").select2({
		ajax: {
			url: '<?php echo base_url();?>admin_apotek/data_pabrik',
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
    $('.OpenDisposisi').on('click',function(){
          var id = $(this).data('id');     
        $('.modal-body').load('<?php echo base_url('admin_apotek/pembelian/diskon/'); ?>'+id,function(){
            $('#modal-default').modal({show:true});
        });
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
    $('.persen').on('change',function(){
            updateDepRow($(this).closest("tr"));

    });
 });

$(document).on('input', '.jml, .harga, .diskon, .persen' , updateDepIT);

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
			if (persen == 0) {
				percent = parseInt(diskon.replace(/,/g, ''));
			}else{
				percent = Math.round((parseInt(jml) * parseInt(harga.replace(/,/g, ''))) * (parseInt(diskon)/100));
			}
			calcu = (parseInt(jml) * parseInt(harga.replace(/,/g, ''))) - percent;
			calcu = parseFloat(calcu).toLocaleString('en-US');
        }
    });
    $row.find('.total').val(calcu);
//    $row.find('.total').val(calcu);
}
function updateDxcvepRow($row){
    $row.find('.jml, .harga, .diskon, .persen, .subp').each(function(i) {
        if (!isNaN(this.value) && this.value.length != 0) {
			var jml = $row.find('.jml').val();
			var harga = $row.find('.harga').val();
			var diskon = $row.find('.diskon').val();
			var persen = $row.find('.persen').val();
			var subp = $row.find('.subp').val();
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
			if(persen == 0) {
				percent = parseInt(diskon.replace(/,/g, ''));
			}else{
				percent = Math.round((parseInt(jml) * parseInt(harga.replace(/,/g, ''))) * (parseInt(diskon.replace(/,/g, ''))/100));
			}
			calcu = (parseInt(jml) * parseInt(harga.replace(/,/g, ''))) - percent;
			var subtotal_pembelian = parseInt(document.getElementById('subtotal_pembelian').value.replace(/,/g, ''));
			var persen_pembelian = parseInt(document.getElementById('persen_pembelian').value.replace(/,/g, ''));
			var diskon_pembelian = parseInt(document.getElementById('diskon_pembelian').value.replace(/,/g, ''));
			if (persen_pembelian == 0) {
				percentase = Math.round(subtotal_pembelian - (diskon_pembelian));		
			}else{
				percentase = Math.round(subtotal_pembelian * (diskon_pembelian/100));
			}
			sub_total = subtotal_pembelian + calcu  - percentase;
			calcu = parseFloat(calcu).toLocaleString('en-US');
			document.getElementById('subdiskon').value = sub_total.toLocaleString('en-US');	
			var pajak = document.getElementById('pajak').value;
	if (pajak == 0) { 
		var spajak = 0;
		document.getElementById('ppn_pembelian').value = spajak.toLocaleString('en-US');
		document.getElementById('ttotal').value = sub_total.toLocaleString('en-US');
		document.getElementById('total_pembelian').value = sub_total.toLocaleString('en-US');
	}else if(pajak == 2) {  //pajak tpph22 = Math.floor((tpph22*100)/100);
		var dpp = Math.floor(sub_total * 100/110);			
		var spajak = Math.floor(10/100 * dpp);		
		var ttotal = spajak + sub_total;
		document.getElementById('ppn_pembelian').value = spajak.toLocaleString('en-US');
		document.getElementById('ttotal').value = ttotal.toLocaleString('en-US');	
		document.getElementById('total_pembelian').value = ttotal.toLocaleString('en-US');	
	}else{
		pajak = Math.floor((sub_total * 10)/100);
		var total = sub_total + pajak;
		document.getElementById('ppn_pembelian').value = spajak.toLocaleString('en-US');
		document.getElementById('ttotal').value = total.toLocaleString('en-US');			
		document.getElementById('total_pembelian').value = total.toLocaleString('en-US');			
	}			
	//		document.getElementById('total_pembelian2').value = sub_total.toLocaleString('en-US');
        }
    });
    $row.find('.total').val(calcu);
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
?>
</script>
		</div>
	</body>
</html>