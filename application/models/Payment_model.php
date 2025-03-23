<?php
class Payment_model extends CI_Model
{
    public function add_payment($data)
    {
        $this->db->insert('payments', $data);
        $payment_id = $this->db->insert_id();

        // Update invoice payment status
        $this->update_invoice_payment($data['invoice_id'], $data['amount_paid']);

        return $payment_id;
    }

    private function update_invoice_payment($invoice_id, $amount_paid)
    {
        // Get invoice details
        $this->db->where('id', $invoice_id);
        $invoice = $this->db->get('invoices')->row_array();

        if ($invoice) {
            $new_total_paid = $invoice['amount_paid'] + $amount_paid;
            $payment_status = ($new_total_paid >= $invoice['final_amount']) ? 'Paid' : 'Partially Paid';

            // Update invoice record
            $this->db->where('id', $invoice_id);
            $this->db->update('invoices', [
                'amount_paid' => $new_total_paid,
                'payment_status' => $payment_status
            ]);
        }
    }

    public function get_payments_by_invoice($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        return $this->db->get('payments')->result_array();
    }
}