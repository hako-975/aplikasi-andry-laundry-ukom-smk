<style>
	@media print {
		.print {
			display: none;
		}
		a.scroll-to-top {
			display: none!important;
		}
	}
</style>
<div class="container my-3">
	<div class="row justify-content-center">
		<div class="col-3 text-center">
			<a href="" class="print btn btn-success"><i class="fas fa-fw fa-print"></i> Cetak</a>
		</div>
		<div class="col-3 text-center">
			<a href="<?= base_url('auth/login'); ?>" class="print btn btn-success"><i class="fas fa-fw fa-undo"></i> kembali</a>
		</div>
	</div>
</div>
<script>
	window.print();
</script>