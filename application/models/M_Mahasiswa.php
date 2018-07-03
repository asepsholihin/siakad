<?php 
 
class M_Mahasiswa extends CI_Model{	
	function get_data(){
		$this->db->select('mahasiswa.*, prodi.nama as prodi, dosen.nama as dosen_wali');
		$this->db->from('mahasiswa');
		$this->db->join('prodi', 'prodi.id = mahasiswa.id_prodi');
		$this->db->join('dosen', 'dosen.nidn = mahasiswa.id_dosen');
		$this->db->order_by('mahasiswa.nim'); 
		$query = $this->db->get();
		return $query->result();
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
		foreach ($query->result() as $row)
		{
			$return[$row->id] = $row->nama;
		}
		return $return;
	}
}