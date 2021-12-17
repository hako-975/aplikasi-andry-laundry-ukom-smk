<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'am');
		$this->load->model('Main_model', 'mm');
		$this->load->model('Transaksi_model', 'tm');
		$this->load->model('DetailTransaksi_model', 'dtm');
	}

	public function index()
	{
		$data['title'] = 'Selamat Datang di Andry Laundry';
		$data['outlet'] = $this->mm->getAllOutlet();
		$this->load->view('templates/header_landing', $data);
		$this->load->view('auth/index', $data);
		$this->load->view('templates/footer_landing', $data);
	}

	public function cekStatusPesanan()
	{
		$data['title'] = 'Cek Status Pesanan - Andry Laundry';
		if (isset($_POST['cari_kode'])) {
			$kode_invoice = $this->input->post('kode_invoice', true);
			$data['transaksi'] = $this->am->getTransaksiByKodeInvoice($kode_invoice);
			$id_transaksi = $data['transaksi']['id_transaksi'];
			if ($data['transaksi'] > 0) {
				$data['detail_header_transaksi'] = $this->am->getDetailTransaksiByIdTransaksi($id_transaksi);
				$data['detail_transaksi'] = $this->tm->getDetailTransaksiById($id_transaksi);
				$data['total_harga'] = $this->tm->getTotalHarga($id_transaksi);
				$data['pembayaran'] = $this->tm->getPembayaran($id_transaksi);
				$data['berhasil'] = true;
			} else {
				$data['error'] = true;
			}
			$data['kode_invoice'] = $kode_invoice;
		}
		$this->load->view('templates/header_landing', $data);
		$this->load->view('auth/cek_status_pesanan', $data);
		$this->load->view('templates/footer_landing', $data);
	}

	public function login()
	{
		if ($this->session->userdata('id_user')) {
			redirect('main');
		}

		$data['title'] = 'Masuk - Andry Laundry';
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('auth/login', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->am->check_login();
		}
	}

	public function logout()
	{
		if ($this->session->userdata('id_user')) {
			$this->mm->createLog('Pengguna ' . $this->session->userdata('username') . ' berhasil logout' , $this->session->userdata('id_user'));
		}

		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('id_outlet');
		$this->session->unset_userdata('id_jabatan');
		$this->session->unset_userdata('username');
		session_destroy();
		redirect('auth/login');
	}
}