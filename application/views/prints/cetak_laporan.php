<div class="container-fluid py-2">
	<div class="row">
		<div class="col-lg">
			<h4 class="my-4"><i class="fas fa-fw fa-handshake"></i> Daftar Transaksi Dari Tanggal <?= $this->uri->segment(3, 0); ?> Sampai <?= $this->uri->segment(4, 0); ?></h4>
			<table class="table table-striped table-bordered text-center">
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
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($transaksiLaporan as $dt): ?>
						<tr>
							<td><?= $i++; ?></td>
							<td>
								<?= $dt['kode_invoice']; ?>
							</td>
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
							    <span class="badge badge-danger"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php elseif ($dt['status_transaksi'] == 'dicuci'): ?>
							    <span class="text-white badge badge-warning"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php elseif ($dt['status_transaksi'] == 'siap diambil'): ?>
							    <span class="badge badge-primary"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php elseif ($dt['status_transaksi'] == 'sudah diambil'): ?>
							    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php else: ?>
							    <span class="badge badge-info"><?= ucwords(strtolower($dt['status_transaksi'])); ?></span>
							  <?php endif ?>
							</td>
							<td>
								<?php if ($dt['status_bayar'] == 'belum dibayar'): ?>
									<span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> <?= $dt['status_bayar']; ?></span>
								<?php elseif ($dt['status_bayar'] == 'sudah dibayar'): ?>
									<span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $dt['status_bayar']; ?></span>
								<?php endif ?>
							</td>
							<?php if ($this->session->userdata('id_jabatan') == '1'): ?>
								<td><?= $dt['nama_outlet']; ?></td>
							<?php endif ?>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row my-2">
		<div class="p-4 m-1 rounded text-white bg-info">
			<h3>Penghasilan (Rp.) <?= number_format($penghasilan['penghasilan']); ?></h3>
		</div>
	</div>
</div>