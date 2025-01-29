<?php $this->view('header') ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->

	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Application Setting</h1>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<form method="POST" action="#" id="frm-update" enctype="multipart/form-data">
				<!-- SELECT2 EXAMPLE -->
				<div class="card card-default">
					<div class="card-header">
						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove">
								<i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row">
							<input type="hidden" name="appid" value="<?php echo $app_details[0]->m_app_id ?>">
							<div class="col-md-6">
								<div class="form-group">
									<label>Application Name</label>
									<input type="text" class="form-control" value="<?php echo $app_details[0]->m_app_name; ?>" placeholder="Application Name" name="m_app_name">
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<label>Application Contact</label>
									<input type="text" value="<?php echo $app_details[0]->m_app_mobile  ?>" name="m_app_contact" class="form-control" placeholder="Application Contact">
								</div>
								<!-- /.form-group -->
							</div>
							<!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Application Alternative Contact</label>
									<input type="text" value="<?php echo $app_details[0]->m_app_alt_mobile  ?>" name="m_app_alt_contact" class="form-control" placeholder="Application Alternative Contact">
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<label>Application Mail</label>
									<input type="text" value="<?php echo $app_details[0]->m_app_email  ?>" name="m_app_mail" class="form-control" placeholder="Application Mail">
								</div>
								<!-- /.form-group -->
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Application Address</label>
									<textarea class="form-control" name="m_app_address" placeholder="Application Address"><?php echo $app_details[0]->m_app_address ?></textarea>
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<label>Instagram</label>
									<input type="text" name="m_app_instagram" value="<?php echo $app_details[0]->m_app_insta; ?>" class="form-control" placeholder="Instagram">
								</div>

							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label> Facebook</label>
									<input type="text" value="<?php echo $app_details[0]->m_app_fb; ?>" name="m_app_fesbook" class="form-control" placeholder="Facebook">
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<label>Whatsapp</label>
									<input type="text" value="<?php echo $app_details[0]->m_app_whatsapp; ?>" name="m_app_whatsapp" class="form-control" placeholder="Whatsapp">
								</div>
								<!-- /.form-group -->
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label> Twitter</label>
									<input type="text" value="<?php echo $app_details[0]->m_app_twitter; ?>" name="m_app_twitter" class="form-control" placeholder="Twitter">
								</div>
								<!-- /.form-group -->
								<div class="form-group">
									<label>Linkedin</label>
									<input type="text" value="<?php echo $app_details[0]->m_app_linkedin; ?>" name="m_app_linkedin" class="form-control" placeholder="Linkedin">
								</div>

								<!-- /.form-group -->
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label> Youtube</label>
									<input type="text" value="<?php echo $app_details[0]->m_app_youtube; ?>" name="m_app_youtude" class="form-control" placeholder="Youtube">
								</div>
							</div>
							<!-- /.row -->

						</div>
						<!-- /.card -->
					</div>
					<!-- SELECT2 EXAMPLE -->
					<div class="card card-default">
						<div class="card-header">
							<h3 class="card-title">Image Upload</h3>

							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse">
									<i class="fas fa-minus"></i>
								</button>
								<button type="button" class="btn btn-tool" data-card-widget="remove">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<?php
										if (!empty($app_details[0]->m_app_logo) && file_exists('uploads/user/' . $app_details[0]->m_app_logo)) {
											$applogo = base_url('uploads/user/' . $app_details[0]->m_app_logo);
										} else {
											$applogo = base_url('uploads/user/default.jpg');
										}
										?> <img style="max-height:120px" src="<?php echo $applogo ?>" class="img-responsive img-thumbnail" /><br>
										<label class="control-label">Color Logo</label>
										<input type="hidden" name="applogo" value="<?php echo $app_details[0]->m_app_logo ?>">
										<input type="file" name="m_app_logo" class="form-control">
									</div>
									<!-- /.form-group -->
									<div class="form-group">
										<?php
										if (!empty($app_details[0]->m_app_icon) && file_exists('uploads/user/' . $app_details[0]->m_app_icon)) {
											$appfavi = base_url('uploads/user/' . $app_details[0]->m_app_icon);
										} else {
											$appfavi = base_url('uploads/user/default.jpg');
										}
										?>
										<img style="max-height:50px" src="<?php echo $appfavi ?>" class="img-responsive img-thumbnail" /><br>
										<label class="control-label">Favicon logo</label>
										<input type="hidden" name="appfavicon" value="<?php echo $app_details[0]->m_app_icon ?>">
										<input type="file" name="m_app_icon" class="form-control">
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
								<div class="col-md-6">
									<div class="form-group">
										<?php
										if (!empty($app_details[0]->m_app_black_logo) && file_exists('uploads/user/' . $app_details[0]->m_app_black_logo)) {
											$appblack_logo = base_url('uploads/user/' . $app_details[0]->m_app_black_logo);
										} else {
											$appblack_logo = base_url('uploads/user/default.jpg');
										}
										?>
										<img src="<?php echo $appblack_logo ?>" class="img-responsive img-thumbnail" /><br>
										<label class="control-label">Black Logo</label>
										<input type="hidden" name="app_black_logo" value="<?php echo $app_details[0]->m_app_black_logo ?>">
										<input type="file" name="m_app_black_logo" class="form-control">
									</div>
									<!-- /.form-group -->
									<div class="form-group">
										<?php
										if (!empty($app_details[0]->m_app_white_logo) && file_exists('uploads/user/' . $app_details[0]->m_app_white_logo)) {
											$appwhite_logo = base_url('uploads/user/' . $app_details[0]->m_app_white_logo);
										} else {
											$appwhite_logo = base_url('uploads/user/default.jpg');
										}
										?>
										<img src="<?php echo $appwhite_logo ?>" class="img-responsive img-thumbnail" /><br>
										<label class="control-label">White Logo</label>
										<input type="hidden" name="app_white_logo" value="<?php echo $app_details[0]->m_app_white_logo ?>">
										<input type="file" name="m_app_white_logo" class="form-control">
									</div>
									<!-- /.form-group -->
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
						<!-- /.card-body -->

					</div>
					<!-- /.card -->

				</div>
				<div class="row p-3">
					<div class="form-layout-submit text-center">
						<button type="submit" id="btn-update" class="btn btn-block btn-info">Update Settings</button>
					</div>
				</div>
			</form>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->

</div>
<!-- /.content-wrapper -->

<?php $this->view('footer');
$this->view('js/profile_js');

?>
