<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Laporan_model', 'lm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['title'] = 'Laporan';
		
		// jika tombol cari tanggal ditekan
		if (isset($_POST['cari_tanggal'])) {
			$tanggal_awal = date('Y-m-d 00:00:00', strtotime($this->input->post('tanggal_awal')));
			$tanggal_akhir = date('Y-m-d 23:59:59', strtotime($this->input->post('tanggal_akhir')));
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
		} else {
			if ($this->session->userdata('id_jabatan') == '1') {
				// buat tanggal default
				$tanggal_awal = date('Y-m-01 00:00:00');
				$tanggal_akhir = date('Y-m-d 23:59:59');
				$data['transaksiLaporan'] = $this->lm->getTransaksiLaporan($tanggal_awal, $tanggal_akhir);
				$data['jumlah_transaksi'] = $this->lm->getTransaksiLaporanSortTgl($tanggal_awal, $tanggal_akhir)->row_array();
				$data['jumlah_status_transaksi_proses'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'proses')->row_array();
				$data['jumlah_status_transaksi_dicuci'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'dicuci')->row_array();
				$data['jumlah_status_transaksi_siap_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'siap diambil')->row_array();
				$data['jumlah_status_transaksi_sudah_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'sudah diambil')->row_array();
				$data['jumlah_status_bayar_sudah_dibayar'] = $this->lm->getTransaksiLaporanSortStatusBayar($tanggal_awal, $tanggal_akhir, 'sudah dibayar')->row_array();
				$data['jumlah_status_bayar_belum_dibayar'] = $this->lm->getTransaksiLaporanSortStatusBayar($tanggal_awal, $tanggal_akhir, 'belum dibayar')->row_array();

				$data['penghasilan'] = $this->lm->getPenghasilan($tanggal_awal, $tanggal_akhir);
				
			} else {
				// buat tanggal default
				$tanggal_awal = date('Y-m-01 00:00:00');
				$tanggal_akhir = date('Y-m-d 23:59:59');
				$data['transaksiLaporan'] = $this->lm->getTransaksiLaporanOutletAdministrator($tanggal_awal, $tanggal_akhir);
				$data['jumlah_transaksi'] = $this->lm->getTransaksiLaporanSortTglOutletAdministrator($tanggal_awal, $tanggal_akhir)->row_array();
				$data['jumlah_status_transaksi_proses'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'proses')->row_array();
				$data['jumlah_status_transaksi_dicuci'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'dicuci')->row_array();
				$data['jumlah_status_transaksi_siap_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'siap diambil')->row_array();
				$data['jumlah_status_transaksi_sudah_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'sudah diambil')->row_array();
				$data['jumlah_status_bayar_sudah_dibayar'] = $this->lm->getTransaksiLaporanSortStatusBayarOutletAdministrator($tanggal_awal, $tanggal_akhir, 'sudah dibayar')->row_array();
				$data['jumlah_status_bayar_belum_dibayar'] = $this->lm->getTransaksiLaporanSortStatusBayarOutletAdministrator($tanggal_awal, $tanggal_akhir, 'belum dibayar')->row_array();

				$data['penghasilan'] = $this->lm->getPenghasilanOutletAdministrator($tanggal_awal, $tanggal_akhir);
			}
		}

		$data['jumlah_member'] = $this->lm->getJumlahMemberAll();

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('laporan/index', $data);
		$this->load->view('templates/footer', $data);
	}
}