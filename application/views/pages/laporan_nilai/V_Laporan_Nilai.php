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
                <div class="pull-right mb-3 ml-3">
                    <?php
                        $js = 'class="form-control" id="id_matkul" onChange="window.location = \''.base_url().'laporan_nilai/matkul/\' + $(\'#id_kelas\').val()+\'/\'+$(this).val()"'; 
                        echo form_dropdown('id_matkul', $matkul, $this->uri->segment(4), $js);
                    ?>
                </div>
                <div class="pull-right mb-3 ml-3">
                    <?php
                        $js = 'class="form-control" id="id_kelas" onChange="window.location = \''.base_url().'laporan_nilai/matkul/\' + $(this).val()+\'/\'+$(\'#id_matkul\').val()"'; 
                        echo form_dropdown('id_kelas', $kelas, $this->uri->segment(3), $js);
                    ?>
                </div>

                <?php if($this->session->userdata('role') == 'wadir1') { ?>
                    <!-- <a href="javascript: w=window.open('<?php echo base_url('laporan_nilai'); ?>/download/'+$('#semester').val()+''); w.print();" class="btn btn-outline-success pull-right">Download</a> -->
                    <a href="javascript: w=window.location.href ='<?php echo base_url('laporan_nilai'); ?>/laporan'" class="btn btn-outline-success pull-right">Download</a>
                <?php } else if($this->session->userdata('role') == 'admin') { ?>
                    <a href="javascript: w=window.location.href = '<?php echo base_url('laporan_nilai'); ?>/laporan'" class="btn btn-outline-success pull-right">Laporan</a>
                <?php } else {
                    if($this->uri->segment(3) && $this->uri->segment(4 && count($mahasiswa) > 0)) { ?>
                    <a href="<?php echo base_url('laporan_nilai') ?>/export/<?php echo $this->uri->segment(3); ?>/<?php echo $this->uri->segment(4); ?>" class="btn btn-outline-success pull-right">Download</a>
                <?php } 
                }?>

                <div class="table-responsive">
                    <table id="data" class="display table pt-3">
                        <thead>
                            <tr>
                                <th class="no-sort">No</th>
                                <th class="no-sort">Mahasiswa</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Tugas</th>
                                <th>Nilai Akhir</th>
                                <th class="no-sort">Nilai Mutu</th>
                                <th class="no-sort">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($mahasiswa as $mahasiswa){ 
                                $nilai_akhir = $mahasiswa->total_uts+$mahasiswa->total_uas+$mahasiswa->total_tugas;
                                $nilai_mutu = $this->M_Nilai->grading($nilai_akhir);
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $mahasiswa->nama ?></td>
                            <td><?php echo $mahasiswa->uts ?></td>
                            <td><?php echo $mahasiswa->uas ?></td>
                            <td><?php echo $mahasiswa->tugas ?></td>
                            <td><?php echo $nilai_akhir ?></td>
                            <td><?php echo $nilai_mutu ?></td>
                            <td><?php echo $this->M_Nilai->lulus($nilai_mutu) ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
</div>