<?php
/**
 * Pages controller
 * Intended to serve static content from views/pages/ directory
 * 
 * Methods that are intented to show something should set 
 * $this->data['main_content_view'] for the master template to display
 * in the main content area
 * 
 * @author Constantin Kraft
 * 
 */
 
class Pages extends MY_Controller {
    
    /**
     * index
     */
    public function index() 
    {
        $this->view();
    }
    
    /**
     * View a specific page or default to home page
     * 
     * TODO: documentation
     */
    public function view($page = 'home') 
    {
        if( ! file_exists( APPPATH . 'views/pages/' . $page .'.php' )) 
        {   
            show_404();
        }
        
        //~ $this->load->view('templates/header', $data);
        //~ $this->load->view('pages/'.$page, $data);
        //~ $this->load->view('templates/footer', $data);
        // TODO: maybe create method in MY_Controller
        $this->data['main_content_view'] = $this->load->view('pages/'.$page, '', TRUE);
        $this->load->view('default', $this->data);
    }
}
