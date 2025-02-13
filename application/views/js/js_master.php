<script type="text/javascript">
  $(document).ready(function(e) {

 

    //===========================state ===========================//
    $("form#frm-add-state").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-state");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_state'); ?>",
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
              window.location = "<?php echo site_url('Master/state_list'); ?>";
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


    $("#state_tbl").on("click", ".delete-state", function() {
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
            url: "<?php echo site_url('Master/delete_state'); ?>",
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

    //===========================state ===========================//

		
    //===========================City ===========================//

    $("form#frm-add-city").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-city");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_city'); ?>",
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
              window.location = "<?php echo site_url('Master/city_list'); ?>";
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


    $("#city_tbl").on("click", ".delete-city", function() {
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
            url: "<?php echo site_url('Master/delete_city'); ?>",
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

    //===========================City===========================//

 
    //===========================cashacc ===========================//
    $("form#frm-add-cashacc").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-cashacc");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_cashacc'); ?>",
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
              window.location = "<?php echo site_url('Master/cashAcc_list'); ?>";
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


    $("#cashacc_tbl").on("click", ".delete-cashacc", function() {
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
            url: "<?php echo site_url('Master/delete_cashacc'); ?>",
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

    //===========================cashacc ===========================//
 
		//---------------state wise city----------------------//
		
    //////////////////////////
    $("#m_state").on('change', function() {
        var m_state = $('#m_state :selected').val();

        $('#m_city').find('option').not(':first').remove();



        $.ajax({
            url: "<?php echo site_url('Master/get_city') ?>",
            type: "POST",
            data: {
                m_state: m_state
            },
            dataType: "JSON",
            success: function(data) {

                var selectm_state = $("#m_state").val();

                var html = "";

                $.each(data, function(index, value) {

                    if (value.state == selectm_state) {
                        var sel2 = 'selected';

                    } else {
                        var sel2 = '';

                    }

                    html += "<option value='" + value.m_city_id + "' " + sel2 + ">" + value.m_city_name + "</option>";
                });
                $("#m_city").append(html);
            }
        });
    });

		// //////////////////////////////////////////////////////////

		
    //===========================perm===========================//
    $("form#frm-add-perm").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-perm");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_perm'); ?>",
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
              window.location = "<?php echo site_url('Master/perm_list'); ?>";
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


    $("#perm_tbl").on("click", ".delete-perm", function() {
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
            url: "<?php echo site_url('Master/delete_perm'); ?>",
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

    //===========================perm===========================//


    //===========================Userperm===========================//


    $(".checkedclick").on("click", function() {

      var permid = $(this).data('permid');
      var modulee = $(this).data('module');
      var submodule = $(this).data('submodule');
      var userpermid = $(this).data('userpermid');
      var userid = $(this).data('userid');
      var name = $(this).data('name');

      // alert(permid+'-'+ modulee +'-'+ submodule+ '-'+ userpermid+ '-'+ userid +'-'+ name)
      if ($(this).is(":checked")) {
        var value = 1;
      } else {
        var value = 0;
      }


      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Master/insert_userperm'); ?>",
        data: {
          permid: permid,
          modulee: modulee,
          submodule: submodule,
          userpermid: userpermid,
          userid: userid,
          name: name,
          value: value,
        },

        dataType: "JSON",
        success: function(data) {
          if (data.status == 'success') {
            $('#toast_text-box').removeClass('hide');
            $('#toast_text-box').css('background-color', '#26ff26cf');
              $('#toast_text-text').text('Permission update successfully');
            setTimeout(function() {
              location.reload();
              $('#toast_text-box').addClass('hide');
             
            }, 100);
          } else {
            $('#toast_text-box').removeClass('hide');
            $('#toast_text-box').css('background-color', '#ff2626e0');
              $('#toast_text-box').css('color', '#fff');
              $('#toast_text-text').text('Something Went wrong');
            setTimeout(function() {
              $('#toast_text-box').addClass('hide');
             
            }, 200);
          }
        },
        error: function(jqXHR, status, err) {
          $('#toast_text-box').removeClass('hide');
          setTimeout(function() {
            $('#toast_text-box').addClass('hide');
            $('#toast_text-box').css('background-color', '#ff2626e0');
            $('#toast_text-box').css('color', '#fff');
            $('#toast_text-text').text('Something Went wrong');
          }, 100);
        }
      });



    });


  });
</script>
