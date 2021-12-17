<div class="container">
	<div class="row my-2">
		<div class="col-lg my-auto header-judul">
			<h4><i class="fas fa-fw fa-align-justify"></i> <sup><i class="fas fa-1x fa-handshake"></i></sup> Detail Transaksi</h4>
		</div>
		<div class="col-lg my-auto header-kanan">
			<?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
				<?php if ($detail_header_transaksi['status_bayar'] == 'belum dibayar'): ?>
					<?php if ($detail_header_transaksi['status_transaksi'] == 'proses'): ?>
						<a href="" data-toggle="modal" data-target="#ubahDetailTransaksiModal" class="btn btn-primary"><i class="fas fa-fw fa-align-justify"></i> <sup><i class="fas fa-1x fa-handshake"></i></sup> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah Detail Transaksi</a>
					<?php else: ?>
						<small class="btn btn-info">Jika status sudah dibayar atau sudah melewati diproses, tidak dapat diubah!</small>
					<?php endif ?>
				<?php elseif ($detail_header_transaksi['status_bayar'] == 'sudah dibayar'): ?>
					<small class="btn btn-info">Jika status sudah dibayar, tidak dapat diubah!</small>
				<?php else: ?>
					<a href="" data-toggle="modal" data-target="#ubahDetailTransaksiModal" class="btn btn-primary"><i class="fas fa-fw fa-align-justify"></i> <sup><i class="fas fa-1x fa-handshake"></i></sup> <sup><i class="fas fa-fw fa-edit"></i></sup> Ubah Detail Transaksi</a>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
  <div class="row my-2">
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
  <div class="row my-2">
      <div class="col-lg">
        <div class="modal-content">
          <div class="modal-body px-5">
            <div class="row my-2 justify-content-center text-center">
              <div class="col-sm-3">
                <span class="badge badge-danger"><i class="fas fa-fw fa-sync"></i> Proses</span>
              </div>
              <div class="col-sm-3">
                <span class="text-white badge badge-warning"><i class="fas fa-fw fa-tshirt"></i> Dicuci</span>
              </div>
              <div class="col-sm-3">
                <span class="badge badge-primary"><i class="fas fa-fw fa-people-carry"></i> Siap Diambil</span>
              </div>
              <div class="col-sm-3">
                <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> Sudah Diambil</span>
              </div>
            </div>  
            <div class="row my-2 mb-3">
              <div class="col-sm">
                <?php if ($detail_header_transaksi['status_transaksi'] == 'proses'): ?>
                  <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                <?php elseif ($detail_header_transaksi['status_transaksi'] == 'dicuci'): ?>
                  <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                <?php elseif ($detail_header_transaksi['status_transaksi'] == 'siap diambil'): ?>
                  <div class="progress">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 63%" aria-valuenow="63" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                <?php elseif ($detail_header_transaksi['status_transaksi'] == 'sudah diambil'): ?>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                <?php endif ?>
              </div>
            </div>                
            <table class="table">
              <tr>
                <td class="font-weight-bold">Kode Invoice</td>
                <td class="px-2"> : </td>
                <td><?= $detail_header_transaksi['kode_invoice']; ?></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Nama Member</td>
                <td class="px-2"> : </td>
                <td><?= $detail_header_transaksi['nama_member']; ?></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Tanggal Transaksi</td>
                <td class="px-2"> : </td>
                <td><?= date('d-m-Y, H:i:s', strtotime($detail_header_transaksi['tanggal_transaksi'])); ?></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Batas Waktu</td>
                <td class="px-2"> : </td>
                <td><?= date('d-m-Y, H:i:s', strtotime($detail_header_transaksi['batas_waktu'])); ?></td>
              </tr>
              <tr>
                <td class="font-weight-bold">Tanggal Bayar</td>
                <td class="px-2"> : </td>
                <?php if ($detail_header_transaksi['tanggal_bayar'] == '0000-00-00 00:00:00'): ?>
                  <td>-</td>
                  <?php else: ?>
                  <td><?= date('d-m-Y, H:i:s', strtotime($detail_header_transaksi['tanggal_bayar'])); ?></td>
                <?php endif ?>
              </tr>
              <tr>
                <td class="font-weight-bold">Status Transaksi</td>
                <td class="px-2"> : </td>
                <?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
                  <td>
                    <?php if ($detail_header_transaksi['status_transaksi'] == 'proses'): ?>
                      <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $detail_header_transaksi['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Proses" data-status2="Dicuci"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></a>
                    <?php elseif ($detail_header_transaksi['status_transaksi'] == 'dicuci'): ?>
                      <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $detail_header_transaksi['id_transaksi']; ?>" class="text-white badge badge-warning btn-status" data-status1="Dicuci" data-status2="Siap Diambil"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></a>
                    <?php elseif ($detail_header_transaksi['status_transaksi'] == 'siap diambil'): ?>
                      <a href="<?= base_url('transaksi/ubahStatusTransaksi/') . $detail_header_transaksi['id_transaksi']; ?>" class="badge badge-primary btn-status" data-status1="Siap Diambil" data-status2="Sudah Diambil"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></a>
                    <?php elseif ($detail_header_transaksi['status_transaksi'] == 'sudah diambil'): ?>
                      <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                    <?php else: ?>
                      <span class="badge badge-info"><?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                    <?php endif ?>
                  </td>
                <?php else: ?>
                  <td>
                    <?php if ($detail_header_transaksi['status_transaksi'] == 'proses'): ?>
                      <span class="badge badge-danger"><i class="fas fa-fw fa-sync"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                    <?php elseif ($detail_header_transaksi['status_transaksi'] == 'dicuci'): ?>
                      <span class="text-white badge badge-warning"><i class="fas fa-fw fa-tshirt"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                    <?php elseif ($detail_header_transaksi['status_transaksi'] == 'siap diambil'): ?>
                      <span class="badge badge-primary"><i class="fas fa-fw fa-people-carry"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                    <?php elseif ($detail_header_transaksi['status_transaksi'] == 'sudah diambil'): ?>
                      <span class="badge badge-success"><i class="fas fa-fw fa-check-circle"></i> <?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                    <?php else: ?>
                      <span class="badge badge-info"><?= ucwords(strtolower($detail_header_transaksi['status_transaksi'])); ?></span>
                    <?php endif ?>
                  </td>
                <?php endif ?>
              </tr>
              <tr>
                <td class="font-weight-bold">Status Bayar</td>
                <td class="px-2"> : </td>
                <?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
                  <td>
                    <?php if ($detail_header_transaksi['status_bayar'] == 'belum dibayar'): ?>
                      <a href="<?= base_url('/transaksi/pembayaranTransaksi/') . $detail_header_transaksi['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Belum Dibayar" data-status2="Sudah Dibayar"><i class="fas fa-fw fa-times"></i> <?= $detail_header_transaksi['status_bayar']; ?></a>
                    <?php elseif ($detail_header_transaksi['status_bayar'] == 'sudah dibayar'): ?>
                      <span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                    <?php endif ?>
                  </td>
                <?php else: ?>
                  <td>
                    <?php if ($detail_header_transaksi['status_bayar'] == 'belum dibayar'): ?>
                      <span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                    <?php elseif ($detail_header_transaksi['status_bayar'] == 'sudah dibayar'): ?>
                      <span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                    <?php endif ?>
                  </td>
                <?php endif ?>
              </tr>
            </table>
            <hr class="mt-0 pt-0 mb-2 pb-2">
            <div class="table-responsive">
              <table class="table table-striped table-bordered border border-dark mt-3 mb-1">
                <thead>
                  <tr class="text-center">
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
                    <tr class="text-center">
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
                    <td colspan="5">
                      Total Harga dibulatkan (Rp.)
                    </td>
                    <td class="text-right">
                      <?php 
                        $total_harga_terakhir = (ceil(($total_harga['total_harga'] + $dt['biaya_tambahan'] - $diskon + $pajak) / 100)) * 100;
                       ?>
                      <?= number_format($total_harga['total_harga'] + $dt['biaya_tambahan'] - $diskon + $pajak); ?> <span class="font-weight-bold">(<?= number_format($total_harga_terakhir); ?>)</span>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="5">
                      Uang yang dibayar (Rp.)
                    </td>
                    <td class="text-right font-weight-bold">
                      <?php if ($pembayaran == null): ?>
                        <?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
                          <?php if ($detail_header_transaksi['status_bayar'] == 'belum dibayar'): ?>
                            <a href="<?= base_url('/transaksi/pembayaranTransaksi/') . $detail_header_transaksi['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Belum Dibayar" data-status2="Sudah Dibayar"><i class="fas fa-fw fa-times"></i> <?= $detail_header_transaksi['status_bayar']; ?></a>
                          <?php elseif ($detail_header_transaksi['status_bayar'] == 'sudah dibayar'): ?>
                            <span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                          <?php endif ?>
                        <?php else: ?>
                          <?php if ($detail_header_transaksi['status_bayar'] == 'belum dibayar'): ?>
                            <span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                          <?php elseif ($detail_header_transaksi['status_bayar'] == 'sudah dibayar'): ?>
                            <span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                          <?php endif ?>
                        <?php endif ?>
                      <?php else: ?>
                        <?= number_format($pembayaran['uang_yg_dibayar']); ?>
                      <?php endif ?>
                    </td>
                  </tr>
                  <tr>
                    <th colspan="5">
                      Kembalian (Rp.)        
                    </th>
                    <td class="text-right font-weight-bold">
                      <?php if ($pembayaran == null): ?>
                        <?php if ($this->session->userdata('id_jabatan') !== '4'): ?>
                          <?php if ($detail_header_transaksi['status_bayar'] == 'belum dibayar'): ?>
                            <a href="<?= base_url('/transaksi/pembayaranTransaksi/') . $detail_header_transaksi['id_transaksi']; ?>" class="badge badge-danger btn-status" data-status1="Belum Dibayar" data-status2="Sudah Dibayar"><i class="fas fa-fw fa-times"></i> <?= $detail_header_transaksi['status_bayar']; ?></a>
                          <?php elseif ($detail_header_transaksi['status_bayar'] == 'sudah dibayar'): ?>
                            <span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                          <?php endif ?>
                        <?php else: ?>
                          <?php if ($detail_header_transaksi['status_bayar'] == 'belum dibayar'): ?>
                            <span class="badge badge-danger"><i class="fas fa-fw fa-times"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                          <?php elseif ($detail_header_transaksi['status_bayar'] == 'sudah dibayar'): ?>
                            <span class="badge badge-success"><i class="fas fa-fw fa-check"></i> <?= $detail_header_transaksi['status_bayar']; ?></span>
                          <?php endif ?>
                        <?php endif ?>
                      <?php else: ?>
                        <?= number_format($pembayaran['kembalian']); ?>
                      <?php endif ?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>


<!-- Modal Ubah DetailTransaksi -->
<div class="text-left modal fade" id="ubahDetailTransaksiModal<?= $detail_header_transaksi['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahDetailTransaksiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="<?= base_url('detailTransaksi/updateDetailTransaksi/') . $detail_header_transaksi['id_transaksi']; ?>" method="post">
    	<div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="ubahDetailTransaksiModalLabel"><i class="fas fa-fw fa-align-justify"></i> <sup><i class="fas fa-1x fa-handshake"></i></sup> <sup><i class="fas fa-fw fa-plus"></i></sup> Ubah Detail Transaksi - <?= $detail_header_transaksi['kode_invoice']; ?></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="form-group">
	        	<label for="id_transaksi<?= $detail_header_transaksi['kode_invoice']; ?>">Kode Invoice Transaksi</label>
	        	<input style="cursor: not-allowed;" class="form-control" id="id_transaksi<?= $detail_header_transaksi['kode_invoice']; ?>" disabled type="text" value="<?= $detail_header_transaksi['kode_invoice']; ?>">
	        	<input type="hidden" name="id_transaksi" value="<?= $detail_header_transaksi['id_transaksi']; ?>">
	        </div>
	        <div class="form-group bg-success text-white p-3 rounded">
	        	<?php foreach ($paket as $dp): $s=false; ?>
			  		<div class="my-3">
			  			<input type="hidden" name="id_paket[]" value="<?= $dp['id_paket']; ?>">
				    	<h6 class="font-weight-bold"><?= ucwords($dp['nama_jenis_paket']); ?> | <?= $dp['nama_paket']; ?> | Rp. <?= number_format($dp['harga_paket']); ?></h6>
		        		<?php foreach ($detail_transaksi_paket as $ddtp): ?>
			        		<?php if ($dp['id_paket'] == $ddtp['id_paket']): $s=true;?>
								<input type="hidden" name="id_detail_transaksi[]" value="<?= $ddtp['id_detail_transaksi']; ?>">
								<label for="kuantitas<?= $detail_header_transaksi['id_transaksi']; ?>">Kuantitas</label>
								<input type="number" class="form-control my-1" name="kuantitas[]" placeholder="kuantitas" value="<?= $ddtp['kuantitas']; ?>">
								<label for="keterangan<?= $detail_header_transaksi['id_transaksi']; ?>">Keterangan</label>
			        			<textarea name="keterangan[]" id="keterangan" class="form-control my-1" placeholder="Keterangan <?= $dp['nama_paket']; ?>"><?= $ddtp['keterangan']; ?></textarea>
		        			<?php endif ?>
		        		<?php endforeach ?>
		        		<?php if ($s == false): ?>
		        			<input type="hidden" name="id_detail_transaksi[]">
							    <label for="kuantitas<?= $detail_header_transaksi['id_transaksi']; ?>">Kuantitas</label>
		        			<input type="number" id="kuantitas<?= $detail_header_transaksi['id_transaksi']; ?>" class="form-control my-1" name="kuantitas[]" placeholder="kuantitas">
                  
							    <label for="keterangan<?= $detail_header_transaksi['id_transaksi']; ?>">Keterangan</label>
			        		<textarea name="keterangan[]" id="keterangan<?= $detail_header_transaksi['id_transaksi']; ?>" class="form-control my-1" placeholder="Keterangan <?= $dp['nama_paket']; ?>"></textarea>
		        		<?php endif ?>
			  		</div>
        		<?php endforeach ?>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
	        <button type="submit" name="btnUbahDetailTransaksi" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Kirim</button>
	      </div>
	    </div>
    </form>
  </div>
</div>



