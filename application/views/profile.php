<?php $this->view('header') ?>


<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Profile</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
						<li class="breadcrumb-item active">User Profile</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			
		<form method="post" action="#" id="frm-update-profile" enctype="multipart/form-data"  >
			<div class="row">
				<div class="col-md-3">
					<!-- Profile Image -->
					<div class="card card-primary card-outline">
						<div class="card-body box-profile">
							<div class="text-center">
								<?php
								$admin_img = base_url('uploads/emp/logo.jpg');
								if (!empty($user_dtl[0]->m_emp_pic)) {
									$img_title = $user_dtl[0]->m_emp_pic;
									if (file_exists('uploads/emp/' . $img_title)) {
										$admin_img = base_url('uploads/emp/') . $img_title;
									}
								}
								?>
								<img class="profile-user-img img-fluid img-circle"
									src="<?php echo $admin_img;  ?>"
									alt="profile picture" id="uploadPreview">
								<input type="hidden" name="pre_m_admin_img" value="<?php echo $user_dtl[0]->m_emp_pic; ?>">
							</div>
							<h3 class="profile-username text-center"><?php echo $user_dtl[0]->m_emp_name; ?></h3> 
							<button type="button" id="uploadImagebtn" class="btn btn-primary btn-block"> Upload New Photo </button>
							<input type="file" id="uploadImage" class="account-file-input" name="m_admin_img" onchange="PreviewImage();"
								hidden accept="image/png, image/jpeg, image/jpg" />
						</div> 
					</div>
					<!-- /.card -->


					<!-- /.card -->
				</div>
				<!-- /.col -->
				<div class="col-md-9">
					<div class="card">
						<div class="card-header p-2">
							<ul class="nav nav-pills"> 
								<li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
							</ul>
						</div><!-- /.card-header -->
						<div class="card-body">
							<div class="tab-content">

								<!-- /.tab-pane -->

								<div class="tab-pane active" id="settings"> 

									

										<div class="form-group row">
											<label for="inputName" class="col-sm-2 col-form-label">Admin Name</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="inputName" name="m_admin_name" value="<?php echo $user_dtl[0]->m_emp_name; ?>" placeholder="enter admin name"
													required />
											</div>
										</div>
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="inputEmail" name="m_admin_email" value="<?php echo $user_dtl[0]->m_emp_email; ?>" required>
											</div>
										</div>

										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Password</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="inputName2" name="m_admin_pass" value="<?php echo $user_dtl[0]->m_emp_password; ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="inputName2" class="col-sm-2 col-form-label">Phone Number</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="inputName2" name="m_admin_contact" onkeypress="return /[0-9]/i.test(event.key)" - only number placeholder=" enter admin contact number" aria-label="" aria-describedby="" required value="<?php echo $user_dtl[0]->m_emp_mobile; ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
											<div class="col-sm-10">
												<textarea class="form-control" id="inputExperience" name="m_admin_address" required><?php echo $user_dtl[0]->m_emp_laddress; ?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-sm-2 col-sm-10">
												<button type="submit" class="btn btn-danger">Update</button>
											</div>
										</div>
									
								</div>
								<!-- /.tab-pane -->
							</div>
							<!-- /.tab-content -->
						</div><!-- /.card-body -->
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			
			</div>
			</form>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>




<?php $this->view('footer');
$this->view('js/profile_js');
?>
