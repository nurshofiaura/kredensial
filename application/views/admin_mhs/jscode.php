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
$(document).ready(function() {
    $('.select2').select2()
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
                "url"  : "<?php echo base_url();?>admin_asesor/<?php echo $page;?>/data/<?php echo $key;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan","searchable":false,"visible":false },
                      { "data": "tgl_pengajuan", "searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_kompetensi", "searchable":false },
                      { "data": "nama_status_diusulkan", "searchable":false },
                      { "data": "status_pengajuan", "searchable":false,
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-warning">REGISTRASI</button>';
                            } else if(row.status_pengajuan === '1'){
                               return '<button class="btn btn-xs btn-info">PROSES</button>';
                            } else if(row.status_pengajuan === '2'){
                               return '<button class="btn btn-xs btn-primary">Validasi</button>';
                            } else if(row.status_pengajuan === '3'){
                               return '<button class="btn btn-xs btn-success">Selesai</button>';
                            } else {
                               return '<button class="btn btn-xs btn-danger">Ditolak</button>';
                            }
                        }
                      }
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [ 
              {
                text: "<i class='fa fa-edit'></i> Pilih Validator",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('admin_asesor/'.$page.'/pilih/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              }, 
              {
                text: "<i class='fa fa-cog'></i> Seting Form Validator",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                    data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                    location.href = '<?php echo base_url('admin_asesor/'.$page.'/form/'); ?>'+data;
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
elseif ($page=="data_user")
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
      '<tr> <td>M Status:</td><td>'+d.nama_status_kawin+'</td> <td></td><td>Email:</td><td>'+d.email+'</td> </tr>'+
      '<tr> <td>No HP:</td><td>'+d.no_hp+'</td>            <td></td>   <td>Status Pegawai:</td><td>'+d.nama_status_pegawai+'</td> </tr>'+
  '<tr> <td>Pendidikan:</td><td>'+d.nama_pendidikan+'</td>            <td></td>   <td>JK:</td><td>'+d.jk+'</td> </tr>'+
  '<tr> <td>NIP:</td><td>'+d.nip+'</td>            <td></td>   <td>NIRA:</td><td>'+d.no_profesi+'</td> </tr>'+
  '<tr> <td>TTL:</td><td>'+d.tmp_lahir+', '+d.tgl_lahir+'</td>            <td></td>   <td>Alamat:</td><td>'+d.alamat+'</td> </tr>'+
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
                "url"  : "<?php echo base_url();?>admin_mhs/<?php echo $page;?>/data/<?php echo $key;?>",
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
  { "data": "id_user","searchable":false,"visible":false },
  { "data": "nama_pegawai" },
  { "data": "nama_level","searchable":false, "orderable":false },
  { "data": "nama_working","searchable":false, "orderable":false },
  { "data": "nama_unit","searchable":false, "orderable":false },                   
            ],
            "order": [[1, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                 {
                     text: "<i class='fa fa-key'></i> Reset Password to 7654321",
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
                         location.href = '<?php echo base_url('admin_mhs/'.$page.'/reset/'); ?>'+data; //[Modif Disini]
                       }
                     });
                    }
                 },
              {
                text: "<i class='fa fa-edit'></i> Rubah Unit",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_user'];
                          data2 = dt.rows( { selected: true } ).data()[0]['barcode_pegawai'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('admin_mhs/'.$page.'/unit/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                 {
                     text: "<i class='fa fa-whatsapp'></i> Kirim Status Akun Ke WA",
                     extend: "selected",
                     className: "btnmaroon",
                     action: function ( e, dt, node, config ) {
                         data = dt.rows( { selected: true } ).data()[0]['id_user'];
                     swal({
                       title: "Yakin ?",
                       text: "Yakin akan Kirim Status WA ",     //[Modif Disini]
                       icon: "warning",
                       buttons: true,
                       dangerMode: true,
                     })
                     .then((willDelete) => {
                       if (willDelete) {
                         location.href = '<?php echo base_url('admin_mhs/'.$page.'/wa_asesor/'); ?>'+data; //[Modif Disini]
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
?>
</script>
		</div>
	</body>
</html>
