<?php $this->view('Includes/header') ?>
<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type');
$user_store = $this->session->userdata('user_store'); 
$taxper = (int)get_settings('m_app_tax'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1><?= $pagename ?></h1>
                </div>
                <div class="col-sm-2 text-right">
                    <?php if ($logged_user_type == 1 || has_perm($roll_id, 'INV', 'INV', 'List')) { ?>
                        <a href="<?php echo site_url('Invoice/invoice_list') ?>" class="btn btn-sm btn-info">Invoice List </a>
                    <?php } ?>
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

                        <div class="card-body">
                            <?php if (!empty($edit_value)) {
                                $m_inv_id = $edit_value->m_inv_id;
                                $m_inv_entity = $edit_value->m_inv_entity;
                                $m_entity_mobile = $edit_value->m_entity_mobile;
                                $m_entity_name = $edit_value->m_entity_name;
                                $m_entity_type = $edit_value->m_entity_type;
                                $m_inv_date = $edit_value->m_inv_date;
                                $m_inv_store = $edit_value->m_inv_store;
                                $m_inv_amount = $edit_value->m_inv_amount;
                                $m_inv_dispr = $edit_value->m_inv_dispr;
                                $m_inv_discount = $edit_value->m_inv_discount;
                                $m_inv_pretax_amount = $edit_value->m_inv_pretax_amount;
                                $m_inv_cgst = $edit_value->m_inv_cgst;
                                $m_inv_sgst = $edit_value->m_inv_sgst;
                                $m_inv_igst = $edit_value->m_inv_igst;
                                $m_inv_totalamt = $edit_value->m_inv_totalamt;
                                $m_inv_remarks = $edit_value->m_inv_remarks;
                                $item_data = $edit_value->item_data;
                                $fild = "Edit";
                            } else {
                                $m_inv_id = "";
                                $m_inv_entity = "";
                                $m_entity_mobile = "";
                                $m_entity_name = "";
                                $m_entity_type = "";
                                $m_inv_date = date('Y-m-d');
                                $m_inv_store = $user_store;
                                $m_inv_amount = 0;
                                $m_inv_dispr = 0;
                                $m_inv_discount = 0;
                                $m_inv_pretax_amount = 0;
                                $m_inv_cgst = 0;
                                $m_inv_sgst = 0;
                                $m_inv_igst = 0;
                                $m_inv_totalamt = 0;
                                $m_inv_remarks = "";
                                $item_data = array();
                                $fild = "Add";
                            } ?>
                            <?php if ($logged_user_type == 1 || has_perm($roll_id, 'INV', 'INV', $fild)) { ?>

                                <form method="post" action="#" id="frm-add-invoice">

                                    <div class="row mb-1 g-3">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Date <span class="text-danger">*</span></label>
                                                <input type="hidden" name="m_inv_taxper" id="m_inv_taxper" value="<?= $taxper ?>">
                                                <input type="hidden" name="m_inv_id" id="m_inv_id" value="<?= $m_inv_id ?>">
                                                <input type="date" max="<?= date('Y-m-d') ?>" name="m_inv_date" id="m_inv_date" class="form-control" required="" value="<?= $m_inv_date ?>">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Store/Warehouse <span class="text-danger">*</span></label>
                                                <select name="m_inv_store" id="m_inv_store" class="form-control select2" required>
                                                    <option value="">Select Warehouse</option>
                                                    <?php if (!empty($store_value)) {
                                                        foreach ($store_value as $key) {
                                                            $op = $m_inv_store == $key->m_str_id ? 'selected' : '';
                                                            $stype = $key->m_str_type == 1 ? 'Store' : 'Warehouse';
                                                            if (!empty($user_store)) {
                                                                if ($user_store == $key->m_str_id) {
                                                                    echo '<option value="' . $key->m_str_id . '" ' . $op . ' data-stype="' . $key->m_str_type . '" data-sstate="' . $key->m_state . '">' . $key->m_str_name . ' (' . $stype . ')' . '</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="' . $key->m_str_id . '" ' . $op . ' data-stype="' . $key->m_str_type . '" data-sstate="' . $key->m_state . '">' . $key->m_str_name . ' (' . $stype . ')' . '</option>';
                                                            }
                                                        }
                                                    } ?>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Customer Mobile <span class="text-danger">*</span></label>
                                                <input list="cust_datalist" id="m_entity_mobile" name="m_entity_mobile" placeholder="Enter Mobile" class="form-control" value="<?= $m_entity_mobile ?>">
                                                <datalist id="cust_datalist">
                                                    <?php
                                                    if (!empty($entities_value)) {
                                                        foreach ($entities_value as $Vcust) {
                                                    ?>
                                                            <option value="<?= $Vcust->m_entity_mobile; ?>" data-custid="<?= $Vcust->m_entity_id ?>" data-custname="<?= $Vcust->m_entity_name ?>" data-custtype="<?= $Vcust->m_entity_type ?>" data-custdis="<?= $Vcust->m_entity_discount ?>" data-custstate="<?= $Vcust->m_entity_state ?>"><?= $Vcust->m_entity_mobile . ' - ' . $Vcust->m_entity_name; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Customer Name <span class="text-danger">*</span></label>
                                                <input id="m_entity_type" name="m_entity_type" type="hidden" value="<?= $m_entity_type ?>">
                                                <input id="m_inv_entity" name="m_inv_entity" type="hidden" value="<?= $m_inv_entity ?>">
                                                <input id="m_entity_discount" type="hidden" value="0" >
                                                <input id="m_store_state" type="hidden" value="0" >
                                                <input id="m_entity_state" type="hidden" value="0" >
                                                <input id="m_entity_name" name="m_entity_name" placeholder="Enter Name" class="form-control" value="<?= $m_entity_name ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-2">

                                            <div class="table-responsive">

                                                <table class="table table-striped table-bordered dt-responsive nowra">
                                                    <thead>
                                                        <th>Sn</th>
                                                        <th>Product Name</th>
                                                        <th>Batch Number</th>
                                                        <th>Package</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Total</th>
                                                        <th>CGST</th>
                                                        <th>SGST</th>
                                                        <th>IGST</th>
                                                        <th>Discount</th>
                                                        <th>Net Total</th>
                                                        <th></th>
                                                    </thead>
                                                    <tbody id="tableblock">
                                                        <?php
                                                        if (!empty($id)) {
                                                            $cou = 0;
                                                            foreach ($item_data as $kry) {
                                                                $cou++;
                                                        ?>
                                                                <tr id="rowcot<?= $cou ?>">
                                                                    <td id="rowcount<?= $cou ?>"><?= $cou ?></td>
                                                                    <td id="item_name<?= $cou ?>"><?= $kry->m_pro_name ?></td>
                                                                    <td id="item_batch<?= $cou ?>"><?= $kry->m_batch_number ?></td>
                                                                    <td id="item_pckage<?= $cou ?>"><?= $kry->package_name ?> - <?= $kry->size_name ?></td>
                                                                    <td>
                                                                        <input type="hidden" name="inv_item_id[]" id="inv_item_id<?= $cou ?>" value="<?= $kry->inv_item_id ?>">
                                                                        <input type="hidden" name="inv_item_stcktrans[]" id="inv_item_stcktrans<?= $cou ?>" value="<?= $kry->inv_item_stcktrans ?>">
                                                                        <input type="hidden" name="inv_item_product[]" id="inv_item_product<?= $cou ?>" value="<?= $kry->inv_item_product ?>">
                                                                        <input type="hidden" name="inv_item_batch[]" id="inv_item_batch<?= $cou ?>" data-avlqty="<?= ($kry->balance_qty + $kry->inv_item_qty) ?>" value="<?= $kry->inv_item_batch ?>">
                                                                        <input type="number" id="inv_item_qty<?= $cou ?>" name="inv_item_qty[]" class="prodqty checkqty calclss" data-count="<?= $cou ?>" style="width:80px" value="<?= $kry->inv_item_qty ?>">
                                                                        <input type="hidden" name="pre_item_qty[]" value="<?= $kry->inv_item_qty ?>">
                                                                    </td>
                                                                    <td><input type="number" id="inv_item_rate<?= $cou ?>" name="inv_item_rate[]" class="prodrate calclss " data-count="<?= $cou ?>" style="width:80px" value="<?= $kry->inv_item_rate ?>">
                                                                        <input type="hidden" id="inv_item_pretaxamt<?= $cou ?>" name="inv_item_pretaxamt[]" value="<?= $kry->inv_item_pretaxamt ?>" class="prodstotal">
                                                                        <input type="hidden" id="inv_item_cgst<?= $cou ?>" name="inv_item_cgst[]" value="<?= $kry->inv_item_cgst ?>" class="prodcgst">
                                                                        <input type="hidden" id="inv_item_sgst<?= $cou ?>" name="inv_item_sgst[]" value="<?= $kry->inv_item_sgst ?>" class="prodsgst">
                                                                        <input type="hidden" id="inv_item_disamt<?= $cou ?>" name="inv_item_disamt[]" value="<?= $kry->inv_item_disamt ?>" class="proddisamt">
                                                                        <input type="hidden" id="inv_item_disper<?= $cou ?>" name="inv_item_disper[]" value="<?= $kry->inv_item_disper ?>" class="prodisper">
                                                                        <input type="hidden" id="inv_item_igst<?= $cou ?>" name="inv_item_igst[]" value="<?= $kry->inv_item_igst ?>" class="prodigst">
                                                                        <input type="hidden" id="inv_item_netamt<?= $cou ?>" name="inv_item_netamt[]" value="<?= $kry->inv_item_netamt ?>" class="prodntotal">
                                                                    </td>
                                                                    <td id="item_pretaxamt<?= $cou ?>"><?= $kry->inv_item_pretaxamt ?></td>
                                                                    <td id="item_cgst<?= $cou ?>"><?= $kry->inv_item_cgst != 0 ? $taxper/2 :'0'; ?></td>
                                                                    <td id="item_sgst<?= $cou ?>"><?=  $kry->inv_item_sgst != 0 ? $taxper/2 :'0'; ?></td>
                                                                    <td id="item_igst<?= $cou ?>"><?= $kry->inv_item_igst != 0 ? $taxper :'0'; ?></td>
                                                                    <td id="item_custdis<?= $cou ?>"><?= $kry->inv_item_disper ?></td>
                                                                    <td id="item_netamt<?= $cou ?>"><?= $kry->inv_item_netamt ?></td>
                                                                    <td> <button type="button" class="btn btn-danger px-1 py-0 delete-invoice" data-dtype="2" data-value="<?= $kry->inv_item_id ?>" title="Delete"><i class="fa fa-trash"></i></button></td>
                                                                </tr>

                                                        <?php
                                                            }
                                                            echo '<input type="hidden" id="rowunt" value="' . $cou . '">';
                                                        }
                                                        ?>

                                                        <input type="hidden" id="rowunt" value="0">
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="4">Total </td>
                                                            <td id="qty_total"></td>
                                                            <td></td>
                                                            <td id="sub_total"></td>
                                                            <td id="cgst_total"></td>
                                                            <td id="sgst_total"></td>
                                                            <td id="igst_total"></td>
                                                            <td id="dis_total"></td>
                                                            <td id="grand_total"></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <input list="items_datalist" id="item_serch_inp" placeholder="Add Product" class="form-control" style="width: 50%; margin-bottom:5px;">

                                                <datalist id="items_datalist">
                                                    <?php
                                                    if (!empty($store_batchvalue)) {
                                                        foreach ($store_batchvalue as $Vitem) {
                                                    ?>
                                                            <option value="<?= $Vitem->stk_trans_id; ?>" data-prodname="<?= $Vitem->m_pro_name ?>" data-prodid="<?= $Vitem->m_batch_pro_id ?>" data-batchid="<?= $Vitem->m_batch_id ?>" data-batchno="<?= $Vitem->m_batch_number ?>" data-avlbal="<?= $Vitem->balance_qty ?>" data-pckgname="<?= $Vitem->package_name ?>" data-sizename="<?= $Vitem->size_name ?>" data-warehseid="<?= $Vitem->stk_trans_to ?>" data-price="<?= $Vitem->m_batch_price ?>"><?= $Vitem->m_pro_name . ' - ' . $Vitem->m_batch_number; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </datalist>

                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group row">
                                                <label for="amount" class="col-sm-4 col-form-label">Amount</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="m_inv_amount" id="m_inv_amount" class="form-control" readonly value="<?= $m_inv_amount ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="amount" class="col-sm-4 col-form-label">Discount</label>
                                                <div class="col-sm-3">
                                                    <input type="text" name="m_inv_dispr" id="m_inv_dispr" class="form-control" value="<?= $m_inv_dispr ?>" placeholder="Eg. 8%">
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" name="m_inv_discount" id="m_inv_discount" class="form-control" readonly value="<?= $m_inv_discount ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="amount" class="col-sm-4 col-form-label">Sub Total</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="m_inv_pretax_amount" id="m_inv_pretax_amount" class="form-control" readonly value="<?= $m_inv_pretax_amount ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="amount" class="col-sm-4 col-form-label">Total Tax</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="m_inv_igst" id="m_inv_igst" value="<?= $m_inv_igst ?>">
                                                    <input type="hidden" name="m_inv_cgst" id="m_inv_cgst" value="<?= $m_inv_cgst ?>">
                                                    <input type="hidden" name="m_inv_sgst" id="m_inv_sgst" value="<?= $m_inv_sgst ?>">
                                                    <input type="text" name="total_tax" id="total_tax" class="form-control" readonly value="<?= $m_inv_cgst + $m_inv_sgst ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="amount" class="col-sm-4 col-form-label">Grand Total</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="m_inv_totalamt" id="m_inv_totalamt" class="form-control" readonly value="<?= $m_inv_totalamt ?>">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="remark">Remark</label>
                                                <textarea name="m_inv_remarks" id="remark" rows="4" class="form-control" placeholder="Enter Remark"><?= $m_inv_remarks ?></textarea>
                                            </div>
                                            <div class="d-flex">
                                                <button type="submit" id="btn-add-invoice" class="btn btn-info mr-2">Save</button>
                                                <a href="<?php echo site_url('Invoice/invoice_list') ?>" class="btn btn-danger">Cancel</a>
                                            </div>
                                        </div>

                                    </div>
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

<?php $this->view('Includes/footer')  ?>
<?php $this->view('js/js_custom') ?>
<?php $this->view('Invoice/js/invoice_js') ?>