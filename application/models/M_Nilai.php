<?php 
 
class M_Nilai extends CI_Model{
	function get_data($id_matkul,$kelas){
		$query = $this->db->query("
		SELECT nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria_nilai.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria_nilai.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria_nilai.tugas/100 ELSE '' END) AS total_tugas,
		mahasiswa.nim,
		mahasiswa.nama, 
		nilai.id_matkul FROM nilai
		JOIN kriteria_nilai ON nilai.id_matkul = kriteria_nilai.id_matkul 
		JOIN matkul ON nilai.id_matkul = matkul.id 
		RIGHT JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim AND nilai.id_matkul='".$id_matkul."' WHERE mahasiswa.id_kelas='".$kelas."'
		GROUP BY mahasiswa.nim");
		
		return $query->result();
	}

	function get_data_kelas($id_matkul, $id_kelas){
		$where = "WHERE mahasiswa.id_kelas='".$id_kelas."'";	

		$query = $this->db->query("
		SELECT nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria_nilai.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria_nilai.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria_nilai.tugas/100 ELSE '' END) AS total_tugas,
		mahasiswa.nim,
		mahasiswa.nama,
		nilai.id_matkul
		FROM nilai 
		RIGHT JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		JOIN kriteria_nilai ON nilai.id_dosen = kriteria_nilai.id_dosen AND nilai.id_matkul='".$id_matkul."' ".$where." GROUP BY mahasiswa.nim");
		return $query->result();
	}

	function transkrip($nim){
		return $query = $this->db->query("
		SELECT mahasiswa.nim, mahasiswa.nama, matkul.kode, matkul.nama as matkul, matkul.sks, nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria_nilai.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria_nilai.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria_nilai.tugas/100 ELSE '' END) AS total_tugas
		FROM nilai
		JOIN matkul ON nilai.id_matkul = matkul.id
		JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		JOIN kriteria_nilai ON nilai.id_matkul = kriteria_nilai.id_matkul AND mahasiswa.nim='".$nim."'
		JOIN kuisioner ON kuisioner.id_mahasiswa = nilai.id_mahasiswa AND kuisioner.id_matkul = nilai.id_matkul
		GROUP BY nilai.id_matkul");
	}

	function transkrip_all($nim){
		return $query = $this->db->query("
		SELECT mahasiswa.nim, mahasiswa.nama, matkul.kode, matkul.nama as matkul, matkul.sks, nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria_nilai.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria_nilai.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria_nilai.tugas/100 ELSE '' END) AS total_tugas
		FROM nilai
		JOIN matkul ON nilai.id_matkul = matkul.id
		JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		JOIN kriteria_nilai ON nilai.id_matkul = kriteria_nilai.id_matkul AND mahasiswa.nim='".$nim."'
		JOIN kuisioner ON kuisioner.id_mahasiswa = nilai.id_mahasiswa AND kuisioner.id_matkul = nilai.id_matkul
		GROUP BY nilai.id_matkul");
	}

	function print_transkrip($nim, $semester){
		return $query = $this->db->query("
		SELECT matkul.kode, matkul.nama as matkul, matkul.sks, nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria_nilai.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria_nilai.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria_nilai.tugas/100 ELSE '' END) AS total_tugas
		FROM nilai
		JOIN matkul ON nilai.id_matkul = matkul.id
		JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		JOIN kriteria_nilai ON nilai.id_matkul = kriteria_nilai.id_matkul AND mahasiswa.nim='".$nim."'
		JOIN kuisioner ON kuisioner.id_mahasiswa = nilai.id_mahasiswa AND kuisioner.id_matkul = nilai.id_matkul WHERE nilai.semester='".$semester."'
		GROUP BY nilai.id_matkul");
	}
 
	function insert_data($data, $table){
		$this->db->insert($table, $data);
	}

	function cek_nilai($where, $table){		
		$query = $this->db->get_where($table, $where);
		if($query->num_rows()==0){
			return FALSE;
		} 
		else{
			return $query->result();
		}
    }

    function update_data($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
    }
    
    function hapus_data($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
	}

	public function grading($nilai) {
		if($nilai >= 85) {
			return "A";
		}
		if(($nilai >= 78) && ($nilai <= 84.99)) {
			return "AB";
		}
		if($nilai >= 70 && $nilai <= 77.99) {
			return "B";
		}
		if($nilai >= 63 && $nilai <= 69.99) {
			return "BC";
		}
		if($nilai >= 55 && $nilai <= 62.99) {
			return "C";
		}
		if($nilai >= 40 && $nilai <= 54.99) {
			return "D";
		}
		if($nilai > 0 && $nilai <= 39.99) {
			return "E";
		}
		if($nilai == 0) {
			return "";
		}
	}

	public function grading_angka($nilai) {
		if($nilai == "A") {
			return 4;
		}
		if($nilai == "AB") {
			return 3.5;
		}
		if($nilai == "B") {
			return 3;
		}
		if($nilai == "BC") {
			return 2.5;
		}
		if($nilai == "C") {
			return 2;
		}
		if($nilai == "D") {
			return 1;
		}
		if($nilai == "E") {
			return 0;
		}
	}

	public function lulus($nilai) {
		if($nilai == "D" || $nilai == "E") {
			return "Tidak Lulus";
		} else {
			return "Lulus";
		}
	}

	function ambil_kelas($id_dosen) {
		$prodi = $this->db->get_where('dosen', array('nidn' => $id_dosen))->row();
		$this->db->select('id, nama');
		$this->db->from('kelas');
		$this->db->where('id_prodi', $prodi->id_prodi);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[''] = 'Pilih Kelas';
			$return[$row->id] = $row->nama;
		}
		return $return;
	}
}