<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Prodi');
		$this->load->model('M_Dosen');
		$this->load->model('M_Kelas');
		$this->load->model('M_Matkul');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		
	}
 
	public function index() {
		$data['mahasiswa'] = $this->M_Mahasiswa->get_data();
		$this->render_page('pages/mahasiswa/v_mahasiswa', $data);
	}

	function input() {
		$data['prodi'] = $this->M_Prodi->ambil_prodi();
		$data['dosen'] = $this->M_Dosen->ambil_dosen();
		$data['kelas'] = $this->M_Kelas->ambil_kelas();
		$data['matkul'] = $this->M_Matkul->ambil_matkul();
		$this->render_page('pages/mahasiswa/v_input_mahasiswa', $data);
	}
 
	function proses_input() {
		$nim 		= $this->input->post('nim');
		$nama 		= $this->input->post('nama');
		$tgl_lahir 	= $this->input->post('tgl_lahir');
		$tmp_lahir 	= $this->input->post('tmp_lahir');
		$jk 		= $this->input->post('jk');
		$alamat 	= $this->input->post('alamat');
		$id_kelas 	= $this->input->post('id_kelas');
		$matkul 	= $this->input->post('matkul');
 
		$post = array(
			'nim' 		=> $nim,
			'nama'		=> $nama,
			'tgl_lahir'	=> $tgl_lahir,
			'tmp_lahir'	=> $tmp_lahir,
			'jk'		=> $jk,
			'alamat'	=> $alamat,
			'id_kelas'	=> $id_kelas,
			'matkul'	=> implode(',',$matkul)
			);
		
		$this->M_Mahasiswa->input_data($post, 'mahasiswa');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('mahasiswa');
	}

	function edit($id){
        $where = array('nim' => $id);
		$data['prodi'] = $this->M_Prodi->ambil_prodi();
		$data['dosen'] = $this->M_Dosen->ambil_dosen();
		$data['kelas'] = $this->M_Kelas->ambil_kelas();
		$data['matkul'] = $this->M_Matkul->ambil_matkul();
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
		$id_kelas 	= $this->input->post('id_kelas');
		$matkul 	= $this->input->post('matkul');
 
		$post = array(
			'nim' 		=> $nim,
			'nama'		=> $nama,
			'tgl_lahir'	=> $tgl_lahir,
			'tmp_lahir'	=> $tmp_lahir,
			'jk'		=> $jk,
			'alamat'	=> $alamat,
			'id_kelas'	=> $id_kelas,
			'matkul'	=> implode(',',$matkul)
			);

		$where = array(
			'nim' => $nim
		);

		$this->M_Mahasiswa->update_data($where, $post, 'mahasiswa');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('mahasiswa');
	}

	function hapus($id){
		$where = array('nim' => $id);
		$this->M_Mahasiswa->hapus_data($where, 'mahasiswa');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil dihapus.</div>');
		redirect('mahasiswa');
	}
}