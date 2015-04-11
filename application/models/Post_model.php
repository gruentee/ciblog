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
        $sql_select = "SELECT `post`.*, `user`.username, `user`.id as user_id
                FROM `post`
                INNER JOIN `user` ON `post`.author = `user`.id ";
        $sql_where = "WHERE `post`.slug = ? AND `post`.active=1";
        if ($slug === FALSE ) 
        {
            // TODO: limit # of posts -> pagination
            //~ $query = $this->db->get();
            $query = $this->db->query($sql_select);
            return $query->result_array();
        }
        // TODO: validate slug, maybe via routing
        //~ $query = $this->db->get_where('post', array('slug' => $slug));
        // TODO: sanitize slug
        $query = $this->db->query($sql_select . $sql_where, array($slug));
        //~ echo($query);
        return $query->row_array();
    }
    
    /**
     * insert single post
     *
     * @return boolean on post insertion, tag insertion fails quietly
     */
    public function insert() {
        $slug = url_title($this->input->post('title'), 'dash');
        $active = $this->input->post('active') == 'on' ? 1 : 0;
        $date = mdate('%Y-%m-%d %H:%i:%s', now('Europe/Berlin'));
        $data = array(
            'author' => $this->input->post('author'),
            'title'  => $this->input->post('title'),
            'slug'   => $slug,
            'text'   => $this->input->post('text'),
            'category' => $this->input->post('category'),
            'date_created' => $date,
            'active' => $active
        );
        return $this->db->insert('post', $data);
    }
}
