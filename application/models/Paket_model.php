<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	
	public function getAllPaket()
	{
		$this->db->select('*');
		$this->db->join('outlet', 'paket.id_outlet = outlet.id_outlet');
		$this->db->join('jenis_paket', 'paket.id_jenis_paket = jenis_paket.id_jenis_paket');
		return $this->db->get('paket')->result_array();
	}

	public function getPaketOutletAdministrator()
	{
		$this->db->select('*');
		$this->db->join('outlet', 'paket.id_outlet = outlet.id_outlet');
		$this->db->join('jenis_paket', 'paket.id_jenis_paket = jenis_paket.id_jenis_paket');
		$id_outlet = $this->session->userdata('id_outlet');
		$this->db->where('outlet.id_outlet', $id_outlet);
		return $this->db->get('paket')->result_array();
	}

	public function getAllOutlet()
	{
		return $this->db->get('outlet')->result_array();
	}

	public function getAllJenisPaket()
	{
		return $this->db->get('jenis_paket')->result_array();
	}

	public function getPaketById($id)
	{
		$this->db->select('*');
		$this->db->join('outlet', 'paket.id_outlet = outlet.id_outlet');
		$this->db->join('jenis_paket', 'paket.id_jenis_paket = jenis_paket.id_jenis_paket');
		return $this->db->get_where('paket', ['paket.id_paket' => $id])->row_array();
	}

	public function createPaket()
	{
		$data = [
			'nama_paket' => $this->input->post('nama_paket', true),
			'harga_paket' => $this->input->post('harga_paket', true),
			'id_outlet' => $this->input->post('id_outlet', true),
			'id_jenis_paket' => $this->input->post('id_jenis_paket', true)
		];

		$this->db->insert('paket', $data);
		$this->session->set_flashdata('message-success', 'Paket ' . $data['nama_paket'] . ' berhasil ditambahkan');
		$this->mm->createLog('Paket ' . $data['nama_paket'] . ' berhasil ditambahkan', $this->mm->id_user());
		redirect('paket');
	}

	public function updatePaket($id)
	{
		$this->mm->check_jabatan_bukan_administrator('paket');
		$data = [
			'nama_paket' => $this->input->post('nama_paket', true),
			'harga_paket' => $this->input->post('harga_paket', true),
			'id_outlet' => $this->input->post('id_outlet', true),
			'id_jenis_paket' => $this->input->post('id_jenis_paket', true)
		];
		
		$this->db->where('paket.id_paket', $id);
		$this->db->update('paket', $data);
		$this->session->set_flashdata('message-success', 'Paket ' . $data['nama_paket'] . ' berhasil diubah');
		$this->mm->createLog('Paket ' . $data['nama_paket'] . ' berhasil diubah', $this->mm->id_user());
		redirect('paket');
	}

	public function deletePaket($id)
	{
		$this->mm->check_jabatan_bukan_administrator('paket');
		$data['paket'] = $this->getPaketById($id);
		$this->db->delete('paket', ['id_paket' => $id]);
		$this->session->set_flashdata('message-success', 'Paket ' . $data['paket']['nama_paket'] . ' berhasil dihapus');
		$this->mm->createLog('Paket ' . $data['paket']['nama_paket'] . ' berhasil dihapus', $this->mm->id_user());
		redirect('paket');
	}

}