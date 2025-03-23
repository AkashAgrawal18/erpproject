<?php $this->view('header') ?>
<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type'); ?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div id="flash-message" class="alert alert-danger d-none" role="alert"></div>
                        <div class="card-body">
                            <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT', 'PDT', 'Edit')) { ?>
                            <form id="edit-invoice-form">
                                <input type="hidden" name="invoice_id" id="invoice_id" value="<?= $invoice->id ?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Invoice No.</label>
                                        <input type="text" name="invoice_number" id="invoice_number"
                                            value="<?= $invoice->invoice_number ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Invoice Date</label>
                                        <input type="date" name="invoice_date" id="invoice_date"
                                            value="<?= $invoice->invoice_date ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">From</label>
                                        <select name="from_id" id="from_id" class="form-control">
                                            <option value="">Select From</option>
                                            <?php foreach ($factories as $factory): ?>
                                            <option value="<?= $factory->id ?>"
                                                <?= ($factory->id == $invoice->from_id) ? 'selected' : '' ?>>
                                                <?= $factory->name ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">To (Entities Only)</label>
                                        <select name="to_id" id="to_id" class="form-control select2">
                                            <option value="">Select To</option>
                                            <?php foreach ($entities as $entity): ?>
                                            <option value="<?= $entity->id ?>" data-discount="<?= $entity->discount ?>"
                                                <?= ($entity->id == $invoice->to_id) ? 'selected' : '' ?>>
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
                                        <?php if (!empty($invoice_items)): ?>
                                        <?php foreach ($invoice_items as $key => $item): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td>
                                                <select name="batch_id[]" class="form-select form-control batch-select">
                                                    <option value="">Select Batch</option>
                                                    <?php foreach ($batches as $batch): ?>
                                                    <option value="<?= $batch->id ?>"
                                                        data-product-id="<?= $batch->product_id ?>"
                                                        data-product-name="<?= $batch->product_name ?>"
                                                        data-expiry="<?= $batch->expiry_date ?>"
                                                        data-rate="<?= $batch->price ?>"
                                                        data-stock="<?= $batch->available_stock ?>"
                                                        <?= $batch->id == $item->batch_id ? 'selected' : '' ?>>
                                                        <?= $batch->batch_number ?> - <?= $batch->product_name ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control product-name"
                                                    value="<?= $item->product_name ?>" readonly>
                                                <input type="hidden" class="product-id" name="product_id[]"
                                                    value="<?= $item->product_id ?>">
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[]" class="form-control qty"
                                                    value="<?= $item->quantity ?>" min="1">
                                            </td>
                                            <td>
                                                <input type="text" name="expiry_date[]" class="form-control expiry-date"
                                                    value="<?= $item->expiry_date ?>" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="rate[]" class="form-control rate"
                                                    value="<?= $item->rate ?>" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="discount_percentage[]"
                                                    class="form-control discount"
                                                    value="<?= $item->discount_percentage ?>" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="discounted_amount[]"
                                                    class="form-control discounted-amount"
                                                    value="<?= $item->discounted_amount ?>" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="pre_tax_amount[]"
                                                    class="form-control pre-tax-amount"
                                                    value="<?= $item->pre_tax_amount ?>" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="cgst[]" class="form-control cgst"
                                                    value="<?= $item->cgst ?>">
                                            </td>
                                            <td>
                                                <input type="text" name="sgst[]" class="form-control sgst"
                                                    value="<?= $item->sgst ?>">
                                            </td>
                                            <td>
                                                <input type="text" name="net_amount[]" class="form-control net-amount"
                                                    value="<?= $item->net_amount ?>" readonly>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger remove-item">X</button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else: ?>
                                        <tr>
                                            <td colspan="13" class="text-center">No items found.</td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <button type="button" class="btn btn-primary" id="add-item">Add Item</button>

                                <!-- Summary & Payment Section -->
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Total Amount</label>
                                        <input type="text" name="total_amount" id="total-amount" class="form-control"
                                            readonly value="<?= $invoice->total_amount ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Total Discount</label>
                                        <input type="text" name="total_discount" id="total-discount"
                                            class="form-control" readonly value="<?= $invoice->total_discount ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Total Pre Tax Amount</label>
                                        <input type="text" name="total_pre_tax_amount" id="total-pre-tax-amount"
                                            class="form-control" readonly value="<?= $invoice->total_pre_tax_amount ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Total IGST</label>
                                        <input type="text" name="total_igst" id="total-igst" class="form-control"
                                            value="0	" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Total CGST</label>
                                        <input type="text" name="total_cgst" id="total-cgst" class="form-control"
                                            readonly value="<?= $invoice->total_cgst ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Total SGST</label>
                                        <input type="text" name="total_sgst" id="total-sgst" class="form-control"
                                            readonly value="<?= $invoice->total_sgst ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Net Amt</label>
                                        <input type="text" name="final_amount" id="final-amount" class="form-control"
                                            readonly value="<?= $invoice->final_amount ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Amount Paid</label>
                                        <input type="text" name="amount_paid" id="amount-paid" class="form-control"
                                            value="<?= $invoice->amount_paid ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Due Amount</label>
                                        <input type="text" name="due_amount" id="due-amount" class="form-control"
                                            readonly value="<?= $invoice->due_amount ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Due Date</label>
                                        <input type="date" name="due_date" id="due_date" class="form-control" required
                                            value="<?= $invoice->due_date ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Remarks</label>
                                        <input type="text" name="remarks" id="remarks" class="form-control"
                                            value="<?= $invoice->remarks ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mt-3">Update Invoice</button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->view('footer') ?>
<script>
var base_url = '<?= base_url(); ?>';

$(document).ready(function() {


});
</script>
<script src="<?= base_url('assets/js/invoice.js'); ?>"></script>