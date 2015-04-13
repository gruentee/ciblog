<?php
/**
 * Posts controller
 * 
 * @author Constantin Kraft
 * 
 */

class Post extends MY_Controller 
{
    private $helpers = array(
        'date'
    );
    
    
    public function __construct() {
        parent::__construct();
        
        $this->load->helper($this->helpers);
        
        $this->load->model('post_model');     
    }
    
    /**
     * Posts controller index method - show all posts 
     */
    public function index() {
        $posts = $this->post_model->get_posts();
        // render list view
        $list = $this->load->view('post/list', array("posts" => $posts), TRUE);
        //~ echo "<pre>";
        //~ print_r($list);
        //~ echo "</pre>";
        $this->data['main_content_view'] = $list;
        $this->load->view('default', $this->data);
        // TODO: map author's user id to user name
        // TODO: maybe format date nicely here instead of view
    }
    
    /**
     * View a single post
     * 
     * @param String slug by which to select post
     *
     */
    public function view($slug)
    {
        // TODO: do validation
        $post_items = $this->post_model->get_posts($slug);
        if(count($post_items) > 0)
        {
            $this->data['main_content_view'] = $this->load->view(
                'post/view',
                array('post' => $post_items), TRUE
            );
        } 
        else 
        {
            // TODO: localize message
            // TODO: move to view
            $this->data['main_content_view'] = "Post  nicht gefunden!";
        }
        $this->load->view('default', $this->data);
    }
    
    /**
     * Get posts by month
     * 
     * @return array of post records found or empty array
     */ 
    public function view_by_month($year, $month) 
    {
        //~ $month = $this->input->get('month', TRUE);
        //~ $year = $this->input->get('year', TRUE);
        //~ printf("%d %d", $month, $year);
        
        if ( checkdate($month, 1, $year) == TRUE ) 
        {
            $post_items = $this->post_model->get_by_month($month, $year);
            $this->data['main_content_view'] = $this->load->view(
                'post/list',
                array('posts' => $post_items), TRUE
            );
        }
        else 
        {
            // TODO: send 404;
            $this->data['main_content_view'] = "bla";
        }        

        //~ $this->data->main_content_view = $post_items;
        $this->load->view('default', $this->data);
    }
    
    /**
     * Create a post
     * 
     */
    public function create()
    {
        $this->load->library('form_validation');
        $category_model = $this->load->model('category_model');
        $tag_model = $this->load->model('tag_model');
        
        // TODO: get user_id from Session
        $data['user_id'] = 1;
        // TODO: l10n
        $data['success'] = FALSE;
        $data['page_title'] = 'Blogpost erstellen';
        $cats_array = $this->category_model->get_categories();
        // BEWARE: array_column requires PHP >= 5.5.0
        $data['category_options'] = array_column($cats_array, 'name', 'id');
        $tags_array = $this->tag_model->get_tags();
        $data['tag_options'] = array_column($tags_array, 'tag', 'id');

        if ($this->form_validation->run() === FALSE) 
        {
            $this->data['main_content_view'] = $this->load->view('post/create', $data, TRUE);
        }
        else 
        {
            // creation
            $data['success'] = TRUE;
                $this->data['main_content_view'] = $this->load->view('post/create', $data, TRUE);
            if($this->post_model->insert()) {
                $tags = $this->input->post('tags[]');
                if(is_array($tags)) 
                {
                    $post_id = $this->db->insert_id();
                    foreach ($tags as $k => $v) 
                    {
                        $data = array('post_id' => $post_id, 'tag_id' => $v);
                        $this->db->insert('posts_tags', $data);
                    }
                }
                $data['message'] = "Post <i>„{$this->input->post('title')}“</i> wurde erfolgreich erstellt!";
            }
            else 
            {
                $data['message'] = "Fehler beim Erstellen des Posts!";
            }
            $this->data['main_content_view'] = $this->load->view('post/create', $data, TRUE);
        }
        
        $this->load->view('default', $this->data);
    }
}
