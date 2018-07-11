<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_Kuisioner extends MY_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('M_Mahasiswa');
		$this->load->model('M_Dosen');
		$this->load->model('M_Prodi');
		$this->load->model('M_Kuisioner');
		$this->load->model('M_Matkul');
		$this->load->model('M_Laporan_Kuisioner');
		$this->load->helper('url');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
        }
        
	}
 
	public function index() {
        $id_matkul = 0;
        $data['laporan_kuisioner'] = $this->M_Laporan_Kuisioner->get_data($id_matkul)->result();
        $data['dosen'] = $this->M_Dosen->ambil_dosen();
        $data['matkul'] = $this->M_Matkul->ambil_matkul_dosen($this->session->userdata('id_user'));
        $data['id_matkul'] = $id_matkul;
		$this->render_page('pages/laporan_kuisioner/v_laporan_kuisioner', $data);
    }

    public function matkul($id_dosen='',$id_matkul='') {
        $data['dosen'] = $this->M_Dosen->ambil_dosen();
        $data['matkul'] = $this->M_Matkul->ambil_matkul_dosen($this->session->userdata('id_user'));
        $data['id_matkul'] = $id_matkul;
        $data['laporan_kuisioner'] = $this->M_Laporan_Kuisioner->get_data($id_dosen,$id_matkul)->result();
        //echo $this->db->last_query();
        $this->render_page('pages/laporan_kuisioner/v_laporan_kuisioner', $data);
    }

    public function matakuliah($id_matkul='') {
        $data['dosen'] = $this->M_Dosen->ambil_dosen();
        $data['matkul'] = $this->M_Matkul->ambil_matkul_dosen($this->session->userdata('id_user'));
        $data['id_matkul'] = $id_matkul;
        $data['laporan_kuisioner'] = $this->M_Laporan_Kuisioner->get_data_dosen($id_matkul)->result();
        //echo $this->db->last_query();
        $this->render_page('pages/laporan_kuisioner/v_laporan_kuisioner', $data);
    }

    public function hasil_kuisioner() {
        $data['prodi'] = $this->M_Prodi->ambil_prodi();
		$data['dosen'] = $this->M_Dosen->ambil_dosen();
        $data['matkul'] = $this->M_Matkul->ambil_matkul();
        
        $sql = $this->db->query("SELECT kategori FROM referensi_kuisioner WHERE jenis !='esai' GROUP BY kategori");
        
        $data['ref_kategori'] = array();
        
        foreach($sql->result() as $row) {

            $data['ref_kategori'][] = $row;
            
        }

        $data['esai'] = $this->db->query("SELECT id,kode,pertanyaan FROM referensi_kuisioner WHERE jenis ='esai' GROUP BY kategori")->result();
        
		$this->render_page('pages/laporan_kuisioner/v_hasil_kuisioner', $data);
    }
    
    // function hasil_kuisioner($id_mahasiswa) {
    //     $data['kuisioner'] = $this->M_Laporan_Kuisioner->ambil_kuisioner($id_mahasiswa)->result();
    //     echo json_encode($data['kuisioner']);
    //     //$this->render_page('pages/laporan_kuisioner/v_laporan_kuisioner', $data);
    // }
}