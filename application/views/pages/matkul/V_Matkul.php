<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Mata Kuliah</h4> 
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
            
                <div class="box-title float-right"><a href="<?php echo base_url('matkul/input');?>" class="btn btn-outline-info">+</a></div>
                <h3 class="box-title">Mata Kuliah</h3>

                <div class="table-responsive">
                    <table id="data" class="display table pt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Program Studi</th>
                                <th>Semester</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($matkul as $u){ 
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $u->kode ?></td>
                            <td><?php echo $u->nama ?></td>
                            <td><?php echo $u->sks ?></td>
                            <td><?php echo $u->prodi ?></td>
                            <td><?php echo $u->semester ?></td>
                            <td>
                                <a href="<?php echo base_url('matkul/edit/'.$u->id.'');?>" class="btn btn-outline-warning">Edit</a>
                                <a href="<?php echo base_url('matkul/hapus/'.$u->id.'');?>" class="btn btn-outline-danger">Hapus</a>
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