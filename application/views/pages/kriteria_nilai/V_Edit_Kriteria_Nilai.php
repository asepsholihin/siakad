<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Kriteria Nilai</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <?php foreach($kriteria_nilai as $u) { ?>
                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('kriteria_nilai/proses_edit'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama" class="col-md-12">Kriteria Nilai</label>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?php echo $u->id; ?>">
                            <input id="nama" type="text" name="nama" value="<?php echo $u->nama; ?>" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="skala" class="col-md-12">Skala Penilaian</label>
                        <div class="col-md-12">
                            <input id="skala" type="text" name="skala" value="<?php echo $u->skala; ?>" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
                <?php } ?>
            
            </div>
        </div>
    </div>
</div>