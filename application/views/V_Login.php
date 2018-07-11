<html>
<head>
	<title>Login</title>
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/css/util.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(<?php echo base_url(); ?>assets/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						<img src="<?php echo base_url('assets/images/logo.png')?>" width="84"><br><br>
						Login Siakad
					</span>
				</div>

				<div class="col-sm-12 mt-3">  
					<?php echo $this->session->flashdata('msg'); ?>
				</div>  

				<form class="login100-form validate-form" autocomplete="off" action="<?php echo base_url('login/proses_login'); ?>" method="post">
					<div class="wrap-input100 validate-input m-b-26">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="">
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn mt-4">
						<button class="login100-form-btn btn-block">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>