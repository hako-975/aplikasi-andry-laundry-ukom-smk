<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paket extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Paket_model', 'pm');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jenis_paket'] = $this->pm->getAllJenisPaket();
		$data['outlet'] = $this->pm->getAllOutlet();
		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['paket'] = $this->pm->getAllPaket();
		} else {
			// ambil data user berdasarkan outlet administrator tersebut
			$data['paket'] = $this->pm->getPaketOutletAdministrator();
		}
		$data['title'] = ucwords('daftar paket - ') . $data['dataUser']['username'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('paket/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createPaket()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jenis_paket'] = $this->pm->getAllJenisPaket();
		$data['outlet'] = $this->pm->getAllOutlet();
		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['paket'] = $this->pm->getAllPaket();
		} else {
			// ambil data user berdasarkan outlet administrator tersebut
			$data['paket'] = $this->pm->getPaketOutletAdministrator();
		}
		$data['title'] = ucwords('daftar paket - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('nama_paket', 'Nama paket', 'required|trim');
		$this->form_validation->set_rules('harga_paket', 'Harga paket', 'required|trim|numeric');
		$this->form_validation->set_rules('id_outlet', 'Nama Outlet', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('id_jenis_paket', 'Nama Jenis Paket', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('paket/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->pm->createPaket();
		}
	}

	public function updatePaket($id)
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['paket'] = $this->pm->getAllPaket();
		} else {
			// ambil data user berdasarkan outlet administrator tersebut
			$data['paket'] = $this->pm->getPaketOutletAdministrator();
		}
		$data['outlet'] = $this->pm->getAllOutlet();
		$data['jenis_paket'] = $this->pm->getAllJenisPaket();
		$data['title'] = ucwords('daftar paket - ') . $data['paket']['nama_paket'];

		$this->form_validation->set_rules('nama_paket', 'Nama paket', 'required|trim');
		$this->form_validation->set_rules('harga_paket', 'Harga paket', 'required|trim|numeric');
		$this->form_validation->set_rules('id_outlet', 'Nama Outlet', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('id_jenis_paket', 'Nama Jenis Paket', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('templates/header-sidebar', $data);
			$this->load->view('paket/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
		    $this->pm->updatePaket($id);
		}
	}

	public function deletePaket($id)
	{
		$this->mm->check_status_login();
		
		$this->pm->deletePaket($id);
	}
}