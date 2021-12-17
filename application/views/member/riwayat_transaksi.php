<div class="row my-2">
	<div class="col-lg">
		<h4>Riwayat Transaksi Member - <?= $member['nama_member']; ?></h4>
	</div>
</div>
<div class="row my-2">
	<div class="col-lg">
		<div class="table-responsive">
			<table class="table table-bordered" id="table_id">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Invoice</th>
						<th>Tanggal Transaksi</th>
						<th>Status Transaksi</th>
						<th>Status Bayar</th>
						<th>Nama Outlet</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach ($riwayat_transaksi as $drt): ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $drt['kode_invoice']; ?></td>
							<td><?= $drt['tanggal_transaksi']; ?></td>
							<td>
								<?php if ($drt['status_transaksi'] == 'proses'): ?>
									<span class="badge badge-danger"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($drt['status_transaksi'])); ?></span>
								<?php elseif ($drt['status_transaksi'] == 'dicuci'): ?>
								    <span class="text-white badge badge-warning"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($drt['status_transaksi'])); ?></span>
								<?php elseif ($drt['status_transaksi'] == 'siap diambil'): ?>
								    <span class="badge badge-primary"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($drt['status_transaksi'])); ?></span>
								<?php elseif ($drt['status_transaksi'] == 'sudah diambil'): ?>
								    <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($drt['status_transaksi'])); ?></span>
								<?php else: ?>
								    <span class="badge badge-info"><?= ucwords(strtolower($drt['status_transaksi'])); ?></span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($drt['status_bayar'] == 'belum dibayar'): ?>
									<span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> <?= $drt['status_bayar']; ?></span>
								<?php elseif ($drt['status_bayar'] == 'sudah dibayar'): ?>
									<span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $drt['status_bayar']; ?></span>
								<?php endif ?>
							</td>
							<td><?= $drt['nama_outlet']; ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>