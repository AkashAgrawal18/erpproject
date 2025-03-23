<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function getInvoicesDataTables($postData)
	{
		$columns = ["invoice_number", "from_name", "to_name", "invoice_date", "due_date", "total_amount", "due_amount", "payment_status", "status"];

		$this->db->select("i.*, 
			COALESCE(f.name, e_from.name) AS from_name, 
			e_to.name AS to_name,
			(i.total_amount - COALESCE(p.paid_amount, 0)) AS due_amount");
		$this->db->from("invoices i");
		$this->db->join("factories f", "i.from_id = f.id", "left");
		$this->db->join("entities e_from", "i.from_id = e_from.id", "left");
		$this->db->join("entities e_to", "i.to_id = e_to.id", "left");
		$this->db->join("(SELECT invoice_id, SUM(amount_paid) as paid_amount FROM payments GROUP BY invoice_id) p", "i.id = p.invoice_id", "left");

		if (!empty($postData['search']['value'])) {
			$this->db->group_start();
			foreach ($columns as $col) {
				$this->db->or_like($col, $postData['search']['value']);
			}
			$this->db->group_end();
		}

		$cloneDb = clone $this->db;
		$filteredRecords = $cloneDb->count_all_results();

		if (!empty($postData['order'])) {
			$this->db->order_by($columns[$postData['order'][0]['column']], $postData['order'][0]['dir']);
		} else {
			$this->db->order_by("i.id", "DESC");
		}

		if ($postData['length'] != -1) {
			$this->db->limit($postData['length'], $postData['start']);
		}

		$query = $this->db->get();
		$totalRecords = $this->db->count_all("invoices");

		return [
			"data" => $query->result(),
			"recordsTotal" => $totalRecords,
			"recordsFiltered" => $filteredRecords
		];
	}


	// Generate unique invoice number
	public function generateInvoiceNumber()
	{
		$this->db->select('MAX(id) as max_id');
		$query = $this->db->get('invoices');
		$row = $query->row();
		return 'INV-' . str_pad($row->max_id + 1, 6, '0', STR_PAD_LEFT);
	}

	// Insert invoice
	public function insert_invoice($data)
	{
		$this->db->insert('invoices', $data);
		return $this->db->insert_id();
	}

	public function insert_invoice_items($items)
	{
		return $this->db->insert_batch('invoice_items', $items);
	}

	public function insert_payment($data)
	{
		return $this->db->insert('payments', $data);
	}

	public function get_invoice_by_id($invoice_id)
	{
		return $this->db->get_where('invoices', ['id' => $invoice_id, 'deleted_on' => NULL])->row();
	}

	public function get_invoice_items($invoice_id)
	{
		$this->db->select('
        invoice_items.*, batches.batch_number,batches.id,
        master_product_tbl.m_pro_name as product_name, 
    ');
		$this->db->from('invoice_items');
		$this->db->join('master_product_tbl', 'master_product_tbl.m_pro_id = invoice_items.product_id', 'left');
		$this->db->join('batches', 'batches.id  = invoice_items.batch_id ', 'left');
		$this->db->where('invoice_items.invoice_id', $invoice_id);
		$this->db->where('invoice_items.deleted_on', NULL);

		return $this->db->get()->result();
	}

	public function get_invoice_list()
	{
		$this->db->select('invoices.*, customers.name AS customer_name');
		$this->db->from('invoices');
		$this->db->join('customers', 'invoices.to_entity_id = customers.id', 'left');
		$this->db->order_by('invoices.id', 'DESC');
		return $this->db->get()->result_array();
	}

	public function update_invoice($invoice_id, $data)
	{
		$this->db->where('id', $invoice_id);
		return $this->db->update('invoices', $data);
	}

	public function soft_delete_invoice_items($invoice_id)
	{
		$this->db->where('invoice_id', $invoice_id);
		return $this->db->update('invoice_items', ['deleted_on' => date('Y-m-d H:i:s')]);
	}

	public function mark_invoice_items_deleted($item_ids)
	{
		$this->db->where_in('id', $item_ids);
		return $this->db->update('invoice_items', ['deleted_on' => date('Y-m-d H:i:s')]);
	}

	public function update_invoice_payment($invoice_id, $data)
	{
		$this->db->where('invoice_id', $invoice_id);
		return $this->db->update('invoice_payments', $data);
	}

	public function get_invoice_batches($invoice_id)
	{
		$this->db->select('batch_id, product_id, quantity, discount_percentage, discounted_amount, pre_tax_amount, cgst, sgst, net_amount, expiry_date');
		$this->db->from('invoice_items');
		$this->db->where('invoice_id', $invoice_id);

		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_invoice_items_data($invoice_id)
	{
		$this->db->select('
			invoice_items.*, 
			invoices.*,
			master_product_tbl.m_pro_name as product_name, 
			batches.price, 
			batches.batch_number , 
			batches.expiry_date
		');
		$this->db->from('invoice_items');
		$this->db->join('invoices', 'invoice_items.invoice_id = invoices.id', 'left');
		$this->db->join('master_product_tbl', 'invoice_items.product_id = master_product_tbl.m_pro_id', 'left');
		$this->db->join('batches', 'invoice_items.batch_id = batches.id', 'left');
		$this->db->where('invoice_items.invoice_id', $invoice_id);

		return $this->db->get()->result();
	}


	public function get_invoice_data_by_id($invoice_id)
	{
		$this->db->select('invoices.*, from_tbl.name as from_name, to_tbl.name as to_name');
		$this->db->from('invoices');
		$this->db->join('factories as from_tbl', 'invoices.from_id = from_tbl.id', 'left');
		$this->db->join('entities as to_tbl', 'invoices.to_id = to_tbl.id', 'left');
		$this->db->where('invoices.id', $invoice_id);

		return $this->db->get()->row();
	}

	public function get_invoice_items_by_invoice_id($invoice_id)
	{
		return $this->db->get_where('invoice_items', ['invoice_id' => $invoice_id, 'deleted_on' => NULL])->result_array();
	}


	public function update_invoice_item($item_id, $data)
	{
		$this->db->where('id', $item_id);
		return $this->db->update('invoice_items', $data);
	}
}