<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Dosen</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('dosen/proses_input'); ?>" method="post">
                    <div class="form-group">
                        <label for="nidn" class="col-md-12">NIDN</label>
                        <div class="col-md-12">
                            <input id="nidn" type="text" name="nidn" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-md-12">Nama Lengkap</label>
                        <div class="col-md-12">
                            <input id="nama" type="text" name="nama" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir" class="col-md-12">Tanggal Lahir</label>
                        <div class="col-md-12">
                            <input id="tgl_lahir" type="date" name="tgl_lahir" class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label for="tmp_lahir" class="col-md-12">Tempat Lahir</label>
                        <div class="col-md-12">
                            <input id="tmp_lahir" type="text" name="tmp_lahir" class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label for="jk" class="col-md-12">Jenis Kelamin</label>
                        <div class="col-md-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jk" id="l" value="L">
                            <label class="form-check-label" for="l">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jk" id="p" value="P">
                            <label class="form-check-label" for="p">Perempuan</label>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="col-md-12">Alamat</label>
                        <div class="col-md-12">
                            <input id="alamat" type="text" name="alamat" class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi" class="col-md-12">Program Studi</label>
                        <div class="col-md-12">
                            <input id="id_prodi" type="text" name="id_prodi" class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label for="id_matkul" class="col-md-12">Mata Kuliah</label>
                        <div class="col-md-12">
                            <input id="id_matkul" type="text" name="id_matkul" class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan" class="col-md-12">Jabatan</label>
                        <div class="col-md-12">
                            <input id="jabatan" type="text" name="jabatan" class="form-control form-control-line"> </div>
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