<?php
    $this->db->select('mahasiswa.*, prodi.nama as prodi');
    $this->db->from('mahasiswa');
    $this->db->join('prodi', 'mahasiswa.id_prodi = prodi.id');
    $this->db->where('mahasiswa.nim', $this->session->userdata("id_user"));
    $user = $this->db->get()->row();
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Transkrip Nilai</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <!-- <div class="col-md-12 my-4 text-right">
                    <a class="btn btn btn-rounded btn-info btn-outline" href="<?php echo base_url("nilai"); ?>/print_transkrip/<?php echo $user->nim ?>">Print Transkrip</a>
                </div> -->
                <div class="col-md-2 offset-md-10 my-4 text-right">
                    <?php
                        $p_semester = array(''=>'Pilih Semester','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6');
                        $js = 'class="form-control" id="semester" onChange="window.location = \''.base_url().'nilai/transkrip_nilai/\' + \''.$user->nim.'\'+\'/\'+$(this).val()"'; 
                        echo form_dropdown('semester', $p_semester, $this->uri->segment(4), $js);
                    ?>
                </div>
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
                                        <!-- <th class="text-center">Nilai Akhir</th> -->
                                        <th class="text-center">Nilai Mutu</th>
                                        <th class="text-center">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no = 1;
                                $arr_nilai_mutu = array();
                                $jml_sks = array();
                                foreach($transkrip as $row) { 

                                    $nilai_akhir = $row->total_uts+$row->total_uas+$row->total_tugas;
                                    $nilai_mutu = $this->M_Nilai->grading($nilai_akhir);
                                    $arr_nilai_mutu[] = $this->M_Nilai->grading_angka($nilai_mutu) * $row->sks;
                                    $jml_sks[] = $row->sks;
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row->kode ?></td>
                                        <td><?php echo $row->matkul ?></td>
                                        <td class="text-center"><?php echo $row->sks ?></td>
                                        <!-- <td class="text-center"><?php echo $nilai_akhir ?></td> -->
                                        <td class="text-center"><?php echo $nilai_mutu ?></td>
                                        <td class="text-center"><?php echo $this->M_Nilai->grading_angka($nilai_mutu) ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            
                            <?php 
                                $nilais = $this->M_Nilai->print_transkrip($user->nim, $semester)->result();
                                $jml_matkul = count($nilais);
                                $nilai = array();
                                $nilai_matkul = array();
                                $ips = array();
                                $arr_nilai_D = array();
                                $arr_nilai_E = array();
                                foreach($nilais as $row1) {
                                    $nilai_akhir = $row1->total_uts+$row1->total_uas+$row1->total_tugas;
                                    $nilai_index = $this->M_Nilai->grading($nilai_akhir);
                                    $nilai_mutu = $this->M_Nilai->grading_angka($nilai_index);
                                    
                                    $nilai[] = $nilai_mutu;
                                    $nilai_matkul[$row1->matkul] = $nilai_mutu;

                                    if($nilai_index == "D") {
                                        $arr_nilai_D[] = 1;
                                        $jml_d = array_sum($arr_nilai_D);
                                    }
                                    if($nilai_index == "E") {
                                        $arr_nilai_E[] = 1;
                                        $jml_e = array_sum($arr_nilai_E);
                                    }
                                }
                                $jml_d = array_sum($arr_nilai_D);
                                $jml_e = array_sum($arr_nilai_E);
                                if($jml_d <= 4 && $jml_e < 0) {
                                    $lulus = "Tetap";
                                } else if($jml_d >= 8 && $jml_e < 0) {
                                    $lulus = "Percobaan";
                                } else if($jml_d > 8 || $jml_e > 0) {
                                    $lulus = "Tidak Lulus";
                                } else if($jml_d > 0) {
                                    $lulus = "Tidak Lulus";
                                }
                                $bbt = array_sum($nilai);
                            ?>

                            <table width="150" class="no-border m-2">
                                <tr>
                                    <td>SKS</td>
                                    <td>:</td>
                                    <td><?php echo array_sum($jml_sks); ?></td>
                                </tr>
                                <tr>
                                    <td>IPK</td>
                                    <td>:</td>
                                    <td><?php if($bbt != 0) { echo floatval($bbt/$jml_matkul); } else { echo 0; } ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>