<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $idescription; ?>">
	<meta name="keywords" content="<?php echo $ikeywords; ?>">
  <meta name="author" content="la-themes">
  <link rel="icon" href="<?php echo base_url();?>assets/images/favicon.ico">
  <title>LOGIN | <?php echo $instance_name; ?></title>
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.ico" type="image/x-icon">
  <!--font-awesome-css-->
  <link rel="stylesheet" href="rassets/vendor/fontawesome/css/all.css">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">
  <!-- tabler icons-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/tabler-icons/tabler-icons.css">
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="rassets/vendor/bootstrap/bootstrap.min.css">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="rassets/css/style.css">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="rassets/css/responsive.css">
</head>
  <body>
  <div class="app-wrapper d-block">
    <div class="">
      <!-- Body main section starts -->
      <main class="w-100 p-0">
        <!-- Login to your Account start -->
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 p-0">
                    <div class="login-form-container">
                      <div class="mb-4">
                   <!--     <a class="logo d-inline-block" href="index.html">
                          <img src="../assets/images/logo/1.png" width="250" alt="#">
                        </a> -->
                      </div>
                      <div class="form_container">
			<?php 
			echo form_open('masuk',' class="app-form" ');  
/*			echo validation_errors(); 
				if (!empty($pesan)) {
					echo '<h3 class="text-center title-login">'
					. $pesan . 
					'</h3>';
				}else{
					echo '<h3 class="text-center title-login">Login</h3>';
				}	*/				
			?> 
                  <!--      <form class="app-form"> -->
                          <div class="mb-3 text-center">
                            <h3>Login to your Account</h3>
                            <p class="f-s-12 text-secondary">Get started with our app, just create an account and enjoy the experience.</p>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Email address</label>
			<?php
				input_text("username",$username,"autofocus autocomplete='off' required","Masukkan Username","text");
			?>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Password</label>
 			<?php
				input_text("password",$password,"autocomplete='off' required","Masukkan Password","password");
			?>	
                          <div class="form-text text"><input type="checkbox" onclick="myFunctionp()"> Show Password </div>
                        </div>
                <!--          <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="formCheck1">
                            <label class="form-check-label" for="formCheck1">remember me</label>
                          </div> -->
                          <div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                          </div>
                          <div class="app-divider-v justify-content-center">
                            <p>OR</p>
                          </div>
                          <div>
                            <a href="<?php echo base_url();?>" role="button" class="btn btn-success w-100">Dashboard</a>
                          </div>
                 <!--         <div class="mb-3">
                            <div class="text-center">
                              <button type="button" class="btn btn-primary icon-btn b-r-5 m-1"><i class="ti ti-brand-facebook text-white"></i></button>
                              <button type="button" class="btn btn-danger icon-btn b-r-5 m-1"><i class="ti ti-brand-google text-white"></i></button>
                              <button type="button" class="btn btn-dark icon-btn b-r-5 m-1"><i class="ti ti-brand-github text-white"></i></button>
                            </div>
                          </div>
                          <div class="text-center">
                            <a href="./terms_condition.html" class="text-secondary text-decoration-underline">Terms of use &amp; Conditions</a>
                          </div> 
                        </form>-->
                        <?php echo form_close(); ?>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login to your Account end -->
      </main>
      <!-- Body main section ends -->
    </div>
  </div>
  <!-- latest jquery-->
  <script src="rassets/js/jquery-3.6.3.min.js"></script>

  <!-- Bootstrap js-->
  <script src="rassets/vendor/bootstrap/bootstrap.bundle.min.js"></script>

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