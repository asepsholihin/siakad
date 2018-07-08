<?php 
 
class M_Nilai extends CI_Model{
	function get_data($id_matkul,$semester){
		$query = $this->db->query("
		SELECT nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria.tugas/100 ELSE '' END) AS total_tugas,
		mahasiswa.nim,
		mahasiswa.nama, 
		nilai.id_matkul FROM nilai
        JOIN kriteria ON nilai.id_matkul = kriteria.id_matkul
		RIGHT JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim AND nilai.id_matkul='".$id_matkul."' WHERE mahasiswa.semester='".$semester."'
		GROUP BY mahasiswa.nim");
		
		return $query->result();
	}

	function get_data_kelas($id_dosen, $id_matkul, $semester){

		if($this->session->userdata('role') == "dosen") {
			$where = "nilai.id_dosen LIKE '%".$id_dosen."%' AND ";
		} else if($this->session->userdata('role') == "dosen_wali") {
			$where = "mahasiswa.id_dosen LIKE '%".$id_dosen."%' AND ";
		} else if($this->session->userdata('role') == "kajur") {
			$join = "JOIN dosen ON dosen.id_prodi = mahasiswa.id_prodi";
			$group = "GROUP BY nilai.id_matkul";
		}
			

		$query = $this->db->query("
		SELECT nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria.tugas/100 ELSE '' END) AS total_tugas,
		mahasiswa.nim,
		mahasiswa.nama,
		nilai.id_matkul
		FROM nilai 
		RIGHT JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		".$join."
		JOIN kriteria ON nilai.id_dosen = kriteria.id_dosen AND nilai.id_matkul='".$id_matkul."' WHERE ".$where." nilai.semester='".$semester."' ".$group."
		GROUP BY mahasiswa.nim");
		return $query->result();
	}

	function transkrip($nim){
		return $query = $this->db->query("
		SELECT mahasiswa.nim, mahasiswa.nama, matkul.kode, matkul.nama as matkul, matkul.sks, nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria.tugas/100 ELSE '' END) AS total_tugas
		FROM nilai
		JOIN matkul ON nilai.id_matkul = matkul.id
		JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		JOIN kriteria ON nilai.id_matkul = kriteria.id_matkul AND mahasiswa.nim='".$nim."'
		JOIN kuisioner ON kuisioner.id_mahasiswa = nilai.id_mahasiswa AND kuisioner.id_matkul = nilai.id_matkul
		GROUP BY nilai.id_matkul");
	}

	function transkrip_all($nim){
		return $query = $this->db->query("
		SELECT mahasiswa.nim, mahasiswa.nama, matkul.kode, matkul.nama as matkul, matkul.sks, nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria.tugas/100 ELSE '' END) AS total_tugas
		FROM nilai
		JOIN matkul ON nilai.id_matkul = matkul.id
		JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		JOIN kriteria ON nilai.id_matkul = kriteria.id_matkul AND mahasiswa.nim='".$nim."'
		JOIN kuisioner ON kuisioner.id_mahasiswa = nilai.id_mahasiswa AND kuisioner.id_matkul = nilai.id_matkul
		GROUP BY nilai.id_matkul");
	}

	function print_transkrip($nim, $semester){
		return $query = $this->db->query("
		SELECT matkul.kode, matkul.nama as matkul, matkul.sks, nilai.uts, nilai.uas, nilai.tugas,
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria.tugas/100 ELSE '' END) AS total_tugas
		FROM nilai
		JOIN matkul ON nilai.id_matkul = matkul.id
		JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		JOIN kriteria ON nilai.id_matkul = kriteria.id_matkul AND mahasiswa.nim='".$nim."'
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

	function ambil_kriteria_nilai() {
		$this->db->select('id, nama');
		$this->db->from('kriteria_nilai');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result();
	}

	function ambil_prodi() {
		$this->db->select('id, nama');
		$this->db->from('prodi');
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[$row->id] = $row->nama;
		}
		return $return;
	}
	
	function ambil_matkul() {
		$this->db->select('id, matkul.nama');
		$this->db->from('matkul');
		$this->db->join('dosen', 'dosen.id_matkul = matkul.id', 'LEFT');
		// if(!empty($this->session->userdata("id_user"))) {
		// 	$this->db->where('dosen.nidn', $this->session->userdata("id_user"));
		// }
		
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[0] = "Pilih Mata Kuliah";
			$return[$row->id] = $row->nama;
		}
		return $return;
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
}