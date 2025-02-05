<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('.datatable').DataTable({
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script type="text/javascript">
 	$(document).ready(function() {
 		const clockInBtn = $("#clockInBtn");
 		const clockOutBtn = $("#clockOutBtn");
 		var empId = "<?php echo $this->session->userdata('user_id'); ?>";

 		// Initially check the clock-in status
 		checkClockInStatus();
 		console.log("Emp ID being sent: ", empId);

 		// Clock In
 		clockInBtn.click(function() {
 			$.ajax({
 				url: "<?php echo base_url('Setting/clock_in'); ?>",
 				type: "POST",
 				data: {
 					emp_id: empId
 				},
 				success: function(response) {
 					const result = JSON.parse(response);
 					if (result.status === "success") {
 						alert(result.message);
 						toggleButtons("0");
 					} else {
 						alert(result.message);
 					}
 				},
 				error: function() {
 					alert("Error occurred while clocking in.");
 				},
 			});
 		});

 		// Clock Out
 		clockOutBtn.click(function() {
 			$.ajax({
 				url: "<?php echo base_url('Setting/clock_out'); ?>",
 				type: "POST",
 				data: {
 					emp_id: empId
 				}, // Pass employee ID to backend
 				success: function(response) {
 					const result = JSON.parse(response);
 					if (result.status === "success") {
 						alert(result.message);
 						toggleButtons("1");
 					} else {
 						alert(result.message);
 					}
 				},
 				error: function() {
 					alert("Error occurred while clocking out.");
 				},
 			});
 		});

 		// Check Clock-In Status
 		function checkClockInStatus() {
 			$.ajax({
 				url: "<?php echo base_url('Setting/check_status'); ?>",
 				type: "GET",
 				success: function(response) {
 					const result = JSON.parse(response);
 					if (result.status === "1") {
 						toggleButtons("1");
 					} else {
 						toggleButtons("0");
 					}
 				},
 				error: function() {
 					alert("Error occurred while checking status.");
 				},
 			});
 		}

 		// Toggle Buttons
 		function toggleButtons(status) {
 			if (status === "0") {
 				clockInBtn.hide();
 				clockOutBtn.show();
 			} else {
 				clockInBtn.show();
 				clockOutBtn.hide();
 			}
 		}

 	});
 </script>
