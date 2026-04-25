<?php
//=================================== H O M E ================================================
$arraybox = array('warning','success','info','danger');
$resarray = array_rand($arraybox);
$thenarray = $arraybox[$resarray];
if ($page=="home")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="daftar")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
	<?php echo form_open_multipart('radiologi/daftar/view/'.$first_date.'/'.$last_date.'/'.$key,' id="signupform" '); ;
	?>
	  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
		<div class="box-header with-border">
		  <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
		</div>
		  <div class="box-body">
        <div class="col-md-12">
					<div class="form-group">
					  <label>Cari RM DAN NAMA PASIEN ( Ketik multiple pisahkan dengan spasi atau - ) Contoh (00000 NAMA)</label>
							<?php
								input_text("key",$key," autofocus","Ketik multiple pisahkan dengan spasi atau -","text");
							?>
					</div>
				</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label>Tanggal Awal</label>
								<?php
									input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal","");
								?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						  <label>Tanggal Akhir</label>
							<?php
								input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal","");
							?>
						</div>
					</div>
		  </div>
			<div class="box-footer">
			  <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
			</div>
	  </div>
	<?php echo form_close(); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%"></th>
					  <th style="display:none;">ID</th>
					  <th>Tanggal</th>
					  <th>RM</th>
					  <th>Nama</th>
					  <th>Umur</th>
					  <th>Pengirim</th>
					  <th>Ruangan</th>
					  <th>Status</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="daftar_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        		<div class="box-header with-border">
        		  <h3 class="box-title">PEMERIKSAAN PENUNJANG</h3>
        		</div>
        		  <div class="box-body">
                  <div id="tabelpenunjang" class="tabelpenunjang"></div>
        		  </div>
        	  </div>
            <div id="pemeriksaane" class="pemeriksaane"></div>
        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <?php echo $header; ?> <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="daftar_pemeriksaane")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<input type="hidden" name="id_pendaftaran_unit" id="id_pendaftaran_unit" value="<?= $id_pendaftaran_unit; ?>">
  <div class="box box-<?php echo $thenarray; ?> box-solid">
    <div class="box-header with-border">
       <h3 class="box-title">INPUT TINDAKAN / PEMERIKSAAN</h3>

      <div class="box-tools pull-right">

      </div>
    </div>
    <div class="box-body">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">MOHON LENGKAPI DATA INI</h3>

          <div class="box-tools pull-right">

          </div>
        </div>
        <div class="box-body">
          <div class="col-md-2">
            <div class="form-group">
              <label>Tanggal Pemeriksaan</label>
                <?php
                  input_calendar("tgl_pemeriksaan","tgl_pemeriksaan",$tgl_pemeriksaan,"Masukkan Tanggal","");
                ?>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Postur Pasien</label>
              <?php
                input_pdselect2("id_fat",$cmd_fat,$id_fat);
              ?>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Hamil</label>
              <?php

                input_pdselect2("hamil",$hamile,$hamil);
              ?>
            </div>
          </div>
          <div class="col-md-2 text-right">
            <div class="form-group">
              <label>Berat Badan</label>
              <?php
                input_textcustom("bb",$bb,"style='text-align:right;'  required
                      onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'",
                          "Berat Badan","text");
              ?>
            </div>
          </div>
          <div class="col-md-2 text-right">
            <div class="form-group">
              <label>Tinggi Badan</label>
              <?php
                input_textcustom("tb",$tb,"style='text-align:right;' required
                      onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'",
                          "Tinggi Badan","text");
              ?>
            </div>
          </div>  
        </div>
      </div>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title">TINDAKAN / PEMERIKSAAN</h3>
          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">
          <table id="example1" style="width:100%" class="table table-hover table-transaksi table-sm">
            <thead>
               <tr style="background-color: #800000;color: white;">
                <th class="text-sm text-label text-left border-0" style="width: 5%">Kelas</th>
                <th class="text-sm text-label text-left border-0" style="width: 25%">
                  Tindakan / Pemeriksaan
                </th>
                <th class="text-sm text-label text-left border-0" style="width: 5%">No Pemeriksaan</th>
                <th class="text-sm text-label text-right border-0" style="width: 5%">Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-sm text-label text-left border-0">
                  <?php
               //   input_pdselect2("id_kelas",$cmd_kelas,$id_kelas);
                  input_pdselect2fleksibel("id_kelas","id_kelas",$cmd_kelas,"id_kelas","nama_kelas",$id_kelas,"Pilih Kelas");
                  ?>                 
                </td>
                <td class="text-sm text-label text-left border-0">
                  <?php
                 input_pdselect2url("id_tindakan_tarif","id_tindakan_tarif","form-control select2","required='required'","Pilih Kelas Dulu");
                  ?>                 
                </td>
                <td class="text-sm text-label text-left border-0">
                    <?php
                      input_text("no_pemeriksaan",$no_pemeriksaan," required ","No Pemeriksaan","text");
                    ?>               
                </td>
                <td class="text-sm text-label text-right border-0">
              <?php 
                input_textcustom("jml_billing",$jml_billing," style='text-align:right;' required id='jml_billing'
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
                          "Nominal Transaksi","text");          
              ?>                 
                </td>                
              </tr>
            </tbody>
          </table>
          <table id="dttb2" style="width:100%" class="table table-hover table-transaksi table-sm">
            <thead>
              <tr style="background-color: #29675B;color: white;">
                <th class="text-sm text-label text-left border-0" style="width: 10%">Tanggal</th>
                <th class="text-sm text-label text-left border-0" >Tindakan / Pemeriksaan</th>
                <th class="text-sm text-label text-left border-0" >No Pemeriksaan</th>
                <th class="text-sm text-label text-left border-0" style="width: 10%">Kelas</th>
                <th class="text-sm text-label text-right border-0" style="width: 10%">Jumlah</th>
                <th class="text-sm text-label text-right border-0" style="width: 15%">Tarif</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                  <th colspan="5" class="text-sm text-label text-right border-0" >Total Pembayaran:</th>
                  <th></th>
              </tr>
            </tfoot>
          </table> 
        </div>
      </div>
    </div>
    <div class="box-footer">
      <button class="btn btn-info btnClick" id="btn_simpan">Simpan</button>
    </div>
  </div>
  <script type="text/javascript">
