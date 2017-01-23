<?php


return [

    'attributes' => [

        [
            'slug'  => 'email_address',
            'name'  => 'E-mail Address',
            'type'  => 'email',
            'rules' => 'required|email'
        ],

        [
            'slug'  => 'header_styles',
            'name'  => 'Header',
            'type'  => 'textarea',
            'rules' => ''
        ],

        [
            'slug'  => 'footer_scripts',
            'name'  => 'Footer',
            'type'  => 'textarea',
            'rules' => ''
        ],

    ],

];