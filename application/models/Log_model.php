<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {
	public function getAllLog()
	{
		$this->db->order_by('tanggal_log', 'desc');
		$this->db->join('user', 'log.id_user = user.id_user');
		return $this->db->get('log')->result_array();
	}

}