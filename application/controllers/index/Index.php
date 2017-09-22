<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
public function __construct()
    {
		parent::__construct();
       
		$this->load->model('model', 'model', TRUE);
	}
public function index(){
	
	
	$this->load->view('apa/layout/dashboard');
	//$this->load->view('admin/layout/dashboard_admin',$data);
	
	
}




}



?>