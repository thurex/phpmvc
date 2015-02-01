<?php 
/**
 * This is a Anax pagecontroller.
 *
 */

// Get environment & autoloader and the $app-object.
require __DIR__.'/config_with_app.php'; 

// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryDefault();

$di->set('form', '\Mos\HTMLForm\CForm');
 
$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
}); 

$di->set('TagsController', function() use ($di) {
    $controller = new \Anax\Project\TagsController();
    $controller->setDI($di);
    return $controller;
}); 

//Database
$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
    //$db->setVerbose(true);
    $db->connect();
    
    return $db;
});
//Table kmom04_user
$di->set('UsersController', function() use ($di) {
    $controller = new \Anax\Users\UsersController();
    $controller->setDI($di);
    return $controller;
});
//Table kmom04_comments
$di->set('QuestionsController', function() use ($di) {
    $controller = new \Anax\Questions\QuestionsController();
    $controller->setDI($di);
    return $controller;
}); 
 
$app = new \Anax\Kernel\CAnax($di);

//Theme configuration
$app->theme->configure(ANAX_APP_PATH . 'config/theme_me_kmom05.php');

//Routes
$app->router->add('', function() use ($app) {
    $app->theme->setTitle("Brädspelssajt");

    $content = $app->fileContent->get('me.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('me/page', [
        'content' => $content]);
    
    //if (isset($_SESSION['currentuser'])){
        //include comments
        //*****************
         $app->dispatcher->forward([
            'controller' => 'comment',
            'action'     => 'view',
            'params'     => ['key'=>'',],
        ]);

        //Variables to a view
        $app->views->add('comment/form', [
            'mail'      => null,
            'web'       => null,
            'name'      => null,
            'content'   => null,
            'output'    => null,
            'key'       => '' //unique name for a view
        ]); 
    //}
    
   
    
    $app->views->add('me/page', [
        'byline' => $byline,
    ]);
    
});

$app->router->add('about', function() use ($app) {
    $app->theme->setTitle("Brädspelssajt");

    $content = $app->fileContent->get('about.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');

    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('me/page', [
        'content' => $content]);
    
    //if (isset($_SESSION['currentuser'])){
        //include comments
        //*****************
         $app->dispatcher->forward([
            'controller' => 'comment',
            'action'     => 'view',
            'params'     => ['key'=>'',],
        ]);

        //Variables to a view
        $app->views->add('comment/form', [
            'mail'      => null,
            'web'       => null,
            'name'      => null,
            'content'   => null,
            'output'    => null,
            'key'       => '' //unique name for a view
        ]); 
    //}
    
   
    
    $app->views->add('me/page', [
        'byline' => $byline,
    ]);
    
});

$app->router->add('initq', function() use ($app) {
    include('initq.php'); 
    
});
/*
$app->router->add('Tags', function() use ($app) {
    $app->theme->setTitle("Taggs");
    
    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->dispatcher->forward([
        'controller' => 'Tags',
        'action'     => 'view',
        //'params'     => ['key'=>'',],
    ]);
    
    $app->views->add('project/tags', [
        //'content' => $content,
        'byline' => $byline,
    ]);
    
});
 * 
 */

$app->router->add('questions', function() use ($app) {
    $app->theme->setTitle("Frågor");
    
    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('project/questions', [
        //'content' => $content,
        'byline' => $byline,
    ]);
    
});

$app->router->add('setup', function() use ($app) {
    $app->theme->setTitle("Frågor");    
    /*
    $content = $app->fileContent->get('kmom01.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
     * 
     */
    
    $byline = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    //include comments
    //*****************
     $app->dispatcher->forward([
        'controller' => 'questions',
        'action'     => 'setup',
        'params'     => ['key'=>'thurextable',],
      ]);
    
    $app->views->add('questions/questions', [
        //'content' => $content,
        'byline' => $byline,
    ]);
    
    
});


$app->router->add('source', function() use ($app) {
    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");
    
    $source = new \Mos\Source\CSource([
        'secure_dir' => '..',
        'base_dir' => '..',
        'add_ignore' => ['.htaccess'],
    ]);
    
    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
});


// Render the response using theme engine.
$app->router->handle();
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_project.php');
$app->theme->render();
