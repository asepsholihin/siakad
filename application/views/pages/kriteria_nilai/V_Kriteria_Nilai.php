<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Kriteria Nilai</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <!-- <?php if(count($kriteria_nilai) >= 3) { ?>
                <div class="box-title float-right"><a href="<?php echo base_url('kriteria_nilai/input');?>" class="btn btn-outline-info">+</a></div>
                <?php } ?> -->
                <h3 class="box-title">Kriteria Nilai</h3>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kriteria Nilai</th>
                                <th>Skala Penilaian</th>
                                <?php if($this->session->userdata('role') == "admin") { ?> <th>Dosen</th> <?php } ?>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if(count($kriteria_nilai) >= 3) {
                            $no = 1;
                            foreach($kriteria_nilai as $u){ 
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $u->nama ?></td>
                            <td><?php echo $u->skala ?></td>
                            <?php if($this->session->userdata('role') == "admin") { ?><td><?php echo $u->dosen ?></td><?php } ?>
                            <td>
                                <a href="<?php echo base_url('kriteria_nilai/edit/'.$u->id.'');?>" class="btn btn-outline-warning">Edit</a>
                            </td>
                        </tr>
                        <?php } 
                        } else { 
                            
                            $cek = $this->db->query("SELECT skala FROM kriteria_nilai WHERE id_dosen='".$this->session->userdata("id_user")."' ORDER BY nama DESC")->result();
                            
                            $skala = array();
                            foreach($cek as $row) {
                                $skala[] = $row;
                            }
                        ?>
                        <tr>
                            <td>1</td>
                            <td>UTS</td>
                            <td><a href="#" class="uts" data-name="uts" data-type="text" data-pk="<?php echo $this->session->userdata("id_user"); ?>" data-url="<?php echo base_url('kriteria_nilai'); ?>/live_edit/"><?php if(!empty($skala[0])) {echo $skala[0]->skala;} ?></a></td>
                            <?php if($this->session->userdata('role') == "admin") { ?><td><?php echo $u->dosen ?></td><?php } ?>
                            
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>UAS</td>
                            <td><a href="#" class="uas" data-name="uas" data-type="text" data-pk="<?php echo $this->session->userdata("id_user"); ?>" data-url="<?php echo base_url('kriteria_nilai'); ?>/live_edit/"><?php if(!empty($skala[1])) {echo $skala[1]->skala;} ?></a></td>
                            <?php if($this->session->userdata('role') == "admin") { ?><td><?php echo $u->dosen ?></td><?php } ?>
                            
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Tugas</td>
                            <td><a href="#" class="tugas" data-name="tugas" data-type="text" data-pk="<?php echo $this->session->userdata("id_user"); ?>" data-url="<?php echo base_url('kriteria_nilai'); ?>/live_edit/"><?php if(!empty($skala[2])) {echo $skala[2]->skala;} ?></a></td>
                            <?php if($this->session->userdata('role') == "admin") { ?><td><?php echo $u->dosen ?></td><?php } ?>
                            
                        </tr>
                        
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
</div>