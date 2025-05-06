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

 
  //=========================== area ===========================//

  $("form#frm-add-area").submit(function(e) {
			e.preventDefault();
			var clkbtn = $("#btn-add-area");
			clkbtn.prop('disabled', true);
			var formData = new FormData(this);
			let pgtype = $('#m_area_type').val();
			if (pgtype == 1) {
				var relink = "area_list";
			} else if (pgtype == 2) {
				var relink = "subarea_list";
			}

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('Master/insert_area'); ?>",
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
							window.location = "<?php echo site_url('Master/'); ?>" + relink;
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


		$("#area_tbl").on("click", ".delete-area", function() {
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
						url: "<?php echo site_url('Master/delete_area'); ?>",
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

		//===========================area===========================//

 
		//---------------state wise city----------------------//
		
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


		
    //===========================warehouse ===========================//
    $("form#frm-add-ware").submit(function(e) {
      e.preventDefault();
      var clkbtn = $("#btn-add-ware");
      clkbtn.prop('disabled', true);
      var formData = new FormData(this);

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('Product/insert_warehouse'); ?>",
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
              window.location = "<?php echo site_url('Product/warehouse_list'); ?>";
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


    $("#ware_tbl").on("click", ".delete-ware", function() {
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
            url: "<?php echo site_url('Product/delete_warehouse'); ?>",
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

    //===========================warehouse ===========================//



  });
</script>
