<?php
class Discount_model extends CI_Model
{
    public function get_discount($entity_id)
    {
        $this->db->select('discount_percentage');
        $this->db->from('discounts');
        $this->db->join('entities', 'entities.entity_type = discounts.entity_type');
        $this->db->where('entities.id', $entity_id);
        return $this->db->get()->row_array();
    }

	public function getDiscountByEntityId($entity_id) {
        return $this->db->get_where('discounts', ['entity_id' => $entity_id])->row();
    }
}