<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');
class Factories extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Factories_model'); // Load Model
        $this->load->library('form_validation'); // Load Form Validation Library
        $this->load->database(); // Load Database
        $this->load->helper(['url', 'form']); // Load URL and Form Helpers
    }


	public function index()
    {
        $data['factories'] = $this->Factories_model->get_all_factories();
        $this->load->view('factories', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Factory Name', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
            return;
        }

        $data = [
            'name' => $this->input->post('name'),
            'location' => $this->input->post('location'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $insertId = $this->Factories_model->insert_factory($data);

        if ($insertId) {
            echo json_encode([
                'success' => true,
                'id' => $insertId,
                'created_at' => $data['created_at']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to insert data.']);
        }
    }

	public function edit($id = null)
	{
		if ($id === null) {
			echo json_encode(['success' => false, 'message' => 'Invalid request.']);
			return;
		}

		// Fetch factory details
		$factory = $this->Factories_model->get_factory_by_id($id);

		if ($factory) {
			echo json_encode(['success' => true, 'data' => $factory]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Factory not found.']);
		}
	}

	public function update()
    {
        $this->form_validation->set_rules('id', 'Factory ID', 'required|numeric');
        $this->form_validation->set_rules('name', 'Factory Name', 'trim|required');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            echo json_encode(['success' => false, 'message' => validation_errors()]);
            return;
        }

        $id = $this->input->post('id');
        $data = [
            'name' => $this->input->post('name', TRUE),
            'location' => $this->input->post('location', TRUE),
        ];

        if ($this->Factories_model->update_factory($id, $data)) {
			$updated_factory = $this->Factories_model->get_factory_by_id($id);
            echo json_encode([
                'success' => true,
                'id' => $id,
                'name' => $data['name'],
                'location' => $data['location'],
				'created_at' => $updated_factory->created_at
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update factory.']);
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');

        if ($this->Factories_model->delete_factory($id)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete record.']);
        }
    }


}
