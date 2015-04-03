<?php
/**
 * Model for blog posts
 * 
 * @author Constantin Kraft
 *
 */
class Post_model extends CI_Model 
{
    public function __construct()
    {    
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get all posts or post specified by slug from DB
     * 
     * @param String slug identifying the post
     * @return Array array of record OR rows found
     */
    public function get_posts($slug = FALSE)
    {
        if ($slug === FALSE ) 
        {
            $query = $this->db->get('post');
            return $query->result_array();
        }
        // TODO: sanitize slug, maybe via routing
        $query = $this->db->get_where('post', array('slug' => $slug));
        return $query->row_array();
    }
    
}