$('#tgl_pemeriksaan').datepicker({
  format: 'dd-mm-yyyy',
  autoclose: true
})
$("#tgl_pemeriksaan").inputmask("datetime", {
    mask: "1-2-y",
    placeholder: "dd-mm-yyyy",
    leapday: "-02-29",
    separator: "-",
    alias: "dd/mm/yyyy"
});
$('.btnClick').click(function(){
  load_pmr();
});
$(document).ready(function() {
  $('.select2').select2()
//   var e = document.getElementById("id_kelas");
//   var ik = document.getElementById("kelas").value;
// $('#id_kelas').change(function(){
//   $("#kelas").val($(this).val());
// });
  // $(".select_tindakan").select2({
  // ajax: {
  //   url: 'radiologi/data_pemeriksaan/'+ik,
  //   type: "post",
  //   dataType: 'json',
  //   delay: 250,
  //   data: function (params) {
  //     return {
  //       searchTerm: params.term // search term
  //     };
  //   },
  //   processResults: function (response) {
  //     return {
  //       results: response
  //     };
  //   },
  //   cache: true
  // }
  // });
$('#btn_simpan').on('click',function(){
    var id=$('#id_tindakan_tarif').val();
    var no=$('#no_pemeriksaan').val();
    var tgl=$('#tgl_pemeriksaan').val();
    var jml=$('#jml_billing').val();
    var daftar=$('#id_pendaftaran_unit').val();
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('radiologi/daftar/simpan_tambah_pemeriksaan_billing')?>",
        dataType : "JSON",
        data : {id:id, no:no, tgl:tgl, jml:jml, daftar:daftar},
        success: function(data){

        }
    });
    return false;
});
  function numberWithCommas(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
  var table = $('#dttb2').DataTable( {
      "processing": true,
      "searchable": false,
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
                "url"  : "<?php echo base_url();?>radiologi/daftar/billing/<?php echo $first_date;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_pemeriksaan", "searchable":false },
                      { "data": "nama_tindakan" },
                      { "data": "no_pemeriksaan", "searchable":false },
                      { "data": "nama_kelas", "searchable":false },
                      { "data": "jml_billing", "searchable":false, className: "text-right" },
                      { "data": "number_billing", "searchable":false, className: "text-right" }
            ],
        initComplete: function () {
            this.api().columns('.select-filter').every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                         column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                            } );
   
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
      
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
      
                // Total over all pages
                total = api
                    .column( 5 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
      
                // Total over this page
                pageTotal = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                $( api.column( 5 ).footer() ).html(
                    'Rp'+ numberWithCommas(pageTotal)
                );
      
                // Update footer
                // $( api.column( 5 ).footer() ).html(
                //     'Rp'+ numberWithCommas(pageTotal) +' ( Rp'+ numberWithCommas(total) +' )'
                // );
              },
            //   "footerCallback": function (row, data, start, end, display){
            //       var api = this.api(), data;
   
            //   // Remove the formatting to get integer data for summation
            //   var intVal = function ( i ) {
            //       return typeof i === 'string' ?
            //           i*1 :
            //           typeof i === 'number' ?
            //               i : 0;
            //   };
   
            //   // Total over all pages
            //   total = api
            //       .column( 6 )
            //       .data()
            //       .reduce( function (a, b) {
            //           return intVal(a) + intVal(b);
            //       }, 0 );
   
            //   // Total over this page
            //   pageTotal = api
            //       .column( 6, { page: 'current'} )
            //       .data()
            //       .reduce( function (a, b) {
            //           return intVal(a) + intVal(b);
            //       }, 0 );
   
            //   // Update footer
            //   $( api.column( 6 ).footer() ).html(
            //       'Rp'+total +',-'
            //   );
            // },
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                text: "<i class='fa fa-trash'></i> Hapus",
                extend: "selected",
                className: "btnred",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_pemeriksaan'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('radiologi/daftar/hapus_pemeriksaan/'); ?>'+data,function(){
                          $('#modal-default').modal({show:true});
                        });

                  }
              },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
          "processing": false,
          "searching": false,
          "ordering": false,
          "lengthChange": false,
          "scrollX": true,
        })
});
    $('select[name=id_kelas]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>radiologi/data_pemeriksaan/'+$(this).val(),
            type: "POST",
            dataType: 'json'
         }).done(function(data) {
               var len = data.length;
                $("#id_tindakan_tarif").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]["id"];
                    var name = data[i]["text"];

                    $("#id_tindakan_tarif").append("<option value='"+id+"'>"+name+"</option>");

                }
         }).fail(function() {

         }).always(function() {

        });
    });
  </script>
