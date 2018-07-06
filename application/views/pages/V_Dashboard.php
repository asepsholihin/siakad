<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Dashboard</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="white-box text-center p-5">
            
            <h2>Hai, <?php echo $this->session->userdata("nama"); ?>.</h2>
            <hr>
            <h4 class="mt-3">Semester 
                <?php if($this->session->userdata("role") == 'admin') { ?>
                    <a href="#" class="btn btn-link semester" data-name="semester" data-pk="semester" data-type="text" data-url="<?php echo base_url('dashboard'); ?>/semester"><?php echo $semester->semester; ?></a>
                <?php } else { ?>
                    <?php echo $semester->semester; ?>
                <?php } ?>
            </h4>
            </div>
        </div>
    </div>
</div>