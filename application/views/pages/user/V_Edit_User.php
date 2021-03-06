<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Program Studi</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            <?php foreach($user as $u){ ?>
                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('user/proses_edit'); ?>" method="post">
                    <div class="form-group">
                        <label for="username" class="col-md-12">Username</label>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?php echo $u->id; ?>">
                            <input id="username" type="text" name="username" value="<?php echo $u->username; ?>" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_user" class="col-md-12">NIM/NIDN (Mahasiswa/Dosen)</label>
                        <div class="col-md-12">
                            <input id="id_user" type="text" name="id_user" value="<?php echo $u->id_user; ?>" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-md-12">Hak Akses</label>
                        <div class="col-md-12">
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Pilih Hak Akses</option>
                                <option value="admin" <?php if($u->role=='admin') { ?> selected <?php } ?>>Admin</option>
                                <option value="dosen" <?php if($u->role=='dosen') { ?> selected <?php } ?>>Dosen</option>
                                <option value="mahasiswa" <?php if($u->role=='mahasiswa') { ?> selected <?php } ?>>Mahasiswa</option>
                                <option value="wadir1" <?php if($u->role=='wadir1') { ?> selected <?php } ?>>Wakil Direktur 1</option>
                                <option value="kajur" <?php if($u->role=='kajur') { ?> selected <?php } ?>>Ketua Jurusan</option>
                                <option value="walikelas" <?php if($u->role=='walikelas') { ?> selected <?php } ?>>Wali Kelas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Simpan</button>
                            <a href="<?php echo base_url('user')?>" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>