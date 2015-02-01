<?php

namespace Phpmvc\Comment;

/**
 * To attach comments-flow to a page or some content.
 *
 */
class CommentController extends \Anax\Comments\CommentsDbaseController implements \Anax\DI\IInjectionAware
{
    //use \Anax\DI\TInjectable;
    
    

        /**
     * View all comments.
     *
     * @return void
     */
    public function viewAction($key = null){
        $id = null;
        $comments = new \Phpmvc\Comment\CommentsInSession();
        $comments->setDI($this->di);
        $all = $comments->findAll($key);
        if ($all == NULL){ //No comments in session -> read from database
            $all = array();
            $this->initialize();
            $allFromDbase = $this->getAllAction(); //Read all posts from database
            foreach ($allFromDbase as $commentet){
                $name = $commentet->name;
                if ($this->url->getPage() == $commentet->keyid) { 
                    $comment = [
                        'content'   => $commentet->content,
                        'name'      => $commentet->name,
                        'web'       => $commentet->web,
                        'mail'      => $commentet->mail,
                        //'ip'        => $this->request->getServer('REMOTE_ADDR'),
                        'timestamp' => $commentet->timestamp,
                        'key'       => $commentet->keyid,
                    ];
                    $id = $commentet->id;
                    //$key = $commentet->keyid;

                    $comments = new \Phpmvc\Comment\CommentsInSession();
                    $comments->setDI($this->di);
                    $comments->saveComment($comment, $id, $key); //save to session
                }
                
            }
            
            $all = $comments->findAll($key);
        }
        
        //$comments=$all;  

        $this->views->add('comment/comments', [
            'comments' => $all,
            'key' => $key,
            'id' => $id
        ]);
    }
    
    

    /**
     * Save a edited comment.
     *
     * @return void
     */
    //in editform.tpl.php: <input type='submit' name='doSave', call for this function
    //$this->url->create('comment/save'), call for this function
    public function saveAction($id=null){
        $isPosted = $this->request->getPost('doSave');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }
        $id = $this->request->getPost('commentId'); //Sets id for a specific comment   
        $key = $this->request->getPost('key');
        $now = date(DATE_RFC2822);
        $now = gmdate('Y-m-d H:i:s'); 
        $comment = [
            'content'   => $this->request->getPost('content'),
            'name'      => $this->request->getPost('name'),
            'web'       => $this->request->getPost('web'),
            'mail'      => $this->request->getPost('mail'),
            //'ip'        => $this->request->getServer('REMOTE_ADDR'),
            'timestamp' => $now,
        ];

        $comments = new \Phpmvc\Comment\CommentsInSession();
        $comments->setDI($this->di);
        $comments->saveComment($comment, $id, $key);
        //Edit database
        $this->initialize(); //Database
        $this->editCommentDbaseAction($comment, $id, $key);
        
        $this->response->redirect($this->request->getPost('redirect'));
    }
    
    /**
     * Delete a comment.
     *
     * @return void
     */
    //in comments.tpl.php: <input type='submit' name='doDeleteComment', call for this function
    //$this->url->create('comment/deleteComment'), call for this function
    public function deleteCommentAction($id = NULL) 
    {
        $isPosted = $this->request->getPost('doDeleteComment'); //Test
        
        $id = $this->request->getPost('commentId'); //Sets id for a specific comment
        
        if(!$isPosted){ //Test
            $this->response->redirect($this->request->getPost('redirect'));
        }
        
        //$comments = new \Phpmvc\Comment\CommentsInSession();
        $comments = new \Phpmvc\Comment\CommentsInSession();
        $comments->setDI($this->di);
        $key = $this->request->getPost('key'); //Get current view
        $comments->deleteComment($id, $key); //Delete a specific comment for a specific view
        
        
        
        $this->initialize(); //Database
        $this->deleteCommentDbaseAction($id, $key);

        $this->response->redirect($this->request->getPost('redirect'));
    }
    
    /**
     * Add a comment.
     *
     * @return void
     */
    //in form.tpl.php: <input type='submit' name='doCreate', call for this function
    //$this->url->create('comment/add'), call for this function
    public function addAction()
    {
        $isPosted = $this->request->getPost('doCreate');//Test
        
        if (!$isPosted) { //Testing
            $this->response->redirect($this->request->getPost('redirect'));
        }
        
        //Get varaibles from form.tpl.php
        //Edit time:
        $now = date(DATE_RFC2822);
        $now = gmdate('Y-m-d H:i:s'); 
        $comment = [
            'content'   => $this->request->getPost('content'),
            'name'      => $this->request->getPost('name'),
            'web'       => $this->request->getPost('web'),
            'mail'      => $this->request->getPost('mail'),
            'timestamp' => $now, //Now
            //'ip'        => $this->request->getServer('REMOTE_ADDR'),
        ];
        
        $comments = new \Phpmvc\Comment\CommentsInSession();
        $comments->setDI($this->di);

        $key = $this->request->getPost('key'); //Get vaiable, from wich view
        $comments->add($comment, $key); //Adds a comment to a specific view (key)     
        
        //Put to Database
        $all = $comments->findAll($key); //How many?
        $lastId=0;
        foreach ($all as $id => $comment){
            $lastId=$id;
        }       
        $this->initialize(); //Database
        $this->addCommentDbaseAction($comment, $key, $lastId);

        $this->response->redirect($this->request->getPost('redirect'));
    } 
    
    /**
     * Edit choosen comment.
     *
     * @return void
     */
    //in comments.tpl.php: <input type='submit' name='doEdit' , call for this function
    //$this->url->create('comment/editView/'), call for this function
    public function editViewAction(){
        $this->theme->setTitle("Ändra meddelande"); //Set title
        $comments = new \Phpmvc\Comment\CommentsInSession();
        $comments->setDi($this->di);        
        $key = $this->request->getPost('key'); //Get varable key from hiddenpost, key from wich view
        $id = $this->request->getPost('commentId'); //Get varable id from hiddenpost, id of a specific comment
        $comment = $comments->getComment($id, $key); //function in CommentsInSession
        
        //Send variables to editform.tpl.php
        $this->views->add('comment/editform', [
        'mail'      => $comment['mail'],
        'web'       => $comment['web'],
        'name'      => $comment['name'],
        'content'   => $comment['content'],
        'key'       => $key,
        'id'        => $id
        ]);
    }



    /**
     * Remove all comments.
     *
     * @return void
     */
    //in form.tpl.php: $this->url->create('comment/removeAll'), call for this function
    //in form.tpl.php: name='doRemoveAll', call for this function
    public function removeAllAction()
    {
        $isPosted = $this->request->getPost('doRemoveAll');
        
        if (!$isPosted) {
            $this->response->redirect($this->request->getPost('redirect'));
        }

        $comments = new \Phpmvc\Comment\CommentsInSession();
        $comments->setDI($this->di);

        $comments->deleteAll();
        
        //CommentsDbaseController database
        $this->initialize(); //Database
        $this->deleteAllCommentsAction();

        $this->response->redirect($this->request->getPost('redirect'));
    }
}
