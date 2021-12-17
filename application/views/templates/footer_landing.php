    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/jquery/popper.min.js"></script>

    <!-- Plug In JavaScript -->
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/fancybox/jquery.fancybox.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/fontawesome/js/all.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.easing.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/select2/select2.min.js"></script>
    


    <!-- Config Plug In JavaScript -->
    <script src="<?= base_url(); ?>assets/js/config-datatables.js"></script>
    <script src="<?= base_url(); ?>assets/js/config-fancybox.js"></script>
    <script src="<?= base_url(); ?>assets/js/config-sweetalert2.js"></script>
    <script src="<?= base_url(); ?>assets/js/config-select2.js"></script>


    <script>
        // event pada saat link diklik
        $('.page-scroll').on('click', function(e){

            // ambil isi href
            var tujuan = $(this).attr('href');
            // tangkap elemen yg bersangkutan
            var elemenTujuan = $(tujuan);

            // pindahkan scroll
            $('html, body').animate({
                scrollTop: elemenTujuan.offset().top - 65
            }, 1250, 'easeInOutExpo');

            e.preventDefault();
        });
    </script>
  </body>
</html>