<div class="row my-2">
	<div class="col-lg my-auto header-judul">
		<h4><i class="fas fa-fw fa-users"></i> Daftar Member</h4>
	</div>
	<div class="col-lg my-auto header-kanan">
		<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
			<a href="" data-toggle="modal" data-target="#tambahMemberModal" class="btn btn-primary"><i class="fas fa-fw fa-users"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Member</a>
		<?php endif ?>
		<!-- Modal Tambah Member -->
		<div class="text-left modal fade" id="tambahMemberModal" tabindex="-1" role="dialog" aria-labelledby="tambahMemberModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <form action="<?= base_url('member/createMember'); ?>" method="post">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahMemberModalLabel"><i class="fas fa-fw fa-users"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Member</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="form-group">
			        	<label for="nama_member">Nama Member</label>
			        	<input required type="text" name="nama_member" id="nama_member" class="form-control" value="<?= set_value('nama_member'); ?>">
					    <?= form_error('nama_member', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<div class="row">
			        		<div class="col-sm">
			        			<label for="jenis_kelamin">Jenis Kelamin</label>
			        		</div>
			        	</div>
			        	<div class="row">
			        		<div class="col-sm-3">
					        	<input type="radio" name="jenis_kelamin" value="pria" id="pria"> <label for="pria">Pria</label>
			        		</div>
			        		<div class="col-sm-3">
					        	<input type="radio" name="jenis_kelamin" value="wanita" id="wanita"> <label for="wanita">Wanita</label>
			        		</div>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label for="telepon_member">Telepon Member</label>
			        	<input required type="number" name="telepon_member" id="telepon_member" class="form-control"  value="<?= set_value('telepon_member'); ?>">
					    <?= form_error('telepon_member', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="email_member">Email Member</label>
			        	<input type="email" name="email_member" id="email_member" class="form-control"  value="<?= set_value('email_member'); ?>" placeholder="(Opsional)">
					    <?= form_error('email_member', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="alamat_member">Alamat Member</label>
			        	<textarea required name="alamat_member" id="alamat_member" class="form-control" value="<?= set_value('alamat_member'); ?>"></textarea>
					    <?= form_error('alamat_member', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
			        <button type="submit" name="btnTambahMember" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
						<th>Nama Member</th>
						<th>Jenis Kelamin</th>
						<th>Telepon Member</th>
						<th>Email Member</th>
						<th>Alamat Member</th>
						<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
							<th>Aksi</th>
						<?php endif ?>							
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($member as $dm): ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $dm['nama_member']; ?></td>
							<td><?= $dm['jenis_kelamin']; ?></td>
							<td><?= $dm['telepon_member']; ?></td>
							<td><?= $dm['email_member']; ?></td>
							<td><?= $dm['alamat_member']; ?></td>
							<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
								<td>
									<a href="<?= base_url('member/riwayatTransaksi/') . $dm['id_member']; ?>" class="m-1 badge badge-warning text-white"><i class="fas fa-fw fa-history"></i> Riwayat</a>
									<a href="" data-toggle="modal" data-target="#ubahMemberModal<?= $dm['id_member']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
									<!-- Jika super administrator atau administrator -->
									<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
										<a href="<?= base_url('member/deleteMember/') . $dm['id_member']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $dm['nama_member']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
									<?php endif ?>
								</td>
							<?php endif ?>
						</tr>
						<!-- Modal Ubah Member -->
						<div class="text-left modal fade" id="ubahMemberModal<?= $dm['id_member']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahMemberModalLabel<?= $dm['id_member']; ?>" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <form action="<?= base_url('member/updateMember/') . $dm['id_member']; ?>" method="post">
						    	<div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="ubahMemberModalLabel<?= $dm['id_member']; ?>"><i class="fas fa-fw fa-users"></i> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah Member - <?= $dm['nama_member']; ?></h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <div class="form-group">
							        	<label for="nama_member<?= $dm['id_member']; ?>">Nama Member</label>
							        	<input required type="text" name="nama_member" id="nama_member<?= $dm['id_member']; ?>" class="form-control" value="<?= $dm['nama_member']; ?>">
							        	<?php $id_member = $dm['id_member']; ?>
									    <?= form_error('nama_member', '<small class="form-text text-danger">', '</small>'); ?>
							        </div>
							        <div class="form-group">
							        	<div class="row">
							        		<div class="col-sm">
							        			<label>Jenis Kelamin</label>
							        		</div>
							        	</div>
							        	<div class="row">
							        		<?php if ($dm['jenis_kelamin'] == 'pria'): ?>
							        			<div class="col-sm-3">
										        	<input type="radio" checked name="jenis_kelamin" value="pria" id="pria<?= $dm['id_member']; ?>"> <label for="pria<?= $dm['id_member']; ?>">Pria</label>
								        		</div>
								        		<div class="col-sm-3">
										        	<input type="radio" name="jenis_kelamin" value="wanita" id="wanita<?= $dm['id_member']; ?>"> <label for="wanita<?= $dm['id_member']; ?>">Wanita</label>
								        		</div>
							        		<?php elseif ($dm['jenis_kelamin'] == 'wanita'): ?>
							        			<div class="col-sm-3">
										        	<input type="radio" name="jenis_kelamin" value="pria" id="pria<?= $dm['id_member']; ?>"> <label for="pria<?= $dm['id_member']; ?>">Pria</label>
								        		</div>
								        		<div class="col-sm-3">
										        	<input type="radio" checked name="jenis_kelamin" value="wanita" id="wanita<?= $dm['id_member']; ?>"> <label for="wanita<?= $dm['id_member']; ?>">Wanita</label>
								        		</div>
								        	<?php else: ?>
								        		<div class="col-sm-3">
										        	<input type="radio" name="jenis_kelamin" value="pria" id="pria<?= $dm['id_member']; ?>"> <label for="pria<?= $dm['id_member']; ?>">Pria</label>
								        		</div>
								        		<div class="col-sm-3">
										        	<input type="radio" name="jenis_kelamin" value="wanita" id="wanita<?= $dm['id_member']; ?>"> <label for="wanita<?= $dm['id_member']; ?>">Wanita</label>
								        		</div>
							        		<?php endif ?>
							        	</div>
							        </div>
							        <div class="form-group">
							        	<label for="telepon_member<?= $dm['id_member']; ?>">Telepon Member</label>
							        	<input required type="number" name="telepon_member" id="telepon_member<?= $dm['id_member']; ?>" class="form-control" value="<?= $dm['telepon_member']; ?>">
									    <?= form_error('telepon_member', '<small class="form-text text-danger">', '</small>'); ?>
							        </div>
							        <div class="form-group">
							        	<label for="email_member<?= $dm['id_member']; ?>">Email Member</label>
							        	<input type="email" name="email_member" id="email_member<?= $dm['id_member']; ?>" class="form-control"  value="<?= $dm['email_member']; ?>">
									    <?= form_error('email_member', '<small class="form-text text-danger">', '</small>'); ?>
							        </div>
							        <div class="form-group">
							        	<label for="alamat_member<?= $dm['id_member']; ?>">Alamat Member</label>
							        	<textarea required name="alamat_member" id="alamat_member<?= $dm['id_member']; ?>" class="form-control"><?= $dm['alamat_member']; ?></textarea>
									    <?= form_error('alamat_member', '<small class="form-text text-danger">', '</small>'); ?>
							        </div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
							        <button type="submit" name="btnUbahMember" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
