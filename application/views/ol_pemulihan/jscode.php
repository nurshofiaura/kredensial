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
elseif ($page=="penolakan")
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
                "url"  : "<?php echo base_url();?>ol_pemulihan/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook","searchable":false,"visible":false },
                      { "data": "wkt_logbook", "searchable":false },
                      { "data": "nama_kewenangan", "orderable":false },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "nama_working", "searchable":false },
                      { "data": "tolak", "searchable":false,
                        "render": function(data, type, row){
                            if (row.tolak === '1') {
                               return '<button class="btn btn-xs btn-danger">Supervisi</button>';
                            } else {
                               return '<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
                            }
                        }
                      }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-user-md fa-lg'></i> Daftarkan Untuk Pemulihan",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                    data = dt.rows( { selected: true } ).data()[0]['barcode_pegawai'];
                    // alert(JSON.stringify(data));
                    location.href = '<?php echo base_url('ol_pemulihan/'.$page.'/pendaftaran/'); ?>'+data+'/1';

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
elseif ($page=="validasi_validasi")
{
?>
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb').DataTable( {
            "processing": true,
            "serverSide": true,
            "searching": false,
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
                "url"  : "<?php echo base_url();?>ol_validasi/validasi/dataprint/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_kor_print","searchable":false,"visible":false },
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "nama_kategori","searchable":false },
                      { "data": "nama_pengcab","searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-file-pdf-o'></i> PDF",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      data = dt.rows( { selected: true } ).data()[0]['link_print'];
                      if(data !== null && data !== ''){                     
                        data2 = dt.rows( { selected: true } ).data()[0]['id_kor_print']; 
                        window.open('<?php echo base_url('ol_validasi/pengajuan_korespodensi/pdf_surat/'); ?>'+data2);
                      }
                      else{
                          swal({
                            title: "FORMAT BELUM DIBUAT",
                            text: "SILAHKAN HUBUNGI PROGRAMMER",
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
    });
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty
        console.log(urlToRedirect); // verify if this is the right URL
        swal({
            title: "Apakah Anda Yakin Hapus Data",
            text: "Data Dapat Dipilih Kembali!",
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
    $('.OpenDisposisi').on('click',function(){
          var id = $(this).data('id');   
          var id2 = $(this).data('id2');   
        $('.modal-body').load('<?php echo base_url('ol_validasi/validasi/disposisi/'); ?>'+id+'/'+id2,function(){
            $('#exampleModal').modal({show:true});
        });
    });
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
                "url"  : "<?php echo base_url();?>ol_kompetensi/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan","searchable":false,"visible":false },
                      { "data": "tgl_pengajuan", "searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_status_diusulkan", "searchable":false },
                      { "data": "status_pengajuan", "searchable":false,
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-warning">REGISTRASI</button>';
                            } else if(row.status_pengajuan === '1'){
                               return '<button class="btn btn-xs btn-info">PROSES</button>';
                            } else if(row.status_pengajuan === '2'){
                               return '<button class="btn btn-xs btn-primary">SETUJU</button>';
                            } else {
                               return '<button class="btn btn-xs btn-danger">TOLAK</button>';
                            }
                        }
                      }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-barcode'></i> Lihat Validasi",
                    extend: "selected",
                    className: "btnpurple",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_kompetensi/'.$page.'/seting/'); ?>'+data;
                    }
                }, 
