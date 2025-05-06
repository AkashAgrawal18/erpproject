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
		$('#m_state').trigger('change');
		$('#m_state').on('change', function() {
			var selectedState = $(this).val();

			// Show only the cities that match the selected state
			$('#m_city option').each(function() {
				var cityState = $(this).data('state');

				if (!cityState || selectedState === "") {
					$(this).removeClass('d-none'); // show default "Select City"
				} else if (cityState == selectedState) {
					$(this).removeClass('d-none');
				} else {
					$(this).addClass('d-none');
				}
			});

			// Reset the city dropdown selection
			$('#m_city').val('').trigger('change');
		});



		const clockInBtn = $("#clockInBtn");
		const clockOutBtn = $("#clockOutBtn");
		var empId = "<?php echo $this->session->userdata('user_id'); ?>";

		// Initially check the clock-in status
		checkClockInStatus();
		console.log("Emp ID being sent: ", empId);

		// Clock In

		clockInBtn.click(async function() {
			try {
				let latitude = '';
				let longitude = '';
				const locations = await getLocation();
				latitude = locations.latitude;
				longitude = locations.longitude;
				$.ajax({
					url: "<?php echo base_url('Setting/clock_in'); ?>",
					type: "POST",
					data: {
						emp_id: empId,
						latitude,
						longitude
					},
					success: function(response) {
						const result = JSON.parse(response);
						if (result.status === "success") {
							swal(result.message, {
								icon: "success",
								timer: 1000,
							});
							toggleButtons("0");
						} else {
							swal(result.message, {
								icon: "error",
								timer: 4000,
							});
						}
					},
					error: function() {
						swal("Error occurred while clocking in.", {
							icon: "error",
							timer: 4000,
						});
					},
				});
			} catch (error) {
				console.error("Error:", error.message);
			}

		});
		clockOutBtn.click(async function() {
			try {
				let latitude = '';
				let longitude = '';
				const locations = await getLocation();
				latitude = locations.latitude;
				longitude = locations.longitude;

				$.ajax({
					url: "<?php echo base_url('Setting/clock_out'); ?>",
					type: "POST",
					data: {
						emp_id: empId,
						latitude,
						longitude
					}, // Pass employee ID to backend
					success: function(response) {
						const result = JSON.parse(response);
						if (result.status === "success") {
							swal(result.message, {
								icon: "success",
								timer: 1000,
							});
							toggleButtons("1");
						} else {
							swal(result.message, {
								icon: "error",
								timer: 4000,
							});
						}
					},
					error: function() {
						swal("Error occurred while clocking out.", {
							icon: "error",
							timer: 4000,
						});
					},
				});
			} catch (error) {
				console.error("Error:", error.message);
			}

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

	function getLocation() {
		return new Promise((resolve, reject) => {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(
					(position) => {
						resolve({
							latitude: position.coords.latitude,
							longitude: position.coords.longitude
						});
					},
					(error) => {
						reject(error);
					}
				);
			} else {
				reject(new Error("Geolocation is not supported by this browser."));
			}
		});
	}
</script>