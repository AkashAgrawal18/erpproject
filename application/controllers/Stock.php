<?php
class Stock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Stock_model');
    }

    public function check_stock($batch_id)
    {
        $stock = $this->Stock_model->get_stock($batch_id);
        echo json_encode($stock);
    }
}