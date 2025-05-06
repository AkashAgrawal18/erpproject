<?php date_default_timezone_set('Asia/Kolkata');
class Report_model extends CI_model
{

	/* ======================================= attendence report ======================================== */
	public function get_emp_attd($from_month = '')
	{
		$result = [];

		// Get list of employees
		$emp_list = $this->db->select('m_emp_id, m_emp_name, m_emp_mobile, m_emp_rest, m_start_time')
			->join('master_department_tbl shift', 'shift.m_dept_id = master_employee_tbl.m_emp_dshift', 'left')
			->where('m_emp_status', 1)
			->get('master_employee_tbl')
			->result();

		// Get month days count
		$monthdays = date('t', strtotime("01-$from_month"));

		if (!empty($emp_list)) {
			$start_date = date('Y-m-01', strtotime("01-$from_month"));
			$end_date = date('Y-m-t', strtotime("01-$from_month"));

			// Batch fetch attendance records
			$attendance_data = $this->db->select('m_std_id, m_emp_id, m_date, m_time_in, m_time_out')
				->where('m_date >=', $start_date)
				->where('m_date <=', $end_date)
				->get('master_emp_attendance')
				->result();

			// Convert attendance to an associative array for faster lookup
			$attendance_map = [];
			foreach ($attendance_data as $attd) {
				$attendance_map[$attd->m_emp_id][$attd->m_date] = $attd;
			}

			// Batch fetch holidays
			$holidays = $this->db->select('m_hol_date, m_hol_name')
				->where('m_hol_date >=', $start_date)
				->where('m_hol_date <=', $end_date)
				->get('master_holiday_tbl')
				->result();

			// Convert holidays to an associative array for fast lookup
			$holiday_map = [];
			foreach ($holidays as $hol) {
				$holiday_map[$hol->m_hol_date] = $hol->m_hol_name;
			}

			// Batch fetch leaves
			$leaves = $this->db->select('m_leav_id, m_leav_empname, m_leav_fromdate, m_leav_todate')
				->where('m_leav_fromdate <=', $end_date)
				->where('m_leav_todate >=', $start_date)
				->get('master_leaves_tbl')
				->result();

			// Convert leaves to an associative array for fast lookup
			$leave_map = [];
			foreach ($leaves as $leave) {
				for ($d = strtotime($leave->m_leav_fromdate); $d <= strtotime($leave->m_leav_todate); $d += 86400) {
					$leave_map[$leave->m_leav_empname][date('Y-m-d', $d)] = $leave->m_leav_id;
				}
			}

			// Process each employee
			foreach ($emp_list as $emp) {
				$emp->attdn_status = [];

				// Loop through each day in the month
				for ($i = 1; $i <= $monthdays; $i++) {
					$date = date('Y-m-d', strtotime("$i-$from_month"));

					$present = isset($attendance_map[$emp->m_emp_id][$date]) ? $attendance_map[$emp->m_emp_id][$date] : null;
					$holiday = isset($holiday_map[$date]) ? $holiday_map[$date] : null;
					$leave = isset($leave_map[$emp->m_emp_id][$date]) ? $leave_map[$emp->m_emp_id][$date] : null;

					if (!empty($present) && !empty($present->m_time_in) && !empty($present->m_time_out)) {
						$status = 1;
						$attd_id = $present->m_std_id;
					} elseif (!empty($present) && !empty($present->m_time_in)) {
						$status = 2;
						$attd_id = $present->m_std_id;
					} elseif (!empty($holiday) || date('N', strtotime($date)) == $emp->m_emp_rest) {
						$status = 3;
						$attd_id = $holiday ?: "Week Off";
					} elseif (!empty($leave)) {
						$status = 4;
						$attd_id = $leave;
					} elseif ($date <= date('Y-m-d')) {
						$status = 5;
						$attd_id = '';
					} else {
						$status = 0;
						$attd_id = '';
					}

					$emp->attdn_status[] = (object) [
						"date" => $date,
						"status" => $status,
						"attd_id" => $attd_id ?: '',
					];
				}

				$result[] = $emp;
			}
		}

		return $result;
	}


	public function get_empatt_detail($attd_id, $type)
	{
		if ($type == 1) {
			return $this->db->select('emp.m_emp_id,emp.m_emp_name,emp.m_emp_pic,emp.m_emp_mobile,emp.m_emp_rest,shift.m_start_time,shift.m_dept_name,m_time_in,m_time_out,m_date')
				->join('master_employee_tbl emp', 'emp.m_emp_id = master_emp_attendance.m_emp_id', 'left')
				->join('master_department_tbl shift', 'shift.m_dept_id = emp.m_emp_dshift', 'left')
				->where('m_std_id', $attd_id)->get('master_emp_attendance')->row();
		} else if ($type == 2) {
			return $this->db->select('master_leaves_tbl.*,emp.m_emp_id,emp.m_emp_name,emp.m_emp_pic,emp.m_emp_mobile,shift.m_start_time,shift.m_dept_name')
				->join('master_employee_tbl emp', 'emp.m_emp_id = master_leaves_tbl.m_leav_empname', 'left')
				->join('master_department_tbl shift', 'shift.m_dept_id = emp.m_emp_dshift', 'left')
				->where('m_leav_id', $attd_id)->get('master_leaves_tbl')->row();
		}
	}

