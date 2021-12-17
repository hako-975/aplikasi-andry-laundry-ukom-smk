<?php 
	$this->db->join('member', 'transaksi.id_member = member.id_member');
	$transaksi = $this->db->get_where('transaksi', ['kode_invoice' => $this->session->userdata('kode_invoice')])->row_array();
	$id_transaksi = $transaksi['id_transaksi'];
 ?>
<div class="container">
	<div class="row">
		<div class="col-lg">
			<form action="<?= base_url('detailTransaksi/createDetailTransaksi'); ?>" method="post">

				<!-- mengambil status transaksi dari session -->
				<?php if ($this->session->userdata('status_bayar')): ?>
					<input type="hidden" name="status_bayar" value="<?= $this->session->userdata('status_bayar'); ?>">
				<?php endif ?>
				<!-- mengambil kode invoice dari session -->
				<input type="hidden" name="kode_invoice" value="<?= $this->session->userdata('kode_invoice'); ?>">
				<!-- mengambil id transaksi dari hasil fetch kode invoice -->
				<input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahDetailTransaksiModalLabel"><i class="fas fa-fw fa-align-justify"></i> <sup><i class="fas fa-1x fa-handshake"></i></sup> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Detail Transaksi</h5>
			      </div>
			      <div class="modal-body">
			        <div class="row">
			        	<div class="col-lg-6">
			        		<div class="form-group">
					        	<label>Kode Invoice Transaksi</label>
					        	<input style="cursor: not-allowed;" class="form-control" type="text" disabled value="<?= $this->session->userdata('kode_invoice'); ?>">
					        </div>
			        	</div>
			        	<div class="col-lg-6">
			        		<div class="form-group">
					        	<label>Nama Member</label>
					        	<input style="cursor: not-allowed;" class="form-control" type="text" disabled value="<?= $transaksi['nama_member']; ?>">
					        </div>
			        	</div>
			        </div>
			        <div class="form-group">
		        		<?php foreach ($paket as $dp): ?>
		        			<div class="row">
		        				<div class="col-lg-7">
		        					<div class="input-group mb-3">
									  <div class="input-group-prepend">
									  	<input type="hidden" name="id_paket[]" value="<?= $dp['id_paket']; ?>">
									    <span class="input-group-text" id="basic-addon1"><?= ucwords($dp['nama_jenis_paket']); ?> | <?= $dp['nama_paket']; ?> | Rp. <?= number_format($dp['harga_paket']); ?></span>
									  </div>
									  <input type="number" min="0" class="form-control" name="kuantitas[]" aria-describedby="basic-addon1" placeholder="Isi Kuantitas">
									</div>
								    <small class="my-1 text-info">Kosongkan bila paket tidak dipilih</small>
		        				</div>
		        				<div class="col-lg-5">
		        					<div class="form-group">
							        	<textarea name="keterangan[]" id="keterangan" class="form-control" placeholder="Keterangan <?= $dp['nama_paket']; ?>"><?= set_value('keterangan'); ?></textarea>
									    <?= form_error('keterangan', '<small class="form-text text-danger">', '</small>'); ?>
									</div>
		        				</div>
		        			</div>
		        		<?php endforeach ?>
			        </div>
			      </div>
			      <div class="modal-footer">
			      	
			      	<a href="<?= base_url('transaksi/deleteTransaksi/') . $id_transaksi; ?>" class="btn btn-danger btn-delete-dettrans" data-text="Apakah anda yakin ingin membatalkan Transaksi? Kode Invoice <?= $transaksi['kode_invoice']; ?>"><i class="fas fa-fw fa-times"></i> Batalkan Transaksi</a>
			        <button type="submit" name="btnTambahDetailTransaksi" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
			      </div>
			    </div>
		    </form>
		</div>
	</div>
</div>