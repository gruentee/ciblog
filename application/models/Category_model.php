<?php
/**
 * Model representing categories in DB
 * 
 * @author Constantin Kraft
 * 
 */

class Category_model extends CI_Model {
    
    public function __construct()
    {    
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all categories
     * 
     * @return array of result arrays or empty array
     */
    public function get_categories()
    {
        $query = $this->db->get('category');
        return $query->result_array();
    }
    


    public function __destruct()
    {    

    }
}
