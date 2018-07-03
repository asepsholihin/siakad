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
		$data['nilai'] = array();
		$data['matkul'] = $this->M_Nilai->ambil_matkul();
		$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
		$this->render_page('pages/nilai/v_nilai', $data);
	}

	public function matkul($id_matkul) {
		$data['mahasiswa'] = $this->M_Nilai->ambil_mahasiswa();
		$data_nilais = array();

		$data_mahasiswa = $this->M_Nilai->ambil_mahasiswa();
		foreach($data_mahasiswa as $row) {
			$data_nilai = $this->M_Nilai->ambil_nilai($row->nim, $id_matkul);
			foreach($data_nilai as $row_nilai) {
				$data_nilais[] = $row_nilai;
			}

		}
		echo json_encode($data_nilais);
		//echo $this->db->last_query(); 
		$data['matkul'] = $this->M_Nilai->ambil_matkul();
		$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
		//$this->render_page('pages/nilai/v_nilai', $data);
	}
 
	function proses_edit($id_matkul) {
		$name 		= $this->input->post('name');
		$pk 		= $this->input->post('pk');
		$value 		= $this->input->post('value');
		
		$data = array(
			$name => $value
		);

		$where = array(
			'id_mahasiswa' => $pk,
			'id_matkul' => $id_matkul
		);

		$this->M_Nilai->update_data($where, $data, 'nilai');
	}

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Nilai->hapus_data($where, 'nilai');
		redirect('nilai');
	}
}