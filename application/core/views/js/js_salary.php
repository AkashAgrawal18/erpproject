<script type="text/javascript">
    $(document).ready(function() {
        // Function to update Absent & Payable Salary
        function updateSalaryFields(row) {
            let totalDays = parseInt(row.find("input[name='m_salinst_totaldays[]']").val()) || 0;
            let present = parseInt(row.find("input[name='m_salinst_prdays[]']").val()) || 0;
            let leave = parseInt(row.find("input[name='m_salinst_lvdays[]']").val()) || 0;
            let pardaysal = parseFloat(row.find("input[name='parday_salary[]']").val()) || 0;

            // Calculate absent days
            let absent = totalDays - (present + leave);
            row.find("input[name='m_salinst_absent[]']").val(absent); // Assign absent days to the correct input

            // Calculate payable salary
            let payable = pardaysal * (present + leave); // Only count present + leave days
            row.find("input[name='m_salinst_payable[]']").val(payable.toFixed(2));

            // Mark row as changed
            row.attr("data-changed", "true");
        }

        // Attach event listener to all relevant inputs
        $(document).on("input", "input[name='m_salinst_prdays[]'], input[name='m_salinst_lvdays[]'], input[name='m_salinst_totaldays[]'], input[name='parday_salary[]']", function() {
            let row = $(this).closest("tr");
            updateSalaryFields(row);
        });


        $("form#emp_salary_form").submit(function(e) {
            e.preventDefault();
            var clkbtn = $("#submit_salary");
            clkbtn.prop('disabled', true);
            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('Report/insert_salary'); ?>",
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
                            window.location = "<?php echo site_url('Report/emp_salary_list'); ?>";
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

    });
</script>