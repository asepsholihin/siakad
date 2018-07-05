<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Tambah Program Studi</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">

                <form class="form-horizontal form-material" autocomplete="off" action="<?php echo base_url('referensi_kuisioner/proses_input'); ?>" method="post">
                    <div class="form-group">
                        <label for="kategori" class="col-md-12">Kategori</label>
                        <div class="col-md-12">
                            <input id="kategori" type="text" name="kategori" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pertanyaan" class="col-md-12">Pertanyaan</label>
                        <div class="col-md-12">
                            <input id="pertanyaan" type="text" name="pertanyaan" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jk" class="col-md-12">Jenis Pertanyaan</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" checked name="jenis" id="pilihan" value="pilihan">
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
                        </div>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
</div>