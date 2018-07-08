<?php
    $this->db->select('mahasiswa.*, prodi.nama as prodi');
    $this->db->from('users');
    $this->db->join('mahasiswa', 'mahasiswa.nim = users.id_user');
    $this->db->join('prodi', 'mahasiswa.id_prodi = prodi.id');
    $this->db->where('mahasiswa.nim', $this->uri->segment(3));
    $user = $this->db->get()->row();
?>

<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<style>
    table {
        border: 1px solid #ccc;
    }
    .table th {
        border: 0;
    }
    th,td {
        border: 0;
    }
    table.no-border,table.no-border td {
        border: none;
    }
    table.t-padding td {
        padding: 4px 10px 4px 0;
    }
</style>

<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function() {
    window.print();
});
</script>

<div class="row">
    <div class="col-md-8 offset-2 text-center my-5" style="border: 2px solid #555;">
        <h4 class="mt-2">POLITEKNIK NEGERI SUBANG</h4>
        <h5 class="mt-1">LAPORAN NILAI SEMESTER</h5>
    </div>
    <div class="col-md-8 offset-md-2">
        <table class="mb-4 no-border t-padding" border="0">
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td><?php echo $user->prodi ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo $user->nama ?></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td><?php echo $user->nim ?></td>
            </tr>
        </table>
        <div class="table-responsive">
            <table class="table no-border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th class="text-center">SKS</th>
                        <!-- <th class="text-center">Nilai Akhir</th> -->
                        <th class="text-center">Nilai Mutu</th>
                        <th class="text-center">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                $arr_nilai_mutu = array();
                $jml_sks = array();
                foreach($transkrip as $row) { 

                    $nilai_akhir = $row->total_uts+$row->total_uas+$row->total_tugas;
                    $nilai_mutu = $this->M_Nilai->grading($nilai_akhir);
                    $arr_nilai_mutu[] = $this->M_Nilai->grading_angka($nilai_mutu) * $row->sks;
                    $jml_sks[] = $row->sks;
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row->kode ?></td>
                        <td><?php echo $row->matkul ?></td>
                        <td class="text-center"><?php echo $row->sks ?></td>
                        <!-- <td class="text-center"><?php echo $nilai_akhir ?></td> -->
                        <td class="text-center"><?php echo $nilai_mutu ?></td>
                        <td class="text-center"><?php echo $this->M_Nilai->grading_angka($nilai_mutu) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <?php 
                $nilais = $this->M_Nilai->transkrip_all($user->nim)->result();
                //echo json_encode($nilais);
                $nilai = array();
                $nilai_matkul = array();
                $ips = array();
                $arr_nilai_D = array();
                $arr_nilai_E = array();
                foreach($nilais as $row1) {
                    $nilai_akhir = $row1->total_uts+$row1->total_uas+$row1->total_tugas;
                    $nilai_index = $this->M_Nilai->grading($nilai_akhir);
                    $nilai_mutu = $this->M_Nilai->grading_angka($nilai_index);
                    
                    $nilai[] = $nilai_mutu*$row1->sks;
                    $nilai_matkul[$row1->matkul] = $nilai_mutu;

                    if($nilai_index == "D") {
                        $arr_nilai_D[] = 1;
                        $jml_d = array_sum($arr_nilai_D);
                    }
                    if($nilai_index == "E") {
                        $arr_nilai_E[] = 1;
                        $jml_e = array_sum($arr_nilai_E);
                    }
                }
                $jml_d = array_sum($arr_nilai_D);
                $jml_e = array_sum($arr_nilai_E);
                if($jml_d <= 4 || $jml_e < 0) {
                    $lulus = "Tetap";
                } else if($jml_d >= 8 && $jml_e < 0) {
                    $lulus = "Percobaan";
                } else if($jml_d > 8 || $jml_e > 0) {
                    $lulus = "Tidak Lulus";
                } else if($jml_d > 0) {
                    $lulus = "Tidak Lulus";
                }
                $bbt = array_sum($nilai);
            ?>

            <table width="30%" class="no-border mt-5">
                <tr>
                    <td>Satuan Kredit Semester (SKS)</td>
                    <td>:</td>
                    <td><?php echo array_sum($jml_sks); ?></td>
                </tr>
                <tr>
                    <td>Index Prestasi Semester (IPS)</td>
                    <td>:</td>
                    <td><?php echo $bbt/6 ?></td>
                </tr>
                <tr>
                    <td>Stauan Kelulusan</td>
                    <td>:</td>
                    <td><?php echo $lulus ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>