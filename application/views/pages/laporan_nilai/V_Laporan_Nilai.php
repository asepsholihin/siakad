<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Nilai</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <h3 class="box-title float-left mt-1 mb-4">Mata Kuliah</h3>
                <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                    <?php
                        $js = 'class="form-control" onChange="window.location = \''.base_url().'laporan_nilai/matkul/\' + $(this).val();"'; 
                        echo form_dropdown('id_matkul', $matkul, $this->uri->segment(3), $js);
                    ?>
                </div>
                <a href="<?php echo base_url('laporan_nilai') ?>/createXLS/<?php echo $this->uri->segment(3); ?>" class="btn btn-outline-success pull-right">Download</a>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mahasiswa</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Tugas</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($mahasiswa as $mahasiswa){ 
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $mahasiswa->nama ?></td>
                            <td><?php echo $mahasiswa->uts ?></td>
                            <td><?php echo $mahasiswa->uas ?></td>
                            <td><?php echo $mahasiswa->tugas ?></td>
                            <td><?php 
                                $kriteria = $this->db->query("SELECT kriteria_nilai.*, dosen.nama as dosen, matkul.nama as matkul FROM `kriteria_nilai`
                                JOIN dosen on dosen.nidn = kriteria_nilai.id_dosen
                                JOIN matkul on dosen.id_matkul = matkul.id AND matkul.id='".$this->uri->segment(3)."' ORDER BY kriteria_nilai.nama DESC")->result();
                                if ( count($kriteria) > 0 ) {
                                    $uts    = intval($mahasiswa->uts)*$kriteria[0]->skala/100;
                                    $uas    = intval($mahasiswa->uas)*$kriteria[1]->skala/100;
                                    $tugas  = intval($mahasiswa->tugas)*$kriteria[2]->skala/100;

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