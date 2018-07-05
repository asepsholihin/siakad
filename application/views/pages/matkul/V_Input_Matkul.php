<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Mata Kuliah</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('matkul/proses_input'); ?>" method="post">
                    <div class="form-group">
                        <label for="kode" class="col-md-12">Kode Mata Kuliah</label>
                        <div class="col-md-12">
                            <input id="kode" type="text" name="kode" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-md-12">Mata Kuliah</label>
                        <div class="col-md-12">
                            <input id="nama" type="text" name="nama" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sks" class="col-md-12">Bobot SKS</label>
                        <div class="col-md-12">
                            <input id="sks" type="text" name="sks" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi" class="col-md-12">Program Studi</label>
                        <div class="col-md-12">
                            <?php echo form_dropdown('id_prodi', $prodi, null, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
</div>