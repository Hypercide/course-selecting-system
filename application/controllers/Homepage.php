<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Index
*/
class Homepage extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		session_check();
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function studentindex()
	{
		$this->load->view('student_index');
	}

	public function mainview()
	{
		$this->load->view('main');
	}

	public function studentmainview()
	{
		$this->load->view('student_main');
	}

	public function course()
	{
		$this->load->view('course/courseList.html');
	}

	public function choose()
	{
		$this->load->view('course/courseChoose.html');
	}

	public function user()
	{
		$this->load->view('user/userList.html');
	}

	public function userchoosen()
	{
		$this->load->view('user/userChoosen.html');
	}

	public function signout()
	{
		session_unset();
		session_destroy();
		$this->load->view('Login');
	}
}
	
 ?>