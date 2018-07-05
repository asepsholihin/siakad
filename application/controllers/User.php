<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_User');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

		if($this->session->userdata("role") != "admin") { 
			redirect(base_url("dashboard"));
		}
	}
 
	public function index() {
        $data['user'] = $this->M_User->get_data()->result();
		$this->render_page('pages/user/v_user', $data);
	}

	function input() {
		$this->render_page('pages/user/v_input_user');
	}
 
	function proses_input() {
        $data = $this->input->post();
        $data['password'] = md5($this->input->post('password'));

		$this->M_User->input_data($data, 'users');
		redirect('user');
	}

	function edit($id){
        $where = array('id' => $id);
        $data['user'] = $this->M_User->edit_data($where, 'users')->result();
        $this->render_page('pages/user/v_edit_user', $data);
	}
	
	function proses_edit() {
		$id = $this->input->post('id');
		$data = $this->input->post();

		$where = array(
			'id' => $id
		);

		$this->M_User->update_data($where, $data, 'users');
		redirect('user');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_User->hapus_data($where, 'users');
		redirect('user');
	}
}