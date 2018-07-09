<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Program Studi</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('user/proses_input'); ?>" method="post">
                    <div class="form-group">
                        <label for="username" class="col-md-12">Username</label>
                        <div class="col-md-12">
                            <input id="username" type="text" name="username" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-12">Password</label>
                        <div class="col-md-12">
                            <input id="password" type="password" name="password" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_user" class="col-md-12">NIM/NIDN (Mahasiswa/Dosen)</label>
                        <div class="col-md-12">
                            <input id="id_user" type="text" name="id_user" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-md-12">Hak Akses</label>
                        <div class="col-md-12">
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Pilih Hak Akses</option>
                                <option value="admin">Admin</option>
                                <option value="dosen">Dosen</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="kajur">Ketua Jurusan</option>
                                <option value="wadir1">Wakil Direktur 1</option>
                                <option value="walikelas">Wali Kelas</option>
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
            
            </div>
        </div>
    </div>
</div>