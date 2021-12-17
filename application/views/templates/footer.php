        </div>
        <!-- ./Container-fluid -->
      </div>
        <!-- ./Content -->
    </div>
    <!-- ./wrapper -->

    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    
	<!-- Sweet Alert 2 -->
	<div class="flashdata" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
	<div class="flashdata-success" data-flashdata="<?= $this->session->flashdata('message-success'); ?>"></div>
	<div class="flashdata-failed" data-flashdata="<?= $this->session->flashdata('message-failed'); ?>"></div>
	<!-- ./Sweet Alert 2 -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('assets/vendor/jquery/jquery-3.4.1.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery/jquery.easing.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/jquery/popper.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/chartjs/Chart.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/datatables/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/datatables/datatables/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/fancybox/jquery.fancybox.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/fontawesome/js/all.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
    <script src="<?= base_url('assets/vendor/select2/select2.min.js'); ?>"></script>


    <!-- Config JavaScript -->
	<script src="<?= base_url('assets/js/config-datatables.js'); ?>"></script>
	<script src="<?= base_url('assets/js/config-fancybox.js'); ?>"></script>
    <script src="<?= base_url('assets/js/config-sweetalert2.js'); ?>"></script>
    <script src="<?= base_url('assets/js/config-sidebar.js'); ?>"></script>
    <script src="<?= base_url('assets/js/config-select2.js'); ?>"></script>

  </body>
</html>