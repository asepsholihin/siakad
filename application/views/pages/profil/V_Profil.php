<?php
    $this->db->select('mahasiswa.*');
    $this->db->from('users');
    $this->db->join('mahasiswa', 'mahasiswa.nim = users.id_user');
    $this->db->where('mahasiswa.nim', $this->session->userdata("id_user"));
    $user = $this->db->get()->row();
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Profil</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg">
                                <div class="overlay-box">
                                    <div class="user-content">
    <a href="javascript:void(0)"><img src="<?php echo base_url()?>assets/images/<?php if($user->jk == "L") { ?>male<?php } else { ?>female<?php } ?>.png" class="thumb-lg img-circle" alt="img"></a>
                                        <h4 class="text-white mt-2"><?php echo $user->nama ?></h4>
                                        <h5 class="text-white"><?php echo $user->nim ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <form class="form-horizontal form-material">
                            <div class="form-group">
                                <label class="col-md-12">Nama Lengkap</label>
                                <div class="col-md-12">
                                    <input type="text" disabled value="<?php echo $user->nama ?>" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Jenis Kelamin</label>
                                <div class="col-md-12">
                                    <input type="text" disabled value="<?php if($user->jk == 'L') { ?>Laki-laki<?php } else { ?>Perempuan<?php }?>" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Tempat Lahir</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled value="<?php echo $user->tmp_lahir ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12">Tanggal Lahir</label>
                                        <div class="col-md-12">
                                            <input type="text" disabled value="<?php echo $user->tgl_lahir ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>