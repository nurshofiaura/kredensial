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
<?php
//================================================= H O M E =================================================
if ($page=="home")  
{
	//	Agar saat home tidak ke universal
?>

<?php
}
else if ($page=="clone_proses_umum")  
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
//      "pageLength": 10,
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          

                      { "data": "tgl_per_imqc_hasil","searchable":false },
                      { "data": "nama_per_imqc_detil","searchable":false },
                      { "data": "nama_per_imqc","searchable":false },
                      { "data": "jenis_per_imqc","searchable":false },
                      { "data": "hasil_lhu_detil","searchable":false },
                      { "data": "nama_pegawai","searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> Proses",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
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
else if ($page=="clone_proses_buku_putih")  
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
//      "pageLength": 10,
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "coun_kewenangan","searchable":false },
                      { "data": "nama_kompetensi","searchable":false },
                      { "data": "nama_kewenangan","searchable":false },
                      { "data": "id_kode_kewenangan","searchable":false },
                      { "data": "id_sifat_kewenangan","searchable":false },
                      { "data": "creator_kewenangan","searchable":false }

/*                      { "data": "id_pasien","searchable":false },
                      { "data": "rm","searchable":false },
                      { "data": "nama_pasien","searchable":false },
                      { "data": "tgl_lahir","searchable":false },
                      { "data": "jk","searchable":false },
                      { "data": "alamat","searchable":false }*/

/*                      { "data": "tgl_logbook","searchable":false },
                      { "data": "nama_kewenangan","searchable":false },
                      { "data": "nama_kompetensi","searchable":false },
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "jml_logbook","searchable":false },
                      { "data": "nama_working","searchable":false }*/

/*                      { "data": "tgl_lhu","searchable":false },
                      { "data": "nama_lhu","searchable":false },
                      { "data": "nama_equipment","searchable":false },
                      { "data": "nama_item_lhu","searchable":false },
                      { "data": "hasil_lhu_detil","searchable":false },
                      { "data": "nama_pegawai","searchable":false }*/
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> Proses",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
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
else if ($page=="clone_proses_logbook")  
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
//      "pageLength": 10,
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_logbook_pasien","searchable":false },
                      { "data": "tgl_logbook","searchable":false },
                      { "data": "rm","searchable":false },
                      { "data": "nama_pasien","searchable":false },
                      { "data": "nama_kewenangan","searchable":false },
                      { "data": "jml_logbook","searchable":false }

/*                      { "data": "id_pasien","searchable":false },
                      { "data": "rm","searchable":false },
                      { "data": "nama_pasien","searchable":false },
                      { "data": "tgl_lahir","searchable":false },
                      { "data": "jk","searchable":false },
                      { "data": "alamat","searchable":false }*/

/*                      { "data": "tgl_logbook","searchable":false },
                      { "data": "nama_kewenangan","searchable":false },
                      { "data": "nama_kompetensi","searchable":false },
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "jml_logbook","searchable":false },
                      { "data": "nama_working","searchable":false }*/

/*                      { "data": "tgl_lhu","searchable":false },
                      { "data": "nama_lhu","searchable":false },
                      { "data": "nama_equipment","searchable":false },
                      { "data": "nama_item_lhu","searchable":false },
                      { "data": "hasil_lhu_detil","searchable":false },
                      { "data": "nama_pegawai","searchable":false }*/
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> Proses",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
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
else if ($page=="clone_proses_pasien")  
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
//      "pageLength": 10,
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
/*                      { "data": "id_logbook_pasien","searchable":false },
                      { "data": "tgl_logbook","searchable":false },
                      { "data": "rm","searchable":false },
                      { "data": "nama_pasien","searchable":false },
                      { "data": "nama_kewenangan","searchable":false },
                      { "data": "jml_logbook","searchable":false }*/

                      { "data": "id_pasien","searchable":false },
                      { "data": "rm","searchable":false },
                      { "data": "nama_pasien","searchable":false },
                      { "data": "tgl_lahir","searchable":false },
                      { "data": "jk","searchable":false },
                      { "data": "alamat","searchable":false }

/*                      { "data": "tgl_logbook","searchable":false },
                      { "data": "nama_kewenangan","searchable":false },
                      { "data": "nama_kompetensi","searchable":false },
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "jml_logbook","searchable":false },
                      { "data": "nama_working","searchable":false }*/

