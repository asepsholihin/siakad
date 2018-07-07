<?php 
error_reporting(0);
 defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Nilai extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Nilai');
		$this->load->model('M_Upload');
		$this->load->model('M_User');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}
 
	public function index() {
		$data['mahasiswa'] = array();
		$data['matkul'] = $this->M_Nilai->ambil_matkul();
		$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
		$this->render_page('pages/laporan_nilai/v_laporan_nilai', $data);
	}

	public function matkul($id_matkul,$semester) {
		if($id_matkul == 0) {
			redirect('laporan_nilai');	
		} else {
			$data['mahasiswa'] = $this->M_Nilai->get_data_kelas($this->session->userdata("id_user"),$id_matkul,$semester);
			$data['matkul'] = $this->M_Nilai->ambil_matkul();
			$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
			$this->render_page('pages/laporan_nilai/v_laporan_nilai', $data);
		}
	}

	public function download($semester) {
		$data['mahasiswa'] = $this->db->query("SELECT * FROM mahasiswa LEFT JOIN nilai ON nilai.id_mahasiswa = mahasiswa.nim WHERE mahasiswa.semester='".$semester."' GROUP BY mahasiswa.nim")->result();
		$this->load->view('pages/laporan_nilai/v_print_nilai', $data);   
    }
}