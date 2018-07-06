<?php 
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

	public function createXLS() {
		//membuat objek
		$this->load->library('excel');
		
		$objPHPExcel = new PHPExcel();
		$data = $this->db->get('users');

		// Nama Field Baris Pertama
		$fields = $data->list_fields();
		$col = 0;
		foreach ($fields as $field)
		{
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
			$col++;
		}
 
		// Mengambil Data
		$row = 2;
		foreach($data->result() as $data)
		{
			$col = 0;
			foreach ($fields as $field)
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
				$col++;
			}
 
			$row++;
		}
		$objPHPExcel->setActiveSheetIndex(0);

		//Set Title
		$objPHPExcel->getActiveSheet()->setTitle('Data Absen');

		//Save ke .xlsx, kalau ingin .xls, ubah 'Excel2007' menjadi 'Excel5'
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

		//Header
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		//Nama File
		header('Content-Disposition: attachment;filename="absen.xlsx"');

		//Download
		$objWriter->save("php://output");      
    }
}