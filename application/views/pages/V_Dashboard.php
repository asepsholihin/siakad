<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            
			<h1>Login berhasil !</h1>
			<h2>Hai, <?php echo $this->session->userdata("nama"); ?></h2>
			<a href="<?php echo base_url('login/logout'); ?>">Logout</a>
            
            </div>
        </div>
    </div>
</div>