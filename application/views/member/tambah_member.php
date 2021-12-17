<div class="container">
	<div class="row">
		<div class="col-lg">
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
	<div class="row">
		<div class="col-lg-5">
			<form action="<?= base_url('member/createMember'); ?>" method="post">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahMemberModalLabel"><i class="fas fa-fw fa-users"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Member</h5>
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
			        		<div class="col-sm-4">
					        	<input type="radio" name="jenis_kelamin" value="pria" id="pria"> <label for="pria">Pria</label>
			        		</div>
			        		<div class="col-sm-4">
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
			        <button type="submit" name="btnTambahMember" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
			      </div>
			    </div>
		    </form>
		</div>

		<div class="col-lg-7">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table_id">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Member</th>
							<th>Telepon Member</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($member as $dm): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $dm['nama_member']; ?></td>
								<td><?= $dm['telepon_member']; ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>