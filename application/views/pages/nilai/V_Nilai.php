<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Nilai</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-sm-12 mb-2">  
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                </div>
                <?php if($cek_kriteria > 0) { ?>
                
                <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                    <div class="row">
                        <div class="col-md-4 pt-2">
                            Semester
                        </div>
                        <div class="col-md-8">
                            <?php
                                $p_semester = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6');
                                $js = 'class="form-control" id="semester" onChange="window.location = \''.base_url().'nilai/matkul/\' + $(\'#id_matkul\').val()+\'/\'+$(this).val()"'; 
                                echo form_dropdown('semester', $p_semester, $this->uri->segment(4), $js);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="pull-right mb-3 ml-3">
                    <?php
                        $js = 'class="form-control" id="id_matkul" onChange="window.location = \''.base_url().'nilai/matkul/\' + $(this).val()+\'/\'+$(\'#semester\').val()"'; 
                        echo form_dropdown('id_matkul', $matkul, $this->uri->segment(3), $js);
                    ?>
                </div>
                <a href="<?php echo base_url('nilai') ?>/upload" class="btn btn-outline-success pull-right">Upload</a>

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
                            <td><a href="#" class="uts" data-name="uts" data-type="text" data-pk="<?php echo $mahasiswa->nim ?>" data-url="<?php echo base_url('nilai'); ?>/proses_edit/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>"><?php echo $mahasiswa->uts ?></a></td>
                            <td><a href="#" class="uas" data-name="uas" data-type="text" data-pk="<?php echo $mahasiswa->nim ?>" data-url="<?php echo base_url('nilai'); ?>/proses_edit/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>"><?php echo $mahasiswa->uas ?></a></td>
                            <td><a href="#" class="tugas" data-name="tugas" data-type="text" data-pk="<?php echo $mahasiswa->nim ?>" data-url="<?php echo base_url('nilai'); ?>/proses_edit/<?php echo $this->uri->segment(3) ?>/<?php echo $this->uri->segment(4) ?>"><?php echo $mahasiswa->tugas ?></a></td>
                            <td><?php echo intval($mahasiswa->total_uts)+intval($mahasiswa->total_uas)+intval($mahasiswa->total_tugas) ?></td>
                            <td><?php echo $this->M_Nilai->grading(intval($mahasiswa->total_uts)+intval($mahasiswa->total_uas)+intval($mahasiswa->total_tugas)); ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <?php } else { ?>

                    <div class="text-center p-5">
                        <h2>Hai, <?php echo $this->session->userdata("nama"); ?>.</h2>
                        <hr>
                        <h4 class="mt-3">Anda belum mengisi kriteria nilai,<br>silahkan isi <a href="<?php echo base_url('kriteria_nilai') ?>">disini</a></h4>
                    </div>

                <?php } ?>
            
            </div>
        </div>
    </div>
</div>