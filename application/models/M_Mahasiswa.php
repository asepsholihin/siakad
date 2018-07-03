<?php 
 
class M_Mahasiswa extends CI_Model{	
	function get_data(){
		return $this->db->get('mahasiswa');
	}
 
	function input_data($data,$table){
		$this->db->insert($table,$data);
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
	
	function ambil_prodi() {
		$this->db->select('id, nama');
		$this->db->from('prodi');
		$query = $this->db->get();
		return $query->result();
	}
	
	function ambil_dosen() {
		$this->db->select('nidn, nama');
		$this->db->from('dosen');
		$query = $this->db->get();
		return $query->result();
	}
}