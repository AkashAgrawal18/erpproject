<?php $this->view('Includes/header') ?>

<?php $roll_id = $this->session->userdata('roll_id');
$logged_user_type = $this->session->userdata('user_type'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-10">
					<h3><?= $pagename ?></h3>
				</div>
				<div class="col-sm-2 text-right">
					<?php if ($logged_user_type == 1 || has_perm($roll_id, 'LDS', 'FWP', 'List')) { ?>
						<a href="<?php echo site_url('Leads/lead_list') ?>" class="btn btn-sm btn-info">Lead List </a>
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
							<?php if ($logged_user_type == 1 || has_perm($roll_id, 'LDS', 'FWP', 'Add')) { ?>

								<form method="post" action="#" id="frm-add-follow">
									<?php if (!empty($edit_value)) {
										$id = $edit_value->m_follow_id;
										$follow_lead = $edit_value->m_follow_lead;
                                        $follow_date = $edit_value->m_follow_date;
                                        $follow_sample = $edit_value->m_follow_sample;
                                        $follow_piece = $edit_value->m_follow_piece;
                                        $follow_product = $edit_value->m_follow_product;
                                        $follow_next = $edit_value->m_follow_next;
                                        $follow_remark = $edit_value->m_follow_remark;
                                        $follow_assigned = $edit_value->m_follow_assigned;
                                        $follow_status = $edit_value->m_follow_status;
									} else {
										$id = '';
										$follow_lead = '';
                                        $follow_date = date('Y-m-d');
                                        $follow_sample = '';
                                        $follow_piece = '';
                                        $follow_product = '';
                                        $follow_next = '';
                                        $follow_remark = '';
                                        $follow_assigned = '';
                                        $follow_status = '';
									} ?>

									<div class="row">
										<input type="hidden" name="m_follow_id" id="m_follow_id" value="<?= $id ?>">
                                        
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Date<span class="text-danger">*</span></label>
												<input type="date" max="<?= date('Y-m-d')?>" name="m_follow_date" id="m_follow_date" value="<?= $follow_date ?>" required class="form-control">
											</div>
										</div>

                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Is Sample Given <span class="text-danger">*</span></label>
												<select name="m_follow_sample" id="m_follow_sample" class="form-control select2" required>
                                                <option value="0" <?php if($follow_sample == 0) echo 'selected' ?>>No</option>
													<option value="1" <?php if($follow_sample == 1) echo 'selected' ?>>Yes</option>
												</select>
											</div>
										</div>
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Product</label>
												<select name="m_follow_product" id="m_follow_product" class="form-control" title="Select Product">
												<?php
												if (!empty($pro_value)) {
													foreach ($pro_value as $prod) {
												?>
														<option value="<?php echo $prod->m_pro_id; ?>" <?php if ($follow_product == $prod->m_pro_id) echo 'selected'; ?>><?php echo $prod->m_pro_name; ?></option>
												<?php
													}
												}
												?>
												</select>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label>Piece</label>
												<input type="number" name="m_follow_piece" id="m_follow_piece" class="form-control" readonly placeholder="Enter Piece Given" value="<?= $follow_piece; ?>">
											</div>
										</div>
                                       
                                        <div class="col-sm-3 <?php if(empty($edit_value)) echo 'd-none' ?>">
											<div class="form-group">
												<label>Status </label>
												<select name="m_follow_status" id="m_status" class="form-control select2" title="Select Status" >
												<option value="">Select Status</option>
												<?php
												if (!empty($status_value)) {
													foreach ($status_value as $stus) {
												?>
														<option value="<?php echo $stus->m_status_id; ?>" <?php if ($follow_status == $stus->m_status_id) echo 'selected'; ?>><?php echo $stus->m_status_name; ?></option>
												<?php
													}
												}
												?>
											</select>
											</div>
										</div>
                                        <div class="col-sm-3">
											<div class="form-group">
												<label>Next Followup </label>
												<input type="date" min="<?= $follow_next ?: date('Y-m-d')?>" name="m_follow_next" id="m_follow_next" value="<?= $follow_next ?>" class="form-control">
											</div>
										</div>
										
										<div class="col-sm-12">
											<div class="form-group">
												<label>Remark </label>
												<textarea class="form-control" name="m_follow_remark" id="m_follow_remark"><?= $follow_remark ?></textarea>
											</div>
										</div>
										
										
									</div>
									<div class="row">
										<div class="col-md-3">
											<div class="form-layout-submit">
												<button type="submit" id="btn-add-follow" class="btn btn-block btn-info">Submit</button>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-layout-submit">
												<a href="<?php echo site_url('Leads/add_followup') ?>" class="btn btn-block btn-danger">Cancel </a>

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
<?php $this->view('Leads/js/js_lead') ?>
