<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuisioner extends MY_Controller {
    
    function __construct() {
		parent::__construct();
        $this->load->model('M_Dosen');
        $this->load->model('M_Mahasiswa');
		$this->load->model('M_Kuisioner');
		$this->load->model('M_Referensi_Kuisioner');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
        }
    }

    public function index() {
        $data['prodi'] = $this->M_Mahasiswa->ambil_prodi();
		$data['dosen'] = $this->M_Mahasiswa->ambil_dosen();
        $data['matkul'] = $this->M_Dosen->ambil_matkul();
        
        $sql = $this->db->query("SELECT kategori FROM referensi_kuisioner WHERE jenis !='esai' GROUP BY kategori");
        
        $data['ref_kategori'] = array();
        
        foreach($sql->result() as $row) {

            $data['ref_kategori'][] = $row;
            
        }

        $data['esai'] = $this->db->query("SELECT id,kode,pertanyaan FROM referensi_kuisioner WHERE jenis ='esai' GROUP BY kategori")->result();
        
		$this->render_page('pages/kuisioner/v_kuisioner', $data);
    }
    
    function proses_input() {
        $post = $this->input->post();
        if($this->input->post('nim') == '' || $this->input->post('nama') == '' || $this->input->post('email') == '') {
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center"><strong>Gagal!</strong> <br> Silahkan isi dengan lengkap.</div>');
            redirect('kuisioner');
        } else {
            unset($post['nim'],$post['nama'],$post['id_dosen']);
            $post['id_mahasiswa'] = $this->input->post('nim');
            
            $this->M_Mahasiswa->input_data($post, 'kuisioner');
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center"><strong>Berhasil!</strong> <br> Terimakasih sudah mengisi kuisioner.</div>');
            redirect('kuisioner');
        }
	}
}