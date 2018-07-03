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
                <div class="box-title float-left ml-3 mb-4">
                    <?php
                        $js = 'class="form-control" onChange="window.location = \''.base_url().'nilai/matkul/\' + $(this).val();"'; 
                        echo form_dropdown('id_matkul', $matkul, $this->uri->segment(3), $js);
                    ?>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mahasiswa</th>
                                <?php
                                foreach($kriteria_nilai as $u){ 
                                ?>
                                    <th><?php echo $u->nama ?></th>
                                <?php
                                }
                                ?>
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
                            <td><a href="#" class="uts" data-name="uts" data-type="text" data-pk="<?php echo $mahasiswa->nim ?>" data-url="<?php echo base_url('nilai'); ?>/proses_edit/<?php echo $this->uri->segment(3) ?>"><?php echo $mahasiswa->uts ?></a></td>
                            <td><a href="#" class="uas" data-name="uas" data-type="text" data-pk="<?php echo $mahasiswa->nim ?>" data-url="<?php echo base_url('nilai'); ?>/proses_edit/<?php echo $this->uri->segment(3) ?>"><?php echo $mahasiswa->uas ?></a></td>
                            <td><a href="#" class="tugas" data-name="tugas" data-type="text" data-pk="<?php echo $mahasiswa->nim ?>" data-url="<?php echo base_url('nilai'); ?>/proses_edit/<?php echo $this->uri->segment(3) ?>"><?php echo $mahasiswa->tugas ?></a></td>
                            <td><a href="#" class="grade" data-name="grade" data-type="text" data-pk="<?php echo $mahasiswa->nim ?>" data-url="<?php echo base_url('nilai'); ?>/proses_edit/<?php echo $this->uri->segment(3) ?>"><?php echo $mahasiswa->grade ?></a></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
</div>