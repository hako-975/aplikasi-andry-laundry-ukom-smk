<div class="container-fluid mx-0 px-0">
	<div class="row my-2">
		<div class="col-lg header-judul">
			<h2 class="text-break">Profile - <?= $_SESSION['username']; ?></h2>
			<?php if (validation_errors()): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Gagal!</strong> <?= validation_errors(); ?>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<?php endif ?>
		</div>
		<div class="col-lg header-kanan">
			<a target="_blank" href="<?= base_url('prints/profile/') . $_SESSION['id_user']; ?>" class="btn btn-success"><i class="fas fa-fw fa-print"></i></a>
			<a href="" data-toggle="modal" data-target="#editBiodataModal" class="btn btn-warning text-white"><i class="fas fa-fw fa-user-edit"></i></a>
			<a href="" data-toggle="modal" data-target="#changePassword" class="btn btn-danger"><i class="fas fa-fw fa-lock"></i> <sup><i class="fas fa-fw fa-edit"></i></sup></a>
		</div>
	</div>
	<div class="row justify-content-center my-4">
		<div class="col-10">
			<div class="card bg-info p-4 rounded text-white mb-3">
			  <div class="row qr-code">
			  	<div class="col">
			  		<a href="<?= base_url('assets/img/img_properties/qr-code.png'); ?>" class="enlarge">
				  		<img width="100" src="<?= base_url('assets/img/img_properties/qr-code.png'); ?>" alt="qr-code">
			  		</a>
			  	</div>
			  </div>
			  <div class="row no-gutters">
			    <div class="col-lg-2 mt-4">
			    	<a href="<?= base_url('assets/img/img_profiles/') . $dataUser['foto']; ?>" class="enlarge">
				      <img width="150" src="<?= base_url('assets/img/img_profiles/') . $dataUser['foto']; ?>" class="card-img" alt="<?= $dataUser['foto']; ?>">
			    	</a>
			    	<h6 class="font-weight-bold mt-2 pt-2 mb-1 pb-0">Username : </h6>
			    	<h6 class="font-weight-bold mb-2 pb-2 mt-1 pt-0"><?= $dataUser['username']; ?></h6>
			    </div>
			    <div class="col-lg-9">
			      <div class="card-body my-auto">
		      		<div class="row">
		      			<div class="col-md-4">Nama Lengkap</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= ucwords(strtolower($dataUser['nama_lengkap'])); ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Tempat Lahir</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= $dataUser['tempat_lahir']; ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Tanggal Lahir</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= $dataUser['tanggal_lahir']; ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Jenis Kelamin</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= ucwords($dataUser['jenis_kelamin']); ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Golongan Darah</div>
		      			<div class="col-xs-1"> : </div>
		      			<?php if ($dataUser['golongan_darah'] == ""): ?>
		      				<div class="col">-</div>
		      			<?php else: ?>
		      				<div class="col text-break"><?= strtoupper($dataUser['golongan_darah']); ?></div>
		      			<?php endif ?>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">No. Telepon</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= $dataUser['telepon']; ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Email</div>
		      			<div class="col-xs-1"> : </div>
		      			<?php if ($dataUser['email'] == ""): ?>
		      				<div class="col-1">-</div>
		      			<?php else: ?>
			      			<div class="col text-break"><?= $dataUser['email']; ?></div>
			      		<?php endif ?>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Alamat</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= $dataUser['alamat']; ?></div>
		       		</div>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editBiodataModal" tabindex="-1" role="dialog" aria-labelledby="editBiodataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="<?= base_url('main/updateBiodata'); ?>" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="id_user" value="<?= $dataUser['id_user']; ?>">
    	<div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editBiodataModalLabel">Ubah Biodata - <?= $dataUser['username']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	      		<div class="col-lg">
	      			<div class="text-center">
						<a href="<?= base_url('assets/img/img_profiles/') . $dataUser['foto']; ?>" id="check_enlarge_photo" class="enlarge">
							<img style="width: 75%" src="<?= base_url('assets/img/img_profiles/') . $dataUser['foto']; ?>" id="check_photo" class="img-thumbnail rounded img_fluid" alt="Photo">
						</a>
					</div>
					<div><small>Click image to zoom</small></div>
					<div class="custom-file my-3 mb-5">
						<input type="file" class="custom-file-input" id="photo" name="foto">
						<label for="photo" class="custom-file-label">Pilih Foto</label>
					</div>
	      		</div>
	      		<div class="col-lg">
	      			<div class="form-group">
			        	<label for="nama_lengkap">Nama Lengkap</label>
			        	<input required type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= $dataUser['nama_lengkap']; ?>">
					    <?= form_error('nama_lengkap', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="tempat_lahir">Tempat Lahir</label>
			        	<input required type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $dataUser['tempat_lahir']; ?>">
					    <?= form_error('tempat_lahir', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="tanggal_lahir">Tanggal Lahir</label>
			        	<input required type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $dataUser['tanggal_lahir']; ?>">
					    <?= form_error('tanggal_lahir', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<div class="row">
			        		<div class="col-sm">
			        			<label for="jenis_kelamin">Jenis Kelamin</label>
			        		</div>
			        	</div>
			        	<div class="row">
			        		<?php if ($dataUser['jenis_kelamin'] == 'pria'): ?>
			        			<div class="col-sm-4">
						        	<input type="radio" checked name="jenis_kelamin" value="pria" id="pria"> <label for="pria">Pria</label>
				        		</div>
				        		<div class="col-sm-4">
						        	<input type="radio" name="jenis_kelamin" value="wanita" id="wanita"> <label for="wanita">Wanita</label>
				        		</div>
			        		<?php elseif ($dataUser['jenis_kelamin'] == 'wanita'): ?>
			        			<div class="col-sm-4">
						        	<input type="radio" name="jenis_kelamin" value="pria" id="pria"> <label for="pria">Pria</label>
				        		</div>
				        		<div class="col-sm-4">
						        	<input type="radio" checked name="jenis_kelamin" value="wanita" id="wanita"> <label for="wanita">Wanita</label>
				        		</div>
				        	<?php else: ?>
								<div class="col-sm-4">
						        	<input type="radio" name="jenis_kelamin" value="pria" id="pria"> <label for="pria">Pria</label>
				        		</div>
				        		<div class="col-sm-4">
						        	<input type="radio" name="jenis_kelamin" value="wanita" id="wanita"> <label for="wanita">Wanita</label>
				        		</div>
			        		<?php endif ?>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label for="golongan_darah">Golongan Darah</label>
			        	<select name="golongan_darah" id="golongan_darah" class="form-control">
			        		<option value="<?= $dataUser['golongan_darah']; ?>"><?= strtoupper($dataUser['golongan_darah']); ?></option>
			        		<option value="o">O</option>
			        		<option value="a">A</option>
			        		<option value="b">B</option>
			        		<option value="ab">AB</option>
			        		<option value="0">-</option>
			        	</select>
			        </div>
			        <div class="form-group">
			        	<label for="telepon">Telepon</label>
			        	<input required type="number" name="telepon" id="telepon" class="form-control"  value="<?= $dataUser['telepon']; ?>">
					    <?= form_error('telepon', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="email">Email</label>
			        	<input type="email" name="email" id="email" class="form-control"  value="<?= $dataUser['email']; ?>" placeholder="(Opsional)">
					    <?= form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="alamat">Alamat</label>
			        	<textarea required name="alamat" id="alamat" class="form-control"><?= $dataUser['alamat']; ?></textarea>
					    <?= form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
	        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
	      </div>
	    </div>
    </form>
  </div>
</div>


<!-- Change Password Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= base_url('main/changePassword'); ?>" method="post">
    	<div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="changePasswordLabel">Ganti Password - <?= $dataUser['username']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<div class="form-group">
				<label for="password_old"><i class="fas fa-fw fa-lock"></i> Password Lama</label>
				<input required type="password" name="password_old" id="password_old" class="form-control">
				<?= form_error('password_old', '<small class="form-text text-danger">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="password_new"><i class="fas fa-fw fa-lock"></i> Password Baru</label>
				<input required type="password" name="password_new" id="password_new" class="form-control">
				<?= form_error('password_new', '<small class="form-text text-danger">', '</small>'); ?>
			</div>
			<div class="form-group">
				<label for="password_verify"><i class="fas fa-fw fa-lock"></i> Password Verifikasi</label>
				<input required type="password" name="password_verify" id="password_verify" class="form-control">
				<?= form_error('password_verify', '<small class="form-text text-danger">', '</small>'); ?>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
	        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
	      </div>
	    </div>
    </form>
  </div>
</div>