<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Data Kuisioner</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
            
                <h3 class="box-title">Kuisioner</h3>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Program Studi</th>
                                <th width="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $no = 1;
                            foreach($laporan_kuisioner as $u){ 
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $u->nim ?></td>
                            <td><?php echo $u->nama ?></td>
                            <td><?php echo $u->prodi ?></td>
                            <td><a href="<?php echo base_url('laporan_kuisioner') ?>/hasil_kuisioner/<?php echo $u->nim?>" class="btn btn btn-rounded btn-info btn-outline">Lihat kuisioner</a></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
        </div>
    </div>
</div>