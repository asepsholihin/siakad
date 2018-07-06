<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Kriteria Nilai</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h3 class="box-title float-left mt-1 mb-4">Kriteria Nilai</h3>
                <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                    <?php
                        $js = 'class="form-control" id="id_matkul" onChange="window.location = \''.base_url().'kriteria_nilai/matkul/\' + $(this).val()"'; 
                        echo form_dropdown('id_matkul', $matkul, $this->uri->segment(3), $js);
                    ?>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kriteria Nilai</th>
                                <th>Skala Penilaian</th>
                                <?php if($this->session->userdata('role') == "admin") { ?> <th>Dosen</th> <?php } ?>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php ;
                        if(count($kriteria_nilai) > 0) {
                            $no = 1;
                            foreach($kriteria_nilai as $row){ 
                                if(!empty($row->uts)) {
                        ?>
                            <tr>
                                <td>1</td>
                                <td>UTS</td>
                                <td><a href="#" class="uts" data-name="uts" data-type="text" data-pk="<?php echo $this->session->userdata("id_user"); ?>" data-url="<?php echo base_url('kriteria_nilai'); ?>/live_edit/<?php echo $id_matkul ?>"><?php echo $row->uts ?></a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>UAS</td>
                                <td><a href="#" class="uas" data-name="uas" data-type="text" data-pk="<?php echo $this->session->userdata("id_user"); ?>" data-url="<?php echo base_url('kriteria_nilai'); ?>/live_edit/<?php echo $id_matkul ?>"><?php echo $row->uas ?></a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Tugas</td>
                                <td><a href="#" class="tugas" data-name="tugas" data-type="text" data-pk="<?php echo $this->session->userdata("id_user"); ?>" data-url="<?php echo base_url('kriteria_nilai'); ?>/live_edit/<?php echo $id_matkul ?>"><?php echo $row->tugas ?></a></td>
                            </tr>
                            <?php } ?>
                        <?php } 
                        } else {  
                            if($id_matkul != 0) { ?>
                        
                        <tr>
                            <td>1</td>
                            <td>UTS</td>
                            <td><a href="#" class="uts" data-name="uts" data-type="text" data-pk="<?php echo $this->session->userdata("id_user"); ?>" data-url="<?php echo base_url('kriteria_nilai'); ?>/live_edit/<?php echo $id_matkul ?>"></a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>UAS</td>
                            <td><a href="#" class="uas" data-name="uas" data-type="text" data-pk="<?php echo $this->session->userdata("id_user"); ?>" data-url="<?php echo base_url('kriteria_nilai'); ?>/live_edit/<?php echo $id_matkul ?>"></a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Tugas</td>
                            <td><a href="#" class="tugas" data-name="tugas" data-type="text" data-pk="<?php echo $this->session->userdata("id_user"); ?>" data-url="<?php echo base_url('kriteria_nilai'); ?>/live_edit/<?php echo $id_matkul ?>"></a></td>
                        </tr>
                        
                        <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
</div>