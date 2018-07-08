<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Nilai</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <div class="text-center">
                    <h4>EVALUASI KELULUSAN PROGRAM PENDIDIKAN</h4>
                    <h5>JURUSAN/PROGRAM STUDI : MANAJEMEN INFORMATIKA</h5>
                    <p>Tahun Akademik 2015/2016</p>

                    <div class="col-md-2 offset-md-5 mt-4">
                        <?php
                            $p_semester = array(''=>'Pilih Semester','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6');
                            $js = 'class="form-control" id="semester" onChange="window.location = \''.base_url().'laporan_nilai/laporan/\' + $(this).val()"'; 
                            echo form_dropdown('semester', $p_semester, $this->uri->segment(3), $js);
                        ?>
                    </div>
                </div>

                <div class="text-left mb-2">
                    Semester : <?php echo $this->uri->segment(3); ?>
                </div>
                <table id="data_nilai" class="table display pt-3">
                    <thead>
                        <tr class="text-center">
                            <th>Nama</th>
                            <?php
                            $jml_matkul = $this->db->query("SELECT nama, sks FROM matkul WHERE semester='".$this->uri->segment(3)."'")->num_rows();
                            ?>
                            <?php
                            $query = $this->db->query("SELECT nama, sks FROM matkul WHERE semester='".$this->uri->segment(3)."'")->result();
                            foreach($query as $matkul) {
                            ?>
                            <th><?php echo $matkul->nama. "<br> SKS(" .$matkul->sks.")"; ?></th>
                            <?php } ?>
                            <th >Jumlah BBT</th>
                            <th >IPS</th>
                            <th >STAT</th>
                            <th >#</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $peringkat = 1;
                    foreach($mahasiswa as $row) { 
                    
                        $nilais = $this->M_Laporan_Nilai->print_transkrip($row->nim, $semester)->result();
                        //echo json_encode($nilais);
                        $nilai = array();
                        $nilai_matkul = array();
                        $ips = array();
                        $arr_nilai_D = array();
                        $arr_nilai_E = array();
                        foreach($nilais as $row1) {
                            $nilai_akhir = $row1->total_uts+$row1->total_uas+$row1->total_tugas;
                            $nilai_index = $this->M_Nilai->grading($nilai_akhir);
                            $nilai_mutu = $this->M_Nilai->grading_angka($nilai_index);
                            
                            $nilai[] = $nilai_mutu*$row1->sks;
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
                        if($jml_d <= 4 || $jml_e < 0) {
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
                        <tr class="text-center">
                            <td class="text-left"><?php echo $row->nama; ?><br><?php echo $row->nim; ?></td>
                            <?php
                            $query = $this->db->query("SELECT nama, sks FROM matkul WHERE semester='".$this->uri->segment(3)."'")->result();
                            foreach($query as $matkul) {
                            ?>
                            <td><?php echo $nilai_matkul[$matkul->nama]; ?></td>
                            <?php } ?>
                            <td><?php echo $bbt; ?></td>
                            <td><?php echo $bbt/6; ?></td>
                            <td><?php echo $lulus; ?></td>
                            <td><a href="<?php echo base_url('laporan_nilai').'/transkrip_nilai/'.$row->nim.'/'.$this->uri->segment(3) ?>/" target="_blank">Print</a></td>
                        </tr>
                    <?php 
                    $peringkat++;
                    } ?>
                    </tbody>
                </table>

                <table cellpadding="6" class="no-border">
                    <tr>
                        <td>IPS</td>
                        <td>:</td>
                        <td>Indeks Prestasi Praktik</td>
                    </tr>
                    <tr>
                        <td>STA</td>
                        <td>:</td>
                        <td>Status Kelulusan</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>
