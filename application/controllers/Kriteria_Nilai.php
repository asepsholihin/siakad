<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria_Nilai extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Kriteria_Nilai');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index() {
		$data['kriteria_nilai'] = $this->M_Kriteria_Nilai->get_data()->result();
		$this->render_page('pages/kriteria_nilai/v_kriteria_nilai', $data);
	}

	function input() {
		$this->render_page('pages/kriteria_nilai/v_input_kriteria_nilai');
	}
 
	function proses_input() {
		$nama 		= $this->input->post('nama');
		$skala 		= $this->input->post('skala');
 
		$data = array(
			'nama'		=> $nama,
			'skala'		=> $skala
			);

		$this->M_Kriteria_Nilai->input_data($data, 'kriteria_nilai');
		redirect('kriteria_nilai');
	}

	function edit($id){
        $where = array('id' => $id);
        $data['kriteria_nilai'] = $this->M_Kriteria_Nilai->edit_data($where, 'kriteria_nilai')->result();
        $this->render_page('pages/kriteria_nilai/v_edit_kriteria_nilai', $data);
	}
	
	function proses_edit() {
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
		$skala 		= $this->input->post('skala');
 
		$data = array(
			'id' 		=> $id,
			'nama'		=> $nama,
			'skala'		=> $skala
			);

		$where = array(
			'id' => $id
		);

		$this->M_Kriteria_Nilai->update_data($where, $data, 'kriteria_nilai');
		redirect('kriteria_nilai');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Kriteria_Nilai->hapus_data($where, 'kriteria_nilai');
		redirect('kriteria_nilai');
	}
}