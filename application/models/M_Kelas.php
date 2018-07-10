<?php 
 
class M_Kelas extends CI_Model{	
	function get_data(){
		$this->db->select('kelas.*, dosen.nama as dosen, prodi.nama as prodi, jurusan.nama as jurusan');
		$this->db->from('kelas');
		$this->db->join('dosen', 'dosen.nidn = kelas.id_dosen');
		$this->db->join('prodi', 'prodi.id = kelas.id_prodi');
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
	
	function ambil_kelas() {
		$this->db->select('id, nama');
		$this->db->from('kelas');
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[''] = 'Pilih Kelas';
			$return[$row->id] = $row->nama;
		}
		return $return;
	}

	function ambil_kelas_jurusan($id_prodi) {
		$this->db->select('kelas.id, kelas.nama');
		$this->db->from('kelas');
		$this->db->join('prodi', 'prodi.id = kelas.id_prodi');
		$this->db->join('jurusan', 'jurusan.id = prodi.id_jurusan');
		$this->db->where('kelas.id_prodi', $id_prodi);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[''] = 'Pilih Kelas';
			$return[$row->id] = $row->nama;
		}
		return $return;
	}
}