<?php 
 
class M_Mahasiswa extends CI_Model{	
	function get_data(){
		$this->db->select('mahasiswa.*, prodi.nama as prodi, kelas.nama as kelas');
		$this->db->from('mahasiswa');
		$this->db->join('kelas', 'kelas.id = mahasiswa.id_kelas');
		$this->db->join('prodi', 'prodi.id = kelas.id_prodi');
		$this->db->order_by('mahasiswa.nim'); 
		$query = $this->db->get();
		return $query->result();
	}

	function profil($id) {
		$this->db->select('mahasiswa.*, prodi.nama as prodi, kelas.nama as kelas');
		$this->db->from('mahasiswa');
		$this->db->join('kelas', 'kelas.id = mahasiswa.id_kelas');
		$this->db->join('prodi', 'prodi.id = kelas.id_prodi');
		$this->db->where('mahasiswa.nim', $id);
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
}