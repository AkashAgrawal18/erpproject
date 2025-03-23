<?php
class Factories_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Fetch all factories
     *
     * @return array
     */
    public function get_all_factories()
    {
        $query = $this->db->where('deleted_on', NULL)->order_by('created_at', 'DESC')->get('factories');
        return $query->result();
    }

    /**
     * Insert new factory
     *
     * @param array $data
     * @return int|bool
     */
    public function insert_factory($data)
    {
        $this->db->insert('factories', $data);
        return $this->db->insert_id(); // Return inserted ID
    }

    /**
     * Get factory by ID
     *
     * @param int $id
     * @return object|null
     */
    public function get_factory_by_id($id)
    {
        $query = $this->db->get_where('factories', ['id' => $id]);
        return $query->row(); // Returns a single object or NULL
    }


    /**
     * Update factory details
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
	public function update_factory($id, $data)
	{
		$data['updated_at'] = date('Y-m-d H:i:s');
	
		$this->db->where('id', $id);
		return $this->db->update('factories', $data);
	}

    /**
     * Delete factory by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete_factory($id)
    {
        return $this->db->delete('factories', ['id' => $id]);
    }

    /**
     * Check if a factory exists
     *
     * @param int $id
     * @return bool
     */
    public function factory_exists($id)
    {
        $query = $this->db->get_where('factories', ['id' => $id]);
        return $query->num_rows() > 0;
    }
}
