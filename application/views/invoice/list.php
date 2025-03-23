<?php $this->view('header') ?>
<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1><?= $pagename ?></h1>
				</div>
				<div class="col-sm-6 text-right">
					<a href="<?php echo site_url('invoice/add') ?>" class="btn btn-sm btn-info btn-vsm"><i class="fa fa-plus-circle"></i> Add New Invoice</a>

				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<!-- /.card-header -->
						<div class="card-body">
						<table id="invoiceTable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Invoice No</th>
									<th>From</th>
									<th>To</th>
									<th>Invoice Date</th>
									<th>Total Amount</th>
									<th>Due Amount</th>
									<th>Due Date</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						</div>
						<!-- /.card-body -->

					</div>

				</div>
				<!-- /.col -->

			</div>
			<!-- /.row -->

		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->view('footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_hr') ?>
<script>
	var base_url = '<?= base_url(); ?>';	

	console.log(base_url);
</script>
<script src="<?= base_url('assets/js/invoice.js'); ?>"></script>