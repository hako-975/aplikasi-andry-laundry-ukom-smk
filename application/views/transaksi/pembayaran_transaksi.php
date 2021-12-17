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
	    	<div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title"><i class="fas fa-fw fa-dollar-sign"></i> Pembayaran Transaksi</h5>
		      </div>
		      <div class="modal-body">
        		<div class="row">
        			<div class="col-lg-6">
        				<div class="form-group">
		        			<label class="font-weight-bold" for="kode_invoice">Kode Invoice</label>
		        			<input style="cursor: not-allowed;" class="form-control" value="<?= $transaksi['kode_invoice']; ?>" disabled type="text">
		        		</div>
        			</div>
        			<div class="col-lg-6">
        				<div class="form-group">
		        			<label class="font-weight-bold" for="nama_member">Nama Member</label>
		        			<input style="cursor: not-allowed;" class="form-control" value="<?= $transaksi['nama_member']; ?>" disabled type="text">
		        		</div>
        			</div>
        		</div>
		        <div class="form-group">
		        	<label class="font-weight-bold">Paket</label>
		        	<table class="table table-bordered table-hover">
		        		<thead>
		        			<tr>
		        				<th>No</th>
		        				<th>Nama Paket</th>
		        				<th>Keterangan</th>
		        				<th>Harga Paket (Rp.)</th>
		        				<th>Kuantitas</th>
		        				<th>Sub Harga (Rp.)</th>
		        			</tr>
		        		</thead>
		        		<tbody>
		        			<?php $i = 1; ?>
		        			<?php foreach ($detail_transaksi as $dt): ?>
		        				<tr>
		        					<td><?= $i++; ?></td>
		        					<td><?= $dt['nama_paket']; ?></td>
		        					<td><?= $dt['keterangan']; ?></td>
		        					<td><?= number_format($dt['harga_paket']); ?></td>
		        					<td><?= number_format($dt['kuantitas']); ?></td>
		        					<td class="text-right"><?= number_format($dt['harga_paket'] * $dt['kuantitas']); ?></td>
		        				</tr>
		        			<?php endforeach ?>
		        			<tr>
		        				<td colspan="5">
		        					Biaya Tambahan (Rp.)
		        				</td>
		        				<td class="text-right">
		        					+ <?= number_format($dt['biaya_tambahan']); ?>
		        				</td>
		        			</tr>
		        			<tr>
		        				<td colspan="5">
		        					Diskon %
		        				</td>
		        				<td class="text-right">
		        					<?php $diskon = ($total_harga['total_harga'] + $dt['biaya_tambahan']) * $dt['diskon'] / 100; ?>
		        					<?= number_format($dt['diskon']); ?> (- <?= number_format($diskon); ?>)
		        				</td>
		        			</tr>
		        			<tr>
		        				<td colspan="5">
		        					Pajak %
		        				</td>
		        				<td class="text-right">
		        					<?php $pajak = ($total_harga['total_harga'] + $dt['biaya_tambahan'] - $diskon) * $dt['pajak'] / 100; ?>
		        					<?= number_format($dt['pajak']); ?> (+ <?= number_format($pajak); ?>)
		        				</td>
		        			</tr>
		        			<tr>
		        				<th colspan="5">
		        					Total Harga dibulatkan (Rp.)
		        				</th>
		        				<td class="text-right">
		        					<?php 
		        						$total_harga_terakhir = (ceil(($total_harga['total_harga'] + $dt['biaya_tambahan'] - $diskon + $pajak) / 100)) * 100;
		        					 ?>
									<?= number_format($total_harga['total_harga'] + $dt['biaya_tambahan'] - $diskon + $pajak); ?> <span class="font-weight-bold">(<?= number_format($total_harga_terakhir); ?>)</span>
		        				</td>
		        			</tr>
		        		</tbody>
		        	</table>
		        </div>
		        <div class="row">
		        	<div class="col-lg-12">
		        		<div class="form-group">
				        	<?php if (isset($_SESSION['kembalian'])): ?>
					        	<div class="row">
				        			<div class="col-lg-6">
				        				<div class="form-group">
					        				<label for="uang_yg_dibayar">Uang yang dibayar</label>
					        				<input style="cursor: not-allowed;" disabled type="text" id="uang_yg_dibayar" class="form-control" value="<?= number_format($_SESSION['uang_yg_dibayar']); ?>">
					        			</div>
				        			</div>
				        			<div class="col-lg-6">
				        				<div class="form-group">
					        				<label for="kembalian">Kembalian</label>
					        				<input style="cursor: not-allowed;" disabled type="text" id="kembalian" class="form-control" value="<?= number_format($_SESSION['kembalian']); ?>">
					        			</div>
				        			</div>
				        		</div>
				        	<?php else: ?>
				        		<div class="row justify-content-end">
				        			<div class="col-lg-6">
				        				<form method="post" action="<?= base_url('transaksi/pembayaranTransaksi/') . $this->uri->segment(3, 0); ?>">
						        			<div class="form-group">
						        				<input type="hidden" name="total_harga" value="<?= $total_harga_terakhir; ?>">
						        				<label for="uang_yg_dibayar">Uang yang dibayar</label>
						        				<input type="number" id="uang_yg_dibayar" class="form-control" name="uang_yg_dibayar">
						        			</div>
						        			<div class="form-group text-right">
							        			<button name="bayar" type="submit" class="btn btn-success"><i class="fas fa-fw fa-dollar-sign"></i> Bayar</button>
						        			</div>
						        		</form>
				        			</div>
				        		</div>
				        	<?php endif ?>
				        </div>
		        	</div>
		        </div>
		      </div>
			  <?php if (isset($_SESSION['kembalian'])): ?>
			      <div class="modal-footer">
			        	<a href="<?= base_url('prints/cetakInvoice/') . $this->uri->segment(3, 0); ?>" class="btn btn-success"><i class="fas fa-fw fa-print"></i> Cetak Invoice</a>
			      </div>
		      <?php endif ?>
		    </div>
		</div>
	</div>
</div>

