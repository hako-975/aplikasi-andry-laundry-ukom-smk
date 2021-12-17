<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaksi_model', 'tm');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->tm->getAllOutlet();
		$data['member'] = $this->tm->getAllMember();
		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['jumlah_status_transaksi_semua'] = $this->tm->getJumlahStatusTransaksi('semua')->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksi('proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksi('dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksi('siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksi('sudah diambil')->row_array();
			$status_transaksi = $this->uri->segment(3, 0);
			if ($status_transaksi) {
				$data['transaksi'] = $this->tm->getAllTransaksi($status_transaksi);
			} else {
				$data['transaksi'] = $this->tm->getAllTransaksi();
			}
		} else {
			$data['jumlah_status_transaksi_semua'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('semua')->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('sudah diambil')->row_array();
			$status_transaksi = $this->uri->segment(3, 0);
			if ($status_transaksi) {
				$data['transaksi'] = $this->tm->getTransaksiOutletAdministrator($status_transaksi);
			} else {
				$data['transaksi'] = $this->tm->getTransaksiOutletAdministrator();
			}
		}

		$data['title'] = ucwords('daftar transaksi - ') . $data['dataUser']['username'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('transaksi/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createTransaksi()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->tm->getAllOutlet();
		$data['member'] = $this->tm->getAllMember();
		
		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['jumlah_status_transaksi_semua'] = $this->tm->getJumlahStatusTransaksi('semua')->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksi('proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksi('dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksi('siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksi('sudah diambil')->row_array();
			$status_transaksi = $this->uri->segment(3, 0);
			if ($status_transaksi) {
				$data['transaksi'] = $this->tm->getAllTransaksi($status_transaksi);
			} else {
				$data['transaksi'] = $this->tm->getAllTransaksi();
			}
		} else {
			$data['jumlah_status_transaksi_semua'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('semua')->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('sudah diambil')->row_array();
			$status_transaksi = $this->uri->segment(3, 0);
			if ($status_transaksi) {
				$data['transaksi'] = $this->tm->getTransaksiOutletAdministrator($status_transaksi);
			} else {
				$data['transaksi'] = $this->tm->getTransaksiOutletAdministrator();
			}
		}

		$data['title'] = ucwords('daftar transaksi - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('batas_waktu', 'Batas Waktu', 'required');
		$this->form_validation->set_rules('id_member', 'Nama Member', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('id_outlet', 'Nama Outlet', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('transaksi/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->tm->createTransaksi();
		}
	}

	public function updateTransaksi($id)
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->tm->getAllOutlet();
		$data['member'] = $this->tm->getAllMember();

		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['jumlah_status_transaksi_semua'] = $this->tm->getJumlahStatusTransaksi('semua')->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksi('proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksi('dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksi('siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksi('sudah diambil')->row_array();
			$status_transaksi = $this->uri->segment(3, 0);
			if ($status_transaksi) {
				$data['transaksi'] = $this->tm->getAllTransaksi($status_transaksi);
			} else {
				$data['transaksi'] = $this->tm->getAllTransaksi();
			}
		} else {
			$data['jumlah_status_transaksi_semua'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('semua')->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksiOutletAdministrator('sudah diambil')->row_array();
			$status_transaksi = $this->uri->segment(3, 0);
			if ($status_transaksi) {
				$data['transaksi'] = $this->tm->getTransaksiOutletAdministrator($status_transaksi);
			} else {
				$data['transaksi'] = $this->tm->getTransaksiOutletAdministrator();
			}
		}
		
		$data['jumlah_status_transaksi_proses'] = $this->tm->getJumlahStatusTransaksi('proses')->row_array();
		$data['jumlah_status_transaksi_dicuci'] = $this->tm->getJumlahStatusTransaksi('dicuci')->row_array();
		$data['jumlah_status_transaksi_siap_diambil'] = $this->tm->getJumlahStatusTransaksi('siap diambil')->row_array();
		$data['jumlah_status_transaksi_sudah_diambil'] = $this->tm->getJumlahStatusTransaksi('sudah diambil')->row_array();
		$data['title'] = ucwords('daftar transaksi - ') . $data['dataUser']['username'];

		$this->form_validation->set_rules('batas_waktu', 'Batas Waktu', 'required');
		$this->form_validation->set_rules('id_member', 'Nama Member', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('templates/header-sidebar', $data);
			$this->load->view('transaksi/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
		    $this->tm->updateTransaksi($id);
		}
	}

	public function tambahTransaksi()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->tm->getAllOutlet();
		$data['member'] = $this->tm->getAllMember();

		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['transaksi'] = $this->tm->getAllTransaksi();
		} else {
			$data['transaksi'] = $this->tm->getTransaksiOutletAdministrator();
		}
		
		$data['title'] = ucwords('tambah transaksi - ') . $data['dataUser']['username'];

		$this->form_validation->set_rules('batas_waktu', 'Batas Waktu', 'required');
		$this->form_validation->set_rules('id_member', 'Nama Member', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('transaksi/tambah_transaksi', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->tm->createTransaksi();
		}
	}

	public function pembayaranTransaksi($id_transaksi = 0)
	{
		
		if (isset($_SESSION['id_transaksi'])) {
			$id_transaksi = $this->session->userdata('id_transaksi');
		}
		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->tm->getAllOutlet();
		$data['member'] = $this->tm->getAllMember();
		$data['transaksi'] = $this->tm->getTransaksiById($id_transaksi);
		$data['detail_transaksi'] = $this->tm->getDetailTransaksiById($id_transaksi);
		$data['jumlah_paket'] = $this->tm->getJumlahPaketOutletAdministrator();
		$data['total_harga'] = $this->tm->getTotalHarga($id_transaksi);

		$data['title'] = ucwords('pembayaran transaksi - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('uang_yg_dibayar', 'Uang yang dibayar', 'required|numeric');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('transaksi/pembayaran_transaksi', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->tm->pembayaranTransaksi($id_transaksi);
		}
	}
	
	public function deleteTransaksi($id)
	{
		// jika belum login pindahkan ke halaman user
		if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}

		$this->session->unset_userdata('kode_invoice');
		if ($this->session->userdata('status_transaksi')) {
			$this->session->unset_userdata('status_transaksi');
		}
		$this->tm->deleteTransaksi($id);
	}

	public function ubahStatusTransaksi($id)
	{
		$this->mm->check_status_login();
		
		$this->tm->ubahStatusTransaksi($id);
	}
}