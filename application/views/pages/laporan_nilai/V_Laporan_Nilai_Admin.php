<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Laporan Nilai Admin</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <div class="row">
                    <div class="col-md-2 offset-md-3 mb-4">
                        <?php
                            $p_semester = array('0'=>'Pilih Semester','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6');
                            $js = 'class="form-control" id="semester"'; 
                            echo form_dropdown('semester', $p_semester, $this->uri->segment(3), $js);
                        ?>
                    </div>
                    <div class="col-md-2 mb-4">
                        <?php
                            $js = 'class="form-control" id="prodi"'; 
                            $prodi[''] = 'Pilih Prodi';
                            echo form_dropdown('prodi', $prodi, $this->uri->segment(4), $js);
                        ?>
                    </div>
                    <div class="col-md-2 mb-4">
                        <?php if($this->session->userdata('role') == 'wadir1') { ?>
                            <a href="javascript: w=window.open('<?php echo base_url('laporan_nilai'); ?>/download/'+$('#semester').val()+'/'+$('#prodi').val()+''); w.print();" class="btn btn-outline-success btn-block">Download</a>
                        <?php } else { ?>
                            <button class="btn btn-block btn-outline-success" onclick="lihat()">Lihat</button>
                        <?php } ?>
                    </div>
                </div>
                <?php
                    $q_prodi = $this->db->get_where('prodi', array('id'=> $this->uri->segment(4)));
                ?>

                <?php if($semester != 0 && $q_prodi->num_rows() > 0) { ?>
                <div class="text-center">
                    <h4>EVALUASI KELULUSAN PROGRAM PENDIDIKAN</h4>
                    <h5>JURUSAN/PROGRAM STUDI : <?php echo strtoupper($q_prodi->row()->nama); ?></h5>
                    <p>Tahun Akademik <?php echo date('Y') ;?>/<?php echo date('Y')+1; ?></p>
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
                    
                        $nilais = $this->M_Laporan_Nilai->print_transkrip($row->nim, $semester, $id_prodi)->result();
                        //echo $this->db->last_query();
                        $sks = array();
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
                            $sks[] = $row1->sks;

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
                        if($jml_d <= 4 && $jml_e <= 0) {
                            $lulus = "Tetap";
                        } else if($jml_d >= 8 && $jml_e <= 0) {
                            $lulus = "Percobaan";
                        } else if($jml_d > 8 || $jml_e > 0) {
                            $lulus = "Tidak Lulus";
                        } else if($jml_e > 0) {
                            $lulus = "Tidak Lulus";
                        }
                        $bbt = array_sum($nilai);
                        $jml_sks = array_sum($sks);
                    ?>
                        <tr class="text-center">
                            <td class="text-left"><?php echo $row->nama; ?><br><?php echo $row->nim; ?></td>
                            <?php
                            $query = $this->db->query("SELECT nama, sks FROM matkul WHERE semester='".$this->uri->segment(3)."'")->result();
                            foreach($query as $matkul) {
                            ?>
                            <td><?php echo $nilai_matkul[$matkul->nama]; ?></td>
                            <?php } ?>
                            <td><?php echo number_format($bbt, 2, ',', ''); ?></td>
                            <td><?php if($bbt != 0) { echo number_format($bbt/$jml_sks, 2, ',', ''); } else { echo 0; } ?></td>
                            <td><?php echo $lulus; ?></td>
                            <td>
                            <?php if($bbt > 0) {?>
                            <a href="<?php echo base_url('laporan_nilai').'/transkrip_nilai/'.$row->nim.'/'.$this->uri->segment(3).'/'.$id_prodi ?>" target="_blank">Print</a>
                            <?php } ?>
                            </td>
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

                <?php } ?>

            </div>
        </div>
    </div>
</div>

<script>
function lihat() {
    var smt = $('#semester').val();
    var prodi = $('#prodi').val();
    
    window.location.href = '<?php echo base_url('laporan_nilai/laporan')?>/'+smt+'/'+prodi;
}
</script>