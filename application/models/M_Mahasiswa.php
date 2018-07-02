<?php 
 
class M_Mahasiswa extends CI_Model{	
	function get_data(){
		return $this->db->get('mahasiswa');
	}
 
	function input_data($data,$table){
		$this->db->insert($table,$data);
	}
}