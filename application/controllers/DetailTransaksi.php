<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailTransaksi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('DetailTransaksi_model', 'dtm');
		$this->load->model('Main_model', 'mm');
		$this->load->model('Transaksi_model', 'tm');
	}

	public function index($id_transaksi)
	{
		$data['dataUser'] = $this->mm->getDataUser();

		$data['detail_header_transaksi'] = $this->dtm->getDetailTransaksiByIdTransaksi($id_transaksi);
		$data['pembayaran'] = $this->tm->getPembayaran($id_transaksi);
		$data['detail_transaksi'] = $this->tm->getDetailTransaksiById($id_transaksi);
		$data['total_harga'] = $this->tm->getTotalHarga($id_transaksi);
		$data['detail_transaksi_paket'] = $this->dtm->getPaketOutletAdministratorById($id_transaksi);
		$data['paket'] = $this->dtm->getAllPaketOutletAdministrator();
		if ($data['detail_transaksi'] == NULL) {
			$kode_invoice = $this->dtm->getKodeInvoiceById($id_transaksi);
			$this->session->set_userdata(['kode_invoice' => $kode_invoice['kode_invoice']]);
			redirect('detailTransaksi/tambahDetailTransaksi/');
		}
		$data['title'] = ucwords('daftar detail transaksi - ') . $data['dataUser']['username'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('detail_transaksi/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createDetailTransaksi()
	{
		if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}

		$data['dataUser'] = $this->mm->getDataUser();
		$data['detail_transaksi'] = $this->dtm->getDetailTransaksiOutletAdministrator();
		$data['paket'] = $this->dtm->getAllPaketOutletAdministrator();

		$data['title'] = ucwords('daftar detail transaksi - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('id_transaksi', 'Kode Invoice', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('detail_transaksi/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->dtm->createDetailTransaksi();
		}
	}

	public function updateDetailTransaksi($id_transaksi)
	{
		if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}

		$data['dataUser'] = $this->mm->getDataUser();
		$data['detail_transaksi'] = $this->dtm->getDetailTransaksiOutletAdministrator();
		$data['paket'] = $this->dtm->getAllPaketOutletAdministrator();
		$data['detail_transaksi_paket'] = $this->dtm->getPaketOutletAdministratorById($id_transaksi);

		$data['title'] = ucwords('daftar detail transaksi - ') . $data['dataUser']['username'];

		$this->form_validation->set_rules('id_transaksi', 'Kode Invoice', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('templates/header-sidebar', $data);
			$this->load->view('detail_transaksi/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
		    $this->dtm->updateDetailTransaksi($id_transaksi);
		}
	}

	public function tambahDetailTransaksi()
	{
		// jika belum login pindahkan ke halaman user
		if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['detail_transaksi'] = $this->dtm->getDetailTransaksiOutletAdministrator();
		$data['paket'] = $this->dtm->getAllPaketOutletAdministrator();

		$data['title'] = ucwords('tambah detail transaksi - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('id_transaksi', 'Kode Invoice', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('detail_transaksi/tambah_detail_transaksi', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->dtm->createDetailTransaksi();
		}
	}

	// public function deleteDetailTransaksi($id)
	// {
	// 	$this->mm->check_status_login();
		
	// 	$this->dtm->deleteDetailTransaksi($id);
	// }
}