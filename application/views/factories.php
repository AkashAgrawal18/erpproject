<?php $this->view('header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Factories Management</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table id="factories_tbl" class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th>Factory Name</th>
                                        <th>Location</th>
                                        <th>Created At</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($factories)) {
                                        foreach ($factories as $factory) {
                                            $edit_link = site_url('Factories/edit?id=') . $factory->id;
                                    ?>
                                            <tr id="row-<?php echo $factory->id; ?>">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $factory->name; ?></td>
                                                <td><?php echo $factory->location; ?></td>
                                                <td><?php echo $factory->created_at; ?></td>
                                                <td>
												<button class="btn btn-success btn-sm edit-factory" data-id="<?= $factory->id ?>">
													<i class="fa fa-edit"></i>
												</button>
                                                    <button class="btn btn-danger btn-sm delete-factory" data-value="<?php echo $factory->id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo !empty($edit_factory) ? 'Edit Factory' : 'Add New Factory'; ?></h3>
                        </div>
                        <div class="card-body">
                            <form method="post" action="#" id="frm-add-factory">
                                <?php
                                $id = $edit_factory->id ?? '';
                                $name = $edit_factory->name ?? '';
                                $location = $edit_factory->location ?? '';
                                ?>
                                <div class="form-group">
                                    <label>Factory Name<span class="text-danger">*</span></label>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Factory Name" required value="<?php echo $name; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Location<span class="text-danger">*</span></label>
                                    <input type="text" id="location" name="location" class="form-control" placeholder="Enter Location" required value="<?php echo $location; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-block btn-info">Submit</button>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="<?php echo site_url('Factories'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->view('footer'); ?>
<?php $this->view('js/js_custom'); ?>
<script>
	var base_url = '<?= base_url(); ?>';	

	console.log(base_url);
</script>
<script src="<?= base_url('assets/js/factories.js'); ?>"></script>