<?php 
 
class M_Matkul extends CI_Model{	
	function get_data(){
		$this->db->select('matkul.*, prodi.nama as prodi');
		$this->db->from('matkul');
		$this->db->join('prodi', 'prodi.id = matkul.id_prodi');
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

	function ambil_matkul_dosen($id_dosen) {
		$dosen = $this->db->get_where('dosen', array('nidn'=>$id_dosen))->row();

		$this->db->select('DISTINCT(id), matkul.nama');
		$this->db->from('matkul');
		if($this->session->userdata('role') != 'admin') {
			$this->db->join('dosen', 'matkul.id IN ('.$dosen->matkul.')');
		}
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[''] = 'Pilih Mata Kuliah';
			$return[$row->id] = $row->nama;
		}
		return $return;
	}

	function ambil_matkul_mahasiswa($id_mahasiswa) {
		$mahasiswa = $this->db->get_where('mahasiswa', array('nim'=>$id_mahasiswa))->row();

		$this->db->select('DISTINCT(id), matkul.nama');
		$this->db->from('matkul');
		if($this->session->userdata('role') != 'admin') {
			$this->db->where('matkul.id IN ('.$mahasiswa->matkul.')');
		}
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[''] = 'Pilih Mata Kuliah';
			$return[$row->id] = $row->nama;
		}
		return $return;
	}

	function ambil_matkul_jurusan($id_prodi) {
		$this->db->select('DISTINCT(matkul.id), matkul.nama');
		$this->db->from('matkul');
		$this->db->join('prodi','prodi.id=matkul.id_prodi');
		$this->db->join('jurusan','jurusan.id=prodi.id_jurusan');
		$this->db->where("matkul.id_prodi='".$id_prodi."'");
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
			$return[''] = 'Pilih Mata Kuliah';
			$return[$row->id] = $row->nama;
		}
		return $return;
	}
}