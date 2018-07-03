<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Nilai');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index() {
		$data['mahasiswa'] = array();
		$data['matkul'] = $this->M_Nilai->ambil_matkul();
		$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
		$this->render_page('pages/nilai/v_nilai', $data);
	}

	public function matkul($id_matkul) {
		$data['mahasiswa'] = $this->M_Nilai->get_data($id_matkul);
		$data['matkul'] = $this->M_Nilai->ambil_matkul();
		$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
		$this->render_page('pages/nilai/v_nilai', $data);
	}
 
	function proses_edit($id_matkul) {
		$name 		= $this->input->post('name');
		$pk 		= $this->input->post('pk');
		$value 		= $this->input->post('value');
		
		$data = array(
			$name => $value
		);

		$input = array(
			'id_mahasiswa' => $pk,
			'id_matkul' => $id_matkul,
			$name => $value
		);

		$where = array(
			'id_mahasiswa' => $pk,
			'id_matkul' => $id_matkul
		);

		$cek = $this->M_Nilai->cek_nilai($where, 'nilai');
		if($cek){
			$this->M_Nilai->update_data($where, $data, 'nilai');
		} else {
			$this->M_Nilai->insert_data($input, 'nilai');
		}
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Nilai->hapus_data($where, 'nilai');
		redirect('nilai');
	}
}