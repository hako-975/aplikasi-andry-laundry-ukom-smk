<div class="row my-2">
	<div class="col-lg my-auto header-judul">
		<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
			<h4><i class="fas fa-fw fa-user"></i> Daftar Pengguna</h4>
		<?php elseif ($this->session->userdata('id_jabatan') == '2'): ?>
			<h4><i class="fas fa-fw fa-user"></i> Daftar Pengguna - <?= $dataUser['nama_outlet']; ?></h4>
		<?php else: ?>
			<h4><i class="fas fa-fw fa-user"></i> Daftar Pengguna - <?= $dataUser['nama_outlet']; ?></h4>
		<?php endif ?>
	</div>
	<div class="col-lg my-auto header-kanan">
		<!-- Jika super administrator atau administrator -->
		<?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
			<a href="" data-toggle="modal" data-target="#tambahUserModal" class="btn btn-primary"><i class="fas fa-fw fa-user-plus"></i> Tambah Pengguna</a>
		<?php endif ?>
		<!-- Modal Tambah User -->
		<div class="text-left modal fade" id="tambahUserModal" tabindex="-1" role="dialog" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <form action="<?= base_url('user/createUser'); ?>" method="post">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahUserModalLabel"><i class="fas fa-fw fa-user-plus"></i> Tambah Pengguna</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="form-group">
			        	<label for="username">Nama Pengguna</label>
			        	<input required type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>">
					    <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="password">Kata Sandi</label>
			        	<input required type="password" name="password" id="password" class="form-control" value="<?= set_value('password'); ?>">
					    <?= form_error('password', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="password_verify">Verifikasi Kata Sandi</label>
			        	<input required type="password" name="password_verify" id="password_verify" class="form-control" value="<?= set_value('password_verify'); ?>">
					    <?= form_error('password_verify', '<small class="form-text text-danger">', '</small>'); ?>
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
				        <div class="form-group">
				        	<label for="id_jabatan">Nama Jabatan</label>
				        	<select name="id_jabatan" id="id_jabatan" class="form-control">
				        		<option value="0">------ Pilih Jabatan ------</option>
				        		<?php foreach ($jabatan as $dj): ?>
					        		<?php if ($dj['id_jabatan'] !== '1'): ?>
					        			<option value="<?= $dj['id_jabatan']; ?>"><?= ucwords($dj['nama_jabatan']); ?></option>
					        		<?php endif ?>
				        		<?php endforeach ?>
				        	</select>
						    <?= form_error('id_jabatan', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				    <?php else: ?>
			        	<div class="form-group">
				        	<label for="id_outlet">Nama Outlet</label>
			        		<input type="hidden" name="id_outlet" value="<?= $this->session->userdata('id_outlet'); ?>">
			        		<input style="cursor: not-allowed;" disabled type="text" value="<?= $dataUser['nama_outlet']; ?>" class="form-control">
				        </div>
			        	<div class="form-group">
				        	<label for="id_jabatan">Nama Jabatan</label>
				        	<select name="id_jabatan" id="id_jabatan" class="form-control">
				        		<option value="0">------ Pilih Jabatan ------</option>
				        		<?php foreach ($jabatan as $dj): ?>
							        <!-- jika jabatan super administrator tidak bisa dipilih -->
					        		<?php if ($dj['id_jabatan'] !== '1'): ?>
					        			<!-- jika yg login administrator -->
					        			<?php if ($dataUser['id_jabatan'] == '2'): ?>
							        		<?php if ($dj['id_jabatan'] !== '1' AND $dj['id_jabatan'] !== '2'): ?>
						        				<option value="<?= $dj['id_jabatan']; ?>"><?= ucwords($dj['nama_jabatan']); ?></option>
						        			<?php endif ?>
					        			<?php endif ?>
					        		<?php endif ?>
				        		<?php endforeach ?>
				        	</select>
						    <?= form_error('id_jabatan', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				    <?php endif ?>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
			        <button type="submit" name="btnTambahUser" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
						<th>Nama Pengguna</th>
						<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
							<th>Nama Outlet</th>
						<?php endif ?>
						<th>Nama Jabatan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($user as $du): ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $du['username']; ?></td>
							<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
								<td><?= $du['nama_outlet']; ?></td>
							<?php endif ?>
							<td><?= $du['nama_jabatan']; ?></td>
							<td class="text-center">
								<a href="<?= base_url('user/profile/') . $du['id_user']; ?>" class="badge badge-info"><i class="fas fa-fw fa-align-justify"></i> Detail</a>
								<!-- Jika bukan akun super administrator -->
								<?php if ($du['id_jabatan'] !== '1'): ?>
									<!-- jika yg login jabatan super administrator atau administrator -->
									<?php if ($dataUser['id_jabatan'] == '1' OR $dataUser['id_jabatan'] == '2'): ?>
										<!-- Jika jabatan administrator dengan administrator tidak bisa saling memanipulasi -->
										<?php if ($du['id_jabatan'] !== '2' OR $dataUser['id_jabatan'] == '1'): ?>
											<a href="" data-toggle="modal" data-target="#ubahUserModal<?= $du['id_user']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
											<a href="<?= base_url('user/deleteUser/') . $du['id_user']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $du['username']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
										<?php endif ?>
									<?php endif ?>
								<?php endif ?>
							</td>
						</tr>
						<!-- Modal Ubah pengguna -->
						<div class="text-left modal fade" id="ubahUserModal<?= $du['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahUserModalLabel<?= $du['id_user']; ?>" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <form action="<?= base_url('user/updateUser/') . $du['id_user']; ?>" method="post">
						    	<div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="ubahUserModalLabel<?= $du['id_user']; ?>"><i class="fas fa-fw fa-user-edit"></i> Ubah pengguna - <?= $du['username']; ?></h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <div class="form-group">
							        	<label for="username<?= $du['id_user']; ?>">Nama Pengguna</label>
							        	<input style="cursor: not-allowed;" disabled type="text" name="username" id="username<?= $du['id_user']; ?>" class="form-control" value="<?= $du['username']; ?>">
									    <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
							        </div>
							        <?php if ($this->session->userdata('id_jabatan') == '1'): ?>
							        	<div class="form-group">
								        	<label for="id_outlet<?= $du['id_user']; ?>">Nama Outlet</label>
								        	<select name="id_outlet" id="id_outlet<?= $du['id_user']; ?>" class="form-control">
								        		<option value="<?= $du['id_outlet']; ?>"><?= $du['nama_outlet']; ?></option>
								        		<?php foreach ($outlet as $do): ?>
								        			<?php if ($du['id_outlet'] !== $do['id_outlet']): ?>
										        		<option value="<?= $do['id_outlet']; ?>"><?= $do['nama_outlet']; ?></option>
								        			<?php endif ?>
								        		<?php endforeach ?>
								        	</select>
										    <?= form_error('id_outlet', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								        <div class="form-group">
								        	<label for="id_jabatan<?= $du['id_user']; ?>">Nama Jabatan</label>
								        	<select name="id_jabatan" id="id_jabatan<?= $du['id_user']; ?>" class="form-control">
								        		<option value="<?= $du['id_jabatan']; ?>"><?= $du['nama_jabatan']; ?></option>
								        		<?php foreach ($jabatan as $dj): ?>
									        		<?php if ($dj['id_jabatan'] !== '1'): ?>
									        			<?php if ($du['id_jabatan'] !== $dj['id_jabatan']): ?>
										        			<option value="<?= $dj['id_jabatan']; ?>"><?= $dj['nama_jabatan']; ?></option>
									        			<?php endif ?>
									        		<?php endif ?>
								        		<?php endforeach ?>
								        	</select>
										    <?= form_error('id_jabatan', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								    <?php else: ?>
								        <div class="form-group">
								        	<label for="id_outlet">Nama Outlet</label>
							        		<input type="hidden" name="id_outlet" value="<?= $this->session->userdata('id_outlet'); ?>">
							        		<input style="cursor: not-allowed;" disabled type="text" value="<?= $dataUser['nama_outlet']; ?>" class="form-control">
								        </div>
								        <div class="form-group">
							        	<label for="id_jabatan<?= $du['id_user']; ?>">Nama Jabatan</label>
							        	<select name="id_jabatan" id="id_jabatan<?= $du['id_user']; ?>" class="form-control">
							        		<option value="<?= $du['id_jabatan']; ?>"><?= $du['nama_jabatan']; ?></option>
							        		<?php foreach ($jabatan as $dj): ?>
							        			<!-- jika jabatan super administrator tidak bisa dipilih -->
								        		<?php if ($dj['id_jabatan'] !== '1'): ?>
								        			<!-- jika yg login administrator -->
								        			<?php if ($dataUser['id_jabatan'] == '2'): ?>
										        		<?php if ($dj['id_jabatan'] !== '1' AND $dj['id_jabatan'] !== '2'): ?>
									        				<?php if ($dj['id_jabatan'] !== $du['id_jabatan']): ?>
									        					<option value="<?= $dj['id_jabatan']; ?>"><?= ucwords($dj['nama_jabatan']); ?></option>
									        				<?php endif ?>
									        			<?php endif ?>
								        			<?php endif ?>
								        		<?php endif ?>
							        		<?php endforeach ?>
							        	</select>
									    <?= form_error('id_jabatan', '<small class="form-text text-danger">', '</small>'); ?>
							        </div>
							        <?php endif ?>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
							        <button type="submit" name="btnUbahUser" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
