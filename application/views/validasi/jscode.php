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
                "url"  : "<?php echo base_url();?>validasi/<?php echo $page;?>/data/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "id_pengajuan","searchable":false,"visible":false },
                      { "data": "tgl_pengajuan", "searchable":false },
                      { "data": "nama_pegawai" },
                      { "data": "nama_status_diusulkan", "searchable":false },
                      { "data": "nama_working", "searchable":false },
                      { "data": "status_pengajuan", "searchable":false,
                        "render": function(data, type, row){
                            if (row.status_pengajuan === '0') {
                               return '<button class="btn btn-xs btn-warning">REGISTRASI</button>';
                            } else if(row.status_pengajuan === '1'){
                               return '<button class="btn btn-xs btn-info">PROSES</button>';
                            } else if(row.status_pengajuan === '2'){
                               return '<button class="btn btn-xs btn-primary">Upload Berkas</button>';
                            } else {
                               return '<button class="btn btn-xs btn-success">Terbit SPK</button>';
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
                        location.href = '<?php echo base_url('validasi/'.$page.'/beranda/'); ?>'+data;
                    }
                }, 
                {
                    text: "<i class='fa fa-upload'></i> Upload Signature",
                    className: "btnfuchsia",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                            location.href = '<?php echo base_url('validasi/signature'); ?>';
                    }
                },
