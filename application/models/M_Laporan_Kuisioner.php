<?php 
 
class M_Laporan_Kuisioner extends CI_Model{	
	function get_data($id_dosen='', $id_matkul=''){
        return $this->db->get_where('kuisioner', array('id_dosen'=>$id_dosen,'id_matkul'=>$id_matkul));
    }
    function get_data_dosen($id_matkul=''){
        return $this->db->get_where('kuisioner', array('id_matkul'=>$id_matkul));
    }
}