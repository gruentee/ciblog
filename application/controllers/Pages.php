<?php
/**
 * Pages controller
 * 
 * @author Constantin Kraft
 * 
 */
 
class Pages extends CI_Controller {
    
    /**
     * Generic view function
     * 
     * TODO: documentation
     */
    public function view($page = 'home') 
    {
        if( ! file_exists( APPPATH . 'views/pages' . $page .'.php' )) 
        {   
            show_404();
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    
    }
}
