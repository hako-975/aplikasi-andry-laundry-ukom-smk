<div class="container">
	<div class="row my-2">
		<div class="col-lg header-judul">
			<h2>Daftar Catatan</h2>
		</div>
	</div>
	<div class="row my-2">
		<div class="col-lg">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="table_id">
					<thead>
						<tr>
							<th>No</th>
							<th>Isi Catatan</th>
							<th>Tanggal Catatan</th>
							<th>Pembuat Catatan</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($log as $dl): ?>
							<tr>
								<td><?= $i++; ?></td>
								<td><?= $dl['isi_log']; ?></td>
								<td><?= $dl['tanggal_log']; ?></td>
								<td><?= $dl['username']; ?></td>
							</tr>
							</div>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>