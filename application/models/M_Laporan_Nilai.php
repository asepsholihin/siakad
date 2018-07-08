<?php 
 
class M_Laporan_Nilai extends CI_Model{

	function print_transkrip($nim, $semester){
		return $query = $this->db->query("
		SELECT matkul.kode, matkul.nama as matkul, matkul.sks, nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria.tugas/100 ELSE '' END) AS total_tugas
		FROM nilai
		JOIN matkul ON nilai.id_matkul = matkul.id
		JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		JOIN kriteria ON nilai.id_matkul = kriteria.id_matkul AND mahasiswa.nim='".$nim."' WHERE nilai.semester='".$semester."'
		GROUP BY nilai.id_matkul");
	}
}