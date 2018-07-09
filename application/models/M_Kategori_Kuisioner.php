<?php 
 
class M_Kategori_Kuisioner extends CI_Model{	
	function get_data(){
		return $this->db->get('kategori_kuisioner');
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
	
	function ambil_kategori_kuisioner() {
		$this->db->select('id, nama');
		$this->db->from('kategori_kuisioner');
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[$row->id] = $row->nama;
		}
		return $return;
	}
}