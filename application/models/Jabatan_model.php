<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	
	public function getAllJabatan()
	{
		return $this->db->get('jabatan')->result_array();
	}

	public function getJabatanById($id)
	{
		return $this->db->get_where('jabatan', ['jabatan.id_jabatan' => $id])->row_array();
	}

	public function createJabatan()
	{
		$data = [
			'nama_jabatan' => $this->input->post('nama_jabatan', true)
		];

		$this->db->insert('jabatan', $data);
		$this->session->set_flashdata('message-success', 'Jabatan ' . $data['nama_jabatan'] . ' berhasil ditambahkan');
		$this->mm->createLog('Jabatan ' . $data['nama_jabatan'] . ' berhasil ditambahkan', $this->mm->id_user());
		redirect('jabatan');
	}

	public function updateJabatan($id)
	{
		$data = [
			'nama_jabatan' => $this->input->post('nama_jabatan', true)
		];
		
		$this->db->where('jabatan.id_jabatan', $id);
		$this->db->update('jabatan', $data);
		$this->session->set_flashdata('message-success', 'Jabatan ' . $data['nama_jabatan'] . ' berhasil diubah');
		$this->mm->createLog('Jabatan ' . $data['nama_jabatan'] . ' berhasil diubah', $this->mm->id_user());
		redirect('jabatan');
	}

	public function deleteJabatan($id)
	{
		$dataUser = $this->mm->getDataUser();
		if ($id_jabatan !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data Jabatan');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Jabatan', $this->mm->id_user());
			redirect('jabatan');
		}
		$data['jabatan'] = $this->getJabatanById($id);
		$this->db->delete('jabatan', ['id_jabatan' => $id]);
		$this->session->set_flashdata('message-success', 'Jabatan ' . $data['jabatan']['nama_jabatan'] . ' berhasil dihapus');
		$this->mm->createLog('Jabatan ' . $data['jabatan']['nama_jabatan'] . ' berhasil dihapus', $this->mm->id_user());
		redirect('jabatan');
	}

}