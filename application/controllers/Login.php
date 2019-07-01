<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* login
*/
class Login extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login_check()
	{
		$s_id = $this->input->post('s_id',true);
		$password = $this->input->post('password');
		$password = md5($password);

		$sql="select username, profilephoto, level from ".$this->db->dbprefix('student')." where s_id='{$s_id}' and password='{$password}' union all select username, profilephoto, level from ".$this->db->dbprefix('admin')." where username='{$s_id}' and admin_password='{$password}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		// var_dump($result);
		$arr['digit'] = '1';
		
		if ($result) {
		    $time=time();
		    $sql="UPDATE ".$this->db->dbprefix('student')." SET lastlogintime='{$time}' where s_id='{$s_id}'";
			$query = $this->db->query($sql);
		    
			if ($result['level']==='0') {
				$newdata = array(
					's_id'				=> $s_id,
				    'username'			=> $result['username'],
				    'profilephoto'		=> $result['profilephoto']
				);
				$this->session->set_userdata($newdata);
		    	echo json_encode($arr);
			}else if ($result['level']==='1') {
				$newdata = array(
				    'username'			=> $result['username'],
				    'profilephoto'		=> $result['profilephoto']
				);
				$this->session->set_userdata($newdata);
				$arr['digit'] = '2';
		    	echo json_encode($arr);
			}
		}else{
		    $arr['digit'] = '3';
		    echo json_encode($arr);
		}
	}

	public function reg()
	{
		$this->load->view('reg');
	}

}

 ?>