<?php
}
elseif ($page=="daftar_hapus_pemeriksaan")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
            <input type="hidden" name="id_pemeriksaan" id="id_pemeriksaan" value="<?= $id_pemeriksaan; ?>">
            <input type="hidden" name="id_status_pemeriksaan" id="id_status_pemeriksaan" value="<?= $id_status_pemeriksaan; ?>">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">HAPUS PEMERIKSAAN</h3>
            </div>
              <div class="box-body">
                <h1 style="text-align:center;">
                    YAKIN AKAN MENGHAPUS DATA INI ?
                </h1><hr>
                <div style="text-align:center;" class="col-md-12">
                    <button class="btn btn-danger btnClick" id="btn_hapus">HAPUS</button>
                </div>
              </div>
          </div>
    </div>
    </div>
<script type="text/javascript">
$('#btn_hapus').on('click',function(){
    var id=$('#id_pemeriksaan').val();
    var status=$('#id_status_pemeriksaan').val();
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('radiologi/daftar/simpan_hapus_pemeriksaan')?>",
        dataType : "JSON",
        data : {status:status, id:id},
        success: function(data){

        }
    });
    return false;
});
$('.btnClick').click(function(){
  load_pmr();
  $('#modal-default').modal('hide');
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="daftar_tabelpenunjang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
    <div class="box-tools pull-right">
    <?php
      input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
    ?>
    </div>
    <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Pemeriksaan</th>
          <th>Hasil</th>
        </tr>
      </thead>
    </table>
	<script type="text/javascript">
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
                "url"  : "<?php echo base_url();?>radiologi/daftar/pmr/<?php echo$first_date;?>",
                "type" : "POST"
            },
            "columns": [
                      { "data": "tgl_pemeriksaan_penunjang", "searchable":false },
					            { "data": "nama_tindakan" },
                      { "data": "hasil_pemeriksaan_penunjang", "searchable":false }
            ],
            "order": [[0, 'desc']] ,
            select: 'single',
            dom: 'Blrtip',
            "buttons": [
              {
                  text: "<i class='fa fa-plus'></i> Tambah",
                  className: "btnpurple",
                  init: function(api, node, config) {
                      $(node).removeClass('btn-default')
                  },
                  action: function ( e, dt, node, config ) {
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('radiologi/daftar/tambah_penunjang/'); ?><?php echo $first_date; ?>',function(){
                          $('#modal-default').modal({show:true});
                        });
                  }
              },
              {
                text: "<i class='fa fa-edit'></i> Rubah",
                extend: "selected",
                className: "btnteal",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_pemeriksaan_penunjang'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('radiologi/daftar/edit_penunjang/'); ?>'+data,function(){
                          $('#modal-default').modal({show:true});
                        });

                  }
              },
              {
                text: "<i class='fa fa-trash'></i> Hapus",
                extend: "selected",
                className: "btnred",
                  action: function ( e, dt, node, config ) {
                      data = dt.rows( { selected: true } ).data()[0]['id_pemeriksaan_penunjang'];
                      $("#modal-default").modal();
                        $('.modal-body').load('<?php echo base_url('radiologi/daftar/hapus_penunjang/'); ?>'+data,function(){
                          $('#modal-default').modal({show:true});
                        });

                  }
              },
                {
                    text: "<i class='fa fa-refresh'></i> Reload",
                    className: "btngreen",
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
	</script>
<?php
}
elseif ($page=="daftar_tambah_penunjang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
		        <input type="hidden" name="id_pendaftaran" id="id_pendaftaran" value="<?= $id_pendaftaran; ?>">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">TAMBAH PENUNJANG</h3>
            </div>
              <div class="box-body">
        				<div class="col-md-6">
        					  <label>Tanggal Pemeriksaan</label>
                    <?php
        							input_calendar("tgl_pemeriksaan_penunjang","tgl_pemeriksaan_penunjang",$tgl_pemeriksaan_penunjang," Tanggal"," readonly required");
        						?>
        				</div>
                <div class="col-md-6">
        					  <label>Nama Pemeriksaan</label>
                    <?php
        							input_pdselect2("id_tindakan",$cmd_tindakan_no_null,$id_tindakan);
        						?>
        				</div>
                <div class="col-md-12">
        					  <label>Hasil Pemeriksaan</label>
                    <?php
        							input_text("hasil_pemeriksaan_penunjang",$hasil_pemeriksaan_penunjang,"required","Masukkan Hasil Penunjang","text");
        						?>
        				</div>
              </div>
				<div class="box-footer">
					<button class="btn btn-info btnClick" id="btn_simpan">Simpan</button>
				</div>
          </div>
		</div>
	  </div>
<script type="text/javascript">
  $('#tgl_pemeriksaan_penunjang').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
  })
