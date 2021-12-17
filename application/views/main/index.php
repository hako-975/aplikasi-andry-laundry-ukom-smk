<div class="row my-2">
	<div class="col-lg header-judul">
		<h2><i class="fas fa-fw fa-tachometer-alt"></i> Dashbor</h2>
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
	<div class="col-lg-9">
        <form method="post" action="<?= base_url('main'); ?>" class="form-inline bg-primary p-3 rounded text-white">
          <div class="row mx-auto justify-content-center">
            <div class="col-lg text-center ml-2 p-1">
				<?php if (isset($_POST['cari_tanggal'])): ?>
					<?php 
						$tanggal_awal_heading = date('d-m-Y', strtotime($tanggal_awal));
						$tanggal_akhir_heading = date('d-m-Y', strtotime($tanggal_akhir));
					 ?>
					<h5>Dari Tanggal <?= $tanggal_awal_heading; ?> Sampai Tanggal <?= $tanggal_akhir_heading; ?></h5>
				<?php else: ?>
					<h5>Dari Tanggal <?= date('01-m-Y'); ?> Sampai Tanggal <?= date('d-m-Y'); ?></h5>
				<?php endif ?>
            </div>
          </div>
          <div class="row justify-content-center text-center">
            <div class="col-lg">
              <div class="form-group my-1">
                <label class="mx-2">Dari tanggal : </label>
                <?php if (isset($_POST['cari_tanggal'])): ?>
                  <input type="date" name="tanggal_awal" class="form-control" value="<?= $tanggal_awal; ?>">
                <?php else: ?>
                  <input type="date" name="tanggal_awal" class="form-control" value="<?= date('Y-m-01'); ?>">
                <?php endif ?>
              </div>
            </div>
            <div class="col-lg">
              <div class="form-group my-1">
                <label class="mx-2">Sampai tanggal : </label>
                <?php if (isset($_POST['cari_tanggal'])): ?>
                  <input type="date" name="tanggal_akhir" class="form-control" value="<?= $tanggal_akhir; ?>">
                <?php else: ?>
                  <input type="date" name="tanggal_akhir" class="form-control" value="<?= date('Y-m-d'); ?>">
                <?php endif ?>
              </div>
            </div>
            <div class="col-lg mt-4">
              <div class="form-group my-1">
                <button class="btn btn-success mx-1" name="cari_tanggal" type="submit"><i class="fas fa-fw fa-filter"></i> Filter</button>
                <a class="btn btn-success mx-1" href="<?= base_url('main'); ?>"><i class="fas fa-fw fa-redo"></i></a>
              </div>
            </div>
          </div>
        </form>
      </div>
	
	<!-- ./Form Cari Tanggal dan jumlah pelanggan -->
	<div class="col-lg-3 mb-3">
        <div class="card">
          <div class="card-body bg-secondary text-white text-center">
            <div class="row justify-content-center">
              <div class="col-lg my-2">
                <i class="fas fa-3x fa-users"></i>
              </div>
              <div class="col-lg my-2">
                <h1><?php if ($jumlah_member == ''): ?>
			    		0
			    	<?php else: ?>
			    		<?= $jumlah_member; ?>
			    	<?php endif ?></h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg">
                <h5>Member</h5>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 mb-3">
        <div class="card">
          <div class="card-body bg-danger text-white text-center">
            <div class="row justify-content-center">
              <div class="col-lg my-2">
                <i class="fas fa-3x fa-sync"></i>
              </div>
              <div class="col-lg my-2">
                <h1>	
                	<?php if (isset($jumlah_status_transaksi_proses['proses'])): ?>
			    		<?= $jumlah_status_transaksi_proses['proses']; ?>
		    		<?php else: ?>
		    			0
		    		<?php endif ?>
			    </h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg">
                <h5>Proses</h5>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 mb-3">
        <div class="card">
          <div class="card-body bg-warning text-white text-center">
            <div class="row justify-content-center">
              <div class="col-lg my-2">
                <i class="fas fa-3x fa-tshirt"></i>
              </div>
              <div class="col-lg my-2">
                <h1>	
                	<?php if (isset($jumlah_status_transaksi_dicuci['dicuci'])): ?>
			    		<?= $jumlah_status_transaksi_dicuci['dicuci']; ?>
		    		<?php else: ?>
		    			0
		    		<?php endif ?>
			    </h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg">
                <h5>Dicuci</h5>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 mb-3">
        <div class="card">
          <div class="card-body bg-info text-white text-center">
            <div class="row justify-content-center">
              <div class="col-lg my-2">
                <i class="fas fa-3x fa-people-carry"></i>
              </div>
              <div class="col-lg my-2">
                <h1>	
                	<?php if (isset($jumlah_status_transaksi_siap_diambil['siap diambil'])): ?>
			    		<?= $jumlah_status_transaksi_siap_diambil['siap diambil']; ?>
		    		<?php else: ?>
		    			0
		    		<?php endif ?>
			    </h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg">
                <h5>Siap Diambil</h5>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-lg-3 mb-3">
        <div class="card">
          <div class="card-body bg-success text-white text-center">
            <div class="row justify-content-center">
              <div class="col-lg my-2">
                <i class="fas fa-3x fa-check-circle"></i>
              </div>
              <div class="col-lg my-2">
                <h1>	
                	<?php if (isset($jumlah_status_transaksi_sudah_diambil['sudah diambil'])): ?>
			    		<?= $jumlah_status_transaksi_sudah_diambil['sudah diambil']; ?>
		    		<?php else: ?>
		    			0
		    		<?php endif ?>
			    </h1>
              </div>
            </div>
            <div class="row">
              <div class="col-lg">
                <h5>Sudah Diambil</h5>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

