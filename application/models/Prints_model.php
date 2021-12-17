<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prints_model extends CI_Model {
	public function getProfileById($id)
	{
		$this->db->select('*');
		$this->db->join('biodata', 'user.id_user = biodata.id_user');
		return $this->db->get_where('user', ['user.id_user' => $id])->row_array();
	}

}