<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getAllMember()
	{
		return $this->db->get('member')->result_array();
	}

	public function getMemberById($id)
	{
		return $this->db->get_where('member', ['member.id_member' => $id])->row_array();
	}

	public function getRiwayatTransaksiById($id)
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'member.id_member = transaksi.id_member');
		$this->db->join('outlet', 'transaksi.id_outlet = outlet.id_outlet');
		$this->db->where('transaksi.id_member', $id);
		$this->db->order_by('transaksi.tanggal_transaksi', 'desc');
		return $this->db->get('member')->result_array();
	}

	public function createMember()
	{
		$data = [
			'nama_member' => ucwords(strtolower($this->input->post('nama_member', true))),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
			'telepon_member' => $this->input->post('telepon_member', true),
			'email_member' => $this->input->post('email_member', true),
			'alamat_member' => $this->input->post('alamat_member', true)
		];

		$this->db->insert('member', $data);
		$this->session->set_flashdata('message-success', 'Member ' . $data['nama_member'] . ' berhasil ditambahkan');
		$this->mm->createLog('Member ' . $data['nama_member'] . ' berhasil ditambahkan', $this->mm->id_user());
		redirect('member');
	}

	public function updateMember($id)
	{
		$data = [
			'nama_member' => $this->input->post('nama_member', true),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
			'telepon_member' => $this->input->post('telepon_member', true),
			'email_member' => $this->input->post('email_member', true),
			'alamat_member' => $this->input->post('alamat_member', true)
		];
		
		$this->db->where('member.id_member', $id);
		$this->db->update('member', $data);
		$this->session->set_flashdata('message-success', 'Member ' . $data['nama_member'] . ' berhasil diubah');
		$this->mm->createLog('Member ' . $data['nama_member'] . ' berhasil diubah', $this->mm->id_user());
		redirect('member');
	}

	public function deleteMember($id)
	{
		$this->mm->check_jabatan_bukan_administrator('member');
		$data['member'] = $this->getMemberById($id);
		$this->db->delete('member', ['id_member' => $id]);
		$this->session->set_flashdata('message-success', 'Member ' . $data['member']['nama_member'] . ' berhasil dihapus');
		$this->mm->createLog('Member ' . $data['member']['nama_member'] . ' berhasil dihapus', $this->mm->id_user());
		redirect('member');
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