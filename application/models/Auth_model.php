<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	public function check_login()
	{
		// Mengambil variabel yang diinput
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);

		// Cek apakah ada akun yang sesuai dengan yang diinputkan username
		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		if ($user) {
			if (password_verify($password, $user['password'])) {
				// Menset userdata atau session
				$data = [
					'id_user' => $user['id_user'],
					'id_outlet' => $user['id_outlet'],
					'id_jabatan' => $user['id_jabatan'],
					'username' => $user['username']
				];
				$this->mm->createLog('Pengguna ' . $data['username'] . ' berhasil login' , $data['id_user']);
				$this->session->set_userdata($data);
				redirect('auth/login');
			} else {
				$this->session->set_flashdata('message-failed', 'Password yang anda masukkan salah');
				redirect('Auth/login');
			}
		} else {
			$this->session->set_flashdata('message-failed', 'Username yang anda masukkan salah');
			redirect('Auth/login');
		}
	}
	
	// Landing page
	public function getTransaksiByKodeInvoice($kode_invoice)
	{
		$this->db->select('*');
		$this->db->join('detail_transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('member', 'transaksi.id_member = member.id_member');
		$this->db->join('outlet', 'transaksi.id_outlet = outlet.id_outlet');
		return $this->db->get_where('transaksi', ['kode_invoice' => $kode_invoice])->row_array();
	}
	
	public function getDetailTransaksiByIdTransaksi($id_transaksi)
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('outlet', 'transaksi.id_outlet = outlet.id_outlet');
		$this->db->join('member', 'transaksi.id_member = member.id_member');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		$this->db->order_by('detail_transaksi.id_detail_transaksi', 'desc');
		$this->db->where('detail_transaksi.id_transaksi', $id_transaksi);
		return $this->db->get('detail_transaksi')->row_array();
	}		
}