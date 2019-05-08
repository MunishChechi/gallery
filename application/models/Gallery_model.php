<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model {

	public function insert_image($data)
	{
		$this->db->insert('gallery', $data);

		return $this->db->insert_id();
	}

	public function get_images()
	{
		return $this->db->get('gallery')->result_array();
	}

	public function get_image($id)
	{
		return $this->db->get_where('gallery',array('id'=>$id))->result_array();
	}
    
}
        
 ?>