<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            // Your own constructor code
    }
    function render_page($content, $data = NULL){

        $data['header'] = $this->load->view('templates/header', $data, TRUE);
        $data['content'] = $this->load->view($content, $data, TRUE);
        $data['footer'] = $this->load->view('templates/footer', $data, TRUE);
        
        $this->load->view('templates/main', $data);
    }
}