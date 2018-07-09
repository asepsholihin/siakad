<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_Kuisioner extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Kategori_Kuisioner');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}
 
	public function index() {
		$data['kategori_kuisioner'] = $this->M_Kategori_Kuisioner->get_data()->result();
		$this->render_page('pages/kategori_kuisioner/v_kategori_kuisioner', $data);
	}

	function input() {
		$this->render_page('pages/kategori_kuisioner/v_input_kategori_kuisioner');
	}
 
	function proses_input() {
		$nama 		= $this->input->post('nama');
 
		$data = array(
			'nama'		=> $nama
			);

		$this->M_Kategori_Kuisioner->input_data($data, 'kategori_kuisioner');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('kategori_kuisioner');
	}

	function edit($id){
        $where = array('id' => $id);
        $data['kategori_kuisioner'] = $this->M_Kategori_Kuisioner->edit_data($where, 'kategori_kuisioner')->result();
        $this->render_page('pages/kategori_kuisioner/v_edit_kategori_kuisioner', $data);
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

		$this->M_Kategori_Kuisioner->update_data($where, $data, 'kategori_kuisioner');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('kategori_kuisioner');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Kategori_Kuisioner->hapus_data($where, 'kategori_kuisioner');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil dihapus.</div>');
		redirect('kategori_kuisioner');
	}
}