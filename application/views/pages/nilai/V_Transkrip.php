<?php
    $this->db->select('mahasiswa.*, prodi.nama as prodi');
    $this->db->from('users');
    $this->db->join('mahasiswa', 'mahasiswa.nim = users.id_user');
    $this->db->join('prodi', 'mahasiswa.id_prodi = prodi.id');
    $this->db->where('mahasiswa.nim', $this->session->userdata("id_user"));
    $user = $this->db->get()->row();
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Profil</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg">
                                <div class="overlay-box">
                                    <div class="user-content">
    <a href="javascript:void(0)"><img src="<?php echo base_url()?>assets/images/<?php if($user->jk == "L") { ?>male<?php } else { ?>female<?php } ?>.png" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white mt-2"><?php echo $user->nama ?></h4>
                                        <h5 class="text-white mt-1"><?php echo $user->nim ?></h5>
                                        <h5 class="text-white mt-1">Program Studi <?php echo $user->prodi ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Mata Kuliah</th>
                                        <th class="text-center">SKS</th>
                                        <th class="text-center">Nilai Akhir</th>
                                        <th class="text-center">Nilai Mutu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no = 1;
                                foreach($transkrip as $row) { ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row->kode ?></td>
                                        <td><?php echo $row->matkul ?></td>
                                        <td class="text-center"><?php echo $row->sks ?></td>
                                        <td class="text-center"><?php echo intval($row->total_uts)+intval($row->total_uas)+intval($row->total_tugas); ?></td>
                                        <td class="text-center"><?php echo $this->M_Nilai->grading(intval($row->total_uts)+intval($row->total_uas)+intval($row->total_tugas)); ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>