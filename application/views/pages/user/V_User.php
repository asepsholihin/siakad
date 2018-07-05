<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data User</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            
                <div class="box-title float-right"><a href="<?php echo base_url('user/input');?>" class="btn btn-outline-info">+</a></div>
                <h3 class="box-title">User</h3>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Hak Akses</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($user as $u){ 
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $u->username ?></td>
                            <td><?php echo $u->mahasiswa ?> <?php echo $u->dosen ?></td>
                            <td><?php echo $u->role ?></td>
                            <td>
                                <a href="<?php echo base_url('user/edit/'.$u->id.'');?>" class="btn btn-outline-warning">Edit</a>
                                <a href="<?php echo base_url('user/hapus/'.$u->id.'');?>" class="btn btn-outline-danger">Hapus</a>
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