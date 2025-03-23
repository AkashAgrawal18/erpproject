	<?php $this->view('header') ?>
	<?php $roll_id = $this->session->userdata('roll_id');
	$logged_user_type = $this->session->userdata('user_type'); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <!-- <section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-10">
						<h1><?= $pagename ?></h1>
					</div>
					<div class="col-sm-2 text-right">
						<a href="<?php echo site_url('Product/product_list') ?>" class="btn btn-sm btn-info">Product List </a>
					</div>
				</div>
			</div><!- - /.container-fluid - ->
		</section> -->

	    <!-- Main content -->
	    <section class="content">
	        <div class="container-fluid">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="card">
	                        <div id="flash-message" class="alert alert-danger d-none" role="alert"></div>
	                        <div class="card-body">
	                            <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT', 'PDT', 'Add')) { ?>
	                            <form id="edit-invoice-form">
	                                <!-- Invoice Details -->
	                                <div class="row">
	                                    <div class="col-md-3">
	                                        <label class="form-label">Invoice No.</label>
	                                        <input type="text" name="invoice_number" class="form-control" readonly
	                                            value="INV<?= time() ?>">
	                                    </div>
	                                    <div class="col-md-3">
	                                        <label class="form-label">Invoice Date</label>
	                                        <input type="date" name="invoice_date" class="form-control" required>
	                                    </div>
	                                    <div class="col-md-3 form-group">
	                                        <label class="form-label">From</label>
	                                        <select name="from_id" id="from_id" class="form-select form-control">
	                                            <option value="">Select From</option>
	                                            <?php foreach ($factories as $factory): ?>
	                                            <option value="<?= $factory->id ?>"> <?= $factory->name ?> </option>
	                                            <?php endforeach; ?>
	                                        </select>
	                                    </div>
	                                    <div class="col-md-3 form-group">
	                                        <label class="form-label">To (Entities Only)</label>
	                                        <select name="to_id" id="to_id" class="form-select form-control select2">
	                                            <option value="">Select To</option>
	                                            <?php foreach ($entities as $entity): ?>
	                                            <option value="<?= $entity->id ?>"
	                                                data-discount="<?= $entity->discount ?>">
	                                                <?= $entity->name ?>
	                                            </option>
	                                            <?php endforeach; ?>
	                                        </select>
	                                    </div>

	                                </div>
	                                <hr>
	                                <!-- Invoice Items -->
	                                <h4 class="mb-3">Invoice Items</h4>
	                                <table class="table table-bordered">
	                                    <thead>
	                                        <tr>
	                                            <th>S.N</th>
	                                            <th>Batch Number</th>
	                                            <th>Product</th>
	                                            <th>Quantity</th>
	                                            <th>Expiry</th>
	                                            <th>Rate</th>
	                                            <th>D. Per</th>
	                                            <th>D. Amt</th>
	                                            <th>Pre Tax Amt</th>
	                                            <th>CGST</th>
	                                            <th>SGST</th>
	                                            <th>Net Amount</th>
	                                            <th>Action</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody id="invoice-items">
	                                        <tr>
	                                            <td>1</td>
	                                            <td>
	                                                <select name="batch_id[]"
	                                                    class="form-select form-control batch-select ">
	                                                    <option value="">Select Batch</option>
	                                                    <?php foreach ($batches as $batch): ?>
	                                                    <option value="<?= $batch->id ?>"
	                                                        data-product-id="<?= $batch->product_id ?>"
	                                                        data-product-name="<?= $batch->product_name ?>"
	                                                        data-expiry="<?= $batch->expiry_date ?>"
	                                                        data-rate="<?= $batch->price ?>"
	                                                        data-stock="<?= $batch->available_stock ?>">
	                                                        <?= $batch->batch_number ?> - <?= $batch->product_name ?>
	                                                    </option>
	                                                    <?php endforeach; ?>
	                                                </select>
	                                            </td>
	                                            <td><input type="text" name="" class="form-control product-name" readonly>
	                                                <input type="hidden" class="product-id" name="product_id[]" />
	                                            </td>
	                                            <td><input type="number" name="quantity[]" class="form-control qty"
	                                                    min="1"></td>
	                                            <td><input type="text" name="expiry_date[]"
	                                                    class="form-control expiry-date" readonly></td>
	                                            <td><input type="text" name="rate[]" class="form-control rate" readonly>
	                                            </td>
	                                            <td><input type="text" name="discount_percentage[]"
	                                                    class="form-control discount" readonly></td>
	                                            <td><input type="text" name="discounted_amount[]"
	                                                    class="form-control discounted-amount" readonly></td>
	                                            <td><input type="text" name="pre_tax_amount[]"
	                                                    class="form-control pre-tax-amount" readonly></td>
	                                            <td><input type="text" name="cgst[]" class="form-control cgst"></td>
	                                            <td><input type="text" name="sgst[]" class="form-control sgst"></td>
	                                            <td><input type="text" name="net_amount[]" class="form-control net-amount"
	                                                    readonly></td>
	                                            <td><button type="button" class="btn btn-danger remove-item">X</button>
	                                            </td>
	                                        </tr>
	                                    </tbody>
	                                </table>
	                                <button type="button" class="btn btn-primary" id="add-item">Add Item</button>

	                                <!-- Summary & Payment Section -->
	                                <hr>

	                                <div class="row">
	                                    <div class="col-md-4">
	                                        <label class="form-label">Total Amount</label>
	                                        <input type="text" name="total_amount" id="total-amount" class="form-control"
	                                            readonly>
	                                    </div>
	                                    <div class="col-md-4">
	                                        <label class="form-label">Total Discount</label>
	                                        <input type="text" name="total_discount" id="total-discount"
	                                            class="form-control" readonly>
	                                    </div>
	                                    <div class="col-md-4">
	                                        <label class="form-label">Total Pre Tax Amount</label>
	                                        <input type="text" name="total_pre_tax_amount" id="total-pre-tax-amount"
	                                            class="form-control" readonly>
	                                    </div>
	                                    <div class="col-md-4">
	                                        <label class="form-label">Total IGST</label>
	                                        <input type="text" name="total_igst" id="total-igst" class="form-control"
	                                            value="0	" readonly>
	                                    </div>
	                                    <div class="col-md-4">
	                                        <label class="form-label">Total CGST</label>
	                                        <input type="text" name="total_cgst" id="total-cgst" class="form-control"
	                                            readonly>
	                                    </div>
	                                    <div class="col-md-4">
	                                        <label class="form-label">Total SGST</label>
	                                        <input type="text" name="total_sgst" id="total-sgst" class="form-control"
	                                            readonly>
	                                    </div>
	                                    <div class="col-md-4">
	                                        <label class="form-label">Net Amt</label>
	                                        <input type="text" name="final_amount" id="final-amount" class="form-control"
	                                            readonly>
	                                    </div>
	                                    <div class="col-md-4">
	                                        <label class="form-label">Amount paid</label>
	                                        <input type="text" name="amount_paid" id="amount-paid" class="form-control">
	                                    </div>
	                                    <div class="col-md-4">
	                                        <label class="form-label">Due Amount</label>
	                                        <input type="text" name="due_amount" id="due-amount" class="form-control"
	                                            readonly>
	                                    </div>
	                                    <div class="col-md-4">
	                                        <label class="form-label">Due Date</label>
	                                        <input type="date" name="due_date" class="form-control" required>
	                                    </div>

	                                    <div class="col-md-4">
	                                        <label class="form-label">Remarks</label>
	                                        <input type="text" name="remarks" id="remarks" class="form-control" required>
	                                    </div>
	                                </div>
	                                <button type="submit" class="btn btn-success mt-3">Submit Invoice</button>
	                            </form>

	                            <?php } ?>
	                        </div>
	                        <!-- /.card-body -->
	                    </div>
	                    <!-- /.card -->
	                </div>
	            </div>
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