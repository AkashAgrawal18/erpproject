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
  					<a class="nav-link <?php if ($this->uri->segment(1) == 'Welcome') {
                                                            echo 'active';
                                                        } ?>"  href="<?php echo base_url('Welcome'); ?>" >
  						<i class="nav-icon fas fa-tachometer-alt"></i>	<p>	Dashboard </p>	</a> 
  				</li> 
  				<li class="nav-item">
  					<a href="#" class="nav-link">
  						<i class="nav-icon fa fa-user"></i>
  						<p>	HR <i class="fas fa-angle-left right"></i> </p>
  					</a>
  					<ul class="nav nav-treeview">
					  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR')) { ?>   
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'DPT') { echo 'active';  } ?>" href="<?php echo base_url('HrDept/department_list'); ?>" ><i class="far fa-circle nav-icon"></i> <p>Department</p> </a>
  						</li>
						<?PHP } ?>
						<?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'DGN') { echo 'active';  } ?>" href="<?php echo base_url('HrDept/designation_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Designation</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'SFTR') { echo 'active';  } ?>" href="<?php echo base_url('HrDept/shift_roster_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Shift Roster</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'HLD') { echo 'active';  } ?>" href="<?php echo base_url('HrDept/holiday_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Holidays</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'STRFCT') { echo 'active';  } ?>" href="<?php echo base_url('HrDept/store_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Stores/factory</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'LVS') { echo 'active';  } ?>" href="<?php echo base_url('HrDept/leave_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Leaves</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'HR')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'EMP') { echo 'active';  } ?>" href="<?php echo base_url('HrDept/employe_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Employees</p>
  							</a>
  						</li>
						  <?PHP } ?>
  					</ul>
  				</li>

  				<li class="nav-item">
  					<a href="#" class="nav-link">
  						<i class="nav-icon fas fa-box"></i>
  						<p>Product<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
					  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'PDT')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'PDT') { echo 'active';  } ?>"href="<?php echo base_url('Product/product_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product</p>
  							</a>
  						</li>
						<?PHP } ?>
						<?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'PDT')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'CTG') { echo 'active';  } ?>" href="<?php echo base_url('Product/category_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Category</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'PDT')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'SCTG') { echo 'active';  } ?>" href="<?php echo base_url('Product/sub_category_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Sub Category</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'PDT')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'PDTPACK') { echo 'active';  } ?>" href="<?php echo base_url('Product/product_package_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product Package</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'PDT')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'PDTSIZE') { echo 'active';  } ?>"  href="<?php echo base_url('Product/product_size_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product Size</p>
  							</a>
  						</li>
						  <?PHP } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'PDT')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'PDTBRAND') { echo 'active';  } ?>"  href="<?php echo base_url('Product/product_brand_list'); ?>" >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Product Brand</p>
  							</a>
  						</li>
						<?PHP } ?>
  					</ul>
  				</li>

  				<li class="nav-item">
  					<a href="#" class="nav-link">
  						<i class="nav-icon fas fa-boxes"></i>
  						<p>Finance<i class="fas fa-angle-left right"></i>
  						</p>
  					</a>
  					<ul class="nav nav-treeview">
					  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'FNC')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'ASLR') { echo 'active';  } ?>"  href="<?php echo base_url('Report/emp_add_salary'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Add Salary</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'EMPSLR')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'PDTBRAND') { echo 'active';  } ?>"  href="<?php echo base_url('Report/emp_salary_list'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Employees Salary</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'EMPAR')) { ?>  
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'PDTBRAND') { echo 'active';  } ?>"  href="<?php echo base_url('Report/emp_attd_report'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>EMP Attendance Report</p>
  							</a>
  						</li>
						<?php } ?>
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
					  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MST')) { ?> 
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'SBRK') { echo 'active';  } ?>" href="<?php echo base_url('HrDept/salaryBreakup_list'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Salary Breakup</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MST')) { ?> 
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'ST') { echo 'active';  } ?>" href="<?php echo base_url('Master/state_list'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>State</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MST')) { ?> 
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'CT') { echo 'active';  } ?>" href="<?php echo base_url('Master/city_list'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>City</p>
  							</a>
  						</li>
						  <?php } ?>
						  <?php if ($logged_user_type == 1 || has_perm($logged_user_id, 'MST')) { ?> 
  						<li class="nav-item">
  							<a class="nav-link <?php if ($this->uri->segment(1) == 'PRM') { echo 'active';  } ?>" href="<?php echo base_url('Master/user_list'); ?>"  >
  								<i class="far fa-circle nav-icon"></i>
  								<p>Permission</p>
  							</a>
  						</li>
						<?php } ?>
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
