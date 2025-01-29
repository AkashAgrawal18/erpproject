<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo (!empty($pagename)) ? $pagename : 'Login'; ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body style="background: url('<?php echo base_url('uploads/user/logo4.jpg'); ?>') no-repeat center center; background-size: cover;" class="hold-transition login-page">

	<div class="login-box">
		<div class="login-logo">
			<a href="../../index2.html" style="color: white;"><b>Digital</b>Shakha</a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<div class="row">
					<div class="col-sm-12">
					<p class="login-box-msg">Sign Up</p>
				<form action='<?php echo base_url('Login') ?>' method="post">
					<div class="input-group mb-3">
						<input type="text" class="form-control" id="login_email" name="login_email" required="true" value="<?php echo set_value('login_email'); ?>" autofocus placeholder="Enter Your Email">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-2">
						<input type="password" class="form-control" required="true" value="<?php echo set_value('login_pass'); ?>" name="login_pass" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span> <i class='fa fa-eye  input-icon'  aria-hidden='true' data-change0='fa fa-eye' 
        data-change='fa fa-eye-slash' title="Click here"  ></i> 
							</div>
						</div>
					</div>
					<div class="mb-3 form-password-toggle">
                <div class="input-group input-group-merge">
                  <div id="captcha" class="captcha-text  ">
                    <!-- CAPTCHA text will appear here -->
                  </div>
                  <input type="text" class="form-control" id="captcha-input" placeholder="Enter CAPTCHA"  required/>
                 </div>
              </div>
					<div class="row">
						<!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
						<!-- /.col -->
						<div class="col-4 text-right">
							<button type='submit' class="btn btn-primary btn-block">Login</button>
						</div>
						<!-- /.col -->
					</div>
					<?php if ($this->session->flashdata('status')) echo $this->session->flashdata('status'); ?>
				</form>
					</div>
				</div>
				


				<!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>


<style>

  .captcha-text {
    font-size: 20px;
    font-weight: bold;
    letter-spacing: 5px;
    color: #333;
    width: 45%;
    background-color: yellow;
  }

  #captcha-input {
    width: 50%;
    display: block;
    padding: 0.4375rem 0.875rem;
    font-size: 0.9375rem;
    font-weight: 400;
    line-height: 1.53;
    color: #697a8d;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #d9dee3;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.375rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
   }

  #error-message {
    font-size: 14px;
    background-color: #ffe0db;
    border-color: #ffc5bb;
    color: #ff3e1d;
    margin-top: 10px;
    padding: 0px 8px;
    font-weight: bold;
  }
</style>

<script>
    // Function to generate a random CAPTCHA text
    function generateCaptcha() {
      const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
      let captchaText = '';

      for (let i = 0; i < 6; i++) {
        captchaText += characters.charAt(Math.floor(Math.random() * characters.length));
      }

      document.getElementById('captcha').textContent = captchaText;
    }

    // Function to validate the CAPTCHA input
    function validateCaptcha() {
      $('#btn-login').prop('disabled',true);
      let captchaInput = $('#captcha-input').val();
      let captchaText = $('#captcha').text();
      let login_email = $('#login_email').val();
      let login_pass = $('#login_pass').val();
      if(login_email == "" || login_email == null){
        $('#error-message').text('Login Id is Required.');
        $('#btn-login').prop('disabled',false);
        generateCaptcha();
        return false;
      }
      if(login_pass == "" || login_pass == null){
        $('#error-message').text('Password is Required.');
        $('#btn-login').prop('disabled',false);
        generateCaptcha();
        return false;
      }
      if(captchaInput == "" || captchaInput == null){
        $('#error-message').text('Captcha is Required.');
        $('#btn-login').prop('disabled',false);
        generateCaptcha();
        return false;
      }
      if (captchaInput != captchaText) {
        $('#error-message').text('Incorrect CAPTCHA, please try again.');
        $('#btn-login').prop('disabled',false);
        generateCaptcha();
        return false;
      }
      $('#formAuthentication').submit();
    }

    // Initialize the CAPTCHA when the page loads
    window.onload = function() {
      generateCaptcha();
    };
  </script>
