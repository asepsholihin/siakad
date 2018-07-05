<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Dosen</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            
                <div class="box-title float-right"><a href="<?php echo base_url('dosen/input');?>" class="btn btn-outline-info">+</a></div>
                <h3 class="box-title">Dosen</h3>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIDN</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Program Studi</th>
                                <th>Mata Kuliah</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($dosen as $u){ 
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $u->nidn ?></td>
                            <td><?php echo $u->nama ?></td>
                            <td><?php echo $u->jabatan ?></td>
                            <td><?php echo $u->prodi ?></td>
                            <td><?php echo $u->matkul ?></td>
                            <td>
                                <a href="<?php echo base_url('dosen/edit/'.$u->nidn.'');?>" class="btn btn-outline-warning">Edit</a>
                                <a href="<?php echo base_url('dosen/hapus/'.$u->nidn.'');?>" class="btn btn-outline-danger">Hapus</a>
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