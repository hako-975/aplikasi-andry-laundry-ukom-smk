<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisPaket_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	
	public function getAllJenisPaket()
	{
		return $this->db->get('jenis_paket')->result_array();
	}

	public function getJenisPaketById($id)
	{
		return $this->db->get_where('jenis_paket', ['jenis_paket.id_jenis_paket' => $id])->row_array();
	}

	public function createJenisPaket()
	{
		$data = [
			'nama_jenis_paket' => $this->input->post('nama_jenis_paket', true)
		];

		$this->db->insert('jenis_paket', $data);
		$this->session->set_flashdata('message-success', 'Jenis Paket ' . $data['nama_jenis_paket'] . ' berhasil ditambahkan');
		$this->mm->createLog('Jenis Paket ' . $data['nama_jenis_paket'] . ' berhasil ditambahkan', $this->mm->id_user());
		redirect('jenisPaket');
	}

	public function updateJenisPaket($id)
	{
		$this->mm->check_jabatan_bukan_administrator('user');

		$data = [
			'nama_jenis_paket' => $this->input->post('nama_jenis_paket', true)
		];
		
		$this->db->where('jenis_paket.id_jenis_paket', $id);
		$this->db->update('jenis_paket', $data);
		$this->session->set_flashdata('message-success', 'Jenis Paket ' . $data['nama_jenis_paket'] . ' berhasil diubah');
		$this->mm->createLog('Jenis Paket ' . $data['nama_jenis_paket'] . ' berhasil diubah', $this->mm->id_user());
		redirect('jenisPaket');
	}

	public function deleteJenisPaket($id)
	{
		$this->mm->check_jabatan_bukan_administrator('jenisPaket');
		$dataUser = $this->mm->getDataUser();
		if ($id_jabatan !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data Jenis Paket');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Jenis Paket', $this->mm->id_user());
			redirect('jenisPaket');
		}
		$data['jenis_paket'] = $this->getJenisPaketById($id);
		$this->db->delete('jenis_paket', ['id_jenis_paket' => $id]);
		$this->session->set_flashdata('message-success', 'Jenis Paket ' . $data['jenis_paket']['nama_jenis_paket'] . ' berhasil dihapus');
		$this->mm->createLog('Jenis Paket ' . $data['jenis_paket']['nama_jenis_paket'] . ' berhasil dihapus', $this->mm->id_user());
		redirect('jenisPaket');
	}

}