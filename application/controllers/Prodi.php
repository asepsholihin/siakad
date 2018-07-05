<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Prodi');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index() {
		$data['prodi'] = $this->M_Prodi->get_data()->result();
		$this->render_page('pages/prodi/v_prodi', $data);
	}

	function input() {
		$this->render_page('pages/prodi/v_input_prodi');
	}
 
	function proses_input() {
		$nama 		= $this->input->post('nama');
 
		$data = array(
			'nama'		=> $nama
			);

		$this->M_Prodi->input_data($data, 'prodi');
		redirect('prodi');
	}

	function edit($id){
        $where = array('id' => $id);
        $data['prodi'] = $this->M_Prodi->edit_data($where, 'prodi')->result();
        $this->render_page('pages/prodi/v_edit_prodi', $data);
	}
	
	function proses_edit() {
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
 
		$data = array(
			'id' 		=> $id,
			'nama'		=> $nama
			);

		$where = array(
			'id' => $id
		);

		$this->M_Prodi->update_data($where, $data, 'prodi');
		redirect('prodi');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Prodi->hapus_data($where, 'prodi');
		redirect('prodi');
	}
}