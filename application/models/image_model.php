<?php
class Image_model extends CI_Model{

	public function record_count($search) {
		if($search != null && !empty($search)){
			foreach($search as $field=>$keyword){
				if($keyword != null && $keyword != '')
					$this->db->like($field, $keyword);
			}
			return $this->db->count_all_results("images");
		}
	
		return $this->db->count_all("images");
	}
	
	public function getList($category_ID){
		$this->db->order_by('images.id', 'asc');
		$this->db->where("category_ID",$category_ID);
		$query = $this->db->get('images');
		if( $query->num_rows() > 0 ) {
			return $query->result();
		}
		return false;
	}
	
	public function fetch_images($limit, $start, $search) {
		if($search != null && !empty($search)){
			foreach($search as $field=>$keyword){
				if($keyword != null && $keyword != ''){
					$this->db->like($field, $keyword);
				}
			}
		}
		$this->db->limit($limit, $start);
		$this->db->order_by('images.id', 'asc');
		$query = $this->db->get("images");
	
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}
	
	public function addRow($data){
		$this->db->insert('images', $data);
		return $this->db->insert_id();
	}

	public function updateRow($id, $data){
		$this->db->where("id", $id);
		$this->db->update("images", $data);
	}
	
	public function deleteRow($id){
		$this->db->where("id",$id);
		$this->db->delete('images');
		return 'success';
	}
	
	public function image_item($id){
		$this->db->where('id', $id);
		$query = $this->db->get('images');
		return $query->row();
	}
	
	public function countByURLnID($id, $url){
		$this->db->where("id", $id);
		$this->db->where("image_URL",$url);
	
		$query = $this->db->get('images');
		return $query->num_rows();
	}
	
	public function deleteURLByID($id){
		$this->db->where("id", $id);
		$data = array ('image_URL' => '', 'thumbnail_URL' => '');
		$this->db->update("images", $data);
		return 'success';
	}
}