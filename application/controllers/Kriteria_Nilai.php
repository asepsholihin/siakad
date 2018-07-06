<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria_Nilai extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Kriteria_Nilai');
		$this->load->model('M_Nilai');
		$this->load->model('M_Mahasiswa');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	function index() {
		$data['id_matkul'] = 0;
		$data['matkul'] = $this->M_Nilai->ambil_matkul();
		$data['kriteria_nilai'] = $this->M_Kriteria_Nilai->get_data($this->session->userdata('id_user'), 0)->result();
		$this->render_page('pages/kriteria_nilai/v_kriteria_nilai', $data);
	}

	function matkul($id_matkul) {
		if($id_matkul == 0) {
			redirect('kriteria_nilai');	
		}
		$data['matkul'] = $this->M_Nilai->ambil_matkul();
		$data['id_matkul'] = $id_matkul;
		$data['kriteria_nilai'] = $this->M_Kriteria_Nilai->get_data($this->session->userdata('id_user'),$id_matkul)->result();
		$this->render_page('pages/kriteria_nilai/v_kriteria_nilai', $data);
	}

	function input() {
		$data['dosen'] = $this->M_Mahasiswa->ambil_dosen();
		$this->render_page('pages/kriteria_nilai/v_input_kriteria_nilai', $data);
	}
 
	function proses_input() {
		$nama 		= $this->input->post('nama');
		$skala 		= $this->input->post('skala');
		$id_dosen 	= $this->input->post('id_dosen');
 
		$data = array(
			'nama'		=> $nama,
			'skala'		=> $skala,
			'id_dosen'	=> $id_dosen
			);

		$this->M_Kriteria_Nilai->input_data($data, 'kriteria_nilai');
		redirect('kriteria_nilai');
	}

	function live_edit($id_matkul) {
		$name 		= $this->input->post('name');
		$pk 		= $this->input->post('pk');
		$value 		= $this->input->post('value');

		$input = array(
			$name => $value,
			'id_dosen' => $pk,
			'id_matkul' => $id_matkul
		);
		$cek = $this->db->get_where('kriteria', array('id_dosen' =>$pk, 'id_matkul' => $id_matkul));
		if($cek->num_rows() > 0) {
			$this->M_Kriteria_Nilai->update_data(array('id_dosen' =>$pk, 'id_matkul' => $id_matkul), $input,'kriteria');
		} else {
			$this->M_Kriteria_Nilai->input_data($input, 'kriteria');
		}
		
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