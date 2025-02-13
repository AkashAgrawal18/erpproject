  <!-- Main Sidebar Container -->
  <?php
	$logged_user_id = $this->session->userdata('user_id');
	$logged_user_type = $this->session->userdata('user_type');


	?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  	<!-- Sidebar -->
  	<div class="sidebar">
  		<!-- Sidebar user panel (optional) -->
  		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  			<div class="image">
  				<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
  			</div>
  			<div class="info">
  				<a href="<?php echo base_url('Welcome'); ?>" class="d-block">Digitalshakha</a>
  			</div>
  		</div>

  		<!-- Sidebar Menu -->
  		<nav class="mt-2">
  			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
  				<li class="nav-item menu-open">
  					<a href="<?php echo base_url('Welcome'); ?>" class="nav-link active">
  						<i class="nav-icon fas fa-tachometer-alt"></i>
  						<p>
  							Dashboard
  						</p>
  					</a>

  				</li>

  				<li class="nav-item">
  					<a href="#" class="nav-link">
  						<i class="nav-icon fa fa-user"></i>
  						<p>
  							HR
  							<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
  						<li class="nav-item">
  							<a href="<?php echo base_url('HrDept/department_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Department</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('HrDept/designation_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Designation</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('HrDept/shift_roster_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Shift Roster</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('HrDept/holiday_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Holidays</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('HrDept/store_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Stores/factory</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('HrDept/leave_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Leaves</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('HrDept/employe_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Employees</p>
  							</a>
  						</li>
  					</ul>
  				</li>

  				<li class="nav-item">
  					<a href="#" class="nav-link">
  						<i class="nav-icon fas fa-box"></i>
  						<p>Product<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
  						<li class="nav-item">
  							<a href="<?php echo base_url('Product/product_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Product/category_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Category</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Product/sub_category_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Sub Category</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Product/product_package_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product Package</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Product/product_size_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product Size</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Product/product_brand_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product Brand</p>
  							</a>
  						</li>
  					</ul>
  				</li>

  				<li class="nav-item">
  					<a href="#" class="nav-link">
  						<i class="nav-icon fas fa-boxes"></i>
  						<p>Finance<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
  						<li class="nav-item">
  							<a href="<?php echo base_url('Report/emp_add_salary'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Add Salary</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Report/emp_salary_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Employees Salary</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Report/emp_attd_report'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>EMP Attendance Report</p>
  							</a>
  						</li>
  					</ul>
  				</li>


  				<li class="nav-item">
  					<a href="#" class="nav-link">
  						<i class="nav-icon fas fa-database"></i>
  						<p>
  							Master
  							<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
  						<li class="nav-item">
  							<a href="<?php echo base_url('HrDept/salaryBreakup_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Salary Breakup</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Master/state_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>State</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Master/city_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>City</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Master/userperm_list'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Permission</p>
  							</a>
  						</li>
  					</ul>
  				</li>

  				<li class="nav-item">
  					<a href="#" class="nav-link">
  						<i class="nav-icon fas fa-box"></i>
  						<p>
  							Setting
  							<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
  						<li class="nav-item">
  							<a href="<?php echo base_url('Setting/app_setting'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Application Setting</p>
  							</a>
  						</li>
  						<li class="nav-item">
  							<a href="<?php echo base_url('Setting'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Profile</p>
  							</a>
  						</li>

  						<li class="nav-item">
  							<a href="<?php echo base_url('Logout'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Logout</p>
  							</a>
  						</li>
  					</ul>
  				</li>
  			</ul>
  		</nav>
  		<!-- /.sidebar-menu -->
  	</div>
  	<!-- /.sidebar -->
  </aside>
