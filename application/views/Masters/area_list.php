<?php $this->view('Includes/header'); ?>

<?php $roll_id = $this->session->userdata('roll_id');
$user_type = $this->session->userdata('user_type');
if ($pgtype == 1) {
    $relink = "area_list";
    $headname = "Area";
    $Md = "MST";
    $Smd = "AR";
} else if ($pgtype == 2) {
    $relink = "subarea_list";
    $headname = "Sub Area";
    $Md = "MST";
    $Smd = "SAR";
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3><?= $pagename ?></h3>
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

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="area_tbl" class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th><?= $headname ?> Name</th>
                                        <?php if ($pgtype == 2) { ?>
                                            <th>Area</th>
                                        <?php } ?>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    if (!empty($all_value)) {
                                        foreach ($all_value as $value) {
                                            $edit_link = site_url('Master/' . $relink . '?id=') . $value->m_area_id;
                                    ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $value->m_area_name; ?></td>
                                                <?php if ($pgtype == 2) { ?>
                                                    <td><?= $value->area_name; ?></td>
                                                <?php } ?>
                                                <td><?php echo $value->city_name; ?></td>
                                                <td><?php echo $value->state_name; ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($value->m_area_status == 1)) {
                                                    ?>
                                                        <a class="btn btn-success btn-sm" title="Active" data-toggle="Active">Active</a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a class="btn btn-danger btn-sm" title="In-Active" data-toggle="In-Active">In-Active</a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td title="Action" style="white-space: nowrap;">
                                                    <?php if ($user_type == 1 || has_perm($roll_id, $Md, $Smd, 'Edit')) { ?>
                                                        <a href="<?php echo $edit_link; ?>" class="btn btn-success btn-sm" title="Edit" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                                    <?php }
                                                    if ($user_type == 1 || has_perm($roll_id, $Md, $Smd, 'Delete')) { ?>
                                                        <button class="btn btn-danger btn-sm delete-area" data-value="<?php echo $value->m_area_id; ?>" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                                                    <?php } ?>
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
                        <!-- /.card-body -->

                    </div>

                </div>
                <!-- /.col -->
                <?php $fild = !empty($id) ? "Edit" : "Add";
                if ($user_type == 1 || has_perm($roll_id, $Md, $Smd, $fild)) { ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><?php if (!empty($id)) {
                                                            echo 'Edit Value';
                                                        } else {
                                                            echo 'Add New';
                                                        } ?></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="#" id="frm-add-area">

                                    <?php if (!empty($edit_value)) {
                                        $id = $edit_value->m_area_id;
                                        $title = $edit_value->m_area_name;
                                        $pgtype = $edit_value->m_area_type;
                                        $area = $edit_value->m_area_area;
                                        $state = $edit_value->m_area_state;
                                        $city = $edit_value->m_area_city;
                                        $status = $edit_value->m_area_status;
                                    } else {
                                        $id = '';
                                        $title = '';
                                        $area = '';
                                        $state = '';
                                        $city = '';
                                        $status = 1;
                                    } ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>State </label>
                                                <select name="m_area_state" id="m_state" class="form-control select2" title="Select State">
                                                    <option value="">Select State</option>
                                                    <?php
                                                    if (!empty($state_list)) {
                                                        foreach ($state_list as $ste) {
                                                    ?>
                                                            <option value="<?php echo $ste->m_state_id; ?>" <?php if ($state == $ste->m_state_id) echo 'selected'; ?>><?php echo $ste->m_state_name; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>City </label>
                                                <select name="m_area_city" id="m_city" class="form-control select2" title="Select City">
                                                    <option value="">Select City</option>
                                                    <?php
                                                    if (!empty($city_list)) {
                                                        foreach ($city_list as $cty) {
                                                    ?>
                                                            <option value="<?php echo $cty->m_city_id; ?>" data-state="<?= $cty->m_city_state ?>" <?php if ($city == $cty->m_city_id) echo 'selected'; ?>><?php echo $cty->m_city_name; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row <?php if ($pgtype == 1) {
                                                        echo 'd-none';
                                                    } ?>">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Area </label>
                                                <select name="m_area_area" id="m_area" class="form-control select2" title="Select Area">
                                                    <option value="">Select Area</option>
                                                    <?php
                                                    if (!empty($area_list)) {
                                                        foreach ($area_list as $are) {
                                                    ?>
                                                            <option value="<?php echo $are->m_area_id; ?>" data-state="<?= $are->m_area_state ?>" data-city="<?= $are->m_area_city ?>" <?php if ($area == $are->m_area_id) echo 'selected'; ?>><?php echo $are->m_area_name; ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><?= $headname ?> Name<span class="text-danger">*</span></label>
                                                <input type="hidden" name="m_area_id" id="m_area_id" value="<?= $id ?>">
                                                <input type="hidden" name="m_area_type" id="m_area_type" value="<?= $pgtype ?>">
                                                <input type="text" name="m_area_name" id="m_area_name" class="form-control" placeholder="Enter Name" required="" value="<?= $title ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="m_area_status" id="m_area_status" class="form-control" title="Select Status">
                                                    <option value="1" <?php if ($status == 1) echo 'selected' ?>>Active</option>
                                                    <option value="0" <?php if ($status == 0) echo 'selected' ?>>In-Active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-layout-submit">
                                                <button type="submit" id="btn-add-area" class="btn btn-block btn-info">Submit</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-layout-submit">
                                                <a href="<?php echo site_url('Master/' . $relink) ?>" class="btn btn-block btn-danger">Cancel </a>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                <?php } ?>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->view('Includes/footer')  ?>

<?php $this->view('js/js_custom') ?>
<?php $this->view('js/js_master') ?>