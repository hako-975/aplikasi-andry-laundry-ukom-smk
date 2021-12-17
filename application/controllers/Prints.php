<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prints extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Prints_model', 'prm');
		$this->load->model('Main_model', 'mm');
		$this->load->model('Transaksi_model', 'tm');
		$this->load->model('Laporan_model', 'lm');
	}

	public function profile($id)
	{
		$this->mm->check_status_login();
		$this->mm->createLog('Print profile', $this->mm->id_user());
		$data['userProfile'] = $this->prm->getProfileById($id);
		$data['title'] = 'Print Profle - ' . $data['userProfile']['username'];
	    $this->load->view('templates/header', $data);
	    $this->load->view('prints/profile', $data);
	    $this->load->view('templates/footer', $data);  
	    $this->load->view('templates/prints', $data);  
	}

	public function cetakInvoice($id_transaksi)
	{
		$this->mm->check_status_login();
		$this->session->unset_userdata('id_transaksi');
		$this->session->unset_userdata('uang_yg_dibayar');
		$this->session->unset_userdata('kembalian');
		$data['transaksi'] = $this->tm->getTransaksiById($id_transaksi);
		$data['total_harga'] = $this->tm->getTotalHarga($id_transaksi);
		$data['detail_transaksi'] = $this->tm->getDetailTransaksiById($id_transaksi);
		$data['pembayaran'] = $this->tm->getPembayaran($id_transaksi);
		$this->mm->createLog('Cetak Invoice' . ' - ' . $data['transaksi']['kode_invoice'] . ' - ' . $data['transaksi']['nama_member'], $this->mm->id_user());
		$data['title'] = 'Cetak Invoice' . ' - ' . $data['transaksi']['kode_invoice'] . ' - ' . $data['transaksi']['nama_member'];
	    $this->load->view('templates/header', $data);
	    $this->load->view('prints/cetak_invoice', $data);
	    $this->load->view('templates/footer', $data);  
	    $this->load->view('templates/prints', $data);  
	}

	public function laporan($tanggal_awal, $tanggal_akhir)
	{
		$this->mm->check_status_login();
		// jika tombol cari tanggal ditekan
		$tanggal_awal = date('Y-m-d 00:00:00', strtotime($this->uri->segment(3, 0)));
		$tanggal_akhir = date('Y-m-d 23:59:59', strtotime($this->uri->segment(4, 0)));
		// jika jabatan super administrator
		if ($this->session->userdata('id_jabatan') == '1') {				
			$data['transaksiLaporan'] = $this->lm->getTransaksiLaporanSortTgl($tanggal_awal, $tanggal_akhir)->result_array();
			$data['jumlah_transaksi'] = $this->lm->getTransaksiLaporanSortTgl($tanggal_awal, $tanggal_akhir)->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'sudah diambil')->row_array();
			$data['jumlah_status_bayar_sudah_dibayar'] = $this->lm->getTransaksiLaporanSortStatusBayar($tanggal_awal, $tanggal_akhir, 'sudah dibayar')->row_array();
			$data['jumlah_status_bayar_belum_dibayar'] = $this->lm->getTransaksiLaporanSortStatusBayar($tanggal_awal, $tanggal_akhir, 'belum dibayar')->row_array();
			
			$data['penghasilan'] = $this->lm->getPenghasilan($tanggal_awal, $tanggal_akhir);
			// kirim data tanggal untuk riwayat penelusuran
			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
		} else {
			$data['transaksiLaporan'] = $this->lm->getTransaksiLaporanSortTglOutletAdministrator($tanggal_awal, $tanggal_akhir)->result_array();
			$data['jumlah_transaksi'] = $this->lm->getTransaksiLaporanSortTglOutletAdministrator($tanggal_awal, $tanggal_akhir)->row_array();
			$data['jumlah_status_transaksi_proses'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'proses')->row_array();
			$data['jumlah_status_transaksi_dicuci'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'dicuci')->row_array();
			$data['jumlah_status_transaksi_siap_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'siap diambil')->row_array();
			$data['jumlah_status_transaksi_sudah_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'sudah diambil')->row_array();
			$data['jumlah_status_bayar_sudah_dibayar'] = $this->lm->getTransaksiLaporanSortStatusBayarOutletAdministrator($tanggal_awal, $tanggal_akhir, 'sudah dibayar')->row_array();
			$data['jumlah_status_bayar_belum_dibayar'] = $this->lm->getTransaksiLaporanSortStatusBayarOutletAdministrator($tanggal_awal, $tanggal_akhir, 'belum dibayar')->row_array();

			$data['penghasilan'] = $this->lm->getPenghasilanOutletAdministrator($tanggal_awal, $tanggal_akhir);
			// kirim data tanggal untuk riwayat penelusuran
			$data['tanggal_awal'] = $this->input->post('tanggal_awal');
			$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
			
		}

		$this->mm->createLog('Cetak Laporan' . ' - ' . $tanggal_awal . ' - ' . $tanggal_akhir, $this->mm->id_user());
		$data['title'] = 'Cetak Laporan' . ' - ' . $tanggal_awal . ' - ' . $tanggal_akhir;
		$this->load->view('templates/header', $data);
	    $this->load->view('prints/cetak_laporan', $data);
	    $this->load->view('templates/footer', $data);  
	    $this->load->view('templates/prints', $data);  
	}
}