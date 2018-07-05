<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Program Studi</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <?php foreach($referensi_kuisioner as $u) { ?>
                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('referensi_kuisioner/proses_edit'); ?>" method="post">
                    <div class="form-group">
                        <label for="kategori" class="col-md-12">Kategori</label>
                        <div class="col-md-12">
                            <input id="kategori" type="text" name="kategori" value="<?php echo $u->kategori; ?>" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pertanyaan" class="col-md-12">Pertanyaan</label>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?php echo $u->id; ?>">
                            <input id="pertanyaan" type="text" name="pertanyaan" value="<?php echo $u->pertanyaan; ?>" class="form-control form-control-line">
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