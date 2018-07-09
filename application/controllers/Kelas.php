<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Kelas');
		$this->load->model('M_Dosen');
		$this->load->model('M_Prodi');
		$this->load->model('M_Jurusan');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}
 
	public function index() {
		$data['kelas'] = $this->M_Kelas->get_data()->result();
		$this->render_page('pages/kelas/v_kelas', $data);
	}

	function input() {
        $data['dosen'] = $this->M_Dosen->ambil_dosen();
        $data['prodi'] = $this->M_Prodi->ambil_prodi();
        $data['jurusan'] = $this->M_Jurusan->ambil_jurusan();
		$this->render_page('pages/kelas/v_input_kelas', $data);
	}
 
	function proses_input() {
		$nama 		= $this->input->post('nama');
		$id_dosen 	= $this->input->post('id_dosen');
		$id_prodi   = $this->input->post('id_prodi');
		$semester   = $this->input->post('semester');
 
		$data = array(
            'nama'          => $nama,
            'id_dosen'      => $id_dosen,
            'id_prodi'      => $id_prodi,
            'semester'      => $semester
        );

		$this->M_Kelas->input_data($data, 'kelas');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('kelas');
	}

	function edit($id){
        $where = array('id' => $id);
        $data['dosen'] = $this->M_Dosen->ambil_dosen();
        $data['prodi'] = $this->M_Prodi->ambil_prodi();
        $data['jurusan'] = $this->M_Jurusan->ambil_jurusan();
        $data['kelas'] = $this->M_Kelas->edit_data($where, 'kelas')->result();
        $this->render_page('pages/kelas/v_edit_kelas', $data);
	}
	
	function proses_edit() {
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
		$id_dosen 	= $this->input->post('id_dosen');
		$id_prodi   = $this->input->post('id_prodi');
		$semester   = $this->input->post('semester');
 
		$data = array(
            'nama'          => $nama,
            'id_dosen'      => $id_dosen,
            'id_prodi'      => $id_prodi,
            'semester'      => $semester
        );

		$where = array(
			'id' => $id
		);

		$this->M_Kelas->update_data($where, $data, 'kelas');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('kelas');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Kelas->hapus_data($where, 'kelas');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil dihapus.</div>');
		redirect('kelas');
	}
}