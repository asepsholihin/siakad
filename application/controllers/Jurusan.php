<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Jurusan');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}
 
	public function index() {
		$data['jurusan'] = $this->M_Jurusan->get_data()->result();
		$this->render_page('pages/jurusan/v_jurusan', $data);
	}

	function input() {
		$this->render_page('pages/jurusan/v_input_jurusan');
	}
 
	function proses_input() {
		$nama 		= $this->input->post('nama');
 
		$data = array(
			'nama'		=> $nama
			);

		$this->M_Jurusan->input_data($data, 'jurusan');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('jurusan');
	}

	function edit($id){
        $where = array('id' => $id);
        $data['jurusan'] = $this->M_Jurusan->edit_data($where, 'jurusan')->result();
        $this->render_page('pages/jurusan/v_edit_jurusan', $data);
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

		$this->M_Jurusan->update_data($where, $data, 'jurusan');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('jurusan');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Jurusan->hapus_data($where, 'jurusan');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil dihapus.</div>');
		redirect('jurusan');
	}
}