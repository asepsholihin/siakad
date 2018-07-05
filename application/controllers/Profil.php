<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Dosen');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

		if($this->session->userdata("role") != "mahasiswa") { 
			redirect(base_url("dashboard"));
		}
	}
 
	public function index() {
		$data['profil'] = $this->M_Mahasiswa->profil($this->session->userdata('id_user'));
		$this->render_page('pages/profil/v_profil', $data);
    }

}