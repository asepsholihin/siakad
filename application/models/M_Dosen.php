<?php 
 
class M_Dosen extends CI_Model{	
	function get_data(){
		$this->db->select('dosen.*, prodi.nama as prodi, matkul.nama as matkul');
		$this->db->from('dosen');
		$this->db->join('prodi', 'prodi.id = dosen.id_prodi');
		$this->db->join('matkul', 'matkul.id = dosen.id_matkul');
		$query = $this->db->get();
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
			$return[$row->id] = $row->nama;
		}
		return $return;
	}

	function ambil_matkul_() {
		$dosen = $this->db->get_where('dosen', array("nidn" => $this->session->userdata('id_user')))->row();
		//
		$this->db->select('id, nama');
		$this->db->from('matkul');
		// if($this->session->userdata('role') != 'admin'){
		// 	$this->db->where("id IN ($dosen->matkul)");
		// }
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[0] = "Pilih Mata Kuliah";
			$return[$row->id] = $row->nama;
		}
		return $return;
	}
}