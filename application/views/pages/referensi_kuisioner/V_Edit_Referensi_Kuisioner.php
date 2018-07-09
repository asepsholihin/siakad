<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Edit Program Studi</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <?php foreach($referensi_kuisioner as $row) { ?>
                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('referensi_kuisioner/proses_edit'); ?>" method="post">
                    <div class="form-group">
                        <label for="id_kategori" class="col-md-12">Kategori</label>
                        <div class="col-md-12">
                            <?php echo form_dropdown('id_kategori', $kategori, $row->id_kategori, 'class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pertanyaan" class="col-md-12">Pertanyaan</label>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?php echo $row->id; ?>">
                            <input id="pertanyaan" type="text" name="pertanyaan" value="<?php echo $row->pertanyaan; ?>" class="form-control form-control-line" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jk" class="col-md-12">Jenis Pertanyaan</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" checked name="jenis" id="pilihan" value="pilihan" checked>
                                <label class="form-check-label" for="pilihan">Pilihan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis" id="esai" value="esai">
                                <label class="form-check-label" for="esai">Esai</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Simpan</button>
                            <a href="<?php echo base_url('referensi_kuisioner')?>" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
                <?php } ?>
            
            </div>
        </div>
    </div>
</div>