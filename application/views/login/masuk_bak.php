<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico">
	<title>LOGIN | <?php echo $instance_name; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="index, follow">
		<meta name="description" content="<?php echo $idescription; ?>">
		<meta name="keywords" content="<?php echo $ikeywords; ?>">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link href="<?php echo base_url();?>assets/admin/style-login.css" rel="stylesheet">
</head>
  <body>
    <div class="col-md-4 col-md-offset-4 form-login">  
		<?php
								
		
		 ?>
        <div class="outter-form-login">
        <div class="logo-login">
            <em class="glyphicon glyphicon-lock"></em>
        </div>
			<?php 
			echo form_open('masuk',' class="inner-login" ');  
/*			echo validation_errors(); 
				if (!empty($pesan)) {
					echo '<h3 class="text-center title-login">'
					. $pesan . 
					'</h3>';
				}else{
					echo '<h3 class="text-center title-login">Login</h3>';
				}	*/				
			?>         
			<h4 style="font-weight: bold;" ><strong>Login</strong></h4> 
				<small><input type="checkbox" onclick="myFunction()"> Show Username </small>
                <div class="form-group">
			<?php
				input_text("username",$username,"autofocus autocomplete='off' required","Masukkan Username","text");
			?>
                </div>
				<small><input type="checkbox" onclick="myFunctionp()"> Show Password </small>
                <div class="form-group">
			<?php
				input_text("password",$password,"autocomplete='off' required","Masukkan Password","password");
			?>	
                </div>
				<div class="form-group">
				<div class="col-md-5">
					<button class="btn btn-block btn-custom-green" type="submit">L O G I N</button>
				</div>
				<div class="col-md-2">&nbsp;
				</div>
				<div class="col-md-5">
					<a href="<?php echo base_url();?>" class="btn btn-block btn-info" >Beranda</a>
				</div>
				</div>
			<?php echo form_close(); ?>
        </div>
    </div>
	
  <div class="danger-data" data-flashdata="<?php echo $this->session->flashdata('danger'); ?>"></div>
  <div class="sukses-data" data-flashdata="<?php echo $this->session->flashdata('sukses'); ?>"></div>
<script src="<?php echo base_url();?>assets/admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>  
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>

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
function myFunction() {
  var x = document.getElementById("username");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
function myFunctionp() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>