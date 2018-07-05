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
                                        <th>SKS</th>
                                        <th>Nilai</th>
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
                                        <td><?php echo $row->sks ?></td>
                                        <td><?php 
                                            $kriteria = $this->db->query("SELECT kriteria_nilai.*, dosen.nama as dosen, matkul.nama as matkul FROM `kriteria_nilai`
                                            JOIN dosen on dosen.nidn = kriteria_nilai.id_dosen
                                            JOIN matkul on dosen.id_matkul = matkul.id AND matkul.id='".$row->id_matkul."' ORDER BY kriteria_nilai.nama DESC")->result();
                                            if ( count($kriteria) > 0 ) {
                                                $uts    = $row->uts*$kriteria[0]->skala/100;
                                                $uas    = $row->uas*$kriteria[1]->skala/100;
                                                $tugas  = $row->tugas*$kriteria[2]->skala/100;

                                                echo $this->M_Nilai->grading($uts+$uas+$tugas);
                                            } else {
                                                echo "Belum ada";
                                            }
                                            
                                        ?></td>
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