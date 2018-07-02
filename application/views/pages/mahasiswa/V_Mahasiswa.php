<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Mahasiswa</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            
                <div class="box-title float-right"><a href="<?php echo base_url('mahasiswa/input');?>" class="btn btn-outline-info">+</a></div>
                <h3 class="box-title">Mahasiswa</h3>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($mahasiswa as $u){ 
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $u->nim ?></td>
                            <td><?php echo $u->nama ?></td>
                            <td><?php echo $u->id_prodi ?></td>
                            <td><?php echo $u->id_dosen ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
</div>