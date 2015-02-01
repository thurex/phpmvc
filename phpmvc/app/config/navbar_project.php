<?php
/**
 * Config-file for navigation bar.
 *
 */
$loggedin = $this->di->session->has('currentuser');
if ($loggedin == true){
    return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Hem',   
            'url'   => '',  
            'title' => 'Hem'
        ],
 
        // This is a menu item
        'questions'  => [
            'text'  => 'Frågor',   
            'url'   => 'questions/getall',   
            'title' => 'Frågor',
            /*

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [
                    
                    // This is a menu item of the submenu
                    
                    'kmom04'  => [
                        'text'  => 'Kmom04',   
                        'url'   => 'kmom04',  
                        'title' => 'Kmom04'
                    ],
                    
                    'kmom03'  => [
                        'text'  => 'Kmom03',   
                        'url'   => 'kmom03',  
                        'title' => 'Kmom03'
                    ],
                    
                    // This is a menu item of the submenu
                    
                    'kmom02'  => [
                        'text'  => 'Kmom02',   
                        'url'   => 'kmom02',  
                        'title' => 'Kmom02'
                    ],

                    // This is a menu item of the submenu
                    'kmom01'  => [
                        'text'  => 'Kmom01',   
                        'url'   => 'kmom01',  
                        'title' => 'Kmom01'
                    ],

                    
                ],
            ],
             * 
             */
        ],
        
        // This is a menu item
        'users' => [
            'text'  =>'Användare', 
            'url'   =>'users/list',  
            'title' => 'Användare'
        ],
        /*
        'users' => [
            'text'  =>'Användare', 
            'url'   =>'users/project_list',  
            'title' => 'Användare'
        ],
         * 
         */
        // This is a menu item
        'tags' => [
            'text'  =>'Taggar', 
            'url'   =>'tags/tags',  
            'title' => 'Taggar'
        ],
        /*
        // This is a menu item
        'login' => [
            'text'  =>'Login', 
            'url'   =>'users/login',  
            'title' => 'Login'
        ],
        
        // This is a menu item
        'signup' => [
            'text'  =>'Sign up', 
            'url'   =>'users/signup',  
            'title' => 'Sign up'
        ],
         * 
         */
        
        // This is a menu item
        'profile' => [
            'text'  =>'Profil', 
            'url'   =>'users/profile',  
            'title' => 'Profile'
        ],
        
        // This is a menu item
        'logout' => [
            'text'  =>'Logout', 
            'url'   =>'users/logout',  
            'title' => 'Logout'
        ],
        
        // This is a menu item
        'source' => [
            'text'  =>'Källkod', 
            'url'   =>'source',  
            'title' => 'Källkod'
        ],
 
        // This is a menu item
        /*
        'tags' => [
            'text'  =>'Taggar', 
            'url'   =>'project/tags',  
            'title' => 'Taggar'
        ],
         * 
         */
        
        // This is a menu item
        'about' => [
            'text'  =>'Om', 
            'url'   =>'about',  
            'title' => 'Om'
        ],
             
    ],
 
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
        if ($url == $this->di->get('request')->getRoute()) {
            return true;
        }
    },

    // Callback to create the urls
    'create_url' => function($url) {
        return $this->di->get('url')->create($url);
    },
];
}
else {
    return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Hem',   
            'url'   => '',  
            'title' => 'Hem'
        ],
 
        // This is a menu item
        'questions'  => [
            'text'  => 'Frågor',   
            'url'   => 'questions/getall',   
            'title' => 'Frågor',
            /*

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [
                    
                    // This is a menu item of the submenu
                    
                    'kmom04'  => [
                        'text'  => 'Kmom04',   
                        'url'   => 'kmom04',  
                        'title' => 'Kmom04'
                    ],
                    
                    'kmom03'  => [
                        'text'  => 'Kmom03',   
                        'url'   => 'kmom03',  
                        'title' => 'Kmom03'
                    ],
                    
                    // This is a menu item of the submenu
                    
                    'kmom02'  => [
                        'text'  => 'Kmom02',   
                        'url'   => 'kmom02',  
                        'title' => 'Kmom02'
                    ],

                    // This is a menu item of the submenu
                    'kmom01'  => [
                        'text'  => 'Kmom01',   
                        'url'   => 'kmom01',  
                        'title' => 'Kmom01'
                    ],

                    
                ],
            ],
             * 
             */
        ],
        
        // This is a menu item
        'users' => [
            'text'  =>'Användare', 
            'url'   =>'users/list',  
            'title' => 'Användare'
        ],
        /*
        'users' => [
            'text'  =>'Användare', 
            'url'   =>'users/project_list',  
            'title' => 'Användare'
        ],
         * 
         */
        // This is a menu item
        'tags' => [
            'text'  =>'Taggar', 
            'url'   =>'tags/tags',  
            'title' => 'Taggar'
        ],
        
        // This is a menu item
        'login' => [
            'text'  =>'Login', 
            'url'   =>'users/login',  
            'title' => 'Login'
        ],
        
        // This is a menu item
        'signup' => [
            'text'  =>'Sign up', 
            'url'   =>'users/add',  
            'title' => 'Sign up'
        ],
        /*
        // This is a menu item
        'profile' => [
            'text'  =>'Profil', 
            'url'   =>'users/profile',  
            'title' => 'Profile'
        ],
        
        // This is a menu item
        'logout' => [
            'text'  =>'Logout', 
            'url'   =>'users/logout',  
            'title' => 'Logout'
        ],  
         * 
         */      
        
        // This is a menu item
        'source' => [
            'text'  =>'Källkod', 
            'url'   =>'source',  
            'title' => 'Källkod'
        ],
 
        // This is a menu item
        /*
        'tags' => [
            'text'  =>'Taggar', 
            'url'   =>'project/tags',  
            'title' => 'Taggar'
        ],
         * 
         */
        
        // This is a menu item
        'about' => [
            'text'  =>'Om', 
            'url'   =>'about',  
            'title' => 'Om'
        ],
             
    ],
 
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
        if ($url == $this->di->get('request')->getRoute()) {
            return true;
        }
    },

    // Callback to create the urls
    'create_url' => function($url) {
        return $this->di->get('url')->create($url);
    },
];
}

