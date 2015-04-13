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
        
        // TODO: Standard-SQL-Queries in Member-Variablen ablegen
        // TODO: refactor SQL queries using query builder
        $this->sql_select = "SELECT `post`.*, `user`.username, `user`.id as user_id
                FROM `post`
                INNER JOIN `user` ON `post`.author = `user`.id ";
        $this->sql_join_user = NULL;
        $this->sql_join_category = NULL;
    }
    
    /**
     * Get all posts or post specified by slug from DB
     * 
     * @param String slug identifying the post
     * @return Array array of record OR rows found
     */
    public function get_posts($slug=FALSE)
    {
        //~ $this->db->order_by('`post`.date_created', 'DESC');        
        $sql_select = "SELECT `post`.*, username, user.id as user_id
                FROM `post`
                INNER JOIN `user` ON `post`.author = `user`.id ";
        $sql_where = "WHERE `post`.slug = ? AND `post`.active=1";

        if ($slug === FALSE ) 
        {
            // TODO: limit # of posts -> pagination
            //~ $query = $this->db->get();
            $this->db->select('post.*, `user`.username, `user`.id as user_id');
            $this->db->from('post');
            $this->db->join('`user`', 'post.author = user.id');
            $this->db->where('post.active=1');
            $this->db->order_by('date_created', 'DESC');
            $query = $this->db->get();
            //~ $query = $this->db->query($sql_select);
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
    
    /**
     * get post by month
     * 
     * @param string month date string
     * @return array of post records or empty array
     */
    public function get_by_month($month=NULL, $year=NULL)
    {
        $start_date = mdate('%Y-%m-%d', mktime(0,0,0,$month,1,$year));
        $year = $month < 12 ? $year : $year +1;
        $month = $month < 12 ? $month : 1;
        $day = days_in_month($month, $year);
        $end_date = mdate('%Y-%m-%d', mktime(0,0,0,$month,$day,$year));
        $sql  = $this->sql_select;
        // BETWEEN syntax allows MySQL to use Indexes -> better performance
        $sql .= " WHERE `post`.date_created BETWEEN '$start_date' AND '$end_date'";
        $sql .= " ORDER BY `post`.date_created DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    /**
     * get by category 
     * 
     * @param string value of slug identifying the category
     * @return array of post records or empty array
     */
    public function get_by_category($slug)
    {
        $this->db->select('`post`.*, username, user.id as user_id, category.*');
        $this->db->from('post');
        $this->db->join('user', 'post.author=user.id');
        $this->db->join('category', 'post.category=category.id');
        $this->db->where('post.active', 1);
        $this->db->where('category.slug=', $slug);
        $this->db->order_by('date_created', 'DESC');
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
}