$("#tgl_pemeriksaan_penunjang").inputmask("datetime", {
  mask: "1-2-y",
  placeholder: "dd-mm-yyyy",
  leapday: "-02-29",
  separator: "-",
  alias: "dd/mm/yyyy"
});
$('#btn_simpan').on('click',function(){
    var nama=$('#id_tindakan').val();
    var hasil=$('#hasil_pemeriksaan_penunjang').val();
    var tgl=$('#tgl_pemeriksaan_penunjang').val();
    var daftar=$('#id_pendaftaran').val();
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('radiologi/daftar/simpan_tambah_penunjang')?>",
        dataType : "JSON",
        data : {nama:nama, hasil:hasil, tgl:tgl, daftar:daftar},
        success: function(data){

        }
    });
    return false;
});
$('.btnClick').click(function(){
  load_data();
  $('#modal-default').modal('hide');
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="daftar_edit_penunjang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
		        <input type="hidden" name="id_pemeriksaan_penunjang" id="id_pemeriksaan_penunjang" value="<?= $id_pemeriksaan_penunjang; ?>">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">RUBAH PENUNJANG</h3>
            </div>
              <div class="box-body">
        				<div class="col-md-6">
        					  <label>Tanggal Pemeriksaan</label>
                    <?php
        							input_calendar("tgl_pemeriksaan_penunjang","tgl_pemeriksaan_penunjang",$tgl_pemeriksaan_penunjang," Tanggal"," readonly required");
        						?>
        				</div>
                <div class="col-md-6">
        					  <label>Nama Pemeriksaan</label>
                    <?php
        							input_pdselect2("id_tindakan",$cmd_tindakan_no_null,$id_tindakan);
        						?>
        				</div>
                <div class="col-md-12">
        					  <label>Hasil Pemeriksaan</label>
                    <?php
        							input_text("hasil_pemeriksaan_penunjang",$hasil_pemeriksaan_penunjang,"required","Masukkan Hasil Penunjang","text");
        						?>
        				</div>
              </div>
				<div class="box-footer">
					<button class="btn btn-info btnClick" id="btn_edit">Simpan</button>
				</div>
          </div>
		</div>
	  </div>
<script type="text/javascript">
  $('#tgl_pemeriksaan_penunjang').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true
  })
$("#tgl_pemeriksaan_penunjang").inputmask("datetime", {
  mask: "1-2-y",
  placeholder: "dd-mm-yyyy",
  leapday: "-02-29",
  separator: "-",
  alias: "dd/mm/yyyy"
});
$('#btn_edit').on('click',function(){
    var nama=$('#id_tindakan').val();
    var hasil=$('#hasil_pemeriksaan_penunjang').val();
    var tgl=$('#tgl_pemeriksaan_penunjang').val();
    var daftar=$('#id_pemeriksaan_penunjang').val();
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('radiologi/daftar/simpan_edit_penunjang')?>",
        dataType : "JSON",
        data : {nama:nama, hasil:hasil, tgl:tgl, daftar:daftar},
        success: function(data){

        }
    });
    return false;
});
$('.btnClick').click(function(){
  load_data();
  $('#modal-default').modal('hide');
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="daftar_hapus_penunjang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
		        <input type="hidden" name="id_pemeriksaan_penunjang" id="id_pemeriksaan_penunjang" value="<?= $id_pemeriksaan_penunjang; ?>">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">HAPUS PENUNJANG</h3>
            </div>
              <div class="box-body">
                <h1 style="text-align:center;">
                    YAKIN AKAN MENGHAPUS DATA INI ?
                </h1><hr>
        				<div style="text-align:center;" class="col-md-12">
        					  <button class="btn btn-danger btnClick" id="btn_hapus">HAPUS</button>
        				</div>
              </div>
          </div>
		</div>
	  </div>
<script type="text/javascript">
$('#btn_hapus').on('click',function(){
    var daftar=$('#id_pemeriksaan_penunjang').val();
    $.ajax({
        type : "POST",
        url  : "<?php echo base_url('radiologi/daftar/simpan_hapus_penunjang')?>",
        dataType : "JSON",
        data : {daftar:daftar},
        success: function(data){

        }
    });
    return false;
});
$('.btnClick').click(function(){
  load_data();
  $('#modal-default').modal('hide');
});
$(document).ready(function() {
  $('.select2').select2()
});
</script>
<?php
}
elseif ($page=="daftar_penunjang")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
      <div class="row">
        <div class="col-md-12">
		<FORM method="POST" class="form-horizontal" action="<?php echo base_url('radiologi/daftar/aksi_penunjang');?>" onClick="return cek();">
		<input type="hidden" name="id_pendaftaran" value="<?= $first_date; ?>">
		<input type="hidden" name="id_unit_user" value="<?= $room_id; ?>">
		<?php
			if($jml > 0){
		?>
		<input type="hidden" name="id_pemeriksaan_ku" value="<?= $id_pemeriksaan_ku; ?>">
		<?php
			}
		?>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>
            </div>
              <div class="box-body">
				<div class="col-md-12">
					<div class="form-group">
					  <label>Hamil</label>
						<?php
							input_pdselect2("hamil",$hamile,$hamil);
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Berat Badan</label>
						<?php
							input_textcustom("bb",$bb,"style='text-align:right;'  required
										onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'",
												"Masukkan Angka dan titik","text");
						?>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
					  <label>Tinggi Badan</label>
						<?php
							input_textcustom("tb",$tb,"style='text-align:right;' required
										onkeypress='return event.keyCode > 47 && event.keyCode < 58 || event.keyCode == 46' class='form-control'",
												"Masukkan Angka dan titik","text");
						?>
					</div>
				</div>
              </div>
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
          </div>
		</div>
		</FORM>
	  </div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.select2').select2()
		});
	</script>
