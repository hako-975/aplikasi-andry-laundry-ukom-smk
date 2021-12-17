<div class="container">
	<div class="row my-2">
		<div class="col-lg header-judul">
			<h2 class="text-break">Profile - <?= $userProfile['username']; ?></h2>
		</div>
		<div class="col-lg header-kanan">
			<a href="<?= base_url('prints/profile/') . $userProfile['id_user']; ?>" target="_blank" class="btn btn-success"><i class="fas fa-fw fa-print"></i></a>
			<!-- Jika yang login super administrator atau administrator -->
			<?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
				<!-- Jika bukan akun super administrator atau yang login super administrator itu sendiri -->
				<?php if ($userProfile['id_jabatan'] !== '1' OR $this->session->userdata('id_user') == '1'): ?>
					<!-- bukan akun administrator  atau yang login super administrator -->
					<?php if ($userProfile['id_jabatan'] !== '2' OR $this->session->userdata('id_user') == '1'): ?>
						<a href="" data-toggle="modal" data-target="#editBiodataModal" class="btn btn-warning text-white"><i class="fas fa-fw fa-user-edit"></i></a>
					<!-- jika akun administrator yang login administrator itu sendiri -->
					<?php elseif ($userProfile['id_user'] == $this->session->userdata('id_user')): ?>
						<a href="" data-toggle="modal" data-target="#editBiodataModal" class="btn btn-warning text-white"><i class="fas fa-fw fa-user-edit"></i></a>
					<?php endif ?>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
	<div class="row justify-content-center my-2">
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
			    	<a href="<?= base_url('assets/img/img_profiles/') . $userProfile['foto']; ?>" class="enlarge">
				      <img width="150" src="<?= base_url('assets/img/img_profiles/') . $userProfile['foto']; ?>" class="card-img" alt="<?= $userProfile['foto']; ?>">
			    	</a>
			    	<h6 class="font-weight-bold mt-2 pt-2 mb-1 pb-0">Username : </h6>
			    	<h6 class="font-weight-bold mb-2 pb-2 mt-1 pt-0"><?= $userProfile['username']; ?></h6>
			    </div>
			    <div class="col-lg-9">
			      <div class="card-body my-auto">
		      		<div class="row">
		      			<div class="col-md-4">Nama Lengkap</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= ucwords(strtolower($userProfile['nama_lengkap'])); ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Tempat Lahir</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= $userProfile['tempat_lahir']; ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Tanggal Lahir</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= $userProfile['tanggal_lahir']; ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Jenis Kelamin</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= ucwords($userProfile['jenis_kelamin']); ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Golongan Darah</div>
		      			<div class="col-xs-1"> : </div>
		      			<?php if ($userProfile['golongan_darah'] == ""): ?>
		      				<div class="col">-</div>
		      			<?php else: ?>
		      				<div class="col text-break"><?= strtoupper($userProfile['golongan_darah']); ?></div>
		      			<?php endif ?>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">No. Telepon</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= $userProfile['telepon']; ?></div>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Email</div>
		      			<div class="col-xs-1"> : </div>
		      			<?php if ($userProfile['email'] == ""): ?>
		      				<div class="col-1">-</div>
		      			<?php else: ?>
			      			<div class="col text-break"><?= $userProfile['email']; ?></div>
			      		<?php endif ?>
		       		</div>
		       		<div class="row">
		      			<div class="col-md-4">Alamat</div>
		      			<div class="col-xs-1"> : </div>
		      			<div class="col text-break"><?= $userProfile['alamat']; ?></div>
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
    	<input type="hidden" name="id_user" value="<?= $userProfile['id_user']; ?>">
    	<div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editBiodataModalLabel">Ubah Biodata - <?= $userProfile['username']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	      		<div class="col-lg">
	      			<div class="text-center">
						<a href="<?= base_url('assets/img/img_profiles/') . $userProfile['foto']; ?>" id="check_enlarge_photo" class="enlarge">
							<img style="width: 75%" src="<?= base_url('assets/img/img_profiles/') . $userProfile['foto']; ?>" id="check_photo" class="img-thumbnail rounded img_fluid" alt="Photo">
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
			        	<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= $userProfile['nama_lengkap']; ?>">
					    <?= form_error('nama_lengkap', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="tempat_lahir">Tempat Lahir</label>
			        	<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $userProfile['tempat_lahir']; ?>">
					    <?= form_error('tempat_lahir', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="tanggal_lahir">Tanggal Lahir</label>
			        	<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $userProfile['tanggal_lahir']; ?>">
					    <?= form_error('tanggal_lahir', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<div class="row">
			        		<div class="col-sm">
			        			<label for="jenis_kelamin">Jenis Kelamin</label>
			        		</div>
			        	</div>
			        	<div class="row">
			        		<?php if ($userProfile['jenis_kelamin'] == 'pria'): ?>
			        			<div class="col-sm-4">
						        	<input type="radio" checked name="jenis_kelamin" value="pria" id="pria"> <label for="pria">Pria</label>
				        		</div>
				        		<div class="col-sm-4">
						        	<input type="radio" name="jenis_kelamin" value="wanita" id="wanita"> <label for="wanita">Wanita</label>
				        		</div>
			        		<?php elseif ($userProfile['jenis_kelamin'] == 'wanita'): ?>
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
			        		<option value="<?= $userProfile['golongan_darah']; ?>"><?= strtoupper($userProfile['golongan_darah']); ?></option>
			        		<option value="o">O</option>
			        		<option value="a">A</option>
			        		<option value="b">B</option>
			        		<option value="ab">AB</option>
			        		<option value="0">-</option>
			        	</select>
			        </div>
			        <div class="form-group">
			        	<label for="telepon">Telepon</label>
			        	<input type="number" name="telepon" id="telepon" class="form-control"  value="<?= $userProfile['telepon']; ?>">
					    <?= form_error('telepon', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="email">Email</label>
			        	<input type="email" name="email" id="email" class="form-control"  value="<?= $userProfile['email']; ?>" placeholder="(Opsional)">
					    <?= form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="alamat">Alamat</label>
			        	<textarea name="alamat" id="alamat" class="form-control"><?= $userProfile['alamat']; ?></textarea>
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