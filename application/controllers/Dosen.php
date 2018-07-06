<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Dosen');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index() {
		$data['dosen'] = $this->M_Dosen->get_data();
		$this->render_page('pages/dosen/v_dosen', $data);
	}

	function input() {
		$data['prodi'] = $this->M_Dosen->ambil_prodi();
		$data['matkul'] = $this->M_Dosen->ambil_matkul();
		$this->render_page('pages/dosen/v_input_dosen', $data);
	}
 
	function proses_input() {
		$nidn 		= $this->input->post('nidn');
		$nama 		= $this->input->post('nama');
		$tgl_lahir 	= $this->input->post('tgl_lahir');
		$tmp_lahir 	= $this->input->post('tmp_lahir');
		$jk 		= $this->input->post('jk');
		$alamat 	= $this->input->post('alamat');
		$id_prodi 	= $this->input->post('id_prodi');
		$id_matkul 	= $this->input->post('id_matkul');
		$jabatan 	= $this->input->post('jabatan');
 
		$data = array(
			'nidn' 		=> $nidn,
			'nama'		=> $nama,
			'tgl_lahir'	=> $tgl_lahir,
			'tmp_lahir'	=> $tmp_lahir,
			'jk'		=> $jk,
			'alamat'	=> $alamat,
			'id_matkul' => $id_matkul,
			'id_prodi'  => $id_prodi,
			'jabatan'  => $jabatan
			);

		$this->M_Dosen->input_data($data, 'dosen');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('dosen');
    }
    
    function edit($id){
		$where = array('nidn' => $id);
		$data['prodi'] = $this->M_Dosen->ambil_prodi();
		$data['matkul'] = $this->M_Dosen->ambil_matkul();
        $data['dosen'] = $this->M_Dosen->edit_data($where, 'dosen')->result();
        $this->render_page('pages/dosen/v_edit_dosen', $data);
    }

    function proses_edit(){
        $nidn 		= $this->input->post('nidn');
		$nama 		= $this->input->post('nama');
		$tgl_lahir 	= $this->input->post('tgl_lahir');
		$tmp_lahir 	= $this->input->post('tmp_lahir');
		$jk 		= $this->input->post('jk');
		$alamat 	= $this->input->post('alamat');
		$id_prodi 	= $this->input->post('id_prodi');
		$id_matkul 	= $this->input->post('id_matkul');
		$jabatan 	= $this->input->post('jabatan');
     
        $data = array(
			'nidn' 		=> $nidn,
			'nama'		=> $nama,
			'tgl_lahir'	=> $tgl_lahir,
			'tmp_lahir'	=> $tmp_lahir,
			'jk'		=> $jk,
			'alamat'	=> $alamat,
			'id_matkul' => $id_matkul,
			'id_prodi'  => $id_prodi,
			'jabatan'   => $jabatan
			);
     
        $where = array(
            'nidn' => $nidn
        );

		$this->M_Dosen->update_data($where, $data, 'dosen');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
		redirect('dosen');
    }

    function hapus($id){
		$where = array('nidn' => $id);
		$this->M_Dosen->hapus_data($where, 'dosen');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil dihapus.</div>');
		redirect('dosen');
	}
}