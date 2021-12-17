<div class="container">
	<div class="row my-2">
		<div class="col-lg my-auto header-judul">
			<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
				<h4><i class="fas fa-fw fa-store"></i> Daftar Outlet</h4>
			<?php elseif ($this->session->userdata('id_jabatan') == '2'): ?>
				<h4><i class="fas fa-fw fa-store"></i> Daftar Outlet - <?= $dataUser['nama_outlet']; ?></h4>
			<?php else: ?>
				<h4><i class="fas fa-fw fa-store"></i> Daftar Outlet - <?= $dataUser['nama_outlet']; ?></h4>
			<?php endif ?>
		</div>
		<div class="col-lg my-auto header-kanan">
			<!-- Jika super administrator -->
			<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
				<a href="" data-toggle="modal" data-target="#tambahOutletModal" class="btn btn-primary"><i class="fas fa-fw fa-store"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Outlet</a>
			<?php endif ?>

			<!-- Modal Tambah Outlet -->
			<div class="text-left modal fade" id="tambahOutletModal" tabindex="-1" role="dialog" aria-labelledby="tambahOutletModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <form action="<?= base_url('outlet/createOutlet'); ?>" method="post">
			    	<div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="tambahOutletModalLabel"><i class="fas fa-fw fa-store"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Outlet</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<label for="nama_outlet">Nama Outlet</label>
				        	<input required type="text" name="nama_outlet" id="nama_outlet" class="form-control" value="<?= set_value('nama_outlet'); ?>">
						    <?= form_error('nama_outlet', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <div class="form-group">
				        	<label for="telepon_outlet">Telepon Outlet</label>
				        	<input required type="number" name="telepon_outlet" id="telepon_outlet" class="form-control"  value="<?= set_value('telepon_outlet'); ?>">
						    <?= form_error('telepon_outlet', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <div class="form-group">
				        	<label for="alamat_outlet">Alamat Outlet</label>
				        	<textarea required name="alamat_outlet" id="alamat_outlet" class="form-control" value="<?= set_value('alamat_outlet'); ?>"></textarea>
						    <?= form_error('alamat_outlet', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
				        <button type="submit" name="btnTambahOutlet" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
							<th>Nama Outlet</th>
							<th>Telepon Outlet</th>
							<th>Alamat Outlet</th>
							<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
								<th>Aksi</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($outlet as $do): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $do['nama_outlet']; ?></td>
								<td><?= $do['telepon_outlet']; ?></td>
								<td><?= $do['alamat_outlet']; ?></td>
								<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
									<td>
										<a href="" data-toggle="modal" data-target="#ubahOutletModal<?= $do['id_outlet']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
										<a href="<?= base_url('outlet/deleteOutlet/') . $do['id_outlet']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $do['nama_outlet']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
									</td>
								<?php endif ?>
							</tr>
							<!-- Modal Ubah Outlet -->
							<div class="text-left modal fade" id="ubahOutletModal<?= $do['id_outlet']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahOutletModalLabel<?= $do['id_outlet']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('outlet/updateOutlet/') . $do['id_outlet']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahOutletModalLabel<?= $do['id_outlet']; ?>"><i class="fas fa-fw fa-store"></i> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah Outlet - <?= $do['nama_outlet']; ?></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="form-group">
								        	<label for="nama_outlet<?= $do['id_outlet']; ?>">Nama Outlet</label>
								        	<input required type="text" name="nama_outlet" id="nama_outlet<?= $do['id_outlet']; ?>" class="form-control" value="<?= $do['nama_outlet']; ?>">
								        	<?php $id_outlet = $do['id_outlet']; ?>
										    <?= form_error('nama_outlet', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								        <div class="form-group">
								        	<label for="telepon_outlet<?= $do['id_outlet']; ?>">Telepon Outlet</label>
								        	<input required type="number" name="telepon_outlet" id="telepon_outlet<?= $do['id_outlet']; ?>" class="form-control" value="<?= $do['telepon_outlet']; ?>">
										    <?= form_error('telepon_outlet', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								        <div class="form-group">
								        	<label for="alamat_outlet<?= $do['id_outlet']; ?>">Alamat Outlet</label>
								        	<textarea required name="alamat_outlet" id="alamat_outlet<?= $do['id_outlet']; ?>" class="form-control"><?= $do['alamat_outlet']; ?></textarea>
										    <?= form_error('alamat_outlet', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
								        <button type="submit" name="btnUbahOutlet" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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