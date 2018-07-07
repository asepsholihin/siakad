<?php 
 
class M_Laporan_Kuisioner extends CI_Model{	
	function get_data($id_matkul){
        $this->db->select('mahasiswa.nama, mahasiswa.nim, prodi.nama as prodi');
        $this->db->from('kuisioner');
        $this->db->join('mahasiswa', 'mahasiswa.nim = kuisioner.id_mahasiswa');
        $this->db->join('prodi', 'prodi.id = mahasiswa.id_prodi');
        if($id_matkul != 0) {
            $this->db->where('kuisioner.id_matkul', $id_matkul);
        }
        return $this->db->get();
    }

    function ambil_kuisioner($id_mahasiswa) {
        $where = array(
            'id_mahasiswa' => $id_mahasiswa
        );
        $this->db->select('kuisioner.*, mahasiswa.nim, mahasiswa.nama, prodi.id as prodi, matkul.id as matkul, dosen.nidn as dosen');
        $this->db->from('kuisioner');
        $this->db->join('mahasiswa', 'mahasiswa.nim = kuisioner.id_mahasiswa');
        $this->db->join('prodi', 'prodi.id = kuisioner.id_prodi');
        $this->db->join('matkul', 'matkul.id = kuisioner.id_matkul', 'LEFT');
        $this->db->join('dosen', 'dosen.id_matkul = matkul.id', 'LEFT');
        return $this->db->get();


    }
}