<?php
}
elseif ($page=="reject")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Nama</th>
					  <th>Status</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="reject_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/reject/simpan_tambah');?>" onClick="return cek();">
      <input type="hidden" name="id_unit" value="<?= $id_unit; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $title; ?></h3>
			</div>
			  <div class="box-body">
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama</label>
									<?php
										input_text("nama_reject",$nama_reject,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Status</label>
										<?php
											input_pdselect2("status_reject",$cmd_status,$status_reject);
										?>
								</div>
							</div>
						 </div>
					</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="reject_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/reject/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_reject" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $title; ?></h3>
			</div>
			  <div class="box-body">
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama</label>
									<?php
										input_text("nama_reject",$nama_reject,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
								  <label>Status</label>
										<?php
											input_pdselect2("status_reject",$cmd_status,$status_reject);
										?>
								</div>
							</div>
						 </div>
					</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="fokus")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Nama</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="fokus_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/fokus/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $title; ?></h3>
			</div>
			  <div class="box-body">
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama</label>
									<?php
										input_text("nama_field_size",$nama_field_size,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
						 </div>
					</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="fokus_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/fokus/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_field_size" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $title; ?></h3>
			</div>
			  <div class="box-body">
					<div class="container col-md-12">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
								  <label>Nama</label>
									<?php
										input_text("nama_field_size",$nama_field_size,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
								</div>
							</div>
						 </div>
					</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="thickness")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Nama</th>
					  <th>Fat</th>
					  <th>Ketebalan</th>
					  <th>Deskripsi</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="thickness_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/thickness/simpan_tambah');?>" onClick="return cek();">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $title; ?></h3>
			</div>
			  <div class="box-body">
							<div class="col-md-6">
								  <label>Nama</label>
									<?php
										input_text("nama_thickness",$nama_thickness,"maxlength='255' required autofocus","Masukkan Nama","text");
									?>
							</div>
              <div class="col-md-6">
								  <label>Fat</label>
									<?php
                  input_pdselect2("fat",$cmd_fat,$fat);
									?>
							</div>
              <div class="col-md-6">
								  <label>Ketebalan</label>
									<?php
                  input_textcustom("thickness",$thickness," style='text-align:right;' required
  											onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
  													"Nominal Transaksi","text");
									?>
							</div>
							<div class="col-md-6">
								  <label>Deskripsi</label>
                  <?php
										input_text("deskripsi_thickness",$deskripsi_thickness,"maxlength='255' required autofocus","Masukkan Deskripsi","text");
									?>
							</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="thickness_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/thickness/simpan_edit');?>" onClick="return cek();">
		<input type="hidden" name="id_thickness" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $title; ?></h3>
			</div>
			  <div class="box-body">
          <div class="col-md-6">
              <label>Nama</label>
              <?php
                input_text("nama_thickness",$nama_thickness,"maxlength='255' required autofocus","Masukkan Nama","text");
              ?>
          </div>
          <div class="col-md-6">
              <label>Fat</label>
              <?php
              input_pdselect2("fat",$cmd_fat,$fat);
              ?>
          </div>
          <div class="col-md-6">
              <label>Ketebalan</label>
              <?php
              input_textcustom("thickness",$thickness," style='text-align:right;' required
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control inputnumber debet'",
                        "Nominal Transaksi","text");
              ?>
          </div>
          <div class="col-md-6">
              <label>Deskripsi</label>
              <?php
                input_text("deskripsi_thickness",$deskripsi_thickness,"maxlength='255' required autofocus","Masukkan Deskripsi","text");
              ?>
          </div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="fe")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Tindakan</th>
					  <th>Obyek</th>
					  <th>Fokus</th>
					  <th>Kv - mAs - FPD</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="bakhp")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Tindakan</th>
					  <th>BAKHP</th>
					  <th>Jumlah</th>
					  <th>Satuan</th>
            <th>Status</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="fe_tambah" || $page=="bakhp_tambah")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small>  <?php echo $instance_name; ?> </small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
					<tr>
					  <th width="5%">ID</th>
					  <th>Tindakan</th>
					  <th>Golongan</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="fe_tambah_fe")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/fe/simpan_tambah_fe');?>" onClick="return cek();">
		<input type="hidden" name="id_tindakan" value="<?= $id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php $nama_tindakan; ?></h3>
			</div>
			  <div class="box-body">
          <?php
					foreach($fat as $rowfat){
            $kondisi_fe=array('id_tindakan'=>$id,'id_thickness'=>$rowfat['id_thickness']);
          	$jml_fe = $this->m_umum->jumlah_record_filter('radiologi_fe',$kondisi_fe);
            if($jml_fe == 0){
              $kv = 0;
              $mas = 0;
              $fpd = 0;
              $id_field_size = set_value('id_field_size',$this->input->post("id_field_size"));
              $id_thickness = $rowfat['id_thickness'];
            }else{
              $fe = $this->m_rancak->fe_fat($id,$rowfat['id_thickness']);
              $kv = round($fe['kv'],1);
              $mas = round($fe['mas'],5);
              $fpd = round($fe['fpd'],1);
              $id_field_size = $fe['id_field_size'];
              $id_thickness = $fe['id_thickness'];
            }

					?>
          <input type="hidden" name="id_thickness[]" value="<?= $id_thickness; ?>">
          <div class="col-md-12">
            <div class="col-md-3">
                <label>Ketebalan</label>
                <?php
                  input_text("nama_thickness",$rowfat['nama_thickness'],"maxlength='255' readonly","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Fokus</label>
                <?php
                  input_pdselect2("id_field_size[]",$field_size,$id_field_size);
                ?>
            </div>
            <div class="col-md-2">
                <label>kV</label>
                <?php
                input_textcustom("kv[]",$kv," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>mAs</label>
                <?php
                input_textcustom("mas[]",$mas," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
            <div class="col-md-2">
                <label>FPD</label>
                <?php
                input_textcustom("fpd[]",$fpd," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46' class='form-control'",
                          "Nominal Transaksi","text");
                ?>
            </div>
          </div>
          <?php
          }
           ?>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="bakhp_tambah_bakhp")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('admin_radiologi/bakhp/simpan_tambah_bakhp');?>" onClick="return cek();">
		<input type="hidden" name="id_tindakan" value="<?= $id; ?>">
		<input type="hidden" name="id_unit" value="<?= $unit_id; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">BAKHP, ISI JIKA RUBAH / TAMBAH</h3>
			</div>
			  <div class="box-body">
          <table id="example1" width="100%" class="table table-bordered table-striped">
    			  <thead>
    				<tr>
    					<th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;">BAKHP</th>
    					<th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;">Jumlah</th>
    					<th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;">Satuan</th>
    					<th style="background-color:#9b0e27;color:white;text-align: center;vertical-align:middle;">Status</th>
    				</tr>
    			  </thead>
    			  <tbody>
    					<?php
    					foreach($bakhp_tindakan as $rowbakhp_tindakan){
    					?>
    				<tr>
    					<td style="vertical-align:middle;"><?php echo $rowbakhp_tindakan['nama_barang']; ?></td>
    					<td style="vertical-align:middle;"><?php echo $rowbakhp_tindakan['jml_pemeriksaan_bakhp']; ?></td>
    					<td style="vertical-align:middle;"><?php echo $rowbakhp_tindakan['nama_satuan']; ?></td>
    					<td style="vertical-align:middle;"><?php echo $rowbakhp_tindakan['status_pemeriksaan_bakhp']; ?></td>
    				</tr>
    					<?php
    					}
    					?>
    			  </tbody>
    		  </table><hr>
          <?php
					foreach($bakhp as $rowbakhp){
					?>
          <input type="hidden" name="id_barang[]" value="<?= $rowbakhp['id_barang']; ?>">
          <div class="col-md-12">
            <div class="col-md-3">
                <label>BAKHP</label>
                <?php
                  input_text("nama_barang",$rowbakhp['nama_barang'],"maxlength='255' readonly","","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Jumlah</label>
                <?php
                input_textcustom("jml_pemeriksaan_bakhp[]",$jml_pemeriksaan_bakhp," style='text-align:right;' required
                      onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
                          "Jumlah Pemakaian","text");
                ?>
            </div>
            <div class="col-md-3">
                <label>Satuan</label>
                <?php
                  input_pdselect2("id_satuan[]",$cmd_satuan_barang,$id_satuan);
                ?>
            </div>
            <div class="col-md-3">
                <label>Status</label>
                <?php
                  input_pdselect2("status_pemeriksaan_bakhp[]",$cmd_status,$status_pemeriksaan_bakhp);
                ?>
            </div>
          </div>
          <?php
          }
           ?>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function() {
	$('.select2').select2()
});
</script>
<?php
}
elseif ($page=="program_tr_tindakan")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <?php echo form_open('Admin_radiologi/program_tr/tindakan',' ');
  	  input_text("id_program_tr",$id_program_tr,"","","hidden"); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="example1" width="100%" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                <input name="select_all" class="checkall" type="checkbox" />
              </th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Unit</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $no=0;
              foreach($tindakan_4programtr as $row){
                $no++;
              ?>
            <tr>
              <td style="vertical-align:middle;">
                <div class="checkbox">
                <label>
                  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_tindakan'];?>"
                  <?php if(in_array($row['id_tindakan'],$tindakan)) echo 'checked="checked"'; ?> >
                </label>
                </div>
              </td>
              <td style="vertical-align:middle;"><?php echo $row['id_tindakan'];?></td>
              <td style="vertical-align:middle;"><?php echo $row['nama_tindakan'];?></td>
            </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="program_tr_unit")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <?php echo form_open('Admin_radiologi/program_tr/unit',' ');
  	  input_text("id_program_tr",$id_program_tr,"","","hidden"); ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="example1" width="100%" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">
                <input name="select_all" class="checkall" type="checkbox" />
              </th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">ID</th>
              <th style="background-color:#9b0e27;color:white;vertical-align:middle;">Unit</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $no=0;
              foreach($unit_4programtr as $row){
                $no++;
              ?>
            <tr>
              <td style="vertical-align:middle;">
                <div class="checkbox">
                <label>
                  <input type="checkbox" class="child" name="chk[]" value="<?php echo $row['id_struktur_jabatan'];?>"
                  <?php if(in_array($row['id_struktur_jabatan'],$struktur_jabatan)) echo 'checked="checked"'; ?> >
                </label>
                </div>
              </td>
              <td style="vertical-align:middle;"><?php echo $row['id_struktur_jabatan'];?></td>
              <td style="vertical-align:middle;"><?php echo $row['nama_struktur_jabatan'];?></td>
            </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="program_tr")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
			<?php
				input_textcustom("",""," autofocus class='form-control input-sm' id='search-inp' ","CARI DI TABEL","text");
			?>
          </div>
        </div>
        <div class="box-body">
			<table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
				<thead>
          <tr>
					  <th>Tindakan</th>
					  <th>Minimal Waktu (Jam)</th>
					  <th>Waktu Awal Efektif</th>
					  <th>Waktu Akhir Efektif</th>
					</tr>
				</thead>
			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
         <small><?php echo $instance_name; ?></small>
      </div>
      <div class="modal-body" style="padding:10px; font-size:15px;">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php
}
elseif ($page=="program_tr_waktu")
{
?>
		<FORM method="POST" class="form-horizontal" id="signupform" action="<?php echo base_url('Admin_radiologi/program_tr/aksi_waktu');?>" onClick="return cek();">
      <input type="hidden" name="id_program_tr" value="<?= $id_program_tr; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">GOLONGAN</h3>
			</div>
			  <div class="box-body">
          <div class="col-md-12">
  					<div class="form-group">
  					  <label>Waktu Maximal Time Respon</label>
  						<?php
  							input_textcustom("time",$time," class='form-control' id='time' ","","text");
  						?>
  					</div>
  				</div>
  				<div class="col-md-5">
  					<div class="form-group">
  					  <label>Waktu Awal Efektif</label>
  						<?php
  							input_textcustom("begin_time",$begin_time," class='form-control' id='begin_time' ","","text");
  						?>

  					</div>
  				</div>
  				<div class="col-md-1">
  				</div>
  				<div class="col-md-6">
  					<div class="form-group">
  					  <label>Waktu Akhir Efektif</label>
  						<?php
  							input_textcustom("end_time",$end_time," class='form-control' id='end_time' ","","text");
  						?>

  					</div>
  				</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$("#time").inputmask("hh:mm:ss", {
  placeholder: "HH:MM:SS",
  insertMode: false,
  showMaskOnHover: false,
});
$("#begin_time").inputmask("hh:mm:ss", {
  placeholder: "HH:MM:SS",
  insertMode: false,
  showMaskOnHover: false,
});
$("#end_time").inputmask("hh:mm:ss", {
  placeholder: "HH:MM:SS",
  insertMode: false,
  showMaskOnHover: false,
});
</script>
<?php
}
elseif ($page=="program_tr_dayofweek")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
<FORM method="POST" class="form-horizontal" action="<?php echo base_url('Admin_radiologi/program_tr/aksi_dayofweek');?>" onClick="return cek();">
<input type="hidden" name="id_program_tr" value="<?= $id_program_tr; ?>">
       <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
            <h3 class="box-title"><button type="submit" class="btn btn-primary btn-xs">Submit</button></h3>

          <div class="box-tools pull-right">

          </div>
        </div>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">TINDAKAN</h3>
			</div>
			  <div class="box-body">
          <div class="col-md-12">
  					<div class="form-group">
  					  <label>Hari Efektif</label>
  						<?php
  							checkboxflatred("id_dayofweek","id_dayofweek[]",$kol_dayofweek,"id_dayofweek","nama_dayofweek",$id_dayofweek,"flat-red","<br>","","array");
  						?>
  					</div>
  				</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
	  </FORM>
