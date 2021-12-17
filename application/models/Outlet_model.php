<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getAllOutlet()
	{
		return $this->db->get('outlet')->result_array();
	}

	public function getOutletById($id)
	{
		return $this->db->get_where('outlet', ['outlet.id_outlet' => $id])->row_array();
	}

	public function createOutlet()
	{
		$data = [
			'nama_outlet' => $this->input->post('nama_outlet', true),
			'telepon_outlet' => $this->input->post('telepon_outlet', true),
			'alamat_outlet' => $this->input->post('alamat_outlet', true)
		];

		$this->db->insert('outlet', $data);
		$this->session->set_flashdata('message-success', 'Outlet ' . $data['nama_outlet'] . ' berhasil ditambahkan');
		$this->mm->createLog('Outlet ' . $data['nama_outlet'] . ' berhasil ditambahkan', $this->mm->id_user());
		redirect('outlet');
	}

	public function updateOutlet($id)
	{
		$data = [
			'nama_outlet' => $this->input->post('nama_outlet', true),
			'telepon_outlet' => $this->input->post('telepon_outlet', true),
			'alamat_outlet' => $this->input->post('alamat_outlet', true)
		];
		
		$this->db->where('outlet.id_outlet', $id);
		$this->db->update('outlet', $data);
		$this->session->set_flashdata('message-success', 'Outlet ' . $data['nama_outlet'] . ' berhasil diubah');
		$this->mm->createLog('Outlet ' . $data['nama_outlet'] . ' berhasil diubah', $this->mm->id_user());
		redirect('outlet');
	}

	public function deleteOutlet($id)
	{
		$dataUser = $this->mm->getDataUser();
		if ($id_jabatan !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data Outlet');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Outlet', $this->mm->id_user());
			redirect('outlet');
		}
		$data['outlet'] = $this->getOutletById($id);
		$this->db->delete('outlet', ['id_outlet' => $id]);
		$this->session->set_flashdata('message-success', 'Outlet ' . $data['outlet']['nama_outlet'] . ' berhasil dihapus');
		$this->mm->createLog('Outlet ' . $data['outlet']['nama_outlet'] . ' berhasil dihapus', $this->mm->id_user());
		redirect('outlet');
	}

	public function createLog($message, $id_user)
	{
		$data = [
			'isi_log' => $message,
			'tanggal_log' => date('Y-m-d H:i:s'),
			'id_user' => $id_user
		];
		$this->db->insert('log', $data);
	}
}