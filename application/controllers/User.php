<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'um');
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$this->mm->check_status_login();

		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->um->getAllOutlet();
		$data['jabatan'] = $this->um->getAllJabatan();
		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['user'] = $this->um->getAllUser();
		} else {
			$data['user'] = $this->um->getUserOutletAdministrator();
		}
		
		$data['title'] = 'Daftar Pengguna - ' . $data['dataUser']['username'];
		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function createUser()
	{
		$this->mm->check_status_login();

		$data['dataUser'] = $this->mm->getDataUser();
		$data['outlet'] = $this->um->getAllOutlet();
		$data['jabatan'] = $this->um->getAllJabatan();
		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['user'] = $this->um->getAllUser();
		} else {
			// ambil data user berdasarkan outlet administrator tersebut
			$data['user'] = $this->um->getUserOutletAdministrator();
		}
		$data['title'] = 'Daftar Pengguna - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('username', 'Nama Pengguna', 'required|trim|is_unique[user.username]', [
			'is_unique' => 'Nama Pengguna sudah terdaftar!'
		]);
		$this->form_validation->set_rules('password', 'Kata Sandi', 'required|matches[password_verify]');
		$this->form_validation->set_rules('password_verify', 'Verifikasi Kata Sandi', 'required|matches[password]');
		$this->form_validation->set_rules('id_outlet', 'Nama Outlet', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('id_jabatan', 'Nama Jabatan', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->um->createUser();
		}
	}

	public function updateUser($id)
	{
		$data['dataUser'] = $this->mm->getDataUser();
		// Jika akun super administrator yang login
		if ($this->session->userdata('id_jabatan') == '1') {
			$data['user'] = $this->um->getAllUser();
		} else {
			// ambil data user berdasarkan outlet administrator tersebut
			$data['user'] = $this->um->getUserOutletAdministrator();
		}
		$data['outlet'] = $this->um->getAllOutlet();
		$data['jabatan'] = $this->um->getAllJabatan();
		
		$data['title'] = 'Daftar Pengguna - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('id_outlet', 'Nama Outlet', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('id_jabatan', 'Nama Jabatan', 'required|is_natural_no_zero');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('user/index', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->um->updateUser($id);
		}
	}

	public function deleteUser($id)
	{
		$this->mm->check_status_login();
		
		$this->um->deleteUser($id);
	}

	public function createBiodata($username)
	{
		$this->mm->check_status_login();
		$getUserByUsername = $this->um->getUserByUsername($username);
		$getUserByUsernameNoJoin = $this->um->getUserByUsernameNoJoin($username);

		if ($getUserByUsername) {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $getUserByUsername['username'] . ' sudah memiliki biodata');
			redirect('user');
		}

		$id_user = $getUserByUsernameNoJoin['id_user'];
		$data['dataUser'] = $this->mm->getDataUser();
		$data['userBiodata'] = $this->um->getUserById($id_user);
		$data['title'] = 'Isi Biodata - ' . $username;

		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-sidebar', $data);
			$this->load->view('user/createBiodata', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->um->createBiodata();
		}
	}

	public function profile($id)
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['userProfile'] = $this->um->getUserByIdAllData($id);
		$data['title'] = ucwords('profile - ') . $data['userProfile']['username'];
		$this->load->view('templates/header-sidebar', $data);
		$this->load->view('user/profile', $data);
		$this->load->view('templates/footer', $data);
	}

}