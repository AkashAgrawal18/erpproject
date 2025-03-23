<?php
class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model');
    }

    public function add()
    {
        $invoice_id = $this->input->post('invoice_id');
        $entity_id = $this->input->post('entity_id');
        $amount_paid = $this->input->post('amount_paid');
        $payment_mode = $this->input->post('payment_mode');

        $data = [
            'invoice_id' => $invoice_id,
            'entity_id' => $entity_id,
            'amount_paid' => $amount_paid,
            'payment_mode' => $payment_mode,
            'payment_date' => date('Y-m-d H:i:s')
        ];

        $payment_id = $this->Payment_model->add_payment($data);

        if ($payment_id) {
            $this->session->set_flashdata('success', 'Payment recorded successfully.');
        } else {
            $this->session->set_flashdata('error', 'Payment failed.');
        }

        redirect('invoice/view/' . $invoice_id);
    }

    public function view_payments($invoice_id)
    {
        $data['payments'] = $this->Payment_model->get_payments_by_invoice($invoice_id);
        $this->load->view('payments_list', $data);
    }
}