<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Mata Kuliah</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <?php foreach($matkul as $u) { ?>
                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('matkul/proses_edit'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama" class="col-md-12">Matak Kuliah</label>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?php echo $u->id; ?>">
                            <input id="nama" type="text" name="nama" value="<?php echo $u->nama; ?>" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sks" class="col-md-12">Bobot SKS</label>
                        <div class="col-md-12">
                            <input id="sks" type="text" name="sks" value="<?php echo $u->sks; ?>" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi" class="col-md-12">Program Studi</label>
                        <div class="col-md-12">
                            <input id="id_prodi" type="text" name="id_prodi" value="<?php echo $u->id_prodi; ?>" class="form-control form-control-line">
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