<script type="text/javascript">
$(document).ready(function () {
	$('.select2').select2()
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
});
</script>
<?php
}
elseif ($page=="pie")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <?php echo form_open('admin_radiologi/pie/view/'.$first_date.'/'.$last_date,' class="form-horizontal"'); ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?php echo $title; ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="col-md-6">
      					<label>Tanggal Mulai</label>
      					<?php
      						input_calendar("first_date","first_date",$first_date,"Masukkan Tanggal"," required");
      					?>
      				</div>
      				<div class="col-md-6">
      					<label>Tanggal Akhir</label>
      					<?php
      						input_calendar("last_date","last_date",$last_date,"Masukkan Tanggal"," required");
      					?>
      				</div>
            </div>
            <div class="box-footer">
                <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
            </div>
          </div>
          <?php echo form_close(); ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?php echo $title; ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div id="chartdiv"></div>
            </div>
          </div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="lt" || $page=="lb" || $page=="lh")
{
?>
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $header; ?> <small></small>
      </h1>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <?php echo form_open('admin_radiologi/'.$page.'/view/'.$bln.'/'.$thn,' class="form-horizontal"'); ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?php echo $title; ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="col-md-12">
      					<label>Range</label>
      					<?php
      						input_pdselect2("page",$array_page,$page);
      					?>
      				</div>
              <div class="col-md-6">
      					<label>Bulan</label>
      					<?php
      						input_pdselect2("bln",$array_month,$bln);
      					?>
      				</div>
      				<div class="col-md-6">
      					<label>Tanggal Akhir</label>
      					<?php
      						input_pdselect2("thn",$year_logbook,$thn);
      					?>
      				</div>
            </div>
            <div class="box-footer">
                <button type="submit" name="action" value="BtnProses" class="btn btn-primary pull-left"><i class="fa fa-recycle"></i> Proses</button>
            </div>
          </div>
          <?php echo form_close(); ?>
          <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
            <div class="box-header with-border">
               <h3 class="box-title"><?php echo $title; ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div id="chartdiv"></div>
            </div>
          </div>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="format_radiologi")
{
?>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $link_kembali;?>"
				class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
			</a>
    </section>
    <section class="content">
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><?php echo $title; ?></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <table id="dttb" width="100%" class="table table-bordered table-striped table-hover" >
    				<thead>
    					<tr>
    					  <th width="5%"></th>
    					  <th>ID</th>
    					  <th>Tindakan</th>
    					  <th>Deskripsi</th>
    					  <th>Radiolog</th>
    					</tr>
    				</thead>
    			</table>
        </div>
        <div class="box-footer">

        </div>
      </div>
    </section>
</div>
<?php
}
elseif ($page=="format_radiologi_tambah")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $link_kembali;?>"
				class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
			</a>
    </section>
    <section class="content">
      <?php echo form_open_multipart('normal/format_radiologi/tambah',' ');
      input_text("id_struktur_jabatan",$struktur_jabatan_id,"","","hidden");
       ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-xs btn-primary">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label>Deskripsi</label>
    <?php
      input_text("nama_normal",$nama_normal,"maxlength='255' autofocus required","Masukkan Deskripsi","text");
    ?>
          </div>
          <div class="form-group">
            <label>Tindakan</label>
    <?php
      input_pdselect2fleksibel("id_tindakan","id_tindakan",$cmd_tindakan,"id_tindakan","nama_tindakan",$id_tindakan,"Silahkan Pilih Tindakan");
    ?>
          </div>
          <div class="form-group">
            <label>Radiolog</label>
    <?php
      input_pdselect2("id_pegawai",$cmd_spesialis,$id_pegawai);
    ?>
          </div>
          <div class="form-group">
            <label>Hasil</label>
    <?php
      input_textareacustom("hasil_normal",$hasil_normal," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Format Hasil");
    ?>
          </div>
          <div class="form-group">
            <label>Kesimpulan</label>
    <?php
      input_textareacustom("kesimpulan_normal",$kesimpulan_normal," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Format Kesimpulan");
    ?>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <?php echo form_close(); ?>
    </section>
