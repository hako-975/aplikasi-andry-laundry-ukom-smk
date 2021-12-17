<div class="container">
	<div class="row my-2">
		<div class="col-lg my-auto header-judul">
			<h4><i class="fas fa-fw fa-boxes"></i> Daftar Jenis Paket</h4>
		</div>
		<div class="col-lg my-auto header-kanan">
			<!-- Jika super administrator atau administrator -->
			<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
				<a href="" data-toggle="modal" data-target="#tambahJenisPaketModal" class="btn btn-primary"><i class="fas fa-fw fa-boxes"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Jenis Paket</a>
			<?php endif ?>
			<!-- Modal Tambah JenisPaket -->
			<div class="text-left modal fade" id="tambahJenisPaketModal" tabindex="-1" role="dialog" aria-labelledby="tambahJenisPaketModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <form action="<?= base_url('jenisPaket/createJenisPaket'); ?>" method="post">
			    	<div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="tambahJenisPaketModalLabel"><i class="fas fa-fw fa-boxes"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Jenis Paket</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<label for="nama_jenis_paket">Nama Jenis Paket</label>
				        	<input required type="text" name="nama_jenis_paket" id="nama_jenis_paket" class="form-control" value="<?= set_value('nama_jenis_paket'); ?>">
						    <?= form_error('nama_jenis_paket', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
				        <button type="submit" name="btnTambahJenisPaket" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
							<th>Nama Jenis Paket</th>
							<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
								<th>Aksi</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($jenis_paket as $djp): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $djp['nama_jenis_paket']; ?></td>
								<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
									<td>
										<a href="" data-toggle="modal" data-target="#ubahJenisPaketModal<?= $djp['id_jenis_paket']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
										<a href="<?= base_url('jenisPaket/deleteJenisPaket/') . $djp['id_jenis_paket']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $djp['nama_jenis_paket']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
									</td>
								<?php endif ?>
							</tr>
							<!-- Modal Ubah JenisPaket -->
							<div class="text-left modal fade" id="ubahJenisPaketModal<?= $djp['id_jenis_paket']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahJenisPaketModalLabel<?= $djp['id_jenis_paket']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('jenisPaket/updateJenisPaket/') . $djp['id_jenis_paket']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahJenisPaketModalLabel<?= $djp['id_jenis_paket']; ?>"><i class="fas fa-fw fa-boxes"></i> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah Jenis Paket - <?= $djp['nama_jenis_paket']; ?></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="form-group">
								        	<label for="nama_jenis_paket<?= $djp['id_jenis_paket']; ?>">Nama Jenis Paket</label>
								        	<input required type="text" name="nama_jenis_paket" id="nama_jenis_paket<?= $djp['id_jenis_paket']; ?>" class="form-control" value="<?= $djp['nama_jenis_paket']; ?>">
										    <?= form_error('nama_jenis_paket', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
								        <button type="submit" name="btnUbahJenisPaket" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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