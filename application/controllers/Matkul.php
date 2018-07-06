<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Matkul extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Matkul');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index() {
		$data['matkul'] = $this->M_Matkul->get_data();
		$this->render_page('pages/matkul/v_matkul', $data);
	}

	function input() {
		$data['prodi'] = $this->M_Matkul->ambil_prodi();
		$this->render_page('pages/matkul/v_input_matkul', $data);
	}
 
	function proses_input() {
		$kode 		= $this->input->post('kode');
		$nama 		= $this->input->post('nama');
		$sks 		= $this->input->post('sks');
		$id_prodi	= $this->input->post('id_prodi');
 
		$data = array(
			'kode'		=> $kode,
			'nama'		=> $nama,
			'sks'		=> $sks,
			'id_prodi'	=> $id_prodi
			);

		$this->M_Matkul->input_data($data, 'matkul');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('matkul');
	}

	function edit($id){
		$where = array('id' => $id);
		$data['prodi'] = $this->M_Matkul->ambil_prodi();
        $data['matkul'] = $this->M_Matkul->edit_data($where, 'matkul')->result();
        $this->render_page('pages/matkul/v_edit_matkul', $data);
	}
	
	function proses_edit() {
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
		$nama 		= $this->input->post('nama');
		$sks 		= $this->input->post('sks');
		$id_prodi	= $this->input->post('id_prodi');
		
		$data = array(
			'id' 		=> $id,
			'nama'		=> $nama,
			'sks'		=> $sks,
			'id_prodi'	=> $id_prodi
			);

		$where = array(
			'id' => $id
		);

		$this->M_Matkul->update_data($where, $data, 'matkul');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('matkul');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Matkul->hapus_data($where, 'matkul');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil dihapus.</div>');
		redirect('matkul');
	}
}