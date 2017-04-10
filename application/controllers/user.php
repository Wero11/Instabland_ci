<?php 
/*
 * This is the Controller for the Lodge page
 * 
 * @author: SM
 */

class User extends CI_Controller{

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
  		parent::__construct();
  		$this->load->helper("url");
  		$this->load->model('user_model');
  		$this->load->library('upload');
  		$this->load->library("pagination");
  	}
	
	public function index(){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
		
		$data = $this->fetchPage();
		$data_m['admin'] = $this->session->userdata('admin');
		$data_m['current_view'] = 'user_view';
		$data_m['page_id'] = 0;
		
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/user', $data);
		$this->load->view('include/footer');
	}
	
	public function listapi(/*$offset=0*/){
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		
		$user_data = $this->user_model->getList($email,$password);
		$rescode = (count($user_data)) > 0 ? 'success' : 'fail';
		$data['rescode'] = $rescode;
		$data['response'] = $user_data;
		echo json_encode($data);
		exit;
	}
	
	public function fetchPage() {
		$config = array();
		$config["base_url"] = base_url() . "user/index";
		$config["total_rows"] = $this->user_model->record_count();
		$config["per_page"] = 20;
		$config["uri_segment"] = 3;
		$config['num_links'] = 10;
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
	
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["user_list"] = $this->user_model->fetch_all_users($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
		$data["pagenum"] = $page;
		
		return $data;
	}
	
	public function add($page=0){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
		
		$data_m['admin'] = $this->session->userdata('admin');
		$data_m['current_view'] = 'user_add';
		$data_m['page_id'] = 1;
		$data['pagenum'] = $page;
		
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/user_add',$data);
		$this->load->view('include/footer');
	}
	
	public function save(){
		$data = $this->input->post();
		$page = $data['page'];
		
		unset($data['page']);
		
		$user_result = $this->user_model->addRow($data);
		redirect('../user/index');
	}
	
	public function edit($page=0,$id=1){
		if ( $this->session->userdata('user') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
		
		$user = $this->user_model->user_item($id);
		$data_m['admin'] = $this->session->userdata('admin');
		$data['item_detail'] = $user;
		$data["pagenum"] = $page;
		
		$data_m['current_view'] = 'user_edit';
		$data_m['page_id'] = 1;
		
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/user_edit', $data);
		$this->load->view('include/footer');
	}
	
	public function update(){
	
		$data = $this->input->post();
		$page = $data['page'];
		$id = $data['id'];
		
		if ( $data['password'] == '' ) {
			$row = $this->user_model->user_item($id);
			$data['password'] = $row->password;
		}
		
		if ( !isset($data['isAdmin']) ) $data['isAdmin'] = 0;
		
		unset($data['page']);
		unset($data['id']);
		
		$data1 = array(
				"userID" => $data["userID"],
				"email" => $data["email"],
				"password" => $data["password"],
				"isAdmin" => $data["isAdmin"],
		);
		
		$user_result = $this->user_model->updateRow($id, $data1);
		
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect('../user/mine');
		} else {
			redirect('../user/index');
		}
	}
	
	public function delete($page=0,$id=1){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
		
		$this->user_model->deleteRow($id);
		redirect('../user/index');
	}
	
	public function mine(){
		if ( $this->session->userdata('user') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
		
		$id = $this->session->userdata('mine');
		$user = $this->user_model->user_item($id);
		
		$data_m['admin'] = $this->session->userdata('admin');
		$data['user_list'] = array($user);
		$data["links"] = "";
		$data["pagenum"] = 0;
		$data["mine"] = 1;
		
		$data_m['current_view'] = 'user_view';
		$data_m['page_id'] = 0;
		
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/user', $data);
		$this->load->view('include/footer');
	}
}