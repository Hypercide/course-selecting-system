<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* course
*/
class Course extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('course/courseList.html');
	}

	public function getcourselist()
	{
		$sql = "select count(course_id) from ".$this->db->dbprefix('course');
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$count = $result['count(course_id)'];

		$page_num = isset($_GET['limit'])?$_GET['limit']:10;	//接收limit，每页显示多少条数据
		$pages = ceil($count/$page_num);				  		//总页数，向上取整
		$page = isset($_GET['page'])?$_GET['page']:1;			//当前页数
		$startpos = ($page - 1)*$page_num;

		$sql = "select * from ".$this->db->dbprefix('course')." order by course_id asc limit $startpos,$page_num";
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

	public function getcoursecount()
	{
		$sql = "select count(course_id) from ".$this->db->dbprefix('course');
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$count = $result['count(course_id)'];

		$arr['count'] = $count;
		echo json_encode($arr);
	}

	public function addcourse()
	{
		$this->load->view('course/courseAdd.html');
	}

	public function getTeacherSelect($teachered)
	{
		$sql="select * from ".$this->db->dbprefix('teacher')." order by teacher_name asc";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$str="";
		if($result){
			$str.="<select name='course_teacher'>";
			foreach ($result as $row){
				$name=$row["teacher_name"];
				if ($name==$teachered) {
					$str.="<option value='$name' selected >".$name."</option>";
				}else{
					$str.="<option value='$name'>".$name."</option>";
				}
				
			}
			$str.="</select>";
		}

		$data = array(
			"teacher" => $teachered,
			"data" => $str
		);

		echo json_encode($data);
	}

	public function course_id_check()
	{
		$course_id = $this->input->post('course_id',true);

		$sql="select course_name from ".$this->db->dbprefix('course')." where course_id='{$course_id}'";
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
		$course_id = $data['course_id'];

		$sql="select course_name from ".$this->db->dbprefix('course')." where course_id='{$course_id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$arr['digit'] = '1';

		if (!$result) {
			$this->db->insert('course', $data);
			echo json_encode($arr);
		}else{
		    $arr['digit'] = '2';
		    echo json_encode($arr);
		}
	}

	public function courseedit($id)
	{
		$sql="select * from ".$this->db->dbprefix('course')." where course_id='{$id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();

		$this->load->view('course/courseEdit',$result);
	}	

	public function edit_check()
	{
		$data = $this->input->post();
		$course_id = $data['course_id'];
		$arr['digit'] = '1';

		$this->db->where('course_id',$course_id);
		$this->db->update('course', $data);
		echo json_encode($arr);
	}

	public function moreinfo($course_id)
	{
		$sql="select * from ".$this->db->dbprefix('course')." where course_id='{$course_id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();

		$this->load->view('course/courseInfo',$result);
	}

	public function coursedel($id)
	{
		$sql = "delete from ".$this->db->dbprefix('course')." where course_id={$id}";
		$query = $this->db->query($sql);
	}

	public function coursedels()
	{
		$courseId = $_GET['courseId'];
		if ($courseId) {
			foreach ($courseId as $row){
				$id = $row;
				$sql = "delete from ".$this->db->dbprefix('course')." where course_id={$id}";
				$query = $this->db->query($sql);
			}
		}
	}

	public function choosecourse($id)
	{
		$sql="select * from ".$this->db->dbprefix('choosen')." where course_id='{$id}' and s_id='{$_SESSION['s_id']}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$arr['digit'] = '0';

		if ($result) {
			echo json_encode($arr);
		}else{
			$sql="select * from ".$this->db->dbprefix('course')." where course_id='{$id}'";
			$query = $this->db->query($sql);
			$result = $query->row_array();

			$course_name = $result['course_name'];
			$course_credit = $result['course_credit'];
			$course_theoryhour = $result['course_theoryhour'];
			$course_practicehour = $result['course_practicehour'];
			$course_testtype = $result['course_testtype'];
			$course_teacher = $result['course_teacher'];
			$course_remain = $result['course_remain'];

			if ($course_remain>0) {
				$result['course_remain'] = $result['course_remain'] - 1;	//课余量-1
				$this->db->where('course_id',$id);
				$this->db->update('course', $result);

				$data = array(
					's_id'					=>	$_SESSION['s_id'],
					'username'				=>	$_SESSION['username'],
					'course_id'				=>	$id,
					'course_name'			=>	$course_name,
					'course_credit'			=>	$course_credit,
					'course_theoryhour'		=>	$course_theoryhour,
					'course_practicehour'	=>	$course_practicehour,
					'course_testtype'		=>	$course_testtype,
					'course_teacher'		=>	$course_teacher,
					'choosen_addtime'		=>	time()
				);
				$this->db->insert('choosen',$data);

				$arr['digit'] = '1';
				echo json_encode($arr);
			}else{
				$arr['digit'] = '2';
				echo json_encode($arr);
			}
		}
	}

	public function getcoursechoosenlist($course_id)
	{
		$sql = "select count(choosen_id) from ".$this->db->dbprefix('choosen')." where course_id='{$course_id}'";
		$query = $this->db->query($sql);
		$result = $query->row_array();
		$count = $result['count(choosen_id)'];

		$page_num = isset($_GET['limit'])?$_GET['limit']:10;	//接收limit，每页显示多少条数据
		$pages = ceil($count/$page_num);				  		//总页数，向上取整
		$page = isset($_GET['page'])?$_GET['page']:1;			//当前页数
		$startpos = ($page - 1)*$page_num;

		$sql = "select * from ".$this->db->dbprefix('choosen')." where course_id='{$course_id}'"." order by choosen_id asc limit $startpos,$page_num";
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

}

 ?>