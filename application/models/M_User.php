<?php 
 
class M_User extends CI_Model{	
	function get_data(){
		$this->db->select('users.*, mahasiswa.nama as mahasiswa, dosen.nama as dosen');
		$this->db->from('users');
		$this->db->join('mahasiswa', 'mahasiswa.nim = users.id_user', 'LEFT');
		$this->db->join('dosen', 'dosen.nidn = users.id_user', 'LEFT');
		return $this->db->get();

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