<?php

class StockTransfer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Stock_model');
    }

    public function transfer()
    {
        $batch_id = $this->input->post('batch_id');
        $from_warehouse = $this->input->post('from_warehouse');
        $to_warehouse = $this->input->post('to_warehouse');
        $to_entity = $this->input->post('to_entity');
        $quantity = $this->input->post('quantity');

        if ($this->Stock_model->transfer_stock($batch_id, $from_warehouse, $to_warehouse, $to_entity, $quantity)) {
            $this->session->set_flashdata('success', 'Stock transferred successfully');
        } else {
            $this->session->set_flashdata('error', 'Stock transfer failed');
        }

        redirect('stock/transfer');
    }
}