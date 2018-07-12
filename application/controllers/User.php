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
		
		if($data['role'] == 'kajur') {
			$udah_ada_kajur = $this->db->get_where('users', array('role'=>'kajur'))->num_rows();
			if($udah_ada_kajur == 2) {
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><strong>Ketua Jurusan</strong> sudah ada.</div>');
			} else {
				$this->M_User->input_data($data, 'users');
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
			}
		}

		if($data['role'] == 'wadir1') {
			$udah_ada_wadir = $this->db->get_where('users', array('role'=>'kajur'))->num_rows();
			if($udah_ada_wadir > 0) {
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><strong>Wakil Direktur 1</strong> sudah ada.</div>');
			} else {
				$this->M_User->input_data($data, 'users');
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
			}
		}

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
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('user');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_User->hapus_data($where, 'users');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil dihapus.</div>');
		redirect('user');
	}
}