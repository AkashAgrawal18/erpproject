<script type="text/javascript">
  $(document).ready(function(e) {

		 //=========================== employee ===========================//
// Function to insert a new employee
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

    $(".mobilevali").change(function() {
      if ($('#m_emp_altmobile').val() != '') {
        if ($('#m_emp_altmobile').val() == $('#m_emp_mobile').val()) {
          swal('Alternate Number Should be different', {
            icon: "error",
            timer: 1000,
          });
          $('#m_emp_altmobile').val('');
        } else {
          return true;
        }

      }

    });

    $("#Salary").click(function() {
      $('.nabtn').removeClass('active');
      $(this).addClass('active');
      $(".Salary").css("display", "block");
      $(".Statuatory").css("display", "none");
      $(".Prev_emp").css("display", "none");
      $(".Address").css("display", "none");
      $(".Login_dtl").css("display", "none");
      $(".Skills").css("display", "none");
    });

    $("#Statuatory").click(function() {
      $('.nabtn').removeClass('active');
      $(this).addClass('active');
      $(".Salary").css("display", "none");
      $(".Statuatory").css("display", "block");
      $(".Prev_emp").css("display", "none");
      $(".Address").css("display", "none");
      $(".Login_dtl").css("display", "none");
      $(".Skills").css("display", "none");
    });
    $("#Prev_emp").click(function() {
      $('.nabtn').removeClass('active');
      $(this).addClass('active');
      $(".Salary").css("display", "none");
      $(".Statuatory").css("display", "none");
      $(".Prev_emp").css("display", "block");
      $(".Address").css("display", "none");
      $(".Login_dtl").css("display", "none");
      $(".Skills").css("display", "none");
    });
    $("#Address").click(function() {
      $('.nabtn').removeClass('active');
      $(this).addClass('active');
      $(".Salary").css("display", "none");
      $(".Statuatory").css("display", "none");
      $(".Prev_emp").css("display", "none");
      $(".Address").css("display", "block");
      $(".Login_dtl").css("display", "none");
      $(".Skills").css("display", "none");
    });
    $("#Login_dtl").click(function() {
      $('.nabtn').removeClass('active');
      $(this).addClass('active');
      $(".Salary").css("display", "none");
      $(".Statuatory").css("display", "none");
      $(".Prev_emp").css("display", "none");
      $(".Address").css("display", "none");
      $(".Login_dtl").css("display", "block");
      $(".Skills").css("display", "none");
    });
    $("#Skills").click(function() {
      $('.nabtn').removeClass('active');
      $(this).addClass('active');
      $(".Salary").css("display", "none");
      $(".Statuatory").css("display", "none");
      $(".Prev_emp").css("display", "none");
      $(".Address").css("display", "none");
      $(".Login_dtl").css("display", "none");
      $(".Skills").css("display", "block");
    });


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
       var relink = "company_list";
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


    //=========================== hq ===========================//

    $("form#frm-add-hq").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-hq");
      clkbtn.prop('disabled', true);
      var type = $('#m_hq_type').val();
      if (type == 1) {
        var pagelink = "HrDept/hq_list";
      } else if (type == 2) {
        var pagelink = "Setup/plans_list";

      } else if (type == 3) {
        var pagelink = "Setup/package_list";

      } else if (type == 4) {
        var pagelink = "Setup/band_colour_list";
      }


      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_hq'); ?>",
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
              window.location = "<?php echo base_url() ?>" + pagelink;
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


    $("#hq_tbl").on("click", ".delete-hq", function() {
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
            url: "<?php echo site_url('HrDept/delete_hq'); ?>",
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

    //===========================hq===========================//


    //=========================== nh ===========================//

    $("form#frm-add-nh").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-nh");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_nh'); ?>",
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
              window.location = "<?php echo site_url('HrDept/nh_list'); ?>";
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


    $("#nh_tbl").on("click", ".delete-nh", function() {
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
            url: "<?php echo site_url('HrDept/delete_nh'); ?>",
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

    //===========================nh===========================//


   

    checkbox_checked("#is_out_of_job", '#dol_block');
    checkbox_checked("#is_esic_applicable", '#esicno_block');
    checkbox_checked("#is_epf_applicable", '#epfno_block');

    $("#is_out_of_job").on("click", function() {
      checkbox_checked(this, '#dol_block');
    });

    $("#is_esic_applicable").on("click", function() {
      checkbox_checked(this, '#esicno_block');
    });

    $("#is_epf_applicable").on("click", function() {
      checkbox_checked(this, '#epfno_block');
    });


 



    //=========================== advance  ===========================//

    $("form#frm-add-advance").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-advance");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_advance'); ?>",
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
              window.location = "<?php echo site_url('HrDept/advance_list'); ?>";
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


    $("#advance_tbl").on("click", ".delete-advance", function() {
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
            url: "<?php echo site_url('HrDept/delete_advance'); ?>",
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


    $("#m_advance_empid").on("change", function() {
      var empid = $(this).val();
      //  alert(empid)

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/check_emp_history'); ?>",
        data: {
          empid
        },
        dataType: "JSON",
        success: function(data) {

          if (data.status == 'success') {
            var salmode = data.emp_dtl.m_emp_salmode == 1 ? 'Cash' : 'Bank Account'
            $('#empdetailblock').html(` <h4>Employee Details </h4><table class="table table-striped table-bordered">
    <tr><th>EmployeeCode</th><td>` + data.emp_dtl.m_emp_code + `</td>
    <th>EmployeeName</th><td>` + data.emp_dtl.m_emp_name + `</td>
    <th>Mobile</th><td>` + data.emp_dtl.m_emp_mobile + `</td>
    <th>Alt Mobile</th><td>` + data.emp_dtl.m_emp_altmobile + `</td></tr>
    <tr><th>Company</th><td>` + data.emp_dtl.m_company_name + `</td>
    <th>Designation</th><td>` + data.emp_dtl.m_design_name + `</td>
    <th>Department</th><td>` + data.emp_dtl.m_dept_name + `</td>
   <th>DateOfBirth</th><td>` + data.emp_dtl.m_emp_dob + `</td></tr>
   <tr><th>DateOfJoining</th><td>` + data.emp_dtl.m_emp_doj + `</td>
 
   <th>Salary Mode</th><td>` + salmode + `</td>
    <th>Max Advance Amount</th><td id="maxadvamt">` + (data.emp_dtl.m_emp_gross_salary * 0.2) + `</td></tr>
    </table>`);
            var result = '';
            if (data.advc_his != '' && data.advc_his != null) {
              $.each(data.advc_his.reverse(), function(i, item) {
                result += `<tr>
                <td>` + (i + 1) + `</td>
                <td>` + item.m_advance_date + `</td>
                <td>` + item.m_advance_amt + `</td>
                <td>` + item.m_advance_remarks + `</td>
                </tr>`;
              });
            }


            $('#emphistoryblock').html(` <h4>Advance History Of this month</h4>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>SNo</th>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Remark</th>
                                                </thead>
                                                <tbody>
` + result + `
                                                </tbody>
                                            </table>`);

          } else {
            $("#m_advance_empid").val('').trigger('change');
            swal(data.message, {
              icon: "error",
              timer: 3000,
            });

          }
        },

      });



    });

    $('#m_advance_amt').change(function() {
      var entered_amt = parseInt($(this).val());
      var maxadvamt = parseInt($('#maxadvamt').html());

      if (maxadvamt >= entered_amt) {
        return true;
      } else {
        swal('Amount should less then or equal to Max Allow', {
          icon: "error",
          timer: 3000,
        });
        $(this).val('');
      }
    });

    //=========================== advance ===========================//

    //=========================== salinst ===========================//

    $("form#frm-add-salinst").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-salinst");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_salinst'); ?>",
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
              window.location = "<?php echo site_url('HrDept/salinst_list'); ?>";
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


    $("#salinst_tbl").on("click", ".delete-salinst", function() {
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
            url: "<?php echo site_url('HrDept/delete_salinst'); ?>",
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


    $("#navigbtn").on("click", function() {
      var btnid = $(this).val();
      if (btnid == 1) {
        $('#listSalInst').css('display', 'none');
        $('#addSalInst').css('display', 'block');
        $(this).val(2);
        $(this).text('SalaryInst List');
      } else if (btnid == 2) {
        $('#listSalInst').css('display', 'block');
        $('#addSalInst').css('display', 'none');
        $(this).val(1);
        $(this).text('Add New');
      }

    });

    $("#m_salinst_empid").on("change", function() {
      var empid = $(this).val();
      //  alert(empid)

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/get_emp_dtl'); ?>",
        data: {
          empid
        },
        dataType: "JSON",
        success: function(data) {
          if (data) {
            $('#empdetailblock').html(`<table class="table table-striped table-bordered">
    <tr><th>EmployeeCode</th><td>` + data.m_emp_code + `</td></tr>
    <tr><th>EmployeeName</th><td>` + data.m_emp_name + `</td></tr>
    <tr><th>Company</th><td>` + data.m_company_name + `</td></tr>
    <tr><th>Designation</th><td>` + data.m_design_name + `</td></tr>
    <tr><th>Department</th><td>` + data.m_dept_name + `</td></tr>
    <tr><th>HQ</th><td>` + data.m_emp_hq + `</td></tr>
    <tr><th>DateOfJoining</th><td>` + data.m_emp_doj + `</td></tr>
    <tr><th>GrossSalary</th><td>` + data.m_emp_gross_salary + `</td></tr>
    </table>`);

          }
        },

      });



    });

    //===========================salinst===========================//





    //=========================== incrmt ===========================//

    $("form#frm-add-incrmt").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-incrmt");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/insert_incrmt'); ?>",
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
              window.location = "<?php echo site_url('HrDept/incrmt_list'); ?>";
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


    $("#incrmt_tbl").on("click", ".delete-incrmt", function() {
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
            url: "<?php echo site_url('HrDept/delete_incrmt'); ?>",
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


    $("#navigbtn1").on("click", function() {
      var btnid = $(this).val();
      if (btnid == 1) {
        $('#listincrmt').css('display', 'none');
        $('#addincrmt').css('display', 'block');
        $(this).val(2);
        $(this).text('SalaryInst List');
      } else if (btnid == 2) {
        $('#listincrmt').css('display', 'block');
        $('#addincrmt').css('display', 'none');
        $(this).val(1);
        $(this).text('Add New');
      }

    });

    $("#m_incrmt_empid").on("change", function() {
      var empid = $(this).val();
      //  alert(empid)

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('HrDept/get_emp_dtl'); ?>",
        data: {
          empid
        },
        dataType: "JSON",
        success: function(data) {
          if (data) {
            $('#empdetailblock').html(`<table class="table table-striped table-bordered">
    <tr><th>EmployeeCode</th><td>` + data.m_emp_code + `</td></tr>
    <tr><th>EmployeeName</th><td>` + data.m_emp_name + `</td></tr>
    <tr><th>Company</th><td>` + data.m_company_name + `</td></tr>
    <tr><th>Designation</th><td><input type="hidden" name="m_old_designation" value="` + data.m_emp_design + `">` + data.m_design_name + `</td></tr>
    <tr><th>Department</th><td>` + data.m_dept_name + `</td></tr>
    <tr><th>HQ</th><td>` + data.m_emp_hq + `</td></tr>
    <tr><th>DateOfJoining</th><td>` + data.m_emp_doj + `</td></tr>
    <tr><th>GrossSalary</th><td>` + data.m_emp_gross_salary + `</td></tr>
    </table>`);

            $('.salsrtblock').empty().html(` <table class="table table-bordered" id="salsrtblock"><tbody >
                                                        <tr>
                                                            <th>Salary Head</th>
                                                            <th style="width:33%">Prev Salary</th>
                                                            <th style="width:32%">New Salary</th>

                                                        </tr>
                                                        <tr>
                                                            <th>Basic</th>
                                                            <td>` + data.m_emp_salary + ` </td>
                                                            <td><input type="number" name="m_emp_salary"></td>
                                                         
                                                        </tr>
                                                        <tr>
                                                            <th>TA</th>
                                                            <td>` + data.m_emp_ta + ` </td>
                                                            <td><input type="number" name="m_emp_ta"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>HRA</th>
                                                            <td>` + data.m_emp_hra + ` </td>
                                                            <td><input type="number" name="m_emp_hra"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>CCA</th>
                                                            <td>` + data.m_emp_cca + ` </td>
                                                            <td><input type="number" name="m_emp_cca"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>SplAllowance</th>
                                                            <td>` + data.m_emp_spl_allow + ` </td>
                                                            <td><input type="number" name="m_emp_spl_allow"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>EducationAllow</th>
                                                            <td>` + data.m_emp_educ_allow + ` </td>
                                                            <td><input type="number" name="m_emp_educ_allow"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>MedicalAllowance</th>
                                                            <td>` + data.m_emp_medic_allow + ` </td>
                                                            <td><input type="number" name="m_emp_medic_allow"></td>
                                                            
                                                        </tr>
                                                        <tr>
                                                            <th>GrossSalary</th>
                                                            <td><input type="hidden" name="m_old_gross" value="` + data.m_emp_gross_salary + `">` + data.m_emp_gross_salary + ` </td>
                                                            <td><input type="number" name="m_emp_gross_salary"></td>
                                                            
                                                        </tr>
                                                    </tbody></table>`);

          }
        },

      });



    });

    $('#arias_from_month').on("click", function() {
      if ($(this).is(":checked")) {
        $('#m_incrmt_ariasdate').attr('readonly', false);
      } else {
        $('#m_incrmt_ariasdate').attr('readonly', true);
      }
    });
    //===========================incrmt===========================//


  });

  function checkbox_checked(checkboxId, inputId) {
    if ($(checkboxId).is(":checked")) {
      $(inputId).show();
    } else {
      $(inputId).hide();
    }
  }
</script>


