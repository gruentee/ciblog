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
     * Get all tags
     * 
     * @return array of result arrays or empty array
     */
    public function get_tags()
    {
        $query = $this->db->get('tag');
        return $query->result_array();
    }
    
    /**
     * get tags by post
     *
     * @param int post_id of tagged post for which to get tags
     * @return array of tag records or empty array
     */
    public function get_tags_by_post($id)
    {
        $sql = "SELECT tag.id, tag.tag  FROM posts_tags 
                JOIN tag  ON tag.id=posts_tags.tag_id WHERE post_id=?";
        $query = $this->db->query($sql, $id);
        return $query->result_array();
    }
    
    
    public function __destruct()
    {    

    }
}
