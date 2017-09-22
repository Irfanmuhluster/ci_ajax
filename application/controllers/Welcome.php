<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
              
			$this->load->model('model');
            $this->load->library('form_validation');
            $this->load->library('session');
                //$this->load->helper('url');
            $this->load->helper(array('form', 'url'));
             
        }


	public function index()
	{
		$data = array(
			'isi' => 'apa/layout/isi');
		
		$this->load->view('apa/layout/dashboard',$data); 
	}

	public function getPegawai(){
		$result = $this->model->GetPegawai();
		echo json_encode($result);
	}

	public function GetPegawaiInsert(){
		
			$nama = $this->input->post('Nama');
			$alamat = $this->input->post('Alamat');
			$umur = $this->input->post('Umur');
		
				$data = array(
								'Nama' => $nama,
								'Alamat' => $alamat,
								'Umur' => $umur
					);
				
		
			$result = $this->model->GetPegawaiInsert('pegawai',$data);
			$msg['type'] = 'tambah';
			$msg['success'] = false;
			if($result){
					$msg['success'] = true;
			}else{
					$msg['success'] = false;
			}
			echo json_encode($msg);	
	}

	public function EditPegawai()
	{
			$Id = $this->input->get('id');
			$result	= $this->model->editPegawai($Id); //return bisa disini bisa dimodel
			
			echo json_encode($result);	

	}
	
	public function UpdatePegawai(){
			$Id = $this->input->post('Id');
			$nama = $this->input->post('Nama');
			$alamat = $this->input->post('Alamat');
			$umur = $this->input->post('Umur');
				$data = array(
								'Id' => $Id,
								'Nama' => $nama,
								'Alamat' => $alamat,
								'Umur' => $umur
					);
			$result = $this->model->GetPegawaiUpdate('pegawai',$data);
			$msg['type'] = 'update';
			$msg['success'] = false;
			if($result){
					$msg['success'] = true;
			}else{
					$msg['success'] = false;
			}
			echo json_encode($msg);	
	}

	public function DeletePegawai(){
		$Id = $this->input->get('id');
		$result = $this->model->deletePegawai($Id);
		//$msg['type'] = 'hapus';
			$msg['success'] = false;
			if($result){
					$msg['success'] = true;
			}else{
					$msg['success'] = false;
			}
			echo json_encode($msg);	

	}

	public function new_func()
	{
		echo 'Hello world';
	}
	
}
