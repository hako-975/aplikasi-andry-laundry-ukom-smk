<div class="container">
	<div class="row my-2">
		<div class="col-lg header-judul">
			<h2><i class="fas fa-fw fa-file-signature"></i> Daftar Laporan</h2>
			<?php if (validation_errors()): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Gagal!</strong> <?= validation_errors(); ?>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<?php endif ?>
		</div>
	</div>
	<!-- Form Cari Tanggal dan jumlah pelanggan -->
	<div class="row my-2">
		<div class="col-lg-8">
			<div class="p-4 m-1 rounded text-white bg-info">
				<h3>Filter Tanggal Transaksi</h3>
				<?php if (isset($_POST['cari_tanggal'])): ?>
					<?php 
						$tanggal_awal_heading = date('d-m-Y', strtotime($tanggal_awal));
						$tanggal_akhir_heading = date('d-m-Y', strtotime($tanggal_akhir));
					 ?>
					<h5>Dari Tanggal <?= $tanggal_awal_heading; ?> Sampai Tanggal <?= $tanggal_akhir_heading; ?></h5>
				<?php else: ?>
					<h5>Dari Tanggal <?= date('01-m-Y'); ?> Sampai Tanggal <?= date('d-m-Y'); ?></h5>
				<?php endif ?>
				<form action="<?= base_url('laporan'); ?>" method="post">
					<div class="row">
						<div class="col-lg my-1">
							<div class="form-group">
								<label for="tanggal_awal">Tanggal Awal</label>
								<?php if (isset($_POST['cari_tanggal'])): ?>
									<input type="date" id="tanggal_awal" class="form-control" name="tanggal_awal" value="<?= $tanggal_awal; ?>">
								<?php else: ?>
									<input type="date" id="tanggal_awal" class="form-control" name="tanggal_awal" value="<?= date('Y-m-01'); ?>">
								<?php endif ?>
							</div>
						</div>
						<div class="col-lg my-1">
							<div class="form-group">
								<label for="tanggal_akhir">Tanggal Akhir</label>
								<?php if (isset($_POST['cari_tanggal'])): ?>
									<input type="date" id="tanggal_akhir" class="form-control" name="tanggal_akhir" value="<?= $tanggal_akhir; ?>">
								<?php else: ?>
									<input type="date" id="tanggal_akhir" class="form-control" name="tanggal_akhir" value="<?= date('Y-m-d'); ?>">
								<?php endif ?>
							</div>
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-lg my-1">
							<label for="status_transaksi">Status Transaksi</label>
							<select name="status_transaksi" id="status_transaksi" class="form-control">
								<option value="semua">Semua</option>
								<option value="proses">Proses</option>
								<option value="dicuci">Dicuci</option>
								<option value="siap diambil">Siap diambil</option>
								<option value="sudah diambil">Sudah diambil</option>
							</select>
						</div>
						<div class="col-lg my-1">
							<label for="status_bayar">Status Bayar</label>
							<select name="status_bayar" id="status_bayar" class="form-control">
								<option value="semua">Semua</option>
								<option value="belum dibayar">Belum dibayar</option>
								<option value="sudah dibayar">Sudah dibayar</option>
							</select>
						</div>
					</div> -->
					<div class="row">
						<div class="col-lg my-1">
							<button type="submit" name="cari_tanggal" class="btn btn-success"><i class="fas fa-fw fa-filter"></i> Filter</button>
						</div>
						<div class="col-lg my-1">
							<a href="<?= base_url('laporan'); ?>" class="btn btn-secondary"><i class="fas fa-fw fa-undo"></i> Reset</a>
						</div>
					</div>
				</form>
			</div>
			<div class="p-4 m-1 rounded text-white bg-info">
			<?php if (isset($_POST['cari_tanggal'])): ?>
				<h3>Penghasilan (Rp.) <?= number_format($penghasilan['penghasilan']); ?></h3>
			<?php else: ?>
				<h3>Penghasilan (Rp.) 0</h3>
			<?php endif ?>
			</div>
			<?php if (isset($_POST['cari_tanggal'])): ?>
			<div class="p-4 m-1">
				<a target="_blank" href="<?= base_url('prints/laporan/' . $tanggal_awal . '/' . $tanggal_akhir); ?>" class="btn btn-success"><i class="fas fa-fw fa-print"></i> Cetak</a>
			</div>
			<?php endif ?>
		</div>
		<?php if (isset($_POST['cari_tanggal'])): ?>
			<div class="col-lg-4">
				<div class="p-4 m-1 jumlah-laporan rounded bg-success text-white">
					<div class="card text-dark">
					  <div class="card-header">
					    Jumlah
					  </div>
					  <ul class="list-group list-group-flush">
					    <li class="list-group-item"><i class="fas fa-fw fa-users"></i> Member : <strong>
					    	<?php if ($jumlah_member == null): ?>
					    		0
					    	<?php else: ?>
					    		<?= $jumlah_member; ?>
					    	<?php endif ?>
					    </strong></li>
					    <li class="list-group-item"><i class="fas fa-fw fa-handshake"></i> Transaksi : 
					    	<strong>
					    		<?php if ($jumlah_transaksi == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_transaksi['jumlah_transaksi']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
					    <li class="list-group-item"><i class="fas fa-fw fa-sync"></i> Proses : 
					    	<strong>
					    		<?php if ($jumlah_status_transaksi_proses == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_status_transaksi_proses['proses']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
					    <li class="list-group-item"><i class="fas fa-fw fa-tshirt"></i> Dicuci : 
					    	<strong>
					    		<?php if ($jumlah_status_transaksi_dicuci == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_status_transaksi_dicuci['dicuci']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
					    <li class="list-group-item"><i class="fas fa-fw fa-people-carry"></i> Siap Diambil : 
					    	<strong>
					    		<?php if ($jumlah_status_transaksi_siap_diambil == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_status_transaksi_siap_diambil['siap diambil']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
					    <li class="list-group-item"><i class="fas fa-fw fa-check-circle"></i> Sudah Diambil : 
					    	<strong>
					    		<?php if ($jumlah_status_transaksi_sudah_diambil == null): ?>
					    			0
					    		<?php else: ?>
						    		<?= $jumlah_status_transaksi_sudah_diambil['sudah diambil']; ?>
					    		<?php endif ?>
					    	</strong>
					    </li>
						<li class="list-group-item"><i class="fas fa-fw fa-dollar-sign"></i><sup><i class="fas fa-1x fa-times"></i></sup> Belum Dibayar : <strong>
					    	<?php if ($jumlah_status_bayar_belum_dibayar == null): ?>
					    		0
					    	<?php else: ?>
					    		<?= $jumlah_status_bayar_belum_dibayar['belum dibayar']; ?>
					    	<?php endif ?>
					    </strong></li>
					    <li class="list-group-item"><i class="fas fa-fw fa-dollar-sign"></i> Sudah Dibayar : <strong>
					    	<?php if ($jumlah_status_bayar_sudah_dibayar == null): ?>
					    		0
					    	<?php else: ?>
					    		<?= $jumlah_status_bayar_sudah_dibayar['sudah dibayar']; ?>
					    	<?php endif ?>
					    </strong></li>
					  </ul>
					</div>
				</div>
			</div>
		<?php endif ?>
	</div>
	<!-- ./Form Cari Tanggal dan jumlah pelanggan -->
	
	<?php if (isset($_POST['cari_tanggal'])): ?>
		<div class="row">
			<div class="col-lg">
			<?php if (isset($_POST['cari_tanggal'])): ?>
				<h4><i class="fas fa-fw fa-handshake"></i> Daftar Terakhir Transaksi <?= $tanggal_awal_heading; ?> s/d <?= $tanggal_akhir_heading; ?></h4>
			<?php else: ?>
				<h4><i class="fas fa-fw fa-handshake"></i> Daftar Terakhir Transaksi</h4>
			<?php endif ?>
				<div class="table-responsive">
					<table class="table table-striped table-bordered text-center" id="table_id_all">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Invoice</th>
								<th>Nama Member</th>
								<th>Tanggal Transaksi</th>
								<th>Batas Waktu</th>
								<th>Tanggal Bayar</th>
								<th>Status Transaksi</th>
								<th>Status Bayar</th>
								<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
									<th>Outlet</th>
								<?php endif ?>
								<th>Pembuat</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							<?php foreach ($transaksiLaporan as $dt): ?>
								<tr>
									<td><?= $i++; ?></td>
									<td>
										<?= $dt['kode_invoice']; ?>
									</td>
									<td><?= $dt['nama_member']; ?></td>
									<td><?= $dt['tanggal_transaksi']; ?></td>
									<td><?= $dt['batas_waktu']; ?></td>
									<?php if ($dt['tanggal_bayar'] == '0000-00-00 00:00:00'): ?>
							          	<td>-</td>
						          	<?php else: ?>
							        	<td><?= $dt['tanggal_bayar']; ?></td>
							        <?php endif ?>
									<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
										<td>
										  <?php if ($dt['status_transaksi'] == 'proses'): ?>
										    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Proses" data-status2="Dicuci"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
										  <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
										    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="text-white badge badge-warning btn-status" data-status1="Dicuci" data-status2="Siap Diambil"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
										  <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
										    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-primary btn-status" data-status1="Siap Diambil" data-status2="Sudah Diambil"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
										  <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
										    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
										  <?php else: ?>
										    <span class="badge badge-info"><?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
										  <?php endif ?>
										</td>
									<?php else: ?>
										<td>
										  <?php if ($dt['status_transaksi'] == 'proses'): ?>
										    <span class="badge badge-danger"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
										  <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
										    <span class="text-white badge badge-warning"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
										  <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
										    <span class="badge badge-primary"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
										  <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
										    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
										  <?php else: ?>
										    <span class="badge badge-info"><?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
										  <?php endif ?>
										</td>
									<?php endif ?>
									<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
										<td>
											<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
												<a href="<?= base_url('/transaksi/pembayaranTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Belum Dibayar" data-status2="Sudah Dibayar"><i class="fas fa-fw fa-times"></i> <?= $dt['status_bayar']; ?></a>
											<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
												<span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $dt['status_bayar']; ?></span>
											<?php endif ?>
										</td>
									<?php else: ?>
										<td>
											<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
												<span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> <?= $dt['status_bayar']; ?></span>
											<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
												<span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $dt['status_bayar']; ?></span>
											<?php endif ?>
										</td>
									<?php endif ?>
									<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
										<td><?= $dt['nama_outlet']; ?></td>
									<?php endif ?>
									<td><?= $dt['username']; ?></td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php endif ?>
</div>