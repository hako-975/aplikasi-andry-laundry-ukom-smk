<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
	public function check_status_login()
	{
		// jika belum login pindahkan ke halaman user
		if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}

		// jika sedang menginputkan detail transaksi, paksa ke halaman tambah transaski
		if ($this->session->userdata('kode_invoice')) {
			redirect('detailTransaksi/tambahDetailTransaksi');
		}elseif ($this->session->userdata('status_bayar')) {
			redirect('transaksi/pembayaranTransaksi');
		}
	}

	public function check_jabatan_bukan_administrator($table)
	{
		$id_jabatan = $this->session->userdata('id_jabatan');
		$id_outlet = $this->session->userdata('id_outlet');
		$dataUser = $this->getDataUser();
		
		// Jika admninistrator tapi harus sesuai outlet
		if ($id_jabatan == '2') {
			// cek outlet
			if ($dataUser['id_outlet'] !== $id_outlet) {
				$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data ' . $table);
				$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data ' . $table, $this->mm->id_user());
				redirect($table);
			}
		// jika bukan super administrator
		} elseif ($id_jabatan !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data ' . $table);
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data ' . $table, $this->mm->id_user());
			redirect($table);
		} 
	}

	public function id_user()
	{
		return $this->session->userdata('id_user');
	}

	public function createLog($message, $id_user)
	{
		$data = [
			'isi_log' => $message,
			'tanggal_log' => date('Y-m-d H:i:s'),
			'id_user' => $id_user
		];
		$this->db->insert('log', $data);
	}

	public function getDataUser()
	{
		$id_user = $this->session->userdata('id_user');
		$this->db->select('*');
		$this->db->join('outlet', 'user.id_outlet = outlet.id_outlet');
		$this->db->join('biodata', 'user.id_user = biodata.id_user');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan');
		return $this->db->get_where('user', ['user.id_user' => $id_user])->row_array();
	}

	public function updateBiodata()
	{
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
		];

		$dataUser = $this->mm->getDataUser();
		$id_user = $this->input->post('id_user', true);
		$this->db->where('biodata.id_user', $id_user);
		$this->db->update('biodata', $data);
		$this->session->set_flashdata('message-success', 'Biodata Pengguna ' . $dataUser['username'] . ' berhasil diubah');
		$this->mm->createLog('Biodata Pengguna ' . $dataUser['username'] . ' berhasil diubah', $this->mm->id_user());
		redirect('user');
	}


	public function changePassword()
	{
		$dataUser = $this->mm->getDataUser();
		$password_old = $this->input->post('password_old', true);
		$password_new = $this->input->post('password_new', true);
		
		if (password_verify($password_old, $dataUser['password'])) {
			$password_hash = password_hash($password_new, PASSWORD_DEFAULT);
			$data = [
				'password' => $password_hash
			];
			
			$this->db->where('user.id_user', $this->mm->id_user());
			$this->db->update('user', $data);
			$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Password');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Password', $this->mm->id_user());		
			redirect('main/profile');
		} else {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' gagal mengubah Password! Password tidak sesuai dengan password lama');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' gagal mengubah Password! Password tidak sesuai dengan password lama', $this->mm->id_user());		
			redirect('main/profile');
			return false;
		}
	}


	public function createBiodata()
	{
		$data = [
			'nama_lengkap' => $this->input->post('nama_lengkap', true),
			'tempat_lahir' => $this->input->post('tempat_lahir', true),
			'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
			'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
			'golongan_darah' => $this->input->post('golongan_darah', true),
			'telepon' => $this->input->post('telepon', true),
			'email' => $this->input->post('email', true),
			'alamat' => $this->input->post('alamat', true),
			'foto' => $this->input->post('foto', true),
			'id_user' => $this->id_user()
		];
		$this->db->insert('biodata', $data);
		$this->session->set_flashdata('message-success', 'Biodata berhasil ditambahkan');
		$this->createLog('Biodata berhasil ditambahkan', $this->id_user());
		redirect('main/biodata');
	}
	public function getAllOutlet()
	{
		return $this->db->get('outlet')->result_array();
	}
}