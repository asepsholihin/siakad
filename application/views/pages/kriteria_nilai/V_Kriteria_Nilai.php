<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Kriteria Nilai</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            
                <div class="box-title float-right"><a href="<?php echo base_url('kriteria_nilai/input');?>" class="btn btn-outline-info">+</a></div>
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
                                <a href="<?php echo base_url('kriteria_nilai/hapus/'.$u->id.'');?>" class="btn btn-outline-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
</div>