<!-- garis pembatas -->
<hr class="my-4">


<div class="row">
	<div class="col-lg">
		<h4><i class="fas fa-fw fa-stopwatch"></i> Daftar Transaksi Yang Wajib Selesai Hari Ini</h5>
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="table_id_5l3">
				<thead>
					<tr class="text-center">
						<th>No</th>
						<th>Kode Invoice</th>
						<th>Nama Member</th>
						<th>Tanggal Transaksi</th>
						<th>Batas Waktu</th>
						<th>Status Transaksi</th>
						<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
							<th>Nama Outlet</th>
						<?php endif ?>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($transaksi_wajib_selesai_hari_ini as $twshi): ?>
						<tr class="text-center">
							<td><?= $i++; ?></td>
							<td><?= $twshi['kode_invoice']; ?></td>
							<td><?= $twshi['nama_member']; ?></td>
							<td><?= $twshi['tanggal_transaksi']; ?></td>
							<td><?= $twshi['batas_waktu']; ?></td>
							<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
								<td>
								  <?php if ($twshi['status_transaksi'] == 'proses'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $twshi['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Proses" data-status2="Dicuci"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($twshi['status_transaksi'])); ?></a>
								  <?php elseif ($twshi['status_transaksi'] == 'dicuci'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $twshi['id_transaksi']; ?>" class="text-white badge badge-warning btn-status" data-status1="Dicuci" data-status2="Siap Diambil"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($twshi['status_transaksi'])); ?></a>
								  <?php elseif ($twshi['status_transaksi'] == 'siap diambil'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $twshi['id_transaksi']; ?>" class="badge badge-primary btn-status" data-status1="Siap Diambil" data-status2="Sudah Diambil"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($twshi['status_transaksi'])); ?></a>
								  <?php elseif ($twshi['status_transaksi'] == 'sudah diambil'): ?>
								    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($twshi['status_transaksi'])); ?></span>
								  <?php else: ?>
								    <span class="badge badge-info"><?= ucwords(strtolower($twshi['status_transaksi'])); ?></span>
								  <?php endif ?>
								</td>
							<?php else: ?>
								<td>
								  <?php if ($twshi['status_transaksi'] == 'proses'): ?>
								    <span class="badge badge-danger"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($twshi['status_transaksi'])); ?></span>
								  <?php elseif ($twshi['status_transaksi'] == 'dicuci'): ?>
								    <span class="text-white badge badge-warning"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($twshi['status_transaksi'])); ?></span>
								  <?php elseif ($twshi['status_transaksi'] == 'siap diambil'): ?>
								    <span class="badge badge-primary"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($twshi['status_transaksi'])); ?></span>
								  <?php elseif ($twshi['status_transaksi'] == 'sudah diambil'): ?>
								    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($twshi['status_transaksi'])); ?></span>
								  <?php else: ?>
								    <span class="badge badge-info"><?= ucwords(strtolower($twshi['status_transaksi'])); ?></span>
								  <?php endif ?>
								</td>
							<?php endif ?>
							<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
								<td><?= $twshi['nama_outlet']; ?></td>
							<?php endif ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- garis pembatas -->
