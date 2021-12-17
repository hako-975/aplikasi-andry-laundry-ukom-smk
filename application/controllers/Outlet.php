<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Outlet_model', 'om');
		$this->load->model('Main_model', 'mm');
	}


	public function index()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->om->getAllOutlet();
		$data['title'] = ucwords('daftar outlet - ') . $data['dataUser']['username'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('outlet/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createOutlet()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->om->getAllOutlet();
		$data['title'] = ucwords('daftar outlet - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('nama_outlet', 'Nama Outlet', 'required|trim');
		$this->form_validation->set_rules('telepon_outlet', 'Telepon Outlet', 'required|trim');
		$this->form_validation->set_rules('alamat_outlet', 'Alamat Outlet', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('outlet/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->om->createOutlet();
		}
	}

	public function updateOutlet($id)
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->om->getAllOutlet();
		$data['title'] = ucwords('daftar outlet - ') . $data['dataUser']['username'];

		$this->form_validation->set_rules('nama_outlet', 'Nama Outlet', 'required|trim');
		$this->form_validation->set_rules('telepon_outlet', 'Telepon Outlet', 'required|trim');
		$this->form_validation->set_rules('alamat_outlet', 'Alamat Outlet', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('templates/header-sidebar', $data);
			$this->load->view('outlet/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
		    $this->om->updateOutlet($id);
		}
	}

	public function deleteOutlet($id)
	{
		$this->mm->check_status_login();
		
		$this->om->deleteOutlet($id);
	}
}