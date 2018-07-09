<?php 
 
class M_Laporan_Kuisioner extends CI_Model{	
	function get_data($id_matkul){
        $this->db->select('mahasiswa.nama, mahasiswa.nim');
        $this->db->from('kuisioner');
        $this->db->join('mahasiswa', 'mahasiswa.nim = kuisioner.id_mahasiswa');
        if($id_matkul != 0) {
            $this->db->where('kuisioner.id_matkul', $id_matkul);
        }
        return $this->db->get();
    }
}