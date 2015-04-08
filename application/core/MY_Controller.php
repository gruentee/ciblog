<?php
/** 
 * Extend CI_Controller for common behaviour
 * 
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
        
    // Link text => route
    // TODO: l10n
    private $site_navigation = array(
        'Home'          => '/',
        'About'         => '/about',
        'Archive'       => '/archive'
    );

    function __construct() {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->helper('language');
        $this->load->helper('debug');
        // Load language file
        //~ $this->lang->load('en_admin', 'english');
        
        $this->_generate_sitenav();
    }
    
    private function _generate_sitenav()
    {
        $navigation = array();
        foreach($this->site_navigation as $text => $url)
        {
            $current_page = $this->uri->rsegment(1, 0);
            // Strange behaviour: 
            //~ $active = array_shift(explode('/', base_url())) == $url ? 'active' : '';
            $active = $url == $current_page ? 'active' : '';
            $navigation[] = anchor(
                base_url($url),
                $text
                ,array('class' => 'blog-nav-item ' . $active)
                //~ , 'title' => $current_page
                //~ )
            );
        }
        
        $this->data['sitenav'] = $navigation;
    }
    
}

?>
