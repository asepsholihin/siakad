<?php

$query = $this->db->query("SELECT id_kategori, kategori_kuisioner.nama as kategori FROM referensi_kuisioner JOIN kategori_kuisioner ON referensi_kuisioner.id_kategori=kategori_kuisioner.id WHERE jenis='pilihan' GROUP BY id_kategori")->result();

$kategori = array();
$query3 = array();
foreach($query as $row) {
    
    $query1 = $this->db->query("SELECT concat(kode, id) as field FROM referensi_kuisioner WHERE jenis='pilihan' AND id_kategori='".$row->id_kategori."'")->result();
    $field = array();
    foreach($query1 as $row1) {
        
        $field[] = $row1;

    }
    $kategori[] = $row->kategori;

    $fields = '';
    $per = '';
    for($i=0;$i<count($field);$i++){

        $fields .= 'SUM('.$field[$i]->field.')+';
        $per = count($field);
    }
    
    
    if($this->session->userdata('role') == 'admin') {
        $query3[] = $this->db->query("SELECT (".rtrim($fields, '+').")/".$per." as jumlah  FROM kuisioner WHERE id_dosen LIKE '%".$this->uri->segment(3)."%' AND id_matkul='".$id_matkul."'")->row()->jumlah;
    } else {
        $query3[] = $this->db->query("SELECT (".rtrim($fields, '+').")/".$per." as jumlah  FROM kuisioner WHERE id_dosen LIKE '%".$this->session->userdata('id_user')."%' AND id_matkul='".$id_matkul."'")->row()->jumlah;
    }
    
}
?>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Grafik Hasil Kuisioner</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                
                <h3 class="box-title text-center">Grafik Kuisioner</h3>

                <div class="row">
                    <?php if($this->session->userdata('role') == 'admin') { ?>
                    <div class="col-md-2 offset-md-4 mb-4">
                    <?php
                        $js = 'class="form-control" id="id_dosen" onChange="window.location = \''.base_url('laporan_kuisioner').'/matkul/\' + $(this).val()+\'/\'+$(\'#id_matkul\').val()"'; 
                        $dosen[''] = 'Pilih Dosen';
                        echo form_dropdown('id_dosen', $dosen, $this->uri->segment(3), $js);
                    ?>
                    </div>
                    <div class="col-md-2 mb-4">
                    <?php
                        $js = 'class="form-control" id="id_matkul" onChange="window.location = \''.base_url('laporan_kuisioner').'/matkul/\' + $(\'#id_dosen\').val()+\'/\'+$(this).val()"'; 
                        echo form_dropdown('id_matkul', $matkul, $this->uri->segment(4), $js);
                    ?>
                    </div>
                    <?php } ?>
                    <?php if($this->session->userdata('role') != 'admin') { ?>
                        <div class="col-md-4  offset-md-4  mb-4">
                        <?php
                            $js = 'class="form-control" id="id_matkul" onChange="window.location = \''.base_url('laporan_kuisioner').'/matakuliah/\' + $(this).val()"'; 
                            echo form_dropdown('id_matkul', $matkul, $this->uri->segment(3), $js);
                        ?>
                        </div>
                    <?php } ?>
                </div>

                <canvas id="myChart"></canvas>
            
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>
<script>
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($kategori); ?>,
        datasets: [{
            label: 'Kuisioner',
            data: <?php echo json_encode($query3); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>