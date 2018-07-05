<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Referensi_Kuisioner extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Referensi_Kuisioner');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
		
		if($this->session->userdata("role") == "mahasiswa") { 
			redirect(base_url("dashboard"));
		}
	}
 
	public function index() {
		$data['referensi_kuisioner'] = $this->M_Referensi_Kuisioner->get_data()->result();
		$this->render_page('pages/referensi_kuisioner/v_referensi_kuisioner', $data);
	}

	function input() {
		$this->render_page('pages/referensi_kuisioner/v_input_referensi_kuisioner');
	}
 
	function proses_input() {
		$pertanyaan	= $this->input->post('pertanyaan');
		$kategori	= $this->input->post('kategori');
		$jenis		= $this->input->post('jenis');
 
		$input = array(
			'pertanyaan'	=> $pertanyaan,
			'kategori'		=> $kategori,
			'jenis'			=> $jenis
			);

		$this->M_Referensi_Kuisioner->input_data($input, 'referensi_kuisioner');

		//Tambah Field
		$this->db->select('id');
		$this->db->from('referensi_kuisioner');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		$this->M_Referensi_Kuisioner->tambah_field($query->row()->id);
		redirect('referensi_kuisioner');
	}

	function edit($id){
        $where = array('id' => $id);
        $data['referensi_kuisioner'] = $this->M_Referensi_Kuisioner->edit_data($where, 'referensi_kuisioner')->result();
        $this->render_page('pages/referensi_kuisioner/v_edit_referensi_kuisioner', $data);
	}
	
	function proses_edit() {
		$id	= $this->input->post('id');
		$pertanyaan	= $this->input->post('pertanyaan');
		$kategori	= $this->input->post('kategori');
		$jenis		= $this->input->post('jenis');
 
		$data = array(
			'pertanyaan'	=> $pertanyaan,
			'kategori'		=> $kategori,
			'jenis'			=> $jenis
			);

		$where = array(
			'id' => $id
		);

		$this->M_Referensi_Kuisioner->update_data($where, $data, 'referensi_kuisioner');
		redirect('referensi_kuisioner');
	}

	function hapus($id){
		$where = array('id' => $id);

		//Hapus Field
		$this->db->select('id');
		$this->db->from('referensi_kuisioner');
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get();
		$this->M_Referensi_Kuisioner->hapus_field($query->row()->id);
		
		$this->M_Referensi_Kuisioner->hapus_data($where, 'referensi_kuisioner');
		redirect('referensi_kuisioner');
	}
}