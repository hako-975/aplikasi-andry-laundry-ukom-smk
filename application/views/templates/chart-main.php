<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: [
            <?php 
              for ($x=6; $x > 0; $x--) :
              $sett   = mktime(0,0,0,date("n"),date("j")-$x,date("Y"));
              $tgl  = date("d-M", $sett);
            ?>
            '<?= $tgl ?>',
            <?php endfor ?>
            'Hari Ini'
          ],
          datasets: [{
              label: ' Jumlah Transaksi dalam sehari',
              data: [
                <?php 
                  for ($z=6; $z > 0; $z--) :
                  $sett_awal = mktime(0,0,0,date("n"),date("j")-$z,date("Y"));
                  $sett_akhir = mktime(23,59,59,date("n"),date("j")-$z,date("Y"));
                  $tgl_awal  = date("Y-m-d H:i:s", $sett_awal);
                  $tgl_akhir  = date("Y-m-d H:i:s", $sett_akhir);
                  $id_outlet = $this->session->userdata('id_outlet');
                  if ($this->session->userdata('id_jabatan') == '1') {
                    $sqlChart = "SELECT COUNT(id_transaksi) AS jml_transaksi FROM transaksi WHERE tanggal_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir'";
                  } else {
                    $sqlChart = "SELECT COUNT(id_transaksi) AS jml_transaksi FROM transaksi WHERE tanggal_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir' AND transaksi.id_outlet = '$id_outlet'";
                  }
                  $dateAssc     = $this->db->query($sqlChart)->row_array();
                ?>
                '<?= $dateAssc['jml_transaksi']; ?>',
                <?php
                  endfor;
                  $dateNowAwal  = date("Y-m-d 00:00:00");
                  $dateNowAkhir  = date("Y-m-d 23:59:59");
                  $id_outlet = $this->session->userdata('id_outlet');
                  if ($this->session->userdata('id_jabatan') == '1') {
                    $sqlChart2  = "SELECT COUNT(id_transaksi) AS jml_transaksi FROM transaksi WHERE tanggal_transaksi BETWEEN '$dateNowAwal' AND '$dateNowAkhir'";
                  } else {
                    $sqlChart2  = "SELECT COUNT(id_transaksi) AS jml_transaksi FROM transaksi WHERE tanggal_transaksi BETWEEN '$dateNowAwal' AND '$dateNowAkhir' AND transaksi.id_outlet = '$id_outlet'";
                  }
                  $dateAssc2     = $this->db->query($sqlChart2)->row_array();
                ?>
                '<?= $dateAssc2['jml_transaksi'] ?>',
              ],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(0, 255, 0, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)',
                  'rgba(0, 255, 0, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
        scales: {
        }
      }
  });
</script>