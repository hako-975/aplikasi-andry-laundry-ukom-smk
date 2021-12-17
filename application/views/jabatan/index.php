<div class="container">
	<div class="row my-2">
		<div class="col-lg my-auto header-judul">
			<h4><i class="fas fa-fw fa-user"></i> <sup><i class="fas fa-1x fa-chart-line"></i></sup> Daftar Jabatan</h4>
		</div>
		<div class="col-lg my-auto header-kanan">
			<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
				<a href="" data-toggle="modal" data-target="#tambahJabatanModal" class="btn btn-primary"><i class="fas fa-fw fa-user"></i> <sup><i class="fas fa-1x fa-chart-line"></i></sup> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Jabatan</a>
			<?php endif ?>
			<!-- Modal Tambah Jabatan -->
			<div class="text-left modal fade" id="tambahJabatanModal" tabindex="-1" role="dialog" aria-labelledby="tambahJabatanModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <form action="<?= base_url('jabatan/createJabatan'); ?>" method="post">
			    	<div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="tambahJabatanModalLabel"><i class="fas fa-fw fa-user"></i> <sup><i class="fas fa-1x fa-chart-line"></i></sup> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Jabatan</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <div class="form-group">
				        	<label for="nama_jabatan">Nama Jabatan</label>
				        	<input required type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" value="<?= set_value('nama_jabatan'); ?>">
						    <?= form_error('nama_jabatan', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
				        <button type="submit" name="btnTambahJabatan" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
							<th>Nama Jabatan</th>
							<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
								<th>Aksi</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($jabatan as $dj): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $dj['nama_jabatan']; ?></td>
								<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
									<td>
										<?php if ($dj['id_jabatan'] !== '1'): ?>
											<a href="" data-toggle="modal" data-target="#ubahJabatanModal<?= $dj['id_jabatan']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
											<a href="<?= base_url('jabatan/deleteJabatan/') . $dj['id_jabatan']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $dj['nama_jabatan']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
										<?php endif ?>
									</td>
								<?php endif ?>
							</tr>
							<!-- Modal Ubah Jabatan -->
							<div class="text-left modal fade" id="ubahJabatanModal<?= $dj['id_jabatan']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahJabatanModalLabel<?= $dj['id_jabatan']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('jabatan/updatejabatan/') . $dj['id_jabatan']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahjabatanModalLabel<?= $dj['id_jabatan']; ?>"><i class="fas fa-fw fa-user"></i> <sup><i class="fas fa-1x fa-chart-line"></i></sup> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah jabatan - <?= $dj['nama_jabatan']; ?></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="form-group">
								        	<label for="nama_jabatan<?= $dj['id_jabatan']; ?>">Nama jabatan</label>
								        	<input required type="text" name="nama_jabatan" id="nama_jabatan<?= $dj['id_jabatan']; ?>" class="form-control" value="<?= $dj['nama_jabatan']; ?>">
										    <?= form_error('nama_jabatan', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
								        <button type="submit" name="btnUbahJabatan" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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