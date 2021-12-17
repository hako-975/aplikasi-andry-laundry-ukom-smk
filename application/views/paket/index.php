<div class="container">
	<div class="row my-2">
		<div class="col-lg my-auto header-judul">
			<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
				<h4><i class="fas fa-fw fa-box"></i> Daftar Paket</h4>
			<?php elseif ($this->session->userdata('id_jabatan') == '2'): ?>
				<h4><i class="fas fa-fw fa-box"></i> Daftar Paket - <?= $dataUser['nama_outlet']; ?></h4>
			<?php else: ?>
				<h4><i class="fas fa-fw fa-box"></i> Daftar Paket - <?= $dataUser['nama_outlet']; ?></h4>
			<?php endif ?>
		</div>
		<div class="col-lg my-auto header-kanan">
			<!-- Jika super administrator atau administrator -->
			<?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
				<a href="" data-toggle="modal" data-target="#tambahPaketModal" class="btn btn-primary"><i class="fas fa-fw fa-box"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Paket</a>
			<?php endif ?>
			<!-- Modal Tambah Paket -->
			<div class="text-left modal fade" id="tambahPaketModal" tabindex="-1" role="dialog" aria-labelledby="tambahPaketModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <form action="<?= base_url('paket/createPaket'); ?>" method="post">
			    	<div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="tambahPaketModalLabel"><i class="fas fa-fw fa-box"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Paket</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<label for="nama_paket">Nama Paket</label>
				        	<input required type="text" name="nama_paket" id="nama_paket" class="form-control" value="<?= set_value('nama_paket'); ?>">
						    <?= form_error('nama_paket', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <div class="form-group">
				        	<label for="harga_paket">Harga Paket</label>
				        	<input required type="number" name="harga_paket" id="harga_paket" class="form-control" value="<?= set_value('harga_paket'); ?>">
						    <?= form_error('harga_paket', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <?php if ($this->session->userdata('id_jabatan') == '1'): ?>
					       	<div class="form-group">
					        	<label for="id_outlet">Nama Outlet</label>
					        	<select name="id_outlet" id="id_outlet" class="form-control">
					        		<option value="0">------ Pilih Outlet ------</option>
					        		<?php foreach ($outlet as $do): ?>
						        		<option value="<?= $do['id_outlet']; ?>"><?= $do['nama_outlet']; ?></option>
					        		<?php endforeach ?>
					        	</select>
							    <?= form_error('id_outlet', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
					    <?php else: ?>
					        <div class="form-group">
					        	<label for="id_outlet">Nama Outlet</label>
				        		<input type="hidden" name="id_outlet" value="<?= $this->session->userdata('id_outlet'); ?>">
				        		<input style="cursor: not-allowed;" disabled type="text" value="<?= $dataUser['nama_outlet']; ?>" class="form-control">
					        </div>
				       <?php endif ?>
				        <div class="form-group">
				        	<label for="id_jenis_paket">Jenis Paket</label>
				        	<select name="id_jenis_paket" id="id_jenis_paket" class="form-control">
				        		<option value="0">------ Pilih Jenis Paket ------</option>
				        		<?php foreach ($jenis_paket as $djp): ?>
					        		<option value="<?= $djp['id_jenis_paket']; ?>"><?= ucwords($djp['nama_jenis_paket']); ?></option>
				        		<?php endforeach ?>
				        	</select>
						    <?= form_error('id_jenis_paket', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
				        <button type="submit" name="btnTambahPaket" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
				      </div>
				    </div>
			    </form>
			  </div>
			</div>
		</div>
	</div>
	<div class="row my-2">
		<div class="col-lg-6">
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
	<div class="row my-2">
		<div class="col-lg">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table_id">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Paket</th>
							<th>Harga Paket (Rp.)</th>
							<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
								<th>Nama Outlet</th>
							<?php endif ?>
							<th>Jenis Paket</th>
							<!-- Jika super administrator atau administrator -->
							<?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
								<th>Aksi</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($paket as $dp): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $dp['nama_paket']; ?></td>
								<td><?= number_format($dp['harga_paket']); ?></td>
								<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
									<td><?= $dp['nama_outlet']; ?></td>
								<?php endif ?>
								<td><?= ucwords($dp['nama_jenis_paket']); ?></td>
								<!-- Jika super administrator atau administrator -->
								<?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
									<td>
										<a href="" data-toggle="modal" data-target="#ubahPaketModal<?= $dp['id_paket']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
										<a href="<?= base_url('paket/deletePaket/') . $dp['id_paket']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $dp['nama_paket']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
									</td>
								<?php endif ?>
							</tr>
							<!-- Modal Ubah Paket -->
							<div class="text-left modal fade" id="ubahPaketModal<?= $dp['id_paket']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahPaketModalLabel<?= $dp['id_paket']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('paket/updatePaket/') . $dp['id_paket']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahPaketModalLabel<?= $dp['id_paket']; ?>"><i class="fas fa-fw fa-box"></i> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah Paket - <?= $dp['nama_paket']; ?></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="form-group">
								        	<label for="nama_paket<?= $dp['id_paket']; ?>">Nama Paket</label>
								        	<input required type="text" name="nama_paket" id="nama_paket<?= $dp['id_paket']; ?>" class="form-control" value="<?= $dp['nama_paket']; ?>">
										    <?= form_error('nama_paket', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								        <div class="form-group">
								        	<label for="harga_paket<?= $dp['id_paket']; ?>">Harga Paket</label>
								        	<input required type="number" name="harga_paket" id="harga_paket<?= $dp['id_paket']; ?>" class="form-control" value="<?= $dp['harga_paket']; ?>">
										    <?= form_error('harga_paket', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								        <?php if ($this->session->userdata('id_jabatan') == '1'): ?>
									        <div class="form-group">
									        	<label for="id_outlet<?= $dp['id_paket']; ?>">Nama Outlet</label>
									        	<select name="id_outlet" id="id_outlet<?= $dp['id_paket']; ?>" class="form-control">
									        		<option value="<?= $dp['id_outlet']; ?>"><?= $dp['nama_outlet']; ?></option>
									        		<?php foreach ($outlet as $do): ?>
										        		<?php if ($dp['id_outlet'] !== $do['id_outlet']): ?>
										        			<option value="<?= $do['id_outlet']; ?>"><?= $do['nama_outlet']; ?></option>
										        		<?php endif ?>
									        		<?php endforeach ?>
									        	</select>
											    <?= form_error('id_outlet', '<small class="form-text text-danger">', '</small>'); ?>
									        </div>								        	
							        	<?php else: ?>
							        		<div class="form-group">
									        	<label for="id_outlet">Nama Outlet</label>
								        		<input type="hidden" name="id_outlet" value="<?= $this->session->userdata('id_outlet'); ?>">
								        		<input style="cursor: not-allowed;" disabled type="text" value="<?= $dataUser['nama_outlet']; ?>" class="form-control">
									        </div>
								        <?php endif ?>
								        <div class="form-group">
								        	<label for="id_jenis_paket">Jenis Paket</label>
								        	<select name="id_jenis_paket" id="id_jenis_paket" class="form-control">
								        		<option value="<?= $dp['id_jenis_paket']; ?>"><?= $dp['nama_jenis_paket']; ?></option>
								        		<?php foreach ($jenis_paket as $djp): ?>
									        		<?php if ($dp['id_jenis_paket'] !== $djp['id_jenis_paket']): ?>
										        		<option value="<?= $djp['id_jenis_paket']; ?>"><?= ucwords($djp['nama_jenis_paket']); ?></option>
									        		<?php endif ?>
								        		<?php endforeach ?>
								        	</select>
										    <?= form_error('id_jenis_paket', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
								        <button type="submit" name="btnUbahPaket" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
</div>