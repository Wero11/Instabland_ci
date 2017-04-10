<?php 
/*
 * This is the Controller for the Lodge page
 * 
 * @author: SM
 */

class Category extends CI_Controller{

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
  		parent::__construct();
  		$this->load->helper("url");
  		$this->load->model('category_model');
  		$this->load->library("pagination");
  	}
	
	public function index(){
		if ( $this->session->userdata('admin') != 'true' ) {
	      redirect( "/" );    // no session established, kick back to login page
	    }

	    $data = $this->fetchPage();
	    $data_m['admin'] = $this->session->userdata('admin');
		$data_m['current_view'] = 'category_view';
		$data_m['page_id'] = 0;
		
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/category', $data);
		$this->load->view('include/footer');
	}
	
	public function fetchPage() {
		$search = $this->input->post();
		
		if($search != null && !empty($search))
			$this->session->set_userdata('searchterm', $search);
		else if($search != null && empty($search))
			$this->session->set_userdata('searchterm', null);
		
		$search =  $this->session->userdata('searchterm');
		
		$config = array();
		$config["base_url"] = base_url() . "catetory/index";
		$config["total_rows"] = $this->category_model->record_count($search);
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
		$data["category_list"] = $this->category_model->fetch_categories($config["per_page"], $page,$search);
		$data["links"] = $this->pagination->create_links();
		$data["pagenum"] = $page;
		$data['search'] = $search;
		
		return $data;
	}
	
	public function add($page=0){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
	
		$data_m['current_view'] = 'category_edit';
		$data_m['admin'] = $this->session->userdata('admin');
		$data_m['page_id'] = 1;
		$data_m['user_index'] = $this->session->userdata('user_index');
		$data['pagenum'] = $page;
	
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/category_add',$data);
		$this->load->view('include/footer');
	}
	
	public function save(){
		$data = $this->input->post();
		$page = $data['page'];
	
		unset($data['page']);
	
		$category_result = $this->category_model->addRow($data);
		redirect('../category/index');
	}
	
	public function edit($page=0,$id=1){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
		
		$category = $this->category_model->category_item($id);
		$data['item_detail'] = $category;
		$data["pagenum"] = $page;
		
		$data_m['admin'] = $this->session->userdata('admin');
		$data_m['current_view'] = 'category_edit';
		$data_m['page_id'] = 1;
		
		
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/category_edit', $data);
		$this->load->view('include/footer');
	}
	
	public function update(){
		$data = $this->input->post();
		$id = $data['id'];
		
		unset($data['page']);
		unset($data['id']);
		
		$category_result = $this->category_model->updateRow($id, $data);
		redirect('../category/index');
	}
	
	public function delete($page=0,$id=1){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
		
		
		$this->category_model->deleteRow($id);
		redirect('../category/index');
	}
}