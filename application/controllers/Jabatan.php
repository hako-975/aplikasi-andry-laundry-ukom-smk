<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jabatan_model', 'jm');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jabatan'] = $this->jm->getAllJabatan();
		$data['title'] = ucwords('daftar jabatan - ') . $data['dataUser']['username'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('jabatan/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createJabatan()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jabatan'] = $this->jm->getAllJabatan();
		$data['title'] = ucwords('daftar jabatan - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('jabatan/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->jm->createJabatan();
		}
	}

	public function updateJabatan($id)
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jabatan'] = $this->jm->getAllJabatan();
		$data['title'] = ucwords('daftar jabatan - ') . $data['jabatan']['nama_jabatan'];

		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('templates/header-sidebar', $data);
			$this->load->view('jabatan/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
		    $this->jm->updateJabatan($id);
		}
	}

	public function deleteJabatan($id)
	{
		$this->mm->check_status_login();
		
		$this->jm->deleteJabatan($id);
	}
}