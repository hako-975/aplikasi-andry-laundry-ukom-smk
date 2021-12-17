<?php 
	$id = $this->session->userdata('id_user');
	$this->db->join('biodata', 'biodata.id_user = user.id_user');
	$cek_biodata = $this->db->get_where('user', ['user.id_user' => $id])->row_array();
 ?>
<!DOCTYPE html>
<html lang="en" id="page-top">
  <head>
  	<?php include 'include-css.php'; ?>
	<title><?= $title; ?></title>
  </head>
  <body>
	<?php if ($cek_biodata !== NULL): ?>
		<div class="wrapper">
			<!-- Sidebar  -->
			<nav id="sidebar">
			    <div class="sidebar-header">
			    	<img class="img-fluid" src="<?= base_url('assets/img/img_properties/laundry.jpg'); ?>" alt="logo">
			    </div>

			    <ul class="list-unstyled components">
			      <p class="bg-primary my-0"><strong>Outlet</strong> : <?= $dataUser['nama_outlet']; ?></p>
			      <p class="bg-success my-0"><strong>Pengguna</strong> : <?= $dataUser['username']; ?></p>
			      <p class="bg-danger my-0"><strong>Jabatan</strong> : <?= $dataUser['nama_jabatan']; ?></p>
			      <li>
			      	<a href="<?= base_url('main'); ?>"><i class="fas fa-fw fa-tachometer-alt"></i> Dasbor</a>
			      </li>
			      <?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
			      	<li>
				      	<a href="<?= base_url('member/tambahMember'); ?>"><i class="fas fa-fw fa-users"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Member</a>
				    </li>
				    <li>
				      	<a href="<?= base_url('transaksi/tambahTransaksi'); ?>"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-1x fa-plus"></i></sup> Tambah Transaksi</a>
				    </li>
					<li>
						<a href="<?= base_url('transaksi'); ?>"><i class="fas fa-fw fa-handshake"></i> Transaksi</a>
					</li>
				  <?php endif ?>
			      <li>
			        <a href="#manajemenSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-fw fa-align-justify"></i> Manajemen Data</a>
			        <ul class="collapse list-unstyled" id="manajemenSubmenu">
			        	<!-- Jika yang login super administrator -->
			        	<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
				        <li>
				        	<a href="<?= base_url('outlet'); ?>"><i class="fas fa-fw fa-store"></i> Outlet</a>
				        </li>
				        <li>
				            <a href="<?= base_url('jabatan'); ?>"><i class="fas fa-fw fa-user"></i> <sup><i class="fas fa-1x fa-chart-line"></i></sup> Jabatan</a>
				        </li>
						<?php endif ?>
						<li>
							<a href="<?= base_url('user'); ?>"><i class="fas fa-fw fa-user"></i> Pengguna</a>
						</li>
			        	<!-- Jika yang login super administrator atau administrator -->
			        	<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
						<li>
							<a href="<?= base_url('jenisPaket'); ?>"><i class="fas fa-fw fa-boxes"></i> Jenis Paket</a>
						</li>
						<?php endif ?>
			        	<?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
						<li>
							<a href="<?= base_url('paket'); ?>"><i class="fas fa-fw fa-box"></i> Paket</a>
						</li>
						<?php endif ?>
						<li>
							<a href="<?= base_url('member'); ?>"><i class="fas fa-fw fa-users"></i> Member</a>
						</li>
			        </ul>
			      </li>
			      <li>
			          <a href="<?= base_url('laporan'); ?>"><i class="fas fa-fw fa-file-signature"></i> Laporan</a>
			      </li>
		    	  <!-- Jika yang login super administrator atau administrator -->
			      <?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
			      <li>
			        <a href="<?= base_url('log'); ?>"><i class="fas fa-fw fa-file-alt"></i> Catatan</a>
			      </li>
			      <?php endif ?>
			      <li>
			        <a data-toggle="modal" data-target="#logoutModal" href=""><i class="fas fa-fw fa-sign-out-alt"></i> Keluar</a>
			      </li>
			    </ul>

			    <ul class="list-unstyled">
			      <li>
			        <p>Hak Cipta 2020 &copy; Oleh Andri.</p>
			      </li>
			    </ul>
			</nav>

			<!-- Page Content  -->
			<div id="content">
			    <nav class="navbar navbar-expand-lg navbar-light bg-light">
			      <div class="container-fluid">
			        <button type="button" id="sidebarCollapse" class="btn btn-info">
			          <i class="fas fa-align-left"></i>
			        </button>

			        <ul class="nav navbar-nav ml-auto my-2">
			          <li class="nav-item active">
			            <a href="<?= base_url('main/profile'); ?>" class="btn btn-primary"><i class="fas fa-fw fa-user"></i> <?= $dataUser['username']; ?></a>
			          </li>
			        </ul>
			      </div>
			    </nav>
			    
		    	<div class="container-fluid">
	    	
			    	<!-- Modal Logout -->
					<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="logoutModalLabel">Keluar Aplikasi Andry Laundry</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					       	Apakah <?= $dataUser['username']; ?> dari outlet <?= $dataUser['nama_outlet']; ?> ingin keluar aplikasi?
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
					        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-primary"><i class="fas fa-fw fa-sign-out-alt"></i> Keluar</a>
					      </div>
					    </div>
					  </div>
					</div>
	<?php endif ?>