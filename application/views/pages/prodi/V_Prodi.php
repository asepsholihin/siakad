<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Program Studi</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            
                <div class="box-title float-right"><a href="<?php echo base_url('prodi/input');?>" class="btn btn-outline-info">+</a></div>
                <h3 class="box-title">Program Studi</h3>

                <div class="table-responsive">
                    <table id="data" class="display table pt-3">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Program Studi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($prodi as $u){ 
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $u->nama ?></td>
                            <td>
                                <a href="<?php echo base_url('prodi/edit/'.$u->id.'');?>" class="btn btn-outline-warning">Edit</a>
                                <a href="<?php echo base_url('prodi/hapus/'.$u->id.'');?>" class="btn btn-outline-danger">Hapus</a>
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