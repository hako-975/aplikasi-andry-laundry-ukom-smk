<div class="container">
	<div class="row my-2">
		<div class="col-lg header-judul">
			<h2><i class="fas fa-fw fa-user"></i> Isi Biodata - <?= $userBiodata['username']; ?></h2>
		</div>
	</div>
	<div class="row my-2">
		<div class="col-lg">
			<form action="<?= base_url('user/createBiodata/') . $userBiodata['id_user']; ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_user" value="<?= $userBiodata['id_user']; ?>">
		      	<div class="row">
		      		<div class="col-lg">
		      			<div class="text-center">
							<a href="<?= base_url('assets/img/img_profiles/default.png'); ?>" id="check_enlarge_photo" class="enlarge">
								<img style="width: 75%" src="<?= base_url('assets/img/img_profiles/default.png'); ?>" id="check_photo" class="img-thumbnail rounded img_fluid" alt="Photo">
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
				        	<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= set_value('nama_lengkap'); ?>">
						    <?= form_error('nama_lengkap', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <div class="form-group">
				        	<label for="tempat_lahir">Tempat Lahir</label>
				        	<input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir'); ?>">
						    <?= form_error('tempat_lahir', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <div class="form-group">
				        	<label for="tanggal_lahir">Tanggal Lahir</label>
				        	<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir'); ?>">
						    <?= form_error('tanggal_lahir', '<small class="form-text text-danger">', '</small>'); ?>
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
				        	<label for="golongan_darah">Golongan Darah</label>
				        	<select name="golongan_darah" id="golongan_darah" class="form-control">
				        		<option value="0">--- Pilih Golongan Darah ---</option>
				        		<option value="o">O</option>
				        		<option value="a">A</option>
				        		<option value="b">B</option>
				        		<option value="ab">AB</option>
				        	</select>
				        </div>
				        <div class="form-group">
				        	<label for="telepon">Telepon</label>
				        	<input type="number" name="telepon" id="telepon" class="form-control"  value="<?= set_value('telepon'); ?>">
						    <?= form_error('telepon', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <div class="form-group">
				        	<label for="email">Email</label>
				        	<input type="email" name="email" id="email" class="form-control"  value="<?= set_value('email'); ?>" placeholder="(Opsional)">
						    <?= form_error('email', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
				        <div class="form-group">
				        	<label for="alamat">Alamat</label>
				        	<textarea name="alamat" id="alamat" class="form-control"><?= set_value('alamat'); ?></textarea>
						    <?= form_error('alamat', '<small class="form-text text-danger">', '</small>'); ?>
				        </div>
		      		</div>
		      	</div>			        
		        <button type="submit" name="btnTambahBiodata" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
		    </form>
		</div>
	</div>
</div>
