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
elseif ($page=="laporan")
{
?>
$('#id').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('#id2').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#id2").inputmask("datetime", {
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
                "url"  : "<?php echo base_url();?>ol_laporan/<?php echo $page;?>/data/<?php echo $id;?>/<?php echo $id2;?>/<?php echo $id3;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "wkt_laporan", "visible":false },
                      { "data": "tgl_laporan", "searchable":false, className : "text-center"},
                      { "data": "tgl_awal", "searchable":false, className : "text-center",  "orderable":false,
                            "render": function ( data, type, row ) {
                                return '(' + row.tgl_awal + ' -' + row.tgl_akhir + ')';
                            }
                      },
                      { "data": "judul_laporan", "orderable":false, className : "text-center"},
                      { "data": "tujuan_laporan", "orderable":false, className : "text-center"},
                      { "data": "nama_working", "searchable":false, "orderable":false, className : "text-center"},
                      { "data": "nama_pegawai", "searchable":false, "orderable":false, className : "text-center"}
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
                          $('.modal-body').load('<?php echo base_url('ol_laporan/'.$page.'/tambah'); ?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/'.$page.'/edit/'); ?>'+data,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                    text: "<i class='fa fa-area-chart'></i> Sesuaikan Data Tabel / Grafik",
                    extend: "selected",
                    className: "btnfuchsia",
                    action: function ( e, dt, node, config ) {
                        data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                        location.href = '<?php echo base_url('ol_laporan/tabel/view/'); ?>'+data;
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
elseif ($page=="tabel"){
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
            "url"  : "<?php echo base_url();?>ol_laporan/<?php echo $page;?>/data/<?php echo $idlap;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "urutan_laporan_tabel", "searchable":false, className : "text-center"},
                      { "data": "judul_laporan_tabel", "searchable":false },
                      { "data": "minimax", "searchable":false },
                      { "data": "lhu", "searchable":false },
                      { "data": "nama_tabel", "orderable":false },
                      { "data": "nama_working", "orderable":false },
                      { "data": "berkas", 
                        "render": function(data, type, row){
                            if (row.berkas === '0' || row.berkas === null || row.berkas == "" ) {
                               return '<button class="btn btn-xs btn-danger"> Tidak Ada</button>';                               
                           }  else {
                               return '<button class="btn btn-xs btn-success"> Ada</button>';
                           }
                        }                          
                      },
                      { "data": "sub", 
                        "render": function(data, type, row){
                            if (row.sub === '1') {
                               return '<button class="btn btn-xs btn-success"> Sertakan</button>';
                           }  else {
                               return '<button class="btn btn-xs btn-danger"> Tidak disertakan</button>';
                           }
                        }                          
                      }
            ],
            "order": [[0, 'asc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
                {
                    text: "<i class='fa fa-area-chart'></i>&nbsp;<i class='fa fa-plus-square'></i> Tambah Grafik / Tabel",
                    className: "btnmaroon",
                    init: function(api, node, config) {
                        $(node).removeClass('btn-default')
                    },
                    action: function ( e, dt, node, config ) {
                        $("#modal-default").modal();
                          $('.modal-body').load('<?php echo base_url('ol_laporan/baru/tambah_tabel/'); ?><?php echo $idlap;?>',function(){
                            $('#modal-default').modal({show:true});
                          });
                    }
                },
              {
                text: "<i class='fa fa-area-chart'></i>&nbsp;<i class='fa fa-pencil-square'></i> Rubah Grafik / Tabel",
                extend: "selected",
                className: "btnmaroon",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/baru/rubah_tabel/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                text: "<i class='fa fa-sort-amount-asc'></i> Sesuaikan Urutan",
                extend: "selected",
                className: "btnnavy",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/baru/rubah_urutan/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
                },
                {
                text: "<i class='fa fa-bar-chart'></i>&nbsp;<i class='fa fa-cogs'></i> Seting Tabel / Grafik",
                extend: "selected",
                className: "btnyellow",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/baru/modif/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
                },
              {
                text: "<i class='fa fa-line-chart'></i> Tambah Min - Max (Range)",
                extend: "selected",
                className: "btnred",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/baru/seting_range/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                text: "<i class='fa fa-database'></i> Pilih Sumber Data",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/baru/rubah_lhu/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
                },
              {
                text: "<i class='fa fa-gears'></i> Pilih Data QC / IM Berdasarkan Laporan Personal / Ruangan",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/baru/rubah_qc/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-database'></i> <i class='fa fa-gears'></i> Seting Sumber Data",
                extend: "selected",
                className: "btnlime",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/'.$page.'/seting_kompetensi/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Seting Isi Sumber Data",
                extend: "selected",
                className: "btnyellow",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/'.$page.'/seting_isi_kompetensi/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
              {
                text: "<i class='fa fa-gears'></i> Pilih Data Kompetensi Berdasarkan Kewenangan / Kompetensi",
                extend: "selected",
                className: "btnblue",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/baru/seting_kewenangan/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
/*              {
                text: "<i class='fa fa-gears'></i> Pilih Berkas Yang Akan Dimasukkan Laporan",
                extend: "selected",
                className: "btnnavy",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<php echo base_url('ol_laporan/baru/seting_berkas/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },*/
              {
                text: "<i class='fa fa-file-pdf-o'></i> Apakah Tampilkan Tombol Sub Laporan?",
                extend: "selected",
                className: "btnorange",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                        //    $('.modal-body').load('<php echo base_url('ol_laporan/'.$page.'/seting_print/'); ?>'+data+'/'+data2,function(){
                            $('.modal-body').load('<?php echo base_url('ol_laporan/baru/seting_sub/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
/*              {
                text: "<i class='fa fa-file-pdf-o'></i> Hanya Tampilkan Print PDF?",
                extend: "selected",
                className: "btnorange",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<php echo base_url('ol_laporan/'.$page.'/seting_print/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
              },
                {
                text: "<i class='fa fa-close'></i> Sertakan / Tidak tombol di Laporan",
                extend: "selected",
                className: "btnred",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<php echo base_url('ol_laporan/'.$page.'/disabel/'); ?>'+data+'/'+data2,function(){
                              $('#modal-default').modal({show:true});
                            });
                  }
                }, */
                {
                    text: "<i class='fa fa-bar-chart'></i>&nbsp;<i class='fa fa-pencil-square'></i> Lihat Tabel / Grafik",
                    extend: "selected",
                    className: "btnmaroon",
                    action: function ( e, dt, node, config ) {
                        kompetensi = dt.rows( { selected: true } ).data()[0]['lhu'];
                        if( kompetensi === "" || !kompetensi){
                            swal({
                              title: "SUMBER DATA KOSONG",
                              text: "Isi Sumber Data Dahulu ",
                              icon: "warning",
                              buttons: "Tutup",
                              dangerMode: true,
                            })
                        }
                        else{
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                    //    location.href = '<?php echo base_url('ol_laporan/cek/view/'); ?>'+data+'/'+data2;
                         window.open('<?php echo base_url('ol_laporan/tabel/cek/'); ?>'+data+'/'+data2);
                        }
                    }
                },
              {
                text: "<i class='fa fa-send'></i> &nbsp; <i class='fa fa-link'></i>&nbsp; Buka Link Laporan",
                extend: "selected",
                className: "btnlightblue",
                  action: function ( e, dt, node, config ) {
                  //    data = dt.rows( { selected: true } ).data()[0]['id_pendaftaran_unit'];
                      laporan = dt.rows( { selected: true } ).data()[0]['id_laporan'];              
                      tabel = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];              
                        window.open('<?php echo base_url('external/forward/view/'); ?>'+laporan+'/'+tabel);
                      }
              },
                {
                text: "<i class='fa fa-copy'></i> Clone Data",
                extend: "selected",
                className: "btnolive",
                  action: function ( e, dt, node, config ) {
                          data = dt.rows( { selected: true } ).data()[0]['id_laporan'];
                          data2 = dt.rows( { selected: true } ).data()[0]['id_laporan_tabel'];
                          $("#modal-default").modal();
                            $('.modal-body').load('<?php echo base_url('ol_laporan/baru/clone/'); ?>'+data+'/'+data2,function(){
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
elseif ($page=="tabel_cek")
{
?>
    <?php 
    if($idtab){
        //============================================================================= GRAFIK 3 Grafik Pie
        if($tabel == 3){
    ?>
            am4core.ready(function() {
                // Tabel 3
            am4core.useTheme(am4themes_dataviz);
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.PieChart);

            chart.data = [
                <?php
                    foreach($grafikpie as $row1){
                ?>
                    {
                      "country":  <?php echo '"'.$row1[$nama_item].'"'; ?>,
                      "total": <?php echo round($row1[$jml_item],2); ?>
                    },
                <?php
                    }
                ?>
            ];

            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "total";
            pieSeries.dataFields.category = "country";
pieSeries.innerRadius = am4core.percent(50);
pieSeries.ticks.template.disabled = true;
pieSeries.labels.template.disabled = true;

            pieSeries.labels.template.text = "[bold {color}]{category} :  {value} ({value.percent.formatNumber('#.0')}%) [/]";
            pieSeries.labels.template.paddingTop = 0;
            pieSeries.labels.template.paddingBottom = 0;
            pieSeries.labels.template.fontSize = 10;
            pieSeries.labels.template.maxWidth = 250;
            pieSeries.labels.template.wrap = true;
            pieSeries.labels.template.relativeRotation = 90;

            var rgm = new am4core.RadialGradientModifier();
            rgm.brightnesses.push(-0.8, -0.8, -0.5, 0, - 0.5);
            pieSeries.slices.template.fillModifier = rgm;
            pieSeries.slices.template.strokeModifier = rgm;
            pieSeries.slices.template.strokeOpacity = 0.4;
            pieSeries.slices.template.strokeWidth = 0;

            var legendContainer = am4core.create("legenddiv", am4core.Container);
            legendContainer.width = am4core.percent(100);
            legendContainer.height = am4core.percent(100);

            chart.legend = new am4charts.Legend();
            //chart.legend.labels.template.text = "[bold {color}]{category} : {value.percent.formatNumber('#.0')}% [/]";
            chart.legend.paddingTop = 0;
            chart.legend.paddingBottom = 0;
            chart.legend.fontSize = 11;
            chart.legend.wrap = true;
        //    chart.legend.labels.template.maxWidth = 150;
            chart.legend.labels.template.truncate = true;   
            chart.legend.scrollable = true;
            chart.legend.parent = legendContainer;

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

            var watermark = chart.createChild(am4core.Label);
            watermark.text = "Source: [bold] kredensial.com [/]";
            watermark.align = "left";
            watermark.fillOpacity = 0.5;
            watermark.disabled = true;

            // Enable watermark on export
            chart.exporting.events.on("exportstarted", function(ev) {
              watermark.disabled = false;
            });

            // Disable watermark when export finishes
            chart.exporting.events.on("exportfinished", function(ev) {
              watermark.disabled = true;
            });

            // Add watermark to validated sprites
            chart.exporting.validateSprites.push(watermark);

            chart.responsive.enabled = true;

            var title = chart.titles.create();
            title.text = "<?php echo $judul_laporan_tabel; ?>";
            title.fontSize = 18;
            title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";
            });
    <?php
        }
        //============================================================================= GRAFIK 5 Grafik Garis Combine
        if($tabel == 5){
    ?>
            am4core.ready(function() {
                // Tabel 5
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            foreach($grafik5 as $row1){
            ?>
            {
              "year": new Date(<?php echo $row1[$js_thn]; ?>, <?php echo $row1[$js_bln]-1; ?>, <?php echo $row1[$js_hr]; ?>),
              <?php
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          } 
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
              foreach($subgrafik5 as $row2){
              ?>
              <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo round($row2[$jml_item],2); ?>,
              <?php
              }
              ?>
            },
            <?php
            }
            ?>
            ];

            chart.maskBullets = false;
            chart.dateFormatter.dateFormat = "dd-MM-yyyy";

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
        //var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

        let label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.maxWidth = 120;

        categoryAxis.events.on("sizechanged", function(ev) {
        let axis = ev.target;
          var cellWidth = axis.pixelWidth / (axis.endIndex - axis.startIndex);
          if (cellWidth < axis.renderer.labels.template.maxWidth) {
            axis.renderer.labels.template.rotation = -45;
            axis.renderer.labels.template.horizontalCenter = "right";
            axis.renderer.labels.template.verticalCenter = "middle";
          }
          else {
            axis.renderer.labels.template.rotation = 0;
            axis.renderer.labels.template.horizontalCenter = "middle";
            axis.renderer.labels.template.verticalCenter = "top";
          }
        });

        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.minGridDistance = 30;

        // Set date label formatting
        dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
        // Create series
        function createSeriesAndAxis(field, name, topMargin, bottomMargin) {
            // Create value axis
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.minLabelPosition = 0.01;

          
          var series = chart.series.push(new am4charts.LineSeries());
          series.dataFields.valueY = field;
          series.dataFields.dateX = "year";
series.strokeWidth = 3;
//series.tensionX = 0.7;
series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series.legendSettings.labelText = "[bold {color}]{name}[/]";
series.legendSettings.valueText = "{valueY.close}";
series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";
          series.name = name;
        //  series.tooltipText = "{dateX}: [b]{valueY}[/]";
    //      series.strokeWidth = 2;
          series.yAxis = valueAxis;
        //  series.legendSettings.valueText = "{valueY}";

        //  series.visible  = false;

          let hs = series.segments.template.states.create("hover")
          hs.properties.strokeWidth = 5;
          series.segments.template.strokeWidth = 1;

          // Add simple bullet
          var circleBullet = series.bullets.push(new am4charts.CircleBullet());
          circleBullet.circle.stroke = am4core.color("#fff");
          circleBullet.circle.strokeWidth = 2;
         // circleBullet.tooltipText = "[bold]{name} : {valueY}[/]";

          var labelBullet = series.bullets.push(new am4charts.LabelBullet());
          labelBullet.label.text = "[bold]{valueY}[/]";
          labelBullet.label.dy = -20;
          labelBullet.fontSize = 11;
          
          valueAxis.renderer.line.strokeOpacity = 1;
          valueAxis.renderer.line.stroke = series.stroke;
          valueAxis.renderer.grid.template.stroke = series.stroke;
          valueAxis.renderer.grid.template.strokeOpacity = 0.1;
          valueAxis.renderer.labels.template.fill = series.stroke;
          valueAxis.renderer.minGridDistance = 25;
          valueAxis.align = "right";
          
          if (topMargin && bottomMargin) {
            valueAxis.marginTop = 10;
            valueAxis.marginBottom = 10;
          }
          else {
            if (topMargin) {
              valueAxis.marginTop = 20;
            }
            if (bottomMargin) {
              valueAxis.marginBottom = 20;
            }
          }
          
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.stroke = am4core.color("#fff");
            bullet.circle.strokeWidth = 2;
            bullet.adapter.add("dy", function(dy, target) {
              hideBullet(target);
              return dy;
            })

            function hideBullet(bullet) {
              if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
                bullet.visible = false;
              }
              else {
                bullet.visible = true;
              }
            }
        }

            <?php
            foreach($legendgrafik5 as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik[$id_item].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_item1].' - '.$rowambil_limbah_grafik[$nama_item2].'"'; ?>, true, true);
            <?php
            }
            ?>

            // createSeriesAndAxis("value", "Series #1", false, true);
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

            chart.legend = new am4charts.Legend();
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
   //         chart.legend.labels.template.text = "[bold {color}]{name}[/]";

            chart.legend.scrollable = true
        //    chart.leftAxesContainer.layout = "vertical";
            chart.rightAxesContainer.layout = "vertical"; 

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

            var watermark = chart.createChild(am4core.Label);
            watermark.text = "Source: [bold] kredensial.com [/]";
            watermark.align = "left";
            watermark.fillOpacity = 0.5;
            watermark.disabled = true;

            chart.exporting.events.on("exportstarted", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.events.on("exportfinished", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.validateSprites.push(watermark);

            var title = chart.titles.create();
            title.text = "<?php echo $judul_laporan_tabel; ?>";
            title.fontSize = 18;
            title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

            }); 
    <?php
        }
        //============================================================================= GRAFIK 6 Grafik Garis Range separate
        if($tabel == 6){
    ?>
            am4core.ready(function() {
                // Tabel 6
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            $jml_hasil_lhu = 0;
            foreach($grafikhr as $row1){
            ?>
            {
              "year": new Date(<?php echo $row1[$js_thn]; ?>, <?php echo $row1[$js_bln]-1; ?>, <?php echo $row1[$js_hr]; ?>),
              <?php
              $no = 0;
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 4){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",".$jml_item." as ".$jml_item." ");     
          }
          elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          } 
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
              foreach($subgrafik5 as $row2){
                $jml_hasil_lhu = $jml_hasil_lhu + $row2[$jml_item];
                  $no++;
              ?>
              <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo round($row2[$jml_item],2); ?>,
              <?php
              }
              ?>
            },
            <?php
            }
            ?>
            ];

            chart.maskBullets = false;
            chart.dateFormatter.dateFormat = "dd-MM-yyyy";

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
        //var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.minGridDistance = 30;

        // Set date label formatting
        dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

        // Create series
        function createSeriesAndAxis(field, name, topMargin, bottomMargin) {
            // Create value axis
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.minLabelPosition = 0.01;
               // valueAxis.min = ?php echo $min_standar; ?>;
                // valueAxis.max = ?php echo $max_standar; ?>;
          
          var series = chart.series.push(new am4charts.LineSeries());
          series.dataFields.valueY = field;
          series.dataFields.dateX = "year";
        //  series.dataFields.categoryX = "year";
          series.name = name;

series.strokeWidth = 3;
//series.tensionX = 0.7;
series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series.legendSettings.labelText = "[bold {color}]{name}[/]";
series.legendSettings.valueText = "{valueY.close}";
series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";

/*          series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
          series.strokeWidth = 2;*/
          series.yAxis = valueAxis;
        //  series.legendSettings.valueText = "{valueY}";

        //  series.visible  = false;

          let hs = series.segments.template.states.create("hover")
          hs.properties.strokeWidth = 5;
          series.segments.template.strokeWidth = 1;

          // Add simple bullet
          var circleBullet = series.bullets.push(new am4charts.CircleBullet());
          circleBullet.circle.stroke = am4core.color("#fff");
          circleBullet.circle.strokeWidth = 2;
         // circleBullet.tooltipText = "[bold]{name} : {valueY}[/]";

          var labelBullet = series.bullets.push(new am4charts.LabelBullet());
          labelBullet.label.text = "[bold]{valueY}[/]";
          labelBullet.label.dy = -20;
          labelBullet.fontSize = 11;

                    //  labelBullet.tooltip.label.wrap = true;
                    //  labelBullet.tooltip.label.width = 300;
          
          valueAxis.renderer.line.strokeOpacity = 1;
          valueAxis.renderer.line.stroke = series.stroke;
          valueAxis.renderer.grid.template.stroke = series.stroke;
          valueAxis.renderer.grid.template.strokeOpacity = 0.1;
          valueAxis.renderer.labels.template.fill = series.stroke;
          valueAxis.renderer.minGridDistance = 25;
          valueAxis.align = "right";
          
          if (topMargin && bottomMargin) {
            valueAxis.marginTop = 10;
            valueAxis.marginBottom = 10;
          }
          else {
            if (topMargin) {
              valueAxis.marginTop = 20;
            }
            if (bottomMargin) {
              valueAxis.marginBottom = 20;
            }
          }
          
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.stroke = am4core.color("#fff");
            bullet.circle.strokeWidth = 2;
            bullet.adapter.add("dy", function(dy, target) {
              hideBullet(target);
              return dy;
            })

            function hideBullet(bullet) {
              if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
                bullet.visible = false;
              }
              else {
                bullet.visible = true;
              }
            }
        }

            <?php
            foreach($legendgrafik5 as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik[$id_item].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_item1].' - '.$rowambil_limbah_grafik[$nama_item2].'"'; ?>, true, true);
            <?php
            }
            ?>

            // createSeriesAndAxis("value", "Series #1", false, true);
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

        var legendContainer = am4core.create("legenddiv", am4core.Container);
        legendContainer.width = am4core.percent(100);
        legendContainer.height = am4core.percent(100);
        //chart.legend.parent = legendContainer;
            chart.legend = new am4charts.Legend();
          //  chart.legend.labels.template.text = "[bold {color}]{name}[/]";
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    //    chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
            chart.legend.labels.template.maxWidth = 350;
            chart.legend.labels.template.truncate = true;
        chart.legend.fontSize = 11;
            chart.legend.scrollable = true
        chart.legend.labels.template.wrap = false;

        /*chart.legend.itemContainers.template.events.on("over", function(ev) {
          var series = ev.target.dataItem.dataContext;
          series.bulletsContainer.show();
        });

        chart.legend.itemContainers.template.events.on("out", function(ev) {
          var series = ev.target.dataItem.dataContext;
          series.bulletsContainer.hide();
        });
        */
            chart.leftAxesContainer.layout = "vertical";

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

            var watermark = chart.createChild(am4core.Label);
            watermark.text = "Source: [bold] kredensial.com [/]";
            watermark.align = "left";
            watermark.fillOpacity = 0.5;
            watermark.disabled = true;

            chart.exporting.events.on("exportstarted", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.events.on("exportfinished", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.validateSprites.push(watermark);

            var title = chart.titles.create();
            title.text = "<?php echo $judul_laporan_tabel; ?>";
            title.fontSize = 18;
            title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

            }); 
    <?php
        }
        //============================================================================= GRAFIK 7 Grafik Garis Range Combine
        if($tabel == 7){
    ?>
            am4core.ready(function() {
                // Tabel 7
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

        chart.data = [
        <?php
        foreach($grafikhr as $row1){
        ?>
        {
         "year": <?php echo '"'.$row1[$tgl_hr].'"'; ?>, //harian
          <?php
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          } 
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
          foreach($subgrafik5 as $row2){
          ?>
          <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
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
            //categoryAxis.fontSize = 10;

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

            // Create value axis
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.inversed = false;
            valueAxis.title.text = "Nilai";
            valueAxis.renderer.minLabelPosition = 0.01;
            <?php  
            if($ambil_data_min > $min_laporan_tabel){
                $plusmin = $min_laporan_tabel - 1;
            }else{
                $plusmin = $ambil_data_min - 1;
            }
            if($ambil_data_max < $max_laporan_tabel){
                 $plusmax = $max_laporan_tabel + 1;
            }else{
                 $plusmax = $ambil_data_max + 1;
            }
            ?>
            valueAxis.min = <?= $plusmin ?>;
            valueAxis.max = <?= $plusmax ?>;

            let range0 = valueAxis.axisRanges.create();
            range0.value = <?= round($min_laporan_tabel,2) ?>;
            range0.label.text = "Batas Min = <?= round($min_laporan_tabel,2) ?>";
            range0.grid.stroke = am4core.color("#ff0000");
            range0.grid.strokeWidth = 2;
            range0.grid.strokeOpacity = 1;
            range0.label.inside = true;
            range0.label.fill = range0.grid.stroke;
            range0.label.verticalCenter = "bottom";

            let range500 = valueAxis.axisRanges.create();
            range500.value = <?= round($max_laporan_tabel,2) ?>;
            range500.label.text = "Batas Max = <?= round($max_laporan_tabel,2) ?>";
            range500.grid.stroke = am4core.color("#ff0000");
            range500.grid.strokeWidth = 2;
            range500.grid.strokeOpacity = 1;
            range500.label.inside = true;
            range500.label.fill = range500.grid.stroke;
            range500.label.verticalCenter = "bottom";

            <?php
            foreach($legendgrafik5 as $row1x){
            ?>
            // Create series
            var series<?php echo $row1x[$id_item]; ?> = chart.series.push(new am4charts.LineSeries());
            series<?php echo $row1x[$id_item]; ?>.dataFields.valueY = <?php echo '"'.$row1x[$id_item].'"'; ?>;
            series<?php echo $row1x[$id_item]; ?>.dataFields.categoryX = "year";
            series<?php echo $row1x[$id_item]; ?>.name = <?php echo '"'.$row1x[$nama_item1].' - '.$row1x[$nama_item2].'"'; ?>;
            series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
            series<?php echo $row1x[$id_item]; ?>.visible  = false;

series<?php echo $row1x[$id_item]; ?>.strokeWidth = 3;
//     series<?php echo $row1x[$id_item]; ?>.tensionX = 0.7;
series<?php echo $row1x[$id_item]; ?>.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.labelText = "[bold {color}]{name}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.valueText = "{valueY.close}";
series<?php echo $row1x[$id_item]; ?>.legendSettings.itemValueText = "[bold]{valueY}[/bold]";

            let hs<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.segments.template.states.create("hover")
            hs<?php echo $row1x[$id_item]; ?>.properties.strokeWidth = 5;
            series<?php echo $row1x[$id_item]; ?>.segments.template.strokeWidth = 1;

            var circleBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
            circleBullet<?php echo $row1x[$id_item]; ?>.circle.stroke = am4core.color("#fff");
            circleBullet<?php echo $row1x[$id_item]; ?>.circle.strokeWidth = 2;

            var labelBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.LabelBullet());
            labelBullet<?php echo $row1x[$id_item]; ?>.label.text = "[bold {color}]{valueY}[/]";
            labelBullet<?php echo $row1x[$id_item]; ?>.label.dy = -20;
            labelBullet<?php echo $row1x[$id_item]; ?>.fontSize = 11;

            <?php
            }
            ?>

                chart.cursor = new am4charts.XYCursor();
                chart.cursor.lineX.strokeOpacity = 0;
                chart.cursor.lineY.strokeOpacity = 0;

                chart.zoomOutButton.align = "left";
                chart.zoomOutButton.valign = "bottom";
                chart.zoomOutButton.marginLeft = 10;
                chart.zoomOutButton.marginBottom = 10;

                var scrollbar = new am4charts.XYChartScrollbar();

                chart.scrollbarX = scrollbar;
                chart.legend = new am4charts.Legend();
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
        //        chart.legend.labels.template.text = "[bold {color}]{name}[/]";

                chart.legend.scrollable = true
                chart.legend.labels.template.text = "[bold {color}]{name} : {value} [/]";
                chart.legend.labels.template.maxWidth = 350;
                chart.legend.labels.template.truncate = true;
                chart.legend.fontSize = 11;
                chart.legend.scrollable = true
                chart.leftAxesContainer.layout = "vertical";

                chart.exporting.menu = new am4core.ExportMenu();
                chart.exporting.menu.align = "left";
                chart.exporting.menu.verticalAlign = "top";

                var watermark = chart.createChild(am4core.Label);
                watermark.text = "Source: [bold] kredensial.com [/]";
                watermark.align = "left";
                watermark.fillOpacity = 0.5;
                watermark.disabled = true;

                // Enable watermark on export
                chart.exporting.events.on("exportstarted", function(ev) {
                  watermark.disabled = true;
                });

                // Disable watermark when export finishes
                chart.exporting.events.on("exportfinished", function(ev) {
                  watermark.disabled = true;
                });

                // Add watermark to validated sprites
                chart.exporting.validateSprites.push(watermark);

                var title = chart.titles.create();
                title.text = "<?php echo $judul_laporan_tabel; ?>";
                title.fontSize = 18;
                title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

            }); // end am4core.ready()
    <?php
        }
        //============================================================================= GRAFIK 8 Grafik Garis separate
        if($tabel == 8){
    ?>
            am4core.ready(function() {
                // Tabel 8
            am4core.useTheme(am4themes_animated);
            var chart = am4core.create("chartdiv", am4charts.XYChart);

            chart.data = [
            <?php
            $jml_hasil_lhu = 0;
            foreach($grafik5 as $row1){
            ?>
            {
              "year": new Date(<?php echo $row1[$js_thn]; ?>, <?php echo $row1[$js_bln]-1; ?>, <?php echo $row1[$js_hr]; ?>),
              <?php
              $no = 0;
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          }   
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
              foreach($subgrafik5 as $row2){
                $jml_hasil_lhu = $jml_hasil_lhu + $row2[$jml_item];
                  $no++;
              ?>
              <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo round($row2[$jml_item],2); ?>,
              <?php
              }
              ?>
            },
            <?php
            }
            ?>
            ];

            chart.maskBullets = false;
            chart.dateFormatter.dateFormat = "dd-MM-yyyy";

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.DateAxis());
        //var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        dateAxis.renderer.minGridDistance = 30;

        // Set date label formatting
        dateAxis.periodChangeDateFormats.setKey("month", "[bold]yyyy");
        // Create series
        function createSeriesAndAxis(field, name, topMargin, bottomMargin) {
            // Create value axis
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.renderer.minLabelPosition = 0.01;
               // valueAxis.min = ?php echo $min_standar; ?>;
                // valueAxis.max = ?php echo $max_standar; ?>;
          
          var series = chart.series.push(new am4charts.LineSeries());
          series.dataFields.valueY = field;
          series.dataFields.dateX = "year";
        //  series.dataFields.categoryX = "year";
          series.name = name;
        //  series.tooltipText = "{name}: [b]{valueY}[/]";
        //  series.strokeWidth = 2;
 series.strokeWidth = 3;
//     series.tensionX = 0.7;
series.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series.legendSettings.labelText = "[bold {color}]{name}[/]";
series.legendSettings.valueText = "{valueY.close}";
series.legendSettings.itemValueText = "[bold]{valueY}[/bold]";       
          series.yAxis = valueAxis;
        //  series.legendSettings.valueText = "{valueY}";
        //  series.visible  = false;

          let hs = series.segments.template.states.create("hover")
          hs.properties.strokeWidth = 5;
          series.segments.template.strokeWidth = 1;

          // Add simple bullet
          var circleBullet = series.bullets.push(new am4charts.CircleBullet());
          circleBullet.circle.stroke = am4core.color("#fff");
          circleBullet.circle.strokeWidth = 2;
         // circleBullet.tooltipText = "[bold]{name} : {valueY}[/]";

          var labelBullet = series.bullets.push(new am4charts.LabelBullet());
          labelBullet.label.text = "[bold]{valueY}[/]";
          labelBullet.label.dy = -20;
          labelBullet.fontSize = 11;

                    //  labelBullet.tooltip.label.wrap = true;
                    //  labelBullet.tooltip.label.width = 300;
          
          valueAxis.renderer.line.strokeOpacity = 1;
          valueAxis.renderer.line.stroke = series.stroke;
          valueAxis.renderer.grid.template.stroke = series.stroke;
          valueAxis.renderer.grid.template.strokeOpacity = 0.1;
          valueAxis.renderer.labels.template.fill = series.stroke;
          valueAxis.renderer.minGridDistance = 25;
          valueAxis.align = "right";
          
          if (topMargin && bottomMargin) {
            valueAxis.marginTop = 10;
            valueAxis.marginBottom = 10;
          }
          else {
            if (topMargin) {
              valueAxis.marginTop = 20;
            }
            if (bottomMargin) {
              valueAxis.marginBottom = 20;
            }
          }
          
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.stroke = am4core.color("#fff");
            bullet.circle.strokeWidth = 2;
            bullet.adapter.add("dy", function(dy, target) {
              hideBullet(target);
              return dy;
            })

            function hideBullet(bullet) {
              if (bullet.pixelX < 0 || bullet.pixelX > chart.plotContainer.measuredWidth || bullet.pixelY < 0 || bullet.pixelY > chart.plotContainer.measuredHeight) {
                bullet.visible = false;
              }
              else {
                bullet.visible = true;
              }
            }
        }

            <?php
            foreach($legendgrafik5 as $rowambil_limbah_grafik){
            ?>
            createSeriesAndAxis(<?php echo '"'.$rowambil_limbah_grafik[$id_item].'"'; ?>, <?php echo '"'.$rowambil_limbah_grafik[$nama_item1].' - '.$rowambil_limbah_grafik[$nama_item2].'"'; ?>, true, true);
            <?php
            }
            ?>

            // createSeriesAndAxis("value", "Series #1", false, true);
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

        var legendContainer = am4core.create("legenddiv", am4core.Container);
        legendContainer.width = am4core.percent(100);
        legendContainer.height = am4core.percent(100);
        //chart.legend.parent = legendContainer;
            chart.legend = new am4charts.Legend();
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
//        chart.legend.itemContainers.template.tooltipText = "[bold {color}]{name}[/]";
            chart.legend.labels.template.maxWidth = 350;
            chart.legend.labels.template.truncate = true;
        chart.legend.fontSize = 11;
            chart.legend.scrollable = true
        chart.legend.labels.template.wrap = false;

        /*chart.legend.itemContainers.template.events.on("over", function(ev) {
          var series = ev.target.dataItem.dataContext;
          series.bulletsContainer.show();
        });

        chart.legend.itemContainers.template.events.on("out", function(ev) {
          var series = ev.target.dataItem.dataContext;
          series.bulletsContainer.hide();
        });
        */
            chart.leftAxesContainer.layout = "vertical";

            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "left";
            chart.exporting.menu.verticalAlign = "top";

            var watermark = chart.createChild(am4core.Label);
            watermark.text = "Source: [bold] kredensial.com [/]";
            watermark.align = "left";
            watermark.fillOpacity = 0.5;
            watermark.disabled = true;

            chart.exporting.events.on("exportstarted", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.events.on("exportfinished", function(ev) {
              watermark.disabled = true;
            });

            chart.exporting.validateSprites.push(watermark);

            var title = chart.titles.create();
            title.text = "<?php echo $judul_laporan_tabel; ?>";
            title.fontSize = 18;
            title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

            }); 
    <?php
        }
        //============================================================================= GRAFIK 9 Grafik Garis
        if($tabel == 9){
    ?>
        am4core.ready(function() {
            // Tabel 9
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.data = [
        <?php
        foreach($grafik5 as $row1){
        ?>
        {
    //      "year": <?php echo '"'.$row1[$tgl_hr].'"'; ?>, //harian
          "year": <?php echo '"'.$row1[$tgl_bln].'"'; ?>, //bulanan
    //      "year": <?php echo '"'.$row1[$tgl_thn].'"'; ?>, //tahunan
          <?php
          $no = 0;
          if($lhu == 5){
        $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }elseif($lhu == 8){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          }       
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
          foreach($subgrafik5 as $row2){
              $no++;
          ?>
          <?php echo '"'.$row2[$id_item].'"'; ?>:<?php echo $row2[$jml_item]; ?>,
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

var axisTooltip = categoryAxis.tooltip;
axisTooltip.background.fill = am4core.color("#07BEB8");
axisTooltip.background.strokeWidth = 0;
axisTooltip.background.cornerRadius = 3;
axisTooltip.background.pointerLength = 0;
axisTooltip.dy = 5;

var dropShadow = new am4core.DropShadowFilter();
dropShadow.dy = 1;
dropShadow.dx = 1;
dropShadow.opacity = 0.5;
axisTooltip.filters.push(dropShadow);

        // Create value axis
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.inversed = false;
        valueAxis.title.text = "Nilai";
        valueAxis.renderer.minLabelPosition = 0.01;

        <?php
        foreach($legendgrafik5 as $row1x){
        //  $jsonxx = $this->m_umum->ambil_data('dsr_kredensial','id_dsr_kredensial',$nox);
        ?>
        // Create series
        var series<?php echo $row1x[$id_item]; ?> = chart.series.push(new am4charts.LineSeries());
        series<?php echo $row1x[$id_item]; ?>.dataFields.valueY = <?php echo '"'.$row1x[$id_item].'"'; ?>;
        series<?php echo $row1x[$id_item]; ?>.dataFields.categoryX = "year";
        series<?php echo $row1x[$id_item]; ?>.name = <?php echo '"'.$row1x[$nama_item1].' - '.$row1x[$nama_item2].'"'; ?>;
        series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
    //    series<?php echo $row1x[$id_item]; ?>.tooltipText = "{name} Tgl {categoryX} : {valueY}";
    //    series<?php echo $row1x[$id_item]; ?>.legendSettings.valueText = "{valueY}";
        series<?php echo $row1x[$id_item]; ?>.visible  = false;

 series<?php echo $row1x[$id_item]; ?>.strokeWidth = 3;
series<?php echo $row1x[$id_item]; ?>.tooltipText = "{name} - {dateX} : [b]{valueY}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.labelText = "[bold {color}]{name}[/]";
series<?php echo $row1x[$id_item]; ?>.legendSettings.valueText = "{valueY.close}";
series<?php echo $row1x[$id_item]; ?>.legendSettings.itemValueText = "[bold]{valueY}[/bold]";  

        let hs<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.segments.template.states.create("hover")
        hs<?php echo $row1x[$id_item]; ?>.properties.strokeWidth = 5;
        series<?php echo $row1x[$id_item]; ?>.segments.template.strokeWidth = 1;

        var circleBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.CircleBullet());
        circleBullet<?php echo $row1x[$id_item]; ?>.circle.stroke = am4core.color("#fff");
        circleBullet<?php echo $row1x[$id_item]; ?>.circle.strokeWidth = 2;

        var labelBullet<?php echo $row1x[$id_item]; ?> = series<?php echo $row1x[$id_item]; ?>.bullets.push(new am4charts.LabelBullet());
        labelBullet<?php echo $row1x[$id_item]; ?>.label.text = "{valueY}";
        labelBullet<?php echo $row1x[$id_item]; ?>.label.dy = -20;

        <?php
        }
        ?>
    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;
    chart.legend = new am4charts.Legend();
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    chart.legend.labels.maxWidth = 350;
    chart.legend.labels.maxHeight  = 350;
    chart.legend.labels.truncate = true;
    chart.legend.fontSize = 10;
    chart.legend.labels.template.wrap = false;
//    chart.legend.scrollable = true
//   chart.leftAxesContainer.layout = "horizontal";
 //   chart.leftAxesContainer.layout = "vertical";
 //   chart.rightAxesContainer.layout = "vertical";

    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.responsive.enabled = true;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?= $judul_laporan_tabel ?>";
    title.fontSize = 18;
    title.tooltipText = "<?= $judul_laporan_tabel ?>";

    }); // end am4core.ready()
    <?php
        }
        //============================================================================= GRAFIK 10 Grafik Batang
        if($tabel == 10){
    ?>
        am4core.ready(function() {

        // Tabel 10
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);
        chart.scrollbarX = new am4core.Scrollbar();

            chart.data = [
                <?php
                    foreach($grafikpie as $row1){
                ?>
                    {
                      "country":  <?php echo '"'.$row1[$nama_item].'"'; ?>,
                      "visits": <?php echo round($row1[$jml_item],2); ?>
                    },
                <?php
                    }
                ?>
            ];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.renderer.labels.template.rotation = -45;
        categoryAxis.tooltip.disabled = true;
        categoryAxis.renderer.minHeight = 110;

        let label = categoryAxis.renderer.labels.template;
        label.wrap = true;
        label.maxWidth = 120;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.tooltipText = "[bold]{categoryX} : {valueY}[/]";
        series.columns.template.strokeWidth = 0;

        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

        var bullet = series.bullets.push(new am4charts.LabelBullet())
        bullet.interactionsEnabled = false
        bullet.dy = -10;
        bullet.label.text = '[bold]{valueY}[/]'
        bullet.label.fill = am4core.color('#000000')

        // on hover, make corner radiuses bigger
        var hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", function(fill, target) {
          return chart.colors.getIndex(target.dataItem.index);
        });

        // Cursor
        chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

    var scrollbar = new am4charts.XYChartScrollbar();

    chart.scrollbarX = scrollbar;

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?= $judul_laporan_tabel ?>";
    title.fontSize = 18;
    title.tooltipText = "<?= $judul_laporan_tabel ?>";

        }); // end am4core.ready()
    <?php
        }
        //============================================================================= GRAFIK 11 Grafik Batang Persentase
        if($tabel == 11){
    ?>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in


chart.data = [
<?php  
//========================================================== PHP
//$group_loro = array("MONTH(tgl_logbook)", $grup2);
//$period = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$group1); 
        foreach($grafik5 as $row1){                             //==================== FOREACH
            $bulan =  $this->m_rancak->getBulan(date('m',strtotime($row1[$tgl_item])));  
            $bln =  date('Y-m',strtotime($row1[$tgl_item]));
            $tahun =  date('Y',strtotime($row1[$tgl_item]));
            $join = $bulan.'   '.$tahun;
//========================================================== END PHP
?>
  {
    category: <?= '"'.$join.'"' ?>,
<?php  
//========================================================== PHP
          if($lhu == 5){
        $subselectgrafik5 = (" ".$coun_item." as ".$id_item.",COUNT(".$coun_item.") as ".$jml_item." ");    
          }elseif($lhu == 4 || $lhu == 8){
        $subselectgrafik5 = (" ".$coun_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }elseif($lhu == 7){
        $subselectgrafik5 = (" ".$id_item." as ".$id_item.",COUNT(".$sume.") as ".$jml_item." ");    
          }else{
       $subselectgrafik5 = (" ".$grup_item." as ".$id_item.",SUM(".$jml_item.") as ".$jml_item." ");     
          }
           if($lhu == 4){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$id_instansi);    
          }elseif($lhu == 8 || $lhu == 5){
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$ins=>$idinst);    
          }else{
        $subkondisi5 = array('YEAR('.$tgl_item.')'=>$row1[$js_thn],'MONTH('.$tgl_item.')'=>$row1[$js_bln],$id_peg=>$pegawai,$ins=>$id_instansi);    
          }       
        $subgrafik5 = $this->m_ol_laporan->ambil_isi($idtab,$tabel_item,$subselectgrafik5,$subkondisi5,$lhu,$tgl_item,'asc',$jml_isi,$arr_isi,$jml_seting,$arr_seting,$grup_item);
//$komp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$skonbln,$id,$grup2);
foreach($subgrafik5 as $rowkomp){                                                     //==================== SUB FOREACH
//========================================================== END PHP
?>
    <?= $rowkomp[$id_item] ?>: <?= $rowkomp[$jml_item] ?>,
<?php 
//========================================================== PHP 
}                                                                               //==================== END SUB FOREACH
//========================================================== END PHP
?>
  },
<?php  
//========================================================== PHP
}                                                                               //==================== END FOREACH
//========================================================== END PHP
?>
];

chart.colors.step = 2;
chart.padding(30, 30, 10, 30);

var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "category";
categoryAxis.renderer.grid.template.location = 0;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.max = 100;
valueAxis.strictMinMax = true;
valueAxis.calculateTotals = true;
valueAxis.renderer.minWidth = 50;

<?php  
//$kp = $this->m_member->ambil_grafik_range_new($lhu,$tabel1,$select2,$konbln,$id,$grup2);
    foreach($legendgrafik5 as $rowkp){
        if($lhu == 4 || $lhu == 5 || $lhu == 8){
            $rowkp[$id_item] = $rowkp[$coun_item];
        }
?>

var series<?= $rowkp[$id_item] ?> = chart.series.push(new am4charts.ColumnSeries());
series<?= $rowkp[$id_item] ?>.columns.template.width = am4core.percent(80);
series<?= $rowkp[$id_item] ?>.columns.template.tooltipText = "{name}: {valueY}";
series<?= $rowkp[$id_item] ?>.name = <?php echo '"'.$rowkp[$nama_item1].' - '.$rowkp[$nama_item2].'"'; ?>;
series<?= $rowkp[$id_item] ?>.dataFields.categoryX = "category";
series<?= $rowkp[$id_item] ?>.dataFields.valueY = <?= '"'.$rowkp[$id_item].'"' ?>;
series<?= $rowkp[$id_item] ?>.dataFields.valueYShow = "totalPercent";
series<?= $rowkp[$id_item] ?>.dataItems.template.locations.categoryX = 0.5;
series<?= $rowkp[$id_item] ?>.stacked = true;
series<?= $rowkp[$id_item] ?>.tooltip.pointerOrientation = "vertical";

var bullet<?= $rowkp[$id_item] ?> = series<?= $rowkp[$id_item] ?>.bullets.push(new am4charts.LabelBullet());
bullet<?= $rowkp[$id_item] ?>.interactionsEnabled = false;
bullet<?= $rowkp[$id_item] ?>.label.text = "{valueY} : {valueY.totalPercent.formatNumber('#.00')}%";
//bullet<?= $rowkp[$id_item] ?>.label.truncate = true;
bullet<?= $rowkp[$id_item] ?>.label.text.wrap = true;
bullet<?= $rowkp[$id_item] ?>.label.fill = am4core.color("#ffffff");
bullet<?= $rowkp[$id_item] ?>.locationY = 0.5;


<?php  
    }
?>

chart.scrollbarX = new am4core.Scrollbar();


    chart.cursor = new am4charts.XYCursor();
    chart.cursor.lineX.strokeOpacity = 0;
    chart.cursor.lineY.strokeOpacity = 0;

    chart.zoomOutButton.align = "left";
    chart.zoomOutButton.valign = "bottom";
    chart.zoomOutButton.marginLeft = 10;
    chart.zoomOutButton.marginBottom = 10;

chart.legend = new am4charts.Legend();
chart.legend.markers.template.disabled = true;
chart.legend.labels.template.text = "[bold {color}]{name} : {valueY}[/]";
    chart.legend.labels.maxWidth = 350;
    chart.legend.labels.maxHeight  = 350;
    chart.legend.labels.truncate = true;
    chart.legend.fontSize = 10;
    chart.legend.labels.template.wrap = false;

    var legendContainer = am4core.create("legenddiv", am4core.Container);
    legendContainer.width = am4core.percent(100);
    legendContainer.height = am4core.percent(100);
    chart.legend.parent = legendContainer;
    chart.leftAxesContainer.layout = "vertical";

    chart.exporting.menu = new am4core.ExportMenu();
    chart.exporting.menu.align = "left";
    chart.exporting.menu.verticalAlign = "top";

    var watermark = chart.createChild(am4core.Label);
    watermark.text = "Source: [bold] kredensial.com [/]";
    watermark.align = "left";
    watermark.fillOpacity = 0.5;
    watermark.disabled = true;

    // Enable watermark on export
    chart.exporting.events.on("exportstarted", function(ev) {
      watermark.disabled = true;
    });

    // Disable watermark when export finishes
    chart.exporting.events.on("exportfinished", function(ev) {
      watermark.disabled = true;
    });

    // Add watermark to validated sprites
    chart.exporting.validateSprites.push(watermark);

    var title = chart.titles.create();
    title.text = "<?php echo $judul_laporan_tabel; ?>";
    title.fontSize = 18;
    title.tooltipText = "<?php echo $judul_laporan_tabel; ?>";

}); 
    <?php
        }
      }
    ?>
<?php
}
?>
</script>
		</div>
	</body>
</html>
