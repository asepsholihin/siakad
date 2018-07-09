<?php 
error_reporting(0);
 defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Nilai extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Laporan_Nilai');
		$this->load->model('M_Nilai');
		$this->load->model('M_Upload');
		$this->load->model('M_User');
		$this->load->model('M_Dosen');
		$this->load->model('M_Prodi');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}
 
	public function index() {
		$data['mahasiswa'] = array();
		$data['matkul'] = $this->M_Dosen->ambil_matkul_();
		$this->render_page('pages/laporan_nilai/v_laporan_nilai', $data);
	}

	public function matkul($id_matkul,$semester) {
		if($id_matkul == 0) {
			redirect('laporan_nilai');	
		} else {
			$data['mahasiswa'] = $this->M_Nilai->get_data_kelas($this->session->userdata("id_user"),$id_matkul,$semester);
			$data['matkul'] = $this->M_Dosen->ambil_matkul_();
			$this->render_page('pages/laporan_nilai/v_laporan_nilai', $data);
		}
	}

	public function download($semester,$prodi='') {
		$data['semester'] = $semester;
		$data['mahasiswa'] = $this->db->query("SELECT * FROM mahasiswa LEFT JOIN nilai ON nilai.id_mahasiswa = mahasiswa.nim WHERE mahasiswa.semester='".$semester."' AND mahasiswa.id_prodi='".$prodi."' GROUP BY mahasiswa.nim")->result();
		$this->load->view('pages/laporan_nilai/v_print_nilai', $data);   
	}

	public function laporan($semester = '', $prodi = '') {
		$data['semester'] = $semester;
		$data['prodi'] = $this->M_Prodi->ambil_prodi_();
		$data['mahasiswa'] = $this->db->query("SELECT * FROM mahasiswa LEFT JOIN nilai ON nilai.id_mahasiswa = mahasiswa.nim WHERE mahasiswa.semester='".$semester."' AND mahasiswa.id_prodi='".$prodi."' GROUP BY mahasiswa.nim")->result();
		$this->render_page('pages/laporan_nilai/v_laporan_nilai_admin', $data);   
	}

	function transkrip_nilai($nim,$semester) {
		$data['semester'] = $semester;
		$data['transkrip'] = $this->M_Laporan_Nilai->print_transkrip($nim,$semester)->result();
		$this->load->view('pages/laporan_nilai/v_transkrip', $data);
	}
	
	public function createXLS($id_matkul,$semester) {
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();	
	
		if($this->session->userdata('role') == "dosen") {	
			$where = "nilai.id_dosen LIKE '%".$this->session->userdata("id_user")."%' AND ";	
		} else if($this->session->userdata('role') == "dosen_wali") {	
			$where = "mahasiswa.id_dosen LIKE '%".$this->session->userdata("id_user")."%' AND ";	
		} else if($this->session->userdata('role') == "kajur") {	
			$join = "JOIN dosen ON dosen.id_prodi = mahasiswa.id_prodi";	
			$group = "GROUP BY mahasiswa.nim";	
		} else if($this->session->userdata('role') == "wadir1" || $this->session->userdata('role') == "admin") {
			$join = "";	
			$group = "GROUP BY mahasiswa.nim";	
		}
	
		$data = $this->db->query("	
		SELECT	
		mahasiswa.nim,	
		mahasiswa.nama,	
		matkul.nama as matkul, matkul.sks,	
		nilai.uts, nilai.uas, nilai.tugas,	
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria.uts/100 ELSE '' END) AS total_uts,	
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria.uas/100 ELSE '' END) AS total_uas,	
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria.tugas/100 ELSE '' END) AS total_tugas	
		FROM nilai 	
		JOIN matkul ON matkul.id = nilai.id_matkul	
		RIGHT JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim	
		".$join."	
		JOIN kriteria ON nilai.id_matkul = kriteria.id_matkul AND nilai.id_matkul='".$id_matkul."' WHERE ".$where." nilai.semester='".$semester."' ".$group."");	
	
		$tambah_field = array('NIM','Nama', 'Mata Kuliah', 'SKS', 'UTS', 'UAS', 'Tugas', 'Nilai Akhir', 'Nilai Mutu');	
		$tambah = array('nilai_akhir', 'nilai_mutu');	
		$fields = array_merge($data->list_fields(), $tambah);	
			
		unset($fields[7],$fields[8],$fields[9]);	
			
		$col = 0;	
		foreach ($tambah_field as $field)	
		{	
			//echo json_encode($field);	
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);	
			$col++;	
		}	
 	
			
			
		$row = 2;	
			
		foreach($data->result() as $value)	
		{	
				
			$value->nilai_akhir = $value->total_uts+$value->total_uas+$value->total_tugas;	
			$value->nilai_mutu = $this->M_Nilai->grading($value->nilai_akhir);	
			unset($value->total_uts, $value->total_uas, $value->total_tugas);	
				
				
			$col = 0;	
			foreach ($fields as $field)	
			{	
				//echo json_encode($value->$field);	
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
	
		$matkul = $this->db->get_where('matkul', array('id' => $id_matkul))->row();	
	
		header('Content-Disposition: attachment;filename="Nilai-'.$matkul->nama.'-Semester-'.$semester.'.xlsx"');	
	
		$objWriter->save("php://output");      	
	}
}