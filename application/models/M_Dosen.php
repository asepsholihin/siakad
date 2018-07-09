<?php 
 
class M_Dosen extends CI_Model{	
	function get_data(){
		$this->db->select('dosen.*, prodi.nama as prodi');
		$this->db->from('dosen');
		$this->db->join('prodi', 'prodi.id = dosen.id_prodi');
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

	function ambil_dosen() {
		$query = $this->db->get('dosen');
		foreach ($query->result() as $row)
		{
			$return[$row->nidn] = $row->nama;
		}
		return $return;
	}

	function ambil_jabatan() {
		return array(
			'Dosen' => 'Dosen',
			'Wali Kelas' => 'Wali Kelas',
			'Ketua Jurusan' => 'Ketua Jururan',
			'Wakil Direktur 1' => 'Wakil Direktur 1'
		);
	}
}