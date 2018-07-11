<?php 
 
class M_Prodi extends CI_Model{	
	function get_data(){
		$this->db->select('prodi.*, jurusan.nama as jurusan');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.id_jurusan');
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

	function ambil_prodi_dosen() {
		$this->db->select('prodi.id, prodi.nama');
		$this->db->from('prodi');
		$this->db->join('dosen', 'dosen.id_prodi = prodi.id');
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[$row->id] = $row->nama;
		}
		return $return;
	}

	function ambil_prodi_jurusan($nidn) {
		$id_jurusan = $this->db->query("SELECT jurusan.id, jurusan.nama FROM prodi 
		LEFT JOIN dosen ON dosen.id_prodi = prodi.id
		JOIN jurusan ON jurusan.id = prodi.id
		WHERE dosen.nidn='".$nidn."'")->row()->id;

		$this->db->select('prodi.id, prodi.nama');
		$this->db->from('prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.id');
		$this->db->where(array('jurusan.id'=>$id_jurusan));
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[$row->id] = $row->nama;
		}
		return $return;
	}
}