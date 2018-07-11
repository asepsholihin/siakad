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
		$this->load->model('M_Kelas');
		$this->load->model('M_Prodi');
		$this->load->model('M_Kriteria_Nilai');
		$this->load->model('M_Matkul');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}

	}
 
	public function index() {
		$data['mahasiswa'] = array();
		if($this->session->userdata('role') == 'admin') {
			$data['kelas'] = $this->M_Kelas->ambil_kelas();
			$data['matkul'] = $this->M_Matkul->ambil_matkul();
		} else if($this->session->userdata('role') == 'dosen' || $this->session->userdata('role') == 'walikelas'){
			redirect('laporan_nilai/laporan');
		} else if($this->session->userdata('role') == 'kajur') {
			redirect('laporan_nilai/laporan');
		} else if($this->session->userdata('role') == 'wadir1') {
			redirect('laporan_nilai/laporan');
		}
		$this->render_page('pages/laporan_nilai/v_laporan_nilai', $data);
	}

	public function matkul($id_kelas='',$id_matkul='') {
		if($this->session->userdata('role') == 'admin') {
			$data['kelas'] = $this->M_Kelas->ambil_kelas();
			$data['matkul'] = $this->M_Matkul->ambil_matkul();
		} else if($this->session->userdata('role') == 'dosen'){
			$data['kelas'] = $this->M_Nilai->ambil_kelas($this->session->userdata('id_user'));
			$data['matkul'] = $this->M_Matkul->ambil_matkul_dosen($this->session->userdata('id_user'));
		} else if($this->session->userdata('role') == 'kajur') {
			$id_prodi = $this->db->get_where('dosen', array('nidn' => $this->session->userdata('id_user')))->row()->id_prodi;
			$data['matkul'] = $this->M_Matkul->ambil_matkul_jurusan($id_prodi);
			$data['kelas'] = $this->M_Kelas->ambil_kelas_jurusan($id_prodi);
		} else if($this->session->userdata('role') == 'wadir1') {
			$data['matkul'] = $this->M_Matkul->ambil_matkul();
			$data['kelas'] = $this->M_Kelas->ambil_kelas();
		}

		$data['mahasiswa'] = $this->M_Nilai->get_data_kelas($id_matkul,$id_kelas);
		//echo $this->db->last_query();
		$this->render_page('pages/laporan_nilai/v_laporan_nilai', $data);
	}

	public function download($semester='', $id_prodi='') {
		$data['semester'] = $semester;
		$data['id_prodi'] = $id_prodi;
		$data['prodi'] = $this->M_Prodi->ambil_prodi();
		$data['mahasiswa'] = $this->db->query("SELECT mahasiswa.* FROM mahasiswa JOIN kelas ON kelas.id = mahasiswa.id_kelas WHERE kelas.id_prodi='".$id_prodi."' GROUP BY mahasiswa.nim")->result();
		$this->load->view('pages/laporan_nilai/v_print_nilai', $data);   
	}

	public function download_kelas($semester='',$id_kelas='',$id_prodi='') {
		$data['mahasiswa'] = $this->db->query("SELECT mahasiswa.* FROM mahasiswa JOIN kelas ON kelas.id = mahasiswa.id_kelas WHERE kelas.id='".$id_kelas."' GROUP BY mahasiswa.nim")->result();
		//echo $this->db->last_query();

		if($id_prodi == '') {
			$prodi = $this->db->query("SELECT * FROM kelas JOIN prodi ON kelas.id_prodi = prodi.id WHERE kelas.id='".$id_kelas."'")->row();
			redirect('laporan_nilai/download_kelas/'.$semester.'/'.$id_kelas.'/'.$prodi->id.'');
		}

		$data['id_prodi'] = $id_prodi;
		$data['semester'] = $semester;
		$data['id_kelas'] = $id_kelas;
		$this->load->view('pages/laporan_nilai/v_print_nilai', $data);   
	}

	public function laporan($semester='', $id_prodi='') {
		$data['semester'] = $semester;
		$data['id_prodi'] = $id_prodi;
		
		if($this->session->userdata('role') == 'kajur') {
			$data['prodi'] = $this->M_Prodi->ambil_prodi_jurusan($this->session->userdata('id_user'));
		} else {
			$data['prodi'] = $this->M_Prodi->ambil_prodi();
		}

		$data['kelas'] = $this->M_Kelas->ambil_kelas();
		
		$data['mahasiswa'] = $this->db->query("SELECT mahasiswa.* FROM mahasiswa JOIN nilai ON nilai.id_mahasiswa = mahasiswa.nim JOIN kelas ON kelas.id = mahasiswa.id_kelas WHERE kelas.id_prodi='".$id_prodi."' GROUP BY mahasiswa.nim")->result();
		$this->render_page('pages/laporan_nilai/v_laporan_nilai_admin', $data);   
	}

	function transkrip_nilai($nim,$semester,$id_prodi) {
		$data['semester'] = $semester;
		$data['id_prodi'] = $id_prodi;
		$data['transkrip'] = $this->M_Laporan_Nilai->print_transkrip($nim,$semester,$id_prodi)->result();
		$this->load->view('pages/laporan_nilai/v_transkrip', $data);
	}
	
	public function export($id_kelas, $id_matkul) {
		$this->load->library('excel');
		$objPHPExcel = new PHPExcel();

		if($this->session->userdata('role') == "admin" || $this->session->userdata('role') == "wadir1") {
			$where = "";
		} else {
			$where = "WHERE mahasiswa.id_kelas='".$id_kelas."'";
		}
			
		$data = $this->db->query("
		SELECT 
		mahasiswa.nim,	
		mahasiswa.nama,	
		matkul.nama as matkul, matkul.sks,	
		nilai.uts, nilai.uas, nilai.tugas,	
		(CASE WHEN nilai.uts IS NOT NULL THEN nilai.uts*kriteria_nilai.uts/100 ELSE '' END) AS total_uts,
		(CASE WHEN nilai.uas IS NOT NULL THEN nilai.uas*kriteria_nilai.uas/100 ELSE '' END) AS total_uas,
		(CASE WHEN nilai.tugas IS NOT NULL THEN nilai.tugas*kriteria_nilai.tugas/100 ELSE '' END) AS total_tugas,
		matkul.semester as semester
		FROM nilai 
		JOIN matkul ON matkul.id = nilai.id_matkul
		RIGHT JOIN mahasiswa ON nilai.id_mahasiswa = mahasiswa.nim
		JOIN kriteria_nilai ON nilai.id_dosen = kriteria_nilai.id_dosen AND nilai.id_matkul='".$id_matkul."' ".$where." GROUP BY mahasiswa.nim");
	
		$tambah_field = array('NIM','Nama', 'Mata Kuliah', 'SKS', 'UTS', 'UAS', 'Tugas', 'Nilai Akhir', 'Nilai Mutu', 'Semester');	
		$tambah = array('nilai_akhir', 'nilai_mutu', 'semester');	
		$fields = array_merge($data->list_fields(), $tambah);	
			
		unset($fields[7],$fields[8],$fields[9],$fields[10]);	
			
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
			$value->semester = $value->semester;	
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


		$matkul = $this->db->get_where('matkul', array('id' => $id_matkul))->row();	

		$objPHPExcel->setActiveSheetIndex(0);	
	
		$objPHPExcel->getActiveSheet()->setTitle('Nilai Semester '.$matkul->semester);	
	
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');	
	
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");	
		header("Cache-Control: no-store, no-cache, must-revalidate");	
		header("Cache-Control: post-check=0, pre-check=0", false);	
		header("Pragma: no-cache");	
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');	
	
	
		header('Content-Disposition: attachment;filename="Nilai-'.$matkul->nama.'-'.$matkul->semester.'.xlsx"');	
	
		$objWriter->save("php://output");      	
	}
}