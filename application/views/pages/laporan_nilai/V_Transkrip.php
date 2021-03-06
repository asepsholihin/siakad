<?php
    $this->db->select('mahasiswa.*, prodi.nama as prodi');
    $this->db->from('mahasiswa');
    $this->db->join('kelas', 'kelas.id = mahasiswa.id_kelas');
    $this->db->join('prodi', 'prodi.id = kelas.id_prodi');
    $this->db->where('mahasiswa.nim', $this->uri->segment(3));
    $user = $this->db->get()->row();
?>

<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        min-height:100vh;
        height:100vh;
        font-size: 12px;
    }
    table {
        border: 1px solid #ccc;
    }
    .table th {
        border: 0;
        background: transparent !important;
    }
    th,td {
        font-size: 12px;
        border: 0;
    }
    table.no-border,table.no-border td {
        border: none;
    }
    table.t-padding td {
        padding: 4px 10px 4px 0;
    }
    p {
        margin: 0;
    }
</style>

<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function() {
    window.print();
});
</script>

<?php
function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
?>

<div class="row" style="padding:0em 1em; height:100vh;background:url(<?php echo base_url(); ?>assets/images/bg.png) no-repeat center;">
    <div class="col-md-12 p-5" style="border: 5px double #5ca969;">
        <div class="col-md-12 text-center mb-5" style="border: 2px solid #5ca969;">
            <div class="row">
                <div class="col-md-2">
                    <img src="<?php echo base_url(); ?>assets/images/logo.png" style="height:84px;width: 84px;margin: 10px;" class="img-fluid" alt="">
                </div>
                <div class="col-md-8 pt-3">
                    <h5 class="mt-2">POLITEKNIK NEGERI SUBANG</h5>
                    <h6 class="mt-1">LAPORAN NILAI SEMESTER</h6>
                </div>
            </div>
        </div>
        <div class="col-md-12">
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
                <tr>
                    <td>Nilai Semester</td>
                    <td>:</td>
                    <td><?php echo $semester ?></td>
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
                    foreach($transkrip as $row) { 

                        $nilai_akhir = $row->total_uts+$row->total_uas+$row->total_tugas;
                        $nilai_mutu = $this->M_Nilai->grading($nilai_akhir);
                        $arr_nilai_mutu[] = $this->M_Nilai->grading_angka($nilai_mutu) * $row->sks;
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
                    $nilais = $this->M_Laporan_Nilai->print_transkrip($user->nim, $semester, $id_prodi)->result();
                    $sks = array();
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
                        $sks[] = $row1->sks;

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
                    if($jml_d <= 4 && $jml_e <= 0) {
                        $lulus = "Tetap";
                    } else if($jml_d >= 8 && $jml_e <= 0) {
                        $lulus = "Percobaan";
                    } else if($jml_d > 8 || $jml_e > 0) {
                        $lulus = "Tidak Lulus";
                    } else if($jml_e > 0) {
                        $lulus = "Tidak Lulus";
                    }
                    $bbt = array_sum($nilai);
                    $jml_sks = array_sum($sks);
                ?>

                <table class="no-border mt-5 t-padding">
                    <tr>
                        <td>Satuan Kredit Semester (SKS)</td>
                        <td>:</td>
                        <td><?php echo $jml_sks; ?></td>
                    </tr>
                    <tr>
                        <td>Index Prestasi Semester (IPS)</td>
                        <td>:</td>
                        <td><?php if($bbt != 0) { echo number_format($bbt/$jml_sks, 2, ',', ''); } else { echo 0; } ?></td>
                    </tr>
                    <tr>
                        <td>Stauan Kelulusana</td>
                        <td>:</td>
                        <td><?php echo $lulus ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 offset-md-7 mt-1">
                <p>Subang, <?php echo tanggal_indo(date('Y-m-d')); ?></p>
                <p>Wakil Direktur 1,</p>
                <br><br><br>

                <?php $wadir = $this->db->get_where('dosen', array('jabatan' => 'Wakil Direktur 1'))->row() ?>
                <p><?php echo $wadir->nama ?></p>
                <p>NIP. <?php echo $wadir->nidn ?></p>
            </div>
        </div>
    </div>
</div>