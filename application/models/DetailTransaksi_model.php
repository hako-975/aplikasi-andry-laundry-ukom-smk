<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetailTransaksi_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	
	public function getAllDetailTransaksi()
	{
		$this->db->select('*');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('member', 'transaksi.id_member = member.id_member');
		$this->db->join('outlet', 'transaksi.id_outlet = outlet.id_outlet');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		$this->db->order_by('detail_transaksi.id_detail_transaksi', 'desc');
		return $this->db->get('detail_transaksi')->result_array();
	}

	public function getDetailTransaksiIdTransaksiByKodeInvoice($kode_invoice)
	{
		return $this->db->get_where('detail_transaksi', ['id_transaksi' => $id])->row_array();
	}

	public function getDetailTransaksiOutletAdministrator()
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('outlet', 'transaksi.id_outlet = outlet.id_outlet');
		$this->db->join('member', 'transaksi.id_member = member.id_member');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		$this->db->join('pembayaran', 'pembayaran.id_transaksi = transaksi.id_transaksi');
		$this->db->order_by('detail_transaksi.id_detail_transaksi', 'desc');
		$id_outlet = $this->session->userdata('id_outlet');
		$this->db->where('outlet.id_outlet', $id_outlet);
		return $this->db->get('detail_transaksi')->row_array();
	}

	public function getDetailTransaksiOutletAdministratorByIdTransaksi($id_transaksi)
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('outlet', 'transaksi.id_outlet = outlet.id_outlet');
		$this->db->join('member', 'transaksi.id_member = member.id_member');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('jenis_paket', 'paket.id_jenis_paket = jenis_paket.id_jenis_paket');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		$this->db->order_by('detail_transaksi.id_detail_transaksi', 'desc');
		$id_outlet = $this->session->userdata('id_outlet');
		$this->db->where('outlet.id_outlet', $id_outlet);
		$this->db->where('detail_transaksi.id_transaksi', $id_transaksi);
		return $this->db->get('detail_transaksi')->row_array();
	}

	public function getTransaksiProsesOutletAdministrator()
	{
		$this->db->select('*');
		$this->db->join('outlet', 'transaksi.id_outlet = outlet.id_outlet');
		$this->db->join('member', 'transaksi.id_member = member.id_member');
		$this->db->order_by('transaksi.tanggal_transaksi', 'desc');
		$id_outlet = $this->session->userdata('id_outlet');
		$this->db->where('outlet.id_outlet', $id_outlet);
		$this->db->where('transaksi.status_transaksi', 'proses');
		return $this->db->get('transaksi')->result_array();
	}

	public function getTransaksiById($id)
	{
		return $this->db->get_where('transaksi', ['id_transaksi' => $id])->row_array();
	}

	public function getAllPaket()
	{
		$this->db->select('*');
		$this->db->join('outlet', 'paket.id_outlet = outlet.id_outlet');
		$this->db->join('jenis_paket', 'paket.id_jenis_paket = jenis_paket.id_jenis_paket');
		return $this->db->get('paket')->result_array();
	}

	public function getAllPaketOutletAdministrator()
	{
		$this->db->join('outlet', 'paket.id_outlet = outlet.id_outlet');
		$this->db->join('jenis_paket', 'paket.id_jenis_paket = jenis_paket.id_jenis_paket');
		$id_outlet = $this->session->userdata('id_outlet');
		$this->db->where('outlet.id_outlet', $id_outlet);
		$this->db->order_by('paket.id_paket', 'asc');
		return $this->db->get('paket')->result_array();
	}

	public function getPaketOutletAdministratorById($id_transaksi)
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('outlet', 'transaksi.id_outlet = outlet.id_outlet');
		$this->db->join('member', 'transaksi.id_member = member.id_member');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('jenis_paket', 'paket.id_jenis_paket = jenis_paket.id_jenis_paket');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		$id_outlet = $this->session->userdata('id_outlet');
		$this->db->where('outlet.id_outlet', $id_outlet);
		$this->db->where('detail_transaksi.id_transaksi', $id_transaksi);
		$this->db->order_by('paket.id_paket', 'asc');
		return $this->db->get('detail_transaksi')->result_array();
	}

	public function getDetailTransaksiById($id)
	{
		$this->db->select('*');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		return $this->db->get_where('detail_transaksi', ['detail_transaksi.id_detail_transaksi' => $id])->row_array();
	}

	public function getJumlahPaketOutletAdministrator()
	{	
		$this->db->select('*');
		$this->db->join('outlet', 'outlet.id_outlet = paket.id_outlet');
		$this->db->where('outlet.id_outlet', $this->session->userdata('id_outlet'));
		return $this->db->count_all_results('paket');
	}

	public function createDetailTransaksi()
	{
		$id_transaksi = $this->input->post('id_transaksi', true);
		$jumlahPaketOutlet = $this->getJumlahPaketOutletAdministrator();
		$id_paket = $this->input->post('id_paket', true);
		$kuantitas = $this->input->post('kuantitas', true);
		$keterangan = $this->input->post('keterangan', true);

		$transaksi = $this->getTransaksiById($id_transaksi);
		
		// jika kuantitas tidak diisi
		$required_kuantitas = '';
		for ($i=0; $i < $jumlahPaketOutlet; $i++) { 
			$required_kuantitas .= $kuantitas[$i] !== '';
			$required_kuantitas .= ' AND ';
		}
		$required_kuantitas = rtrim($required_kuantitas, ' AND ');

		if ($required_kuantitas == '') {
			$this->session->set_flashdata('message-failed', 'Detail Transaksi ' . $transaksi['kode_invoice'] . ' gagal ditambahkan! isi minimal 1 paket');
			$this->mm->createLog('Detail Transaksi ' . $transaksi['kode_invoice'] . ' gagal ditambahkan! isi minimal 1 paket', $this->mm->id_user());
			redirect('detailTransaksi/tambahDetailTransaksi');
		}
		

		$query_tambah_detail_transaksi   = "INSERT INTO detail_transaksi (id_transaksi, id_paket, kuantitas, keterangan) VALUES ";
		for( $i=0; $i < $jumlahPaketOutlet; $i++ )
		{
			if ($kuantitas[$i] != '') {
				$query_tambah_detail_transaksi .= "('{$id_transaksi}', '{$id_paket[$i]}', '{$kuantitas[$i]}', '{$keterangan[$i]}')";
				$query_tambah_detail_transaksi .= ",";
			}
		}
		$query_tambah_detail_transaksi = rtrim($query_tambah_detail_transaksi, ",");

		$this->db->query($query_tambah_detail_transaksi);
		$this->session->set_flashdata('message-success', 'Detail Transaksi ' . $transaksi['kode_invoice'] . ' berhasil ditambahkan');
		$this->mm->createLog('Detail Transaksi ' . $transaksi['kode_invoice'] . ' berhasil ditambahkan', $this->mm->id_user());

		if ($this->session->userdata('status_bayar')) {
			$this->session->unset_userdata('kode_invoice');
			$this->session->set_userdata(['id_transaksi' => $id_transaksi]);
			redirect('transaksi/pembayaranTransaksi');
		} else {
			// meng unset session
			$this->session->unset_userdata('kode_invoice');
			$this->session->unset_userdata('status_bayar');
			redirect('detailTransaksi/index/' . $id_transaksi);
		}

	}

	public function updateDetailTransaksi($id)
	{
		$id_transaksi = $this->input->post('id_transaksi', true);
		$id_detail_transaksi = $this->input->post('id_detail_transaksi', true);
		$id_paket = $this->input->post('id_paket', true);
		$kuantitas = $this->input->post('kuantitas', true);
		$keterangan = $this->input->post('keterangan', true);
		$transaksi = $this->getTransaksiById($id_transaksi);
		$jumlahPaketOutlet = $this->getJumlahPaketOutletAdministrator();

 		$required_kuantitas = '';
		for ($i=0; $i < $jumlahPaketOutlet; $i++) { 
			$required_kuantitas .= $kuantitas[$i] !== '';
			$required_kuantitas .= ' AND ';
		}
		$required_kuantitas = rtrim($required_kuantitas, ' AND ');

		if ($required_kuantitas == '') {
			$this->session->set_flashdata('message-failed', 'Detail Transaksi ' . $transaksi['kode_invoice'] . ' gagal ditambahkan! isi minimal 1 paket');
			$this->mm->createLog('Detail Transaksi ' . $transaksi['kode_invoice'] . ' gagal ditambahkan! isi minimal 1 paket', $this->mm->id_user());
			redirect('detailTransaksi/index/' . $id_transaksi);
		}

		for ($i=0; $i < count($id_paket); $i++) { 
			$idPaket 	= $id_paket[$i];
			$idDetail 	= $id_detail_transaksi[$i];
			$qty 		= $kuantitas[$i];
			$ket 		= $keterangan[$i];

			if ($qty > 0) {
				$cek 	= $this->db->get_where('detail_transaksi',["id_detail_transaksi" => $idDetail]);
				if ($cek->num_rows() > 0) {
					$data = [
						'id_paket' => $idPaket,
						'kuantitas' => $qty,
						'keterangan' => $ket,
						'id_transaksi' => $id_transaksi
					];
					$this->db->where('id_detail_transaksi', $idDetail);
					$this->db->update('detail_transaksi', $data);
				}else{
					$data = [
						'id_paket' => $idPaket,
						'kuantitas' => $qty,
						'keterangan' => $ket,
						'id_transaksi' => $id_transaksi
					];
					$this->db->insert('detail_transaksi', $data);
				}
			}else{
				$cek 	= $this->db->get_where('detail_transaksi',["id_detail_transaksi" => $idDetail]);
				if ($cek->num_rows() > 0) {
					$this->db->where('id_detail_transaksi', $idDetail);
					$this->db->delete('detail_transaksi');
				}
			}
		}

		$this->session->set_flashdata('message-success', 'Detail Transaksi ' . $transaksi['kode_invoice'] . ' berhasil dimanipulasi');
		$this->mm->createLog('Detail Transaksi ' . $transaksi['kode_invoice'] . ' berhasil dimanipulasi', $this->mm->id_user());
	
		redirect('detailTransaksi/index/' . $id_transaksi);
	}

	public function getKodeInvoiceById($id_transaksi)
	{
		return $this->db->get_where('transaksi', ['id_transaksi' => $id_transaksi])->row_array();
	}

	public function getDetailTransaksiByIdTransaksi($id_transaksi)
	{
		$this->db->select('*');
		$this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
		$this->db->join('outlet', 'transaksi.id_outlet = outlet.id_outlet');
		$this->db->join('member', 'transaksi.id_member = member.id_member');
		$this->db->join('paket', 'detail_transaksi.id_paket = paket.id_paket');
		$this->db->join('user', 'transaksi.id_user = user.id_user');
		$this->db->order_by('detail_transaksi.id_detail_transaksi', 'desc');
		$this->db->where('detail_transaksi.id_transaksi', $id_transaksi);
		return $this->db->get('detail_transaksi')->row_array();
	}		

	// public function deleteDetailTransaksi($id)
	// {
	// 	$data['detail_transaksi'] = $this->getDetailTransaksiById($id);
	// 	$transaksi = $this->getTransaksiById($id);
	// 	$this->db->delete('detail_transaksi', ['id_detail_transaksi' => $id]);
	// 	$this->session->set_flashdata('message-success', 'Detail Transaksi ' . $transaksi['kode_invoice'] . ' berhasil dihapus');
	// 	$this->mm->createLog('Detail Transaksi ' . $transaksi['kode_invoice'] . ' berhasil dihapus', $this->mm->id_user());
	// 	redirect('detailTransaksi');
	// }

}