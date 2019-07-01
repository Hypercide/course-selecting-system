<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Index
*/
class User extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		session_check();
	}

	public function index()
	{
		$this->load->view('user/userList.html');
	}

	public function userdata()
	{
		$sql="select * from ".$this->db->dbprefix('student')." where s_id='{$_SESSION['s_id']}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();

		$this->load->view('user/userData',$result);
	}

	public function changepwd()
	{
		$this->load->view('user/changepwd');
	}

	public function oldpwd_check($oldpwd)
	{
		$oldpwd = md5($oldpwd);
		$sql="select password from ".$this->db->dbprefix('student')." where s_id='{$_SESSION['s_id']}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();

		if ($oldpwd == $result['password']) {
			$arr['digit'] = '1';
			echo json_encode($arr);
		}else{
			$arr['digit'] = '2';
			echo json_encode($arr);
		}
		
	}

	public function changepwd_check()
	{
		$data = $this->input->post();
		$data['password'] = md5($data['password']);
		$arr['digit'] = '1';

		$this->db->where('s_id',$_SESSION['s_id']);
		$this->db->update('student', $data);
		echo json_encode($arr);
	}

	public function getusercount()
	{
		$sql = "select count(id) from ".$this->db->dbprefix('student');
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$count = $result['count(id)'];

		$arr['count'] = $count;
		echo json_encode($arr);
	}

	public function getuserlist()
	{
	    $sql = "select count(id) from ".$this->db->dbprefix('student');
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$count = $result['count(id)'];

		$page_num = isset($_GET['limit'])?$_GET['limit']:10;	//接收limit，每页显示多少条数据
		$pages = ceil($count/$page_num);				  		//总页数，向上取整
		$page = isset($_GET['page'])?$_GET['page']:1;			//当前页数
		$startpos = ($page - 1)*$page_num;

		$sql = "select * from ".$this->db->dbprefix('student')." order by id asc limit $startpos,$page_num";
		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data = array(
			"code" => 0,
			"msg" => "",
			"count" => $count,
			"data" => $result
		);

	    echo json_encode($data);
	}

	public function useradd()
	{
		$this->load->view('user/userAdd.html');
	}

	public function addimg()
	{
		$files = $_FILES['pics'];
		
		$filename = "";
		
		$arr = explode(".",$files["name"]);
		$max = count($arr)-1;

		$ext = strtolower($arr[$max]);
		
		$filename = time().rand(100,9999).".".$ext;
		move_uploaded_file($files["tmp_name"], FCPATH."public/images/".$filename);

		$data = array(
			"code" => 0,
			"msg" => "",
			"data" => $filename
		);
		echo json_encode($data);
	}

	public function getMajorSelect($majored)
	{
		$sql="select * from ".$this->db->dbprefix('major')." order by major_id asc";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$str="";
		if($result){
			$str.="<select name='major'>";
			foreach ($result as $row){
				$id=$row["major_id"];
				$name=$row["major_name"];
				if ($id==$majored) {
					$str.="<option value='$id' selected >".$name."</option>";
				}else{
					$str.="<option value='$id'>".$name."</option>";
				}
			}
			$str.="</select>";
		}

		$data = array(
			"data" => $str
		);

		echo json_encode($data);
	}

	public function s_id_check()
	{
		$s_id = $this->input->post('s_id',true);

		$sql="select username from ".$this->db->dbprefix('student')." where s_id='{$s_id}'";
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

	public function add_check()
	{
		$data = $this->input->post();
		$s_id = $data['s_id'];
		$data['password'] = md5($data['password']);

		$sql="select username from ".$this->db->dbprefix('student')." where s_id='{$s_id}'";
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

	public function useredit($id)
	{
		$sql="select * from ".$this->db->dbprefix('student')." where id='{$id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();

		$this->load->view('user/userEdit',$result);
	}

	public function edit_check()
	{
		$data = $this->input->post();
		$id = $data['id'];
		$arr['digit'] = '1';

		$this->db->where('id',$id);
		$this->db->update('student', $data);
		echo json_encode($arr);
	}

	public function userinfo()
	{

		$this->load->view('user/userInfo');
	}

	public function moreinfo($id)
	{
		$sql="select * from ".$this->db->dbprefix('student')." where id='{$id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();

		$this->load->view('user/userInfo',$result);
	}

	public function userdel($id)
	{
		$sql="select profilephoto from ".$this->db->dbprefix('student')." where id='{$id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		if ($result['profilephoto']!="default.jpg") {
			$filename = FCPATH . "public/images/" . $result['profilephoto'];
			unlink($filename);
		}
		
		$sql = "delete from ".$this->db->dbprefix('student')." where id={$id}";
		$query = $this->db->query($sql);
	}

	public function userdels()
	{
		$userId = $_GET['userId'];
		if ($userId) {
			foreach ($userId as $row){
				$id = $row;
				$sql = "select profilephoto from ".$this->db->dbprefix('student')." where id='{$id}'";
				$query = $this->db->query($sql);
				$result = $query->row_array();
				if ($result['profilephoto']!="default.jpg") {
					$filename = FCPATH . "public/images/" . $result['profilephoto'];
					unlink($filename);
				}
				
				$sql = "delete from ".$this->db->dbprefix('student')." where id={$id}";
				$query = $this->db->query($sql);
			}
		}
	}

	public function getchoosen()
	{
		$sql = "select count(choosen_id) from ".$this->db->dbprefix('choosen')." where s_id=".$_SESSION['s_id'];
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$count = $result['count(choosen_id)'];

		$page_num = isset($_GET['limit'])?$_GET['limit']:10;	//接收limit，每页显示多少条数据
		$pages = ceil($count/$page_num);				  		//总页数，向上取整
		$page = isset($_GET['page'])?$_GET['page']:1;			//当前页数
		$startpos = ($page - 1)*$page_num;

		$sql = "select * from ".$this->db->dbprefix('choosen')." where s_id=".$_SESSION['s_id']." order by course_id asc limit $startpos,$page_num";
		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data = array(
			"code" => 0,
			"msg" => "",
			"count" => $count,
			"data" => $result
		);

	    echo json_encode($data);
	}

	public function choosendel($choosen_id,$course_id)
	{
		$sql="select * from ".$this->db->dbprefix('course')." where course_id='{$course_id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();

		$result['course_remain'] = $result['course_remain'] + 1;	//课余量-1
		$this->db->where('course_id',$course_id);
		$this->db->update('course', $result);

		$sql = "delete from ".$this->db->dbprefix('choosen')." where choosen_id={$choosen_id}";
		$query = $this->db->query($sql);
	}

	public function getuserchoosencount()
	{
		$sql = "select count(choosen_id) from ".$this->db->dbprefix('choosen')." where s_id='{$_SESSION['s_id']}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$count = $result['count(choosen_id)'];

		$arr['count'] = $count;
		echo json_encode($arr);
	}

	public function getuserchoosenlist($s_id)
	{
		$sql = "select count(choosen_id) from ".$this->db->dbprefix('choosen')." where s_id='{$s_id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$count = $result['count(choosen_id)'];

		$page_num = isset($_GET['limit'])?$_GET['limit']:10;	//接收limit，每页显示多少条数据
		$pages = ceil($count/$page_num);				  		//总页数，向上取整
		$page = isset($_GET['page'])?$_GET['page']:1;			//当前页数
		$startpos = ($page - 1)*$page_num;

		$sql = "select * from ".$this->db->dbprefix('choosen')." where s_id='{$s_id}'"." order by choosen_id asc limit $startpos,$page_num";
		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data = array(
			"code" => 0,
			"msg" => "",
			"count" => $count,
			"data" => $result
		);

	    echo json_encode($data);
	}

	public function getechartsdata()
	{
		$sql = "select major_name from ".$this->db->dbprefix('major');
		$query = $this->db->query($sql);
		$result = $query->result_array();
		
		echo json_encode($result);
	}
}
	
 ?>