</div>
<?php
}
elseif ($page=="format_radiologi_edit")
{
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
    <section class="content-header">
      <a href="<?php echo $link_kembali;?>"
				class="btn btn-<?php echo $arraybox[array_rand($arraybox)]; ?>" > <i class="fa fa-reply"></i> Kembali
			</a>
    </section>
    <section class="content">
      <?php echo form_open_multipart('normal/format_radiologi/edit/'.$id,' ');
      input_text("id_normal",$id,"","","hidden");
      input_text("nama_normal_lama",$nama_normal,"","","hidden");
       ?>
      <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
        <div class="box-header with-border">
           <h3 class="box-title"><button type="submit" class="btn btn-xs btn-primary">Submit</button></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label>Deskripsi</label>
    <?php
      input_text("nama_normal",$nama_normal,"maxlength='255' autofocus required","Masukkan Deskripsi","text");
    ?>
          </div>
          <div class="form-group">
            <label>Tindakan</label>
    <?php
      input_pdselect2fleksibel("id_tindakan","id_tindakan",$cmd_tindakan,"id_tindakan","nama_tindakan",$id_tindakan,"Silahkan Pilih Tindakan");
    ?>
          </div>
          <div class="form-group">
            <label>Radiolog</label>
    <?php
      input_pdselect2("id_pegawai",$cmd_spesialis,$id_pegawai);
    ?>
          </div>
          <div class="form-group">
            <label>Hasil</label>
    <?php
      input_textareacustom("hasil_normal",$hasil_normal," id='editor1' rows='10' cols='100' class='form-control' ","Masukkan Format Hasil");
    ?>
          </div>
          <div class="form-group">
            <label>Kesimpulan</label>
    <?php
      input_textareacustom("kesimpulan_normal",$kesimpulan_normal," id='editor2' rows='10' cols='100' class='form-control' ","Masukkan Format Kesimpulan");
    ?>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
      <?php echo form_close(); ?>
    </section>
</div>
<?php
}
