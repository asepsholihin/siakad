<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    function __construct() {
		parent::__construct();
		$this->load->helper('url');
        $this->load->model('M_Login');
    }

    function index() {
		$this->load->view('V_Login');
		if($this->session->userdata('status') == "login"){
			redirect(base_url("dashboard"));
		}
    }

    function proses_login(){
		$username   = $this->input->post('username');
		$password   = $this->input->post('password');
		$where      = array(
                        'username' => $username,
                        'password' => md5($password)
                    );
        $cek        = $this->M_Login->cek_login("users", $where)->num_rows();
        
		if($cek > 0) {

			$user = $this->M_Login->cek_login("users", $where)->row();
 
			$data_session = array(
				'nama'      => $username,
				'id_user'   => $user->id_user,
				'role'      => $user->role,
				'status'    => "login"
				);
 
			$this->session->set_userdata($data_session);
 
			redirect(base_url("dashboard"));
 
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Username atau password salah</div>');
	redirect(base_url()."login");
		}
	}
 
	function logout() {
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
