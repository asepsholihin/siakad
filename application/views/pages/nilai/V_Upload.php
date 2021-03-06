<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js'); ?>"></script>

<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Upload Nilai</h4> 
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box p-5 text-center">
            
                <h4>Upload Nilai</h4>
                <p class="text-danger">*Gunakan file format <strong>.xlxs</strong></p>
                <a class="btn btn btn-rounded btn-info btn-outline" href="<?php echo base_url("excel/format.xlsx"); ?>">Download Contoh Format</a>
                
                <form method="post" action="<?php echo base_url('nilai'); ?>/upload" enctype="multipart/form-data">
                    <div class="col-md-4 offset-md-4 mt-5">
                        <label class="file">
                            <input type="file" name="file" required/>
                        </label>

                        <div class="form-group mt-4">
                            <input type="submit" class="btn btn-success btn-block" name="preview" value="Preview">
                        </div>
                    </div>
                </form>

                <?php
                    if(isset($_POST['preview'])){ 
                        if(isset($upload_error)){ 
                            echo "<div style='color: red;'>".$upload_error."</div>";
                            die;
                        }
                        
                        
                        echo "<form method='post' action='".base_url('nilai')."/import'>";
                        
                        
                        echo "<div style='color: red;' id='kosong'>
                        Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
                        </div>";
                        
                        echo "
                        <h4 class=\"mt-5 mb-4\"> <strong>Preview Data Nilai</strong> </h4>
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th class=\"text-left\" >NIS</th>
                                        <th class=\"text-left\" >Nama</th>
                                        <th>Kode Matkul</th>
                                        <th>NIDN Dosen</th>
                                        <th>Nama Dosen</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        <th>Tugas</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        
                        $numrow = 1;
                        $kosong = 0;
                        
                        foreach($sheet as $row) {  
                            $A = isset($row['A']) ? $row['A'] : '';
                            $B = isset($row['B']) ? $row['B'] : '';
                            $C = isset($row['C']) ? $row['C'] : '';
                            $D = isset($row['D']) ? $row['D'] : '';
                            $E = isset($row['E']) ? $row['E'] : '';
                            $F = isset($row['F']) ? $row['F'] : '';
                            $G = isset($row['G']) ? $row['G'] : '';
                            $H = isset($row['H']) ? $row['H'] : '';
                            
                            $nis = $A;
                            $nama = $B;
                            $kodematkul = $C;
                            $nidn = $D;
                            $dosen = $E;
                            $uts = $F;
                            $uas = $G;
                            $tugas = $H;
                            
                            
                            if(empty($nis) && empty($nama) && empty($kodematkul) && empty($nidn) && empty($dosen) && empty($uts) && empty($uas) && empty($tugas))
                                continue; 
                            
                            if($numrow > 1){
                                $nis_td = ( ! empty($nis))? "" : " class=\"bg-danger\"";
                                $nama_td = ( ! empty($nama))? "" : " class=\"bg-danger\"";
                                $kodematkul_td = ( ! empty($kodematkul))? "" : " class=\"bg-danger\"";
                                $nidn_td = ( ! empty($nidn))? "" : " class=\"bg-danger\"";
                                $dosen_td = ( ! empty($dosen))? "" : " class=\"bg-danger\"";
                                $uts_td = ( ! empty($uts))? "" : " class=\"bg-danger\"";
                                $uas_td = ( ! empty($uas))? "" : " class=\"bg-danger\"";
                                $tugas_td = ( ! empty($tugas))? "" : " class=\"bg-danger\"";
                            
                                if(empty($nis) or empty($nama) or empty($kodematkul) or empty($nidn) or empty($dosen) or empty($uts) or empty($uas) or empty($tugas)){
                                    $kosong++;
                                }
                                
                                echo "<tr>";
                                echo "<td align=\"left\" ".$nis_td.">".$nis."</td>";
                                echo "<td align=\"left\" ".$nama_td.">".$nama."</td>";
                                echo "<td".$kodematkul_td.">".$kodematkul."</td>";
                                echo "<td".$nidn_td.">".$nidn."</td>";
                                echo "<td".$dosen_td.">".$dosen."</td>";
                                echo "<td".$uts_td.">".$uts."</td>";
                                echo "<td".$uas_td.">".$uas."</td>";
                                echo "<td".$tugas_td.">".$tugas."</td>";
                                echo "</tr>";
                            }
                            
                            $numrow++;
                        }
                        
                        echo "
                                </tbody>
                            </table>
                        </div>";
                        
                        if($kosong > 0){
                        ?>  
                            <script>
                            $(document).ready(function(){
                                $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                                
                                $("#kosong").show();
                            });
                            </script>
                        <?php
                        } else { ?>
                            <script>
                            $(document).ready(function(){
                                $("#kosong").hide();
                            });
                            </script>
                            <?php
                            echo "<hr>";
                            
                            echo "<button class='btn btn-success mr-3' type='submit' name='import'>Import</button>";
                            echo "<a class='btn btn-danger' href='".base_url("nilai")."'>Cancel</a>";
                        }
                        
                        echo "</form>";
                    }
                    ?>
            
            </div>
        </div>
    </div>
</div>