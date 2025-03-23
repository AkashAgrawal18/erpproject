<?php
class Stock_model extends CI_Model {

    public function deduct_stock($warehouse_id, $batch_id, $quantity) {
        $this->db->set('available_stock', 'available_stock - ' . (int)$quantity, FALSE);
        $this->db->where('warehouse_id', $warehouse_id);
        $this->db->where('batch_id', $batch_id);
        $this->db->where('available_stock >=', $quantity);
        $this->db->update('warehouse_stock');
        
        return $this->db->affected_rows() > 0;
    }

    public function update_stock($warehouse_id, $batch_id, $quantity) {
        $this->db->set('available_stock', 'available_stock + ' . (int)$quantity, FALSE);
        $this->db->where('warehouse_id', $warehouse_id);
        $this->db->where('batch_id', $batch_id);
        $this->db->update('warehouse_stock');
    }

    public function get_stock($warehouse_id, $batch_id) {
        return $this->db->get_where('warehouse_stock', [
            'warehouse_id' => $warehouse_id,
            'batch_id' => $batch_id
        ])->row_array();
    }
}
