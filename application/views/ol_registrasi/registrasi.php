<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico">
		<title><?php echo $header; ?> | <?php echo $instance_name; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="index, follow">
		<meta name="description" content="<?php echo $idescription; ?>">
		<meta name="keywords" content="<?php echo $ikeywords; ?>">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/dist/css/skins/_all-skins.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav text-sm">
<div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
<div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>
<?php
$arraybox = array('warning','success','info','danger');
?>
<style>
.select2-container {
    width: 100% !important;
    padding: 0;
}
</style>
  <div class="content-wrapper">
  	<?php 
  		if($status_online == 0){
  	?>
    <section class="content-header">
	    <div class="pad margin no-print">
	      <div class="callout callout-danger" style="margin-bottom: 0!important;">
	        <h3 style="text-align:center;"><i class="fa fa-info-circle"></i> 
	        	PERHATIAN ! JIKA INPUT TANPA ID MAKA DATA TIDAK AKAN MASUK</h3>
	      </div>
	    </div>
    </section>
  	<?php 
 		 }
  	?>
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
		  <?php echo form_open_multipart('ol_registrasi/registrasi/'.$id,' id="signupform" ');
		  input_text("barcode_registrasi",$barcode_registrasi,"","","hidden");
		  input_text("status_online",$status_online,"","","hidden");
		  input_text("ppni_online",$ppni_online,"","","hidden");
		  ?>
		<div class="box-body">
		  <div class="box box-<?php echo $arraybox[array_rand($arraybox)]; ?> box-solid">
			<div class="box-header with-border">
			  <h3 class="box-title">
					<a href="<?php echo $link_kembali;?>"
						class="btn btn-success btn-xs" > <i class="fa fa-reply"></i> Kembali
					</a>
			  </h3>
			</div>
			  <div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-3">
							<div class="form-group">
							  <label>Nama Pegawai</label>
								<?php
									input_text("nama_pegawai",$nama_pegawai,"maxlength='60' required autofocus ","Ketikkan Nama","text");
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Tempat Lahir</label>
								<?php
									input_text("tmp_lahir",$tmp_lahir,"maxlength='255' ","Ketikkan Tempat Lahir","text");
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Tanggal Lahir</label>
								<?php
									input_calendar("tgl_lahir","tgl_lahir",$tgl_lahir,"Masukkan Tanggal Lahir"," required");
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Jenis Kelamin</label>
								<?php
									input_pdselect2("jk",$gender,$jk);
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Status Perkawinan</label>
								<?php
									input_pdselect2("id_status_kawin",$cmd_status_kawin,$id_status_kawin);
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Agama</label>
								<?php
									input_pdselect2("id_agama",$cmd_agama,$id_agama);
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Status Perawat</label>
								<?php
									input_pdselect2("status_perawat",$opsi_status_perawat,$status_perawat);
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>PK</label>
								<?php
									input_pdselect2fleksibel("id_kode_kewenangan","id_kode_kewenangan",$kol_kode_kewenangan_null,"id_kode_kewenangan","nama_kode_kewenangan",$id_kode_kewenangan,"Belum Ada PK");
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>No KTP &nbsp; <small><span style="font-weight:bold;" id="msg2"></span></small></label>
                <?php
									input_textcustom("nik",$nik," required id='nik'
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Masukkan No KTP","text");
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Status Pegawai</label>
								<?php
								input_pdselect2fleksibel("tipe_pegawai","tipe_pegawai",$cmd_tipe_pegawai,"id_status_pegawai","nama_status_pegawai",$tipe_pegawai,"Pilih Status Pegawai");
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Nomor Induk Karyawan</label>
                <?php
									input_textcustom("nip",$nip,"  id='nip'
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Masukkan No Induk Karyawan","text");
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>No WA </label>
								<?php
									input_textcustom("no_hp",$no_hp," required
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Ketikkan No HP format kode negara","text");
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Email</label>
								<?php
									input_text("email",$email,"maxlength='255' ","Ketikkan Email","text");
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Jabatan Fungsional</label>
								<?php
									input_pdselect2("id_jabatan_fungsional",$cmd_jabfung,$id_jabatan_fungsional);
							//		input_pdselect2fleksibel("id_jabatan_fungsional","id_jabatan_fungsional",$cmd_jabfung,"id_jabatan_fungsional","nama_jabatan_fungsional",$id_jabatan_fungsional,"Tidak Ada Jabfung");
								?>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
							  <label>Nomor Profesi (NIRA/PARI DLL)</label>
                <?php
									input_textcustom("no_profesi",$no_profesi,"  id='no_profesi'
												onkeypress='return event.charCode >= 48 && event.charCode <= 57' class='form-control'",
														"Masukkan No Profesi","text");
								?>
							</div>
						</div>	
						<div class="col-md-3">
							<div class="form-group">
							  <label>DPK / DPW</label>
								<?php
									input_pdselect2("id_pengcab",$null_pengcab,$id_pengcab);
								//	echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
								?>
							</div>
						</div>					
						<div class="col-md-3">
							<div class="form-group">
							  <label>Tempat Bekerja</label>
								<?php
							//		input_pdselect2("id_instansi",$ambil_data_rujukan_instansi,$id_instansi);
									input_pdselect2fleksibel("id_instansi","id_instansi",$ambil_data_rujukan_instansi,"id_working","nama_working",$id_instansi,"Belum Bekerja");
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Pendidikan Terakhir</label>
								<?php
									input_pdselect2("id_pendidikan",$cmd_pendidikan,$id_pendidikan);
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Alamat</label>
								<?php
									input_text("alamat",$alamat,"maxlength='255' ","Ketikkan Alamat","text");
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Propinsi</label>
								<?php
									input_pdselect2fleksibel("id_prov","id_prov",$kol_provinsi,"id_prov","nama_prov",$id_prov,"Silahkan Pilih Provinsi Dulu");
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Kota/Kabupaten</label>
								<?php
									input_pdselect2("id_kab",$kab,$id_kab);
								//	echo form_dropdown('id_kab',$kab,'0',array('id'=>'id_kab','class'=>'form-control'));
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Kecamatan</label>
								<?php
									input_pdselect2("id_kec",$kec,$id_kec);
								//	echo form_dropdown('id_kec',$kec,'0',array('id'=>'id_kec','class'=>'form-control'));
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Kelurahan</label>
								<?php
									input_pdselect2("id_kel",$kel,$id_kel);
								//	echo form_dropdown('id_kel',$kel,'0',array('id'=>'id_kel','class'=>'form-control'));
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label>Username &nbsp; <small><span style="font-weight:bold;" id="msg"></span></small></label>
							  <small><input type="checkbox" onclick="myUsername()"> Hide </small>
								<?php
									input_textcustom("username",$username," maxlength='60' class='form-control' required autocomplete='off' id='username' ",
													"Huruf kecil tanpa spasi dan spesial character kecuali -","text");
								?>
							</div>
						</div>
					</div>
				</div>
			  </div>
		  </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="setuju btn btn-primary" disabled="disabled">Submit</button>
        </div>
		<?php echo form_close(); ?>
      </div>
    </section>
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <?php echo $ilicensed; ?>
    </div>
    <?php echo $ifooter; ?>
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.inputmask.bundle.js"></script>
<script src="<?php echo base_url();?>assets/admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>assets/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/dist/js/adminlte.min.js"></script>
<script type="text/javascript">
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
var status = 0;
$('select[name=tipe_pegawai]').on('change',function(){
    $.ajax({
        url:'<?php echo base_url();?>ol_registrasi/jabfung_data/'+$(this).val(),
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
    $('select[name=id_prov]').on('change',function(){
        $.ajax({
            url:'<?php echo base_url();?>ol_registrasi/kab_data/'+$(this).val(),
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
            url:'<?php echo base_url();?>ol_registrasi/kec_data/'+$(this).val(),
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
            url:'<?php echo base_url();?>ol_registrasi/kel_data/'+$(this).val(),
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
            url:'<?php echo base_url();?>ol_registrasi/pengcab/'+$(this).val(),
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
  $("#id_jabatan_fungsional").change(function(){
    $(".setuju").prop('disabled', $(this).val() == 0 );
  });	
		$("#username").on("input", function(e) {
			$('#msg').hide();
			if ($('#username').val() == null || $('#username').val() == "") {
				$('#msg').show();
				$("#msg").html("Username Harus Diisi").css("color", "red");
			} else {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>ol_registrasi/check_availability",
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
    $("#nik").on("input", function(e) {
			$('#msg2').hide();
			if ($('#nik').val() == null || $('#nik').val() == "") {
				$('#msg2').show();
				$("#msg2").html("NIK Harus Diisi").css("color", "red");
			} else {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url();?>ol_registrasi/check_nik",
					data: $('#signupform').serialize(),
					dataType: "html",
					cache: false,
					success: function(msg2) {
						$('#msg2').show();
						$("#msg2").html(msg2);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						$('#msg2').show();
						$("#msg2").html(textStatus + " " + errorThrown);
					}
				});
			}
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
function setInputFilter(textbox, inputFilter, errMsg) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
    textbox.addEventListener(event, function(e) {
      if (inputFilter(this.value)) {
        // Accepted value
        if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
          this.classList.remove("input-error");
          this.setCustomValidity("");
        }
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        // Rejected value - restore the previous one
        this.classList.add("input-error");
        this.setCustomValidity(errMsg);
        this.reportValidity();
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        // Rejected value - nothing to restore
        this.value = "";
      }
    });
  });
}
setInputFilter(document.getElementById("nik"), function(value) {
  return /^-?\d*$/.test(value); }, "Harus Angka");
setInputFilter(document.getElementById("nip"), function(value) {
  return /^-?\d*$/.test(value); }, "Harus Angka");
setInputFilter(document.getElementById("no_profesi"), function(value) {
  return /^-?\d*$/.test(value); }, "Harus Angka");
</script>
</body>
</html>
