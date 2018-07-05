<?php 
 
class M_Kriteria_Nilai extends CI_Model{	
	function get_data($id_dosen){
		if($id_dosen) {
			return $this->db->get_where('kriteria_nilai', array("id_dosen" => $id_dosen));
		} else {
			$this->db->select('kriteria_nilai.*, dosen.nama as dosen');
			$this->db->from('kriteria_nilai');
			$this->db->join('dosen', 'dosen.nidn = kriteria_nilai.id_dosen');
			return $this->db->get();
		}
		
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
}