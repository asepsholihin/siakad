<?php
    $this->db->select('mahasiswa.nim, mahasiswa.nama, mahasiswa.id_prodi');
    $this->db->from('users');
    $this->db->join('mahasiswa', 'mahasiswa.nim = users.id_user');
    $this->db->where('mahasiswa.nim', $this->session->userdata("id_user"));
    $user = $this->db->get()->row();
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Kuisioner</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <h3 class="box-title text-center">INSTRUMEN PENILAIAN KINERJA DOSEN<br>PELAKSANAAN PERKULIAHAN SEMESTER GASAL 2017/2018<br>POLITEKNIK NEGERI SUBANG</h3>
                <p class="text-secondary text-center">Isilah kuesioner ini berdasarkan pendapat anda dengan jujur.</p>

                <div class="col-sm-12 my-3">  
					<?php echo $this->session->flashdata('msg'); ?>
				</div>  

                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('kuisioner/proses_input'); ?>" method="post">
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="col-md-12">Alamat email <span class="text-danger">*</span></label>
                                <div class="col-md-12">
                                    <input id="email" type="text" name="email" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nim" class="col-md-12">NIM <span class="text-danger">*</span></label>
                                <div class="col-md-12">
                                    <input id="nim" type="text" name="nim" readonly value="<?php echo $user->nim ?>" class="form-control form-control-line">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_prodi" class="col-md-12">Program Studi <span class="text-danger">*</span></label>
                                <div class="col-md-12">
                                    <?php echo form_dropdown('id_prodi', $prodi, $user->id_prodi, 'class="form-control"'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_dosen" class="col-md-12">Mata Kuliah <span class="text-danger">*</span></label>
                                <div class="col-md-12">
                                    <?php echo form_dropdown('id_matkul', $matkul, null, 'class="form-control"'); ?>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label for="id_dosen" class="col-md-12">Nama Dosen <span class="text-danger">*</span></label>
                                <div class="col-md-12">
                                    <?php echo form_dropdown('id_dosen', $dosen, null, 'class="form-control"'); ?>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-md-12">Nama Mahasiswa <span class="text-danger">*</span></label>
                        <div class="col-md-12">
                            <input id="nama" type="text" name="nama" readonly value="<?php echo $user->nama ?>" class="form-control form-control-line">
                        </div>
                    </div>

                    <?php 
                        foreach($ref_kategori as $kategori){
                    ?>
                        <h3 class="box-title mt-5"><?php echo $kategori->kategori ?> <span class="text-danger">*</span></h3>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th></th>
                                        <th></th>
                                        <th width="14%">Sangat Tidak Setuju</th>
                                        <th width="10%">Tidak Setuju</th>
                                        <th width="10%">Biasa</th>
                                        <th width="10%">Setuju</th>
                                        <th width="10%">Sangat Setuju</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $no = 1;
                                    
                                    $where = array(
                                        'kategori' => $kategori->kategori
                                    );
                        
                                    $ref_kuisioner = $this->M_Kuisioner->kuisioner($where, 'referensi_kuisioner');
                                    foreach($ref_kuisioner->result() as $u){
                                ?>
                                        <tr class="text-center">
                                            <td><?php echo $no++; ?>.</td>
                                            <td class="text-left"><?php echo $u->pertanyaan ?></td>
                                            <td><input type="radio" name="<?php echo $u->kode.$u->id ?>" value="1"></td>
                                            <td><input type="radio" name="<?php echo $u->kode.$u->id ?>" value="2"></td>
                                            <td><input type="radio" name="<?php echo $u->kode.$u->id ?>" value="3"></td>
                                            <td><input type="radio" name="<?php echo $u->kode.$u->id ?>" value="4"></td>
                                            <td><input type="radio" name="<?php echo $u->kode.$u->id ?>" value="5"></td>
                                        </tr>
                                <?php 
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    <?php 
                        }
                    ?>
                    
                    <?php 
                        foreach($esai as $esai){
                    ?>
                        <div class="form-group mt-5">
                            <label for="nim" class="col-md-8"><?php echo $esai->pertanyaan ?> </label>
                            <div class="col-md-8">
                                <input id="nim" type="text" name="<?php echo $esai->kode.$esai->id ?>" class="form-control form-control-line">
                            </div>
                        </div>
                    <?php 
                        } 
                    ?>

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