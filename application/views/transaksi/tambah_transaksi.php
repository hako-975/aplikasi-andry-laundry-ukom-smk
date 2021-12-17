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
		<div class="col-lg">
			<form action="<?= base_url('transaksi/createTransaksi'); ?>" method="post">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahTransaksiModalLabel"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Transaksi</h5>
			      </div>
			      <div class="modal-body">
			        <div class="form-group">
			        	<label for="batas_waktu">Batas Waktu</label>
			        	<input required type="datetime-local" name="batas_waktu" id="batas_waktu" class="form-control" value="<?= date('Y-m-d') . 'T' . date('H:i'); ?>">
					    <?= form_error('batas_waktu', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="row">
			        	<div class="col-lg">
			        		<div class="form-group">
					        	<label for="biaya_tambahan">Biaya Tambahan (Rp.)</label>
					        	<input type="number" name="biaya_tambahan" id="biaya_tambahan" class="form-control" value="<?= set_value('biaya_tambahan'); ?>">
							    <?= form_error('biaya_tambahan', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
			        	</div>
			        	<div class="col-lg">
			        		<div class="form-group">
					        	<label for="diskon">Diskon %</label>
					        	<input type="number" name="diskon" id="diskon" class="form-control" value="<?= set_value('diskon'); ?>" placeholder="contoh: jika 10% maka ditulis 10">
							    <?= form_error('diskon', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
			        	</div>
			        	<div class="col-lg">
			        		<div class="form-group">
					        	<label for="pajak">Pajak %</label>
					        	<input type="number" name="pajak" id="pajak" class="form-control" value="10" placeholder="contoh: jika 10% maka ditulis 10">
							    <?= form_error('pajak', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
			        	</div>
			        </div>
			        <div class="form-group">
			        	<label for="status_bayar">Status Bayar</label>
			        	<select name="status_bayar" id="status_bayar" class="form-control">
			        		<option value="belum dibayar">Belum dibayar</option>
			        		<option value="sudah dibayar">Sudah dibayar</option>
			        	</select>
			        </div>
			        <div class="form-group">
			        	<label for="id_member">Member</label>
			        	<select name="id_member" id="id_member" class="form-control js-member-basic-single">
			        		<option value="0">------ Pilih Member ------</option>
			        		<?php foreach ($member as $dm): ?>
				        		<option value="<?= $dm['id_member']; ?>"><?= $dm['nama_member']; ?></option>
			        		<?php endforeach ?>
			        	</select>
			        	<small class="text-info"><a href="<?= base_url('member/tambahMember'); ?>">Tidak ada nama Member? klik disini!</a></small>
					    <?= form_error('id_member', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="id_outlet">Nama Outlet</label>
		        		<input type="hidden" name="id_outlet" value="<?= $this->session->userdata('id_outlet'); ?>">
		        		<input style="cursor: not-allowed;" disabled type="text" value="<?= $dataUser['nama_outlet']; ?>" class="form-control">
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="submit" name="btnTambahTransaksi" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
			      </div>
			    </div>
		    </form>
		</div>
	</div>
</div>
