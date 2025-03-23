<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entity_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getFactories() {
        $this->db->where('entity_type', 'factory');
        return $this->db->get('entities')->result();
    }

    public function getEntities() {
        return $this->db->get('entities')->result();
    }
}
?>
