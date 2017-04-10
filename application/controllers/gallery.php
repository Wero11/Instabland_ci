<?php 
/*
 * This is the Controller for the Lodge page
 * 
 * @author: SM
 */

class Gallery extends CI_Controller{

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
  		parent::__construct();
  		$this->load->helper("url");
		$this->load->model('category_model');
  		$this->load->model('image_model');
  		$this->load->library("pagination");
  	}
	
	public function index(){
		if ( $this->session->userdata('user') != 'true' ) {
	      redirect( "/" );    // no session established, kick back to login page
	    }

	    $data = $this->fetchGalleryPage();
	    $data_m['admin'] = $this->session->userdata('admin');
		$data_m['current_view'] = 'gallery_view';
		$data_m['page_id'] = 0;
		
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/gallery', $data);
		$this->load->view('include/footer');
	}
	
	public function fetchGalleryPage() {
		
		$search = $this->input->post();
		
		if($search != null && !empty($search))
			$this->session->set_userdata('searchitem', $search);
		else if($search != null && empty($search))
			$this->session->set_userdata('searchitem', null);
		
		$search =  $this->session->userdata('searchitem');
		
		$config = array();
		$config["base_url"] = base_url() . "gallery/index";
		$config["total_rows"] = $this->image_model->record_count($search);
		$config["per_page"] = 18;
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
		$data["category_list"] = $this->category_model->fetch_categories(10000, 0, '');
		$data["gallery_list"] = $this->image_model->fetch_images($config["per_page"], $page,$search);	
		$data["links"] = $this->pagination->create_links();
		$data["pagenum"] = $page;
		$data['search'] = $search;

		return $data;
	}
}