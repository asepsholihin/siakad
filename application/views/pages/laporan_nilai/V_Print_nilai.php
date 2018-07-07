<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        margin: 3em;
    }
    table {
        border: 1px solid #ccc;
    }
    th,td {
        border: 1px solid #ccc;
    }
    table.no-border,table.no-border td {
        border: none;
    }
</style>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {

    $.extend( $.fn.dataTable.defaults, {
        "language": {
            "paginate": {
            "previous": "Kembali",
            "next": "Selanjutnya"
            },
            "search": "Cari",
            "zeroRecords": "Data tidak ditemukan",
            "emptyTable": "Tidak ada data"
        },
        "info": false,
        "lengthChange": false
    });

    $('#data').DataTable({
        "order": [[ 6, "desc" ]],
        "paging": false,
        "info": false,
        "searching": false
    });
});
</script>

<div class="text-center">
    <h4>EVALUASI KELULUSAN PROGRAM PENDIDIKAN</h4>
    <h5>JURUSAN/PROGRAM STUDI : MANAJEMEN INFORMATIKA</h5>
    <p>Tahun Akademik 2015/2016</p>
</div>

<div class="text-left mb-2">
    Semester : <?php echo $this->uri->segment(3); ?>
</div>
<table id="data" class="table display">
    <thead>
        <tr class="text-center">
            <th>Nama</th>
            <th >NIM</th>
            <?php
            $jml_matkul = $this->db->query("SELECT nama, sks FROM matkul WHERE semester='".$this->uri->segment(3)."'")->num_rows();
            ?>
            <?php
            $query = $this->db->query("SELECT nama, sks FROM matkul WHERE semester='".$this->uri->segment(3)."'")->result();
            foreach($query as $matkul) {
            ?>
            <th><?php echo $matkul->nama. "<br> SKS(" .$matkul->sks.")"; ?></th>
            <?php } ?>
            <th >Jumlah BBT</th>
            <th >IPS</th>
            <th align="center">Nilai<br>D</th>
            <th align="center">Nilai<br>E</th>
            <th >STAT</th>
            <th >PER</th></td>
        </tr>
    </thead>
    <tbody>
    <?php 
    $peringkat = 1;
    foreach($mahasiswa as $row) { 
    
        $nilais = $this->M_Nilai->transkrip_all($row->nim)->result();
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
        <tr class="text-center">
            <td class="text-left"><?php echo $row->nama; ?></td>
            <td><?php echo $row->nim; ?></td>
            <td><?php echo $nilai_matkul['Statistika']; ?></td>
            <td><?php echo $nilai_matkul['Ekonomi Mikro']; ?></td>
            <td><?php echo $nilai_matkul['Ekonomi Makro']; ?></td>
            <td><?php echo $bbt; ?></td>
            <td><?php echo $bbt/6; ?></td>
            <td><?php echo $jml_d; ?></td>
            <td><?php echo $jml_e; ?></td>
            <td><?php echo $lulus; ?></td>
            <td><?php echo $peringkat; ?></td>
        </tr>
    <?php 
    $peringkat++;
    } ?>
    </tbody>
</table>

<table cellpadding="6" class="no-border">
    <tr>
        <td>IPP</td>
        <td>:</td>
        <td>Indeks Prestasi Praktik</td>
    </tr>
    <tr>
        <td>IPT</td>
        <td>:</td>
        <td>Indeks Prestasi Praktik</td>
    </tr>
    <tr>
        <td>IPS</td>
        <td>:</td>
        <td>Indeks Prestasi Praktik</td>
    </tr>
    <tr>
        <td>STA</td>
        <td>:</td>
        <td>Status Kelulusan</td>
    </tr>
    <tr>
        <td>PER</td>
        <td>:</td>
        <td>Peringkat</td>
    </tr>
    <tr>
        <td>PL</td>
        <td>:</td>
        <td>Peringatan Lisan</td>
    </tr>
    <tr>
        <td>PT</td>
        <td>:</td>
        <td>Peringatan Tertulis</td>
    </tr>
</table>
</div>
