<?php
/*
 * Contains form validation rule sets
 * 
 * @author Constantin Kraft
 *
 */

$config = array(
    'post/create' => array(
        array(
            'field' => 'title',
            'label' => 'Titel',
            'rules' => 'required|min_length[3]|max_length[60]|alpha_numeric|encode_php_tags',
            'errors' => array(
                'required' => '%s darf nicht leer sein',
                'min_length' => '%s muss zwischen 3 und 60 Zeichen lang sein',
                'alpha_numeric' => '%s darf nur alphanumerische [A-Z 0..9] Zeichen enthalten.'
            )
        ),
        array(
            'field' => 'text',
            'label' => 'Text',
            'rules' => 'required|encode_php_tags',
            'errors' => array(
                'required' => '%s darf nicht leer sein'
            )
        )
    )
);
