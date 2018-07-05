<?php 
 
class M_Kuisioner extends CI_Model{	
	function get_data(){
		return $this->db->get('kuisioner');
	}

	function kuisioner($where, $table){		
        return $this->db->get_where($table, $where);
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