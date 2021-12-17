<style>
  body {
    font-family: monospace, sans-serif;
  }
  ul {
    list-style: none;
    padding: 0;
    overflow-x: hidden;
  }
  .outer {
    width: 100%;  
  }
  .inner {
    padding-left: 20px;
  }
  li:not(.nested):before {
    float: left;
    width: 0;
    white-space: nowrap;
    content:"..........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................";
  }
  li span:first-child {
    padding-right: 0.33em;
    background: #FAFAFA;
  }
  span + span {
    float: right;
    padding-left: 0.33em;
    background: #FAFAFA;
  }
  @media print {
    .hilang-diprint {
      display: none;
    }
  }
</style>

<div class="container border border-dark my-2 p-4 px-5 mt-4">
  <div class="row justify-content-center">
    <div class="col-2 text-left">
      <img width="100%" class="rounded" src="<?= base_url(); ?>assets/img/img_properties/laundry.jpg" alt="logo">
    </div>
    <div class="col text-left my-auto">
      <table border="0">
        <tr>
          <th style="min-width: 135px !important"><h6 class="text-dark py-0 my-0 font-weight-bold">Nama Outlet</h6></th>
          <td class="px-2"> : </td>
          <td><?= $transaksi['nama_outlet']; ?></td>
        </tr>
        <tr>
          <th style="min-width: 135px !important"><h6 class="text-dark py-0 my-0 font-weight-bold">Alamat Outlet</h6></th>
          <td class="px-2"> : </td>
          <td><?= $transaksi['alamat_outlet']; ?></td>
        </tr>
        <tr>
          <th style="min-width: 135px !important"><h6 class="text-dark py-0 my-0 font-weight-bold">Telepon Outlet</h6></th>
          <td class="px-2"> : </td>
          <td><?= $transaksi['telepon_outlet']; ?></td>
        </tr>
      </table>
    </div>
  </div>
  <div class="mt-4" style="border: 1px black dashed"></div>
  <div class="row justify-content-center mt-3 mb-2">
    <div class="col text-center">
      <h4>KODE INVOICE. <?= $transaksi['kode_invoice']; ?></h4>
    </div>
  </div>
  <div style="border: 1px black dashed"></div>
  <div class="row my-4">
    <div class="col-6">
      <table border="0">
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Nama Member</td>
          <td class="px-2"> : </td>
          <td><?= $transaksi['nama_member']; ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">No. Telepon</td>
          <td class="px-2"> : </td>
          <td><?= $transaksi['telepon_member']; ?></td>
        </tr>
    		<tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Email</td>
          <td class="px-2"> : </td>
          <td>
            <?php if ($transaksi['email_member'] == ''): ?>
              -
            <?php else: ?>
              <?= $transaksi['email_member']; ?>
            <?php endif ?>
          </td>
        </tr>
        <tr>
          <td style="min-width: 135px !important;" class="font-weight-bold">Alamat</td>
          <td class="px-2"> : </td>
          <td style=" max-width: 260px !important"><?= $transaksi['alamat_member']; ?></td>
        </tr>
      </table>
    </div>
    <div class="col">
      <table border="0">
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Tanggal Cetak Invoice</td>
          <td class="px-2"> : </td>
          <td><?= date('d-m-Y, H:i:s'); ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Tanggal Transaksi</td>
          <td class="px-2"> : </td>
          <td><?= date('d-m-Y, H:i:s', strtotime($transaksi['tanggal_transaksi'])); ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Batas Waktu</td>
          <td class="px-2"> : </td>
          <td><?= date('d-m-Y, H:i:s', strtotime($transaksi['batas_waktu'])); ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Tanggal Bayar</td>
          <td class="px-2"> : </td>
          <td><?= date('d-m-Y, H:i:s', strtotime($transaksi['tanggal_bayar'])); ?></td>
        </tr>
        <tr>
          <td style="min-width: 135px !important" class="font-weight-bold">Status Transaksi</td>
          <td class="px-2"> : </td>
          <td>
            <?php if ($transaksi['status_transaksi'] == 'proses'): ?>
              <span class="text-white btn-print btn btn-sm btn-danger"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php elseif ($transaksi['status_transaksi'] == 'dicuci'): ?>
              <span class="text-white btn-print btn btn-sm btn-warning"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php elseif ($transaksi['status_transaksi'] == 'siap diambil'): ?>
              <span class="text-white btn-print btn btn-sm btn-primary"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php elseif ($transaksi['status_transaksi'] == 'sudah diambil'): ?>
              <span class="text-white btn-print btn btn-sm btn-success"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php else: ?>
              <span class="text-white btn-print btn btn-sm btn-info"><?= ucwords(strtolower($transaksi['status_transaksi'])); ?></span>
            <?php endif ?>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div style="border: 1px black dashed"></div>
  <div class="row justify-content-center mt-2 mb-1">
    <div class="col text-center">
      <h4>Detail Transaksi</h4>
    </div>
  </div>
  <div style="border: 1px black dashed"></div>
  <div class="row">
    <div class="col-lg">
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
              <?= number_format($total_harga['total_harga'] + $dt['biaya_tambahan'] - $diskon + $pajak); ?> <span class="font-weight-bold">(<?= number_format($pembayaran['total_harga']); ?>)</span>
            </td>
          </tr>
          <tr>
            <td colspan="5">
              Uang yang dibayar (Rp.)
            </td>
            <td class="text-right font-weight-bold">
              <?= number_format($pembayaran['uang_yg_dibayar']); ?>
            </td>
          </tr>
          <tr>
            <th colspan="5">
              Kembalian (Rp.)        
            </th>
            <td class="text-right font-weight-bold">
              <?= number_format($pembayaran['kembalian']); ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  
  <div class="mx-n5 my-2" style="border: 1px black solid"></div>
  <div class="row mt-5 pt-5">
    <div class="col font-weight-bold">...........................</div>
    <div class="col-3 font-weight-bold text-right">...........................</div>
  </div>
  <div class="row">
    <div class="col"><h5 class="ml-1 font-weight-bold">Tanda Terima</h5></div>
    <div class="col-3"><h5 class="ml-1 font-weight-bold">Hormat Kami</h5></div>
  </div>
  <div class="mt-5" style="border: 1px black dashed"></div>
  <p class="text-center mt-4 text-dark">Terima kasih sudah mempercayakan cucian Anda kepada Kami.</p>
</div>
