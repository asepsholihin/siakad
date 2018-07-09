<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Kelas</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            <?php foreach($kelas as $row) { ?>
                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('kelas/proses_edit'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama" class="col-md-12">Kelas</label>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?php echo $row->id ?>">
                            <input id="nama" type="text" name="nama" value="<?php echo $row->nama ?>" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_dosen" class="col-md-12">Wali Kelas</label>
                        <div class="col-md-12">
                            <?php echo form_dropdown('id_dosen', $dosen, $row->id_dosen, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi" class="col-md-12">Program Studi</label>
                        <div class="col-md-12">
                            <?php echo form_dropdown('id_prodi', $prodi, $row->id_prodi, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="semester" class="col-md-12">Semester</label>
                        <div class="col-md-12">
                            <select class="form-control" id="semester" name="semester" required>
                                <option value="1" <?php if($row->semester == 1) {?> selected <?php }?>>1</option>
                                <option value="2" <?php if($row->semester == 2) {?> selected <?php }?>>2</option>
                                <option value="3" <?php if($row->semester == 3) {?> selected <?php }?>>3</option>
                                <option value="4" <?php if($row->semester == 4) {?> selected <?php }?>>4</option>
                                <option value="5" <?php if($row->semester == 5) {?> selected <?php }?>>5</option>
                                <option value="6" <?php if($row->semester == 6) {?> selected <?php }?>>6</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Simpan</button>
                            <a href="<?php echo base_url('prodi')?>" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
            <?php } ?>
            </div>
        </div>
    </div>
</div>