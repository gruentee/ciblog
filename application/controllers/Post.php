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
        $post = $this->post_model->get_posts($slug);
        if(count($post) > 0)
        {
            $this->data['main_content_view'] = $this->load->view(
                'post/view',
                array('post' => $post), TRUE
            );
        } 
        else 
        {
            // TODO: localize message
            // TODO: move to view
            $this->data['main_content_view'] = "Post $slug nicht gefunden!";
        }
        $this->load->view('default', $this->data);
    }
    
}
