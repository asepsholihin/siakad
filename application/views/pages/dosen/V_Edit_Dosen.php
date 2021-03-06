<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Dosen</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <?php foreach($dosen as $u){ ?>
                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('dosen/proses_edit'); ?>" method="post">
                    <div class="form-group">
                        <label for="nidn" class="col-md-12">NIDN <i class="text-muted">(Tidak dapat diubah)</i></label>
                        <div class="col-md-12">
                            <input id="nidn" type="hidden" name="nidn" value="<?php echo $u->nidn; ?>" class="form-control form-control-line">
                            <input id="nidn" type="text"  disabled value="<?php echo $u->nidn; ?>" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-md-12">Nama Lengkap</label>
                        <div class="col-md-12">
                            <input id="nama" type="text" name="nama" value="<?php echo $u->nama; ?>" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir" class="col-md-12">Tanggal Lahir</label>
                        <div class="col-md-12">
                            <input id="tgl_lahir" type="date" name="tgl_lahir" value="<?php echo $u->tgl_lahir; ?>" class="form-control form-control-line" required> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tmp_lahir" class="col-md-12">Tempat Lahir</label>
                        <div class="col-md-12">
                            <input id="tmp_lahir" type="text" name="tmp_lahir" value="<?php echo $u->tmp_lahir; ?>" class="form-control form-control-line" required> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jk" class="col-md-12">Jenis Kelamin</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="l" value="L" <?php if($u->jk=='L') { ?> checked=checked <?php } ?> >
                                <label class="form-check-label" for="l">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="p" value="P" <?php if($u->jk=='P') { ?> checked=checked <?php } ?> >
                                <label class="form-check-label" for="p">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-md-12">Alamat</label>
                        <div class="col-md-12">
                            <input id="alamat" type="text" name="alamat" value="<?php echo $u->alamat; ?>" class="form-control form-control-line" required> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi" class="col-md-12">Program Studi</label>
                        <div class="col-md-12">
                            <?php echo form_dropdown('id_prodi', $prodi, $u->id_prodi, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan" class="col-md-12">Jabatan</label>
                        <div class="col-md-12">
                            <?php echo form_dropdown('jabatan', $jabatan, $u->jabatan, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_dosen" class="col-md-12">Mata Kuliah</label>
                        <div class="col-md-12">
                            <?php echo form_dropdown('matkul[]', $matkul, explode(',',$u->matkul), 'class="form-control select2" multiple="multiple"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Simpan</button>
                            <a href="<?php echo base_url('dosen')?>" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
                <?php } ?>
            
            </div>
        </div>
    </div>
</div>