	/* ======================================= attendence report ======================================== */

	/* ======================================= Stock report ======================================== */

	public function get_stock($prodId, $store = '', $todate = '', $day = '')
	{
		// Helper function to apply date filter
		$apply_date_filter = function ($field) use ($todate, $day) {
			if (!empty($todate)) {
				if ($day == 1) {
					$this->db->where($field, $todate);
				} else {
					$this->db->where("DATE_FORMAT($field, '%Y-%m-%d') <=", $todate);
				}
			}
		};

		// Get stock in
		$apply_date_filter('stk_trans_date');
		if (!empty($store)) {
			$this->db->where('stk_trans_to', $store);
		} else {
			$this->db->where('stk_trans_from', 0); // overall product stock
		}
		$in_qry = $this->db->select('SUM(stk_trans_qty) as totalqty')
			->where('stk_trans_prod', $prodId)
			->get('stock_transfers')
			->row();
		$total_in = $in_qry ? $in_qry->totalqty : 0;
		$this->db->reset_query();

		// Get stock out (only for store-specific)
		$total_out = 0;
		if (!empty($store)) {
			$apply_date_filter('stk_trans_date');
			$out_qry = $this->db->select('SUM(stk_trans_qty) as totalqty')
				->where('stk_trans_from', $store)
				->where('stk_trans_prod', $prodId)
				->get('stock_transfers')
				->row();
			$total_out = $out_qry ? $out_qry->totalqty : 0;
			$this->db->reset_query();
		}

		// Get sales
		if (!empty($store)) {
			$this->db->join('invoice_tbl', 'invoice_tbl.m_inv_id = invoice_items_tbl.inv_item_invoice');
			$this->db->where('m_inv_store', $store);
		}
		$apply_date_filter('inv_item_date');
		$sale_qry = $this->db->select('SUM(inv_item_qty) as totalqty')
			->where('inv_item_product', $prodId)
			->get('invoice_items_tbl')
			->row();
		$total_sale = $sale_qry ? $sale_qry->totalqty : 0;

		// Final result
		$balance_qty = $store !== '' ? $total_in - ($total_out + $total_sale) : $total_in - $total_sale;

		return (object)[
			'total_in'      => $store !== '' ? $total_in : 0,
			'total_out'     => $store !== '' ? $total_out : 0,
			'total_sale'    => $total_sale,
			'balance_qty'   => $balance_qty ?: 0
		];
	}


	public function store_wise_stock($curr_date, $store, $cate = '', $subcate = '')
	{
		$result = array();
		if (!empty($cate)) {
			$this->db->where('m_pro_cate', $cate);
		}
		if (!empty($subcate)) {
			$this->db->where('m_pro_subcate', $subcate);
		}
		$prod_list = $this->db->select('m_pro_id,m_pro_name,cate.m_cat_name as category_name,subcate.m_cat_name as subcategory_name,pkg.m_cat_name as package_name,size.m_cat_name as size_name,brand.m_cat_name as brand_name')->join('master_cate_tbl as cate', 'master_product_tbl.m_pro_cate = cate.m_cat_id')->join('master_cate_tbl as subcate', 'master_product_tbl.m_pro_subcate = subcate.m_cat_id')->join('master_cate_tbl as pkg', 'master_product_tbl.m_pro_pack = pkg.m_cat_id')->join('master_cate_tbl as size', 'master_product_tbl.m_pro_size = size.m_cat_id')->join('master_cate_tbl as brand', 'master_product_tbl.m_pro_brand = brand.m_cat_id')->where('m_pro_status', 1)->order_by('m_pro_name')->get('master_product_tbl')->result();

		if (!empty($prod_list)) {
			foreach ($prod_list as $prod) {
				$opening_bal = $this->get_stock($prod->m_pro_id, $store, date('Y-m-d', strtotime($curr_date . '-1 day')));

				$today_bal = $this->get_stock($prod->m_pro_id, $store, $curr_date, 1);
				$res = (object)array(
					"m_pro_id" => $prod->m_pro_id,
					"m_pro_name" => $prod->m_pro_name,
					"category_name" => $prod->category_name,
					"subcategory_name" => $prod->subcategory_name,
					"package_name" => $prod->package_name,
					"size_name" => $prod->size_name,
					"brand_name" => $prod->brand_name,
					"opening_stock" => $opening_bal->balance_qty,
					"todays_pkg" => $today_bal->total_in ?: 0,
					"todays_sale" => ($today_bal->total_out + $today_bal->total_sale) ?: 0,
					"closing_stock" => $opening_bal->balance_qty + $today_bal->balance_qty,
				);
				$result[] = $res;
			}
		}
		return $result;
	}
	/* ======================================= Stock report ======================================== */
}
