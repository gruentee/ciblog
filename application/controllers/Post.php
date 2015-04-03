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
}
