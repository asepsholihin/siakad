<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Mahasiswa');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index() {
		$data['mahasiswa'] = $this->M_Mahasiswa->get_data()->result();
		$this->render_page('pages/mahasiswa/v_mahasiswa', $data);
	}

	function input() {
		$this->render_page('pages/mahasiswa/v_input_mahasiswa');
	}
 
	function proses_input() {
		$nim 		= $this->input->post('nim');
		$nama 		= $this->input->post('nama');
		$tgl_lahir 	= $this->input->post('tgl_lahir');
		$tmp_lahir 	= $this->input->post('tmp_lahir');
		$jk 		= $this->input->post('jk');
		$alamat 	= $this->input->post('alamat');
		$id_prodi 	= $this->input->post('id_prodi');
		$id_dosen 	= $this->input->post('id_dosen');
 
		$data = array(
			'nim' 		=> $nim,
			'nama'		=> $nama,
			'tgl_lahir'	=> $tgl_lahir,
			'tmp_lahir'	=> $tmp_lahir,
			'jk'		=> $jk,
			'alamat'	=> $alamat,
			'id_prodi'		=> $id_prodi,
			'id_dosen'	=> $id_dosen
			);

		$this->M_Mahasiswa->input_data($data, 'mahasiswa');
		redirect('mahasiswa');
	}

	function edit($id){
        $where = array('nim' => $id);
        $data['mahasiswa'] = $this->M_Mahasiswa->edit_data($where, 'mahasiswa')->result();
        $this->render_page('pages/mahasiswa/v_edit_mahasiswa', $data);
	}
	
	function proses_edit() {
		$nim 		= $this->input->post('nim');
		$nama 		= $this->input->post('nama');
		$tgl_lahir 	= $this->input->post('tgl_lahir');
		$tmp_lahir 	= $this->input->post('tmp_lahir');
		$jk 		= $this->input->post('jk');
		$alamat 	= $this->input->post('alamat');
		$id_prodi 	= $this->input->post('id_prodi');
		$id_dosen 	= $this->input->post('id_dosen');
 
		$data = array(
			'nim' 		=> $nim,
			'nama'		=> $nama,
			'tgl_lahir'	=> $tgl_lahir,
			'tmp_lahir'	=> $tmp_lahir,
			'jk'		=> $jk,
			'alamat'	=> $alamat,
			'id_prodi'		=> $id_prodi,
			'id_dosen'	=> $id_dosen
			);

		$where = array(
			'nim' => $nim
		);

		$this->M_Mahasiswa->update_data($where, $data, 'mahasiswa');
		redirect('mahasiswa');
	}

	function hapus($id){
		$where = array('nim' => $id);
		$this->M_Mahasiswa->hapus_data($where, 'mahasiswa');
		redirect('mahasiswa');
	}
}