<script type="text/javascript">
  $(document).ready(function(e) {

		 //=========================== employee ===========================//
 
$("form#frm-emp-create").submit(function (e) {
    e.preventDefault();
    var clkbtn = $("#btn-emp-create");
    clkbtn.prop("disabled", true);
    var formData = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_emp'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (data) {
            if (data.status == "success") {
                swal(data.message, {
                    icon: "success",
                    timer: 1000,
                });
                setTimeout(function () {
                    window.location = "<?php echo site_url('HrDept/employe_list'); ?>";
                }, 1000);
            } else {
                clkbtn.prop("disabled", false);
                swal(data.message, {
                    icon: "error",
                    timer: 5000,
                });
            }
        },
        error: function () {
            clkbtn.prop("disabled", false);
            swal("Some Problem Occurred!! Please try again", {
                icon: "error",
                timer: 2000,
            });
        },
    });
});

// Function to update an existing employee
$("form#frm-emp-update").submit(function (e) {
    e.preventDefault();
    var clkbtn = $("#btn-emp-update");
    clkbtn.prop("disabled", true);
    var formData = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/update_emp'); ?>",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "JSON",
        success: function (data) {
            if (data.status == "success") {
                swal(data.message, {
                    icon: "success",
                    timer: 1000,
                });
                setTimeout(function () {
                    window.location = "<?php echo site_url('HrDept/employe_list'); ?>";
                }, 1000);
            } else {
                clkbtn.prop("disabled", false);
                swal(data.message, {
                    icon: "error",
                    timer: 5000,
                });
            }
        },
        error: function () {
            clkbtn.prop("disabled", false);
            swal("Some Problem Occurred!! Please try again", {
                icon: "error",
                timer: 2000,
            });
        },
    });
});



    $("#employe_tbl").on("click", ".delete-employe", function() {
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
            url: "<?php echo site_url('HrDept/delete_emp'); ?>",
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


		
    $(".sbk_delt").on("click", ".delete-sbk", function() {
      // alert("hiiiii");
      var clkbtn = $(this);
      clkbtn.prop('disabled', true);
      var dlt_id = $(this).data('value');
      //console.log(dlt_id);
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
            url: "<?php echo site_url('HrDept/delete_slarybk'); ?>",
            data: {
              delete_id: dlt_id
            
            },
            dataType: "JSON",
            success: function(data) {
              if (data.status == 'success') {
                swal(data.message, {
                  icon: "success",
                  timer: 2000,
                });
                setTimeout(function() {
                  location.reload();
                }, 2000);
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



		///////////////////////////employee/////////////////////////
 

    //=========================== dept ===========================//

    $("form#frm-add-dept").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-dept");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);
      let pgtype = $('#m_dept_type').val();
      if (pgtype == 1) {
       var relink = "department_list";
      } else if (pgtype == 2) {
       var relink = "designation_list";
      } else if (pgtype == 3) {
       var relink = "salaryBreakup_list";
      }else if (pgtype == 4) {
       var relink = "shift_roster_list";
      }

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_dept'); ?>",
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
              window.location = "<?php echo site_url('HrDept/'); ?>"+relink;
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


    $("#dept_tbl").on("click", ".delete-dept", function() {
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
            url: "<?php echo site_url('HrDept/delete_dept'); ?>",
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

    //===========================dept===========================//

		
    //===========================store===========================//

    $("form#frm-add-store").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-store");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_store'); ?>",
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
              window.location = "<?php echo site_url('HrDept/store_list'); ?>";
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


    $("#store_tbl").on("click", ".delete-store", function() {
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
            url: "<?php echo site_url('HrDept/delete_store'); ?>",
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

    //===========================Store===========================//

				
    //===========================holidaye===========================//

    $("form#frm-add-holiday").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-holiday");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_holiday'); ?>",
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
              window.location = "<?php echo site_url('HrDept/holiday_list'); ?>";
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


    $("#holiday_tbl").on("click", ".delete-holiday", function() {
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
            url: "<?php echo site_url('HrDept/delete_holiday'); ?>",
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

    //===========================holidaye===========================//

 
		
    //=========================== cate ===========================//

    $("form#frm-add-cate").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-cate");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);
      let cattype = $('#m_cat_type').val();
      if (cattype == 1) {
       var relink = "category_list";
      } else if (cattype == 2) {
       var relink = "sub_category_list";
      } 

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_cate'); ?>",
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
              window.location = "<?php echo site_url('HrDept/'); ?>"+relink;
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


    $("#cate_tbl").on("click", ".delete-cate", function() {
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
            url: "<?php echo site_url('HrDept/delete_cate'); ?>",
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

    //===========================cate===========================//

			
    //===========================leave===========================//

    $("form#frm-add-leave").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-leave");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_leave'); ?>",
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
              window.location = "<?php echo site_url('HrDept/leave_list'); ?>";
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


    $("#leave_tbl").on("click", ".delete-leave", function() {
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
            url: "<?php echo site_url('HrDept/delete_leave'); ?>",
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

    //===========================leave===========================//

 
 
	});
</script>


