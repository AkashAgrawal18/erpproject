  <!-- Main Sidebar Container -->
  <?php
	$logged_user_id = $this->session->userdata('user_id');
	$logged_user_type = $this->session->userdata('user_type');
	$roll_id = $this->session->userdata('roll_id');


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
  			 
  				<li class="nav-item menu-open">
  					<a class="nav-link <?php if ($this->uri->segment(1) == 'Welcome') {  echo 'active';   } ?>" 
					 href="<?php echo base_url('Welcome'); ?>" ><i class="nav-icon fas fa-tachometer-alt"></i>	<p>	Dashboard </p></a> 
  				</li> 
				  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR')) { ?>   
  				<li class="nav-item">
  					<a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'HrDept') {  echo 'active';   } ?>">
  						<i class="nav-icon fa fa-user"></i>
  						<p>	HR <i class="fas fa-angle-left right"></i> </p>
  					</a>
  					<ul class="nav nav-treeview">
					  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR','DPT','List')) { ?>   
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('HrDept/department_list'); ?>" ><i class="far fa-circle nav-icon"></i> <p>Department</p> </a>
  						</li>
						<?PHP } ?>
						<?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR','DGN','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('HrDept/designation_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Designation</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR','SFTR','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('HrDept/shift_roster_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Shift Roster</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR','HLD','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('HrDept/holiday_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Holidays</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR','STRFCT','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('HrDept/store_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Stores/factory</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR','LVS','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('HrDept/leave_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Leaves</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR', 'RLS','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('HrDept/roll_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Rolls</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'HR','EMP','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('HrDept/employe_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Employees</p>
  							</a>
  						</li>
						  <?PHP } ?>
  					</ul>
  				</li>
				  <?PHP } ?>
				  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT')) { ?>  
  				<li class="nav-item">
  					<a href="#" class="nav-link  <?php if ($this->uri->segment(1) == 'Product') {  echo 'active';   } ?>">
  						<i class="nav-icon fas fa-box"></i>
  						<p>Product<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
					  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT','PDT','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link"href="<?php echo base_url('Product/product_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product</p>
  							</a>
  						</li>
						<?PHP } ?>
						<?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT','CTG','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('Product/category_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Category</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT','SCTG','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('Product/sub_category_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Sub Category</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT','PDTPACK','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('Product/product_package_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product Package</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT','PDTSIZE','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link"  href="<?php echo base_url('Product/product_size_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product Size</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT','PDTBRAND','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link"  href="<?php echo base_url('Product/product_brand_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product Brand</p>
  							</a>
  						</li> 
						<?PHP } ?>
						<?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT','PDTSIZE','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link"  href="<?php echo base_url('Product/batch_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Batch</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT','PDTSIZE','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link"  href="<?php echo base_url('Product/stock_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Stock</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'PDT','PDTSIZE','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link"  href="<?php echo base_url('Product/warehouse_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Warehouses</p>
  							</a>
  						</li>
						  <?PHP } ?>
  					</ul>
  				</li>
				  <?PHP } ?>
				  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'FNC')) { ?>  
  				<li class="nav-item">
  					<a href="#" class="nav-link  <?php if ($this->uri->segment(1) == 'Report') {  echo 'active';   } ?>">
  						<i class="nav-icon fas fa-boxes"></i>
  						<p>Finance<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
					  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'FNC','ASLR','Add')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link"  href="<?php echo base_url('Report/emp_add_salary'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Add Salary</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'FNC', 'EMPSLR','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link"  href="<?php echo base_url('Report/emp_salary_list'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Employees Salary</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'FNC', 'EMPAR','List')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link"  href="<?php echo base_url('Report/emp_attd_report'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>EMP Attendance Report</p>
  							</a>
  						</li>
						<?php } ?>
  					</ul>
  				</li>
				  <?php } ?>
				  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'MST')) { ?> 
  				<li class="nav-item ">
  					<a href="#" class="nav-link <?php if ($this->uri->segment(1) == 'Master') {  echo 'active';   } ?>">
  						<i class="nav-icon fas fa-database"></i>
  						<p>
  							Master
  							<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
					  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'MST', 'SBRK', 'List')) { ?> 
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('HrDept/salaryBreakup_list'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Salary Breakup</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'MST','ST','List')) { ?> 
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('Master/state_list'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>State</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'MST','CT', 'List')) { ?> 
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('Master/city_list'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>City</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($roll_id, 'MST', 'PRM', 'List')) { ?> 
  						<li class="nav-item">
  							<a class="nav-link" href="<?php echo base_url('Master/rolls_permission'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Rolls & Permission</p>
  							</a>
  						</li>
						<?php } ?>
  					</ul>
  				</li>
				  <?php } ?>
  				<li class="nav-item">
  					<a href="#" class="nav-link  <?php if ($this->uri->segment(1) == 'Setting') {  echo 'active';   } ?>">
  						<i class="nav-icon fas fa-box"></i>
  						<p>
  							Setting
  							<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
					  <?php if ($logged_user_type == 1) { ?> 
  						<li class="nav-item">
  							<a href="<?php echo base_url('Setting/app_setting'); ?>" class="nav-link">
  								<i class="far fa-circle nav-icon"></i>
  								<p>Application Setting</p>
  							</a>
  						</li>
						<?php } ?>
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
