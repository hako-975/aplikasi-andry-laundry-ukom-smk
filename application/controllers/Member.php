<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_model', 'mbm');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['member'] = $this->mbm->getAllMember();
		$data['title'] = ucwords('daftar member - ') . $data['dataUser']['username'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('member/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createMember()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['member'] = $this->mbm->getAllMember();
		$data['title'] = ucwords('daftar member - ') . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('nama_member', 'Nama Member', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('telepon_member', 'Telepon Member', 'required|trim');
		$this->form_validation->set_rules('email_member', 'Email Member', 'trim|valid_email');
		$this->form_validation->set_rules('alamat_member', 'Alamat Member', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('member/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->mbm->createMember();
		}
	}

	public function updateMember($id)
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['member'] = $this->mbm->getAllMember();
		$data['title'] = ucwords('daftar member - ') . $data['dataUser']['username'];

		$this->form_validation->set_rules('nama_member', 'Nama Member', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('telepon_member', 'Telepon Member', 'required|trim');
		$this->form_validation->set_rules('email_member', 'Email Member', 'trim|valid_email');
		$this->form_validation->set_rules('alamat_member', 'Alamat Member', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
		    $this->load->view('templates/header-sidebar', $data);
			$this->load->view('member/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
		    $this->mbm->updateMember($id);
		}
	}

	public function tambahMember()
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['member'] = $this->mbm->getAllMember();
		$data['title'] = ucwords('tambah member - ') . $data['dataUser']['username'];

		$this->form_validation->set_rules('nama_member', 'Nama Member', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('telepon_member', 'Telepon Member', 'required|trim');
		$this->form_validation->set_rules('email_member', 'Email Member', 'trim|valid_email');
		$this->form_validation->set_rules('alamat_member', 'Alamat Member', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('member/tambah_member', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->mbm->createMember();
		}
	}

	public function deleteMember($id)
	{
		$this->mm->check_status_login();
		
		$this->mbm->deleteMember($id);
	}

	public function riwayatTransaksi($id)
	{
		$this->mm->check_status_login();
		
		$data['dataUser'] = $this->mm->getDataUser();
		$data['member'] = $this->mbm->getMemberById($id);
		$data['riwayat_transaksi'] = $this->mbm->getRiwayatTransaksiById($id);
		$data['title'] = ucwords('detail member - ') . $data['member']['nama_member'];

		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('member/riwayat_transaksi', $data);
		$this->load->view('templates/footer', $data);
	}
}