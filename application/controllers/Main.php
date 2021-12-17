<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('User_model', 'um');
		$this->load->model('Laporan_model', 'lm');
	}

	public function check_biodata()
	{
		$username = $this->session->userdata('username');
		$user = $this->um->getUserByUsername($username);
		if ($user == null) {
			redirect('user/createBiodata/' . $username);
		}
	}

	public function index()
	{
		$this->mm->check_status_login();
		$this->check_biodata();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['title'] = 'Dashbor Andry Laundry';
		
		// jika tombol cari tanggal ditekan
		if (isset($_POST['cari_tanggal'])) {
			$tanggal_awal = date('Y-m-d 00:00:00', strtotime($this->input->post('tanggal_awal')));
			$tanggal_akhir = date('Y-m-d 23:59:59', strtotime($this->input->post('tanggal_akhir')));
			// super administrator
			if ($this->session->userdata('id_jabatan') == '1') {				
				$data['transaksiLaporan'] = $this->lm->getTransaksiLaporanSortTgl($tanggal_awal, $tanggal_akhir)->result_array();
				$data['jumlah_transaksi'] = $this->lm->getTransaksiLaporanSortTgl($tanggal_awal, $tanggal_akhir)->row_array();
				$data['jumlah_status_transaksi_proses'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'proses')->row_array();
				$data['jumlah_status_transaksi_dicuci'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'dicuci')->row_array();
				$data['jumlah_status_transaksi_siap_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'siap diambil')->row_array();
				$data['jumlah_status_transaksi_sudah_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, 'sudah diambil')->row_array();
				$data['member_sering_mencuci'] = $this->lm->getMemberSeringMencuci($tanggal_awal, $tanggal_akhir)->result_array();
				$data['transaksi_wajib_selesai_hari_ini'] = $this->lm->getTransaksiWajibSelesaiHariIni();

				// kirim data tanggal untuk riwayat penelusuran
				$data['tanggal_awal'] = $this->input->post('tanggal_awal');
				$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
			// selain super administrator
			} else {
				$data['transaksiLaporan'] = $this->lm->getTransaksiLaporanSortTglOutletAdministrator($tanggal_awal, $tanggal_akhir)->result_array();
				$data['jumlah_transaksi'] = $this->lm->getTransaksiLaporanSortTglOutletAdministrator($tanggal_awal, $tanggal_akhir)->row_array();
				$data['jumlah_status_transaksi_proses'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'proses')->row_array();
				$data['jumlah_status_transaksi_dicuci'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'dicuci')->row_array();
				$data['jumlah_status_transaksi_siap_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'siap diambil')->row_array();
				$data['jumlah_status_transaksi_sudah_diambil'] = $this->lm->getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, 'sudah diambil')->row_array();
				$data['member_sering_mencuci'] = $this->lm->getMemberSeringMencuciOutletAdministrator($tanggal_awal, $tanggal_akhir)->result_array();
				$data['transaksi_wajib_selesai_hari_ini'] = $this->lm->getTransaksiWajibSelesaiHariIniOutletAdministrator();
				// kirim data tanggal untuk riwayat penelusuran
				$data['tanggal_awal'] = $this->input->post('tanggal_awal');
				$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
			}
		// jika tombol cari tanggal TIDAK ditekan
		} else {
			// super administrator
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
				$data['member_sering_mencuci'] = $this->lm->getMemberSeringMencuci($tanggal_awal, $tanggal_akhir)->result_array();
				$data['transaksi_wajib_selesai_hari_ini'] = $this->lm->getTransaksiWajibSelesaiHariIni();

			// selain super administrator
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
				$data['member_sering_mencuci'] = $this->lm->getMemberSeringMencuciOutletAdministrator($tanggal_awal, $tanggal_akhir)->result_array();
				$data['transaksi_wajib_selesai_hari_ini'] = $this->lm->getTransaksiWajibSelesaiHariIniOutletAdministrator();
			}
		}

		$data['jumlah_member'] = $this->lm->getJumlahMemberAll();

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('main/index', $data);
		$this->load->view('templates/footer', $data);
		$this->load->view('templates/chart-main', $data);
	}

	public function profile()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['title'] = ucwords('profile - ') . $data['dataUser']['username'];
		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('main/profile', $data);
		$this->load->view('templates/footer', $data);
	}

	public function updateBiodata()
	{
		$this->mm->check_status_login();
		$id_user = $this->session->userdata('id_user');
		$data['dataUser'] = $this->mm->getDataUser();
		$data['userBiodata'] = $this->um->getUserById($id_user);
		$data['title'] = 'Profile - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('main/profile', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->mm->updateBiodata();
		}
	}

	public function changePassword()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['title'] = ucwords('profile - ') . $data['dataUser']['username'];
		$this->form_validation->set_rules('password_old', 'Password Lama', 'required');
		$this->form_validation->set_rules('password_new', 'Password Baru', 'required|matches[password_verify]');
		$this->form_validation->set_rules('password_verify', 'Password Verifikasi', 'required|matches[password_new]');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('main/profile', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->mm->changePassword();
		}
	}

	public function laporan()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['title'] = ucwords('laporan - ') . $data['dataUser']['username'];
		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('main/laporan', $data);
		$this->load->view('templates/footer', $data);
	}

}