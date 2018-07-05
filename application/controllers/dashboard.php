<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
 
	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	public function index() {
		$this->render_page('pages/v_dashboard');
	}
}