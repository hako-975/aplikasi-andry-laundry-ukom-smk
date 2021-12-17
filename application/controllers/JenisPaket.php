<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisPaket extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('JenisPaket_model', 'jpm');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jenis_paket'] = $this->jpm->getAllJenisPaket();
		$data['title'] = ucwords('daftar jenis paket - ') . $data['dataUser']['username'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('jenis_paket/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createJenisPaket()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jenis_paket'] = $this->jpm->getAllJenisPaket();
		$data['title'] = ucwords('daftar jenis paket - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('nama_jenis_paket', 'Nama Jenis Paket', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('jenis_paket/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->jpm->createJenisPaket();
		}
	}

	public function updateJenisPaket($id)
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jenis_paket'] = $this->jpm->getAllJenisPaket();
		$data['title'] = ucwords('daftar jenis paket - ') . $data['jenis_paket']['nama_jenis_paket'];

		$this->form_validation->set_rules('nama_jenis_paket', 'Nama Jenis Paket', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('templates/header-sidebar', $data);
			$this->load->view('jenis_paket/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
		    $this->jpm->updateJenisPaket($id);
		}
	}

	public function deleteJenisPaket($id)
	{
		$this->mm->check_status_login();
		
		$this->jpm->deleteJenisPaket($id);
	}
}