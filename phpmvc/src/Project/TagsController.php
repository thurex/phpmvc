<?php
namespace Anax\Project;

/**
 * A controller for users and admin related events
 * 
 */
class TagsController implements \Anax\DI\IInjectionAware {
    use \Anax\DI\TInjectable;
    
    /**
     * Initialize the controller
     * 
     *
     * @return void
     */
    public function initialize(){
        $this->tags = new \Anax\Project\Tags();
        $this->tags->setDI($this->di);
    }
    
    public function tagsAction(){
        $this->initialize();
        $all = $this->tags->findAll();
        
        $this->theme->setTitle("Taggs");
        $this->views->add('project/tags', [
            'tags' => $all,
            'title' => "Taggar",
        ]);
    }
    
    
    public function tagidAction($id = null){
        $this->initialize();
        $this->session->set('tagid', [
            'id' => $id
            ]);
        //$this->url->create("questions/showtag/$id");
        $url = $this->url->create("questions/getall");
        $this->response->redirect($url);   
        
    }
}

