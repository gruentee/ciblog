<?php
/**
 * Model representing tags in DB
 * 
 * @author Constantin Kraft
 * 
 */

class Tag_model extends CI_Model {
    
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
    public function get_tags()
    {
        $query = $this->db->get('tag');
        return $query->result_array();
    }
    
    public function __destruct()
    {    

    }
}
