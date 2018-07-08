<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Nilai');
		$this->load->model('M_Upload');
		$this->load->model('M_Dosen');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index() {
		$data['mahasiswa'] = array();
		$data['matkul'] = $this->M_Dosen->ambil_matkul_();
		$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
		$data['cek_kriteria'] = $this->db->get_where('kriteria', array('id_dosen' => $this->session->userdata('id_user')))->num_rows();
		$this->render_page('pages/nilai/v_nilai', $data);
	}

	public function matkul($id_matkul,$semester) {
		if($id_matkul == 0) {
			redirect('nilai');	
		} else {
			$data['mahasiswa'] = $this->M_Nilai->get_data($id_matkul, $semester);
			$data['matkul'] = $this->M_Dosen->ambil_matkul_();
			$data['kriteria_nilai'] = $this->M_Nilai->ambil_kriteria_nilai();
			$data['cek_kriteria'] = $this->db->get_where('kriteria', array('id_dosen' => $this->session->userdata('id_user')))->num_rows();
			$this->render_page('pages/nilai/v_nilai', $data);
		}
		
	}
 
	function proses_edit($id_matkul,$semester) {
		$name 		= $this->input->post('name');
		$pk 		= $this->input->post('pk');
		$value 		= $this->input->post('value');

		$input = array(
			'id_mahasiswa' => $pk,
			'id_matkul' => $id_matkul,
			$name => $value,
			'semester' => $semester,
			'id_dosen' => $this->session->userdata('id_user')
		);

		$data = array(
			$name => $value,
			'semester' => $semester,
			'id_dosen' => $this->session->userdata('id_user')
		);

		$where = array(
			'id_mahasiswa' => $pk,
			'id_matkul' => $id_matkul
			// 'id_dosen' => $this->session->userdata('id_user')
		);

		$cek = $this->M_Nilai->cek_nilai($where, 'nilai');
		if($cek){
			$this->M_Nilai->update_data($where, $data, 'nilai');
		} else {
			$this->M_Nilai->insert_data($input, 'nilai');
		}
	}

	function transkrip_nilai($nim,$semester) {
		$data['semester'] = $semester;
		$data['transkrip'] = $this->M_Nilai->print_transkrip($nim, $semester)->result();
		$this->render_page('pages/nilai/v_transkrip', $data);
	}

	function print_transkrip($nim) {
		$this->load->library('excel');

		$semester = $this->db->get('semester')->row();
		$semester = $semester->semester;
		
		$objPHPExcel = new PHPExcel();

		$data = $this->M_Nilai->print_transkrip($nim, $semester);
		//echo json_encode($data);

		$tambah_field = array('Kode', 'Mata Kuliah', 'SKS', 'UTS', 'UAS', 'Tugas', 'Nilai Akhir', 'Nilai Mutu');
		$tambah = array('nilai_akhir', 'nilai_mutu');
		$fields = array_merge($data->list_fields(), $tambah);
		
		unset($fields[5],$fields[6],$fields[7]);
		
		$col = 0;
		foreach ($tambah_field as $field)
		{
			//echo json_encode($field)."<br>";
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
			$col++;
		}
 
		
		
		$row = 2;
		
		foreach($data->result() as $value)
		{
			
			$value->nilai_akhir = $value->total_uts+$value->total_uas+$value->total_tugas;
			$value->nilai_mutu = $this->M_Nilai->grading($value->nilai_akhir);
			
			
			$col = 0;
			foreach ($fields as $field)
			{
				//echo json_encode($value->$field)."<br>";
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value->$field);
				$col++;
			}
 
			$row++;
		}
		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->setTitle('Nilai Semester '.$semester);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		header('Content-Disposition: attachment;filename="Nilai-Semester-'.$semester.'.xlsx"');

		$objWriter->save("php://output");  
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
				$nidn 	= isset($row['D']) ? $row['D'] : '';
				$dosen 	= isset($row['E']) ? $row['E'] : '';
				$uts 	= isset($row['F']) ? $row['F'] : '';
				$uas 	= isset($row['G']) ? $row['G'] : '';
				$tugas 	= isset($row['H']) ? $row['H'] : '';
				$semester 	= isset($row['I']) ? $row['I'] : '';
		
				if($numrow > 1){

				$get_matkul = $this->db->query("SELECT id FROM matkul WHERE kode='".$kodematkul."'")->row();
				
				array_push($data, [
					'id_mahasiswa'=>$nis,
					'id_matkul'=>$get_matkul->id,
					'id_dosen'=>$nidn,
					'uts'=>$uts,
					'uas'=>$uas,
					'tugas'=>$tugas,
					'semester'=>$semester,
				]);
				}
				
				$numrow++;
			}
			//echo json_encode($data);
			foreach($data as $row) {
				$input = array(
					'id_mahasiswa'=>$row['id_mahasiswa'],
					'id_matkul'=>$row['id_matkul'],
					'id_dosen'=>$row['id_dosen'],
					'uts'=>$row['uts'],
					'uas'=>$row['uas'],
					'tugas'=>$row['tugas'],
					'semester'=>$row['semester']
				);
				//echo json_encode($input);
				$where = array(
					'id_mahasiswa' => $row['id_mahasiswa'],
					'id_matkul' => $row['id_matkul'],
					'id_dosen' => $row['id_dosen']
				);
		
				$cek = $this->M_Nilai->cek_nilai($where, 'nilai');
				if($cek){
					$this->db->where($where);
					$this->db->update('nilai', $input);
				} else {
					$this->db->insert('nilai', $input);
				}
			}
			
			$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Berhasil disimpan.</div>');
			redirect("nilai");
	  }

	function hapus($id){
		$where = array('id' => $id);
		$this->M_Nilai->hapus_data($where, 'nilai');
		redirect('nilai');
	}
}