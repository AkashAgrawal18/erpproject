<script type="text/javascript">
    $(document).ready(function(e) {
        //=========================== status ===========================//

        $("form#frm-add-status").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#btn-add-status");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);
            let pgtype = $('#m_status_type').val();
            if (pgtype == 1) {
                var relink = "status_list";
            } else if (pgtype == 2) {
                var relink = "source_list";
            }

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Leads/insert_status'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });
                        setTimeout(function() {
                            window.location = "<?php echo site_url('Leads/'); ?>" + relink;
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });


        $("#status_tbl").on("click", ".delete-status", function() {
            var clkbtn = $(this);
            clkbtn.prop('disabled', true);
            var dlt_id = $(this).data('value');

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Leads/delete_status'); ?>",
                        data: {
                            delete_id: dlt_id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == 'success') {
                                swal(data.message, {
                                    icon: "success",
                                    timer: 1000,
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                clkbtn.prop('disabled', false);
                                swal(data.message, {
                                    icon: "error",
                                    timer: 5000,
                                });
                            }
                        },
                        error: function(jqXHR, status, err) {
                            clkbtn.prop('disabled', false);
                            swal("Some Problem Occurred!! please try again", {
                                icon: "error",
                                timer: 2000,
                            });
                        }
                    });

                } else {
                    clkbtn.prop('disabled', false);
                    swal("Your Data is safe!", {
                        icon: "info",
                        timer: 2000,
                    });
                }
            });
        });

        //===========================status===========================//

        //=========================== lead ===========================//

        $("form#frm-add-lead").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#btn-add-lead");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Leads/insert_lead'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });
                        setTimeout(function() {
                            window.location = "<?php echo site_url('Leads/lead_list'); ?>";
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });


        $("#lead_tbl").on("click", ".delete-lead", function() {
            var clkbtn = $(this);
            clkbtn.prop('disabled', true);
            var dlt_id = $(this).data('value');

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Leads/delete_lead'); ?>",
                        data: {
                            delete_id: dlt_id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == 'success') {
                                swal(data.message, {
                                    icon: "success",
                                    timer: 1000,
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                clkbtn.prop('disabled', false);
                                swal(data.message, {
                                    icon: "error",
                                    timer: 5000,
                                });
                            }
                        },
                        error: function(jqXHR, status, err) {
                            clkbtn.prop('disabled', false);
                            swal("Some Problem Occurred!! please try again", {
                                icon: "error",
                                timer: 2000,
                            });
                        }
                    });

                } else {
                    clkbtn.prop('disabled', false);
                    swal("Your Data is safe!", {
                        icon: "info",
                        timer: 2000,
                    });
                }
            });
        });

        //===========================lead===========================//
        //=========================== followup ===========================//

        $("form#frm-add-follow").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#btn-add-follow");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Leads/insert_followup'); ?>",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        swal(data.message, {
                            icon: "success",
                            timer: 1000,
                        });
                        setTimeout(function() {
                            window.location = "<?php echo site_url('Leads/lead_list'); ?>";
                        }, 1000);
                    } else {
                        clkbtn.prop('disabled', false);
                        swal(data.message, {
                            icon: "error",
                            timer: 5000,
                        });
                    }
                },
                error: function(jqXHR, status, err) {
                    clkbtn.prop('disabled', false);
                    swal("Some Problem Occurred!! please try again", {
                        icon: "error",
                        timer: 2000,
                    });
                }
            });

        });


        $("#lead_tbl").on("click", ".delete-followup", function() {
            var clkbtn = $(this);
            clkbtn.prop('disabled', true);
            var dlt_id = $(this).data('value');

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('Leads/delete_lead'); ?>",
                        data: {
                            delete_id: dlt_id
                        },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status == 'success') {
                                swal(data.message, {
                                    icon: "success",
                                    timer: 1000,
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                clkbtn.prop('disabled', false);
                                swal(data.message, {
                                    icon: "error",
                                    timer: 5000,
                                });
                            }
                        },
                        error: function(jqXHR, status, err) {
                            clkbtn.prop('disabled', false);
                            swal("Some Problem Occurred!! please try again", {
                                icon: "error",
                                timer: 2000,
                            });
                        }
                    });

                } else {
                    clkbtn.prop('disabled', false);
                    swal("Your Data is safe!", {
                        icon: "info",
                        timer: 2000,
                    });
                }
            });
        });

        $("#m_follow_sample").change(function() {
            if ($(this).val() == 1) {
                $(".samplediv").removeClass('d-none');
            } else {
                $(".samplediv").addClass('d-none');
            }
        });

        //=========================== followup ===========================//

    });

    function addfollowup_modal(leadid) {

        $.ajax({
            type: "POST",
            url: "<?= site_url('Leads/get_lead_details'); ?>",
            data: {
                leadid
            },
            dataType: "JSON",
            success: function(data) {
                if (data) {
                    $('#leaddetaildiv').html(`<div class="col-sm-4">
                        <strong>Lead Name:</strong> <span id="leadname">${data.m_lead_name}</span>
                    </div>
                    <div class="col-sm-4">
                    <strong>Mobile:</strong> <span id="leadmobile">${data.m_lead_mobile || 'N/A'}</span>
                    </div>
                    <div class="col-sm-4">
                        <strong>Lead Type:</strong> <span id="leadtype">${data.m_lead_type || 'N/A'}</span>
                    </div>
                    <div class="col-sm-4">
                        <strong>Source:</strong> <span id="leadsource">${data.source_name || 'N/A'}</span>
                    </div>
                    <div class="col-sm-4">
                        <strong>Assigned To:</strong> <span id="leadassigned">${data.assigned_to || 'N/A'}</span>
                    </div>
                    <div class="col-sm-4">
                        <strong>City:</strong> <span id="leadcity">${data.city_name || 'N/A'}</span>
                    </div>
                    <div class="col-sm-4">
                        <strong>State:</strong> <span id="leadstate">${data.state_name || 'N/A'}</span>
                    </div>
                    <div class="col-sm-6">
                        <strong>Address:</strong> <span id="leadaddress">${data.m_lead_address || 'N/A'}</span>
                    </div>`);
                    $('#m_follow_lead').val(data.m_lead_id);
                    $('#m_follow_assigned').val(data.m_lead_assigned);
                    $('#m_follow_status').val(data.m_lead_status).trigger('change');
                    $('#add_followup_modal').modal('show');
                } else {
                    swal("Data Not Found! Please Try Again", {
                        icon: "error",
                        timer: 5000,
                    });
                }
            }
        });
    }
</script>