<script type="text/javascript">
$(document).ready(function() {
    // Function to update Absent & Payable Salary
    function updateSalaryFields(row) {
        let totalDays = parseInt(row.find("input[name='total_days[]']").val()) || 0;
        let present = parseInt(row.find("input[name='present[]']").val()) || 0;
        let leave = parseInt(row.find("input[name='leave[]']").val()) || 0;
        let salary = parseFloat(row.find("input[name='salary[]']").val()) || 0;

        // Calculate absent days
        // let absent = totalDays - (present + leave);
        let absent = totalDays - (present + leave);
        row.find("input[name='absent[]']").val(absent);

        // Calculate payable salary
        let dailySalary = totalDays > 0 ? salary / totalDays : 0;
        // let payable = dailySalary * (present + leave);
        let payable = dailySalary * (present);
        row.find("input[name='payable[]']").val(payable.toFixed(2));

        // Mark row as changed
        row.attr("data-changed", "true");
    }

    // Attach event listener to track changes in Present, Leave, and Salary inputs
    $(document).on("input", "input[name='present[]'], input[name='leave[]'], input[name='salary[]']", function() {
        let row = $(this).closest("tr");
        updateSalaryFields(row);
    });

    // Form Submission - Only Submit Modified Rows
    $("#emp_salary_form").submit(function(e) {
        e.preventDefault();
        var clkbtn = $("#submit_salary");
        clkbtn.prop('disabled', true);

        let modifiedData = [];

        $("#empsly_tbl tbody tr").each(function() {
            if ($(this).attr("data-changed") === "true") {
                let row = $(this);
                modifiedData.push({
                    emp_id: row.find("input[name='emp_id[]']").val(),
                    salary: row.find("input[name='salary[]']").val(),
                    total_days: row.find("input[name='total_days[]']").val(),
                    present: row.find("input[name='present[]']").val(),
                    absent: row.find("input[name='absent[]']").val(),
                    leave: row.find("input[name='leave[]']").val(),
                    payable: row.find("input[name='payable[]']").val()
                });
            }
        });

        if (modifiedData.length === 0) {
            swal("No changes detected!", { icon: "info", timer: 1500 });
            clkbtn.prop('disabled', false);
            return;
        }

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('report/insert_salary'); ?>",
            data: { salaries: modifiedData },
            dataType: "JSON",
            success: function(response) {
                if (response.status === 'success') {
                    swal(response.message, { icon: "success", timer: 1000 });
                    setTimeout(function() { window.location.reload(); }, 1000);
                } else {
                    swal(response.message, { icon: "error", timer: 5000 });
                    clkbtn.prop('disabled', false);
                }
            },
            error: function() {
                swal("Some Problem Occurred! Please try again.", { icon: "error", timer: 2000 });
                clkbtn.prop('disabled', false);
            }
        });
    });
});


</script>
