<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* reg
*/
class Reg extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function s_id_check()
	{
		$s_id = $this->input->post('s_id',true);

		$sql="select id from ".$this->db->dbprefix('student')." where s_id='{$s_id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$arr['digit'] = '1';
		
		if ($result) {
			echo json_encode($arr);
		}else{
		    $arr['digit'] = '2';
		    echo json_encode($arr);
		}
	}

	public function reg_check()
	{
		$data = $this->input->post();
		$s_id = $data['s_id'];
		$data['password'] = md5($data['password']);

		$sql="select id from ".$this->db->dbprefix('student')." where s_id='{$s_id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$arr['digit'] = '1';

		if (!$result) {
			$this->db->insert('student', $data);
			echo json_encode($arr);
		}else{
		    $arr['digit'] = '2';
		    echo json_encode($arr);
		}
	}
}

 ?>