/*                      { "data": "tgl_lhu","searchable":false },
                      { "data": "nama_lhu","searchable":false },
                      { "data": "nama_equipment","searchable":false },
                      { "data": "nama_item_lhu","searchable":false },
                      { "data": "hasil_lhu_detil","searchable":false },
                      { "data": "nama_pegawai","searchable":false }*/
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> Proses",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
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
else if ($page=="clone_proses_lhu")  
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
//      "pageLength": 10,
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          

                      { "data": "tgl_eq_imut","searchable":false },
                      { "data": "nama_eq_detil","searchable":false },
                      { "data": "nama_equipment","searchable":false },
                      { "data": "hasil_eq_imut","searchable":false },
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "barcode_pegawai","searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> Proses",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
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
//================================================= INSTANSI =================================================
elseif ($page=="dk")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_dk", "searchable":false, "visible": false },
                      { "data": "kode_rekening", "searchable":false },
                      { "data": "nama_dk" },
                      { "data": "nama_working", "searchable":false },
                      { "data": "status_dk", "searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false
                }
             ],
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Tambah Komite",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah Komite",
                  extend: "selected",
                  className: "btnEdit",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_dk'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_transaksi","searchable":false },
                      { "data": "tgl_transaksi","searchable":false },
                      { "data": "no_transaksi" },
                      { "data": "nama_jenis_jurnal" },
                      { "data": "nama_dk","searchable":false },
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "total_transaksi","searchable":false },
                      { "data": "ket_transaksi","searchable":false,"orderable":false },
                      { "data": "struk_transaksi", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.struk_transaksi === '') {
                               return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else if (row.struk_transaksi === null) {
                                return '<button class="btn btn-xs btn-danger"> Belum Ada File</button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"><i class="fa fa-search"></i> Klik Lihat Berkas</button>';
                             } 
                         }
                       }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-plus'></i> Jurnal",
                    className: "btnnavy",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
                    }
                },  
                {
                    text: "<i class='fa fa-pencil'></i> Edit Jurnal",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['kode_transaksi'];  
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data;
                    }
                },  
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['struk_transaksi'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/struk/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },
                {
                  text: "<i class='fa fa-table'></i> Jurnal",
                  extend: "selected",
                  className: "btnlime",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['kode_transaksi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/jurnal/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-table'></i> Buku Besar",
                  extend: "selected",
                  className: "btnolive",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['kode_transaksi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/buku_besar/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-table'></i> Neraca",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['kode_transaksi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/neraca/'); ?><?php echo $first_date;?>/<?php echo $last_date;?>/'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
/*                {
                  text: "<i class='fa fa-table'></i> Rugi Laba",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['kode_transaksi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('?php echo base_url('sa/'.$page.'/rl/'); ?>?php echo $first_date;?>/?php echo $last_date;?>/'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },*/
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
elseif ( $page=="transaksi_tambah" )  
{
?>
$(document).ready(function() {
      $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
      $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());  
    $('.select2').select2();
          $(".select_coa").select2({
            ajax: {
                url: '<?php echo base_url();?>sa/data_coa',
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
                url: '<?php echo base_url();?>sa/data_mata_uang',
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
          html += '<td><input type="text" name="ket_transaksi_detil[]" class="form-control" placeholder="Keterangan Transaksi"/></td>';
          html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
          $('#item_table').append(html); 
          $('.select2').select2();       
          $(".select_coa").select2({
            ajax: {
                url: '<?php echo base_url();?>sa/data_coa',
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
                url: '<?php echo base_url();?>sa/data_mata_uang',
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
}elseif ( $page=="transaksi_edit" )  
{
?>
$(document).ready(function() {
      $('#sumtotal').html( $('input[name^="total_transaksi"]').fonkTopladeb());
      $('#sumdebet').html( $('input[name^="td_debet"]').fonkTopladeb());
      $('#sumkredit').html( $('input[name^="td_kredit"]').fonkToplakre());  
    $('.select2').select2();
          $(".select_coa").select2({
            ajax: {
                url: '<?php echo base_url();?>sa/data_coa',
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
                url: '<?php echo base_url();?>sa/data_mata_uang',
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
          html += '<td><input type="text" name="ket_transaksi_detil[]" class="form-control" placeholder="Keterangan Transaksi"/></td>';
          html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
          $('#item_table').append(html); 
          $('.select2').select2();       
          $(".select_coa").select2({
            ajax: {
                url: '<?php echo base_url();?>sa/data_coa',
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
                url: '<?php echo base_url();?>sa/data_mata_uang',
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
else if ($page=="cl_pmr")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $first_date;?>/<?php echo $last_date;?>",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_logbook_pasien","searchable":false },
                      { "data": "tgl_logbook","searchable":false },
                      { "data": "rm","searchable":false },
                      { "data": "nama_pasien","searchable":false },
                      { "data": "nama_kewenangan","searchable":false },
                      { "data": "jml_logbook","searchable":false }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> Proses",
                    className: "btnTambah",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
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
//================================================= INSTANSI =================================================
else if ($page=="komunitas_tambah" || $page=="komunitas_edit")
{
?>
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>sa/kab_data/'+$(this).val(),
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
            url:'<?php echo base_url();?>sa/kec_data/'+$(this).val(),
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
$(document).ready(function() {
    $('.select2').select2()
});
<?php
}
elseif ($page=="import_csv_tambah" || $page=="kop_tambah")
{
?>
$(document).ready(function() {
    $('.select2').select2()
});
<?php
}
elseif ($page=="komunitas")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_dpk","searchable":false,"visible":false },
                      { "data": "nama_dpk" },
                      { "data": "nama_kab", "searchable":false, "orderable":false },
                      { "data": "cabang", "searchable":false, "orderable":false },                      
                      { "data": "alamat_dpk", "searchable":false, "orderable":false },
                                       { "data": "state",
                                            "render": function(data, type, row){
                                                if (row.state === '0') {
                                                   return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                                               } else {
                                                   return '<button class="btn btn-xs btn-success">AKTIF</button>';
                                               }
                                            }
                                     },
                      { "data": "kop_dpk", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.kop_dpk === '') {
                               return '<button class="btn btn-xs btn-danger"><i class="fa fa-close"></i></button>';
                             } else if (row.kop_dpk === null) {
                                return '<button class="btn btn-xs btn-danger"><i class="fa fa-close"></i></button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"><i class="fa fa-check"></i></button>';
                             } 
                         }
                       },
                      { "data": "stempel_dpk", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.stempel_dpk === '') {
                               return '<button class="btn btn-xs btn-danger"><i class="fa fa-close"></i></button>';
                             } else if (row.stempel_dpk === null) {
                                return '<button class="btn btn-xs btn-danger"><i class="fa fa-close"></i></button>';
                             } else {
                                return '<button class="btn btn-xs btn-success"><i class="fa fa-check"></i></button>';
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
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit / Upload Kop",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_dpk'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Edit / Upload Stempel",
                    extend: "selected",
                    className: "btnaqua",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_dpk'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/stempel/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-search'></i> Lihat Kop",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['kop_dpk'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/kop/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },  
              {
                text: "<i class='fa fa-search'></i> Lihat Stempel",
                extend: "selected",
                className: "btnlime",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['stempel_dpk'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/kop/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD DI MENU RUBAH",
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
elseif ($page=="skewenangan")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_kewenangan","searchable":false },
                      { "data": "nama_kewenangan" },
                      { "data": "kode_unit", "searchable":false, "orderable":false },
                      { "data": "nama_kompetensi", "searchable":false, "orderable":false }
            ],
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
else if ($page=="pengurus_enabled" || $page=="working_enabled" || $page=="instansi_enabled")
{
?>
$(document).ready(function() {
    $('.select2').select2()
    $('.checkall').on('click', function() {
        $('.child').prop('checked', this.checked)
    });
    $('#example1').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : true,
      'scrollX'     : true ,
      'scrollX'         : true,
      'scrollY'         : '350px',
      'scrollCollapse'  : true,
    })
});
<?php
}
else if ($page=="whatsnew")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_whatsnew","searchable":false },
                      { "data": "isi_whatsnew","searchable":false,"orderable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [      
                {
                    text: "<i class='fa fa-pencil'></i> Edit",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_whatsnew'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/whatsnew/edit/'); ?>'+data;
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
elseif ($page=="whatsnew_edit")
{
?>
$(document).ready(function() {
    CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
});
<?php
}
else if ($page=="instansi")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_instansi","searchable":false },
					  { "data": "nama_instansi" },
					  { "data": "alamat_instansi","searchable":false,"orderable":false },
                      { "data": "email_instansi","searchable":false,"orderable":false },
                      { "data": "kontak_instansi","searchable":false,"orderable":false },
                      { "data": "status_bayar",
                        "render": function(data, type, row){
                            if (row.status_bayar === '0') {
                               return '<button class="btn btn-xs btn-danger">FREE</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">PREMIUM</button>';
                           }
                        }
                     },
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                {
                  text: "<i class='fa fa-edit'></i> Rubah Instansi",
                  extend: "selected",
                  className: "btnEdit",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_instansi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },		 
                {
                  text: "<i class='fa fa-phone'></i> Rubah WA Gateway",
                  extend: "selected",
                  className: "btnTambah",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_instansi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit_wa/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-envelope'></i> Rubah Send Email ",
                  extend: "selected",
                  className: "btnUbah",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_instansi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit_email/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Logo",
                    extend: "selected",
                    className: "btnEdit",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_instansi'];  
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/logo/'); ?>'+data;
                    }
                },
                 {
                     text: "<i class='fa fa-trash'></i> Hapus Logo",
                     extend: "selected",
                     className: "btnHapus",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_instansi']; 
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan menghapus logo ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/hapus_logo/'); ?>'+data; //[Modif Disini]
                       } 
                     });
                    }
                 },	
/*                {
                  text: "<i class='fa fa-money fa-lg'></i> Bayar / Pengajuan Kompetensi",
                  extend: "selected",
                  className: "btnUbah",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_instansi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('?php echo base_url('sa/'.$page.'/bayar/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },*/
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
else if ($page=="program")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_program","searchable":false },
					  { "data": "nama_program" },
					  { "data": "tjabatan","searchable":false,"orderable":false },
                      { "data": "tjabatan_fungsional","searchable":false,"orderable":false },
                      { "data": "tstruktur_jabatan","searchable":false,"orderable":false },
                      { "data": "tunit","searchable":false,"orderable":false },
                      { "data": "truangan","searchable":false,"orderable":false },
                      { "data": "takses","searchable":false,"orderable":false },
                      { "data": "tuser_level","searchable":false,"orderable":false }
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },			
                {
                  text: "<i class='fa fa-edit'></i> Jabatan",
                  extend: "selected",
                  className: "btnblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/isi/'); ?>'+data+'<?php echo '/jabatan/jabatan/id_jabatan/nama_jabatan' ?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Jabatan Fungsional",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/isi/'); ?>'+data+'<?php echo '/jabatan_fungsional/jabatan_fungsional/id_jabatan_fungsional/nama_jabatan_fungsional' ?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Struktur Jabatan",
                  extend: "selected",
                  className: "btnlime",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/isi/'); ?>'+data+'<?php echo '/struktur_jabatan/struktur_jabatan/id_struktur_jabatan/nama_struktur_jabatan' ?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Unit",
                  extend: "selected",
                  className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/isi/'); ?>'+data+'<?php echo '/unit/unit/id_unit/nama_unit' ?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Akses",
                  extend: "selected",
                  className: "btngreen",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/isi/'); ?>'+data+'<?php echo '/akses/akses/id_akses/nama_akses' ?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Ruangan",
                  extend: "selected",
                  className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/isi/'); ?>'+data+'<?php echo '/ruangan/ruangan/id_ruangan/nama_ruangan' ?>',function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Level",
                  extend: "selected",
                  className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_program']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/isi/'); ?>'+data+'<?php echo '/user_level/user_level/id_level/nama_level' ?>',function(){
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
else if ($page=="grade")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_grade","searchable":false, "visible":false },
                      { "data": "nama_grade" },
                      { "data": "nama_jabatan","searchable":false,"orderable":false }
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_grade'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
else if ($page=="pcare")  
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
      '<tr> <td>cons id:</td><td>'+d.cons_id+'</td> <td></td><td>secret key:</td><td>'+d.secret_key+'</td> </tr>'+
      '<tr> <td>base url:</td><td>'+d.base_url+'</td> <td></td><td>service name:</td><td>'+d.service_name+'</td> </tr>'+
      '<tr> <td>pcare user:</td><td>'+d.pcare_user+'</td><td></td><td>pcare pass:</td><td>'+d.pcare_pass+'</td> </tr>'+
      '<tr> <td>user key:</td><td>'+d.user_key+'</td><td></td><td>kd aplikasi:</td><td>'+d.kd_aplikasi+'</td> </tr>'+
      '</table>';
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable":false,
                        "orderable":false,
                        "data":      null,
                        "defaultContent": '<i class = "glyphicon glyphicon-plus-sign"> </ i>'
                    },
                      { "data": "id_pcare","searchable":false,"orderable":false },                   
                      { "data": "nama_working" },
                      { "data": "status_pcare",
                        "render": function(data, type, row){
                            if (row.status_pcare === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
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
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_pcare'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
else if ($page=="ol_lakon")  
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
      '<tr> <td>IDP:</td><td>'+d.id_pegawai+'</td> <td></td><td>Barcode P:</td><td>'+d.barcode_pegawai+'</td> </tr>'+
      '<tr> <td>IDU:</td><td>'+d.id_user+'</td> <td></td><td>Barcode U:</td><td>'+d.barcode_user+'</td> </tr>'+
      '<tr> <td>Jabfung:</td><td>'+d.nama_jabatan_fungsional+'</td><td></td><td>HP:</td><td>'+d.no_hp+'</td> </tr>'+
      '<tr> <td>NIP:</td><td>'+d.nip+'</td><td></td><td>No Profesi:</td><td>'+d.no_profesi+'</td> </tr>'+
      '<tr> <td>NIK:</td><td>'+d.nik+'</td><td></td><td>Ins Pelayanan:</td><td>'+d.tmpt_bekerja+'</td> </tr>'+
      '</table>';
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable":false,
                        "orderable":false,
                        "data":      null,
                        "defaultContent": '<i class = "glyphicon glyphicon-plus-sign"> </ i>'
                    },
                      { "data": "id_user","searchable":false,"orderable":false },                   
                      { "data": "nama_pegawai" },
                      { "data": "username","searchable":false,"orderable":false },
                      { "data": "nama_level","searchable":false,"orderable":false },
                      { "data": "nama_working" },
                      { "data": "nama_unit","searchable":false,"orderable":false },
                      { "data": "status_user",
                        "render": function(data, type, row){
                            if (row.status_user === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     },
                     { "data": "status_pegawai",
                        "render": function(data, type, row){
                            if (row.status_pegawai === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     },
                     { "data": "visible",
                        "render": function(data, type, row){
                            if (row.visible === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     },
                     { "data": "give_level",
                        "render": function(data, type, row){
                            if (row.give_level === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     }              
            ],
            "order": [[1, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
                 {
                     text: "<i class='fa fa-plus'></i> Status User Aktif",
                     extend: "selected",
                     className: "btngreen",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_user'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan AKTIFKAN status user ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/status_user/1/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },
                 {
                     text: "<i class='fa fa-minus'></i> Status User Non Aktif",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_user'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan NON AKTIFKAN status user ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/status_user/0/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },         
                 {
                     text: "<i class='fa fa-recycle'></i> Reset Password ke 7654321",
                     extend: "selected",
                     className: "btnmaroon",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan mereset password ke 7654321 ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/reset_password/0/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 }, 
                 {
                     text: "<i class='fa fa-plus'></i> Status Pegawai Aktif",
                     extend: "selected",
                     className: "btngreen",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan AKTIFKAN status pegawai ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/status_pegawai/1/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },    
                  {
                     text: "<i class='fa fa-minus'></i> Status Pegawai Non Aktif",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan NON AKTIFKAN status pegawai ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/status_pegawai/0/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },       
                 {
                     text: "<i class='fa fa-plus'></i> Visible",
                     extend: "selected",
                     className: "btngreen",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan AKTIFKAN Visible ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/visible/1/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },    
                  {
                     text: "<i class='fa fa-minus'></i> Hapus Visible",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan NON AKTIFKAN Visible ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/visible/0/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },
                 {
                     text: "<i class='fa fa-plus'></i> Beri Level",
                     extend: "selected",
                     className: "btngreen",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan AKTIFKAN Level ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/give_level/1/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },    
                  {
                     text: "<i class='fa fa-minus'></i> Hapus Level",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan NON AKTIFKAN Level ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/give_level/0/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },
                {
                    text: "<i class='fa fa-pencil'></i> Hak Akses Lainnya",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/ol_akses/view/'); ?>'+data;
                    }
                }, 
              {
                text: "<i class='fa fa-edit'></i> Rubah Instansi",
                extend: "selected",
                className: "btngreen",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_user'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/rubah/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-edit'></i> Rubah Unit",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/unit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-edit'></i> Ms Kredensial Jab",
                extend: "selected",
                className: "btngreen",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_user'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/ms_kredensial/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-edit'></i> Ms Kredensial Ins",
                extend: "selected",
                className: "btngreen",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_user'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/ms_instansi/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-edit'></i> Ms Kredensial Asesor",
                extend: "selected",
                className: "btngreen",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_user'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/ms_asesor/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-edit'></i> Ms Kredensial Ruangan / Unit",
                extend: "selected",
                className: "btngreen",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_user'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/ms_unit/'); ?>'+data,function(){
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
else if ($page=="ol_akses")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_ol_akses","searchable":false },
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
                     },
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah/'); ?><?php echo $id;?>',function(){
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
                         location.href = '<?php echo base_url('sa/'.$page.'/status/1/'); ?>'+data; //[Modif Disini]
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
                         location.href = '<?php echo base_url('sa/'.$page.'/status/0/'); ?>'+data; //[Modif Disini]
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
else if ($page=="lakon")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_user","searchable":false },
                      { "data": "id_pegawai","searchable":false,"orderable":false },
                      { "data": "username","searchable":false,"orderable":false },
                      { "data": "nama_level","searchable":false,"orderable":false },
                      { "data": "status_user","searchable":false,"orderable":false },
                      { "data": "nama_pegawai" },
                      { "data": "status_pegawai","searchable":false,"orderable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',            
            dom: 'Blrtip',
            "buttons": [
/*                 {
                     text: "<i class='fa fa-plus'></i> Status User Aktif",
                     extend: "selected",
                     className: "btngreen",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_user'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan AKTIFKAN status user ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '?php echo base_url('sa/'.$page.'/status_user/1/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },
                 {
                     text: "<i class='fa fa-minus'></i> Status User Non Aktif",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_user'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan NON AKTIFKAN status user ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '?php echo base_url('sa/'.$page.'/status_user/0/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },         
                 {
                     text: "<i class='fa fa-recycle'></i> Reset Password ke 7654321",
                     extend: "selected",
                     className: "btnmaroon",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_user'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan mereset password ke 7654321 ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '?php echo base_url('sa/'.$page.'/reset_password/0/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 }, 
                 {
                     text: "<i class='fa fa-plus'></i> Status Pegawai Aktif",
                     extend: "selected",
                     className: "btngreen",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan AKTIFKAN status pegawai ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '?php echo base_url('sa/'.$page.'/status_pegawai/1/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },    
                  {
                     text: "<i class='fa fa-minus'></i> Status Pegawai Non Aktif",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan NON AKTIFKAN status pegawai ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '?php echo base_url('sa/'.$page.'/status_pegawai/0/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },       
                {
                    text: "<i class='fa fa-pencil'></i> Hak Akses Lainnya",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '?php echo base_url('sa/akses/view/'); ?>'+data;
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pegawai_akses","searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_akses","searchable":false },
                      { "data": "status_pegawai_akses","searchable":false }
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah/'); ?><?php echo $id;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                 {
                     text: "<i class='fa fa-plus'></i> Status Aktif",
                     extend: "selected",
                     className: "btngreen",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai_akses'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan AKTIFKAN",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/status/1/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },
                 {
                     text: "<i class='fa fa-minus'></i> Status Non Aktif",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_pegawai_akses'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan NON AKTIFKAN",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/status/0/'); ?>'+data; //[Modif Disini]
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
else if ($page=="a_online")  
{
?>
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_kode_online","visible":false },
                      { "data": "kode_online","orderable":false },
                      { "data": "nama_menu","orderable":false },
                      { "data": "status_online",
                        "render": function(data, type, row){
                            if (row.status_online === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     },
                     { "data": "menu",
                        "render": function(data, type, row){
                            if (row.menu === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     },
                    { "data": "seen_pengurus","orderable":false },
                      { "data": "kunci",
                        "render": function(data, type, row){
                            if (row.kunci === '0') {
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                }, 
                {
                  text: "<i class='fa fa-pencil'></i> Edit",
                  extend: "selected",
                  className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kode_online'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
    }); 
<?php
}
else if ($page=="enabled")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id_kode_online;?>/<?php echo $id;?>/<?php echo $id_jabatan;?>/<?php echo $id_instansi;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_ol_enabled","searchable":false },
                      { "data": "kode_online","searchable":false },
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "no_profesi","searchable":false },
                      { "data": "nip","searchable":false },
                      { "data": "nama_jabatan","searchable":false },
                      { "data": "nama_working","searchable":false },
                      { "data": "nama_menu","searchable":false },
                     { "data": "enabled",
                        "render": function(data, type, row){
                            if (row.enabled === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     },
                      { "data": "status_ol_enabled",
                        "render": function(data, type, row){
                            if (row.status_ol_enabled === '0') {
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
                  text: "<i class='fa fa-pencil'></i> Edit",
                  extend: "selected",
                  className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_ol_enabled'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
                            $('#modal-default').modal({show:true});
                          });

                    }
                },
/*                {
                    text: "<i class='fa fa-user-plus'></i> Tambah Pengurus",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '?php echo base_url('sa/pengurus_enabled'); ?>';
                    }
                },*/
                {
                    text: "<i class='fa fa-user-plus'></i> Tambah Instansi",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        location.href = '<?php echo base_url('sa/instansi_enabled'); ?>';
                    }
                },
/*                {
                    text: "<i class='fa fa-pencil'></i> Pengurus",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kode_online'];
                        // alert(JSON.stringify(data));
                        location.href = '?php echo base_url('sa/pengurus_enabled/view/'); ?>'+data;
                    }
                },*/  
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
elseif ($page=="status_bayar")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "barcode_pengajuan", "searchable":false },
                      { "data": "tgl_pengajuan", "searchable":false, "orderable":false },
                      { "data": "nama_pegawai" },  
                      { "data": "nama_working", "searchable":false, "orderable":false  }

/*                
"render": "[, ].name"
===========================================
"render": {
    "_": "plain",
    "filter": "filter",
    "display": "display"
}
===========================================        
"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
    $(nTd).html("<a href='assets/invoice/"+oData.struk_pengajuan+"' target=_blank><i class='fa fa-search'></i> Lihat File</a>")
}
                        */
                        ],
            "order": [[0, 'asc']] ,

/*       columnDefs: [{ 
    "targets": 0,
    "data": 'phone',
    "render": {
      "_": "plain",
      "filter": "filter",
      "display": "display"
    }
    ==========================================
    "targets": 4,
    "data": "description",
    "render": function ( data, type, row, meta ) {
      return type === 'display' && data.length > 40 ?
        '<span title="'+data+'">'+data.substr( 0, 38 )+'...</span>' :
        data;
    }
    ==========================================
    "targets": 7,
    "render": function ( data, type, row, meta ) {
      return '<a href="'+data+'">Download</a>';
    } 
    =====================================================
             
                 targets: 7,
                 render: function (data, type, row) {
                     if (data == 0) {
                         return " intern zero";
                     }
                     else
                         return "intern non zero";
                 }
             }],*/

            select: 'single',                   
            dom: 'Blrtip',  
            "buttons": [ 
                 {
                     text: "<i class='fa fa-money'></i> Aktifasi",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan mengaktifasi ? ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/bayar/'); ?>'+data; //[Modif Disini]
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
elseif ($page=="aktifasi")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
               //       { "data": "barcode_registrasi","searchable":false },
                      { "data": "wkt_registrasi","searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_working" },
                      { "data": "status_bayar_working","searchable":false },
                      { "data": "nominal_working","searchable":false, className: "text-right" },
                      { "data": "expired_working","searchable":false },
                      { "data": "no_hp","searchable":false }
            ],
            "order": [[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-users'></i> Aktifasi",
                    extend: "selected",
                    className: "btnblue",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_registrasi'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah/'); ?>'+data;
                    }
                },
                 {
                     text: "<i class='fa fa-trash'></i> Hapus",
                     extend: "selected",
                     className: "btnred",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['barcode_registrasi'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan menghapus ? ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data; //[Modif Disini]
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
else if ($page=="aktifasi_tambah")
{
?>
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
                    url: "<?php echo base_url();?>sa/check_availability",
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
        url:'<?php echo base_url();?>sa/jabfung_data/'+$(this).val(),
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
$('select[name=id_instansi]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>sa/unite_data/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
        // alert(data[0]["nama_kab"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
// alert("id="+data[1]["id_kab"]+" nama="+data[1]["nama_kab"]);
            $("#id_unit").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_unit"];
                var name = data[i]["nama_unit"];

                $("#id_unit").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
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
elseif ($page=="pengajuan")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_pengajuan","searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "status_pengajuan_temp", "searchable":false,
                        "render": function(data, type, row){
                            if (row.status_pengajuan_temp === 'BAYAR') {
                               return '<button class="btn btn-xs btn-success">LUNAS</button>';
                            } else {
                               return '<button class="btn btn-xs btn-warning">PENDING</button>';
                            }
                        }
                      },
                      { "data": "wkt_pengajuan","searchable":false },
                      { "data": "struk_pengajuan_temp","searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-recycle'></i> Aktifasi",
                    extend: "selected",
                    className: "btnblue",
                    action: function ( e, dt, node, config ) {
                        status_pengajuan_temp = dt.rows( { selected: true } ).data()[0]['status_pengajuan_temp'];
                        if(status_pengajuan_temp=='PENDING'){
                            data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan_temp'];
                            // alert(JSON.stringify(data));
                            location.href = '<?php echo base_url('sa/'.$page.'/aktifasi/'); ?>'+data;
                        }
                        else{
                            swal({
                              title: "Cek Pembayaran",
                              text: "SUDAH MELAKUKAN PEMBAYARAN",
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
else if ($page=="pengajuan_aktifasi" || $page=="struk_upload")
{
?>
$(document).ready(function() {
    $('.select2').select2()
});
$('#tgl_pengajuan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_pengajuan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
}); 
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   = number_string.split(','),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
    });
<?php
}
elseif ($page=="struk")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_pengajuan","searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "create_pengajuan","searchable":false },
                      { "data": "struk_pengajuan","searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-upload'></i> Upload",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/upload/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-search'></i> Lihat Berkas",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['struk_pengajuan'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/struk/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD",
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
elseif ($page=="struktur_jabatan")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_struktur_jabatan", "searchable":false, "visible":false },
                      { "data": "nama_struktur_jabatan" },
                      { "data": "nama_working", "searchable":false, "orderable":false },
                      { "data": "status_struktur_jabatan", "searchable":false, "orderable":false, 
                        "render": function(data, type, row){
                            if (row.status_struktur_jabatan === '1') {
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_struktur_jabatan'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="kategori_absen")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_kategori_absen", "searchable":false, "visible":false },
                      { "data": "nama_kategori_absen" },
                      { "data": "nama_working", "searchable":false, "orderable":false },
                      { "data": "status_kategori_absen", "searchable":false, "orderable":false, 
                        "render": function(data, type, row){
                            if (row.status_kategori_absen === '1') {
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kategori_absen'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="seting_absen")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_seting", "searchable":false, "visible":false },
                      { "data": "nama_seting" },
                      { "data": "nama_unit", "searchable":false, "orderable":false },
                      { "data": "location", "searchable":false, "orderable":false },
                      { "data": "radius", "searchable":false, "orderable":false },
                      { "data": "zoom", "searchable":false, "orderable":false },
                      { "data": "clock_in", "searchable":false, "orderable":false },
                      { "data": "clock_out", "searchable":false, "orderable":false },
                      { "data": "status_seting", "searchable":false, "orderable":false, 
                        "render": function(data, type, row){
                            if (row.status_seting === '1') {
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_seting'];
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="work")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_working","searchable":false,"visible":false },
                      { "data": "nama_working" },
                      { "data": "alamat_working", "searchable":false }
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                }, 
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_working'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                    text: "<i class='fa fa-upload'></i> Upload Kop",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_working'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/kop/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-pencil'></i> Upload Kop Kecil",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_working'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/kop_sm/'); ?>'+data;
                    }
                },
              {
                text: "<i class='fa fa-search'></i> Lihat Kop",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['kop_working'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/kop/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },
              {
                text: "<i class='fa fa-search'></i> Lihat Kop SM",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['kop_sm_working'];
                      if(data !== null && data !== ''){                     
                        window.open('<?php echo base_url('assets/berkas/kop/'); ?>'+data);
                      }
                      else{
                          swal({
                            title: "FILE BELUM ADA",
                            text: "SILAHKAN UPLOAD",
                            icon: "warning",
                            buttons: "Tutup",
                            dangerMode: true,
                          })
                        }
                      }
              },
                {
                    text: "<i class='fa fa-money'></i> Data Pembayaran",
                    extend: "selected",
                    className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_working'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/mitra/view/'); ?>'+data;
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
elseif ($page=="mitra")
{
?>
/*    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   = number_string.split(','),
            sisa    = split[0].length % 3,
            rupiah  = split[0].substr(0, sisa),
            ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        tanpa_rupiah.value = formatRupiah(this.value);
    });*/
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_working_mitra","searchable":false },
                      { "data": "nama_struktur_jabatan" },
                      { "data": "nama_pegawai" },
                      { "data": "nama_working", "searchable":false },
                      { "data": "nominal_working_mitra", "searchable":false },
                      { "data": "tgl_awal_working_mitra", "searchable":false },
                      { "data": "tgl_akhir_working_mitra", "searchable":false },
                      { "data": "ket_working_mitra", "searchable":false },
                      { "data": "status_bayar_working_mitra", "searchable":false,
                        "render": function(data, type, row){
                            if (row.status_bayar_working_mitra === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF /RESIGN</button>';
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
                //    extend: "selected",
                    className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah/'); ?><?php echo $id;?>';
                    }
                }, 
                {
                    text: "<i class='fa fa-edit'></i> Rubah",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_working_mitra'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?><?php echo $id;?>/'+data;
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
elseif ($page=="mitra_tambah" || $page=="mitra_edit"){
?>
$('#tgl_awal_working_mitra').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_awal_working_mitra").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#tgl_akhir_working_mitra').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_akhir_working_mitra").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
function formatRupiah(angka, prefix)
{
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   = number_string.split(','),
        sisa    = split[0].length % 3,
        rupiah  = split[0].substr(0, sisa),
        ribuan  = split[0].substr(sisa).match(/\d{3}/gi);
        
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
var tanpa_rupiah = document.getElementById('tanpa-rupiah');
tanpa_rupiah.addEventListener('keyup', function(e)
{
    tanpa_rupiah.value = formatRupiah(this.value);
});
$(document).ready(function() {
    $('.select2').select2()
});
<?php
}
elseif ($page=="working")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pegawai_instansi","searchable":false },
                      { "data": "id_pegawai", "searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_working", "searchable":false },
                      { "data": "nama_jabatan_fungsional", "searchable":false },
                      { "data": "status_pegawai_instansi", "searchable":false,
                        "render": function(data, type, row){
                            if (row.status_pegawai_instansi === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF /RESIGN</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     }
            ],
            "order": [[0, 'desc'],[1, 'asc']] ,
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                }, 
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_pegawai_instansi'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="aplikasi_bayar")
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
      '<tr> <td>IDP:</td><td>'+d.id_pegawai+'</td> <td></td><td>Barcode:</td><td>'+d.barcode_pegawai+'</td> </tr>'+
      '<tr> <td>Jabfung:</td><td>'+d.nama_jabatan_fungsional+'</td><td></td><td>HP:</td><td>'+d.no_hp+'</td> </tr>'+
      '<tr> <td>Nominal:</td><td>'+d.nominal_aplikasi_bayar+'</td><td></td><td>KTP:</td><td>'+d.nik+'</td> </tr>'+
      '<tr> <td>NIP:</td><td>'+d.nip+'</td><td></td><td>No Profesi:</td><td>'+d.no_profesi+'</td> </tr>'+
      '<tr> <td>Expired:</td><td>'+d.tgl_expired+'</td><td></td><td>Bayar:</td><td>'+d.tgl_aplikasi_bayar+'</td> </tr>'+
      '<tr> <td>Ins Exp:</td><td>'+d.expired_working+'</td><td></td><td>Status Bayar:</td><td>'+d.status_aplikasi_bayar+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data/<?php echo $id;?>",
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
                      { "data": "id_aplikasi_bayar","searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_working", "searchable":false },
                      { "data": "nama_jabatan_fungsional", "searchable":false },
                      { "data": "tipe_konsumen", "searchable":false },
                      { "data": "status_aplikasi_bayar", "searchable":false },
                      { "data": "expired_working", "searchable":false },
                      { "data": "tgl_expired", "searchable":false }
            ],
            "order": [[1, 'desc']] ,
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                }, 
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_aplikasi_bayar'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
else if ($page=="pelayanan")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_pelayanan","searchable":false,"orderable":false },                   
                      { "data": "nama_pelayanan" },
                      { "data": "nama_working","searchable":false,"orderable":false },
                      { "data": "status_pelayanan",
                        "render": function(data, type, row){
                            if (row.status_pelayanan === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
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
                    className: "btnteal",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                }, 
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_pelayanan'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
else if ($page=="ruangan")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [                          
                      { "data": "id_unit","searchable":false,"orderable":false },                   
                      { "data": "nama_unit" },
                      { "data": "nama_struktur_jabatan","searchable":false,"orderable":false },
                      { "data": "nama_working","searchable":false,"orderable":false },
                      { "data": "status_unit",
                        "render": function(data, type, row){
                            if (row.status_unit === '0') {
                               return '<button class="btn btn-xs btn-danger">NON AKTIF</button>';
                           } else {
                               return '<button class="btn btn-xs btn-success">AKTIF</button>';
                           }
                        }
                     }         
            ],
            "order": [[3, 'asc']] ,
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                }, 
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_unit'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="kompetensi")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [            
                      { "data": "create_kompetensi", "searchable":false, "visible":false },
                      { "data": "kode_unit" },
                      { "data": "nama_kompetensi" },
                      { "data": "nama_jabatan", "searchable":false },
                      { "data": "nama_working", "searchable":false },
                    { "data": "status_kompetensi", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.status_kompetensi === '0') {
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kompetensi']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="kewenangan")  
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [            
                      { "data": "create_kewenangan", "searchable":false, "visible":false },
                      { "data": "kode_unit", "orderable":false },
                      { "data": "nama_kewenangan", "orderable":false },                      
                      { "data": "nama_kompetensi", "orderable":false },
                      { "data": "nama_jabatan", "orderable":false },
                      { "data": "nama_working", "orderable":false }
                    
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
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
                {
                  text: "<i class='fa fa-edit'></i> Rubah",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan']; 
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data,function(){
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
elseif ($page=="kop")
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
                "url"  : "<?php echo base_url();?>sa/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_gambar","searchable":false,"visible":false },
                      { "data": "nama_gambar" },
                      { "data": "nama_kategori_gambar","searchable":false },
                      { "data": "nama_working","searchable":false },
                      { "data": "link_gambar","searchable":false },
                      { "data": "status_gambar", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.status_gambar === '0') {
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
                //    extend: "selected",
                    className: "btnteal",
                    action: function ( e, dt, node, config ) {
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/tambah'); ?>';
                    }
                }, 
                {
                    text: "<i class='fa fa-edit'></i> Rubah",
                    extend: "selected",
                    className: "btnlightblue",
                    action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_gambar'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('sa/'.$page.'/edit/'); ?>'+data;
                    }
                },
                {
                  text: "<i class='fa fa-search'></i> Lihat Kop SM",
                  extend: "selected",
                  className: "btnteal",
                    action: function ( e, dt, node, config ) {
                    //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                        data = dt.rows( { selected: true } ).data()[0]['link_gambar'];
                        if(data !== null && data !== ''){                     
                          window.open('<?php echo base_url('assets/berkas/kop/'); ?>'+data);
                        }
                        else{
                            swal({
                              title: "FILE BELUM ADA",
                              text: "SILAHKAN UPLOAD",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                          }
                        }
                },
                {
                  text: "<i class='fa fa-trash'></i> Hapus Logo",
                  extend: "selected",
                  className: "btnred",
                  action: function ( e, dt, node, config ) {
                  data = dt.rows( { selected: true } ).data()[0]['id_gambar']; 
                  data2 = dt.rows( { selected: true } ).data()[0]['link_gambar']; 
                  swal({
                    title: "Yakin ?",
                    text: "Yakin akan menghapus logo ",     //[Modif Disini]
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      location.href = '<?php echo base_url('sa/'.$page.'/hapus/'); ?>'+data+'/'+data2; //[Modif Disini]
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
?>
</script>
		</div>
	</body>
</html>