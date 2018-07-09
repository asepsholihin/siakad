<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Kategori Kuisioner</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('kategori_kuisioner/proses_input'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama" class="col-md-12">Kategori Kuisioner</label>
                        <div class="col-md-12">
                            <input id="nama" type="text" name="nama" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Simpan</button>
                            <a href="<?php echo base_url('kategori_kuisioner')?>" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
</div>