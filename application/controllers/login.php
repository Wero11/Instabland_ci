<?php 
/*
 * This is the Controller for the Login page
 * 
 * @author: SM
 */

class Login extends CI_Controller{

  	function __construct()
  	{
  		header('Access-Control-Allow-Origin: *');
  		parent::__construct();
  	    $this->load->model('login_model');
    }
	
	public function index(){
		$this->session->set_userdata('user', '');
		$this->session->set_userdata('admin', '');
		$data['current_view'] = 'login_view';
		$data['page_id'] = 0;
		$this->load->view('include/header');
		$this->load->view('templates/login',$data);
		$this->load->view('include/footer');
	}
	
	public function check(){
		$user_email = $_REQUEST["email"];
		$user_pass = $_REQUEST["password"];

		$result = $this->login_model->Isadmin($user_email, $user_pass);
		if ($result == 'true'){
			if ( $this->session->userdata('admin') ) {
				redirect('../category');
			} else {
				redirect('../gallery');
			}
		}else{
			$data['error'] = 'Failed';
			redirect('/');
		}
	}
}