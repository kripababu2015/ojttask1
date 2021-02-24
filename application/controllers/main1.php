<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main1 extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	//first loading page
	public function index()
	{
		$this->load->view('reg');
	}
	

	//user home page
	public function trexam()
	{
		$this->load->view('trexam');

	}
	
	//registration page
	public function register()
	{
		$this->load->view('reg');
	}


	//Registration Action or data insertion
	public function regi()
	{
		//$this->load->helper(array('form', 'url'));
		$this->load->library("form_validation");
		$this->load->library("form_validation");
		$this->form_validation->set_rules("fname","name",'required|max_length[25]|alpha');
		$this->form_validation->set_rules("lname","last name",'required|max_length[25]|alpha');
		$this->form_validation->set_rules("phno","phone number",'required|max_length[10]|numeric');
		$this->form_validation->set_rules("email","email",'required|valid_email');
		$this->form_validation->set_rules("uname","user name",'required|max_length[10]|alpha');
		$this->form_validation->set_rules("password","password",'required');


		if($this->form_validation->run() == TRUE)
		{
			$this->load->model('mainmodel1');	
		$pass=$this->input->post("password");
		$encpass=$this->mainmodel1->encpswd($pass);
		$a=array("fname"=>$this->input->post("fname"),
				"lname"=>$this->input->post("lname"),
				"phno"=>$this->input->post("phno"),
				"email"=>$this->input->post("email"),
				"uname"=>$this->input->post("uname"),
				"password"=>$encpass,'status'=>'0','utype'=>'0');
		// $b=array("uname"=>$this->input->post("uname"),
		// 		"password"=>$encpass,'status'=>'0','utype'=>'0');
		$this->mainmodel1->regi($a);
		redirect(base_url().'main1/register');
		}
		// else
		// {
		// 	$this->load->view('myform');

		// }

		
	}
	
	//view page Approval/reject 
	public function viewregap()
	{
		$this->load->model('mainmodel1');
		$data['n']=$this->mainmodel1->viewt();
		$this->load->view('viewregap',$data);

	}
	//approve action 
	public function approve()
	{

		$this->load->model('mainmodel1');
		$id=$this->uri->segment(3);
		$this->mainmodel1->approve($id);
		redirect('main1/viewregap','refresh');
		
	}

	//reject action page
	public function reject()
	{

		$this->load->model('mainmodel1');
		$id=$this->uri->segment(3);
		$this->mainmodel1->reject($id);
		redirect('main1/viewregap','refresh');
		
	}

	//login view page
	public function login()
	{
		$this->load->view('log');

	}


	//login Check
	public function logincheck()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("uname","uname",'required');
		$this->form_validation->set_rules("password","password",'required');
		if($this->form_validation->run())
		{
		
			$this->load->model('mainmodel1');	
			$uname=$this->input->post("uname");
			$password=$this->input->post("password");
			$a=$this->mainmodel1->logi($uname,$password);
			if($a)
			{
			$id=$this->mainmodel1->getuserid($uname);
			$user=$this->mainmodel1->getuser($id);
			$this->load->library(array('session'));
			$this->session->set_userdata(array('id'=>(int)$user->id,
				'status'=>$user->status,'utype'=>$user->utype));
			if($_SESSION['status']=='1' && $_SESSION['utype']=='1')
			{
				redirect(base_url().'main1/viewregap');
			}
			elseif($_SESSION['status']=='1' && $_SESSION['utype']=='0')
			{
				redirect(base_url().'main1/trexam');
			}
			else
			{
				echo "waiting for approval";

			}
		}
		else
		{
			echo "invalid user";
		}
	}
	else
	{
		redirect(base_url().'main/reg');
	}
}


}