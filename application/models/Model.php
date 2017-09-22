<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model {
		public $variable; 

        public function __construct()
        {
                $this->load->database();
        }
	public function GetPegawai()
	{
		$query = $this->db->get('pegawai');
		return $query->result_array();
	}

	public function editPegawai($Id){
		
		
		$this->db->where('Id', $Id);
		$query =  $this->db->get('pegawai');
		return $query->row(); //kalau mau menampilkan data mmg hrs pakai $query->row()
			
	}

	public function GetPegawaiInsert($table,$data)
	{
		$this->db->insert($table,$data);
			if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
	}

	public function GetPegawaiUpdate($table,$data)
	{
		$this->db->where('Id', $data['Id']);
	    $this->db->update($table, $data);
	    if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}
	}

	public function deletePegawai($Id){
		$this->db->delete('pegawai',array('Id'=>$Id));
	    if($this->db->affected_rows() > 0){
				return true;
			}else{
				return false;
			}

	}

}

/* End of file  Model.php */
/* Location: ./application/models/ Model.php */