<hr class="my-4">

<div class="row">
	<div class="col-lg">
		<?php if (isset($_POST['cari_tanggal'])): ?>
			<h4><i class="fas fa-fw fa-handshake"></i> Daftar Terakhir Transaksi <?= $tanggal_awal_heading; ?> s/d <?= $tanggal_akhir_heading; ?></h4>
		<?php else: ?>
			<h4><i class="fas fa-fw fa-handshake"></i> Daftar Terakhir Transaksi</h4>
		<?php endif ?>
		<div class="table-responsive">
			<table class="table table-striped table-bordered text-center" id="table_id_5l">
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
						<th>Aksi</th>
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
							<td>
								<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
									<a href="<?= base_url('prints/cetakInvoice/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-info"><i class="fas fa-fw fa-print"></i> Cetak</a>
								<?php endif ?>
								<a href="<?= base_url('detailTransaksi/index/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-warning text-white"><i class="fas fa-fw fa-align-justify"></i> Detail</a>
								<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
									<a href="" data-toggle="modal" data-target="#ubahTransaksiModal<?= $dt['id_transaksi']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
								<?php endif ?>
								<!-- Jika super administrator atau administrator -->
								<?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
									<a href="<?= base_url('transaksi/deleteTransaksi/') . $dt['id_transaksi']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $dt['kode_invoice']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
								<?php endif ?>
							</td>
						</tr>
						<!-- Modal Ubah Transaksi -->
						<div class="text-left modal fade" id="ubahTransaksiModal<?= $dt['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('transaksi/updateTransaksi/') . $dt['id_transaksi']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah Transaksi - <?= $dt['kode_invoice']; ?></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="form-group">
								        	<label for="batas_waktu<?= $dt['kode_invoice']; ?>">Batas Waktu</label>
								        	<?php 
								        		$batas_waktu = $dt['batas_waktu'];
								        		$batas_waktu_timestamp = strtotime($batas_waktu);
								        	 ?>
								        	<input required type="datetime-local" name="batas_waktu" id="batas_waktu<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= date('Y-m-d', $batas_waktu_timestamp) . 'T' . date('H:i', $batas_waktu_timestamp); ?>">
										    <?= form_error('batas_waktu', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								        <div class="row">
								        	<div class="col-lg-6">
								        		<div class="form-group">
										        	<label for="biaya_tambahan<?= $dt['kode_invoice']; ?>">Biaya Tambahan (Rp.)</label>
										        	<input style="cursor: not-allowed;" disabled type="text" name="biaya_tambahan" id="biaya_tambahan<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= number_format($dt['biaya_tambahan']); ?>">
												    <?= form_error('biaya_tambahan', '<small class="form-text text-danger">', '</small>'); ?>
										        </div>
								        	</div>
								        	<div class="col-lg-3">
								        		<div class="form-group">
										        	<label for="diskon<?= $dt['kode_invoice']; ?>">Diskon %</label>
										        	<input style="cursor: not-allowed;" disabled min="0" max="100" type="text" name="diskon" id="diskon<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= number_format($dt['diskon']); ?>">
												    <?= form_error('diskon', '<small class="form-text text-danger">', '</small>'); ?>
										        </div>
								        	</div>
								        	<div class="col-lg-3">
								        		<div class="form-group">
										        	<label for="pajak<?= $dt['kode_invoice']; ?>">Pajak %</label>
										        	<input style="cursor: not-allowed;" disabled min="0" max="100" type="text" name="pajak" id="pajak<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= number_format($dt['pajak']); ?>">
												    <?= form_error('pajak', '<small class="form-text text-danger">', '</small>'); ?>
										        </div>
								        	</div>
								        </div>
								        <div class="form-group">
								        	<label for="status_transaksi<?= $dt['kode_invoice']; ?>">Status Transaksi</label>
							        		<select name="status_transaksi" id="status_transaksi<?= $dt['kode_invoice']; ?>" class="form-control">
                                            	<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
	                                            	<?php if ($dt['status_transaksi'] == 'proses'): ?>
		                                              <option value="proses">Proses</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                        	  <option value="sudah diambil">Sudah diambil</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                              <option value="dicuci">Dicuci</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                            <?php endif ?>
	                                            <?php else: ?>
	                                            	<?php if ($dt['status_transaksi'] == 'proses'): ?>
		                                              <option value="proses">Proses</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="proses">Proses</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="proses">Proses</option>
		                                              <option value="dicuci">Dicuci</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="proses">Proses</option>
		                                            <?php endif ?>
	                                            <?php endif ?>
	                                        </select>
								        </div>
								        <div class="form-group">
								        	<label for="status_bayar<?= $dt['kode_invoice']; ?>">Status Bayar</label>
								        	<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
	                                            <input class="form-control" value="Sudah Bayar" disabled style="cursor: not-allowed;">
												<input type="hidden" name="status_bayar" value="<?= $dt['status_bayar']; ?>">
								        	<?php else: ?>
									        	<select name="status_bayar" id="status_bayar<?= $dt['kode_invoice']; ?>" class="form-control">
									        		<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
									        			<option value="belum dibayar">Belum dibayar</option>
										        		<option value="sudah dibayar">Sudah dibayar</option>
									        		<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
										        		<option value="sudah dibayar">Sudah dibayar</option>
									        			<option value="belum dibayar">Belum dibayar</option>
									        		<?php else: ?>
									        			<option value="belum dibayar">Belum dibayar</option>
										        		<option value="sudah dibayar">Sudah dibayar</option>
									        		<?php endif ?>
									        	</select>
								        	<?php endif ?>
								        </div>
								        <div class="form-group">
								        	<label for="id_member">Member</label>
								        	<?php if ($dt['status_transaksi'] !== 'proses' || $dt['status_bayar'] == 'sudah dibayar'): ?>
								        		<input type="hidden" name="id_member" value="<?= $dt['id_member']; ?>">
								        		<input style="cursor: not-allowed;" class="form-control" type="text" disabled value="<?= $dt['nama_member']; ?>">
								        	<?php else: ?>
								        		<select name="id_member" id="id_member" class="form-control">
									        		<option value="<?= $dt['id_member']; ?>"><?= $dt['nama_member']; ?></option>
									        		<?php foreach ($member as $dm): ?>
									        			<?php if ($dt['id_member'] !== $dm['id_member']): ?>
											        		<option value="<?= $dm['id_member']; ?>"><?= $dm['nama_member']; ?></option>
									        			<?php endif ?>
									        		<?php endforeach ?>
									        	</select>
								        	<?php endif ?>
								        </div>
								        <div class="form-group">
								        	<label for="id_outlet<?= $dt['id_transaksi']; ?>">Nama Outlet</label>
							        		<input type="hidden" name="id_outlet" value="<?= $dt['id_outlet']; ?>">
							        		<input style="cursor: not-allowed;" disabled type="text" value="<?= $dataUser['nama_outlet']; ?>" class="form-control">
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
								        <button type="submit" name="btnUbahTransaksi" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
								      </div>
								    </div>
							    </form>
							  </div>
							</div>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- garis pembatas -->
<hr class="my-4">

<div class="row">
	<div class="col-lg bg-white shadow p-3 rounded mx-2 my-2">
		<?php if (isset($_POST['cari_tanggal'])): ?>
			<h4><i class="fas fa-fw fa-users"></i> Daftar Member Sering Mencuci <?= $tanggal_awal_heading; ?> s/d <?= $tanggal_akhir_heading; ?></h5>
		<?php else: ?>
			<h4><i class="fas fa-fw fa-users"></i> Daftar Member Sering Mencuci</h4>
		<?php endif ?>
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr class="text-center">
						<th>No</th>
						<th>Nama Member</th>
						<th>Jumlah Cuci</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($member_sering_mencuci as $msm): ?>
						<tr class="text-center">
							<td><?= $i++; ?></td>
							<td><?= $msm['nama_member']; ?></td>
							<td><?= $msm['jumlah_cuci']; ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-lg bg-white shadow p-3 rounded mx-2 my-2">
		<h4><i class="fas fa-fw fa-handshake"></i> Jumlah Transaksi dalam 7 hari</h5>
	    <canvas class="my-5" id="myChart"></canvas>
	</div>
</div>
