<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getAllUser()
	{
		$this->db->select('*');
		$this->db->join('outlet', 'user.id_outlet = outlet.id_outlet');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan');
		return $this->db->get('user')->result_array();
	}

	public function getUserOutletAdministrator()
	{
		$this->db->select('*');
		$this->db->join('outlet', 'user.id_outlet = outlet.id_outlet');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan');
		$id_outlet = $this->session->userdata('id_outlet');
		$this->db->where('outlet.id_outlet', $id_outlet);
		return $this->db->get('user')->result_array();
	}

	public function getAllOutlet()
	{
		return $this->db->get('outlet')->result_array();
	}

	public function getAllJabatan()
	{
		return $this->db->get('jabatan')->result_array();
	}

	public function getUserByUsername($username)
	{
		$this->db->select('*');
		$this->db->join('biodata', 'biodata.id_user = user.id_user');
		return $this->db->get_where('user', ['user.username' => $username])->row_array();
	}

	public function getUserByUsernameNoJoin($username)
	{
		return $this->db->get_where('user', ['user.username' => $username])->row_array();
	}

	public function getUserById($id)
	{
		return $this->db->get_where('user', ['user.id_user' => $id])->row_array();
	}

	public function getUserByIdAllData($id)
	{
		$this->db->select('*');
		$this->db->join('biodata', 'biodata.id_user = user.id_user');
		$this->db->join('outlet', 'outlet.id_outlet = user.id_outlet');
		return $this->db->get_where('user', ['user.id_user' => $id])->row_array();
	}

	public function createUser()
	{
		$data = [
			'username' => $this->input->post('username', true),
			'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
			'id_outlet' => $this->input->post('id_outlet', true),
			'id_jabatan' => $this->input->post('id_jabatan', true)
		];
		$this->db->insert('user', $data);
		$this->session->set_flashdata('message-success', 'Pengguna ' . $data['username'] . ' berhasil ditambahkan');
		$this->mm->createLog('Pengguna ' . $data['username'] . ' berhasil ditambahkan', $this->mm->id_user());
		redirect('user/createBiodata/' . $data['username']);
	}

	public function createBiodata()
	{
		$this->db->set('foto', 'default.png');

		$foto = $_FILES['foto']['name'];
		if ($foto) {
			$config['upload_path'] = './assets/img/img_profiles/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
		
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('foto')) {
				$new_foto = $this->upload->data('file_name');
				$this->db->set('foto', $new_foto);
			} else {
				echo $this->upload->display_errors();
			}
		}

		$data = [
			'nama_lengkap' => $this->input->post('nama_lengkap', true),
			'tempat_lahir' => $this->input->post('tempat_lahir', true),
			'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
			'golongan_darah' => $this->input->post('golongan_darah', true),
			'telepon' => $this->input->post('telepon', true),
			'email' => $this->input->post('email', true),
			'alamat' => $this->input->post('alamat', true),
			'id_user' => $this->input->post('id_user', true)
		];

		$this->db->insert('biodata', $data);
		$this->session->set_flashdata('message-success', 'Biodata Pengguna ' . $data['nama_lengkap'] . ' berhasil ditambahkan');
		$this->mm->createLog('Biodata Pengguna ' . $data['nama_lengkap'] . ' berhasil ditambahkan', $this->mm->id_user());
		redirect('user');
	}

	
	public function updateUser($id)
	{
		$this->mm->check_jabatan_bukan_administrator('user');

		$data = [
			'id_outlet' => $this->input->post('id_outlet', true),
			'id_jabatan' => $this->input->post('id_jabatan', true)
		];		
		$this->db->where('user.id_user', $id);
		$this->db->update('user', $data);
		$user = $this->getUserById($id);
		$this->session->set_flashdata('message-success', 'Pengguna ' . $user['username'] . ' berhasil diubah');
		$this->mm->createLog('Pengguna ' . $user['username'] . ' berhasil diubah', $this->mm->id_user());
		redirect('user');
	}

	public function deleteUser($id)
	{
		$this->mm->check_jabatan_bukan_administrator('user');
		$user = $this->getUserById($id);
		$this->db->delete('user', ['id_user' => $id]);
		$this->session->set_flashdata('message-success', 'Pengguna ' . $user['username'] . ' berhasil dihapus');
		$this->mm->createLog('Pengguna ' . $user['username'] . ' berhasil dihapus', $this->mm->id_user());
		redirect('user');
	}


}