/*                  {
                    text: "<i class='fa fa-send'></i> Kirim Data Untuk Upload Kelengkapan",
                    extend: "selected",
                    className: "btngreen",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = 'php echo base_url('validasi/'.$page.'/kirim/2/'); ?>'+data;
                    }
                },
              {
                    text: "<i class='fa fa-close'></i> Tolak",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_pengajuan'];
                        // alert(JSON.stringify(data));
                        location.href = ' echo base_url('ol_kompetensi/'.$page.'/kirim/3/'); '+data;
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
elseif ($page=="pengajuan_kompetensi_permohonan" || $page=="pengajuan_kompetensi_asesmen" || $page=="pengajuan_kompetensi_observasi" || $page=="pengajuan_kompetensi_tulis" || $page=="pengajuan_kompetensi_komponen" || $page=="pengajuan_kompetensi_kesenjangan")  
{
?>
    $(document).ready(function() {
  		CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    });
<?php
}
elseif ($page=="pengajuan_kompetensi_rencana")  
{
?>
    $(document).ready(function() {
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
    $('#example1').DataTable({
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
elseif ($page=="pengajuan_kompetensi_lisan")  
{
?>
    $(document).ready(function() {
        CKEDITOR.replace('editorx', {enterMode: CKEDITOR.ENTER_BR});
    <?php
    $no =0;
    foreach($form2_detil as $rowform2_detil){  
    $no++;    
    ?>
        CKEDITOR.replace('editor<?= $no ?>', {enterMode: CKEDITOR.ENTER_BR});
    <?php 
    }
    ?>
    });
<?php
}
elseif ($page=="pengajuan_kompetensi_portofolio")
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
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
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
                "url"  : "<?php echo base_url();?>validasi/pengajuan_kompetensi/logbook/<?php echo $id;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "nama_kewenangan" },
                      { "data": "nama_kompetensi" },
                      { "data": "nama_sifat_kewenangan" },
                      { "data": "status_validasi","searchable":false, className: "text-center" }
/*                      { "data": null, "orderable": false, "searchable":false, className:"text-center",
                        "render": function(data, type, row){
                            if (row.result_tolak === '1') {
                               return '<button class="btn btn-xs btn-danger"> Supervisi</button>';
                           } else if (row.result_tolak === '2') {
                               return '<button class="btn btn-xs btn-danger">  Tidak Kompeten</button>';
                           } else if (row.validasi === '1') {
                               return '<button class="btn btn-xs btn-success"> Kompeten</button>';
                           }else {
                               return '<button class="btn btn-xs btn-info"> Belum Di Validasi</button>';
                           }
                        }
                      },*/
            ],
            "order": [[1, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                  {
                    text: "<i class='fa fa-pencil'></i> Validasi",
                    extend: "selected",
                    className: "btnolive",
                      action: function ( e, dt, node, config ) { 
                              data = dt.rows( { selected: true } ).data()[0]['id_kewenangan'];
                              $("#modal-default").modal();
                                $('.modal-body').load('<?php echo base_url('validasi/pengajuan_kompetensi/rkk/'); ?><?php echo $id;?>/'+data,function(){
                                  $('#modal-default').modal({show:true});
                                });
                      }
                  },
/*                {
                    text: "<i class='fa fa-check-square-o'></i> Kompeten 1 Kewenangan",
                    extend: "selected",
                    className: "btngreen",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan'];
                        // alert(JSON.stringify(data));
                        location.href = '<php echo base_url('validasi/pengajuan_kompetensi/v_kompetensi_all/1/0/'); ?>'+data+'/<php echo $id; ?>/<php echo $barcode_form; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-check'></i> Kompeten",
                    extend: "selected",
                    className: "btngreen",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<php echo base_url('validasi/pengajuan_kompetensi/v_kompetensi/1/0/'); ?>'+data+'/<php echo $id; ?>/<php echo $barcode_form; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-close'></i> Supervisi",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<php echo base_url('validasi/pengajuan_kompetensi/v_kompetensi/2/1/'); ?>'+data+'/<php echo $id; ?>/<php echo $barcode_form; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-close'></i>  Tidak Kompeten",
                    extend: "selected",
                    className: "btnred",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['barcode_logbook'];
                        // alert(JSON.stringify(data));
                        location.href = '<php echo base_url('validasi/pengajuan_kompetensi/v_kompetensi/2/2/'); ?>'+data+'/<php echo $id; ?>/<php echo $barcode_form; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-times-circle-o'></i> Supervisi 1 Kewenangan",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan'];
                        // alert(JSON.stringify(data));
                        location.href = '<php echo base_url('validasi/pengajuan_kompetensi/v_kompetensi_all/2/1/'); ?>'+data+'/<php echo $id; ?>/<php echo $barcode_form; ?>';
                    }
                },
                {
                    text: "<i class='fa fa-times-circle-o'></i>  Tidak Kompeten 1 Kewenangan",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_kewenangan'];
                        // alert(JSON.stringify(data));
                        location.href = '<php echo base_url('validasi/pengajuan_kompetensi/v_kompetensi_all/2/2/'); ?>'+data+'/<php echo $id; ?>/<php echo $barcode_form; ?>';
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
        $('#examplex').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'scrollX'     : true ,
          'scrollX'         : true,
          'scrollY'         : '350px',
          'scrollCollapse'  : true,
          'order': [[0, 'asc']]
        })
    });
<?php
}
elseif ($page=="pengajuan_kompetensi_konsultasi" || $page=="pengajuan_kompetensi_cek" || $page=="pengajuan_kompetensi_keputusan" || $page=="pengajuan_kompetensi_banding")  
{
?>
    $(document).ready(function() {
        $('.select2').select2()
        CKEDITOR.replace('editor1', {enterMode: CKEDITOR.ENTER_BR});
        $('#url_link').on('change', function(){
             var details = document.getElementById("url_link").value;
             var allData = details.split("||");
             var url_link = allData[0];
             var bpv = allData[1];
                if (typeof bpv !== 'undefined') {
                    document.getElementById('banding_form').value = bpv;
                }else{
                    document.getElementById('banding_form').value = "";
                }
          $('.awaktextarea').load('<?php echo base_url('validasi/pengajuan_kompetensi/'); ?>'+url_link+'<?php echo '_modal/'; ?>'+bpv);
        });
    });
<?php
}
?>
</script>
		</div>
	</body>
</html>