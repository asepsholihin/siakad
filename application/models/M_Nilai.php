<?php 
 
class M_Nilai extends CI_Model{	
	function ambil_mahasiswa(){
		$query = $this->db->get('mahasiswa');
		return $query->result();
	}
	function ambil_nilai($id_mahasiswa, $id_matkul){
		$query = $this->db->query("SELECT uts,uas,tugas FROM nilai WHERE id_mahasiswa='".$id_mahasiswa."' AND id_matkul='".$id_matkul."'");
		return $query->result();
	}
 
	function input_data($data, $table){
		$this->db->insert($table, $data);
	}

	function edit_data($where, $table){		
        return $this->db->get_where($table, $where);
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