<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Dosen');
		$this->load->model('M_Prodi');
		$this->load->model('M_Matkul');
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
		$data['prodi'] = $this->M_Prodi->ambil_prodi();
		$data['matkul'] = $this->M_Matkul->ambil_matkul();
		$data['jabatan'] = $this->M_Dosen->ambil_jabatan();
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
		$jabatan 	= $this->input->post('jabatan');
		$matkul 	= $this->input->post('matkul');
 
		$data = array(
			'nidn' 		=> $nidn,
			'nama'		=> $nama,
			'tgl_lahir'	=> $tgl_lahir,
			'tmp_lahir'	=> $tmp_lahir,
			'jk'		=> $jk,
			'alamat'	=> $alamat,
			'id_prodi'  => $id_prodi,
			'jabatan'  => $jabatan,
			'matkul'	=> implode(',',$matkul)
			);

		if($jabatan == 'Ketua Jurusan') {
			$jurusan = $this->db->query("SELECT jurusan.* FROM jurusan JOIN prodi on prodi.id_jurusan=jurusan.id WHERE prodi.id='".$id_prodi."'")->row();
			$udah_ada = $this->db->query("SELECT * FROM dosen JOIN prodi ON dosen.id_prodi=prodi.id JOIN jurusan ON prodi.id_jurusan=jurusan.id AND jurusan.id='".$jurusan->id."'")->num_rows();
			if($udah_ada > 0) {
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Ketua Jurusan <strong>'.$jurusan->nama.'</strong> sudah ada.</div>');
			} else {
				$this->M_Dosen->input_data($data, 'dosen');
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
			}
		}

		if($jabatan == 'Wakil Direktur 1') {
			$udah_ada_wadir = $this->db->get_where('dosen', array('jabatan'=>'Wakil Direktur 1'))->num_rows();
			if($udah_ada_wadir > 0) {
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><strong>Wakil Direktur 1</strong> sudah ada.</div>');
			} else {
				$this->M_Dosen->input_data($data, 'dosen');
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
			}
		}
		
		redirect('dosen');
    }
    
    function edit($id){
		$where = array('nidn' => $id);
		$data['prodi'] = $this->M_Prodi->ambil_prodi();
		$data['matkul'] = $this->M_Matkul->ambil_matkul();
		$data['jabatan'] = $this->M_Dosen->ambil_jabatan();
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
		$jabatan 	= $this->input->post('jabatan');
		$matkul 	= $this->input->post('matkul');
     
        $data = array(
			'nidn' 		=> $nidn,
			'nama'		=> $nama,
			'tgl_lahir'	=> $tgl_lahir,
			'tmp_lahir'	=> $tmp_lahir,
			'jk'		=> $jk,
			'alamat'	=> $alamat,
			'id_prodi'  => $id_prodi,
			'jabatan'   => $jabatan,
			'matkul'	=> implode(',',$matkul)
			);
     
        $where = array(
            'nidn' => $nidn
		);

		if($jabatan == 'Ketua Jurusan') {
			$jurusan = $this->db->query("SELECT jurusan.* FROM jurusan JOIN prodi on prodi.id_jurusan=jurusan.id WHERE prodi.id='".$id_prodi."'")->row();
			$udah_ada = $this->db->query("SELECT * FROM dosen JOIN prodi ON dosen.id_prodi=prodi.id JOIN jurusan ON prodi.id_jurusan=jurusan.id AND jurusan.id='".$jurusan->id."'")->num_rows();
			if($udah_ada > 0) {
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Ketua Jurusan <strong>'.$jurusan->nama.'</strong> sudah ada.</div>');
			} else {
				$this->M_Dosen->update_data($where, $data, 'dosen');
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
			}
		}

		if($jabatan == 'Wakil Direktur 1') {
			$udah_ada_wadir = $this->db->get_where('dosen', array('jabatan'=>'Wakil Direktur 1'))->num_rows();
			if($udah_ada_wadir > 0) {
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><strong>Wakil Direktur 1</strong> sudah ada.</div>');
			} else {
				$this->M_Dosen->update_data($where, $data, 'dosen');
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
			}
		}
		
		redirect('dosen');
    }

    function hapus($id){
		$where = array('nidn' => $id);
		$this->M_Dosen->hapus_data($where, 'dosen');
		$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil dihapus.</div>');
		redirect('dosen');
	}
}