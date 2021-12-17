<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
	public function getJumlahMemberAll()
	{
		return $this->db->count_all_results('member');
	}
	public function getTransaksiLaporan($tanggal_awal, $tanggal_akhir)
	{
		$query = "SELECT *, (SELECT count('transaksi.id_transaksi') FROM transaksi) AS jumlah_transaksi FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet
			INNER JOIN member ON transaksi.id_member = member.id_member
			WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query)->result_array();
	}

	public function getTransaksiLaporanSortTgl($tanggal_awal, $tanggal_akhir)
	{
		$query = "SELECT *, (SELECT count('transaksi.id_transaksi') FROM transaksi WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir') AS jumlah_transaksi FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet
			INNER JOIN member ON transaksi.id_member = member.id_member
			WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}

	public function getTransaksiLaporanSortStatusTransaksi($tanggal_awal, $tanggal_akhir, $status_transaksi)
	{
		$query = "SELECT *, (SELECT count('transaksi.status_transaksi') FROM transaksi WHERE transaksi.status_transaksi = '$status_transaksi' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir') AS '$status_transaksi' FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet
			INNER JOIN member ON transaksi.id_member = member.id_member
			WHERE transaksi.status_transaksi = '$status_transaksi' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}

	public function getTransaksiLaporanSortStatusBayar($tanggal_awal, $tanggal_akhir, $status_bayar)
	{
		$query = "SELECT *, (SELECT count('transaksi.status_bayar') FROM transaksi WHERE transaksi.status_bayar = '$status_bayar' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir') AS '$status_bayar' FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet
			INNER JOIN member ON transaksi.id_member = member.id_member
			WHERE transaksi.status_bayar = '$status_bayar' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}

	public function getTransaksiLaporanSortStatusBayarOutletAdministrator($tanggal_awal, $tanggal_akhir, $status_bayar)
	{
		$id_outlet = $this->session->userdata('id_outlet');
		$query = "SELECT *, (SELECT count('transaksi.status_bayar') FROM transaksi WHERE transaksi.status_bayar = '$status_bayar' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND transaksi.id_outlet = '$id_outlet') AS '$status_bayar' FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet
			INNER JOIN member ON transaksi.id_member = member.id_member
			WHERE transaksi.status_bayar = '$status_bayar' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND transaksi.id_outlet = '$id_outlet'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}

	public function getMemberSeringMencuci($tanggal_awal, $tanggal_akhir)
	{
		$query = "SELECT *, count('transaksi.id_transaksi') as jumlah_cuci FROM transaksi 
		INNER JOIN user ON transaksi.id_user = user.id_user 
		INNER JOIN member ON transaksi.id_member = member.id_member 
		INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet WHERE 
		transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
		GROUP BY member.id_member
		ORDER BY jumlah_cuci DESC
		LIMIT 0, 5 
		";
		return $this->db->query($query);
	}

	// administrator outlet
	public function getTransaksiLaporanOutletAdministrator($tanggal_awal, $tanggal_akhir)
	{
		$id_outlet = $this->session->userdata('id_outlet');
		$query = "SELECT *, (SELECT count('transaksi.id_transaksi') FROM transaksi INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet WHERE outlet.id_outlet = '$id_outlet') AS jumlah_transaksi FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet
			INNER JOIN member ON transaksi.id_member = member.id_member
			WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
			AND outlet.id_outlet = '$id_outlet'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query)->result_array();
	}

	public function getTransaksiLaporanSortTglOutletAdministrator($tanggal_awal, $tanggal_akhir)
	{
		$id_outlet = $this->session->userdata('id_outlet');
		$query = "SELECT *, (SELECT count('transaksi.id_transaksi') FROM transaksi INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND outlet.id_outlet = '$id_outlet') AS jumlah_transaksi FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet
			INNER JOIN member ON transaksi.id_member = member.id_member
			WHERE transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
			AND outlet.id_outlet = '$id_outlet'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}

	public function getTransaksiLaporanSortStatusTransaksiOutletAdministrator($tanggal_awal, $tanggal_akhir, $status_transaksi)
	{
		$id_outlet = $this->session->userdata('id_outlet');
		$query = "SELECT *, (SELECT count('transaksi.status_transaksi') FROM transaksi INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet WHERE transaksi.status_transaksi = '$status_transaksi' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND outlet.id_outlet = '$id_outlet') AS '$status_transaksi' FROM transaksi 
			INNER JOIN user ON transaksi.id_user = user.id_user
			INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet
			INNER JOIN member ON transaksi.id_member = member.id_member
			WHERE transaksi.status_transaksi = '$status_transaksi' AND transaksi.tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
			AND outlet.id_outlet = '$id_outlet'
			ORDER BY transaksi.tanggal_transaksi DESC
		";
		return $this->db->query($query);
	}

	public function getMemberSeringMencuciOutletAdministrator($tanggal_awal, $tanggal_akhir)
	{
		$id_outlet = $this->session->userdata('id_outlet');
		$query = "SELECT *, count('transaksi.id_transaksi') as jumlah_cuci FROM transaksi 
		INNER JOIN user ON transaksi.id_user = user.id_user 
		INNER JOIN member ON transaksi.id_member = member.id_member 
		INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet WHERE transaksi.tanggal_transaksi 
		BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND outlet.id_outlet = '$id_outlet' 
		GROUP BY member.id_member
		ORDER BY jumlah_cuci DESC
		LIMIT 0, 5 
		";
		return $this->db->query($query);
	}

	public function getTransaksiWajibSelesaiHariIni()
	{
		$tanggal_awal = date('Y-m-d 00:00:00');
		$tanggal_akhir = date('Y-m-d 23:59:59');

		$query = "SELECT * FROM transaksi 
		INNER JOIN member ON transaksi.id_member = member.id_member 
		INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet 
		WHERE transaksi.batas_waktu 
		BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
		";
		return $this->db->query($query)->result_array();
	}

	public function getTransaksiWajibSelesaiHariIniOutletAdministrator()
	{
		$tanggal_awal = date('Y-m-d 00:00:00');
		$tanggal_akhir = date('Y-m-d 23:59:59');

		$id_outlet = $this->session->userdata('id_outlet');
		$query = "SELECT * FROM transaksi 
		INNER JOIN member ON transaksi.id_member = member.id_member 
		INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet 
		WHERE transaksi.batas_waktu 
		BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND outlet.id_outlet = '$id_outlet'
		";
		return $this->db->query($query)->result_array();
	}

	public function getPenghasilanOutletAdministrator($tanggal_awal, $tanggal_akhir)
	{
		$id_outlet = $this->session->userdata('id_outlet');
		$query = "SELECT *, sum(
			(((paket.harga_paket * detail_transaksi.kuantitas) + transaksi.biaya_tambahan) - (((paket.harga_paket * detail_transaksi.kuantitas) + transaksi.biaya_tambahan) * transaksi.diskon / 100)) + (((((paket.harga_paket * detail_transaksi.kuantitas) + transaksi.biaya_tambahan) - (((paket.harga_paket * detail_transaksi.kuantitas) + transaksi.biaya_tambahan) * transaksi.diskon / 100)) * transaksi.pajak) / 100)
		) as penghasilan
		FROM transaksi
		INNER JOIN user ON transaksi.id_user = user.id_user 
		INNER JOIN member ON transaksi.id_member = member.id_member 
		INNER JOIN detail_transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi 
		INNER JOIN paket ON detail_transaksi.id_paket = paket.id_paket 
		INNER JOIN jenis_paket ON paket.id_jenis_paket = jenis_paket.id_jenis_paket 
		INNER JOIN outlet ON transaksi.id_outlet = outlet.id_outlet WHERE transaksi.tanggal_transaksi 
		BETWEEN '$tanggal_awal' AND '$tanggal_akhir' AND outlet.id_outlet = '$id_outlet'
		";
		return $this->db->query($query)->row_array();
	}

	public function getPenghasilan($tanggal_awal, $tanggal_akhir)
	{
		$query = "SELECT jmlPenghasilan ('$tanggal_awal', '$tanggal_akhir') as penghasilan";
		return $this->db->query($query)->row_array();
	}
}