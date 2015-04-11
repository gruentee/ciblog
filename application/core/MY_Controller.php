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
        
        $this->data['sitenav'] = $this->_generate_sitenav();
        
        // set view variables
        $this->data['sidebar']  = $this->_generate_sidebar_content();
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
        return $navigation;
    }
    
    private function _generate_sidebar_content()
    {
        $this->load->model('category_model');
        $sidebar = array('archive' => array(), 'categories' => array());
        // TODO: maybe move HTML generation to views for extra flexibility
        $cats = $this->category_model->get_categories();
        foreach ($cats as $cat) 
        {
            // TODO: l10n
            $sidebar['categories'][] = anchor(
                base_url('category/' . $cat['slug']),
                $cat['name'],
                'title="Einträge der Kategorie ' . $cat['name'] . ' zeigen"' 
            );
        }
        // generate link for each month of the year
        // TODO: l10n
        for( $i = 1; $i <= 12; $i++ ) {
            $month_name = strftime( '%B', mktime( 0, 0, 0, $i, 1 ) );
            $now = now();
            $link = anchor(
                base_url(strftime("/%Y/{$i}", $now)),
                $month_name,
                'title="Einträge des Monats $monthname anzeigen"'
            );
            $sidebar['archive'][] = $link;
        }
        return $sidebar;
    }
}

?>
