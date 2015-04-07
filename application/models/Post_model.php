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
            //~ $this->db->select('*');
            //~ $this->db->from('post');
            //~ $this->db->join('user', 'user.id=author');
            // TODO: limit # of posts -> pagination
            $query = $this->db->get();
            $this->db->query($sql);
            return $query->result_array();
        }
        // TODO: validate slug, maybe via routing
        //~ $query = $this->db->get_where('post', array('slug' => $slug));
        // TODO: sanitize slug
        $sql = "SELECT `post`.*, `user`.username, `user`.id as user_id
                FROM `post`
                INNER JOIN `user` ON `post`.author = `user`.id
                WHERE `post`.slug = ?
                AND `post`.active=1";
        $query = $this->db->query($sql, array($slug));
        //~ echo($query);
        return $query->row_array();
    }
    
}