/*                {
                    text: "<i class='fa fa-pencil'></i> Perbaiki Berkas",
                    extend: "selected",
                    className: "btnorange",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = 'echo base_url('ol_kompetensi/'.$page.'/kembali/'); ?>'+data;
                    }
                },*/ 
                {
                    text: "<i class='fa fa-check'></i> Setuju",
                    extend: "selected",
                    className: "btngreen",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_kompetensi/'.$page.'/kirim/2/'); ?>'+data;
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Tolak",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_kompetensi/'.$page.'/kirim/3/'); ?>'+data;
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
elseif ($page=="pengajuan_kompetensi_seting")
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
                "url"  : "<?php echo base_url();?>ol_kompetensi/pengajuan_kompetensi/validator/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan_validasi", "searchable":false, "visible":false },
                      { "data": "nama_ms_struktur","searchable":false },
                      { "data": "nama_pegawai","searchable":false },
                      { "data": "nms","searchable":false },
                      { "data": "nama_working","searchable":false },
                      { "data": "validasi", "searchable":false, 
                        "render": function(data, type, row){
                            if (row.validasi === '1') {
                               return '<button class="btn btn-xs btn-warning"> Setuju</button>';
                             } else if (row.validasi === '2') {
                               return '<button class="btn btn-xs btn-danger"> Tolak</button>';
                             } else {
                               return '<button class="btn btn-xs btn-success"> Proses</button>';
                             } 
                        }
                    }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-edit'></i> Input Validator",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                  data2 = dt.rows( { selected: true } ).data()[0]['id_pengajuan_validasi'];
                  data3 = dt.rows( { selected: true } ).data()[0]['id_pegawai_struktur'];
                  $("#modal-default").modal();
                    $('.modal-body').load('<?php echo base_url('ol_kompetensi/pengajuan_kompetensi/isi_validator/'); ?>'+data+'/'+data2,function(){
                      $('#modal-default').modal({show:true});
                    });
                  }
              },
              {
                text: "<i class='fa fa-search'></i> Lihat Hasil Validasi",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                  data2 = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan_validasi'];
                  data3 = dt.rows( { selected: true } ).data()[0]['barcode_pegawai_struktur'];
                    location.href = '<?php echo base_url('ol_kompetensi/pengajuan_kompetensi/lihat/'); ?><?php echo $id; ?>/'+data2+'/'+data3;
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
elseif ($page=="pengajuan_kompetensi_validasi")
{
?>
    $(document).ready(function() {
        $('.select2').select2()
        var table = $('#dttb2').DataTable( {
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
                "url"  : "<?php echo base_url();?>ol_kompetensi/pengajuan_kompetensi/log_null/<?php echo $id;?>/<?php echo $id3;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook", "searchable":false, "visible":false },
                      { "data": "nama_kewenangan" }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-check'></i> SETUJU",
                    extend: "selected",
                    className: "btngreen",
                    action: function ( e, dt, node, config ) {
                        data1 = dt.rows( { selected: true } ).data()[0]['id_kewenangan'];
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        data3 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_kompetensi/pengajuan_kompetensi/tambah_validasi/'); ?><?php echo $id; ?>/<?php echo $id2; ?>/<?php echo $id3; ?>/1/0/'+data1+'/'+data2+'/'+data3;
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Tolak Supervisi",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data1 = dt.rows( { selected: true } ).data()[0]['id_kewenangan'];
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        data3 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_kompetensi/pengajuan_kompetensi/tambah_validasi/'); ?><?php echo $id; ?>/<?php echo $id2; ?>/<?php echo $id3; ?>/2/1/'+data1+'/'+data2+'/'+data3;
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Tolak Tidak Kompeten",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data1 = dt.rows( { selected: true } ).data()[0]['id_kewenangan'];
                        data2 = dt.rows( { selected: true } ).data()[0]['id_logbook'];
                        data3 = dt.rows( { selected: true } ).data()[0]['id_pegawai'];
                        // alert(JSON.stringify(data));
                        location.href = '<?php echo base_url('ol_kompetensi/pengajuan_kompetensi/tambah_validasi/'); ?><?php echo $id; ?>/<?php echo $id2; ?>/<?php echo $id3; ?>/2/2/'+data1+'/'+data2+'/'+data3;
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
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
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
elseif ($page=="pengajuan_kompetensi_lihat")
{
?>
    $(document).ready(function() {
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
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : true,
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
elseif ($page=="penolakan_pendaftaran")
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
$(document).ready(function() {
  $('.select2').select2()
$('select[name=id_instansi_pegawai]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_pemulihan/unit_data_perinstansi/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
      //   alert(data[0]["nama_unit"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
 //alert("id="+data[1]["id_unit"]+" nama="+data[1]["nama_unit"]);
            $("#id_unit_pegawai").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_unit"];
                var name = data[i]["nama_unit"];

                $("#id_unit_pegawai").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
$('select[name=id_instansi]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_pemulihan/unit_data_perinstansi/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
      //   alert(data[0]["nama_unit"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
 //alert("id="+data[1]["id_unit"]+" nama="+data[1]["nama_unit"]);
            $("#id_unit_pemulihan").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_unit"];
                var name = data[i]["nama_unit"];

                $("#id_unit_pemulihan").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
$('select[name=id_instansi]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_pemulihan/unit_data_opi_pegawai/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
      //   alert(data[0]["nama_unit"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
 //alert("id="+data[1]["id_unit"]+" nama="+data[1]["nama_unit"]);
            $("#id_pemulihan").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_pegawai"];
                var name = data[i]["nama_pegawai"];

                $("#id_pemulihan").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
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
                "url"  : "<?php echo base_url();?>ol_pemulihan/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook_pemulihan", "searchable":false, "visible":false },
                      { "data": "tgl_awal", "searchable":false },
                      { "data": "tgl_akhir", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
                    { "data": "nama_working" },
                    { "data": "nama_unit", "searchable":false },
                      { "data": "result_pemulihan",
                        "render": function(data, type, row){
                            if (row.result_pemulihan === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else if (row.result_pemulihan === '2') {
                               return '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           }
                        }
                    },
                      { "data": "status_pemulihan",
                        "render": function(data, type, row){
                            if (row.status_pemulihan === '1') {
                               return '<button class="btn btn-xs btn-info"> Proses</button>';
                           } else if (row.status_pemulihan === '2') {
                               return '<button class="btn btn-xs btn-success"> Selesai</button>';
                           } else {
                               return '<button class="btn btn-xs btn-default"> Registrasi</button>';
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
                  text: "<i class='fa fa-cog'></i> Seting Pemulihan",
                  extend: "selected",
                  className: "btnpurple",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['barcode_logbook_pemulihan'];
                      // alert(JSON.stringify(data));
                      location.href = '<?php echo base_url('ol_pemulihan/'.$page.'/edit/'); ?>'+data;
                  }
              },
              {
                  text: "<i class='fa fa-search'></i> Hasil Kegiatan",
                  extend: "selected",
                  className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['barcode_logbook_pemulihan'];
                      // alert(JSON.stringify(data));
                      location.href = '<?php echo base_url('ol_pemulihan/'.$page.'/hasil/'); ?>'+data;
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
                "url"  : "<?php echo base_url();?>ol_pemulihan/kegiatan/data2/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook_pemulihan_detil", "searchable":false, "visible":false },
                      { "data": "tgl_logbook", "searchable":false },
                      { "data": "nama_kewenangan" }
            ],
            "order": [[0, 'desc']] ,
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
                      location.href = '<?php echo base_url('ol_pemulihan/kegiatan/tambah/'); ?><?php echo $id;?>';
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
$('select[name=id_instansi_pegawai]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_pemulihan/unit_data_perinstansi/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
      //   alert(data[0]["nama_unit"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
 //alert("id="+data[1]["id_unit"]+" nama="+data[1]["nama_unit"]);
            $("#id_unit_pegawai").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_unit"];
                var name = data[i]["nama_unit"];

                $("#id_unit_pegawai").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
$('select[name=id_instansi]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_pemulihan/unit_data_perinstansi/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
      //   alert(data[0]["nama_unit"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
 //alert("id="+data[1]["id_unit"]+" nama="+data[1]["nama_unit"]);
            $("#id_unit_pemulihan").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_unit"];
                var name = data[i]["nama_unit"];

                $("#id_unit_pemulihan").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
$('select[name=id_instansi]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_pemulihan/unit_data_opi_pegawai/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
      //   alert(data[0]["nama_unit"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
 //alert("id="+data[1]["id_unit"]+" nama="+data[1]["nama_unit"]);
            $("#id_pemulihan").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_pegawai"];
                var name = data[i]["nama_pegawai"];

                $("#id_pemulihan").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
    });
<?php
}
elseif ($page=="kegiatan_tambah")
{
?>
    $(document).ready(function() {
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
                "url"  : "<?php echo base_url();?>ol_pemulihan/kegiatan/data3/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_kegiatan_pemulihan", "searchable":false, "visible":false },
                      { "data": "tgl_kegiatan_pemulihan", "searchable":false },
                      { "data": "nama_kewenangan" },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "rm_kegiatan_pemulihan", "searchable":false },
                                { "data": "catatan_kegiatan_pemulihan", "searchable":false },
                      { "data": "result_kegiatan_pemulihan",
                        "render": function(data, type, row){
                            if (row.result_kegiatan_pemulihan === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else if (row.result_kegiatan_pemulihan === '2') {
                               return '<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           }
                        }
                        }
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
elseif ($page=="list_kegiatan")
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
                "url"  : "<?php echo base_url();?>ol_kegiatan/<?php echo $page;?>/data",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_logbook_pemulihan", "searchable":false, "visible":false },
                      { "data": "tgl_awal", "searchable":false },
                      { "data": "tgl_akhir", "searchable":false },
                      { "data": "nama_pegawai", "searchable":false },
                    { "data": "nama_working" },
                    { "data": "nama_unit" },
                      { "data": "status_pemulihan",
                        "render": function(data, type, row){
                            if (row.status_pemulihan === '1') {
                               return '<button class="btn btn-xs btn-info"> Proses</button>';
                           } else if (row.status_pemulihan === '2') {
                               return '<button class="btn btn-xs btn-success"> Selesai</button>';
                           } else {
                               return '<button class="btn btn-xs btn-default"> Registrasi</button>';
                           }
                        }
                    },
                      { "data": "result_pemulihan",
                        "render": function(data, type, row){
                            if (row.result_pemulihan === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else if (row.result_pemulihan === '2') {
                               return '<button class="btn btn-xs btn-danger"> Tidak Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           }
                        }
                    }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                  text: "<i class='fa fa-pencil'></i> Isi Hasil Kegiatan",
                  extend: "selected",
                  className: "btnfuchsia",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['barcode_logbook_pemulihan'];
                      // alert(JSON.stringify(data));
                      location.href = '<?php echo base_url('ol_kegiatan/'.$page.'/isi/'); ?>'+data;
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
elseif ($page=="list_kegiatan_isi")
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
                "url"  : "<?php echo base_url();?>ol_kegiatan/list_kegiatan/data2/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_kegiatan_pemulihan", "searchable":false, "visible":false },
                      { "data": "tgl_kegiatan_pemulihan", "searchable":false },
                      { "data": "nama_kewenangan" },
                      { "data": "nama_pegawai", "searchable":false },
                      { "data": "rm_kegiatan_pemulihan", "searchable":false },
                      { "data": "catatan_kegiatan_pemulihan", "searchable":false },
                      { "data": "result_kegiatan_pemulihan",
                        "render": function(data, type, row){
                            if (row.result_kegiatan_pemulihan === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           } else if (row.result_kegiatan_pemulihan === '2') {
                               return '<button class="btn btn-xs btn-danger">Tidak Kompeten</button>';
                           } else {
                               return '<button class="btn btn-xs btn-default"> Proses</button>';
                           }
                        }
                       }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-plus'></i> Tambah Kegiatan",
    //            extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
          //            data = dt.rows( { selected: true } ).data()[0]['id_logbook_pemulihan'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('ol_kegiatan/list_kegiatan/input/'); ?><?php echo $id;?>',function(){
                          $('#modal-default').modal({show:true});
                        });

                  }
              },
              {
                text: "<i class='fa fa-pencil'></i> Rubah Kegiatan",
                extend: "selected",
                className: "btnorange",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_kegiatan_pemulihan'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('ol_kegiatan/list_kegiatan/edit/'); ?><?php echo $id;?>/'+data,function(){
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
$('select[name=id_instansi_pegawai]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_kegiatan/unit_data_perinstansi/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
      //   alert(data[0]["nama_unit"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
 //alert("id="+data[1]["id_unit"]+" nama="+data[1]["nama_unit"]);
            $("#id_unit_pegawai").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_unit"];
                var name = data[i]["nama_unit"];

                $("#id_unit_pegawai").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
$('select[name=id_instansi]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_kegiatan/unit_data_perinstansi/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
      //   alert(data[0]["nama_unit"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
 //alert("id="+data[1]["id_unit"]+" nama="+data[1]["nama_unit"]);
            $("#id_unit_pemulihan").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_unit"];
                var name = data[i]["nama_unit"];

                $("#id_unit_pemulihan").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

    });
});
$('select[name=id_instansi]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_kegiatan/unit_data_opi_pegawai/'+$(this).val(),
        type: "POST",
        dataType: 'json'
     }).done(function(data) {
      //   alert(data[0]["nama_unit"]);
        // $('select[name=id_kab]').html(data);
           var len = data.length;
 //alert("id="+data[1]["id_unit"]+" nama="+data[1]["nama_unit"]);
            $("#id_pemulihan").empty();
            for( var i = 0; i<len; i++){
                var id = data[i]["id_pegawai"];
                var name = data[i]["nama_pegawai"];

                $("#id_pemulihan").append("<option value='"+id+"'>"+name+"</option>");

            }
     }).fail(function() {

     }).always(function() {

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
