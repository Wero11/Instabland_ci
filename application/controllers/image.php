<?php 
/*
 * This is the Controller for the Lodge page
 * 
 * @author: SM
 */

class Image extends CI_Controller{

	protected $path_img_upload_folder;
	protected $path_img_thumb_upload_folder;
	protected $path_url_img_upload_folder;
	protected $path_url_img_thumb_upload_folder;
	
	protected $delete_img_url;
	
	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
  		parent::__construct();
  		$this->load->helper("url");
		$this->load->model('category_model');
  		$this->load->model('image_model');
  		$this->load->library("pagination");
		
		$this->load->helper(array('form', 'url'));
		
		//Set relative Path with CI Constant
		$this->setPath_img_upload_folder("assets/uploads/");
		$this->setPath_img_thumb_upload_folder("assets/uploads/thumbnails/");
		
		//Delete img url
		$this->setDelete_img_url(base_url() . 'image/deleteImage/');
		
		//Set url img with Base_url()
		$this->setPath_url_img_upload_folder(base_url() . "assets/uploads/");
		$this->setPath_url_img_thumb_upload_folder(base_url() . "assets/uploads/thumbnails/");
  	}
	
	public function index(){
		if ( $this->session->userdata('admin') != 'true' ) {
	      redirect( "/" );    // no session established, kick back to login page
	    }

	    $data = $this->fetchPage();
	    $data_m['admin'] = $this->session->userdata('admin');
		$data_m['current_view'] = 'image_view';
		$data_m['page_id'] = 0;
		
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/image', $data);
		$this->load->view('include/footer');
	}
	
	public function listapi($category_ID=0){
		$image_data = $this->image_model->getList($category_ID);
		echo json_encode($image_data);
		exit;
	}
	
	public function fetchPage() {
		$search = $this->input->post();
		
		if($search != null && !empty($search))
			$this->session->set_userdata('searchterm', $search);
		else if($search != null && empty($search))
			$this->session->set_userdata('searchterm', null);
		
		$search =  $this->session->userdata('searchterm');
		
		$config = array();
		$config["base_url"] = base_url() . "image/index";
		$config["total_rows"] = $this->image_model->record_count($search);
		$config["per_page"] = 10;
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
		$data["image_list"] = $this->image_model->fetch_images($config["per_page"], $page,$search);
		$data["links"] = $this->pagination->create_links();
		$data["pagenum"] = $page;
		$data['search'] = $search;
		
		return $data;
	}
	
	public function add($page=0){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
	
		$data_m['current_view'] = 'image_edit';
		$data_m['admin'] = $this->session->userdata('admin');
		$data_m['page_id'] = 1;
		$data_m['user_index'] = $this->session->userdata('user_index');
		$data['pagenum'] = $page;
		$data["category_list"] = $this->category_model->fetch_categories(10000, 0, '');
	
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/image_add',$data);
		$this->load->view('include/footer');
	}
	
	public function save(){
		$data = $this->input->post();
		$page = $data['page'];
	
		unset($data['page']);
	
		$image_result = $this->image_model->addRow($data);
		$this->session->set_userdata('image_id', $image_result);
		redirect('../image/upload_view/0/'.$image_result);
	}
	
	public function edit($page=0,$id=1){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
		
		$image = $this->image_model->image_item($id);
		$data['item_detail'] = $image;
		$data["pagenum"] = $page;
		$data["category_list"] = $this->category_model->fetch_categories(10000, 0, '');
		
		$data_m['admin'] = $this->session->userdata('admin');
		$data_m['current_view'] = 'image_edit';
		$data_m['page_id'] = 1;
		
		
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/image_edit', $data);
		$this->load->view('include/footer');
	}
	
	public function update(){
		$data = $this->input->post();
		$page = $data['page'];
		$id = $data['id'];
		
		unset($data['page']);
		unset($data['id']);
		
		$image_result = $this->image_model->updateRow($id, $data);
		$this->session->set_userdata('image_id', $id);
		redirect('../image/upload_view/'.$page.'/'.$id);
	}
	
	public function delete($page=0,$id=1){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
		
		$this->image_model->deleteRow($id);
		redirect('../image/index');
	}
	
	public function upload_view($page=0,$id=1){
		if ( $this->session->userdata('admin') != 'true' ) {
			redirect( "/" );    // no session established, kick back to login page
		}
	
		$data['current_view'] = 'upload_view';
		$data['page_id'] = 0;
		
		$data_m['current_view'] = 'image_edit';
		$data_m['admin'] = $this->session->userdata('admin');
		$data_m['page_id'] = 0;
		$data_m['user_index'] = $this->session->userdata('user_index');
	
		$this->load->view('include/header');
		$this->load->view('templates/menubar',$data_m);
		$this->load->view('templates/upload_view',$data);
		$this->load->view('include/footer');
	}
	
	public function finish(){
		redirect('../image/index');
	}
	
	
	/*
	 * File Uplaod functions
	 * */
		
	// Function called by the form
	public function upload_img()
	{	
		//Format the name
		$name = $_FILES['userfile']['name'];
		$name = strtr($name, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
	
		// replace characters other than letters, numbers and . by _
		$name = preg_replace('/([^.a-z0-9]+)/i', '_', $name);
	
		//Your upload directory, see CI user guide
		$config['upload_path'] = $this->getPath_img_upload_folder();
	
		$config['allowed_types'] = 'gif|jpg|png|JPG|GIF|PNG';
		$config['max_size'] = '20000';
		$config['file_name'] = $name;
	
		//Load the upload library
		$this->load->library('upload', $config);
	
		if ($this->do_upload())
		{
			// Codeigniter Upload class alters name automatically (e.g. periods are escaped with an
			//underscore) - so use the altered name for thumbnail
			$data = $this->upload->data();
			$name = $data['file_name'];
	
			//gallery save process
			$image_data = array();
			
			$id = $this->session->userdata('image_id');
		
			$image_data['image_URL'] = $this->getPath_url_img_upload_folder() . $name;
			$image_data['thumbnail_URL'] = $this->getPath_url_img_thumb_upload_folder() . $name;
			
			$image_result = $this->image_model->updateRow($id, $image_data);
			
			//If you want to resize
			$config['new_image'] = $this->getPath_img_thumb_upload_folder();
			$config['image_library'] = 'gd2';
			$config['source_image'] = $this->getPath_img_upload_folder() . $name;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 144;
			$config['height'] = 144;
	
			$this->load->library('image_lib', $config);
	
			$this->image_lib->resize();
	
			//Get info
			$info = new stdClass();
	
			$info->name = $name;
			$info->size = $data['file_size']*1024;
			$info->type = $data['file_type'];
			$info->url = $this->getPath_url_img_upload_folder() . $name;
			$info->thumbnail_url = $this->getPath_url_img_thumb_upload_folder() . $name; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
			$info->delete_url = $this->getDelete_img_url() . $name;
			$info->delete_type = 'DELETE';
	
			//$this->session->set_userdata('user_id', $gallery_data['serviceProviderId']);
			
			//Return JSON data
			if (IS_AJAX)
			{   //this is why we put this in the constants to pass only json data
		
				echo json_encode(array($info));
				
				//this has to be the only the only data returned or you will get an error.
				//if you don't give this a json array it will give you a Empty file upload result error
				//it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
			}
			else
			{   // so that this will still work if javascript is not enabled
				$file_data['upload_data'] = $this->upload->data();
				echo json_encode(array($info));
			}
		}
		else
		{	
			// the display_errors() function wraps error messages in <p> by default and these html chars don't parse in
			// default view on the forum so either set them to blank, or decide how you want them to display.  null is passed.
			$error = array('error' => $this->upload->display_errors('',''));
			echo json_encode(array($error));
		}	
	}
	
	//Function for the upload : return true/false
	public function do_upload()
	{
		if (!$this->upload->do_upload())
		{
			return false;
		}
		else
		{
			//$data = array('upload_data' => $this->upload->data());
			return true;
		}
	}	
	
	//Function Delete image
	public function deleteImage()
	{
		//Get the name in the url
		$file = $this->uri->segment(3);
	
		$success = unlink($this->getPath_img_upload_folder() . $file);
		$success_th = unlink($this->getPath_img_thumb_upload_folder() . $file);
	
		//info to see if it is doing what it is supposed to
		$info = new stdClass();
		$info->sucess = $success;
		$info->name = $file;
		$info->path = $this->getPath_url_img_upload_folder() . $file;
		$info->file = is_file($this->getPath_img_upload_folder() . $file);
		
		$this->image_model->deleteURLByID($this->session->userdata('image_id'));
		
		if (IS_AJAX)
		{//I don't think it matters if this is set but good for error checking in the console/firebug
			echo json_encode(array($info));
		}
		else
		{
			//here you will need to decide what you want to show for a successful delete
			var_dump($file);
		}
	}
	
	
	//Load the files
	public function get_files()
	{ 	
		$this->get_scan_files();
	}
	
	//Get info and Scan the directory
	public function get_scan_files()
	{		
		$file_name = isset($_REQUEST['file']) ? basename(stripslashes($_REQUEST['file'])) : null;
		if ($file_name)
		{
			$info = $this->get_file_object($file_name);
		}
		else
		{
			$info = $this->get_file_objects();
		}
		
		header('Content-type: application/json');		
		echo json_encode($info);
	}
	
	protected function get_file_object($file_name)
	{ 
		$file_path = $this->getPath_img_upload_folder() . $file_name;
		if (is_file($file_path) && $file_name[0] !== '.')
		{
	
			$file = new stdClass();
			$file->name = $file_name;
			$file->size = filesize($file_path);
			$file->url = $this->getPath_url_img_upload_folder() . rawurlencode($file->name);
			$file->thumbnail_url = $this->getPath_url_img_thumb_upload_folder() . rawurlencode($file->name);
			//File name in the url to delete
			$file->delete_url = $this->getDelete_img_url() . rawurlencode($file->name);
			$file->delete_type = 'DELETE';
	
			return $file;
		} else {
			return null;
		}
	}
	
	//Scan
	protected function get_file_objects()
	{	
		$img_files = array_values(array_filter(array_map(
				array($this, 'get_file_object'), scandir($this->getPath_img_upload_folder())
		)));
		
		$i = 0;
		$img_ary = array();
	
		foreach ( $img_files as $img_file ) {
			if ( $img_file != null ) {
				
				$id = $this->session->userdata('image_id');
				$url = $img_file->url;
					
				if ( $this->image_model->countByURLnID($id, $url) > 0 ) {
					$img_ary[$i] = $img_file;
					$i++;
				}
			}
		}
		
		return $img_ary;
	}
	
	// GETTER & SETTER
	public function getPath_img_upload_folder()
	{
		return $this->path_img_upload_folder;
	}
	
	public function setPath_img_upload_folder($path_img_upload_folder)
	{
		$this->path_img_upload_folder = $path_img_upload_folder;
	}
	
	public function getPath_img_thumb_upload_folder()
	{
		return $this->path_img_thumb_upload_folder;
	}
	
	public function setPath_img_thumb_upload_folder($path_img_thumb_upload_folder)
	{
		$this->path_img_thumb_upload_folder = $path_img_thumb_upload_folder;
	}
	
	public function getPath_url_img_upload_folder()
	{
		return $this->path_url_img_upload_folder;
	}
	
	public function setPath_url_img_upload_folder($path_url_img_upload_folder)
	{
		$this->path_url_img_upload_folder = $path_url_img_upload_folder;
	}
	
	public function getPath_url_img_thumb_upload_folder()
	{
		return $this->path_url_img_thumb_upload_folder;
	}
	
	public function setPath_url_img_thumb_upload_folder($path_url_img_thumb_upload_folder)
	{
		$this->path_url_img_thumb_upload_folder = $path_url_img_thumb_upload_folder;
	}
	
	public function getDelete_img_url()
	{
		return $this->delete_img_url;
	}
	
	public function setDelete_img_url($delete_img_url)
	{
		$this->delete_img_url = $delete_img_url;
	}
	
}