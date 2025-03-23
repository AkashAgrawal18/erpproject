<?php
class Invoice extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Invoice_model');
		$this->load->model('Entity_model');
		$this->load->model('Discount_model');
		$this->load->model('Factories_model');
		$this->load->model('Batch_model');
		$this->load->model('Warehouse_model');
		$this->load->model('Stock_model');
	}

	public function list()
	{
		$data['pagename'] = "Invoice List";
		$this->load->view('invoice/list', $data);
	}

	public function get_invoices()
	{
		$this->load->model('Invoice_model');

		$postData = $this->input->post();
		$invoiceData = $this->Invoice_model->getInvoicesDataTables($postData);

		$data = [];
		if (!empty($invoiceData['data'])) {
			foreach ($invoiceData['data'] as $invoice) {
				$data[] = [
					"id" => $invoice->id,
					"invoice_number" => $invoice->invoice_number,
					"from_name" => $invoice->from_name,
					"to_name" => $invoice->to_name,
					"invoice_date" => $invoice->invoice_date,
					"due_date" => $invoice->due_date,
					"total_amount" => $invoice->total_amount,
					"due_amount" => $invoice->due_amount,
					"payment_status" => $invoice->payment_status ?? 'Pending',
					"status" => $invoice->status ?? 'Active'
				];
			}
		}

		$response = [
			"draw" => isset($postData['draw']) ? intval($postData['draw']) : 0,
			"recordsTotal" => $invoiceData['recordsTotal'] ?? 0,
			"recordsFiltered" => $invoiceData['recordsFiltered'] ?? 0,
			"data" => $data
		];

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function add()
	{
		$data['factories'] = $this->Factories_model->get_all_factories();
		$data['entities'] = $this->Entity_model->getEntities();
		$data['invoice_number'] = $this->Invoice_model->generateInvoiceNumber();
		$data['batches'] = $this->Batch_model->getBatchesWithProductDetails();
		$data['warehouses'] = $this->Warehouse_model->getAllWarehouses();

		$entitiesWithDiscounts = [];
		foreach ($data['entities'] as $entity) {
			$discount = $this->Discount_model->getDiscountByEntityId($entity->id);
			$entity->discount = $discount ? $discount->discount_percentage : 0;
			$entitiesWithDiscounts[] = $entity;
		}
		$defaultWarehouse = !empty($data['warehouses']) ? $data['warehouses'][0]->id : 1;
		$data['entities'] = $entitiesWithDiscounts;

		$this->load->view('invoice/add-invoice', $data);
	}

	// Fetch batches based on selected product
	public function get_batches()
	{
		$product_id = $this->input->post('product_id');
		$batches = $this->Batch_model->getBatchesByProduct($product_id);
		echo json_encode($batches);
	}

	public function save()
	{
		$this->load->library('form_validation');

		// Validate the main invoice fields
		$this->form_validation->set_rules('invoice_number', 'Invoice Number', 'required');
		$this->form_validation->set_rules('invoice_date', 'Invoice Date', 'required');
		$this->form_validation->set_rules('from_id', 'From', 'required');
		$this->form_validation->set_rules('to_id', 'To', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'message' => validation_errors()
			]);
			return;
		}

		// Invoice Data
		$invoiceData = [
			'invoice_number' => $this->input->post('invoice_number'),
			'invoice_date' => $this->input->post('invoice_date'),
			'from_id' => $this->input->post('from_id'),
			'to_id' => $this->input->post('to_id'),
			'total_amount' => $this->input->post('total_amount'),
			'total_discount' => $this->input->post('total_discount'),
			'total_pre_tax_amount' => $this->input->post('total_pre_tax_amount'),
			'total_cgst' => $this->input->post('total_cgst'),
			'total_sgst' => $this->input->post('total_sgst'),
			'final_amount' => $this->input->post('final_amount'),
			'amount_paid' => $this->input->post('amount_paid'),
			'due_amount' => $this->input->post('due_amount'),
			'due_date' => $this->input->post('due_date'),
			'remarks' => $this->input->post('remarks'),
			'created_at' => date('Y-m-d H:i:s')
		];

		// Insert Invoice and get ID
		$invoice_id = $this->Invoice_model->insert_invoice($invoiceData);

		if (!$invoice_id) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Failed to save invoice. Please try again.'
			]);
			return;
		}

		// Invoice Items
		$batch_ids = $this->input->post('batch_id');
		$product_ids = $this->input->post('product_id');
		$quantities = $this->input->post('quantity');
		$discount_percents = $this->input->post('discount_percentage');
		$discounted_amounts = $this->input->post('discounted_amount');
		$pre_tax_amounts = $this->input->post('pre_tax_amount');
		$cgsts = $this->input->post('cgst');
		$sgsts = $this->input->post('sgst');
		$net_amounts = $this->input->post('net_amount');
		$expiry_dates = $this->input->post('expiry_date');

		$items = [];
		foreach ($batch_ids as $key => $batch_id) {
			if (!empty($batch_id) && !empty($quantities[$key])) { // Prevent empty inserts
				$items[] = [
					'invoice_id' => $invoice_id,
					'batch_id' => $batch_id,
					'product_id' => $product_ids[$key],
					'quantity' => $quantities[$key],
					'expiry_date' => $expiry_dates[$key],
					'discount_percentage' => $discount_percents[$key],
					'discounted_amount' => $discounted_amounts[$key],
					'pre_tax_amount' => $pre_tax_amounts[$key],
					'cgst' => $cgsts[$key],
					'sgst' => $sgsts[$key],
					'net_amount' => $net_amounts[$key]
				];

				$stock_status = $this->update_stock_on_add($batch_id, $quantities[$key]);

				if ($stock_status['status'] === 'error') {
					echo json_encode($stock_status);
					return;
				}
			}
		}

		if (!empty($items)) {
			$this->Invoice_model->insert_invoice_items($items);
		}

		// Invoice Payment
		$paymentData = [
			'invoice_id' => $invoice_id,
			'amount_paid' => $this->input->post('amount_paid'),
			'due_amount' => $this->input->post('due_amount'),
			'created_at' => date('Y-m-d H:i:s')
		];

		// $this->Invoice_model->insert_invoice_payment($paymentData);

		echo json_encode([
			'status' => 'success',
			'message' => 'Invoice saved successfully!'
		]);
	}

	public function edit($invoice_id)
	{
		$data['invoice'] = $this->Invoice_model->get_invoice_by_id($invoice_id);
		$data['invoice_items'] = $this->Invoice_model->get_invoice_items($invoice_id);

		$data['batches'] = $this->Batch_model->getBatchesWithProductDetails();
		// echo '<br>';
		// print_r($data['invoice']);
		// exit;
		$data['factories'] = $this->Factories_model->get_all_factories();
		$data['entities'] = $this->Entity_model->getEntities();
		$entitiesWithDiscounts = [];
		foreach ($data['entities'] as $entity) {
			$discount = $this->Discount_model->getDiscountByEntityId($entity->id);
			$entity->discount = $discount ? $discount->discount_percentage : 0;
			$entitiesWithDiscounts[] = $entity;
		}
		$data['entities'] = $entitiesWithDiscounts;
		$this->load->view('invoice/edit-invoice', $data);
	}

	public function update($invoice_id)
	{
		$this->load->library('form_validation');

		// Validate invoice fields
		$this->form_validation->set_rules('invoice_number', 'Invoice Number', 'required');
		$this->form_validation->set_rules('invoice_date', 'Invoice Date', 'required');
		$this->form_validation->set_rules('from_id', 'From', 'required');
		$this->form_validation->set_rules('to_id', 'To', 'required');

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => 'error',
				'message' => validation_errors()
			]);
			return;
		}

		// Invoice Data Update
		$invoiceData = [
			'invoice_number' => $this->input->post('invoice_number'),
			'invoice_date' => $this->input->post('invoice_date'),
			'from_id' => $this->input->post('from_id'),
			'to_id' => $this->input->post('to_id'),
			'total_amount' => $this->input->post('total_amount'),
			'total_discount' => $this->input->post('total_discount'),
			'total_pre_tax_amount' => $this->input->post('total_pre_tax_amount'),
			'total_cgst' => $this->input->post('total_cgst'),
			'total_sgst' => $this->input->post('total_sgst'),
			'final_amount' => $this->input->post('final_amount'),
			'amount_paid' => $this->input->post('amount_paid'),
			'due_amount' => $this->input->post('due_amount'),
			'due_date' => $this->input->post('due_date'),
			'remarks' => $this->input->post('remarks'),
			'updated_at' => date('Y-m-d H:i:s')
		];

		$this->Invoice_model->update_invoice($invoice_id, $invoiceData);

		// Get existing invoice item IDs from DB
		$existingItems = $this->Invoice_model->get_invoice_items_by_invoice_id($invoice_id);
		$existingItemIds = array_column($existingItems, 'id'); // Array of existing item IDs

		// Get posted invoice items
		$batch_ids = $this->input->post('batch_id');
		$product_ids = $this->input->post('product_id');
		$quantities = $this->input->post('quantity');
		$discount_percents = $this->input->post('discount_percentage');
		$discounted_amounts = $this->input->post('discounted_amount');
		$pre_tax_amounts = $this->input->post('pre_tax_amount');
		$cgsts = $this->input->post('cgst');
		$sgsts = $this->input->post('sgst');
		$net_amounts = $this->input->post('net_amount');
		$expiry_dates = $this->input->post('expiry_date');
		$item_ids = $this->input->post('item_id'); // Hidden field for existing item IDs

		$updatedItemIds = []; // Store updated item IDs to compare later
		$itemsToInsert = [];

		foreach ($batch_ids as $key => $batch_id) {
			if (!empty($batch_id) && !empty($quantities[$key])) {
				if (!empty($item_ids[$key])) {
					$oldItem = $existingItemMap[$item_ids[$key]];
					$stock_status = $this->update_stock_on_update(
						$oldItem->batch_id,  // Old batch
						$batch_id,  // New batch
						$oldItem->quantity,  // Old quantity
						$quantities[$key]  // New quantity
					);

					if ($stock_status['status'] === 'error') {
						echo json_encode($stock_status);
						return;
					}
					// Existing item: Update
					$updatedItemIds[] = $item_ids[$key];
					$this->Invoice_model->update_invoice_item($item_ids[$key], [
						'batch_id' => $batch_id,
						'product_id' => $product_ids[$key],
						'quantity' => $quantities[$key],
						'expiry_date' => $expiry_dates[$key],
						'discount_percentage' => $discount_percents[$key],
						'discounted_amount' => $discounted_amounts[$key],
						'pre_tax_amount' => $pre_tax_amounts[$key],
						'cgst' => $cgsts[$key],
						'sgst' => $sgsts[$key],
						'net_amount' => $net_amounts[$key],
						'updated_at' => date('Y-m-d H:i:s')
					]);
				} else {
					// New item: Insert
					$itemsToInsert[] = [
						'invoice_id' => $invoice_id,
						'batch_id' => $batch_id,
						'product_id' => $product_ids[$key],
						'quantity' => $quantities[$key],
						'expiry_date' => $expiry_dates[$key],
						'discount_percentage' => $discount_percents[$key],
						'discounted_amount' => $discounted_amounts[$key],
						'pre_tax_amount' => $pre_tax_amounts[$key],
						'cgst' => $cgsts[$key],
						'sgst' => $sgsts[$key],
						'net_amount' => $net_amounts[$key],
						'created_at' => date('Y-m-d H:i:s')
					];
				}
			}
		}

		// Insert new items
		if (!empty($itemsToInsert)) {
			$this->Invoice_model->insert_invoice_items($itemsToInsert);
		}

		// Mark deleted items as "deleted_on"
		$itemsToDelete = array_diff($existingItemIds, $updatedItemIds); // Items in DB but not in updated list
		if (!empty($itemsToDelete)) {
			$this->Invoice_model->mark_invoice_items_deleted($itemsToDelete);
		}

		// Invoice Payment
		$paymentData = [
			'invoice_id' => $invoice_id,
			'amount_paid' => $this->input->post('amount_paid'),
			'due_amount' => $this->input->post('due_amount'),
			'updated_at' => date('Y-m-d H:i:s')
		];

		// $this->Invoice_model->update_invoice_payment($invoice_id, $paymentData);

		echo json_encode([
			'status' => 'success',
			'message' => 'Invoice updated successfully!'
		]);
	}

	public function get_invoice($invoice_id)
	{
		$this->load->model('Invoice_model');

		// Fetch invoice details
		$invoice = $this->Invoice_model->get_invoice_by_id($invoice_id);

		if (!$invoice) {
			echo json_encode(['status' => 'error', 'message' => 'Invoice not found']);
			return;
		}

		// Fetch invoice items
		$invoice_items = $this->Invoice_model->get_invoice_items_data($invoice_id);
		// echo'<br>';print_r($invoice_items);exit;
		// Format response
		$response = [
			'status' => 'success',
			'invoice' => [
				'invoice_number' => $invoice->invoice_number,
				'invoice_date' => $invoice->invoice_date,
				'from_id' => $invoice->from_id,
				'to_id' => $invoice->to_id,
				'amount_paid' => $invoice->amount_paid,
				'due_date' => $invoice->due_date,
				'remarks' => $invoice->remarks,
				'items' => $invoice_items
			]
		];

		echo json_encode($response);
	}

	public function download_invoice($invoice_id)
	{
		$this->load->library('pdf_library');

		// Fetch Invoice Details with Factory and Entity Details
		$this->db->select('invoices.*, factories.name as from_name, entities.name as to_name');
		$this->db->from('invoices');
		$this->db->join('factories', 'invoices.from_id = factories.id', 'left');
		$this->db->join('entities', 'invoices.to_id = entities.id', 'left');
		$this->db->where('invoices.id', $invoice_id);
		$invoiceData = $this->db->get()->row(); // Fetch single row

		// Fetch Invoice Items
		$this->db->select('invoice_items.*, master_product_tbl.m_pro_name as product_name, invoice_items.discounted_amount,batches.batch_number');
		$this->db->from('invoice_items');
		$this->db->join('batches', 'batches.id = invoice_items.batch_id', 'left');
		$this->db->join('master_product_tbl', 'invoice_items.product_id = master_product_tbl.m_pro_id', 'left');
		$this->db->where('invoice_items.invoice_id', $invoice_id);
		$invoiceItems = $this->db->get()->result(); // Fetch multiple rows

		// Debugging: Check if data is fetched correctly
		if (!$invoiceData) {
			show_error('Invoice not found!', 404);
		}

		// Generate PDF
		$this->pdf_library->generate_invoice_pdf($invoiceData, $invoiceItems);
	}
}