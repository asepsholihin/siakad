<?php 
 
class M_Nilai extends CI_Model{
	function get_data($id_matkul){
		$query = $this->db->query("
		SELECT
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts ELSE '' END) AS uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas ELSE '' END) AS uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas ELSE '' END) AS tugas,
		(CASE WHEN nilai.grade IS NOT NULL THEN nilai.grade ELSE '' END) AS grade,
		mahasiswa.nim,
		mahasiswa.nama, nilai.id_matkul FROM nilai
		RIGHT JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim AND nilai.id_matkul=".$id_matkul."");
		if($query->num_rows()==0){
			return FALSE;
		} 
		else{
			return $query->result();
		}
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
		$this->db->select('id, nama');
		$this->db->from('matkul');
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[''] = "Pilih Mata Kuliah";
			$return[$row->id] = $row->nama;
		}
		return $return;
	}
}