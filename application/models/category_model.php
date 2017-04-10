<?php
class Category_model extends CI_Model{

	public function record_count($search) {
		if($search != null && !empty($search)){
			foreach($search as $field=>$keyword){
				if($keyword != null && $keyword != '')
					$this->db->like($field, $keyword);
			}
			return $this->db->count_all_results("categorys");
		}
	
		return $this->db->count_all("categorys");
	}
	
	public function fetch_categories($limit, $start, $search) {
		if($search != null && !empty($search)){
			foreach($search as $field=>$keyword){
				if($keyword != null && $keyword != ''){
					$this->db->like($field, $keyword);
				}
			}
		}
		$this->db->limit($limit, $start);
		$this->db->order_by('categorys.id', 'asc');
		$query = $this->db->get("categorys");
	
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}
	
	public function addRow($data){
		$this->db->insert('categorys', $data);
		return $this->db->insert_id();
	}

	public function updateRow($id, $data){
		$this->db->where("id", $id);
		$this->db->update("categorys", $data);
	}
	
	public function deleteRow($id){
		$this->db->where("id",$id);
		$this->db->delete('categorys');
		return 'success';
	}
	
	public function category_item($id){
		$this->db->where('id', $id);
		$query = $this->db->get('categorys');
		return $query->row();
	}
	
}