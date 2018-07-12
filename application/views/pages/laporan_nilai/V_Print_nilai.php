<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        margin: 1em;
        font-size: 12px;
    }
    table {
        border: 1px solid #ccc;
    }
    th,td {
        font-size: 12px;
        border: 1px solid #ccc;
    }
    table.no-border,table.no-border td {
        border: none;
    }
    .logo-icon {
        height: 28px;
        margin: 0 6px 4px 0;
    }
</style>
<script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    window.print();

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

<?php
    $q_prodi = $this->db->get_where('prodi', array('id'=> $id_prodi));
?>

<div class="text-center">

    <h6><img class="logo-icon" src="<?php echo base_url('assets/images/logo.png') ?>" alt="Logo"> Politeknik Negeri Subang</h6>

    <hr  style="margin: 30px;border: 1px double #5ca969;">

    <h5>EVALUASI KELULUSAN PROGRAM PENDIDIKAN</h5>
    <h6>JURUSAN/PROGRAM STUDI : <?php echo strtoupper($q_prodi->row()->nama); ?></h6>
    <p>Tahun Akademik <?php echo date('Y') ;?>/<?php echo date('Y')+1; ?></p>
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
    $ips = array();
    foreach($mahasiswa as $row) { 
    
        $nilais = $this->M_Laporan_Nilai->print_transkrip($row->nim, $this->uri->segment(3), $id_prodi)->result();
        //echo $this->db->last_query();
        $sks = array();
        $nilai = array();
        $nilai_matkul = array();
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
        $bbt = array_sum($nilai);
        $jml_sks = array_sum($sks);

        $ips[] = ($bbt/$jml_sks);
        

        if($bbt != 0) {
            if($jml_d <=4 && $jml_e == 0) {
                $lulus = "Tetap";
            } else if($jml_d >= 8 && $jml_e == 0) {
                $lulus = "Percobaan";
            } else if($jml_d > 8 || $jml_e > 0) {
                $lulus = "Tidak Lulus";
            } else if($jml_e > 0) {
                $lulus = "Tidak Lulus";
            }
        } else {
            $lulus = "";
        }
    ?>
        <tr class="text-center">
            <td class="text-left"><?php echo $row->nama; ?></td>
            <td><?php echo $row->nim; ?></td>
            <?php
            $query = $this->db->query("SELECT nama, sks FROM matkul WHERE semester='".$this->uri->segment(3)."'")->result();
            foreach($query as $matkul) {
            ?>
            <td><?php echo $nilai_matkul[$matkul->nama]; ?></td>
            <?php } ?>
            <td><?php echo $bbt; ?></td>
            <td><?php if($bbt != 0) { echo number_format($bbt/$jml_sks, 2, ',', ''); } else { echo 0; } ?></td>
            <td><?php echo $jml_d; ?></td>
            <td><?php echo $jml_e; ?></td>
            <td><?php echo $lulus; ?></td>
            <td><?php echo $peringkat; ?></td>
        </tr>
    <?php 
    $peringkat++;
    } ?>
        <?php 
            $ttl_ips = array_sum($ips);
            $ttl_mhs = count($mahasiswa);

            
        ?>
        <tr>
            <td colspan="2">Total IPS</td>
            <td colspan="9"><?php echo number_format($ttl_ips,2, ',', '') ?></td>
        </tr>
        <tr>
            <td colspan="2">Rata-rata IPS</td>
            <td colspan="9"><?php echo number_format($ttl_ips/$ttl_mhs,2, ',', '');?></td>
        </tr>
    </tbody>
</table>



<table cellpadding="30" class="no-border">
    <tr>
        <td valign="top">
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
            </table>
        </td>
        <td>
            <table cellpadding="6" class="no-border">
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
        </td>
    </tr>
</table>
</div>
