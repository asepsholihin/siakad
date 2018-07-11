<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Mahasiswa</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <?php foreach($mahasiswa as $row){ ?>
                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('mahasiswa/proses_edit'); ?>" method="post">
                    <div class="form-group">
                        <label for="tahun_masuk" class="col-md-12">Tahun Masuk</label>
                        <div class="col-md-12">
                            <input id="tahun_masuk" type="text" name="tahun_masuk" disabled value="<?php echo $row->tahun_masuk; ?>" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nim" class="col-md-12">NIM</label>
                        <div class="col-md-12">
                            <input id="nim" type="hidden" name="nim" value="<?php echo $row->nim; ?>"  class="form-control form-control-line">
                            <input id="nim" type="text" disabled value="<?php echo $row->nim; ?>" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-md-12">Nama Lengkap</label>
                        <div class="col-md-12">
                            <input id="nama" type="text" name="nama" value="<?php echo $row->nama; ?>" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir" class="col-md-12">Tanggal Lahir</label>
                        <div class="col-md-12">
                            <input id="tgl_lahir" type="date" name="tgl_lahir" value="<?php echo $row->tgl_lahir; ?>" class="form-control form-control-line" required> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tmp_lahir" class="col-md-12">Tempat Lahir</label>
                        <div class="col-md-12">
                            <input id="tmp_lahir" type="text" name="tmp_lahir" value="<?php echo $row->tmp_lahir; ?>" class="form-control form-control-line" required> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jk" class="col-md-12">Jenis Kelamin</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="l" value="L" <?php if($row->jk=='L') { ?> checked=checked <?php } ?> >
                                <label class="form-check-label" for="l">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jk" id="p" value="P" <?php if($row->jk=='P') { ?> checked=checked <?php } ?> >
                                <label class="form-check-label" for="p">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-md-12">Alamat</label>
                        <div class="col-md-12">
                            <input id="alamat" type="text" name="alamat" value="<?php echo $row->alamat; ?>" class="form-control form-control-line" required> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_kelas" class="col-md-12">Kelas</label>
                        <div class="col-md-12">
                            <?php echo form_dropdown('id_kelas', $kelas, $row->id_kelas, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_dosen" class="col-md-12">Mata Kuliah</label>
                        <div class="col-md-12">
                            <?php echo form_dropdown('matkul[]', $matkul, explode(',',$row->matkul), 'class="form-control select2" multiple="multiple"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Simpan</button>
                            <a href="<?php echo base_url('mahasiswa')?>" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
                <?php } ?>
            
            </div>
        </div>
    </div>
</div>