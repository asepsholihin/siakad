<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Nilai');
		$this->load->model('M_Upload');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index() {
		$data['mahasiswa'] = array();
		$data['matkul'] = $this->M_Nilai->ambil_matkul();
		$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
		$this->render_page('pages/nilai/v_nilai', $data);
	}

	public function matkul($id_matkul) {
		if($id_matkul == 0) {
			redirect('nilai');	
		} else {
			$data['mahasiswa'] = $this->M_Nilai->get_data($id_matkul);
			$data['matkul'] = $this->M_Nilai->ambil_matkul();
			$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
			$this->render_page('pages/nilai/v_nilai', $data);
		}
		
	}
 
	function proses_edit($id_matkul) {
		$name 		= $this->input->post('name');
		$pk 		= $this->input->post('pk');
		$value 		= $this->input->post('value');
		
		$semester = $this->db->get('semester')->row();

		$input = array(
			'id_mahasiswa' => $pk,
			'id_matkul' => $id_matkul,
			$name => $value,
			'semester' => $semester->semester,
			'id_dosen' => $this->session->userdata('id_user')
		);

		$data = array(
			$name => $value,
			'semester' => $semester->semester,
			'id_dosen' => $this->session->userdata('id_user')
		);

		$where = array(
			'id_mahasiswa' => $pk,
			'id_matkul' => $id_matkul,
			'id_dosen' => $this->session->userdata('id_user')
		);

		$cek = $this->M_Nilai->cek_nilai($where, 'nilai');
		if($cek){
			$this->M_Nilai->update_data($where, $data, 'nilai');
		} else {
			$this->M_Nilai->insert_data($input, 'nilai');
		}
	}

	function transkrip_nilai($nim) {
		$data['transkrip'] = $this->M_Nilai->transkrip($nim);
		$this->render_page('pages/nilai/v_transkrip', $data);
	}

	private $filename = "import_data";

		public function upload(){
			$data = array();

			if(isset($_POST['preview'])){

				$upload = $this->M_Upload->upload_file($this->filename);

				if($upload['result'] == "success"){

					include APPPATH.'third_party/PHPExcel/PHPExcel.php';

					$excelreader = new PHPExcel_Reader_Excel2007();
					$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx');
					$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

					$data['sheet'] = $sheet; 
				} else {
					$data['upload_error'] = $upload['error']; 
				}
			}

			$this->render_page('pages/nilai/v_upload', $data);
		}
	  
	  public function import() {
		
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx');
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			
			$data = [];
			
			$numrow = 1;
			foreach($sheet as $row){
				$nis 	= isset($row['A']) ? $row['A'] : '';
				$nama 	= isset($row['B']) ? $row['B'] : '';
				$kodematkul = isset($row['C']) ? $row['C'] : '';
				$uts 	= isset($row['D']) ? $row['D'] : '';
				$uas 	= isset($row['E']) ? $row['E'] : '';
				$tugas 	= isset($row['F']) ? $row['F'] : '';
				$index 	= isset($row['G']) ? $row['G'] : '';
				$semester 	= isset($row['H']) ? $row['H'] : '';
		
				if($numrow > 1){

				$get_matkul = $this->db->query("SELECT id FROM matkul WHERE kode='".$kodematkul."'")->row();
				
				array_push($data, [
					'id_mahasiswa'=>$nis,
					'id_matkul'=>$get_matkul->id,
					'uts'=>$uts,
					'uas'=>$uas,
					'tugas'=>$tugas,
					'grade'=>$index,
					'semester'=>$semester,
				]);
				}
				
				$numrow++;
			}
			
			$this->M_Upload->insert_multiple($data);
			
			redirect("nilai");
	  }

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Nilai->hapus_data($where, 'nilai');
		redirect('nilai');
	}
}