<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part text-center">
            <a class="text-dark" href="index.html">
                <b>
                    SIAKAD
                </b>
            </a>
        </div>
        
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
                <a class="profile-pic" href="#"><?php echo $this->session->userdata("nama"); ?></a>
            </li>
            <li>
                <a href="<?php echo base_url('login/logout'); ?>">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
        </div>
        <ul class="nav" id="side-menu">
            <li style="padding: 60px 0 0">
                <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
            </li>
            <?php 
            if($this->session->userdata("role") == "admin") { 
            ?>
            <li>
                <a href="<?php echo base_url('mahasiswa'); ?>"></i>Mahasiswa</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "admin") { 
            ?>
            <li>
                <a href="<?php echo base_url('prodi'); ?>">Program Studi</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "admin") { 
            ?>
            <li>
                <a href="<?php echo base_url('dosen'); ?>">Dosen</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "admin") { 
            ?>
            <li>
                <a href="<?php echo base_url('matkul'); ?>">Mata Kuliah</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "dosen" || $this->session->userdata("role") == "kajur" || $this->session->userdata("role") == "dosen_wali") { 
            ?>
            <li>
                <a href="<?php echo base_url('kriteria_nilai'); ?>">Kriteria Nilai</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "dosen" || $this->session->userdata("role") == "kajur" || $this->session->userdata("role") == "dosen_wali") { 
            ?>
            <li>
                <a href="<?php echo base_url('nilai'); ?>">Nilai</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "admin" || $this->session->userdata("role") == "dosen" || $this->session->userdata("role") == "kajur" || $this->session->userdata("role") == "dosen_wali") { 
            ?>
            <li>
                <a href="<?php echo base_url('laporan_nilai'); ?>">Laporan Nilai</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "admin" || $this->session->userdata("role") == "kajur") { 
            ?>
            <li>
                <a href="<?php echo base_url('referensi_kuisioner'); ?>">Referensi Kuisioner</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "mahasiswa") { 
            ?>
            <li>
                <?php
                    $cek = $this->db->get_where('kuisioner', array('id_mahasiswa' => $this->session->userdata("id_user")));
                    if($cek->num_rows() > 0) {
                ?>
                    <a href="<?php echo base_url('laporan_kuisioner'); ?>/hasil_kuisioner/<?php echo $this->session->userdata("id_user") ?>">Kuisioner</a>
                <?php } else { ?>
                    <a href="<?php echo base_url('kuisioner'); ?>">Kuisioner</a>
                <?php } ?>
            </li>
            <?php }
            if($this->session->userdata("role") == "admin" || $this->session->userdata("role") == "dosen" || $this->session->userdata("role") == "kajur" || $this->session->userdata("role") == "dosen_wali") { 
            ?>
            <li>
                <a href="<?php echo base_url('laporan_kuisioner'); ?>">Laporan Kuisioner</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "mahasiswa") { 
            ?>
            <li>
                <a href="<?php echo base_url('profil'); ?>">Profil</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "mahasiswa") { 
            ?>
            <li>
                <a href="<?php echo base_url('nilai'); ?>/transkrip_nilai/<?php echo $this->session->userdata("id_user") ?>">Transkrip Nilai</a>
            </li>
            <?php }
            if($this->session->userdata("role") == "admin") { 
            ?>
            <li>
                <a href="<?php echo base_url('user'); ?>">User</a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>