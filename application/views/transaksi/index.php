<div class="row my-2">
	<div class="col-lg my-auto header-judul">
		<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
			<h4><i class="fas fa-fw fa-handshake"></i> Daftar Transaksi</h4>
		<?php elseif ($this->session->userdata('id_jabatan') == '2'): ?>
			<h4><i class="fas fa-fw fa-handshake"></i> Daftar Transaksi - <?= $dataUser['nama_outlet']; ?></h4>
		<?php else: ?>
			<h4><i class="fas fa-fw fa-handshake"></i> Daftar Transaksi - <?= $dataUser['nama_outlet']; ?></h4>
		<?php endif ?>
	</div>
	<div class="col-lg my-auto header-kanan">
		<a href="" data-toggle="modal" data-target="#tambahTransaksiModal" class="btn btn-primary"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Transaksi</a>
		<!-- Modal Tambah Transaksi -->
		<div class="text-left modal fade" id="tambahTransaksiModal" tabindex="-1" role="dialog" aria-labelledby="tambahTransaksiModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <form action="<?= base_url('transaksi/createTransaksi'); ?>" method="post">
		    	<div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="tambahTransaksiModalLabel"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-plus"></i></sup> Tambah Transaksi</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <div class="form-group">
			        	<label for="batas_waktu">Batas Waktu</label>
			        	<input required type="datetime-local" name="batas_waktu" id="batas_waktu" class="form-control" value="<?= date('Y-m-d') . 'T' . date('H:i'); ?>">
					    <?= form_error('batas_waktu', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="row">
			        	<div class="col-lg-6">
			        		<div class="form-group">
					        	<label for="biaya_tambahan">Biaya Tambahan (Rp.)</label>
					        	<input type="number" name="biaya_tambahan" id="biaya_tambahan" class="form-control" value="<?= set_value('biaya_tambahan'); ?>">
							    <?= form_error('biaya_tambahan', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
			        	</div>
			        	<div class="col-lg-3">
			        		<div class="form-group">
					        	<label for="diskon">Diskon %</label>
					        	<input min="0" max="100" type="number" name="diskon" id="diskon" class="form-control" value="<?= set_value('diskon'); ?>">
							    <?= form_error('diskon', '<small class="form-text text-danger">', '</small>'); ?>
					        </div>
			        	</div>
			        	<div class="col-lg-3">
			        		<div class="form-group">
					        	<label for="pajak">Pajak %</label>
					        	<input min="0" max="100" type="number" name="pajak" id="pajak" class="form-control" value="10">
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
			        	<select style="display: block!important;width: 100%!important;height: calc(1.5em + 0.75rem + 2px)!important;padding: 0.375rem 0.75rem!important;font-size: 1rem!important;font-weight: 400!important;line-height: 1.5!important;color: #495057!important;background-color: #fff!important;background-clip: padding-box!important;border: 1px solid #ced4da!important;border-radius: 0.25rem!important;transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out!important;" name="id_member" id="id_member" class="js-member-basic-single">
			        		<option value="0">------ Pilih Member ------</option>
			        		<?php foreach ($member as $dm): ?>
				        		<option value="<?= $dm['id_member']; ?>"><?= $dm['nama_member']; ?></option>
			        		<?php endforeach ?>
			        	</select>
					    <?= form_error('id_member', '<small class="form-text text-danger">', '</small>'); ?>
			        </div>
			        <div class="form-group">
			        	<label for="id_outlet">Nama Outlet</label>
		        		<input type="hidden" name="id_outlet" value="<?= $this->session->userdata('id_outlet'); ?>">
		        		<input style="cursor: not-allowed;" disabled type="text" value="<?= $dataUser['nama_outlet']; ?>" class="form-control">
			        </div>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
			        <button type="submit" name="btnTambahTransaksi" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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

<div class="row justify-content-center text-center my-2">
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/'); ?>" class="btn btn-secondary">Semua</a> <span class="badge badge-secondary"><?= $jumlah_status_transaksi_semua['semua']; ?></span>
	</div>
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/' . 'proses'); ?>" class="btn btn-danger">Proses</a> <span class="badge badge-danger"><?= $jumlah_status_transaksi_proses['proses']; ?></span>
	</div>
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/' . 'dicuci'); ?>" class="btn btn-warning text-white">Dicuci</a> <span class="badge badge-warning text-white"><?= $jumlah_status_transaksi_dicuci['dicuci']; ?></span>
	</div>
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/' . 'siap diambil'); ?>" class="btn btn-info">Siap diambil</a> <span class="badge badge-info"><?= $jumlah_status_transaksi_siap_diambil['siap diambil']; ?></span>
	</div>
	<div class="col-md m-1 px-0">
		<a href="<?= base_url('transaksi/index/' . 'sudah diambil'); ?>" class="btn btn-success">Sudah diambil</a> <span class="badge badge-success"><?= $jumlah_status_transaksi_sudah_diambil['sudah diambil']; ?></span>
	</div>
</div>

<?php if ($this->uri->segment(3, 0)): ?>
	<div class="row my-2">
		<div class="col-lg">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="table_id">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Invoice</th>
							<th>Nama Member</th>
							<th>Tanggal Transaksi</th>
							<th>Batas Waktu</th>
							<th>Tanggal Bayar</th>
							<th>Status Transaksi</th>
							<th>Status Bayar</th>
							<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
								<th>Outlet</th>
							<?php endif ?>
							<th>Pembuat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($transaksi as $dt): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $dt['kode_invoice']; ?></td>
								<td><?= $dt['nama_member']; ?></td>
								<td><?= $dt['tanggal_transaksi']; ?></td>
								<td><?= $dt['batas_waktu']; ?></td>
								<?php if ($dt['tanggal_bayar'] == '0000-00-00 00:00:00'): ?>
						          	<td>-</td>
					          	<?php else: ?>
						        	<td><?= $dt['tanggal_bayar']; ?></td>
						        <?php endif ?>
								<td>
								  <?php if ($dt['status_transaksi'] == 'proses'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Proses" data-status2="Dicuci"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="text-white badge badge-warning btn-status" data-status1="Dicuci" data-status2="Siap Diambil"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-primary btn-status" data-status1="Siap Diambil" data-status2="Sudah Diambil"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
								    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
								  <?php else: ?>
								    <span class="badge badge-info"><?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
								  <?php endif ?>
								</td>
								<td>
									<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
										<a href="<?= base_url('/transaksi/pembayaranTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Belum Dibayar" data-status2="Sudah Dibayar"><i class="fas fa-fw fa-times"></i> <?= $dt['status_bayar']; ?></a>
									<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $dt['status_bayar']; ?></span>
									<?php endif ?>
								</td>
								<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
									<td><?= $dt['nama_outlet']; ?></td>
								<?php endif ?>
								<td><?= $dt['username']; ?></td>
								<td>
									<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<a href="<?= base_url('prints/cetakInvoice/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-info"><i class="fas fa-fw fa-print"></i> Cetak</a>
									<?php endif ?>
									<a href="<?= base_url('detailTransaksi/index/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-warning text-white"><i class="fas fa-fw fa-align-justify"></i> Detail</a>
									<a href="" data-toggle="modal" data-target="#ubahTransaksiModal<?= $dt['id_transaksi']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
									<!-- Jika super administrator atau administrator -->
									<?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
										<a href="<?= base_url('transaksi/deleteTransaksi/') . $dt['id_transaksi']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $dt['kode_invoice']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
									<?php endif ?>
								</td>
							</tr>
							<!-- Modal Ubah Transaksi -->
							<div class="text-left modal fade" id="ubahTransaksiModal<?= $dt['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('transaksi/updateTransaksi/') . $dt['id_transaksi']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah Transaksi - <?= $dt['kode_invoice']; ?></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="form-group">
								        	<label for="batas_waktu<?= $dt['kode_invoice']; ?>">Batas Waktu</label>
								        	<?php 
								        		$batas_waktu = $dt['batas_waktu'];
								        		$batas_waktu_timestamp = strtotime($batas_waktu);
								        	 ?>
								        	<input required type="datetime-local" name="batas_waktu" id="batas_waktu<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= date('Y-m-d', $batas_waktu_timestamp) . 'T' . date('H:i', $batas_waktu_timestamp); ?>">
										    <?= form_error('batas_waktu', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								        <div class="row">
								        	<div class="col-lg-6">
								        		<div class="form-group">
										        	<label for="biaya_tambahan<?= $dt['kode_invoice']; ?>">Biaya Tambahan (Rp.)</label>
										        	<input style="cursor: not-allowed;" disabled type="text" name="biaya_tambahan" id="biaya_tambahan<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= number_format($dt['biaya_tambahan']); ?>">
												    <?= form_error('biaya_tambahan', '<small class="form-text text-danger">', '</small>'); ?>
										        </div>
								        	</div>
								        	<div class="col-lg-3">
								        		<div class="form-group">
										        	<label for="diskon<?= $dt['kode_invoice']; ?>">Diskon %</label>
										        	<input style="cursor: not-allowed;" disabled min="0" max="100" type="text" name="diskon" id="diskon<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= number_format($dt['diskon']); ?>">
												    <?= form_error('diskon', '<small class="form-text text-danger">', '</small>'); ?>
										        </div>
								        	</div>
								        	<div class="col-lg-3">
								        		<div class="form-group">
										        	<label for="pajak<?= $dt['kode_invoice']; ?>">Pajak %</label>
										        	<input style="cursor: not-allowed;" disabled min="0" max="100" type="text" name="pajak" id="pajak<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= number_format($dt['pajak']); ?>">
												    <?= form_error('pajak', '<small class="form-text text-danger">', '</small>'); ?>
										        </div>
								        	</div>
								        </div>
								        <div class="form-group">
								        	<label for="status_transaksi<?= $dt['kode_invoice']; ?>">Status Transaksi</label>
							        		<select name="status_transaksi" id="status_transaksi<?= $dt['kode_invoice']; ?>" class="form-control">
	                                            <?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
	                                            	<?php if ($dt['status_transaksi'] == 'proses'): ?>
		                                              <option value="proses">Proses</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                        	  <option value="sudah diambil">Sudah diambil</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                              <option value="dicuci">Dicuci</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                            <?php endif ?>
	                                            <?php else: ?>
	                                            	<?php if ($dt['status_transaksi'] == 'proses'): ?>
		                                              <option value="proses">Proses</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="proses">Proses</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="proses">Proses</option>
		                                              <option value="dicuci">Dicuci</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="proses">Proses</option>
		                                            <?php endif ?>
	                                            <?php endif ?>
	                                        </select>
								        </div>
								        <div class="form-group">
								        	<label for="status_bayar<?= $dt['kode_invoice']; ?>">Status Bayar</label>
								        	<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
	                                            <input class="form-control" value="Sudah Bayar" disabled style="cursor: not-allowed;">
												<input type="hidden" name="status_bayar" value="<?= $dt['status_bayar']; ?>">
								        	<?php else: ?>
									        	<select name="status_bayar" id="status_bayar<?= $dt['kode_invoice']; ?>" class="form-control">
									        		<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
									        			<option value="belum dibayar">Belum dibayar</option>
										        		<option value="sudah dibayar">Sudah dibayar</option>
									        		<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
										        		<option value="sudah dibayar">Sudah dibayar</option>
									        			<option value="belum dibayar">Belum dibayar</option>
									        		<?php else: ?>
									        			<option value="belum dibayar">Belum dibayar</option>
										        		<option value="sudah dibayar">Sudah dibayar</option>
									        		<?php endif ?>
									        	</select>
								        	<?php endif ?>
								        </div>
								        <div class="form-group">
								        	<label for="id_member<?= $dt['kode_invoice']; ?>">Member</label>
								        	<?php if ($dt['status_transaksi'] !== 'proses' || $dt['status_bayar'] == 'sudah dibayar'): ?>
								        		<input type="hidden" name="id_member" value="<?= $dt['id_member']; ?>">
								        		<input style="cursor: not-allowed;" class="form-control" type="text" disabled value="<?= $dt['nama_member']; ?>">
								        	<?php else: ?>
								        		<select style="display: block!important;width: 100%!important;height: calc(1.5em + 0.75rem + 2px)!important;padding: 0.375rem 0.75rem!important;font-size: 1rem!important;font-weight: 400!important;line-height: 1.5!important;color: #495057!important;background-color: #fff!important;background-clip: padding-box!important;border: 1px solid #ced4da!important;border-radius: 0.25rem!important;transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out!important;" name="id_member" id="id_member<?= $dt['kode_invoice']; ?>" class="js-member-basic-single">
									        		<option value="<?= $dt['id_member']; ?>"><?= $dt['nama_member']; ?></option>
									        		<?php foreach ($member as $dm): ?>
									        			<?php if ($dt['id_member'] !== $dm['id_member']): ?>
											        		<option value="<?= $dm['id_member']; ?>"><?= $dm['nama_member']; ?></option>
									        			<?php endif ?>
									        		<?php endforeach ?>
									        	</select>
								        	<?php endif ?>
								        </div>
								        <div class="form-group">
								        	<label for="id_outlet<?= $dt['id_transaksi']; ?>">Nama Outlet</label>
							        		<input type="hidden" name="id_outlet" value="<?= $dt['id_outlet']; ?>">
							        		<input style="cursor: not-allowed;" disabled type="text" value="<?= $dataUser['nama_outlet']; ?>" class="form-control">
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
								        <button type="submit" name="btnUbahTransaksi" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
<?php elseif ($this->uri->segment(3, 0) == FALSE): ?>
	<div class="row my-2">
		<div class="col-lg">
			<div class="table-responsive">
				<table class="table table-striped table-bordered text-center" id="table_id">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Invoice</th>
							<th>Nama Member</th>
							<th>Tanggal Transaksi</th>
							<th>Batas Waktu</th>
							<th>Tanggal Bayar</th>
							<th>Status Transaksi</th>
							<th>Status Bayar</th>
							<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
								<th>Outlet</th>
							<?php endif ?>
							<th>Pembuat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($transaksi as $dt): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $dt['kode_invoice']; ?></td>
								<td><?= $dt['nama_member']; ?></td>
								<td><?= $dt['tanggal_transaksi']; ?></td>
								<td><?= $dt['batas_waktu']; ?></td>
								<?php if ($dt['tanggal_bayar'] == '0000-00-00 00:00:00'): ?>
						          	<td>-</td>
					          	<?php else: ?>
						        	<td><?= $dt['tanggal_bayar']; ?></td>
						        <?php endif ?>
								<td>
								  <?php if ($dt['status_transaksi'] == 'proses'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Proses" data-status2="Dicuci"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="text-white badge badge-warning btn-status" data-status1="Dicuci" data-status2="Siap Diambil"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
								    <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-primary btn-status" data-status1="Siap Diambil" data-status2="Sudah Diambil"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></a>
								  <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
								    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
								  <?php else: ?>
								    <span class="badge badge-info"><?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
								  <?php endif ?>
								</td>
								<td>
									<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
										<a href="<?= base_url('/transaksi/pembayaranTransaksi/') . $dt['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Belum Dibayar" data-status2="Sudah Dibayar"><i class="fas fa-fw fa-times"></i> <?= $dt['status_bayar']; ?></a>
									<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $dt['status_bayar']; ?></span>
									<?php endif ?>
								</td>
								<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
									<td><?= $dt['nama_outlet']; ?></td>
								<?php endif ?>
								<td><?= $dt['username']; ?></td>
								<td>
									<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
										<a href="<?= base_url('prints/cetakInvoice/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-info"><i class="fas fa-fw fa-print"></i> Cetak</a>
									<?php endif ?>
									<a href="<?= base_url('detailTransaksi/index/') . $dt['id_transaksi']; ?>" class="m-1 badge badge-warning text-white"><i class="fas fa-fw fa-align-justify"></i> Detail</a>
									<a href="" data-toggle="modal" data-target="#ubahTransaksiModal<?= $dt['id_transaksi']; ?>" class="m-1 badge badge-success"><i class="fas fa-fw fa-edit"></i> Ubah</a>
									<!-- Jika super administrator atau administrator -->
									<?php if ($this->session->userdata('id_jabatan') == '1' OR $this->session->userdata('id_jabatan') == '2'): ?>
										<a href="<?= base_url('transaksi/deleteTransaksi/') . $dt['id_transaksi']; ?>" class="btn-delete m-1 badge badge-danger" data-text="<?= $dt['kode_invoice']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
									<?php endif ?>
								</td>
							</tr>
							<!-- Modal Ubah Transaksi -->
							<div class="text-left modal fade" id="ubahTransaksiModal<?= $dt['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <form action="<?= base_url('transaksi/updateTransaksi/') . $dt['id_transaksi']; ?>" method="post">
							    	<div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ubahTransaksiModalLabel<?= $dt['id_transaksi']; ?>"><i class="fas fa-fw fa-handshake"></i> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah Transaksi - <?= $dt['kode_invoice']; ?></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="form-group">
								        	<label for="batas_waktu<?= $dt['kode_invoice']; ?>">Batas Waktu</label>
								        	<?php 
								        		$batas_waktu = $dt['batas_waktu'];
								        		$batas_waktu_timestamp = strtotime($batas_waktu);
								        	 ?>
								        	<input required type="datetime-local" name="batas_waktu" id="batas_waktu<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= date('Y-m-d', $batas_waktu_timestamp) . 'T' . date('H:i', $batas_waktu_timestamp); ?>">
										    <?= form_error('batas_waktu', '<small class="form-text text-danger">', '</small>'); ?>
								        </div>
								        <div class="row">
								        	<div class="col-lg-6">
								        		<div class="form-group">
										        	<label for="biaya_tambahan<?= $dt['kode_invoice']; ?>">Biaya Tambahan (Rp.)</label>
										        	<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
														<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
													        	<input type="number" id="biaya_tambahan<?= $dt['kode_invoice']; ?>" min="0" class="form-control" value="<?= $dt['biaya_tambahan']; ?>" name="biaya_tambahan">
													        <?php else: ?>
													        	<input style="cursor: not-allowed;" disabled type="text" id="biaya_tambahan<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= number_format($dt['biaya_tambahan']); ?>">
													        <?php endif ?>
												        <?php endif ?>
											        <?php endif ?>

												    <?= form_error('biaya_tambahan', '<small class="form-text text-danger">', '</small>'); ?>
										        </div>
								        	</div>
								        	<div class="col-lg-3">
								        		<div class="form-group">
										        	<label for="diskon<?= $dt['kode_invoice']; ?>">Diskon %</label>
										        	<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
														<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
													        	<input type="number" id="diskon<?= $dt['kode_invoice']; ?>" min="0" max="100" class="form-control" value="<?= $dt['diskon']; ?>" name="diskon">
													        <?php else: ?>
										        				<input style="cursor: not-allowed;" disabled min="0" max="100" type="text" name="diskon" id="diskon<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= number_format($dt['diskon']); ?>">
													        <?php endif ?>
												        <?php endif ?>
											        <?php endif ?>
												    <?= form_error('diskon', '<small class="form-text text-danger">', '</small>'); ?>
										        </div>
								        	</div>
								        	<div class="col-lg-3">
								        		<div class="form-group">
										        	<label for="pajak<?= $dt['kode_invoice']; ?>">Pajak %</label>
										        	<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
														<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
															<?php if ($dt['status_transaksi'] == 'proses'): ?>
													        	<input type="number" id="pajak<?= $dt['kode_invoice']; ?>" min="0" max="100" class="form-control" value="<?= $dt['pajak']; ?>" name="pajak">
													        <?php else: ?>
													        	<input style="cursor: not-allowed;" disabled min="0" max="100" type="text" name="pajak" id="pajak<?= $dt['kode_invoice']; ?>" class="form-control" value="<?= number_format($dt['pajak']); ?>">
													        <?php endif ?>
												        <?php endif ?>
											        <?php endif ?>
												    <?= form_error('pajak', '<small class="form-text text-danger">', '</small>'); ?>
										        </div>
								        	</div>
								        </div>
								        <div class="form-group">
								        	<label for="status_transaksi<?= $dt['kode_invoice']; ?>">Status Transaksi</label>
							        		<select name="status_transaksi" id="status_transaksi<?= $dt['kode_invoice']; ?>" class="form-control">
	                                            <?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
	                                            	<?php if ($dt['status_transaksi'] == 'proses'): ?>
		                                              <option value="proses">Proses</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                        	  <option value="sudah diambil">Sudah diambil</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                              <option value="dicuci">Dicuci</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                            <?php endif ?>
	                                            <?php else: ?>
	                                            	<?php if ($dt['status_transaksi'] == 'proses'): ?>
		                                              <option value="proses">Proses</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="proses">Proses</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="proses">Proses</option>
		                                              <option value="dicuci">Dicuci</option>
		                                            <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
		                                              <option value="sudah diambil">Sudah diambil</option>
		                                              <option value="siap diambil">Siap diambil</option>
		                                              <option value="dicuci">Dicuci</option>
		                                              <option value="proses">Proses</option>
		                                            <?php endif ?>
	                                            <?php endif ?>
	                                        </select>
								        </div>
								        <div class="form-group">
								        	<label for="status_bayar<?= $dt['kode_invoice']; ?>">Status Bayar</label>
								        	<?php if ($dt['status_bayar'] == 'sudah dibayar'): ?>
	                                            <input class="form-control" value="Sudah Bayar" disabled style="cursor: not-allowed;">
												<input type="hidden" name="status_bayar" value="<?= $dt['status_bayar']; ?>">
								        	<?php else: ?>
									        	<select name="status_bayar" id="status_bayar<?= $dt['kode_invoice']; ?>" class="form-control">
									        		<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
									        			<option value="belum dibayar">Belum dibayar</option>
										        		<option value="sudah dibayar">Sudah dibayar</option>
									        		<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
										        		<option value="sudah dibayar">Sudah dibayar</option>
									        			<option value="belum dibayar">Belum dibayar</option>
									        		<?php else: ?>
									        			<option value="belum dibayar">Belum dibayar</option>
										        		<option value="sudah dibayar">Sudah dibayar</option>
									        		<?php endif ?>
									        	</select>
								        	<?php endif ?>
								        </div>
								        <div class="form-group">
								        	<label for="id_member<?= $dt['kode_invoice']; ?>">Member</label>
								        	<?php if ($dt['status_transaksi'] !== 'proses' || $dt['status_bayar'] == 'sudah dibayar'): ?>
								        		<input type="hidden" name="id_member" value="<?= $dt['id_member']; ?>">
								        		<input style="cursor: not-allowed;" class="form-control" type="text" disabled value="<?= $dt['nama_member']; ?>">
								        	<?php else: ?>
								        		<select style="display: block!important;width: 100%!important;height: calc(1.5em + 0.75rem + 2px)!important;padding: 0.375rem 0.75rem!important;font-size: 1rem!important;font-weight: 400!important;line-height: 1.5!important;color: #495057!important;background-color: #fff!important;background-clip: padding-box!important;border: 1px solid #ced4da!important;border-radius: 0.25rem!important;transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out!important;" name="id_member" id="id_member<?= $dt['kode_invoice']; ?>" class="js-member-basic-single">
									        		<option value="<?= $dt['id_member']; ?>"><?= $dt['nama_member']; ?></option>
									        		<?php foreach ($member as $dm): ?>
									        			<?php if ($dt['id_member'] !== $dm['id_member']): ?>
											        		<option value="<?= $dm['id_member']; ?>"><?= $dm['nama_member']; ?></option>
									        			<?php endif ?>
									        		<?php endforeach ?>
									        	</select>
								        	<?php endif ?>
								        </div>
								        <div class="form-group">
								        	<label for="id_outlet<?= $dt['id_transaksi']; ?>">Nama Outlet</label>
							        		<input type="hidden" name="id_outlet" value="<?= $dt['id_outlet']; ?>">
							        		<input style="cursor: not-allowed;" disabled type="text" value="<?= $dataUser['nama_outlet']; ?>" class="form-control">
								        </div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
								        <button type="submit" name="btnUbahTransaksi" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
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
<?php endif ?>